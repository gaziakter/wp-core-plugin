<?php
/*
Plugin Name: Custom Contact Form Widget
Description: A simple contact form widget with a title and shortcode field.
Version: 1.0
Author: Your Name
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Contact_Form_Widget extends WP_Widget {
    // Class constructor
    public function __construct() {
        $widget_ops = array(
            'classname' => 'custom_contact_form_widget',
            'description' => 'A custom contact form widget with a title and shortcode field',
        );
        parent::__construct('custom_contact_form_widget', 'Harry Contact Form Widget', $widget_ops);
    }

    // The widget form (for the backend)
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $shortcode = !empty($instance['shortcode']) ? $instance['shortcode'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" class="widefat" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('shortcode'); ?>">Shortcode:</label>
            <input type="text" id="<?php echo $this->get_field_id('shortcode'); ?>" name="<?php echo $this->get_field_name('shortcode'); ?>" value="<?php echo esc_attr($shortcode); ?>" class="widefat" />
        </p>
        <?php
    }

    // Update widget settings
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['shortcode'] = (!empty($new_instance['shortcode'])) ? strip_tags($new_instance['shortcode']) : '';
        return $instance;
    }

    // Display the widget on the frontend
    public function widget($args, $instance) {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        if (!empty($instance['shortcode'])) {
            echo do_shortcode($instance['shortcode']);
        }
        echo $args['after_widget'];
    }
}

// Register the widget
function register_custom_contact_form_widget() {
    register_widget('Custom_Contact_Form_Widget');
}
add_action('widgets_init', 'register_custom_contact_form_widget');
