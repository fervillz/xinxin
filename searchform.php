<?php
/**
 * default search form
 */
?>
<form action="" class="search-form" role="search" method="get" id="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-search">
		<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:" />
	</div><!-- /.form-search -->
	<div class="free-spacing">
		<!-- nothing here -->
	</div><!-- /.free-spacing -->
	<div class="form-submit">
		<input type="submit" class="search-submit" value="Search some stuffs" />
	</div><!-- /.form-submit -->
</form><!-- /.searchform -->
