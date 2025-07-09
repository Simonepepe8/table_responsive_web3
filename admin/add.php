<?php
//require 'auth.php';
$success = '';
$error = '';
// ถ้ากด submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db.php';

    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $position = trim($_POST['position']);
    $gender = trim($_POST['gender']);

    if ($first_name && $last_name && $email && $position && $gender) {
        $stmt = $conn->prepare("INSERT INTO datatable (first_name, last_name, email, position, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $position, $gender);

        $stmt->close();
    } else {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เพิ่มพนักงาน</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="dashboard-add add-employee">
  <h1>เพิ่มพนักงาน</h1>

  <?php if ($success): ?>
    <div class="alert success"><?= $success ?></div>
  <?php endif; ?>

  <?php if ($error): ?>
    <div class="alert error"><?= $error ?></div>
  <?php endif; ?>

  <form method="post" class="form">
    <label>ชื่อ: <input type="text" name="first_name" required></label>
    <label>นามสกุล: <input type="text" name="last_name" required></label>
    <label>Email: <input type="email" name="email" required></label>
    <label>ตำแหน่ง: <input type="text" name="position" required></label>
    <label>เพศ:
      <select name="gender" required>
        <option value="">--เลือกเพศ--</option>
        <option value="Male">ชาย</option>
        <option value="Female">หญิง</option>
        <option value="Other">อื่น ๆ</option>
      </select>
    </label>
    <button onclick="myFunction()" type="submit" class="btn btn-add">เพิ่มพนักงาน</button>
    <a href="index.php" class="btn">กลับ</a>
  </form>
</body>
</html>
<script>
    function myFunction() {
  Swal.fire("เพิ่มพนักงานสำเร็จ!");
}
</script>