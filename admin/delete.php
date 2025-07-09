<?php
//require 'auth.php';
require 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
  $stmt = $conn->prepare("DELETE FROM datatable WHERE id = ?");
  $stmt->bind_param("i", $id);
  if ($stmt->execute()) {
    header("Location: index.php");
    exit;
  } else {
    die("ลบไม่สำเร็จ");
  }
}
$conn->close();
?>