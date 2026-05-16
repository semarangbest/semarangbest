<?php

namespace Hellomadxartwork\Includes\Customizer;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class madxartwork_Upsell extends \WP_Customize_Control {

	// Whitelist content parameter
	public $content = '';

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   2.4.0
	 * @return  void
	 */
	public function render_content() {
		$this->print_customizer_upsell();

		if ( isset( $this->description ) ) {
			echo '<span class="description customize-control-description">' . $this->description . '</span>';
		}
	}

	/**
	 * Customizer deeplinks HTML
	 *
	 * @return string HTML to use in the customizer panel
	 */

	private function print_customizer_upsell() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$customizer_content = '';

		// Get Plugins
		$plugins = get_plugins();

		if ( ! isset( $plugins['madxartwork/madxartwork.php'] ) ) {
			$customizer_content .= $this->get_customizer_upsell_html(
				__( 'Install madxartwork', 'hello-madxartwork' ),
				__( 'Create a cross-site Header and Footer using madxartwork & Hello theme', 'hello-madxartwork' ),
				wp_nonce_url(
					add_query_arg(
						[
							'action' => 'install-plugin',
							'plugin' => 'madxartwork',
						],
						admin_url( 'update.php' )
					),
					'install-plugin_madxartwork'
				),
				__( 'Install &amp; Activate', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		} elseif ( ! defined( 'madxartwork_VERSION' ) ) {
			$customizer_content .= $this->get_customizer_upsell_html(
				__( 'Activate madxartwork', 'hello-madxartwork' ),
				__( 'Create a cross-site Header and Footer using madxartwork & Hello theme', 'hello-madxartwork' ),
				wp_nonce_url( 'plugins.php?action=activate&plugin=madxartwork/madxartwork.php', 'activate-plugin_madxartwork/madxartwork.php' ),
				__( 'Activate madxartwork', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		} elseif ( defined( 'madxartwork_VERSION' ) && version_compare( madxartwork_VERSION, '3.0.12', '<' ) ) {
			$customizer_content .= $this->get_customizer_upsell_html(
				__( 'Update madxartwork', 'hello-madxartwork' ),
				__( 'You need madxartwork version 3.1.0 or above to create a cross-site Header and Footer.', 'hello-madxartwork' ),
				wp_nonce_url( 'update-core.php' ),
				__( 'Update madxartwork', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		} else {
			$customizer_content .= $this->get_customizer_upsell_html(
				__( 'Set Your Header &amp; Footer', 'hello-madxartwork' ),
				__( 'Create cross-site Header and Footer using madxartwork & Hello theme', 'hello-madxartwork' ),
				wp_nonce_url( 'post.php?post=' . get_option( 'madxartwork_active_kit' ) . '&action=madxartwork' ),
				__( 'Start Here', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		}

		echo $customizer_content;
	}

	private function get_customizer_upsell_html( $title, $text, $url, $button_text, $image ) {
		return sprintf( '
			<div class="customize-control-header-footer-holder">
				<img src="%5$s">
				<div class="madxartwork-nerd-box-message">
					<p class="madxartwork-panel-heading-title madxartwork-section-title">%1$s</p>
					<p class="madxartwork-section-body">%2$s</p>
				</div>
				<a class="button button-primary" target="_blank" href="%3$s">%4$s</a>
			</div>',
			$title,
			$text,
			$url,
			$button_text,
			$image
		);
	}
}
