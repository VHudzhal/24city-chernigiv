<# if ( window.JetDesignKitData.license.activated ) { #>
<button class="elementor-template-library-template-action jet-template-library-template-insert elementor-button elementor-button-success">
	<i class="eicon-file-download"></i><span class="elementor-button-title"><?php
		esc_html_e( 'Insert', 'jet-design-kit' );
	?></span>
</button>
<# } else { #>
{{{ window.JetDesignKitData.license.link }}}
<# } #>