<?php
add_action('init', 'elessi_blog_heading');
if (!function_exists('elessi_blog_heading')) {
    function elessi_blog_heading() {
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Blog", 'elessi-theme'),
            "target" => 'blog',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("Blog Options", 'elessi-theme'),
            "std" => "<h4>" . __("Blog Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Single Layout", 'elessi-theme'),
            "id" => "single_blog_layout",
            "std" => "left",
            "type" => "select",
            "options" => array(
                "left" => __("Left Sidebar", 'elessi-theme'),
                "right" => __("Right Sidebar", 'elessi-theme'),
                "no" => __("No Sidebar (Centered)", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => __("Archive Layout", 'elessi-theme'),
            "id" => "blog_layout",
            "std" => "left",
            "type" => "select",
            "options" => array(
                "left" => __("Left Sidebar", 'elessi-theme'),
                "right" => __("Right Sidebar", 'elessi-theme'),
                "no" => __("No Sidebar (Centered)", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => __("Style", 'elessi-theme'),
            "id" => "blog_type",
            "std" => "blog-standard",
            "type" => "select",
            "options" => array(
                "blog-standard" => __("Standard", 'elessi-theme'),
                "blog-list" => __("List", 'elessi-theme'),
                "blog-grid" => __("Grid", 'elessi-theme'),
                "masonry-isotope" => __("Masonry Isotope", 'elessi-theme')
            )
        );
        
        /* ======================================================================= */
        
        $of_options[] = array(
            "name" => __("Heading for Archive Page", 'elessi-theme'),
            "id" => "blog_heading",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Heading for Blog Page", 'elessi-theme'),
            "id" => "posts_heading",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Masonry Isotope - Grid - Blog style", 'elessi-theme'),
            "std" => "<h4>" . __("Masonry Isotope - Grid - Blog style", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Columns in desktop", 'elessi-theme'),
            "id" => "masonry_blogs_columns_desk",
            "std" => "3-cols",
            "type" => "select",
            "options" => array(
                "2-cols" => __("2 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme'),
                "4-cols" => __("4 columns", 'elessi-theme'),
                "5-cols" => __("5 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Columns in Mobile", 'elessi-theme'),
            "id" => "masonry_blogs_columns_small",
            "std" => "1-col",
            "type" => "select",
            "options" => array(
                "1-cols" => __("1 column", 'elessi-theme'),
                "2-cols" => __("2 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Columns in Tablet", 'elessi-theme'),
            "id" => "masonry_blogs_columns_tablet",
            "std" => "2-cols",
            "type" => "select",
            "options" => array(
                "1-col" => __("1 column", 'elessi-theme'),
                "2-cols" => __("2 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme')
            )
        );
        
        /* ======================================================================= */
        
        $of_options[] = array(
            "name" => __("Meta Info - Blog Style", 'elessi-theme'),
            "std" => "<h4>" . __("Meta Info - Blog Style", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Author info", 'elessi-theme'),
            "id" => "show_author_info",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Datetime info", 'elessi-theme'),
            "id" => "show_date_info",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Categories info", 'elessi-theme'),
            "id" => "show_cat_info",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Tags info", 'elessi-theme'),
            "id" => "show_tag_info",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Comment Count info", 'elessi-theme'),
            "id" => "show_comment_info",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Readmore", 'elessi-theme'),
            "id" => "show_readmore_blog",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Short description (Only use for Blog Grid layout)", 'elessi-theme'),
            "id" => "show_desc_blog",
            "std" => 1,
            "type" => "switch"
        );
        
        /* ======================================================================= */
        
        $of_options[] = array(
            "name" => __("Single Page", 'elessi-theme'),
            "std" => "<h4>" . __("Single Blog page", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Main Image", 'elessi-theme'),
            "id" => "main_single_post_image",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Categories info", 'elessi-theme'),
            "id" => "single_cat_info",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Author - Date info", 'elessi-theme'),
            "id" => "show_author_date_info",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Tags info", 'elessi-theme'),
            "id" => "show_tags_info",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Share icons", 'elessi-theme'),
            "id" => "show_share_icons_info",
            "std" => 1,
            "type" => "switch"
        );
        
        if (NASA_CORE_ACTIVED) {
        
            $of_options[] = array(
                "name" => __("Related", 'elessi-theme'),
                "id" => "relate_blogs",
                "std" => 1,
                "type" => "switch"
            );

            $of_options[] = array(
                "name" => __("Number for related blog", 'elessi-theme'),
                "id" => "relate_blogs_number",
                "std" => "10",
                "type" => "text"
            );

            $of_options[] = array(
                "name" => __("Columns Related in desktop", 'elessi-theme'),
                "id" => "relate_blogs_columns_desk",
                "std" => "3-cols",
                "type" => "select",
                "options" => array(
                    "3-cols" => __("3 columns", 'elessi-theme'),
                    "4-cols" => __("4 columns", 'elessi-theme'),
                    "5-cols" => __("5 columns", 'elessi-theme')
                )
            );

            $of_options[] = array(
                "name" => __("Columns Related in mobile", 'elessi-theme'),
                "id" => "relate_blogs_columns_small",
                "std" => "1-col",
                "type" => "select",
                "options" => array(
                    "1-cols" => __("1 column", 'elessi-theme'),
                    "2-cols" => __("2 columns", 'elessi-theme')
                )
            );

            $of_options[] = array(
                "name" => __("Columns Related in Tablet", 'elessi-theme'),
                "id" => "relate_blogs_columns_tablet",
                "std" => "2-cols",
                "type" => "select",
                "options" => array(
                    "1-col" => __("1 column", 'elessi-theme'),
                    "2-cols" => __("2 columns", 'elessi-theme'),
                    "3-cols" => __("3 columns", 'elessi-theme')
                )
            );
        }
    }
}
