<?php


function brandme_registration_form(){
	if(!is_user_logged_in()){
		global $brandme_registration_form;
		global $brandme_load_css;

		$brandme_load_css = true;

		$registration_enabled = get_option('users_can_register');

		if($registration_enabled){
			$output = brandme_registration_form_fields();
		}else{
			wp_redirect(home_url());
		}
		return $output;


	}else{
		wp_redirect("home");
	}
}
add_shortcode('register_form', 'brandme_registration_form');

// user login form
function brandme_login_form() {

	if(!is_user_logged_in()) {

		global $brandme_load_css;

		// set this to true so the CSS is loaded
		$brandme_load_css = true;

		$output = brandme_login_form_fields();
	} else {
		// could show some logged in user info here
		// $output = 'user info here';
	}
	return $output;
}
add_shortcode('login_form', 'brandme_login_form');

function add_brandme_autocomplete_scripts(){
	wp_enqueue_script("jquery-effects-core");
	wp_enqueue_script("jquery-ui-core");
}
add_action( 'wp_enqueue_scripts', 'add_brandme_autocomplete_scripts' );

// registration form fields
function brandme_registration_form_fields() {

	ob_start(); ?>
		<h3 class="brandme_header"><?php _e('Register'); ?></h3>

		<?php 
		// show any error messages after form submission
		brandme_show_error_messages(); ?>

		<form id="brandme_registration_form" class="brandme_form" action="" method="POST">
		<!-- progressbar -->
		<ul id="progressbar">
		<li class="active"><?php _e('Account Setup'); ?></li>
		<li><?php _e('Social Profiles'); ?></li>
		<li><?php _e('Personal Details'); ?></li>
		<li><?php _e('Favorite Color'); ?></li>
		</ul>
		<fieldset>
			<h2 class="fs-title"><?php _e('Create your account'); ?></h2>
			<h3 class="fs-subtitle"><?php _e('Step 1'); ?></h3>
			<input name="brandme_user_email" id="brandme_user_email" class="required" type="email" placeholder="<?php _e('Email'); ?>"/>
			<input name="brandme_user_pass" id="password" class="required" type="password" placeholder="<?php _e('Password'); ?>"/>
			<input name="brandme_user_pass_confirm" id="password_again" class="required" type="password" placeholder="<?php _e('Confirm Password'); ?>"/>
			<input type="button" name="next" class="next action-button" value="<?php _e('Next'); ?>"/>
		</fieldset>
		<fieldset>
			<h2 class="fs-title">What's your name?</h2>
			<h3 class="fs-subtitle">Step 2</h3>
			<input name="brandme_user_first" id="brandme_user_first" type="text" placeholder="<?php _e('First name'); ?>"/>
			<input name="brandme_user_last" id="brandme_user_last" type="text" placeholder="<?php _e('Last name'); ?>"/>
			<input type="button" name="previous" class="previous action-button" value="<?php _e('Previous'); ?>"/>
			<input type="button" name="next" class="next action-button" value="<?php _e('Next'); ?>"/>
		</fieldset>
		<fieldset class="ui-widget">
			<h2 class="fs-title">Where do you live?</h2>
			<h3 class="fs-subtitle">Step 3</h3>
			<input type="text" id="brandme_user_address" size="50" name="brandme_user_address" placeholder="<?php _e('Address'); ?>"/>
			<input type="hidden" id="brandme_street_address" name ="brandme_street_address" />
			<input type="hidden" id="brandme_zipcode" name ="brandme_zipcode" />
			<input type="hidden" id="brandme_state" name ="brandme_state" />
			<input type="hidden" id="brandme_country" name ="brandme_country" />
			<input type="button" name="previous" class="previous action-button" value="<?php _e('Previous'); ?>"/>
			<input type="button" name="next" class="next action-button" value="<?php _e('Next'); ?>"/>
		</fieldset>
		<fieldset class="color">
			<h2 class="fs-title">Favorite Color</h2>
			<h3 class="fs-subtitle">Step 4</h3>
			<input type="checkbox" value="red" class="red-box">
			<input type="button" name="previous" class="previous action-button" value="<?php _e('Previous'); ?>"/>
			<input type="submit" name="submit" class="submit action-button" value="<?php _e('Submit'); ?>"/>
		</fieldset>
		<fieldset>
			<h2 class="fs-title">Profile Picture</h2>
			<h3 class="fs-subtitle">Step 5</h3>
			<
		</fieldset>
			<input type="hidden" name="brandme_register_nonce" value="<?php echo wp_create_nonce('brandme-register-nonce'); ?>"/>
		</form>
		<!-- jQuery easing plugin -->
		<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
		<script src="<?php echo(plugin_dir_url(__FILE__) . "brandme.js"); ?>"type="text/javascript"></script>
		<?php
		return ob_get_clean();
}

// login form fields
function brandme_login_form_fields() {

	ob_start(); ?>
		<h3 class="brandme_header"><?php _e('Login'); ?></h3>

		<?php
		// show any error messages after form submission
		brandme_show_error_messages(); ?>

		<form id="brandme_login_form"  class="brandme_form"action="" method="post">
		<fieldset>
		<p>
		<label for="brandme_user_login">Username</label>
		<input name="brandme_user_login" id="brandme_user_login" class="required" type="text"/>
		</p>
		<p>
		<label for="brandme_user_pass">Password</label>
		<input name="brandme_user_pass" id="brandme_user_pass" class="required" type="password"/>
		</p>
		<p>
		<input type="hidden" name="brandme_login_nonce" value="<?php echo wp_create_nonce('brandme-login-nonce'); ?>"/>
		<input id="brandme_login_submit" type="submit" value="Login"/>
		</p>
		</fieldset>
		</form>
		<?php
		return ob_get_clean();
}


