$(document).ready(function () {
  $('#category').change(function () {
    filter();
  });
  $('#keyword').keypress(function (event) {
    if (event.keyCode == 13) {
      filter();
    }
  });
  var filter = function () {
    var category = $('#category').val();
    var keyword = $('#keyword').val();
    window.location.replace("/product?category=" + category + "&keyword=" + keyword);
  }
});