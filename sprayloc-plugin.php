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


function addItemToTaxonomy($name, $slug, $taxonomy){
    $cat_exists = term_exists( $slug, $taxonomy );

    if( !$cat_exists){

        wp_insert_term( 
            $name, 
            $taxonomy, 
            array(
                'description' => 'added by plugin script',
                'slug' => $slug
            ) 
        );
    }
}

function register_custom_post_type(){

    $labels = array(
        'name'                      => 'Types de Materiel',
        'singular_name'             => 'Type de Materiel',
        'all_items'                 =>  'All Categories',
        'edit_item'                 =>  'Edit Category',
        'view_item'                 =>  'View Category',
        'update_item'               =>  'Update Category',
        'add_new_item'              =>  __('Ajouter un nouveau type'),
        'new_item_name'             =>  'Category Name',
        'parent_item'               =>  __('Type Parent'),
        'parent_item_colon'         =>  'Parent Category:',
        'search_items'              =>  'Search Gallery Categories',
        'popular_items'             =>  'Popular Categories',
    );

    register_taxonomy( 
        'materiel_cat', 
        'materiel', 
        array(
            'labels' => $labels,
            'show_ui' => true,
            // 'show_tagcloud' => false,
            'hierarchical' => true,
            'show_in_rest' => true
        ) 
    );

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
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
            'show_in_rest' => true,
            'taxonomies' => array( 'post_tag' ,'materiel_cat')
            
        ) 
    );
    
    // insert default materiel types
    addItemToTaxonomy('Non Classé', 'non-classe', 'materiel_cat');
    addItemToTaxonomy('Caméra', 'camera', 'materiel_cat');
    addItemToTaxonomy('Lumière', 'lumiere', 'materiel_cat');
    addItemToTaxonomy('Streaming', 'streaming', 'materiel_cat');
    addItemToTaxonomy('Cable', 'cable', 'materiel_cat');

}

add_action("init", 'register_custom_post_type', 10);