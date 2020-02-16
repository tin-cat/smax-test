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

	define("SMAX_DIR", ".."); // Must contain the path to SMAX lib directory
	include SMAX_DIR."/smax.inc.php"; // Include SMAX definitions
	include SMAX_DIR."/smax.config.php"; // Include your desired SMAX configuration

	echo "<h1>".Smax\Main::getVersionInfo()." tests</h1>";

	echo "<ul class=properties>\n";
	array_walk(Smax\Main::getConfigInfo(), function($value, $key){ echo "<li><span>$key</span><span>$value</span></li>\n"; });
	echo  "</ul>\n";

	echo "<hr>\n";

	// Manually build some scenarios for an imaginary content to test the SMAX algorithm by directly feeding a list of ratings to Smax\Main::calculate
	$now = mktime();
	$secondsIntervalBetweenSteps = 60;

	// Simple humanist
	$set = new Smax\Set(array(
		new Smax\RatingDefault(array(
			"timestamp" => $now,
			"attitude" => Smax\ATTITUDE_HUMANIST
		)),
		new Smax\RatingFromOwner(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_SAFE
		)),
		new Smax\RatingFromOther(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		)),
		new Smax\RatingFromOther(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		)),
		new Smax\RatingFromOther(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		)),
	), Smax\ATTITUDE_HUMANIST);
	echo $set->getDebugInfoHtml("Simple");

	// Simple skeptical
	$set = new Smax\Set(array(
		new Smax\RatingDefault(array(
			"timestamp" => $now,
			"attitude" => Smax\ATTITUDE_SKEPTICAL
		)),
		new Smax\RatingFromOwner(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_SAFE
		)),
		new Smax\RatingFromOther(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		))
	), Smax\ATTITUDE_SKEPTICAL);
	echo $set->getDebugInfoHtml("Simple");

	// Simple moderated
	$set = new Smax\Set(array(
		new Smax\RatingDefault(array(
			"timestamp" => $now,
			"attitude" => Smax\ATTITUDE_HUMANIST
		)),
		new Smax\RatingFromOwner(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		)),
		new Smax\RatingFromOther(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		)),
		new Smax\RatingFromModerator(array(
			"timestamp" => $now+=$secondsIntervalBetweenSteps,
			"rating" => Smax\RATING_MODERATE
		))
	), Smax\ATTITUDE_HUMANIST);
	echo $set->getDebugInfoHtml("Simple moderated");

?></body>
</html>