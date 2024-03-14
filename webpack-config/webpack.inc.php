<?php

function webpack_register_assets ()
{
	// var_dump(get_template_directory_uri() .'/public/styles.css'); die;
	// webpack compiled css asset
	wp_register_style('webpack-style', get_template_directory_uri() .'/public/styles.css');
	// webpack compiled js asset
	wp_register_script('webpack-script', get_template_directory_uri() .'/public/bundle.js');

	// include assets
	wp_enqueue_style('webpack-style');
	wp_enqueue_script('webpack-script');
}

add_action('wp_enqueue_scripts', 'webpack_register_assets', 1);
