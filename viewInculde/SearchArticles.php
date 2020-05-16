<?php

function SearchArticles (){
    ?>
    <section>
        <div class="profile profile-long">
            <div class="profile__image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/567707/dog.png" alt="Doggo"></div>
            <div class="profile__info">
                <h2>Titre de l'article</h2>
                <p class="profile__info__extra">Une bonne description de taille respectable et toujours une bonne acroche pour l'information</p>
            </div>
            <div class="profile__stats">
                <p class="profile__stats__title">Like</p>
                <h5 class="profile__stats__info">28</h5>
            </div>
            <div class="profile__stats">
                <p class="profile__stats__title">Commentaire</p>
                <h5>10</h5>
            </div>
            <div class="profile__stats">
                <a class="button">Suprimer</a>
            </div>
            <div class="profile__cta"><a class="button">Lire l'article</a></div>
        </div>
    </section>
<?php
}