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
// include(dirname(__FILE__) . "/functions.php");
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

/**
 * Get available fields and return as an array of options
 * @param  object $form     gavity forms object
 * @return array            field choice options
 */
function get_field_choices($form) {
    foreach ($form['fields'] as $field) {
        $field_title = $field['label'];
        $choice = array(
                        'label' => $field_title,
                        'value' => $field_title,
                        );
        $choices[] = $choice;
    }
    return $choices;
}

/**
 * built mainly for debugging purposes to make sure things are working
 * @param  string $message what would you like the message to say
 * @param  string $subject Subject line of the email
 */
function mail_dev($message, $subject) {
    $admin = "bwagner@drivestl.com";
    $headers = "From: Test App <test@drivestl.com>";
    $message = wordwrap( $message, 70 );
    mail($admin, $subject, $message, $headers);
}

/**
 * see if form is selected as a review collection form
 * @param  array $entry entry data from the form submitted
 * @param  array $form  form which was submitted
 */
function check_enabled($entry, $form) {
    $id = $form['id'];
    $form_meta = GFAPI::get_form($id);
    $settings = $form_meta['gravity-reviews'];

    if ($settings['enabled']=='1') {
        if ($settings['admin-alert']=='1') {
            mail_dev(print_r($entry, true), "Mail Admin Enabled");
        }
        mail_dev(print_r($entry, true), "This is a Review");
        submit_review($entry, $form);
    } else {
        mail_dev(print_r($form_meta, true), "Failed result");
    }
}

/**
 * What to do with a submission when complete
 * @param  array $entry data from the form
 * @param  array $form  form which was submitted
 */
function submit_review($entry, $form) {
    // This will be fired later
}
