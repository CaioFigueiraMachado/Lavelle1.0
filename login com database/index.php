    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            width: 350px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        #registroForm {
            display: none;
        }
        #loginContainer {
            display: block;
        }
        .show {
            display: block !important;
        }
        .hide {
            display: none !important;
        }
    </style>
    <script>
        function toggleRegistro() {
            var registroForm = document.getElementById('registroForm');
            var loginContainer = document.getElementById('loginContainer');
            registroForm.classList.add('show');
            loginContainer.classList.add('hide');
        }
        function toggleLogin() {
            var registroForm = document.getElementById('registroForm');
            var loginContainer = document.getElementById('loginContainer');
            registroForm.classList.remove('show');
            loginContainer.classList.remove('hide');
        }
    </script>
<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
// Registro de novo usuário
if(isset($_POST['registro_nome']) && isset($_POST['registro_email']) && isset($_POST['registro_senha'])) {
    $nome = $mysqli->real_escape_string($_POST['registro_nome']);
    $email = $mysqli->real_escape_string($_POST['registro_email']);
    $senha = $mysqli->real_escape_string($_POST['registro_senha']);

    if(strlen($nome) == 0 || strlen($email) == 0 || strlen($senha) == 0) {
        echo "Preencha todos os campos do registro.";
    } else {
        // Verifica se o email já existe
        $sql_check = "SELECT id FROM usuarios WHERE email = '$email'";
        $query_check = $mysqli->query($sql_check);
        if($query_check->num_rows > 0) {
            echo "E-mail já cadastrado.";
        } else {
            $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
            if($mysqli->query($sql_insert)) {
                echo "Usuário registrado com sucesso!";
            } else {
                echo "Erro ao registrar: " . $mysqli->error;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f2f2f2;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }
            .container {
                background: #fff;
                padding: 30px 40px;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                margin-bottom: 20px;
                width: 350px;
            }
            h1 {
                text-align: center;
                color: #333;
            }
            label {
                display: block;
                margin-bottom: 5px;
                color: #555;
            }
            input[type="text"], input[type="password"] {
                width: 100%;
                padding: 8px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
            button {
                background: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 16px;
            }
            button:hover {
                background: #0056b3;
            }
            #registroForm, #loginContainer {
                display: none;
            }
            .show {
                display: block !important;
            }
            .hide {
                display: none !important;
            }
        </style>
        <script>
            function toggleRegistro() {
                document.getElementById('registroForm').classList.add('show');
                document.getElementById('loginContainer').classList.remove('show');
            }
            function toggleLogin() {
                document.getElementById('loginContainer').classList.add('show');
                document.getElementById('registroForm').classList.remove('show');
            }
            window.onload = function() {
                document.getElementById('registroForm').classList.remove('show');
                document.getElementById('loginContainer').classList.remove('show');
            }
        </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            width: 350px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        #registroForm {
            display: none;
        }
        .show {
            display: block !important;
        }
    </style>
    <script>
        function toggleRegistro() {
            var form = document.getElementById('registroForm');
            form.classList.toggle('show');
        }
    </script>
</head>
<body>
    <div class="container">
        <button onclick="toggleRegistro()">Registrar novo usuário</button>
        <button onclick="toggleLogin()" style="margin-left:10px;">Entrar</button>
    </div>
    <div class="container" id="registroForm">
        <form action="" method="POST">
            <h1>Registrar</h1>
            <label>Nome</label>
            <input type="text" name="registro_nome">
            <label>E-mail</label>
            <input type="text" name="registro_email">
            <label>Senha</label>
            <input type="password" name="registro_senha">
            <button type="submit">Registrar</button>
            <button type="button" onclick="toggleLogin()" style="margin-top:10px;background:#6c757d;">Voltar para login</button>
        </form>
    </div>
    <div class="container" id="loginContainer">
        <h1>Acesse sua conta</h1>
        <form action="" method="POST">
            <p>
                <label>E-mail</label>
                <input type="text" name="email">
            </p>
            <p>
                <label>Senha</label>
                <input type="password" name="senha">
            </p>
            <p>
                <button type="submit">Entrar</button>
            </p>
        </form>
    </div>
</body>
</html>