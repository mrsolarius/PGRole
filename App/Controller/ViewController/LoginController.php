<?php

namespace ViewController;

use DBController\DBConnection;
use DBController\Select;
use Exception;
use RuntimeException;


class LoginController{

    /**
     * @var \Model\User[]
     */
    private $users;

    /**
     * loginController constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $c = new DBConnection();
        $pdo = $c->connect();
        $select = new Select($pdo);
        $this->users=$select->getUsers();
    }

    /**
     * fonction permetant la decconection
     * detrouit toutes les variable de session associer à l'utilisateur
     * @return void;
     */
    public function logOut(){
        unset($_SESSION['LOGIN']);
        unset($_SESSION['NAME']);
        unset($_SESSION['SURNAME']);
        unset($_SESSION['ROLENAME']);
        unset($_SESSION['ROLEID']);
    }

    /**
     * Fonction permetant le check du login sur le formulaire
     * @return void
     * @throws RuntimeException
     */
    public function loginCheck(){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $password = md5($password);

        foreach ($this->users as $user){
            if ($user->getLogin()===$login){
                if ($password == $user->getPassword()){
                    $user->setUserSession();
                    return;
                }
                throw new RuntimeException("Mauvais mot de passe");
            }
        }
        throw new RuntimeException("Aucun utilisateur trouver");
    }
}



