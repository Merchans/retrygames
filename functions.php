<?php

	// Style CSS
	add_action( 'wp_enqueue_scripts', 'bootscore_5_child_enqueue_styles' );
	function bootscore_5_child_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	}

	// WooCommerce
	require get_template_directory() . '/woocommerce/woocommerce-functions.php';


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

	/**
	 * Change several of the breadcrumb defaults
	 */
	add_filter( 'woocommerce_breadcrumb_defaults', 'retrygames_woocommerce_breadcrumbs' );
	function retrygames_woocommerce_breadcrumbs() {
		return array(
				'delimiter'   => '&nbsp;/&nbsp;',
				'wrap_before' => '<nav class="breadcrumb mb-4 mt-4 p-4 bg-light rounded" itemprop="breadcrumb">',
				'wrap_after'  => '</nav>',
				'before'      => '',
				'after'       => '',
				'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
		);
	}

	function woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) :
				the_post();
				wc_get_template_part( 'content', 'single-product' );
			endwhile;

		}  else {
			?>

			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

			<?php endif; ?>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( woocommerce_product_loop() ) : ?>

				<?php do_action( 'woocommerce_before_shop_loop' ); ?>

				<?php woocommerce_product_loop_start(); ?>

				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action( 'woocommerce_after_shop_loop' ); ?>

			<?php
			else :
				do_action( 'woocommerce_no_products_found' );
			endif;
		}
	}


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
