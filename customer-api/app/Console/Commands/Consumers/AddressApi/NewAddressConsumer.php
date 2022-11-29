<?php

namespace App\Console\Commands\Consumers\AddressApi;

use Illuminate\Console\Command;
use Exception;
use App\Repositories\Address\Contracts\AddressRepositoryInterface;
use App\Messaging\Contracts\ConsumerInterface;
use App\Constants\TopicConstant;

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
     * @param AddressRepositoryInterface $addressRepository
     * @param ConsumerInterface $consumer
     *
     */
    public function __construct(
        private AddressRepositoryInterface $addressRepository,
        private ConsumerInterface $consumer
    )
    {
        $this->addressRepository = $addressRepository;
        $this->consumer          = $consumer;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $newAddresses = $this->consumer->getMessages(TopicConstant::NEW_ADDRESS);

            foreach ($newAddresses as $newAddress) {
                $zipCode = intval(preg_replace('/\D/', '', $newAddress['zip_code']));

                unset($newAddress['zip_code']);

                $this->addressRepository->updateOrCreate(
                    ['zip_code' => $zipCode],
                    $newAddress
                );
            }

            return Command::SUCCESS;
        } catch (Exception $exception) {
            return Command::FAILURE;
        }
    }
}
