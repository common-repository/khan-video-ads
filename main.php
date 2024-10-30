<?php
/*
Plugin Name: Khan Video Ads
Version: 1.0
Plugin URI: https://mufthai.com/khan-viideo-ads.zip
Author: Samiullah Kaifi
Author URI: https://mufthai.com/
Description: Display Google Ads, Html5 Video Ads, Images & Text Ads on Youtube, Vimeo Iframe or Pretty Embed Url Ads with easy controls.
License: GPL2
*/

// Import Javascript
add_action( 'wp_enqueue_scripts', 'khan_video_advertise' );
function khan_video_advertise() {
	wp_enqueue_style( 'video-overlay-main-css', plugin_dir_url( __FILE__ ) .  '/css/main.css' );
	  $post_id = get_the_ID();
	  $posts_array = array(get_option('video-ad-post'));
	 // echo '<pre>'; print_r($posts_array); echo '</pre>';
if(get_option('video-ad-post')==0)
{
    	wp_enqueue_script( 'video_overlay_localized', plugin_dir_url( __FILE__ ) .  '/js/main.js', array( 'jquery' ) );
	
	}else{
if ( ($key = array_search($post_id, $posts_array)) !== false) {
    	wp_enqueue_script( 'video_overlay_localized', plugin_dir_url( __FILE__ ) .  '/js/main.js', array( 'jquery' ) );

}
	}
	  $posts_array_page = array(get_option('video-ad-page'));
if(get_option('video-ad-page')==0)
{
	    	wp_enqueue_script( 'video_overlay_localized', plugin_dir_url( __FILE__ ) .  '/js/main.js', array( 'jquery' ) );
	
	}else{
if ( ($key = array_search($post_id, $posts_array_page)) !== false) {
    	wp_enqueue_script( 'video_overlay_localized', plugin_dir_url( __FILE__ ) .  '/js/main.js', array( 'jquery' ) );

}
	}



	wp_localize_script('video_overlay_localized', 'VideoOverlayAds', array( 'overlay_inner_html' => get_option('video-overlay-inner-html'), 'overlay_close_button' => get_option('video-overlay-display-close-btn'), 'overlay_video_advertis' => get_option('video-ad-html5'), 'overlay_video_ad_time' => get_option('video-ad-time'), 'overlay_video_ad_skip_time' => get_option('video-ad-skip-time'), 'overlay_video_ad_post' => get_option('video-ad-post'), 'overlay_video_ad_page' => get_option('video-ad-page') ));

	// Enqueued script with localized data.
	wp_enqueue_script( 'video_overlay_localized' );
}

// Create Custom Plugin Settings Menu
add_action('admin_menu', 'video_overlay_create_menu');
function video_overlay_create_menu() {
	//create new top-level menu
	add_options_page('Khan Video Ads', 'Khan Video Ads', 'administrator', __FILE__, 'video_overlay_settings_page');
	//call register settings function
	add_action( 'admin_init', 'video_overlay_register_mysettings' );
}
// Plugin Setting Menu
function video_overlay_settings_page() {
?>
<div class="wrap">
    <h2>Video Overlay Ads Settings</h2>
    <div class="video-overlay-ads-optionform-holder">
        <form method="post" action="options.php">
            <?php settings_fields( 'video-overlay-settings' ); ?>
            <?php settings_fields( 'video-overlay-settings' ); ?>
            <?php settings_fields( 'video-overlay-settings' ); ?>
            <?php settings_fields( 'video-overlay-settings' ); ?>
            <?php settings_fields( 'video-overlay-settings' ); ?>
            <?php settings_fields( 'video-overlay-settings' ); ?>
            <?php settings_fields( 'video-overlay-settings' ); ?>
            
            
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Enter Your Ad. Text, Image, Video, Gif etc</th>
                    <td>


<hr />


                      
					  <?php 
					  $content = get_option('video-overlay-inner-html');
    wp_editor( $content, 'video-overlay-inner-html' );
					  
					   ?> 

                   </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Display close button</th>
                    <td><input type="checkbox" name="video-overlay-display-close-btn" <?php if ( get_option('video-overlay-display-close-btn') == 1 || get_option('video-overlay-display-close-btn') == 'on' ) echo 'checked="checked"'; ?> /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Enter 1 if Ad Type is Video (Insert Only Html5 Video Ad)</th>
                    <td>
                <input type="text" name="video-ad-html5" value="<?php echo get_option('video-ad-html5'); ?>"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Ad Display Time</th>
                    <td>
                    <span>1000 = 1 second </span>
                    <input type="text" name="video-ad-time" value="<?php echo get_option('video-ad-time'); ?>"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row">User Can Skip Ad After Time</th>
                  <td>
                    <span>1000 = 1 second </span>                  
                  <input type="text" name="video-ad-skip-time" value="<?php echo get_option('video-ad-skip-time'); ?>"/></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Show Ad on Post</th>
                  <td>
                    <span>For All Post Enter 0 For Specfic Post Enter like 5,6,9 </span>                  
                  <input type="text" name="video-ad-post" value="<?php echo get_option('video-ad-post'); ?>"/></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Show Ad on Pages</th>
                  <td>
                    <span>For All Pages Ad Enter 0 For Specfic Pages Enter like 5,6,9 </span>                  
                  <input type="text" name="video-ad-page" value="<?php echo get_option('video-ad-page'); ?>"/></td>
                </tr>



            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <div class="video-overlay-ads-righttip-holder">
        <h2>Thank You</h2>
        <p>Need Help. You can review on plugin to ask any query</p>
        <p>https://www.w3schools.com/html/html5_video.asp</p>
        <h3>Html5 Video Source Code Example</h3>
            <p>Video Must be muted for autoplay</p>
            &lt;video id=&quot;sampleMovie&quot; width=&quot;640&quot; height=&quot;360&quot; preload controls&gt;
	&lt;source src=&quot;HTML5Sample_H264.mov&quot; type='video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;' /&gt;
	&lt;source src=&quot;HTML5Sample_Ogg.ogv&quot; type='video/ogg; codecs=&quot;theora, vorbis&quot;' /&gt;
	&lt;source src=&quot;HTML5Sample_WebM.webm&quot; type='video/webm; codecs=&quot;vp8, vorbis&quot;' /&gt;
&lt;/video&gt;
    </div>
<style>
.video-overlay-ads-optionform-holder{
    display: block;
    float: left;
    width: 70%;
    margin: 0;
    padding: 10px;
}
.video-overlay-ads-righttip-holder{
    display: block;
    float: left;
    width: 25%;
    background: #dedede;
    border: 1px solid #fff;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    padding: 10px;
    margin: 0;
    margin-top: 30px;
}


.video-ad-skip{
    position: absolute;
    z-index: 999;
    right: 18;
    color: #fff !important;		
} 
@media screen and (max-width: 1080px) {
    .video-overlay-ads-optionform-holder{
        width: 100%;
    }
    .video-overlay-ads-righttip-holder{
        width: 100%;
    }
}
</style>
</div>
<?php 
}

// Register settings
function video_overlay_register_mysettings() {
	//register our settings
	register_setting( 'video-overlay-settings', 'video-overlay-inner-html' );
	register_setting( 'video-overlay-settings', 'video-overlay-display-close-btn' );
	register_setting( 'video-overlay-settings', 'video-ad-html5' );
	register_setting( 'video-overlay-settings', 'video-ad-time' );
	register_setting( 'video-overlay-settings', 'video-ad-skip-time' );
	register_setting( 'video-overlay-settings', 'video-ad-post' );
	register_setting( 'video-overlay-settings', 'video-ad-page' );

}

?>