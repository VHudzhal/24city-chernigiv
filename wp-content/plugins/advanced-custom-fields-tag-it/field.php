<?php

class acf_field_tag_it extends acf_field {

	function __construct() {

		$this->name     = 'tag-it';
		$this->label    = __( 'Tag It', 'acf-tag-it' );
		$this->category = 'basic';
		$this->defaults = array();
		$this->l10n     = array(
			'error' => __( 'Error! Please enter a higher value', 'acf-tag-it' )
		);

		parent::__construct();
	}

	function render_field_settings( $field ) {

		acf_render_field_setting( $field, array(
			'label'        => __( 'Available Tags', 'acf-tag-it' ),
			'instructions' => __( "Used as source for autocompletion, unless source is overridden.<br><br>Enter each choice on a new line.", 'acf-tag-it' ),
			'type'         => 'textarea',
			'name'         => 'available_tags'
		) );
	}

	function try_json_decode( $string ) {

		$value = json_decode( $string );

		return (object) array(
			'value'   => $value,
			'success' => ( json_last_error() == JSON_ERROR_NONE )
		);
	}

	function render_field( $field ) {
		$options = json_encode( array_map( 'trim', explode( "\n", $field['available_tags'] ) ) );

		?>
		<input id="<?php echo esc_attr( $field['id'] ); ?>"
		       type="text"
		       class="acf-tag-it"
		       name="<?php echo esc_attr( $field['name'] ); ?>"
		       value="<?php echo esc_attr( $field['value'] ); ?>"
		       style="width: 100%"
		/>
		<script>
			jQuery('#<?php echo $field['id']; ?>').select2({tags: <?php echo $options; ?>});
		</script>
		<?php
	}
}

new acf_field_tag_it();