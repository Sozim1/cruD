<?php
include 'database.php';

// Verifica se o ID do registro a ser excluído foi fornecido via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Constrói a consulta SQL para excluir o registro
    $sql = "DELETE FROM usuarios WHERE id = $id";

    // Executa a consulta SQL
    if (mysqli_query($conn, $sql)) {
        // Redireciona para a página inicial após a exclusão
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao excluir registro: " . mysqli_error($conn);
    }
} else {
    echo "ID do registro não fornecido.";
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>
