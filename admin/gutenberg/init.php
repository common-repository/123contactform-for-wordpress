<?php
/**
 * Blocks Initializer
 *
 * @since   1.0.0
 * @package CPF
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function formbuilder_123_block_assets() { // phpcs:ignore
	wp_enqueue_style(
		'formbuilder-123-block-style-css',
		plugins_url( 'gutenberg/blocks.style.build.css', dirname( __FILE__ ) ), 
		array( 'wp-editor' ) 
	);
}
add_action( 'enqueue_block_assets', 'formbuilder_123_block_assets' );

/**
 * Enqueue Gutenberg block assets for backend editor.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function formbuilder_123_editor_assets() { // phpcs:ignore
	wp_enqueue_script(
		'formbuilder-123-block-js',
		plugins_url( '/gutenberg/blocks.build.js', dirname( __FILE__ ) ),
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		true
	);

	wp_enqueue_style(
		'formbuilder-123-block-editor-css',
		plugins_url( 'gutenberg/blocks.editor.build.css', dirname( __FILE__ ) ),
		array( 'wp-edit-blocks' )
	);
}
add_action( 'enqueue_block_editor_assets', 'formbuilder_123_editor_assets' );