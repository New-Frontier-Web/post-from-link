<?php

class PFL_enqueue {

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_css_js'));
    }

    public function enqueue_css_js() {
        wp_register_style('pfl-styles', PFL_URL . 'assets/css/styles.css');
        wp_enqueue_style('pfl-styles');
        wp_enqueue_script( 'pfl-script', PFL_URL . 'assets/scripts/index.js' );
        add_filter( 'script_loader_tag', array($this, 'add_type_to_script'), 10, 3 );
        wp_enqueue_media();
    }

    public function add_type_to_script( $tag, $handle, $src ) { // Custom function to make the Index JS file type module

        if ( 'pfl-script' === $handle ) {
            $tag = '<script src="' . esc_url( $src ) . '" type="module"></script>';
        }

        return $tag;
    }

    public function plugin_row_meta( $plugin_meta, $plugin_file ) {

        // I am muting this function for now - just keeping it so I don't have to figure out how to do this
        // in the future

        if ( PFL_PLUGIN_BASE === $plugin_file ) {
            $row_meta = [
                'docs' => '<a href="https://go.elementor.com/docs-admin-plugins/" aria-label="' . esc_attr( esc_html__( 'View Elementor Documentation', 'elementor' ) ) . '" target="_blank">' . esc_html__( 'Docs & FAQs', 'elementor' ) . '</a>',
                'ideo' => '<a href="https://go.elementor.com/yt-admin-plugins/" aria-label="' . esc_attr( esc_html__( 'View Elementor Video Tutorials', 'elementor' ) ) . '" target="_blank">' . esc_html__( 'Video Tutorials', 'elementor' ) . '</a>',
            ];

            $plugin_meta = array_merge( $plugin_meta, $row_meta );
        }

        return $plugin_meta;
    }

}

class PFL_create_menus {

    public function __construct() {
        add_action( 'admin_menu', array($this, 'create_menus'));
    }

    public function create_menus() {

        //create new top-level menu
        add_menu_page(
            'Post From Link', // Page Title
            'Post From Link', // Menu Title
            'administrator', // Capability
            PFL_PATH, // Menu Slug
            'post_from_link_page', // Function
            // PFL_URL . 'assets/images/icon.png', // Icon URL
//            'post_from_link_settings_page' // Position
        );

//        add_submenu_page(
//            __FILE__, // Parent Slug
//            'Post From Link Settings', // Page Title
//            'Settings', // Menu Title
//            'manage_options', // Capability
//            'post-from-link-settings', // Menu Slug
//            'post_from_link_settings_page', // Function
//            '' // Position
//        );

    }

}