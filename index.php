<?php 
	//Define pagetitle
	$pagetitle = 'Welcome';
	//Include header
	include 'header.php'; 
?>
	<h2 class="header">
		<?php echo $sitetitle; // echo sitetitle as headline ?>
	</h2>
    <form action="play.php">
        <input id="btn__reset" type="submit" value="Start Game" />
    </form>

<?php
	//Include footer
	include 'footer.php';
?>