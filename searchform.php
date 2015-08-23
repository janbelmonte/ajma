<?php
/**
 * The search form template
 *
 * @package		WordPress
 * @subpackage	SoapBox
 * @since		SoapBox 1.0
 **/ 
?>
 <form method="get" class="searchform" action="<?php echo home_url(); ?>/">
	<fieldset>
		<input class="s" type="text" placeholder="Search" value="<?php if ( get_search_query() != '' ) { echo trim( esc_html( get_search_query() ) ); } else { echo ''; } ?>" name="s" />
		<div class="searchsubmit">
			<span class="funky-icon-search"></span>
			<input type="submit" value="Search" />
		</div>
	</fieldset>
</form>