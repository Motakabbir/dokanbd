<?php
/*
 * Product group button
 */

/**
 * Before tag wrap
 */
do_action('nasa_before_show_buttons_loop');

/**
 * Open tag wrap
 */
echo '<div class="nasa-product-grid nasa-group-btns nasa-btns-product-item">';

/**
 * Content tag wrap
 */
do_action('nasa_show_buttons_loop');

/**
 * Close tag wrap
 */
echo '</div>';

/**
 * After tag wrap
 */
do_action('nasa_after_show_buttons_loop'); // after loop btn
