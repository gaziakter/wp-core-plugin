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
class Harry_Newsletter extends Widget_Base {

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
		return 'harry-Newsletter';
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
		return __( 'Harry Newsletter', 'harry-core' );
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
				'label' => esc_html__( 'Title', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->end_controls_section();

		$this->start_controls_section(
			'harry_newsletter_section',
			[
				'label' => esc_html__( 'Form Shortcode', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'shortcode',
			[
				'label' => esc_html__( 'Shortcode', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '', 'harry-core' ),
				'placeholder' => esc_html__( 'shortcode here', 'harry-core' ),
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

		<?php if(!empty($settings['shortcode'])) : ?>	
		<section class="subscribe__area p-relative z-index-1">
            <div class="subscribe__bg"></div>
            <div class="container">
               <div class="subscribe__inner-14">
                  <div class="row gx-0 align-items-center">
                     <div class="col-xl-5 col-lg-5">
                        <h3 class="subscribe__title-14"><?php echo wp_kses_post($settings['harry_title']); ?></h3>
                     </div>
                     <div class="col-xl-7 col-lg-7">
                        <div class="subscribe__form-14">
							<?php echo do_shortcode( $settings['shortcode'] ); ?>
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


$widgets_manager->register( new Harry_Newsletter() );