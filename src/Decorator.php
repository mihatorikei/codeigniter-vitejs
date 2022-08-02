<?php

namespace Mihatori\CodeigniterVite;

use CodeIgniter\View\ViewDecoratorInterface;

class Decorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        # Check whether vite is running or manifest is ready.
        if (env('VITE_AUTO_INJECTING'))
        {
            if (Vite::isReady() === false)
            {
                throw new \Exception('CodeIgniter Vite package is installed, but not initialized. did you run "php spark vite:init" ?');
            }

            # First inject app div
            $html = str_replace('<body>', "<body>\n\t<div id=\"app\">", $html);
            # Close the div
            $html = str_replace('</body>', "\n\t</div>\n</body>", $html);

            # Get bundled assets.
            $tags = Vite::tags();

            $jsTags  = $tags['js'];

            # now inject css
            if (!empty($tags['css']) && env('VITE_FRAMEWORK') !== 'sveltekit')
            {
                $cssTags = $tags['css'];

                $html = str_replace('</head>', "\n\t$cssTags\n", $html);
                $html = str_replace('</body>', "\n\t$jsTags\n</body>", $html);
            }
            else
            {
                $html = str_replace('</head>', "\n\t$jsTags\n</head>", $html);
            }
        }

        return $html;
    }
}
