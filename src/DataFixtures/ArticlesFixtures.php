<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Article; 

// On crée la classe "ArticlesFixtures" qui hérite de "Fixture" avec la commande : 
// php bin/console make:fixtures
// Cette commande crée le fichier : src/DataFixtures/ArticlesFixtures.php

class ArticlesFixtures extends Fixture
{
    // On a une fonction load qui va recevoir un "manager".  
    public function load(ObjectManager $manager)
    {
        // On va créer une boucle qui va créer dix articles.
        for($i = 1 ; $i <= 10;  $i++){
            // On instancie une classe article
            // Pour cela, nous devons avoir écrit "use App\Entity\Article;" au début de notre fichier 
            $article = new Article();

            // On renseigne le titre et le contenu des articles
            // On peut enchainer les méthodes set
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Contenu de l'article n°$i </p>")
                    ->setImage("http://placehold.it/350x150")
                    ->setCreatedAt(new \DateTime());
                    
                    // Il faut préparer le manager à faire persister dans le temps
                    $manager->persist($article);
        }
        // La méthode flush() envoie réellement les données à la base de données  
        $manager->flush();
    }
}
