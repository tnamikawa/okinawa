
function array_search(haystack, needle) {
  var ret = -1;
  
  for (var i = 0; i < haystack.length; i++) {
    if (needle == haystack[i]) {
      ret = i;
      break;
    }
  }
  
  return ret;
}

function array_remove(haystack, hay) {
  var ret = [];
  
  for (var i = 0; i < haystack.length; i++) {
    if (hay != haystack[i]) {
      ret.push(haystack[i]);
    }
  }
  
  return ret;
}

function get_inner_height() {
  var ret = 0;
  
  if (window.innerHeight) {
    ret = window.innerHeight;
  }
  else if (document.body.clientHeight) {
    ret = document.body.clientHeight;
  }
  
  return ret;
}

function get_inner_width() {
  var ret = 0;
  
  if (window.innerWidth) {
    ret = window.innerWidth;
  }
  else if (document.body.clientWidth) {
    ret = document.body.clientWidth;
  }
  
  return ret;
}

function rand(min, max) {
  var offset, len;
  offset = min;
  len = max - min;
  
  return offset + Math.floor(Math.random() * len);
}