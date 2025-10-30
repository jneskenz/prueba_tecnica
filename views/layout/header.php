<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Trabajadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 70px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php?controller=trabajadores&action=index">Prueba Técnica</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php?controller=trabajadores&action=index">Trabajadores</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?controller=trabajadores&action=create">Nuevo</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
    <?php if (!empty($_SESSION['flash'])): ?>
        <div class="alert alert-success"><?= $_SESSION['flash'] ?></div>
        <?php unset($_SESSION['flash']); endif; ?>
