function outputUpdate(price) {
    var gifHtml = "";
    for (i = 0; i < price; i++) {
        gifHtml += '<img src="/img/dollar.gif" width="48" height="48" alt="dolla dolla bill yall"/>'
    }
    document.getElementById("dollars").innerHTML = gifHtml;
}
