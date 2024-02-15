<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("database.php");

    // Preparação dos dados
    $user = $_POST['user'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $date_nasc = $_POST['date_nasc'];

    // Inserção no banco de dados
    $sql = "INSERT INTO usuarios (user, password, email, date_nasc, date_reg) VALUES ('$user', '$password', '$email', '$date_nasc', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Novo registro adicionado com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Registro</title>
    <link rel="stylesheet" type="text/css" href="css_file/_add.css">

</head>
<body>
    <h2>Adicionar Novo Registro</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="user">Usuário:</label><br>
        <input type="text" id="user" name="user" required><br>
        <label for="password">Senha:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="date_nasc">Data de Nascimento:</label><br>
        <input type="date" id="date_nasc" name="date_nasc" required><br><br>
        <label for="confirmacao">Confirmo as informações a cima: <input type="checkbox" id="confirmacao" name="confirmacao" required> </label><br>
        <input type="submit" value="Adicionar">

    </form>
    <br>
    <a href="index.php">Voltar para a página inicial</a>
</body>
</html>
