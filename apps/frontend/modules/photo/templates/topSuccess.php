<?php
use_helper('okinawa');
?>
<title>沖縄写真旅行</title>
<meta name="description" content="沖縄写真サイトとして国内最大規模の<?php echo $count; ?>枚の写真を公開中。二次加工、商用利用もご自由にどうぞ。" />
<meta name="robots" content="index,follow" />
<style type="text/css">

div#topbg a:link
{
  color: <?php echo $bg->getLinkColor(); ?>;
}
div#topbg a:visited
{
  color: <?php echo $bg->getLinkColor(); ?>;
}

</style>
</head>
<body>
<div class="topframe">
</div>
<div style="text-align:center; width:100%; margin-top: 25px;">
<div id="topbg" <?php
echo 'style="background-image:url(\'/topbg/' . $hour . '.jpg\');"';
?>>
<div id="r">
<div id="r2">
<div style="color:<?php echo $bg->getTextColor(); ?>; font-size:23px;">沖縄写真旅行&nbsp;</div>
<div style="color:<?php echo $bg->getTextColor(); ?>; font-size:13px; margin-top: 20px; line-height: 20px;">
  <?php echo $sf_data->getRaw('intro'); ?>
<br />
<br />
<?php echo link_to('キーワードで写真を探す/By keyword', 'photo/keywordindex'); ?>&nbsp;<br />
<br />
<?php echo link_to('地図で写真を探す/By map', 'photo/map'); ?>&nbsp;<br />
<br />
<br />
<?php echo link_to('ブログパーツ/Blog parts', 'photo/blogparts'); ?>&nbsp;<br />
<br />
<?php echo link_to('壁紙/Wallpapers', 'photo/wallpaperlist'); ?>&nbsp;<br />
<br />
<br />
<?php echo link_to('リンク/Link', 'photo/link'); ?>&nbsp;<br />
<br />
<?php echo link_to('このサイトについて/About me', 'photo/introduction'); ?>&nbsp;<br />
<br />
<br />
表紙&nbsp;<br />
<?php echo link_to($bgphoto->getTitle(), 'photo/show?id=' . $bgphoto->getId()); ?>&nbsp;<br />
<!--<br />
連絡先&nbsp;<br />
<script type="text/javascript">
document.write('<' + 'a href="mailto:fran_zoo');
document.write('e@y');
document.write('ahoo.co.jp">');
document.write('fran_zoo');
document.write('e@y');
document.write('ahoo.co.jp<' + '/a>');
</script>&nbsp;
-->
</div>
</div>
</div>
<div id="l">
<div id="l2t">
<div style="color:<?php echo $bg->getTextColor(); ?>; font-size:15px; margin-left:12px;">
<?php open_date_short($recent[0]); ?> 沖縄の写真を<?php echo $recentCount; ?>枚追加
</div>
<?php
for ($i = 0; $i < 7 && $i < $recentCount; $i++) {
  print '<div class="photocover"><div class="photoframe">' . okinawaUtil::getThumbnailTagSlim($recent[$i]) . '<br />';
  print '</div></div>';
}
?>
<br clear="all"/>
<div class="bpcover"><div class="bpframe">
<a href="/blogphotolink/">
<img src="/parts/today_200.jpg" style="border:0px;">
</a>
<div style="text-align:right; font-size:9px; width:200px;"><a href="/blogparts"><span style="color:#808080">ブログパーツ「沖縄の窓」</span></a></div>
</div></div>
</div>
<div id="l2b">
</div>
</div>
</div>


</div>
</div>
<div style="width: 250px; margin-left: auto; margin-right: auto; text-align: center">
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 4,
  interval: 6000,
  width: 250,
  height: 300,
  theme: {
    shell: {
      background: '#333333',
      color: '#ffffff'
    },
    tweets: {
      background: '#000000',
      color: '#ffffff',
      links: '#4aed05'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: false,
    hashtags: true,
    timestamp: true,
    avatars: false,
    behavior: 'all'
  }
}).render().setUser('photookinawa').start();
</script>
</div>