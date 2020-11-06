<?php

namespace App\Controller;

use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(PersonRepository $personRepository): Response
    {

        $persons = $personRepository->findAll();


        return $this->render('person/index.html.twig', compact('persons'));
    }

    

}
