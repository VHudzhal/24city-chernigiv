<?php
/**
 * Keywords template
 */
?>
<#
	if ( ! _.isEmpty( keywords ) ) {
#>
<select class="jet-library-keywords">
	<option value=""><?php esc_html_e( 'Any Topic', 'jet-design-kit' ); ?></option>
	<# _.each( keywords, function( title, slug ) { #>
	<option value="{{ slug }}">{{ title }}</option>
	<# } ); #>
</select>
<#
	}
#>