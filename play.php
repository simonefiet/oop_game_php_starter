<?php 

	/*
	This page is to handle the HTML, instantiating objects, storing sessions and calling appropriate methods.
	*/

	//Include files
	$pagetitle = 'Play'; //Define pagetitle
	include 'header.php';
	include 'inc/Game.php';
	include 'inc/Phrase.php';

	session_start(); //Start new session
	
	if (isset($_POST['start'])) {
	    unset($_SESSION['selected']);
	    unset($_SESSION['phrase']);
	}

	
	
	if(!isset($_POST['key'])) {
		$_SESSION['phrase'] = new Phrase();
   		$_SESSION['game'] = new Game($_SESSION['phrase']);
	} else {
		$selection = filter_input(INPUT_POST, 'key', FILTER_SANITIZE_STRING);
     	$_SESSION['phrase']->selected[] = $selection;
	}

?>

    <div id="banner" class="section">
        <h2 class="header">
        	<?php echo $sitetitle; // echo sitetitle as headline ?>		
        </h2>
        <div>
        	<?php echo $_SESSION['phrase']->displayPhrase(); ?>
		</div>
		<form action="play.php" method="POST">
			<div class="keyboard">
				<?php echo $_SESSION['game']->displayKeyboard(); ?>		
			</div>
			<?php
				echo $_SESSION['game']->displayScore();
				echo $_SESSION['game']->gameOver();
			?>
		</form>
    </div>

    <!-- 
    Use keypress to submit answer
    Code found here: https://css-tricks.com/snippets/javascript/javascript-keycodes/
    -->
    <script>
    	document.addEventListener("keydown", function(event) {
			console.log(event.key);
			var keyboard = document.getElementsByClassName("key"); //Every input button has class key
			var letter = event.key;
			for(
				let i = 0; 
				i <= keyboard.length -1; 
				i++
			) {
		  		let key = keyboard[i].value;
		  		if(letter == key) {
		  			keyboard[i].click(); //Use .click() function to prevent click. If input is disabled nothing happens
		  		}
		  	}
		});
    </script>

<?php
	//Include footer
	include 'footer.php';
?>