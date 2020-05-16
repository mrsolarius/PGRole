<?php


namespace Model;


class Comentary
{
    private Article $article;
    private User $user;
    private $idComment;
    private $comment;

    /**
     * Comentary constructor.
     * @param $comment
     * @param $user
     * @param $article
     */
    public function __construct($comment,$user, $article){
        $this->comment = $comment;
        $this->user = $user;
        $this->article = $article;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }


    /**
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return mixed
     */
    public function getIdComment()
    {
        return $this->idComment;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $idComment
     */
    public function setIdComment($idComment): void
    {
        $this->idComment = $idComment;
    }


}