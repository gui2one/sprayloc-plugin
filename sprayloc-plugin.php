<?php

/**
 * Plugin Name: Sprayloc Plugin
 * Author: gui2one
 * Text Domain: sprayloc-plugin
 * @package sprayloc
 */

require_once( plugin_dir_path( __FILE__ ) . "vendor/autoload.php");

use Inc\admin\SpraylocPluginAdmin;
use Inc\admin\SpraylocEnqueue;



function sprayloc_activate_plugin(){
    

    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'sprayloc_activate_plugin' );


function sprayloc_deactivate_plugin(){
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'sprayloc_deactivate_plugin' );


function addItemToTaxonomy($taxonomy, $name, $slug){
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
    addItemToTaxonomy('materiel_cat', 'Non Classé', 'non-classe' );
    addItemToTaxonomy('materiel_cat', 'Caméra'    , 'camera'     );
    addItemToTaxonomy('materiel_cat', 'Lumière'   , 'lumiere'    );
    addItemToTaxonomy('materiel_cat', 'Streaming' , 'streaming'  );
    addItemToTaxonomy('materiel_cat', 'Cable'     , 'cable'      );

}

add_action("init", 'register_custom_post_type', 10);

// $admin = new Admin();
// $admin->register();

$admin = new SpraylocPluginAdmin();
$enqueue = new SpraylocEnqueue();
$enqueue->register();

function sprayloc_shortcode(){
    $sprayloc_plugin_admin_options = get_option( 'sprayloc_plugin_admin_option_name' ); // Array of All Options
    $json_data_0 = $sprayloc_plugin_admin_options['json_data_0']; // json data
    $json = json_decode($json_data_0);

    $str = '';
    $str .= "<div class='product-card-container'>";
    foreach($json as $item){

        $image = $item->{'image'};
        $display_name = $item->{'displayname'};
        $image_alt = __('product image', 'sprayloc-plugin');
        $external_remark = $item->{'external_remark'};

        $str .= "<div class='product-card'>";
        $str .= "<h1>$display_name</h1>";
        if($external_remark != '')
            $str .= "<div class='desc block-ellipsis'>$external_remark</div>";
        
            $str .= "<img src='$image' alt='$image_alt'>";
        $str .= "</div>";
    }

    $str .= "</div>";

    return $str;
}

add_shortcode( 'sprayloc_equipments', 'sprayloc_shortcode' );

function vue_app_short_code(){
    // $str = '';

    $str = get_template_part('../../plugins/sprayloc-plugin/components/VueApp' );
    // $str ='<div id="vue_app"><h1>{{message}}</h1></div>';

    // var_dump($str);
    return $str ;
}


add_shortcode( 'sprayloc_vue_app', 'vue_app_short_code' );