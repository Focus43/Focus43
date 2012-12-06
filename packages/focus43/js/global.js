/**
 * Created with JetBrains RubyMine.
 * User: superrunt
 * Date: 11/26/12
 * Time: 5:11 PM
 * To change this template use File | Settings | File Templates.
 */

// Scrolling stuff

(function( $ ) {

    $.fn.scrollTo = function ( target, duration, options, whenDone ) {
        var targetOffset, windowOffset, scrollLength, scrollChange;
        windowOffset = $('html').offset();
        targetOffset = $(target).offset();
//        scrollLength = targetOffset.top + windowOffset.top;
        scrollLength = targetOffset.top;

        if (options && options.scrollOffset) scrollLength -= options.scrollOffset;

        scrollChange = scrollLength + "px";
        $('html, body').animate({ scrollTop: scrollChange }, duration, whenDone)

        return this;
    }

})( jQuery );

var scrollNavigationUtil = {

    cacheElementPointers: function  () {

        scrollNavigationUtil.window = $(window);
        scrollNavigationUtil.navigationUl = $('ul.nav');
        scrollNavigationUtil.html = $('html');
        scrollNavigationUtil.header = $(".navbar");
    },

    changeNavClasses: function( target ) {
        target.parent().siblings('.active').removeClass('active')
        target.parent().addClass('active');
    },

    scrollToTopic: function( event ) {
        console.log('scrollToTopic')
        // first disable the scroll listener
        scrollNavigationUtil.window.unbind('scroll', scrollNavigationUtil.scrollHandler);

        var target = $(event.target);
        var topicId = target.attr('href');
        var topicTarget = $("div" + topicId);
        var headerHeight = scrollNavigationUtil.header.height();
        // prevent the page from jumping to new location
        event.preventDefault();
        // change nav class
        scrollNavigationUtil.changeNavClasses(target);

        scrollNavigationUtil.html.scrollTo( topicTarget, 1000, { scrollOffset: headerHeight }, function () {
            // re-enable the scroll listener
//            scrollNavigationUtil.window.scroll(scrollNavigationUtil.scrollHandler);
        });

    },

    addScrollToLinks: function() {

        scrollNavigationUtil.navigationUl.children().children().each( function ( idx, elm ) {
            if ( $(elm).attr('data-toggle') ) return
            $(elm).click(scrollNavigationUtil.scrollToTopic);
        });

    },

    scrollHandler: function() {

        var windowOffset = Math.round(scrollNavigationUtil.html.offset().top);
        var headerHeight = Math.round(scrollNavigationUtil.header.height());

        scrollNavigationUtil.contentContainer.children('div.post').each( function ( idx, elm ) {

            if (Math.round($(elm).offset().top) + windowOffset >= headerHeight + 150 &&  Math.round($(elm).offset().top) + windowOffset <= headerHeight + 200 ) {

                scrollNavigationUtil.changeNavClasses( $('a#' + $(elm).attr('id') + "-link") );

            }
        })

    }
};





$(window).load(function(){
    scrollNavigationUtil.cacheElementPointers();
    scrollNavigationUtil.addScrollToLinks();

//    addPopoverToPeeps();

    if ($('.carousel')) $('.carousel').carousel()

    // add thumbnail class to work examples
    $('ul.thumbnails li a').addClass('thumbnail');

    // TODO: move rest into namespaced methods
    // logo parallax effect
    var movementStrength = 15;
    var height = movementStrength / $(window).height();
    var width = movementStrength / $(window).width();
    var logo = $('.logo img');
    $(".jumbotron").mousemove( function(e) {
        var pageX = e.pageX - (logo.width() / 2);
        var pageY = e.pageY - (logo.height() / 2);
        var newvalueX = width * pageX * -1;
        var newvalueY = height * pageY * -1;
        logo.css("background-position", newvalueX+"px "+newvalueY+"px");
    });
});