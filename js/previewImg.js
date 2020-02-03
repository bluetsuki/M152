var loadFile = function(event) {
    var parent = document.getElementById("previewImg");
    parent.innerHTML = "";
    for(var i = 0; i < event.target.files.length; i++){
        var child = document.createElement("img");
        child.width = 200;
        child.className = 'ml-3';
        child.src = URL.createObjectURL(event.target.files[i]);
        parent.append(child);
    }
};
