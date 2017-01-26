<?php
/*
Plugin Name: Gravity Forms Review Add-On
Plugin URI: http://www.gravityforms.com
Description: A Gravity Forms Add-On to allow Admins to collect reviews and easily share them on their site
Version: 0.1
Author: Bret Wagner
Author URI:

------------------------------------------------------------------------
*/
/**
 * @author Bret Wagner <bretwagner@bwagner-webdev.com>
 * @copyright 2017 Free to copy and utilize as you see fit, just give credit if you like the plugin.
 *
 * Created to give site admins an easy way to create forms to collect reviews of their restaurant, hotel, or business.
 * I wanted to create something that allowed me to easily take the reviews and post them on the site without a hassle.
 *
 */

define( 'GF_REVIEWS_VERSION', '0.1' );

add_action( 'gform_loaded', array( 'GF_Reviews_Bootstrap', 'load' ), 5 );
include(dirname(__FILE__) . "/functions.php");
class GF_Reviews_Bootstrap {

    public static function load() {

        if ( ! method_exists( 'GFForms', 'include_addon_framework' ) ) {
            return;
        }

        require_once( 'class-gfreviews.php' );

        GFAddOn::register( 'GFReviews' );
    }

}

function gf_simple_addon() {
    return GFSimpleAddOn::get_instance();
}
