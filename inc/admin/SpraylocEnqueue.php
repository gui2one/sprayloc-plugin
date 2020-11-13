<?php

/**
 * @package sprayloc
 */

 namespace Inc\admin;

 class SpraylocEnqueue{

    function register(){
        add_action("wp_enqueue_scripts", array($this, "enqueueClient"));
        add_action("admin_enqueue_scripts", array($this, "enqueueAdmin"));
    }

    function enqueueAdmin(){
        wp_enqueue_style( "sprayloc-plugin-css", plugin_dir_url( dirname(__FILE__ ,2)). "/css/admin-style.css", array(), 1.0, 'all' );
        wp_enqueue_script( "vuejs", plugin_dir_url( dirname(__FILE__ ,2)). "/js/libs/vue.js", array(), 1.0, false );
        wp_enqueue_script( "main_vuejs", plugin_dir_url( dirname(__FILE__ ,2)). "/js/main.js", array(), 1.0, true );
    }

    function enqueueClient(){
        wp_enqueue_style( "sprayloc-plugin-css", plugin_dir_url( dirname(__FILE__ ,2)). "/css/admin-style.css", array(), 1.0, 'all' );
    }
 }