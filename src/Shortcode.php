<?php

namespace Squirtle\Shortcode;

use Squirtle\Shortcode\Compilers\ShortcodeCompiler;

class Shortcode
{
    /**
     * Shortcode compiler
     *
     * @var ShortcodeCompiler
     */
    protected $compiler;

    /**
     * Constructor
     *
     * @param ShortcodeCompiler $compiler
     */
    public function __construct(ShortcodeCompiler $compiler)
    {
        $this->compiler = $compiler;
    }

    /**
     * Register a new shortcode
     *
     * @param $key
     * @param string $name
     * @param null $description
     * @param callable|string $callback
     * @return Shortcode
     */
    public function register($key, string $name, $description = null, $callback = null): Shortcode
    {
        $this->compiler->add($key, $name, $description, $callback);

        return $this;
    }

    /**
     * Enable the shortcode
     *
     * @return Shortcode
     */
    public function enable(): Shortcode
    {
        $this->compiler->enable();

        return $this;
    }

    /**
     * Disable the shortcode
     *
     * @return Shortcode
     */
    public function disable(): Shortcode
    {
        $this->compiler->disable();

        return $this;
    }

    /**
     * Compile the given string
     *
     * @param string $value
     * @return string
     */
    public function compile(string $value): string
    {
        // Always enable when we call the compile method directly
        $this->enable();

        // return compiled contents
        return $this->compiler->compile($value);
    }

    /**
     * @param string $value
     * @return string
     */
    public function strip(string $value): string
    {
        return $this->compiler->strip($value);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->compiler->getRegistered();
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setConfig(string $key, string $value)
    {
        $this->compiler->setConfig($key, $value);
    }

    /**
     * @param string $name
     * @param array $attributes
     * @return string
     */
    public function generateShortcode(string $name, array $attributes = []): string
    {
        $parsedAttributes = '';
        foreach ($attributes as $key => $attribute) {
            $parsedAttributes .= ' ' . $key . '="' . $attribute . '"';
        }

        return '[' . $name . $parsedAttributes . '][/' . $name . ']';
    }
}
