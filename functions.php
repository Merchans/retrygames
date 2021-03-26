<?php

	// Define url for child theme
	define('RETRY_PATH_HOME', dirname( __FILE__ ));


	// Style CSS For PARENT THEME
	add_action( 'wp_enqueue_scripts', 'bootscore_5_child_enqueue_styles' );
	function bootscore_5_child_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	}

	// WooCommerce For PARENT THEME
	require get_template_directory() . '/woocommerce/woocommerce-functions.php';

	/**
	 * Customizer additions.
	 */
	require_once RETRY_PATH_HOME . '/inc/customizer.php';
	require_once RETRY_PATH_HOME . '/inc/woocommerce.php';

	add_theme_support( 'custom-background' );


	// Breadcrumb
	if ( ! function_exists( 'the_breadcrumb' ) ) :
		function the_breadcrumb() {
			if ( ! is_home() ) {
				echo '<nav class="breadcrumb mb-4 mt-4 p-4 bg-light rounded">';
				echo '<a href="' . home_url( '/' ) . '">' . ( '<i class="fas fa-home"></i>' ) . '</a><span class="divider">&nbsp;/&nbsp;</span>';
				if ( is_category() || is_single() ) {
					the_category( ' <span class="divider">&nbsp;/&nbsp;</span> ' );
					if ( is_single() ) {
						echo ' <span class="divider">&nbsp;/&nbsp;</span> ';
						the_title();
					}
				} elseif ( is_page() ) {
					echo the_title();
				}
				echo '</nav>';
			}
		}

		add_filter( 'breadcrumbs', 'breadcrumbs' );
	endif;
// Breadcrumb End



	// Widgets
	if ( ! function_exists( 'retrygames_widgets_init' ) ) :

		function retrygames_widgets_init() {

			// Footer 1
			register_sidebar( array(
					'name'          => esc_html__( 'Sidebar-right', 'retrygames' ),
					'id'            => 'sidebar-right',
					'description'   => esc_html__( 'Add widgets here.', 'retrygames' ),
					'before_widget' => '<section id="%1$s" class="widget %2$s card card-body mb-4 bg-light border-0">',
					'after_widget'  => '</section>',
					'before_title'  => '<h2 class="widget-title card-title border-bottom py-2">',
					'after_title'   => '</h2>',
			) );
			// Footer 1 End

		}

		add_action( 'widgets_init', 'retrygames_widgets_init' );

	endif;
	// Widgets End


	/**
	 * Enqueue scripts and styles.
	 */
	function retrygames_scripts() {
		// Flexlider javascript and CSS files
		wp_enqueue_script( 'flexslider-min-js', get_bloginfo( 'stylesheet_directory' ) . '/inc/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '', true );
		wp_enqueue_style( 'flexslider-css', get_bloginfo( 'stylesheet_directory' ) . '/inc/flexslider/flexslider.css', array(), '', 'all' );
		wp_enqueue_script( 'flexslider-js', get_bloginfo( 'stylesheet_directory' ) . '/inc/flexslider/flexslider.js', array( 'jquery' ), '', true );

	}

	add_action( 'wp_enqueue_scripts', 'retrygames_scripts' );
