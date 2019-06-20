$(document).ready(function () {
  console.log("It is ready!");



  $(".btn").click(
    function concatenate() {

      var res = $('input').map(function(idx, elem)
      {return $(elem).val();}).get();
    // var x = $("input");
    //  for (var i = 0; i < x.length; i ++) {
    //   console.log(x(i).val + "** ");
    //   res = res + " " + x(i).val;
    // }

    res += $(".span_class").text();
    $("#result").css("backgroundColor", "blue");
    $("#result").text("The result is " + res);
  });
});
