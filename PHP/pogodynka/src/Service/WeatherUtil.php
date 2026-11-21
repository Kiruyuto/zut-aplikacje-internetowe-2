<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Location;
use App\Entity\Measurement;
use App\Repository\LocationRepository;
use App\Repository\WeatherMeasurementRepository;

class WeatherUtil
{
    public function __construct(
        private readonly WeatherMeasurementRepository $weatherMeasurementRepository,
        private readonly LocationRepository $locationRepository,
    ) {
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForLocation(Location $location): array
    {
        return $this->weatherMeasurementRepository->findByLocation($location);
    }

    /**
     * @return Measurement[]
     */
    public function getWeatherForCountryAndCity(string $countryCode, string $city): array
    {
        $location = $this->locationRepository->findOneBy([
            'country' => $countryCode,
            'city' => $city,
        ]);

        return $location === null ? [] : $this->getWeatherForLocation($location);
    }
}
