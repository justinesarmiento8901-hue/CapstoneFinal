<?php
include 'dbForm.php';

session_start(); // Ensure session is started
$showDeleteButton = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';

$search = isset($_POST['search']) ? mysqli_real_escape_string($con, $_POST['search']) : '';

$sql = "SELECT parents.*, 
           GROUP_CONCAT(infantinfo.id SEPARATOR ', ') AS infant_ids, 
           GROUP_CONCAT(infantinfo.firstname SEPARATOR ', ') AS infant_names
        FROM parents
        LEFT JOIN infantinfo ON parents.id = infantinfo.parent_id
        WHERE 
            parents.id LIKE '%$search%' OR
            parents.first_name LIKE '%$search%' OR 
            parents.last_name LIKE '%$search%' OR 
            parents.email LIKE '%$search%'
        GROUP BY parents.id";

$result = mysqli_query($con, $sql);
$output = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
            <td>{$row['id']}</td>
            <td>{$row['first_name']}</td>
            <td>{$row['last_name']}</td>
            <td>{$row['phone']}</td>
            <td>{$row['email']}</td>
            <td>{$row['address']}</td>
            <td>" . ($row['infant_ids'] ?: 'N/A') . "</td>
            <td>" . ($row['infant_names'] ?: 'N/A') . "</td>
            <td>
                <button class='btn btn-success btn-sm' onclick='confirmEdit({$row['id']})'>Edit</button>";
        if ($showDeleteButton) {
            $output .= "<button class='btn btn-danger btn-sm' onclick='confirmDelete({$row['id']})'>Delete</button>";
        }
        $output .= "<a href='view_details.php?parent_id={$row['id']}' class='btn btn-info btn-sm'>Details</a>";
        $output .= "</td>
        </tr>";
    }
} else {
    $output = "<tr><td colspan='9' class='text-center'>No records found.</td></tr>";
}

echo $output;
