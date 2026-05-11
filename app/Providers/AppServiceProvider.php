<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositeries\StudentRepositry;
use App\Repositeries\TeacherRepositry;
use App\Repositeries\AdminRepositry;
use App\Services\AdminService;
use App\Services\StudentService;
use App\Services\TeacherService;
use App\Interfaces\CommonInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

public function boot()
{
    // Teacher
    $this->app->when(TeacherService::class)
        ->needs(CommonInterface::class)
        ->give(TeacherRepositry::class);

    // Student
    $this->app->when(StudentService::class)
        ->needs(CommonInterface::class)
        ->give(StudentRepositry::class);

    // Admin
    $this->app->when(AdminService::class)
        ->needs(CommonInterface::class)
        ->give(AdminRepositry::class);
}
}
