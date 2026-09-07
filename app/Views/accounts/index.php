<?php

/** @var array $accounts */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AppBank</title>

    <!-- Bootstrap 5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/2c9eef3e53.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">

    <?php require __DIR__ . '/../partials/navbar.php'; ?>

    <main class="container py-5">

        <div class="mb-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard" class="text-success text-decoration-none">
                            <i class="fa-solid fa-house me-1"></i>
                            Panel principal
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Mis cuentas
                    </li>
                </ol>
            </nav>
            <h1 class="fw-bold">Mis Cuentas</h1>
            <p class="text-secondary fs-5">
                Consulta y administra tus cuentas.
            </p>
        </div>

        <div class="row">
            <?php if (empty($accounts)): ?>

                <div class="card border-0 shadow">
                    <div class="card-body text-center py-5">

                        <i class="fa-solid fa-wallet fs-1 text-success mb-3"></i>

                        <h4 class="fw-bold">
                            No tienes cuentas registradas
                        </h4>

                        <p class="text-secondary mb-4">
                            Crea tu primera cuenta para comenzar a utilizar AppBank.
                        </p>

                        <a href="/accounts/create" class="btn btn-success">
                            <i class="fa-solid fa-plus me-2"></i>
                            Nueva cuenta
                        </a>

                    </div>
                </div>

            <?php else: ?>

                <!-- Aquí irá la tabla -->

            <?php endif; ?>
        </div>

    </main>

</body>

</html>