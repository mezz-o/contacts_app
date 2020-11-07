<?php

namespace App\Controller;

use App\Entity\Information;
use App\Entity\Person;
use App\Form\InformationType;
use App\Form\PersonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformationController extends AbstractController
{
  

    /**
     * @Route("/information/create", name="app_information_create", methods="GET|POST")
     */
    public function create(Person $person, Request $req, EntityManagerInterface $em): Response
    {
        $information = new Information();
        dd($information->setPersonInformation($person));
        $form = $this->createForm(InformationType::class, $information);

        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($information);
            $em->flush();

            return $this->redirectToRoute("app_home");
        }

        return $this->render("/information/create.html.twig", ["form"=>$form->createView()]);
    }
}
