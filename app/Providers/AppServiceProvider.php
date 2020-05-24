<?php

namespace App\Providers;

use App\Services\Shift\ShiftSalary\ShiftSalaryCalculator;
use App\Services\Shift\ShiftSalary\ShiftSalaryCalculatorInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ShiftSalaryCalculatorInterface::class,
            ShiftSalaryCalculator::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
