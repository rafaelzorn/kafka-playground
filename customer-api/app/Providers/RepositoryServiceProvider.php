<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Address\AddressRepository;
use App\Repositories\Address\Contracts\AddressRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
    }
}
