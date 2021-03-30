<?php

namespace App\Controller;

use App\Entity\Article; // Pour utilier la classe Article dans notre Controller  
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// La classe BlogController hérite d'une autre classe AbstractController
class BlogController extends AbstractController
{
    // Un commentaire qui commence par un arobase est une annonation
    // La route s'écrit entre guillemets (doubles quotes)
    // Une route doit avoir un nom (name)   
    /**
     * @Route("/blog", name="blog")
     */
    // Le but de cette fonction "index" est de traiter la demande et de renvoyer une réponse
    // La réponse consiste en afficher un fichier HTML qui s'appelle index.html.twig et
    // qui se trouve dans le dossier blog.
    
    public function index(): Response
    {
        // Pour accèder aux données on crée la variable "repo"
        // qui va communiquer avec Doctrine pour demander un repository qui gère l'entité Article
        // "repo" va accèder aux Articles 
        $repo =  $this->getDoctrine()->getRepository(Article::class);

        // $article = $repo->find(12); // Pour rechercher un article par "id"
        // $article = $repo->findOneByTitle('Titre de l\'article'); // Pour rechercher un article par "title"

        $articles = $repo->findAll(); // Pour rechercher tous mes articles 

        // $this->render() permet d'appeler un fichier twig
        // Le premier paramètre que prend render() est une 'view', le fichier twig à afficher
        // Nous allons passer à twig l'ensemble de mes articles
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    /**
     * @Route ("/")
     */
    // On crée une public fonction home()
    // On la relie avec la route "/"
    // Nous devons créer le fichier home.html.twig dans notre dossier blog pour que cela fonctionne
    public function home() {
        return $this->render('blog/home.html.twig', [
            'title' => "Bienvenue ici les amis !!! ",
            'age' => 29
        ]);
    }

    /**
     *
     * @Route("/blog/{id}", name="blog_show")
     */
    // On passe $id à la fonction show()  
    public function show($id) {
        // On crée une variable $repo qui communique avec Doctrine et on lui demande le repository Article 
        $repo = $this->getDoctrine()->getRepository(Article::class);

        // On demande de trouver l'article qui a l'identifiant $id passé en argument  
        $article = $repo->find($id);

        // On passe à twig un tableau des variables que je veux qu'il utilise 
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
}
