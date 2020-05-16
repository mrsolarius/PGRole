<?php

namespace DBController;


use Exception;
use Model\Article;
use Model\Comentary;
use Model\User;

class Insert
{

    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * initalisation de l'objet avec PDO
     * @param type $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Fonction addArticle
     * Permet d'ajouter a la BDD un article à partir de l'objet article et du login de l'utilisateur actif
     * @param String $login
     * @param Article $article
     * @return void|Exception
     */
    public function addArticle(String $login, Article $article){
        //requette d'insertion dans article
        $sql = 'INSERT INTO articles(title,introduction,content) VALUES(:title,:introduction,:content)';
        $stmt = $this->pdo->prepare($sql);

        // passage des valeur au statement
        $stmt->bindValue(':title', $article->getTitle());
        $stmt->bindValue(':introduction', $article->getIntroduction());
        $stmt->bindValue(':content', $article->getContent());

        // execution de la requette
        $stmt->execute();

        // recupération de l'id de l'article
        $idArticle = $this->pdo->lastInsertId();

        //requette d'insertion dans writte
        $sql = 'INSERT INTO write(login,id_article) VALUES(:login,:id)';

        //préparation de la requette
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':id', $idArticle);

        //execution de la requette
        $stmt->execute();
    }

    /**
     * Function addComentary
     * Permet d'ajouter à la BDD un commentaire sur un article
     * @param String $login
     * @param int $idArticle
     * @param String $comment
     */
    public function addComentary(String $login,int $idArticle,String $comment){
        //requette d'insertion du commentaire
        $sql = 'INSERT INTO commentary(id_article,content) VALUES(:idArticle,:content)';
        $stmt = $this->pdo->prepare($sql);

        // passage des valeur au statement
        $stmt->bindValue(':idArticle', $idArticle);
        $stmt->bindValue(':content', $comment);

        // execution de la requette
        $stmt->execute();

        // recupération de l'id du commentaire
        $idComentaire = $this->pdo->lastInsertId('commentary_id_comment_seq');


        //requette d'insertion de la personne ayant ecrit le commentaire (j'aurais du mettre sa en clef étrangérer de commentary mais j'ai plus le temps de modifier)
        $sql = 'INSERT INTO discuss(login,id_article,id_comment) VALUES(:login,:idArticle,:idComment)';
        $stmt = $this->pdo->prepare($sql);

        // passage des valeur au statement
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':idArticle', $idArticle);
        $stmt->bindValue(':idComment', (int) $idComentaire);

        // execution de la requette
        $stmt->execute();
    }
}