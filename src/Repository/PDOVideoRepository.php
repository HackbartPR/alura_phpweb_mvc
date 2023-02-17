<?php

namespace HackbartPR\Repository;

use PDO;
use HackbartPR\Entity\Video;
use HackbartPR\Interfaces\VideoRepository;

class PDOVideoRepository implements VideoRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Video $video):bool
    {
        if (!empty($video->id())) {
            return $this->update($video);
        }

        return $this->add($video);
    }

    public function add(Video $video): bool
    {
        $stmt = $this->pdo->prepare('INSERT INTO videos (url, title) VALUES (?,?);');
        $stmt->bindValue(1, $video->url);
        $stmt->bindValue(2, $video->title);
        
        return $stmt->execute();
    }

    public function update(Video $video):bool
    {
        $stmt = $this->pdo->prepare('UPDATE videos SET url = :url, title = :title WHERE id = :id;');
        $stmt->bindValue(':url', $video->url);
        $stmt->bindValue(':title', $video->title);
        $stmt->bindValue(':id', $video->id());
        
        return $stmt->execute();        
    }

    public function remove(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM videos WHERE id = ?');
        $stmt->bindValue(1, $_GET['id'], \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function all(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM videos');
        $videoDataList = $stmt->fetchAll();

        $videoList = [];
        foreach ($videoDataList as $video) {
            $videoList[] = new Video($video['id'], $video['title'], $video['url']);
        }

        return $videoList;
    }
}