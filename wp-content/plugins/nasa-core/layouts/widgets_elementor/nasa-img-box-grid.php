<?php
$title = isset($instance['title']) ? $instance['title'] : '';
$title_font_size = isset($instance['title_font_size']) ? $instance['title_font_size'] : 'm';

$glb_link = isset($instance['glb_link']) ? $instance['glb_link'] : '';
$glb_link_text = isset($instance['glb_link_text']) ? $instance['glb_link_text'] : '';

$column_number = isset($instance['column_number']) ? $instance['column_number'] : 5;
$column_number_small = isset($instance['column_number_small']) ? $instance['column_number_small'] : 2;
$column_number_tablet = isset($instance['column_number_tablet']) ? $instance['column_number_tablet'] : 4;

$el_class = isset($instance['el_class']) ? $instance['el_class'] : '';

$class_wrap = 'nasa-flex flex-wrap flex-items-' . ((int) $column_number) . ' medium-flex-items-' . ((int) $column_number_tablet) . ' small-flex-items-' . ((int) $column_number_small);
$class_wrap .= $el_class != '' ? ' ' . esc_attr($el_class) : '';
?>

<?php if ($title || $glb_link) :
    $class_title = 'nasa-dft nasa-title margin-bottom-15 nasa-flex jbw flex-wrap align-baseline nasa-' . $title_font_size;
    ?>
    <div class="<?php echo esc_attr($class_title); ?>">
        <h3 class="nasa-heading-title nasa-min-height margin-top-10"><?php echo $title ? esc_attr($title) : ''; ?></h3>

        <?php if ($glb_link) : ?>
            <a href="<?php echo esc_url($glb_link); ?>" class="nasa-bold nasa-flex fs-15 margin-top-10">
                <?php echo $glb_link_text ? $glb_link_text . '&nbsp;&nbsp;' : ''; ?>
                <svg class="nasa-only-ltr primary-color" viewBox="0 0 512 512" width="17" height="17"><path fill="currentColor" d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM281 385c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l71-71L136 280c-13.3 0-24-10.7-24-24s10.7-24 24-24l182.1 0-71-71c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L393 239c9.4 9.4 9.4 24.6 0 33.9L281 385z"/></svg>
                <svg class="nasa-only-rtl primary-color" viewBox="0 0 512 512" width="17" height="17"><path fill="currentColor" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<div class="nasa-image-box-grid">
    <div class="<?php echo $class_wrap; ?>">
        <?php
        foreach ($instance['boxgrid'] as $key => $args) :
            $_this->render_shortcode_text($args);
        endforeach;
        ?>
    </div>
</div>
