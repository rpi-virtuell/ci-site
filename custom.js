/* Custom JS */

jQuery(function ($) {

    if ($('.archive-sidebar').length > 0) {
$archiveSidebar = $('.archive-sidebar');
$contentColumn = $('.results');
$contentHeader = $('header');
$archiveSidebar.prepend('<div class="sidebarswitch">Info</div>');
$archiveSidebar.on('click',function(e){
    $(this).toggleClass('open');
    $contentColumn.toggleClass('fade');
    $contentHeader.toggleClass('fade');
})
    }
})