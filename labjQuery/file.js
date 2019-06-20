var ID;
var SCORE = 0;
var myTimer;

$(document).ready(function(){
  function rnd(max) { return Math.floor(Math.random()*(max+1)) };

function createImage(container, maxwidth, maxheight, imgsrc) {
    $(ID).hide();
    var id = "newimage" + rnd(1000000);
    var leftPos = rnd(maxwidth);
    var rightPos = rnd(maxheight);
    console.log("left", leftPos);
    $(container).append(
        "<img id='" + id + "' src='" + imgsrc +
        "' style='display:block; float:left; position:absolute; width: 300px; height: 350px;" +
        "margin-left:" + leftPos + "px;" +
        "top:"  + rightPos + "px'>");
    return "#" + id;
};

function theEnd() {
  clearInterval(myTimer);
  $("#score").text(SCORE);
  SCORE += 1;
  $(ID).hide();
  $("#container").append("<h2>YOU WON!</h2>");
  var r= $('<input type="button" value="Restart game!" id="refresh_button"/>');
  $("#container").append(r);
  $('#refresh_button').click(function() {
    location.reload();
});
}

function increaseScore() {
  $(ID).click(function() {
    SCORE += 1;
  });
  $("#score").text(SCORE);
}


var myTimer = setInterval(function() {
  if (SCORE < 10) {
      ID = createImage("#container", 800, 500, "images/img" + rnd(7) + ".jpg");
      increaseScore();
  } else {
    theEnd();
  }}, 1000);
});
