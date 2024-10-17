<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://i0.wp.com/tramadiseno.com.mx/wp-content/uploads/2022/08/PSX_20201111_150241-scaled.jpg?fit=2560%2C1605&ssl=1');
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
            line-height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.7); /* Blanco transparente */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            width: 300px;
            backdrop-filter: blur(5px);
        }

        h1 {
            text-align: center;
            color: #333; /* Cambié el color a un tono más oscuro */
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333; /* Tono oscuro para texto */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #b28d4c; /* Color marrón acorde a la imagen */
            border-radius: 4px;
            background-color: rgba(255, 255, 255, 0.1); /* Fondo ligeramente transparente */
        }

        button {
            background-color: #b28d4c; /* Marrón claro inspirado en la imagen */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto; /* Centra el botón */
            width: 100%; /* Ajustar el ancho completo */
        }

        button:hover {
            background-color: #8e6f3e; /* Marrón más oscuro en hover */
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            text-align: center;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        
        <form method="POST" action="login.php">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
        </form>

        <?php
        // Mostrar mensaje de error si se pasa por GET (opcional)
        if (isset($_GET['error'])) {
            echo '<p class="error-message">' . $_GET['error'] . '</p>';
        }
        ?>
    </div>
</body>
</html>

