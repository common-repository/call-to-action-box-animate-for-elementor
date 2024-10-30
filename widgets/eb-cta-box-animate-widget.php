<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * CTA Box Animate Widget
 */
class EB_CTA_Box_Animate extends Widget_Base {

	/**
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'eb-cta-box-animate';
	}

	/**
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'CTA Box Animate', 'elementor' );
	}

	/**
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-eb-cta-box-animate eb-cta-box-animate-icon';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'eb-elementor-extended' ];
	}

	public function get_script_depends() {
		return [ 'eb-cta-box-animate' ];
	}

	/**
	 * Get button sizes.
	 *
	 * Retrieve an array of button sizes for the button widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return array An array containing button sizes.
	 */
	public static function get_button_sizes() {
		return [
			'xs' => __( 'Extra Small', 'elementor' ),
			'sm' => __( 'Small', 'elementor' ),
			'md' => __( 'Medium', 'elementor' ),
			'lg' => __( 'Large', 'elementor' ),
			'xl' => __( 'Extra Large', 'elementor' ),
		];
	}
	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Box Animate Element', 'elementor' ),
			]
		);

		$this->add_control(
			'box_blurb_style',
			[
				'label' => __( 'Blurb Element', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [
					'none' => [
						'title' => __( 'None', 'elementor' ),
						'icon' => 'fa fa-ban',
					],
					'icon' => [
						'title' => __( 'Icon', 'elementor' ),
						'icon' => 'fa fa-star',
					],
					'image' => [
						'title' => __( 'Image', 'elementor' ),
						'icon' => 'fa fa-picture-o',
					],
				],
				'separator' => 'before',
				'default' => 'none',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
				'default' => 'fa fa-star',
				'condition' => [
					'box_blurb_style' => 'icon',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'elementor' ),
					'stacked' => __( 'Stacked', 'elementor' ),
					'framed' => __( 'Framed', 'elementor' ),
				],
				'default' => 'default',
				'prefix_class' => 'elementor-view-',
				'condition' => [
					'box_blurb_style' => 'icon',
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'elementor' ),
					'square' => __( 'Square', 'elementor' ),
				],
				'default' => 'circle',
				'condition' => [
					'box_blurb_style' => 'icon',
					'view!' => 'default',
					'icon!' => '',
				],
				'prefix_class' => 'elementor-shape-',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'box_blurb_style' => 'image',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
				'condition' => [
					'box_blurb_style' => 'image',
				],
			]
		);

		$this->add_control(
			'divider',
			[
				'label' => __( 'Use Divider line', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'divider_placement',
			[
				'label' => __( 'Placement', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => 'Before Title',
					'after' => 'After Title',
				],
				'default' => 'after',
				'condition' => [
					'divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'divider_style',
			[
				'label' => __( 'Style', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'solid' => __( 'Solid', 'elementor' ),
					'double' => __( 'Double', 'elementor' ),
					'dotted' => __( 'Dotted', 'elementor' ),
					'dashed' => __( 'Dashed', 'elementor' ),
				],
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .elementor-divider-separator' => 'border-top-style: {{VALUE}};',
				],
				'condition' => [
					'divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'divider_weight',
			[
				'label' => __( 'Weight', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-divider-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'divider' => 'yes',
				],
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-divider-separator' => 'border-top-color: {{VALUE}};',
				],
				'condition' => [
					'divider' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'divider_width',
			[
				'label' => __( 'Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 20,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-divider-separator' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'divider' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'divider_gap',
			[
				'label' => __( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-divider' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'divider' => 'yes',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title, Subtitle & Description', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'elementor' ),
				'placeholder' => __( 'Enter your title', 'elementor' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'subtitle_text',
			[
				'label' => __( '', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the subtitle', 'elementor' ),
				'placeholder' => __( 'Enter your subtitle', 'elementor' ),
				'label_block' => true,
				'separator' => 'none',
			]
		);

		$this->add_control(
			'subtitle_text_placement',
			[
				'label' => __( 'Subtitle Placement', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'before' => 'Before Title',
					'after' => 'After Title',
				],
				'default' => 'after',
				'condition' => [
					'subtitle_text!' => '',
				],
				'separator' => 'none',
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
				'placeholder' => __( 'Enter your description', 'elementor' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'button_one_text',
			[
				'label' => __( 'Button #1 Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click me', 'elementor' ),
				'placeholder' => __( 'Click me', 'elementor' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_two_text',
			[
				'label' => __( 'Button #2 Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Click me', 'elementor' ),
				'placeholder' => __( 'Click me', 'elementor' ),
			]
		);

		$this->add_control(
			'button_separator',
			[
				'label' => esc_html__( 'Use Separator Text', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'button_separator_text',
			[
				'label' => __( 'Separator Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'or', 'elementor' ),
				'placeholder' => __( 'or', 'elementor' ),
				'condition' => [
					'button_separator' => 'yes',
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' ),
			]
		);

		$this->add_control(
			'link_to_element',
			[
				'label' => __( 'Link to', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => 'Title & Icon',
					'entire_div' => 'Entire DIV as a link',
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title HTML Tag', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_setting',
			[
				'label' => __( 'Button Settings', 'elementor' ),
			]
		);

		$this->add_control(
			'button_spacing',
			[
				'label' => __( 'Button Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button-one' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button-two' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'button_two_text!' => '',
				],
				'separator' => 'after',
			]
		);

		$this->add_control(
			'button_one_label',
			[
				'label' => __( 'Button #1', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_one_type',
			[
				'label' => __( 'Type', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'elementor' ),
					'info' => __( 'Info', 'elementor' ),
					'success' => __( 'Success', 'elementor' ),
					'warning' => __( 'Warning', 'elementor' ),
					'danger' => __( 'Danger', 'elementor' ),
				],
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_one_link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		/*
		$this->add_responsive_control(
			'button_one_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);*/

		$this->add_control(
			'button_one_size',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_one_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_one_icon_align',
			[
				'label' => __( 'Icon Position', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'elementor' ),
					'right' => __( 'After', 'elementor' ),
				],
				'condition' => [
					'button_one_icon!' => '',
				],
			]
		);

		$this->add_control(
			'button_one_icon_indent',
			[
				'label' => __( 'Icon Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_one_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_one_view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_two_label',
			[
				'label' => __( 'Button #2', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_two_type',
			[
				'label' => __( 'Type', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'elementor' ),
					'info' => __( 'Info', 'elementor' ),
					'success' => __( 'Success', 'elementor' ),
					'warning' => __( 'Warning', 'elementor' ),
					'danger' => __( 'Danger', 'elementor' ),
				],
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_two_link',
			[
				'label' => __( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'elementor' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		/*
		$this->add_responsive_control(
			'button_one_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);*/

		$this->add_control(
			'button_two_size',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => self::get_button_sizes(),
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_two_icon',
			[
				'label' => __( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		$this->add_control(
			'button_two_icon_align',
			[
				'label' => __( 'Icon Position', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => __( 'Before', 'elementor' ),
					'right' => __( 'After', 'elementor' ),
				],
				'condition' => [
					'button_two_icon!' => '',
				],
			]
		);

		$this->add_control(
			'button_two_icon_indent',
			[
				'label' => __( 'Icon Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_two_icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button-two .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button-two .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_two_view',
			[
				'label' => __( 'View', 'elementor' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		$this->end_controls_section();

		//Button Separator
		$this->start_controls_section(
			'section_button_separator',
			[
				'label' => __( 'Button Separator', 'elementor' ),
				'condition' => [
					'button_separator' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_separator_space',
			[
				'label' => __( 'Spacing in Between', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-btn-separator' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//Hover Effects
		$this->start_controls_section(
			'section_hover_effect',
			[
				'label' => __( 'Content Hover Animation', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_content_animation',
			[
				'label' => __( 'Content Animation', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'groups' => [
					[
						'label' => __( 'None', 'elementor' ),
						'options' => [
							'' => __( 'None', 'elementor' ),
						],
					],
					[
						'label' => __( 'Fade', 'elementor' ),
						'options' => [							
							'fade-in' => 'Fade In',
							'fade-in-up' => 'Fade In Up',
							'fade-in-down' => 'Fade In Down',
							'fade-in-left' => 'Fade In Left',
							'fade-in-right' => 'Fade In Right',
						],
					],
					[
						'label' => __( 'Slide', 'elementor' ),
						'options' => [
							'slide-up' => 'Slide Up',
							'slide-down' => 'Slide Down',
							'slide-left' => 'Slide Left',
							'slide-right' => 'Slide Right',
							'slide-top-left' => 'Slide Top Left',
							'slide-top-right' => 'Slide Top Right',
							'slide-bottom-left' => 'Slide Bottom Left',
							'slide-bottom-right' => 'Slide Bottom Right',
						],
					],
				],
				'default' => '',
			]
		);

		$this->add_control(
			'hover_content_sequenced_animation',
			[
				'label' => __( 'Sequenced Animation', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'condition' => [
					'hover_content_animation!' => '',
				],
			]
		);

		$this->add_control(
			'hover_content_transition_speed',
			[
				'label' => __( 'Transition Speed (s)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box.eb-cta-box-hover-sequenced-off .eb-cta-box-content-wrapper' => '-webkit-transition: {{SIZE}}s; -o-transition: {{SIZE}}s; transition: {{SIZE}}s;',

				],
				'default' => [
					'size' => 0.35,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
					],
				],
				'condition' => [
					'hover_content_animation!' => '',
					'hover_content_sequenced_animation' => '',
				],
			]
		);

		$this->add_control(
			'hover_content_sequenced_transition_speed',
			[
				'label' => __( 'Transition Speed (s)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box.eb-cta-box-hover-sequenced-on .eb-cta-box-hover-sequenced-item' => '-webkit-transition-duration: {{SIZE}}s; -o-transition-duration: {{SIZE}}s; transition-duration: {{SIZE}}s;',
				],
				'default' => [
					'size' => 0.35,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
					],
				],
				'condition' => [
					'hover_content_animation!' => '',
					'hover_content_sequenced_animation' => 'yes',
				],
			]
		);

		//Overlay Text
		$this->add_control(
			'eb_overlay_text',
			[
				'label' => __( 'Show Overylay Text', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'separator' => 'before',
				'condition' => [
					'hover_content_animation!' => '',
				],
			]
		);

		$this->add_control(
			'eb_overlay_animation',
			[
				'label' => __( 'Overlay Animation', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'groups' => [
					[
						'label' => __( 'Fade Out', 'elementor' ),
						'options' => [							
							'fade-out' => 'Fade Out',
							'fade-out-up' => 'Fade Out Up',
							'fade-out-down' => 'Fade Out Down',
							'fade-out-left' => 'Fade Out Left',
							'fade-out-right' => 'Fade Out Right',
						],
					],
				],
				'default' => 'fade-out',
				'condition' => [
					'eb_overlay_text!' => '',
				],
			]
		);

		$this->add_control(
			'eb_overlay_animation_transition_speed',
			[
				'label' => __( 'Transition Speed (s)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-text-wrapper' => '-webkit-transition: {{SIZE}}s; -o-transition: {{SIZE}}s; transition: {{SIZE}}s;',
				],
				'default' => [
					'size' => 0.25,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
					],
				],
				'condition' => [
					'eb_overlay_text!' => '',
				],
			]
		);

		$this->add_control(
			'eb_overlay_title_text',
			[
				'label' => __( 'Overlay Title Text', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Overlay text', 'elementor' ),
				'placeholder' => __( 'Enter your overlay title text', 'elementor' ),
				'label_block' => true,
				'condition' => [
					'eb_overlay_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'eb_overlay_description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Overlay Description', 'elementor' ),
				'placeholder' => __( 'Enter your overlay description', 'elementor' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
				'condition' => [
					'eb_overlay_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'eb_overlay_title_size',
			[
				'label' => __( 'Title HTML Tag', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h5',
				'condition' => [
					'eb_overlay_text' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_cta_box_animate',
			[
				'label' => __( 'Main Layout', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_height',
			[
				'label' => __( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box .eb-cta-box-content-wrapper' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_up',
			[
				'label' => __( 'Content Animation Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above up or bottom padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translateY(100%) translateY(+{{SIZE}}{{UNIT}});
					    -moz-transform: translateY(100%) translateY(+{{SIZE}}{{UNIT}});
					    -ms-transform: translateY(100%) translateY(+{{SIZE}}{{UNIT}});
					    -o-transform: translateY(100%) translateY(+{{SIZE}}{{UNIT}});
					    transform: translateY(100%) translateY(+{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-up',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_down',
			[
				'label' => __( 'Content Animation Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above up or bottom padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translateY(-100%) translateY(-{{SIZE}}{{UNIT}});
					    -moz-transform: translateY(-100%) translateY(-{{SIZE}}{{UNIT}});
					    -ms-transform: translateY(-100%) translateY(-{{SIZE}}{{UNIT}});
					    -o-transform: translateY(-100%) translateY(-{{SIZE}}{{UNIT}});
					    transform: translateY(-100%) translateY(-{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-down',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_left',
			[
				'label' => __( 'Content Animation Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above left or right padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translateX(100%) translateX(+{{SIZE}}{{UNIT}});
					    -moz-transform: translateX(100%) translateX(+{{SIZE}}{{UNIT}});
					    -ms-transform: translateX(100%) translateX(+{{SIZE}}{{UNIT}});
					    -o-transform: translateX(100%) translateX(+{{SIZE}}{{UNIT}});
					    transform: translateX(100%) translateX(+{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-left',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_right',
			[
				'label' => __( 'Content Hover Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above left or right padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translateX(-100%) translateX(-{{SIZE}}{{UNIT}});
					    -moz-transform: translateX(-100%) translateX(-{{SIZE}}{{UNIT}});
					    -ms-transform: translateX(-100%) translateX(-{{SIZE}}{{UNIT}});
					    -o-transform: translateX(-100%) translateX(-{{SIZE}}{{UNIT}});
					    transform: translateX(-100%) translateX(-{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-right',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_top_left',
			[
				'label' => __( 'Content Hover Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above left or right padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translate(-100%, -100%) translate(-{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    -moz-transform: translate(-100%, -100%) translate(-{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    -ms-transform: translate(-100%, -100%) translate(-{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    -o-transform: translate(-100%, -100%) translate(-{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    transform: translate(-100%, -100%) translate(-{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-top-left',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_top_right',
			[
				'label' => __( 'Content Hover Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above left or right padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translate(100%, -100%) translate(+{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    -moz-transform: translate(100%, -100%) translate(+{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    -ms-transform: translate(100%, -100%) translate(+{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    -o-transform: translate(100%, -100%) translate(+{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});
					    transform: translate(100%, -100%) translate(+{{SIZE}}{{UNIT}}, -{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-top-right',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_bottom_left',
			[
				'label' => __( 'Content Hover Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above left or right padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translate(-100%, 100%) translate(-{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    -moz-transform: translate(-100%, 100%) translate(-{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    -ms-transform: translate(-100%, 100%) translate(-{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    -o-transform: translate(-100%, 100%) translate(-{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    transform: translate(-100%, 100%) translate(-{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-bottom-left',
				],
			]
		);

		$this->add_responsive_control(
			'cta_box_animate_content_slide_bottom_right',
			[
				'label' => __( 'Content Hover Padding', 'elementor' ),
				'description' => __( 'Some animation, padding is needed if you are using padding on the main element. This value must be the same as the above left or right padding.', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-content-wrapper' => '-webkit-transform: translate(100%, 100%) translate(+{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    -moz-transform: translate(100%, 100%) translate(+{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    -ms-transform: translate(100%, 100%) translate(+{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    -o-transform: translate(100%, 100%) translate(+{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});
					    transform: translate(100%, 100%) translate(+{{SIZE}}{{UNIT}}, +{{SIZE}}{{UNIT}});',
					'{{WRAPPER}} .eb-cta-box-hover:hover .eb-cta-box-content-wrapper' => '-webkit-transform: translate(0, 0);
					    -moz-transform: translate(0, 0);
					    -ms-transform: translate(0, 0);
					    -o-transform: translate(0, 0);
					    transform: translate(0, 0);',
				],
				'condition' => [
					'cta_box_animate_padding!' => '',
					'hover_content_animation' => 'slide-bottom-right',
				],
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cta_box_animate_content_vertical_position',
			[
				'label' => __( 'Vertical Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'middle',
				'prefix_class' => 'eb-cta-box-vertical-align-',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'icon_vertical_alignment',
			[
				'label' => __( 'Icon Vertical Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'prefix_class' => 'elementor-vertical-align-',
				'condition' => [
					'box_blurb_style!' => 'none',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'eb_effect_image_bg',
				'label' => __( 'Background Color', 'elementor' ),
				'types' => [ 'classic','gradient' ],
				'selector' => '{{WRAPPER}} .eb-cta-box-animate-bg',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'eb_background_overlay',
			[
				'label' => __( 'Background Overlay', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-animate-bg-wrapper .eb-cta-box-overlay' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
				'condition' => [
					'eb_effect_image_bg_image[id]!' => '',
				],
			]
		);

		$this->add_control(
			'eb_background_overlay_option',
			[
				'label' => __( 'Show Overylay on Hover', 'elementor' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor' ),
				'label_off' => __( 'Off', 'elementor' ),
				'separator' => 'after',
				'condition' => [
					'eb_background_overlay!' => '',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_transition',
			[
				'label' => __( 'Background Hover Transition', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => [
					'' => 'None',
					'greyscale' => 'Greyscale',
					'blur' => 'Blur',
					'sepia' => 'Sepia',
					'saturate' => 'Saturate',
					'brightness' => 'Brightness',
					'contrast' => 'Contrast',
					'invert' => 'Invert',
					'hue-rotate' => 'Hue Rotate',
				],
				'default' => '',
				'condition' => [
					'eb_effect_image_bg_image[id]!' => '',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_transition_speed',
			[
				'label' => __( 'Transition Speed (s)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box .eb-cta-box-animate-bg, {{WRAPPER}} .eb-cta-box .eb-cta-box-overlay' => '-webkit-transition: {{SIZE}}s; -o-transition: {{SIZE}}s; transition: {{SIZE}}s;',
				],
				'default' => [
					'size' => 0.35,
				],
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 5,
					],
				],
				'condition' => [
					'eb_effect_image_transition!' => '',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_blur',
			[
				'label' => __( 'Blur', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-blur' => '-webkit-filter: blur({{SIZE}}{{UNIT}}); filter: blur({{SIZE}}{{UNIT}}); -moz-filter: blur({{SIZE}}{{UNIT}}); -ms-filter: blur({{SIZE}}{{UNIT}}); -o-filter: blur({{SIZE}}{{UNIT}});',
				],
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'blur',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_greyscale',
			[
				'label' => __( 'Greyscale (%)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-greyscale' => '-webkit-filter: grayscale({{SIZE}}%); filter: grayscale({{SIZE}}%); -moz-filter: grayscale({{SIZE}}%); -ms-filter: grayscale({{SIZE}}%); -o-filter: grayscale({{SIZE}}%);',
				],
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'greyscale',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_sepia',
			[
				'label' => __( 'Sepia (%)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-sepia' => '-webkit-filter: sepia({{SIZE}}%); filter: sepia({{SIZE}}%); -moz-filter: sepia({{SIZE}}%); -ms-filter: sepia({{SIZE}}%); -o-filter: sepia({{SIZE}}%);',
				],
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'sepia',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_saturate',
			[
				'label' => __( 'Saturate', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-saturate' => '-webkit-filter: saturate({{SIZE}}); filter: saturate({{SIZE}}); -moz-filter: saturate({{SIZE}}); -ms-filter: saturate({{SIZE}}); -o-filter: saturate({{SIZE}});',
				],
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'saturate',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_brightness',
			[
				'label' => __( 'Brightness (%)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-brightness' => '-webkit-filter: brightness({{SIZE}}%); filter: brightness({{SIZE}}%); -moz-filter: brightness({{SIZE}}%); -ms-filter: brightness({{SIZE}}%); -o-filter: brightness({{SIZE}}%);',
				],
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'brightness',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_contrast',
			[
				'label' => __( 'Contrast (%)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-contrast' => '-webkit-filter: contrast({{SIZE}}%); filter: contrast({{SIZE}}%); -moz-filter: contrast({{SIZE}}%); -ms-filter: contrast({{SIZE}}%); -o-filter: contrast({{SIZE}}%);',
				],
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 500,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'contrast',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_invert',
			[
				'label' => __( 'Invert (%)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-invert' => '-webkit-filter: invert({{SIZE}}%); filter: invert({{SIZE}}%); -moz-filter: invert({{SIZE}}%); -ms-filter: invert({{SIZE}}%); -o-filter: invert({{SIZE}}%);',
				],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'invert',
				],
			]
		);

		$this->add_control(
			'eb_effect_image_hue_rotate',
			[
				'label' => __( 'Hue-Rotate (Deg)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box:hover .eb-cta-box-bg-hue-rotate' => '-webkit-filter: hue-rotate({{SIZE}}deg); filter: hue-rotate({{SIZE}}deg); -moz-filter: hue-rotate({{SIZE}}deg); -ms-filter: hue-rotate({{SIZE}}deg); -o-filter: hue-rotate({{SIZE}}deg);',
				],
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [
					'eb_effect_image_transition' => 'hue-rotate',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Blurb Icon', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
					'box_blurb_style' => 'icon',
				],
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'position',
			[
				'label' => __( 'Icon Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hover',
			[
				'label' => __( 'Blurb Icon Hover', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
					'box_blurb_style' => 'icon',
				],
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover, {{WRAPPER}}.elementor-view-default .elementor-icon:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-view-framed .elementor-icon:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.elementor-view-stacked .elementor-icon:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Blurb Image', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'box_blurb_style' => 'image',
				],
			]
		);

		$this->add_control(
			'image_position',
			[
				'label' => __( 'Image Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor-position-',
				'toggle' => false,
			]
		);

		$this->add_responsive_control(
			'image_space',
			[
				'label' => __( 'Image Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.elementor-position-right .elementor-image-box-img' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-left .elementor-image-box-img' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.elementor-position-top .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .elementor-image-box-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_opacity',
			[
				'label' => __( 'Opacity (%)', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper .elementor-image-box-img img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper .elementor-image-box-img img',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-wrapper .elementor-image-box-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon-box-wrapper .elementor-image-box-img img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content Area', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'eb_content_image_bg',
				'label' => __( 'Background Color', 'elementor' ),
				'types' => [ 'classic','gradient' ],
				'selector' => '{{WRAPPER}} .eb-cta-box .eb-cta-box-content-wrapper',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'cta_box_animate_content_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box .elementor-icon-box-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);	

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_typography_text_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
			]
		);

		$this->add_control(
			'heading_subtitle',
			[
				'label' => __( 'Subtitle', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'subtitle_text!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'subtitle_bottom_space',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-animate-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'subtitle_text!' => '',
				],
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .eb-cta-box-animate-subtitle' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
				'condition' => [
					'subtitle_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .eb-cta-box-animate-subtitle',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => [
					'subtitle_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'subtitle_typography_text_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .eb-cta-box-animate-subtitle',
				'condition' => [
					'subtitle_text!' => '',
				],
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'description_bottom_space',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'description_typography_text_shadow',
				'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
			]
		);

		$this->end_controls_section();

		//Overlay Styles 
		$this->start_controls_section(
			'section_style_overlay_content',
			[
				'label' => __( 'Overlay', 'elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'eb_overlay_text' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'overlay_text_align',
			[
				'label' => __( 'Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'elementor' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'elementor' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-text-wrapper' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'overlay_vertical_position',
			[
				'label' => __( 'Vertical Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'elementor' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'middle',
				'prefix_class' => 'eb-cta-box-overlay-vertical-align-',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'overlay_inner_wrapper',
			[
				'label' => __( 'Overlay Inner Wrapper', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'overlay_text_inner_padding',
			[
				'label' => __( 'Inner Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'overlay_inner_background',
			[
				'label' => __( 'Inner Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-inner-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_outer_wrapper',
			[
				'label' => __( 'Overlay Outer Wrapper', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'overlay_text_padding',
			[
				'label' => __( 'Outer Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-text-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_background',
				'label' => __( 'Background Color', 'elementor' ),
				'types' => [ 'classic','gradient' ],
				'selector' => '{{WRAPPER}} .eb-overlay-text-wrapper',
			]
		);

		$this->add_control(
			'overlay_heading_title',
			[
				'label' => __( 'Overlay Title', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'overlay_title_bottom_space',
			[
				'label' => __( 'Spacing', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-text-wrapper .eb-overlay-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'overlay_title_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-text-wrapper .eb-overlay-title' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'overlay_title_typography',
				'selector' => '{{WRAPPER}} .eb-overlay-text-wrapper .eb-overlay-title',
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'overlay_heading_description',
			[
				'label' => __( 'Overlay Description', 'elementor' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'overlay_description_color',
			[
				'label' => __( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eb-overlay-text-wrapper .eb-overlay-description' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'overlay_description_typography',
				'selector' => '{{WRAPPER}} .eb-overlay-text-wrapper .eb-overlay-description',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->end_controls_section();

		//Button #1
		$this->start_controls_section(
			'section_style_button_one',
			[
				'label' => __( 'Button #1', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_one_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_one_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button-one, {{WRAPPER}} .elementor-button-one',
			]
		);

		$this->start_controls_tabs( 'tabs_button_one_style' );

		$this->start_controls_tab(
			'tab_button_one_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'button_one_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one, {{WRAPPER}} .elementor-button-one' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_one_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one, {{WRAPPER}} .elementor-button-one' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_one_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'button_one_hover_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one:hover, {{WRAPPER}} .elementor-button-one:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_one_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one:hover, {{WRAPPER}} .elementor-button-one:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_one_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one:hover, {{WRAPPER}} .elementor-button-one:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_one_hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_one_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-button-one',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_one_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one, {{WRAPPER}} .elementor-button-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_one_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button-one',
			]
		);

		$this->add_responsive_control(
			'button_one_text_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-one, {{WRAPPER}} .elementor-button-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		//Seperator
		$this->start_controls_section(
			'section_style_separator',
			[
				'label' => __( 'Separator Text', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_separator_text' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'separator_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .eb-cta-box-btn-separator',
			]
		);

		$this->add_control(
			'separator_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .eb-cta-box-btn-separator',
				],
			]
		);


		$this->end_controls_section();

		//Button #2
		$this->start_controls_section(
			'section_style_button_two',
			[
				'label' => __( 'Button #2', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_two_text!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_two_typography',
				'scheme' => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} a.elementor-button-two, {{WRAPPER}} .elementor-button-two',
			]
		);

		$this->start_controls_tabs( 'tabs_button_two_style' );

		$this->start_controls_tab(
			'tab_button_two_normal',
			[
				'label' => __( 'Normal', 'elementor' ),
			]
		);

		$this->add_control(
			'button_two_text_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two, {{WRAPPER}} .elementor-button-two' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_two_background_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two, {{WRAPPER}} .elementor-button-two' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_two_hover',
			[
				'label' => __( 'Hover', 'elementor' ),
			]
		);

		$this->add_control(
			'button_two_hover_color',
			[
				'label' => __( 'Text Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two:hover, {{WRAPPER}} .elementor-button-two:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_two_background_hover_color',
			[
				'label' => __( 'Background Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two:hover, {{WRAPPER}} .elementor-button-two:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_two_hover_border_color',
			[
				'label' => __( 'Border Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two:hover, {{WRAPPER}} .elementor-button-two:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_two_hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_two_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .elementor-button-two',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_two_border_radius',
			[
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two, {{WRAPPER}} .elementor-button-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_two_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button-two',
			]
		);

		$this->add_responsive_control(
			'button_two_text_padding',
			[
				'label' => __( 'Padding', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.elementor-button-two, {{WRAPPER}} .elementor-button-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon', 'class', [ 'elementor-icon', 'elementor-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';

		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			if ( 'default' === $settings['link_to_element'] ) {
				$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
				$icon_tag = 'a';

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'link', 'target', '_blank' );
				}

				if ( $settings['link']['nofollow'] ) {
					$this->add_render_attribute( 'link', 'rel', 'nofollow' );
				}
			}
		}

		//Icon
		if ( 'icon' === $settings['box_blurb_style'] ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_render_attribute( 'subtitle_text', 'class', 'eb-cta-box-animate-subtitle' );
		$this->add_render_attribute( 'description_text', 'class', 'elementor-icon-box-description' );
		if ( 'yes' === $settings['hover_content_sequenced_animation']) { 
			$this->add_render_attribute( 'description_text', 'class', 'eb-cta-box-hover-sequenced-item' );
		}

		$this->add_inline_editing_attributes( 'title_text', 'none' );

		$this->add_inline_editing_attributes( 'subtitle_text', 'none' );

		$this->add_inline_editing_attributes( 'description_text' );

		//Button #1
		$this->add_render_attribute( 'button_wrapper', 'class', 'elementor-button-wrapper' );
		if ( 'yes' === $settings['hover_content_sequenced_animation']) { 
			$this->add_render_attribute( 'button_wrapper', 'class', 'eb-cta-box-hover-sequenced-item' );
		}

		if ( ! empty( $settings['button_one_link']['url'] ) ) {
			$this->add_render_attribute( 'button', 'href', $settings['button_one_link']['url'] );
			$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );

			if ( $settings['button_one_link']['is_external'] ) {
				$this->add_render_attribute( 'button', 'target', '_blank' );
			}

			if ( $settings['button_one_link']['nofollow'] ) {
				$this->add_render_attribute( 'button', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button', 'class', 'elementor-button elementor-button-one elementor-button-' . $settings['button_one_type'] );
		$this->add_render_attribute( 'button', 'role', 'button' );

		if ( ! empty( $settings['button_one_size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_one_size'] );
		}

		if ( $settings['button_one_hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_one_hover_animation'] );
		}

		//Button #2
		if ( ! empty( $settings['button_two_link']['url'] ) ) {
			$this->add_render_attribute( 'button_two', 'href', $settings['button_two_link']['url'] );
			$this->add_render_attribute( 'button_two', 'class', 'elementor-button-link' );

			if ( $settings['button_two_link']['is_external'] ) {
				$this->add_render_attribute( 'button_two', 'target', '_blank' );
			}

			if ( $settings['button_two_link']['nofollow'] ) {
				$this->add_render_attribute( 'button_two', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'button_two', 'class', 'elementor-button elementor-button-two elementor-button-' . $settings['button_two_type'] );
		$this->add_render_attribute( 'button_two', 'role', 'button' );

		if ( ! empty( $settings['button_two_size'] ) ) {
			$this->add_render_attribute( 'button_two', 'class', 'elementor-size-' . $settings['button_two_size'] );
		}

		if ( $settings['button_two_hover_animation'] ) {
			$this->add_render_attribute( 'button_two', 'class', 'elementor-animation-' . $settings['button_two_hover_animation'] );
		}

		//CTA
		$this->add_render_attribute( 'hover_content_animation', 'class', 'eb-cta-box' );
		if ( ! empty( $settings['link']['url'] ) ) {
			if ( 'entire_div' === $settings['link_to_element'] ) {
				$this->add_render_attribute( 'main_tag_link', 'href', $settings['link']['url'] );

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'main_tag_link', 'target', '_blank' );
				}

				if ( $settings['link']['nofollow'] ) {
					$this->add_render_attribute( 'main_tag_link', 'rel', 'nofollow' );
				}
				$this->add_render_attribute( 'main_tag_link', 'class', 'eb-cta-box-link' );
			}
		}

		if ( '' !== $settings['hover_content_animation'] ) {
			$this->add_render_attribute( 'hover_content_animation', 'class', 'eb-cta-box-hover eb-cta-hover-' . $settings['hover_content_animation']);
			if ( 'yes' === $settings['eb_overlay_text']) {
				$this->add_render_attribute( 'hover_content_animation', 'class', 'eb-cta-overlay-fade-out eb-cta-overlay-' . $settings['eb_overlay_animation']);
			}
			if ( 'yes' === $settings['hover_content_sequenced_animation']) { 
				$this->add_render_attribute( 'hover_content_animation', 'class', 'eb-cta-box-hover-sequenced-on' );
			} else {
				$this->add_render_attribute( 'hover_content_animation', 'class', 'eb-cta-box-hover-sequenced-off' );
			}
		}


		?>
		<div <?php echo $this->get_render_attribute_string( 'hover_content_animation' ); ?>>
        	<?php
				if ( 'none' !== $settings['eb_effect_image_transition'] ) {
					$this->add_render_attribute( 'eb_effect_image_transition', 'class', 'eb-cta-box-animate-bg eb-cta-box-bg-' . $settings['eb_effect_image_transition']);
				}

				$this->add_render_attribute( 'eb_background_overlay_option', 'class', 'eb-cta-box-overlay');
				if ( 'yes' === $settings['eb_background_overlay_option'] ) {
					$this->add_render_attribute( 'eb_background_overlay_option', 'class', 'eb-cta-box-overlay-show-on-hover');
				}

				$imageBackground = '<div ' . $this->get_render_attribute_string( 'eb_effect_image_transition' ) . '></div>';
				
				$eb_bg_effect = '<div class="eb-cta-box-animate-bg-wrapper">' . $imageBackground . '<div ' . $this->get_render_attribute_string( 'eb_background_overlay_option' ) . '></div></div>';
				echo $eb_bg_effect;
        	?>
			<div class="eb-cta-box-content-wrapper">
		        <div class="elementor-icon-box-wrapper">
			        <?php if ( 'icon' === $settings['box_blurb_style'] ) : ?>
		            <div class="elementor-icon-box-icon<?php if ( 'yes' === $settings['hover_content_sequenced_animation']) { echo ' eb-cta-box-hover-sequenced-item'; }?>">
		                <<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
		                    <i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
		                </<?php echo $icon_tag; ?>>
		            </div>
		            <?php elseif ( 'image' === $settings['box_blurb_style'] && ! empty( $settings['image']['url'] ) ) : ?>
		            	<?php
							$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
							$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
							$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

							$this->add_render_attribute( 'image_hover_animation', 'class', 'elementor-image-box-img elementor-animation-' . $settings['image_hover_animation'] );

							//$blurb_img = '<img ' . $this->get_render_attribute_string( 'image' ) . ' />';

							$blurb_img = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );

							if ( ! empty( $settings['link']['url'] ) ) {
								$blurb_img = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $blurb_img . '</a>';
							}

							$eb_image = '<figure ' . $this->get_render_attribute_string( 'image_hover_animation' ) . '>' . $blurb_img . '</figure>';
							echo $eb_image;
		            	?>
					<?php endif; ?>
		            <div class="elementor-icon-box-content">
		            	<?php if ( 'before' === $settings['subtitle_text_placement'] ) { ?>
		                <p class="eb-cta-box-animate-subtitle<?php if ( 'yes' === $settings['hover_content_sequenced_animation']) { echo ' eb-cta-box-hover-sequenced-item'; }?>" <?php echo $this->get_render_attribute_string( 'subtitle_text' ); ?>><?php echo $settings['subtitle_text']; ?></p>
		                <?php } ?>
		                <?php if ( 'yes' === $settings['divider'] && 'before' === $settings['divider_placement'] ) { ?>
		                <div class="elementor-divider<?php if ( 'yes' === $settings['hover_content_sequenced_animation']) { echo ' eb-cta-box-hover-sequenced-item'; }?>">
							<span class="elementor-divider-separator"></span>
						</div>
						<?php } ?>
		                <<?php echo $settings['title_size']; ?> class="elementor-icon-box-title<?php if ( 'yes' === $settings['hover_content_sequenced_animation']) { echo ' eb-cta-box-hover-sequenced-item'; }?>">
		                    <<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
		                </<?php echo $settings['title_size']; ?>>
		                <?php if ( 'yes' === $settings['divider'] && 'after' === $settings['divider_placement'] ) { ?>
		                <div class="elementor-divider<?php if ( 'yes' === $settings['hover_content_sequenced_animation']) { echo ' eb-cta-box-hover-sequenced-item'; }?>">
							<span class="elementor-divider-separator"></span>
						</div>
						<?php } ?>
		                <?php if ( 'after' === $settings['subtitle_text_placement'] ) { ?>
		                <p class="eb-cta-box-animate-subtitle<?php if ( 'yes' === $settings['hover_content_sequenced_animation']) { echo ' eb-cta-box-hover-sequenced-item'; }?>" <?php echo $this->get_render_attribute_string( 'subtitle_text' ); ?>><?php echo $settings['subtitle_text']; ?></p>
		                <?php } ?>
		                <p <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo $settings['description_text']; ?></p>
		                <?php if ( '' !== $settings['button_one_text'] ) { ?>
		                <div <?php echo $this->get_render_attribute_string( 'button_wrapper' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
							<?php $this->render_text(); ?>
						</a>
						<?php if ( 'yes' === $settings['button_separator'] ) { ?>
							<span class="eb-cta-box-btn-separator"><?php echo $settings['button_separator_text']; ?></span>
						<?php } ?>
						<?php if ( '' !== $settings['button_two_text'] ) { ?>
						<a <?php echo $this->get_render_attribute_string( 'button_two' ); ?>>
							<?php $this->render_text_two(); ?>
						</a>
						<?php } ?>
						</div>
						<?php } ?>
		            </div>
		        </div>
		    </div>
		    <?php if ( 'yes' == $settings['eb_overlay_text'] ) {?>
		    <div class="eb-overlay-text-wrapper">
            	<div class="eb-overlay-text-content">
            		<div class="eb-overlay-inner-wrapper">
	            		<<?php echo $settings['eb_overlay_title_size']; ?> class="eb-overlay-title"><?php echo $settings['eb_overlay_title_text']; ?></<?php echo $settings['eb_overlay_title_size']; ?>>
	            		<p class="eb-overlay-description"><?php echo $settings['eb_overlay_description_text']; ?></p>
	            	</div>
            	</div>
            </div>
            <?php } ?>
            <?php if ( 'entire_div' === $settings['link_to_element'] ) { ?>
				<a <?php echo $this->get_render_attribute_string( 'main_tag_link' ); ?>></a>
			<?php } ?>
    	</div>
		<?php
	}

	/**
	 * Render icon box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _content_template() {
		?>
        <#
        var link = settings.link.url ? 'href="' + settings.link.url + '"' : '';
        if ( 'default' === settings.link_to_element) {
        	var iconTag = 'a';
    	} else {
    		iconTag = 'span';
    	}

		view.addRenderAttribute( 'subtitle_text', 'class', 'eb-cta-box-animate-subtitle' );
        view.addRenderAttribute( 'description_text', 'class', 'elementor-icon-box-description' );
        if ( 'yes' === settings.hover_content_sequenced_animation) {
        	view.addRenderAttribute( 'subtitle_text', 'class', 'eb-cta-box-hover-sequenced-item' );
        	view.addRenderAttribute( 'description_text', 'class', 'eb-cta-box-hover-sequenced-item' );
    	}

        view.addInlineEditingAttributes( 'title_text', 'none' );
        view.addInlineEditingAttributes( 'subtitle_text', 'none' );
        view.addInlineEditingAttributes( 'description_text' );

        view.addRenderAttribute( 'button_one_text', 'class', 'elementor-button-text' );
		view.addInlineEditingAttributes( 'button_one_text', 'none' );

		view.addRenderAttribute( 'button_two_text', 'class', 'elementor-button-text' );
		view.addInlineEditingAttributes( 'button_two_text', 'none' );

		view.addInlineEditingAttributes( 'eb_overlay_title_text', 'none' );
        view.addInlineEditingAttributes( 'eb_overlay_description_text', 'none' );

        view.addRenderAttribute( 'eb_overlay_title_text', 'class', 'eb-overlay-title' );
        view.addRenderAttribute( 'eb_overlay_description_text', 'class', 'eb-overlay-description' );
			
		var ctaBoxWrapperClasses = 'eb-cta-box';
		if ( '' !== settings.hover_content_animation ) {
			ctaBoxWrapperClasses += ' eb-cta-box-hover eb-cta-hover-' + settings.hover_content_animation;
			if ( 'yes' === settings.eb_overlay_text) { 
				ctaBoxWrapperClasses += ' eb-cta-overlay-fade-out eb-cta-overlay-' + settings.eb_overlay_animation;
			}
			if ( 'yes' === settings.hover_content_sequenced_animation) { 
				ctaBoxWrapperClasses += ' eb-cta-box-hover-sequenced-on';
			} else {
				ctaBoxWrapperClasses += ' eb-cta-box-hover-sequenced-off';
			}
		}

		view.addRenderAttribute( 'hover_content_animation', 'class', ctaBoxWrapperClasses );	

		if ( 'entire_div' === settings.link_to_element) { 
			var linktoElement = settings.link.url ? 'href="' + settings.link.url + '"' : '';
			view.addRenderAttribute( 'main_tag_link', 'class', 'eb-cta-box-link' );	
		}

        #>
        <div {{{ view.getRenderAttributeString( 'hover_content_animation' ) }}}>
        	<#

			view.addRenderAttribute( 'eb_background_overlay_option', 'class', 'eb-cta-box-overlay' );

			if ( 'yes' === settings.eb_background_overlay_option ) {
				view.addRenderAttribute( 'eb_background_overlay_option', 'class', 'eb-cta-box-overlay-show-on-hover' );
			}

			#>
			<div class="eb-cta-box-animate-bg-wrapper">
				<div class="eb-cta-box-animate-bg eb-cta-box-bg-{{{ settings.eb_effect_image_transition}}}"></div>
				<div {{{ view.getRenderAttributeString( 'eb_background_overlay_option' ) }}}></div>
			</div>
			<div class="eb-cta-box-content-wrapper">
		        <div class="elementor-icon-box-wrapper">
		        	<# if ( 'icon' === settings.box_blurb_style ) { #>
		            <div class="elementor-icon-box-icon<# if ( 'yes' === settings.hover_content_sequenced_animation ) {#> eb-cta-box-hover-sequenced-item<#}#>">
		                <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
		                    <i class="{{ settings.icon }}" aria-hidden="true"></i>
		                </{{{ iconTag }}}>
		            </div>
					<# }
					else if ( 'image' === settings.box_blurb_style && settings.image.url ) {
						var image = {
							id: settings.image.id,
							url: settings.image.url,
							size: settings.thumbnail_size,
							dimension: settings.thumbnail_custom_dimension,
							model: view.getEditModel()
						};

						var image_url = elementor.imagesManager.getImageUrl( image );

						var imageHtml = '<img src="' + image_url + '" class="elementor-animation-' + settings.image_hover_animation + '" />';

						if ( settings.link.url ) {
							imageHtml = '<a href="' + settings.link.url + '">' + imageHtml + '</a>';
						}

						eb_html = '<figure class="elementor-image-box-img">' + imageHtml + '</figure>';
						print( eb_html );
					} #>
		            <div class="elementor-icon-box-content">
		            	<# if ( 'before' === settings.subtitle_text_placement ) { #>
		                <p {{{ view.getRenderAttributeString( 'subtitle_text' ) }}}>{{{ settings.subtitle_text }}}</p>
		                <# } #>
		                <# if ( 'yes' === settings.divider && 'before' === settings.divider_placement ) { #>
		                <div class="elementor-divider<# if ( 'yes' === settings.hover_content_sequenced_animation ) {#> eb-cta-box-hover-sequenced-item<#}#>">
							<span class="elementor-divider-separator"></span>
						</div>
						<# } #>
		                <{{{ settings.title_size }}} class="elementor-icon-box-title<# if ( 'yes' === settings.hover_content_sequenced_animation ) {#> eb-cta-box-hover-sequenced-item<#}#>">
		                    <{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
		                </{{{ settings.title_size }}}>
		                 <# if ( 'yes' === settings.divider && 'after' === settings.divider_placement ) { #>
		                <div class="elementor-divider<# if ( 'yes' === settings.hover_content_sequenced_animation ) {#> eb-cta-box-hover-sequenced-item<#}#>">
							<span class="elementor-divider-separator"></span>
						</div>
						<# } #>
		                <# if ( 'after' === settings.subtitle_text_placement ) { #>
		                <p {{{ view.getRenderAttributeString( 'subtitle_text' ) }}}>{{{ settings.subtitle_text }}}</p>
		                <# } #>
		                <p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
		                <# if ( settings.button_one_text ) { #>
		                	<div class="elementor-button-wrapper<# if ( 'yes' === settings.hover_content_sequenced_animation ) {#> eb-cta-box-hover-sequenced-item<#}#>">
								<a class="elementor-button elementor-size-{{ settings.button_one_size }} elementor-button-{{ settings.button_one_type }} elementor-button-one elementor-animation-{{ settings.button_one_hover_animation }}" href="{{ settings.button_one_link.url }}" role="button">
									<span class="elementor-button-content-wrapper">
										<# if ( settings.button_one_icon ) { #>
										<span class="elementor-button-icon elementor-align-icon-{{ settings.button_one_icon_align }}">
											<i class="{{ settings.button_one_icon }}" aria-hidden="true"></i>
										</span>
										<# } #>
										<span {{{ view.getRenderAttributeString( 'button_one_text' ) }}}>{{{ settings.button_one_text }}}</span>
									</span>
								</a>
								<# if ( settings.button_separator === 'yes' ) { #>
									<span class="eb-cta-box-btn-separator">{{{ settings.button_separator_text }}}</span>
								<# } #>
								<# if ( settings.button_two_text ) { #>
								<a class="elementor-button elementor-size-{{ settings.button_two_size }} elementor-button-{{ settings.button_two_type }} elementor-button-two elementor-animation-{{ settings.hover_animation }}" href="{{ settings.button_two_link.url }}" role="button">
									<span class="elementor-button-content-wrapper">
										<# if ( settings.button_two_icon ) { #>
										<span class="elementor-button-icon elementor-align-icon-{{ settings.button_two_icon_align }}">
											<i class="{{ settings.button_two_icon }}" aria-hidden="true"></i>
										</span>
										<# } #>
										<span {{{ view.getRenderAttributeString( 'button_two_text' ) }}}>{{{ settings.button_two_text }}}</span>
									</span>
								</a>
								<# } #>
							</div>
		                <# } #>
		            </div>
		        </div>
		    </div>
		    <# if ( 'yes' === settings.eb_overlay_text ) { #>
            <div class="eb-overlay-text-wrapper">
            	<div class="eb-overlay-text-content">
            		<div class="eb-overlay-inner-wrapper">
	            		<{{{ settings.eb_overlay_title_size }}} {{{ view.getRenderAttributeString( 'eb_overlay_title_text' ) }}}>{{{ settings.eb_overlay_title_text }}}</{{{ settings.eb_overlay_title_size }}}>
	            		<# if ( '' !== settings.eb_overlay_description_text ) { #>
	            		<p {{{ view.getRenderAttributeString( 'eb_overlay_description_text' ) }}}>{{{ settings.eb_overlay_description_text }}}</p>
	            		<# } #>
	            	</div>
            	</div>
            </div>
            <# } #>
            <# if ( 'entire_div' === settings.link_to_element ) { #>
            <a {{{ view.getRenderAttributeString( 'main_tag_link' ) }}} {{{ linktoElement }}}></a>
            <# } #>
    	</div>
		<?php
	}

	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['button_one_icon_align'],
				],
			],
			'button_one_text' => [
				'class' => 'elementor-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'button_one_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['button_one_icon'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<i class="<?php echo esc_attr( $settings['button_one_icon'] ); ?>" aria-hidden="true"></i>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'button_one_text' ); ?>><?php echo $settings['button_one_text']; ?></span>
		</span>
		<?php
	}

	protected function render_text_two() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['button_two_icon_align'],
				],
			],
			'button_two_text' => [
				'class' => 'elementor-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'button_two_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['button_two_icon'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<i class="<?php echo esc_attr( $settings['button_two_icon'] ); ?>" aria-hidden="true"></i>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'button_two_text' ); ?>><?php echo $settings['button_two_text']; ?></span>
		</span>
		<?php
	}
}

Plugin::instance()->widgets_manager->register_widget_type( new EB_CTA_Box_Animate() );