<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\VehicleRepository;

class VehicleController extends AbstractController
{
    // #[Route('/vehicle', name: 'app_vehicle')]
    // public function index(): JsonResponse
    // {
    //     return $this->json([
    //         'message' => 'Welcome to your new controller!',
    //         'path' => 'src/Controller/VehicleController.php',
    //     ]);
    // }


    #[Route('/', name: 'vehicle_index', methods: ['GET', 'POST'])]
    public function index(Request $request, VehicleRepository $vehicleRepository): Response
    {
        $searchTerm = $request->query->get('search');
        $vehicles = $vehicleRepository->findBySearchTerm($searchTerm);

        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $vehicles,
            'searchTerm' => $searchTerm,
        ]);
    }


    #[Route('/new', name: 'vehicle_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_index');
        }

        return $this->render('vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'vehicle_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_index');
        }

        return $this->render('vehicle/edit.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'vehicle_delete', methods: ['POST'])]
    public function delete(Request $request, Vehicle $vehicle, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $vehicle->getId(), $request->request->get('_token'))) {
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vehicle_index');
    }
}
