<?php
namespace CSI\Widgets;

class newsletterWidget extends \WP_Widget {


    function __construct() {
        parent::__construct('csi_newsletter_widget', __('Newsletter Widget', 'csi_newsletter_widget'), array( 'description' => __( 'Displays the LitNet newsletter subscribe form', 'csi_newsletter_widget' ), ));
    }
    /*
     * Widget Frontend Code
     */
    public function widget( $args, $instance )
    {
        $title = apply_filters('widget_title', $instance['title']);

        // START OUTPUT
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];

        echo '<form>';
        echo '';
        echo '<div class="input-group">';
        echo '<input type="email" class="form-control">';
        echo '</div>';
        echo '<div class="input-group">';
        echo '<input class="btn" type="submit" value="Submit"/>';
        echo '</div>';
        echo '</form>';
        echo $args['after_widget'];
    }

    /*
     * Widget Backend Functions
     */
    public function form( $instance ) {

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'New title', 'csi_newsletter_widget' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>This widget shows the newsletter subscribe form. There are no other options available</p>

    <?php
    }

// Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['email'] = ( ! empty( $new_instance['email'] ) ) ? strip_tags( $new_instance['email'] ) : '';
        $instance['telephone'] = ( ! empty( $new_instance['telephone'] ) ) ? strip_tags( $new_instance['telephone'] ) : '';
        $instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? strip_tags( $new_instance['facebook'] ) : '';
        $instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? strip_tags( $new_instance['twitter'] ) : '';
        $instance['rss'] = ( ! empty( $new_instance['rss'] ) ) ? strip_tags( $new_instance['rss'] ) : '';
        return $instance;
    }
}
?>