$(document).ready(function () {
  const table = $('#employeeTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: 'server_processing.php',
      type: 'POST',
      data: function (d) {
        d.gender = $('#genderFilter').val();
      }
    },
    columns: [
      { data: 'id' },
      { data: 'first_name' },
      { data: 'last_name' },
      { data: 'email' },
      { data: 'position' },
      { data: 'gender' },
      {
        data: null,
        render: function (data, type, row) {
          return `
          <a href="edit.php?id=${data.id}" class="btn-table btn-edit">แก้ไข</a>
          <a href="delete.php?id=${data.id}" class="btn-table btn-delete">ลบ</a>
        `;
        }
      }
    ]
  });
    $('#crudForm').submit(function(e) {
    e.preventDefault();
    const formData = $(this).serialize();
    const id = $('#empId').val();
    const type = id ? 'edit' : 'add';
    $.post('save.php', formData, function(response) {
      closePopup();
      table.ajax.reload();
      try {
        const res = JSON.parse(response);
        showAlertByType(type, res);
      } catch (e) {
        showAlertByType('default', {});
      }
    });
  });
});

