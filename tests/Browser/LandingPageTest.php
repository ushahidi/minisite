<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LandingPageTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSeeIn('a[href="'.route('landing.search').'"] .mdc-button__label', 'Search')
                    ->assertSeeIn('a[href="'.route('community.create').'"] .mdc-button__label', 'Create')
                    ->assertSee('Active Communities')
                    ->assertPresent('.js-menu-button')
                    // if we have not added communities this should not appear
                    ->assertMissing('.mdc-card.community-card');
        });
    }
}
