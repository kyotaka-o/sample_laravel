$(function() { 
  //センタリングをする関数
  function centeringModalSyncer(){

    //画面(ウィンドウ)の幅を取得し、変数[w]に格納
    var w = $(window).width();
    console.log(w)
    //画面(ウィンドウ)の高さを取得し、変数[h]に格納
    var h = $(window).height();
    console.log(h)
    //コンテンツ(#modal-content)の幅を取得し、変数[cw]に格納
    var cw = $("#modal-content").outerWidth(true);
    console.log(cw)
    //コンテンツ(#modal-content)の高さを取得し、変数[ch]に格納
    var ch = $("#modal-content").outerHeight(true);
    console.log(ch)
    //コンテンツ(#modal-content)を真ん中に配置するのに、左端から何ピクセル離せばいいか？を計算して、変数[pxleft]に格納
    var pxleft = ((w - cw)/2);

    //コンテンツ(#modal-content)を真ん中に配置するのに、上部から何ピクセル離せばいいか？を計算して、変数[pxtop]に格納
    var pxtop = ((h - ch)/2);
    console.log(pxleft)
    console.log(pxtop)
    //[#modal-content]のCSSに[left]の値(pxleft)を設定
    $("#modal-content").css({"left": pxleft + "px"});

    //[#modal-content]のCSSに[top]の値(pxtop)を設定
    $("#modal-content").css({"top": pxtop + "px"});
  }
  function mordal_close(){
    //[#modal-overlay]、または[#modal-close]をクリックしたら起こる処理
    //[#modal-overlay]と[#modal-close]をフェードアウトする
    $("#modal-content,#modal-overlay").fadeOut("slow",function(){
      //フェードアウト後、[#modal-overlay]をHTML(DOM)上から削除
      $("#modal-overlay").remove();
      // $("#modal-content").faideOut();
    });
  }

  $("#new-art").click(
    function(e){
      //キーボード操作などにより、オーバーレイが多重起動するのを防止する
      $(this).blur() ;	//ボタンからフォーカスを外す
      if($("#modal-overlay")[0]) return false ;		//新しくモーダルウィンドウを起動しない [下とどちらか選択]
      // if($("#modal-overlay")[0]) $("#modal-overlay").remove() ;		//現在のモーダルウィンドウを削除して新しく起動する [上とどちらか選択]

      //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
      $("body").append('<div id="modal-overlay"></div>');

      //[$modal-overlay]をフェードインさせる
      $("#modal-overlay").fadeIn("slow");
      // var contents = $("#modal-content");
      // contents[0].setAttribute("id","modal-content");
      // contents[0].setAttribute("style","display:none");

      // contents.css("width","800px");
      // contents.css("heigt","600px");
      // $("body").append(contents);
      //[$modal-content]をフェードインさせる
      $("#modal-content").fadeIn("slow");
      centeringModalSyncer();
    }
  );
  $("#modal-close").unbind().click(function(){
    mordal_close();
  });
  $('body').on('click','#modal-overlay',function(e){
    mordal_close();
  });

  function buildHTML(input){
    var html = `<img src="${input}" height="150px width="250px" id="image-prev">`
    return html;
  } 

  var files_array = [];
  var total_index = 0;
  function file_input(files,index) {
    file = files[index];
    files_array.push(file);
    var fileReader = new FileReader();
    // ファイルが読み込まれた際に、行う動作を定義する。
    fileReader.onload = function( event ) {
      // 画像のurlを取得します。
      var loadedImageUri = event.target.result;
      // 取得したURLを利用して、ビューにHTMLを挿入する。
      var html = buildHTML(loadedImageUri);

      total_index++;
      $("#modal-content").prepend(html);
      if(files.length-1 > index){
        index++;
        file_input(files,index)
      }

    };
    // ファイルの読み込みを行う。
    fileReader.readAsDataURL(file);
  }

  $("#image_input").change(function(e){
    var index = 0;
    // console.log(e.target.files);
    $("#image-prev").remove();

    if (e.target.files =="")
    {
      return;
    }
    file_input(e.target.files,index)
  });


  $('#form-org').on('submit', function(e){
    e.preventDefault();
    var formData = new FormData(this);
    e.stopPropagation();
      $.ajax({
          url: "/articles",
          type: 'POST',
          data: formData,
          dataType: 'json',
          processData: false,
          contentType: false
      })
      .done(function(data) {
        
        mordal_close();
        content = document.getElementsByName('token')[0].content
        console.log(content);
        url = data.image_url.replace('public/', 'storage/');
        var html=` <div class="art-card" style="background-image: url('${url}')" data-id='${data.id}'>
          <div class="art-card__title">
            <h4>${data.title}</h4>
          </div>
          <div class="art-card__body">
             <p>${data.body}</p>
          </div>
            <form action="/articles/${data.id}" method="post" class="del_form">
            　<input type="hidden" name="_token" value="${content}">
              <input type="hidden" name="_method" value="delete">
              <input type="submit" name="" value="×" class="btn btn-danger pos-right-top delete-art">
            </form>
          </div>`
        $("section").prepend(html);
      })
      .fail(function(){
        alert('error');
      })

  });
});