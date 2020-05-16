<?php
session_start();
require 'vendor/autoload.php';
use ViewController\ArticleController;
use ViewController\CommentaryController;

function returnBack(){
    header('Status: 301 redirection permanente', false, 301);
    header('Location: '.$_SESSION['URL']);
    exit();
}

$articleController = New ArticleController();
if(isset($_GET['id'])){
    $article = $articleController->getArticle($_GET['id']);
    if(get_class($article)==="Exception"){
        $_SESSION['error'] = $article->getTraceAsString();
        returnBack();
    }
}else{
    returnBack();
}
?>
<?php include('Template/head.php') ?>
<body>
<!-- partial:index.partial.html -->
<?php include('Template/loginBox.php');?>
<?php
if(isset($_SESSION['error']))include ('Template/errorModal.php')?>
<div class="interactive">
    <?php include('Template/nav.php') ?>
    <div>
        <section>
            <main>
                <div class="mainContainer" style="width: 80%;max-width: none">
                    <h1><?php echo $article->getTitle()?></h1>
                    <div>
                        <div class="topbarContainer">
                            <i class="fas fa-heart"></i>
                        </div>
                    </div>
                    <p><?php echo $article->getIntroduction()?></p>
                    <p><?php echo $article->getContent()?></p>
                    <h2>Comentaires</h2>
                    <hr>
                    <form style="margin-bottom: 40px" method="post" action="./App/Controller/action.php?action=addComment">
                        <input type="hidden" name="idArticle" value="<?php echo $article->getIdArticle()?>">
                        <textarea name="comment"></textarea>
                        <button>Envoyer</button>
                    </form>
                    <div style="max-width: none;width: 100%">
                        <?php
                        $commentController = new CommentaryController();
                        $commentController->displayAllArticleComment($article->getIdArticle());
                        ?>
                    </div>
            </main>
        </section>
    </div>
    <footer>
        <nav>
            <ul>
                <li><a href="#">Articles</a></li>
                <li><a href="#">Compte Rendu</a></li>
                <li><a href="#">Se Connecter</a></li>
            </ul>
        </nav>
    </footer>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="./script.js"></script>
</body>
</html>
