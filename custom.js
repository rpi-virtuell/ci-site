/* Custom JS */

jQuery(function ($) {

    if ($('.archive-sidebar').length > 0) {
$archiveSidebar = $('.archive-sidebar');
$archiveSidebar.prepend('<div class="sidebarswitch">Informationen</div>');
    }
})