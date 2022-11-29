<?php

namespace App\Console\Commands\Consumers\AddressApi;

use Illuminate\Console\Command;

class NewAddressConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consume:address-api.new-address';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume Kafka messages from "address-api.new-address".';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
