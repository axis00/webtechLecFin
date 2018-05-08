function searchword() {
    var input, search, table, tr, td, i;
    input = document.getElementById("keyword");
    search = input.value.toUpperCase();
    table = document.getElementById("glossary");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(search) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
