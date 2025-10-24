<?php
session_start();

if (isset($_SESSION["usuario"])) {
    header("Location: /mysql/20251023/dashboard.php");
}

include("../../20251009/config/database.php");

$database = new Database();

$erro = "";
if ($_POST) {
    $email = $_POST["email"] ?? "";
    $senha = md5($_POST["senha"]) ?? "";

    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        try {
            $usuario = $database->read("usuarios", ["email" => $email, "senha" => $senha], 1);
            if (count($usuario["data"]) > 0) {
                $_SESSION["usuario"] = $usuario["data"][0]["id"];
                header("Location: /mysql/20251023/dashboard.php");
                exit();
            } else {
                $erro = "Email ou senha incorretos.";
            }
        } catch (\Throwable $th) {
            $erro = "Email no sistema.";
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-login:hover {
            background-color: #0056b3;
        }

        .erro {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }

        .info {
            background-color: #d1ecf1;
            color: #0c5460;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #bee5eb;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <form method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>
    </div>
</body>

</html>