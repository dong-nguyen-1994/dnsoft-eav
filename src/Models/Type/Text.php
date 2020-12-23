<?php

namespace Dnsoft\Eav\Models\Type;

use Dnsoft\Core\Traits\TranslatableTrait;

class Text extends \Rinvex\Attributes\Models\Type\Text
{
    use TranslatableTrait;

    public $translatable = [
        'content',
    ];
}
