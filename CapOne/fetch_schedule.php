<?php
include 'dbForm.php';

$sql = "SELECT 
            v.vacc_id,
            v.infant_id,
            CONCAT_WS(' ', i.firstname, i.middlename, i.surname) AS infant_name,
            CONCAT_WS(' ', p.first_name, p.last_name) AS parent_name,
            p.phone AS parent_contact,
            v.vaccine_name,
            v.date_vaccination,
            v.next_dose_date,
            v.status,
            v.remarks
        FROM tbl_vaccination_schedule v
        JOIN infantinfo i ON v.infant_id = i.id
        JOIN parents p ON i.parent_id = p.id
        ORDER BY i.id ASC, v.date_vaccination DESC";

$res = mysqli_query($con, $sql);
$rows = '';
$grouped_data = [];
$count = 1;

if ($res) {
    // Group data by infant_id
    while ($r = mysqli_fetch_assoc($res)) {
        $grouped_data[$r['infant_id']][] = $r;
    }

    // Display grouped data
    foreach ($grouped_data as $infant_id => $vaccines) {
        $first_vaccine = $vaccines[0]; // Get infant info from first vaccine
        $infantEsc = htmlspecialchars($first_vaccine['infant_name']);
        $parentEsc = htmlspecialchars($first_vaccine['parent_name']);

        // Add infant header row
        $rows .= "<tr class='infant-group-header'>
            <td rowspan='" . count($vaccines) . "'>{$count}</td>
            <td rowspan='" . count($vaccines) . "'><a href='#' class='infantLink' data-id='{$infant_id}'>{$infantEsc}</a></td>
            <td rowspan='" . count($vaccines) . "'>{$parentEsc}</td>
            <td rowspan='" . count($vaccines) . "'>{$first_vaccine['parent_contact']}</td>
            <td>{$first_vaccine['vaccine_name']}</td>
            <td>{$first_vaccine['date_vaccination']}</td>
            <td>{$first_vaccine['next_dose_date']}</td>
            <td class='text-center'>
                <input type='checkbox' class='form-check-input statusCheckbox' data-id='{$first_vaccine['vacc_id']}' " . (($first_vaccine['status'] === 'Completed') ? 'checked' : '') . ">
                <div style='margin-top:4px'>" . (($first_vaccine['status'] === 'Completed') ? "<span class='badge bg-success'>Completed</span>" : "<span class='badge bg-warning'>Pending</span>") . "</div>
            </td>
            <td>" . htmlspecialchars($first_vaccine['remarks']) . "</td>
            <td class='text-center'>
                <button class='btn btn-sm btn-warning editBtn' data-id='{$first_vaccine['vacc_id']}'>Edit</button>
                <button class='btn btn-sm btn-danger deleteBtn' data-id='{$first_vaccine['vacc_id']}'>Delete</button>
            </td>
        </tr>";

        // Add remaining vaccines for this infant
        for ($i = 1; $i < count($vaccines); $i++) {
            $vaccine = $vaccines[$i];
            $vaccineEsc = htmlspecialchars($vaccine['vaccine_name']);
            $remarksEsc = htmlspecialchars($vaccine['remarks']);
            $statusBadge = ($vaccine['status'] === 'Completed') ? "<span class='badge bg-success'>Completed</span>" : "<span class='badge bg-warning'>Pending</span>";
            $checked = ($vaccine['status'] === 'Completed') ? 'checked' : '';

            $rows .= "<tr class='vaccine-row'>
                <td>{$vaccineEsc}</td>
                <td>{$vaccine['date_vaccination']}</td>
                <td>{$vaccine['next_dose_date']}</td>
                <td class='text-center'>
                    <input type='checkbox' class='form-check-input statusCheckbox' data-id='{$vaccine['vacc_id']}' {$checked}>
                    <div style='margin-top:4px'>{$statusBadge}</div>
                </td>
                <td>{$remarksEsc}</td>
                <td class='text-center'>
                    <button class='btn btn-sm btn-warning editBtn' data-id='{$vaccine['vacc_id']}'>Edit</button>
                    <button class='btn btn-sm btn-danger deleteBtn' data-id='{$vaccine['vacc_id']}'>Delete</button>
                </td>
            </tr>";
        }
        $count++;
    }
} else {
    $rows = "<tr><td colspan='10' class='text-center text-danger'>Query error: " . mysqli_error($con) . "</td></tr>";
}
echo $rows;
