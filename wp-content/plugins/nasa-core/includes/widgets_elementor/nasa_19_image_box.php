<?php
/**
 * Widget for Elementor
 */
class Nasa_Image_Box_Grid_WGSC extends Nasa_Elementor_Widget {
    
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
        $this->shortcode = 'nasa_image_box';
        $this->widget_cssclass = 'nasa_image_box_grid_wgsc';
        $this->widget_description = __('Display Image Box Grid', 'nasa-core');
        $this->widget_id = 'nasa_image_box_grid_sc';
        $this->widget_name = 'ELM - Nasa Image Box Grid';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'class' => 'first',
                'label' => __('Title', 'nasa-core')
            ),
            
            'title_font_size' => array(
                'type' => 'select',
                'std' => 'm',
                'label' => __('Title Font Size', 'nasa-core'),
                'options' => array(
                    'xl' => __('X-Large', 'nasa-core'),
                    'l' => __('Large', 'nasa-core'),
                    'm' => __('Medium', 'nasa-core'),
                    's' => __('Small', 'nasa-core'),
                    't' => __('Tiny', 'nasa-core')
                )
            ),
            
            'glb_link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Global URL', 'nasa-core')
            ),
            
            'glb_link_text' => array(
                'type' => 'text',
                'std' => 'See All&nbsp;<i class="fa fa-arrow-circle-right primary-color"></i>',
                'label' => __('Global URL Text', 'nasa-core')
            ),
            
            'boxgrid' => array(
                'type' => 'boxgrid',
                'std' => array(),
                'label' => __('Image Box Items', 'nasa-core')
            ),
            
            'column_number' => array(
                'type' => 'select',
                'std' => 5,
                'label' => __('Columns Number', 'nasa-core'),
                'options' => $this->array_numbers(8)
            ),
            
            'column_number_small' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Small', 'nasa-core'),
                'options' => $this->array_numbers(3)
            ),
            
            'column_number_tablet' => array(
                'type' => 'select',
                'std' => 4,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(5)
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );
        
        $this->settings_item = array(
            'image' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Image', 'nasa-core')
            ),
            
            'alt' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('ALT - Text', 'nasa-core')
            ),
            
            'link_text' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('URL', 'nasa-core')
            ),
            
            'link_target' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Target', 'nasa-core'),
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '_blank' => __('Blank', 'nasa-core')
                )
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
        
        add_action('nasa_widget_field_boxgrid', array($this, 'box_content'), 10, 4);

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

                case 'checkbox':
                    $instance[$key] = empty($new_instance[$key]) ? 0 : 1;
                    break;
                
                case 'boxgrid':
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
    public function box_content($key, $value, $setting, $instance) {
        $data_id = $this->get_field_id($key);
        $data_name = $this->get_field_name($key);
        ?>
        <div class="nasa-img-box-grid-content nasa-wrap-items">
            <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
            
            <div class="nasa-img-box-grid-content-wrap nasa-appent-wrap" data-id="<?php echo esc_attr($data_id); ?>">
                <?php
                if (!empty($value)) {
                    foreach ($value as $order => $item) {
                        include NASA_CORE_PLUGIN_PATH . 'admin/views/widgets_elementor/img-box-item.php';
                    }
                }
                ?>
            </div>
            
            <a href="javascript:void(0);" class="nasa-add-item">
                <?php echo esc_html__('Add New Item', 'nasa-core'); ?>
            </a>
            
            <?php /* Template new item */ ?>
            <script type="text/template" class="tmpl-nasa-content">
                <?php
                $order = '{{order}}';
                $item = array();
                include NASA_CORE_PLUGIN_PATH . 'admin/views/widgets_elementor/img-box-item.php';
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
    public function box_item($instance, $name_root, $id_root, $order) {
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
        if (empty($instance['boxgrid'])) {
            return;
        }
        
        nasa_template('widgets_elementor/nasa-img-box-grid.php', array('instance' => $instance, '_this' => $this));
    }
}
