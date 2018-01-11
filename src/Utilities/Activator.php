<?php

namespace Objectiv\BoosterSeat\Utilities;

use Objectiv\BoosterSeat\Managers\PathManager;

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link objectiv.co
 * @since 1.0.0
 * @package Objectiv\Plugins\Checkout\Utilities
 * @author Brandon Tassone <brandontassone@gmail.com>
 */

class Activator {

	/**
	 * Method to be run on plugin activation.
	 *
	 * Place the plugin dependncy checks in relevantly named functions
	 *
	 * @since 1.0.0
	 * @access public
	 * @param $plugins
	 * @return boolean
	 */
	public static function activate($plugins) {

		foreach($plugins as $plugin_file_location => $plugin_error_info) {
			$plugin_activation_errors = array();

			$notice_name = $plugin_error_info[0];
			$error_info = $plugin_error_info[1];

			if( !is_plugin_active($plugin_file_location) ) {
				$plugin_activation_errors[] = $error_info;
			}

			if( ! empty($plugin_activation_errors) ) {
				add_option($notice_name, $plugins);
			}
		}

		return empty($plugins);
	}

	/**
	 * Method to be run on unsuccessful plugin activation. The function that generates the error admin notice for plugin
	 * activation
	 *
	 * @since 1.0.0
	 * @access public
	 * @param PathManager $path_manager
	 * @param string $notice_name
	 * @param string $text_domain
	 */
	public static function activate_admin_notice($path_manager, $notice_name, $text_domain = "") {

		$activation_error = get_option($notice_name);

		if(!empty($activation_error)) {

			// Get rid of "Plugin Activated" message on error.
			unset($_GET["activate"]);

			foreach($activation_error as $error) {
				if(!$error["success"]) {
					// Print the error notice
					printf("<div class='%s'><p>%s</p></div>", $error["class"], __($error["message"], $text_domain));
				}
			}

			// Remove the option after all error messages displayed
			delete_option($notice_name);

			// Deactivate the plugin
			deactivate_plugins($path_manager->get_path_main_file());
		}
	}
}