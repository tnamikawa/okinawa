<script src="/js/prototype.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/blogpartspage.js"></script>
<title>沖縄ブログパーツ</title>
<meta name="description" content="沖縄の写真<?php echo $count; ?>枚から日替わりで表示するブログパーツです。簡単に設置できます。" />
</head>
<body style="background-image:url('/images/blogbg.gif'); text-align:center; color:#666666;">

<div style="width:720px; background-color: #ffffff; text-align:left; margin-left:auto; margin-right:auto;">

<h1 style="font-size:24px; padding-top:24px; padding-left: 12px;">沖縄の窓&nbsp;&nbsp;<span style="font-size:14px;">by <a href="/">沖縄写真旅行</a></span></h1>
<p style="font-size:12px; padding-top:12px; padding-left: 12px; padding-bottom:24px;">沖縄の写真<?php echo $count; ?>枚から日替わりで表示するブログパーツです。</p>
<div style="height:20px; background-color:#cccccc;"></div>
<table width="720">
<tr><td width="500" valign="top">
<div style="padding-left:12px; padding-top:12px;">
<p style="font-size:18px;">それなに？</p>
<div style="font-size:12px; padding-top:12px; border-top: 1px dotted #999999;">
ブログのサイドバーに「沖縄の窓」を設置すると<br />
日替わりで沖縄の写真が出ます。<br />
<br />
<br />
</div>
<p style="font-size:18px;">設置方法</p>
<div style="font-size:12px; padding-top:12px; border-top: 1px dotted #999999;">
まず、幅を決めて<br />
<br />
<input type="radio" name="w" id="w120" onClick="showCode(120)"><span onClick="showCode(120)">120</span>&nbsp;&nbsp;
<input type="radio" name="w" id="w140" onClick="showCode(140)"><span onClick="showCode(140)">140</span>&nbsp;&nbsp;
<input type="radio" name="w" id="w160" onClick="showCode(160)"><span onClick="showCode(160)">160</span>&nbsp;&nbsp;
<input type="radio" name="w" id="w180" onClick="showCode(180)"><span onClick="showCode(180)">180</span>&nbsp;&nbsp;
<input type="radio" name="w" id="w200" onClick="showCode(200)"><span onClick="showCode(200)">200</span>&nbsp;&nbsp;
<input type="radio" name="w" id="w220" onClick="showCode(220)"><span onClick="showCode(220)">220</span>&nbsp;&nbsp;
<input type="radio" name="w" id="w240" onClick="showCode(240)"><span onClick="showCode(240)">240</span>&nbsp;&nbsp;
<br />
<br />
それから、下のコードをコピーして<br />
サイドバーに貼り付けるだけ！<br />
<br />
<textarea cols="36" rows="4" id="codearea" onclick="$('codearea').select()"></textarea>
<br /><br />
</div>
<p style="font-size:18px;">プレビュー</p>
<div style="font-size:12px; padding-top:12px; border-top: 1px dotted #999999;">
<div id="previewcode"></div><br />
</div>
<p style="font-size:18px;">バックナンバー</p>
<div style="font-size:12px; padding-top:12px; border-top: 1px dotted #999999;">
<?php
for ($i = 0; $i < sizeof($photos); $i++) {
  $photo = $photos[$i];
  echo '<table><tr><td>';
  echo '<a href="' . okinawaUtil::getPhotoLinkUrl($photo) . '">';
  echo '<img src="/parts/' . $photo->getId() . '_160.jpg" alt="バックナンバー"></a></td>';
  echo '<td valign="top" style="font-size:12px;line-height:15px;">';
  echo $list[$i]->getUseDate() . '<br>';
  echo $photo->getTitle();
  echo '</td></tr></table><br>';
}

?>
</div>
</div>
</td><td width="220" valign="top">
<div style="padding-left:12px; padding-top:24px;">
<br />
<div style="text-align:center; width:200px;">
<a href="/show/102"><img src="/parts/102_200.jpg" style="border:0px;"></a>
</div>
<div style="text-align:right; font-size:9px; width:200px;"><a href="http://photo-okinawa.com"><span style="color:#808080">by photo-okinawa.com</span></a><br />
<span style="color:#808080"></span></div> 
<br />
<div style="text-align:center; width:160px;">
<a href="/show/371"><img src="/parts/371_160.jpg" style="border:0px;"></a>
</div>
<div style="text-align:right; font-size:9px; width:160px;"><a href="http://photo-okinawa.com"><span style="color:#808080">by photo-okinawa.com</span></a><br />
<span style="color:#808080"></span></div> 
<br />
<div style="text-align:center; width:120px;">
<a href="/show/567"><img src="/parts/567_120.jpg" style="border:0px;"></a>
</div>
<div style="text-align:right; font-size:9px; width:120px;"><a href="http://photo-okinawa.com"><span style="color:#808080">by photo-okinawa.com</span></a><br />
<span style="color:#808080"></span></div> 
<br />
</div>
</td></tr>
</table>
</div>
