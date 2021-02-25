// This function allows changes to the data table on the Home/Index View.
// pagingType:full_numbers adds the number buttons at the bottom of the table.
// order:2,asc sets the third column in ascending order.
$(document).ready( function () {
    $('#dataTable').DataTable({
        "pagingType": "full_numbers",
        "order": [[ 2, "asc" ]]
    });
} );
