<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Policies\EntryPolicy;
use Statamic\Sites\Site;

class Entry extends EntryPolicy
{
    /**
     * @param  User  $user
     * @param  string  $entry
     */
    public function edit($user, $entry): bool
    {
        return $this->can($user) || parent::edit($user, $entry);
    }

    /**
     * @param  User  $user
     * @param  string  $entry
     */
    public function update($user, $entry): bool
    {
        return $this->can($user) || parent::update($user, $entry);
    }

    /**
     * @param  User  $user
     * @param  string  $collection
     * @param  Site|null  $site
     */
    public function create($user, $collection, $site = null): bool
    {
        return $this->can($user) || parent::create($user, $collection, $site);
    }

    protected function can(User $user): bool
    {
        $permission = config()->string('statamic-veto.permissions.entry');

        return $user->hasPermission($permission);
    }

    public static function bind(): void
    {
        app()->bind(
            EntryPolicy::class,
            static::class
        );
    }
}
