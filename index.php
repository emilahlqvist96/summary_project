<ul>
	<li><a href="add_subject.php">Add subject</a></li>

<?php

	$host = "localhost";
	$dbname = "summary_project";
	$username = "summary_project";
	$password = "123123";
	$dsn = "mysql:host=$host;dbname=$dbname";
	$attr = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
	$pdo = new PDO($dsn, $username, $password, $attr);

	if(!empty($_POST))
	{
		if($_POST['subject_name'] !== "")
		{
			$_POST = null;
			$subject_name = filter_input(INPUT_POST, 'subject_name');
			$statement = $pdo->prepare("INSERT INTO subjects (name) VALUES (:subject_name)");
			$statement->bindParam(":subject_name", $subject_name);
			if(!$statement->execute())
				print_r($statement->errorInfo());
		}
	}

	foreach($pdo->query("SELECT * FROM subjects ORDER BY name") as $row)
	{	
		echo "<li><a href=\"summaries.php?subject_id={$row['id']}\">{$row['name']}</a></li>";
	}

?>

</ul>