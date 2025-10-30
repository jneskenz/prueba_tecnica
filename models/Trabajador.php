<?php
class Trabajador
{
    protected $db;

    public function __construct(PDO $pdo)
    {
        $this->db = $pdo;
    }

    public function all()
    {
        $stmt = $this->db->query('SELECT 
            t.id,
            t.nombre,
            t.apellido_paterno,
            t.apellido_materno,
            t.tipo_documento,
            t.numero_documento,
            t.sexo,
            t.fecha_nacimiento,
            t.direccion,
            t.position,
            t.email,
            t.salary,
            t.created_at,
            COALESCE(dist.descripcion, t.distrito_id, "-") AS distrito,
            COALESCE(prov.descripcion, t.provincia_id, "-") AS provincia,
            COALESCE(dep.descripcion, t.departamento_id, "-") AS departamento
        FROM trabajadores t
        LEFT JOIN ubigeodistrito dist ON t.distrito_id COLLATE utf8mb4_unicode_ci = dist.id COLLATE utf8mb4_unicode_ci
        LEFT JOIN ubigeoprovincia prov ON t.provincia_id COLLATE utf8mb4_unicode_ci = prov.id COLLATE utf8mb4_unicode_ci
        LEFT JOIN ubigeodepartamento dep ON t.departamento_id COLLATE utf8mb4_unicode_ci = dep.id COLLATE utf8mb4_unicode_ci
        ORDER BY t.id DESC');
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM trabajadores WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findDocument($numero_documento)
    {
        $stmt = $this->db->prepare('SELECT * FROM trabajadores WHERE numero_documento = :numero_documento');
        $stmt->execute(['numero_documento' => $numero_documento]);
        return $stmt->fetch();
    }

    public function create(array $data)
    {
        $stmt = $this->db->prepare('INSERT 
            INTO trabajadores (nombre, apellido_paterno, apellido_materno, tipo_documento, numero_documento, sexo, fecha_nacimiento, direccion,
            departamento_id, provincia_id, distrito_id) 
            VALUES (:nombre, :apellido_paterno, :apellido_materno, :tipo_documento, :numero_documento, :sexo, :fecha_nacimiento, :direccion,
            :departamento_id, :provincia_id, :distrito_id)');

        return $stmt->execute([
            'nombre' => $data['nombre'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],
            'sexo' => $data['sexo'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'direccion' => $data['direccion'],
            'departamento_id' => $data['departamento_id'],
            'provincia_id' => $data['provincia_id'],
            'distrito_id' => $data['distrito_id'],
        ]);
    }

    public function update($id, array $data)
    {
        $stmt = $this->db->prepare('UPDATE trabajadores 
        SET nombre = :nombre, apellido_paterno = :apellido_paterno, apellido_materno = :apellido_materno, tipo_documento = :tipo_documento, numero_documento = :numero_documento, sexo = :sexo, fecha_nacimiento = :fecha_nacimiento, direccion = :direccion, departamento_id = :departamento_id, provincia_id = :provincia_id, distrito_id = :distrito_id WHERE id = :id');
        return $stmt->execute([
            'nombre' => $data['nombre'],
            'apellido_paterno' => $data['apellido_paterno'],
            'apellido_materno' => $data['apellido_materno'],
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],
            'sexo' => $data['sexo'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'direccion' => $data['direccion'],
            'departamento_id' => $data['departamento_id'],
            'provincia_id' => $data['provincia_id'],
            'distrito_id' => $data['distrito_id'],
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare('DELETE FROM trabajadores WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
