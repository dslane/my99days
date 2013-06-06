<?php
/**
 * Functions - general template functions that are used throughout EvoLve
 *
 * @package evolve
 * @subpackage Functions
 */

 
 
function evolve_media() {
  $template_url = get_template_directory_uri();
  $options = get_option('evolve');
  $evolve_css_data = '';
  
  $evl_pos_button = evl_get_option('evl_pos_button','disable');
  $evl_css_content = evl_get_option('evl_css_content','');
  
  $evl_header_slider = evl_get_option('evl_header_slider', 'disable');
  $evl_bootstrap = evl_get_option('evl_bootstrap', '1');
  
	if( is_admin() ) return;
	wp_enqueue_script( 'hoverIntent' );
  wp_enqueue_script( 'jquery' );  
  if ($evl_header_slider == "" || $evl_header_slider == "disable") { } else { wp_enqueue_script( 'carousel', EVLJS . '/carousel.js' ); }
  wp_enqueue_script( 'tipsy', EVLJS . '/tipsy.js' );
  wp_enqueue_script( 'fields', EVLJS . '/fields.js' );
  if ($evl_pos_button == "disable" || $evl_pos_button == "") {} else { wp_enqueue_script( 'jquery_scroll', EVLJS . '/jquery.scroll.pack.js' ); }      
	wp_enqueue_script( 'supersubs', EVLJS . '/supersubs.js' );
	wp_enqueue_script( 'superfish', EVLJS . '/superfish.js' );
  wp_enqueue_script( 'buttons', EVLJS . '/buttons.js' );
  
		$blog_title = evl_get_option('evl_title_font');
		$blog_tagline = evl_get_option('evl_tagline_font');
		$post_title = evl_get_option('evl_post_font');
		$content_font = evl_get_option('evl_content_font');	
    $heading_font = evl_get_option('evl_heading_font');			

		
		$selected_fonts[0] = $blog_title['face'];
		$selected_fonts[1] = $blog_tagline['face'];
		$selected_fonts[2] = $post_title['face'];
		$selected_fonts[3] = $content_font['face'];
    $selected_fonts[4] = $heading_font['face'];
		
		
		$font_face_all = '';
		$j = 0;
		$font_storage[] = '';
		for ( $i=0; $i<5; $i++ ) {		
		if (in_array($selected_fonts[$i], $font_storage )) {}
 	else {
			$font_storage[] = $selected_fonts[$i];
		$font_face = explode(',',$selected_fonts[$i]);	
		$font_face = str_replace(" ", "+", $font_face[0]);
			if($font_face != 'Arial' && $font_face != 'Georgia' && $font_face != 'Impact' && $font_face != 'Lucida+Sans+Unicode' && $font_face != 'Myriad+Pro*' && $font_face != 'Palatino+Linotype' && $font_face != 'Tahoma' && $font_face != 'Times+New+Roman' && $font_face != 'Trebuchet+MS' && $font_face != 'Verdana'){
				if($j>0){$ext = '|';} else {$ext = '';}
				$j++;
		$font_face = $ext.$font_face.':r,b,i';
		$font_face_all = $font_face_all.$font_face;	
			}
		}
		}
			if($font_face_all){
		wp_enqueue_style('googlefont', "http://fonts.googleapis.com/css?family=".$font_face_all);
		}
  
  
  // Bootstrap Elements
  
  if ($evl_bootstrap == "1" ) { 
  wp_enqueue_script( 'bootstrap', EVLJS . '/bootstrap/js/bootstrap.js' ); 
  wp_enqueue_style( 'bootstrapcss', EVLJS . '/bootstrap/css/bootstrap.css' );
  wp_enqueue_style( 'bootstrapcssresponsive', EVLJS . '/bootstrap/css/bootstrap-responsive.css' );  
  }    
  
  // Stylesheets
  
  wp_register_style('maincss', $template_url . '/style.css', false);
  wp_enqueue_style('maincss');
 
  // Custom Stylesheets
 
  require_once( get_template_directory() . '/custom-css.php' ); 
  
  // Custom CSS
  
  $evolve_css_data .= $evl_css_content;
  
  wp_add_inline_style( 'maincss', $evolve_css_data );
  
    
}

/**
 * remove_generator_link() Removes generator link
 *
 * @since 0.1
 * @credits http://www.plaintxt.org
 * @needsdoc
 */
function remove_generator_link() { return ''; }

/**
 * evolve_menu - adds css class to the <ul> tag in wp_page_menu.
 *
 * @since 0.3
 * @filter evolve_menu_ulclass
 * @needsdoc
 */
function evolve_menu_ulclass( $ulclass ) {
	$classes = apply_filters( 'evolve_menu_ulclass', (string) 'nav-menu' ); // Available filter: evolve_menu_ulclass
	return preg_replace( '/<ul>/', '<ul class="'. $classes .'">', $ulclass, 1 );
}

/**
 * evolve_nice_terms clever terms
 *
 * @since 0.2.3
 * @needsdoc
 */
