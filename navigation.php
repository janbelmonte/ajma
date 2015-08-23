<?php
/**
 * The template for displaying the page header (logo/site title, navigation and social buttons.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/
?>

<!-- BEGIN .site-header -->
<header id="menu" class="header-wrapper">
	
	<!-- BEGIN .site-header-content -->
	<div class="header-content">
		
		<!-- logo -->
		<!--
		<h1>
		
			<a class="header-logo" href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?> <?php if ( get_bloginfo( 'description' ) != "" ) { echo ' - '. get_bloginfo( 'description' ); } ?>">
				<?php if ( of_get_option( 'logo' ) != "" ) { ?>
					<img src="<?php echo of_get_option( 'logo' ); ?>" alt="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>" />
					<span class="hidden"><?php bloginfo( 'name' ); ?></span>
				<?php } else { ?>
					<span><?php bloginfo( 'name' ); ?></span>
				<?php } ?>
			</a>
			
			<?php if ( of_get_option ( 'enable_tagline' ) == '1' && get_bloginfo( 'description' ) != "" ) { ?>
		
				<span class="header-tagline"><?php bloginfo( 'description' ); ?></span>
			<?php } ?>
		
		</h1>
		-->	
	
		<nav role="navigation">
			
			<h1 class="hidden"><?php _e( "Primary Menu", "funky_theme" ); ?></h1>
			
			<?php wp_nav_menu( 
				array( 
					'theme_location' => 'primary',
					'container'		 => false,
					'menu_id'		 => 'primary-nav',
					'menu_class'	 => 'clearfix',
					'depth'           => 2,
					'fallback_cb'	 => false
				) 
			); ?>
			
			<?php // Portfolio Filters
			if (
				is_tax( 'portfolio_category' )
				|| is_page_template( 'page-portfolio.php' )
			) {
				
				$children = false;				
				
				// Get Taxonomy
				if ( is_tax( 'portfolio_category' ) ) {
					
					$taxonomy	= get_taxonomy( get_query_var( 'taxonomy' ) );
					$taxonomy	= $taxonomy->name;
					$term		= $wp_query->get( 'term' );
				
				} elseif ( is_page_template( 'page-portfolio.php' ) ) {
					
					$taxonomy	= 'portfolio_category';
					$term		= get_post_meta( $post->ID, 'soapbox_portfolio_category', true );
					
				}				

				$term = get_term_by( 'slug', $term, $taxonomy );				
				$children = get_term_children( $term->term_id, $taxonomy );
				
				if ( !empty( $children ) ) { ?>
					
					<h4 class="title"><?php _e( "Filter", "funky_theme" ); ?></h4>
					
					<!-- BEGIN .filter -->
					<ul class="filter">

						<li><a data-filter="*" href="#" class="selected"><?php _e( 'All', 'funky_theme' ); ?></a></li>
						
						<?php foreach ( $children as $term_id ) {
						
							$the_term = get_term_by( 'id', $term_id, $taxonomy );
							echo '<li><a href="'. get_term_link( $the_term->slug, 'portfolio_category' ) .'" data-filter=".'. urldecode( $the_term->slug ) .'">'. $the_term->name .'</a></li>';
						
						} ?>
						
					<!-- END .filter -->
					</ul>		

				<?php } ?>	
	
			<?php } ?>
		
		</nav>
		
	
	<!-- END .site-header-content -->
	</div>
	
	<div class="footer">
	
		<?php if (
			of_get_option( 'dribbble_url' ) != ""
			|| of_get_option( 'facebook_url' ) != ""
			|| of_get_option( 'flickr_url' ) != ""
			|| of_get_option( 'google_plus_url' ) != ""
			|| of_get_option( 'instagram_url' ) != ""
			|| of_get_option( 'pinterest_url' ) != ""
			|| of_get_option( 'twitter_url' ) != ""
			|| of_get_option( 'youtube_url' ) != ""
			|| of_get_option( 'vimeo_url' ) != ""
			|| of_get_option( 'behance_url' ) != ""
		) { ?>
			<div class="social-buttons">
				<?php if ( of_get_option( 'facebook_url' ) != "" ) {?>
					<a class="facebook" href="<?php echo of_get_option( 'facebook_url' ); ?>"><span class="funky-icon-facebook"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'twitter_url' ) != "" ) {?>
					<a class="twitter" href="<?php echo of_get_option( 'twitter_url' ); ?>"><span class="funky-icon-twitter"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'google_plus_url' ) != "" ) {?>
					<a class="google" href="<?php echo of_get_option( 'google_plus_url' ); ?>"><span class="funky-icon-google-plus"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'youtube_url' ) != "" ) {?>
					<a class="youtube" href="<?php echo of_get_option( 'youtube_url' ); ?>"><span class="funky-icon-youtube"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'vimeo_url' ) != "" ) {?>
					<a class="vimeo" href="<?php echo of_get_option( 'vimeo_url' ); ?>"><span class="funky-icon-vimeo"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'flickr_url' ) != "" ) {?>
					<a class="flickr" href="<?php echo of_get_option( 'flickr_url' ); ?>"><span class="funky-icon-flickr"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'dribbble_url' ) != "" ) { ?>
					<a class="dribbble" href="<?php echo of_get_option( 'dribbble_url' ); ?>"><span class="funky-icon-dribbble"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'instagram_url' ) != "" ) {?>
					<a class="instagram" href="<?php echo of_get_option( 'instagram_url' ); ?>"><span class="funky-icon-instagram"></span></a>
				<?php } ?>
				<?php if ( of_get_option( 'pinterest_url' ) != "" ) {?>
					<a class="pinterest" href="<?php echo of_get_option( 'pinterest_url' ); ?>"><span class="funky-icon-pinterest"></span></a>
				<?php } ?>	
				<?php if ( of_get_option( 'behance_url' ) != "" ) {?>
					<a class="behance" href="<?php echo of_get_option( 'behance_url' ); ?>"><span class="funky-icon-behance"></span></a>
				<?php } ?>					
			</div>
		<?php } ?>
			
		<div class="copyright">
			&copy; <?php echo date( "Y" ); ?> Ateneo Junior Marketing Association<br/><br/>
			<?php echo ' '. of_get_option( 'copyright_text' ); ?>Developed with <a href="http://www.janbelmonte.com/">Attention to Detail</a>
		</div>
	
	</div>
	
<!-- END .site-header -->
</header>