/**
 * Khan Video Ads
 * Main Javascript Library
 */
(function( $ ) {
	"use strict";
	var jQuery;
	
	if (window.jQuery === undefined) {
	    
	    // Holly Cow We cant use jQuery
		// For now Do nothing

	} else {
	    jQuery = window.jQuery;
	    jQueryLoaded();
	}

	// jQuery load callback
	function jQueryLoaded(){

		jQuery( document ).ready(function() {


          if ( jQuery( ".pretty-embed" ).length ) {


		var scriptTags = document.getElementsByName('.pretty-embed img');
jQuery( "<div class='video-overlay-wrapper'>" ).insertBefore( ".pretty-embed" );
jQuery( ".pretty-embed" ).appendTo( ".video-overlay-wrapper" );

jQuery( "<div class='video-overlay-front'><a href='#' class='video-overlay-dismiss-btn video-overlay-dismiss'>× </a><div class='video-overlay-content-holder'>"+VideoOverlayAds.overlay_inner_html+"</div></div></div>" ).insertAfter( ".pretty-embed" );


/*<div class="video-overlay-front"><span class="video-ad-skip">You Can SKIP AD After 15 Second</span><a href="#" class="video-overlay-dismiss-btn video-overlay-dismiss">× </a>
<div class="video-overlay-content-holder"><img src="https://voluntarydba.files.wordpress.com/2018/08/youtube-play-button-overlay.png?w=1400"></div></div></div>
*/
}


			var scriptTags = document.getElementsByTagName('iframe');

			for(var i = 0; i < scriptTags.length; i++) {
				
				var scriptTag = scriptTags[i];
				
				if ( ytVidId( scriptTag.src ) ) {

					// This is a youtube embed, lets wrap it with a overlay
					addVideoOverlayAds(scriptTag);

				}else if( scriptTag.src.match(/https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/) ){
					// This is a Vimeo embed, lets wrap it with a overlay
					addVideoOverlayAds(scriptTag);
				}

			}

var videotime = VideoOverlayAds.overlay_video_ad_time;
var videoskiptime = VideoOverlayAds.overlay_video_ad_skip_time;
var vad = VideoOverlayAds.overlay_video_advertis;

			jQuery( ".video-overlay-dismiss-btn" ).on( "click", function(e) {
				
				e.preventDefault();
				if( jQuery(this).parent().hasClass('video-overlay-front') ){
					jQuery(this).parent().delay(videoskiptime).fadeOut("slow");
				}else if( jQuery(this).parent().parent().hasClass('video-overlay-front') ){
					jQuery(this).parent().parent().delay(videoskiptime).fadeOut("slow");
				}
			});
			
			jQuery(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {
        jQuery(".video-overlay-front").delay(videoskiptime).fadeOut("slow");
    }, videotime);
});
			
			

		});
		
	}

	function addVideoOverlayAds(scriptTag){
		jQuery(scriptTag).wrap( "<div class='video-overlay-wrapper'></div>" );

		var videoOverlayInnerContent = '<div class="video-overlay-front">';

		if( VideoOverlayAds.overlay_close_button == 1 || VideoOverlayAds.overlay_close_button == 'on' )
			videoOverlayInnerContent += '<img src="https://i.imgur.com/HPF9WAs.png" style="position:absolute;right:0;top:0;z-index:9999;"><a href="#" class="video-overlay-dismiss-btn video-overlay-dismiss">&times; </a>';

		videoOverlayInnerContent += '<div class="video-overlay-content-holder">';

		videoOverlayInnerContent += VideoOverlayAds.overlay_inner_html + '</div></div>';					

		jQuery('.video-overlay-wrapper').append(videoOverlayInnerContent);
	}

	function ytVidId( url ) {
		var p = /^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;
		return (url.match(p)) ? RegExp.$1 : false;
	}
	

	
	
})( jQuery );