<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * abstract Nasa Elementor Widget
 *
 * @version  4.0
 * @extends  WP_Widget
 */

abstract class Nasa_Elementor_Widget extends WP_Widget {

    /**
     * CSS class.
     *
     * @var string
     */
    public $widget_cssclass;

    /**
     * Widget description.
     *
     * @var string
     */
    public $widget_description;

    /**
     * Widget ID.
     *
     * @var string
     */
    public $widget_id;

    /**
     * Widget name.
     *
     * @var string
     */
    public $widget_name;

    /**
     * Settings.
     *
     * @var array
     */
    public $settings;

    /**
     * short code.
     *
     * @var text
     */
    public $shortcode;

    /**
     * Constructor.
     */
    public function __construct() {
        $widget_ops = array(
            'classname' => $this->widget_cssclass,
            'description' => $this->widget_description,
            'customize_selective_refresh' => true,
        );

        parent::__construct($this->widget_id, $this->widget_name, $widget_ops);
    }

    /**
     * Get this widgets title.
     *
     * @param array $instance Array of instance options.
     * @return string
     */
    protected function get_instance_title($instance) {
        if (isset($instance['title_widget'])) {
            return $instance['title_widget'];
        }

        if (isset($this->settings, $this->settings['title_widget'], $this->settings['title_widget']['std'])) {
            return $this->settings['title_widget']['std'];
        }

        return '';
    }

    /**
     * Output the html at the start of a widget.
     *
     * @param array $args Arguments.
     * @param array $instance Instance.
     */
    public function widget_start($args, $instance) {
        return;
    }

    /**
     * Output the html at the end of a widget.
     *
     * @param  array $args Arguments.
     */
    public function widget_end($args) {
        return;
    }

    /**
     * Updates a particular instance of a widget.
     *
     * @see    WP_Widget->update
     * @param  array $new_instance New instance.
     * @param  array $old_instance Old instance.
     * @return array
     */
    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        if (empty($this->settings)) {
            return $instance;
        }

        // Loop settings and get values to save.
        foreach ($this->settings as $key => $setting) {
            if (!isset($setting['type'])) {
                continue;
            }
            
            $setting['std'] = isset($setting['std']) ? $setting['std'] : '';

            // Format the value based on settings type.
            switch ($setting['type']) {
                case 'textarea':
                    $instance[$key] = isset($new_instance[$key]) ? wp_kses(trim(wp_unslash($new_instance[$key])), wp_kses_allowed_html('post')) : $setting['std'];
                    break;
                
                case 'textarea_html':
                    $instance[$key] = isset($new_instance[$key]) ? trim(wp_unslash($new_instance[$key])) : $setting['std'];
                    break;

                case 'checkbox':
                    $instance[$key] = empty($new_instance[$key]) ? 0 : 1;
                    break;

                default:
                    $instance[$key] = isset($new_instance[$key]) ? sanitize_text_field($new_instance[$key]) : $setting['std'];
                    break;
            }

            /**
             * Sanitize the value of a setting.
             */
            $instance[$key] = apply_filters('nasa_widget_settings_sanitize_option', $instance[$key], $new_instance, $key, $setting);
        }

