<?php

namespace App\Controller;

use App\Entity\Information;
use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods="GET")
     */
    public function index(PersonRepository $personRepository): Response
    {

        $persons = $personRepository->findAll();


        return $this->render('person/index.html.twig', compact('persons'));
    }

    /**
     * @Route("/create", name="app_person_create", methods="GET|POST")
     */
    public function create(EntityManagerInterface $em, Request $req): Response
    {

        $person = new Person;
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($person);
            $em->flush();

            $this->addFlash("succes", "New person successfuly added!");
            return $this->redirectToRoute("app_home");
        }

        return $this->render("person/create.html.twig", ["form"=>$form->createView()]);

    }

    /**
     * @Route("/edit/{id<[0-9]+>}", name="app_person_edit", methods="GET|POST")
     */
    public function edit(Person $person, EntityManagerInterface $em, Request $req): Response
    {

        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            return $this->redirectToRoute("app_home");
        }

        return $this->render("/person/edit.html.twig", ["form"=>$form->createView()]);

    }

/**
 * @Route("/{id<[0-9]+>}", name="app_person_delete", methods="DELETE")
 */
    public function delete(Request $req, EntityManagerInterface $em, Person $person)
    {

        if ($this->isCsrfTokenValid('person_delete_' .$person->getId(), $req->request->get('csrf_token'))) {

            
            $em->remove($person);
            $em->flush();

         }

        return $this->redirectToRoute("app_home");

    }

}
