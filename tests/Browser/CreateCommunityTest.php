<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use TestingSeeder;
use App\User;
class CreateCommunityTest extends DuskTestCase
{
    use DatabaseMigrations;

    protected function setUp(): void {
        parent::setUp();
        $this->artisan('db:seed');
        $this->artisan('db:seed', ['--class' => 'TestingSeeder']);
    }
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testCreateFirstCommunity()
    {
        // Run a single seeder...
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
            ->visit(route('community.create'))
                    ->click('.js-cookie-consent-agree')
                    ->type('name', 'Piriapolis')
                    ->type('welcome', 'Welcome to piriapolis')
                    ->type('description', 'A community for people in our city')
                    ->type('location_string', 'Piriapolis')
                    ->radio('visibility', 'community')
                    ->press('Next')
                    // this is..flaky at best. Not sure yet why a waitForRoute fails here
                    ->assertPresent('.map')
                    ->radio('input[name="location"]', 'Piriápolis, Maldonado, 20200, Uruguay')
                    // if we have not added communities this should not appear
                    ->press('Next')
                    ->waitForRoute('minisite.admin', ['community' => 'piriapolis'])
                    ->assertPresent('.blocks-js')
                    ->assertSee('Welcome to piriapolis')
                    ->assertSee('A community for people in our city')
                    ->assertSee('Edit Site Preferences');
        });
    }
}
