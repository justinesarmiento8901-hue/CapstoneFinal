<?php
include 'dbForm.php'; // Include database connection file

if (isset($_GET['parent_id'])) {
    $parent_id = mysqli_real_escape_string($con, $_GET['parent_id']);

    $parentQuery = "SELECT first_name, last_name FROM parents WHERE id = '$parent_id' LIMIT 1";
    $parentResult = mysqli_query($con, $parentQuery);
    $parent = mysqli_fetch_assoc($parentResult);
    if (!$parent) {
        echo "Parent not found.";
        exit;
    }

    $vaccineReference = [];
    $referenceQuery = "SELECT vaccine_name, disease_prevented, age_stage FROM tbl_vaccine_reference ORDER BY FIELD(age_stage,'Birth','1½ mo','2½ mo','3½ mo','9 mo','1 yr'), vaccine_name ASC";
    $referenceResult = mysqli_query($con, $referenceQuery);
    if ($referenceResult) {
        while ($refRow = mysqli_fetch_assoc($referenceResult)) {
            $vaccineReference[] = $refRow;
        }
    }

    $infantQuery = "SELECT id, CONCAT_WS(' ', firstname, middlename, surname) AS full_name, dateofbirth, weight, height, sex FROM infantinfo WHERE parent_id = '$parent_id'";
    $infantResult = mysqli_query($con, $infantQuery);
    $infants = [];
    if ($infantResult) {
        while ($infantRow = mysqli_fetch_assoc($infantResult)) {
            $infantId = (int) $infantRow['id'];
            $fullName = trim(preg_replace('/\s+/', ' ', $infantRow['full_name']));
            $infantRow['full_name'] = $fullName;
            $statusMap = [];
            $historyRows = [];
            $detailsQuery = "SELECT vaccine_name, stage, status, updated_at FROM tbl_vaccination_details WHERE infant_id = $infantId";
            $detailsResult = mysqli_query($con, $detailsQuery);
            if ($detailsResult) {
                while ($detailRow = mysqli_fetch_assoc($detailsResult)) {
                    $statusMap[$detailRow['vaccine_name']][$detailRow['stage']] = $detailRow;
                    if (strcasecmp($detailRow['status'], 'Pending') !== 0) {
                        $historyRows[] = $detailRow;
                    }
                }
            }

            $vaccinationDetails = [];
            $completedCount = 0;
            $totalVaccines = count($vaccineReference);
            foreach ($vaccineReference as $referenceRow) {
                $vaccineName = $referenceRow['vaccine_name'];
                $stage = $referenceRow['age_stage'];
                $detail = $statusMap[$vaccineName][$stage] ?? null;
                $status = $detail['status'] ?? 'Pending';
                if ($status === 'Completed') {
                    $completedCount++;
                }
                $vaccinationDetails[] = [
                    'vaccine_name' => $vaccineName,
                    'disease_prevented' => $referenceRow['disease_prevented'],
                    'stage' => $stage,
                    'status' => $status,
                    'updated_at' => $detail['updated_at'] ?? ''
                ];
            }
            $infantRow['vaccinations'] = $vaccinationDetails;
            $infantRow['progress_total'] = $totalVaccines;
            $infantRow['progress_completed'] = $completedCount;
            $infantRow['progress_percent'] = $totalVaccines > 0 ? round(($completedCount / $totalVaccines) * 100) : 0;
            usort($historyRows, function ($a, $b) {
                $timeA = !empty($a['updated_at']) ? strtotime($a['updated_at']) : 0;
                $timeB = !empty($b['updated_at']) ? strtotime($b['updated_at']) : 0;
                if ($timeA === $timeB) {
                    return 0;
                }
                return ($timeA < $timeB) ? 1 : -1;
            });
            $infantRow['recent_history'] = array_slice($historyRows, 0, 5);
            $infants[] = $infantRow;
        }
    }
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="mb-1">Parent: <?php echo htmlspecialchars($parent['first_name'] . ' ' . $parent['last_name']); ?></h2>
                <p class="text-muted mb-0">Showing infants and vaccination records linked to this parent.</p>
            </div>
            <a href="view_parents.php" class="btn btn-primary">Back to Parent Records</a>
        </div>

        <?php if (!empty($infants)): ?>
            <?php foreach ($infants as $infant): ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Infant: <?php echo htmlspecialchars($infant['full_name']); ?> (ID: <?php echo (int) $infant['id']; ?>)</h5>
                    </div>
                    <div class="card-body">
                        <h6>Vaccination Progress</h6>
                        <?php if ($infant['progress_total'] > 0): ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-semibold">Completed Vaccines</span>
                                    <span class="text-muted"><?php echo $infant['progress_completed']; ?> / <?php echo $infant['progress_total']; ?> (<?php echo $infant['progress_percent']; ?>%)</span>
                                </div>
                                <div class="progress" style="height: 24px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: <?php echo $infant['progress_percent']; ?>%;"
                                        aria-valuenow="<?php echo $infant['progress_percent']; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo $infant['progress_percent']; ?>%
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No vaccine reference data available.</p>
                        <?php endif; ?>

                        <h6 class="mt-4">Vaccination Records</h6>
                        <?php if (!empty($infant['vaccinations'])): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Disease Prevented</th>
                                            <th>Vaccine</th>
                                            <th>Stage</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($infant['vaccinations'] as $record): ?>
                                            <?php
                                            $statusClass = ($record['status'] === 'Completed') ? 'bg-success text-white' : 'bg-warning text-dark';
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($record['disease_prevented']); ?></td>
                                                <td><?php echo htmlspecialchars($record['vaccine_name']); ?></td>
                                                <td><?php echo htmlspecialchars($record['stage']); ?></td>
                                                <td><span class="badge <?php echo $statusClass; ?>"><?php echo htmlspecialchars($record['status']); ?></span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted mb-0">No vaccination records found for this infant.</p>
                        <?php endif; ?>

                        <h6 class="mt-4">Recent History</h6>
                        <?php if (!empty($infant['recent_history'])): ?>
                            <div class="card border-secondary">
                                <div class="card-header bg-light">
                                    <span class="fw-semibold">Latest Updates</span>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <?php
                                    $historyDisplayed = false;
                                    foreach ($infant['recent_history'] as $history):
                                        if (empty($history['updated_at'])) {
                                            continue;
                                        }
                                        $historyTime = date('M d, Y g:i A', strtotime($history['updated_at']));
                                        $historyDisplayed = true;
                                    ?>
                                        <li class="list-group-item">
                                            <strong><?php echo htmlspecialchars($history['vaccine_name']); ?></strong>
                                            <span class="text-muted">(<?php echo htmlspecialchars($history['stage']); ?>)</span>
                                            &mdash; Status: <span class="badge bg-secondary"><?php echo htmlspecialchars($history['status']); ?></span>
                                            <div class="small text-muted">Updated: <?php echo htmlspecialchars($historyTime); ?></div>
                                        </li>
                                    <?php endforeach; ?>
                                    <?php if (!$historyDisplayed): ?>
                                        <li class="list-group-item text-muted">No recent vaccination updates recorded.</li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">No recent vaccination updates recorded.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">No infants found for this parent.</div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>