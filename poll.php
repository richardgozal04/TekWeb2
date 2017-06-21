<?php
	require_once 'init.php';
	if(!isset($_GET['poll'])) {
		header('Location: index.php');
	} else {
		$id = (int)$_GET['poll'];
	}
	
	//poll information
	$pollQuery = $db->prepare("
		SELECT id, question
		FROM polls
		WHERE id = :poll
		AND DATE(NOW()) BETWEEN starts AND ends
	");
	$pollQuery->execute([
		'poll' => $id
	]);
	$poll = $pollQuery->fetchObject();
	
	//Get The user answer for this poll
	$answerQuery = $db->prepare("
		SELECT polls_choices.id AS choice_id, polls_choices.name AS choice_name
		FROM polls_answers
		JOIN polls_choices
		ON polls_answers.choice = polls_choices.id
		WHERE polls_answers.user = :user
		AND polls_answers.poll = :poll
	");
	
	$answerQuery->execute([
		'user' => $_SESSION['user_id'],
		'poll' => $id
	]);
	
	//Has User complete poll?4
	$completed = $answerQuery->rowCount() ? true : false;
	
	if($completed){
		//Get all answers
		$answerQuery = $db->prepare("
			SELECT
			polls_choices.name,
			COUNT(polls_answers.id) * 100 / (
				SELECT COUNT(*)
				FROM polls_answers
				WHERE polls_answers.poll = :poll) AS percentage
			FROM polls_choices
			LEFT JOIN polls_answers
			ON polls_choices.id = polls_answers.choice
			WHERE polls_choices.poll = :poll
			GROUP BY polls_choices.id
		");
		$answerQuery->execute([
			'poll' => $id
		]);
		
		//extract answers
		while($row = $answerQuery->fetchObject()){
			$answers[] = $row;
		}
	} else {
		//Get poll choices
		$choicesQuery = $db->prepare("
			SELECT polls.id, polls_choices.id AS choice_id, polls_choices.name
			FROM polls
			JOIN polls_choices
			ON polls.id = polls_choices.poll
			WHERE polls.id = :poll
			AND DATE(NOW()) BETWEEN polls.starts AND polls.ends
		");
		
		$choicesQuery->execute([
			'poll' => $id
		]);
		
		//Extract choices
		while($row=$choicesQuery->fetchObject()) {
			$choices[] = $row;
		}
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
			.poll{
				padding:20px;
				border:1px solid #ccc;
			}
			.poll-question{
				margin-bottom:20px;
			}
			.poll-options{
				margin-bottom:20px;
			}
			.poll-option{
				margin-bottom:10px;
			}
			.borderAll {
				border:solid 1px #ccc;
			}
		</style>
		
	</head>
	<body>
		<?php if(!$poll): ?>
			<p>That poll doesn't exist</p>
		<?php else: ?>
			<div class="poll">
				<div class="poll-question">
					<?php echo $poll->question; ?>
				</div>
				
				<?php if($completed): ?>
					<p>You have completed the poll, thanks. </p>
					
					<ul>
					<?php foreach($answers as $answer): ?>
						<li><?php echo $answer->name; ?> (<?php echo number_format($answer->percentage, 2); ?>%)</li>
					<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<?php if(!empty($choices)): ?>
						<form action="vote.php" method="post">
							<div class="poll-options">
							
								<?php foreach($choices as $index => $choice): ?>
								<div class="poll-option">
									<input type = "radio" name="choice" value="<?php echo $choice->choice_id; ?>" id="c<?php echo $index; ?>">
									<label for="c<?php echo $index; ?>"><?php echo $choice->name; ?></label>
								</div>
								<?php endforeach; ?>
								
							</div>
							<input type="submit" value="Submit Answer">
							<input type="hidden" name="poll" value="<?php echo $id; ?>">
						</form>
					<?php else: ?>
						<p>There are no choices right now. </p>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php endif; ?>
	</body>
</html>