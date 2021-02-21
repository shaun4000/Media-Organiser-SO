var song = 1;
function add_fields() {
    song++;
    var objTo = document.createElement('input');
    objTo.setAttribute("class", "form-control mb-2");
    objTo.setAttribute("type", "text");
    objTo.setAttribute("name", "songs["+song+"]");
    document.getElementById('song-group').appendChild(objTo);
    var objTo = document.createElement('input');
    objTo.setAttribute("class", "form-control-file mb-2");
    objTo.setAttribute("type", "file");
    objTo.setAttribute("name", "file["+song+"]");
    document.getElementById('song-group').appendChild(objTo);
}

$(document).ready( function () {
    $('#dataTable').DataTable({
        "pagingType": "full_numbers",
        "order": [[ 2, "asc" ]]
    });
} );
