<?php

class PFL_ajax_functions {

    public function __construct() {

        add_action( 'wp_ajax_post_from_link',       array($this,'post_from_link'));
        add_action( 'wp_ajax_save_post_from_link',  array($this,'save_post_from_link'));

    }

    public function post_from_link() {

        require_once( PFL_PATH . 'api/post-from-link-api.php');

        wp_die(); // this is required to terminate immediately and return a proper response

    }

    public function save_post_from_link() {

        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        global $wpdb; // this is how you get access to the database

        $pfl = array(
            'post_title'    => wp_strip_all_tags( $_POST['pfl-data']['title'] ),
            'post_content'  => $_POST['pfl-data']['description'],
            'post_status'   => 'draft',
            'tax_input' => array( 'category' => $_POST['pfl-data']['category'] ),
        );

        $post = wp_insert_post( $pfl );

        if ( $post && ! is_wp_error( $result )) { // if post is submitted

            $image_url = media_sideload_image( $_POST['pfl-data']['image'], $post );

            wp_update_post( array(
                'ID'            => $post,
                'post_status'   => 'publish'
            ) );

            $strpos1 = strrpos($image_url, "src='");
            $strpos1 += 5;
            $string1 = substr($image_url, $strpos1);


            $strpos2 = strrpos($string1,"alt", $strpos1);

            $image_in_library_url = substr($string1, 0, $strpos2 - 2);

            $attachment_id = attachment_url_to_postid( $image_in_library_url );

            set_post_thumbnail( $post, $attachment_id );
            echo 'Featured image added';

            add_post_meta( $post, '_links_to', $_POST['pfl-data']['url'], true );

        }

        wp_die(); // this is required to terminate immediately and return a proper response
    }

}