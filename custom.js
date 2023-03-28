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
        $personbody = $('#person-body');

        if (!$mainContentWrapper.text().trim().length) {
            $mainContentWrapper.empty();
            $personbody.prepend($profile);
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
	
	$(document).ready(function(){
		
		var openlinks = $('.single-event a[href *= "/wp-content/uploads/"], .single-post a[href *= "/wp-content/uploads/"], .single-product a[href *= "/wp-content/uploads/"],.single-publikation a[href *= "/wp-content/uploads/"]' );
		
		if(openlinks.length > 0 && openlinks.length < 10){
			
			$('.single .sideBarWrapper ').first().append($('<div class="sidebarBox downloads"><h3><i class="fas fa-file-download"></i> Downloads</h3><ul></ul></div>'));
			
			$.each(openlinks, function(key,value){
			
				console.log('openlinks', value.href);
				console.log('openlinks', value.text);
				
				var button = $('<li><a class="openaccess" style="max-width:150px" href="'+value.href+'" title="'+value.textContent+'">'+value.textContent+'</a></li>');
				
				$('.single .sideBarWrapper .sidebarBox.downloads ul').first().append(button);
			});
		}
		
	});
});