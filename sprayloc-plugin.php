<?php

/**
 * Plugin Name: Sprayloc Plugin
 * Author: gui2one
 * Text Domain: sprayloc-plugin
 */

require_once( plugin_dir_path( __FILE__ ) . "vendor/autoload.php");

use Inc\base\testClass;




function sprayloc_activate_plugin(){
    // $test_class = new testClass();
}
register_activation_hook( __FILE__, 'sprayloc_activate_plugin' );


function sprayloc_deactivate_plugin(){
    
}
register_deactivation_hook( __FILE__, 'sprayloc_deactivate_plugin' );


function register_custom_post_type(){

    $labels = array(
        'name'                  => _x( 'Materiels', 'Post type general name', 'sprayloc-plugin' ),
        'singular_name'         => _x( 'Materiel', 'Post type singular name', 'sprayloc-plugin' ),
        'menu_name'             => _x( 'Materiels', 'Admin Menu text', 'sprayloc-plugin' ),
    );
    register_post_type( 
        'materiel', 
        array(
            'labels' => $labels,
            'public' => true,
            'capability_type' => 'post',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'categories' ),
            'show_in_rest' => true,
            'taxonomies'          => array( 'category' )
            
        ) 
    );
}

add_action("init", 'register_custom_post_type');