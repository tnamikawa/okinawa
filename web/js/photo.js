
var id = 0;
var vtagid = 0;
var htagid = 0;
var vids = [];
var hids = [];
var vurls = [];
var hurls = [];

function show(id) {
  var w = window.innerWidth;
  var h = window.innerHeight;
  
  ajaxGetPhoto(id, 2, 4);
}


function ajaxGetPhoto(photoid, prevcnt, nextcnt) {
  
  // 通信
  var url, pars, myAjax;
  url = '/photo/ajaxgetphoto';
  pars = 'photoid=' + photoid + '&prevcnt=' + prevcnt;
  pars += '&nextcnt=' + nextcnt;
  pars += '&vtagid=' + vtagid + '&htagid=' + htagid;
  myAjax = new Ajax.Request(
  url,
  {
    method: 'get',
    parameters: pars,
    onComplete: updateGetPhoto
  }
  );
}

function updateGetPhoto(req) {
  
  var tmp;
  var restext, list;
  restext = new String(req.responseText);
  list = restext.split("\n");
  
  var title = list[0];
  var comment = list[1];
  var shotdate = list[2];
  var tagidlist = list[3].split(',');
  var tagwordlist = list[4].split(',');
  var photourl = list[5];
  var v_prevlist = list[6].split('<>');
  var v_nextlist = list[7].split('<>');
  var h_prevlist = list[8].split('<>');
  var h_nextlist = list[9].split('<>');
  var tagprevlist = list[10].split('<->');
  var tagnextlist = list[11].split('<->');
  
  var buff = 'タイトル：' + title + '<br>';
  buff += 'コメント：' + comment + '<br>';
  buff += '撮影日時：' + shotdate + '<br>';
  
  buff += 'タグID：' + tagidlist + '<br>';
  buff += 'タグワード：' + tagwordlist + '<br>';
  buff += '<img src="' + photourl + '">';
  
  $('main').innerHTML = buff;
  
  var vbuff = v_prevlist.join(',') + '----' + v_nextlist.join(',');
  var hbuff = h_prevlist.join(',') + '----' + h_nextlist.join(',');
  
  $('vthumb').innerHTML = vbuff;
  $('hthumb').innerHTML = hbuff; 
}