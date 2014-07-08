<?php
function turboSMTP_admin(){
	add_options_page('turboSMTP Options', 'turboSMTP','manage_options', __FILE__, 'turboSMTP_page');
	add_action('load-turboSMTP_admin', 'turboSMTP_help_tab');
	
}

function turboSMTP_page(){
	$ts_nonce = wp_create_nonce('turboSMTP_nonce');
	global $tsOptions;
	if(isset($_POST['turboSMTP_mail_update']) && isset($_POST['turboSMTP_mail_nonce_update'])){
		if(!wp_verify_nonce(trim($_POST['turboSMTP_mail_nonce_update']),'turboSMTP_nonce')){
			wp_die('Security check not passed!');
		}
		$tsOptions = array();
		$tsOptions["from"] = trim($_POST['turboSMTP_mail_from']);
		$tsOptions["fromname"] = trim($_POST['turboSMTP_mail_fromname']);
		$tsOptions["host"] = trim($_POST['turboSMTP_mail_host']);
		$tsOptions["smtpsecure"] = trim($_POST['turboSMTP_mail_smtpsecure']);
		$tsOptions["port"] = trim($_POST['turboSMTP_mail_port']);
		$tsOptions["smtpauth"] = trim($_POST['turboSMTP_mail_smtpauth']);
		$tsOptions["username"] = trim($_POST['turboSMTP_mail_username']);
		$tsOptions["password"] = trim($_POST['turboSMTP_mail_password']);
		$tsOptions["deactivate"] = (isset($_POST['turboSMTP_mail_deactivate'])) ? trim($_POST['turboSMTP_mail_deactivate']) : "";
		update_option("turboSMTP_options",$tsOptions);
		if(!is_email($tsOptions["from"])){
			echo '<div id="message" class="updated fade error"><p><strong>' . __("The field 'Email \"From\" address' must be a valid email address!","turboSMTP") . '</strong></p></div>';
		}
		elseif(empty($tsOptions["host"])){
			echo '<div id="message" class="updated fade error"><p><strong>' . __("The field \"SMTP Host\" can not be left blank!","turboSMTP") . '</strong></p></div>';
		}
		else{
			echo '<div id="message" class="updated fade"><p><strong>' . __("Options saved.","turboSMTP") . '</strong></p></div>';
		}
	}
	if(isset($_POST['turboSMTP_mail_test']) && isset($_POST['turboSMTP_mail_nonce_test'])){
		if(!wp_verify_nonce(trim($_POST['turboSMTP_mail_nonce_test']),'turboSMTP_nonce')){
			wp_die('Security check not passed!');
		}
		$to = trim($_POST['turboSMTP_mail_to']);
		$subject = trim($_POST['turboSMTP_mail_subject']);
		$message = trim($_POST['turboSMTP_mail_message']);
		$failed = 0;
		if(!empty($to) && !empty($subject) && !empty($message)){
			try{
				$result = wp_mail($to,$subject,$message);
			}catch(phpmailerException $e){
				$failed = 1;
			}
		}
		else{
			$failed = 2;
		}
		if(!$failed){
			if($result==TRUE){
				echo '<div id="message" class="updated fade"><p><strong>' . __("Message sent successfully!","turboSMTP") . '</strong></p></div>';
			}
			else{
				$failed = 1;
			}
		}
		if($failed == 1){
			echo '<div id="message" class="updated fade error"><p><strong>' . __("Some errors occurred! Check the settings or if there are other plugins SMTP active!","turboSMTP") . '</strong></p></div>';
		}
		elseif($failed == 2){
			echo '<div id="message" class="updated fade error"><p><strong>' . __("The fields \"To\" can not be left blank when testing!","turboSMTP") . '</strong></p></div>';
		}
	}
	if(is_admin()){require_once('turboSMTP-admin.php');}
}
function turboSMTP_help_tab () {
    $screen = get_current_screen();

    // Add my_help_tab if current screen is My Admin Page
    $screen->add_help_tab( array(
        'id'	=> 'my_help_tab',
        'title'	=> __('My Help Tab'),
        'content'	=> '<p>' . __( 'Descriptive content that will show in My Help Tab-body goes here.' ) . '</p>',
    ) );
}
?>