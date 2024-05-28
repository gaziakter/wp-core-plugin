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


		$this->start_controls_section(
			'harry_social_section',
			[
				'label' => esc_html__( 'Social List', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'design_style' => ['style_02'],
				],
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'social_title',
			[
				'label' => esc_html__( 'Social Title', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Strategy' , 'textdomain' ),
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
			'harry_social_list',
			[
				'label' => esc_html__( 'Social List', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'social_title' => esc_html__( 'Title #1', 'textdomain' ),
					],
					[
						'social_title' => esc_html__( 'Title #2', 'textdomain' ),
					],
				],
				'title_field' => '{{{ social_title }}}',
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

		<?php if($settings['design_style'] == 'style_02') : 
			if ( ! empty( $settings['harry_link']['url'] ) ) {
				$this->add_link_attributes( 'button_arg', $settings['harry_link'] );
				$this->add_render_attribute('button_arg', 'class', 'tp-btn');
			}
		?>

		<section class="about__me-info pb-90 pt-110">
            <div class="container">
               <div class="row">
                  <div class="col-xl-4 col-lg-3">
                     <span class="about__me-info-subtitle"><?php echo esc_html($settings['harry_sub_title']); ?></span>
                  </div>
                  <div class="col-xl-8 col-lg-9">
                     <div class="about__me-info-content wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <h4 class="about__me-info-title"><?php echo wp_kses_post($settings['harry_title']); ?> <img src="<?php echo get_template_directory_uri(); ?>/assets/img/about/about-me-title-icon.png" alt=""></h4>
                        <p><?php echo wp_kses_post($settings['harry_text']); ?></p>

                        <div class="about__me-info-bottom d-sm-flex align-items-center mt-40">
						<?php if(!empty($settings['harry_button_text'])) : ?>
                           <div class="about__me-info-btn mr-30">
                              <a <?php echo $this->get_render_attribute_string( 'button_arg' ); ?>>
							  	<?php echo esc_html($settings['harry_button_text']); ?>
                                 <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                 </svg>
                              </a>
                           </div>
						   <?php endif; ?>
                           <div class="about__me-info-social">
						   <?php foreach (  $settings['harry_social_list'] as $key => $item ) : ?>
                              <a href="#">
								
							  <?php if(!empty($item['select_icon'] == 'icon')) : ?>
								<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>	
							<?php else: ?>
							<?php echo $item['harry_svg_icon']; ?>
							<?php endif; ?>
							  
							  <?php echo esc_html($item['social_title']); ?>
							</a>
							<?php endforeach; ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

		<?php elseif($settings['design_style'] == 'style_03') : ?>

		<div>
			<h1>This is style three</h1>
		</div>	

		<?php else: 
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
		<?php endif; ?>



		<?php
	}

}


$widgets_manager->register( new Harry_About_Me() );