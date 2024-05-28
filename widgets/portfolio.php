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
class Harry_Portfolio extends Widget_Base {

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
		return 'harry-portfolio-post';
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
		return __( 'Portfolio Post', 'harry-core' );
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
			'cat_list',
			[
				'label' => esc_html__( 'Category', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => post_cat('portfolio-cat'),
			]
		);

		$this->add_control(
			'post_not_in',
			[
				'label' => esc_html__( 'Post Not In', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => get_all_post('harry-portfolio'),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Post Per Page', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
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

		$args = array(
			'post_type' => 'harry-portfolio',
			'posts_per_page' => $settings['posts_per_page'],
			'order' => "DESC",
			'order_by' => ['title','name','date','ID'],
			'post_status' => array( 'publish' ),
			'post__not_in' => $settings['post_not_in'],
			
		);

		if(!empty($settings['cat_list']) || !empty($settings['cat_exclude'])){
			$args['tax_query'] = array(
				array(
				'taxonomy' => 'portfolio-cat',
				'field' => 'slug',
				'terms' => (!empty($settings['cat_exclude'])) ? $settings['cat_exclude'] : $settings['cat_list'] ,
				'operator' => (!empty($settings['cat_exclude'])) ? 'NOT IN' : 'IN',
				),
			);
		}

		$query = new \WP_Query( $args );

			
		?>

		<section class="portfolio__area pt-110 pb-75 p-relative fix">
            <div class="portfolio__shape d-none">
               <img class="portfolio__shape-13" src="assets/img/portfolio/grid/shape/circle-1.png" alt="">
               <img class="portfolio__shape-14" src="assets/img/portfolio/grid/shape/circle-2.png" alt="">
               <img class="portfolio__shape-15" src="assets/img/portfolio/grid/shape/circle-sm.png" alt="">
               <img class="portfolio__shape-16" src="assets/img/portfolio/grid/shape/polygon-yellow.png" alt="">
               <img class="portfolio__shape-17" src="assets/img/portfolio/grid/shape/polygon-pink.png" alt="">
               <img class="portfolio__shape-18" src="assets/img/portfolio/grid/shape/polygon-green.png" alt="">
               <img class="portfolio__shape-19" src="assets/img/portfolio/grid/shape/polygon-green-2.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="portfolio__section-title-wrapper text-center mb-90">
                        <span class="portfolio__section-title-pre">CHECK OUT OUR LATEST WORK</span>
                        <h3 class="portfolio__section-title">Portfolio Classic</h3>
                     </div>
                  </div>
               </div>
               <?php if(!empty($settings['cat_list'])) : ?>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__masonary-btn text-center mb-40">
                           <div class="masonary-menu filter-button-group">
                              <button class="active" data-filter="*">All <span><?php echo esc_html($query->post_count); ?></span></button>
							  <?php foreach ( $settings['cat_list'] as $list ): 
									$category = get_term_by( 'slug', $list, 'portfolio-cat' );	
									// var_dump($list);
							  ?>	
                              <button data-filter=".<?php echo esc_html( $list ); ?>"><?php echo esc_html( post_cat('portfolio-cat')[$list] ); ?> <span><?php echo esc_html($category->count); ?></span></button>
							  <?php endforeach; ?>
                           </div>
                     </div>
                  </div>
               </div>
            	<?php endif; ?>

               <div class="row tp-gx-4 grid tp-portfolio-load-more ddd" data-show="9">
			       <?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post();
						$categories = get_the_terms(get_the_ID(),'portfolio-cat');
					?>
                  <div class="col-xl-4 col-lg-4 col-md-6 tp-portfolio grid-item <?php echo harry_get_cat_data($categories); ?>">
                     <div class="portfolio__grid-item mb-40 wows fadeInUps" >
                        <div class="portfolio__grid-thumb w-img fix">
                           <a href="portfolio-details.html">
						   <?php the_post_thumbnail( ); ?>
                           </a>
                           <div class="portfolio__grid-popup">
                              <a href="assets/img/portfolio/grid/portfolio-grid-1.jpg" class="popup-image">
                                 <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.1667 8.33341H0.833333C0.377778 8.33341 0 7.95564 0 7.50008C0 7.04453 0.377778 6.66675 0.833333 6.66675H14.1667C14.6222 6.66675 15 7.04453 15 7.50008C15 7.95564 14.6222 8.33341 14.1667 8.33341Z" fill="currentColor"/>
                                    <path d="M7.4974 15C7.04184 15 6.66406 14.6222 6.66406 14.1667V0.833333C6.66406 0.377778 7.04184 0 7.4974 0C7.95295 0 8.33073 0.377778 8.33073 0.833333V14.1667C8.33073 14.6222 7.95295 15 7.4974 15Z" fill="currentColor"/>
                                 </svg>                                    
                              </a>
                           </div>
                        </div>
                        <div class="portfolio__grid-content">
                           <h3 class="portfolio__grid-title">
						   			<a href="<?php the_permalink( ); ?>"><?php the_title( ); ?></a>
                           </h3>
                           <div class="portfolio__grid-bottom">
                              <div class="portfolio__grid-category">
                                 <span>
                                    <a href="#"><?php echo harry_get_cat_data($categories,', ', 'name'); ?></a>
                                 </span>
                              </div>
                              <div class="portfolio__grid-show-project">
                                 <a href="portfolio-details.html" class="portfolio-link-btn">
                                    Show project 
                                    <span>
                                       <svg width="26" height="9" viewBox="0 0 26 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M21.6934 1L25 4.20003L21.6934 7.4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                          <path d="M0.999999 4.19897H25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                       </svg>
                                    </span>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
				  <?php endwhile; wp_reset_postdata(); endif; ?>		
               </div>
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="portfolio__load-more text-center">
                        <button id="tp-load-more" type="button" class="tp-load-more-btn load-more mt-30 mb-50">
                           <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M1 8.5C1 4.36 4.33 1 8.5 1C13.5025 1 16 5.17 16 5.17M16 5.17V1.42M16 5.17H12.67" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                              <path d="M15.9175 8.5C15.9175 12.64 12.5575 16 8.4175 16C4.2775 16 1.75 11.83 1.75 11.83M1.75 11.83H5.14M1.75 11.83V15.58" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                           </svg>                              
                           Load more Post
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </section>

		<?php
	}

}


$widgets_manager->register( new Harry_Portfolio() );