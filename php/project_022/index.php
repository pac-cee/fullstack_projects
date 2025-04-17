<?php
$filename = 'data.csv';
if (!file_exists($filename)) {
    echo "CSV file not found.";
    exit;
}
echo "<table border='1'><tr>";
// read header row
if (($handle = fopen($filename, 'r')) !== false) {
    $headers = fgetcsv($handle);
    foreach ($headers as $h) {
        echo "<th>" . htmlspecialchars($h) . "</th>";
    }
    echo "</tr>";
    while (($row = fgetcsv($handle)) !== false) {
        echo "<tr>";
        foreach ($row as $cell) {
            echo "<td>" . htmlspecialchars($cell) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    fclose($handle);
} else {
    echo "Could not open CSV file.";
}
?>
