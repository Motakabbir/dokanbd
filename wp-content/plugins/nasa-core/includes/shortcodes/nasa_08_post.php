<?php
/**
 * Shortcode [nasa_post ...]
 * 
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_posts($atts = array(), $content = null) {
    global $nasa_opt;
    
    $dfAttr = array(
        "title" => '',
        "title_desc" => '',
        "align" => '',
        'show_type' => 'slide',
        'auto_slide' => 'false',
        'loop_slide' => 'false',
        'dots' => 'false',
        'arrows' => 1,
        'posts' => '8',
        'category' => '',
        'columns_number' => '3',
        'columns_number_small' => '1',
        'columns_number_small_slider' => '1',
        'columns_number_tablet' => '2',
        'cats_enable' => 'yes',
        'date_author' => 'bot',
        'date_enable' => 'yes',
        'author_enable' => 'yes',
        'readmore' => 'yes',
        'page_blogs' => 'yes',
        'des_enable' => 'no',
        'info_align' => 'left',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    /**
     * Cache shortcode
     */
    $key = false;
    if (isset($nasa_opt['nasa_cache_shortcodes']) && $nasa_opt['nasa_cache_shortcodes']) {
        $key = nasa_key_shortcode('nasa_post', $dfAttr, $atts);
        $content = nasa_get_cache_shortcode($key);
    }
    
    if (!$content) {
        $posts = isset($show_type) && $show_type == 'grid_3' ? '2' : $posts;
        
        $args = array(
            'post_status'       => 'publish',
            'post_type'         => 'post',
            'category_name'     => $category != '' ? $category : '',
            'posts_per_page'    => (int) $posts ? (int) $posts : 8,
            'orderby'           => 'date',
            'order'             => 'DESC',
            // 'suppress_filters'  => true
        );

        $recentPosts = new WP_Query(apply_filters('nasa_latest_posts_args', $args));
        
        if ($recentPosts->post_count) {
            ob_start();
            $align = ($align == 'center') ? ' text-center' : '';
            
            $class_wrap = 'nasa-sc-posts-warp';
            $class_wrap .= $el_class != '' ? ' ' . $el_class : '';
            ?>
            <div class="<?php echo esc_attr($class_wrap); ?>">
                <?php if (trim($title) !== '' && $show_type !== 'grid_3') { ?> 
                    <div class="nasa-title nasa-m">
                        <h3 class="nasa-title-heading margin-bottom-0 <?php echo esc_attr($align); ?>">
                            <?php echo esc_attr($title); ?>
                        </h3>
                        
                        <?php if (trim($title_desc) != '') {
                            echo '<p class="nasa-title-desc">' . esc_html($title_desc) . '</p>';
                        } ?>
                        <hr class="nasa-separator margin-bottom-20" />
                    </div>
                <?php } ?>
                
                <?php
                switch ($show_type) :
                    case 'grid':
                        $file = 'blogs/latestblog_grid.php';
                        break;
                    case 'grid_2':
                        $file = 'blogs/latestblog_grid_2.php';
                        break;
                    case 'grid_3':
                        $file = 'blogs/latestblog_grid_3.php';
                        break;
                    case 'list':
                        $file = 'blogs/latestblog_list.php';
                        break;
                    case 'slide':
                    default:
                        $file = 'blogs/latestblog_carousel.php';
                        break;
                endswitch;

                $nasa_args = array(
                    'nasa_opt' => $nasa_opt,
                    "title" => $title,
                    "title_desc" => $title_desc,
                    "align" => $align,
                    'show_type' => $show_type,
                    'auto_slide' => $auto_slide,
                    'loop_slide' => $loop_slide,
                    'dots' => $dots,
                    'arrows' => $arrows,
                    'posts' => $posts,
                    'category' => $category,
                    'columns_number' => $columns_number,
                    'columns_number_small' => $columns_number_small,
                    'columns_number_small_slider' => $columns_number_small_slider,
                    'columns_number_tablet' => $columns_number_tablet,
                    'cats_enable' => $cats_enable,
                    'date_author' => $date_author,
                    'date_enable' => $date_enable,
                    'author_enable' => $author_enable,
                    'readmore' => $readmore,
                    'page_blogs' => $page_blogs,
                    'des_enable' => $des_enable,
                    'info_align' => $info_align,
                    'el_class' => $el_class,
                    'recentPosts' => $recentPosts
                );

                nasa_template($file, $nasa_args);
            ?>
            </div>
            <?php
            
            $content = ob_get_clean();

            if ($content) {
                nasa_set_cache_shortcode($key, $content);
            }
        }
    }
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Recent Posts
// **********************************************************************//   
function nasa_register_latest_post(){
    $params = array(
        "name" => "Posts",
        "base" => "nasa_post",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display Post - Blogs.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __('Title', 'nasa-core'),
                "param_name" => "title",
                "std" => ''
            ),
            
            array(
                "type" => "textfield",
                "heading" => __('Description', 'nasa-core'),
                "param_name" => "title_desc",
                "std" => ''
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Style", 'nasa-core'),
                "param_name" => "show_type",
                "value" => array(
                    __('Slider', 'nasa-core') => 'slide',
                    __('Grid 1', 'nasa-core') => 'grid',
                    __('Grid 2', 'nasa-core') => 'grid_2',
                    __('Grid 3 - Only show 2 posts', 'nasa-core') => 'grid_3',
                    __('List', 'nasa-core') => 'list'
                ),
                "std" => 'slide'
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Slide Auto', 'nasa-core'),
                "param_name" => 'auto_slide',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => 'true',
                    __('No, Thanks!', 'nasa-core') => 'false'
                ),
                "std" => 'false',
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide"
                    )
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Slide Infinite', 'nasa-core'),
                "param_name" => 'loop_slide',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => 'true',
                    __('No, Thanks!', 'nasa-core') => 'false'
                ),
                "std" => 'false',
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide"
                    )
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Dots', 'nasa-core'),
                "param_name" => 'dots',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => 'true',
                    __('No, Thanks!', 'nasa-core') => 'false'
                ),
                "std" => 'false',
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide"
                    )
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Arrows', 'nasa-core'),
                "param_name" => 'arrows',
                "value" => array(
                    __('No, Thanks!', 'nasa-core') => 0,
                    __('Yes, Please!', 'nasa-core') => 1
                ),
                "std" => 1,
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide"
                    )
                )
            ),

            array(
                "type" => "textfield",
                "heading" => __("Posts number - Not use with Grid 3", 'nasa-core'),
                "param_name" => "posts",
                "value" => "8",
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide", "grid", "grid_2", "list"
                    )
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Columns Number", 'nasa-core'),
                "param_name" => "columns_number",
                "value" => array(6, 5, 4, 3, 2, 1),
                "std" => 3,
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide", "grid", "grid_2"
                    )
                ),
                "admin_label" => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Small", 'nasa-core'),
                "param_name" => "columns_number_small",
                "value" => array(2, 1),
                "std" => 1,
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "grid", "grid_2"
                    )
                ),
                "admin_label" => true
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Small", 'nasa-core'),
                "param_name" => "columns_number_small_slider",
                "value" => array('2', '1.5', '1'),
                "std" => 1,
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide"
                    )
                ),
                "admin_label" => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Tablet", 'nasa-core'),
                "param_name" => "columns_number_tablet",
                "value" => array(4, 3, 2, 1),
                "std" => 2,
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide", "grid", "grid_2"
                    )
                ),
                "admin_label" => true,
            ),

            array(
                "type" => "textfield",
                "heading" => __("Categories", 'nasa-core'),
                "param_name" => "category",
                "value" => '',
                "description" => __('Input categories slug Divide with "," Ex: slug-1, slug-2 ...', 'nasa-core')
            ),

            // Date
            array(
                "type" => "dropdown",
                "heading" => __("Show Categories of post", 'nasa-core'),
                "param_name" => "cats_enable",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                'std' => 'yes'
            ),

            // date_author
            array(
                "type" => "dropdown",
                "heading" => __("Date/Author/Readmore position with description", 'nasa-core'),
                "param_name" => "date_author",
                "value" => array(
                    __('Top', 'nasa-core') => 'top',
                    __('Bottom', 'nasa-core') => 'bot'
                ),
                'std' => 'bot',
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide", "grid", "list"
                    )
                )
            ),

            // Date
            array(
                "type" => "dropdown",
                "heading" => __("Show date post", 'nasa-core'),
                "param_name" => "date_enable",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                'std' => 'yes'
            ),

            // Author
            array(
                "type" => "dropdown",
                "heading" => __("Show author post", 'nasa-core'),
                "param_name" => "author_enable",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                'std' => 'yes'
            ),

            // Read more
            array(
                "type" => "dropdown",
                "heading" => __("Show read more", 'nasa-core'),
                "param_name" => "readmore",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                'std' => 'yes'
            ),

            // Page blogs
            array(
                "type" => "dropdown",
                "heading" => __("Show button page blogs", 'nasa-core'),
                "param_name" => "page_blogs",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                'std' => 'yes'
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Show description", 'nasa-core'),
                "param_name" => "des_enable",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'no',
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "slide", "grid", "list"
                    )
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Info Align', 'nasa-core'),
                "param_name" => 'info_align',
                "value" => array(
                    __('Left (RTL - Right)', 'nasa-core') => 'left',
                    __('Right (RTL - Left)', 'nasa-core') => 'right'
                ),
                "std" => 'left',
                "dependency" => array(
                    "element" => "show_type",
                    "value" => array(
                        "list"
                    )
                )
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );

    vc_map($params);
}
