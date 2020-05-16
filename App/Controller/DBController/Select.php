<?php

namespace DBController;

use Exception;
use Model\Article;
use Model\Comentary;
use Model\User;

class Select
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
     * Renvoie tous les utilisateurs et le hash de leur mdp
     * @return User[]
     * @throws Exception
     */
    public function getUsers(){
        //requette de selection des utilisateur ainci que des roles
        $stmt = $this->pdo->query('Select * from users inner join roles on roles.postgres_name = users.postgres_name;');

        $users = [];

        //parcours des utilisateur
        while ($row = $stmt -> fetch(\PDO::FETCH_ASSOC)){
            //création d'un nouvelle utilisateur à chaque itération
            $user = new User($row['login'],$row['password'],$row['name'],$row['surname'],$row['postgres_name'],$row['friendly_name']);
            $users [] = $user;
        }
        return  $users;
    }

    /**function getUser
     * Permet de récupérer un objet utilisateur dans la BDD à partir d'un login
     * @param $login
     * @return Exception|User
     */
    public function getUser($login){
        //requette de selection
        $sql = 'Select * from users inner join roles on roles.postgres_name = users.postgres_name where login =:login;';

        //préapration de la requette
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':login', $login);

        //ewecution
        $stmt->execute();

        //récupération de la première ligne
        $row = $stmt -> fetch(\PDO::FETCH_ASSOC);
        if ($row!==false) {
            //renvoie d'un objet utilisateur
            return new User($row['login'],$row['password'],$row['name'],$row['surname'],$row['postgres_name'],$row['friendly_name']);
        }else{
            //renvois d'une exeption si aucun utilisateur n'est trover
            return new Exception("Article non trouver");
        }
    }

    /**function getArticles
     * Renvoie tous les articles de la BDD sous forme d'objet
     * @return User[]
     * @throws Exception
     */
    public function getArticles(){
        //requette
        $stmt = $this->pdo->query('Select articles.id_article, title, introduction, articles.content,count(commentary.id_article) as nbcoment 
                                            from articles 
                                            full join commentary ON commentary.id_article = articles.id_article
                                            group by articles.id_article');

        $articles = [];

        //parcours des article puis conversion en objet
        while ($row = $stmt -> fetch(\PDO::FETCH_ASSOC)){
            $article = new Article($row['title'],$row['introduction'],$row['content']);
            $article->setIdArticle($row['id_article']);
            $article->setNbcomentary($row['nbcoment']);
            //ajout de l'article à la collection
            $articles [] = $article;
        }
        //renvoie de la colletion
        return  $articles;
    }

    /**
     * function getArticle
     * permet de renvoiyer un seul objet article à partir de sont identifiant
     * @param $id
     * @return Exception|Article
     */
    public function getArticle($id){
        //requete SLQ
        $sql='Select articles.id_article, title, introduction, articles.content,(select count(*) from commentary where id_article= :id)as nbcoment 
              from articles 
              where articles.id_article = :id';

        //préparation de la requette
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id);

        //execution
        $stmt->execute();

        //récupération de la première ligne
        $row = $stmt -> fetch(\PDO::FETCH_ASSOC);
        if ($row!==false) {
            //génération de l'objet à renvoyer
            $article = new Article($row['title'], $row['introduction'], $row['content']);
            $article->setIdArticle($row['id_article']);
            $article->setNbcomentary($row['nbcoment']);
            return $article;
        }else{
            //renvois d'une exeption si aucun acticle n'est trover
            return new Exception("Article non trouver");
        }
    }

    /**function getCommentarys
     * Permet de récupérer tous les commentaire d'un article
     * @param $idArticle
     * @return Comentary[]
     */
    public function getCommentarys($idArticle){
        //requette de selection des commentaire des utililisateur et de l'article associer
        $sql = 'select *
                from commentary
                inner join discuss on discuss.id_article = commentary.id_article 
                and discuss.id_comment = commentary.id_comment
                inner join users on discuss.login = users.login
                where commentary.id_article = :idarticle';

        //préparation de la requette
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idarticle', $idArticle);
        $stmt->execute();

        $commentary = [];

        //parcoure du tableau renvoyer
        while ($row = $stmt -> fetch(\PDO::FETCH_ASSOC)) {
            //génération de chaque objet associer à un comentarie
            $article = $this->getArticle($row['id_article']);
            $user = $this->getUser($row['login']);
            $comment = new Comentary($row['content'],$user,$article);
            $comment->setIdComment($row['id_comment']);
            //ajout du comentaire à la collection de commentaire
            $commentary[] = $comment;

        }
        //renvois des commentaire
        return $commentary;
    }
}