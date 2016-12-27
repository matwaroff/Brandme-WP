<?php
function brandme_admin_page_callback(){
    ob_start(); ?>
        <b>Hello!</b>
    <?php
        return ob_get_clean();
}

add_action('admin_menu', 'brandme_admin_hook');

function brandme_admin_hook(){
        add_menu_page(
                __('BrandMe Settings'),
                __('Brandme'),
                'manage_options',
                'brandme/brandme-admin.php',
                'brandme_admin_page_callback',
                'dashicons-tickets',
		6
        );
}
?>
