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
class Harry_Skill extends Widget_Base {

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
		return 'harry-skill';
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
		return __( 'Skill', 'harry-core' );
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
			'harry_item_list_section',
			[
				'label' => esc_html__( 'Skill List', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_number',
			[
				'label' => esc_html__( 'Number', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '90' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Concept' , 'textdomain' ),
				'label_block' => true,
			]
		);

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
				'default' => [
					[
						'item_title' => esc_html__( 'Title #1', 'textdomain' ),
						'item_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
					[
						'item_title' => esc_html__( 'Title #2', 'textdomain' ),
						'item_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'textdomain' ),
					],
				],
				'title_field' => '{{{ item_title }}}',
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

		<div class="skill__item-wrapper-9">
			<div class="row">
				<?php foreach (  $settings['harry_item_list'] as $key => $item ) : ?>
				<div class="col-xxl-6 col-md-6 col-sm-6 col-6">
					<div class="skill__item-9">
						<div class="skill__icon-9">
							<span>
								<img src="<?php echo esc_url($item['item_image']['url']); ?>" alt="">
							</span>
						</div>
						<div class="skill__content-9">
							<h4><?php echo esc_html($item['item_title']); ?> <span>(<span data-purecounter-duration="1" data-purecounter-end="<?php echo esc_html($item['item_number']); ?>"  class="purecounter">0</span>%)</span></h4>
						</div>
					</div>
				</div>
				<?php endforeach; ?>	
			</div>
		</div>


		<?php
	}

}


$widgets_manager->register( new Harry_Skill() );