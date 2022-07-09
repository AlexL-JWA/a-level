<?php
/**
 * Main class theme A-Level.
 *
 * @package iwpdev/alevel
 */

namespace Alevel;

/**
 * Main class file.
 */
class Main {

	/**
	 * Main construct
	 */
	public function __construct() {
		$this->init();
	}

	/**
	 * Init hooks.
	 *
	 * @return void
	 */
	public function init(): void {
		add_action( 'wp_enqueue_scripts', [ $this, 'add_script' ] );
		add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );

		add_filter( 'mime_types', [ $this, 'add_support_mimes' ] );
		add_filter( 'get_custom_logo', [ $this, 'output_logo' ] );
	}

	/**
	 * Add scripts and style.
	 *
	 * @return void
	 */
	public function add_script(): void {
		wp_enqueue_script(
			'build',
			get_template_directory_uri() . '/assets/js/build.js',
			[
				'jquery',
				'mixitup',
			],
			ALEVEL_VERSION,
			true
		);

		wp_enqueue_script( 'mixitup', get_template_directory_uri() . '/assets/js/mixitup.min.js', [ 'jquery' ], '3.3.1', true );

		wp_enqueue_script( 'html5shiv', '//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', [], '3.7.0', false );
		wp_enqueue_script( 'respond', '//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', [], '1.4.2', false );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

		wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css2?family=Inter:wght@300;400;500;700;900&amp;family=Montserrat:wght@700&amp;display=swap', '', ALEVEL_VERSION );
		wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css', '', ALEVEL_VERSION );
		wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', '', ALEVEL_VERSION );
	}

	/**
	 * Add SVG and Webp formats to upload.
	 *
	 * @param array $mimes Mimes type.
	 *
	 * @return array
	 */
	public function add_support_mimes( array $mimes ): array {

		$mimes['webp'] = 'image/webp';
		$mimes['svg']  = 'image/svg+xml';

		return $mimes;
	}

	/**
	 * Theme support.
	 *
	 * @return void
	 */
	public function add_theme_support(): void {

		// add custom logo.
		add_theme_support( 'custom-logo', [ 'unlink-homepage-logo' => true ] );

		// add menu support.
		add_theme_support( 'menus' );

		register_nav_menus(
			[
				'top_bar_menu' => __( 'Меню верхньої панелі', 'alevel' ),
				'main_menu'    => __( 'Головне меню', 'alevel' ),
			]
		);
	}

	/**
	 * Change output custom logo.
	 *
	 * @param string $html HTML custom logo.
	 *
	 * @return string
	 */
	public function output_logo( string $html ): string {

		$home  = esc_url( get_bloginfo( 'url' ) );
		$class = 'logo';
		if ( has_custom_logo() ) {
			$logo    = wp_get_attachment_image(
				get_theme_mod( 'custom_logo' ),
				'full',
				false,
				[
					'class'    => 'logo',
					'itemprop' => 'logo',
				]
			);
			$content = $logo;

			$content .= '<span class="sr-only">' . get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' ) . '</span>';

			$html = sprintf(
				'<a href="%s" class="%s" rel="home" itemprop="url">%s</a>',
				$home,
				$class,
				$content
			);

		}

		return $html;
	}

	/**
	 * Output select change city.
	 *
	 * @return void
	 */
	public static function get_city_in_select(): void {
		$menu_name = 'top_bar_menu';
		$locations = get_nav_menu_locations();

		if ( $locations && isset( $locations[ $menu_name ] ) ) {

			$menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );
			?>
			<label for="city" class="hidden"></label>
			<select name="city" id="city">
				<?php
				foreach ( (array) $menu_items as $menu_item ) {
					?>
					<option value="<?php echo esc_html( $menu_item->title ); ?>"><?php echo esc_html( $menu_item->title ); ?></option>
					<?php
				}
				?>
			</select>
			<?php
		}
	}
}
