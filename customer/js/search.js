function performSearch() {
    // Get the value from the search input
    var searchValue = document.getElementById("search").value;

    // Redirect to the search page or execute an AJAX request to fetch search results
    window.location.href = "index.php?search=" + encodeURIComponent(searchValue);
}

// Trigger search when Enter key is pressed in the search input
document.getElementById("search").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        performSearch();
    }
});