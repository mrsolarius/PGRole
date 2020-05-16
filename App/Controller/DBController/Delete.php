<?php

namespace DBController;



use http\Encoding\Stream;
use Exception;

class Delete
{

    /**
     * PDO object
     * @var \PDO
     */
    private \PDO $pdo;

    /**
     * initalisation de l'objet avec PDO
     * @param \PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * DeleteArticle
     * Permet de supprimer de la BDD un article dans à partir de sont id
     * @param String $idArticle
     * @return void|Exception
     */
    public  function  deleteArticle (String $idArticle){
        //requette de suprettion (necéside un delete cascade sur comentary et write)
        $sql = 'DELETE FROM Articles WHERE id_article = :id';

        //préparation de la requette
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $idArticle);

        //Execution de la requette
        $stmt->execute();
    }

    /**
     * deleteComentary
     * Permet de supprimer de la BDD un comentaire à partir de sont id et de l'id de l'article
     * @param $idComentary
     * @param $idArticle
     * @return void|Exception
     */
    public function deleteComentary($idComentary,$idArticle){
        //requette de suprettion (necéside un delete cascade sur discuss)
        $sql = 'DELETE FROM commentary WHERE id_article = :idArticle and id_comment = :idComment';

        //préparation de la requette
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idArticle', $idArticle);
        $stmt->bindValue(':idComment', $idComentary);

        //execution de la requette
        $stmt->execute();
    }
}
