    <nav class="navbar bg-success-subtle border-bottom border-success border-2 shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-2 text-success" href="/dashboard">
                <i class="fa-solid fa-building-columns me-2"></i>AppBank
            </a>

            <div class="d-flex align-items-center gap-3">

                <span class="text-success">
                    <i class="fa-solid fa-user me-2"></i>
                    <?= htmlspecialchars(
                        $_SESSION['first_name'] . ' ' . $_SESSION['last_name']
                    ) ?>
                </span>

                <form method="POST" action="/logout" class="m-0">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline-success">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </div>
    </nav>