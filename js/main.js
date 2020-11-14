"use_strict";

var $ = jQuery;

var scripts = document.getElementsByTagName("script");
var path = scripts[scripts.length - 1].src.split("?")[0]; // remove any ?query
var mydir = path.split("/").slice(0, -1).join("/") + "/"; // remove last filename part of path

console.log(mydir);

$(document).ready(function () {
  $("#update_equipment_btn").click(function (event) {
    event.preventDefault();
    // console.log($(this).val());
    $.ajax({
      type: "POST",
      url: mydir + "../inc/base/sprayloc_functions.php",
      data: {
        action: "add_equipment",
        value: $(this).val(),
      },
    }).done(function (msg) {
      console.log("return message :");
      console.log(msg);
      document.location.reload();
    });
  });
});
