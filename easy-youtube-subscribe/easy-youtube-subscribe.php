<?php 
/*
Plugin Name: Youtube Subscribe
Plugin URI: https://wordpress.org/plugins/easy-youtube-subscribe/
Author: Mahabubur Rahman
Author URI: http://mahabub.me
Text Domain: easy-youtube-subscribe
Description: Youtube channel subscribe plugin for wordpress
Version: 3.0.0
*/

class SMYouTubesubscribe_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'SMYouTubesubscribe_Widget',
			'description' => __('YouTube channel subscribe','easy-youtube-subscribe'),
		);
		parent::__construct( 'SMYouTubesubscribe_Widget', 'YouTube Subscribe', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		extract( $args );
     
	    $title      	= apply_filters( 'widget_title', $instance['title'] );
	    $channel_id    	= ($instance['channel_id'])?$instance['channel_id']:'UCKIG1BY9SOv2Hg1q5I8WLBQ';	     
	    $layout    		= ($instance['layout'])?'full':'default';	     
	    $theme    		= ($instance['theme'])?'dark':'default';	     
	    $count    		= ($instance['count'])?'hidden':'default';	     
	    echo $before_widget;	     
	    if ( $title ) {
	        echo $before_title . $title . $after_title;
	    }	                         
	    // echo $theme;	    
		?>
		<style type="text/css">
			.dark_theme{
				padding: 8px; 
				background: rgb(85, 85, 85);
			}
		</style>
		<div class="ytsubscribe_container <?php echo $theme; ?>_theme">
			<script src="https://apis.google.com/js/platform.js"></script>
			<div class="g-ytsubscribe" data-channelid="<?php echo $channel_id; ?>" data-layout="<?php echo $layout; ?>" data-theme="<?php echo $theme; ?>" data-count="<?php echo $count; ?>"></div>
		</div>
		<?php
		echo $after_widget;
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		$title      	= esc_attr( $instance['title'] );
    	$channel_id    	= esc_attr( $instance['channel_id'] );
    	?>
    	<p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
	        <label for="<?php echo $this->get_field_id('channel_id'); ?>"><?php _e('YouTube Channel ID'); ?></label> 
	        <input class="widefat" id="<?php echo $this->get_field_id('channel_id'); ?>" name="<?php echo $this->get_field_name('channel_id'); ?>" type="text" value="<?php echo $channel_id; ?>"/>
	    </p>
	    <p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'layout' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'layout' ); ?>">Show Full layout</label>
        </p>
        <p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'theme' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'theme' ); ?>" name="<?php echo $this->get_field_name( 'theme' ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'theme' ); ?>">Show Dark Theme</label>
        </p>

        <p>
		    <input class="checkbox" type="checkbox" <?php checked( $instance[ 'count' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" /> 
	        <label for="<?php echo $this->get_field_id( 'count' ); ?>">Subscriber count hide</label>
        </p>


	    <?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = $old_instance;
     
	    $instance['title'] 		= strip_tags( $new_instance['title'] );
	    $instance['channel_id'] = strip_tags( $new_instance['channel_id']);
	    $instance['layout'] 	= strip_tags( $new_instance['layout'] );
	    $instance['theme'] 		= strip_tags( $new_instance['theme'] );
	    $instance['count'] 		= strip_tags( $new_instance['count'] );
	     
	     
	    return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'SMYouTubesubscribe_Widget' );
});

require "includes/sm-youtube-subscription-shortcode.php";
