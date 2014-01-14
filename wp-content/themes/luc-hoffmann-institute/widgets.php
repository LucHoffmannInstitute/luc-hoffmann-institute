<?php

/**
 * Quote widget
 */
class Hoffmann_Quote_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'quote-widget',
			'description' => 'Add a quote and citation'
		);

		parent::__construct(
			'quote_widget',
			__( 'Quote', 'hoffmann' ),
			$widget_ops
		);

	}

	public function widget( $args, $instance ) {
		extract( $args );

		$text = $instance['quote_text'];
		$author_name = $instance['author_name'];
		$author_title = $instance['author_title'];

		?>
			<?php echo $before_widget ?>
				<blockquote class="quote">
					<?php echo apply_filters( 'the_content', $text ) ?>
					<cite><?php echo $author_name ?><?php if ( !empty( $author_title ) ) : ?> <small><?php echo $author_title ?></small><?php endif ?></cite>
				</blockquote>
			<?php echo $after_widget ?>
		<?php
	}

	public function form( $instance ) {

		$quote_text = $instance['quote_text'] ? $instance['quote_text'] : '';
		$author_name = $instance['author_name'] ? $instance['author_name'] : '';
		$author_title = $instance['author_title'] ? $instance['author_title'] : '';
		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'quote_text' ) ?>"><?php _e( 'Quote text', 'hoffmann' ) ?></label>
				<textarea name="<?php echo $this->get_field_name( 'quote_text' ) ?>" id="<?php echo $this->get_field_id( 'quote_text' ) ?>" cols="30" rows="10"><?php echo $quote_text ?></textarea>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'author_name' ) ?>"><?php _e( 'Author name', 'hoffmann' ) ?></label>
				<input type="text" name="<?php echo $this->get_field_name( 'author_name' ) ?>" id="<?php echo $this->get_field_id( 'author_name' ) ?>" value="<?php echo $author_name ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'author_title' ) ?>"><?php _e( 'Author title', 'hoffmann' ) ?></label>
				<input type="text" name="<?php echo $this->get_field_name( 'author_title' ) ?>" id="<?php echo $this->get_field_id( 'author_title' ) ?>" value="<?php echo $author_title ?>" />
			</p>
		<?php

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['quote_text'] = strip_tags( stripslashes( $new_instance['quote_text'] ) );
		$instance['author_name'] = sanitize_text_field( $new_instance['author_name'] );
		$instance['author_title'] = sanitize_text_field( $new_instance['author_title'] );
		return $instance;
	}
}
register_widget( 'Hoffmann_Quote_Widget' );

/**
 * Twitter widget
 */
