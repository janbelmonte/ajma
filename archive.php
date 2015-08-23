<?php
/**
 * The post archive template file.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>

<?php if ( have_posts() ): ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<!-- BEGIN .hentry -->
		<article <?php post_class( 'post-list' ); ?>>
			
			<!-- BEGIN .feature-image -->
			<div class="feature-image">


				<!-- BEGIN .entry-body -->
			<div class="entry-body">
				
				<div>
				
					<?php if (
						of_get_option( 'archive_author_meta' ) == '1'
						|| of_get_option( 'archive_date_meta' ) == '1'
						|| of_get_option( 'archive_category_meta' ) == '1'			
						|| ( of_get_option( 'archive_comments_meta' ) == '1' && !post_password_required() ) && ( get_comments_number( $post->ID ) > 0 || comments_open() ) 
					) { ?>

						<ul class="post-meta">

							<?php if ( of_get_option( 'archive_author_meta' ) == '1' ) { ?>
								<li>
									<!-- AUTHOR META -->
									<span class="funky-icon-author"></span>
									<?php the_author_posts_link(); ?>
								</li>
							<?php } ?>
							
							<?php if ( of_get_option( 'archive_date_meta' ) == '1' ) { ?>
								<li>
									<!-- DATE META -->
									<span class="funky-icon-time"></span>
									<time datetime="<?php the_time( 'c' ); ?>"><?php the_time( get_option( 'date_format' ) ); ?></time>
								</li>
							<?php } ?>

							<?php if ( of_get_option( 'archive_category_meta' ) == '1' ) { ?>
								<li>
									<!-- CATEGORY META -->
									<span class="funky-icon-category"></span>
									<?php $category = get_the_category();
									if ( $category ) {
										echo '<a href="'. get_category_link( $category[0]->term_id ) .'" title="'. sprintf( __( "View all posts in %s", "funky_theme" ), $category[0]->name ) .'">'. $category[0]->name .'</a>';
									} ?>
								</li>
							<?php } ?>
							
							<?php if (
								( of_get_option( 'archive_comments_meta' ) == '1' )
								&& ( !post_password_required() )
								&& ( ( get_comments_number( $post->ID ) > 0 )|| ( comments_open() ) )
							) { ?>
								<li>
									<!-- COMMENTS META -->
									<span class="funky-icon-comment"></span>
									<?php comments_popup_link( '0', '1', '%' ); ?>
								</li>
							<?php } ?>
							
						</ul>
				
					<?php } ?>
				

				
					
				</div>
				
				
			<!-- END .entry-body -->
			</div>

				
				<?php the_post_thumbnail( 'archive' ); ?>
				
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<span><?php the_title(); ?></span>
				</a>					
				
			<!-- END .feature-image -->
			</div>		
			
			
		<!-- END .hentry -->
		</article>

	<?php endwhile; ?>
	
	<?php if ( $wp_query->max_num_pages > 1 ) { ?>
	
		<div class="pagination">
		
			<?php // Pagination

			$big = 999999999; // need an unlikely integer

			echo paginate_links( array(
				'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'	=> '?paged=%#%',
				'current'	=> max( 1, get_query_var( 'paged' ) ),
				'total'		=> $wp_query->max_num_pages,
				'prev_text' => '&lsaquo; '. __( "Prev", "funky_theme" ),
				'next_text' => __( "Next", "funky_theme" ) .' &rsaquo;',
			) ); ?>

		</div>
		
	<?php } ?>
	
<?php else : ?>
	
	<!-- BEGIN .page-content -->
	<div class="page-content clearfix">
		
		<p><?php _e( "No posts to show. Check back soon.", "funky_theme" ); ?></p>
		
	<!-- END .entry-content -->
	</div>

<?php endif; ?>

<?php get_footer(); ?>