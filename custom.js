/* Custom JS */

jQuery(function ($) {

    if ($('.archive-sidebar').length > 0) {
        $archiveSidebar = $('.archive-sidebar');
        $contentColumn = $('.results');
        $contentHeader = $('header');
        $archiveSidebar.prepend('<div class="sidebarswitch">Info </div><div class="sidebarClose">+</div>');
        $('.sidebarswitch').on('click', function (e) {
            $(this).parent().toggleClass('open');
            $contentColumn.toggleClass('fade');
            $contentHeader.toggleClass('fade');
        });
        $('.sidebarClose').on('click',function (e) {
            $(this).parent().toggleClass('open');
            $contentColumn.toggleClass('fade');
            $contentHeader.toggleClass('fade');
        })
    }
});