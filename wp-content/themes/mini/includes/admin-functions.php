<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Show in WP Dashboard notice about the plugin is not activated.
 *
 * @return void
 */
function hello_madxartwork_fail_load_admin_notice() {
	// Leave to madxartwork Pro to manage this.
	if ( function_exists( 'madxartwork_pro_load_plugin' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	if ( 'true' === get_user_meta( get_current_user_id(), '_hello_madxartwork_install_notice', true ) ) {
		return;
	}

	$plugin = 'madxartwork/madxartwork.php';

	$installed_plugins = get_plugins();

	$is_madxartwork_installed = isset( $installed_plugins[ $plugin ] );

	if ( $is_madxartwork_installed ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$message = __( 'Hello theme is a lightweight starter theme designed to work perfectly with madxartwork Page Builder plugin.', 'hello-madxartwork' );

		$button_text = __( 'Activate madxartwork', 'hello-madxartwork' );
		$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$message = __( 'Hello theme is a lightweight starter theme. We recommend you use it together with madxartwork Page Builder plugin, they work perfectly together!', 'hello-madxartwork' );

		$button_text = __( 'Install madxartwork', 'hello-madxartwork' );
		$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=madxartwork' ), 'install-plugin_madxartwork' );
	}

	?>
	<style>
		.notice.hello-madxartwork-notice {
			border: 1px solid #ccd0d4;
			border-left: 4px solid #9b0a46 !important;
			box-shadow: 0 1px 4px rgba(0,0,0,0.15);
			display: flex;
			padding: 0px;
		}
		.rtl .notice.hello-madxartwork-notice {
			border-right-color: #9b0a46 !important;
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-notice-aside {
			width: 50px;
			display: flex;
			align-items: start;
			justify-content: center;
			padding-top: 15px;
			background: rgba(215,43,63,0.04);
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-notice-aside img{
			width: 1.5rem;
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-notice-inner {
			display: table;
			padding: 20px 0px;
			width: 100%;
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-notice-content {
			padding: 0 20px;
		}
		.notice.hello-madxartwork-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.hello-madxartwork-notice h3 {
			margin: 0 0 5px;
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-install-now {
			display: block;
			margin-top: 15px;
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-install-now .hello-madxartwork-install-button {
			background: #127DB8;
			border-radius: 3px;
			color: #fff;
			text-decoration: none;
			height: auto;
			line-height: 20px;
			padding: 0.4375rem 0.75rem;
			text-transform: capitalize;
		}
		.notice.hello-madxartwork-notice .hello-madxartwork-install-now .hello-madxartwork-install-button:active {
			transform: translateY(1px);
		}
		@media (max-width: 767px) {
			.notice.hello-madxartwork-notice.hello-madxartwork-install-madxartwork {
				padding: 0px;
			}
			.notice.hello-madxartwork-notice .hello-madxartwork-notice-inner {
				display: block;
				padding: 10px;
			}
			.notice.hello-madxartwork-notice .hello-madxartwork-notice-inner .hello-madxartwork-notice-content {
				display: block;
				padding: 0;
			}
			.notice.hello-madxartwork-notice .hello-madxartwork-notice-inner .hello-madxartwork-install-now {
				display: none;
			}
		}
	</style>
	<script>jQuery( function( $ ) {
			$( 'div.notice.hello-madxartwork-install-madxartwork' ).on( 'click', 'button.notice-dismiss', function( event ) {
				event.preventDefault();

				$.post( ajaxurl, {
					action: 'hello_madxartwork_set_admin_notice_viewed'
				} );
			} );
		} );</script>
	<div class="notice updated is-dismissible hello-madxartwork-notice hello-madxartwork-install-madxartwork">
		<div class="hello-madxartwork-notice-aside">
			<img src="<?php echo esc_url( get_template_directory_uri() ) . '/assets/images/madxartwork-notice-icon.svg'; ?>" alt="<?php _e( 'Get madxartwork', 'hello-madxartwork' ); ?>" />
		</div>
		<div class="hello-madxartwork-notice-inner">
			<div class="hello-madxartwork-notice-content">
				<h3><?php esc_html_e( 'Thanks for installing Hello Theme!', 'hello-madxartwork' ); ?></h3>
				<p><?php echo esc_html( $message ); ?></p>
				<a href="https://go.madxartwork.com/hello-theme-learn/" target="_blank"><?php esc_html_e( 'Learn more about madxartwork', 'hello-madxartwork' ); ?></a>
				<div class="hello-madxartwork-install-now">
					<a class="hello-madxartwork-install-button" href="<?php echo esc_attr( $button_link ); ?>"><?php echo esc_html( $button_text ); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Set Admin Notice Viewed.
 *
 * @return void
 */
function ajax_hello_madxartwork_set_admin_notice_viewed() {
	update_user_meta( get_current_user_id(), '_hello_madxartwork_install_notice', 'true' );
	die;
}

add_action( 'wp_ajax_hello_madxartwork_set_admin_notice_viewed', 'ajax_hello_madxartwork_set_admin_notice_viewed' );
if ( ! did_action( 'madxartwork/loaded' ) ) {
	add_action( 'admin_notices', 'hello_madxartwork_fail_load_admin_notice' );
}
