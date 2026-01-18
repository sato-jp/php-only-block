<?php
/**
 * Plugin Name: PHP Only Block
 * Plugin URI: https://github.com/yourusername/php-only-block
 * Description: PHP だけで作成されたブロックです。
 * Version: 1.0.2
 * Requires at least: 6.9
 * Requires PHP: 8.1
 * Author: Hiroshi Sato
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: only-block
 * Domain Path: /languages
 */

/**
 * Enqueues block editor assets.
 */
function php_only_block_editor_assets() {
    wp_enqueue_script(
        'php-only-block-editor-script',
        plugin_dir_url(__FILE__) . 'build/editor.js',
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(plugin_dir_path(__FILE__) . 'build/editor.js'),
        true
    );
    
    wp_enqueue_style(
        'php-only-block-editor-style',
        plugin_dir_url(__FILE__) . 'build/editor.css',
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'build/editor.css')
    );
}
add_action('enqueue_block_editor_assets', 'php_only_block_editor_assets');

/**
 * Enqueues block frontend assets.
 */
function php_only_block_frontend_assets() {
    if (!is_admin()) {
        wp_enqueue_style(
            'php-only-block-style',
            plugin_dir_url(__FILE__) . 'build/editor.css',
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'build/editor.css')
        );
    }
}
add_action('wp_enqueue_scripts', 'php_only_block_frontend_assets');

/**
 * Renders the PHP Only Block.
 */
function register_blocks() {
    register_block_type('php-only-block/php-only-block', array(
        'title' => 'PHP Only Block',
        'icon' => 'admin-generic',
        'category' => 'widgets',
        'example' => array(),
        'description' => 'PHP だけで作成されたブロック。',
        'keywords' => array('php', 'block'),
        'render_callback' => fn() => '<p>Hello</p>',
        'supports' => array('auto_register' => true),
        'editor_script' => 'php-only-block-editor-script',
        'editor_style' => 'php-only-block-editor-style',
        'style' => 'php-only-block-style',
        'color' => array(
            'background' => '#f0f0f0',
            'foreground' => '#000000',
            'gradient' => '#000000',
            'shadow' => '#000000',
            'text' => '#000000',
            'link' => '#000000',
        ),
    ));
}
add_action('init', 'register_blocks');

