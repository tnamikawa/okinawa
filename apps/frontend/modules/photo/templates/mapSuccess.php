<?php
use_helper('okinawa');
?>
  
    <title><?php echo $name; ?></title>
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=<?php echo sfConfig::get('app_map_key'); ?>"
      type="text/javascript"></script>
    <script src="/js/prototype.js" type="text/javascript"></script>
    <meta name="robots" content="noindex,follow" />
    <script type="text/javascript">

var start_longitude = <?php echo $lng; ?>;
var start_latitude = <?php echo $lat; ?>;
var start_zoom = <?php echo $zoom; ?>;
    
    </script>
    <script src="/js/map.js" type="text/javascript"></script>
  </head>
  <body onload="load()" onunload="GUnload()">
<div class="topframe">
</div>
<h1 class="title"><?php echo $name; ?>&nbsp;&nbsp;<span style="font-size:14px;">by <a href="/">沖縄写真旅行</a></span></h1>
<div class="comment">マップから探せます</div>
<table width="100%">
  <tr><td width="810" align="left" valign="middle">
    <div id="map" style="width: 800px; height: 533px"></div>
  </td><td align="left" valign="top">
  <h3 class="sub">移動</h3>
  <p class="keyword">
  <?php echo link_to('那覇市', 'photo/map?location=naha'); ?>
  &nbsp;
  <?php echo link_to('首里城', 'photo/map?location=shuri'); ?>
  &nbsp;
  <?php echo link_to('宮古島', 'photo/map?location=miyako'); ?>
  &nbsp;
  <?php echo link_to('石垣島', 'photo/map?location=ishigaki'); ?>
  &nbsp;
  <?php echo link_to('西表島', 'photo/map?location=iriomote'); ?>
  &nbsp;
  </p>
  <h3 class="sub">この付近</h3>
  <p class="keyword" id="suburb">
  <?php echo suburb_photos($list); ?>
  </p>
  <br />
  <br />
</td></tr></table>
