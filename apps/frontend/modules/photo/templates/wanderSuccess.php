<title><?php echo $photo->getTitle() ; ?></title>
<meta name="description" content="<?php echo $photo->getComment(); ?>" />
<meta name="robots" content="index,follow" />
<script type="text/javascript" src="/js/prototype.js"></script>
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/photo.js"></script>
<script type="text/javascript">

id = <?php echo $photo->getId(); ?>;

</script>
</head>
<body onload="show(id);">
<?php
use_helper('okinawa');
?>

<h1>メイン写真</h1>
<div id="main"></div>

<h1>縦軸</h1>
<div id="vthumb"></div>

<h1>横軸</h1>
<div id="hthumb"></div>
