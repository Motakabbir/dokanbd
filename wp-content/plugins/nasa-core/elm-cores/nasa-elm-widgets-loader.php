<?php

namespace Nasa_Core;

use Elementor\Plugin;

class Nasa_ELM_Widgets_Loader {
    /**
     * Instance of Nasa_ELM_Widgets_Loader.
     *
     * @var null
     */
    protected static $_instance = null;

    /**
     * Get instance of Widgets_Loader
     *
     * @return Widgets_Loader
     */
    public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Setup actions and filters.
     *
     */
    public function __construct() {
        // Register category.
        add_action('elementor/elements/categories_registered', array($this, 'register_widget_category'));

        // Register widgets.
        add_action('elementor/widgets/register', array($this, 'register_widgets'));
    }

    /**
     * Register Category
     *
     * @since 5.0
     * @param object $this_cat class.
     */
    public function register_widget_category($this_cat) {
        $this_cat->add_category(
            'ns-widgets',
            array(
                'title' => __('Nasa Elements', 'nasa-core'),
                'icon'  => 'eicon-font',
            )
        );
        
        $this_cat->add_category(
            'ns-header-elements',
            array(
                'title' => __('Nasa Header Elements', 'nasa-core'),
                'icon'  => 'eicon-font',
            )
        );

        return $this_cat;
    }
    
    /**
     * Register Widgets
     * 
     * Plugin::instance()->widgets_manager->register(new Nasa_Widgets\Nasa_Object_Elm());
     *
     * Register new Elementor widgets.
     * @access public
     */
    public function register_widgets() {
        // Its is now safe to include Widgets files.
        require_once NASA_CORE_PLUGIN_PATH . 'elm-cores/nasa-elm-widgets-abs.php';
        nasa_includes_files(glob(NASA_CORE_PLUGIN_PATH . 'includes/nasa_widgets/nasa_*.php'));
    }
}

/**
 * Init the class.
 */
function nasa_elm_widgets_init() {
    return Nasa_ELM_Widgets_Loader::instance();
}

nasa_elm_widgets_init();