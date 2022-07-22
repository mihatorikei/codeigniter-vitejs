<?php

namespace Mihatori\CodeigniterVite;

use CodeIgniter\View\ViewDecoratorInterface;

class Decorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        # Check if vite is running or manifest is ready.
        if (Vite::isReady() && env('VITE_AUTO_INJECTING'))
        {
            # First inject app div
            $html = str_replace('<body>', "<body>\n\t<div id=\"app\">", $html);
            # Close the div
            $html = str_replace('</body>', "\n\t</div>\n</body>", $html);

            # Get generated css.
            $tags = Vite::tags();

            $jsTags  = $tags['js'];

            # now inject css
            if (!empty($tags['css']))
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
