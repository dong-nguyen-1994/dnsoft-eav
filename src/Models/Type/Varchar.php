<?php

namespace Dnsoft\Eav\Models\Type;

use Dnsoft\Core\Traits\TranslatableTrait;

class Varchar extends \Rinvex\Attributes\Models\Type\Varchar
{
    use TranslatableTrait;

    public $translatable = [
        'content',
    ];
}
