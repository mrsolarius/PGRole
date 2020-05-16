<?php include('Template/head.php') ?>
<body>
<?php include('Template/loginBox.php');?>
<?php
if(isset($_SESSION['error']))include ('Template/errorModal.php')?>
<div class="interactive">
    <?php include('Template/nav.php') ?>
    <div>
        <section>
            <main>
                <div class="mainContainer" style="width: 80%;max-width: none">
                    <h1>Compte Rendu</h1>
                    <h2>Introduction</h2>
                    <p>Le but de ce TP et de mettre en partique nos conaissence quise sur la gestion des droit sur postgres SQL. Dans ce but notre professeur nous &agrave; placer dans la situation d'un site de presse ou de bloging ou ce trouve plusieur type d'utilisateur qui on chacun leur droit distinct :&nbsp;</p>
                    <table style="background-color: #f9f9f9;">
                        <thead>
                        <tr style="background-color: #6453f7;">
                            <td>
                                <h4><span style="color: #ffffff;">Role</span></h4>
                            </td>
                            <td>
                                <h4><span style="color: #ffffff;">Description</span></h4>
                            </td>
                            <td>
                                <h4><span style="color: #ffffff;">Permision</span></h4>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="background-color: #f9f9f9;">
                            <td>Utilisateur</td>
                            <td>Un utilisateur classique ne se connecte pas il n'a donc q'un seul droit celui de consultation</td>
                            <td>Consulatation&nbsp;</td>
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                            <td>Utilisateur Authentifier</td>
                            <td>Cette utilisateur et un peut plus r&eacute;gulier il a donc du fait de sont enregistrement dans la base de donn&eacute;e la possibliter de commenter</td>
                            <td>
                                <p>Consulation</p>
                                <p>Insertion de commentaire</p>
                            </td>
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                            <td>Mod&eacute;rateur</td>
                            <td>Le mod&eacute;rateur doit veuillez &agrave; supprimer les commentaire qui ne serais pas aproprier et &agrave; aussi la possibilit&eacute;e de commenter</td>
                            <td>
                                <p>Consulation</p>
                                <p>Insertion de commentaire</p>
                                <p>Suppretion de commentaire</p>
                            </td>
                        </tr>
                        <tr style="background-color: #f9f9f9;">
                            <td>R&eacute;dacteur</td>
                            <td>
                                <p>Le r&eacute;adacteur &agrave; lui la possibilit&eacute;e de r&eacute;diger des articles pour le site mais du fait de sont statu il soit aussi pouvoirs les supprimer.&nbsp;</p>
                                <p>Cependant il n'a pas le droit de commenter les article</p>
                            </td>
                            <td>
                                <p>Consulation</p>
                                <p>Insertion article</p>
                                <p>Suppretion d'article</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>Afin de sassurer que les permision des role sont bien g&eacute;rer sur la base de donn&eacute;e et non dans le PHP. Notre proffesseur nous a demmander de renvoyer directement l'erreur php lorsque un utilisateur enfrain ces permision</p>
                    <p>&nbsp;</p>
                    <p>Enfin voici la liste des utilisateur présent dans la BDD avec leurs mot de passe :</p>
                    <table>
                        <tbody>
                        <tr style="background-color: #6453f7;">
                            <td>
                                <h4><span style="color: #ffffff;">Utilisateur</span></h4>
                            </td>
                            <td>
                                <h4><span style="color: #ffffff;">Mot de passe</span></h4>
                            </td>
                            <td>
                                <h4><span style="color: #ffffff;">Role</span></h4>
                            </td>
                        </tr>
                        <tr>
                            <td>lvolat</td>
                            <td>password</td>
                            <td>Utilisateur authentifier</td>
                        </tr>
                        <tr>
                            <td>mumix</td>
                            <td>password</td>
                            <td>Mod&eacute;rateur</td>
                        </tr>
                        <tr>
                            <td>sgibert</td>
                            <td>password</td>
                            <td>R&eacute;dacteur</td>
                        </tr>
                        </tbody>
                    </table>
                    <hr />
                    <h2>Conseption de la base de donn&eacute;es</h2>
                    <p>Dans le but de cr&eacute;e cette application il a fallu r&eacute;fl&eacute;chire &agrave; une base de donn&eacute;e assez simple r&eacute;pondant &agrave; tous les besoin indiquer par le proff&eacute;sseur.</p>
                    <p>C'est pourquois j'ai d&eacute;cid&eacute;e de partir sur ce MCD :&nbsp;</p>
                    <p><img src="./doc/MCD.png" alt="MCD de la base de donn&eacute;e" /></p>
                    <p>&nbsp;</p>
                    <p>De cette magni&egrave;re on retrouve bien les role les utilisateur les article et les commentaire (une am&eacute;lioration &agrave; introduire serais de mettre l'utilisateur directement en cles etrang&eacute;rer de comments)</p>
                    <p>Une fois la base de donn&eacute;e pr&eacute;sente il faut aussi cr&eacute;e les utilisateur ainci que leurs droit</p>
                    <p>pour ce faire j'ai utiliser les requette suivante :</p>
                    <button onclick="location.href = './sql/creationScript.sql'">T&eacute;l&eacute;charger le script SQL</button>
                    <p>&nbsp;</p>
                    <hr>
                    <h2>Test des droit</h2>
                    <p>Afin de verifier que tous les droit mis en place sur postgres fonctionne bien on vas pouvoirs tester les action pour chaque utilisateur</p>
                    <h3>Protocole de test</h3>
                    <p>Afin de tester les droit des utilisateur j'ai mis un protocole simple utilisable pour chaque type d'utilisateur.</p>
                    <p>Les pr&eacute;condition avant d&eacute;ff&eacute;ctuer le teste sont les suivante :</p>
                    <ul style="display: block;
                    list-style-type: disc;
                    margin-block-start: 1em;
                    margin-block-end: 1em;
                    margin-inline-start: 0px;
                    margin-inline-end: 0px;
                    padding-inline-start: 40px;">
                        <li style="display: list-item;">Se trouver sur la page d'acceuil du site</li>
                        <li style="display: list-item;">Avoire au moin un article d'enregistrer</li>
                        <li style="display: list-item;">Avoir au moin un commentaire d'enregistrer sur cette article</li>
                        <li style="display: list-item;">&Ecirc;tre eventuellement connecter avec l'utilisateur de sont choix</li>
                    </ul>
                    <p>Voici donc le protocole</p>
                    <ol>
                        <li>Cliquer sur le boutton +</li>
                        <li>Remplir le formulaire</li>
                        <li>Cliquer sur enregistrer</li>
                        <li>Constater un message d'erreur / Verifier que l'article &agrave; &eacute;tait ajouter</li>
                        <li>Cliquer sur voir l'article (sur l'article d&eacute;j&agrave; pr&eacute;sent)</li>
                        <li>Remplire sur cette page le formulaire de commentaire</li>
                        <li>Cliquer sur envoyer</li>
                        <li>Constater un message d'erreur / Verifier que le commentaire &agrave; bien &eacute;tait ajouter</li>
                        <li>Cliquer sur le boutton sur le commentaire pr&eacute;sent</li>
                        <li>Constater le message d'erreur / Constater la Suppression</li>
                    </ol>
                    <p>Il est ensuite possible d'utilis&eacute;e ce protocole pour tous les utilisateurs puis de relever ou non les message d'erreur &agrave; chaque &eacute;tape.</p>
                    <h3>R&eacute;sultat de mes test</h3>
                    <p>J'ai moi m&ecirc;me suivit ce protocole de teste pour chacun des type d'utilisateur possible.</p>
                    <p>Les tableaux suivant indique les erreur rencontrer &agrave; chaque teste de permition les erreur sont renvoyer sous forme de popup dans l'application. Mais ici serons indiquer les erreur sous forme de text.</p>
                    <p><em>Les erreur suivante contienne les stacktrace du serveur de test en local, elle peuve &ecirc;tre diff&eacute;rente sur le serveur de production.</em></p>
                    <h4>Utilisateur clasique</h4>
                    <table>
                        <thead>
                        <tr style="background-color: #6453f7;">
                            <td><span style="color: #ffffff;">Droit</span></td>
                            <td><span style="color: #ffffff;">Erreur</span></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Consultation</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Ajout D'article</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table articles in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Insert.php:47</td>
                        </tr>
                        <tr>
                            <td>Suppretion d'article</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table articles in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Delete.php:43</td>
                        </tr>
                        <tr>
                            <td>Ajout de commentaire</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table commentary in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Insert.php:81</td>
                        </tr>
                        <tr>
                            <td>Suppretion de commentaire</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table commentary in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Delete.php:63</td>
                        </tr>
                        </tbody>
                    </table>
                    <h4>&nbsp;</h4>
                    <h4>Utilisateur authentifier</h4>
                    <table>
                        <tbody>
                        <tr style="background-color: #6453f7;">
                            <td><span style="color: #ffffff;">Droit</span></td>
                            <td><span style="color: #ffffff;">Erreur</span></td>
                        </tr>
                        <tr>
                            <td>Consultation</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Ajout D'article</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table articles in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Insert.php:47</td>
                        </tr>
                        <tr>
                            <td>Suppretion d'article</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table articles in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Delete.php:43</td>
                        </tr>
                        <tr>
                            <td>Ajout de commentaire</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Suppretion de commentaire</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table commentary in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Delete.php:63</td>
                        </tr>
                        </tbody>
                    </table>
                    <p>Le r&eacute;sultat ici et bien le r&eacute;sulat attendu en effet chacune des erreur r&eacute;p&eacute;rtorier sont du &agrave; un manque de privil&eacute;ge sur la base de donn&eacute;e et ce seulement sur les action que l'utilisateur ne peut pas faire.&nbsp;</p>
                    <p>&nbsp;</p>
                    <h4>Mod&eacute;rateur</h4>
                    <table>
                        <tbody>
                        <tr style="background-color: #6453f7;">
                            <td><span style="color: #ffffff;">Droit</span></td>
                            <td><span style="color: #ffffff;">Erreur</span></td>
                        </tr>
                        <tr>
                            <td>Consultation</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Ajout D'article</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table articles in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Insert.php:47</td>
                        </tr>
                        <tr>
                            <td>Suppretion d'article</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table articles in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Delete.php:43</td>
                        </tr>
                        <tr>
                            <td>Ajout de commentaire</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Suppretion de commentaire</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <h4>R&eacute;dacteur</h4>
                    <table>
                        <thead>
                        <tr style="background-color: #6453f7;">
                            <td><span style="color: #ffffff;">Droit</span></td>
                            <td><span style="color: #ffffff;">Erreur</span></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Consultation</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Ajout D'article</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Suppretion d'article</td>
                            <td>Aucun erreur&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Ajout de commentaire</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table commentary in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Insert.php:81</td>
                        </tr>
                        <tr>
                            <td>Suppretion de commentaire</td>
                            <td>PDOException: SQLSTATE[42501]: Insufficient privilege: 7 ERREUR: droit refus&eacute; pour la table commentary in C:\xampp\htdocs\SLAM3Roles\App\Controller\DBController\Delete.php:63</td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <p>On observe bien ici que le r&eacute;sultat des test pour chacun des role et toujours coh&eacute;ran avec celui demander par le proffesseur. En effet lorsque un utilisateur na pas le droit d'&eacute;ffectuer une action cela se traduit par un erreur SQL en provenance de la BDD et qui indique un manque de privill&eacute;ge</p>
                    <hr>
                    <h2>Installation de l&rsquo;application en production</h2>
                    <h3>Introduction</h3>
                    <p>Avant de s&rsquo;attaquer au gros du probl&egrave;me &agrave; savoirs mettre en ligne l&rsquo;application d&eacute;velopper durant ce TP il est important d&rsquo;avoir en t&ecirc;tes l&rsquo;architecture r&eacute;seau dans laquelle celui-ci vas s&rsquo;int&egrave;gres.</p>
                    <p>Celle-ci ce d&eacute;compose en 3 serveur ayant chacun une adresse ip diff&eacute;rente.</p>
                    <table>
                        <tbody>
                        <tr>
                            <td>
                                <p>Nom</p>
                            </td>
                            <td>
                                <p>Adresse IP</p>
                            </td>
                            <td>
                                <p>Fonction</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Reverse proxy</p>
                            </td>
                            <td>
                                <p>192.168.1.35</p>
                            </td>
                            <td>
                                <p>Il et la passerelle vers interne c&rsquo;est la seul machine sur lequel il y a des port ouvert avec du routage nat pat.</p>
                                <p>&nbsp;</p>
                                <p>C&rsquo;est aussi sur ce server que sont upgrader les requ&ecirc;te avec un certificat SSL. (Cela veut aussi dire que la connexion n&rsquo;est pas chiffrer de bou en bou car sur le r&eacute;seau local les donn&eacute;e sont &eacute;changer en http)</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Server web</p>
                            </td>
                            <td>
                                <p>192.168.1.33</p>
                            </td>
                            <td>
                                <p>Le serveur web contient tous les site web que j&rsquo;ai fait tous au long du BTS.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Server Postgres</p>
                            </td>
                            <td>
                                <p>192.168.1.48</p>
                            </td>
                            <td>
                                <p>Le Serveur de base de donn&eacute;e et utilis&eacute;e par tous les service du r&eacute;seau&nbsp;: Nextcloud,Plex,OnlyOffice,DrawIo.</p>
                                <p>Mais il sert aussi pour h&eacute;berger les bases de donn&eacute;es des plus petit site web h&eacute;berger sur le serveur web.</p>
                                <p>Il n&rsquo;est accessible que en r&eacute;seau local</p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <p>&nbsp;</p>
                    <p>En voici donc un diagramme d&rsquo;architecture r&eacute;seau ci-dessous</p>
                    <img src="doc/DiagrameD'architectureResau.png" width="100%" alt="diagrame architechture réseau">
                    <p>&nbsp;</p>
                    <h2>Installation du serveur</h2>
                    <h3>Enregistrement d&rsquo;un nom de domaine</h3>
                    <p>La premi&egrave;re chose qu&rsquo;il est important de faire, c&rsquo;est de cr&eacute;e un nouveau nom de domaine pour ce serveur afin de le diff&eacute;rentier des autre.</p>
                    <p>Pour sa je me rend sur <a href="https://domains.google.com/m/registrar">https://domains.google.com/</a> ou j&rsquo;ai notament acheter le domaine louisvolat.fr.</p>
                    <p>Je me rends ensuite dans l&rsquo;onglet DNS afin d&rsquo;ajouter un nouveau sous nom de domaine puis je vais dans la partie enregistrement synth&eacute;tique afin d&rsquo;enregistrer un DNS dynamique.</p>
                    <img src="doc/EnregistrementDynDNS.png" alt="enregistrement DNS">
                    <p>&nbsp;</p>
                    <p>Une fois fait il me faut r&eacute;cup&eacute;rer les identifier du DNS pour les enregistrer dans mon reverse proxy afin d&rsquo;indiquer &agrave; google l&rsquo;ip conserner par ce DNS et de la modifier en cas de changement d&rsquo;ip</p>
                    <img src="doc/dnsident.png" alt="identifiant DNS">
                    <p>&nbsp;</p>
                    <p>Comme on peut l&rsquo;observer l&rsquo;IP indiquer et pour le momment 0.0.0</p>
                    <p>Il me faut maintenant me connecter &agrave; mon reverse proxy pour sa je vais utiliser l&rsquo;outil puty (je passe les d&eacute;taille de la connexion)</p>
                    <p>Je vais ensuite editer la configuration de DDNS un outil permetant d&rsquo;indiquer &agrave; google mon ip pour un nom de domaine indiquer.</p>
                    <p>Pour se faire j&rsquo;execute la commande</p>
                    <p>Sudo nano /etc/ddclient.conf</p>
                    <img src="doc/ddnsConfig.png" alt="configuration ddns">
                    <p>&nbsp;</p>
                    <p>Dans le fichier de configuration j&rsquo;indique donc le login et le mot de passe g&eacute;n&eacute;rer par google puis j&rsquo;enregistre le document.</p>
                    <p>Maintenant il me faut red&eacute;marer le service DDNS pour sa j&rsquo;ex&eacute;cutes cette commande</p>
                    <p>sudo /usr/sbin/ddclient -daemon 300 &ndash;syslog</p>
                    <img src="doc/GoogledomaineIpTrouver.png" alt="ip trouver dans google domains">
                    <p>&nbsp;</p>
                    <p>Une fois fait je peut observer sur google que mon IP &agrave; bien &eacute;t&eacute; trouver</p>
                    <p>&nbsp;</p>
                    <h2>Cr&eacute;ation de la Base de donn&eacute;e postgres</h2>
                    <p>Mon architecture &eacute;tant d&eacute;j&agrave; existante pour me connecter au serveur PostgreSQL il me suffit de me rendre dans PG admin 4 puis de cliqu&eacute; sur prodServer une fois fait je peux acc&eacute;der au base de donn&eacute;e et faire clique droit cr&eacute;e une base de donn&eacute;e puis de la nom&eacute;e comme bon me semble dans notre cas je vais la nomm&eacute;e DBPGROLE</p>
                    <p>&nbsp;</p>
                    <p>Maintenant je n&rsquo;ai plus qu&rsquo;&agrave; importer mon script d&rsquo;insertion et le tour et jouer ma BDD et g&eacute;n&eacute;rer.</p>
                    <img src="doc/CréeUneBDDPostgres.png" alt="crée une BDD postgres">
                    <p>&nbsp;</p>
                    <h2>Installation du serveur web</h2>
                    <p>Comme mon serveur web et d&eacute;j&agrave; pr&eacute;configurer je commence par me connecter en FTP &agrave; celui-ci avec mes identifiant et MDP. Une fois fait je cr&eacute;e un nouveau dossier pour le site puis je transph&eacute;rer mon build</p>
                    <img src="doc/FTPCréationDossier.png" alt="création dossier filezilla">
                    <p>&nbsp;</p>
                    <p>Maintenant il faut allez configurer le .env de mon projet qui se trouve dans&nbsp;: &laquo;&nbsp;App/Controller/DBController/database.ini&nbsp;&raquo; avec les nouvelle donn&eacute;e de connexion &agrave; la BDD</p>
                    <p>J&rsquo;indique donc les param&egrave;tre suivant&nbsp;:</p>
                    <p>host=192.168.1.48</p>
                    <p>port=5432</p>
                    <p>database=DBPGROLE</p>
                    <p>&nbsp;</p>
                    <p>Maintenant il faut ce rendre sur le server web pour cr&eacute;e un nouveau virtual host ex&eacute;cutant du php</p>
                    <p>Pour sa je cr&eacute;e un nouveau fichier dans &laquo;&nbsp;/etc/nginx/site-enabled/PGRole&nbsp;&raquo;</p>
                    <p>Si je cr&eacute;e le fichier &agrave; cette emplacement pr&eacute;cie c&rsquo;est parce que ma configuration de nginx inclue tous les fichier ci trouvans.</p>
                    <p>Voici donc ma configuration commenter&nbsp;:</p>
                    <img src="doc/VhostConfig.png" alt="configuration webservices">
                    <p>&nbsp;</p>
                    <p>Une fois fait je red&eacute;mare nginx</p>
                    <p>&nbsp;</p>
                    <h2>Configuration du reverse DNS</h2>
                    <p>Maintenant que tous et pr&ecirc;t &agrave; fonctionner il manque le plus important l&rsquo;ouverture sur interne</p>
                    <p>Pour se faire il vas falloir configurer le serveur dans le reverse proxy et g&eacute;n&eacute;rer un certificat SSL pour avoirs le site disponible en HTTPS</p>
                    <p>Je me rend donc dans la configuration de mon reverse DNS dans&nbsp;: &laquo;&nbsp;/etc/nginx/sites-enabled/proximaServices.conf&nbsp;&raquo;</p>
                    <p>Ma configuration de reverse proxy commence par la d&eacute;claration des upstream vers lequel le reverse proxy devras retrancemettre les information</p>
                    <img src="doc/UpstreamReverseProxy.png" alt="upstream reverse proxy nginx">
                    <p>&nbsp;</p>
                    <p>On observe que le serveur web et d&eacute;j&agrave; bien pr&eacute;sent car utilis&eacute;e ailleurs</p>
                    <p>Maintenant il faut que je fasse une redirection des requ&ecirc;te en provenance de pgrole.louisvolat.fr vers mon web service</p>
                    <p>Pour sa voici la configuration&nbsp;:</p>
                    <img src="doc/reverse%20proxy%20base%20config.png" alt="reverse proxy config">
                    <p>&nbsp;</p>
                    <p>Une fois fait je red&eacute;mare nginx</p>
                    <p>Il est des lors possible de d&rsquo;acc&eacute;der au site via l&rsquo;adresse http://pgrole.louisvolat.fr</p>
                    <p>Cependant le site n&rsquo;est pas encore s&eacute;curis&eacute;e c&rsquo;est pourquois je vais maintenant signer un certificat ssl &agrave; l&rsquo;aide de certbot</p>
                    <p>Pour sa j&rsquo;execute la commande&nbsp;: sudo certbot &ndash;nginx</p>
                    <img src="doc/certbot1.png" alt="certbot = LA VIE !!!!!!!!!">
                    <p>&nbsp;</p>
                    <p>Une fois fait le bot vas me demander pour quelle DNS je souhaite faire ce certificat. Dans mon cas pgrole.louisvolat.fr.<br /> Puis il me demande si je souhaite faire une redirection du port 80 vers le 443 sur ce dns j&rsquo;indique que oui.</p>
                    <p>Et sa y et la tour et jouer le site et accs&eacute;sible en ligne et avec un certificat SSL.</p>
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
