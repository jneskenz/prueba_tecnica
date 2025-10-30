<?php
class Departamento
{
    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function all()
    {
        $stmt = $this->db->query('SELECT * FROM ubigeodepartamento ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ubigeodepartamento WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}
