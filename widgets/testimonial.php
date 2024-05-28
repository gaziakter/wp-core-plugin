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
class Harry_Testimonial extends Widget_Base {

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
		return 'harry-testimonial-list';
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
		return __( 'Testimonial', 'harry-core' );
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
				'label' => esc_html__( 'Testimonials', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_sub_title',
			[
				'label' => esc_html__( 'Subject', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Awesome Support' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_title',
			[
				'label' => esc_html__( 'Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Reviewer Name' , 'textdomain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'item_content',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'There are many variations passages Lorem Ipsum available the majority suffered alteration in some form by injected humour randomised look embarrassing in middle text' , 'textdomain' ),
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

		<section class="testimonial__area">
            <div class="container">

               <div class="row justify-content-center">
                  <div class="col-xxl-12">
                     <div class="testimonial__slider-9 p-relative">
                        <div class="testimonial__slider-active-9">
						<?php foreach (  $settings['harry_item_list'] as $key => $item ) : ?>
                           <div class="testimonial__item-9">
                              <div class="testimonial__content-9 text-center">
                                 <div class="testimonial__shape-quote-9">
                                    <img src="<?php echo get_template_directory_uri(  ); ?>/assets/img/testimonial/9/testimonial-quote-1.png" alt="">
                                 </div>
                                 <h4 class="testimonial-heading"><?php echo esc_html($item['item_sub_title']); ?></h4>
                                 <p><?php echo esc_html($item['item_content']); ?></p>
                          
                                 <div class="testimonial__avater-info-9">
                                    <h3 class="testimonial__avater-title-9"><?php echo esc_html($item['item_title']); ?></h3>
                                 </div>
                              </div>
                           </div>
						   <?php endforeach; ?>	
                        </div>
                        <div class="row justify-content-center">
                           <div class="col-xxl-6 col-xl-6 col-lg-7 col-md-10 col-sm-8">
                              <div class="testimonial__slider-nav-9 mt-35 mb-15 ml-25 mr-25">
								<?php foreach (  $settings['harry_item_list'] as $key => $item ) : ?>
                                 <div class="testimonial__slider-9-thumb-nav">
                                    <div class="tp-border-loader">
                                       <svg width="116" height="116" viewBox="0 0 116 116" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <circle cx="58" cy="58" r="56.5" stroke-width="0"></circle> 
                                          <circle cx="58" cy="58" r="56.5" stroke-width="3" stroke-linecap="round" style="stroke-dashoffset: -356px; stroke-dasharray: 0px, 366px;"></circle>
                                      </svg>
                                    </div>
                                    <img src="<?php echo esc_url($item['item_image']['url']); ?>" alt="">
                                 </div>
								 <?php endforeach; ?>
                              </div>
                              
                           </div>
                        </div>
                        <div class="testimonial__slider-arrow-9 d-none d-md-block">
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

		<?php
	}

}


$widgets_manager->register( new Harry_Testimonial() );