<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/css/loginStyle.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <form action="/auth/loginProcess" method="post">
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Iniciar Sesión">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
