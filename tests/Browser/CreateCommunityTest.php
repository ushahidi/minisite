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
    public function testCreateClosedCommunity()
    {
        // Run a single seeder...
        $this->browse(function (Browser $loggedIn, $anon) {
            $loggedIn->loginAs(User::find(1))
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
                ->visit(route('minisite.admin', ['community' => 'piriapolis']))
                ->assertSee('Unauthorized') ;
            $whatsAppLink = route('createByType', ['community' => Community::find(1), 'blockType' => BlockType::find('WhatsApp Group Link')]);
            $infoField = BlockTypeFields::where(['block_type' => 'WhatsApp Group Link', 'name' => 'Info'])->first();
            $urlField = BlockTypeFields::where(['block_type' => 'WhatsApp Group Link', 'name' => 'Url'])->first();
            $loggedIn
                ->visit(route('minisite.admin', ['community' => 'piriapolis']))
                ->click('.fn-body-add')
                ->click('a[href="'.$whatsAppLink.'"]')
                ->type('input[name="fields['.$urlField->id.']"]', 'https://ohnoes')
                ->type('input[name="fields['.$infoField->id.']"]', 'Join us in whatsapp')
                ->radio('visibility', 'community')
                ->press('Add')
                ->assertSee('Welcome to piriapolis')
                ->assertPresent('a[href="https://ohnoes"]')
                ->assertSee('Join us in whatsapp')
                ;//Add blocks
            $anon
                ->visit(route('minisite.admin', ['community' => 'piriapolis']))
                ->assertSee('Unauthorized') ;

        });
    }
    /**
     * Create a community that is open to the public, with some private blocks
     */
    public function testCreateOpenCommunity()
    {
        $this->browse(function (Browser $loggedIn, Browser $anon, Browser $loggedInVisitor) {
            //Add a public community
            $loggedIn->loginAs(User::find(1))
            ->visit(route('community.create'))
                    ->type('name', 'Open for everyone')
                    ->type('welcome', 'Welcome to my open piriapolis community')
                    ->type('description', 'A community for people in our city to share openly')
                    ->type('location_string', 'Piriapolis')
                    ->radio('visibility', 'public')
                    ->press('Next')
                    // this is..flaky at best. Not sure yet why a waitForRoute fails here
                    ->assertPresent('.map')
                    ->radio('input[name="location"]', 'Piriápolis, Maldonado, 20200, Uruguay')
                    // if we have not added communities this should not appear
                    ->press('Next')
                    ->waitForRoute('minisite.admin', ['community' => 'open-for-everyone'])
                    ->assertPresent('.blocks-js')
                    ->assertSee('Welcome to my open piriapolis community')
                    ->assertSee('A community for people in our city to share openly')
                    ->assertSee('Edit Site Preferences');
            // Check that you can visit and find a public community if you are not logged in
            $anon
                ->visit(route('minisite.admin', ['community' => 'open-for-everyone']))
                ->assertSee('Welcome to my open piriapolis community') ;
            //Add a PUBLIC block in a public community
            $whatsAppLink = route('createByType', ['community' => Community::find(1), 'blockType' => BlockType::find('WhatsApp Group Link')]);
            $infoField = BlockTypeFields::where(['block_type' => 'WhatsApp Group Link', 'name' => 'Info'])->first();
            $urlField = BlockTypeFields::where(['block_type' => 'WhatsApp Group Link', 'name' => 'Url'])->first();
            $loggedIn
                ->visit(route('minisite.admin', ['community' => 'open-for-everyone']))
                ->click('.fn-body-add')
                ->click('a[href="'.$whatsAppLink.'"]')
                ->type('input[name="fields['.$urlField->id.']"]', 'https://ohnoes')
                ->type('input[name="fields['.$infoField->id.']"]', 'Join us in whatsapp')
                ->radio('visibility', 'public')
                ->press('Add')
                ->assertSee('Welcome to my open piriapolis community')
                ->assertPresent('a[href="https://ohnoes"]')
                ->assertSee('Join us in whatsapp')
                ;
            //Add a COMMUNITY ONLY block in a public community
            $pinnedItemLink = route('createByType', ['community' => Community::find(1), 'blockType' => BlockType::find('Pinned item')]);
            $infoField = BlockTypeFields::where(['block_type' => 'Pinned item', 'name' => 'Info'])->first();
            $textField = BlockTypeFields::where(['block_type' => 'Pinned item', 'name' => 'Text'])->first();
            $loggedIn
                ->visit(route('minisite.admin', ['community' => 'open-for-everyone']))
                ->click('.fn-body-add')
                ->click('a[href="'.$pinnedItemLink.'"]')
                ->type('textarea[name="fields['.$infoField->id.']"]', 'My pinned item which is for my community only')
                ->type('input[name="fields['.$textField->id.']"]', 'This information is sensitive do not share it')
                ->radio('visibility', 'community')
                ->press('Add')
                ->assertSee('Welcome to my open piriapolis community')
                ->assertSee('My pinned item which is for my community only')
                ->assertSee('This information is sensitive do not share it')
                ;
            // check that even the community is public, I can't see a public community's "COMMUNITY ONLY" blocks if I'm not logged in
            $anon
                ->visit(route('minisite.admin', ['community' => 'open-for-everyone']))
                ->assertSee('Welcome to my open piriapolis community')
                ->assertPresent('a[href="https://ohnoes"]')
                ->assertSee('Join us in whatsapp')
                ->assertDontSee('My pinned item which is for my community only')
                ->assertDontSee('This information is sensitive do not share it');
            // check that even if I am logged in, I can't see a public community's "COMMUNITY ONLY" blocks if I'm not a member
            $loggedInVisitor
                ->loginAs(User::find(2))
                ->visit(route('minisite.admin', ['community' => 'open-for-everyone']))
                ->assertSee('Welcome to my open piriapolis community')
                ->assertPresent('a[href="https://ohnoes"]')
                ->assertSee('Join us in whatsapp')
                ->assertDontSee('My pinned item which is for my community only')
                ->assertDontSee('This information is sensitive do not share it');
        });
    }
}
