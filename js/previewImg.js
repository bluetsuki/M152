var loadFile = function(event) {
    var parent = document.getElementById("previewImg");
    parent.innerHTML = "";
    for(var i = 0; i < event.target.files.length; i++){
        var k = document.createElement("img");
        k.width = 200;
        k.className = 'ml-3';
        k.src = URL.createObjectURL(event.target.files[i]);
        parent.append(k);
    }
};