class Hoffmann_Twitter_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'twitter-widget',
			'description' => 'Display your latest tweet'
		);

		parent::__construct(
			'twitter_widget',
			__( 'Twitter', 'hoffmann' ),
			$widget_ops
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = $instance['title'];

		$twitter_handle = get_option( 'twitter_handle' );
		if ( !isset( $twitter_handle ) || empty( $twitter_handle ) ) {
			return;
		}

		// require StormTwitter
		$st_file = dirname( __FILE__ ) . '/bower_components/storm-twitter/StormTwitter.class.php';
		if ( !file_exists( $st_file ) ) {
			return;
		}
		require $st_file;

		$config = array(
			'directory' => dirname( __FILE__ ), // the path used to store the .tweetcache cache file
			'key' => 'DYXBFDZFspwTxaTUwmcsQ',
			'secret' => 'GAxmuAztdd7hRJXmYJLMangCi8sPweDaZJtPetvQXY',
			'token' => '10473012-r78D7996wpuWzJ2r63aciT7zGmUgI5SRNhta0IBxI',
			'token_secret' => 'CnUJeRpy8EqJgCIS6iO8eI2vIm92IFKRt2I36xAg',
			'cache_expire' => 3600
		);

		$twitter = new StormTwitter( $config );

		$tweets = $twitter->getTweets( 1, $twitter_handle, array(
			'exclude_replies' => true
		) );

		if ( empty( $tweets ) ) {
			return;
		}

		?>
			<?php echo $before_widget ?>
				<?php echo $before_title . $title . $after_title ?>
				<ul>
					<?php foreach ( $tweets as $tweet ) : ?>
						<li><?php echo $this->parse_tweet( $tweet ) ?></li>
					<?php endforeach ?>
				</ul>
				<a class="follow-link" href="http://twitter.com/<?php echo $twitter_handle ?>">Follow @<?php echo $twitter_handle ?> <i class="icon-arrow-right"></i></a>
			<?php echo $after_widget ?>
		<?php
	}

	public function form( $instance ) {

		$title = $instance['title'] ? $instance['title'] : 'Twitter';

		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Title', 'hoffmann' ) ?></label>
				<input type="text" name="<?php echo $this->get_field_name( 'title' ) ?>" id="<?php echo $this->get_field_id( 'title' ) ?>" value="<?php echo $title ?>" />
			</p>
		<?php

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}

	private function parse_tweet( $tweet ) {
		$text = $tweet['text'];

		// link mentioned users
		$user_mentions = $tweet['entities']['user_mentions'];
		if ( isset( $user_mentions ) && !empty( $user_mentions ) ) {
			foreach ( $user_mentions as $mention ) {
				if ( strpos( $text, '@' . $mention['screen_name'] ) ) {
					$text = str_replace( '@' . $mention['screen_name'], '<a href="http://twitter.com/' . $mention['screen_name'] . '">@' . $mention['screen_name'] . '</a>', $text );
				}
			}
		}

		// link hashtags
		$hashtags = $tweet['entities']['hashtags'];
		if ( isset( $hashtags ) && !empty( $hashtags ) ) {
			foreach ( $hashtags as $tag ) {
				if ( strpos( $text, $tag['text'] ) ) {
					$text = str_replace( '#' . $tag['text'], '<a href="https://twitter.com/search?q=%23' . $tag['text'] . '&src=hash">#' . $tag['text'] . '</a>', $text );
				}
			}
		}

		// link urls
		$urls = $tweet['entities']['urls'];
		if ( isset( $urls ) && !empty( $urls ) ) {
			foreach ( $urls as $url ) {
				if ( strpos( $text, $url['url'] ) ) {
					$text = str_replace( $url['url'], '<a href="' . $url['url'] . '">' . $url['url'] . '</a>', $text );
				}
			}
		}

		return $text;
	}
}
register_widget( 'Hoffmann_Twitter_Widget' );

/**
 * Image widget
 */
class Hoffmann_Image_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'image-widget',
			'description' => 'Display an image with optional text below'
		);

		parent::__construct(
			'image_widget',
			__( 'Image', 'hoffmann' ),
			$widget_ops
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = $instance['title'];
		$image_url = $instance['image_url'];
		$text = $instance['text'];

		if ( !isset( $image_url ) || empty( $image_url ) ) {
			return;
		}

		?>
			<?php echo $before_widget ?>
				<?php if ( isset( $title ) && !empty( $title ) ) : ?>
					<?php echo $before_title . $title . $after_title ?>
				<?php endif ?>
				<img src="<?php echo $image_url ?>">
				<?php if ( isset( $text ) && !empty( $text ) ) : ?>
					<div class="widget-content">
						<?php echo apply_filters( 'the_content', $text ) ?>
					</div>
				<?php endif ?>
			<?php echo $after_widget ?>
		<?php
	}

	public function form( $instance ) {

		$title = $instance['title'] ? $instance['title'] : '';
		$image_url = $instance['image_url'] ? $instance['image_url'] : '';
		$text = $instance['text'] ? $instance['text'] : '';

		?>
			<p>
				<label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Title', 'hoffmann' ) ?></label>
				<input type="text" name="<?php echo $this->get_field_name( 'title' ) ?>" id="<?php echo $this->get_field_id( 'title' ) ?>" value="<?php echo $title ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'image_url' ) ?>"><?php _e( 'Image URL', 'hoffmann' ) ?></label>
				<input type="text" name="<?php echo $this->get_field_name( 'image_url' ) ?>" id="<?php echo $this->get_field_id( 'image_url' ) ?>" value="<?php echo $image_url ?>" />
				<p><small>The image URL, including http://. To get the URL for an image in the media library, go to the edit page for that image and copy the File URL. E.g. http://luchoffmanninstitute.org/wp-content/uploads/2013/10/302688.jpg.</small></p>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'text' ) ?>"><?php _e( 'Text', 'hoffmann' ) ?></label>
				<textarea name="<?php echo $this->get_field_name( 'text' ) ?>" id="<?php echo $this->get_field_id( 'text' ) ?>" cols="30" rows="10"><?php echo $text ?></textarea>
			</p>
		<?php

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['image_url'] = sanitize_text_field( $new_instance['image_url'] );
		$instance['text'] = sanitize_text_field( $new_instance['text'] );
		return $instance;
	}
}
//register_widget( 'Hoffmann_Image_Widget' );