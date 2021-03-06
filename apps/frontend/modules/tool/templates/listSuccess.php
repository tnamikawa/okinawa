<?php include_title() ?>

</head>
<body>
<?php
// auto-generated by sfPropelCrud
// date: 2007/04/06 17:17:58
?>
<?php use_helper('okinawa'); ?>
<h1>管理リスト</h1>
<br />
<?php echo link_to('全て', 'tool/list'); ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo link_to('タグ未設定', 'tool/lacktag'); ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo link_to('コメント未設定', 'tool/lackcomment'); ?>
&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo link_to('地図未設定', 'tool/lackmap'); ?>
&nbsp;&nbsp;&nbsp;&nbsp;<br />
<br />

<table cellpadding="2">
<thead>
<tr>
  <th>操作</th>
  <th>サムネイル</th>
  <th>ID</th>
  <th>地図</th>
  <th>タイトル</th>
  <th>コメント</th>
  <th>タグ</th>
  <th>撮影日時</th>
</tr>
</thead>
<tbody>
<?php foreach ($photos as $photo): ?>
<tr>
      <td><?php echo link_to('削除', 'tool/delete?id=' . $photo->getId()); ?></td>
      <td><?php echo okinawaUtil::getThumbnailTagSlim($photo); ?></td>
      <td width="32"><?php echo $photo->getId(); ?></td>
      <td width="48"><?php echo $photo->isMapOK() ? '済' : '未設定'; ?></td>
      <td><?php echo $photo->getTitle() ?></td>
      <td width="30%"><?php echo $photo->getComment() ?></td>
      <td><?php print_taglist($photo); ?></td>
      <td><?php echo $photo->getShotDate() ?></td>
        </tr>
<?php endforeach; ?>
</tbody>
</table>
