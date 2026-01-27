<?php

namespace JustBetter\Veto\Tests\Policies;

use JustBetter\Veto\Policies\Term;
use JustBetter\Veto\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Facades\Taxonomy as TaxonomyFacade;
use Statamic\Facades\Term as TermFacade;
use Statamic\Taxonomies\Taxonomy as StatamicTaxonomy;
use Statamic\Taxonomies\Term as StatamicTerm;

class TermTest extends TestCase
{
    #[Test]
    public function a_user_can_view(): void
    {
        $permission = config()->string('statamic-veto.permissions.term');
        $user = $this->setupUser($permission);

        /** @var StatamicTaxonomy $taxonomy */
        $taxonomy = TaxonomyFacade::make();
        $taxonomy->handle('::taxonomy::')
            ->title('::title::');
        $taxonomy->saveQuietly();

        /** @var StatamicTerm $term */
        $term = TermFacade::make('test');
        $term->taxonomy($taxonomy)
            ->slug('::slug::')
            ->data([
                'title' => '::title::',
            ]);
        $term->saveQuietly();

        $policy = app(Term::class);

        $this->assertTrue($policy->view($user, $term));
    }

    #[Test]
    public function a_user_can_update(): void
    {
        $permission = config()->string('statamic-veto.permissions.term');
        $user = $this->setupUser($permission);

        /** @var StatamicTaxonomy $taxonomy */
        $taxonomy = TaxonomyFacade::make();
        $taxonomy->handle('::taxonomy::')
            ->title('::title::');
        $taxonomy->saveQuietly();

        /** @var StatamicTerm $term */
        $term = TermFacade::make('test');
        $term->taxonomy($taxonomy)
            ->slug('::slug::')
            ->data([
                'title' => '::title::',
            ]);
        $term->saveQuietly();

        $policy = app(Term::class);

        $this->assertTrue($policy->update($user, $term));
    }

    #[Test]
    public function a_user_can_edit(): void
    {
        $permission = config()->string('statamic-veto.permissions.term');
        $user = $this->setupUser($permission);

        /** @var StatamicTaxonomy $taxonomy */
        $taxonomy = TaxonomyFacade::make();
        $taxonomy->handle('::taxonomy::')
            ->title('::title::');
        $taxonomy->saveQuietly();

        /** @var StatamicTerm $term */
        $term = TermFacade::make('test');
        $term->taxonomy($taxonomy)
            ->slug('::slug::')
            ->data([
                'title' => '::title::',
            ]);
        $term->saveQuietly();

        $policy = app(Term::class);

        $this->assertTrue($policy->edit($user, $term));
    }

    #[Test]
    public function a_user_can_create(): void
    {
        $permission = config()->string('statamic-veto.permissions.term');
        $user = $this->setupUser($permission);

        /** @var StatamicTaxonomy $taxonomy */
        $taxonomy = TaxonomyFacade::make();
        $taxonomy->handle('::taxonomy::')
            ->title('::title::');
        $taxonomy->saveQuietly();

        /** @var StatamicTerm $term */
        $term = TermFacade::make('test');
        $term->taxonomy($taxonomy)
            ->slug('::slug::')
            ->data([
                'title' => '::title::',
            ]);
        $term->saveQuietly();

        $policy = app(Term::class);

        $this->assertTrue($policy->create($user, $taxonomy));
    }

    #[Test]
    public function a_user_can_store(): void
    {
        $permission = config()->string('statamic-veto.permissions.term');
        $user = $this->setupUser($permission);

        /** @var StatamicTaxonomy $taxonomy */
        $taxonomy = TaxonomyFacade::make();
        $taxonomy->handle('::taxonomy::')
            ->title('::title::');
        $taxonomy->saveQuietly();

        $policy = app(Term::class);

        $this->assertTrue($policy->store($user, $taxonomy));
    }
}
