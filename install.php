<?php
$sms_version = "1.1.1";

function sms_install() {
	global $wpdb;
	global $sms_version;
	
	$table_name = $wpdb->prefix . "sms_subscribers";
	
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) { //Plugin table does not exist yet, create it now
	
		$sql = "CREATE TABLE " . $table_name . " (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			number text NOT NULL,
			ip varchar(100) NOT NULL,
			date datetime NOT NULL,
			UNIQUE KEY id (id)
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		add_option('sms_header','Receive updates via SMS');
		add_option('sms_footer',"SMS Subscription Manager by <a href='http://www.igeek.co.za/'>iGeek</a>");
		add_option('sms_max','160');
		add_option('sms_version',$sms_version);
		add_option('sms_from','');
		
	} else { // Plugin table already exists just update it if new version available
	
		$installed_ver = get_option( "sms_version" );
		if($installed_ver != $sms_version ) {
			$sql = "CREATE TABLE " . $table_name . " (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				number text NOT NULL,
				ip varchar(100) NOT NULL,
				date datetime NOT NULL,
				UNIQUE KEY id (id)
			);";
		
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			update_option( "sms_version", $sms_version );
			update_option( "sms_max", '160' );
		}
	}
}
?>