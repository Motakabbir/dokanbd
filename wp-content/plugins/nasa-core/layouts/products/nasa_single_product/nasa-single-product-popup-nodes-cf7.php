<?php
$content = '';

/**
 * Request a Call Back
 */
if ($request_a_callback) :
    $product_image = isset($product_image) ? $product_image : $single_product->get_image('thumbnail');
    $product_title = isset($product_title) ? $product_title : $single_product->get_name();
    $product_link = isset($product_link) ? $product_link : $single_product->get_permalink();
    $product_price = isset($product_price) ? $product_price : $single_product->get_price_html();
    
    /**
     * Content Popup, add class 'zoom-anim-dialog' into 'nasa-node-content' to add effect flip popup
     */
    $content .= '<div id="nasa-content-request-a-callback" class="nasa-node-content nasa-popup-content-contact hidden-tag">';
    
        /**
         * Product Info
         */
        $content .= '<div class="nasa-flex flex-column nasa-product">';

            $content .= '<div class="nasa-product-img">' . $product_image . '</div>';

            $content .= '<div class="nasa-product-info text-center">';
                /**
                 * Product Name
                 */
                $content .= '<p class="name">' . $product_title . '</p>';

                /**
                 * Product Price
                 */
                if ($product_price) :
                    $content .= '<div class="price">' . $product_price . '</div>';
                endif;
                
                $content .= '<div class="hidden-tag nasa-info-add-form">';
                $content .= '<input type="hidden" name="product-name" value="' . esc_attr($product_title) . '" />';
                $content .= '<input type="hidden" name="product-url" value="' . esc_url($product_link) . '" />';
                $content .= '</div>';
            $content .= '</div>';

        $content .= '</div>';
    
        /**
         * Contact form 7
         */
        $content .= '<div class="nasa-wrap">';

            $content .= '<h3 class="nasa-heading-popup text-center nasa-bold-800 fs-28 mobile-fs-25">';
                $content .= esc_html__('Request a Call Back', 'nasa-core');
            $content .= '</h3>';

            $content .= $request_a_callback;

        $content .= '</div>';
    
    $content .= '</div>';
endif;

/**
 * Ask a Question
 */
if ($ask_a_question) :
    $product_image = isset($product_image) ? $product_image : $single_product->get_image('thumbnail');
    $product_title = isset($product_title) ? $product_title : $single_product->get_name();
    $product_link = isset($product_link) ? $product_link : $single_product->get_permalink();
    $product_price = isset($product_price) ? $product_price : $single_product->get_price_html();
    
    /**
     * Content Popup, add class 'zoom-anim-dialog' into 'nasa-node-content' to add effect flip popup
     */
    $content .= '<div id="nasa-content-ask-a-quetion" class="nasa-node-content nasa-popup-content-contact hidden-tag">';
    
        /**
         * Product Info
         */
        $content .= '<div class="nasa-flex flex-column nasa-product">';

            $content .= '<div class="nasa-product-img">' . $product_image . '</div>';

            $content .= '<div class="nasa-product-info text-center">';
                
                /**
                 * Product Name
                 */
                $content .= '<p class="name">' . $product_title . '</p>';

                /**
                 * Product Price
                 */
                if ($product_price) :
                    $content .= '<div class="price">' . $product_price . '</div>';
                endif;
                
                $content .= '<div class="hidden-tag nasa-info-add-form">';
                $content .= '<input type="hidden" name="product-name" value="' . esc_attr($product_title) . '" />';
                $content .= '<input type="hidden" name="product-url" value="' . esc_url($product_link) . '" />';
                $content .= '</div>';
            $content .= '</div>';

        $content .= '</div>';
    
        /**
         * Contact form 7
         */
        $content .= '<div class="nasa-wrap">';

            $content .= '<h3 class="nasa-heading-popup text-center nasa-bold-800 fs-28 mobile-fs-25">';
                $content .= esc_html__('Ask a Question', 'nasa-core');
            $content .= '</h3>';

            $content .= $ask_a_question;

        $content .= '</div>';
    
    $content .= '</div>';
endif;

/**
 * Output
 */
echo apply_filters('nasa_single_product_popup_nodes_cf7', $content);
