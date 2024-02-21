function getSubcategories(categoryId) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("subcategory-dropdown-" + categoryId).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "get_subcategories.php?category_id=" + categoryId, true);
    xhttp.send();
}
