<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12/01/17
 * Time: 16:44
 */
class Snippet
{
    protected $id;
    protected $title;
    protected $content;
    protected $publishDate;
    protected $userId;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function __construct($title,$content)
    {
        $date = new DateTime();
        $this->setTitle($title);
        $this->setContent($content);
        $this->setPublishDate( $date->format('Y-m-d H:i:s'));
        $this->setUserId(user()->getId());
    }

    public static function fromDatabase($donnes){
        $newSnippet = new Snippet($donnes['title'],$donnes['content']);
        $newSnippet->setPublishDate($donnes['publishDate']);
        $newSnippet->setId($donnes['id']);
        return $newSnippet;
    }

    /**
     * @return mixed
     */
    public function getPublishDate()
    {
        return $this->publishDate;
    }

    /**
     * @param mixed $date
     */
    public function setPublishDate($date)
    {
        $this->publishDate = $date;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }



}