<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

<?php
	elegant_description();
	elegant_keywords();
	elegant_canonical();

	/**
	 * Fires in the head, before {@see wp_head()} is called. This action can be used to
	 * insert elements into the beginning of the head before any styles or scripts.
	 *
	 * @since 1.0
	 */
	do_action( 'et_head_meta' );

	$template_directory_uri = get_template_directory_uri();
?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
	$product_tour_enabled = et_builder_is_product_tour_enabled();
	$page_container_style = $product_tour_enabled ? ' style="padding-top: 0px;"' : ''; ?>
	<div id="page-container"<?php echo et_core_intentionally_unescaped( $page_container_style, 'fixed_string' ); ?>>
<?php
	if ( $product_tour_enabled || is_page_template( 'page-template-blank.php' ) ) {
		return;
	}

	$et_secondary_nav_items = et_divi_get_top_nav_items();

	$et_phone_number = $et_secondary_nav_items->phone_number;

	$et_email = $et_secondary_nav_items->email;

	$et_contact_info_defined = $et_secondary_nav_items->contact_info_defined;

	$show_header_social_icons = $et_secondary_nav_items->show_header_social_icons;

	$et_secondary_nav = $et_secondary_nav_items->secondary_nav;

	$et_top_info_defined = $et_secondary_nav_items->top_info_defined;

	$et_slide_header = 'slide' === et_get_option( 'header_style', 'left' ) || 'fullscreen' === et_get_option( 'header_style', 'left' ) ? true : false;
