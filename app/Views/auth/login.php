<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AppBank</title>
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

    <nav class="navbar bg-success-subtle border-bottom border-success border-2 shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-2 text-success" href="/">
                <i class="fa-solid fa-building-columns me-2"></i>AppBank
            </a>

            <a class="btn btn-outline-success" href="/">
                Volver al inicio
            </a>
        </div>
    </nav>

    <main class="container">
        <div class="row justify-content-center py-4">
            <div class="col-md-8 col-lg-5">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body p-5">

                        <div class="text-center mb-4">
                            <i class="fa-solid fa-circle-user fs-1 text-success mb-3"></i>

                            <h2 class="fw-bold">
                                Iniciar sesión
                            </h2>

                            <p class="text-secondary mb-0">
                                Ingresa tus credenciales para acceder a tu cuenta.
                            </p>
                        </div>

                        <?php if (isset($_SESSION['error'])): ?>

                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($_SESSION['error']) ?>
                            </div>

                            <?php unset($_SESSION['error']); ?>

                        <?php endif; ?>

                        <form method="POST" action="/login">
                            <div class="mb-3">
                                <label for="document_number" class="form-label">
                                    Número de documento
                                </label>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-id-card text-success"></i>
                                    </span>

                                    <input
                                        type="text"
                                        class="form-control"
                                        id="document_number"
                                        name="document_number"
                                        required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    Contraseña
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa-solid fa-lock text-success"></i>
                                    </span>

                                    <input
                                        type="password"
                                        class="form-control"
                                        id="password"
                                        name="password"
                                        required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                Iniciar sesión
                                <i class="fa-solid fa-right-to-bracket ms-2"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap 5.3.8 JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous">
    </script>
</body>

</html>