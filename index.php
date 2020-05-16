<?php include('Template/head.php') ?>
<body>
<!-- partial:index.partial.html -->
<?php include('Template/loginBox.php');?>
<?php

require 'vendor/autoload.php';
use ViewController\ArticleController;
?>
<?php
if(isset($_SESSION['error']))include ('Template/errorModal.php')?>
<div class="modal">
    <div class="overlay"></div>
    <div class="modalContainer" style="width: 60vw">
        <form action="./App/Controller/action.php?action=addArticle" method="post">
            <div>
                <h2>Titre de l'article</h2>
                <input type="text" name="title"></input>
            </div>
            <div>
                <h3>Description</h3>
                <textarea style="height: 100px" name="introduction"></textarea>
            </div>
            <div>
                <h3>Article</h3>
                <textarea style="height: 280px" name="content"></textarea>
            </div>


            <div class="footer" style="background-color: white;">
                <button type="submit">Enregistrer</button>
                <button onclick="" class="close">Anuler</button>
            </div>
        </form>
    </div>
</div>
<div class="interactive">
   <?php include('Template/nav.php') ?>
   <section>
      <main>
         <div class="mainContainer">
               <h1>Les Articles !</h1>
               <div class="topbarContainer">
               <a id="showPopup"><i class="fas fa-plus"></i></a>
               </div>
            <p>Retrouver ici tous les article de la base de donnée</p>
             <?php
                $displayArticle = new ArticleController();
                $displayArticle->displayAllArticle();?>
         </div>
      </main>
   </section>

    <?php
    include('Template/footer.php')
    ?>
</div>
</body>
</html>
