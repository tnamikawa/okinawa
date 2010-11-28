<?php
 
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', false);
 
// initialize database manager
$databaseManager = new sfDatabaseManager($configuration);
$databaseManager->initialize($configuration);

$c = new Criteria();
$c->add(PhotoPeer::COMMENT, null, Criteria::ISNOTNULL);
$photos = PhotoPeer::doSelect($c);

$idx = mt_rand(0, sizeof($photos) - 1);
$photo = $photos[$idx];


require_once('twitteroauth.php');

$consumer_key = 'MZXz2Ne2BV3j8ECFAwovWg';							// Consumer keyの値
$consumer_secret = 'Lw6k1fW7jqil7dMl5lpek9xM3AZhR6vl4951pfM';	// Consumer secretの値

$access_token = "177564150-vNekl7lGYFAf8dTrnkamZmCicyyrp2toBMIQHLEc";
$access_token_secret = "NFz7BecMpaZ4YCluA2xVZajGLUiWgZBAazDAraCIg";

// OAuthオブジェクト生成
$to = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

//発言用文字列作成(最大文字数を考慮して発言フォーマット作成)
$tweet_max_len = 120;   //tweetメッセージの最大文字数(変更可)

$tmpUrl = 'http://tinyurl.com/api-create.php?url=' . 'http://photo-okinawa.com/photo/show?id=' . $photo->getId();

$writer_and_url = file_get_contents($tmpUrl);
$body_len_max = $tweet_max_len - mb_strlen($writer_and_url,'utf-8');

$comment = $photo->getComment();
if(mb_strlen($comment, 'utf-8') > $body_len_max) {
  $comment = mb_substr($comment, 0, $body_len_max - 3) . '...';
}

$status = $comment . $writer_and_url;  //発言内容

$method = 'statuses/update.xml';				//発言を行うメソッドを指定
$parameters = array('status' => $status);	//パラメータを指定(ここでは発言内容を指定)

// TwitterへPOSTする。パラメーターは配列に格納する
$req = $to->OAuthRequest('https://twitter.com/'.$method,'POST',$parameters);



