<?php
	require_once 'init.php';

	if(isset($_POST['user'])) {
		$user = $_POST['user'];
		
		$registerQuery = $db->prepare("
			INSERT INTO users (username)
			VALUE (:user)
		");
		$registerQuery->execute([
			'user' => $user
			]);

		header('Location: index.php');
	}
	else {
	header('Location: register.php');
	}
?>