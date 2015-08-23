<?php
/**
 * Template Name: Contact
 *
 * The contact form template. Content area is split in half with the left half being
 * filled by a Google map.
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
 
get_header(); ?>	
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		<!-- BEGIN .page-header -->
		<div class="feature-content">
			
			<?php if ( get_post_meta( $post->ID, 'soapbox_map_address', true ) != '' ) { ?>
	
				<!-- BEGIN .google-map -->
				<div class="google-map">		
					
					<?php // Map Styling presets
					$zoom		= 11; 
					$saturation = 0;

					if ( get_post_meta( $post->ID, 'soapbox_map_zoom', true ) != '' ) {
						$zoom  = get_post_meta( $post->ID, 'soapbox_map_zoom', true );
					}
					
					if ( get_post_meta( $post->ID, 'soapbox_map_saturation', true ) != '' ) {
						
						if ( intval( get_post_meta( $post->ID, 'soapbox_map_saturation', true ) < -100 ) ) {
							$saturation = -100;
						} elseif ( intval( get_post_meta( $post->ID, 'soapbox_map_saturation', true ) > 100 ) ) {
							$saturation = 100;			
						} else {
							$saturation = get_post_meta( $post->ID, 'soapbox_map_saturation', true );
						}
						
					} ?>
					
					<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
				
					<div id="map_canvas-<?php the_ID(); ?>"></div>
					
					<script type="text/javascript">
						jQuery(document).ready(function($) {
							
							var styles = [
								{
									stylers: [
										{ saturation: <?php echo $saturation; ?> }
										
										<?php if ( strlen( get_post_meta( $post->ID, 'soapbox_map_hue', true ) ) > 3 ) {
											echo ',{ hue: "'. get_post_meta( $post->ID, 'soapbox_map_hue', true ) .'"}';
										} ?>
									]
								}
								<?php if ( get_post_meta( $post->ID, 'soapbox_map_simplify', true ) == 'on' ) {
									echo ',
										{
											"elementType": "geometry","stylers": [
												{ "visibility": "simplified" }
											]
										}';
								} ?>		
							];
							
							var styledMap = new google.maps.StyledMapType(styles,
								{name: "Styled Map"});

							var mapOptions = {
								zoom: <?php echo $zoom; ?>,
								mapTypeControlOptions: {
									mapTypeId: [google.maps.MapTypeId.ROADMAP, 'map_style']
								},
								draggable:			false,
								disableDefaultUI:	true,
								scrollwheel:		false,					
								mapTypeControl:		false,
								scaleControl:		false				
							}
							
							var map = new google.maps.Map(document.getElementById("map_canvas-<?php the_ID(); ?>"), mapOptions);					
							
							geocoder = new google.maps.Geocoder();
							var address = "<?php echo get_post_meta( $post->ID, 'soapbox_map_address', true ); ?>";
							geocoder.geocode( { "address": address }, 
								function(results, status) {
									if (status == google.maps.GeocoderStatus.OK) {
										map.setCenter(results[0].geometry.location);
										
										<?php if ( get_post_meta( $post->ID, 'soapbox_custom_map_pin', true ) != "" ) {
											echo 'var image = new google.maps.MarkerImage( "'. get_post_meta( $post->ID, 'soapbox_custom_map_pin', true ) .'",
												// This marker is 129 pixels wide by 42 pixels tall.
												new google.maps.Size('. get_post_meta( $post->ID, 'soapbox_custom_map_pin_width', true ) .','. get_post_meta( $post->ID, 'soapbox_custom_map_pin_height', true ) .'),
												// The origin for this image is 0,0.
												new google.maps.Point(0,0)										
											);';
										} ?>
			
										var marker = new google.maps.Marker({
											map: map, 
											position: results[0].geometry.location
											<?php if ( get_post_meta( $post->ID, 'soapbox_custom_map_pin', true ) != "" ) {
												echo ', icon: image';
											} ?>
										});
									}
								});
								
							map.mapTypes.set('map_style', styledMap);
							map.setMapTypeId('map_style');	
							
						});
					</script>
					
				<!-- END .google-map -->
				</div>
				
			<?php } ?>
		
		<!-- END .page-header -->
		</div>
		
		<!-- BEGIN .page-content -->
		<div <?php post_class( 'page-content clearfix' ); ?>>
			
			<!-- BEGIN .content-padding -->
			<div class="content-padding clearfix">
			
				<!-- BEGIN .page-header -->
				<header class="page-header">		
					
					<?php if ( get_post_meta( $post->ID, 'soapbox_hide_page_title', true ) != 'on' ) { ?>
						<h1><?php funky_the_title(); ?></h1>					
					<?php } ?>
					
					<?php if ( 
						( $post->post_excerpt != '' )
						&& ( get_post_meta( $post->ID, 'soapbox_show_subtitle', true ) == 'on' )
					) { ?>
						<?php the_excerpt(); ?>
					<?php } ?>
					
				<!-- END .page-header -->
				</header>
		
				<?php the_content(); ?>		
		
			<!-- END .content-wrapper -->
			</div>
		
		<!-- END .page-content -->
		</div>
		
	<?php endwhile; ?>

<?php get_footer(); ?>