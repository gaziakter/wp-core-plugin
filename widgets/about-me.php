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
class Harry_About_Me extends Widget_Base {

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
		return 'harry-about-me';
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
		return __( 'About Me', 'harry-core' );
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

		$this->start_controls_section(
			'harry_button_section',
			[
				'label' => esc_html__( 'Button', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
			$this->add_render_attribute('button_arg', 'class', 'tp-btn-5 tp-btn-5-white');
		}


		?>

		<section class="about__area about__space-145">
            <div class="about__inner-9 black-bg wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
               <div class="container">
                  <div class="row justify-content-center">
                     <div class="col-xxl-10 col-xl-10 col-lg-11 col-md-10">
                        <div class="about__wrapper-9">
						<?php if(!empty($settings['harry_sub_title'])) : ?>
                           <span class="about-subtitle"><?php echo esc_html($settings['harry_sub_title']); ?></span>
						   <?php endif; ?>
						   <?php if(!empty($settings['harry_title'])) : ?>
                           <h3 class="about-title"><?php echo wp_kses_post($settings['harry_title']); ?></h3>
						   <?php endif; ?>

						   <?php if(!empty($settings['harry_text'])) : ?>
                           <p><?php echo esc_html($settings['harry_text']); ?></p>
						   <?php endif; ?>

						   <?php if(!empty($settings['harry_button_text'])) : ?>
                           <div class="about__btn-9">
                            <a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>><?php echo esc_html($settings['harry_button_text']); ?></a>
                           </div>
						   <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
		<?php
	}

}


$widgets_manager->register( new Harry_About_Me() );