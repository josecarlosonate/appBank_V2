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

    <!-- Mis estilos -->
    <link rel="stylesheet" href="/css/app.css">
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
                    <li class="breadcrumb-item">
                        <a href="/accounts" class="text-success text-decoration-none">
                            <i class="fa-solid fa-wallet me-1"></i>
                            Mis cuentas
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Nueva cuenta
                    </li>
                </ol>
            </nav>

            <div class="mb-4">
                <div>
                    <h1 class="fw-bold">Nueva cuenta</h1>
                    <p class="text-secondary fs-5 mb-0">
                        Crea una nueva cuenta en AppBank.
                    </p>
                </div>
            </div>
        </div>

        <div>
            <?php if (isset($_SESSION['error'])): ?>

                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                </div>

                <?php unset($_SESSION['error']); ?>

            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-lg-6 col-xl-5">

                <div class="card border-0 shadow">
                    <div class="card-body p-4">

                        <form id="account-form" method="POST" action="/accounts">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="account_type" class="form-label fw-semibold">
                                    Tipo de cuenta
                                </label>
                                <select class="form-select" id="account_type" name="account_type" required>
                                    <option value="" selected disabled> Selecciona un tipo </option>
                                    <option value="SAVINGS"> Cuenta de ahorros </option>
                                    <option value="CHECKING"> Cuenta corriente </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="balance" class="form-label fw-semibold">
                                    Saldo inicial
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text text-success fw-semibold">
                                        $
                                    </span>
                                    <input type="text" class="form-control" id="balance" name="balance" inputmode="decimal" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <a href="/accounts" class="btn btn-outline-secondary"> Cancelar </a>

                                <button type="submit" class="btn btn-success">
                                    <i class="fa-solid fa-plus me-2"></i>
                                    Crear cuenta
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.21.0/dist/jquery.validate.min.js"></script>
    <script src="/js/accounts.js"></script>
</body>

</html>