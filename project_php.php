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
	<div id="nav_bar">
	    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #2c3e50">
	        <div class="container">
	            <a class="navbar-brand"  href="project_php.php?id=1"><i class="fab fa-twitter"></i> &nbsp; Twitter API</a>
	            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
	            </button>

	            <div class="collapse navbar-collapse" id="navbarSupportedContent">   
	             	<ul class="navbar-nav mr-auto">
		              <li class="nav-item">
				        <a class="nav-link" href="https://twitter.com/sn_1798"><i class="fas fa-external-link-alt"></i> Home</a>
				      </li>
				      <li class="nav-item">
				        <a class="nav-link" href="project_php.php?id=2"> Get Tweets</a>
				      </li>
				    </ul>
			   	    <form class="form-inline" method="post" action="project_php.php?id=3">
				      	<input class="form-control  mr-sm-1" id="input_bar" placeholder="Search" aria-label="Search" name="search_query">
	                    <button class="btn btn-dark-outline" id="search_bar" type="submit">Search</button>
				    </form>

	                
	            </div> 	
	        </div>	
	    </nav>
	</div>

	<?php 

		if(isset($_GET["id"])){

			$ch = $_GET["id"];
			switch($ch)
			{
				case 1: include('insert_tweet.php');
						break;
				case 2: include('rt_tweet.php');
						break;
				case 3: session_start();

						if(isset($_POST['search_query'])){

							$user = $_POST['search_query'];
							// header("location: search_twt.php")
						}

					    $_SESSION['searchq'] = $user;
					    include('search_twt.php');
						break;
				
					
			}
		}

	?>

	<!-- <div class="container" id="home">
	    <br><br><br><br><br><br><br><br><br>
	    <div class="jumbotron">
	        <h1><i class="fab fa-twitter-square"></i> Tweet</h1>
	        <h3></h3>
	        <hr>
	        <center>
	        	<form action="project_php.php" method="POST">
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

	<div class="container" id="twitter_feed">
	    <br><br><br><br>
	    <div class="jumbotron">
	        <h1><i class="fab fa-twitter-square"></i> Twitter Feed</h1>
	        <hr>
	        <div id="tweet_list">
				<ul class="list-group">
					<?php

						$tweet_json = $connection->get("statuses/home_timeline", ["count" => 20,"exclude_replies" => true]);
	                    $tweet_ar = json_decode(json_encode($tweet_json), True);

						echo '<ul class="list-group">';
						foreach($tweet_ar as $value) {
							
							echo '<li class="list-group-item list-group-item-dark">
								  <a class="btn btn-danger" href="http://twitter.com/anyuser/status/'.$value[id_str].'"> View Tweet</a>
								  <form class="inline-form" method="post"><button class="btn btn-dark" id="rt_btn" name="rt_submit"><i class="fas fa-retweet"></i></button></form>
								  <b> '.$value[user][name].': </b>'.$value[text].'</li>';
							
						}
						echo '</ul>';
						
						if(isset($_POST['rt_submit'])){
							$id = "983397191212412928";
	   					    $rt_tweet = $connection->post("statuses/retweet/$id");
						}

					?>
				</ul>
	        </div>
	    </div>
	</div>

	<div class="container" id="search_feed">
	    <br><br><br><br>
	    <div class="jumbotron">
	        <h1><i class="fab fa-twitter-square"></i> Search Feed</h1>
	        <hr>
	        <div id="search_list">
				<ul class="list-group">
					 <?php

						// $tweet_json = $connection->get("statuses/home_timeline", ["count" => 20,"exclude_replies" => true]);
	     //                $tweet_ar = json_decode(json_encode($tweet_json), True);


						// echo '<ul class="list-group">';
						// foreach($tweet_ar as $value) {
						// 	echo '<li class="list-group-item list-group-item-dark"><b>'.$value[user][name].': </b>'.$value[text].'</li>';
							
						// }
						// echo '</ul>';
					?> 
				</ul>
	        </div>
	    </div>
	</div> -->



	
	

	


<script type="text/javascript" src="script.js"></script>
</body>
</html>