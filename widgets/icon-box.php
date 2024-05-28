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
class Harry_Icon_Box extends Widget_Base {

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
		return 'harry-icon-box';
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
		return __( 'Harry Icon Box', 'harry-core' );
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
			'harry_design_section',
			[
				'label' => esc_html__( 'Design Style', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'design_style',
			[
				'label' => esc_html__( 'Choose Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style_01',
				'options' => [
					'style_01' => esc_html__( 'Style 01', 'textdomain' ),
					'style_02' => esc_html__( 'Style 02', 'textdomain' ),
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'harry_icon_box_section',
			[
				'label' => esc_html__( 'Title and Content', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				'default' => esc_html__( 'Default title', 'harry-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'harry-core' ),
			]
		);

		$this->add_control(
			'harry_desc',
			[
				'label' => esc_html__( 'Content', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Hic nesciunt galisum aut dolorem aperiam eum soluta quod ea cupiditate.', 'harry-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'harry-core' ),
				'condition' => [
					'design_style' => 'style_02',
				],
			]
		);

		$this->add_control(
			'select_icon',
			[
				'label' => esc_html__( 'Chose Icon Method', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'icon' => esc_html__( 'Icon', 'textdomain' ),
					'svg'  => esc_html__( 'SVG', 'textdomain' ),
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-smile',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'condition' => [
					'select_icon' => 'icon',
				],
			]
		);

		$this->add_control(
			'harry_svg_icon',
			[
				'label' => esc_html__( 'SVG', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', 'harry-core' ),
				'placeholder' => esc_html__( 'svg icon code here', 'harry-core' ),
				'condition' => [
					'select_icon' => 'svg',
				],
			]
		);

		$this->add_control(
			'box_url',
			[
				'label' => esc_html__( 'URL', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '#' , 'textdomain' ),
				'label_block' => true,
				'condition' => [
					'design_style' => 'style_01',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'harry_button_section',
			[
				'label' => esc_html__( 'Button', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design_style' => 'style_02',
				],
			]
		);

		$this->add_control(
			'harry_button_text',
			[
				'label' => esc_html__( 'Button Text', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'harry-core' ),
				'placeholder' => esc_html__( 'Button text here', 'harry-core' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'harry_link',
			[
				'label' => esc_html__( 'Link', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
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
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-border');
		}


		?>

		<?php if($settings['design_style'] == 'style_02') : ?>
			<div class="services__item transition-3 mb-30 fix wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
				<div class="services__shape">
					<img class="services__shape-1" src="<?php echo get_template_directory_uri();?>/assets/img/services/shape/services-shape-1.png" alt="">
					<img class="services__shape-2" src="<?php echo get_template_directory_uri();?>/assets/img/services/shape/services-shape-2.png" alt="">
				</div>
				<div class="services__item-inner">
					<div class="services__icon">
						<span>
						<?php if(!empty($settings['select_icon'] == 'icon')) : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>	
						<?php else: ?>
						<?php echo $settings['harry_svg_icon']; ?>
						<?php endif; ?>
						</span>
					</div>
					<div class="services__content">
						<h3 class="services__title">
						<?php if(!empty($settings['harry_link']['url'])) : ?>
						<a href="<?php echo esc_url($settings['harry_link']['url']); ?>"><?php echo esc_html($settings['harry_title']); ?></a>
						<?php else: ?>
						<?php echo esc_html($settings['harry_title']); ?>
						<?php endif; ?>	
						</h3>
						<?php if(!empty($settings['harry_desc'])) : ?>
						<p><?php echo esc_html($settings['harry_desc']); ?></p>
						<?php endif; ?>	
						<?php if(!empty($settings['harry_link']['url'])) : ?>	
						<div class="services__btn">
							<a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>><?php echo esc_html($settings['harry_button_text']); ?> <i class="fa-regular fa-angle-right"></i></a>
						</div>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		<?php else: ?>	


		<div class="services__item-9 mb-30 transition-3">
			<div class="services__item-9-top d-flex align-items-start justify-content-between">
				<div class="services__icon-9">
					<span>
						<?php if(!empty($settings['select_icon'] == 'icon')) : ?>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>	
						<?php else: ?>
						<?php echo $settings['harry_svg_icon']; ?>
						<?php endif; ?>


						<img src="<?php echo get_template_directory_uri(  ); ?> /assets/img/services/9/services-icon-shape.png" alt="">  

					</span>
				</div>
				<?php if(!empty($settings['box_url'])) : ?>
				<div class="services__btn-9">
					<a href="<?php echo esc_url($settings['box_url']); ?>"><i class="fa-light fa-arrow-up-right"></i></a>
				</div>
				<?php endif; ?>
			</div>
			<div class="services__content-9">
				<?php if(!empty($settings['harry_sub_title'])) : ?>
				<span class="services-project"><?php echo esc_html($settings['harry_sub_title']); ?></span>
				<?php endif; ?>
				<?php if(!empty($settings['harry_title'])) : ?>
				<h3 class="services__title-9">
					<?php if(!empty($settings['box_url'])) : ?>
					<a href="<?php echo esc_url($settings['box_url']); ?>"><?php echo esc_html($settings['harry_title']); ?></a>
					<?php else: ?>
					<?php echo esc_html($settings['harry_title']); ?>
					<?php endif; ?>	
				</h3>
				<?php endif; ?>
			</div>
		</div>

		<?php endif; ?>

		<?php
	}

}


$widgets_manager->register( new Harry_Icon_Box() );