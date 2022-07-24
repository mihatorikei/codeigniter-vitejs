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
     * @return array single script tag on developing and much more on production
     */
    public static function tags(): ?array
    {
        $result = [
            'js'    => null,
            'css'   => null
        ];

        # Check if vite is running.
        $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

        $result['js'] = @file_get_contents($entryFile) ? '<script type="module" src="' . $entryFile . '"></script>' : null;

        # React HMR fix.
        if (!empty($result['js']))
        {
            $result['js'] = self::getReactTag() . $result['js'];
        }

        # If vite isn't running, then return the bundled resources.
        if (empty($result['js']) && is_file(self::$manifest))
        {
            # Get the manifest content.
            $manifest = file_get_contents(self::$manifest);
            # You look much pretty as a php object =).
            $manifest = json_decode($manifest);

            # Now, we will get all js files and css from the manifest.
            foreach ($manifest as $file)
            {
                # Check extension
                $fileExtension = substr($file->file, -3, 3);

                # Generate js tag.
                if ($fileExtension === '.js' && isset($file->isEntry) && $file->isEntry === true)
                {
                    $result['js'] .= '<script type="module" src="/' . $file->file . '"></script>';
                }

                if (!empty($file->css))
                {
                    foreach ($file->css as $cssFile)
                    {
                        $result['css'] .= '<link rel="stylesheet" href="/' . $cssFile . '" />';
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
     * Check whether vite is running or manifest does exist.
     * 
     * @return bool true if vite is runnig or if manifest does exist, otherwise false;
     */
    public static function isReady(): bool
    {
        $entryFile = env('VITE_ORIGIN') . '/' . env('VITE_RESOURCES_DIR') . '/' . env('VITE_ENTRY_FILE');

        switch (true)
        {
            case @file_get_contents($entryFile):
                $result = true;
                break;
            case is_file(self::$manifest):
                $result = true;
                break;

            default:
                $result = false;
        }

        return $result;
    }
}
