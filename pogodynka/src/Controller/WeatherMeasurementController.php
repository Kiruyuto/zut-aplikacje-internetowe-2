<?php

namespace App\Controller;

use App\Entity\WeatherMeasurement;
use App\Form\WeatherMeasurementType;
use App\Repository\WeatherMeasurementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/weather/measurement', priority: 1)]
final class WeatherMeasurementController extends AbstractController
{
    #[Route(name: 'app_weather_measurement_index', methods: ['GET'])]
    public function index(WeatherMeasurementRepository $weatherMeasurementRepository): Response
    {
        return $this->render('weather_measurement/index.html.twig', [
            'weather_measurements' => $weatherMeasurementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_weather_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $weatherMeasurement = new WeatherMeasurement();
        $form = $this->createForm(WeatherMeasurementType::class, $weatherMeasurement, [
            'validation_groups' => 'create',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($weatherMeasurement);
            $entityManager->flush();

            return $this->redirectToRoute('app_weather_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weather_measurement/new.html.twig', [
            'weather_measurement' => $weatherMeasurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weather_measurement_show', methods: ['GET'])]
    public function show(WeatherMeasurement $weatherMeasurement): Response
    {
        return $this->render('weather_measurement/show.html.twig', [
            'weather_measurement' => $weatherMeasurement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_weather_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WeatherMeasurement $weatherMeasurement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WeatherMeasurementType::class, $weatherMeasurement, [
            'validation_groups' => 'edit',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_weather_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('weather_measurement/edit.html.twig', [
            'weather_measurement' => $weatherMeasurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weather_measurement_delete', methods: ['POST'])]
    public function delete(Request $request, WeatherMeasurement $weatherMeasurement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weatherMeasurement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($weatherMeasurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_weather_measurement_index', [], Response::HTTP_SEE_OTHER);
    }
}
