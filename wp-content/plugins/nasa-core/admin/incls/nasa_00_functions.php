<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Get Headers builder type
 */
function nasa_get_headers_options($id = false) {
    if (!$id) {
        global $nasa_admin_headers;
        
        if (!isset($nasa_admin_headers)) {
            $headers = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'header'
            ));

            $nasa_admin_headers = array('' => __("Default", 'nasa-core'));

            if ($headers) {
                foreach ($headers as $value) {
                    $nasa_admin_headers[$value->post_name] = $value->post_title;
                }
            }

            $GLOBALS['nasa_admin_headers'] = $nasa_admin_headers;
        }

        return $nasa_admin_headers;
    } else {
        global $nasa_admin_headers_2id;
        
        if (!isset($nasa_admin_headers_2id)) {
            $headers = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'header'
            ));

            $nasa_admin_headers_2id = array('' => __("Default", 'nasa-core'));

            if ($headers) {
                foreach ($headers as $value) {
                    $nasa_admin_headers_2id[$value->post_name] = array($value->ID, $value->post_title);
                }
            }

            $GLOBALS['nasa_admin_headers_2id'] = $nasa_admin_headers_2id;
        }

        return $nasa_admin_headers_2id;
    }
}

/**
 * Get Headers builder by Elementor
 */
function nasa_get_headers_elementor() {
    global $nasa_admin_headers_elm;
    
    if (!isset($nasa_admin_headers_elm)) {
        $headers = get_posts(array(
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post_type' => 'elementor-hf',
            'meta_key' => 'ehf_template_type',
            'meta_value' => 'type_header'
        ));

        $nasa_admin_headers_elm = array('0' => __("Default", 'nasa-core'));
        if ($headers) {
            foreach ($headers as $value) {
                $nasa_admin_headers_elm[$value->ID] = $value->post_title;
            }
        }
        
        $GLOBALS['nasa_admin_headers_elm'] = $nasa_admin_headers_elm;
    }
    
    return $nasa_admin_headers_elm;
}

/**
 * Get Footers builder
 */
function nasa_get_footers_options($id = false) {
    if (!$id) {
        global $nasa_admin_footers;
        
        if (!isset($nasa_admin_footers)) {
            $footers = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'footer'
            ));

            $nasa_admin_footers = array('' => __("Default", 'nasa-core'));

            if ($footers) {
                foreach ($footers as $value) {
                    $nasa_admin_footers[$value->post_name] = $value->post_title;
                }
            }

            $GLOBALS['nasa_admin_footers'] = $nasa_admin_footers;
        }

        return $nasa_admin_footers;
    } else {
        global $nasa_admin_footers_2id;
        
        if (!isset($nasa_admin_footers_2id)) {
            $footers = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'footer'
            ));

            $nasa_admin_footers_2id = array('' => __("Default", 'nasa-core'));

            if ($footers) {
                foreach ($footers as $value) {
                    $nasa_admin_footers_2id[$value->post_name] = array($value->ID, $value->post_title);
                }
            }

            $GLOBALS['nasa_admin_footers_2id'] = $nasa_admin_footers_2id;
        }

        return $nasa_admin_footers_2id;
    }
}

/**
 * Get Footers builder by Elementor
 */
function nasa_get_footers_elementor() {
    global $nasa_admin_footers_elm;
    
    if (!isset($nasa_admin_footers_elm)) {
        $footers = get_posts(array(
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post_type' => 'elementor-hf',
            'meta_key' => 'ehf_template_type',
            'meta_value' => 'type_footer'
        ));

        $nasa_admin_footers_elm = array('0' => __("Default", 'nasa-core'));
        
        if ($footers) {
            foreach ($footers as $footer) {
                $nasa_admin_footers_elm[$footer->ID] = $footer->post_title;
            }
        }
        
        $GLOBALS['nasa_admin_footers_elm'] = $nasa_admin_footers_elm;
    }
    
    return $nasa_admin_footers_elm;
}

/**
 * Get list Contact Form 7
 * @return type
 */
function nasa_get_contact_form7() {
    global $nasa_list_contact_form7;
    
    if (!isset($nasa_list_contact_form7)) {
        $items = array('' => __('Select the Contact Form', 'nasa-core'));
        $contacts = array();

        if (class_exists('WPCF7_ContactForm')) {
            $contacts = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => WPCF7_ContactForm::post_type
            ));

            if (!empty($contacts)) {
                foreach ($contacts as $value) {
                    $items[$value->ID] = $value->post_title;
                }
            }
        }

        if (empty($contacts)) {
            $items = array('' => __('You need install plugin Contact Form 7 and Create a form', 'nasa-core'));
        }
        
        $nasa_list_contact_form7 = $items;
        
        $GLOBALS['nasa_list_contact_form7'] = $nasa_list_contact_form7;
    }
    
    return $nasa_list_contact_form7;
}

/**
 * Get nasa blocks post type
 */
