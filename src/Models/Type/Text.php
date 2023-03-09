<?php

namespace DnSoft\Eav\Models\Type;

use DnSoft\Core\Traits\TranslatableTrait;

class Text extends \Rinvex\Attributes\Models\Type\Text
{
    use TranslatableTrait;

    public $translatable = [
        'content',
    ];
}
