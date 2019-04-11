/* Custom JS */
"use strict ";
jQuery(function ($) {

    if ($('.archive-sidebar').length > 0) {
        $sidebar = $('.archive-sidebar');
        $contentColumn = $('.results');
        $contentHeader = $('header');
        $sidebar.prepend('<div class="sidebarswitch">Info </div><div class="sidebarClose">+</div>');


        if ($sidebar.hasClass('archive-sidebar-books')) {
            console.log($('.archive-sidebar-books'));
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

});