        return $instance;
    }

    /**
     * Outputs the settings update form.
     *
     * @see   WP_Widget->form
     *
     * @param array $instance Instance.
     */
    public function form($instance) {

        if (empty($this->settings)) {
            return;
        }

        foreach ($this->settings as $key => $setting) {
            if (!isset($setting['std'])) {
                $setting['std'] = '';
            }

            $setting['label'] = isset($setting['label']) ? $setting['label'] : '';

            $class = isset($setting['class']) ? $setting['class'] : '';
            $value = isset($instance[$key]) ? $instance[$key] : $setting['std'];
            $data_id = $this->get_field_id($key);
            $data_name = $this->get_field_name($key);

            switch ($setting['type']) {

                /**
                 * Text
                 */
                case 'text':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>"><?php echo wp_kses_post($setting['label']); ?></label>
                        <input class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
                    </p>
                    <?php
                    break;

                /**
                 * Select Dropdown
                 */
                case 'select':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>"><?php echo wp_kses_post($setting['label']); ?></label>
                        <select class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>">
                            <?php foreach ($setting['options'] as $option_key => $option_value) : ?>
                                <option value="<?php echo esc_attr($option_key); ?>" <?php selected($option_key, $value); ?>><?php echo esc_html($option_value); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <?php
                    break;

                /**
                 * Textarea
                 */
                case 'textarea':
                case 'textarea_html':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>"><?php echo wp_kses_post($setting['label']); ?></label>
                        <textarea class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" cols="20" rows="5"><?php echo esc_textarea($value); ?></textarea>
                        <?php if (isset($setting['desc'])) : ?>
                            <small><?php echo esc_html($setting['desc']); ?></small>
                        <?php endif; ?>
                    </p>
                    <?php
                    break;

                /**
                 * Checkbox
                 */
                case 'checkbox':
                    ?>
                    <p>
                        <input class="checkbox <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" type="checkbox" value="1" <?php checked($value, 1); ?> />
                        <label for="<?php echo esc_attr($data_id); ?>"><?php echo wp_kses_post($setting['label']); ?></label>
                    </p>
                    <?php
                    break;

                /**
                 * Set image field
                 */
                case 'attach_image':
                    $class_wrap = 'nasa-wrap-attach-img admin-text-center';

                    $image_src = false;
                    if ($value) :
                        $image = wp_get_attachment_image_src($value, 'thumbnail', false);
                        $image_src = isset($image[0]) ? esc_url($image[0]) : false;
                    endif;

                    if (!$image_src) :
                        $image_src = nasa_no_image(true);
                        $class_wrap .= ' nasa-wrap-no-img';
                    endif;
                    ?>

                    <div class="<?php echo esc_attr($class_wrap); ?>" id="wrap_<?php echo esc_attr($data_id); ?>">
                        <label for="<?php echo esc_attr($data_id); ?>">
                            <?php echo wp_kses_post($setting['label']); ?>
                        </label>

                        <input class="hidden-tag attach-img-id" id="input_<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" type="hidden" value="<?php echo esc_attr($value); ?>" />

                        <div class="nasa-attach-img" id="img_<?php echo esc_attr($data_id); ?>">
                            <img src="<?php echo $image_src; ?>" />
                        </div>

                        <button type="button" class="nasa_upload_img button" data-choose-text="<?php esc_attr_e("Choose an image", "nasa-core"); ?>" data-use-text="<?php esc_attr_e("Use image", "nasa-core"); ?>" data-id="<?php echo esc_attr($data_id); ?>">
                            <?php echo esc_html__('Upload/Add image', 'nasa-core'); ?>
                        </button>

                        <button type="button" class="nasa_remove_img button" data-id="<?php echo esc_attr($data_id); ?>" data-no-image="<?php echo nasa_no_image(true); ?>">
                            <?php echo esc_html__('Remove Image', 'nasa-core'); ?>
                        </button>
                    </div>

                    <?php
                    break;

                /**
                 * Set categories field
                 */
                case 'product_categories':
                    $term = $value ? get_term_by('slug', $value, 'product_cat') : null;
                    ?>

                    <div class="nasa-categories-wrap nasa-root-wrap">
                        <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                        <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                        <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Category selected.', 'nasa-core'); ?>">
                            <?php if($term) : ?>
                                <p class="category-name">
                                    <?php echo $term->name; ?> ( <?php echo $term->slug; ?> )
                                </p>
                                <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                            <?php else: ?>
                                <p class="no-selected">
                                    <?php echo esc_html__('There is not Category selected.', 'nasa-core'); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <a class="select-cat-item" href="javascript:void(0);"><?php echo esc_html__('Click here to select Category ...', 'nasa-core'); ?></a>
                        <div class="list-items-wrap" data-list="0">
                            <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                            <div class="list-items"></div>
                        </div>
                    </div>

                    <?php
                    break;
                    
                /**
                 * Set Brands field
                 */
                case 'product_brands':
                    $term = $value ? get_term_by('slug', $value, 'product_brand') : null;
                    ?>

                    <div class="nasa-brands-wrap nasa-root-wrap">
                        <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                        <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                        <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Brand selected.', 'nasa-core'); ?>">
                            <?php if($term) : ?>
                                <p class="brand-name">
                                    <?php echo $term->name; ?> ( <?php echo $term->slug; ?> )
                                </p>
                                <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                            <?php else: ?>
                                <p class="no-selected">
                                    <?php echo esc_html__('There is not Brand selected.', 'nasa-core'); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <a class="select-brand-item" href="javascript:void(0);"><?php echo esc_html__('Click here to select Brand ...', 'nasa-core'); ?></a>
                        <div class="list-items-wrap" data-list="0">
                            <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                            <div class="list-items"></div>
                        </div>
                    </div>

                    <?php
                    break;
                    
                /**
                 * Set pwb Brands field
                 */
                case 'product_pwb_brands':
                    $term = $value ? get_term_by('slug', $value, 'pwb-brand') : null;
                    ?>

                    <div class="nasa-pwb-brands-wrap nasa-root-wrap">
                        <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                        <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                        <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Brand (PWB) selected.', 'nasa-core'); ?>">
                            <?php if ($term) : ?>
                                <p class="pwb-brand-name">
                                    <?php echo $term->name; ?> ( <?php echo $term->slug; ?> )
                                </p>
                                <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                            <?php else: ?>
                                <p class="no-selected">
                                    <?php echo esc_html__('There is not Brand (PWB) selected.', 'nasa-core'); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <a class="select-pwb-brand-item" href="javascript:void(0);"><?php echo esc_html__('Click here to select Brand (PWB) ...', 'nasa-core'); ?></a>
                        <div class="list-items-wrap" data-list="0">
                            <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                            <div class="list-items"></div>
                        </div>
                    </div>

                    <?php
                    break;

                /**
                 * Set categories field
                 */
                case 'menu_list':
                    $term = $value ? get_term_by('slug', $value, 'nav_menu') : null;
                    ?>

                    <div class="nasa-menus-wrap nasa-root-wrap">
                        <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                        <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                        <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Menu selected.', 'nasa-core'); ?>">
                            <?php if ($term) : ?>
                                <p class="menu-name">
                                    <?php echo $term->name; ?> ( <?php echo $term->slug; ?> )
                                </p>
                                <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                            <?php else: ?>
                                <p class="no-selected">
                                    <?php echo esc_html__('There is not Menu selected.', 'nasa-core'); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <a class="select-menu-item" href="javascript:void(0);"><?php echo esc_html__('Click here to select Menu ...', 'nasa-core'); ?></a>
                        <div class="list-items-wrap" data-list="0">
                            <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                            <div class="list-items"></div>
                        </div>
                    </div>

                    <?php
                    break;

                /**
                 * Set pin slug field
                 */
                case 'pin_slug':
                    $pin_type = isset($setting['pin']) ? $setting['pin'] : ''; 'nasa_pin_mb';
                    $args_pin = array(
                        'name'        => $value,
                        'post_type'   => $pin_type,
                        'post_status' => 'publish',
                        'numberposts' => 1
                    );
                    $pin_array = $value ? get_posts($args_pin) : null;
                    $pin = $pin_array && isset($pin_array[0]) ? $pin_array[0] : null;
                    ?>

                    <div class="nasa-pins-wrap nasa-root-wrap">
                        <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                        <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                        <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Pin selected.', 'nasa-core'); ?>">
                            <?php if ($pin) : ?>
                                <p class="pin-name">
                                    <?php echo $pin->post_title; ?> ( <?php echo $pin->post_name; ?> )
                                </p>
                                <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                            <?php else: ?>
                                <p class="no-selected">
                                    <?php echo esc_html__('There is not Pin selected.', 'nasa-core'); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <a class="select-pin-item" data-type="<?php echo esc_attr($pin_type); ?>" href="javascript:void(0);">
                            <?php echo esc_html__('Click here to select Pin...', 'nasa-core'); ?>
                        </a>
                        <div class="list-items-wrap" data-list="0">
                            <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                            <div class="list-items"></div>
                        </div>
                    </div>

                    <?php
                    break;

                /**
                 * Set Slider slug field
                 */
                case 'revslider':
                    if (class_exists('RevSlider')) {
                        $slider = new RevSlider();
                        if ($value) {
                            $slider->initByAlias($value);
                        }

                        $title = $slider->get_title();
                        ?>

                        <div class="nasa-revs-wrap nasa-root-wrap" style="margin-bottom: 30px;">
                            <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                            <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                            <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Revolution Slider selected.', 'nasa-core'); ?>">
                                <?php if ($title) : ?>
                                    <p class="rev-name">
                                        <?php echo $title; ?> ( <?php echo $value; ?> )
                                    </p>
                                    <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                                <?php else: ?>
                                    <p class="no-selected">
                                        <?php echo esc_html__('There is not Revolution Slider selected.', 'nasa-core'); ?>
                                    </p>
                                <?php endif; ?>
                            </div>

                            <a class="select-rev-item" href="javascript:void(0);">
                                <?php echo esc_html__('Click here to select Revolution Slider...', 'nasa-core'); ?>
                            </a>
                            <div class="list-items-wrap" data-list="0">
                                <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                                <div class="list-items"></div>
                            </div>
                        </div>

                        <?php
                    }
                    break;

                // Default: run an action.
                default:
                    do_action('nasa_widget_field_' . $setting['type'], $key, $value, $setting, $instance);
                    break;
            }
        }
    }

    /**
     * 
     * @param type $atts
     */
    public function render_shortcode_text($atts = array()) {
        if (!$this->shortcode || !shortcode_exists($this->shortcode)) {
            return;
        }

        $atts_sc = array();
        $content = '';
        $text = '';
        
        if ($this->shortcode === 'nasa_service_box') {
            $atts_sc[] = 'vc_type="0"';
        }
        
        if (!empty($atts) && is_array($atts)) {
            foreach ($atts as $key => $value) {
                if ($key === 'title_widget') {
                    continue;
                }

                if ($key !== 'content') {
                    if (!is_array($value) && !is_object($value)) {
                        $value = (string) $value;
                        $atts_sc[] = $key . '="' . esc_attr($value) . '"';
                    }
                } else {
                    $content = $value;
                }
            }
        }

        $text .= '[' . $this->shortcode;
        $text .= !empty($atts_sc) ? ' ' . implode(' ', $atts_sc) : '';
        $text .= trim($content) != '' ? ']' . $content . '[/' . $this->shortcode : '';
        $text .= ']';

        echo do_shortcode($text);
    }

    /**
     * Array Options Yes | No number
     */
    protected function array_bool_number() {
        return array(
            '0' => __('No', 'nasa-core'),
            '1' => __('Yes', 'nasa-core')
        );
    }

    /**
     * Array Options Yes | No String
     */
    protected function array_bool_str() {
        return array(
            'false' => __('No', 'nasa-core'),
            'true' => __('Yes', 'nasa-core')
        );
    }

    /**
     * Array Options Yes No
     */
    protected function array_bool_YN() {
        $result = array(
            'no' => __('No', 'nasa-core'),
            'yes' => __('Yes', 'nasa-core')
        );

        return $result;
    }

    /**
     * Array Options Number
     */
    protected function array_numbers($max = 999, $min = 1) {
        $result = array();

        for ($max; $max >= $min; $max--) {
            $result[$max] = $max;
        }

        return $result;
    }

    /**
     * Array Options Number Half
     */
    protected function array_numbers_half() {
        $result = array(
            '3' => '3',
            '2' => '2',
            '1.5' => '1.5',
            '1' => '1'
        );

        return $result;
    }

    /**
     * 
     * @param type $args
     * @param type $instance
     */
    public function widget($args, $instance) {
        $this->render_shortcode_text($instance);
    }
}

