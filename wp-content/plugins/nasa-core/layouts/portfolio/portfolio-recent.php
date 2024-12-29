<?php 
$postId = get_the_ID();
$categories = wp_get_post_terms($postId, 'categories');
$catsClass = 'wow nasa-slider-item slider-item portfolio-item';

if (!is_wp_error($categories)) :
    foreach ($categories as $category) :
        $catsClass .= ' sort-' . $category->slug;
    endforeach;
endif;

if (!isset($delay)) :
    $delay = 0;
endif;

$lightbox = (!isset($nasa_opt['portfolio_lightbox']) || $nasa_opt['portfolio_lightbox']) ? true : false;

$width = isset($width) ? $width : 400;
$height = isset($height) ? $height : 350;
?>

<div class="<?php echo esc_attr($catsClass); ?>" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($delay); ?>ms">
    <div class="portfolio-image">
        <?php if ($postId) : ?>
            
            <?php $image = nasa_get_image(get_post_thumbnail_id($postId), $width, $height, true); ?>
            
            <?php if ($image) : ?>
                <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
            <?php endif; ?>
            
            <div class="zoom">
                <div class="btn_group">
                    
                    <?php if ($lightbox) : ?>
                        <a href="javascript:void(0);" class="btn portfolio-image-view" data-src="<?php echo nasa_get_image(get_post_thumbnail_id($postId)); ?>" rel="nofollow">
                            <svg width="18" height="18" viewBox="0 0 32 32" fill="currentColor">
                                <path d="M11.202 4.271v-1.066h-7.997v7.997h1.066v-6.177l7.588 7.588 0.754-0.754-7.588-7.588z"/>
                                <path d="M20.798 3.205v1.066h6.177l-7.588 7.588 0.754 0.754 7.588-7.588v6.177h1.066v-7.997z"/>
                                <path d="M11.859 19.387l-7.588 7.588v-6.177h-1.066v7.997h7.997v-1.066h-6.177l7.588-7.588z"/>
                                <path d="M27.729 26.975l-7.588-7.588-0.754 0.754 7.588 7.588h-6.177v1.066h7.997v-7.997h-1.066z"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                    
                    <a href="<?php the_permalink(); ?>" class="btn portfolio-link" title="<?php esc_attr_e('More details', 'nasa-core'); ?>">
                        <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor">
                            <path d="M17.534 20.793c-1.301 0-2.602-0.495-3.592-1.485l0.754-0.754c1.566 1.566 4.112 1.565 5.678 0l6.715-6.716c1.565-1.565 1.565-4.111 0-5.677l-1.251-1.25c-1.565-1.565-4.112-1.565-5.677 0l-4.739 4.739-0.754-0.754 4.739-4.739c1.98-1.981 5.203-1.982 7.185 0l1.251 1.25c1.98 1.981 1.98 5.204 0 7.185l-6.715 6.715c-0.99 0.99-2.292 1.485-3.593 1.485z"/>
                            <path d="M9.001 29.329c-1.357 0-2.633-0.528-3.592-1.488l-1.251-1.25c-1.981-1.982-1.981-5.204 0-7.185l6.716-6.716c1.98-1.98 5.205-1.98 7.185 0l1.251 1.251-0.754 0.754-1.251-1.251c-1.565-1.565-4.112-1.565-5.677 0l-6.716 6.716c-1.564 1.564-1.564 4.111 0 5.677l1.251 1.25c0.758 0.758 1.766 1.176 2.838 1.176s2.080-0.418 2.838-1.176l4.469-4.469 0.754 0.754-4.469 4.469c-0.959 0.96-2.235 1.488-3.592 1.488z"/>
                        </svg>
                    </a>
                    
                </div>
                
                <div class="bg"></div>
            </div>
        <?php endif; ?>
    </div>
</div>
