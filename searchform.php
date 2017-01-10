<?php
/**
 * The searchform
 *
 * @package slnm
 */
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="searchform--searchfield" placeholder="<?php esc_attr_e( 'Zoeken &hellip;', 'slnm' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	</label>
	<input type="submit" class="searchform--submit" value="<?php esc_attr_e( 'Zoek', 'slnm' ); ?>" />
</form>
