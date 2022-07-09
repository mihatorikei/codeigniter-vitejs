<?php

namespace Mihatori\CodeigniterVite;

class CodeigniterVite
{

    /**
     * @var string manifest path.
     */
    private static $manifest;

    public function __construct()
    {
        static::$manifest = is_file(FCPATH . 'manifest.json') ? FCPATH . 'manifest.json' : null;
    }

    /**
     * Get vite entry file on running or bundled files instead.
     * 
     * @return string single script tag on developing and much more on production
     */
    public static function tags()
    {
        # Check if vite is running.
        $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

        $result = @file_get_contents($entryFile) ? '<script type="module" src="' . $entryFile . '"></script>' : null;

        # React HMR fix.
        if (!empty($result))
        {
            $result = static::getReactTag() . "$result";
        }

        # If vite isn't running, then return the compiled resources.
        if (empty($result) && static::$manifest)
        {
            # Get the manifest content.
            $manifest = file_get_contents(static::$manifest);
            # You look much pretty as an php object =).
            $manifest = json_decode($manifest);

            # Now, we will get all js files and css from the manifest.
            foreach ($manifest as $file)
            {
                # Js files.
                $result .= '<script type="module" src="/' . $file->file . '"></script>';

                if (!empty($file->css))
                {
                    foreach ($file->css as $cssFile)
                    {
                        $result .= '<link rel="stylesheet" href="/' . $cssFile . '" />';
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Enable HMR for react.
     * 
     * @see https://v2.vitejs.dev/guide/backend-integration.html
     * 
     * @return string|null a simple module script
     */
    public static function getReactTag()
    {
        if (env('VITE_FRAMEWORK') === 'react')
        {
            $origin = env('VITE_ORIGIN');
            $result = "<script type=\"module\">import RefreshRuntime from '$origin/@react-refresh';RefreshRuntime.injectIntoGlobalHook(window);window.\$RefreshReg\$ = () => {};window.\$RefreshSig\$ = () => (type) => type;window.__vite_plugin_react_preamble_installed__ = true;</script>";
            return "$result\n\t";
        }

        return null;
    }
}
