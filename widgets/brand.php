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
class Harry_Brand extends Widget_Base {

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
		return 'harry-brand';
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
		return __( 'Brand List', 'harry-core' );
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
			'harry_item_list_section',
			[
				'label' => esc_html__( 'Brand List', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'harry_item_list',
			[
				'label' => esc_html__( 'item List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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

		if ( ! empty( $settings['hero_link']['url'] ) ) {
			$this->add_link_attributes( 'button_arg', $settings['hero_link'] );
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-5 tp-link-btn-3');
		}


		?>


	<?php if($settings['design_style'] == 'style_02') : ?>
		<section class="brand__area">
		<div class="container-fluid g-0">
			<div class="row gx-0 gy-2">
				<div class="col-xxl-12">
					<div class="brand__slider-5-1 brand__style-square">
						<div class="brand__slider-5">
							<div class="brand__slider-active-5-1" >
								<?php foreach (  $settings['harry_item_list'] as $key => $item ) : ?>
								<div class="brand__item-5">
									<img src="<?php echo esc_url($item['item_image']['url']); ?>" alt="">
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php else: ?>	
	<section class="brand__area">
		<div class="container-fluid g-0">
			<div class="row gx-0 gy-2">
				<div class="col-xxl-12">
					<div class="brand__slider-5 brand__style-square">
					<div class="brand__slider-5">
						<div class="brand__slider-active-5">
							<?php foreach (  $settings['harry_item_list'] as $key => $item ) : ?>
							<div class="brand__item-5">
								<img src="<?php echo esc_url($item['item_image']['url']); ?>" alt="">
							</div>
							<?php endforeach; ?>
						</div>
					</div>
					</div>
				</div>
				<div class="col-xxl-12 d-none">
					<div class="brand__slider-5-1 brand__style-square">
					<div class="brand__slider-5">
						<div class="brand__slider-active-5-1" >
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-1.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-3.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-6.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-5.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-2.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-4.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-8.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-7.png" alt="">
							</div>
							<div class="brand__item-5">
								<img src="assets/img/brand/5/brand-2.png" alt="">
							</div>
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>							


		<?php
	}

}


$widgets_manager->register( new Harry_Brand() );