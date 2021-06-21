<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test/{nom}", name="test")
     */
    public function index(string $nom): Response
    {
        $taille = strlen($nom);
        return $this->render('test/index.html.twig', [
            'nom' => $nom,
            'taille' => $taille
        ]);
    }
    /** 
    * @Route("/nv-page/{nom}", name="nv-page") 
     */
    // nv-page == URI 
    public function nvPage(string $nom): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Hello '. $nom . ' Your lucky number: ' . $number . '</body></html>'
        );
    }
    /**
     * @Route("/nouvelle-action/{nom}", name="nouvelle-action")
     */
    // taper le nom de l'URI et pas la fonction
    public function nouvelleAction(string $nom): Response
    {
        return new Response(
            '<html><body><h1>' . $nom .'</h1></body></html>'
        );
    }
    /**
     * @Route("/tester/{nom}/{min}", name="tester")
     */
    public function tester(string $nom, int $min): Response
    {
        $taille = strlen($nom);
        return $this->render("test/index.html.twig", [
            'nom' => $nom,
            'min' => $min,
            'taille' => $taille
        ]);
    }
}
