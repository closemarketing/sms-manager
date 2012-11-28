<?php
function sms_options_page() {
$sms_apikey = get_option( "sms_apikey" );
$sms_api_user = get_option( "sms_user" );
$sms_api_pass = get_option( "sms_password" );
$sms_from = get_option( "sms_from" );
$sms_metavar = get_option( "sms_metavar" );
$sms_codecountry = get_option( "sms_codecountry" );
?>
	<div class="wrap">
		<h2>SMS Manager Options</h2>
		
		<br/>
		<form name='sms_update_options' id='sms_update_options' method='POST' action='<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'] ?>'>
			<table>
				<tr>
					<td><?php _e('API Key', 'smsman'); ?></td>
					<td><input type="text" name="sms_api_key" value="<?php echo $sms_apikey; ?>"/></td>
				</tr>
				<tr>
					<td><?php _e('API Username', 'smsman'); ?></td>
					<td><input type="text" name="sms_api_user" value="<?php echo $sms_api_user;?>"/></td>
				</tr>
				<tr>
					<td><?php _e('API Password', 'smsman'); ?></td>
					<td><input type="text" name="sms_api_pass" value="<?php echo $sms_api_pass;?>"/></td>
				</tr>
				<tr>
					<td><?php _e('SMS From', 'smsman'); ?></td>
					<td><input type="text" name="sms_from" value="<?php echo $sms_from;?>"/> <?php _e('(From Number for replies)', 'smsman'); ?></td>

				<tr>
					<td><?php _e('User Phone Variable', 'smsman'); ?></td>
					<td><input type="text" name="sms_metavar" value="<?php echo $sms_metavar;?>"/></td>
				</tr>
				<tr>
					<td><?php _e('Code Country', 'smsman'); ?></td>
					<td><input type="text" name="sms_codecountry" value="<?php echo $sms_codecountry;?>"/></td>
				</tr>
			</table><br/>
			<span class="submit"><input type="submit" value="Update" name="sms_options"/></span>
		</form>
	</div>
	<br/>
	<a href="http://www.jdoqocy.com/click-6479416-10807974" target="_top">Bulk SMS Gateway</a> - Send SMS's from your PC; easy integration!<img src="http://www.tqlkg.com/image-6479416-10807974" width="1" height="1" border="0"/>
	
	<div>
	</div>
<?php
}

function sms_meta_box_send(){
	global $smssuccfail;
	$sms_maxlen = "160";
?>
	<div style="padding: 10px;">
		<form name='send_sms_form' id='send_sms_form' method='POST'>
			<?php _e('Send an SMS to your subscribers:', 'smsman'); ?>
			<br/>
			<br/>
			<table>
				<tr>
					<td><?php _e('Message:', 'smsman'); ?></td>
				</tr>
				<tr>
					<td>
						<textarea maxlength="<?php echo $sms_maxlen; ?>" name="sms_message" id="sms_message"></textarea>
					</td>
				</tr>
				<tr>
					<td><input size=5 value="<?php echo $sms_maxlen; ?>" name="sms_left" id="sms_left" readonly="true"> <?php _e('Characters Left', 'smsman'); ?></td>
				</tr>
				<tr>
					<td><b><?php _e('Send To:', 'smsman'); ?></b> 
					<?php 
					  //Selección Permisos
			          $roles_list = get_editable_roles();    
			          echo '<select name="actrol" style="width:97%;" value="">';
			          echo '<option value=""></option>';
			          foreach ($roles_list as $role => $details) {
			              $roles_ID = esc_attr($role);
			              $roles_name = translate_user_role($details['name'] );
			              
			              echo '<option value="'.$roles_ID.'">'.$roles_name.'</option>';
			          }
			          echo '</select>'; 
			
			          ?>
								
					
					
					</td>
				</tr>
			</table>
			<span class="submit"><input type="submit" value="<?php _e('Send Messages', 'smsman'); ?>" /></span>
		</form>
<?php 
		echo $smssuccfail;
		$smssuccfail = '';?>
	</div>
<?php
}

function sms_meta_box_stats() {
	global $wpdb;
?>
	<div style="padding: 10px;">
			
			<?php
			$result = count_users();
			echo '<p><b>';
			_e('Total Registerd Users: ', 'smsman');			
			echo $result['total_users'].' </b></p>';
			foreach($result['avail_roles'] as $role => $count) {
				$role = ucwords(strtolower($role));
			    echo '<p><b>'.$role.' : </b>'.$count.' ';_e('user', 'smsman');
			    if (!$count) { echo 's'; }
			    echo '</p>';
			
			} ?>
	</div>
<?php
}

function sms_main_page() {
	global $smssuccfail;
?>
	<div class="wrap">
		<h2><?php _e('SMS Message Control Panel','smsman'); ?></h2>
	</div>
<?php
	add_meta_box("sms_send", __('Send SMS Messages','smsman'), "sms_meta_box_send", "sms");
	add_meta_box("sms_stats", __('Subscriber Statistics','smsman'), "sms_meta_box_stats", "smsstats");
?>
	<div id="dashboard-widgets-wrap">
		<div class="metabox-holder">
			<div style="float:left; width:50%;" class="inner-sidebar1">
<?php
	do_meta_boxes('sms','advanced','');
?>
			</div>
			<div style="float:right; width:50%;" class="inner-sidebar2">
<?php
	do_meta_boxes('smsstats','advanced','');
?>	
			</div>
		</div>
	</div>
<?php
}

/*function sms_metabox_post_sidebar() {
	global $wpdb,$post,$smssuccfail;
	$sendsms = get_post_meta($post->ID, 'sms_send_sms', true);
	echo '<p>'.__('Send Post via SMS?').'&nbsp;';
	echo '<input type="radio" name="sms_send_sms" id="sms_send_sms_yes" value="yes" '.checked('yes', $sendsms, false).' /> <label for="sms_send_sms_yes">'.__('Yes').'</label> &nbsp;&nbsp;';
	echo '<input type="radio" name="sms_send_sms" id="sms_send_sms_no" value="no" '.checked('no', $sendsms, false).' /> <label for="sms_send_sms_no">'.__('No').'</label>';
	echo '</p>';
	$table_name = $wpdb->prefix . "sms_subscribers";
	$result = $wpdb->get_results("SELECT count(*) as totalsubs FROM " . $table_name);
	echo '<p><b>Total Subscribers</b>: '.$result[0]->totalsubs.'</p>';
	echo $smssuccfail;
	$smssuccfail = '';
}

function sms_profile_fields($user) {
	echo "<h3>SMS Subscription Options</h3>";
	echo "<table class=\"form-table\">";
	echo "	<tr>";
	echo "		<th><label for=\"sms_profile_number\">Mobile Number</label></th>";
	echo "		<td>";
	echo "			<input type=\"text\" name=\"sms_profile_number\" id=\"sms_profile_number\" value=\"". esc_attr( get_the_author_meta( 'sms_profile_number', $user->ID ) ) ."\" class=\"regular-text\" /><br />";
	echo "			<span class=\"description\">Please enter your mobile number (International Format eg. 2773000000)</span>";
	echo "		</td>";
	echo "	</tr>";
	echo "</table>";
}

function sms_save_profile_fields($user_id) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
		
	$sms_number = $_POST['sms_profile_number'];
	$sms_number = ereg_replace("[^0-9]", "", $sms_number);
	
	//Check if its a valid cellphone number or blank.
	if(strlen($sms_number) >= 10 or $sms_number == "") {
		update_usermeta( $user_id, 'sms_profile_number', $sms_number);
	} else {
		return false;
	}
}*/
?>