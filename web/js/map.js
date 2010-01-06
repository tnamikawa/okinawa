var map = 0;
var photos = new Array(250);
var continueCounter = 0;
var continueX1 = 0;
var continueY1 = 0;
var continueX2 = 0;
var continueY2 = 0;

//var photoicon;

function load() {
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(start_latitude, start_longitude), start_zoom);
    //map.setMapType(G_SATELLITE_TYPE);
    map.addControl(new GSmallZoomControl());
    
    // 配列初期化
    for (i = 0; i < photos.length; i++) {
      photos[i] = 0;
    }

    // 座標を取得
    var bouds, ne, sw;
    bounds = map.getBounds();
    ne = bounds.getNorthEast();
    sw = bounds.getSouthWest();
    
    // リクエスト
    requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());

    // リスナー追加
    GEvent.addListener(map, "click", clickListener);
    GEvent.addListener(map, "zoomend", zoomendListener);
    GEvent.addListener(map, "moveend", moveendListener);
  }
}

function clickListener(overlay, point) {
  if (overlay) {
    if (overlay.title !== undefined) {
      var htm;
      htm = '<div style="text-align:left;color:#444444; font-size:10px"><a href="' + overlay.showurl + '">'; 
      htm += '<img src="' + overlay.photourl + '" border=0 align=left>';
      htm += '<span style="color:#444477; font-size:13px;">';
      htm += overlay.title + '</span></a><br /><br />' + overlay.shotdate + '</div>';
      overlay.openInfoWindowHtml(htm);
    }
  }
}

function zoomendListener() {
  
  continueX1 = 0;
  continueY1 = 0;
  continueX2 = 0;
  continueY2 = 0;
  continueCounter = 0;
  
  // 倍率の上限と下限を調整
  var latlng, zm;
  latlng = map.getCenter();
  zm = map.getZoom();
  if (zm < 9) {
    map.setCenter(latlng, 9);
    return;
  }
  else if (zm > 18) {
    map.setCenter(latlng, 18);
    return;
  }
}

function moveendListener() {
  
  continueX1 = 0;
  continueY1 = 0;
  continueX2 = 0;
  continueY2 = 0;
  continueCounter = 0;

  // 座標を取得
  var bouds, ne, sw;
  bounds = map.getBounds();
  ne = bounds.getNorthEast();
  sw = bounds.getSouthWest();
  
  //$('suburb').innerHTML = "(" + sw.lng() + "," + sw.lat() + ") - (" + ne.lng() + "," + ne.lat() + ")";

  // 範囲外を削除
  removePhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
  
  // リクエスト
  requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
}

function nextRequest() {
  
  // 座標を取得
  var bouds, ne, sw;
  bounds = map.getBounds();
  ne = bounds.getNorthEast();
  sw = bounds.getSouthWest();
  
  // 判定
  if (continueX1 == sw.lng() &&
  continueY1 == sw.lat() &&
  continueX2 == ne.lng() &&
  continueY2 == ne.lat()) {
    
    // リクエスト
    requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
  }
}

function removePhotos(x1, y1, x2, y2) {
  for (var i = 0; i < photos.length; i++) {
    if (photos[i] !== 0) {
      if (photos[i].lng < x1 ||
      photos[i].lng > x2 ||
      photos[i].lat < y1 ||
      photos[i].lat > y2) {
        map.removeOverlay(photos[i]);
        photos[i] = 0;
      }
    }
  }
}

function requestPhotos(x1, y1, x2, y2) {

  // サーバに範囲内の画像をリクエスト
  var url, pars, myAjax;
  url = '/photo/photoinmap';
  pars = 'x1=' + x1 + '&y1=' + y1 + '&x2=' + x2 + '&y2=' + y2 + '&index=' + continueCounter;
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
  
  // 受け取るデータ: 情報HTML, x, y
  var restext, list, cont, tmp;
  restext = new String(originalRequest.responseText);
  list = restext.split("\n");
  
  // 一行めは継続フラグ
  tmp = list[0].split(',');
  cont = tmp[0];
  continueX1 = tmp[1];
  continueY1 = tmp[2];
  continueX2 = tmp[3];
  continueY2 = tmp[4];
  
  // マップ上の表示
  var lng, lat, iw, ih, id, shotdate, title, showurl, iconurl, photourl;
  for (i = 1; i < list.length; i++) {
    tmp = list[i].split(',', 10);
    lng = tmp[0];
    lat = tmp[1];
    iw = tmp[2];
    ih = tmp[3];
    id = tmp[4];
    shotdate = tmp[5];
    showurl = tmp[6];
    iconurl = tmp[7];
    photourl = tmp[8];
    title = tmp[9];
    
    // photosにすでにあればスキップ
    // 挿入候補を見つける
    var idx, dup;
    idx = -1;
    dup = 0;
    for (l = 0; l < photos.length; l++) {
      if (idx == -1 && photos[l] == 0) {
        idx = l;
      }
      if (photos[l].id == id) {
        dup = 1;
      }
    }
    if (dup) {
      continue;
    }
    if (idx == -1) {
      break;
    }
    
    var photoicon;
    photoicon = new GIcon();
    photoicon.image = "http://photo-okinawa.com" + iconurl;
    photoicon.iconSize = new GSize(iw, ih);
    photoicon.iconAnchor = new GPoint(iw / 2, ih / 2);
    photoicon.infoWindowAnchor = new GPoint(iw / 2, ih / 2);
    
    photos[idx] = new GMarker(new GPoint(lng, lat), photoicon);
    photos[idx].title = title;
    photos[idx].shotdate = shotdate;
    photos[idx].showurl = showurl; 
    photos[idx].photourl = photourl;
    photos[idx].lng = lng;
    photos[idx].lat = lat;
    photos[idx].id = id;
    map.addOverlay(photos[idx]);
  }
  
  var latlng, zm, tmplist;
  latlng = map.getCenter();
  zm = map.getZoom();
  tmplist = photos;
  
  if (continueCounter == 0) {
    var ix, iy, idiff, lx, ly, ldiff, tmpphoto;
    for (i = 0; i < tmplist.length; i++) {
      if (tmplist[i] == 0) {
        continue;
      }
      for (l = i + 1; l < tmplist.length; l++) {
        if (tmplist[l] == 0) {
          continue;
        }
        ix = tmplist[i].lng;
        iy = tmplist[i].lat;
        idiff = Math.abs(latlng.x - ix) + Math.abs(latlng.y - iy);
        lx = tmplist[l].lng;
        ly = tmplist[l].lat;
        ldiff = Math.abs(latlng.x - lx) + Math.abs(latlng.y - ly);
        tmplist[i].diff = idiff;
        tmplist[l].diff = ldiff;
        if (idiff > ldiff) {
          tmpphoto = tmplist[i];
          tmplist[i] = tmplist[l];
          tmplist[l] = tmpphoto;
        }
      }
    }
    
    // 中心に近い画像
    var suburb;
    suburb = '';
    for (i = 0; i < tmplist.length && i < 7; i++) {
      if (tmplist[i].diff < 0.005 + 0.005 * (18 - zm)) {
        suburb += '<a href="' + tmplist[i].showurl + '">';
        suburb += tmplist[i].title + '</a><br />';
      }
    }
    if (suburb == '') {
      suburb = 'ありません。';
    }
    $('suburb').innerHTML = suburb;
  }
  // 中心に近い画像から出すために並べ替える
 
  if (cont == 1) {
    continueCounter++;
    nextRequest();
  }
}