/**
 * Includes Widgets
 */
nasa_includes_files(glob(NASA_CORE_PLUGIN_PATH . 'includes/widgets_elementor/nasa_*.php'));

/**
 * Register Elementor Widget - Shortcode 
 */
add_action('widgets_init', 'nasa_elementor_register_wgsc');
function nasa_elementor_register_wgsc() {
    /**
     * For WooCommerce
     */
    if (NASA_WOO_ACTIVED) {
        
        /**
         * Nasa Products
         */
        register_widget('Nasa_Products_WGSC');

        /**
         * Nasa Products Tabs
         */
        register_widget('Nasa_Products_Tabs_WGSC');

        /**
         * Nasa Products Special Deal
         */
        register_widget('Nasa_Products_Special_Deal_WGSC');

        /**
         * Nasa Product Deal
         */
        register_widget('Nasa_Product_Deal_WGSC');

        /**
         * Nasa Products Masonry
         */
        register_widget('Nasa_Products_Masonry_WGSC');

        /**
         * Nasa Product Categories
         */
        register_widget('Nasa_Product_Categories_WGSC');

        /**
         * Nasa Product Group
         */
        register_widget('Nasa_Product_Groups_WGSC');

        /**
         * Nasa Pin Products Banner
         */
        register_widget('Nasa_Pin_Products_Banner_WGSC');

        /**
         * Nasa Pin Products Carousel
         */
        register_widget('Nasa_Pin_Products_Carousel_WGSC');

        /**
         * Nasa Products By Ids
         */
        register_widget('Nasa_Products_By_Ids_WGSC');
    }

    /**
     * Nasa Pin Material Banner
     */
    register_widget('Nasa_Pin_Material_Banner_WGSC');

    /**
     * Nasa Pin Material Carousel
     */
    register_widget('Nasa_Pin_Material_Carousel_WGSC');

    /**
     * Nasa Compare Images
     */
    register_widget('Nasa_Compare_Imgs_WGSC');

    /**
     * Nasa Posts
     */
    register_widget('Nasa_Posts_WGSC');

    /**
     * Nasa Banner
     */
    register_widget('Nasa_Banner_WGSC');

    /**
     * Nasa Banner
     */
    register_widget('Nasa_Banner_2_WGSC');

    /**
     * Nasa Sliders
     */
    register_widget('Nasa_Sliders_WGSC');

    /**
     * Nasa Sliders v2
     */
    register_widget('Nasa_Sliders_2_WGSC');
    
    /**
     * Nasa Mega Menu
     */
    register_widget('Nasa_Mega_Menu_WGSC');

    /**
     * Nasa Menu Root level
     */
    register_widget('Nasa_Menu_Root_WGSC');

    /**
     * Nasa Menu Vertical
     */
    register_widget('Nasa_Menu_Vertical_WGSC');

    /**
     * Nasa Instagram Feed
     */
    register_widget('Nasa_Instagram_Feed_WGSC');

    /**
     * Nasa Share
     */
    register_widget('Nasa_Share_WGSC');

    /**
     * Nasa Follow
     */
    register_widget('Nasa_Follow_WGSC');

    /**
     * Nasa Countdown
     */
    register_widget('Nasa_Countdown_WGSC');

    /**
     * Nasa Service Box
     */
    register_widget('Nasa_Service_Box_WGSC');
    
    /**
     * Nasa Icon Box
     */
    register_widget('Nasa_Icon_Box_WGSC');

    /**
     * Nasa Image Box
     */
    register_widget('Nasa_Image_WGSC');

    /**
     * Nasa Image Box Grid
     */
    register_widget('Nasa_Image_Box_Grid_WGSC');
    
    /**
     * Nasa Testimonials
     */
    register_widget('Nasa_Client_WGSC');
    
    /**
     * Nasa Slider with Testimonials
     */
    register_widget('Nasa_Client_Carousel_WGSC');

    /**
     * Nasa_Icons_WGSC
     */
    if (shortcode_exists('nasa_sc_icons')) {
        register_widget('Nasa_Icons_WGSC');
    }
    
    /**
     * Nasa_Search_Products_WGSC
     */
    if (shortcode_exists('nasa_sc_search_form')) {
        register_widget('Nasa_Search_Products_WGSC');
    }

    /**
     * Revolution Slider
     */
    if (class_exists('RevSlider')) {
        register_widget('Nasa_Rev_Slider_WGSC');
    }
}
    