$(".dropdown-menu li a").click(function(){
  $(this).parents(".dropdown").find('.bouton').html($(this).text() + ' <span class="caret"></span>');
  $(this).parents(".dropdown").find('.bouton').val($(this).data('value'));
  $('#noteHidden').val($(this).data('value'));
});