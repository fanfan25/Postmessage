<!-- Exercise from ch.6 -->
<!DOCTYPE html>
<html style="margin: auto; max-width: 960px;">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Message Board</title>
</head>
<body>
	<h1 style="background-color:lightblue; padding: 50px; margin: -8px 0px;">Message Board</h1>
	<?php 

		if(isset($_GET["action"])){
			if((file_exists("MessageBoard/messages.txt")) && (filesize("MessageBoard/messages.txt") != 0)){
				$MessageArray = file("MessageBoard/messages.txt");
				switch ($_GET["action"]){
					case "Delete First":
						array_shift($MessageArray);
						break;
					case "Delete Last":
						array_pop($MessageArray);
						break;
					case "Delete Message":
						if(isset($_GET["message"])){
							array_splice($MessageArray, $_GET["message"], 1);
						}
						break;
					case "Sort Ascending":
						sort($MessageArray);
						break;
					case "Remove Duplicates":
						$MessageArray = array_unique($MessageArray);
						$MessageArray = array_values($MessageArray);
						break;

				}// end of switch statement

			}// end of file checking if statement
			if(count($MessageArray) > 0){
				$NewMessages = implode($MessageArray);
				$MessageStore = fopen("MessageBoard/messages.txt", "wb");
				if ($MessageStore === FALSE) {
					echo "There was an error updating the message file!\n";
				}
				else{
					fwrite($MessageStore, $NewMessages);
					fclose($MessageStore);
				}

			}//end of count if statement
			else{
			// we are here because $MessageArray is empty
			unlink("MessageBoard/messages.txt");
			}
		
		}// end of isset if statement

		if ((!file_exists("MessageBoard/messages.txt")) || (filesize("MessageBoard/messages.txt") == 0)) {
			echo "<p>Sorry, there are no messages posted.</P>\n";
		}
		else{
			$MessageArray = file("MessageBoard/messages.txt");

			echo "<table style=\"background-color: white; margin: -25px 0px 0px 0px\" border=\"0\" width=\"100%\">\n";
			$count = count($MessageArray);
			for ($i=0; $i < $count; ++$i) { 
				$CurrMsg = explode("~", $MessageArray[$i]);

				echo "<tr style=\"background-color: lightgray;\">\n";
				echo "<td width=\"5%\" style=\"text-align:center; font-weight: bold;\">",($i + 1), "</td>\n";
				echo "<td width =\"85%\"><span style=\"font-weight: bold\">Subject: </span>", htmlentities($CurrMsg[0]), "<br/>\n";
				echo "<span style=\"font-weight: bold;\">Name: </span>", htmlentities($CurrMsg[1]), "<br/>\n";
				echo "<span style=\"font-weight: bold; text-decoration: underline;\">Message </span><br/>\n", htmlentities($CurrMsg[2]), "</td>\n";
				echo "<td width=\"10%\" style=\"text-aligncenter;\"><a href='MessageBoard.php?action=Delete%20Message&message=$i'>Delete this Message</a></td>\n";
				echo "</tr>\n";
			}
			echo "</table>\n";

		}

	?>
	<p>
		<a href="PostMessage.php" style="background-color: red; color:white; margin: 20px 0px 0px 0px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px; text-decoration: none;">Post New Message</a><br/>&nbsp;&nbsp;
	</p>

	<p>
		<a href="MessageBoard.php?action=Remove%20Duplicates" style="background-color: darkturquoise; color:white; margin: 20px 0px 0px 0px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px;text-decoration: none;">Remove Duplicate Messages</a><br/>&nbsp;&nbsp;
	</p>


	<p>
		<a href="MessageBoard.php?action=Sort%20Ascending" style="background-color: blue; color:white; margin: 20px 10px 0px 0px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px;text-decoration: none;">Sort Message A-Z</a><br/>&nbsp;&nbsp;
	</p>

	<p>
		<a href="MessageBoard.php?action=Delete%20First" style="background-color: blueviolet; color:white; margin: 20px 0px 0px 0px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px;text-decoration: none;">Delete First Message</a><br/>&nbsp;&nbsp;
	</p>

	<p>
		<a href="MessageBoard.php?action=Delete%20Last" style="background-color: darkblue; color:white; margin: 20px 0px 0px 0px; padding: 10px 30px 10px 30px ; border-radius: 0px 30px 30px 0px;text-decoration: none;">Delete Last Message</a>
	</p>

</body>
</html>