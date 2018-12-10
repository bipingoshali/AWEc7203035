<?php
//get the q parameter from URL
$q=$_GET["q"];

//find out which feed was selected
if($q=="Google") {
  $xml=("http://news.google.com/news?ned=us&topic=h&output=rss");
} elseif($q=="ZDN") {
  $xml=("https://www.zdnet.com/news/rss.xml");
}

$xmlDoc = new DOMDocument();
$xmlDoc->load($xml);


//get elements from "<channel>"
$channel=$xmlDoc->getElementsByTagName('channel')->item(0);
$channel_title = $channel->getElementsByTagName('title')
->item(0)->childNodes->item(0)->nodeValue;
$channel_link = $channel->getElementsByTagName('link')
->item(0)->childNodes->item(0)->nodeValue;
$channel_desc = $channel->getElementsByTagName('description')
->item(0)->childNodes->item(0)->nodeValue;
$channel_copyright = $channel->getElementsByTagName('copyright')
->item(0)->childNodes->item(0)->nodeValue;
$channel_lastBuildDate = $channel->getElementsByTagName('lastBuildDate')
->item(0)->childNodes->item(0)->nodeValue;

//output elements from "<channel>"
echo ('<h2 style="text-align: center;">'.$channel_desc.'</h2>');
echo ('<h5 style="text-align: center;"><a href="'.$channel_link.'" target="_blank">'.$channel_title.'</a></h5>');
echo ('<h6 style="text-align: center;">'.$channel_lastBuildDate.'<br>'.$channel_copyright.'</h6><hr>');



//get and output "<item>" elements
$x=$xmlDoc->getElementsByTagName('item');
for ($i=0; $i<=2; $i++) {
  $item_title=$x->item($i)->getElementsByTagName('title')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_link=$x->item($i)->getElementsByTagName('link')
  ->item(0)->childNodes->item(0)->nodeValue;
  $item_desc=$x->item($i)->getElementsByTagName('description')
  ->item(0)->childNodes->item(0)->nodeValue;
    echo ('<div class="panel panel-primary">');
    echo ('<div class="panel-heading">');
    echo ('<h3 class="panel-title"><a href="'.$item_link.'" target="_blank">'.$item_title.'</a></h3>');
    echo ('</div>');
    echo ('<div class="panel-body">');
    echo ($item_desc);
    echo ('</div>');
    echo ('</div>');
}
?>
















</div>
