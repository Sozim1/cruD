<?php
include 'database.php';

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

$html = '<h1>Extrato de Registros</h1>';

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

$dompdf->loadHtml($html);

$dompdf->render();

$dompdf->stream('extrato_registros.pdf', ['Attachment' => 0]);
