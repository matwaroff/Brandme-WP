<?php


define("SLUGMETA", 'bm_profile_slug');
define("PUBLICMETA", 'bm_public_profile');
define("BIOMETA", 'bm_bio');

function brandme_profile_page(){
	$currentuser = wp_get_current_user();
	$user_slug = (isset($_GET['u'])) ? $_GET['u'] : NULL;
	if($user_slug != null){
		$user = get_user_from_meta(SLUGMETA, $user_slug);
		if(isset($user)){
			if(get_user_meta($user->ID, 'bm_public_profile')[0] != 0){
				return brandme_profile_page_format($user);
			}else
				return "<h1>This user's profile is not public</h1>";
		}		
	}
	else {
		return brandme_profile_page_format($currentuser);
	}
}
add_shortcode('brandme_profile', 'brandme_profile_page');

function brandme_profile_edit_page(){
	$currentuser = wp_get_current_user();
	if(is_user_logged_in() && is_page('edit-profile')){
		return brandme_profile_edit_page_format($currentuser);
	}
}
add_shortcode('brandme_edit', 'brandme_profile_edit_page');

function brandme_profile_edit_page_format($user){
	$biometa = get_user_meta($user->ID, BIOMETA)[0];
	$publicmeta = get_user_meta($user->ID, PUBLICMETA)[0];
		ob_start(); ?>
		<form id="brandme_profile_edit_form" class="profile edit" name="user_profile_edit_form" action="" method="POST">
			<div id="title"><h1><?php _e($user->display_name); ?></h1><h3><?php _e('Profile Editor'); ?></h3></div>
			<div id="sidebar"></div>
			<div id="body">
				<fieldset>
					<span class="profile-text">
					<h3>Bio:</h3>
					<input type="textfield" name="brandme_bio_field" value="<?php _e($biometa); ?>"></span><br/>
					<label for="brandme_public_profile_field">Public Profile?
						<input type="checkbox" value=<?php print ($publicmeta == 1) ? "1" : "0"; ?> name="brandme_public_profile_field[]" />
					</label><br/>
					<input type="submit" name="brandme_profile_submit" value="<?php _e("Submit"); ?>"/>
				</fieldset>
			</div>
		</form>
		<?php
		return ob_get_clean();
}

function brandme_profile_page_format($user){
		ob_start(); ?>
		<form id="brandme_profile_form" class="profile" name="brandme_profile_form" action="" method="POST">
			<div id="title"><h1><?php _e($user->display_name); ?></div>
			<div id="sidebar"></div>
			<div id="body">
				<span class="profile-text">
				<h3>Bio:</h3>
				<?php _e(get_user_meta($user->ID, BIOMETA)[0]); ?></span>
			</div>
		</form>
		<?php
		return ob_get_clean();
}

function initialize_meta(){
	$users = get_users();
	foreach ($users as $user){
		$slug_meta = get_user_meta($user->ID, SLUGMETA);
		$name = strtolower($user->first_name . "-" . $user->last_name);
		update_user_meta($user->ID, SLUGMETA, $name);
		update_user_meta($user->ID, PUBLICMETA, TRUE);
		update_user_meta($user->ID, BIOMETA, "");
		continue;
		
	}
}
register_activation_hook(__FILE__, 'initialize_meta');

function brandme_profile_edit_process(){
	$currentuser = wp_get_current_user();
	if(isset($_POST['brandme_profile_submit'])){
		$bio = $_POST['brandme_bio_field'];
		$public = $_POST['brandme_public_profile_field'];	
		update_user_meta($currentuser->ID, BIOMETA, $bio);
		update_user_meta($currentuser->ID, PUBLICMETA, $public);	
	}
}
add_action('init', 'brandme_profile_edit_process');
/**
* Helper Functions
*
*/

function is_current_user($user){
	return (get_current_user_id == $user);
}
function get_user_from_meta($metakey, $metaval){
	$user = new WP_User_Query( array(
		'meta_key' => $metakey,
		'meta_value' => $metaval,
		'meta_compare' => '='
	));
	return (sizeof($user->results) !=0 && sizeof($user->results) <= 1) ? $user->results[0] : NULL;
}

