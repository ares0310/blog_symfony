<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController
{

    private $repoArticle;

    public function __construct(ArticleRepository $repoArticle){
        $this->repoArticle = $repoArticle;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles= $this-> repoArticle->findAll(); // recup tous articles de la table article

        return $this->render('home/index.html.twig',[
            "articles"=>$articles
        ]);
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id): Response
    {
        $article=$this -> repoArticle->find($id);
        if(!$article){
            return $this->redirectToRoute("home",[
            ]); // redirige vers "home" peu importe quel url porte la route de home "/accueil/" ou "/home/" ou "/" tout simplement 
        }

        return $this->render("home/show.html.twig",[
            "article" => $article
            ]);
    }
}
