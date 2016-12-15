<?php


/*
   Plugin Name: BrandMe Profiles
   Description: Provides simple front end registration and login forms
   Version: 1.0
   Author: Mathew Waroff*/
define("SLUGMETA", 'bm_profile_slug');
define("PUBLICMETA", 'bm_public_profile');

function brandme_profile_page(){
	$currentuser = wp_get_current_user();
	$user_slug = (isset($_GET['u'])) ? $_GET['u'] : NULL;
	if(is_user_logged_in() && isset($_GET['edit'])){
		return brandme_profile_edit_page_format($currentuser);
	}
	if($user_slug != null){
		$user = get_user_from_meta(SLUGMETA, $user_slug);
		if(isset($user)){
			if(get_user_meta($user->ID, 'bm_public_profile')[0] != "0"){
				return brandme_profile_page_format($user);
			}else
				return "NO ACCESS";
		}		
	}
	else {
		return brandme_profile_page_format($currentuser);
	}
/*
	if($user_slug != null){
		$output = brandme_profile($user_slug);
	}else{

	}
	if($currentuser->ID == 0){ //If there is no current user
		echo "ERROR: No user by that ID";
		exit;
	}else if(is_user_logged_in()){ 
		$user = get_user_by('', get_current_user_id());
		$output = brandme_profile_edit();
	}else{
		$output = brandme_profile();
	}
	return $output;*/
}
add_shortcode('brandme_profile', 'brandme_profile_page');


function brandme_profile_edit_page_format($user){
		ob_start(); ?>
		<form id="user_profile_edit_form" class="profile" name="user_profile_edit_form" action="" method="POST">
			<div id="title"><h1><?php _e($user->display_name); ?></div>
			<div id="sidebar"></div>
			<div id="body"></div>
		</form>
		<?php
		return ob_get_clean();
}

function brandme_profile_page_format($user){
		ob_start(); ?>
		<form id="user_profile_edit_form" class="profile" name="user_profile_edit_form" action="" method="POST">
			<div id="title"><h1><?php _e($user->display_name); ?></div>
			<div id="sidebar"></div>
			<div id="body"></div>
		</form>
		<?php
		return ob_get_clean();
}

function initialize_slug(){
	$users = get_users();
	foreach ($users as $user){
		$slug_meta = get_user_meta($user->ID, SLUGMETA);
		$name = strtolower($user->first_name . "-" . $user->last_name);
		update_user_meta($user->ID, SLUGMETA, $name);
		update_user_meta($user->ID, PUBLICMETA, TRUE);
		continue;
		
	}
}
register_activation_hook(__FILE__, 'initialize_slug');


/**
* Helper Functions
*
*/
function is_current_user($user){
	return (get_current_user_id == $user);
}
function get_user_from_meta($metakey, $metaval){
	$user = new WP_User_Query( array(
		'meta_key' => SLUGMETA,
		'meta_value' => $metaval,
		'meta_compare' => '='
	));
	return (sizeof($user->results) !=0 && sizeof($user->results) <= 1) ? $user->results[0] : NULL;
}
