function show_img(e) {
  var source = e.getAttribute('src');
  var elem = document.getElementById('big_img');
  elem.setAttribute("src", source);
}
