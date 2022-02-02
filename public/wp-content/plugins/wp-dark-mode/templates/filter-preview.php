<?php

$font_size = wp_dark_mode_get_settings( 'wp_dark_mode_accessibility', 'font_size', 100 );

if ( 'custom' == $font_size ) {
	$font_size = wp_dark_mode_get_settings( 'wp_dark_mode_accessibility', 'custom_font_size', 100 );
}

echo "<style>.font_size_preview #hero{zoom: $font_size%}</style>";

?>

<h2>Filter Settings Demo Preview:</h2>

<section  id="hero" class="hero-banner filter-preview wp-dark-mode-include">

    <ul class="navbar_nav wp-dark-mode-include">

        <li><a href="#!" class="wp-dark-mode-include">Home</a></li>

        <li><a href="#!" class="wp-dark-mode-include">Features</a></li>

        <li><a href="#!" class="wp-dark-mode-include">Pricing</a></li>

        <li><a href="#!" class="wp-dark-mode-include">Contact</a></li>

    </ul>

    <div class="small-element wp-dark-mode-include"></div>
    <div class="container wp-dark-mode-include">
        <div class="row wp-dark-mode-include">
            <div class="col-xl-12 wp-dark-mode-include">
                <div class="hero-content wp-dark-mode-include">
                    <h1 class="text-white wp-dark-mode-include">Doing it all,<span>In all new ways.</span></h1>
                    <p class="wp-dark-mode-include">
                        Experience remarkable WordPress products with a new level of power, beauty, and human-centered designs.
                        Think you know WordPress products? Think Deeper!
                    </p>
                    <a class="hero-btn  wp-dark-mode-include" href="https://wppool.dev/" target="_blank">Our Products</a>
                </div>
            </div>
        </div>
    </div>
</section>