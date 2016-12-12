<?php

add_action('admin_menu', 'brandme_admin_menu');

function brandme_admin_menu() {
    add_menu_page('Brand Me', 'Top Level Menu', 'manage_options', 'brandme/brandme-admin-page.php', 'brandme_admin_page', 'dashicons-tickets', 6);
}

?>
