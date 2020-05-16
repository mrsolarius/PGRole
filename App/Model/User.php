<?php

namespace Model;

/**
 * Represent the Connection
 */
class User {
    private $login;
    private $password;
    private $name;
    private $surname;
    private $roleID;
    private $roleName;

    /**
     * User constructor.
     * @param $login
     * @param $password
     * @param $name
     * @param $surname
     * @param $roleID
     * @param $roleName
     */
    public function __construct($login, $password, $name, $surname,$roleID,$roleName)
    {
        $this->login = $login;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->roleID = $roleID;
        $this->roleName = $roleName;
    }

    /**
     * Permet de definir L'utilisateur actif comme utilisateur de session
     * @return void
     */
    public function setUserSession()
    {
        $_SESSION['LOGIN'] = $this->login;
        $_SESSION['NAME'] = $this->name;
        $_SESSION['SURNAME'] = $this->surname;
        $_SESSION['ROLENAME'] = $this->roleName;
        $_SESSION['ROLEID'] = $this->roleID;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getRoleID()
    {
        return $this->roleID;
    }

    /**
     * @param mixed $roleID
     */
    public function setRoleID($roleID): void
    {
        $this->roleID = $roleID;
    }

    /**
     * @return mixed
     */
    public function getRoleName()
    {
        return $this->roleName;
    }

    /**
     * @param mixed $roleName
     */
    public function setRoleName($roleName): void
    {
        $this->roleName = $roleName;
    }



}