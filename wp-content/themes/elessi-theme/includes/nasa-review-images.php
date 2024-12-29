<?php
defined('ABSPATH') || exit;
$svg_zoom = '<svg fill="currentColor" width="18" height="18" viewBox="0 0 32 32">
            <path d="M11.202 4.271v-1.066h-7.997v7.997h1.066v-6.177l7.588 7.588 0.754-0.754-7.588-7.588z"/>
            <path d="M20.798 3.205v1.066h6.177l-7.588 7.588 0.754 0.754 7.588-7.588v6.177h1.066v-7.997z"/>
            <path d="M11.859 19.387l-7.588 7.588v-6.177h-1.066v7.997h7.997v-1.066h-6.177l7.588-7.588z"/>
            <path d="M27.729 26.975l-7.588-7.588-0.754 0.754 7.588 7.588h-6.177v1.066h7.997v-7.997h-1.066z"/>
        </svg>';

$svg_img = '<svg width="15" height="15" viewBox="0 0 24 24" fill="none">
        <path d="M4.02693 18.329C4.18385 19.277 5.0075 20 6 20H18C19.1046 20 20 19.1046 20 18V14.1901M4.02693 18.329C4.00922 18.222 4 18.1121 4 18V6C4 4.89543 4.89543 4 6 4H18C19.1046 4 20 4.89543 20 6V14.1901M4.02693 18.329L7.84762 14.5083C8.52765 13.9133 9.52219 13.8482 10.274 14.3494L10.7832 14.6888C11.5078 15.1719 12.4619 15.1305 13.142 14.5865L15.7901 12.4679C16.4651 11.9279 17.4053 11.8856 18.1228 12.3484C18.2023 12.3997 18.2731 12.4632 18.34 12.5302L20 14.1901M11 9C11 10.1046 10.1046 11 9 11C7.89543 11 7 10.1046 7 9C7 7.89543 7.89543 7 9 7C10.1046 7 11 7.89543 11 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>';
$svg_play = '<svg fill="currentColor" width="25" height="25" viewBox="-2.4 -2.4 64.80 64.80" stroke="currentColor" stroke-width="3">
            <path d="M45.563,29.174l-22-15c-0.307-0.208-0.703-0.231-1.031-0.058C22.205,14.289,22,14.629,22,15v30 c0,0.371,0.205,0.711,0.533,0.884C22.679,45.962,22.84,46,23,46c0.197,0,0.394-0.059,0.563-0.174l22-15 C45.836,30.64,46,30.331,46,30S45.836,29.36,45.563,29.174z M24,43.107V16.893L43.225,30L24,43.107z"></path><path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30 S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z"></path>
            </svg>';
$svg_plus = '<svg width="8" height="8" stroke-width="2" viewBox="5 5 15 15" fill="currentColor">
                <path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>';

$reviews_layout = isset($nasa_opt['single_review_layout']) && $nasa_opt['single_review_layout'] != '' ? $nasa_opt['single_review_layout'] : 'list';
$reviews_layout =  isset($_GET['reviews_layout']) && $_GET['reviews_layout'] != '' ? $_GET['reviews_layout'] : $reviews_layout;

$number_img_review = $number_img_review = apply_filters('nasa_number_img_display_review', 3);
$attachment_ids = get_comment_meta($comment->comment_ID, 'nasa_review_images', true);

$urls = [];
if (!empty($attachment_ids)) :

    $attachment_ids = array_filter( $attachment_ids, function( $attachment_id )  use ( &$urls ) {
        $attachment = get_post( $attachment_id );

        if ( $attachment ) {
            $urls[] = wp_get_attachment_url( $attachment_id, 'full' );
            return true; 
        }
        return false; 
    });

    // $first_attachment_id = reset($attachment_ids);
    $first_three_attachments = array_slice($attachment_ids, 0, $number_img_review);

    ?>
    
    <div    class="nasa-wrap-review-thumb nasa-flex" 
            id="nasa-wrap-review-<?php echo esc_attr($comment->comment_ID); ?>" 
            data-img-review="<?php echo esc_attr__(json_encode($urls))?>">
        <?php 
            foreach ($first_three_attachments as $key => $id_media) {
                $url = wp_get_attachment_url($id_media, 'full');
                $type_file = get_post_mime_type($id_media);
                $firstmedia_class = $key == 0 ? 'nasa-first-media-review' : '';
                $video_play = '';

                if($url) {
                    if (in_array($type_file, array("image/jpg", "image/jpeg", "image/bmp", "image/png", "image/gif", "image/webp"))) {
                        $media = $firstmedia_class == 'nasa-first-media-review' ? wp_get_attachment_image($id_media, 'full', false, array('class' => 'skip-lazy attachment-full size-full nasa-review-media')) : wp_get_attachment_image($id_media, apply_filters('nasa_reivew_product_thumbnail_size', 'fill'), false, array('class' => 'skip-lazy attachment-thumbnail size-thumbnail nasa-review-media'));
                    } else {

                        $media = '<video muted playsinline preload="metadata" class="nasa-review-media" src="' . esc_url($url) . '#t=0.001"><source src="' . esc_url($url) . '" type="'. $type_file .'"></video>';
                        $video_play = $key <= ( $number_img_review - 1 ) ? '<span class="svg-play">' . $svg_play . '</span>' :'';
                        $video_play = ($key == ( $number_img_review - 1 ) && count($attachment_ids) > $number_img_review) ? '' :  $video_play ;
                    }
                }

                ?>
                <a  data-index="<?php echo $key ;?>" 
                    title="<?php echo esc_attr__('Review Product by Images', 'elessi-theme'); ?>" 
                    data-li-id="<?php echo 'li-comment-' . esc_attr( $comment->comment_ID ); ?>" 
                    class="nasa-item-review-thumb crazy-loading <?php echo( $firstmedia_class );?>" 
                    href="<?php echo esc_url( $url ); ?>">

                    <?php echo apply_filters( 'nasa_reivew_product_thumbnail_html', $media, $id_media ) . $video_play; ?>
                    <span class="svg-wrap">
                        <?php echo($svg_zoom);?>
                    </span>
                    <?php 
                        if( $key == ($number_img_review -1) && count($attachment_ids) > $number_img_review ) {
                            echo '<span class="ns-review-img-count">' . $svg_plus . ( count($attachment_ids) - $number_img_review ) . $svg_img . '</span>';
                        }

                        if ( $firstmedia_class == 'nasa-first-media-review' ) {
                            echo '<span class="ns-review-img-count">' . $svg_plus . ( count($attachment_ids) - 1 ) . $svg_img . '</span>';
                        }
                    ?>
                </a>
                <?php
            }
        ?>
    </div>
    
    <?php
endif;