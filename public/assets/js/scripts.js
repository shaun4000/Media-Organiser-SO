// Function to add a Song Field within the Add-Album View.
// This Function will create a Name Input, File Input and Comments Input.
// The Variable 'song' will plus 1 every time the Function is called.
// This will store the input values into a variable for the AlbumController to loop through.
var song = 1;
function add_fields() {
    song++;

    // Label for the Song Group
    var objTo = document.createElement('label');
    objTo.setAttribute("class", "labels");
    objTo.setAttribute("for", "songs["+song+"]");
    objTo.innerHTML = "<strong> Song "+song+"</strong>"
    document.getElementById('song-group').appendChild(objTo);

    // Div to group the Song Name and Prepend
    var objTo = document.createElement('div');
    objTo.setAttribute("class", "input-group mb-2");
    objTo.setAttribute("id", "name-input"+song);
    document.getElementById('song-group').appendChild(objTo);

    // Div to position the Prepend for Song Name
    var objTo = document.createElement('div');
    objTo.setAttribute("class", "input-group-prepend");
    objTo.setAttribute("id", "name-span"+song);
    document.getElementById('name-input'+song).appendChild(objTo);

    // Span with Text for the Prepend for Song Name
    var objTo = document.createElement('span');
    objTo.setAttribute("class", "input-group-text inputs");
    objTo.innerHTML = "Song Name";
    document.getElementById('name-span'+song).appendChild(objTo);

    // Input for the Song Name
    var objTo = document.createElement('input');
    objTo.setAttribute("class", "form-control");
    objTo.setAttribute("type", "text");
    objTo.setAttribute("name", "songs["+song+"]");
    document.getElementById('name-input'+song).appendChild(objTo);

    // Input for the Song File
    var objTo = document.createElement('input');
    objTo.setAttribute("class", "form-control-file mb-2 border rounded");
    objTo.setAttribute("type", "file");
    objTo.setAttribute("name", "file["+song+"]");
    document.getElementById('song-group').appendChild(objTo);

    // Div to position the Prepend for Song Name
    var objTo = document.createElement('div');
    objTo.setAttribute("class", "input-group mb-2");
    objTo.setAttribute("id", "comment-input"+song);
    document.getElementById('song-group').appendChild(objTo);

    // Div to position the Prepend for Comments
    var objTo = document.createElement('div');
    objTo.setAttribute("class", "input-group-prepend");
    objTo.setAttribute("id", "input-span"+song);
    document.getElementById('comment-input'+song).appendChild(objTo);

    // Span with Text for the Prepend
    var objTo = document.createElement('span');
    objTo.setAttribute("class", "input-group-text inputs");
    objTo.innerHTML = "Song Comments";
    document.getElementById('input-span'+song).appendChild(objTo);

    // Input for the Song Comments
    var objTo = document.createElement('input');
    objTo.setAttribute("class", "form-control inputs");
    objTo.setAttribute("type", "text");
    objTo.setAttribute("name", "comments["+song+"]");
    document.getElementById('comment-input'+song).appendChild(objTo);
}
