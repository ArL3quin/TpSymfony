<?php

namespace App\Controller;


use App\Entity\Formulaire;
use App\Form\FormType;
use App\Repository\FormulaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormulaireController extends AbstractController
{

    public function __construct(FormulaireRepository $formulaireRepository){

        $this->FormulaireRepository = $formulaireRepository;
    }

    /**
     * @Route("/formulaire", name="formulaire")
     */
    public function index(Request $request): Response
    {

        $name = $request->query->get('name');
        $formulaire = new Formulaire();
        $form = $this->CreateForm(FormType::class , $formulaire);
        $form ->handleRequest($request);



        dump($form->getViewData());

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($form->getData());
            $entityManager->flush();

        }


        return $this->renderForm('formulaire/index.html.twig',[
            'controller_name' => "Controller de formulaire" ,
            'form' => $form ,
            'formulaires' => $this->FormulaireRepository->findAll() ,
            'name' => $name

        ]);
    }
}
