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
class Harry_Blog_Post extends Widget_Base {

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
		return 'harry-blog-post';
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
		return __( 'Harry Blog Post', 'harry-core' );
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
			'harry_post_section',
			[
				'label' => esc_html__( 'Blog Post', 'harry-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_per_page',
			[
				'label' => esc_html__( 'Post Per Page', 'harry-core' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'cat_list',
			[
				'label' => esc_html__( 'Category', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => post_cat(),
			]
		);

		$this->add_control(
			'cat_exclude',
			[
				'label' => esc_html__( 'Category Exclude', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => post_cat(),
			]
		);

		$this->add_control(
			'post_exclude',
			[
				'label' => esc_html__( 'Post Exclude', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => get_all_post(),
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					'ASC' => esc_html__( 'ASC', 'textdomain' ),
					'DFESC'  => esc_html__( 'DESC', 'textdomain' ),
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__( 'Order By', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'name' => esc_html__( 'Name', 'textdomain' ),
					'date'  => esc_html__( 'Date', 'textdomain' ),
					'title'  => esc_html__( 'Title', 'textdomain' ),
					'rand'  => esc_html__( 'Rand', 'textdomain' ),
					'id'  => esc_html__( 'ID', 'textdomain' ),
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

		$args = array(
			'post_type' => 'post',
			'order' => $settings['order'],
			'orderby' => $settings['order_by'],
			'posts_per_page' => !empty($settings['post_per_page']) ? $settings['post_per_page'] : -1,
			'post__not_in'=> $settings['post_exclude'],
		);

		if(!empty($settings['cat_list'] || $settings['cat_exclude'] )){
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => !empty($settings['cat_exclude']) ?  $settings['cat_exclude'] : $settings['cat_list'],
					'operator' => !empty($settings['cat_exclude']) ? 'NOT IN' : 'IN',
				),
			);
		}

		$query = new \WP_Query( $args );
		?>

		<section class="blog__area grey-bg-12 p-relative z-index-1">
            <div class="container">
               <div class="row">
				<?php if ( $query->have_posts() ) : ?>
					<?php while ( $query->have_posts() ) : $query->the_post();
						$categories = get_the_category(get_the_ID());
					?>	
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                     <div class="blog__item-9 mb-30 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                        <div class="blog__thumb-9 w-img fix">
                           <a href="<?php the_permalink(); ?>">
                              <?php the_post_thumbnail(); ?>
                           </a>
                        </div>
                        <div class="blog__content-9">
                           <div class="blog__meta-9">
                              <span>
                                 <a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
                              </span>
                              <span>
                                 <a href="<?php the_permalink(); ?>"><?php echo esc_html($categories[0]->name); ?></a>
                              </span>
                           </div>
                           <h3 class="blog__title-9">
                              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                           </h3>
                        </div>
                     </div>
                  </div>

				 <?php endwhile; wp_reset_postdata(); endif;  ?> 

               </div>
            </div>
         </section>

		<?php
	}

}


$widgets_manager->register( new Harry_Blog_Post() );