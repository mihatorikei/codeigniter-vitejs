<?php

namespace Mihatori\CodeigniterVite;

use CodeIgniter\View\ViewDecoratorInterface;

class Decorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        $vite = new CodeigniterVite();

        # Check if vite is running or manifest is ready.
        if ($vite->check())
        {
            # Get generated js and css tags.
            $tags = $vite->tags();

            # Insert tags just before "</head>" tag.
            $html = empty($tags) ? $html : str_replace('</head>', "\n\t$tags\n</head>", $html);

            if (env('VITE_ADD_APP_ID') == "true")
            {
                # Insert app id just after body tag
                $html = empty($tags) ? $html : str_replace('<body>', "<body>\n\t<div id=\"app\">", $html);
                # Close it.
                $html = empty($tags) ? $html : str_replace('</body>', "\n\t</div>\n</body>", $html);
            }
        }

        # If not, then just return the html as it is.
        return $html;
    }
}
