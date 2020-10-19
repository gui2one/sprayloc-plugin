<?php

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

namespace Inc\admin;

class SpraylocPluginAdmin {
	private $sprayloc_plugin_admin_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'sprayloc_plugin_admin_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'sprayloc_plugin_admin_page_init' ) );
	}

	public function sprayloc_plugin_admin_add_plugin_page() {
		add_menu_page(
			'Sprayloc Options', // page_title
			'Sprayloc Options', // menu_title
			'manage_options', // capability
			'sprayloc-plugin-admin', // menu_slug
			array( $this, 'sprayloc_plugin_admin_create_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			3 // position
		);
	}

	public function sprayloc_plugin_admin_create_admin_page() {
		$this->sprayloc_plugin_admin_options = get_option( 'sprayloc_plugin_admin_option_name' ); ?>

		<div class="wrap">
			<h2>Sprayloc Options</h2>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'sprayloc_plugin_admin_option_group' );
					do_settings_sections( 'sprayloc-plugin-admin-admin' );
                    submit_button();
                    $this->makePreview();
				?>
			</form>
		</div>
	<?php }

	public function sprayloc_plugin_admin_page_init() {
		register_setting(
			'sprayloc_plugin_admin_option_group', // option_group
			'sprayloc_plugin_admin_option_name', // option_name
			array( $this, 'sprayloc_plugin_admin_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'sprayloc_plugin_admin_setting_section', // id
			'Settings', // title
			array( $this, 'sprayloc_plugin_admin_section_info' ), // callback
			'sprayloc-plugin-admin-admin' // page
		);

		add_settings_field(
			'json_data_0', // id
			'json data', // title
			array( $this, 'json_data_0_callback' ), // callback
			'sprayloc-plugin-admin-admin', // page
			'sprayloc_plugin_admin_setting_section' // section
		);
	}

	public function sprayloc_plugin_admin_sanitize($input) {
		// $sanitary_values = array();
		// if ( isset( $input['json_data_0'] ) ) {
		// 	$sanitary_values['json_data_0'] = esc_textarea( $input['json_data_0'] );
		// }

		return $input;
	}

	public function sprayloc_plugin_admin_section_info() {
		
	}

	public function json_data_0_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="sprayloc_plugin_admin_option_name[json_data_0]" id="json_data_0">%s</textarea>',
			isset( $this->sprayloc_plugin_admin_options['json_data_0'] ) ? esc_attr( $this->sprayloc_plugin_admin_options['json_data_0']) : ''
		);
    }
    

    public function makePreview(){ 
        $sprayloc_plugin_admin_options = get_option( 'sprayloc_plugin_admin_option_name' ); // Array of All Options
        $json_data_0 = $sprayloc_plugin_admin_options['json_data_0']; // json data
        $json = json_decode($json_data_0);
        var_dump($json);
        ?>
        
        


        
        
    <?php }

}
// if ( is_admin() )
// 	$sprayloc_plugin_admin = new SpraylocPluginAdmin();

/* 
 * Retrieve this value with:
 * $sprayloc_plugin_admin_options = get_option( 'sprayloc_plugin_admin_option_name' ); // Array of All Options
 * $json_data_0 = $sprayloc_plugin_admin_options['json_data_0']; // json data
 */
