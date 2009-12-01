var map = 0;
var init = 1;

var con_id = [0, 0, 0, 0];
var con_lng = [0, 0, 0, 0];
var con_lat = [0, 0, 0, 0];
var con_showurl = ['', '', '', ''];
var con_photourl = ['', '', '', ''];
var con_thumburl = ['', '', '', ''];
var con_photow = [0, 0, 0, 0];
var con_photoh = [0, 0, 0, 0];
var con_cw = [0, 0, 0, 0];
var con_ch = [0, 0, 0, 0];
var con_title = ['', '', '', ''];
var con_comment = ['', '', '', ''];
var con_keywords = ['', '', '', ''];
var con_shotdate = ['', '', '', ''];

function showMap() {
  var buff, width;
  
  if (isUseMap) {
    width = screen.width - 900;
    if (width < 200) {
      width = 200;
    }
    if (width > 400) {
      width = 400;
    }
    buff = '<div id="map" style="width: ' + width + 'px; height: 180px; margin-top:15px; margin-left:auto; margin-right:auto;"></div>';
    $('maparea').innerHTML = buff;
  }
}

function load() {
  if (isUseMap) {
    if (GBrowserIsCompatible()) {
      map = new GMap2(document.getElementById("map"));
      map.setCenter(new GLatLng(cur_lat, cur_lng), start_zoom);
      map.setMapType(G_SATELLITE_TYPE);
      map.disableDragging();
      map.disableDoubleClickZoom();
      map.disableContinuousZoom();
      
      marker = new GMarker(new GPoint(cur_lng, cur_lat));
      map.addOverlay(marker);
    }
   }
}

function clickConsole(idx) {
  var buff;
  
  $('console').innerHTML = '';
  
  cur_lat = con_lat[idx];
  cur_lng = con_lng[idx];
  map.panTo(new GLatLng(cur_lat, cur_lng));
  
  buff = '<img src="' + con_photourl[idx] + '"';
  buff += ' width="' + con_photow[idx] + '"';
  buff += ' height="' + con_photoh[idx] + '"';
  buff += ' alt="' + con_title[idx] + '"';
  buff += '>';
  $('photoarea').innerHTML = buff;
  
  buff = '<a href="' + con_showurl[idx] + '">';
  buff += con_title[idx] + '</a>';
  $('titlearea').innerHTML = buff;
  
  $('commentarea').innerHTML = con_comment[idx];
  
  $('keywordsarea').innerHTML = 'キーワード<br />' + con_keywords[idx];
  
  $('shotdatearea').innerHTML = con_shotdate[idx];
  
  buff = '<a href="';
  buff += '/photo/map/zoom/17/longitude/';
  buff += new String(con_lng[idx]).replace(/\./, '_');
  buff += '/latitude/';
  buff += new String(con_lat[idx]).replace(/\./, '_');
  buff += '/photoid/' + con_id[idx];
  buff += '">地図</a>';
  $('maplinkarea').innerHTML = buff;
  
  startRequest(con_id[idx]);
}

function mouseOnConsole(idx) {
  if (isUseMap) {
    map.clearOverlays();
    marker = new GMarker(new GPoint(con_lng[idx], con_lat[idx]));
    map.addOverlay(marker);
  }
}

function mouseOutConsole(idx) {
  if (isUseMap) {
    map.clearOverlays();
    marker = new GMarker(new GPoint(cur_lng, cur_lat));
    map.addOverlay(marker);
  }
}

function startRequest(photoid) {
  
  // 通信
  var url, pars, myAjax;
  url = '/photo/wanderupdate';
  pars = 'photoid=' + photoid;
  myAjax = new Ajax.Request(
  url,
  {
    method: 'get',
    parameters: pars,
    onComplete: updateConsole
  }
  );
}


