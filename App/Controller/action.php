<?php
session_start();

require '../../vendor/autoload.php';

use DBController\DBConnection;
use DBController\Delete;
use ViewController\CommentaryController;
use ViewController\LoginController;
use ViewController\ArticleController;

/**
 * le fichier action.php permet de faire l'interface entre les vue et les controller
 * il choisie entre toutes les action possible par le biez d'un get
 * puis en fonction de celui ci il tranpher au controller ocnsernet la requette
 *
 * a la fin de chaque traitement il effectue une redirection sur la page précédente
 * grace à la variable de session url
 *
 * si une exeption et découverte alors il la stock dans la variable de session
 * cette erreur sera ensuite afficher dans les autre vue
 */
if(isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'login' :
            $login = new LoginController();
            try {
                $login->loginCheck();
            } catch (RuntimeException $exception) {
                $_SESSION['error'] = $exception;
            }
            break;
        case 'logout':
            $login = new LoginController();
            $login->logOut();
            break;
        case 'addArticle':
            $article = new ArticleController();
            try {
                $article->addArticle();
            } catch (RuntimeException $exception) {
                $_SESSION['error'] = $exception;
            }
            break;

        case 'delArticle':
            $article = new ArticleController();
            try {
                $article->deleteArticle();
            } catch (RuntimeException $exception) {
                $_SESSION['error'] = $exception;
            }
            break;
        case 'addComment':
            $comment = new CommentaryController();
            try {
                $comment->addComentary();
            } catch (RuntimeException $exception) {
                $_SESSION['error'] = $exception;
            }
            break;
        case 'delComment':
            $comment = new CommentaryController();
            try {
                $comment->deleteComment();
            }catch (RuntimeException $exception) {
                $_SESSION['error'] = $exception;
            }
            break;
    }
}

//redirection vers la page précédente avec un statu code 301 (redirection permanante)
header('Status: 301 redirection permanente', false, 301);
header('Location: '.$_SESSION['URL']);
exit();