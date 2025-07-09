
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Employee Dashboard</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="popup-alert.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
</head>
<body>
  <header>
    <h1>Employee Dashboard</h1>
  </header>

  <main>
    <div class="actions">
      <button type="buttonadd" class="btn btn-add" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">+เพิ่มพนักงาน</button>
      <a href="logout.php" class="btn btn-logout">ออกจากระบบ</a>
      <!-- สามารถเพิ่มปุ่ม Export / Import / อื่น ๆ ได้ที่นี่ -->
    </div>

    <table id="employeeTable" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>First name</th>
          <th>Last name</th>
          <th>Email</th>
          <th>Position</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
      </thead>
    </table>
  </main>

  <!-- JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <?php
          include 'add.php';
        ?>
      </div>
    </div>
  </div>
</div>