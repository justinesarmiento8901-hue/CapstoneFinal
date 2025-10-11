<?php
include 'dbForm.php';

session_start(); // Ensure session is started
$showDeleteButton = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
$showEditButton = isset($_SESSION['user']['role']) && $_SESSION['user']['role'] !== 'parent';

$search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';

$sql = "SELECT * FROM infantinfo WHERE 
        id LIKE '%$search%' OR
        firstname LIKE '%$search%' OR 
        middlename LIKE '%$search%' OR 
        surname LIKE '%$search%' OR 
        placeofbirth LIKE '%$search%'";

$result = mysqli_query($con, $sql);
$output = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
            <td>{$row['id']}</td>
            <td>{$row['firstname']}</td>
            <td>{$row['middlename']}</td>
            <td>{$row['surname']}</td>
            <td>{$row['dateofbirth']}</td>
            <td>{$row['placeofbirth']}</td>
            <td>{$row['sex']}</td>
            <td>{$row['weight']}</td>
            <td>{$row['height']}</td>
            <td>{$row['bloodtype']}</td>
            <td>{$row['nationality']}</td>
            <td>";
        if ($showEditButton) {
            $output .= "<button class='btn btn-success btn-sm' onclick='confirmEdit({$row['id']})'>Edit</button>";
        }
        if ($showDeleteButton) {
            $output .= "<a href='#' class='btn btn-danger btn-sm' onclick='confirmDelete({$row['id']})'>Delete</a>";
        }
        $output .= "</td>
        </tr>";
    }
} else {
    $output = "<tr><td colspan='12'>No records found.</td></tr>";
}

echo $output;
