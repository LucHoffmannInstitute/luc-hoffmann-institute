<?php
/**
 * Use Media object for listing comments
 */
class ElContraption_Walker_Comment extends Walker_Comment {
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$GLOBALS['comment_depth'] = $depth + 1; ?>
		<ol <?php comment_class('Media-list unstyled comment-' . get_comment_ID()); ?>>
		<?php
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$GLOBALS['comment_depth'] = $depth + 1;
		echo '</ol>';
	}

	function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0) {
		$depth++;
		$GLOBALS['comment_depth'] = $depth;
		$GLOBALS['comment'] = $comment;

		if (!empty($args['callback'])) {
			call_user_func($args['callback'], $comment, $args, $depth);
			return;
		}

		extract($args, EXTR_SKIP); ?>

		<li <?php comment_class('Comment Media comment-' . get_comment_ID()); ?> id="comment-<?php comment_ID(); ?>">
				
			<div class="pull-left">
				<?php echo get_avatar( $comment, $size = '64' ); ?>
			</div>

			<div class="Media-body">

				<div class="Comment-body">

					<div class="Comment-header">
						<h4 class="Comment-title"><?php echo get_comment_author_link(); ?></h4>
						<!--<a class="Comment-permalink" href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>"><i class="icon-link"></i><span>Permalink</span></a>-->
						<time class="Comment-published" datetime="<?php echo comment_date('c'); ?>"><?php printf(__('%1$s', 'hoffmann'), get_comment_date( 'm.d.Y' ),  get_comment_time()); ?></time>
					</div>

					<?php if ($comment->comment_approved == '0') : ?>
						<div class="Alert Alert--info">
							<?php _e('Your comment is awaiting moderation.', 'hoffmann'); ?>
						</div>
					<?php endif; ?>

					<div class="Comment-text">
						<?php comment_text(); ?>
					</div>

					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

				</div><!-- .Comment-body -->

			<?php // </div></li> in end_el() ?>

			<?php// include( locate_template( 'templates/comment.php' ) ); ?>
	<?php
	}

	function end_el(&$output, $comment, $depth = 0, $args = array()) {
		if (!empty($args['end-callback'])) {
			call_user_func($args['end-callback'], $comment, $args, $depth);
			return;
		}
		echo "</div></li>\n";
	}
}

function hoffmann_get_avatar($avatar) {
	$avatar = str_replace("class='avatar", "class='avatar Media-object", $avatar);
	return $avatar;
}
add_filter('get_avatar', 'hoffmann_get_avatar');
