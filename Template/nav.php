<header>
    <nav>
        <a href="#" class="logo"><?php
            if (isset($_SESSION['LOGIN'])){
                echo $_SESSION['ROLENAME'];
            }else{
                echo 'TP SLAM3';
            }?>
        </a>
        <ul class="main-nav">
            <li><a href="./index.php">Articles</a></li>
            <li><a href="./rapport.php">Compte Rendu</a></li>
            <?php
            if (isset($_SESSION['LOGIN'])) {
                ?>
                <li><a href="#" class="loginButton"><?php echo  $_SESSION['NAME'].' '.$_SESSION['SURNAME']?></a></li>
                <li><a href="./App/Controller/action.php?action=logout">Se Deconecter</a></li>
                <?php
            }else {
                ?>
                <li><a href="#" class="loginButton">Se conecter</a></li>
                <?php
            }
            ?>
        </ul>
    </nav>
</header>
