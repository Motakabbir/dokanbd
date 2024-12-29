<?php
/**
 * Widget for Elementor
 */
class Nasa_Sliders_WGSC extends Nasa_Elementor_Widget {
    
    /**
     * Settings tab
     * 
     * @var type 
     */
    public $settings_item = array();

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_banner';
        $this->widget_cssclass = 'nasa_sliders_wgsc';
        $this->widget_description = __('Display Sliders with Banner v1', 'nasa-core');
        $this->widget_id = 'nasa_sliders_sc';
        $this->widget_name = 'ELM - Nasa Sliders v1';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'class' => 'first',
                'label' => __('Title', 'nasa-core')
            ),
            
            'align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Alignment', 'nasa-core'),
                'options' => array(
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'bullets' => array(
                'type' => 'select',
                'std' => 'true',
                'label' => __('Bullets', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'bullets_pos' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Bullets Postition', 'nasa-core'),
                'options' => array(
                    '' => __('Outside', 'nasa-core'),
                    'inside' => __('Inside', 'nasa-core'),
                    'none' => __('Not Set', 'nasa-core')
                )
            ),
            
            'bullets_align' => array(
                'type' => 'select',
                'std' => 'center',
                'label' => __('Bullets Align', 'nasa-core'),
                'options' => array(
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'navigation' => array(
                'type' => 'select',
                'std' => 'true',
                'label' => __('Arrows', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'column_number' => array(
                'type' => 'select',
                'std' => 1,
                'label' => __('Columns Number', 'nasa-core'),
                'options' => $this->array_numbers(12)
            ),
            
            'column_number_small' => array(
                'type' => 'select',
                'std' => 1,
                'label' => __('Columns Number Small', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'column_number_tablet' => array(
                'type' => 'select',
                'std' => 1,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(10)
            ),
            
            'gap_items' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Gap Items', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'padding_item' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Item Padding (px || %)', 'nasa-core')
            ),
            
            'padding_item_small' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Item Padding in Mobile (px || %)', 'nasa-core')
            ),
            
            'padding_item_medium' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Item Padding in Tablet (px || %)', 'nasa-core')
            ),
            
            'force' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Force Initialize', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'autoplay' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Auto Play', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'loop_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Infinite', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'paginationspeed' => array(
                'type' => 'select',
                'std' => '800',
                'label' => __('Speed Slider', 'nasa-core'),
                'options' => array(
                    '300'   => __('0.3s', 'nasa-core'),
                    '400'   => __('0.4s', 'nasa-core'),
                    '500'   => __('0.5s', 'nasa-core'),
                    '600'   => __('0.6s', 'nasa-core'),
                    '700'   => __('0.7s', 'nasa-core'),
                    '800'   => __('0.8s', 'nasa-core'),
                    '900'   => __('0.9s', 'nasa-core'),
                    '1000'  => __('1.0s', 'nasa-core'),
                    '1100'  => __('1.1s', 'nasa-core'),
                    '1200'  => __('1.2s', 'nasa-core'),
                    '1300'  => __('1.3s', 'nasa-core'),
                    '1400'  => __('1.4s', 'nasa-core'),
                    '1500'  => __('1.5s', 'nasa-core'),
                    '1600'  => __('1.6s', 'nasa-core'),
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            ),
            
            'sliders' => array(
                'type' => 'sliders',
                'std' => array(),
                'label' => __('Slider Items', 'nasa-core')
            ),
        );
        
        $this->settings_item = array(
            'img_src' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Banner Image', 'nasa-core')
            ),
            
            'height' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Banner Height', 'nasa-core')
            ),
            
            'width' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Banner Width', 'nasa-core')
            ),
            
            'link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Link', 'nasa-core')
            ),
            
            'content-width' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Content Width (%)', 'nasa-core')
            ),
            
            'align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Horizontal Alignment', 'nasa-core'),
                'options' => array(
                    'left' => __('Left', 'nasa-core'),
                    'center' => __('Center', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'move_x' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Move Horizontal a distance (%)', 'nasa-core')
            ),
            
            'valign' => array(
                'type' => 'select',
                'std' => 'top',
                'label' => __('Vertical Alignment', 'nasa-core'),
                'options' => array(
                    'top' => __('Top', 'nasa-core'),
                    'middle' => __('Middle', 'nasa-core'),
                    'bottom' => __('Bottom', 'nasa-core')
                )
            ),
            
            'text-align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Text Alignment', 'nasa-core'),
                'options' => array(
                    'text-left' => __('Left', 'nasa-core'),
                    'text-center' => __('Center', 'nasa-core'),
                    'text-right' => __('Right', 'nasa-core')
                )
            ),
            
            'banner_responsive' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Responsive', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'content' => array(
                'type' => 'textarea_html',
                'std' => '',
                'label' => __('Banner Text', 'nasa-core')
            ),
            
            'effect_text' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Effect Banner Content', 'nasa-core'),
                'options' => array(
                    'none' => __('None', 'nasa-core'),
                    'fadeIn' => __('fadeIn', 'nasa-core'),
                    'fadeInDown' => __('fadeInDown', 'nasa-core'),
                    'fadeInUp' => __('fadeInUp', 'nasa-core'),
                    'fadeInLeft' => __('fadeInLeft', 'nasa-core'),
                    'fadeInRight' => __('fadeInRight', 'nasa-core'),
                    'slideInDown' => __('slideInDown', 'nasa-core'),
                    'slideInUp' => __('slideInUp', 'nasa-core'),
                    'slideInLeft' => __('slideInLeft', 'nasa-core'),
                    'slideInRight' => __('slideInRight', 'nasa-core'),
                    'flipInX' => __('flipInX', 'nasa-core'),
                    'flipInY' => __('flipInY', 'nasa-core'),
                    'lightSpeedIn' => __('lightSpeedIn', 'nasa-core'),
                    'rotateInDownLeft' => __('rotateInDownLeft', 'nasa-core'),
                    'rotateInDownRight' => __('rotateInDownRight', 'nasa-core'),
                    'rotateInUpLeft' => __('rotateInUpLeft', 'nasa-core'),
                    'rotateInUpRight' => __('rotateInUpRight', 'nasa-core'),
                    'zoomIn' => __('zoomIn', 'nasa-core'),
                    'zoomInDown' => __('zoomInDown', 'nasa-core'),
                    'zoomInLeft' => __('zoomInLeft', 'nasa-core'),
                    'zoomInRight' => __('zoomInRight', 'nasa-core'),
                    'zoomInUp' => __('zoomInUp', 'nasa-core'),
                    'bounceIn' => __('bounceIn', 'nasa-core'),
                    'bounceInDown' => __('bounceInDown', 'nasa-core'),
                    'bounceInLeft' => __('bounceInLeft', 'nasa-core'),
                    'bounceInRight' => __('bounceInRight', 'nasa-core'),
                    'bounceInUp' => __('bounceInUp', 'nasa-core')
                )
            ),
            
            'data_delay' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Animation Delay', 'nasa-core'),
                'options' => array(
                    '' => __('None', 'nasa-core'),
                    '100ms' => __('100ms', 'nasa-core'),
                    '200ms' => __('200ms', 'nasa-core'),
                    '300ms' => __('300ms', 'nasa-core'),
                    '400ms' => __('400ms', 'nasa-core'),
                    '500ms' => __('500ms', 'nasa-core'),
                    '600ms' => __('600ms', 'nasa-core'),
                    '700ms' => __('700ms', 'nasa-core'),
                    '800ms' => __('800ms', 'nasa-core'),
                )
            ),
            
            'hover' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Effect Banner Hover', 'nasa-core'),
                'options' => array(
                    '' => __('None', 'nasa-core'),
                    'zoom' => __('Zoom', 'nasa-core'),
                    'reduction' => __('Zoom Out', 'nasa-core'),
                    'fade' => __('Fade', 'nasa-core')
                )
            ),
            
            'border_inner' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Border Inner', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'border_outner' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Border Outner', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'hide_in_m' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Hide in Mobile - Mobile Layout', 'nasa-core'),
                'options' => array(
                    '' => __('No, Thanks!', 'nasa-core'),
                    '1' => __('Yes, Please!', 'nasa-core')
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );
        
        add_action('nasa_widget_field_sliders', array($this, 'sliders_content'), 10, 4);

        parent::__construct();
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
                
                case 'sliders':
                    $instance[$key] = isset($new_instance[$key]) ? $new_instance[$key] : $setting['std'];
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
     * Slide content
     */
    public function sliders_content($key, $value, $setting, $instance) {
        $data_id = $this->get_field_id($key);
        $data_name = $this->get_field_name($key);
        ?>
        <div class="nasa-sliders-content nasa-wrap-items">
            <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
            
            <div class="nasa-sliders-content-wrap nasa-appent-wrap" data-id="<?php echo esc_attr($data_id); ?>">
                <?php
                if (!empty($value)) {
                    foreach ($value as $order => $slide) {
                        include NASA_CORE_PLUGIN_PATH . 'admin/views/widgets_elementor/slider-item.php';
                    }
                }
                ?>
            </div>
            
            <a href="javascript:void(0);" class="nasa-add-item">
                <?php echo esc_html__('Add New Slide', 'nasa-core'); ?>
            </a>
            
            <?php /* Template new tab */ ?>
            <script type="text/template" class="tmpl-nasa-content">
                <?php
                $order = '{{order}}';
                $slide = array();
                include NASA_CORE_PLUGIN_PATH . 'admin/views/widgets_elementor/slider-item.php';
                ?>
            </script>
        </div>

        <?php
    }
    
    /**
     * Outputs the settings update form.
     *
     * @see   WP_Widget->form
     *
     * @param array $instance Instance.
     */
    public function form_slide($instance, $name_root, $id_root, $order) {
        if (empty($this->settings_item)) {
            return;
        }

        foreach ($this->settings_item as $key => $setting) {
            if (!isset($setting['std'])) {
                $setting['std'] = '';
            }

            $class = isset($setting['class']) ? $setting['class'] : '';
            $value = isset($instance[$key]) ? $instance[$key] : $setting['std'];
            $data_id = $id_root . '-' . $order . '-' . $key;
            $data_name = $name_root . '[' . $order . '][' . $key . ']';

            switch ($setting['type']) {

                case 'text':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>">
                            <?php echo wp_kses_post($setting['label']); ?>
                        </label>
                        
                        <input class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
                    </p>
                    <?php
                    break;

                case 'select':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>">
                            <?php echo wp_kses_post($setting['label']); ?>
                        </label>
                        
                        <select class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>">
                            <?php foreach ($setting['options'] as $option_key => $option_value) : ?>
                                <option value="<?php echo esc_attr($option_key); ?>" <?php selected($option_key, $value); ?>><?php echo esc_html($option_value); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <?php
                    break;
                    
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

                // Default: run an action.
                default:
                    
                    break;
            }
        }
    }
    
    /**
     * 
     * @param type $args
     * @param type $instance
     */
    public function widget($args, $instance) {
        if (empty($instance['sliders'])) {
            return;
        }
        
        nasa_template('widgets_elementor/nasa-sliders.php', array('instance' => $instance, '_this' => $this));
    }
}
