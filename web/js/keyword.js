
function requestPhotos(id, index) {

  // サーバに画像をリクエスト
  var url, pars, myAjax;
  url = '/photo/keywordphotos';
  pars = 'id=' + id + '&index=' + index;
  myAjax = new Ajax.Request(
  url,
  {
    method: 'get',
    parameters: pars,
    onComplete: showPhotos
  }
  );
}

function showPhotos(originalRequest) {
  var restext;
  restext = new String(originalRequest.responseText);
  $('keywordphoto').innerHTML = restext;

}