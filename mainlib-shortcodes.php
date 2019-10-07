<?php

/**
 *
 * @package   Mainlib_shortcodes
 * @author    Tobias Lounsbury <TobiasLounsbury@gmail.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2019 Tobias Lounsbury
 *
 * @wordpress-plugin
 * Plugin Name:       MAIN Custom Shortcodes
 * Plugin URI:        https://github.com/TobiasLounsbury/mainlib-shortcodes
 * Description:       Simple Plugin to give the MAIN Library staff a jumping off point to create their own shortcodes and not use PHP Everywhere or other insecure plugins
 * Version:           1.0.0
 * Author:            Tobias Lounsbury
 * Author URI:        http://TobiasLounsbury.com
 * Text Domain:       plugin-name-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/TobiasLounsbury/mainlib-shortcodes
 */
require_once("includes/config.php");



add_shortcode( 'mainhelloworld', 'mainlib_hello_world_shortcode' );


function mainlib_hello_world_shortcode($attr) {
  return "Hello MAIN Library Network!";
}