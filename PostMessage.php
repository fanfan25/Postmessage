<!-- Exercise from ch.6 -->
<!DOCTYPE html>
<html style="margin: auto; max-width: 960px;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Post Message</title>
</head>
<body>
	<!-- Add PHP block here -->
	<?php 
		if (isset($_POST["submit"])) {
			$Subject = stripslashes($_POST["subject"]);
			$Name = stripslashes($_POST["name"]);
			$Message = stripslashes($_POST["message"]);

				//Replace any '~' with '-' characters
				$Subject = str_replace("~", "-", $Subject);
				$Name = str_replace("~", "-", $Name);
				$Message = str_replace("~", "-", $Message);

				$MessageRecord = "$Subject~$Name~$Message\n";

				// Let's create a varible to store a new open file's data
				$MessageFile = fopen("MessageBoard/messages.txt", "ab");

			// Check that ther are no issues with the file before writing the new massage to it
			if($MessageFile === FALSE){
				echo "There was an error in saving your message!\n";
			}
			else{
				fwrite($MessageFile, $MessageRecord);
				fclose($MessageFile);
				echo "Your message has been saved!\n";
			}
		}// end of main if statement
	?>

	<h1 style="background-color:lightblue; padding: 50px; color: purple;">Post New Message</h1>
	<hr>
	<form action="PostMessage.php" method="POST">
		<label style="font-weight: bold; color: purple;">Subject:</label>
		<input type="text" name="subject" oninvalid="this.setCustomValidity('Must be 4 Characters')" />
		<label style="font-weight: bold; color: purple;">Name:</label>
		<input type="text" name="name" /><br>
		<textarea name="message" rows="6" cols="80" style="margin-top: 12px;"></textarea><br>
		<input type="submit" name="submit" value="Post Message" style="background-color: purple; color:white; margin: 0px 0px 0px 0px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px;" />
		<input type="reset" name="reset" value="Reset Form" style="background-color: purple; color:white; margin: 0px 0px 0px 10px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px;" />
	</form>
	<hr>
	<p><a href="MessageBoard.php" style="background-color: blueviolet; color:white; margin: 10px 0px 0px 300px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px; text-decoration: none;">View Messages!</a></p>
</body>
</html>