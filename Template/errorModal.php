<div class="modal show">
    <div class="overlay"></div>
    <div class="modalContainer" style="width: 60vw">
            <div>
                <h2>Erreur</h2>
                <textarea readonly><?php echo $_SESSION['error'] ?></textarea>
            </div>
            <button onclick="" class="close">Fermer</button>
    </div>
</div>
<?php
//supretion de la variable de session error pour ne pas la réaficher à chaque fois
unset($_SESSION['error']);