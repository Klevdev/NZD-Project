function openTab(tabName, page) {
    let request = new XMLHttpRequest();

    let requestPath = `/administrative/${tabName}_ajax?page=${page}`;
    request.open('GET', requestPath);
    request.onload = () => {
        if (request.status != 200) {
            alert(request.responseText);
        } else {
            // alert(request.responseText);
            document.getElementById('tabContent').innerHTML = request.responseText;
        }
    };
    request.send();
}