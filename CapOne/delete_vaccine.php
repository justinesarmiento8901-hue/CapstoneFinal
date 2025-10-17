<?php
include 'dbForm.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['vacc_id'])) {
    echo 'Invalid request';
    exit;
}
$id = intval($_POST['vacc_id']);

// optional: check privileges / ownership here

$stmt = mysqli_prepare($con, "DELETE FROM tbl_vaccination_schedule WHERE vacc_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
if (mysqli_stmt_execute($stmt)) {
    echo 'deleted';
} else {
    echo 'Delete error: ' . mysqli_error($con);
}
