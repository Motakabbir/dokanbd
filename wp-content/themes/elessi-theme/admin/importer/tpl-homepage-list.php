<?php
defined('ABSPATH') or die();
$wpb_home = isset($wpb_home) ? $wpb_home : true;
$elm_home = isset($elm_home) ? $elm_home : true;
?>
<script type="text/template" id="ns-import-btn-tmp">
    <span class="ns-import-btn">
        <svg viewBox="0 0 1000 1000" height="50" width="50" fill="currentColor">
            <g>
                <g transform="translate(0,512) scale(0.1,-0.1)">
                    <path d="M4875.7,4994.1c-70.8-32.5-133.9-99.4-160.6-170.2c-15.3-38.2-21-984.9-21-3088.5v-3034.9l-529.7,529.7c-292.6,290.7-550.8,537.4-573.7,548.8c-22.9,11.5-80.3,21-126.2,21c-216.1,0-365.3-241-265.8-432.2c23-44,374.8-409.2,839.5-872c701.8-699.9,808.9-799.4,881.6-818.5c177.8-45.9,162.5-59.3,1042.2,818.5c464.7,462.8,816.6,828.1,839.5,872c97.5,191.2-49.7,432.2-265.8,432.2c-45.9,0-107.1-11.5-135.8-26.8c-28.7-15.3-283-262-568-545L5315.5-1290l-9.6,3057.9c-9.6,3052.2-9.6,3059.8-49.7,3111.4c-21,28.7-61.2,70.8-88,89.9C5103.3,5017,4952.2,5030.4,4875.7,4994.1z" />
                    <path d="M794.7,2236.4c-323.2-88-577.5-344.2-661.7-671.2c-44-166.4-44-5469.4,0-5637.7c86.1-328.9,342.3-583.3,673.2-669.3c166.4-44,8221.3-44,8387.7,0c330.8,86.1,587.1,340.4,673.2,669.3c44,168.3,44,5471.3,0,5637.7c-88,340.4-369.1,612-703.7,680.8c-66.9,15.3-476.2,21-1269.8,17.2c-1147.4-5.7-1170.4-5.7-1222-45.9c-101.4-74.6-132-135.8-132-256.3s30.6-181.7,132-256.3c51.6-40.2,78.4-40.2,1235.4-49.7c1157-9.6,1183.8-9.6,1235.4-49.7c28.7-21,70.8-63.1,91.8-91.8c40.2-51.6,40.2-55.5,40.2-2765.3c0-2709.9,0-2713.7-40.2-2765.3c-21-28.7-63.1-70.8-91.8-91.8l-51.6-40.1H5000H909.4l-51.6,40.1c-28.7,21-70.8,63.1-91.8,91.8c-40.2,51.6-40.2,55.4-40.2,2765.3c0,2709.8,0,2713.6,40.2,2765.3c21,28.7,63.1,70.8,91.8,91.8c51.6,40.2,78.4,40.2,1235.4,49.7c1157,9.6,1183.8,9.6,1235.4,49.7c101.4,74.6,132,135.8,132,256.3s-30.6,181.7-132,256.3c-51.6,40.2-72.7,40.2-1241.1,44C1094.9,2265.1,880.7,2259.4,794.7,2236.4z" />
                </g>
            </g>
        </svg>
        
        <span class="ns-txt-import hidden-tag"><?php echo esc_html__('Imported!', 'elessi-theme'); ?></span>
    </span>
</script>

<div class="ns-homes-search nasa-flex jc">
    <div class="ns-homes-search-wrap">
        <input type="text" id="ns-homes-search-input" class="nasa-flex" placeholder="<?php echo esc_attr__('Search homepage ...', 'elessi-theme'); ?>" />
        <label class="ns-label-search" for="ns-homes-search-input"><svg viewBox="0 0 80 80" width="26" height="26" fill="currentColor"><path d="M74.3,72.2L58.7,56.5C69.9,44,69,24.8,56.5,13.5s-31.7-10.3-43,2.2s-10.3,31.7,2.2,43c11.6,10.5,29.3,10.5,40.9,0 l15.7,15.7L74.3,72.2z M36.1,63.5c-15.1,0-27.4-12.3-27.4-27.4C8.7,20.9,21,8.7,36.1,8.7c15.1,0,27.4,12.3,27.4,27.4 C63.5,51.2,51.2,63.5,36.1,63.5z" /><path d="M36.1,12.8v3c11.2,0,20.3,9.1,20.3,20.3h3C59.4,23.2,49,12.8,36.1,12.8z" /></svg></label>
    </div>
