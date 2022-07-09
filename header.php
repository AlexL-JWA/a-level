<?php
/**
 * Header template.
 *
 * @package iwpdev/alevel
 */

$page_class = '';

if ( is_front_page() ) {
	$page_class = 'home';
}
?>
<!DOCTYPE html>
<html style="margin-top:0 !important" <?php language_attributes(); ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo( 'name' ); ?> | <?php bloginfo( 'description' ); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class( $page_class ); ?>>
<header>
	<div class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-content-middle vc_row-flex top-head">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_column vc_column_container vc_col-sm-12">
						<div class="burger-menu"></div>
						<div class="dfr">
							<?php
							wp_nav_menu(
								[
									'theme_location' => 'top_bar_menu',
									'container'      => '',
									'menu_class'     => 'city dfr',
									'echo'           => true,
									'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								]
							);
							?>
							<div class="dfr">
								<a class="call-back icon-phone"><?php esc_html_e( 'Передзвонити', 'alevel' ); ?></a>
								<div class="language dfr">
									<div class="radio-button">
										<input id="ua" type="radio" name="language" value="Ua" checked>
										<label for="ua">Ua</label>
									</div>
									<div class="radio-button">
										<input id="ru" type="radio" name="language" value="Ru">
										<label for="ru">Ru</label>
									</div>
								</div>
								<a class="consultation icon-service" href="#">
									<?php esc_html_e( 'Безкоштовна консультацiя', 'alevel' ); ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="vc_row wpb_row vc_inner vc_row-fluid vc_row-o-content-middle vc_row-flex bottom-head">
		<div class="wpb_column vc_column_container vc_col-sm-12">
			<div class="vc_column-inner">
				<div class="wpb_wrapper">
					<div class="wpb_column vc_column_container vc_col-sm-12 dfr">
						<?php the_custom_logo(); ?>
						<div class="hide">
							<div class="dfr">
								<div class="select">
									<?php \Alevel\Main::get_city_in_select(); ?>
								</div>
								<div class="language dfr">
									<div class="radio-button">
										<input id="ua-header" type="radio" name="language-header" value="Ua" checked>
										<label for="ua-header">Ua</label>
									</div>
									<div class="radio-button">
										<input id="ru-header" type="radio" name="language-header" value="Ru">
										<label for="ru-header">Ru</label>
									</div>
								</div>
								<a class="button icon-phone" href="#"></a><a class="button icon-service" href="#"></a>
							</div>
						</div>
						<?php
						wp_nav_menu(
							[
								'theme_location'  => 'main_menu',
								'container'       => '',
								'container_class' => '',
								'menu_class'      => 'menu dfr',
								'echo'            => true,
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
							]
						);
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>