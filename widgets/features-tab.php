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
class Harry_Features_Tab extends Widget_Base {

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
		return 'harry-features-tab';
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
		return __( 'Harry Features Tab', 'harry-core' );
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
			'Harry_Features_Tab_section',
			[
				'label' => esc_html__( 'Process List', 'harry-core' ),
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
			'Harry_Features_Tab_list',
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

		<section class="vision__area vision__style-2 pt-110 pb-110 grey-bg-4">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-5">
                     <div class="vision__tab tp-tab">
                        <ul class="nav nav-tabs flex-column" id="visionTab" role="tablist">
							<?php foreach (  $settings['Harry_Features_Tab_list'] as $key => $item ) : 
								// $active = ($key == 1) ? 'active' : '';
								$active = $item['active_switch'] ? 'active' : '';

								$index = $key + 1;
							?>
                           <li class="nav-item wow fadeInUp" role="presentation" data-wow-delay=".3s" data-wow-duration="1s">
                             <button class="nav-link <?php echo esc_attr($active); ?>" id="crime-tab-<?php echo esc_attr($index); ?>" data-bs-toggle="tab" data-bs-target="#crime-<?php echo esc_attr($index); ?>" type="button" role="tab" aria-controls="crime-<?php echo esc_attr($index); ?>" aria-selected="false">
                              <span>
							  	<?php if(!empty($item['select_icon'] == 'icon')) : ?>
									<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>	
								<?php else: ?>
								<?php echo $item['harry_svg_icon']; ?>
								<?php endif; ?>                                   
                              </span>
							  
							  <?php echo esc_html($item['harry_title']); ?>
                             </button>
                           </li>
						   <?php endforeach; ?>	
                         </ul>                       
                     </div>
                  </div>
                  <div class="col-xxl-9 col-xl-8 col-lg-8 col-md-7">
                     <div class="vision__tab-content pl-70">
                        <div class="tab-content" id="visionTabContent">
						<?php foreach (  $settings['Harry_Features_Tab_list'] as $key => $item ) : 
							// $active = ($key == 1) ? 'active' : '';
							$active = $item['active_switch'] ? 'show active' : '';
							$index = $key + 1;
						?>
                           <div class="tab-pane fade <?php echo esc_attr($active); ?> wow fadeInUp" id="crime-<?php echo esc_attr($index); ?>" role="tabpanel" aria-labelledby="crime-tab-<?php echo esc_attr($index); ?>">
                              <div class="vision__item">
                                 <div class="vision__thumb m-img mb-30">
								 	<img src="<?php echo esc_url($item['harry_image']['url']); ?>" alt="">
                                 </div>
                                 <div class="vision__content">
                                    <p><?php echo esc_html($item['harry_content']); ?></p>

                                    <div class="vision__list">
									<?php echo $item['harry_content_list']; ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
						   <?php endforeach; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

		<?php
	}

}


$widgets_manager->register( new Harry_Features_Tab() );