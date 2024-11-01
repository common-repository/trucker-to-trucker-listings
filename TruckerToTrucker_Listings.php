<?php
/*
Plugin Name: TruckerToTrucker Listings
Plugin URI: http://www.truckertotrucker.com
Description: Used to add your listings from TruckerToTrucker.com to your wordpress website.
slug: TruckerToTrucker_Listings
version:1.0
Author: Trucker to Trucker LLC
Author URI: http://www.truckertotrucker.com
*/
/* Copyright 2013 Trucker To Trucker 
 
    This file is part of Trucker To Trucker.

    Trucker To Trucker is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Trucker To Trucker is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Trucker To Trucker.  If not, see <http://www.gnu.org/licenses/>.
*/

register_activation_hook( __FILE__, 'install' );

function install()
{
    /**Create an instance of the database class**/
    global $wpdb;

    /**Set the custom table name with the wp prefix "wp_bor_software"**/
    $table_name = $wpdb->prefix . "TruckerToTrucker_Listings";

    /**Execute the sql statement to create or update the custom table**/
    $sql = "CREATE TABLE " . $table_name . " (
            id INT(9) NOT NULL AUTO_INCREMENT,
            api text NOT NULL,
       UNIQUE KEY id (id)
    );";

    require_once(ABSPATH.'wp-admin/includes/upgrade.php');
    dbDelta($sql); 

    /**Insert one record in the table by using the array method
    $ini_software = "Wordpress";
    $ini_developer = "Wordpress Foundation";
    $ini_type = "Blog";
    $ini_license = "GNU";

    $results = $wpdb->insert( $table_name, array( 'software' => $ini_software, 'developer' => $ini_developer, 'type' => $ini_type, 'license' => $ini_license ) );    
	*/

}
register_uninstall_hook( __FILE__, 'uninstall' );

function uninstall(){

    /**Create an instance of the database class**/
    global $wpdb;

    /**Set the custom table name with the wp prefix "wp_bor_software"**/
    $db_table_name = $wpdb->prefix . "TruckerToTrucker_Listings";

    /**Execute the sql statement to delete the custom table**/
    $sql = 'DROP TABLE IF EXISTS '.$db_table_name;
    $wpdb->query( $sql );
}

add_action('admin_menu' , 'settings_page'); 
 
function settings_page() {

	  add_options_page(
        'TruckerToTrucker Listings',   // $page_title,
        'TruckerToTrucker Listings',   // $menu_title,
        'manage_options',  // $capability,
        'TruckerToTrucker_Listings',   // $menu_slug
        'settings'       // Callback
     );
	}
	
function settings() {
 
global $wpdb;

if($_POST['api']=='') {
 
$result12 = $wpdb->get_results("SELECT * FROM wp_TruckerToTrucker_Listings ORDER BY id DESC LIMIT 1" );
 
foreach($result12 as $result123) {
 
	$api_result1=$result123->api;

	}
}
 
else {

	$api_result1=$_POST['api'];
	
	$api_result1 = str_replace(' ', '', $api_result1);
  
}
	
?>
	<h1>Settings</h1>
	<br/>
	<p>
        <h3>Insert the user's personal API key.</h3>
    </p>	

	<form action="" method="POST">
	 <p>
        <label>API Key</label><br /><br />
        <input type="text" name="api" size="40" value="<?php echo $api_result1; ?>" >
    </p>
	<p>
		<input type="submit" name="dralisa_doit" value="Submit" class="button" >
	</p>
	</form>
	
	<br />
	<p>
         Use <span style=
		"font-size:15px;font-weight:bold;">[TruckerToTrucker_Listings]</span> as shortcode. Can be added to any Page or Post.
		
		<ul>
		<li>
		To find your personal API Key, log into your TruckerToTrucker.com account and go to http://www.truckertotrucker.com/generate-api-key.cfm.
		Simply copy and paste your personal API Key into the box so that only your listings show.
		</li>
		</ul>
		<ul>
		<li>
		The permalink should be changed to Post name,
		go to Settings&rarr;Permalinks&rarr;Common Settings&rarr;Post name.
		</li>
		</ul>
    </p>
<?php 

global $wpdb;
  
  $api=$_POST['api']; 
  
  $string_api = str_replace(' ', '', $api);
  
  if($api!="") {
  
  
  $wpdb->insert( wp_TruckerToTrucker_Listings, array( 'api' => $string_api) );  
  
  }
  
}


function display_trailers()
{



?>
<style>
#ttt_detail_pic_medium td a
{
display:none!important;
}
#ttt_detail_pic_medium a:last-child
{
display:block !important;
}
#ttt_detail_pic_medium td
{
color:transparent !important;
}
#emailSeller
{
display:none!important;
}
</style>


<?php


 global $wpdb;
 
$result = $wpdb->get_results("SELECT * FROM wp_TruckerToTrucker_Listings ORDER BY id DESC LIMIT 1" );
 
foreach($result as $result1) {
 
	$api_result=$result1->api;

	}
	

$listing=$_GET['listing'];

$page=$_GET['pg'];

// create a new cURL resource
$ch = curl_init();

if(isset($listing)) {
// set URL and other appropriate options

curl_setopt($ch, CURLOPT_URL, "http://api.truckertotrucker.com/index.cfm?controller=v1.listings&action=show&key=$listing&apikey=$api_result");

}
else if(isset($page)) {
	
	curl_setopt($ch, CURLOPT_URL, "http://api.truckertotrucker.com/index.cfm?controller=v1.listings&action=index&apikey=$api_result&pg=$page");
}
else {

curl_setopt($ch, CURLOPT_URL, "http://api.truckertotrucker.com/index.cfm?controller=v1.listings&action=index&apikey=$api_result");

}

curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);

}
function add_lightbox() {
    wp_enqueue_script( 'fancybox',  plugins_url( 'lightbox/js/fancybox.js' , __FILE__ ), array( 'jquery' ), false, true );
    wp_enqueue_script( 'lightbox', plugins_url( 'lightbox/js/lightbox.js' , __FILE__ ), array( 'fancybox' ), false, true );
    wp_enqueue_style( 'lightbox-style',plugins_url( 'lightbox/css/fancybox.css' , __FILE__ ));
}
add_action( 'wp_enqueue_scripts', 'add_lightbox' );
add_shortcode('TruckerToTrucker_Listings','display_trailers');
 
?>