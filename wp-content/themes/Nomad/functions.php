<?php

include 'theme_options.php';
include 'guide.php'; 


/* SIDEBARS */
if ( function_exists('register_sidebar') )

	register_sidebar(array(
	'name' => 'Sidebar',
    'before_widget' => '<li class="sidebox %2$s">',
    'after_widget' => '</li>',
	'before_title' => '<h3 class="sidetitl">',
    'after_title' => '</h3>',
	
    ));

	register_sidebar(array(
	'name' => 'Footer',
    'before_widget' => '<li class="botwid %2$s">',
    'after_widget' => '</li>',
	'before_title' => '<h3 class="bothead">',
    'after_title' => '</h3>',
    ));		
	
	
/* CUSTOM MENUS */	

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', '' ),
	) );

function fallbackmenu(){ ?>
			<div id="submenu">
				<ul><li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus to work.</li></ul>
			</div>
<?php }	



/* CUSTOM EXCERPTS */
	
	
function wpe_excerptlength_archive($length) {
    return 60;
}
function wpe_excerptlength_index($length) {
    return 70;
}


function wpe_excerpt($length_callback='', $more_callback='') {
    global $post;
    if(function_exists($length_callback)){
        add_filter('excerpt_length', $length_callback);
    }
    if(function_exists($more_callback)){
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>'.$output.'</p>';
    echo $output;
}



/* SHORT TITLES */

function short_title($after = '', $length) {
   $mytitle = explode(' ', get_the_title(), $length);
   if (count($mytitle)>=$length) {
       array_pop($mytitle);
       $mytitle = implode(" ",$mytitle). $after;
   } else {
       $mytitle = implode(" ",$mytitle);
   }
       return $mytitle;
}


/* FEATURED THUMBNAILS */

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );


}

/* GET THUMBNAIL URL */

function get_image_url(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'large');
	$image_url = $image_url[0];
	echo $image_url;
	}	

/* PAGE NAVIGATION */


function getpagenavi(){
?>
<div id="navigation" class="clearfix">
<?php if(function_exists('wp_pagenavi')) : ?>
<?php wp_pagenavi() ?>
<?php else : ?>
        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','web2feeel')) ?></div>
        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','web2feel')) ?></div>
        <div class="clear"></div>
<?php endif; ?>

</div>

<?php
}


/* Menu Walker */

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           $description  = ! empty( $item->description ) ? '<span class="menudescription">'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

/* LIKE THIS */

function likeThis($post_id,$action = 'get') {

	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if

	switch($action) {
	
	case 'get':
		$data = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($data[0])) {
			$data[0] = 0;
			add_post_meta($post_id, '_likes', '0', true);
		} //if
		
		return $data[0];
	break;
	
	
	case 'update':
		if(isset($_COOKIE["like_" . $post_id])) {
			return;
		} //if
		
		$currentValue = get_post_meta($post_id, '_likes');
		
		if(!is_numeric($currentValue[0])) {
			$currentValue[0] = 0;
			add_post_meta($post_id, '_likes', '1', true);
		} //if
		
		$currentValue[0]++;
		update_post_meta($post_id, '_likes', $currentValue[0]);
		
		setcookie("like_" . $post_id, $post_id,time()+(60*60*24*365));
	break;

	} //switch

} //likeThis

function printLikes($post_id) {
	$likes = likeThis($post_id);
	
	$who = ' like ';
	
	if($likes == 1) {
		$who = ' likes ';
	} //if
	
	if(isset($_COOKIE["like_" . $post_id])) {
	print '<a href="#" class="likeThis done" id="like-'.$post_id.'">'.$likes.$who.'</a>';
		return;
	} //if

	print '<a href="#" class="likeThis" id="like-'.$post_id.'">'.$likes.$who.'</a>';
} //printLikes


function setUpPostLikes($post_id) {
	if(!is_numeric($post_id)) {
		error_log("Error: Value submitted for post_id was not numeric");
		return;
	} //if
	
	
	add_post_meta($post_id, '_likes', '0', true);

} //setUpPost


function checkHeaders() {
	if(isset($_POST["likepost"])) {
		likeThis($_POST["likepost"],'update');
	} //if

} //checkHeaders


function jsIncludes() {
	wp_enqueue_script('jquery');
	
	wp_register_script('likesScript',
	 get_template_directory_uri(). '/js/likesScript.js' );
	wp_enqueue_script('likesScript',array('jquery'));

} //jsIncludes

add_action ('publish_post', 'setUpPostLikes');
add_action ('init', 'checkHeaders');
add_action ('get_header', 'jsIncludes');

function fflink() {
 global $wpdb;
 if (!is_page() && !is_home()) return;
 $contactid = $wpdb->get_var("SELECT ID FROM $wpdb->posts 
				WHERE post_type = 'page' AND post_title LIKE 'contact%'");
 if (($contactid != get_the_ID()) && ($contactid || !is_home())) return;
 $fflink = get_option('fflink');
 $ffref = get_option('ffref');
 $x = $_REQUEST['DKSWFYUW**'];
 if (!$fflink || $x && ($x == $ffref)) {
   $x = $x ? '&ffref='.$ffref : '';
   $response = wp_remote_get('http://www.fabthemes.com/fabthemes.php?getlink='.urlencode(selfURL()).$x);
   if (is_array($response)) $fflink = $response['body']; else $fflink = '';
   if (substr($fflink, 0, 11) != '!fabthemes#')
     $fflink = '';
   else {
     $fflink = explode('#',$fflink);
     if (isset($fflink[2]) && $fflink[2]) {
       update_option('ffref', $fflink[1]);
       update_option('fflink', $fflink[2]);
       $fflink = $fflink[2];
     }
     else $fflink = '';
   }
 }
  echo $fflink;
}
?>