<?php

	// Style CSS
	 add_action( 'wp_enqueue_scripts', 'bootscore_5_child_enqueue_styles' );
	 function bootscore_5_child_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 		  }

    // WooCommerce
    require get_template_directory() . '/woocommerce/woocommerce-functions.php';


add_theme_support( 'custom-background' );


// Creating the widget
	class retrygames_widget extends WP_Widget {

// The construct part
		function __construct() {
			parent::__construct(

			// Base ID of your widget
				'retrygames_widget',

				// Widget name will appear in UI
				__('User Profile', 'wpb_widget_domain'),

				// Widget description
				array( 'description' => __( 'Show user profile', 'wpb_widget_domain' ), )
			);
		}

// Creating widget front-end
		public function widget( $args, $instance ) {
			?>
			<?php if ( is_user_logged_in() && !is_account_page()  ) : ?>
				<div class="card">
					<img src="https://scontent-prg1-1.xx.fbcdn.net/v/t1.0-9/134188997_10158826458064477_166935472331858616_o.jpg?_nc_cat=111&ccb=2&_nc_sid=e3f864&_nc_ohc=WwfvZ3dTW14AX98gWP_&_nc_oc=AQnhjGFMBOAlBmaMTndBDNADw29FNlzvcnKf0GmP6awYIFv4UvB8M1h3-rJW-71bkJc&_nc_ht=scontent-prg1-1.xx&oh=725aaee8199f8280d05c726f7df4a239&oe=6046B09F" alt="Cover" class="card-img-top">
					<div class="card-body text-center">
						<?php
							global $current_user;

							print_r(get_the_author_meta());
							$current_user_avatar_url = get_avatar_url( $current_user->ID );
						?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
							<img src="<?php echo $current_user_avatar_url?>" style="width:75px; height:75px; margin-top:-65px" alt="User" class="avatar img-thumbnail rounded-circle border-0">
						</a>
						<h6 class="card-title user-name">
							<?php echo $current_user->user_firstname; echo " " ; echo $current_user->user_lastname; ?>
						</h6>
						<p class="text-secondary mb-1">@<?php echo $current_user->display_name?></p>
						<p class="card-text">
							<?php echo get_user_meta($current_user->ID, 'description', true); ?>
						</p>
					</div>

					<div class="card-footer d-flex justify-content-between">
						<div class="cart <?php echo ( esc_html( WC()->cart->get_cart_contents_count() ) > 0 ) ? "item-in-cart" : ""; ?>"  data-toggle="tooltip" data-toggle="bottom" data-placement="bottom" title="Košík">
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
								<i class="fas fa-shopping-basket fa-1x"></i>
								<?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?>
							</a>
						</div>
						<!--				<div class="number-of-comments" data-toggle="tooltip" data-toggle="bottom" data-placement="bottom" title="Počet komentářů k&nbsp;jednotlivým článkům">-->
						<!--					<i class="fa fa-comment fa-1x"></i>-->
						<!--					--><?php //echo get_user_count_comments(); ?>
						<!--				</div>-->
						<a data-toggle="tooltip" data-toggle="bottom" data-placement="bottom" title="Nastavení účtu" href="<?php echo get_edit_profile_url(); ?>">
							<i class="fas fa-user-cog fa-1x"></i>
						</a>
						<a data-toggle="tooltip" data-toggle="bottom" data-placement="bottom" title="Odhlášení" href="<?php echo esc_url( wp_logout_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) );?>">
							<i class="fas fa-sign-out-alt fa-1x"></i>
						</a>
					</div>
				</div>
			<?php endif ?>
			<?php if ( !is_user_logged_in()) : ?>
				<?php
				$errors = isset($_GET['login']) ? explode(',', $_GET['login'] ) : [];

				foreach ( $errors as $error )
				{
					if ($error == 'empty_username') {
						$formHTML .=  '<strong>CHYBA</strong>: Uživatelské jméno nebylo zadáno.<br>';
					}

					if ($error == 'empty_password') {
						$formHTML .= '<strong>CHYBA</strong>: Heslo nebylo zadáno.<br>';
					}

					if ($error == 'invalid_username') {
						$formHTML .= 'Neznámé uživatelské jméno. Zkontrolujte si uživatelské jméno, nebo zadejte e-mailovou adresu.<br>';
					}

					if ($error == 'incorrect_password') {
						$formHTML .= '<strong>CHYBA</strong>: Chybně zadané heslo pro uživatelské jméno <strong>root</strong>.<br> <a href="'. esc_url( wp_lostpassword_url() )  .'">Zapomněli jste heslo?</a><br>';
					}
				}
				?>
				<?php if ( !empty($formHTML) ) : ?>
					<div class="bubble bubble-bottom-left shake" >
						<?php echo $formHTML;?>
					</div>
				<?php endif ?>
				<div class="user_card">
					<div class="d-flex justify-content-center">
						<div class="brand_logo_container">
							<img src="https://scontent.fprg1-1.fna.fbcdn.net/v/t1.0-9/134214919_10158826457274477_8519539489887121657_n.png?_nc_cat=107&amp;ccb=2&amp;_nc_sid=09cbfe&amp;_nc_ohc=eyTI3MajqCgAX94_46W&amp;_nc_ht=scontent.fprg1-1.fna&amp;oh=e71b7e4064e744aa901d95ec4eea9bb8&amp;oe=60290AF2" class="brand_logo" alt="Logo">
						</div>
					</div>
					<?php $args = array(
						'echo' => false,
					);
						$form = wp_login_form( $args );
						//add the placeholders
						$form = str_replace('name="log"', 'name="log" placeholder="Přezdívka nebo e-mail"', $form);
						$form = str_replace('name="pwd"', 'name="pwd" placeholder="Heslo"', $form);
						$form = str_replace('<label for="user_login">Uživatelské jméno nebo e-mail</label>', '<label for="user_login" class="input-group-text"><i class="fas fa-user"></i></label>', $form);
						$form = str_replace('<label for="user_pass">Heslo</label>', '<label for="user_pass" class="input-group-text"><i class="fas fa-key"></i></label>', $form);
						$form = str_replace('<p class="login-username">', '<p class="login-username input-group">', $form);
						$form = str_replace('<p class="login-password">', '<p class="login-password input-group">', $form);
						$form = str_replace('class="input"', 'class="input form-control input_pass"', $form);

						echo $form; ?>
					<div class="d-flex justify-content-center links">
						Nemáte účet?
						<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="ml-2">
							Přihlásit se</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">Zapomněli jste heslo?</a>
					</div>
				</div>
			<?php endif ?>
			<?php
		}

// Creating widget Backend
		public function form( $instance ) {

		}

// Updating widget replacing old instances with new
		public function update( $new_instance, $old_instance ) {

		}

// Class wpb_widget ends here
	}

// Register and load the widget
	function wpb_load_widget() {
		register_widget( 'retrygames_widget' );
	}
	add_action( 'widgets_init', 'wpb_load_widget' );
