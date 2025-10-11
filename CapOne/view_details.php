<?php
include 'dbForm.php'; // Include database connection file

if (isset($_GET['parent_id'])) {
    $parent_id = mysqli_real_escape_string($con, $_GET['parent_id']);

    // Fetch parent information
    $parentQuery = "SELECT first_name, last_name FROM parents WHERE id = '$parent_id'";
    $parentResult = mysqli_query($con, $parentQuery);
    $parent = mysqli_fetch_assoc($parentResult);

    // Fetch infant records
    $infantQuery = "SELECT id, CONCAT(firstname, ' ', surname) AS full_name, dateofbirth, weight, height FROM infantinfo WHERE parent_id = '$parent_id'";
    $infantResult = mysqli_query($con, $infantQuery);
} else {
    echo "Parent ID is required.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Infant Records</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Infant Records</h2>
        <h4 class="text-center">Parent: <?php echo $parent['first_name'] . ' ' . $parent['last_name']; ?></h4>
        <table class="table table-bordered table-striped mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Weight</th>
                    <th>Height</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($infantResult) > 0): ?>
                    <?php while ($infant = mysqli_fetch_assoc($infantResult)): ?>
                        <tr>
                            <td><?php echo $infant['id']; ?></td>
                            <td><?php echo $infant['full_name']; ?></td>
                            <td><?php echo $infant['dateofbirth']; ?></td>
                            <td><?php echo $infant['weight']; ?></td>
                            <td><?php echo $infant['height']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="view_parents.php" class="btn btn-primary">Back to Parent Records</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>