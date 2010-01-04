<?php
use_helper('okinawa');
?>
<title><?php echo $tag->getTitle(); ?></title>
<meta name="description" content="<?php
if (strlen($tag->getDescription())) {
  echo preg_replace('/\r\n|\r|\n/', '', $tag->getDescription()) . '沖縄でとってきた、' . $tag->getTitle() . 'に関連する写真' . $count . '枚。';
}
else {
  echo $tag->getTitle() . 'に関連する、沖縄でとってきた写真' . $count . '枚。';
}
?>" />
<meta name="robots" content="index,follow" />
<script src="/js/prototype.js" type="text/javascript"></script>
<script src="/js/keyword.js" type="text/javascript"></script>
</head>
<body>
<?php use_helper('okinawa'); ?>
<div class="topframe">
</div>
<h1 class="title"><?php echo $tag->getTitle() . '(' . $tag->getEnglishTitle() . ')'; ?>&nbsp;&nbsp;<span style="font-size:14px;">by <a href="/">沖縄写真旅行</a></span></h1>
<div class="comment"><?php

if (strlen($tag->getDescription())) {
  echo preg_replace('/\r\n|\r|\n/', '<br />', $sf_data->getRaw('tag')->getDescription());
}
else {
  echo $tag->getTitle() . 'に関連する写真たち。';
}
?><br />
<br />
このキーワードを含む写真 <?php echo $count; ?>枚
</div>
<div id="keywordphoto"><?php keyword_photo($tag->getId(), $index, $count); ?></div>