?>

	<?php if ( $et_top_info_defined && ! $et_slide_header || is_customize_preview() ) : ?>
		<?php ob_start(); ?>
		<div id="top-header"<?php echo $et_top_info_defined ? '' : 'style="display: none;"'; ?>>
			<div class="container clearfix">

			<?php if ( $et_contact_info_defined ) : ?>

				<div id="et-info">
				<?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
					<span id="et-info-phone"><?php echo et_core_esc_previously( et_sanitize_html_input_text( $et_phone_number ) ); ?></span>
				<?php endif; ?>

				<?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
					<a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>"><span id="et-info-email"><?php echo esc_html( $et_email ); ?></span></a>
				<?php endif; ?>

				<?php
				if ( true === $show_header_social_icons ) {
					get_template_part( 'includes/social_icons', 'header' );
				} ?>
				</div> <!-- #et-info -->

			<?php endif; // true === $et_contact_info_defined ?>

				<div id="et-secondary-menu">
				<?php
					if ( ! $et_contact_info_defined && true === $show_header_social_icons ) {
						get_template_part( 'includes/social_icons', 'header' );
					} else if ( $et_contact_info_defined && true === $show_header_social_icons ) {
						ob_start();

						get_template_part( 'includes/social_icons', 'header' );

						$duplicate_social_icons = ob_get_contents();

						ob_end_clean();

						printf(
							'<div class="et_duplicate_social_icons">
								%1$s
							</div>',
							et_core_esc_previously( $duplicate_social_icons )
						);
					}

					if ( '' !== $et_secondary_nav ) {
						echo et_core_esc_wp( $et_secondary_nav );
					}

					et_show_cart_total();
				?>
				</div> <!-- #et-secondary-menu -->

			</div> <!-- .container -->
		</div> <!-- #top-header -->
	<?php
		$top_header = ob_get_clean();

		/**
		 * Filters the HTML output for the top header.
		 *
		 * @since 3.10
		 *
		 * @param string $top_header
		 */
		echo et_core_intentionally_unescaped( apply_filters( 'et_html_top_header', $top_header ), 'html' );
	?>
	<?php endif; // true ==== $et_top_info_defined ?>

	<?php if ( $et_slide_header || is_customize_preview() ) : ?>
		<?php ob_start(); ?>
		<div class="et_slide_in_menu_container">
			<?php if ( 'fullscreen' === et_get_option( 'header_style', 'left' ) || is_customize_preview() ) { ?>
				<span class="mobile_menu_bar et_toggle_fullscreen_menu"></span>
			<?php } ?>

			<?php
				if ( $et_contact_info_defined || true === $show_header_social_icons || false !== et_get_option( 'show_search_icon', true ) || class_exists( 'woocommerce' ) || is_customize_preview() ) { ?>
					<div class="et_slide_menu_top">

					<?php if ( 'fullscreen' === et_get_option( 'header_style', 'left' ) ) { ?>
						<div class="et_pb_top_menu_inner">
					<?php } ?>
			<?php }

				if ( true === $show_header_social_icons ) {
					get_template_part( 'includes/social_icons', 'header' );
				}

				et_show_cart_total();
			?>
			<?php if ( false !== et_get_option( 'show_search_icon', true ) || is_customize_preview() ) : ?>
				<?php if ( 'fullscreen' !== et_get_option( 'header_style', 'left' ) ) { ?>
					<div class="clear"></div>
				<?php } ?>
				<form role="search" method="get" class="et-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
						printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
							esc_attr__( 'Search &hellip;', 'Divi' ),
							get_search_query(),
							esc_attr__( 'Search for:', 'Divi' )
						);

						/**
						 * Fires inside the search form element, just before its closing tag.
						 *
						 * @since ??
						 */
						do_action( 'et_search_form_fields' );
					?>
					<button type="submit" id="searchsubmit_header"></button>
				</form>
			<?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

			<?php if ( $et_contact_info_defined ) : ?>

				<div id="et-info">
				<?php if ( '' !== ( $et_phone_number = et_get_option( 'phone_number' ) ) ) : ?>
					<span id="et-info-phone"><?php echo et_core_esc_previously( et_sanitize_html_input_text( $et_phone_number ) ); ?></span>
				<?php endif; ?>

				<?php if ( '' !== ( $et_email = et_get_option( 'header_email' ) ) ) : ?>
					<a href="<?php echo esc_attr( 'mailto:' . $et_email ); ?>"><span id="et-info-email"><?php echo esc_html( $et_email ); ?></span></a>
				<?php endif; ?>
				</div> <!-- #et-info -->

			<?php endif; // true === $et_contact_info_defined ?>
			<?php if ( $et_contact_info_defined || true === $show_header_social_icons || false !== et_get_option( 'show_search_icon', true ) || class_exists( 'woocommerce' ) || is_customize_preview() ) { ?>
				<?php if ( 'fullscreen' === et_get_option( 'header_style', 'left' ) ) { ?>
					</div> <!-- .et_pb_top_menu_inner -->
				<?php } ?>

				</div> <!-- .et_slide_menu_top -->
			<?php } ?>

			<div class="et_pb_fullscreen_nav_container">
				<?php
					$slide_nav = '';
					$slide_menu_class = 'et_mobile_menu';

					$slide_nav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'echo' => false, 'items_wrap' => '%3$s' ) );
					$slide_nav .= wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'container' => '', 'fallback_cb' => '', 'echo' => false, 'items_wrap' => '%3$s' ) );
				?>

				<ul id="mobile_menu_slide" class="<?php echo esc_attr( $slide_menu_class ); ?>">

				<?php
					if ( '' === $slide_nav ) :
				?>
						<?php if ( 'on' === et_get_option( 'divi_home_link' ) ) { ?>
							<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a></li>
						<?php }; ?>

						<?php show_page_menu( $slide_menu_class, false, false ); ?>
						<?php show_categories_menu( $slide_menu_class, false ); ?>
				<?php
					else :
						echo et_core_esc_wp( $slide_nav ) ;
					endif;
				?>

				</ul>
			</div>
		</div>
	<?php
		$slide_header = ob_get_clean();

		/**
		 * Filters the HTML output for the slide header.
		 *
		 * @since 3.10
		 *
		 * @param string $top_header
		 */
		echo et_core_intentionally_unescaped( apply_filters( 'et_html_slide_header', $slide_header ), 'html' );
	?>
	<?php endif; // true ==== $et_slide_header ?>

	<?php ob_start(); ?>
		<header id="main-header" data-height-onload="<?php echo esc_attr( et_get_option( 'menu_height', '66' ) ); ?>">
			<div class="container clearfix et_menu_container">
			<?php
				$logo = ( $user_logo = et_get_option( 'divi_logo' ) ) && ! empty( $user_logo )
					? $user_logo
					: $template_directory_uri . '/images/logo.png';

				ob_start();
			?>
				<div class="logo_container">
					<span class="logo_helper"></span>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo" data-height-percentage="<?php echo esc_attr( et_get_option( 'logo_height', '54' ) ); ?>" />
					</a>
				</div>
			<?php
				$logo_container = ob_get_clean();

				/**
				 * Filters the HTML output for the logo container.
				 *
				 * @since 3.10
				 *
				 * @param string $logo_container
				 */
				echo et_core_intentionally_unescaped( apply_filters( 'et_html_logo_container', $logo_container ), 'html' );
			?>
				<div id="et-top-navigation" data-height="<?php echo esc_attr( et_get_option( 'menu_height', '66' ) ); ?>" data-fixed-height="<?php echo esc_attr( et_get_option( 'minimized_menu_height', '40' ) ); ?>">
					<?php if ( ! $et_slide_header || is_customize_preview() ) : ?>
						<nav id="top-menu-nav">
						<?php
							$menuClass = 'nav';
							if ( 'on' === et_get_option( 'divi_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
							$primaryNav = '';

							$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ) );
							if ( empty( $primaryNav ) ) :
						?>
							<ul id="top-menu" class="<?php echo esc_attr( $menuClass ); ?>">
								<?php if ( 'on' === et_get_option( 'divi_home_link' ) ) { ?>
									<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'Divi' ); ?></a></li>
								<?php }; ?>

								<?php show_page_menu( $menuClass, false, false ); ?>
								<?php show_categories_menu( $menuClass, false ); ?>
							</ul>
						<?php
							else :
								echo et_core_esc_wp( $primaryNav );
							endif;
						?>
						</nav>
					<?php endif; ?>

					<?php
					if ( ! $et_top_info_defined && ( ! $et_slide_header || is_customize_preview() ) ) {
						et_show_cart_total( array(
							'no_text' => true,
						) );
					}
					?>

					<?php if ( $et_slide_header || is_customize_preview() ) : ?>
						<span class="mobile_menu_bar et_pb_header_toggle et_toggle_<?php echo esc_attr( et_get_option( 'header_style', 'left' ) ); ?>_menu"></span>
					<?php endif; ?>

					<?php if ( ( false !== et_get_option( 'show_search_icon', true ) && ! $et_slide_header ) || is_customize_preview() ) : ?>
					<div id="et_top_search">
						<span id="et_search_icon"></span>
					</div>
					<?php endif; // true === et_get_option( 'show_search_icon', false ) ?>

					<?php

					/**
					 * Fires at the end of the 'et-top-navigation' element, just before its closing tag.
					 *
					 * @since 1.0
					 */
					do_action( 'et_header_top' );

					?>
				</div> <!-- #et-top-navigation -->
			</div> <!-- .container -->
			<div class="et_search_outer">
				<div class="container et_search_form_container">
					<form role="search" method="get" class="et-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php
						printf( '<input type="search" class="et-search-field" placeholder="%1$s" value="%2$s" name="s" title="%3$s" />',
							esc_attr__( 'Search &hellip;', 'Divi' ),
							get_search_query(),
							esc_attr__( 'Search for:', 'Divi' )
						);

						/**
						 * Fires inside the search form element, just before its closing tag.
						 *
						 * @since ??
						 */
						do_action( 'et_search_form_fields' );
					?>
					</form>
					<span class="et_close_search_field"></span>
				</div>
			</div>
		</header> <!-- #main-header -->
	<?php
		$main_header = ob_get_clean();

		/**
		 * Filters the HTML output for the main header.
		 *
		 * @since 3.10
		 *
		 * @param string $main_header
		 */
		echo et_core_intentionally_unescaped( apply_filters( 'et_html_main_header', $main_header ), 'html' );
	?>
		<div id="et-main-area">
	<?php
		/**
		 * Fires after the header, before the main content is output.
		 *
		 * @since 3.10
		 */
		do_action( 'et_before_main_content' );

