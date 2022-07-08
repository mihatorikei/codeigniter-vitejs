<?php

namespace Mihatori\CodeigniterVite\Config;

class Registrar
{
    public static function View(): array
    {
        return [
            'decorators' => ['Mihatori\CodeigniterVite\Decorator'],
        ];
    }
}
