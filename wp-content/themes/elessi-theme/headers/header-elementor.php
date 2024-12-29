<?php defined('ABSPATH') or die(); // Exit if accessed directly ?>

<div class="header-wrapper header-type-builder">
    <?php
    /**
     * Hook - top bar header
     */
    // do_action('nasa_topbar_header');
    
    if (isset($nasa_header_hfe) && $nasa_header_hfe) : ?>
        <div class="header-content-builder nasa-header-content-builder">
            <div id="masthead" class="site-header">
                <?php echo $nasa_header_hfe; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
