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
            # Get generated js and css tags.
            $tags = Vite::tags();

            $findAndReplace = [
                # Generated js and css tags.
                '</head>'   => "\n\t$tags\n</head>",
                # app div
                '<body>'    => "<body>\n\t<div id=\"app\">",
                # Closing app div.
                '</body>'   => "\n\t</div>\n</body>"
            ];

            # Insert tags just before "</head>" tag and a div with "app" id
            $html = str_replace(array_keys($findAndReplace), array_values($findAndReplace), $html);
        }

        return $html;
    }
}
