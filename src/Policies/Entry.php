<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Entries\Collection;
use Statamic\Entries\Entry as StatamicEntry;
use Statamic\Policies\EntryPolicy;
use Statamic\Sites\Site;

class Entry extends EntryPolicy
{
    /**
     * @param  User  $user
     * @param  StatamicEntry  $entry
     */
    public function edit($user, $entry): bool
    {
        return $this->can($user) || parent::edit($user, $entry);
    }

    /**
     * @param  User  $user
     * @param  StatamicEntry  $entry
     */
    public function update($user, $entry): bool
    {
        return $this->can($user) || parent::update($user, $entry);
    }

    /**
     * @param  User  $user
     * @param  Collection  $collection
     * @param  Site|null  $site
     */
    public function create($user, $collection, $site = null): bool
    {
        return $this->can($user) || parent::create($user, $collection, $site);
    }

    /**
     * @param  User  $user
     * @param  Collection  $collection
     * @param  Site|null  $site
     */
    public function store($user, $collection, $site = null): bool
    {
        return $this->can($user) || parent::store($user, $collection, $site);
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
