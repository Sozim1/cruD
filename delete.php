<?php
include 'database.php';


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "DELETE FROM usuarios WHERE id = $id";

    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao excluir registro: " . mysqli_error($conn);
    }
} else {
    echo "ID do registro não fornecido.";
}

mysqli_close($conn);
?>
