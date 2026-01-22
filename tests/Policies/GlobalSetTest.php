<?php

namespace JustBetter\Veto\Policies\Tests;

use JustBetter\Veto\Policies\GlobalSet;
use JustBetter\Veto\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Facades\GlobalSet as GlobalSetFacade;
use Statamic\Globals\GlobalSet as StatamicGlobalSet;

class GlobalSetTest extends TestCase
{
    #[Test]
    public function a_user_can_view(): void
    {
        $permission = config()->string('statamic-veto.permissions.global');
        $user = $this->setUpUser($permission);
        /** @var StatamicGlobalSet $global */
        $global = GlobalSetFacade::make('::global::');
        $global->save();

        $policy = app(GlobalSet::class);

        $this->assertTrue($policy->view($user, $global));
    }
}
