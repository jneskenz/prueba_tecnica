<?php
class Distrito
{
    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function all()
    {
        $stmt = $this->db->query('SELECT * FROM ubigeodistrito ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ubigeodistrito WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findByProvinciaId($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ubigeodistrito WHERE provincia = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

}
