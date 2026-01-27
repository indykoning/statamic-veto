<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Policies\GlobalSetVariablesPolicy;

class GlobalSetVariables extends GlobalSetVariablesPolicy
{
    /**
     * @param  User  $user
     * @param  string  $entry
     */
    public function edit($user, $entry): bool
    {
        $permission = config()->string('statamic-veto.permissions.global');

        return $user->hasPermission($permission) || parent::edit($user, $entry);
    }

    public static function bind(): void
    {
        app()->bind(
            GlobalSetVariablesPolicy::class,
            static::class
        );
    }
}
