<?php

namespace Model;

/**
 * Represent the Connection
 */
class Article {
    private $idArticle;
    private $title;
    private $introduction;
    private $content;
    private $nblike;
    private $nbcomentary;

    public function __construct($title,$introduction,$content)
    {
        $this->title = $title;
        $this->introduction = $introduction;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle): void
    {
        $this->idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getIntroduction()
    {
        return $this->introduction;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getNblike()
    {
        return $this->nblike;
    }

    /**
     * @return mixed
     */
    public function getNbcomentary()
    {
        return $this->nbcomentary;
    }

    /**
     * @param mixed $nblike
     */
    public function setNblike($nblike): void
    {
        $this->nblike = $nblike;
    }

    /**
     * @param mixed $nbcomentary
     */
    public function setNbcomentary($nbcomentary): void
    {
        $this->nbcomentary = $nbcomentary;
    }



}