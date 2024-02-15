<?php
// Inclua o arquivo de conexão com o banco de dados
include 'database.php';

// Inclua a biblioteca Dompdf
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Crie uma nova instância do Dompdf
$dompdf = new Dompdf();

// Consulta os registros no banco de dados
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

// Crie o conteúdo HTML para o PDF
$html = '<h1>Extrato de Registros</h1>';

// Verifique se há registros
if (mysqli_num_rows($result) > 0) {
    $html .= '<table border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <th>ID</th>
                    <th>Usuário</th>
                    <th>Senha</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                </tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>
                    <td>' . $row['id'] . '</td>
                    <td>' . $row['user'] . '</td>
                    <td>' . $row['password'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['date_nasc'] . '</td>
                </tr>';
    }
    $html .= '</table>';
} else {
    $html .= '<p>Nenhum registro encontrado.</p>';
}

// Carregue o conteúdo HTML no Dompdf
$dompdf->loadHtml($html);

// Renderize o PDF
$dompdf->render();

// Saída do PDF
$dompdf->stream('extrato_registros.pdf', ['Attachment' => 0]);
