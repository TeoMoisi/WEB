
function concatenate() {
  var inp = ""
  var x = document.getElementsByName("inp");
  for (var i = 0; i < x.length; i ++) {
    inp = inp + " " + x[i].value;
  }
  inp += document.getElementsByClassName("span_class")[0].innerText;

  document.getElementById("result").style.backgroundColor = "blue";
  document.getElementById("result").innerHTML = "The result is " + inp;

}

function press(e) {
  document.getElementById("result").innerHTML += String.fromCharCode(e.which);
  //console.log("e " + e);
}

function addInList() {
  var value = document.getElementsByName("is_inp")[0].value;
  //document.getElementById("unord_list").innerHTML +="<li>" + value + "</li>";
  var li_elem = document.createElement('li');
  li_elem.innerText = value;
  document.getElementById("unord_list").appendChild(li_elem);
}

function clickHandler()
{
    //setTimeout( function() { addInList(); }, 3000 );
    setInterval( function() { addInList(); }, 3000);
}
