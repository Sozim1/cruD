<?php
include 'database.php';

$error = "";

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['user'], $_POST['password'], $_POST['email'], $_POST['date_nasc'])) {
            $user = $_POST['user'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $date_nasc = $_POST['date_nasc'];

            $sql = "UPDATE usuarios SET user='$user', password='$password', email='$email', date_nasc='$date_nasc' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
                exit();
            } else {
                $error = "Erro ao atualizar registro: " . mysqli_error($conn);
            }
        } else {
            $error = "Dados do formulário incompletos.";
        }
    }

    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        $error = "Nenhum registro encontrado com o ID fornecido.";
    }
} else {
    $error = "ID do registro não fornecido.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <link rel="stylesheet" type="text/css" href="css_file/_edit.css">
</head>
<body>
    <h2>Editar Registro</h2>
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
        <label for="user">Usuário:</label>
        <input type="text" id="user" name="user" value="<?php echo isset($row['user']) ? $row['user'] : ''; ?>" required><br><br>
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required><br><br>
        <label for="date_nasc">Data de Nascimento:</label>
        <input type="date" id="date_nasc" name="date_nasc" value="<?php echo isset($row['date_nasc']) ? $row['date_nasc'] : ''; ?>" required><br><br>
        <input type="submit" value="Atualizar">
    </form>
    <br>
    <a href="index.php">Voltar para a página inicial</a>
</body>
</html>
