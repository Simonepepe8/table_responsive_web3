<?php
//require 'auth.php';
require 'db.php';

$success = '';
$error = '';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ดึงข้อมูลเดิมมาแสดงในฟอร์ม
$stmt = $conn->prepare("SELECT * FROM datatable WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

if (!$employee) {
  die("ไม่พบข้อมูลพนักงาน");
}
$stmt->close();

// ถ้า submit ฟอร์มมา
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = trim($_POST['first_name']);
  $last_name = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $position = trim($_POST['position']);
  $gender = trim($_POST['gender']);

  if ($first_name && $last_name && $email && $position && $gender) {
    $stmt = $conn->prepare("UPDATE datatable SET first_name=?, last_name=?, email=?, position=?, gender=? WHERE id=?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $position, $gender, $id);

    if ($stmt->execute()) {
      $success = "อัปเดตข้อมูลเรียบร้อยแล้ว";
    } else {
      $error = "เกิดข้อผิดพลาดในการอัปเดต";
    }

    $stmt->close();
  } else {
    $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>แก้ไขพนักงาน</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>แก้ไขข้อมูลพนักงาน</h1>

  <?php if ($success): ?>
    <div class="alert success"><?= $success ?></div>
  <?php endif; ?>
  <?php if ($error): ?>
    <div class="alert error"><?= $error ?></div>
  <?php endif; ?>

  <form method="post" class="form">
    <label>ชื่อ: <input type="text" name="first_name" value="<?= htmlspecialchars($employee['first_name']) ?>" required></label>
    <label>นามสกุล: <input type="text" name="last_name" value="<?= htmlspecialchars($employee['last_name']) ?>" required></label>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($employee['email']) ?>" required></label>
    <label>ตำแหน่ง: <input type="text" name="position" value="<?= htmlspecialchars($employee['position']) ?>" required></label>
    <label>เพศ:
      <select name="gender" required>
        <option value="">--เลือกเพศ--</option>
        <option value="Male" <?= $employee['gender'] == 'Male' ? 'selected' : '' ?>>ชาย</option>
        <option value="Female" <?= $employee['gender'] == 'Female' ? 'selected' : '' ?>>หญิง</option>
        <option value="Other" <?= $employee['gender'] == 'Other' ? 'selected' : '' ?>>อื่น ๆ</option>
      </select>
    </label>
    <button type="submit" class="btn btn-edit">อัปเดต</button>
    <a href="index.php" class="btn">กลับ</a>
  </form>
</body>
</html>