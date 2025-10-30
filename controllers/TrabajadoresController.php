<?php
class TrabajadoresController
{
    protected $trabajadorModel;
    protected $departamentoModel;
    protected $provinciaModel;
    protected $distritoModel;

    public function __construct(PDO $pdo)
    {
        $this->trabajadorModel = new Trabajador($pdo);
        $this->departamentoModel = new Departamento($pdo);
        $this->provinciaModel = new Provincia($pdo);
        $this->distritoModel = new Distrito($pdo);

    }

    protected function render($view, $data = [])
    {
        extract($data);
        include __DIR__ . '/../views/layout/header.php';
        include __DIR__ . '/../views/' . $view . '.php';
        include __DIR__ . '/../views/layout/footer.php';
    }

    public function index()
    {
        $trabajadores = $this->trabajadorModel->all();
        $this->render('trabajadores/index', ['trabajadores' => $trabajadores]);
    }

    public function create()
    {
        $departamentos = $this->departamentoModel->all();
        $this->render('trabajadores/create', ['departamentos' => $departamentos]);
    }

    public function getProvinciasByDepartamento()
    {
        header('Content-Type: application/json');
        $departamentoId = $_GET['departamento_id'] ?? null;
        if ($departamentoId) {
            $provincias = $this->provinciaModel->findByDepartamentoId($departamentoId);
            echo json_encode($provincias);
        } else {
            echo json_encode([]);
        }
        exit; 
    }

    public function getDistritosByProvincia()
    {
        header('Content-Type: application/json');
        $provinciaId = $_GET['provincia_id'] ?? null;
        if ($provinciaId) {
            $distritos = $this->distritoModel->findByProvinciaId($provinciaId);
            echo json_encode($distritos);
        } else {
            echo json_encode([]);
        }
        exit;
    }

    public function validDocumentDuplicate()
    {
        header('Content-Type: application/json');
        $numeroDocumento = $_GET['numero_documento'] ?? null;
        if ($numeroDocumento) {
            $trabajador = $this->trabajadorModel->findDocument($numeroDocumento);
            if ($trabajador) {
                echo json_encode(['exists' => true]);
            } else {
                echo json_encode(['exists' => false]);
            }
        } else {
            echo json_encode(['exists' => false]);
        }
        exit;
    }

    public function store()
    {
        // nombre, 
        // apellido paterno, 
        // apellido materno, 
        // tipo de documento de identidad [considerar los valores RUC, DNI, Pasaporte], 
        // número de documento de identidad, 
        // sexo, 
        // fecha de nacimiento, 
        // departamento, 
        // provincia, 
        // distrito, 
        // dirección

        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido_paterno' => $_POST['apellido_paterno'] ?? '',
            'apellido_materno' => $_POST['apellido_materno'] ?? '',
            'tipo_documento' => $_POST['tipo_documento'] ?? '',
            'numero_documento' => $_POST['numero_documento'] ?? '',
            'sexo' => $_POST['sexo'] ?? '',
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
            'departamento_id' => $_POST['departamento'] ?? '',
            'provincia_id' => $_POST['provincia'] ?? '',
            'distrito_id' => $_POST['distrito'] ?? '',
            'direccion' => $_POST['direccion'] ?? '',
        ];

        // validar
        $errors = '';
        if (empty($data['nombre'])) {
            $errors .= 'El nombre es obligatorio.';
        }
        if (empty($data['apellido_paterno'])) {
            $errors .= 'El apellido paterno es obligatorio.';
        }
        if (empty($data['apellido_materno'])) {
            $errors .= 'El apellido materno es obligatorio.';
        }
        if (empty($data['tipo_documento'])) {
            $errors .= 'El tipo de documento es obligatorio.';
        }
        if (empty($data['numero_documento'])) {
            $errors .= 'El número de documento es obligatorio.';
        }
        if (empty($data['sexo'])) {
            $errors .= 'El sexo es obligatorio.';
        }
        if (empty($data['fecha_nacimiento'])) {
            $errors .= 'La fecha de nacimiento es obligatoria.';
        }
        if (empty($data['departamento_id'])) {
            $errors .= 'El departamento es obligatorio.';
        }
        if (empty($data['provincia_id'])) {
            $errors .= 'La provincia es obligatoria.';
        }
        if (empty($data['distrito_id'])) {
            $errors .= 'El distrito es obligatorio.';
        }
        if (empty($data['direccion'])) {
            $errors .= 'La dirección es obligatoria.';
        }

        if (!empty($errors)) {
            $_SESSION['flash'] = $errors;
            header('Location: index.php?controller=trabajadores&action=create');
            return;
        }

        $this->trabajadorModel->create($data);
        $_SESSION['flash'] = 'Trabajador creado correctamente.';
        header('Location: index.php?controller=trabajadores&action=index');
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=trabajadores&action=index');
            return;
        }
        $trabajador = $this->trabajadorModel->find($id);
        $departamentos = $this->departamentoModel->all();
        $provincias = $this->provinciaModel->findByDepartamentoId($trabajador['departamento_id']);
        $distritos = $this->distritoModel->findByProvinciaId($trabajador['provincia_id']);
        $this->render('trabajadores/edit', ['trabajador' => $trabajador, 'departamentos' => $departamentos, 'provincias' => $provincias, 'distritos' => $distritos]);
    }

    public function update()
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=trabajadores&action=index');
            return;
        }
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido_paterno' => $_POST['apellido_paterno'] ?? '',
            'apellido_materno' => $_POST['apellido_materno'] ?? '',
            'tipo_documento' => $_POST['tipo_documento'] ?? '',
            'numero_documento' => $_POST['numero_documento'] ?? '',
            'sexo' => $_POST['sexo'] ?? '',
            'fecha_nacimiento' => $_POST['fecha_nacimiento'] ?? '',
            'departamento_id' => $_POST['departamento'] ?? '',
            'provincia_id' => $_POST['provincia'] ?? '',
            'distrito_id' => $_POST['distrito'] ?? '',
            'direccion' => $_POST['direccion'] ?? '',
        ];
        $this->trabajadorModel->update($id, $data);
        $_SESSION['flash'] = 'Trabajador actualizado correctamente.';
        header('Location: index.php?controller=trabajadores&action=index');
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->trabajadorModel->delete($id);
            $_SESSION['flash'] = 'Trabajador eliminado.';
        }
        header('Location: index.php?controller=trabajadores&action=index');
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=trabajadores&action=index');
            return;
        }
        $trabajador = $this->trabajadorModel->find($id);
        $this->render('trabajadores/show', ['trabajador' => $trabajador]);
    }
}
