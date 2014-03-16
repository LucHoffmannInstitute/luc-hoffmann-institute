<?php

/**
 * Set up sidebars
 */
add_action( 'widgets_init', 'hoffmann_sidebars_init' );

function hoffmann_sidebars_init() {

	if ( file_exists( $file ) ) {
		require( $file );
	}

	$before_widget	= '<section id="%1$s" class="Widget %2$s">';
	$before_title 	= '<header class="Widget-header"><h2 class="Widget-title">';
	$after_title	= '</h2></header>';
	$after_widget	= '</section>';

	$additional_sidebars = array();

	// add project post types as additional sidebars
	$projects = get_posts( array(
		'post_type' => 'project'
	) );

	foreach ( $projects as $project ) {
		array_push( $additional_sidebars, $project->post_title );
	}

	if ( !empty( $additional_sidebars ) ) {
		foreach ( $additional_sidebars as $sidebar ) {
			register_sidebar( array(
				'name' => $sidebar,
				'id' => 'sidebar-' . str_replace(' ', '-', strtolower( $sidebar ) ),
				'before_widget' => $before_widget,
				'after_widget'	=> $after_widget,
				'before_title' 	=> $before_title,
				'after_title'	=> $after_title
			) );
		}
	}

	// this will return only top-level pages
	$pages = get_pages('sort_column=menu_order&sort_order=ASC');

	// remove specific pages by page name
	$pages_to_remove = array( );

	if ( empty( $pages ) ) {
		return false;
	}

	foreach( $pages as $page ) {
		// remove specific pages
		if( !in_array( $page->post_name, $pages_to_remove ) ) {
			register_sidebar( array(
				'name' 			=> $page->post_title,
				'id'			=> 'sidebar-' . $page->ID,
				'before_widget' => $before_widget,
				'after_widget'	=> $after_widget,
				'before_title' 	=> $before_title,
				'after_title'	=> $after_title
			) );
		}
	}

}

/**
 * Stay Connected widget
 */
class Hoffmann_Stay_Connected_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'Widget Widget--stay-connected',
			'description' => 'Stay Connected widget'
		);

		parent::__construct(
			'stay_connected',
			__( 'Stay Connected', 'hoffmann' ),
			$widget_ops
		);

	}

	public function widget( $args, $instance ) {
		extract( $args );

		$title = $instance['title'];

		?>
			<?php echo $before_widget ?>
				<?php echo $before_title ?><?php echo $title ?><?php echo $after_title ?>

				<form action="http://wwfint.us7.list-manage2.com/subscribe/post?u=9027d13aee5d8d2ac7bab6eb4&amp;id=ec0233486c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                    <label for="EMAIL">Enter your email address</label>
                    <input type="text" value="" name="EMAIL" placeholder="Enter your email address" />
                    <button type="submit"><i class="icon-arrow-right"></i> <span>Subscribe</span></button>
                </form>

			<?php echo $after_widget ?>
		<?php
	}

	public function form( $instance ) {

		$title = $instance['title'] ? $instance['title'] : 'Stay Connected';
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
}
register_widget( 'Hoffmann_Stay_Connected_Widget' );

/**
 * Quote widget
 */
class Hoffmann_Quote_Widget extends WP_Widget {

	public function __construct() {

		$widget_ops = array(
			'classname' => 'Widget--quote',
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
