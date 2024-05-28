<?php
// Custom Latest Post Widget
class Custom_Services_Post_Widget extends WP_Widget {
    
    // Widget setup
    function __construct() {
        parent::__construct(
            'custom_services_post_list_widget', // Base ID
            'Harry Services Post', // Widget name
            array( 'description' => 'Displays the latest post in the sidebar with options to set the number of posts and widget title' ) // Widget description
        );
    }
    
    // Display the widget content
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : null;
        $post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : 1;
        
        $query_args = array(
            'post_type' => 'harry-services', // Number of posts to display
            'posts_per_page' => $post_count, // Number of posts to display
            'order' => 'DESC', // Order posts by descending
            'orderby' => 'date' // Order by date
        );
        
        $latest_post_query = new WP_Query( $query_args );
        
        if ( $latest_post_query->have_posts() ) {
            echo $args['before_widget'];
            if ( ! empty( $title ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
            } ?>
            <div class="services__widget-tab-2 tp-tab">
                <ul>
                    <?php while ( $latest_post_query->have_posts() ) {
                    $latest_post_query->the_post();
                    $services_icon = function_exists('get_field') ? get_field('services_icon') : null;    
                    ?>
                        <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php if(!empty($services_icon)) : ?>
                                <span>    
                                <?php echo $services_icon; ?>
                                </span>
                            <?php endif; ?>
                            <?php the_title(); ?>
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 11L6 6L1 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        </li>
                    <?php
                } ?>
                </ul>                        
            </div>
        <?php     
            echo $args['after_widget'];
            wp_reset_postdata();
        }
    }
    
    // Widget settings form
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : 1;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Widget Title:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'post_count' ); ?>">Number of Posts to Display:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'post_count' ); ?>" name="<?php echo $this->get_field_name( 'post_count' ); ?>" type="number" min="1" value="<?php echo esc_attr( $post_count ); ?>">
        </p>
        <?php
    }
    
    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['post_count'] = ( ! empty( $new_instance['post_count'] ) ) ? absint( $new_instance['post_count'] ) : 1;
        return $instance;
    }
}

// Register the widget
function register_services_list_post_widget() {
    register_widget( 'Custom_Services_Post_Widget' );
}
add_action( 'widgets_init', 'register_services_list_post_widget' );
