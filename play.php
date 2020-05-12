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

<?php
	//Include footer
	include 'footer.php';
?>