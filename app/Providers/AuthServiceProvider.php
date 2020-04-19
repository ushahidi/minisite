<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Modules\Minisite\Models\Block' => 'App\Policies\BlockPolicy',
        'Modules\Minisite\Models\Community' => 'App\Policies\CommunityPolicy',
        'Modules\Minisite\Models\Invite' => 'App\Policies\InvitePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
