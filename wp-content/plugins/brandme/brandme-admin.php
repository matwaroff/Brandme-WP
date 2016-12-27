<?php
add_action('admin_menu', 'brandme_admin_hook');

function brandme_admin_hook(){
	add_menu_page(
			__('BrandMe Settings'),
			__('Brandme'),
			'manage_options',
			'brandme-admin-page',
			'brandme_admin_page_callback',
			'dashicons-tickets',
			6
		     );
}
function brandme_admin_page_callback(){
	$page = '<form id="brandme_admin_form" name="brandme_admin_form" action="" method="POST">
		<fieldset>
		<h1>Profile Settings</h1>
		<label for="">Setting<input type="text"/> </label>

		</fieldset>
		</form>
		';
	echo $page;
}
?>
