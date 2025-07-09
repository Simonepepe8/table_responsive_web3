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
      { data: 'gender' }
    ]
  });

  $('#genderFilter').on('change', function () {
    table.ajax.reload();
  });
});export function openPopup(mode, data = {}) {
  $('#overlay').show();
  $('#crudPopup').show();
  $('#popupTitle').text(mode === 'add' ? 'Add Employee' : 'Edit Employee');
  $('#crudForm')[0].reset();
  if (mode === 'edit') {
    $('#empId').val(data.id);
    $('[name="first_name"]').val(data.first_name);
    $('[name="last_name"]').val(data.last_name);
    $('[name="email"]').val(data.email);
    $('[name="position"]').val(data.position);
    $('[name="gender"]').val(data.gender);
  }
}

