<?php

namespace App\Command;

use App\Service\WeatherUtil;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'weather:city',
    description: 'Shows the weather forecast for a country and city',
)]
class WeatherCityCommand
{
    public function __construct(private readonly WeatherUtil $weatherUtil)
    {
    }

    public function __invoke(
        SymfonyStyle $io,
        #[Argument('Country code')] string $countryCode,
        #[Argument('City name')] string $city,
    ): int {
        $measurements = $this->weatherUtil->getWeatherForCountryAndCity($countryCode, $city);
        $io->writeln(sprintf('Location: %s', $city));
        $io->table(['Date', 'Temperature'], array_map(fn($m) => [
            $m->getMeasuredAt()->format('Y-m-d'),
            $m->getTemperature(),
        ], $measurements));

        return Command::SUCCESS;
    }
}
