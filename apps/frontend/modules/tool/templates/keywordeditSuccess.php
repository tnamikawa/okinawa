<?php include_title() ?>

</head>
<body>
<?php
// auto-generated by sfPropelCrud
// date: 2007/04/06 17:17:58
?>
<?php use_helper('Object') ?>
<?php use_helper('okinawa'); ?>
<div class="edit">
<?php echo form_tag('tool/keywordupdate') ?>
<h1><?php echo $keyword->getTitle(); ?></h1>
<table>
<tbody>
<tr>
  <th>表示優先度</th>
  <td><input type="text" name="orderpriority" value="<?php echo $keyword->getOrderPriority(); ?>" size=5></td>
</tr>
<tr>
  <th>英語名</th>
  <td><input type="text" name="englishtitle" value="<?php echo $keyword->getEnglishtitle(); ?>" size=40></td>
</tr>
<tr>
  <th>説明</th>
  <td><textarea rows="5" cols="64" name="description"><?php echo $keyword->getDescription(); ?></textarea></td>
</tr>
</tbody>
</table>
<br />
<input type="hidden" name="id" value="<?php echo $keyword->getId(); ?>">
<br />
<?php echo submit_tag('更新') ?>
</form>
</div>