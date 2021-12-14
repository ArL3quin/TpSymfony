<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FormulaireRepository;

class ContactController extends AbstractController
{
    public function __construct(FormulaireRepository $formulaireRepository){

        $this->FormulaireRepository = $formulaireRepository;
    }
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request): Response
    {
        $name = $request->query->get('name');
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'name' => $name,
            'contact' => $this->FormulaireRepository->find($name) ,
        ]);
    }
}
