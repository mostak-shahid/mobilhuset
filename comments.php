<?php
/**
* Template for displaying comments
*/

if ( post_password_required() ) {
    return;
}
?>
<div id="comments" class="comments">   
    <h3 class="comments-count-title"><?php comments_number( 'No Comments', '1 Comments', '% Comments' );?> </h3>
    <div id="comments-list" class="comments-list">
        <?php // You can start editing here -- including this comment! ?>
        <?php if ( have_comments() ) { ?>
            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
                // are there comments to navigate through  ?>
                <h3 class="screen-reader-text sr-only"><?php _e( 'Comment navigation', 'mosgutenbergtemplate' );?></h3>
                <ul id="comment-nav-above" class="comment-navigation pager" role="navigation">
                    <li class="nav-previous previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mosgutenbergtemplate' ) );?></li>
                    <li class="nav-next next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mosgutenbergtemplate' ) );?></li>
                </ul><!-- #comment-nav-above -->
            <?php }
            // check for comment navigation  ?>

            <ul class="media-list">
                <?php
                /* Loop through and list the comments. Tell wp_list_comments()
                * to use bootstrapBasicComment() to format the comments.
                * If you want to override this in a child theme, then you can
                * define bootstrapBasicComment() and that will be used instead.
                * See bootstrapBasicComment() in inc/template-tags.php for more.
                */
                wp_list_comments( array( 'avatar_size' => '60', 'callback' => 'bootstrapBasicComment', 'style' => 'ul', ) );
                ?>
            </ul><!-- .comment-list -->

            <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
                // are there comments to navigate through  ?>
                <h3 class="screen-reader-text sr-only"><?php _e( 'Comment navigation', 'mosgutenbergtemplate' );?></h3>
                <ul id="comment-nav-below" class="comment-navigation comment-navigation-below pager" role="navigation">
                    <li class="nav-previous previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mosgutenbergtemplate' ) );?></li>
                    <li class="nav-next next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mosgutenbergtemplate' ) );?></li>
                </ul><!-- #comment-nav-below -->
            <?php }
                // check for comment navigation  ?>

        <?php }
            // have_comments()  ?>

        <?php
            // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
            <p class="no-comments"><?php _e('Comments are closed.', 'mosgutenbergtemplate'); ?></p>
            <?php 
        } //endif; 
        ?>

        <?php 
        $req      = get_option('require_name_email');
        $aria_req = ($req ? " aria-required='true'" : '');
        $html5 = true;
	
        // re-format comment allowed tags
        $comment_allowedtags = allowed_tags();
        $comment_allowedtags = str_replace(array("\r\n", "\r", "\n"), '', $comment_allowedtags);
        $comment_allowedtags_array = explode('&gt; &lt;', $comment_allowedtags);
        $formatted_comment_allowedtags = '';
        foreach ($comment_allowedtags_array as $item) {
            $formatted_comment_allowedtags .= '<code>';

            if ($comment_allowedtags_array[0] != $item) {
                $formatted_comment_allowedtags .= '&lt;
                ';
            }

            $formatted_comment_allowedtags .= $item;

            if (end($comment_allowedtags_array) != $item) {
                $formatted_comment_allowedtags .= '&gt;
                ';
            }

            $formatted_comment_allowedtags .= '</code> ';
        }
        $comment_allowed_tags = $formatted_comment_allowedtags;
        unset($comment_allowedtags, $comment_allowedtags_array, $formatted_comment_allowedtags);?>
    </div><!-- #comments-list -->
    <div id="comment-form" class="commentForm">
        <?php
	ob_start();
	comment_form(
		array(
            'class_submit' => 'btn btn-primary',
			'fields' => array(
                'comment_notes_before' => '<p class="email-note">Your email address will not be published. Required fields are marked *</p>',
                
				'author' =>	'<div class = "row">' . 
				 			'<div class = "col-md-4">' .
				 			'<div class = "form-group">' .
                            '<label for="author">Name*</label>' .
							'<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' class="form-control"  placeholder="' .  __('Enter your name', 'mosgutenbergtemplate') . '" />' . 
							'</div>'.
							'</div>',
				'email'  => '<div class="col-md-4">' . 
							'<div class="form-group">' .
                            '<label for="email">Email*</label>' .
							'<input id="email" name="email" ' . ($html5 ? 'type="email"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' class="form-control"   placeholder="' .  __('Enter your email', 'mosgutenbergtemplate') . '" />' . 
							'</div>'.
							'</div>',
				'url'    => '<div class="col-md-4">' . 
							'<div class="form-group">' .
                            '<label for="url">Website</label>' .
							'<input id="url" name="url" ' . ($html5 ? 'type="url"' : 'type="text"') . ' value="' . esc_attr($commenter['comment_author_url']) . '" class="form-control"   placeholder="' .  __('Enter your website', 'mosgutenbergtemplate') . '" />' . 
							'</div>' . 
							'</div>' . 
							'</div>',
			),
			'comment_field' => '<div class="form-group">' .   
                            '<label for="comment">Comment</label>' .
							'<textarea id="comment" name="comment" rows="8" aria-required="true" class="form-control"  placeholder="' .  __('Type your comment here', 'mosgutenbergtemplate') . '"></textarea>' .  
							'</div>',
			/*'comment_notes_after' => '<p class="help-block">' . 
							sprintf(__('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'mosgutenbergtemplate'), $comment_allowed_tags) . 
							This message will show after textarea
							'</p>'*/
		)
	); 
    ?>
    </div><!-- #comment-form -->
</div><!-- #comments -->