function updateConsole(req) {
  
  var imgw, imgh;
  imgw = 100;
  imgh = 67;
  if (screen.width <= 1100) {
    imgw = 80;
    imgh = 53;
  }
  var restext, list, tmp;
  restext = new String(req.responseText);
  list = restext.split("\n");
  
  for (i = 0; i < 4; i++) {
    tmp = list[i].split('<,>', 12);
    if (tmp.length == 12) {
      con_id[i] = tmp[0];
      con_lng[i] = tmp[1];
      con_lat[i] = tmp[2];
      con_showurl[i] = tmp[3];
      con_photourl[i] = tmp[4];
      con_thumburl[i] = tmp[5];
      con_photow[i] = tmp[6];
      con_photoh[i] = tmp[7];
      con_title[i] = tmp[8];
      con_comment[i] = tmp[9];
      con_keywords[i] = tmp[10];
      con_shotdate[i] = tmp[11];
      
      if (con_photow[i] / con_photoh[i] > imgw / imgh) {
        con_cw[i] = imgw;
        con_ch[i] = Math.round(con_photoh[i] * con_cw[i] / con_photow[i]);
      }
      else {
        con_ch[i] = imgh;
        con_cw[i] = Math.round(con_photow[i] * con_ch[i] / con_photoh[i]);
      }
    }
    else {
      con_id[i] = 0;
    }
  }
  
  var bounds, ne, sw, isIn, i;

  //cur_zoom = start_zoom;
  //map.setCenter(new GLatLng(cur_lat, cur_lng), cur_zoom);
  
  isIn = true;
  if (cur_zoom == start_zoom) {
    bounds = map.getBounds();
    ne = bounds.getNorthEast();
    sw = bounds.getSouthWest();
    for (i = 0; i < 4; i++) {
      if (con_id[i] == 0 ||
      (sw.lng() < con_lng[i] &&
      sw.lat() < con_lat[i] &&
      ne.lng() > con_lng[i] &&
      ne.lat() > con_lat[i])
      ) {
        // ok
      }
      else {
        isIn = false;
      }
    }
  }
  else {
    isIn = false;
  }
  
  if (! isIn) {
    cur_zoom = start_zoom;
    map.setCenter(new GLatLng(cur_lat, cur_lng), cur_zoom);
    for (i = 0; i < 4; i++) {
      isIn = false;
      for (; cur_zoom > 10 && isIn == false; cur_zoom--) {
        bounds = map.getBounds();
        ne = bounds.getNorthEast();
        sw = bounds.getSouthWest();
        if (con_id[i] == 0 ||
        (sw.lng() < con_lng[i] &&
        sw.lat() < con_lat[i] &&
        ne.lng() > con_lng[i] &&
        ne.lat() > con_lat[i])) {
          isIn = true;
          break;
        }
        map.setCenter(new GLatLng(cur_lat, cur_lng), cur_zoom);
      }
    }
  }
  
  var buff;
  buff = '<table width="' + (imgw * 2 + 20) + '">';
  buff += '<tr><td colspan=2 align="center" valign="middle">';
  buff += consoleImage(0) + '</td></tr>';
  buff += '<tr><td width="50%" align="right" valign="middle">';
  buff += consoleImage(3) + '</td>';
  buff += '<td width="50%" align="left" valign="middle">';
  buff += consoleImage(1) + '</td></tr>';
  buff += '<tr><td colspan=2 align="center" valign="middle">';
  buff += consoleImage(2) + '</td></tr>';
  buff += '</table>';
  
  $('console').innerHTML = buff;
}

function consoleImage(idx) {
  var buff;
  
  buff = '';
  if (con_id[idx]) {
    buff = '<img src="' + con_thumburl[idx] + '" width="' + con_cw[idx] + '"';
    buff += ' height="' + con_ch[idx] + '"';
    buff += ' onmouseover="mouseOnConsole(' + idx + ')"';
    buff += ' onmouseout="mouseOutConsole(' + idx + ')"';
    buff += ' onclick="clickConsole(' + idx + ')"';
    buff += ' style="cursor:pointer"';
    buff += '>';
  }
  
  return buff;
}
