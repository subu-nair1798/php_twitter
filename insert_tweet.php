<!DOCTYPE html>
<html>
<head>
	<title>Document</title>
<link rel="stylesheet" type="text/css" href="project.css">
<!-- CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous"></script>

    <script
    src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
    integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
    crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

	<div class="container" id="home">
	    <br><br><br><br><br><br><br><br><br>
	    <div class="jumbotron">
	        <h1><i class="fab fa-twitter-square"></i> Tweet</h1>
	        <h3></h3>
	        <hr>
	        <center>
	        	<form action="project_php.php?id=1" method="POST">
	        		<input class="form-control col-9 mr-sm-4" id="input_home" name="input_tweet" type="text" placeholder="Write Tweet ... " aria-label="Search">
	                <button class="btn btn-dark col-2" id="search_home" type="submit" onclick="tweet_func()"><i class="fab fa-twitter-square"></i> Tweet</button>
	        	</form>
	        </center>
	    </div>
	</div>

	<?php

		$consumer_key = 'IXPzy27UJ744LiKIFThZBwk7Q';
		$consumer_secret = 'qXoWYwkiJG3KS4p6KTGYxxruvc44x52YgxdJzKKU0QjetzH4yy';
		$access_token = '157936916-5L5atN6pCwNRwgU9fbZ5my040R46IsB7cxJlHwOu';
		$access_token_secret = 'JbHrHJIofICC8vOqePVL4FO2iVOEqlejIsy5pfCLYQglm';

		require "twitteroauth/autoload.php";
		use Abraham\TwitterOAuth\TwitterOAuth;


		$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
		$content = $connection->get("account/verify_credentials");


		if(isset($_POST['input_tweet'])){
			$tweet_text = $_POST['input_tweet'];
			$new_tweet = $connection->post("statuses/update", ["status" => $tweet_text]);
		}

	?>


</body>
</html>