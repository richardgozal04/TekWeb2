<?php
require_once 'init.php';

if(isset($_POST['user'])) {
	$user = $_POST['user'];
	
	$loginQuery=$db->prepare("
		SELECT id, username, COUNT(*) AS jumlah 
		FROM users 
		WHERE username = :user
	");

	$loginQuery->execute([
		'user' => $user
	]);

	while($row=$loginQuery->fetchObject()) {
			$logins[] = $row;
		}

	foreach($logins as $answer):
		$_SESSION['user_id'] = $answer->id;
		$_SESSION['user'] = $answer->username;
	endforeach;

	if(isset($_SESSION['user_id'])) {
		header('Location: index.php');
	}
	else
	{
		header('Location: login.php');
	}
}
else
{
	header('Location: login.php');
}

/*$user = $_POST['user'];
			
			$sql = "SELECT id, username, COUNT(*) AS jumlah FROM users WHERE username = '".$user."'";
			$result = mysql_query($sql);
			$row = mysql_fetch_assoc($result);

			if ($row['jumlah'] >= 1){
				$_SESSION['user'] = $row['username'];
				$_SESSION['user_id'] = $row['id'];
				header("Location: index.php");
			} else {
				header("Location: login.php");
			}*/
?>