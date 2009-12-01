var map = 0;
var photos = new Array(50);
//var photoicon;

function load() {
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(start_latitude, start_longitude), start_zoom);
    map.setMapType(G_SATELLITE_TYPE);
    map.addControl(new GSmallZoomControl());
    
    // 配列初期化
    for (var i = 0; i < photos.length; i++) {
      photos[i] = 0;
    }

    // 座標を取得
    var bounds = map.getBounds();
    var ne = bounds.getNorthEast();
    var sw = bounds.getSouthWest();
    
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
      var htm = '<div style="text-align:left;color:#444444; font-size:10px"><a href="' + overlay.showurl + '">'; 
      htm += '<img src="' + overlay.photourl + '" border=0 align=left>';
      htm += '<span style="color:#444477; font-size:13px;">';
      htm += overlay.title + '</span></a><br /><br />' + overlay.shotdate + '</div>';
      overlay.openInfoWindowHtml(htm);
    }
  }
}

function zoomendListener() {
  
  // 倍率の上限と下限を調整
  var latlng = map.getCenter();
  var zm = map.getZoom();
  if (zm < 9) {
    map.setCenter(latlng, 9);
    return;
  }
  else if (zm > 18) {
    map.setCenter(latlng, 18);
    return;
  }
  
  // 座標を取得
  var bounds = map.getBounds();
  var ne = bounds.getNorthEast();
  var sw = bounds.getSouthWest();
  
  //$('longitude').innerHTML = latlng.lng();
  //$('latitude').innerHTML = latlng.lat();
  //$('zoom').innerHTML = zm;
  
  // 範囲外を削除
  removePhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
  
  // リクエスト
  requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
}

function moveendListener() {

  // 座標を取得
  var bounds = map.getBounds();
  var ne = bounds.getNorthEast();
  var sw = bounds.getSouthWest();
  
  // 範囲外を削除
  removePhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
  
  // リクエスト
  requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
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
  var url = 'http://photo-okinawa.com/photo/photoinmap';
  var pars = 'x1=' + x1 + '&y1=' + y1 + '&x2=' + x2 + '&y2=' + y2;
  var myAjax = new Ajax.Request(
  url,
  {
    method: 'get',
    parameters: pars,
    onComplete: showPhotos
  }
  );
}

function showPhotos(originalRequest) {
  
  // すでにあるものを削除
  //map.clearOverlays();
  
  // 受け取るデータ: 情報HTML, x, y
  var restext = new String(originalRequest.responseText);
  var list = restext.split("\n");
  
  // マップ上の表示
  var tmp, lng, lat, iw, ih, id, shotdate, title, showurl, iconurl, photourl;
  for (var i = 0; i < list.length; i++) {
    tmp = list[i].split(',');
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
    var idx = -1;
    var dup = 0;
    for (var l = 0; l < photos.length; l++) {
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
    
    var photoicon = new GIcon();
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
  
  var latlng = map.getCenter();
  var zm = map.getZoom();
  var tmplist = photos;
  
  $('suburb').innerHTML = 'HEYHEY' + tmplist.length;
  // 中心に近い画像から出すために並べ替える
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