! function (e) {
    var tabsBar = $(".tabs-navigation");
    var tabsBarWidth = tabsBar.outerWidth();
    var totalWidth = 0;
    var tabsItem = tabsBar.find("li");

    tabsItem.each(function () {
        totalWidth += $(this).outerWidth();
    })
    console.log(totalWidth);

    if (totalWidth > tabsBarWidth) {
        $(".scroll-btn").removeClass("inactive");
    } else {
        $(".scroll-btn").addClass("inactive");
    }

    if ($(".nav-tabs").scrollLeft() == 0) {
        $(".scroll-btn.left").addClass("inactive");
    } else {
        $(".scroll-btn.left").removeClass("inactive");
    }
    var liWidth = tabsItem.outerWidth();
    var liCount = tabsItem.length;
    var scrollWidth = liWidth * liCount;

    $(".right").on("click", function () {
        $(".nav-tabs").animate({
            scrollLeft: "+=100px"
        }, 300);
        console.log($(".nav-tabs").scrollLeft() + " px");
    });

    $(".left").on("click", function () {
        $(".nav-tabs").animate({
            scrollLeft: "-=100px"
        }, 300);
    });
    scrollerHide()

    function scrollerHide() {
        var scrollLeftPrev = 0;
        $(".nav-tabs").scroll(function () {
            var $elem = $(".nav-tabs");
            var newScrollLeft = $elem.scrollLeft(),
                width = $elem.outerWidth(),
                scrollWidth = $elem.get(0).scrollWidth;
            if (scrollWidth - newScrollLeft == width) {
                $(".right.scroll-btn").addClass("inactive");
            } else {

                $(".right.scroll-btn").removeClass("inactive");
            }
            if (newScrollLeft === 0) {
                $(".left.scroll-btn").addClass("inactive");
            } else {

                $(".left.scroll-btn").removeClass("inactive");
            }
            scrollLeftPrev = newScrollLeft;
        });
    }
}(jQuery);