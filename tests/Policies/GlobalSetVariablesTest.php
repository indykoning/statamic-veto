<?php

namespace JustBetter\Veto\Tests\Policies;

use JustBetter\Veto\Policies\GlobalSetVariables;
use JustBetter\Veto\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Facades\GlobalSet as GlobalSetFacade;

class GlobalSetVariablesTest extends TestCase
{
    #[Test]
    public function a_user_can_edit(): void
    {
        $permission = config()->string('statamic-veto.permissions.global');
        $user = $this->setUpUser($permission);
        $global = GlobalSetFacade::make('::global::')->save();

        $policy = app(GlobalSetVariables::class);

        $this->assertTrue($policy->edit($user, $global));
    }
}
