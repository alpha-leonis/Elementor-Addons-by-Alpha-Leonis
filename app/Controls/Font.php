<?php

namespace AlphaLeonisAddons\Controls;

class Font extends \Elementor\Control_Font {

	protected function get_default_settings() {
		$fonts = array_merge(\Elementor\Fonts::get_fonts(), ['Arial Testowy' => \Elementor\Fonts::SYSTEM]);
		return [
			'fonts' => $fonts,
		];
	}

}