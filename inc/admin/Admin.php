<?php

/**
 * @package sprayloc
 */

 namespace Inc\admin;

 class Admin{


    function register(){
        add_action("admin_menu", array( $this, 'createAdminUI'));

        // echo 'sdf';
    }

    function createAdminUI(){
        add_menu_page( 
            'sprayloc-plugin-ui', 
            'Sprayloc UI', 
            'manage_options', 
            'my_custom_menu_ui', 
            array( $this, 'renderUI'), 
            'dashicons-welcome-widgets-menus', 
            1000 );
    }

    function renderUI(){
        echo "<h1>Admin UI</h1>";
    }
 }
