<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Policies\GlobalSetPolicy;

class GlobalSet extends GlobalSetPolicy
{
    /**
     * @param  User  $user
     * @param  string  $set
     */
    public function view($user, $set): bool
    {
        $permission = config()->string('statamic-veto.permissions.global');

        return $user->hasPermission($permission) || parent::view($user, $set);
    }

    public static function bind(): void
    {
        app()->bind(
            GlobalSetPolicy::class,
            static::class
        );
    }
}
