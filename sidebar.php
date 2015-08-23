<?php
/**
 * Sidebar template
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/  
?>

<!-- BEGIN .sidebar-wrapper -->
<div id= "sidebar" class="sidebar-wrapper" role="complementary">
	
	<!-- BEGIN .sidebar-content -->
	<div class="sidebar-content">
	
		<?php dynamic_sidebar( 'Post' ); ?>
	
	<!-- END .sidebar-content -->
	</div>	

<!-- END .sidebar-wrapper -->
</div>