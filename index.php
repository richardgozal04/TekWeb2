<?php
	require_once 'init.php';
	
	$pollsQuery = $db->query("
		SELECT id, question
		FROM polls
		WHERE DATE(NOW()) BETWEEN starts AND ends
	");
	
	while($row = $pollsQuery->fetchObject()) {
			$polls[] = $row;
	}
	
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTS-8">
		<title>Document</title>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<style>
		.borderAll {
				border:solid 1px #ccc;
				margin:20px;
				padding:10px;
			}
	</style>

	</head>
	<body>
		<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">Polling</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
       <?php
		if (isset($_SESSION['user'])){
	  ?>
		
			<li><a href="home.php"><span class="glyphicon glyphicon-user"></span> You are logged in as <?php echo $_SESSION['user']; ?></a></li>
	      <li><a href="logout-user.php"><span class="glyphicon glyphicon-remove"></span> Logout</a></li>
		<?php }
		else { ?>
						
			<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
			<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    	<?php } ?>
    	</ul>
  </div>
</nav>
		<?php if(!empty($polls)): ?>
			<ul>
				<?php foreach($polls as $poll): ?>
					<li class="borderAll"><a href="poll.php?poll=<?php echo $poll->id;?>"><?php echo $poll->question; ?></a></li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p>Sorry, no polls available right now. </p>
		<?php endif; ?>
	</body>
</html>