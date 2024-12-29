/**
 * Document nasa-core ready
 */
jQuery(document).ready(function($) {
    "use strict";
    var pswpHTML = '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><div class="pswp__bg"></div><div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="Close (Esc)"></button><button class="pswp__button pswp__button--share" title="Share"></button><button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button><button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button><button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>';

    /**
     * Portfolio popup image
     */
    $('body').on('click', '.portfolio-image-view', function (e) {
        var _this = $(this);
        var _images = $('.portfolio-list .portfolio-item .portfolio-image a.portfolio-image-view');
        var items =[];
        var index = $(_images).index(_this);
        /**
         * Open
         */
        var pswpElement;
        if ($(".pswp[role='dialog']").length) {
            pswpElement = $(".pswp[role='dialog']")[0];
        } else {
            pswpElement = $(pswpHTML).appendTo("body")[0];
        }
        
        var options = {
            closeOnScroll: false,
            mouseUsed: true,
            history:false,
            shareEl: false,
            index: index,
            closeOnVerticalDrag:false
        };

        $(_images).each(function(){
            items.push({
                src: $(this).attr("data-src"),
                w: 0,
                h: 0,
                type: 'img'
            });
        });

        var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);

        gallery.listen('imageLoadComplete', function (index, item) {
            nasa_loadImg_woo_lightbox(index, item, gallery);
        });
        
        gallery.listen('gettingData', function (index, item) {
            nasa_loadImg_woo_lightbox(index, item, gallery);
        });
        gallery.init();

        $('.nasa-loader, .color-overlay').remove();

        e.preventDefault();
    });
});

function nasa_loadImg_woo_lightbox(index, item, gallery) {
    
    if (item.w == 0 && item.h == 0 && item.type == 'img') {
        var imgpreload = new Image();
        imgpreload.onload = function () {
            item.w = this.width;
            item.h = this.height;
            item.needsUpdate = true;
            gallery.updateSize(true);
        };
        imgpreload.src = item.src;
    }
}
