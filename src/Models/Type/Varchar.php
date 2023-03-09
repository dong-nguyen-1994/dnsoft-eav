<?php

namespace DnSoft\Eav\Models\Type;

use DnSoft\Core\Traits\TranslatableTrait;

class Varchar extends \Rinvex\Attributes\Models\Type\Varchar
{
    use TranslatableTrait;

    public $translatable = [
        'content',
    ];
}
