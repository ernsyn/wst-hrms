<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;

class Role extends \Spatie\Permission\Models\Role implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}
