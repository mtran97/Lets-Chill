<!DOCTYPE html>
<html>
<head>
	<title>2Lit</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css"></link>
	<link rel="stylesheet" href="css/style.css"></link>
	<link href='http://fonts.googleapis.com/css?family=Overlock' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Chivo' rel='stylesheet' type='text/css'>
		
	</style>
</head>
<body>
	<div class="container">
		<div class="row page-header">
			<a href="index.php"><h1 class="lit-heading" id="heading">2Lit  <span class="glyphicon glyphicon-fire" aria-hidden="true"></span></h1></a>
		</div>
		<div class="col-md-8" id="contentid"> <!-- The main content column -->
			<div class="row jumbotron">
				<h1>Wanna know what's cool in your area?</h1>
				<p>Click below to sign up for an account! Look below to see some of the hottest events from around the world!</p>
				<button type="button" class="btn btn-primary btn-lg">Sign me up!</button>
			</div>
			<div class="row" id="sort">		<!-- Begin sort div -->
				<span id="inline-sort">Sort by: </span>
				<div class="dropdown">
				  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				    Hot
				    <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
				    <li><a href="#">Newest</a></li>
				    <li><a href="#">Upcoming events</a></li>
				    <li><a href="#">Top</a></li>
				    <li><a href="#">Hot</a></li>
				  </ul>
				</div>
			</div>			<!-- End sort div -->

			<div class="row well" id="contentid">

				<!-- POST-->
				<div class="row panel panel-default post">
					<div class="col-md-4">		<!-- Left side -->
						<div class="row date left-post">
							[date]
						</div>
						<div class="row time">
							[time]
						</div>
						<div class="row place">
							@ [place]
						</div>
					</div>
					<div class="col-md-8 right-post">		<!-- Right side -->
						<div class="row title">
							[title]
						</div>
						<div class="row description">
							[description here]
						</div>
						<div class="row host">
							posted by: <a href="#">[name]</a>
						</div>
						<div class="row host">
							<a href="#">(0 comments)</a>
						</div>
					</div>
					<div class="row interest button-toolbar">
						<button type="button" class="btn btn-default btn-lg upvote"><span class="glyphicon glyphicon-fire" aria-hidden="true"></span>  I'm interested (<span class="upvotes">1</span>)</button>
						<button type="button" class="btn btn-default btn-lg downvote"><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>  2Lame (<span class="downvotes">0</span>)</button>
					</div>
				</div>
				<!-- END POST-->

			</div>
		</div>								<!-- End main content column-->
		<div class="col-md-4" id="sidebarid"> <!-- The sidebar -->
			<div class="panel panel-default">
				<div class="panel-body">
					<p></p>
					<br><br><br><br><br><br><br><br><br>
				</div>
			</div>
		</div>								<!-- End sidebar-->
	</div>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>