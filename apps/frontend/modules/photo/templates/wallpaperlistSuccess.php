<?php
use_helper('okinawa');
?>
<title>沖縄の壁紙</title>
<meta name="description" content="<?php echo $count; ?>枚の沖縄の写真の中から選りすぐった<?php echo sizeof($photos); ?>枚の壁紙を無料提供中です。あなたのPCの壁紙として沖縄の写真はいかがですか。" />
<meta name="keywords" content="沖縄 壁紙" />
<meta name="robots" content="index,follow" />
</head>
<body>
<div class="topframe">
</div>
<h1 class="title">壁紙&nbsp;&nbsp;<span style="font-size:14px;">by <a href="/">沖縄写真旅行</a></span></h1>
<div class="comment">沖縄で撮影した<?php echo $count; ?>枚の写真の中から選りすぐった<?php echo sizeof($photos); ?>枚の壁紙をダウンロードできます。<br />
あなたのPCの壁紙として沖縄の写真はいかがですか。</div>
<div style="text-align:center; width:100%; margin-top: 25px;">
<?php
foreach ($photos as $photo) {
  echo '<div class="wallcover">';
  echo '<div class="wallframe">';
  echo wallpaper_tag($photo, 320, 240) . '<br />';
  echo '<p style="margin-top:10px; font-weight:bold;">' . $photo->getTitle() . '</p>';
  echo '<p style="margin-top:8px;">';
  echo '<a href="' . wallpaper_url($photo, 1024, 768) . '">1024x768</a>';
  echo '&nbsp;';
  echo '<a href="' . wallpaper_url($photo, 1280, 800) . '">1280x800</a>';
  echo '&nbsp;';
  echo '<a href="' . wallpaper_url($photo, 1280, 1024) . '">1280x1024</a>';
  echo '&nbsp;';
  echo '<a href="' . wallpaper_url($photo, 1400, 1050) . '">1400x1050</a>';
  echo '</p>';
  echo '</div></div>';
}


?>