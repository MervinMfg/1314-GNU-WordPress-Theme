<?php
/*
Template Name: Instagram JSON
*/
if (isset($_GET["username"])) {
	header('Content-Type: application/json');
	$feed = new DOMDocument();
	$feed->load('http://statigr.am/RSSFeed.php?username=' . $_GET["username"]);
	$json = array();
	$json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
	$json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
	//$json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue;
	$items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');
	$json['photos'] = array();
	$i = 0;
	foreach($items as $item) {
		// get needed items
		$title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
		$image = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
		$link = $item->getElementsByTagName('link')->item(0)->firstChild->nodeValue;
		$pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
		// take apart description string and get image url
		$image = strstr($image, "img src='");
		$image = strstr($image, "'/></a>", true);
		$image = str_replace("img src='", "", $image);
		// add to json array
		$json['photos'][$i]['title'] = $title;
		$json['photos'][$i]['image'] = $image;
		$json['photos'][$i]['link'] = $link;
		$json['photos'][$i]['pubdate'] = $pubDate;
		$i++;   
	}
	echo json_encode($json);
} else {
	header('Location: /');
}
?>