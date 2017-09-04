<?php

namespace Jiri\Policies;

use Jiri\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccessPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
