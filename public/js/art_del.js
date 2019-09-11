$(function(){


  $(document).on("submit",".del_form",function(e){
    if(!confirm("Delete OK??")){
      e.preventDefault();
      return;
    }
    e.preventDefault();
    var url = $(this).attr('action')
    console.log(this);
    content = document.getElementsByName('token')[0].content
    $.ajax({
      headers: {
          'X-CSRF-TOKEN': content
      },
      url: url,
      type: 'POST',
      data: {'_method': 'DELETE'}, // DELETE リクエストだよ！と教えてあげる。
      dataType: 'json'
    })
    .done(function(data) {
      search = `div[data-id=${data.id}]`
      console.log($(search));
      $(search)[0].remove();
    })
    .fail(function(){
      alert('error');
    })
  });
});