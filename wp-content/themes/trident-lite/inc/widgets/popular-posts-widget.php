<?php
/*** Trident Popular Posts ***/
class trident_popular_posts extends WP_Widget {

    function trident_popular_posts(){
        $widget_ops = array(
            'classname'   => 'trident_popular_posts',
            'description' => __('Display most popular post', 'trident')
        );
        $this->WP_Widget('trident_popular_posts', __('Trident Popular Posts', 'trident'), $widget_ops);
    }

    //	Outputs the options form on admin
    function form($instance){
        $defaults = array(
            'title' => __('Popular Posts', 'trident'),
            'count' => ''
        );

        $instance = wp_parse_args((array)$instance, $defaults); ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'trident') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>"
                   type="text"/>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Number of posts:', 'trident') ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>"
                   name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>"
                   type="number"/>
        </p>

    <?php
    }


    //	Processes widget options to be saved
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = strip_tags($new_instance['count']);
        return $instance;
    }

    //	Outputs the content of the widget
    function widget($args, $instance){
        global $post;
        extract($args);
        $title = esc_html( $instance['title'] );
        $count = strip_tags( $instance['count'] );
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;
                $query = new WP_Query();
                $query->query('orderby=comment_count&posts_per_page=' . $count);
                $postCount = 1;
                
                if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                
                        <div class="trident-popular-posts">
                            <?php $url = esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ) ); ?>
                            <div class="trident-popular-posts-thumbnail">
                                <a href="<?php echo esc_url( get_permalink() ); ?>">
                                    <img src="<?php echo esc_url( $url ); ?>"  alt="Thumbnail" />
                                    <span class="post-number"><?php echo $postCount++; ?></span>
                                </a>
                            </div>
                            <div class="trident-post">
                                <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
                                <p><?php echo get_the_date( ); ?></p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    
                <?php endwhile; endif; ?>
                <?php wp_reset_query(); ?>
            </ul>
        
        <?php
        echo $after_widget;
    }
} // Class trident_popular_posts ends here
?>