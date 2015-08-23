<?php 

// ---------- COMMENTS ---------- //

function new_comment_list( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment; ?>
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		
		<?php 
			$admin_class = "";
			if( get_comment_type() == 'comment' ) {

				if ( user_can( $comment->user_id, 'level_2' ) ) {
					$admin_class = 'admin-comment';
				}

			} 
		?>
		
		<div class="comment-holder <?php echo $admin_class; ?>" id="comment-<?php comment_ID(); ?>">
			
			<?php echo get_avatar( $comment, 40 ); ?>
			
			<span class="comment-author"><?php comment_author_link(); ?></span>
			
			<div class="comment-content">
			
				<?php if ( $comment->comment_approved == '0' ) {?>
					<p><?php _e( 'Your comment is awaiting moderation.', 'funky_theme' ); ?></p>
				<?php } ?>
				
				<?php comment_text() ?>
				
				
			</div>
			
			<ul class="comment-footer">
				<li><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'], 'login_text' => '', 'reply_text' => '<span class="funky-icon-reply"></span>'. __( 'Reply', 'funky_theme' ) ) ) ); ?></li>
				<li><a href="<?php echo htmlspecialchars( get_comment_link( $comment -> comment_ID ) ); ?>"><time datetime="<?php comment_date ('c'); ?>"><span class="funky-icon-time"></span><?php comment_date (); ?> <?php _e( "at", "funky_theme" );?> <?php comment_time(); ?></time></a></li>
			</ul>
			
		</div>
		
<?php } ?>