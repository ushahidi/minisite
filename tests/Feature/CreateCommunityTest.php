<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class CreateCommunityTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateCommunityLoggedOut()
    {
        $this->visit('/');
        $response = $this->get(route('community.create'));
        //get redirected since you're not logged in
        $response->assertStatus(302);
    }
}