</div>

<div class="nasa-select-homepage">
    <ul class="nasa-tabs-heading">
        <?php if ($wpb_home) : ?>
            <li class="tab-heading-js_composer">
                <a href="javascript:void(0);" class="nasa-tab-heading" data-target=".demo-homepages-wpb">
                    <?php echo esc_html__('WPBakery - Homepage List', 'elessi-theme'); ?>
                </a>
            </li>
        <?php endif; ?>

        <?php if ($elm_home) : ?>
            <li class="tab-heading-elementor">
                <a href="javascript:void(0);" class="nasa-tab-heading" data-target=".demo-homepages-elm">
                    <?php echo esc_html__('Elementor - Homepage List', 'elessi-theme'); ?>
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <div class="nasa-tabs-panel">
        <?php if ($wpb_home) : ?>
            <!-- Panel WPBakery -->
            <div class="demo-homepages-wrap demo-homepages-wpb nasa-tab-content tab-content-js_composer">
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-1.jpg" alt="Fashion v1" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-2.jpg" alt="Fashion v2" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-3.jpg" alt="Fashion v3" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-4" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-4.jpg" alt="Fashion v4" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v4</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-5" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-5.jpg" alt="Fashion v5" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v5</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-6" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-6.jpg" alt="Fashion v6" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v6</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-7" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-7.jpg" alt="Fashion v7" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v7</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-8" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-8.jpg" alt="Fashion v8" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v8</sup></h4>
                    </a>
                </div>
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="digital-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/digital-1.jpg" alt="Digital v1" />
                        </div>

                        <h4 class="home-title">Digital <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="digital-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/digital-2.jpg" alt="Digital v2" />
                        </div>

                        <h4 class="home-title">Digital <sup>v2</sup></h4>

                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="accessories-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/accessories.jpg" alt="Accessories v1" />
                        </div>

                        <h4 class="home-title">Accessories <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="accessories-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/accessories-v2.jpg" alt="Accessories v2" />
                        </div>

                        <h4 class="home-title">Accessories <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="accessories-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/accessories-v3.jpg" alt="Accessories v3" />
                        </div>

                        <h4 class="home-title">Accessories <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="baby" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/baby.jpg" alt="Baby" />
                        </div>

                        <h4 class="home-title">Baby</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="bag" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/bag.jpg" alt="Bag" />
                        </div>

                        <h4 class="home-title">Bag</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="bike" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/bike.jpg" alt="Bike" />
                        </div>

                        <h4 class="home-title">Bike</h4>
                    </a>

                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="cosmetic" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/cosmetic.jpg" alt="Cosmetic" />
                        </div>

                        <h4 class="home-title">Cosmetic</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="face-mask" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/face-mask.jpg" alt="Face Mask" />
                        </div>

                        <h4 class="home-title">Face Mask</h4>
                    </a>
                </div>
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="furniture" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/furniture.jpg" alt="Furniture" />
                        </div>

                        <h4 class="home-title">Furniture</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="jewelry" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/jewelry.jpg" alt="Jewelry" />
                        </div>

                        <h4 class="home-title">Jewelry</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic.jpg" alt="Organic v1" />
                        </div>

                        <h4 class="home-title">Organic <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-2.jpg" alt="Organic v2" />
                        </div>

                        <h4 class="home-title">Organic <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-3.jpg" alt="Organic v3" />
                        </div>

                        <h4 class="home-title">Organic <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-4" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-4.jpg" alt="Organic v4" />
                        </div>

                        <h4 class="home-title">Organic <sup>v4</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-5" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-5.jpg" alt="Organic v5" />
                        </div>

                        <h4 class="home-title">Organic <sup>v5</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-farm" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-farm.jpg" alt="Organic farm" />
                        </div>

                        <h4 class="home-title">Organic Farm</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="retail" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/retail.jpg" alt="Retail" />
                        </div>

                        <h4 class="home-title">Retail</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="shoes" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/shoes.jpg" alt="Shoes" />
                        </div>

                        <h4 class="home-title">Shoes</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="t-shirt" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/t-shirt.jpg" alt="T-shirt" />
                        </div>

                        <h4 class="home-title">T-shirt</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="christmas" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/christmas.jpg" alt="Christmas" />
                        </div>

                        <h4 class="home-title">Christmas</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="pet-accessories" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/pet-accessories.jpg" alt="Pet Accessories" />
                        </div>

                        <h4 class="home-title">Pet Accessories</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="watch" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/watch.jpg" alt="Watch" />
                        </div>

                        <h4 class="home-title">Watch</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="watch-dark" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/watch-dark.jpg" alt="Watch Dark" />
                        </div>

                        <h4 class="home-title">Watch Dark</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="auto-parts-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/auto-part-v1.jpg" alt="Auto Parts v1" />
                        </div>

                        <h4 class="home-title">Auto Parts <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="auto-parts-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/auto-part-v2.jpg" alt="Auto Parts v2" />
                        </div>

                        <h4 class="home-title">Auto Parts <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="auto-parts-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/auto-part-v3.jpg" alt="Auto Parts v3" />
                        </div>

                        <h4 class="home-title">Auto Parts <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="medical-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/medical-1.jpg" alt="Medical v1" />
                        </div>

                        <h4 class="home-title">Medical <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="medical-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/medical-2.jpg" alt="Medical v2" />
                        </div>

                        <h4 class="home-title">Medical <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="pharmacy" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/pharmacy.jpg" alt="Pharmacy" />
                        </div>

                        <h4 class="home-title">Pharmacy</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="plant-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/plant-1.jpg" alt="Plant v1" />
                        </div>

                        <h4 class="home-title">Plant <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="plant-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/plant-2.jpg" alt="Plant v2" />
                        </div>

                        <h4 class="home-title">Plant <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="plant-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/plant-3.jpg" alt="Plant v3" />
                        </div>

                        <h4 class="home-title">Plant <sup>v3</sup></h4>
                    </a>
                </div>
                
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="glasses-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/glasses-v1.jpg" alt="Glasses v1" />
                        </div>

                        <h4 class="home-title">Glasses <sup>v1</sup></h4>
                    </a>
                </div>
                
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="glasses-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/glasses-v2.jpg" alt="Glasses v2" />
                        </div>

                        <h4 class="home-title">Glasses <sup>v2</sup></h4>
                    </a>
                </div>
            </div>
        <?php endif; ?>
            
        <?php if ($elm_home) : ?>
            <!-- Panel Elementor -->
            <div class="demo-homepages-wrap demo-homepages-elm nasa-tab-content tab-content-elementor">
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-1.jpg" alt="Fashion v1" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-2.jpg" alt="Fashion v2" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-3.jpg" alt="Fashion v3" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-4" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-4.jpg" alt="Fashion v4" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v4</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-5" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-5.jpg" alt="Fashion v5" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v5</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-6" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-6.jpg" alt="Fashion v6" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v6</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="fashion-8" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/fashion-8.jpg" alt="Fashion v8" />
                        </div>

                        <h4 class="home-title">Fashion <sup>v8</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="digital-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/digital-1.jpg" alt="Digital v1" />
                        </div>

                        <h4 class="home-title">Digital <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="digital-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/digital-2.jpg" alt="Digital v2" />
                        </div>

                        <h4 class="home-title">Digital <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="accessories-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/accessories.jpg" alt="Accessories v1" />
                        </div>

                        <h4 class="home-title">Accessories <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="accessories-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/accessories-v2.jpg" alt="Accessories v2" />
                        </div>

                        <h4 class="home-title">Accessories <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="accessories-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/accessories-v3.jpg" alt="Accessories v3" />
                        </div>

                        <h4 class="home-title">Accessories <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="baby" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/baby.jpg" alt="Baby" />
                        </div>

                        <h4 class="home-title">Baby</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="bag" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/bag.jpg" alt="Bag" />
                        </div>

                        <h4 class="home-title">Bag</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="bike" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/bike.jpg" alt="Bike" />
                        </div>

                        <h4 class="home-title">Bike</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="cosmetic" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/cosmetic.jpg" alt="Cosmetic" />
                        </div>

                        <h4 class="home-title">Cosmetic</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="face-mask" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/face-mask.jpg" alt="Face Mask" />
                        </div>

                        <h4 class="home-title">Face Mask</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="furniture" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/furniture.jpg" alt="Furniture" />
                        </div>

                        <h4 class="home-title">Furniture</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="jewelry" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/jewelry.jpg" alt="Jewelry" />
                        </div>

                        <h4 class="home-title">Jewelry</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic.jpg" alt="Organic v1" />
                        </div>

                        <h4 class="home-title">Organic <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-2.jpg" alt="Organic v2" />
                        </div>

                        <h4 class="home-title">Organic <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-3.jpg" alt="Organic v3" />
                        </div>

                        <h4 class="home-title">Organic <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-4" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-4.jpg" alt="Organic v4" />
                        </div>

                        <h4 class="home-title">Organic <sup>v4</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-5" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-5.jpg" alt="Organic v5" />
                        </div>

                        <h4 class="home-title">Organic <sup>v5</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="organic-farm" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/organic-farm.jpg" alt="Organic farm" />
                        </div>

                        <h4 class="home-title">Organic Farm</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="retail" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/retail.jpg" alt="Retail" />
                        </div>

                        <h4 class="home-title">Retail</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="shoes" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/shoes.jpg" alt="Shoes" />
                        </div>

                        <h4 class="home-title">Shoes</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="t-shirt" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/t-shirt.jpg" alt="T-shirt" />
                        </div>

                        <h4 class="home-title">T-shirt</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="christmas" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/christmas.jpg" alt="Christmas" />
                        </div>

                        <h4 class="home-title">Christmas</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="pet-accessories" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/pet-accessories.jpg" alt="Pet Accessories" />
                        </div>

                        <h4 class="home-title">Pet Accessories</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="watch" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/watch.jpg" alt="Watch" />
                        </div>

                        <h4 class="home-title">Watch</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="watch-dark" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/watch-dark.jpg" alt="Watch Dark" />
                        </div>

                        <h4 class="home-title">Watch Dark</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="auto-parts-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/auto-part-v1.jpg" alt="Auto Parts v1" />
                        </div>

                        <h4 class="home-title">Auto Parts <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="auto-parts-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/auto-part-v2.jpg" alt="Auto Parts v2" />
                        </div>

                        <h4 class="home-title">Auto Parts <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="auto-parts-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/auto-part-v3.jpg" alt="Auto Parts v3" />
                        </div>

                        <h4 class="home-title">Auto Parts <sup>v3</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="medical-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/medical-1.jpg" alt="Medical v1" />
                        </div>

                        <h4 class="home-title">Medical <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="medical-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/medical-2.jpg" alt="Medical v2" />
                        </div>

                        <h4 class="home-title">Medical <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="pharmacy" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/pharmacy.jpg" alt="Pharmacy" />
                        </div>

                        <h4 class="home-title">Pharmacy</h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="plant-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/plant-1.jpg" alt="Plant v1" />
                        </div>

                        <h4 class="home-title">Plant <sup>v1</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="plant-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/plant-2.jpg" alt="Plant v2" />
                        </div>

                        <h4 class="home-title">Plant <sup>v2</sup></h4>
                    </a>
                </div>

                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="plant-3" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/plant-3.jpg" alt="Plant v3" />
                        </div>

                        <h4 class="home-title">Plant <sup>v3</sup></h4>
                    </a>
                </div>
                
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="glasses-1" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/glasses-v1.jpg" alt="Glasses v1" />
                        </div>

                        <h4 class="home-title">Glasses <sup>v1</sup></h4>
                    </a>
                </div>
                
                <div class="demo-homepage-item-wrap">
                    <a href="javascript:void(0);" data-home="glasses-2" class="demo-homepage-item">
                        <div class="img-wrap">
                            <img src="<?php echo ELESSI_THEME_URI; ?>/admin/assets/pages/glasses-v2.jpg" alt="Glasses v2" />
                        </div>

                        <h4 class="home-title">Glasses <sup>v2</sup></h4>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