?>
			<!--
<div class="loadContainer">
    <div id="corak">
        <svg id="corakLogo" xmlns="http://www.w3.org/2000/svg" width="2877" height="517" viewBox="0 0 2877 517" fill="none">
            <path id="path5"
                d="M2365.97 508H2420.64V366L2451.71 350.267C2468.64 341.6 2493.71 328.933 2507.17 322C2520.77 315.067 2532.37 309.333 2533.04 309.333C2533.71 309.333 2540.64 314.267 2548.37 320.267C2573.71 339.733 2614.91 371.067 2662.51 407.067C2676.77 417.867 2689.31 427.467 2690.24 428.4C2691.17 429.333 2697.97 434.533 2705.31 440C2718.64 450.133 2755.71 478.267 2781.04 497.6L2794.64 508H2835.84C2858.51 508 2876.77 507.733 2876.51 507.6C2876.24 507.333 2861.04 495.733 2842.64 482C2824.37 468.133 2803.97 452.667 2797.31 447.467C2790.77 442.267 2774.24 429.733 2760.64 419.467C2718.51 387.733 2703.97 376.667 2703.31 375.867C2702.77 375.333 2679.71 357.867 2659.44 342.8C2656.11 340.267 2652.64 337.467 2651.84 336.8C2650.91 336 2648.64 334.133 2646.51 332.667C2644.51 331.2 2641.31 328.8 2639.44 327.2C2637.57 325.733 2623.84 315.333 2608.91 304.133C2594.11 292.933 2582.24 283.2 2582.77 282.533C2583.17 281.867 2649.44 248.4 2730.11 208.133L2876.77 135.067L2852.51 134.267C2839.17 133.733 2814.37 133.333 2797.57 133.333H2766.91L2738.11 148.133C2722.24 156.4 2705.71 164.933 2701.31 167.333C2696.91 169.733 2681.97 177.467 2667.97 184.667C2633.44 202.4 2611.17 214 2599.97 220C2594.91 222.8 2578.91 231.067 2564.64 238.4C2514.24 264.267 2493.17 275.067 2485.31 279.333C2458.77 293.733 2422.24 311.867 2421.57 311.067C2421.04 310.667 2420.64 240.4 2420.64 155.067V0H2365.97V508Z"
                fill="#FF3300" />
            <path id="path1"
                d="M245.975 134.133C223.841 135.467 195.708 138.933 178.641 142.667C161.175 146.4 130.908 155.2 127.975 157.333C127.308 157.867 125.175 158.8 123.308 159.333C118.508 160.667 88.3747 175.867 85.8413 178.133C84.7747 179.2 83.308 180 82.6413 180C79.8413 180 56.2413 199.467 45.8413 210.267C18.3747 238.933 5.30799 270.133 0.641324 318.667C-2.69201 352.8 7.17466 393.867 25.4413 421.733C34.508 435.333 58.6413 458.933 73.9747 469.067C97.4413 484.533 127.575 497.6 156.641 504.667C164.375 506.533 172.775 508.533 175.308 509.333C183.441 511.467 211.175 514.533 236.375 516.133C288.641 519.2 345.175 512 387.308 496.933C436.375 479.333 468.375 452.267 488.508 411.6C497.175 394.133 499.841 386.8 497.575 386C483.441 381.467 447.041 370.533 446.775 370.933C446.641 371.2 445.041 375.2 443.441 380C433.975 406.8 416.241 428.8 392.908 442.667C369.441 456.533 333.175 467.067 295.975 470.8C273.441 473.067 222.641 471.6 199.975 468.133C124.375 456.4 74.508 420.667 59.0413 367.067C56.2413 357.733 55.9747 353.867 56.108 330C56.108 307.067 56.508 301.867 59.0413 292.933C73.4413 240.4 116.908 204.133 185.575 187.333C212.375 180.667 232.775 178.667 270.641 178.667C309.575 178.8 336.508 182.133 360.641 190.133C373.175 194.267 393.441 205.467 403.441 213.867C418.775 226.8 433.575 247.333 439.975 264.267C441.308 267.867 442.641 270.667 443.175 270.667C444.508 270.667 490.508 254.667 492.508 253.467C493.975 252.533 492.775 249.2 486.775 237.067C469.841 202.8 445.708 178.667 411.308 161.333C389.041 150.133 350.108 139.467 318.908 136.133C304.775 134.533 259.841 133.333 245.975 134.133Z"
                fill="#545454" />
            <path id="path2"
                d="M857.975 134.267C835.041 135.333 807.841 139.333 782.641 145.333C758.508 151.067 720.641 167.067 700.641 180C658.108 207.6 634.908 238.4 623.841 282.133C620.908 294.267 620.108 300.533 619.575 319.733C618.908 343.733 619.975 354.533 624.775 373.467C640.641 437.067 698.775 485.467 783.975 506C807.841 511.733 825.708 514.133 857.441 516C900.108 518.4 943.041 514.933 979.975 506C1030.64 493.733 1070.64 472.933 1100.11 443.467C1123.04 420.267 1137.17 394 1143.57 362.267C1149.04 335.2 1147.04 295.2 1139.04 270.667C1124.51 226.4 1091.97 191.067 1043.31 167.067C991.841 141.467 930.908 130.8 857.975 134.267ZM930.241 180.667C980.775 187.2 1021.57 203.6 1050.77 228.667C1065.84 241.6 1079.57 262 1086.11 280.933C1093.71 303.067 1094.51 338.533 1088.11 362.267C1077.31 401.6 1047.17 431.867 998.508 451.867C974.108 461.867 949.175 467.867 920.108 470.667C898.508 472.8 847.041 471.733 827.308 468.667C782.375 461.733 744.908 445.867 715.441 421.333C701.308 409.467 685.575 387.067 680.241 370.667C676.508 359.2 672.641 338.133 672.641 328.667C672.641 265.467 705.308 222.133 772.375 196.133C779.975 193.2 791.708 189.467 798.375 188C805.175 186.4 813.041 184.533 815.975 183.867C836.641 178.8 901.841 176.933 930.241 180.667Z"
                fill="#545454" />
            <path id="path3"
                d="M1535.31 134.267C1495.84 135.867 1457.84 142.667 1426.51 153.467C1398.24 163.2 1373.71 176.267 1355.97 191.2L1346.64 198.933L1346.24 170.133L1345.97 141.333L1318.91 141.6L1291.97 142L1291.31 508H1345.71L1346.37 419.6C1346.91 338.4 1347.17 330.267 1349.57 317.333C1361.04 257.467 1397.44 214 1452.64 194.133C1464.37 189.867 1490.37 183.467 1504.64 181.467C1510.11 180.533 1525.31 179.6 1538.37 179.067L1561.97 178.267V133.333L1553.04 133.6C1547.97 133.733 1540.11 134 1535.31 134.267Z"
                fill="#545454" />
            <path id="path4"
                d="M1905.97 134.133C1870.91 136.533 1838.91 142.267 1813.57 150.8C1797.84 156.133 1765.17 171.2 1760.64 175.333C1759.44 176.4 1757.97 177.333 1757.44 177.333C1755.17 177.333 1730.77 196.8 1721.71 205.867C1699.97 227.6 1684.91 256.4 1678.37 288.667C1674.77 307.067 1675.04 347.867 1679.04 366.4C1692.91 430.667 1740.64 476.933 1819.31 502.267C1872.37 519.333 1955.84 521.467 2015.97 507.333C2056.64 497.733 2095.44 478.533 2119.31 456.133C2128.11 447.867 2131.71 446.267 2131.17 450.267C2131.04 451.6 2131.04 465.467 2131.17 481.067L2131.31 509.333L2158.37 509.067L2185.31 508.667V135.333H2130.64L2130.51 166.667C2130.51 183.867 2130.37 198.533 2130.24 199.067C2130.11 199.733 2126.51 197.333 2122.37 193.733C2102.37 176.933 2091.44 169.6 2072.51 160.8C2046.77 148.8 2010.51 139.333 1977.97 136C1962.91 134.533 1917.97 133.333 1905.97 134.133ZM1968.11 180.133C1981.84 181.467 2011.71 187.333 2021.97 190.8C2048.24 199.333 2073.44 213.067 2089.84 227.6C2098.38 235.067 2111.31 252 2116.64 262.667C2131.84 293.067 2134.51 337.333 2123.31 370.133C2106.64 418.267 2050.64 456 1976.64 468.667C1959.44 471.733 1912.24 472.8 1890.37 470.8C1817.84 464 1761.71 430.933 1739.57 382C1725.84 351.333 1725.04 308.133 1737.84 275.333C1745.71 254.933 1763.17 232.8 1782.11 218.933C1808.91 199.467 1843.71 186 1881.31 180.667C1896.37 178.533 1948.77 178.133 1968.11 180.133Z"
                fill="#545454" />
        </svg>
        <div id="loaderContainer">
            <svg id="smallerLoader" version="1.1" id="L7" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100"
                enable-background="new 0 0 100 100" xml:space="preserve">
                <path fill="#fff" d="M31.6,3.5C5.9,13.6-6.6,42.7,3.5,68.4c10.1,25.7,39.2,38.3,64.9,28.1l-3.1-7.9c-21.3,8.4-45.4-2-53.8-23.3
  c-8.4-21.3,2-45.4,23.3-53.8L31.6,3.5z">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
                <path fill="#fff" d="M42.3,39.6c5.7-4.3,13.9-3.1,18.1,2.7c4.3,5.7,3.1,13.9-2.7,18.1l4.1,5.5c8.8-6.5,10.6-19,4.1-27.7
  c-6.5-8.8-19-10.6-27.7-4.1L42.3,39.6z">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                        from="0 50 50" to="-360 50 50" repeatCount="indefinite" />
                </path>
                <path fill="#fff" d="M82,35.7C74.1,18,53.4,10.1,35.7,18S10.1,46.6,18,64.3l7.6-3.4c-6-13.5,0-29.3,13.5-35.3s29.3,0,35.3,13.5
  L82,35.7z">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="2s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>

-->