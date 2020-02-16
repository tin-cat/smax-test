<?php
	/**
	 * Tests
	 *
	 * Example basic direct usage of SMAX's algorithm by manually feeding content scenarios
	 *
	 * @package Smax
	 * @category Main
	 */
?><html>
<head>
	<title>SMAX tests</title>
	<link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body><?php

	require "vendor/autoload.php";
	// require __DIR__."/../smax/vendor/autoload.php";

	echo "<h1>".Smax\Main::getVersionInfo()." tests</h1>";

	echo "<ul class=properties>\n";
	array_walk(Smax\Main::getConfigInfo(), function($value, $key){ echo "<li><span>$key</span><span>$value</span></li>\n"; });
	echo  "</ul>\n";	

	echo "<hr>\n";

	// Manually build some scenarios for an imaginary content to test the SMAX algorithm by directly feeding a list of ratings to Smax\Main::calculate
	$now = mktime();
	$secondsIntervalBetweenSteps = 60;

	// Simple humanist
	$set = new Smax\Set([
		new Smax\RatingDefault([
			"timestamp" => $now,
			"attitude" => Smax\ATTITUDE_HUMANIST
		]),
		new Smax\RatingFromOwner([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_SAFE
		]),
		new Smax\RatingFromOther([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		]),
		new Smax\RatingFromOther([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		]),
		new Smax\RatingFromOther([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		]),
	], Smax\ATTITUDE_HUMANIST);
	echo $set->getDebugInfoHtml("Simple");

	// Simple skeptical
	$set = new Smax\Set([
		new Smax\RatingDefault([
			"timestamp" => $now,
			"attitude" => Smax\ATTITUDE_SKEPTICAL
		]),
		new Smax\RatingFromOwner([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_SAFE
		]),
		new Smax\RatingFromOther([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		])
	], Smax\ATTITUDE_SKEPTICAL);
	echo $set->getDebugInfoHtml("Simple");

	// Simple moderated
	$set = new Smax\Set([
		new Smax\RatingDefault([
			"timestamp" => $now,
			"attitude" => Smax\ATTITUDE_HUMANIST
		]),
		new Smax\RatingFromOwner([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		]),
		new Smax\RatingFromOther([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		]),
		new Smax\RatingFromModerator([
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_EXPLICIT
		])
	], Smax\ATTITUDE_HUMANIST);
	echo $set->getDebugInfoHtml("Simple moderated");

?></body>
</html>