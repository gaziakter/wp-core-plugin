<?php
namespace HarryCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Harry Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Harry_Heading extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'harry-heading';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Harry Heading', 'harry-core' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
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
		return [ 'harry-category' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'harry-core' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'harry_title_section',
			[
				'label' => esc_html__( 'Title and Content', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_center',
			[
				'label' => esc_html__( 'Center enable?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'harry_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub title', 'harry-core' ),
				'placeholder' => esc_html__( 'Type your sub title here', 'harry-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'harry_title',
			[
				'label' => esc_html__( 'Title', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Default Sub title', 'harry-core' ),
				'placeholder' => esc_html__( 'Type your sub title here', 'harry-core' ),
			]
		);
		$this->add_control(
			'harry_text',
			[
				'label' => esc_html__( 'Description', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Content here..', 'harry-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'harry-core' ),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['harry_link']['url'] ) ) {
			$this->add_link_attributes( 'button_arg', $settings['harry_link'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-5 tp-btn-5-white');
		}

		$is_center = $settings['is_center'] ? 'is-center' : '';


		?>

		<div class="section__title-wrapper-9 mb-65 <?php echo esc_attr($is_center); ?>">
		<?php if(!empty($settings['harry_sub_title'])) : ?>
			<span class="section__title-pre-9"><?php echo esc_html($settings['harry_sub_title']); ?></span>
			<?php endif; ?>
			<?php if(!empty($settings['harry_title'])) : ?>
			<h3 class="section__title-9"><?php echo wp_kses_post($settings['harry_title']); ?></h3>
			<?php endif; ?>
			<?php if(!empty($settings['harry_text'])) : ?>
			<p><?php echo esc_html($settings['harry_text']); ?></p>
			<?php endif; ?>
		</div>

		<?php
	}

}


$widgets_manager->register( new Harry_Heading() );