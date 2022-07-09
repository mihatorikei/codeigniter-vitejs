<?php

namespace Mihatori\CodeigniterVite;

use CodeIgniter\View\ViewDecoratorInterface;

class Decorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        # Get generated js and css tags.
        $tags = CodeigniterVite::tags();

        # Insert tags just before "</head>" tag.
        $html = empty($tags) ? $html : str_replace('</head>', "\n\t$tags\n</head>", $html);

        return $html;
    }
}
