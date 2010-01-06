
function showCode(width) {
  var buff, buff2;
  
  buff = '';
  buff2 = '';

  date = new Date;
  datestr = new String(date.getYear() + 1900);
  if (date.getMonth() < 9) {
    datestr += '0';
  }
  datestr = datestr + new String(date.getMonth() + 1);
  if (date.getDate() < 10) {
    datestr += '0';
  }
  datestr = datestr + new String(date.getDate());
  
  if (width < 120) {
    width = 120;
    $('partwidth').value = width;
  }
  else if (width > 320) {
    width = 320;
    $('partwidth').value = '320';
  }
  
  $('w' + width).checked = true;
  
  buff += '<div style="text-align:center; width:' + width + 'px;">';
  buff += '<a href="http://photo-okinawa.com/blogphotolink/">';
  buff += '<img src="http://photo-okinawa.com/parts/today_' + width + '.jpg" style="border:0px;">';
  buff += '</a></div>';
  buff += '<div style="text-align:right; font-size:9px; width:' + width + 'px;">';
  buff += '<a href="http://photo-okinawa.com">';
  buff += '<span style="color:#808080">by photo-okinawa.com</span></a></div>';
  
  buff2 += '<div style="text-align:center; width:' + width + 'px;">';
  buff2 += '<a href="http://photo-okinawa.com/show/146">';
  buff2 += '<img src="http://photo-okinawa.com/parts/146_' + width + '.jpg" style="border:0px;">';
  buff2 += '</a></div>';
  buff2 += '<div style="text-align:right; font-size:9px; width:' + width + 'px;">';
  buff2 += '<a href="http://photo-okinawa.com">';
  buff2 += '<span style="color:#808080">by photo-okinawa.com</span></a></div>';
  
  $('codearea').value = buff;
  $('previewcode').innerHTML = buff2;
}