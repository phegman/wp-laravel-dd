<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://peterhegman.com/
 * @since             1.0.0
 * @package           Wp_Laravel_Dd
 *
 * @wordpress-plugin
 * Plugin Name:       Laravel DD for Wordpress
 * Plugin URI:
 * Description:       Use Laravel's dd() (die dump) function in your Wordpress projects
 * Version:           1.0.1
 * Author:            Peter Hegman
 * Author URI:        https://peterhegman.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-laravel-dd
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Autoload Composer packages
require __DIR__ . '/vendor/autoload.php';

// If we haven't loaded this plugin from Composer we need to add our own autoloader
if (!class_exists('PeterHegman\Dumper')) {
    // Get a reference to our PSR-4 Autoloader function that we can use to add our
    $autoloader = require_once('autoload.php');

    // Use the autoload function to setup our class mapping
    $autoloader('PeterHegman\\', __DIR__ . '/src/PeterHegman/');
}

/**
* Disable Wordpress emoji's as they mess with the var-dumper
*/
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(function ($x) {
            (new PeterHegman\Dumper)->dump($x);
        }, func_get_args());

        die(1);
    }
}
