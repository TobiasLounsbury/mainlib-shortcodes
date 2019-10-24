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



add_shortcode( 'mainlib-closings', 'mainlib_closings_shortcode' );


function mainlib_closings_shortcode($attr) {

  $link = mysqli_connect(MAIN_DB_HOST, MAIN_DB_USER, MAIN_DB_PASS);
  if(!$link) {
    return "Error connecting to mysql server: ".mysqli_error();
  }
  $get_my_db=mysqli_select_db($link, MAIN_DB_NAME);

  $libquery = "SELECT * FROM mainclosings ORDER BY Library ASC;";
  $libquery = mysqli_real_escape_string($link, $libquery) or die ("Query to get data from mainclosings failed: ".mysqli_connect_error( $link ));
  $libclosings = mysqli_query( $link, $libquery );
  $output = "";
  $output .= "<table>";
  $output .= "<tr>";
  $output .= "<th>Library</th>
            <th>Reason</th>
            <th>Close Date</th>
            <th>Open Date</th>
            <th>Open Time</th>";
  $output .= "</tr>";
  while ($librow=mysqli_fetch_array($libclosings)) {
    $Library=$librow["Library"]; // <-- These vars need to match the case of the DB columns
    $Reason=$librow["Reason"];
    $CloseDate=$librow["CloseDate"];
    $OpenDate= $librow["OpenDate"];
    $OpenTime= $librow["OpenTime"];
    $phpopendate = strtotime($OpenDate);
    $mysqlopendate = date('M d, Y', $phpopendate);
    $phpclosedate = strtotime($CloseDate);
    $mysqlclosedate = date('M d, Y', $phpclosedate);
    $output .= "<tr>";
    $output .= "<td>$Library</td>
              <td>$Reason</td>
              <td>$mysqlclosedate</td>
              <td>$mysqlopendate</td>
              <td>$OpenTime</td>";
    $output .= "</tr>";
  }
  mysqli_close($link);
  return $output;
}