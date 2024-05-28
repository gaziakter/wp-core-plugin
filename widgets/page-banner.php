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
class Harry_Page_Banner extends Widget_Base {

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
		return 'harry-page-banner';
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
		return __( 'Harry Page Banner', 'harry-core' );
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
			'harry_title_section',
			[
				'label' => esc_html__( 'Title and Content', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'is_breadcrumb',
			[
				'label' => esc_html__( 'Breadcrumb enable?', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'textdomain' ),
				'label_off' => esc_html__( 'Hide', 'textdomain' ),
				'return_value' => 'yes',
				'default' => '',
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
			'item_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
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

		?>

		<?php if($settings['design_style'] == 'style_02') : ?>

		<?php else: ?>	
			
		<section class="breadcrumb__area breadcrumb__style-6 p-relative include-bg pt-200 pb-120">
            <div class="breadcrumb__bg-2 breadcrumb__overlay include-bg" style="background-image:url(<?php echo esc_url($settings['item_image']['url']); ?>)"></div>
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xxl-8 col-xl-8 col-lg-10">
                     <div class="breadcrumb__content text-center p-relative z-index-1">
					 	<?php if(!empty($settings['harry_title'])) : ?>
                        <h3 class="breadcrumb__title"><?php echo wp_kses_post($settings['harry_title']); ?></h3>
						<?php endif; ?>
						<?php if(function_exists('bcn_display') && !empty($settings['is_breadcrumb'])) : ?>
                        <div class="breadcrumb__list">
							<?php bcn_display(); ?> 
                        </div>
						<?php endif; ?>
                     </div>
                  </div>
               </div>
            </div>
        </section>

		

		<?php endif; ?>

		<?php
	}

}


$widgets_manager->register( new Harry_Page_Banner() );