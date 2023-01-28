// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    "language": {
      "paginate": {
        "previous": "‹",
        "next": "›"
      },
      "emptyTable": "Data Kosong",
      "info": "",
      "infoFiltered": "",
      "infoEmpty": "",
      "lengthMenu": "Tampilkan _MENU_ Baris Data",
      "zeroRecords": "Pencarian Tidak Ditemukan...",
    },
    "ordering": false,
  });

  $('#reportTable').DataTable({
    "language": {
      "paginate": {
        "previous": "‹",
        "next": "›"
      },
      "emptyTable": "Data Kosong",
      "info": "",
      "infoFiltered": "",
      "infoEmpty": "",
      "lengthMenu": "Tampilkan _MENU_ Baris Data",
      "zeroRecords": "Pencarian Tidak Ditemukan...",
    },
    'searching': false,
    "ordering": false,
    "lengthChange": false,
  });
});
