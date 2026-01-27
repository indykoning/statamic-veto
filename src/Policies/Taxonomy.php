<?php

namespace JustBetter\Veto\Policies;

use Statamic\Auth\User;
use Statamic\Policies\TaxonomyPolicy;

class Taxonomy extends TaxonomyPolicy
{
    /**
     * @param  User  $user
     * @param  string  $taxonomy
     */
    public function view($user, $taxonomy): bool
    {
        $permission = config()->string('statamic-veto.permissions.term');

        return $user->hasPermission($permission) || parent::view($user, $taxonomy);
    }

    public static function bind(): void
    {
        app()->bind(
            TaxonomyPolicy::class,
            static::class
        );
    }
}
