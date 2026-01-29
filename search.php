<fieldset style="width: 500px;">
    <legend>SEARCH</legend>
    <input type="text" id="nameInput" onkeyup="ajaxSearch()" placeholder="Type to search..."> 
    <button type="button" onclick="ajaxSearch()">Search By Name</button>
    <hr>
    <div id="resultTable">
        </div>
</fieldset>

<script>
function ajaxSearch() {
    let input = document.getElementById("nameInput").value;
    let resultDiv = document.getElementById("resultTable");

    if (input == "") {
        resultDiv.innerHTML = "";
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "search_results.php?q=" + input, true);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            resultDiv.innerHTML = this.responseText;
        }
    };
    xhr.send();
}
</script>