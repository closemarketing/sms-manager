<?php
/*
Plugin Name: SMS Manager
Plugin URI: http://www.closemarketing.es/
Description: Allow Administrator send SMS to registered users with a defined variable for the phone. Based on the plugin of Gerhard Potgieter.
Author: David
Version: 1.0
Author URI: http://www.closemarketing.es/
*/

require_once WP_PLUGIN_DIR . "/sms-manager/install.php";
require_once WP_PLUGIN_DIR . "/sms-manager/options.php";
//require_once WP_PLUGIN_DIR . "/sms-manager/widget.php";
//require_once WP_PLUGIN_DIR . "/sms-manager/subscribers.php";
require_once WP_PLUGIN_DIR . "/sms-manager/functions.php";

function myplugin_init() {
    load_plugin_textdomain('smsman', false, dirname(plugin_basename(__FILE__)) . '/lang/');
} 
add_action('plugins_loaded', 'myplugin_init');

//
add_action("plugins_loaded", "sms_widget_init");

//Call install function if its a new install or update
register_activation_hook(__FILE__,'sms_install');

//Add the admin menu to the dashboad
add_action('admin_menu', 'sms_add_menu');

//New post fields to control sms sending
add_action('publish_post', 'sms_send_on_post', 99);
add_action('publish_post', 'sms_store_post_meta', 1, 2);
add_action('save_post', 'sms_store_post_meta', 1, 2);

//Profile SMS field
/*add_action( 'show_user_profile', 'sms_profile_fields' );
add_action( 'edit_user_profile', 'sms_profile_fields' );
add_action( 'personal_options_update', 'sms_save_profile_fields' );
add_action( 'edit_user_profile_update', 'sms_save_profile_fields' );*/
add_action( 'send_headers', 'sms_set_cookie');

//Add ajax script to blog
wp_enqueue_script('jquery');
wp_register_script("sms-manager", "/wp-content/plugins/sms-manager/international-sms-manager.js");
wp_enqueue_script('sms-manager');

global $smssuccfail;

function sms_add_menu() {
	add_menu_page('SMS Manager', 'SMS Manager', 8, __FILE__, 'sms_main_page',WP_PLUGIN_URL . '/sms-manager/clickatell.png');
	add_submenu_page(__FILE__, __('Options','smsman'), __('Options','smsman'), 8, 'international-sms-options', 'sms_options_page');
	//add_submenu_page(__FILE__, 'Subscribers', 'Subscribers', 8, 'international-sms-subscribers', 'sms_subscribers_page');
}

function sms_store_post_meta($post_id, $post = false) {
	$post = get_post($post_id);
	if (!$post || $post->post_type == 'revision') {
		return;
	}
	$posted_meta = $_POST['sms_send_sms'];
	
	if (!empty($posted_meta)) {
		$posted_meta == 'yes' ? $meta = 'yes' : $meta = 'no';
	} else {
		$meta = 'no';
	}
	
	update_post_meta($post_id, 'sms_send_sms', $meta);
}

function sms_set_cookie()
{
	global $countrycode;
	
	if (isset($_COOKIE['countrycode'])) {
		$countrycode = $_COOKIE['countrycode'];
	} else {
		$countrycode = getCountryCodeFromIP(get_ip());
	}
	setcookie('countrycode', $countrycode);
}

//Handle POST variables to save options and send messages

//First check if sms messages need to be sent
if(!empty($_POST['sms_message'])) {
	//require_once WP_PLUGIN_DIR . "/sms-manager/class.sms_api.php";
	
	$user = get_option( "sms_user" );
	$password = get_option( "sms_password" );
	$api_id = get_option( "sms_apikey" );
	$from = get_option( "sms_from" );
	$sms_metavar = get_option( "sms_metavar" );
	$sms_codecountry = get_option( "sms_codecountry" );
	$baseurl ="http://api.clickatell.com";
	$text = urlencode($_POST['sms_message']);
	
	// auth call
    $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";
    //echo $url;
 
    // do auth call
    $ret = file($url);
 
    // explode our response. return string is on first line of the data returned
    $sess = explode(":",$ret[0]);
    
	
	if ($sess[0] == "OK") {
		//Send SMS to subscribed readers
			
			
			global $wpdb;
			$sess_id = trim($sess[1]); // remove any whitespace
			$actrol = $_POST['actrol'];
			
			$aUsersID = $wpdb->get_col( $wpdb->prepare("SELECT $wpdb->users.ID FROM $wpdb->users"));
			foreach ( $aUsersID as $iUserID ) :
				$sms_number = get_user_meta( $iUserID, $sms_metavar );
				$sms_number = $sms_number[0];
				
				$user = new WP_User( $iUserID );

				if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
					foreach ( $user->roles as $role )
						$sms_role = $role;
				}
								
				if ( $sms_number <> "" && $sms_role==$actrol) {
					$sms_number = $sms_codecountry.$sms_number;
					$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$sms_number&text=$text";
			 
			        // do sendmsg call
			        $ret = file($url);
			        $send = explode(":",$ret[0]);
			        
					if ($send[0] == "ID") {
						$smssuccfail .= "<span style=\"color: green\">Message sent to $sms_number</span><br/>";
					} else {
						$smssuccfail .= "<span style=\"color: red\">Message failed to $sms_number</span><br/>";
					}
				}
			endforeach;
		
	} else {
		$smssuccfail = "<span style=\"color: red\">Failed to authenticate to Clickatell</span>";
	}
}

//Update SMS options
if(!empty($_POST['sms_options'])) {
	update_option( "sms_user", $_POST['sms_api_user']);
	update_option( "sms_password", $_POST['sms_api_pass']);
	update_option( "sms_apikey", $_POST['sms_api_key']);
	update_option( "sms_header", $_POST['sms_header']);
	update_option( "sms_footer", $_POST['sms_footer']);
	update_option( "sms_from", $_POST['sms_from']);
	update_option( "sms_metavar", $_POST['sms_metavar']);
	update_option( "sms_codecountry", $_POST['sms_codecountry']);
}
?>