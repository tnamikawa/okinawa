<?php include_title() ?>

</head>
<body>
<?php
// auto-generated by sfPropelCrud
// date: 2007/04/06 17:17:58
?>
<?php use_helper('okinawa'); ?>
<h1>トップ背景</h1>
<br />
<p><big>
- 一時間ごとに異なる背景が出る<br />
- 画面右端があまりにも一様でないものはやばい<br />
- MacのフォントはWindowsのものより視認性が良い。MacでぎりぎりだとWindowsではしんどい。余裕を。<br />
- 縦横比が標準のもの限定<br />
</big></p>
<table cellpadding="2">
<thead>
<tr>
  <th>操作</th>
  <th>時刻</th>
  <th>サムネイル</th>
  <th>ID</th>
  <th>タイトル</th>
  <th>文字色</th>
  <th>リンク色</th>
</tr>
</thead>
<tbody>
<?php foreach ($topphoto as $top): ?>
<tr>
      <td width="100"><?php echo link_to('変更', 'tool/topphotoedit?id=' . $top->getId()); ?>
      &nbsp;&nbsp;<?php echo link_to('確認', 'photo/index?hour=' . $top->getId()); ?></td>
      <td width="32"><?php echo $top->getId(); ?></td>
      <td><img src="<?php echo okinawaUtil::getThumbUrl($list[$top->getId()]); ?>"></td>
      <td width="32"><?php echo $top->getPhotoId(); ?></td>
      <td><?php echo $list[$top->getId()]->getTitle() ?></td>
      <td><?php echo $top->getTextColor(); ?></td>
      <td><?php echo $top->getLinkColor(); ?></td>
        </tr>
<?php endforeach; ?>
</tbody>
</table>
