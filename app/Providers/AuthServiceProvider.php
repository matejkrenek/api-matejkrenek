<?php

namespace App\Providers;

use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanInvitation;
use App\Policies\V1\Kanban\KanbanInvitationPolicy;
use App\Policies\V1\Kanban\KanbanPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Kanban::class => KanbanPolicy::class,
        KanbanInvitation::class => KanbanInvitationPolicy::class
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
