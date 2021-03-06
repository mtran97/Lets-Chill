<?php

include_once "global.php";

if (!isset($_SESSION['userid'])) {
	header("Location: signin.php");	
}

$canPost = false;
$canVote = false;

$success = true;
if (isset($_GET['city']))
	$cityid = $_GET['city'];
			// Else default to user's city
else if (isset($_SESSION['userid'])) {
	$query = "SELECT city_id FROM lit_user WHERE user_id = '".$_SESSION['userid']."'";
	$result = $conn->query($query);
	$data = $result->fetch_assoc();
	$cityid = $data['city_id'];
	header("Location: view.php?city=".$cityid."&sort=hot");
}

if (!is_numeric($cityid) || $cityid < 0 || $cityid != round($cityid, 0)) {
	$success = false;
	header("Location: error.html");
}
if (isset($_GET['sort'])) {
	$sort = strtolower($_GET['sort']);
	if ($sort == 'hot' || $sort == 'new' || $sort == 'top' || $sort == 'upcoming')
		$sort = strtolower($_GET['sort']);
	else
		$sort = 'hot';
}
else
	$sort = 'hot';

			// If user is logged in and is in the same city -- then they can post and vote
if (isset($_SESSION['userid']) && $_SESSION['cityid'] == $cityid) {
	$canPost = true;
	$canVote = true;
}
			// If they are logged in, then they can vote only
else if (isset($_SESSION['userid'])) {
	$canVote = true;
}

if ($success) {
	$query = "SELECT city, state FROM lit_cities WHERE city_id = '$cityid'";
	$result = $conn->query($query);
	if ($result->num_rows != 1)
		$success = false;
	else {
		$data = $result->fetch_assoc();
		$city = $data['city'];
		$state = $data['state'];
	}
}

if (!$success) {
	header("Location: index.php");
}
?>


<html>
<head>
	<title>too lit</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css"></link>
	<link rel="stylesheet" href="css/style.css"></link>
	<link href='//fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

