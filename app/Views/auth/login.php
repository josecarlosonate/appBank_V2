<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AppBank</title>
</head>

<body>

    <h1>AppBank</h1>

    <form method="POST" action="/login">
        <div>
            <label for="document_number">Documento</label>
            <input
                type="text"
                id="document_number"
                name="document_number"
                required>
        </div>

        <div>
            <label for="password">Contraseña</label>
            <input
                type="password"
                id="password"
                name="password"
                required>
        </div>

        <button type="submit">Iniciar sesión</button>
    </form>

</body>

</html>