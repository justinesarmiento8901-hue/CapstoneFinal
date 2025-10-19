<?php
include 'dbForm.php';
require_once 'sms_queue_helpers.php';

header('Content-Type: application/json');

ensureSmsQueueTable($con);
ensureScheduleBarangayColumn($con);

$sql = "SELECT q.id, q.vacc_id, q.phone, q.barangay, q.next_dose_date, q.schedule_time,
               CONCAT_WS(' ', i.firstname, i.middlename, i.surname) AS infant_name
        FROM sms_queue q
        LEFT JOIN tbl_vaccination_schedule v ON v.vacc_id = q.vacc_id
        LEFT JOIN infantinfo i ON i.id = q.infant_id
        ORDER BY q.next_dose_date IS NULL, q.next_dose_date ASC, q.schedule_time ASC";

$result = mysqli_query($con, $sql);
$rows = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $phone = $row['phone'] ?? '';
        $nextDose = $row['next_dose_date'];
        $time = $row['schedule_time'];

        $rows[] = [
            'id' => (int) $row['id'],
            'vacc_id' => (int) $row['vacc_id'],
            'infant_name' => trim($row['infant_name'] ?? ''),
            'phone' => $phone,
            'barangay' => $row['barangay'] ?? '',
            'next_dose_date' => $nextDose,
            'schedule_time' => $time,
        ];
    }
}

echo json_encode($rows);
