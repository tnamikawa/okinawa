var map = 0;
var photos = new Array(50);

function load() {
  if (GBrowserIsCompatible()) {
    map = new GMap2(document.getElementById("map"));
    map.setCenter(new GLatLng(start_latitude, start_longitude), start_zoom);
    
    // 配列初期化
    for (var i = 0; i < photos.length; i++) {
      photos[i] = 0;
    }
    
    var marker = new GMarker(new GPoint(start_longitude, start_latitude));
    map.addOverlay(marker);
    
    // 座標を取得
    var bouds, ne, sw;
    bounds = map.getBounds();
    ne = bounds.getNorthEast();
    sw = bounds.getSouthWest();
    
    // リクエスト
    requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());

    // リスナー追加
    GEvent.addListener(map, "click", clickListener);
    GEvent.addListener(map, "movestart", redirectMap);
  }
}

function clickListener(overlay, point) {
  if (overlay) {
    if (overlay.showurl !== undefined) {
      document.location = overlay.showurl;
    }
    else {
      document.location = map_url;
    }
  }
  else {
    document.location = map_url;
  }
}

function redirectMap() {
  document.location = map_url;
}

function requestPhotos(x1, y1, x2, y2) {

 // サーバに範囲内の画像をリクエスト
  var url, pars, myAjax; 
  url = 'http://photo-okinawa.com/photo/photoinmap';
  pars = 'x1=' + x1 + '&y1=' + y1 + '&x2=' + x2 + '&y2=' + y2;
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
  var restext, list;
  restext = new String(originalRequest.responseText);
  list = restext.split("\n");
  
  // マップ上の表示
  var tmp, lng, lat, iw, ih, id, shotdate, title, showurl, iconurl, photourl;
  for (i = 0; i < list.length; i++) {
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
    
    if (start_longitude == lng && start_latitude == lat) {
      continue;
    }
    
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
    photos[idx].showurl = showurl;
    map.addOverlay(photos[idx]);
  }
}  
