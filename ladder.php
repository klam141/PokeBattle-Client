<?php

include 'lib/ntbb-ladder.lib.php';

$serverid = 'showdown';
$formatid = 'OU';

if (@$_REQUEST['format']) $formatid = $_REQUEST['format'];
if (@$_REQUEST['server']) $serverid = $_REQUEST['server'];

if (!ctype_alnum($formatid)) {
	die('denied');
}

if (isset($_REQUEST['testclient'])) {
	header('Content-Type: text/plain; charset=utf-8');
}

function page() {
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"])) {
		if ($_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

$page = page();
$url = "http://play.pokemonshowdown.com/ladder.php?format=" . $formatid . "&server=" . $serverid . "&output=html";

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);