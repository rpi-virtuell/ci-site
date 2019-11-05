/* Custom JS */
"use strict ";
jQuery(function ($) {

    if ($('.archive-sidebar').length > 0) {
        $sidebar = $('.archive-sidebar');
        $contentColumn = $('.results');
        $contentHeader = $('header');
        $sidebar.prepend('<div class="sidebarswitch">Info </div><div class="sidebarClose">+</div>');


        if ($sidebar.hasClass('archive-sidebar-books')) {
            //  console.log($('.archive-sidebar-books'));
            $('.sidebarswitch').text('Filter ');
        }

        $('.sidebarswitch').on('click', function (e) {
            $(this).parent().toggleClass('open');
            $contentColumn.toggleClass('fade');
            $contentHeader.toggleClass('fade');
        });
        $('.sidebarClose').on('click', function (e) {
            $(this).parent().toggleClass('open');
            $contentColumn.toggleClass('fade');
            $contentHeader.toggleClass('fade');
        })
    }
    /* Close maincontent container on person detail page when without content*/
    if ($('.person .mainContentWrapper').length > 0) {
        $mainContentWrapper = $('.person .mainContentWrapper .row .col-sm-12 ');
         $profile = $('.sidebarBox .profile');
        $personFunction = $('.sidebarBox .profile .sidebarFunctionWrapper');

        if (!$mainContentWrapper.text().trim().length) {
            $mainContentWrapper.empty();
            $mainContentWrapper.prepend($profile);
        }
    }
    /* Scroll to top on FacetWP Ajax Refresh*/
    $(document).on('facetwp-loaded', function() {
        if (FWP.loaded) {
            $('html, body').animate({
                scrollTop: $('.facetwp-template').offset().top
            }, 500);
        }
    });
});