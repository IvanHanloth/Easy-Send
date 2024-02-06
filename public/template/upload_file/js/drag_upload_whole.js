
var dropzone = document.getElementsByTagName('body')[0];
zone = document.getElementById('whole-zone');
zone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    if (e.target === zone) {
        zone.style.display = 'none';
    }
    if (e.target === dropzone) {
        zone.style.display = 'none';
    }
});
zone.addEventListener('dragover', function(e) {
    e.preventDefault();
    zone.style.display = 'flex';
});
dropzone.addEventListener('dragover', function(e) {
    e.preventDefault();
    zone.style.display = 'flex';
});
zone.addEventListener('drop', function(ev) {
    ev.preventDefault();
    if (ev.dataTransfer.types[0] == 'Files') {
        var files = ev.dataTransfer.files;
        fileUpload.choose(files[0])
    } else if (ev.dataTransfer.types[0] == 'text/plain') {
        var text = ev.dataTransfer.getData('text/plain');
        textUpload.setValue(text)
    }
    zone.style.display = 'none';
});