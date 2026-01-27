<?php

namespace JustBetter\Veto;

use JustBetter\Veto\Policies\Collection;
use JustBetter\Veto\Policies\Entry;
use JustBetter\Veto\Policies\GlobalSet;
use JustBetter\Veto\Policies\GlobalSetVariables;
use JustBetter\Veto\Policies\Taxonomy;
use JustBetter\Veto\Policies\Term;
use Statamic\Auth\Permission;
use Statamic\Facades\Permission as PermissionFacade;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->registerPolicies();
    }

    protected function registerPolicies(): static
    {
        Collection::bind();
        Entry::bind();
        GlobalSet::bind();
        GlobalSetVariables::bind();

        Taxonomy::bind();
        Term::bind();

        return $this;
    }

    public function bootAddon(): void
    {
        $this
            ->bootGlobalSetVariablesPermission()
            ->bootEntryPermission()
            ->bootTermPermission();
    }

    protected function bootGlobalSetVariablesPermission(): static
    {
        // @phpstan-ignore-next-line argument.type
        PermissionFacade::group('globals', function (): void {
            $permission = config()->string('statamic-veto.permissions.global');
            PermissionFacade::register($permission, function (Permission $permission): void {
                $permission
                    ->label('Edit all globals')
                    ->description(__('👑 Veto the ability to let this role edit all globals.'));
            });
        });

        return $this;
    }

    protected function bootEntryPermission(): static
    {
        // @phpstan-ignore-next-line argument.type
        PermissionFacade::group('collections', function (): void {
            $permission = config()->string('statamic-veto.permissions.entry');
            PermissionFacade::register($permission, function (Permission $permission): void {
                $permission
                    ->label('Edit all entries')
                    ->description(__('👑 Veto the ability to let this role edit all collection entries.'));
            });
        });

        return $this;
    }

    protected function bootTermPermission(): static
    {
        // @phpstan-ignore-next-line argument.type
        PermissionFacade::group('taxonomies', function (): void {
            $permission = config()->string('statamic-veto.permissions.term');
            PermissionFacade::register($permission, function (Permission $permission): void {
                $permission
                    ->label('Edit all taxonomy terms')
                    ->description(__('👑 Veto the ability to let this role edit all taxonomy terms.'));
            });
        });

        return $this;
    }
}
