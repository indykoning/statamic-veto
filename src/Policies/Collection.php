<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Entries\Collection as StatamicCollection;
use Statamic\Policies\CollectionPolicy;

class Collection extends CollectionPolicy
{
    /**
     * @param  User  $user
     * @param  StatamicCollection  $collection
     */
    public function view($user, $collection): bool
    {
        $permission = config()->string('statamic-veto.permissions.entry');

        return $user->hasPermission($permission) || parent::view($user, $collection);
    }

    public static function bind(): void
    {
        app()->bind(
            CollectionPolicy::class,
            static::class
        );
    }
}
