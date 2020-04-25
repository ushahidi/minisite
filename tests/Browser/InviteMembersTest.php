<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use TestingSeeder;
use App\User;
use Modules\Minisite\Models\Community;
use Modules\Minisite\Models\BlockType;
use Modules\Minisite\Models\BlockTypeFields;
use Modules\Minisite\Models\Invite;

class InviteMembersTest extends DuskTestCase
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
    public function testSendInvite()
    {
        // Run a single seeder...
        $this->browse(function (Browser $owner, Browser $anon, Browser $invited) {
            $invitedUser = User::find(2);
            $owner
                ->loginAs(User::find(1))
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
            $anon
                ->visit('minisite.admin', ['community' => 'piriapolis'])
                ->assertDontSee('A community for people in our city');
            $invited
                ->loginAs($invitedUser)
                    ->visit('minisite.admin', ['community' => 'piriapolis'])
                        ->assertDontSee('A community for people in our city');
            $owner
                ->visit(route('community.members', ['community'=>'piriapolis']))
                    ->assertSee('Invite Members')
                    ->click('a[href="'.route('community.members.invite', ['community'=>'piriapolis']).'"]')
                    ->type('emails', $invitedUser->email)
                    ->press('Send Invite')
                    ->assertSee('Select any existing member to manage them.');
            $invite = Invite::where('email',$invitedUser->email)->first();
            $invited
                ->loginAs($invitedUser)
                    ->visit(route('community.members.invite.join', ['token' => $invite->token ]))
                        ->assertSee('A community for people in our city');
        });
    }
}
