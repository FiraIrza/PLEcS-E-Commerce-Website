function loadPage(page) {
    // Use AJAX to fetch the content of the selected page
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Update the content of the pageContent div
            document.getElementById('pageContent').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', page, true);
    xhr.send();
}