function nasa_get_blocks_options($id = false) {
    if (!$id) {
        global $nasa_admin_blocks;

        if (!isset($nasa_admin_blocks)) {
            $blocks = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'nasa_block'
            ));

            $nasa_admin_blocks = array('' => __("Default", 'nasa-core'));

            if (!empty($blocks)) {
                foreach ($blocks as $block) {
                    $nasa_admin_blocks[$block->post_name] = $block->post_title . ' - (Slug: ' . $block->post_name . ')';
                }
            }

            $hf_blocks = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'elementor-hf',
                'meta_key' => 'ehf_template_type',
                'meta_value' => 'custom'
            ));

            if (!empty($hf_blocks)) {
                foreach ($hf_blocks as $hf_block) {
                    $nasa_admin_blocks['nshfe.' . $hf_block->ID] = '[' . __('HFE Block') . '] - ' . $hf_block->post_title . ' - (Slug: ' . $hf_block->post_name . ')';
                }
            }

            if (count($nasa_admin_blocks) > 1) {
                $nasa_admin_blocks['-1'] = __('No, Thanks!', 'nasa-core');
            }

            $GLOBALS['nasa_admin_block'] = $nasa_admin_blocks;
        }

        return $nasa_admin_blocks;
    } else {
        global $nasa_admin_blocks_2id;

        if (!isset($nasa_admin_blocks_2id)) {
            $blocks = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'nasa_block'
            ));

            $nasa_admin_blocks_2id = array('' => __("Default", 'nasa-core'));

            if (!empty($blocks)) {
                foreach ($blocks as $block) {
                    $nasa_admin_blocks_2id[$block->post_name] = array($block->ID, $block->post_title . ' - (Slug: ' . $block->post_name . ')', 'nswpb');
                }
            }

            $hf_blocks = get_posts(array(
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'post_type' => 'elementor-hf',
                'meta_key' => 'ehf_template_type',
                'meta_value' => 'custom'
            ));

            if (!empty($hf_blocks)) {
                foreach ($hf_blocks as $hf_block) {
                    $nasa_admin_blocks_2id['nshfe.' . $hf_block->ID] = array($hf_block->ID, '[' . __('HFE Block') . '] - ' . $hf_block->post_title . ' - (Slug: ' . $hf_block->post_name . ')', 'nshfe');
                }
            }

            if (count($nasa_admin_blocks_2id) > 1) {
                $nasa_admin_blocks_2id['-1'] = __('No, Thanks!', 'nasa-core');
            }

            $GLOBALS['nasa_admin_blocks_2id'] = $nasa_admin_blocks_2id;
        }

        return $nasa_admin_blocks_2id;
    }
}

/**
 * Get menus
 */
function nasa_meta_get_list_menus() {
    global $nasa_admin_navs;
    
    if (!isset($nasa_admin_navs)) {
        $menus = wp_get_nav_menus(array('orderby' => 'name'));
        
        $nasa_admin_navs = array(
            '' => __('Default', 'nasa-core')
        );
        
        foreach ($menus as $menu_option) {
            $nasa_admin_navs[$menu_option->term_id] = $menu_option->name;
        }

        $nasa_admin_navs['-1'] = __("Don't show", 'nasa-core');
        
        $GLOBALS['nasa_admin_navs'] = $nasa_admin_navs;
    }

    return $nasa_admin_navs;
}

/**
 * Get Sidebar category layouts
 */
function nasa_get_sidebar_layouts() {
    $options = array(
        ""              => __("Default", 'nasa-core'),
        "top"           => __("Top Bar", 'nasa-core'),
        "top-2"         => __("Top Bar Type 2", 'nasa-core'),
        "top-3"         => __("Top Bar Type 3", 'nasa-core'),
        "left"          => __("Left Sidebar Off-canvas", 'nasa-core'),
        "left-classic"  => __("Left sidebar Classic", 'nasa-core'),
        "right"         => __("Right Sidebar Off-canvas", 'nasa-core'),
        "right-classic" => __("Right Sidebar Classic", 'nasa-core'),
        "no"            => __("No Sidebar", 'nasa-core'),
    );
    
    return $options;
}

/**
 * Single product layouts
 */
function nasa_single_product_layouts() {
    $options = array(
        ""          => __("Default", 'nasa-core'),
        "classic"   => __("Classic", 'nasa-core'),
        "new"       => __("Gallery Grid", 'nasa-core'),
        "new-2"     => __("Gallery Grid 2", 'nasa-core'),
        "new-3"     => __("Gallery Grid 3", 'nasa-core'),
        "full"      => __("Slider - Fullwidth", 'nasa-core'),
        "modern-1"  => __("Purchase Focus", 'nasa-core'),
        "modern-2"  => __("With Background", 'nasa-core'),
        "modern-3"  => __("With Background 2", 'nasa-core'),
        "modern-4"  => __("With Background 3", 'nasa-core'),
    );

    return $options;
}

/**
 * Single product sidebar position
 */
function nasa_single_product_sidebars() {
    $options = array(
        ""        => __("Default", 'nasa-core'),
        "left"    => __("Left Sidebar", 'nasa-core'),
        "right"   => __("Right Sidebar", 'nasa-core'),
        "no"      => __("No Sidebar", 'nasa-core'),
    );

    return $options;
}

/**
 * Single product image layouts
 */
function nasa_single_product_images_layout() {
    $options = array(
        "double" => __("2 Columns", 'nasa-core'),
        "single" => __("1 Column", 'nasa-core')
    );

    return $options;
}

/**
 * Single product image style
 */
function nasa_single_product_images_style() {
    $options = array(
        "slide"  => __("Slide images", 'nasa-core'),
        "scroll" => __("Scroll images", 'nasa-core')
    );

    return $options;
}

/**
 * Single product thumbs style
 */
function nasa_single_product_thumbs_style() {
    $options = array(
        "ver" => __("Vertical", 'nasa-core'),
        "hoz" => __("Horizontal", 'nasa-core')
    );

    return $options;
}

/**
 * Single product tabs style
 */
function nasa_single_product_tabs_style() {
    $options = array(
        ""                  => __("Default", 'nasa-core'),
        "2d-no-border"      => __("Classic 2D - No Border", 'nasa-core'),
        "2d-radius"         => __("Classic 2D - Radius", 'nasa-core'),
        "2d-radius-dashed"  => __("Classic 2D - Radius - Dash", 'nasa-core'),
        "2d"                => __("Classic 2D", 'nasa-core'),
        "3d"                => __("Classic 3D", 'nasa-core'),
        "slide"             => __("Slide", 'nasa-core'),
        "accordion"         => __("Accordion - Border", 'nasa-core'),
        "accordion-2"       => __("Accordion - No Border", 'nasa-core'),
        "small-accordion"   => __("Accordion in Content", 'nasa-core'),
        "scroll-down"       => __("Scroll Down", 'nasa-core'),
        "ver-1"             => __("Vertical", 'nasa-core'),
        "ver-2"             => __("Vertical Expanded", 'nasa-core'),
    );

    return $options;
}

