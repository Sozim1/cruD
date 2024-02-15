<?php
    include("database.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>
    <link rel="stylesheet" type="text/css" href="css_file/_index.css">
</head>
<body>
    <h2>Registros existentes:</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Data de Registro</th>
            <th>Ações</th>
        </tr>

        <?php
        $sql = "SELECT * FROM usuarios";
        $result = mysqli_query($conn, $sql);


        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>".$row["id"]."</td>
                        <td>".$row["user"]."</td>
                        <td>".$row["email"]."</td>
                        <td>".$row["date_nasc"]."</td>
                        <td>".$row["date_reg"]."</td>
                        <td>
                            <a href='edit.php?id=".$row["id"]."'>Editar</a> |
                            <a href='delete.php?id=".$row["id"]."'>Excluir</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
        }
        ?>
        
    </table>
    <br>
    <a href="add.php" class="add-button">Adicionar novo registro</a>  
    <a href="pdf.php" target="_blank" class="pdf-button">Gerar PDF</a>
</body>
</html>

<?php
mysqli_close($conn);
?>
