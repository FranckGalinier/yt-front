<?php

namespace App\Controller;

use App\Entity\Download;
use App\Form\DownloadType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
  
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        $yt = new Download();
        $form = $this->createForm(DownloadType::class, $yt);
        $form->handleRequest($request);
            
        if ($form->isSubmitted() && $form->isValid()) {
            $yt->setTelecharger(false);
            $this->entityManager->persist($yt);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $form->createView(),
        ]);
    }
}
