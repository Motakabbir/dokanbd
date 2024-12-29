<?php
global $nasa_opt;
?>
<div class="wrap" id="of_container">

    <div id="of-popup-save" class="of-save-popup">
        <div class="of-save-save nasa-flex jc">
            <svg class="ns-check-svg" width="24" height="24" viewBox="0 0 32 32"><path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.968 13.328 13.328 13.328c7.361 0 13.328-5.967 13.328-13.328s-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" fill="currentColor"></path><path d="M22.667 11.241l-8.559 8.299-2.998-2.998c-0.312-0.312-0.818-0.312-1.131 0s-0.312 0.818 0 1.131l3.555 3.555c0.156 0.156 0.361 0.234 0.565 0.234 0.2 0 0.401-0.075 0.556-0.225l9.124-8.848c0.317-0.308 0.325-0.814 0.018-1.131-0.309-0.318-0.814-0.325-1.131-0.018z" fill="currentColor"></path></svg>
            <?php echo esc_html__("Options Updated", 'elessi-theme'); ?>
        </div>
    </div>

    <div id="of-popup-reset" class="of-save-popup">
        <div class="of-save-reset nasa-flex jc">
            <svg class="ns-check-svg" width="24" height="24" viewBox="0 0 32 32"><path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.968 13.328 13.328 13.328c7.361 0 13.328-5.967 13.328-13.328s-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" fill="currentColor"></path><path d="M22.667 11.241l-8.559 8.299-2.998-2.998c-0.312-0.312-0.818-0.312-1.131 0s-0.312 0.818 0 1.131l3.555 3.555c0.156 0.156 0.361 0.234 0.565 0.234 0.2 0 0.401-0.075 0.556-0.225l9.124-8.848c0.317-0.308 0.325-0.814 0.018-1.131-0.309-0.318-0.814-0.325-1.131-0.018z" fill="currentColor"></path></svg>
            <?php echo esc_html__("Options Reset", 'elessi-theme'); ?>
        </div>
    </div>

    <div id="of-popup-fail" class="of-save-popup">
        <div class="of-save-fail nasa-flex jc">
            <svg fill="currentColor" viewBox="0 0 512 512" height="24" width="24"><path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"></path></svg>
            <?php echo esc_html__("Error!", 'elessi-theme'); ?>
        </div>
    </div>

    <span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
    <input type="hidden" id="reset" value="<?php echo isset($_REQUEST['reset']) ? esc_attr($_REQUEST['reset']) : ''; ?>" />
    <input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />

    <form id="of_form" method="post" action="" enctype="multipart/form-data">
        <h2 style="display: none;"><?php esc_html_e('Theme Options', 'elessi-theme'); ?></h2>

        <div class="running-import">
            <div class="bg-success"></div>
            <span class="result-import"><span class="success-import">0</span>%</span>
        </div>

        <div class="mess-reponse-import"></div>

        <div class="updated error importer-notice importer-notice-1" style="display: none;"><p><strong><?php echo sprintf(esc_html__('Seems like an error has occured. Please double check the imported data. If incorrect, please use %s and try again', 'elessi-theme'), '<a href="' . admin_url('plugin-install.php?tab=plugin-information&amp;plugin=wordpress-reset&amp;TB_iframe=true&amp;width=830&amp;height=472') . '" class="thickbox" title="' . esc_attr__('Reset WordPress plugin', 'elessi-theme') . '">' . esc_html__('Reset WordPress plugin', 'elessi-theme') . '</a>'); ?> </strong></p></div>

        <div class="updated importer-notice importer-notice-2" style="display: none;"><p><strong><?php echo sprintf(esc_html__('Demo data successfully imported. Please refresh your site and Click Save All Changes NasaTheme options.', 'elessi-theme')); ?></strong></p></div>

        <div class="updated error importer-notice importer-notice-3" style="display: none;"><p><strong><?php esc_html_e('Sorry but your import failed. Most likely, it cannot work with your webhost. You will have to ask your webhost to increase your PHP max_execution_time (or any other webserver timeout to at least 300 secs) and memory_limit (to at least 196M) temporarily.', 'elessi-theme'); ?></strong></p></div>

        <div id="header">
            <div class="logo-options">
                <h2>
                    <?php esc_html_e('Theme Options', 'elessi-theme'); ?>
                    
                    <?php 
                    $class_doc = (!isset($nasa_opt['white_lbl']) || !$nasa_opt['white_lbl']) ? 'nasa-online-doc' : 'nasa-online-doc hidden-tag';
                    ?>
                    <a href="<?php echo esc_url(ELESSI_ADMIN_DOCS); ?>" target="_blank" style="text-decoration: none; margin-left: 10px;" class="<?php echo esc_attr($class_doc); ?>">
                        <?php esc_html_e('Click Here To View Online Documentation', 'elessi-theme'); ?>
                    </a>
                </h2>
            </div>
            
            <div id="js-warning"><?php echo esc_html__("Warning- This options panel will not work properly without javascript!", 'elessi-theme'); ?></div>
            <div class="icon-option"></div>
            <div class="clear"></div>
        </div>

        <div id="info_bar">
            <a href="javascript:void(0);" id="expand_options" class="expand"></a>

            <input type="text" id="search_otp" placeholder="<?php esc_html_e('Search Options', 'elessi-theme'); ?>" />

            <img style="display:none" src="<?php echo ELESSI_ADMIN_DIR_URI; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="<?php echo esc_attr__("Working...", 'elessi-theme'); ?>" />

            <button type="button" class="button-primary nasa-of_save">
                <?php esc_html_e('Save All Changes', 'elessi-theme'); ?>
            </button>

        </div><!--.info_bar--> 	

        <div id="main">

            <div id="of-nav">
                <ul>
                    <?php echo $options_machine->Menu; ?>
                </ul>
            </div>

            <div id="content">
                <?php echo $options_machine->Inputs; /* Settings */ ?>
            </div>

            <div class="clear"></div>

        </div>

        <div class="save_bar">
            <img style="display:none" src="<?php echo ELESSI_ADMIN_DIR_URI; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="<?php esc_attr_e('Working...', 'elessi-theme'); ?>" />
            <button type="button" class="button-primary nasa-of_save"><?php esc_html_e('Save All Changes', 'elessi-theme'); ?></button>			
            <button id ="of_reset" type="button" class="button submit-button reset-button"><?php esc_html_e('Options Reset', 'elessi-theme'); ?></button>
            <img style="display:none" src="<?php echo ELESSI_ADMIN_DIR_URI; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="<?php esc_attr_e('Working...', 'elessi-theme'); ?>" />

        </div><!--.save_bar--> 

    </form>

</div><!--wrap-->
