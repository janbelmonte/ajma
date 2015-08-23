<?php switch ( get_post_meta( $post->ID, 'soapbox_header_text_colour', true ) ) {
	case 'light':
		$text_colour = 'text-color-light';
	break;
	case 'dark':
		$text_colour = 'text-color-dark';
	break;
	default:
		if ( of_get_option( 'color_text' ) == '1' ) {
			$text_colour = 'text-color-light';
		} else {
			$text_colour = 'text-color-dark';		
		}
	break;
} ?>

<div class="element-height">

	<div class="holder">
		
		<div class="cont">

			<!-- BEGIN .page-header -->
			<header class="page-header <?php echo $text_colour; ?>">			
				
				<?php if (
					get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on'
					|| ( ( $post->post_excerpt != '' ) && ( get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on' ) )
				) { ?>	
					
					<?php if ( get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on' ) { ?>
						<h1><?php funky_the_title(); ?></h1>					
					<?php } ?>
					
					<?php if ( 
						( $post->post_excerpt != '' )
						&& ( get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on' )
					) { ?>
						<?php the_excerpt(); ?>
					<?php } ?>
				
				<?php } ?>
				
			<!-- END .page-header -->
			</header>
			
		</div>
	
	</div>

</div>