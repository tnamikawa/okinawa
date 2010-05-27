<?php use_helper('Javascript'); ?>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<!--    <script language="JavaScript" type="text/javascript" src="/js/prototype.js"></script>-->
  
    <title>写真の位置の入力</title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo sfConfig::get('app_map_key'); ?>"
      type="text/javascript"></script>
    <script src="/js/prototype.js" type="text/javascript"></script>
    <script type="text/javascript">

    //<![CDATA[
    
    var marker = 0;
    var map = 0;
    var photos = new Array();
    var photoicon;

    function load() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        map.setCenter(new GLatLng(26.212, 127.681), 10);
        //map.setMapType(G_SATELLITE_TYPE);
        map.addControl(new GLargeMapControl());
        
        photoicon = new GIcon();
        photoicon.image = "http://photo-okinawa.com/images/photoicon.png";
        //photoicon.shadow = "http://photo-okinawa.com/images/photoicon.png";
        photoicon.iconSize = new GSize(20, 16);
        //photoicon.shadowSize = new GSize(20, 16);
        photoicon.iconAnchor = new GPoint(10, 8);
        photoicon.infoWindowAnchor = new GPoint(10, 8);
        
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
          overlay.openInfoWindowHtml("<b>" + overlay.title + "</b>");
        }
        else if (overlay == marker) {
          map.removeOverlay(marker);
          $('longitude').value = 0;
          $('latitude').value = 0;
        }
      }
      else if (point) {
        if (marker) {
          map.removeOverlay(marker);
        }
        
        marker = new GMarker(new GPoint(point.x, point.y));
        map.addOverlay(marker);
        
        $('longitude').value = point.x;
        $('latitude').value = point.y;
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
      
      // リクエスト
      requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
    }
    
    function moveendListener() {
    
      // 座標を取得
      var bounds = map.getBounds();
      var ne = bounds.getNorthEast();
      var sw = bounds.getSouthWest();
      
      // リクエスト
      requestPhotos(sw.lng(), sw.lat(), ne.lng(), ne.lat());
    }
    
    function requestPhotos(x1, y1, x2, y2) {
    
      $('longitude').value = 0;
      $('latitude').value = 0;
      
      // サーバに範囲内の画像をリクエスト
      var url = 'http://photo-okinawa.com/tool/withinmap';
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
      map.clearOverlays();
      
      // 受け取るデータ: 情報HTML, x, y
      var restext = new String(originalRequest.responseText);
      var list = restext.split("\n");
      
      var tmp, lng, lat, title;
      //photos = new Array(list.length);
      for (var i = 0; i < list.length; i++) {
        tmp = list[i].split(',', 3);
        lng = tmp[0];
        lat = tmp[1];
        title = tmp[2];
        
        var marker = new GMarker(new GPoint(lng, lat), photoicon);
        marker.title = title;
        map.addOverlay(marker);
      }
    }
    
    function submitCheck() {
      var lng, lat, id;
      lng = $('longitude').value;
      lat = $('latitude').value;
      id = $('id').value;
      
      var tmp;
      tmp = new String($('thumb').innerHTML);
      if (tmp.length) {
        $('thumb').innerHTML = '';
        var url = 'http://photo-okinawa.com/tool/place';
        var pars = 'longitude=' + lng + '&latitude=' + lat + '&id=' + id;
        var myAjax = new Ajax.Updater(
        'result',
        url,
        {
          method: 'get',
          parameters: pars
        }
        );
      }
      else {
        var url = 'http://photo-okinawa.com/tool/mapthumbnail';
        var pars = 'id=' + id;
        var myAjax = new Ajax.Updater(
        'thumb',
        url,
        {
          method: 'get',
          parameters: pars
        }
        );
      }
      return false;
    }

    //]]>
    </script>
  </head>
  <body onload="load()" onunload="GUnload()">
  <table width="100%">
  <tr><td width="610" align="left" valign="middle">
    <div id="map" style="width: 600px; height: 600px"></div>
  </td><td align="left" valign="middle">
  <p style="font-size:20px">地図上をマウスでクリックして、写真IDを入力し、「決定」してください。</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>

<form action="#">
  <label for="item">経度:</label>
  <input type="text" id="longitude">
  <label for="item">緯度:</label>
  <input type="text" id="latitude">
  <br />
  <label for="item">写真ID:</label>
  <input type="text" id="id" name="id" size=4><br />
  <br />
  <span onclick="submitCheck()" style="font-size:15px; padding:5px; border:1px solid #808080; background-color:#bbbbbb;cursor:pointer">決定</span>
</form>

<br />
<div id="thumb"></div>
<div id="result">通信結果がここに出ます。</div>
</td></tr></table>