</style>
</head>
<body>
	<!-- Fixed navbar -->
	<nav class="navbar navbar-default navbar-fixed-top navbar-font">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand lit-heading" href=" <?php echo "view.php?city=".$_SESSION['cityid']."&sort=hot";?> ">too lit  <span class="glyphicon glyphicon-fire" aria-hidden="true"></span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<?php

				if (isset($_SESSION['userid'])) {
					echo "          <ul class=\"nav navbar-nav\">\n";
					echo "            <li"; if ($sort == 'hot') echo " class=\"active\""; echo "><a href=\"view.php?city=".$cityid."&sort=hot\">Hot</a></li>\n";
					echo "            <li"; if ($sort == 'new') echo " class=\"active\""; echo "><a href=\"view.php?city=".$cityid."&sort=new\">New</a></li>\n";
					echo "            <li"; if ($sort == 'upcoming') echo " class=\"active\""; echo "><a href=\"view.php?city=".$cityid."&sort=upcoming\">Upcoming</a></li>\n";
					echo "            <li"; if ($sort == 'top') echo " class=\"active\""; echo "><a href=\"view.php?city=".$cityid."&sort=top\">Top</a></li>\n";
					echo "            <li><a><strong>"; echo $city.", ".$state; echo "</strong></a></li>\n";
					echo "          </ul>\n";
					echo "          <form class=\"navbar-form navbar-left\" role=\"search\">\n";
					echo "        <div class=\"form-group\">\n";
					echo "          <input type=\"text\" class=\"form-control\" placeholder=\"Take a peek at other cities\">\n";
					echo "        </div>\n";
					echo "        <button type=\"submit\" class=\"btn btn-default\">Search</button>\n";
					echo "      </form>";

				}

				?>

				<ul class="nav navbar-nav navbar-right">
					<?php

					if (isset($_SESSION['userid'])) {
						$query = "SELECT num_notifications FROM lit_user WHERE user_id = '".$_SESSION['userid']."'";
						$result = $conn->query($query);
						$data = $result->fetch_assoc();
						$num = $data['num_notifications'];
						echo "			<li><a href=\"submit.php\">Submit a post</a></li>\n";
						echo "			<li class=\"dropdown\">\n"; 
						echo "              <a class=\"dropdown-toggle noti\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\"><span class=\"glyphicon glyphicon-bell\"></span>"; if ($num>0) echo "<span class=\"badge notification\">".$num."</span>"; echo "<span class=\"caret\"></span></a>\n"; 
						echo "              <ul class=\"dropdown-menu notification-list\">\n"; 
						echo "					<li class=\"dropdown-header\">Notifications</li>";
						echo "              </ul>\n"; 
						echo "            </li>\n";
						echo "            <li class=\"dropdown\">\n";
						echo "              <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">". $_SESSION['username'] ." <span class=\"caret\"></span></a>\n";
						echo "              <ul class=\"dropdown-menu\">\n";
						echo "                <li><a href=\"#\">Profile</a></li>\n";
						echo "                <li><a href=\"#\">Settings</a></li>\n";
						echo "                <li role=\"separator\" class=\"divider\"></li>\n";
						echo "                <li><a href=\"files/termsandconditions.html\">Terms and Conditions</a></li>\n";
						echo "                <li><a href=\"files/privacypolicy.html\">Privacy Policy</a></li>\n";
						echo "                <li role=\"separator\" class=\"divider\"></li>\n";
						echo "                <li><a href=\"logout.php\">Sign out</a></li>\n";
						echo "              </ul>\n";
						echo "            </li>";
					}
					else {
						echo "			<li><a href=\"signin.php\">Sign in</a></li>\n";
					}

					?>

				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<img src="header.png" class="img-responsive">
		</div>
	</div>
	<div class="container">

		<div class="row">
			<div class="col-md-7" id="contentid"> <!-- The main content column -->

				<div class="row well" id="contentid">

					<!-- POST-->

					<?php

					if ($success) {
						$col = "*";
						$query = "SELECT ".$col." FROM lit_post WHERE city_id = '$cityid'";
						$query .= " AND date_event >= CURDATE()";
						if ($sort == 'new') {
							$query .= " ORDER BY datetime_posted DESC";
						}
						else if ($sort == 'upcoming') {
							$query .= " ORDER BY date_event ASC, starttime_event ASC";
						}
						else if ($sort == 'top') {
							$query .= " ORDER BY upvotes DESC, downvotes ASC";
						}
						else if ($sort == 'hot') {
							$query .= 
							"ORDER BY 
							LOG10(ABS(upvotes - downvotes) + 1) * SIGN(upvotes - downvotes)
							+ (UNIX_TIMESTAMP(datetime_posted) / 70000) DESC";
						}
						$result = $conn->query($query);
						while ($row = $result->fetch_assoc()) {
							// Print out each post
							$query = "SELECT username, total_upvotes, total_downvotes from lit_user WHERE user_id = '".$row['user_id']."'";
							$result2 = $conn->query($query);
							$data = $result2->fetch_assoc();
							$username = $data['username'];
							$op_upvotes = $data['total_upvotes'];
							$op_downvotes = $data['total_downvotes'];
							$upvotes = $row['upvotes'];
							$downvotes = $row['downvotes'];
							$postid = $row['post_id'];
							$num_comments = $row['comments'];

							$query = "SELECT response FROM lit_response WHERE user_id = '".$_SESSION['userid']."' AND post_id = '$postid'";
							$result3 = $conn->query($query);
							if ($result3->num_rows == 0) {
								$response = 0;
							}
							else {
								$data2 = $result3->fetch_assoc();
								if ($data2['response'] == "1")
									$response = 1;
								else if ($data2['response'] == "2")
									$response = 2;
								else
									$response = 0;
							}



							echo "				<div class=\"row panel panel-default post\">\n";
							echo "					<div class=\"row\">\n";
							echo "					<div class=\"col-md-4 col-sm-4\">		<!-- Left side -->\n";
							echo "						<div class=\"row date left-post\">\n";
							echo "							".date("m-d-Y", strtotime($row['date_event']))."\n";
							echo "						</div>\n";
							echo "						<div class=\"row time\">\n";
							echo "							".date('g:i a', strtotime($row['starttime_event']))."-\n<br>".date('g:i a', strtotime($row['endtime_event']));
							echo "						</div>\n";
							echo "						<div class=\"row place\">\n";
							echo "							@ ".$row['location']."\n";
							echo "						</div>\n";
							echo "					</div>\n";
							echo "					<div class=\"col-md-8 col-sm-8 right-post\">		<!-- Right side -->\n";
							echo "						<div class=\"row title\">\n";
							echo "							".$row['title']."\n";
							echo "						</div>\n";
							echo "						<div class=\"row description\">\n";
							echo "							".$row['description']."\n";
							echo "						</div>\n";
							echo "						<div class=\"row host\">\n";
							echo "							posted ".time_elapsed_string($row['datetime_posted'])." by: <a href=\"#\">".$username."</a> (+".$op_upvotes.", -".$op_downvotes.")\n";
							echo "						</div>\n";
							echo "						<div class=\"row host\">\n";
							echo "							<a href=\"comments.php?post=$postid\">("; echo "$num_comments"; echo " comment"; echo ($num_comments==1?"":"s"); echo ")</a>\n";
							echo "						</div>\n";
							echo "					</div>\n";
							echo "					</div>\n";
							echo "					<div class=\"row interest button-toolbar\" post-id=\"$postid\">\n";
							echo "						<button type=\"button\" class=\"btn "; if ($response==1) echo "btn-danger"; else echo "btn-default"; echo " upvote\"><span class=\"glyphicon glyphicon-fire\" aria-hidden=\"true\"></span>  I'm interested (<span class=\"upvotes\">".$upvotes."</span>)</button>\n";
							echo "						<button type=\"button\" class=\"btn "; if ($response==2) echo "btn-primary"; else echo "btn-default"; echo " downvote\"><span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span>  2Lame (<span class=\"downvotes\">".$downvotes."</span>)</button>\n";
							echo "					</div>\n";
							echo "				</div>\n\n";

						}
					}

					function time_elapsed_string($datetime, $full = false) {
						$now = new DateTime;
						$ago = new DateTime($datetime);
						$diff = $now->diff($ago);

						$diff->w = floor($diff->d / 7);
						$diff->d -= $diff->w * 7;

						$string = array(
							'y' => 'year',
							'm' => 'month',
							'w' => 'week',
							'd' => 'day',
							'h' => 'hr',
							'i' => 'min',
							's' => 'sec',
							);
						foreach ($string as $k => &$v) {
							if ($diff->$k) {
								$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
							} else {
								unset($string[$k]);
							}
						}

						if (!$full) $string = array_slice($string, 0, 1);
						return $string ? implode(', ', $string) . ' ago' : 'just now';
					}

					?>

					<!-- END POST-->

				</div>
			</div>								<!-- End main content column-->
		</div>
	</div>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>