<?php
include 'dbForm.php';
if (!isset($_GET['vacc_id'])) {
    echo json_encode([]);
    exit;
}
$id = intval($_GET['vacc_id']);
$stmt = mysqli_prepare($con, "SELECT vacc_id, infant_id, vaccine_name, date_vaccination, next_dose_date, status, remarks FROM tbl_vaccination_schedule WHERE vacc_id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($res);
echo json_encode($data ?: []);
