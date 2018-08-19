<?php
/**
 * Plugin Name: Alpha Leonis Addons
 * Description: Set of widgets to enchance Elementor functionality. Plugin Elementor for Wordpress is necessary to function.
 * Author: Alpha Leonis
 * Author URI: http://alphaleonis.pl
 * Version: 1.0.10
 * Text Domain: al-el-addons
 * Domain Path: languages.
 */

if (!defined('ABSPATH'))
    exit;

if (!defined('ALA_VERSION'))
    define('ALA_VERSION', '1.0.10');

require_once('vendor/autoload.php');
require_once('helper-functions.php');

if (!class_exists('AlphaLeonisAddons')) :

    /**
     * Main plugin class
     */
    final class AlphaLeonisAddons
    {

        /**
         * Plugin instance
         * @var AlphaLeonisAddons
         */
        private static $instance;

        /**
         * @return AlphaLeonisAddons
         */
        public static function instance()
        {
            if (!isset(self::$instance) && !(self::$instance instanceof AlphaLeonisAddons)) {
                self::$instance = new AlphaLeonisAddons;
                self::$instance->setupHooks();
            }

            return self::$instance;
        }

        /**
         * Setup hooks
         */
        private function setupHooks()
        {
            add_action('elementor/widgets/widgets_registered', array(self::$instance, 'includeWidgets'));
            add_action('elementor/frontend/after_register_styles', array($this, 'registerStyles'), 10);
            add_action('elementor/frontend/after_enqueue_styles', array($this, 'enqueueStyles'), 10);
            add_action('elementor/frontend/after_register_scripts', array($this, 'registerScripts'), 10);
            add_action('elementor/init', array($this, 'addElementorCategory'));
        }

        /**
         * Include elementor widgets
         * 
         * @param  $widgets_manager
         */
        public function includeWidgets($widgets_manager)
        {
            $widgets_manager->register_widget_type(new \AlphaLeonisAddons\Widgets\FacebookFeed());
            $widgets_manager->register_widget_type(new \AlphaLeonisAddons\Widgets\InstagramFeed());
            $widgets_manager->register_widget_type(new \AlphaLeonisAddons\Widgets\HoverItem());
        }

        /**
         * Register plugin styles
         */
        public function registerStyles()
        {
            wp_register_style('ala-styles', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), ALA_VERSION);
        }

        /**
         * Enqueue styles
         */
        public function enqueueStyles()
        {
            wp_enqueue_style('ala-styles');
        }

        /**
         * Register plugin scripts
         */
        public function registerScripts()
        {
            wp_register_script('sketch-js', plugin_dir_url(__FILE__) . 'assets/js/lib/sketch.min.js', array(), ALA_VERSION, true);
            wp_register_script('ala-hover-item', plugin_dir_url(__FILE__) . 'assets/js/hover-item.js', array(), ALA_VERSION, true);
        }

        /**
         * Add elementor category
         */
        public function addElementorCategory() {
            \Elementor\Plugin::instance()->elements_manager->add_category(
                'alphaleonis-addons',
                array(
                    'title' => __('Alpha Leonis Addons', 'al-el-addons'),
                    'icon' => 'fa fa-plug',
                ),
            2);
        }

    }

endif;

AlphaLeonisAddons::instance();