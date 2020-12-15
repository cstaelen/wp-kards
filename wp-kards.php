<?php
/*
Plugin Name: WP Kards
Plugin URI: https://www.kards.fr/
Description: This plugin provide the ability to display Kards menu widget on wordpress websites.
Version: 1.0
Author: Clément Staelen
Author URI: https://cl-st.me
License: Help yourselves to the shelves
*/

// REGISTER WP OPTIONS SETTINGS

if (!function_exists("update_extra_post_info")) {
    function update_extra_post_info()
    {
        register_setting('wp-kards-settings', 'wp_kards_id');
    }
}

add_action('admin_init', 'update_extra_post_info');

// ADMIN PAGE MENU

function wp_kards_add_page_menu()
{
    add_menu_page('WP Kards', 'WP Kards', 'manage_options', 'dashicons-food', 'wp_kards_display_form');
}

add_action('admin_menu', 'wp_kards_add_page_menu');

// KARDS JS ASSET

function wp_kard_add_js()
{
    wp_register_script('wp-kards-js', '', [], '', true);
    wp_enqueue_script('add-bx-js');
}

add_action('wp_enqueue_scripts', 'wp_kard_add_js');

// KARDS WIDGET OUTPUT

function wp_kard_add_widget()
{
    echo "<markup-widget>After the footer is loaded, my text is added!</markup-widget>";
}

add_action("wp_footer", "wp_kard_add_widget");

// ADMIN FORM

function wp_kards_display_form()
{
?>
    <h1>Wordpress Kards Menu</h1>
    <form method="post" action="options.php">
        <?php settings_fields('wp-kards-settings'); ?>
        <?php do_settings_sections('wp-kards-settings'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">ID du menu Kards à afficher :</th>
                <td><input type="text" name="wp_kards_id" value="<?php echo get_option('wp_kards_id'); ?>" /></td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
<?php
}
