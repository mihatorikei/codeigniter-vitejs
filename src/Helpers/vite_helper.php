<?php

use Mihatori\CodeigniterVite\Vite;

/**
 * Get vite entry file or bundled files.
 * 
 * @return array|null
 */
function viteTags(): ?array
{
    return Vite::tags();
}

/**
 * Get react module
 * 
 * @return string|null
 */
function getReactModule(): ?string
{
    return vite::getReactTag();
}

/**
 * @return bool true if vite is running
 */
function viteIsRunning(): bool
{
    $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');
    return (bool) @file_get_contents($entryFile);
}

/**
 * Get vite framework
 * 
 * @return string react, vue, svelte or none
 */
function viteFramework()
{
    return env('VITE_FRAMEWORK');
}
