<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Policies\TermPolicy;
use Statamic\Sites\Site;

class Term extends TermPolicy
{
    /**
     * @param  User  $user
     * @param  string  $term
     */
    public function view($user, $term): bool
    {
        return $this->can($user) || parent::view($user, $term);
    }

    /**
     * @param  User  $user
     * @param  string  $term
     */
    public function edit($user, $term): bool
    {
        return $this->can($user) || parent::edit($user, $term);
    }

    /**
     * @param  User  $user
     * @param  string  $term
     */
    public function update($user, $term): bool
    {
        return $this->can($user) || parent::update($user, $term);
    }

    /**
     * @param  User  $user
     * @param  string  $taxonomy
     * @param  Site|null  $site
     */
    public function create($user, $taxonomy, $site = null): bool
    {
        return $this->can($user) || parent::create($user, $taxonomy, $site);
    }

    protected function can(User $user): bool
    {
        $permission = config()->string('statamic-veto.permissions.term');

        return $user->has($permission);
    }

    public static function bind(): void
    {
        app()->bind(
            TermPolicy::class,
            static::class
        );
    }
}