/**
 * Loop product effect Hover
 */
function nasa_product_hover_effect_types() {
    $options = array(
        ""                      => __("Default", 'nasa-core'),
        "hover-fade"            => __("Fade", 'nasa-core'),
        "hover-zoom"            => __("Zoom", 'nasa-core'),
        "hover-to-top"          => __("Hover To Top", 'nasa-core'),
        "hover-flip"            => __("Flip Horizontal", 'nasa-core'),
        "hover-bottom-to-top"   => __("Bottom To Top", 'nasa-core'),
        "hover-top-to-bottom"   => __("Top to Bottom", 'nasa-core'),
        "hover-left-to-right"   => __("Left to Right", 'nasa-core'),
        "hover-right-to-left"   => __("Right to Left", 'nasa-core'),
        "hover-carousel"        => __("Gallery - Carousel", 'nasa-core'),
        "no"                    => __("None", 'nasa-core')
    );

    return $options;
}
/**
 * Loop product cards layouts
 */
function nasa_product_card_layouts() {
    $options = array(
        "" => __("Default", 'nasa-core'),
        "ver-buttons"   => __("Style 1", 'nasa-core'),
        "hoz-buttons"   => __("Style 2", 'nasa-core'),
        "modern-1"      => __("Style 3", 'nasa-core'),
        "modern-2"      => __("Style 4", 'nasa-core'),
        "modern-3"      => __("Style 5", 'nasa-core'),
        "modern-4"      => __("Style 6", 'nasa-core'),
        "modern-5"      => __("Style 7", 'nasa-core'),
        "modern-6"      => __("Style 8", 'nasa-core'),
        "modern-7"      => __("Style 9", 'nasa-core'),
        "modern-8"      => __("Style 10", 'nasa-core')
    );

    return $options;
}

/**
 * Get custom fonts
 */
function nasa_get_custom_fonts() {
    global $wp_filesystem, $nasa_upload_dir;
    
    if (!isset($nasa_upload_dir)) {
        $nasa_upload_dir = wp_upload_dir();
        $GLOBALS['nasa_upload_dir'] = $nasa_upload_dir;
    }
    
    $result = array('' => __('Select Your Custom Font.', 'nasa-core'));
    
    $fonts_path = $nasa_upload_dir['basedir'] . '/nasa-custom-fonts';
    
    // Initialize the WP filesystem, no more using 'file-put-contents' function
    if (empty($wp_filesystem)) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }
    
    if (!$wp_filesystem->is_dir($fonts_path)) {
        if (!wp_mkdir_p($fonts_path)){
            return $result;
        }
    }
    
    $list = $wp_filesystem->dirlist($fonts_path);
    if (!empty($list)) {
        foreach ($list as $key => $value) {
            if (isset($value['type']) && $value['type'] === 'd') {
                $result[$key] = $key;
            }
        }
    }
    
    return $result;
}

/**
 * Get Google fonts
 */
