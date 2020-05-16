<?php

namespace DBController;


/**
 * Classe de de connexion à la BDD
 */
class DBConnection {

    /**
     * Connection
     * @var type
     */
    private $conn;

    /**
     * Connection à la BDD et renvois d'un objet de type PDO
     * @return \PDO
     * @throws \Exception
     */
    public function connect()
    {

        // lecture des parametre dans le fichier de configuration en .ini
        $params = parse_ini_file('database.ini');
        if ($params === false) {
            throw new \Exception("Erreur lors dans le fichier de configuration de la BDD");
        }

        //Definition du role de connection en fonction du role de l'utilisateur connecter
        if(isset($_SESSION['ROLEID'])){
            $userType = $_SESSION['ROLEID'];
            $userPass = strtoupper($_SESSION['ROLEID']);
        }else{
            //Si aucun utilisateur connecter alors on prend le role par defaut
            $userType = $params['defaultUser'];
            $userPass = $params['defaultPassword'];
        }

        // connect to the postgresql database
        $conStr = sprintf("pgsql:host=%s;port=%d;dbname=%s;user=%s;password=%s",
            $params['host'],
            $params['port'],
            $params['database'],
            $userType,
            $userPass);

        $pdo = new \PDO($conStr);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }


    public function __construct() {

    }

    private function __clone() {

    }

    private function __wakeup() {

    }

}