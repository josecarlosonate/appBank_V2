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

<body>

    <nav class="navbar border-bottom border-success border-2 shadow-sm py-3 bg-success-subtle">
        <div class="container">
            <a class="navbar-brand fw-bold fs-2 text-success" href="/">
                <i class="fa-solid fa-building-columns me-2"></i>AppBank
            </a>
            <a class="btn btn-outline-success" href="/login">
                Iniciar sesión
            </a>
        </div>
    </nav>
    <main class="container">
        <div class="row align-items-center py-5 mt-5">

            <!-- Contenido principal -->
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold">
                    Tus finanzas, más simples.
                </h1>

                <p class="lead">
                    Administra tus cuentas, realiza transferencias
                    y consulta tus movimientos desde un solo lugar.
                </p>

                <a href="/login" class="btn btn-success btn-lg">
                    Iniciar sesión
                    <i class="fa-solid fa-arrow-right ms-2"></i>
                </a>
            </div>

            <!-- Tarjeta de cuenta -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 bg-success text-white">
                    <div class="card-body p-5">

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Cuenta de ahorros</span>
                            <span class="badge bg-white text-success">Activa</span>
                        </div>

                        <div class="mt-4">
                            <p class="text-white-50 mb-1">Saldo disponible</p>
                            <h2 class="fw-bold mb-0">$4.850.000</h2>
                        </div>

                        <div class="mt-4">
                            <p class="text-white-50 mb-1">Número de cuenta</p>
                            <p class="fw-semibold mb-0">**** **** **** 2841</p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

</body>

</html>