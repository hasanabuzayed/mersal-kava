<?php
declare(strict_types=1);

/**
 * Post Formats module
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Kava_Post_Formats_Module' ) ) {

	/**
	 * Define Kava_Post_Formats_Module class
	 */
	class Kava_Post_Formats_Module extends Kava_Module_Base {

		private $post_formats = [ 'gallery', 'image', 'link', 'quote', 'video', 'audio' ];

		/**
		 * Module ID
		 *
		 * @return string
		 */
		public function module_id(): string {
			return 'post-formats';
		}

		/**
		 * Module actions
		 *
		 * @return void
		 */
		public function actions(): void {
			add_action( 'after_setup_theme', [ $this, 'support_post_formats' ], 6 );
			add_action( 'after_setup_theme', [ $this, 'add_meta_options' ], 6 );

			add_action( 'wp_enqueue_scripts', [ $this, 'register_assets' ], 9 );

			// Register default post formats
			foreach ( $this->post_formats as $format ) {
				add_action( 'kava_post_format_' . $format, [ $this, 'post_format_' . $format ] );
			}
		}

		/**
		 * Module filters
		 *
		 * @return void
		 */
		public function filters(): void {
			add_filter( 'kava-theme/assets-depends/script', [ $this, 'add_depends_scripts' ] );
			add_filter( 'kava-theme/assets-depends/styles', [ $this, 'add_depends_styles' ] );
		}

		/**
		 * Enable `post-formats` support.
		 */
		public function support_post_formats(): void {
			// Enable post formats.
			add_theme_support( 'post-formats', $this->post_formats );
		}

		/**
		 * Register module assets
		 */
		public function register_assets(): void {
			// GLightbox - Vanilla JS lightbox (no jQuery dependency)
			wp_register_script(
				'glightbox',
				'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js',
				[], // No dependencies
				'3.2.0',
				true
			);

			// Swiper v12 - Using CDN (bundle version includes all modules)
			wp_register_script(
				'swiper',
				'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js',
				[], // Swiper v12 doesn't require jQuery
				'12.0.3',
				true
			);

			wp_register_style(
				'glightbox',
				'https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css',
				[],
				'3.2.0'
			);

			// Swiper v12 - Using CDN (standard CSS, no SCSS)
			wp_register_style(
				'swiper',
				'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css',
				[],
				'12.0.3'
			);
		}

		/**
		 * Add depends scripts
		 *
		 * @param array $depends_scripts
		 *
		 * @return array
		 */
		public function add_depends_scripts( array $depends_scripts = [] ): array {
			if ( is_singular( 'post' ) ) {
				array_push( $depends_scripts, 'glightbox', 'swiper' );
			}

			return $depends_scripts;
		}

		/**
		 * Add depends styles
		 *
		 * @param array $depends_styles
		 *
		 * @return array
		 */
		public function add_depends_styles( array $depends_styles = [] ): array {
			if ( is_singular( 'post' ) ) {
				array_push( $depends_styles, 'glightbox', 'swiper' );
			}

			return $depends_styles;
		}

		/**
		 * Add meta options
		 */
		public function add_meta_options(): void {
			kava_post_meta()->add_options( [
				'id'            => 'kava-extra-post-type-settings',
				'title'         => esc_html__( 'Post Formats Settings', 'kava' ),
				'page'          => [ 'post' ],
				'context'       => 'normal',
				'priority'      => 'high',
				'callback_args' => false,
				'fields'        => [
					'post_formats' => [
						'type' => 'component-tab-horizontal',
					],
					'gallery_tab' => [
						'type'   => 'settings',
						'parent' => 'post_formats',
						'title'  => esc_html__( 'Gallery', 'kava' ),
					],
					'kava_extra_gallery_images' => [
						'type'               => 'media',
						'parent'             => 'gallery_tab',
						'title'              => esc_html__( 'Image Gallery', 'kava' ),
						'description'        => esc_html__( 'Choose image(s) for the gallery. This setting is used for your gallery post formats.', 'kava' ),
						'library_type'       => 'image',
						'upload_button_text' => esc_html__( 'Set Gallery Images', 'kava' ),
					],
					'link_tab' => [
						'type'   => 'settings',
						'parent' => 'post_formats',
						'title'  => esc_html__( 'Link', 'kava' ),
					],
					'kava_extra_link' => [
						'type'        => 'text',
						'parent'      => 'link_tab',
						'title'       => esc_html__( 'Link URL', 'kava' ),
						'description' => esc_html__( 'Enter your external url. This setting is used for your link post formats.', 'kava' ),
					],
					'kava_extra_link_target' => [
						'type'        => 'select',
						'parent'      => 'link_tab',
						'title'       => esc_html__( 'Link Target', 'kava' ),
						'description' => esc_html__( 'Choose your target for the url. This setting is used for your link post formats.', 'kava' ),
						'value'       => '_blank',
						'options'     => [
							'_blank' => 'Blank',
							'_self'  => 'Self',
						],
					],
					'quote_tab' => [
						'type'   => 'settings',
						'parent' => 'post_formats',
						'title'  => esc_html__( 'Quote', 'kava' ),
					],
					'kava_extra_quote_text' => [
						'type'        => 'textarea',
						'parent'      => 'quote_tab',
						'title'       => esc_html__( 'Quote', 'kava' ),
						'description' => esc_html__( 'Enter your quote. This setting is used for your quote post formats.', 'kava' ),
					],
					'kava_extra_quote_cite' => [
						'type'        => 'text',
						'parent'      => 'quote_tab',
						'title'       => esc_html__( 'Cite', 'kava' ),
						'description' => esc_html__( 'Enter the quote source. This setting is used for your quote post formats.', 'kava' ),
					],
					'audio_tab' => [
						'type'   => 'settings',
						'parent' => 'post_formats',
						'title'  => esc_html__( 'Audio', 'kava' ),
					],
					'kava_extra_audio' => [
						'type'               => 'media',
						'parent'             => 'audio_tab',
						'title'              => esc_html__( 'Audio', 'kava' ),
						'description'        => esc_html__( 'Add audio from the media library. This setting is used for your audio post formats.', 'kava' ),
						'library_type'       => 'audio',
						'multi_upload'       => false,
						'upload_button_text' => esc_html__( 'Set audio', 'kava' ),
					],
					'kava_extra_audio_loop' => [
						'type'        => 'switcher',
						'parent'      => 'audio_tab',
						'title'       => esc_html__( 'Loop', 'kava' ),
						'description' => esc_html__( 'Allows for the looping of media.', 'kava' ),
						'value'       => false,
					],
					'kava_extra_audio_autoplay' => [
						'type'        => 'switcher',
						'parent'      => 'audio_tab',
						'title'       => esc_html__( 'Autoplay', 'kava' ),
						'description' => esc_html__( 'Causes the media to automatically play as soon as the media file is ready.', 'kava' ),
						'value'       => false,
					],
					'kava_extra_audio_preload' => [
						'type'        => 'switcher',
						'parent'      => 'audio_tab',
						'title'       => esc_html__( 'Preload', 'kava' ),
						'description' => esc_html__( 'Specifies if and how the audio should be loaded when the page loads.', 'kava' ),
						'value'       => false,
					],
					'video_tab' => [
						'type'        => 'settings',
						'parent'      => 'post_formats',
						'title'       => esc_html__( 'Video', 'kava' ),
					],
					'kava_extra_video_type' => [
						'type'        => 'radio',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'Video Source Type', 'kava' ),
						'description' => esc_html__( 'Choose video source type. This setting is used for your video post formats.', 'kava' ),
						'value'       => 'library',
						'options'     => [
							'library'  => [
								'label' => esc_html__( 'Media Library', 'kava' ),
							],
							'external' => [
								'label' => esc_html__( 'External Video', 'kava' ),
							],
						],
					],
					'kava_extra_video_library' => [
						'type'               => 'media',
						'parent'             => 'video_tab',
						'title'              => esc_html__( 'Library Video', 'kava' ),
						'description'        => esc_html__( 'Add video from the media library. This setting is used for your video post formats.', 'kava' ),
						'library_type'       => 'video',
						'multi_upload'       => false,
						'upload_button_text' => esc_html__( 'Set Video', 'kava' ),
						'conditions'         => [
							'kava_extra_video_type' => 'library',
						],
					],
					'kava_extra_video_external' => [
						'type'        => 'text',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'External Video URL', 'kava' ),
						'description' => esc_html__( 'Enter a URL that is compatible with WP built-in oEmbed feature. This setting is used for your video post formats.', 'kava' ),
						'conditions'  => [
							'kava_extra_video_type' => 'external',
						],
					],
					'kava_extra_video_poster' => [
						'type'               => 'media',
						'parent'             => 'video_tab',
						'title'              => esc_html__( 'Video Poster', 'kava' ),
						'description'        => esc_html__( 'Defines image to show as placeholder before the media plays.', 'kava' ),
						'library_type'       => 'image',
						'multi_upload'       => false,
						'upload_button_text' => esc_html__( 'Set Poster', 'kava' ),
					],
					'kava_extra_video_width' => [
						'type'        => 'stepper',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'Width', 'kava' ),
						'description' => esc_html__( 'Defines width of the media.', 'kava' ),
						'value'       => 770,
						'max_value'   => 1200,
						'min_value'   => 100,
					],
					'kava_extra_video_height' => [
						'type'        => 'stepper',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'Height', 'kava' ),
						'description' => esc_html__( 'Defines height of the media.', 'kava' ),
						'value'       => 480,
						'max_value'   => 1200,
						'min_value'   => 100,
					],
					'kava_extra_video_loop' => [
						'type'        => 'switcher',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'Loop', 'kava' ),
						'description' => esc_html__( 'Allows for the looping of media.', 'kava' ),
						'value'       => false,
					],
					'kava_extra_video_autoplay' => [
						'type'        => 'switcher',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'Autoplay', 'kava' ),
						'description' => esc_html__( 'Causes the media to automatically play as soon as the media file is ready.', 'kava' ),
						'value'       => false,
						'conditions'  => [
							'kava_extra_video_loop' => 'true',
						],
					],
					'kava_extra_video_preload' => [
						'type'        => 'switcher',
						'parent'      => 'video_tab',
						'title'       => esc_html__( 'Preload', 'kava' ),
						'description' => esc_html__( 'Specifies if and how the video should be loaded when the page loads.', 'kava' ),
						'value'       => false,
					],
				],
			] );
		}

		/**
		 * Callback for appropriate hook to show image post format related thumbnail.
		 *
		 * @since  1.0.0
		 * @param  array $args Set of arguments.
		 */
		public function post_format_image( array $args = [] ): void {
			$post_id = get_the_ID();

			if ( has_post_thumbnail( $post_id ) ) {
				$default_args = [
					'size' => 'thumbnail',
				];

				$args = wp_parse_args( $args, $default_args );

				$thumb = get_the_post_thumbnail( $post_id, $args['size'] );
				$url   = wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );

				echo sprintf(
					'<figure class="post-thumbnail"><a href="%s" class="post-thumbnail__link" data-popup="magnificPopup">%s</a></figure>',
					$url,
					$thumb
				);
			}
		}

		/**
		 * Callback for appropriate hook to show gallery post format related gallery.
		 *
		 * @since  1.0.0
		 * @param  array $args Set of arguments.
		 */
		public function post_format_gallery( array $args = [] ): void {
			$post_id = get_the_ID();

			$gallery_images = get_post_meta( $post_id, 'kava_extra_gallery_images', true );

			if ( $gallery_images ) {
				$default_args = [
					'size' => 'thumbnail',
				];

				$args = wp_parse_args( $args, $default_args );

				$gallery_images = explode( ',', $gallery_images );

				$images = '';

				foreach ( $gallery_images as $image ) {
					$thumb = wp_get_attachment_image( $image, $args['size'] );
					$url   = wp_get_attachment_url( $image );

					$images .= sprintf(
						'<figure class="post-thumbnail swiper-slide"><a href="%s" class="post-thumbnail__link" data-popup="magnificPopup">%s</a></figure>',
						$url,
						$thumb
					);
				}

				echo sprintf(
					'<div class="post-format-gallery-wrapper">
								<div class="swiper">
									<div class="swiper-wrapper">%s</div>
									<div class="swiper-button-prev"></div>
									<div class="swiper-button-next"></div>
								</div>
							</div>',
					$images
				);
			}
		}

		/**
		 * Callback for appropriate hook to show video post format related video.
		 *
		 * @since 1.0.0
		 */
		public function post_format_video(): void {
			$post_id = get_the_ID();

			$video = null;
			$video_type = get_post_meta( $post_id, 'kava_extra_video_type', true );

			if ( 'library' === $video_type ) {
				$video = wp_get_attachment_url( get_post_meta( $post_id, 'kava_extra_video_library', true ) );
			}

			if ( 'external' === $video_type ) {
				$video = get_post_meta( $post_id, 'kava_extra_video_external', true );
			}

			if ( $video ) {
				$gallery_attr = [
					'src'      => $video,
					'poster'   => wp_get_attachment_url( get_post_meta( $post_id, 'kava_extra_video_poster', true ) ),
					'loop'     => get_post_meta( $post_id, 'kava_extra_video_loop', true ),
					'autoplay' => get_post_meta( $post_id, 'kava_extra_video_autoplay', true ),
					'preload'  => filter_var( get_post_meta( $post_id, 'kava_extra_video_preload', true ), FILTER_VALIDATE_BOOLEAN ) ? 'auto' : 'none',
					'width'    => get_post_meta( $post_id, 'kava_extra_video_width', true ),
					'height'   => get_post_meta( $post_id, 'kava_extra_video_height', true ),
				];

				echo wp_video_shortcode( $gallery_attr );
			}
		}

		/**
		 * Callback for appropriate hook to show link post format related link.
		 *
		 * @since 1.0.0
		 */
		public function post_format_link(): void {
			$post_id = get_the_ID();

			$link = get_post_meta( $post_id, 'kava_extra_link', true );

			if ( $link ) {
				$target = get_post_meta( $post_id, 'kava_extra_link_target', true );

				echo sprintf(
					'<div class="post-format-link-wrapper">
						<a href="%1$s" class="post-format-link" target="%2$s">%1$s</a>
					</div>',
					$link,
					$target
				);
			}
		}

		/**
		 * Callback for appropriate hook to show link post format related link.
		 *
		 * @since 1.0.0
		 */
		public function post_format_quote(): void {
			$post_id = get_the_ID();

			$quote = get_post_meta( $post_id, 'kava_extra_quote_text', true );

			if ( $quote ) {
				$quote_cite = get_post_meta( $post_id, 'kava_extra_quote_cite', true );

				echo sprintf(
					'<blockquote class="post-format-quote">%1$s%2$s</blockquote>',
					$quote,
					$quote_cite ? '<cite>' . $quote_cite . '</cite>' : ''
				);
			}
		}

		/**
		 * Callback for appropriate hook to show audio post format related audio.
		 *
		 * @since  1.0.0
		 * @param  array $args Set of arguments.
		 */
		public function post_format_audio( array $args = [] ): void {
			$post_id = get_the_ID();
			$audio = get_post_meta( $post_id, 'kava_extra_audio', true );

			if ( $audio ) {
				$attr = [
					'src'      => wp_get_attachment_url( $audio ),
					'loop'     => get_post_meta( $post_id, 'kava_extra_audio_loop', true ),
					'autoplay' => get_post_meta( $post_id, 'kava_extra_audio_autoplay', true ),
					'preload'  => filter_var( get_post_meta( $post_id, 'kava_extra_audio_preload', true ), FILTER_VALIDATE_BOOLEAN ) ? 'auto' : 'none',
				];

				echo wp_audio_shortcode( $attr );
			}
		}

	}

}
