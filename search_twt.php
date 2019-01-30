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

    <?php

        $consumer_key = 'IXPzy27UJ744LiKIFThZBwk7Q';
        $consumer_secret = 'qXoWYwkiJG3KS4p6KTGYxxruvc44x52YgxdJzKKU0QjetzH4yy';
        $access_token = '157936916-5L5atN6pCwNRwgU9fbZ5my040R46IsB7cxJlHwOu';
        $access_token_secret = 'JbHrHJIofICC8vOqePVL4FO2iVOEqlejIsy5pfCLYQglm';

        require "twitteroauth/autoload.php";
        use Abraham\TwitterOAuth\TwitterOAuth;


        $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
        $content = $connection->get("account/verify_credentials");

        session_start();

    ?>

    <div class="container" id="twitter_feed">
        <br><br><br><br>
        <div class="jumbotron">
            <h1><i class="fab fa-twitter-square"></i> Search Feed</h1>
            <hr>
            <div id="tweet_list">

                <ul class="list-group">
                    <?php

                        if(isset($_SESSION['searchq'])){
                            $search_query = $_SESSION['searchq'];
                        }

                        
                        $query = array(
                            "q" => $search_query,
                            "count" => 10,
                            "result_type" =>"popular",
                        );

                        $result = $connection->get('search/tweets', $query);
                        

                        echo '<ul class="list-group">';
                        foreach($result->statuses as $value) {
                            
                            echo '<li class="list-group-item list-group-item-dark">
                                  <a class="btn btn-danger" href="http://twitter.com/anyuser/status/'.$value->id_str.'"> View Tweet</a>
                                  <form class="inline-form" action="project_php.php?id=3" method="post"><button class="btn btn-dark" id="rt_btn" name="rt_submit"><i class="fas fa-retweet"></i></button></form>
                                  <b> '.$value->user->name.': </b>'.$value->text.'</li>';
                            
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



</body>
</html>