// logs a member in after submitting a form
function brandme_login_member() {

	if(isset($_POST['brandme_user_login']) && wp_verify_nonce($_POST['brandme_login_nonce'], 'brandme-login-nonce')) {

		// this returns the user ID and other info from the user name
		$user = get_userdatabylogin($_POST['brandme_user_login']);

		if(!$user) {
			// if the user name doesn't exist
			brandme_errors()->add('empty_username', __('Invalid username'));
		}

		if(!isset($_POST['brandme_user_pass']) || $_POST['brandme_user_pass'] == '') {
			// if no password was entered
			brandme_errors()->add('empty_password', __('Please enter a password'));
		}

		// check the user's login with their password
		if(!wp_check_password($_POST['brandme_user_pass'], $user->user_pass, $user->ID)) {
			// if the password is incorrect for the specified user
			brandme_errors()->add('empty_password', __('Incorrect password'));
		}

		// retrieve all error messages
		$errors = brandme_errors()->get_error_messages();

		// only log the user in if there are no errors
		if(empty($errors)) {

			wp_setcookie($_POST['brandme_user_login'], $_POST['brandme_user_pass'], true);
			wp_set_current_user($user->ID, $_POST['brandme_user_login']);	
			do_action('wp_login', $_POST['brandme_user_login']);

			wp_redirect(home_url()); exit;
		}
	}
}
add_action('init', 'brandme_login_member');

//REGISTER a new user
function brandme_add_new_member(){
	if(isset( $_POST['brandme_user_email']) && wp_verify_nonce($_POST['brandme_register_nonce'], 'brandme-register-nonce')){
		$user_email = $_POST['brandme_user_email'];
		$user_first = $_POST['brandme_user_first'];
		$user_last = $_POST['brandme_user_last'];
		$user_pass = $_POST['brandme_user_pass'];
		$pass_confirm = $_POST['brandme_user_pass_confirm'];
		$user_login = $user_first . " " . $user_last;
		$user_color = $_POST['brandme_fav_color'];
		if(username_exists($user_login)){
			brandme_errors()->add('username_unavailable',  __('Email already in use'));
		}
		if(!validate_username($user_login)){
			brandme_errors()->add('username_invalid',  __('Invalid email'));
		}
		if($user_email == '') {
			// empty username
			brandme_errors()->add('username_empty', __('Please enter an email'));
		}
		if(!is_email($user_email)) {
			//invalid email
			brandme_errors()->add('email_invalid', __('Invalid email'));
		}
		if(email_exists($user_email)) {
			//Email address already registered
			brandme_errors()->add('email_used', __('Email already registered'));
		}
		if($user_pass == '') {
			// passwords do not match
			brandme_errors()->add('password_empty', __('Please enter a password'));
		}
		if($user_pass != $pass_confirm) {
			// passwords do not match
			brandme_errors()->add('password_mismatch', __('Passwords do not match'));
		}

		$errors = brandme_errors()->get_error_messages();
		if(empty($errors)){
			$new_user_id = wp_insert_user(array(
						'user_login' => $user_login,
						'user_pass' => $user_pass,
						'user_email' => $user_email,
						'first_name' => $user_first,
						'last_name' => $user_last,
						'user_registered' => date('Y-m-d H:i:s'),
						'role' => 'subscriber'
						));
			if($new_user_id){
				wp_new_user_notification($new_user_id);
				wp_setcookie($user_login, $user_pass, true);
				wp_set_current_user($new_user_id, $user_login);
				update_user_meta(get_current_user_id(), 'bm_field_favcolor', $user_color);
				if(isset($_FILES['file']['type'])){
					brandme_upload_profile_picture($_FILES['file']['tmp_name'], get_current_user_id());
				}
				do_action('wp_login', $user_login);	
				wp_redirect(home_url()); exit;
			}
		}
	}
	$currentuser = wp_get_current_user();

	//printf("Username: %s : %d<br />Color: ", $currentuser->user_login, get_current_user_id());
	//print_r(get_user_meta(get_current_user_id(), 'bm_field_favcolor')[0]);
}
add_action('init', 'brandme_add_new_member');

function brandme_upload_profile_picture(){
	$sourcePath = $_FILES['file']['tmp_name'];       // Storing source path of the file in a variable
	$targetPath = "upload/".$_FILES['file']['name']; // Target path where file is to be stored
	move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file
}
function brandme_errors(){
	static $wp_error;
	return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}
// displays error messages from form submissions
function brandme_show_error_messages() {
	if($codes = brandme_errors()->get_error_codes()) {
		echo '<div class="brandme_errors">';
		// Loop error codes and display errors
		foreach($codes as $code){
			$message = brandme_errors()->get_error_message($code);
			echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
		}
		echo '</div>';
	}	
}

function brandme_register_css(){
	wp_register_style('brandme-form-css', plugin_dir_url(__FILE__) . 'css/forms.css');
	wp_register_style('jquery-ui-style', 'http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
}
add_action('init', 'brandme_register_css');

function brandme_print_css(){
	global $brandme_load_css;

	if(!$brandme_load_css)
		return;

	wp_print_styles('brandme-form-css');
}
add_action('wp_footer', 'brandme_print_css');
