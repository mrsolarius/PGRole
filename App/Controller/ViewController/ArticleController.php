<?php

namespace ViewController;

use DBController\DBConnection;
use DBController\Delete;
use DBController\Insert;
use DBController\Select;
use Exception;
use Model\Article;
use RuntimeException;


class ArticleController{
    /**
     * @var \Model\Article[]
     */
    private $articles;
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * ArticleController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $c = new DBConnection();
        $this->pdo = $c->connect();
        $select = new Select($this->pdo);
        $this->articles=$select->getArticles();
    }

    /**
     * function getArticle
     * Permet de récupérer un article dans la BDD (sert de passerelle entre la vu et la BDD)
     * @param $id
     * @return Exception|Article
     */
    public function getArticle($id){
        $select = new Select($this->pdo);
        return $this->articles=$select->getArticle($id);
    }

    /**function addArticle
     * Permet d'ajouter un article
     * @return void
     */
    public function addArticle(){
        //récupération du login de si l'utilisateur connecter
        if (isset($_SESSION['LOGIN'])) {
            $login = $_SESSION['LOGIN'];
        }else{
            //si il n'est pas definit il faudrais renvoyer une exception
            //mais vu que l'on veut tester les droit on mes juste une chaine vide
            $login = "";
        }
            $title = $_POST['title'];
            $introduction = $_POST['introduction'];
            $content = $_POST['content'];

            $article = new Article($title, $introduction, $content);

            $insert = new Insert($this->pdo);
            $insert->addArticle($login,$article);
            return;

        throw new RuntimeException("Veuillez vous connecter");
    }

    /**
     * fonction deleteArticle
     * permet de supprimer un article sur l'appel d'un formulaire
     * @return void
     */
    public function deleteArticle(){
        $con = new DBConnection();
        $d = new Delete($this->pdo);
        $d->deleteArticle($_GET['id']);
    }

    /**function displayAllArticle
     * fonction d'affichage de tous les article includant directement du code html
     * @return void
     */
    public function displayAllArticle(){
        foreach ($this->articles as $article){
            //apelle de la fonction de génération d'une boite d'article
            $this->displayArticleBox($article);
        }
    }


    /**
     * function displayArticleBox
     * permet d'afficher une previous d'article et remplit automatiquement avec l'objet article
     * @param Article $article
     */
    private function displayArticleBox(Article $article)
    {
        ?>
        <section>
            <div class="profile profile-long">
                <div class="profile__image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/567707/dog.png"
                                                 alt="Doggo"></div>
                <div class="profile__info">
                    <h2><?php echo $article->getTitle() ?></h2>
                    <p class="profile__info__extra"><?php echo $article->getIntroduction() ?></p>
                </div>
                <div class="profile__stats">
                    <p class="profile__stats__title">Commentaire</p>
                    <h5><?php echo $article->getNbcomentary() ?></h5>
                </div>
                <div class="profile__stats">
                    <a class="button" href="./App/Controller/action.php?action=delArticle&id=<?php echo $article->getIdArticle() ?>">Suprimer</a>
                </div>
                <div class="profile__cta"><a class="button" href="./article.php?id=<?php echo $article->getIdArticle() ?>">Lire l'article</a></div>
            </div>
        </section>
        <?php
    }
}
