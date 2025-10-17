<?php
include 'dbForm.php';

$term = trim($_GET['q'] ?? '');

if ($term === '') {
    exit;
}

$stmt = $con->prepare("
    SELECT id, CONCAT_WS(' ', firstname, middlename, surname) AS name
    FROM infantinfo
    WHERE firstname LIKE CONCAT('%', ?, '%')
       OR middlename LIKE CONCAT('%', ?, '%')
       OR surname LIKE CONCAT('%', ?, '%')
    ORDER BY firstname ASC
    LIMIT 10
");
$stmt->bind_param("sss", $term, $term, $term);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<button type='button' class='list-group-item list-group-item-action' data-id='{$row['id']}'>{$row['name']}</button>";
}
