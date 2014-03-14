<?php
/*
|---------------------------------------------------------------------------
| The template for displaying comments
|---------------------------------------------------------------------------
*/
?>
<section class="comments" id="comments">

  <?php
    /**
     * Stop the rest of comments.php from being processed,
     * but don't kill the script entirely -- we still have
     * to load the template.
     */
    if (post_password_required()) {
      echo '<p class="nopassword">This post is password protected. Enter the password to view any comments.</p>';
      echo '</section><!-- #comments -->';
      return;
    }
  ?>

  <?php if ( have_comments() ) : ?>

    <h1 class="comments-title"><?php comments_number() ?>:</h1>

    <ol class="comments-list">
      <?php wp_list_comments() ?>
    </ol>

  <?php
    // If there are no comments, comments are closed, but we're not on pages or post types that do not support comments
    elseif ( !comments_open() && !is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
  ?>
    <p>Comments are closed.</p>

  <?php endif ?>

  <?php $comment_args = array(
    'title_reply' => 'Leave a comment:'
  ) ?>

  <?php comment_form( $comment_args ) ?>

</section><!-- #comments -->