<?php

namespace Mihatori\CodeigniterVite;

class Vite
{

    /**
     * @var string manifest path.
     */
    private static $manifest = FCPATH . 'manifest.json';

    /**
     * Get vite entry file on running or bundled files instead.
     * 
     * @return string single script tag on developing and much more on production
     */
    public static function tags(): ?string
    {
        # Check if vite is running.
        $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

        $result = @file_get_contents($entryFile) ? '<script type="module" src="' . $entryFile . '"></script>' : null;

        # React HMR fix.
        if (!empty($result))
        {
            $result = self::getReactTag() . "$result";
        }

        # If vite isn't running, then return the compiled resources.
        if (empty($result) && is_file(self::$manifest))
        {
            # Get the manifest content.
            $manifest = file_get_contents(self::$manifest);
            # You look much pretty as an php object =).
            $manifest = json_decode($manifest);

            # Now, we will get all js files and css from the manifest.
            foreach ($manifest as $file)
            {
                # Check extension
                $fileExtension = substr($file->file, -3, 3);

                # Generate js tag.
                if ($fileExtension === '.js' && isset($file->isEntry) && $file->isEntry === true)
                {
                    $result .= '<script type="module" src="/' . $file->file . '"></script>';
                }

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
    public static function getReactTag(): ?string
    {
        if (env('VITE_FRAMEWORK') === 'react')
        {
            $origin = env('VITE_ORIGIN');
            $result = "<script type=\"module\">import RefreshRuntime from '$origin/@react-refresh';RefreshRuntime.injectIntoGlobalHook(window);window.\$RefreshReg\$ = () => {};window.\$RefreshSig\$ = () => (type) => type;window.__vite_plugin_react_preamble_installed__ = true;</script>";
            return "$result\n\t";
        }

        return null;
    }

    /**
     * Check if the vite is running or manifest does exist.
     * 
     * @return bool true if vite is runnig or if manifest does exist, otherwise false;
     */
    public static function isReady(): bool
    {
        # Check if vite is running.
        $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

        switch (true)
        {
            case @file_get_contents($entryFile):
                $result = true;
                break;
            case !empty(self::$manifest):
                $result = true;
                break;

            default:
                $result = false;
                break;
        }

        return $result;
    }
}