function nasa_get_google_fonts() {
    return apply_filters('nasa_google_fonts_support', array(
        '' => 'Theme Default',
        'Arial' => 'Arial',
        'Verdana' => 'Verdana, Geneva',
        'Trebuchet' => 'Trebuchet',
        'Trebuchet Ms' => 'Trebuchet MS',
        'Georgia' => 'Georgia',
        'Times New Roman' => 'Times New Roman',
        'Tahoma' => 'Tahoma, Geneva',
        'Helvetica' => 'Helvetica',
        'Abel' => 'Abel',
        'Abril Fatface' => 'Abril Fatface',
        'Aclonica' => 'Aclonica',
        'Acme' => 'Acme',
        'Actor' => 'Actor',
        'Adamina' => 'Adamina',
        'Advent Pro' => 'Advent Pro',
        'Aguafina Script' => 'Aguafina Script',
        'Aladin' => 'Aladin',
        'Aldrich' => 'Aldrich',
        'Alegreya' => 'Alegreya',
        'Alegreya SC' => 'Alegreya SC',
        'Alex Brush' => 'Alex Brush',
        'Alfa Slab One' => 'Alfa Slab One',
        'Alice' => 'Alice',
        'Alike' => 'Alike',
        'Alike Angular' => 'Alike Angular',
        'Allan' => 'Allan',
        'Allerta' => 'Allerta',
        'Allerta Stencil' => 'Allerta Stencil',
        'Allura' => 'Allura',
        'Almarai' => 'Almarai',
        'Almendra' => 'Almendra',
        'Almendra SC' => 'Almendra SC',
        'Amaranth' => 'Amaranth',
        'Amatic SC' => 'Amatic SC',
        'Amethysta' => 'Amethysta',
        'Amiri' => 'Amiri',
        'Andada' => 'Andada',
        'Andika' => 'Andika',
        'Angkor' => 'Angkor',
        'Annie Use Your Telescope' => 'Annie Use Your Telescope',
        'Anonymous Pro' => 'Anonymous Pro',
        'Antic' => 'Antic',
        'Antic Didone' => 'Antic Didone',
        'Antic Slab' => 'Antic Slab',
        'Anton' => 'Anton',
        'Arapey' => 'Arapey',
        'Arbutus' => 'Arbutus',
        'Architects Daughter' => 'Architects Daughter',
        'Aref Ruqaa' => 'Aref Ruqaa',
        'Arimo' => 'Arimo',
        'Arizonia' => 'Arizonia',
        'Armata' => 'Armata',
        'Artifika' => 'Artifika',
        'Arvo' => 'Arvo',
        'Asap' => 'Asap',
        'Asset' => 'Asset',
        'Astloch' => 'Astloch',
        'Asul' => 'Asul',
        'Atomic Age' => 'Atomic Age',
        'Aubrey' => 'Aubrey',
        'Audiowide' => 'Audiowide',
        'Average' => 'Average',
        'Averia Gruesa Libre' => 'Averia Gruesa Libre',
        'Averia Libre' => 'Averia Libre',
        'Averia Sans Libre' => 'Averia Sans Libre',
        'Averia Serif Libre' => 'Averia Serif Libre',
        'Bad Script' => 'Bad Script',
        'Baloo Bhaijaan' => 'Baloo Bhaijaan',
        'Balthazar' => 'Balthazar',
        'Bangers' => 'Bangers',
        'Basic' => 'Basic',
        'Battambang' => 'Battambang',
        'Baumans' => 'Baumans',
        'Bayon' => 'Bayon',
        'Belgrano' => 'Belgrano',
        'Belleza' => 'Belleza',
        'Bentham' => 'Bentham',
        'Berkshire Swash' => 'Berkshire Swash',
        'Bevan' => 'Bevan',
        'Bigshot One' => 'Bigshot One',
        'Bilbo' => 'Bilbo',
        'Bilbo Swash Caps' => 'Bilbo Swash Caps',
        'Bitter' => 'Bitter',
        'Black Ops One' => 'Black Ops One',
        'Bokor' => 'Bokor',
        'Bonbon' => 'Bonbon',
        'Boogaloo' => 'Boogaloo',
        'Bowlby One' => 'Bowlby One',
        'Bowlby One SC' => 'Bowlby One SC',
        'Brawler' => 'Brawler',
        'Bree Serif' => 'Bree Serif',
        'Bubblegum Sans' => 'Bubblegum Sans',
        'Buda' => 'Buda',
        'Buenard' => 'Buenard',
        'Butcherman' => 'Butcherman',
        'Butterfly Kids' => 'Butterfly Kids',
        'Cabin' => 'Cabin',
        'Cabin Condensed' => 'Cabin Condensed',
        'Cabin Sketch' => 'Cabin Sketch',
        'Caesar Dressing' => 'Caesar Dressing',
        'Cagliostro' => 'Cagliostro',
        'Cairo' => 'Cairo',
        'Calligraffitti' => 'Calligraffitti',
        'Cambo' => 'Cambo',
        'Candal' => 'Candal',
        'Cantarell' => 'Cantarell',
        'Cantata One' => 'Cantata One',
        'Cardo' => 'Cardo',
        'Carme' => 'Carme',
        'Carter One' => 'Carter One',
        'Caudex' => 'Caudex',
        'Cedarville Cursive' => 'Cedarville Cursive',
        'Ceviche One' => 'Ceviche One',
        'Changa' => 'Changa',
        'Changa One' => 'Changa One',
        'Chango' => 'Chango',
        'Chau Philomene One' => 'Chau Philomene One',
        'Chelsea Market' => 'Chelsea Market',
        'Chenla' => 'Chenla',
        'Cherry Cream Soda' => 'Cherry Cream Soda',
        'Chewy' => 'Chewy',
        'Chicle' => 'Chicle',
        'Chivo' => 'Chivo',
        'Coda' => 'Coda',
        'Coda Caption' => 'Coda Caption',
        'Codystar' => 'Codystar',
        'Comfortaa' => 'Comfortaa',
        'Coming Soon' => 'Coming Soon',
        'Concert One' => 'Concert One',
        'Condiment' => 'Condiment',
        'Content' => 'Content',
        'Contrail One' => 'Contrail One',
        'Convergence' => 'Convergence',
        'Cookie' => 'Cookie',
        'Copse' => 'Copse',
        'Corben' => 'Corben',
        'Cousine' => 'Cousine',
        'Coustard' => 'Coustard',
        'Covered By Your Grace' => 'Covered By Your Grace',
        'Crafty Girls' => 'Crafty Girls',
        'Creepster' => 'Creepster',
        'Crete Round' => 'Crete Round',
        'Crimson Text' => 'Crimson Text',
        'Crushed' => 'Crushed',
        'Cuprum' => 'Cuprum',
        'Cutive' => 'Cutive',
        'Damion' => 'Damion',
        'Dancing Script' => 'Dancing Script',
        'Dangrek' => 'Dangrek',
        'Dawning of a New Day' => 'Dawning of a New Day',
        'Days One' => 'Days One',
        'Delius' => 'Delius',
        'Delius Swash Caps' => 'Delius Swash Caps',
        'Delius Unicase' => 'Delius Unicase',
        'Della Respira' => 'Della Respira',
        'Devonshire' => 'Devonshire',
        'Didact Gothic' => 'Didact Gothic',
        'Diplomata' => 'Diplomata',
        'Diplomata SC' => 'Diplomata SC',
        'Doppio One' => 'Doppio One',
        'Dorsa' => 'Dorsa',
        'Dosis' => 'Dosis',
        'Dr Sugiyama' => 'Dr Sugiyama',
        'Droid Sans' => 'Droid Sans',
        'Droid Sans Mono' => 'Droid Sans Mono',
        'Droid Serif' => 'Droid Serif',
        'Duru Sans' => 'Duru Sans',
        'Dynalight' => 'Dynalight',
        'EB Garamond' => 'EB Garamond',
        'Eater' => 'Eater',
        'Economica' => 'Economica',
        'El Messiri' => 'El Messiri',
        'Electrolize' => 'Electrolize',
        'Emblema One' => 'Emblema One',
        'Emilys Candy' => 'Emilys Candy',
        'Engagement' => 'Engagement',
        'Enriqueta' => 'Enriqueta',
        'Epilogue' => 'Epilogue',
        'Erica One' => 'Erica One',
        'Esteban' => 'Esteban',
        'Euphoria Script' => 'Euphoria Script',
        'Ewert' => 'Ewert',
        'Exo' => 'Exo',
        'Exo 2' => 'Exo 2',
        'Expletus Sans' => 'Expletus Sans',
        'Fanwood Text' => 'Fanwood Text',
        'Fascinate' => 'Fascinate',
        'Fascinate Inline' => 'Fascinate Inline',
        'Federant' => 'Federant',
        'Federo' => 'Federo',
        'Felipa' => 'Felipa',
        'Fjord One' => 'Fjord One',
        'Flamenco' => 'Flamenco',
        'Flavors' => 'Flavors',
        'Fondamento' => 'Fondamento',
        'Fontdiner Swanky' => 'Fontdiner Swanky',
        'Forum' => 'Forum',
        'Fjalla One' => 'Fjalla One',
        'Francois One' => 'Francois One',
        'Fredericka the Great' => 'Fredericka the Great',
        'Fredoka One' => 'Fredoka One',
        'Freehand' => 'Freehand',
        'Fresca' => 'Fresca',
        'Frijole' => 'Frijole',
        'Fugaz One' => 'Fugaz One',
        'GFS Didot' => 'GFS Didot',
        'GFS Neohellenic' => 'GFS Neohellenic',
        'Galdeano' => 'Galdeano',
        'Gentium Basic' => 'Gentium Basic',
        'Gentium Book Basic' => 'Gentium Book Basic',
        'Geo' => 'Geo',
        'Geostar' => 'Geostar',
        'Geostar Fill' => 'Geostar Fill',
        'Germania One' => 'Germania One',
        'Gilda Display' => 'Gilda Display',
        'Give You Glory' => 'Give You Glory',
        'Glass Antiqua' => 'Glass Antiqua',
        'Glegoo' => 'Glegoo',
        'Gloria Hallelujah' => 'Gloria Hallelujah',
        'Goblin One' => 'Goblin One',
        'Gochi Hand' => 'Gochi Hand',
        'Gorditas' => 'Gorditas',
        'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
        'Graduate' => 'Graduate',
        'Gravitas One' => 'Gravitas One',
        'Great Vibes' => 'Great Vibes',
        'Gruppo' => 'Gruppo',
        'Gudea' => 'Gudea',
        'Habibi' => 'Habibi',
        'Hammersmith One' => 'Hammersmith One',
        'Handwin' => 'Handwin',
        'Hanuman' => 'Hanuman',
        'Happy Monkey' => 'Happy Monkey',
        'Harmattan' => 'Harmattan',
        'Henny Penny' => 'Henny Penny',
        'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
        'Hind' => 'Hind',
        'Holtwood One SC' => 'Holtwood One SC',
        'Homemade Apple' => 'Homemade Apple',
        'Homenaje' => 'Homenaje',
        'IBM Plex Sans' => 'IBM Plex Sans',
        'IBM Plex Sans Arabic' => 'IBM Plex Sans Arabic',
        'IM Fell DW Pica' => 'IM Fell DW Pica',
        'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
        'IM Fell Double Pica' => 'IM Fell Double Pica',
        'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
        'IM Fell English' => 'IM Fell English',
        'IM Fell English SC' => 'IM Fell English SC',
        'IM Fell French Canon' => 'IM Fell French Canon',
        'IM Fell French Canon SC' => 'IM Fell French Canon SC',
        'IM Fell Great Primer' => 'IM Fell Great Primer',
        'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
        'Iceberg' => 'Iceberg',
        'Iceland' => 'Iceland',
        'Imprima' => 'Imprima',
        'Inconsolata' => 'Inconsolata',
        'Inder' => 'Inder',
        'Indie Flower' => 'Indie Flower',
        'Inika' => 'Inika',
        'Inter' => 'Inter',
        'Irish Grover' => 'Irish Grover',
        'Istok Web' => 'Istok Web',
        'Italiana' => 'Italiana',
        'Italianno' => 'Italianno',
        'Jim Nightshade' => 'Jim Nightshade',
        'Jockey One' => 'Jockey One',
        'Jolly Lodger' => 'Jolly Lodger',
        'Jomhuria' => 'Jomhuria',
        'Josefin Sans' => 'Josefin Sans',
        'Josefin Slab' => 'Josefin Slab',
        'Jost' => 'Jost',
        'Judson' => 'Judson',
        'Junge' => 'Junge',
        'Jura' => 'Jura',
        'Just Another Hand' => 'Just Another Hand',
        'Just Me Again Down Here' => 'Just Me Again Down Here',
        'Kameron' => 'Kameron',
        'Karla' => 'Karla',
        'Katibeh' => 'Katibeh',
        'Kaushan Script' => 'Kaushan Script',
        'Kelly Slab' => 'Kelly Slab',
        'Kenia' => 'Kenia',
        'Khmer' => 'Khmer',
        'Knewave' => 'Knewave',
        'Kotta One' => 'Kotta One',
        'Koulen' => 'Koulen',
        'Kranky' => 'Kranky',
        'Kreon' => 'Kreon',
        'Kristi' => 'Kristi',
        'Krona One' => 'Krona One',
        'La Belle Aurore' => 'La Belle Aurore',
        'Lalezar' => 'Lalezar',
        'Lancelot' => 'Lancelot',
        'Lateef' => 'Lateef',
        'Lato' => 'Lato',
        'League Script' => 'League Script',
        'Leckerli One' => 'Leckerli One',
        'Ledger' => 'Ledger',
        'Lekton' => 'Lekton',
        'Lemon' => 'Lemon',
        'Lemonada' => 'Lemonada',
        'Libre Baskerville' => 'Libre Baskerville',
        'Lilita One' => 'Lilita One',
        'Limelight' => 'Limelight',
        'Linden Hill' => 'Linden Hill',
        'Lobster' => 'Lobster',
        'Lobster Two' => 'Lobster Two',
        'Londrina Outline' => 'Londrina Outline',
        'Londrina Shadow' => 'Londrina Shadow',
        'Londrina Sketch' => 'Londrina Sketch',
        'Londrina Solid' => 'Londrina Solid',
        'Lora' => 'Lora',
        'Love Ya Like A Sister' => 'Love Ya Like A Sister',
        'Loved by the King' => 'Loved by the King',
        'Lovers Quarrel' => 'Lovers Quarrel',
        'Luckiest Guy' => 'Luckiest Guy',
        'Lusitana' => 'Lusitana',
        'Lustria' => 'Lustria',
        'Outfit' => 'Outfit',
        'Macondo' => 'Macondo',
        'Macondo Swash Caps' => 'Macondo Swash Caps',
        'Mada' => 'Mada',
        'Magra' => 'Magra',
        'Maiden Orange' => 'Maiden Orange',
        'Mako' => 'Mako',
        'Manrope' => 'Manrope',
        'Marcellus' => 'Marcellus',
        'Marcellus SC' => 'Marcellus SC',
        'Marck Script' => 'Marck Script',
        'Marko One' => 'Marko One',
        'Marmelad' => 'Marmelad',
        'Martel' => 'Martel',
        'Marvel' => 'Marvel',
        'Mate' => 'Mate',
        'Mate SC' => 'Mate SC',
        'Maven Pro' => 'Maven Pro',
        'Meddon' => 'Meddon',
        'MedievalSharp' => 'MedievalSharp',
        'Medula One' => 'Medula One',
        'Megrim' => 'Megrim',
        'Merienda One' => 'Merienda One',
        'Merriweather' => 'Merriweather',
        'Metal' => 'Metal',
        'Metamorphous' => 'Metamorphous',
        'Metrophobic' => 'Metrophobic',
        'Michroma' => 'Michroma',
        'Miltonian' => 'Miltonian',
        'Miltonian Tattoo' => 'Miltonian Tattoo',
        'Miniver' => 'Miniver',
        'Mirza' => 'Mirza',
        'Miss Fajardose' => 'Miss Fajardose',
        'Modern Antiqua' => 'Modern Antiqua',
        'Molengo' => 'Molengo',
        'Monofett' => 'Monofett',
        'Monoton' => 'Monoton',
        'Monsieur La Doulaise' => 'Monsieur La Doulaise',
        'Montaga' => 'Montaga',
        'Montez' => 'Montez',
        'Montserrat' => 'Montserrat',
        'Montserrat Alternates' => 'Montserrat Alternates',
        'Montserrat Subrayada' => 'Montserrat Subrayada',
        'Moul' => 'Moul',
        'Moulpali' => 'Moulpali',
        'Mountains of Christmas' => 'Mountains of Christmas',
        'Mr Bedfort' => 'Mr Bedfort',
        'Mr Dafoe' => 'Mr Dafoe',
        'Mr De Haviland' => 'Mr De Haviland',
        'Mrs Saint Delafield' => 'Mrs Saint Delafield',
        'Mrs Sheppards' => 'Mrs Sheppards',
        'Muli' => 'Muli',
        'Mystery Quest' => 'Mystery Quest',
        'Neucha' => 'Neucha',
        'Neuton' => 'Neuton',
        'News Cycle' => 'News Cycle',
        'Niconne' => 'Niconne',
        'Nixie One' => 'Nixie One',
        'Nobile' => 'Nobile',
        'Nokora' => 'Nokora',
        'Norican' => 'Norican',
        'Nosifer' => 'Nosifer',
        'Nothing You Could Do' => 'Nothing You Could Do',
        'Noticia Text' => 'Noticia Text',
        'Noto Kufi Arabic' => 'Noto Kufi Arabic',
        'Noto Naskh Arabic' => 'Noto Naskh Arabic',
        'Noto Nastaliq Urdu' => 'Noto Nastaliq Urdu',
        'Noto Sans' => 'Noto Sans',
        'Noto Sans Arabic' => 'Noto Sans Arabic',
        'Noto Sans JP' => 'Noto Sans Japanese',
        'Noto Sans KR' => 'Noto Sans Korean',
        'Noto Sans SC' => 'Noto Sans Simplified Chinese',
        'Noto Sans TC' => 'Noto Sans Traditional Chinese',
        'Nova Cut' => 'Nova Cut',
        'Nova Flat' => 'Nova Flat',
        'Nova Mono' => 'Nova Mono',
        'Nova Oval' => 'Nova Oval',
        'Nova Round' => 'Nova Round',
        'Nova Script' => 'Nova Script',
        'Nova Slim' => 'Nova Slim',
        'Nova Square' => 'Nova Square',
        'Numans' => 'Numans',
        'Nunito' => 'Nunito',
        'Nunito Sans' => 'Nunito Sans',
        'Odor Mean Chey' => 'Odor Mean Chey',
        'Old Standard TT' => 'Old Standard TT',
        'Oldenburg' => 'Oldenburg',
        'Oleo Script' => 'Oleo Script',
        'Open Sans' => 'Open Sans',
        'Open Sans Condensed' => 'Open Sans Condensed',
        'Orbitron' => 'Orbitron',
        'Original Surfer' => 'Original Surfer',
        'Oswald' => 'Oswald',
        'Over the Rainbow' => 'Over the Rainbow',
        'Overlock' => 'Overlock',
        'Overlock SC' => 'Overlock SC',
        'Ovo' => 'Ovo',
        'Oxygen' => 'Oxygen',
        'Poppins' => 'Poppins',
        'PT Mono' => 'PT Mono',
        'PT Sans' => 'PT Sans',
        'PT Sans Caption' => 'PT Sans Caption',
        'PT Sans Narrow' => 'PT Sans Narrow',
        'PT Serif' => 'PT Serif',
        'PT Serif Caption' => 'PT Serif Caption',
        'Pacifico' => 'Pacifico',
        'Parisienne' => 'Parisienne',
        'Passero One' => 'Passero One',
        'Passion One' => 'Passion One',
        'Patrick Hand' => 'Patrick Hand',
        'Patua One' => 'Patua One',
        'Paytone One' => 'Paytone One',
        'Permanent Marker' => 'Permanent Marker',
        'Petrona' => 'Petrona',
        'Philosopher' => 'Philosopher',
        'Piedra' => 'Piedra',
        'Pinyon Script' => 'Pinyon Script',
        'Plaster' => 'Plaster',
        'Play' => 'Play',
        'Playball' => 'Playball',
        'Playfair Display' => 'Playfair Display',
        'Plus Jakarta Sans' => 'Plus Jakarta Sans',
        'Podkova' => 'Podkova',
        'Poiret One' => 'Poiret One',
        'Poller One' => 'Poller One',
        'Poly' => 'Poly',
        'Pompiere' => 'Pompiere',
        'Pontano Sans' => 'Pontano Sans',
        'Port Lligat Sans' => 'Port Lligat Sans',
        'Port Lligat Slab' => 'Port Lligat Slab',
        'Prata' => 'Prata',
        'Preahvihear' => 'Preahvihear',
        'Press Start 2P' => 'Press Start 2P',
        'Princess Sofia' => 'Princess Sofia',
        'Prociono' => 'Prociono',
        'Prosto One' => 'Prosto One',
        'Puritan' => 'Puritan',
        'Quantico' => 'Quantico',
        'Quattrocento' => 'Quattrocento',
        'Quattrocento Sans' => 'Quattrocento Sans',
        'Questrial' => 'Questrial',
        'Quicksand' => 'Quicksand',
        'Qwigley' => 'Qwigley',
        'Radley' => 'Radley',
        'Rajdhani' => 'Rajdhani',
        'Rakkas' => 'Rakkas',
        'Raleway' => 'Raleway',
        'Rammetto One' => 'Rammetto One',
        'Rancho' => 'Rancho',
        'Rationale' => 'Rationale',
        'Readex Pro' => 'Readex Pro',
        'Red Hat Display' => 'Red Hat Display',
        'Reddit Sans' => 'Reddit Sans',
        'Reddit Sans Condensed' => 'Reddit Sans Condensed',
        'Redressed' => 'Redressed',
        'Reem Kufi' => 'Reem Kufi',
        'Reenie Beanie' => 'Reenie Beanie',
        'Revalia' => 'Revalia',
        'Ribeye' => 'Ribeye',
        'Ribeye Marrow' => 'Ribeye Marrow',
        'Righteous' => 'Righteous',
        'Roboto' => 'Roboto',
        'Roboto Sans' => 'Roboto Sans',
        'Rochester' => 'Rochester',
        'Rock Salt' => 'Rock Salt',
        'Rokkitt' => 'Rokkitt',
        'Ropa Sans' => 'Ropa Sans',
        'Rosario' => 'Rosario',
        'Rosarivo' => 'Rosarivo',
        'Rouge Script' => 'Rouge Script',
        'Rubik' => 'Rubik',
        'Ruda' => 'Ruda',
        'Ruge Boogie' => 'Ruge Boogie',
        'Ruluko' => 'Ruluko',
        'Rum Raisin' => 'Rum Raisin',
        'Ruslan Display' => 'Ruslan Display',
        'Russo One' => 'Russo One',
        'Ruthie' => 'Ruthie',
        'Sacramento' => 'Sacramento',
        'Sail' => 'Sail',
        'Saira Condensed' => 'Saira Condensed',
        'Salsa' => 'Salsa',
        'Sancreek' => 'Sancreek',
        'Sansita One' => 'Sansita One',
        'Sarina' => 'Sarina',
        'Satisfy' => 'Satisfy',
        'Scheherazade' => 'Scheherazade',
        'Schibsted Grotesk' => 'Schibsted Grotesk',
        'Schoolbell' => 'Schoolbell',
        'Seaweed Script' => 'Seaweed Script',
        'Sevillana' => 'Sevillana',
        'Seymour One' => 'Seymour One',
        'Shadows Into Light' => 'Shadows Into Light',
        'Shadows Into Light Two' => 'Shadows Into Light Two',
        'Shanti' => 'Shanti',
        'Share' => 'Share',
        'Shojumaru' => 'Shojumaru',
        'Short Stack' => 'Short Stack',
        'Siemreap' => 'Siemreap',
        'Sigmar One' => 'Sigmar One',
        'Signika' => 'Signika',
        'Signika Negative' => 'Signika Negative',
        'Simonetta' => 'Simonetta',
        'Sirin Stencil' => 'Sirin Stencil',
        'Six Caps' => 'Six Caps',
        'Slackey' => 'Slackey',
        'Smokum' => 'Smokum',
        'Smythe' => 'Smythe',
        'Sniglet' => 'Sniglet',
        'Snippet' => 'Snippet',
        'Sofia' => 'Sofia',
        'Sonsie One' => 'Sonsie One',
        'Sorts Mill Goudy' => 'Sorts Mill Goudy',
        'Special Elite' => 'Special Elite',
        'Spicy Rice' => 'Spicy Rice',
        'Spinnaker' => 'Spinnaker',
        'Spirax' => 'Spirax',
        'Squada One' => 'Squada One',
        'Stardos Stencil' => 'Stardos Stencil',
        'Stint Ultra Condensed' => 'Stint Ultra Condensed',
        'Stint Ultra Expanded' => 'Stint Ultra Expanded',
        'Stoke' => 'Stoke',
        'Sue Ellen Francisco' => 'Sue Ellen Francisco',
        'Sunshiney' => 'Sunshiney',
        'Supermercado One' => 'Supermercado One',
        'Suwannaphum' => 'Suwannaphum',
        'Swanky and Moo Moo' => 'Swanky and Moo Moo',
        'Syncopate' => 'Syncopate',
        'Tajawal' => 'Tajawal',
        'Tangerine' => 'Tangerine',
        'Taprom' => 'Taprom',
        'Teachers' => 'Teachers',
        'Telex' => 'Telex',
        'Tenor Sans' => 'Tenor Sans',
        'The Girl Next Door' => 'The Girl Next Door',
        'Tienne' => 'Tienne',
        'Tinos' => 'Tinos',
        'Titan One' => 'Titan One',
        'Titillium Web' => 'Titillium Web',
        'Trade Winds' => 'Trade Winds',
        'Trocchi' => 'Trocchi',
        'Trochut' => 'Trochut',
        'Trykker' => 'Trykker',
        'Tulpen One' => 'Tulpen One',
        'Ubuntu' => 'Ubuntu',
        'Ubuntu Condensed' => 'Ubuntu Condensed',
        'Ubuntu Mono' => 'Ubuntu Mono',
        'Ultra' => 'Ultra',
        'Uncial Antiqua' => 'Uncial Antiqua',
        'UnifrakturCook' => 'UnifrakturCook',
        'UnifrakturMaguntia' => 'UnifrakturMaguntia',
        'Unkempt' => 'Unkempt',
        'Unlock' => 'Unlock',
        'Unna' => 'Unna',
        'VT323' => 'VT323',
        'Varela' => 'Varela',
        'Varela Round' => 'Varela Round',
        'Vast Shadow' => 'Vast Shadow',
        'Vibur' => 'Vibur',
        'Vidaloka' => 'Vidaloka',
        'Viga' => 'Viga',
        'Voces' => 'Voces',
        'Volkhov' => 'Volkhov',
        'Vollkorn' => 'Vollkorn',
        'Voltaire' => 'Voltaire',
        'Waiting for the Sunrise' => 'Waiting for the Sunrise',
        'Wallpoet' => 'Wallpoet',
        'Walter Turncoat' => 'Walter Turncoat',
        'Wellfwint' => 'Wellfwint',
        'Wire One' => 'Wire One',
        'Wix Madefor Display' => 'Wix Madefor Display',
        'Work Sans' => 'Work Sans',
        'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
        'Yellowtail' => 'Yellowtail',
        'Yeseva One' => 'Yeseva One',
        'Yesteryear' => 'Yesteryear',
        'Zeyada' => 'Zeyada',
    ));
}

