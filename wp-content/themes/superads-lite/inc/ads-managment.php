<?php
/**
 * SuperAds Theme Ads Functions
 *
 * @package SuperAds
 */

/**
|------------------------------------------------------------------------------
| Display Header Ads: 728x90
|------------------------------------------------------------------------------
*/

function superads_lite_ads_header () {
	$header_banner = html_entity_decode (get_theme_mod('superads_lite_banner_ad_header'), ENT_QUOTES);
	if ($header_banner) {
		?>
		<div class="ads-728x90 ads-top">
			<?php echo $header_banner ?>
		</div>
		
		<?php
	}
}

/**
|------------------------------------------------------------------------------
| Display After Main Navigation Ads: 970x90
|------------------------------------------------------------------------------
*/

function superads_lite_ads_after_main_nav() {

	$banner = html_entity_decode (get_theme_mod('superads_lite_banner_ad_under_nav'), ENT_QUOTES);

	if ($banner) {
		?>
		<div class="ads-970x90 clearfix">
			<?php echo $banner ?>
		</div>
		<?php
	}
}

/**
|------------------------------------------------------------------------------
| Display Ads After Slideshow Ads: 468x60
|------------------------------------------------------------------------------
*/

function superads_lite_ads_bellow_slideshow() {
		
	$banner = html_entity_decode (get_theme_mod('superads_lite_banner_ad_under_slideshow'), ENT_QUOTES);

	if ( (is_home() || is_front_page()) && $banner ) :
		?>
		<div class="ads-468x60">
			<?php echo $banner ?>
		</div>
		<?php
	endif;
}


/**
|------------------------------------------------------------------------------
| Display Ad Before Footer Ads: 970x90
|------------------------------------------------------------------------------
*/

function superads_lite_ads_before_footer() {

	$banner = html_entity_decode (get_theme_mod('superads_lite_banner_ad_footer'), ENT_QUOTES);

	if ($banner) {
		?>
			<div class="ads-970x90 clearfix">
				<?php echo $banner ?>
			</div>
		<?php
	}
}

if (!function_exists('superads_lite_ad_managment')) :

	/**
	|------------------------------------------------------------------------------
	| Ads Managment
	|------------------------------------------------------------------------------
	| 
	| Three ads postion on single post
	| 
	| 1. After post title (Postions: left, center or right)
	| 2. Middle post content (Position: left, center or right)
	| 3. Below post content (Position: left, center or right)
	| 
	| @return void
	|
	*/

	function superads_lite_ad_managment($content) {
		global $post;

		if (!is_single()) return $content;


		$today = date_create(date('Y-m-d'));
		$published = date_create(get_the_date('Y-m-d', $post->ID));
		$interval = date_diff($today, $published);
		$age = $interval->format('%a');

		if ($before_content = get_theme_mod('superads_lite_ads_before_content')) {
				$content = '<div class="ads-banner-block top-single-ads '. get_theme_mod('superads_lite_ads_before_content_align') .'">' . html_entity_decode ($before_content, ENT_QUOTES) . '</div>' . $content;
		}

		if ($middle_content = get_theme_mod('superads_lite_ads_middle_content')) {
				$content =  superads_lite_ad_middle_content($content, '<div class="ads-banner-block middle-single-ads '. get_theme_mod('superads_lite_ads_middle_content_align') .'">' .  html_entity_decode ($middle_content, ENT_QUOTES) . '</div>');
		}
			
		if ($after_content = get_theme_mod('superads_lite_ads_after_content')) {
				$content = $content . '<div class="ads-banner-block below-single-ads '. get_theme_mod('superads_lite_ads_after_content_align') .'">' . html_entity_decode ($after_content, ENT_QUOTES) . '</div>';
		}
		

		return $content;

	}

	add_filter('the_content', 'superads_lite_ad_managment');

endif;

/**
|------------------------------------------------------------------------------
| Render ads middle post content
|------------------------------------------------------------------------------
| 
| @return string
|
*/
 
function superads_lite_ad_middle_content( $content, $middle_ad ) {

	$content = explode("</p>", $content);
    $new_content = '';
    $paragraphAfter = round(count($content)/2); //Enter number of paragraphs to display ad after.

    for ($i = 0; $i < count($content); $i++) {

        if ($i == $paragraphAfter) {
          $new_content .= $middle_ad;
        }

        $new_content.= $content[$i] . "</p>";
    }

    return $new_content;
}