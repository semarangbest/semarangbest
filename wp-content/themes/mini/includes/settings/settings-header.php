<?php

namespace Hellomadxartwork\Includes\Settings;

use madxartwork\Plugin;
use madxartwork\Controls_Manager;
use madxartwork\Group_Control_Background;
use madxartwork\Group_Control_Typography;
use madxartwork\Core\Responsive\Responsive;
use madxartwork\Core\Kits\Documents\Tabs\Tab_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Settings_Header extends Tab_Base {

	public function get_id() {
		return 'hello-settings-header';
	}

	public function get_title() {
		return __( 'Header', 'hello-madxartwork' );
	}

	public function get_icon() {
		return 'eicon-header';
	}

	public function get_help_url() {
		return '';
	}

	public function get_group() {
		return 'theme-style';
	}

	protected function register_tab_controls() {
		$this->start_controls_section(
			'hello_header_section',
			[
				'tab' => 'hello-settings-header',
				'label' => __( 'Header', 'hello-madxartwork' ),
			]
		);

		$this->add_control(
			'hello_header_logo_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Site Logo', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
			]
		);

		$this->add_control(
			'hello_header_tagline_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Tagline', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
			]
		);

		$this->add_control(
			'hello_header_menu_display',
			[
				'type' => Controls_Manager::SWITCHER,
				'label' => __( 'Menu', 'hello-madxartwork' ),
				'default' => 'yes',
				'label_on' => __( 'Show', 'hello-madxartwork' ),
				'label_off' => __( 'Hide', 'hello-madxartwork' ),
			]
		);

		$this->add_control(
			'hello_header_layout',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Layout', 'hello-madxartwork' ),
				'options' => [
					'default' => __( 'Default', 'hello-madxartwork' ),
					'inverted' => __( 'Inverted', 'hello-madxartwork' ),
					'stacked' => __( 'Centered', 'hello-madxartwork' ),
				],
				'selector' => '.site-header',
				'default' => 'default',
			]
		);

		$this->add_control(
			'hello_header_width',
			[
				'type' => Controls_Manager::SELECT,
				'label' => __( 'Width', 'hello-madxartwork' ),
				'options' => [
					'boxed' => __( 'Boxed', 'hello-madxartwork' ),
					'full-width' => __( 'Full Width', 'hello-madxartwork' ),
				],
				'selector' => '.site-header',
				'default' => 'boxed',
			]
		);

		$this->add_responsive_control(
			'hello_header_custom_width',
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
					'hello_header_width' => 'boxed',
				],
				'selectors' => [
					'.site-header .header-inner' => 'width: {{SIZE}}{{UNIT}}; max-width: 100%;',
				],
			]
		);

		$this->add_responsive_control(
			'hello_header_gap',
			[
				'type' => Controls_Manager::SLIDER,
				'label' => __( 'Gap', 'hello-madxartwork' ),
				'size_units' => [
					'%',
					'px',
				],
				'default' => [
					'size' => '0',
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
					'.site-header' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}}',
				],
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'hello_header_layout',
							'operator' => '!=',
							'value' => 'stacked',
						],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'hello_header_background',
				'label' => __( 'Background', 'hello-madxartwork' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.site-header',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_header_logo_section',
			[
				'tab' => 'hello-settings-header',
				'label' => __( 'Site Logo', 'hello-madxartwork' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'hello_header_logo_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'hello_header_logo_type',
			[
				'label' => __( 'Type', 'hello-madxartwork' ),
				'type' => Controls_Manager::SELECT,
				'default' => ( has_custom_logo() ? 'logo' : 'title' ),
				'options' => [
					'logo' => __( 'Logo', 'hello-madxartwork' ),
					'title' => __( 'Title', 'hello-madxartwork' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'hello_header_logo_width',
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
					'hello_header_logo_display' => 'yes',
					'hello_header_logo_type' => 'logo',
				],
				'selectors' => [
					'.site-header .site-branding .site-logo img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'hello_header_title_color',
			[
				'label' => __( 'Text Color', 'hello-madxartwork' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'hello_header_logo_display' => 'yes',
					'hello_header_logo_type' => 'title',
				],
				'selectors' => [
					'.site-header h1.site-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hello_header_title_typography',
				'label' => __( 'Typography', 'hello-madxartwork' ),
				'description' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'hello-madxartwork' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'condition' => [
					'hello_header_logo_display' => 'yes',
					'hello_header_logo_type' => 'title',
				],
				'selector' => '.site-header h1.site-title',
			]
		);

		$this->add_control(
			'hello_header_title_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'hello-madxartwork' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'madxartwork-control-field-description',
				'condition' => [
					'hello_header_logo_display' => 'yes',
					'hello_header_logo_type' => 'title',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_header_tagline',
			[
				'tab' => 'hello-settings-header',
				'label' => __( 'Tagline', 'hello-madxartwork' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'hello_header_tagline_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'hello_header_tagline_color',
			[
				'label' => __( 'Text Color', 'hello-madxartwork' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'hello_header_tagline_display' => 'yes',
				],
				'selectors' => [
					'.site-header .site-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'hello_header_tagline_typography',
				'label' => __( 'Typography', 'hello-madxartwork' ),
				'condition' => [
					'hello_header_tagline_display' => 'yes',
				],
				'selector' => '.site-header .site-description',
			]
		);

		$this->add_control(
			'hello_header_tagline_link',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'Go to <a href="%s">Site Identity</a> to manage your site\'s title and tagline', 'hello-madxartwork' ), wp_nonce_url( 'customize.php?autofocus[section]=title_tagline' ) ),
				'content_classes' => 'madxartwork-control-field-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'hello_header_menu_tab',
			[
				'tab' => 'hello-settings-header',
				'label' => __( 'Menu', 'hello-madxartwork' ),
				'conditions' => [
					'relation' => 'and',
					'terms' => [
						[
							'name' => 'hello_header_menu_display',
							'operator' => '=',
							'value' => 'yes',
						],
					],
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
				'hello_header_menu_notice',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'hello-madxartwork' ) . '</strong><br>' . sprintf( __( 'Go to <a href="%s" target="_blank">Menus screen</a> to create one.', 'hello-madxartwork' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'madxartwork-panel-alert madxartwork-panel-alert-info',
				]
			);
		} else {
			$this->add_control(
				'hello_header_menu',
				[
					'label' => __( 'Menu', 'hello-madxartwork' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'hello-madxartwork' ), admin_url( 'nav-menus.php' ) ),
				]
			);

			$this->add_control(
				'hello_header_menu_warning',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => __( 'Changes will be reflected in the preview only after the page reloads.', 'hello-madxartwork' ),
					'content_classes' => 'madxartwork-panel-alert madxartwork-panel-alert-info',
				]
			);

			$this->add_control(
				'hello_header_menu_layout',
				[
					'label' => __( 'Menu Layout', 'hello-madxartwork' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'hello-madxartwork' ),
						'dropdown' => __( 'Dropdown', 'hello-madxartwork' ),
					],
					'frontend_available' => true,
				]
			);

			$breakpoints = Responsive::get_breakpoints();

			$this->add_control(
				'hello_header_menu_dropdown',
				[
					'label' => __( 'Breakpoint', 'hello-madxartwork' ),
					'type' => Controls_Manager::SELECT,
					'default' => 'tablet',
					'options' => [
						/* translators: %d: Breakpoint number. */
						'mobile' => sprintf( __( 'Mobile (< %dpx)', 'hello-madxartwork' ), $breakpoints['md'] ),
						/* translators: %d: Breakpoint number. */
						'tablet' => sprintf( __( 'Tablet (< %dpx)', 'hello-madxartwork' ), $breakpoints['lg'] ),
						'none' => __( 'None', 'hello-madxartwork' ),
					],
					'selector' => '.site-header',
					'condition' => [
						'hello_header_menu_layout!' => 'dropdown',
					],
				]
			);

			$this->add_control(
				'hello_header_menu_color',
				[
					'label' => __( 'Color', 'hello-madxartwork' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'hello_header_menu_display' => 'yes',
					],
					'selectors' => [
						'.site-header .site-navigation ul.menu li a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'hello_header_menu_toggle_color',
				[
					'label' => __( 'Toggle Color', 'hello-madxartwork' ),
					'type' => Controls_Manager::COLOR,
					'condition' => [
						'hello_header_menu_display' => 'yes',
					],
					'selectors' => [
						'.site-header .site-navigation-toggle i' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' => 'hello_header_menu_typography',
					'label' => __( 'Typography', 'hello-madxartwork' ),
					'condition' => [
						'hello_header_menu_display' => 'yes',
					],
					'selector' => '.site-header .site-navigation .menu li',
				]
			);
		}

		$this->end_controls_section();
	}

	public function on_save( $data ) {
		// Save chosen header menu to the WP settings.
		if ( isset( $data['settings']['hello_header_menu'] ) ) {
			$menu_id = $data['settings']['hello_header_menu'];
			$locations = get_theme_mod( 'nav_menu_locations' );
			$locations['menu-1'] = (int) $menu_id;
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
				__( 'Create a custom header with multiple options', 'hello-madxartwork' ),
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
				__( 'Create a custom header with the new Theme Builder', 'hello-madxartwork' ),
				__( 'With the new Theme Builder you can jump directly into each part of your site', 'hello-madxartwork' ),
				__( 'Create Header', 'hello-madxartwork' ),
				get_template_directory_uri() . '/assets/images/go-pro.svg',
				get_admin_url( null, 'admin.php?page=madxartwork-app#/site-editor/templates/header' )
			);
		}
	}
}
