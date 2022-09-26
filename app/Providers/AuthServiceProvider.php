<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Aluno;
use App\Models\Turma;
use App\Policies\AlunoPolicy;
use App\Policies\TurmaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Aluno::class => AlunoPolicy::class,
        // Turma::class => TurmaPolicy::class,
    ];

    // /**
    //  * Register any authentication / authorization services.
    //  *
    //  * @return void
    //  */
    // public function boot()
    // {
    //     $this->registerPolicies();

    //     //
    // }

    public function boot()

    {
        // Automatically finding the Policies
        Gate::guessPolicyNamesUsing(function ($modelClass) {
            return 'App\\Policies\\' . class_basename($modelClass) . 'Policy';
        });
        $this->registerPolicies();
    }
}
