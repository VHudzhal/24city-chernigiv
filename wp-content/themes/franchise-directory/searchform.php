<form method='get' id='search-form'
      action="<?php echo esc_url( home_url( '/' ) ); ?>" style="">
    <div class="input-group">
	<input type="text" class='field form-control' name='s' id='s'
	       placeholder="<?php esc_attr_e( 'Поиск', 'franchise-directory' ); ?>" />
    <div class="input-group-append">
    <button type="submit" class="submit btn btn-success" name="submit"
	       id="searchsubmit" value="<?php esc_attr_e( 'Найти', 'franchise-directory' ); ?>" >
        <?php esc_attr_e( '', 'franchise-directory' ); ?>
        <i class="fa fa-search"></i>
    </button>
    </div>
    </div>

</form>
