<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The formatting of individual comments is handled by the file /raw_functions/raw_comments.php.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/
?>
<?php if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'Please do not load this page directly.' );
}

if ( !post_password_required() ) {
	
	if ( have_comments() || comments_open() ) { ?>
		
		<div id="comments-wrapper">
			
			<div id="comments-holder">
				
				<?php // Comments Header
				if ( have_comments() || comments_open() ) { ?>
					
					<div class="comments-header">
					
						<?php // Are there comments to navigate through?
						if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>

							<!-- comment pagination -->
							<nav class="comment-navigation clearfix" role="navigation">
								
								<h1 class="hidden"><?php _e( "Comment Navigation", "funky_theme" ); ?></h1>
								
								<div class="nav-previous"><?php previous_comments_link( '<span class="funky-icon-right"></span>' ); ?></div>							
								<div class="nav-next"><?php next_comments_link( '<span class="funky-icon-left"></span>' ); ?></div>
							</nav>
							
						<?php } // Check for comment navigation ?>
						
						<h4 id="comments-title"><?php _e( 'Discussion', 'funky_theme' ); ?></h4>
					
					</div>
					
				<?php } ?>
				
				
				<?php // The Comments
				if ( have_comments() ) { ?>
				
					<ol id="comments" class="commentlist">
						<?php wp_list_comments( 'callback=new_comment_list' ); ?>
					</ol>
					
				<?php } else if ( comments_open() ) { // If comments are open, but there are no comments. ?>

					<p><?php _e( 'Be the first to speak your mind.', 'funky_theme' ); ?></p>

				<?php } ?>

				<?php // Comment Form
				if ( comments_open() ) { ?>

					<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) { ?>
					
						<p class="comment-login"><?php printf( __( 'You must be logged in to post a comment.', 'funky_theme' ) ); ?></p>
						
					<?php } else { ?>

						<?php $fields =  array(
							'author' => '<div class="third">
											<p class="comment-form-author">
												<label for="author">' . __( 'Name', 'funky_theme' ) . '</label> <span class="required">*</span>
												<input id="author" name="author" type="text" class="required" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />
											</p>
										</div>',
										
							'email'  => '<div class="third">
											<p class="comment-form-email">
												<label for="email">' . __( 'Email', 'funky_theme' ) . '</label> <span class="required">*</span>
												<input id="email" name="email" type="text" class="required email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" />
											</p>
										</div>',
										
							'url'    => '<div class="third end">
											<p class="comment-form-url">
												<label for="url">' . __( 'Website', 'funky_theme' ) . '</label>
												<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
											</p>
										</div>'						
						);
						
						comment_form(
							array(
								'logged_in_as'			=>	'<p class="logged-in-as">' . sprintf( __( 'Hello, %1$s. <a href="%2$s" title="Log out of this account">Log out?</a>' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post->ID ) ) ) ) . '</p>',
								'comment_notes_after'	=>	false,
								'cancel_reply_link'		=>	'&times;',
								'title_reply'			=>	__( 'Leave a Comment', 'funky_theme' ),
								'label_submit'			=>	__( 'Submit', 'funky_theme' ),
								'fields'				=>	$fields,
								'comment_field'			=> '<p class="comment-form-comment">
																<label for="comment">' . __( 'Comment', 'funky_theme' ) . '</label> <span class="required">*</span>
																<textarea id="comment" class="required" name="comment" cols="45" rows="8"  aria-required="true"></textarea>
															</p>'
							)
						); ?>
						
					<?php } // If registration required and not logged in ?>

				<?php } // if comments open ?>

			</div>
		
		</div>
	
	<?php } 
 
} ?>