/**
 * Clear cache variations
 */
add_action('wp_ajax_nasa_clear_all_cache', 'nasa_manual_clear_cache');
function nasa_manual_clear_cache() {
    try {
        /**
         * Hook before delete all cache
         */
        do_action('nasa_before_delete_all_cache');
        
        /**
         * Clear Transients deal ids
         */
        nasa_clear_transients_products_deal_ids();

        /**
         * Clear cache variations
         */
        nasa_del_cache_variations();

        /**
         * Clear cache quickview
         */
        nasa_del_cache_quickview();

        /**
         * Clear cache short-codes
         */
        nasa_del_cache_shortcodes();
        
        /**
         * Hook after delete all cache
         */
        do_action('nasa_after_delete_all_cache');
        
        $delete = true;
    } catch (Exception $exc) {
        $delete = false;
    }
    
    if ($delete) {
        die('ok');
    }
    
    die('fail');
}

/**
 * Clear Fake Sold
 */
add_action('wp_ajax_nasa_clear_fake_sold', 'nasa_clear_fake_sold');
function nasa_clear_fake_sold() {
    try {
        global $wpdb;
    
        $wpdb->query('DELETE FROM ' . $wpdb->options . ' WHERE `option_name` LIKE "_transient_nasa_fake_sold%" OR `option_name` LIKE "_transient_timeout_nasa_fake_sold%"');
        
        $delete = true;
    } catch (Exception $exc) {
        $delete = false;
    }
    
    if ($delete) {
        die('ok');
    }
    
    die('fail');
}

