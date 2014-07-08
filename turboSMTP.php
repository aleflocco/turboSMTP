<?php
/*
Plugin Name: turboSMTP
Plugin URI: https://github.com/aleflocco/turboSMTP
Description: turboSMTP WP plugin allows you to send emails via turboSMTP instead of the PHP mail() function.
Version: 1.0
Author: Alessandro Flocco
Author URI: http://www.serversmtp.com
Text Domain: turboSMTP
Domain Path: /languages
*/

// Actions and Filters

add_filter('init','load_turboSMTP_lang');
add_action('phpmailer_init','turboSMTP');
register_activation_hook( __FILE__ , 'turboSMTP_activate' );
add_filter('plugin_action_links','turboSMTP_settings_link',10,2);
add_action('admin_menu', 'turboSMTP_admin');
add_action('admin_enqueue_scripts', 'turboSMTP_styles');

$tsOptions = get_option("turboSMTP_options");

if($tsOptions["deactivate"]=="yes"){
	register_deactivation_hook( __FILE__ , create_function('','delete_option("turboSMTP_options");') );
}

// Functions

function turboSMTP_styles() {
	wp_register_style( 'turboSMTP_css', plugins_url( 'css/turboSMTP.css' ,  __FILE__ ) );
	wp_enqueue_style( 'turboSMTP_css' );
}

function load_turboSMTP_lang(){
	$currentLocale = get_locale();
	if(!empty($currentLocale)){
		$moFile = dirname(__FILE__) . "/languages/turboSMTP-" . $currentLocale . ".mo";
		if(@file_exists($moFile) && is_readable($moFile)) { load_textdomain('turboSMTP',$moFile); }
	}
}

function turboSMTP($phpmailer){
	global $tsOptions;
	if( !is_email($tsOptions["from"]) || empty($tsOptions["host"]) ){
		return;
	}
	$phpmailer->Mailer = "smtp";
	$phpmailer->From = $tsOptions["from"];
	$phpmailer->FromName = $tsOptions["fromname"];
	$phpmailer->Sender = $phpmailer->From; //Return-Path
	$phpmailer->AddReplyTo($phpmailer->From,$phpmailer->FromName); //Reply-To
	$phpmailer->Host = $tsOptions["host"];
	$phpmailer->SMTPSecure = $tsOptions["smtpsecure"];
	$phpmailer->Port = $tsOptions["port"];
	$phpmailer->SMTPAuth = ($tsOptions["smtpauth"]=="yes") ? TRUE : FALSE;
	if($phpmailer->SMTPAuth){
		$phpmailer->Username = $tsOptions["username"];
		$phpmailer->Password = $tsOptions["password"];
	}
}

function turboSMTP_activate(){
	$tsOptions = array();
	$tsOptions["from"] = "";
	$tsOptions["fromname"] = "";
	$tsOptions["host"] = "pro.turbo-smtp.com";
	$tsOptions["smtpsecure"] = "ssl";
	$tsOptions["port"] = "465";
	$tsOptions["smtpauth"] = "yes";
	$tsOptions["username"] = "";
	$tsOptions["password"] = "";
	$tsOptions["deactivate"] = "";
	add_option("turboSMTP_options",$tsOptions);
}

function turboSMTP_settings_link($action_links,$plugin_file){
	if($plugin_file==plugin_basename(__FILE__)){
		$ts_settings_link = '<a href="options-general.php?page=' . dirname(plugin_basename(__FILE__)) . '/class-turboSMTP.php">' . __("Settings") . '</a>';
		array_unshift($action_links,$ts_settings_link);
	}
	return $action_links;
}

if(is_admin()){require_once('class-turboSMTP.php');}

?>