<?php

namespace AlphaLeonisAddons\Helpers;

/**
* Configuration helper
*/
class Configuration
{
	public static function get($option_name, $default = null) {

		$settings = get_option('ala_settings');

		if (!empty($settings) && isset($settings[$option_name]))
			$option_value = $settings[$option_name];
		else
			$option_value = $default;

		return $option_value;
	}

	public static function update($option_name, $option_value) {

		$settings = get_option('ala_settings');

		if (empty($settings))
			$settings = array();

		$settings[$option_name] = $option_value;

		update_option('ala_settings', $settings);
	}
}