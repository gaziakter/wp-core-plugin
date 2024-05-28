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
class Harry_Contact_Info extends Widget_Base {

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
		return 'harry-contact-info';
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
		return __( 'Harry Contact', 'harry-core' );
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
			'harry_cf7_section',
			[
				'label' => esc_html__( 'Form Shortcode', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__( 'Title', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Default title', 'harry-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'harry-core' ),
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




		$this->start_controls_section(
			'contact_info_section',
			[
				'label' => esc_html__( 'Contact List', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Strategy' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Concept' , 'textdomain' ),
				'label_block' => true,
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


		$this->add_control(
			'contact_list',
			[
				'label' => esc_html__( 'Process List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'textdomain' ),
					],
					[
						'process_title' => esc_html__( 'Title #2', 'textdomain' ),
					],
				],
				'title_field' => '{{{ title }}}',
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

		<section class="contact__area pt-150 pb-150 p-relative z-index-1">
            <div class="contact__shape">
               <span class="contact__shape-1"></span>
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-6">
                     <div class="contact__wrapper-9">
                        <div class="section__title-wrapper-9 mb-85">
                           <h3 class="section__title-9"><?php echo wp_kses_post($settings['harry_title']); ?></h3>
                        </div>
                        <div class="contact__list-9 mr-100">
						<?php foreach (  $settings['contact_list'] as $key => $item ) : ?>
                           <div class="contact__list-item-9 flex-wrap d-flex align-items-start">
                              <div class="contact__list-icon-9">
                                 <span>
								<?php if(!empty($item['select_icon'] == 'icon')) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>	
								<?php else: ?>
								<?php echo $item['harry_svg_icon']; ?>
								<?php endif; ?>
                                    <img class="contact-icon-shape" src="<?php echo get_template_directory_uri();?>/assets/img/contact/contact-icon-shape.png" alt="">
                                 </span>
                              </div>
                              <div class="contact__list-content-9">
                                 <h5><?php echo esc_html($item['title']); ?></h5>
                                 <p><a href="tel:<?php echo esc_attr($item['sub_title']); ?>"><?php echo esc_html($item['sub_title']); ?></a></p>
                              </div>
                           </div>
						   <?php endforeach; ?>	
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-6">
                     <div class="contact__form-9 pt-20 pl-70">
                        <h4 class="contact__form-9-title"><?php echo esc_html($settings['form_title']); ?></h4>
						<?php if(!empty($settings['shortcode'])) : ?>			
                        <div class="contact__form-9-inner">
							<?php echo do_shortcode( $settings['shortcode'] ); ?>
                        </div>
						<?php endif; ?>	
                     </div>
                  </div>
               </div>
            </div>
         </section>

		<?php
	}

}


$widgets_manager->register( new Harry_Contact_Info() );