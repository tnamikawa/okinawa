
function requestKeywords(index) {

  // サーバに画像をリクエスト
  var url, pars, myAjax;
  url = '/photo/keywordpage';
  pars = '&index=' + index;
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
  $('keywordsarea').innerHTML = restext;

}