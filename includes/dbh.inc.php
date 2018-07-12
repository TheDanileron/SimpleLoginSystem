<?php
/**
 * Created by PhpStorm.
 * User: www
 * Date: 12.07.2018
 * Time: 14:34
 */

$userName = 'loginTrain';
$password = '1234';
$connectionString = 'localhost/xe';
$conn = oci_connect($userName, $password, $connectionString);
if (!$conn) {
    $m = oci_error();
    trigger_error('Could not connect to database: ' . $m['message'], E_USER_ERROR);
}
$s = oci_parse($conn, "SELECT * FROM USERS");
if (!$s) {
    $m = oci_error($conn);
    trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
}
$r = oci_execute($s);
if (!$r) {
    $m = oci_error($s);
    trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
}
$r = oci_fetch_all($s, $res);

echo "<table border='1'>";
foreach ($res as $column) {
    echo "<tr>";
    foreach ($column as $item) {
        echo "<td>$item</td>";
    }
    echo "</tr>";
}
echo "</table>\n";