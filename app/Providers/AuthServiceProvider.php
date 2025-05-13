<?php
use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
public function boot()
{
    $this->registerPolicies();

    // Define gates
    Gate::define('access-admin', function ($user) {
        return $user->role === 'admin';
    });

    Gate::define('manage-students', function ($user) {
        return in_array($user->role, ['admin', 'teacher']);
    });

    Gate::define('view-dashboard', function ($user) {
        return $user->role !== 'student'; // Only admin and teacher can view dashboard
    });
}
protected $policies = [
    Student::class => StudentPolicy::class,
];
}
