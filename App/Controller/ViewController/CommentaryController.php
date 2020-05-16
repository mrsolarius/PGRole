<?php


namespace ViewController;


use DBController\DBConnection;
use DBController\Delete;
use DBController\Insert;
use DBController\Select;
use Exception;
use Model\Comentary;
use RuntimeException;

class CommentaryController
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * CommentaryController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $c = new DBConnection();
        $this->pdo = $c->connect();
    }

    /**
     *function deleteComment
     * permet de supprimer un commentaire sur appel d'un methode get (set de passerelle entre la BDD et la vue)
     * @return void
     */
    public function deleteComment(){
        $con = new DBConnection();
        $d = new Delete($this->pdo);
        $d->deleteComentary((int)$_GET['idComment'],(int)$_GET['idArticle']);
    }
    /**function addArticle
     * Permet d'ajouter un comentaire
     * @return void
     */
    public function addComentary(){
        $comment = $_POST['comment'];
        $article = $_POST['idArticle'];
        //récupération du login de si l'utilisateur connecter
        if (isset($_SESSION['LOGIN'])){
            $login = $_SESSION['LOGIN'];
        }
        else {
            //si il n'est pas definit il faudrais renvoyer une exception
            //mais vu que l'on veut tester les droit on mes juste une chaine vide pour obtenir l'erreur SQL
            $login = "";
        }
        $article = (int)$article;
        $insert = new Insert($this->pdo);
        $insert->addComentary($login,$article,$comment);
    }

    /**function displayAllArticleComment
     * fonction d'affichage de tous les comentaire inclut directement du code html
     * @return void
     */
    public function displayAllArticleComment($id){
        $select = new Select($this->pdo);
        foreach ($select->getCommentarys($id) as $commentary){
            $this->displayCommentBox($commentary);
        }
    }
    /**
     * function displayCommentBox
     * permet d'afficher un commentaire et remplit automatiquement avec l'objet commentary
     * @param Comentary $comment
     */
    public function displayCommentBox(Comentary $comment){
        ?>
        <div class="profile profile-table">
            <div class="profile__info">
                <h3><?php echo $comment->getUser()->getName().' '.$comment->getUser()->getSurname()?></h3>
                <span><?php echo $comment->getUser()->getRoleName()?></span>
                <p class="profile__info__extra"><?php echo $comment->getComment() ?></p>
            </div>
            <div class="profile__cta">
                <a class="button"
        href="./App/Controller/action.php?action=delComment&idComment=<?php echo $comment->getIdComment()?>&idArticle=<?php echo $comment->getArticle()->getIdArticle() ?>">Supprimer
                </a>
            </div>
        </div>
        <?php
    }

}