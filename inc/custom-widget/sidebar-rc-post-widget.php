<?php
// Custom Latest Post Widget
class Custom_Latest_Post_Widget extends WP_Widget {
    
    // Widget setup
    function __construct() {
        parent::__construct(
            'custom_latest_post_widget', // Base ID
            'Harry Latest Post', // Widget name
            array( 'description' => 'Displays the latest post in the sidebar with options to set the number of posts and widget title' ) // Widget description
        );
    }
    
    // Display the widget content
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'Latest Post';
        $post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : 1;
        
        $query_args = array(
            'posts_per_page' => $post_count, // Number of posts to display
            'order' => 'DESC', // Order posts by descending
            'orderby' => 'date' // Order by date
        );
        
        $latest_post_query = new WP_Query( $query_args );
        
        if ( $latest_post_query->have_posts() ) {
            echo $args['before_widget'];
            if ( ! empty( $title ) ) {
                echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
            }

            while ( $latest_post_query->have_posts() ) {
                $latest_post_query->the_post();
                ?>
                <div class="rc__post d-flex align-items-center">
                    <?php if(has_post_thumbnail()) : ?>
                    <div class="rc__post-thumb">
                        <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt=""></a>
                    </div>
                    <?php endif; ?>

                    <div class="rc__post-content">
                        <h3 class="rc__post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="rc__meta">
                            <span>
                                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 14C11.0899 14 14 11.0899 14 7.5C14 3.91015 11.0899 1 7.5 1C3.91015 1 1 3.91015 1 7.5C1 11.0899 3.91015 14 7.5 14Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.5 3.59961V7.49961L10.1 8.79961" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg><?php echo get_the_date(); ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <?php
            }
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
function register_custom_latest_post_widget() {
    register_widget( 'Custom_Latest_Post_Widget' );
}
add_action( 'widgets_init', 'register_custom_latest_post_widget' );
