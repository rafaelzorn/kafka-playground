<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Services\Address\AddressService;
use App\Services\Address\Contracts\AddressServiceInterface;
use App\Services\ExternalConsultAddress\ViaCepService;
use App\Services\ExternalConsultAddress\Contracts\ExternalConsultAddressServiceInterface;

class ServiceServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(AddressServiceInterface::class, AddressService::class);
        $this->app->bind(ExternalConsultAddressServiceInterface::class, ViaCepService::class);
    }
}