/**
 * Clear Fake In Cart
 */
add_action('wp_ajax_nasa_clear_fake_incart', 'nasa_clear_fake_incart');
function nasa_clear_fake_incart() {
    try {
        global $wpdb;
    
        $wpdb->query('DELETE FROM ' . $wpdb->options . ' WHERE `option_name` LIKE "_transient_nasa_fake_in_cart%" OR `option_name` LIKE "_transient_timeout_nasa_fake_in_cart%"');
        
        $delete = true;
    } catch (Exception $exc) {
        $delete = false;
    }
    
    if ($delete) {
        die('ok');
    }
    
    die('fail');
}

/**
 * Style | Script in Back End
 */
add_action('admin_enqueue_scripts', 'nasa_admin_style_script_fw');
function nasa_admin_style_script_fw() {
    wp_enqueue_style('nasa_back_end-css', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-style.css', array(), '6.1.0');
    wp_enqueue_script('nasa_back_end-script', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-script.js', array(), '6.1.0', true);
    $nasa_core_js = 'var ajax_admin_nasa_core="' . esc_url(admin_url('admin-ajax.php')) . '";';
    wp_add_inline_script('nasa_back_end-script', $nasa_core_js, 'before');
}

/**
 * Style | Script in Back End - Elementor Preview
 */
add_action('elementor/editor/after_enqueue_styles', 'nasa_elementor_admin_enqueues');
function nasa_elementor_admin_enqueues() {
    wp_enqueue_style('nasa_back_end-elem-css', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-elm-side-style.css');
}
