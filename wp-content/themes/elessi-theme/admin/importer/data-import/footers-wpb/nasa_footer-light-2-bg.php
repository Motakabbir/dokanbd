<?php
function nasa_wpb_footer_light_2_bg() {
    $imgs_url_1 = elessi_import_upload('/wp-content/uploads/2023/09/farm-footer-bg.png', '0', array(
        'post_title' => 'farm-footer-bg',
        'post_name' => 'farm-footer-bg',
    ));
    $imgs_url_src_1 = $imgs_url_1 ? wp_get_attachment_image_url($imgs_url_1, 'full') : 'https://via.placeholder.com/1377x160?text=1377x160';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Footer Light 2 With BG',
            'post_name' => 'wpb-footer-light-2-bg',
            'post_content' => '[vc_row el_class="footer-organic-farm footer-light-2 padding-top-80 padding-bottom-20 tablet-padding-top-50 tablet-padding-left-10 tablet-padding-right-10" css=".vc_custom_1657600063708{background-image: url(' . $imgs_url_src_1 . ') !important;}"][vc_column width="1/2" offset="vc_col-lg-6 vc_col-md-12" el_class="tablet-margin-bottom-50"][vc_row_inner][vc_column_inner width="1/2"][nasa_image alt="Footer Logo" link_text="#" image="1703" el_class="skip-lazy"][nasa_contact_us title="Site Name." contact_address="Calista Wise 7292 Dictum Av.Antonio, Italy." contact_phone="(+01)-800-3456-88" contact_email="nasathemes@gmail.com" contact_website="elessi.nasatheme.com" class="desktop-padding-right-20" el_class="tablet-margin-top-15"][/vc_column_inner][vc_column_inner width="1/2" offset="vc_col-md-5"][nasa_follow][nasa_menu menu="information" el_class="tablet-margin-top-10"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2" offset="vc_col-lg-6 vc_col-md-12"][vc_row_inner el_class="footer-contact"][vc_column_inner el_class="mobile-margin-bottom-20 mobile-margin-top-20" width="1/4"][vc_column_text]
<h4 style="font-weight: bold; font-size: 150%;">Newsletter</h4>
[/vc_column_text][/vc_column_inner][vc_column_inner el_class="tablet-padding-right-0" width="3/4" offset="vc_col-md-offset-3 vc_col-md-6"][contact-form-7 id="210"][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="5/12" offset="vc_col-md-6"][nasa_menu menu="customer-care" el_class="tablet-margin-top-10"][/vc_column_inner][vc_column_inner el_class="tablet-padding-right-0" width="7/12" offset="vc_col-md-6"][nasa_opening_time el_class="tablet-margin-top-10"][nasa_image alt="Payments Accept" image="1698" align="right"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column][vc_row_inner el_class="nasa-footer-bottom nasa-transparent"][vc_column_inner el_class="nasa-footer-bottom-left" width="5/12"][vc_column_text]© ' . date('Y') . ' - All Right reserved![/vc_column_text][/vc_column_inner][vc_column_inner el_class="nasa-footer-bottom-right" width="7/12"][nasa_menu menu="footer-menu"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            '_wpb_shortcodes_custom_css' => '.vc_custom_1657600063708{background-image: url(' . $imgs_url_src_1 . ') !important;}'
        )
    );
}
