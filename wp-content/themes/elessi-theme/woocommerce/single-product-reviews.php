<?php
/**
 * Display single product reviews (comments)
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 4.3.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly.
endif;

if (!comments_open()) :
    return;
endif;

global $product,$nasa_opt;

$ratings = $product->get_rating_count();
$rating_item = array(
    5 => $product->get_rating_count(5),
    4 => $product->get_rating_count(4),
    3 => $product->get_rating_count(3),
    2 => $product->get_rating_count(2),
    1 => $product->get_rating_count(1)
);

$count = $product->get_review_count();
$sort_type =  isset($_GET['review_sort']) && $_GET['review_sort'] != '' ? $_GET['review_sort'] : 'date_DESC';

if ($sort_type == 'media_DESC') {
    $args_media = array(
        'post_id' => $product->get_id(),
        'meta_query' => array(
            array(
                'key'     => 'nasa_review_images',
                'compare' => 'EXISTS',
            ),
        ),
    );
    
    $reviews_with_media = get_comments($args_media);
    $count_media = count($reviews_with_media);
}

$change_layout_review = in_array(apply_filters('nasa_single_product_tabs_style', '2d-no-border'),array('small-accordion'));

$options_sort = [
    ['Latest', 'date_DESC'],
    ['Oldest', 'date_ASC'],
    ['Media','media_DESC'],
    ['Lowest Rating', 'rating_ASC'],
    ['Highest Rating', 'rating_DESC'],
];

$reviews_layout = isset($nasa_opt['single_review_layout']) && $nasa_opt['single_review_layout'] != '' ? $nasa_opt['single_review_layout'] : 'list';
$reviews_layout =  isset($_GET['reviews_layout']) && $_GET['reviews_layout'] != '' ? $_GET['reviews_layout'] : $reviews_layout;

$reviewForm = (get_option('woocommerce_review_rating_verification_required') === 'no' || wc_customer_bought_product('', get_current_user_id(), $product->get_id())) ? true : false;

$svg_alert = '<svg width="12" height="12" viewBox="0 0 12 13" fill="none">
    <path d="M6 0C2.67188 0 0 2.69531 0 6C0 9.32812 2.67188 12 6 12C9.30469 12 12 9.32812 12 6C12 2.69531 9.30469 0 6 0ZM6 10.875C3.30469 10.875 1.125 8.69531 1.125 6C1.125 3.32812 3.30469 1.125 6 1.125C8.67188 1.125 10.875 3.32812 10.875 6C10.875 8.69531 8.67188 10.875 6 10.875ZM6 7.125C6.30469 7.125 6.5625 6.89062 6.5625 6.5625V3.5625C6.5625 3.25781 6.30469 3 6 3C5.67188 3 5.4375 3.25781 5.4375 3.5625V6.5625C5.4375 6.89062 5.67188 7.125 6 7.125ZM6 7.92188C5.57812 7.92188 5.25 8.25 5.25 8.64844C5.25 9.04688 5.57812 9.375 6 9.375C6.39844 9.375 6.72656 9.04688 6.72656 8.64844C6.72656 8.25 6.39844 7.92188 6 7.92188Z" fill="currentColor"></path>
  </svg>';

$required_alert = '<span class="nasa-error">' . $svg_alert . esc_html__('This field is required.', 'elessi-theme') . '</span>';
$invalid_alert = '<span class="nasa-invalid-field nasa-error">' . $svg_alert . esc_html__('Please enter a valid email address.', 'elessi-theme') . '</span>';

$classStatistic = 'nasa-statistic-ratings';
if (!$reviewForm) :
    $classStatistic .= ' fullwidth';
endif;

?>
<div id="reviews" class="woocommerce-Reviews">
    <!-- Show statistic Ratings -->
    <div class="<?php echo esc_attr($classStatistic); ?>">
        <?php /* h2>
            <?php echo esc_html__('Customer reviews', 'elessi-theme'); ?>
        </h2 */?>
        <div class="nasa-avg-rating">
            <span class="avg-rating-number">
                <?php echo 0 < $count ? $product->get_average_rating() : '0.00'; ?>
            </span>
            <div class="star-rating">
                <span style="width: <?php echo 0 < $count ? esc_attr($product->get_average_rating()/5 * 100) : 0; ?>%"></span>
            </div>
            
            <?php echo sprintf(esc_html__('%s reviews', 'elessi-theme'), $count); ?>
        </div>

        <table class="nasa-rating-bars">
            <tbody>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <?php
                    echo '<!-- ' . $i . ' stars -->';
                    $per = ($ratings > 0 && isset($rating_item[$i])) ? round($rating_item[$i] / $ratings * 100, 2) : 0;
                    ?>

                    <tr class="nasa-rating-bar">
                        <td class="star-rating-wrap">
                            <span>
                                <?php echo $i; ?>
                                <svg height="17" width="17" viewBox="0 0 24 24" ><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" /></svg>
                            </span>
                        </td>
                        <td class="nasa-rating-per-wrap">
                            <div class="nasa-rating-per">
                                <span style="width: <?php echo esc_attr($per); ?>%" class="nasa-per-content"></span>
                            </div>
                        </td>
                        <td class="nasa-ratings-number text-center rtl-text-left">
                            <?php echo $rating_item[$i]; ?>
                        </td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>

    <?php if ($reviewForm) : ?>
        <div id="review_form_wrapper">
            <div class="nasa_review-submitted_sucess">
                <span class="ns-thank" ><?php echo esc_html__('Thank you!', 'elessi-theme'); ?></span>
                <span><?php echo esc_html__('Your review has been submitted', 'elessi-theme'); ?></span>
            </div>
            <a class="ns-form-close nasa-stclose close-review-form" href="javascript:void(0);" rel="nofollow"></a>
            <div id="review_form">
                <?php
                $commenter = wp_get_current_commenter();
                $req = (bool) get_option('require_name_email', 1);
                $comment_form = array(
                    /* translators: %s is product title */
                    'title_reply' => have_comments() ? sprintf(__('Add a review &ldquo;%s&rdquo;', 'elessi-theme'), get_the_title()) : sprintf(__('Be the first to review &ldquo;%s&rdquo;', 'elessi-theme'), get_the_title()),
                    /* translators: %s is product title */
                    'title_reply_to' => __('Leave a Reply to %s', 'elessi-theme'),
                    'title_reply_before' => '<span class="nasa-error nasa-message"></span><span class="nasa-success nasa-message"></span><span id="reply-title" class="comment-reply-title">',
                    'title_reply_after' => '</span>',
                    'comment_notes_after' => '',
                    'fields' => array(
                        'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'elessi-theme') . '&nbsp;<span class="required">' . ($req ? '*' : '') . '</span></label> ' .
                        '<input id="author" name="author" type="text" placeholder="' . ($req ? esc_attr__('Name *', 'elessi-theme') : esc_attr__('Name', 'elessi-theme')) . '" value="' . esc_attr($commenter['comment_author']) . '" size="30" class="' . ($req ? 'nasa-field-required' : '') . '" />' . ($req ? $required_alert : '') . '</p>',
                        
                        'email' => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'elessi-theme') . '&nbsp;<span class="required">' . ($req ? '*' : '') . '</span></label> ' .
                        '<input id="email" name="email" type="email" placeholder="' . ($req ? esc_attr__('Email *', 'elessi-theme') : esc_attr__('Email', 'elessi-theme')) . '" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" class="' . ($req ? 'nasa-field-required' : '') . '"/>' . ($req ? $required_alert : '') . $invalid_alert . '</p>',
                    ),
                    'label_submit' => __('Submit', 'elessi-theme'),
                    'id_submit' => 'nasa-submit',
                    'logged_in_as' => '',
                    'comment_field' => '',
                );

                $account_page_url = wc_get_page_permalink('myaccount');
                if ($account_page_url) :
                    /* Redirect back product after logged in */
                    $account_page_url = add_query_arg('redirect_to', $product->get_permalink(), $account_page_url);
                    
                    /* translators: %s opening and closing link tags respectively */
                    $comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a review.', 'elessi-theme'), '<a href="' . esc_url($account_page_url) . '">', '</a>') . '</p>';
                    
                    $login_ajax = !NASA_CORE_USER_LOGGED && (!isset($nasa_opt['login_ajax']) || $nasa_opt['login_ajax'] == 1) ? true : false;
                    
                    if ($login_ajax) :
                        echo '<a class="hidden-tag nasa-login-register-ajax" data-enable="1" href="' . esc_url($account_page_url) . '" rel="nofollow"></a>';
                    endif;
                    
                endif;

                if (wc_review_ratings_enabled()) {
                    $comment_form['comment_field'] = '<p class="comment-form-rating"><label class="nasa-rating" for="rating">' . esc_html__('Your rating', 'elessi-theme') . '&nbsp;<span class="required">*</span></label>'.
                    '<select name="rating" id="rating" class="' . (wc_review_ratings_required() ? 'nasa-field-required' : '') . '">' .
                        '<option value="">' . esc_html__('Rate&hellip;', 'elessi-theme') . '</option>' .
                        '<option value="5">' . esc_html__('Perfect', 'elessi-theme') . '</option>' .
                        '<option value="4">' . esc_html__('Good', 'elessi-theme') . '</option>' .
                        '<option value="3">' . esc_html__('Average', 'elessi-theme') . '</option>' .
                        '<option value="2">' . esc_html__('Not that bad', 'elessi-theme') . '</option>' .
                        '<option value="1">' . esc_html__('Very poor', 'elessi-theme') . '</option>' .
                    '</select>' . $required_alert . '</p>';
                }

                $comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . esc_html__('Your review', 'elessi-theme') . '&nbsp;<span class="required">*</span></label><textarea id="comment" name="comment" placeholder="' . esc_html__('Your review *', 'elessi-theme') . '" cols="45" rows="8"  class="nasa-field-required"></textarea>' . $required_alert . '</p>';

                comment_form(apply_filters('woocommerce_product_review_comment_form_args', $comment_form));
                ?>
            </div>
        </div>
        <div class="nasa_reviewed_images_wrap">

            <?php /*h2><?php esc_html_e('Customer photos', 'elessi-theme'); ?></h2*/?>
            <div class="nasa_reviewed_images"></div>
            <a class="button btn-add-new-review" href="javascript:void(0);" rel="nofollow"><?php echo(have_comments() ? __('Write a review', 'elessi-theme') : sprintf(__('Be the first to review &ldquo;%s&rdquo;', 'elessi-theme'), get_the_title())); ?></a>
        </div>
        
    <?php else : ?>
        <div class="nasa_reviewed_images_wrap">
        <div class="nasa_reviewed_images"></div>
        </div>
        <p class="woocommerce-verification-required"><?php esc_html_e('Only logged in customers who have purchased this product may leave a review.', 'elessi-theme'); ?></p>
    <?php endif; ?>

    <div class="nasa-clear-both"></div>
    
    <div id="comments">
        <h2 class="woocommerce-Reviews-title">
            <?php
            if ($count && wc_review_ratings_enabled()) :
                /* translators: 1: reviews count 2: product name */
                // $reviews_title = $sort_type == 'media_DESC' ? sprintf(esc_html(_n('%1$s/%2$s review %3$s has media', '%1$s/%2$s reviews %3$s has media', $count_media, 'elessi-theme')), esc_html($count_media),esc_html($count),'<span>' . get_the_title() . '</span>') : sprintf(esc_html(_n('Showing 1 - %2$s of %1$s review', 'Showing 1 - %2$s of %1$s reviews', $count, 'elessi-theme')), esc_html($count),'<span class="review-showing">' . get_option( 'comments_per_page' ) .'</span>');

                $path = $_SERVER['REQUEST_URI'];
                $page_number = preg_match("/comment-page-(\d+)/", $path, $matches) ? $page_number = $matches[1] : 1;

                $review_end = $page_number * get_option('comments_per_page') > $count ? $count : $page_number * get_option('comments_per_page');
                $review_start = (isset($nasa_opt['single_review_ajax']) && $nasa_opt['single_review_ajax']) ? 1 : ($page_number > 1 ? ($page_number -1) * get_option('comments_per_page') + 1 : 1);

                $reviews_title = sprintf(esc_html(_n('Showing %3$s - %2$s of %1$s review', 'Showing %3$s - %2$s of %1$s reviews', $count, 'elessi-theme')), esc_html($count), esc_html($review_end), esc_html($review_start));
                
                if ($sort_type == 'media_DESC') {
                    $review_end = $page_number * get_option('comments_per_page') > $count_media ? $count_media : $page_number * get_option('comments_per_page');
                    $reviews_title = sprintf(esc_html(_n('Showing %3$s - %2$s of %1$s media review', 'Showing %3$s - %2$s of %1$s media reviews', $count_media, 'elessi-theme')), esc_html($count_media), esc_html($review_end), esc_html($review_start));
                }



                $reviews_title = ($sort_type == 'media_DESC' && $count <= 0) ? esc_html_e('Reviews', 'elessi-theme') : $reviews_title;

                echo apply_filters('woocommerce_reviews_title', $reviews_title, $count, $product); // WPCS: XSS ok.
            else :
                esc_html_e('Reviews', 'elessi-theme');
            endif;
            ?>
        </h2>

        <?php if ($count > 0) : ?>
            <?php if (!$change_layout_review) : ?>
                <div class="woocommerce-Reviews-layout">
                    <a href="javascript:void(0);" class="nasa-change-layout-reviews masonry nasa-tip <?php echo $reviews_layout == 'masonry' ? 'nasa-active' :''; ?>" rel="nofollow" data-tip="Grid" data-class="commentlist masonry large-block-grid-4 small-block-grid-2 medium-block-grid-3" data-type="masonry">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="17" viewBox="0 0 26 18" fill="none">
                            <rect width="8" height="8" rx="2" fill="currentColor"></rect>
                            <rect y="9" width="8" height="8" rx="2" fill="currentColor"></rect>
                            <rect x="9" width="8" height="8" rx="2" fill="currentColor"></rect>
                            <rect x="18" width="8" height="8" rx="2" fill="currentColor"></rect>
                            <rect x="9" y="9" width="8" height="8" rx="2" fill="currentColor"></rect>
                            <rect x="18" y="9" width="8" height="8" rx="2" fill="currentColor"></rect>
                        </svg>
                    </a>

                    <a href="javascript:void(0);" class="nasa-change-layout-reviews list nasa-tip <?php echo $reviews_layout == 'list' ? 'nasa-active' :''; ?>" rel="nofollow" data-tip="List" data-class="commentlist list" data-type="list">      
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="17" viewBox="0 0 21 18" fill="none">
                            <rect x="9" y="2" width="12" height="1" rx="0.5" fill="currentColor"></rect>
                            <rect x="9" y="4" width="12" height="1" rx="0.5" fill="currentColor"></rect>
                            <rect width="8" height="8" rx="1.5" fill="currentColor"></rect>
                            <rect x="9" y="11" width="12" height="1" rx="0.5" fill="currentColor"></rect>
                            <rect x="9" y="13" width="12" height="1" rx="0.5" fill="currentColor"></rect>
                            <rect y="9" width="8" height="8" rx="1.5" fill="currentColor"></rect>
                        </svg>
                    </a>
                </div>
            <?php endif;?>
            
            <div class="woocommerce-Reviews-ordering">
                <span class="sort-text margin-right-5 rtl-margin-right-0 rtl-margin-left-5"><?php echo esc_html('Sort by','elessi-theme')?></span>
                <div class="nasa-ordering">
                    <a href="javascript:void(0);" class="nasa-current-orderby nasa-bold-700">
                        <?php foreach ($options_sort as $option) {
                            if ($option[1] == $sort_type) {
                                echo esc_html($option[0]);
                                break;
                            }
                        }?>
                    </a>
                    <div class="sub-ordering">
                        <?php foreach ($options_sort as $option) : 
                            $active_class = $option[1] == $sort_type ? 'active' : '';
                        ?>
                            <a href="javascript:void(0);" data-value="<?php echo esc_attr($option[1]); ?>" class="nasa-orderby <?php echo esc_attr($active_class); ?>"><?php echo esc_html($option[0], 'elessi-theme'); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <svg class="svg_desktop" width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z"></path></svg>
                <svg class="svg_mobile" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 32 32">
                    <path d="M28.262 5.87c0-1.472-1.194-2.665-2.666-2.665s-2.666 1.193-2.666 2.665c0 1.289 0.916 2.365 2.133 2.612v18.18h1.066v-18.18c1.217-0.247 2.133-1.323 2.133-2.612zM25.596 7.47c-0.882 0-1.599-0.717-1.599-1.599s0.717-1.599 1.599-1.599c0.882 0 1.599 0.717 1.599 1.599s-0.717 1.599-1.599 1.599z" fill="currentColor" />
                    <path d="M6.937 23.517v-18.18h-1.066v18.18c-1.217 0.247-2.132 1.322-2.132 2.612 0 1.472 1.194 2.666 2.666 2.666s2.666-1.194 2.666-2.666c0-1.29-0.916-2.365-2.133-2.612zM6.404 27.729c-0.882 0-1.599-0.717-1.599-1.599s0.717-1.599 1.599-1.599 1.599 0.717 1.599 1.599-0.717 1.599-1.599 1.599z" fill="currentColor" />
                    <path d="M16.533 13.388v-8.050h-1.066v8.050c-1.217 0.247-2.133 1.323-2.133 2.612s0.916 2.365 2.133 2.612v8.050h1.066v-8.050c1.217-0.247 2.133-1.323 2.133-2.612s-0.916-2.365-2.133-2.612zM16 17.599c-0.882 0-1.599-0.717-1.599-1.599s0.717-1.599 1.599-1.599 1.599 0.717 1.599 1.599-0.717 1.599-1.599 1.599z" fill="currentColor" />
                </svg>
            </div>
        <?php endif; ?>

        <?php if (have_comments()) : ?>
            <ol class="commentlist <?php echo $reviews_layout == 'list' || $change_layout_review ? 'list': 'masonry large-block-grid-4 small-block-grid-2 medium-block-grid-3';?>">
                <?php wp_list_comments(apply_filters('woocommerce_product_review_list_args', array('callback' => 'woocommerce_comments'))); ?>
            </ol>
            
            <?php
            if (get_comment_pages_count() > 1 && get_option('page_comments')) :
                echo '<nav class="woocommerce-pagination">';

                paginate_comments_links(
                    apply_filters('woocommerce_comment_pagination_args', array(
                        'prev_text' => '<svg width="35" height="35" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z"/></svg>',
                        'next_text' => '<svg width="35" height="35" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"/></svg>',
                        'type' => 'list'
                    ))
                );
                echo '</nav>';
            endif;
            ?>
        <?php else : ?>
            <p class="woocommerce-noreviews"><?php $sort_type == 'media_DESC' ? esc_html_e('There are no media reviews yet.', 'elessi-theme') : esc_html_e('There are no reviews yet.', 'elessi-theme'); ?></p>
        <?php endif; ?>
    </div>

    <div class="clear"></div>
</div>
