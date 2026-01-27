<?php

namespace JustBetter\Veto\Tests\Policies;

use JustBetter\Veto\Policies\Collection;
use JustBetter\Veto\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Entries\Collection as StatamicCollection;
use Statamic\Facades\Collection as CollectionFacade;

class CollectionTest extends TestCase
{
    #[Test]
    public function a_user_can_view(): void
    {
        $permission = config()->string('statamic-veto.permissions.entry');

        $user = $this->setupUser($permission);
        /** @var StatamicCollection $collection */
        $collection = CollectionFacade::make('test');
        $collection->save();

        $policy = app(Collection::class);

        $this->assertTrue($policy->view($user, $collection));
    }
}
