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
class Harry_Accordion extends Widget_Base {

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
		return 'harry-accordion';
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
		return __( 'Harry Accordion', 'harry-core' );
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
			'Harry_Accordion_section',
			[
				'label' => esc_html__( 'Accordion Item', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'active_switch',
			[
				'label' => esc_html__( 'Active Item', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$repeater->add_control(
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

		$repeater->add_control(
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

		$repeater->add_control(
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

		$repeater->add_control(
			'harry_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Concept' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'harry_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'I design beautifully simple things,and i love what i do.' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'harry_content_list',
			[
				'label' => esc_html__( 'Content List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'harry_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'Harry_Accordion_list',
			[
				'label' => esc_html__( 'Process List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'harry_title' => esc_html__( 'Title #1', 'textdomain' ),
						'harry_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'harry_title' => esc_html__( 'Title #2', 'textdomain' ),
						'harry_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ harry_title }}}',
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
		<div class="services__details-faq faq__style-3">
			<div class="faq__tab-content tp-accordion">
				<div class="accordion" id="general_accordion">
					<?php foreach (  $settings['Harry_Accordion_list'] as $key => $item ) : 
						// $active = ($key == 1) ? 'active' : '';
						$active = $item['active_switch'] ? '' : 'collapsed';
						$show = $item['active_switch'] ? 'show' : '';

						$index = $key + 1;
					?>
					<div class="accordion-item">
						<h2 class="accordion-header" id="headingTwo-<?php echo esc_attr($index); ?>">
							<button class="accordion-button <?php echo esc_attr($active); ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo-<?php echo esc_attr($index); ?>" aria-expanded="false" aria-controls="collapseTwo-<?php echo esc_attr($index); ?>">
							<?php echo esc_html($item['harry_title']); ?>
							</button>
						</h2>
						<div id="collapseTwo-<?php echo esc_attr($index); ?>" class="accordion-collapse collapse <?php echo esc_attr($show); ?>" aria-labelledby="headingTwo-<?php echo esc_attr($index); ?>" data-bs-parent="#general_accordion">
							<div class="accordion-body">
								<p><?php echo esc_html($item['harry_content']); ?></p>
							</div>
						</div>
					</div>
					<?php endforeach; ?>	
				</div>
			</div>
		</div>

		<?php
	}

}


$widgets_manager->register( new Harry_Accordion() );