function evolve_nice_terms( $term = '', $normal_separator = ', ', $penultimate_separator = ' and ', $end = '' ) {
	if ( !$term ) return;
	switch ( $term ):
		case 'cats':
			$terms = evolve_get_terms( 'cats', $normal_separator );
			break;
		case 'tags':
			$terms = evolve_get_terms( 'tags', $normal_separator );
			
			break;
	endswitch;
	if ( empty($term) ) return;
	$things = explode( $normal_separator, $terms );
	
	$thelist = '';
	$i = 1;
	$n = count( $things );
		
	foreach ( $things as $thing ) {
		
		$data = trim( $thing, ' ' );
		
		$links = preg_match( '/>(.*?)</', $thing, $link );
		$hrefs = preg_match( '/href="(.*?)"/', $thing, $href );
		$titles = preg_match( '/title="(.*?)"/', $thing, $title );
		$rels = preg_match( '/rel="(.*?)"/', $thing, $rel );
		
		if (1 < $i and $i != $n) {
			$thelist .= $normal_separator;
		}

		if (1 < $i and $i == $n) {
			$thelist .= $penultimate_separator;
		}
		$thelist .= '<a rel="'. $rel[1] .'" href="'. $href[1] .'"';
		if ( !$term = 'tags' )
			$thelist .= ' title="'. $title[1] .'"';
		$thelist .= '>'. $link[1] .'</a>';
		$i++;
	}
	$thelist .= $end;
	return apply_filters( 'evolve_nice_terms', (string) $thelist );
}

/**
 * evolve_get_terms() Returns other terms except the current one (redundant)
 *
 * @since 0.2.3
 * @usedby evolve_entry_footer()
 */
function evolve_get_terms( $term = NULL, $glue = ', ' ) {
	if ( !$term ) return;
	
	$separator = "\n";
	switch ( $term ):
		case 'cats':
			$current = single_cat_title( '', false );
			$terms = get_the_category_list( $separator );
			break;
		case 'tags':
			$current = single_tag_title( '', '',  false );
			$terms = get_the_tag_list( '', "$separator", '' );
			break;
	endswitch;
	if ( empty($terms) ) return;
	
	$thing = explode( $separator, $terms );
	foreach ( $thing as $i => $str ) {
		if ( strstr( $str, ">$current<" ) ) {
			unset( $thing[$i] );
			break;
		}
	}
	if ( empty( $thing ) )
		return false;

	return trim( join( $glue, $thing ) );
}

/**
 * evolve_get Gets template files
 *
 * @since 0.2.3
 * @needsdoc
 * @action evolve_get
 * @todo test this on child themes
 */
function evolve_get( $file = NULL ) {
	do_action( 'evolve_get' ); // Available action: evolve_get
	$error = "Sorry, but <code>{$file}</code> does <em>not</em> seem to exist. Please make sure this file exist in <strong>" . get_stylesheet_directory() . "</strong>\n";
	$error = apply_filters( 'evolve_get_error', (string) $error ); // Available filter: evolve_get_error
	if ( isset( $file ) && file_exists( get_stylesheet_directory() . "/{$file}.php" ) )
		locate_template( get_stylesheet_directory() . "/{$file}.php" );
	else
        echo $error;
}

/**
 * evlinclude_all() A function to include all files from a directory path
 *
 * @since 0.2.3
 * @credits k2
 */
function evlinclude_all( $path, $ignore = false ) {

	/* Open the directory */
	$dir = @dir( $path ) or die( 'Could not open required directory ' . $path );
	
	/* Get all the files from the directory */
	while ( ( $file = $dir->read() ) !== false ) {
		/* Check the file is a file, and is a PHP file */
		if ( is_file( $path . $file ) and ( !$ignore or !in_array( $file, $ignore ) ) and preg_match( '/\.php$/i', $file ) ) {
			require_once( $path . $file );
		}
	}		
	$dir->close(); // Close the directory, we're done.
}


/**
 * Gets the profile URI for the document being displayed.
 * @link http://microformats.org/wiki/profile-uris Profile URIs
 *
 * @since 0.2.4
 * @param integer $echo 0|1
 * @return string profile uris seperatd by spaces
 **/
function evlget_profile_uri( $echo = 1 ) {
	// hAtom profile
	$profile[] = 'http://purl.org/uF/hAtom/0.1/';
	
	// hCard, hCalendar, rel-tag, rel-license, rel-nofollow, VoteLinks, XFN, XOXO profile
	$profile[] = 'http://purl.org/uF/2008/03/';
	
	$profile = join( ' ', apply_filters( 'profile_uri',  $profile ) ); // Available filter: profile_uri
	
	if ( $echo ) echo $profile;
	else return $profile;
}

function evolve_copy() {

  $options = get_option('evolve');

  if (!empty($options['evl_affiliate_id'])) { $ad_affiliate_id = '?ap_id='.$options['evl_affiliate_id']; } else { $ad_affiliate_id = ''; } 

	$credits = '<p id="copyright"><span class="credits fl-r"><a href="http://theme4press.com/evolve/'.$ad_affiliate_id.'">EvoLve</a> theme by Theme4Press&nbsp;&nbsp;&bull;&nbsp;&nbsp;Powered by <a href="http://wordpress.org">WordPress</a></span> <a href="'. home_url() .'">'. get_bloginfo( 'name' ) .'</a><br /><small>'. get_bloginfo( 'description' ) .'</small></p>';
	echo apply_filters( 'evolve_copy', (string) $credits );
}

?>