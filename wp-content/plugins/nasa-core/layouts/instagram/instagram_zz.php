<?php
$ulclass = 'instagram-pics instagram-size-large';
$aclass = 'instagram-a nasa-instagram-link';
$imgclass = 'instagram-img nasa-instagram-img nasa-not-set';
$imgclass .= $el_class_img ? ' ' . $el_class_img : '';

$class = 'nasa-instagram nasa-instagram-ziczac';
$class .= ' items-' . $columns_number;
$class .= ' items-tablet-' . $columns_number_tablet;
$class .= ' items-mobile-' . $columns_number_small;
// $class .= $el_class ? ' ' . $el_class : '';

echo '<div class="nasa-intagram-wrap' . ($el_class != '' ? ' ' . $el_class : '') . '" data-layout="ziczac" data-size="' . $width . '">';

echo '<div class="nasa-from-instagram-feed hidden-tag">' . do_shortcode($shortcode_text) . '</div>';

echo '<div class="' . $class . '">';

if ($username_show || $instagram_link) :
    echo $instagram_link ? '<a href="' . esc_url($instagram_link) . '" rel="me" target="_blank" title="' . esc_attr__('Follow us on Instagram', 'nasa-core') . '">' : '';

    echo '<div class="username-text nasa-flex"><svg viewBox="0 0 48 48" width="18" height="18" fill="currentColor"><path d="M 16.5 5 C 10.16639 5 5 10.16639 5 16.5 L 5 31.5 C 5 37.832757 10.166209 43 16.5 43 L 31.5 43 C 37.832938 43 43 37.832938 43 31.5 L 43 16.5 C 43 10.166209 37.832757 5 31.5 5 L 16.5 5 z M 16.5 8 L 31.5 8 C 36.211243 8 40 11.787791 40 16.5 L 40 31.5 C 40 36.211062 36.211062 40 31.5 40 L 16.5 40 C 11.787791 40 8 36.211243 8 31.5 L 8 16.5 C 8 11.78761 11.78761 8 16.5 8 z M 34 12 C 32.895 12 32 12.895 32 14 C 32 15.105 32.895 16 34 16 C 35.105 16 36 15.105 36 14 C 36 12.895 35.105 12 34 12 z M 24 14 C 18.495178 14 14 18.495178 14 24 C 14 29.504822 18.495178 34 24 34 C 29.504822 34 34 29.504822 34 24 C 34 18.495178 29.504822 14 24 14 z M 24 17 C 27.883178 17 31 20.116822 31 24 C 31 27.883178 27.883178 31 24 31 C 20.116822 31 17 27.883178 17 24 C 17 20.116822 20.116822 17 24 17 z"/></svg><span class="hide-for-small">' . $username_show . '</span></div>';

    echo $instagram_link ? '</a>' : '';
endif;

echo '<ul class="' . esc_attr($ulclass) . '">';

for ($i = 0; $i < $limit_items; $i++) :
    $liclass = 'instagram-li nasa-instagram-item';
    $liclass .= ($i+1)%2 == 1 ? ' nasa-odd' : ' nasa-even';

    echo '<li class="' . esc_attr($liclass) . '">';
        echo '<a href="#" target="_blank" class="' . esc_attr($aclass) . '" rel="nofollow" data-index="' . $i . '">';
            echo '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8Xw8AAoMBgDTD2qgAAAAASUVORK5CYII=" class="' . $imgclass . '" alt="" width="' . $width . '" height="' . $height . '" />';
        echo '</a>';
    echo '</li>';
endfor;

echo '</ul>';

echo '</div></div>';
