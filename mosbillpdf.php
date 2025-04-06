<?php
require 'vendor/autoload.php';

use Dompdf\Dompdf;

// 1. Connect to MySQL
$host = "localhost";
$user = "root";
$password = "1234";
$database = "mosburgers"; 
$table = "invoice";       

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Fetch data
$sql = "SELECT * FROM invoice ;";
$result = $conn->query($sql);

ob_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Export Table</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<h2>Invoice</h2>
<table>
    <tr>
        <?php
        if ($result->num_rows > 0) {
            $firstRow = $result->fetch_assoc();
            foreach ($firstRow as $col => $val) {
                echo "<th>$col</th>";
            }
            echo "</tr><tr>";
            foreach ($firstRow as $val) {
                echo "<td>$val</td>";
            }
        }

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $val) {
                echo "<td>$val</td>";
            }
            echo "</tr>";
        }
        ?>
    </tr>
</table>
</body>
</html>

<?php
$html = ob_get_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

$dompdf->stream("exported_table.pdf", array("Attachment" => false));
?>
