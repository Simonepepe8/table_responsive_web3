<?php
require 'db.php';

$start  = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$search = $_POST['search']['value'] ?? '';
$gender = $_POST['gender'] ?? '';

$baseQuery = "FROM datatable WHERE 1=1";

// Filter by search
if ($search != '') {
  $search = mysqli_real_escape_string($conn, $search);
  $baseQuery .= " AND (first_name LIKE '%$search%' OR last_name LIKE '%$search%' OR email LIKE '%$search%')";
}

// Filter by gender
if ($gender != '') {
  $gender = mysqli_real_escape_string($conn, $gender);
  $baseQuery .= " AND gender = '$gender'";
}

// Get total records
$resTotal = mysqli_query($conn, "SELECT COUNT(*) as total $baseQuery");
$totalFiltered = mysqli_fetch_assoc($resTotal)['total'];

// Fetch actual data
$dataQuery = "SELECT id, first_name, last_name, email, position, gender $baseQuery LIMIT $start, $length";
$resData = mysqli_query($conn, $dataQuery);

$data = [];
while ($row = mysqli_fetch_assoc($resData)) {
  $data[] = $row;
}

echo json_encode([
  "draw" => intval($_POST['draw'] ?? 1),
  "recordsTotal" => $totalFiltered,
  "recordsFiltered" => $totalFiltered,
  "data" => $data
]);
?>
