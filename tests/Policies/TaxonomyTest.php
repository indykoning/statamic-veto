<?php

namespace JustBetter\Veto\Tests\Policies;

use JustBetter\Veto\Policies\Taxonomy;
use JustBetter\Veto\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Facades\Taxonomy as TaxonomyFacade;
use Statamic\Taxonomies\Taxonomy as StatamicTaxonomy;

class TaxonomyTest extends TestCase
{
    #[Test]
    public function a_user_can_view(): void
    {
        $permission = config()->string('statamic-veto.permissions.term');
        $user = $this->setUpUser($permission);
        /** @var StatamicTaxonomy $taxonomy */
        $taxonomy = TaxonomyFacade::make('::category::');

        $taxonomy->save();

        $policy = app(Taxonomy::class);

        $this->assertTrue($policy->view($user, $taxonomy));
    }
}
