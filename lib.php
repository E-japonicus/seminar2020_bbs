<?php

require_once __DIR__ . '/db_config.php';

class bbs
{
    // Database Info
    protected $dsn            = DB_DSN;
    protected $username       = DB_USER;
    protected $password       = DB_PASSWORD;
    protected $driver_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    protected $pdo = '';

    function __construct()
    {
        try
        {
            $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->driver_options);
        }
        catch (PDOException $e)
        {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage()); 
        }
    }

    function select()
    {
        $sql = 'SELECT * FROM `bbs` ORDER BY id DESC';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function insert()
    { 
        extract($_POST);

        $stmt = $this->pdo->prepare('INSERT INTO bbs (`name`, `comment`) VALUES(:name, :comment)');
        $stmt->bindValue(":name",    $name,    PDO::PARAM_STR);
        $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }

    function update()
    {
        extract($_POST);

        $stmt = $this->pdo->prepare('UPDATE bbs SET name = :name, comment = :comment WHERE id = :id');
        $stmt->bindValue(":name",       $name,      PDO::PARAM_STR);
        $stmt->bindValue(":comment",    $comment,   PDO::PARAM_STR);
        $stmt->bindValue(":id",         $id,        PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }

    function delete()
    {
        extract($_POST);

        $stmt = $this->pdo->prepare('DELETE FROM bbs WHERE id = :id');
        $stmt->bindValue(":id", $id,    PDO::PARAM_INT);
        $stmt->execute();

        return true;
    }
}