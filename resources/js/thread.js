$(function() {
  $('#categories').tagify();
  $('form').submit(function() {
    $('#categories').tagify('serialize');
  });
});
