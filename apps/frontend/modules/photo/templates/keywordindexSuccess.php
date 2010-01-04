<title>沖縄写真旅行 - キーワードから探す</title>
<meta name="robots" content="noindex,follow" />
<script src="/js/prototype.js" type="text/javascript"></script>
<script src="/js/keywords.js" type="text/javascript"></script>
</head>
<body>
<?php use_helper('okinawa'); ?>
<div class="topframe">
</div>
<h1 class="title">キーワードから探す <span style="font-size:14px;">by <a href="/">沖縄写真旅行</a></span></h1>
<div class="comment"><?php echo $count; ?>個のキーワードがあります。</div>
<table class="mainphoto">
<tr><td width="810" align="left" valign="top">
<div id="keywordsarea">
<?php keywords_keyword(0,  $count); ?>
</div>
</td>
<td valign="top" align="left">
<div class="right">
<h3 class="sub">全てのキーワード</h3>
<?php all_keywords(); ?>
</div>
</td></tr></table>
