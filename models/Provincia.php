<?php
class Provincia
{
    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function all()
    {
        $stmt = $this->db->query('SELECT * FROM ubigeoprovincia ORDER BY id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ubigeoprovincia WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findByDepartamentoId($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM ubigeoprovincia WHERE departamento = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetchAll();
    }

}
