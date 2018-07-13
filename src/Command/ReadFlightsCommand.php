<?php

namespace App\Command;

use App\FlightObject\Flight;
use App\Repository\FlightRepositoryInterface;
use App\Service\FlightClaimabilityService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ReadFlightsCommand extends Command
{
    /**
     * @var FlightRepositoryInterface
     */
    private $repository;
    /**
     * @var FlightClaimabilityService
     */
    private $service;

    /**
     * ReadFlightsCommand constructor.
     *
     * @param FlightRepositoryInterface $repository
     * @param FlightClaimabilityService $service
     */
    public function __construct(FlightRepositoryInterface $repository, FlightClaimabilityService $service)
    {
        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    protected function configure()
    {
        $this->setName('flight:read')
            ->setDescription('Reads flight data and makes a decision about claimability')
            ->addArgument('source', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $source = $input->getArgument('source');
        $flights = $this->repository->getAll($source);

        foreach ($flights as $flight)
        {
            /**
             * @var Flight $flight
             */
            $prediction = $this->service->predict($flight);

            if($prediction){
                $this->outputSuccess($output, $flight);
            }
            else {
                $this->outputFailure($output, $flight);
            }
        }

    }

    private function outputFailure(OutputInterface $output, Flight $flight)
    {
        $this->outputTitle($output, $flight);
        $output->writeln('N');
    }

    private function outputSuccess(OutputInterface $output, Flight $flight)
    {
        $this->outputTitle($output, $flight);
        $output->writeln('Y');
    }

    /**
     * @param OutputInterface $output
     * @param Flight $flight
     */
    private function outputTitle(OutputInterface $output, Flight $flight)
    {
        $country = $flight->getCountry();
        $details = $flight->getDetails();
        $reason = '-';

        switch ($flight->getStatus())
        {
            case Flight::STATUS_DELAY:
                $reason = 'Delay';
                break;
            case Flight::STATUS_CANCEL:
                $reason = 'Cancel';
                break;
        }
        $output->write($country.' '.$reason.' '.$details.' ');
    }
}