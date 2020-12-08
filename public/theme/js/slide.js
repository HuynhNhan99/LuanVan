var slishowDuration = 4000;
var slishow = $('.main-content .slishow');

function slishowSwitch(slishow, index, auto) {
    if (slishow.data('wait')) return;

    var slis = slishow.find('.sli');
    var pages = slishow.find('.pagination');
    var activesli = slis.filter('.is-active');
    var activesliImage = activesli.find('.image-container');
    var newsli = slis.eq(index);
    var newsliImage = newsli.find('.image-container');
    var newsliContent = newsli.find('.sli-content');
    var newsliElements = newsli.find('.caption > *');
    if (newsli.is(activesli)) return;

    newsli.addClass('is-new');
    var timeout = slishow.data('timeout');
    clearTimeout(timeout);
    slishow.data('wait', true);
    var transition = slishow.attr('data-transition');
    if (transition == 'fade') {
        newsli.css({
            display: 'block',
            zIndex: 2
        });
        newsliImage.css({
            opacity: 0
        });

        TweenMax.to(newsliImage, 1, {
            alpha: 1,
            onComplete: function() {
                newsli.addClass('is-active').removeClass('is-new');
                activesli.removeClass('is-active');
                newsli.css({ display: '', zIndex: '' });
                newsliImage.css({ opacity: '' });
                slishow.find('.pagination').trigger('check');
                slishow.data('wait', false);
                if (auto) {
                    timeout = setTimeout(function() {
                        slishowNext(slishow, false, true);
                    }, slishowDuration);
                    slishow.data('timeout', timeout);
                }
            }
        });
    } else {
        if (newsli.index() > activesli.index()) {
            var newsliRight = 0;
            var newsliLeft = 'auto';
            var newsliImageRight = -slishow.width() / 8;
            var newsliImageLeft = 'auto';
            var newsliImageToRight = 0;
            var newsliImageToLeft = 'auto';
            var newsliContentLeft = 'auto';
            var newsliContentRight = 0;
            var activesliImageLeft = -slishow.width() / 4;
        } else {
            var newsliRight = '';
            var newsliLeft = 0;
            var newsliImageRight = 'auto';
            var newsliImageLeft = -slishow.width() / 8;
            var newsliImageToRight = '';
            var newsliImageToLeft = 0;
            var newsliContentLeft = 0;
            var newsliContentRight = 'auto';
            var activesliImageLeft = slishow.width() / 4;
        }

        newsli.css({
            display: 'block',
            width: 0,
            right: newsliRight,
            left: newsliLeft,
            zIndex: 2
        });

        newsliImage.css({
            width: slishow.width(),
            right: newsliImageRight,
            left: newsliImageLeft
        });

        newsliContent.css({
            width: slishow.width(),
            left: newsliContentLeft,
            right: newsliContentRight
        });

        activesliImage.css({
            left: 0
        });

        TweenMax.set(newsliElements, { y: 20, force3D: true });
        TweenMax.to(activesliImage, 1, {
            left: activesliImageLeft,
            ease: Power3.easeInOut
        });

        TweenMax.to(newsli, 1, {
            width: slishow.width(),
            ease: Power3.easeInOut
        });

        TweenMax.to(newsliImage, 1, {
            right: newsliImageToRight,
            left: newsliImageToLeft,
            ease: Power3.easeInOut
        });

        TweenMax.staggerFromTo(newsliElements, 0.8, { alpha: 0, y: 60 }, { alpha: 1, y: 0, ease: Power3.easeOut, force3D: true, delay: 0.6 }, 0.1, function() {
            newsli.addClass('is-active').removeClass('is-new');
            activesli.removeClass('is-active');
            newsli.css({
                display: '',
                width: '',
                left: '',
                zIndex: ''
            });

            newsliImage.css({
                width: '',
                right: '',
                left: ''
            });

            newsliContent.css({
                width: '',
                left: ''
            });

            newsliElements.css({
                opacity: '',
                transform: ''
            });

            activesliImage.css({
                left: ''
            });

            slishow.find('.pagination').trigger('check');
            slishow.data('wait', false);
            if (auto) {
                timeout = setTimeout(function() {
                    slishowNext(slishow, false, true);
                }, slishowDuration);
                slishow.data('timeout', timeout);
            }
        });
    }
}

function slishowNext(slishow, previous, auto) {
    var slis = slishow.find('.sli');
    var activesli = slis.filter('.is-active');
    var newsli = null;
    if (previous) {
        newsli = activesli.prev('.sli');
        if (newsli.length === 0) {
            newsli = slis.last();
        }
    } else {
        newsli = activesli.next('.sli');
        if (newsli.length == 0)
            newsli = slis.filter('.sli').first();
    }

    slishowSwitch(slishow, newsli.index(), auto);
}

function homeslishowParallax() {
    var scrollTop = $(window).scrollTop();
    if (scrollTop > windowHeight) return;
    var inner = slishow.find('.slishow-inner');
    var newHeight = windowHeight - (scrollTop / 2);
    var newTop = scrollTop * 0.8;

    inner.css({
        transform: 'translateY(' + newTop + 'px)',
        height: newHeight
    });
}

$(document).ready(function() {
    $('.sli').addClass('is-loaded');

    $('.slishow .arrows .arrow').on('click', function() {
        slishowNext($(this).closest('.slishow'), $(this).hasClass('prev'));
    });

    $('.slishow .pagination .item').on('click', function() {
        slishowSwitch($(this).closest('.slishow'), $(this).index());
    });

    $('.slishow .pagination').on('check', function() {
        var slishow = $(this).closest('.slishow');
        var pages = $(this).find('.item');
        var index = slishow.find('.slis .is-active').index();
        pages.removeClass('is-active');
        pages.eq(index).addClass('is-active');
    });

    /* Lazyloading
    $('.slishow').each(function(){
      var slishow=$(this);
      var images=slishow.find('.image').not('.is-loaded');
      images.on('loaded',function(){
        var image=$(this);
        var sli=image.closest('.sli');
        sli.addClass('is-loaded');
      });
    */

    var timeout = setTimeout(function() {
        slishowNext(slishow, false, true);
    }, slishowDuration);

    slishow.data('timeout', timeout);
});

if ($('.main-content .slishow').length > 1) {
    $(window).on('scroll', homeslishowParallax);
}