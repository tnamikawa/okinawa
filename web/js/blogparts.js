
function showOkinawaParts(width) {
  var div, html, date, datestr, tmp;
  
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
  
  tmp = 'photo';
  tmp += 'okinawa';
  div = document.getElementById(tmp);
  
  html = '<div style="text-align:center">';
  html += '<a href="http://photo-okinawa.com/blogphotolink/' + datestr + '">';
  html += '<img src="http://photo-okinawa.com/blogphoto/' + width + '" alt="沖縄写真旅行" style="border:0px;">';
  html += '</a>';
  html += '</div>';
  
  div.innerHTML = html;
}