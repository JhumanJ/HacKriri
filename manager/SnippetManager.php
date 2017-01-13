<?php

/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12/01/17
 * Time: 17:04
 */
class SnippetManager
{

    protected $db;

    public function __construct($db) {
        $this->setDb($db);
    }

    protected function setDb($db) {
        $this->db=$db;
    }

    public function create(Snippet $snippet) {
        $q = $this->db->prepare('INSERT INTO snippets(userId, title, content, publishDate)
                                  VALUES(:userId, :title, :content, :publishDate)');
        $q->execute(array(
            'userId' => $snippet->getUserId(),
            'title' => $snippet->getTitle(),
            'content' => $snippet->getContent(),
            'publishDate' => $snippet->getPublishDate(),
        ));
    }

    public function update(Snippet $snippet) {
        $q = $this->db->prepare('UPDATE snippets SET userId = :userId, title = :title, content = :content, publishDate = :publishDate WHERE id = :id');
        $q->execute(array(
            'title' => $snippet->getTitle(),
            'content' => $snippet->getContent(),
            'publishDate' => $snippet->getPublishDate(),
            'id' => $snippet->getId(),
            'userId' => $snippet->getUserId(),
        ));
    }

    public function delete(Snippet $snippet) {
        $q = $this->db->prepare('DELETE FROM snippets WHERE id = :id');
        $q->execute(array(
            'id' => $snippet->getId()
        ));
    }

    public function find($id) {
        $q = $this->db->prepare('SELECT * FROM snippets WHERE id = :id');
        $q->execute(array(
            'id' => $id
        ));

        $donnes = $q->fetch(PDO::FETCH_ASSOC);
        $snippet = Snippet::fromDatabase($donnes);
        return $snippet;
    }

    public function userSnippet(User $user){
        $q = $this->db->prepare('SELECT * FROM snippets WHERE userId = :userId');
        $q->execute(array(
            'userId' => $user->getId()
        ));

        $snippets = [];
        while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
            array_push($snippets, Snippet::fromDatabase($row));
        }
        return $snippets;
    }

    public function lastSnippet(User $user){
        $q = $this->db->prepare('SELECT * FROM snippets WHERE userId = :userId LIMIT 1');
        $q->execute(array(
            'userId' => $user->getId()
        ));

        $donnes = $q->fetch(PDO::FETCH_ASSOC);
        $snippet = Snippet::fromDatabase($donnes);
        return $snippet;
    }

}