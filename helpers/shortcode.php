<?php

use Squirtle\Shortcode\Shortcode;

if (!function_exists('shortcode')) {
    /**
     * @return Squirtle\Shortcode\Shortcode
     */
    function shortcode(): Shortcode
    {
        return app('shortcode');
    }
}

if (!function_exists('add_shortcode')) {
    /**
     * @param string $key
     * @param string $name
     * @param string|null $description
     * @param Callable|string $callback
     * @return Squirtle\Shortcode\Shortcode
     */
    function add_shortcode(string $key, string $name, string $description = null, $callback = null): Shortcode
    {
        return shortcode()->register($key, $name, $description, $callback);
    }
}

if (!function_exists('do_shortcode')) {
    /**
     * @param string $content
     * @return string
     */
    function do_shortcode(string $content): string
    {
        return shortcode()->compile($content);
    }
}

if (!function_exists('generate_shortcode')) {
    /**
     * @param string $name
     * @param array $attributes
     * @return string
     */
    function generate_shortcode(string $name, array $attributes = []): string
    {
        return shortcode()->generateShortcode($name, $attributes);
    }
}

if (!function_exists('add_shortcode_config')) {
    /**
     * @param string $key
     * @param string $html
     */
    function add_shortcode_config(string $key, string $html)
    {
        shortcode()->setConfig($key, $html);
    }
}

if (!function_exists('get_shortcode_config')) {
    /**
     * @param string $key
     * @return mixed
     */
    function get_shortcode_config(string $key)
    {
        $shortcodes = shortcode()->getAll();

        return $shortcodes[$key]['config'];
    }
}

if (!function_exists('get_all_shortcode_config')) {
    /**
     * @return array
     */
    function get_all_shortcode_config()
    {

        $shortcodes = shortcode()->getAll();

        $config = [];

        foreach($shortcodes as $shortcode){

            $config[] = $shortcode['config'];
        }

        return $config;
    }
}
