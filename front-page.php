<?php

	/*
	Template Name: Home Page
	*/

	get_header();
?>
<div class="content-area">
	<main>
		<div class="row">
			<section class="slider mt-4 co-12">
				<div class="flexslider">
					<ul class="slides">
						<?php
							for ( $i = 1; $i < 4; $i ++ ) :
								// Getting data from Customizer to display the Slider section
								$slider_page[ $i ]        = get_theme_mod( 'set_slider_page' . $i );
								$slider_button_text[ $i ] = get_theme_mod( 'set_slider_button_text' . $i );
								$slider_button_url[ $i ]  = get_theme_mod( 'set_slider_button_url' . $i );
							endfor;

							$args = array(
									'post_type'      => 'page',
									'posts_per_page' => 3,
									'post__in'       => $slider_page,
									'orderby'        => 'post__in'
							);

							$slider_loop = new WP_Query( $args );
							$j           = 1;
							if ( $slider_loop->have_posts() ):
								while ( $slider_loop->have_posts() ):
									$slider_loop->the_post();
									?>
									<li>
										<?php the_post_thumbnail( 'retrygames-slider', array( 'class' => 'img-fluid' ) ); ?>
										<div class="container">
											<div class="slider-details-container">
												<div class="slider-title">
													<h1><?php the_title(); ?></h1>
												</div>
												<div class="slider-description">
													<div class="subtitle"><?php the_content(); ?></div>
													<a class="link btn btn-primary"
													   href="<?php echo esc_url( $slider_button_url[ $j ] ); ?>"><?php echo esc_html( $slider_button_text[ $j ] ); ?></a>
												</div>
											</div>
										</div>
									</li>
									<?php
									$j ++;
								endwhile;
								wp_reset_postdata();
							endif;
						?>
					</ul>
				</div>
			</section>
		</div>
		<!--<div class="video-row">-->
		<!--	<section class="video-background">-->
		<!--		<div class="video-foreground">-->
		<!--			<iframe src="https://www.youtube.com/embed/hsZRKyK_2Io?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=hsZRKyK_2Io&mute=1"-->
		<!--					frameborder="0" allowfullscreen></iframe>-->
		<!--		</div>-->
		<!--	</section>-->
		<!--</div>-->
		<div class="row"></div>
		<?php
			/*----------------------------------------------------------------------------------------------*/
			// We'll only show these sections if WooCommerce is ative
			if ( class_exists( 'WooCommerce' ) ):
				?>
				<section class="popular-products pt-4">
					<?php

						// Getting data from Customizer to display the Popular Products section
						$popular_limit  = get_theme_mod( 'set_popular_max_num', 3 );
						$popular_col    = get_theme_mod( 'set_popular_max_col', 3 );
						$arrivals_limit = get_theme_mod( 'set_new_arrivals_max_num', 3 );
						$arrivals_col   = get_theme_mod( 'set_new_arrivals_max_col', 3 );

					?>
					<div class="container">
						<div class="section-title">
							<h2><?php echo esc_html( get_theme_mod( 'set_popular_title', __( 'Popular products', 'retrygames' ) ) ); ?></h2>
						</div>
						<?php
							echo do_shortcode( '[products limit=" ' . esc_attr( $popular_limit ) . ' " columns=" ' . esc_attr( $popular_col ) . ' " orderby="popularity" ]' );
						?>
					</div>
				</section>
				<section class="lab-blog">
					<div class="container p-4">
						<div class="section-title">
							<h2><?php echo esc_html( get_theme_mod( 'set_blog_title', __( 'News From Our Blog', 'retrygames' ) ) ); ?></h2>
						</div>
						<div class="row" data-masonry='{"percentPosition": true }'>
							<?php


								$args = array(
										'post_type'           => 'post',
										'posts_per_page'      => 6,
										'ignore_sticky_posts' => true,
								);

								$blog_posts = new WP_Query( $args );

								if ( $blog_posts->have_posts() ):
									while ( $blog_posts->have_posts() ): $blog_posts->the_post();
										?>
										<div class="col-md-6 col-lg-4 col-xxl-3 mb-4">

											<div class="card">

												<?php the_post_thumbnail( 'medium', array( 'class' => 'card-img-top' ) ); ?>

												<div class="card-body">

													<?php bootscore_category_badge(); ?>

													<h2 class="blog-post-title">
														<a href="<?php the_permalink(); ?>">
															<?php the_title(); ?>
														</a>
													</h2>

													<?php if ( 'post' === get_post_type() ) : ?>

														<small class="text-muted mb-2">
															<?php
																bootscore_date();
																bootscore_author();
																bootscore_comments();
																bootscore_edit();
															?>
														</small>

													<?php endif; ?>

													<div class="card-text">
														<?php the_excerpt(); ?>
													</div>

													<div class="">
														<a class="read-more"
														   href="<?php the_permalink(); ?>"><?php _e( 'Read more »', 'bootscore' ); ?></a>
													</div>

													<?php bootscore_tags(); ?>

												</div><!-- card-body -->

											</div><!-- card -->

										</div><!-- col -->

									<?php
									endwhile;
									wp_reset_postdata();
								else:
									?>
									<p><?php esc_html_e( 'Nothing to display', 'retrygames' ) ?></p>
								<?php endif; ?>
						</div>
					</div>
				</section>

				<?php

				// Getting data from Customizer to display the Deal of the Week section
				$showdeal = get_theme_mod( 'set_deal_show', 0 );
				$deal     = get_theme_mod( 'set_deal' );
				$currency = get_woocommerce_currency_symbol();
				$regular  = get_post_meta( $deal, '_regular_price', true );
				$sale     = get_post_meta( $deal, '_sale_price', true );

				// We'll only show this section if the user chooses to do so and if some deal product is set
				if ( $showdeal == 1 && ( ! empty( $deal ) ) ):
					$discount_percentage = absint( 100 - ( ( $sale / $regular ) * 100 ) );
					?>
					<section class="deal-of-the-week woocommerce ">
						<div class="container">
							<div class="card p-4 mt-4 mb-4 col-md-6 m-auto ml-5">
								<div class="section-title">
									<h2><?php echo esc_html( get_theme_mod( 'set_deal_title', __( 'Deal of the Week', 'retrygames' ) ) ); ?></h2>
								</div>
								<div class="row d-flex align-items-center">
									<div class="deal-img col-md-6 col-12 ml-auto text-center">
										<?php echo get_the_post_thumbnail( $deal, 'large', array( 'class' => 'img-fluid' ) ); ?>
									</div>
									<div class="deal-desc col-md-6 col-12 mr-auto text-center">
										<?php if ( ! empty( $sale ) ): ?>
											<strong class="discount badge bg-danger">
												<?php echo esc_html( $discount_percentage ); ?><?php esc_html_e( '%', 'retrygames' ) ?>
											</strong>
										<?php endif; ?>
										<h3>
											<a href="<?php echo esc_url( get_permalink( $deal ) ) ?>"><?php echo esc_html( get_the_title( $deal ) ); ?></a>
										</h3>
										<p><?php echo esc_html( get_the_excerpt( $deal ) ); ?></p>
										<div class="prices">
											<del>
												<strong class="regular woocommerce-Price-amount amount">
													<bdi>
														<?php echo esc_html( $regular );
															echo esc_html( $currency ); ?>
													</bdi>
												</strong>
											</del>
											<?php if ( ! empty( $sale ) ): ?>
												<ins>
												<span class="sale woocommerce-Price-amount amount">
													<bdi>
														<?php
															echo esc_html( $sale );
															echo esc_html( $currency );
														?>
													</bdi>
												</span>
												</ins>
											<?php endif; ?>
										</div>
										<div class="add-to-cart-container mt-auto">
										<a href="<?php echo esc_url( '?add-to-cart=' . $deal ); ?>"
										   class="add_to_cart_button product_type_simple single_add_to_cart_button btn btn-primary d-block ajax_add_to_cart"><?php esc_html_e( 'Add to Cart', 'retrygames' ) ?></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				<?php endif; ?><!-- End $showdeal/$deal verification -->
				<section class="new-arrivals p-4">
					<div class="container">
						<div class="section-title">
							<h2><?php echo esc_html( get_theme_mod( 'set_new_arrivals_title', __( 'New Arrivals', 'retrygames' ) ) ); ?></h2>
						</div>
						<?php echo do_shortcode( '[products limit=" ' . esc_attr( $arrivals_limit ) . ' " columns=" ' . esc_attr( $arrivals_col ) . ' " orderby="date" visibility="visible" ]' ); ?>
					</div>
				</section>

			<?php endif; ?>
		<!---------------------------------------------------------------------------------------------->
		<!-- End class_exists for WooCommerce -->

	</main>
</div>

<?php get_footer(); ?>
