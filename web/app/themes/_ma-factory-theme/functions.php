<?php

function theme_styles()  
{ 

	// Load all of the styles that need to appear on all pages
	wp_enqueue_style( 'main', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js' );

}
add_action('wp_enqueue_scripts', 'theme_styles');



/*--------------------------------------------             
Dequeue Ultimate Member stylesheets 
---------------------------------------------*/

$um_priority = apply_filters( 'um_core_enqueue_priority', 100 );
add_action( 'wp_enqueue_scripts',  'gbfl_dequeue_um_scripts', $um_priority + 1);
function gbfl_dequeue_um_scripts() {
	/*
	 *	Fonticons
	 *		um_fonticons_ii
	 *		um_fonticons_fa
	 *	
	 *	Select2
	 *		select2
	 *	
	 *	Modal
	 *		um_modal
	 *	
	 *	Plugin CSS
	 *		um_styles
	 *		um_members
	 *		um_profile
	 *		um_account
	 *		um_misc
	 *	
	 *	File Upload
	 *		um_fileupload
	 *	
	 *	Datetime Picker
	 *		um_datetime
	 *		um_datetime_date
	 *		um_datetime_time
	 *	
	 *	Raty
	 *		um_raty
	 *	
	 *	Scrollbar
	 *		um_scrollbar
	 *	
	 *	Image Crop
	 *		um_crop
	 *	
	 *	Tipsy
	 *		um_tipsy
	 *	
	 *	Responsive
	 *		um_responsive
	 *	
	 *	RTL
	 *		um_rtl
	 *	
	 *	Default CSS
	 *		um_default_css
	 *	
	 *	Old CSS
	 *		um_old_css
	 */
	wp_dequeue_style('um_default_css');
	// wp_dequeue_style('um_responsive');
	wp_dequeue_style('um_styles');
	// wp_dequeue_style('um_profile');
	// wp_dequeue_style('um_account');
	/*wp_dequeue_style('um_members');*/
	wp_dequeue_style('um_misc');
	wp_dequeue_style('um_old_default_css');
	wp_dequeue_style('um_old_css');
}

// To remove an unwanted user role
// function wps_remove_role() {
//     remove_role( 'user_role' );
// }
// add_action( 'init', 'wps_remove_role' );


// function numeric_pagination() {
 
//     if( is_singular() )
//         return;
 
//     global $wp_query;
 
//     /** Stop execution if there's only 1 page */
//     if( $wp_query->max_num_pages <= 1 )
//         return;
 
//     $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
//     $max   = intval( $wp_query->max_num_pages );
 
//     /** Add current page to the array */
//     if ( $paged >= 1 )
//         $links[] = $paged;
 
//     /** Add the pages around the current page to the array */
//     if ( $paged >= 3 ) {
//         $links[] = $paged - 1;
//         $links[] = $paged - 2;
//     }
 
//     if ( ( $paged + 2 ) <= $max ) {
//         $links[] = $paged + 2;
//         $links[] = $paged + 1;
//     }
 
//     echo '<div class="pagination"><ul>' . "\n";
 
//     /** Previous Post Link */
//     if ( get_previous_posts_link() )
//         printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
 
//     /** Link to first page, plus ellipses if necessary */
//     if ( ! in_array( 1, $links ) ) {
//         $class = 1 == $paged ? ' class="active"' : '';
 
//         printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
//         if ( ! in_array( 2, $links ) )
//             echo '<li>…</li>';
//     }
 
//     /** Link to current page, plus 2 pages in either direction if necessary */
//     sort( $links );
//     foreach ( (array) $links as $link ) {
//         $class = $paged == $link ? ' class="active"' : '';
//         printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
//     }
 
//     /** Link to last page, plus ellipses if necessary */
//     if ( ! in_array( $max, $links ) ) {
//         if ( ! in_array( $max - 1, $links ) )
//             echo '<li>…</li>' . "\n";
 
//         $class = $paged == $max ? ' class="active"' : '';
//         printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
//     }
 
//     /** Next Post Link */
//     if ( get_next_posts_link() )
//         printf( '<li>%s</li>' . "\n", get_next_posts_link() );
 
//     echo '</ul></div>' . "\n";
 
// }

if( !function_exists( 'numeric_pagination' ) ) {
	
    function numeric_pagination($total_posts) {
	
	global $wp_query, $wp_rewrite;
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
		'base' => @add_query_arg('page','%#%'),
		'format' => '',
		'total' => $total_posts,
		'current' => $current,
	        'show_all' => false,
	        'end_size'     => 1,
	        'mid_size'     => 2,
		'type' => 'list',
		'next_text' => 'Suivant',
		'prev_text' => 'Précédent'
	);
	
	if( $wp_rewrite->using_permalinks() )
		$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );
	
	if( !empty($wp_query->query_vars['s']) )
		$pagination['add_args'] = array( 's' => str_replace( ' ' , '+', get_query_var( 's' ) ) );
		
	echo str_replace('page/1/','', paginate_links( $pagination ) );
    }	
}