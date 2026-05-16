<?php

namespace Hellomadxartwork\Includes\Settings;

use madxartwork\Controls_Manager;
use madxartwork\Group_Control_Background;
use madxartwork\Group_Control_Typography;
use madxartwork\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Settings_Footer extends Tab_Base {

	public function get_id() {
		return 'hello-settings-footer';
	}

	public function get_title() {
		return __( 'Footer', 'hello-madxartwork' );
	}

	public function get_icon() {
		return 'eicon-footer';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {

		$this->start_controls_section(
			'hello_footer_section',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Footer', 'hello-madxartwork' ),
			]
		);

		$this->add_control(
			'hello_footer_logo_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
				'selector' => '.site-footer .site-branding',
			]
		);

		$this->add_control(
			'hello_footer_tagline_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'hello_footer_menu_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
				'selector' => '.site-footer .site-navigation',
			]
		);

		$this->add_control(
			'hello_footer_copyright_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Copyright', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
				'selector' => '.site-footer .copyright',
			]
		);

		$this->add_control(
			'hello_footer_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Layout', 'hello-madxartwork' ),
				'options' => [
					'default' => __( 'Default', 'hello-madxartwork' ),
					'inverted' => __( 'Inverted', 'hello-madxartwork' ),
					'stacked' => __( 'Centered', 'hello-madxartwork' ),
				],
				'selector' => '.site-footer',
				'default' => 'default',
			]
		);

		$this->add_control(
			'hello_footer_width',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Width', 'hello-madxartwork' ),
				'options' => [
					'boxed' => __( 'Boxed', 'hello-madxartwork' ),
					'full-width' => __( 'Full Width', 'hello-madxartwork' ),
				],
				'selector' => '.site-footer',
				'default' => 'boxed',
			]
		);

		$this->add_responsive_control(
			'hello_footer_custom_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Content Width', 'hello-madxartwork' ),
				'size_units' => [
					'%',
					'px',
				],
				'range' => [
					'px' => [
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'hello_footer_width' => 'boxed',
				],
				'selectors' => [
					'.site-footer .footer-inner' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				],
			]
		);

		$this->add_responsive_control(
			'hello_footer_gap',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Gap', 'hello-madxartwork' ),
				'size_units' => [
					'%',
					'px',
				],
				'range' => [
					'px' => [
						'max' => 2000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'.site-footer' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'hello_footer_layout!' => 'stacked',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hello_footer_background',
				'label' => __( 'Background', 'hello-madxartwork' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.site-footer',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_logo_section',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Site Logo', 'hello-madxartwork' ),
				'condition' => [
					'hello_footer_logo_display!' => '',
				],
			]
		);

		$this->add_control(
			'hello_footer_logo_type',
			[
				'label' => __( 'Type', 'hello-madxartwork' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'logo',
				'options' => [
					'logo' => __( 'Logo', 'hello-madxartwork' ),
					'title' => __( 'Title', 'hello-madxartwork' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'hello_footer_logo_width',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Logo Width', 'hello-madxartwork' ),
				'description' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s logo', 'hello-madxartwork' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'size_units' => [
					'%',
					'px',
					'vh',
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'hello_footer_logo_display' => 'yes',
					'hello_footer_logo_type' => 'logo',
				],
				'selectors' => [
					'.site-footer .site-branding .site-logo img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'hello_footer_title_color',
			[
				'label' => __( 'Text Color', 'hello-madxartwork' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'hello_footer_logo_display' => 'yes',
					'hello_footer_logo_type' => 'title',
				],
				'selectors' => [
					'.site-footer h4.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hello_footer_title_typography',
				'label' => __( 'Typography', 'hello-madxartwork' ),
				'condition' => [
					'hello_footer_logo_display' => 'yes',
					'hello_footer_logo_type' => 'title',
				],
				'selector' => '.site-footer h4.site-title',

			]
		);

		$this->add_control(
			'hello_footer_title_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'hello-madxartwork' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'madxartwork-control-field-description',
				'condition' => [
					'hello_footer_logo_display' => 'yes',
					'hello_footer_logo_type' => 'title',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_tagline',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Tagline', 'hello-madxartwork' ),
				'condition' => [
					'hello_footer_tagline_display' => 'yes',
				],
			]
		);

		$this->add_control(
			'hello_footer_tagline_color',
			[
				'label' => __( 'Text Color', 'hello-madxartwork' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'hello_footer_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hello_footer_tagline_typography',
				'label' => __( 'Typography', 'hello-madxartwork' ),
				'condition' => [
					'hello_footer_tagline_display' => 'yes',
				],
				'selector' => '.site-footer .site-description',
			]
		);

		$this->add_control(
			'hello_footer_tagline_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'hello-madxartwork' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'madxartwork-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_menu_tab',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Menu', 'hello-madxartwork' ),
				'condition' => [
					'hello_footer_menu_display' => 'yes',
				],
			]
		);

		$available_menus = wp_get_nav_menus();

		$menus = [ '0' => __( '— Select a Menu —', 'hello-madxartwork' ) ];
		foreach ( $available_menus as $available_menu ) {
			$menus[ $available_menu->term_id ] = $available_menu->name;
		}

		if ( 1 === count( $menus ) ) {
			$this->add_control(
				'hello_footer_menu_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'hello-madxartwork' ) . '</strong><br>' . sprintf( __( 'Go to <a href="%s" target="_blank">Menus screen</a> to create one.', 'hello-madxartwork' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'madxartwork-panel-alert madxartwork-panel-alert-info',
				]
			);
		} else {
			$this->add_control(
				'hello_footer_menu',
				[
					'label' => __( 'Menu', 'hello-madxartwork' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'hello-madxartwork' ), admin_url( 'nav-menus.php' ) ),
				]
			);

			$this->add_control(
				'hello_footer_menu_warning',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( 'Changes will be reflected in the preview only after the page reloads.', 'hello-madxartwork' ),
					'content_classes' => 'madxartwork-panel-alert madxartwork-panel-alert-info',
				]
			);

			$this->add_control(
				'hello_footer_menu_color',
				[
					'label' => __( 'Color', 'hello-madxartwork' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'footer .footer-inner .site-navigation a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'hello_footer_menu_typography',
					'label' => __( 'Typography', 'hello-madxartwork' ),
					'selector' => 'footer .footer-inner .site-navigation a',
				]
			);
		}

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_footer_copyright_section',
			[
				'tab' => 'hello-settings-footer',
				'label' => __( 'Copyright', 'hello-madxartwork' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'hello_footer_copyright_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'hello_footer_copyright_text',
			[
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'All rights reserved', 'hello-madxartwork' ),
			]
		);

		$this->add_control(
			'hello_footer_copyright_color',
			[
				'label' => __( 'Text Color', 'hello-madxartwork' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'hello_footer_copyright_display' => 'yes',
				],
				'selectors' => [
					'.site-footer .copyright p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hello_footer_copyright_typography',
				'label' => __( 'Typography', 'hello-madxartwork' ),
				'condition' => [
					'hello_footer_copyright_display' => 'yes',
				],
				'selector' => '.site-footer .copyright p',
			]
		);

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		// Save chosen footer menu to the WP settings.
		if ( isset( $data['settings']['hello_footer_menu'] ) ) {
			$menu_id = $data['settings']['hello_footer_menu'];
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-2'] = (int) $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	public function get_additional_tab_content() {
		if ( ! defined( 'madxartwork_PRO_VERSION' ) ) {
			return sprintf( '
				<div class="hello-madxartwork madxartwork-nerd-box">
					<img src="%4$s" class="madxartwork-nerd-box-icon">
					<div class="madxartwork-nerd-box-message">
						<p class="madxartwork-panel-heading-title madxartwork-nerd-box-title">%1$s</p>
						<p>%2$s</p>
					</div>
					<a class="madxartwork-button madxartwork-button-default madxartwork-nerd-box-link" target="_blank" href="https://madxartwork.com/pro/?utm_source=panel-widgets&amp;utm_campaign=gopro&amp;utm_medium=wp-dash&amp;utm_term=hellomadxartwork">%3$s</a>
				</div>
				',
				__( 'Create a custom footer with multiple options', 'hello-madxartwork' ),
				__( 'Upgrade to madxartwork Pro and enjoy free design and many more features', 'hello-madxartwork' ),
				__( 'Go Pro', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg'
			);
		} else {
			return sprintf( '
				<div class="hello-madxartwork madxartwork-nerd-box">
					<img src="%4$s" class="madxartwork-nerd-box-icon">
					<div class="madxartwork-nerd-box-message">
						<p class="madxartwork-panel-heading-title madxartwork-nerd-box-title">%1$s</p>
						<p class="madxartwork-nerd-box-message">%2$s</p>
					</div>
					<a class="madxartwork-button madxartwork-button-success madxartwork-nerd-box-link" target="_blank" href="%5$s">%3$s</a>
				</div>
				',
				__( 'Create a custom footer with the new Theme Builder', 'hello-madxartwork' ),
				__( 'With the new Theme Builder you can jump directly into each part of your site', 'hello-madxartwork' ),
				__( 'Create Footer', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg',
				get_admin_url( null, 'admin.php?page=madxartwork-app#/site-editor/templates/footer' )
			);
		}
	}
}
