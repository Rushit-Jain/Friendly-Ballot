let url = window.location.href;
let len = url.length - 1;
let element;
if (url.charAt(len) == '1') {
    element = document.getElementById('create');
}
if (url.charAt(len) == '2') {
    element = document.getElementById('manage');
}
if (url.charAt(len) == '3') {
    element = document.getElementById('cast');
}
if (url.charAt(len) == '4') {
    element = document.getElementById('apply');
}
if (url.charAt(len) == '5') {
    element = document.getElementById('view');
}
if (element != undefined) {
    element.style.backgroundColor = "#fffff0";
    element.style.color = "purple";
    element.style.borderRadius = "25px";
}