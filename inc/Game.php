<?php 

//Class with methods for showing the game, handling interactions, and checking for game over
class Game 
{
	private $phrase;
	private $lives = 5;

	//
	public function __construct(Phrase $phrase)
    {
		$this->phrase = $phrase;

    }

	//Checks to see if the player has selected all of the letters
	public function checkForWin() 
	{

		$score = array_intersect($this->phrase->selected, $this->phrase->getLetters());

		if (count($score) == count($this->phrase->getLetters())) {
			return true;
		} else {
			return false;
		}

	}

	//Checks to see if the player has guessed too many wrong letters. If counter() is equal to lives, the game is lost and should return true. 
	public function checkForLose()
	{

		if($this->phrase->counter() == $this->lives) {
			return true;
		} else {
			return false;
		}

	}

	//Displays one message if the player wins and another message if they lose. It returns false if the game has not been won or lost.
	public function gameOver()
	{

		if($this->checkForWin() == true) {

			$gameover = '<div id="overlay" class="win"><div>';
			$gameover .= '<h1 id="game-over-message">Congratulations on guessing: ' . $this->phrase->activePhrase . '</h1>';
			$gameover .= '<form action="play.php" method="POST"><input type="submit" value="Play again" class="btn__reset"></form>';
			$gameover .= '</div></div>';

		} elseif ($this->checkForLose() == true) {

			$gameover = '<div id="overlay" class="lose"><div>';
			$gameover .= '<h1 id="game-over-message">The phrase was: ' . $this->phrase->activePhrase . '. Better luck next time!</h1>';
			$gameover .= '<form action="play.php" method="POST"><input type="submit" value="Try again" class="btn__reset"></form>';
			$gameover .= '</div></div>';
	
		} else {
			$gameover = false;
		}

		return $gameover;

	}

	//Display the number of guesses available
	public function displayScore()
	{

		$score = '<div id="scoreboard" class="section"><ol>'; //Scoreboard div and ordered list start

		for ($correct = 0; $correct < $this->lives - $this->phrase->counter(); $correct++) {
			$score .= '<li class="tries"><img src="images/liveHeart.png" height="35px"></li>';
		}

		for ($wrong = 0; $wrong < $this->phrase->counter(); $wrong++ ) {
			$score .= '<li class="tries"><img src="images/lostHeart.png" height="35px"></li>';
		}

		$score .= '</ol></div>'; //Scoreboard div and ordered list end

		return $score;

	}

	//Return a string of HTML form for keyboard
	public function displayKeyboard()
	{

		$keyrow1 = array('q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p');
		$keyrow2 = array('a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l');
		$keyrow3 = array('z', 'x', 'c', 'v', 'b', 'n', 'm');

		$keys = '<div id="qwerty" class="section">'; //Keyboard div start 
		$keys .= '<div class="keyrow">'; //Keyrow 1 start
		foreach ($keyrow1 as $letter) {
			$keys .= $this->checkKey($letter);
		}
		$keys .= '</div>'; //Keyrow 2 end
		$keys .= '<div class="keyrow">'; //Keyrow 2 start
		foreach ($keyrow2 as $letter) {
			$keys .= $this->checkKey($letter);
		}
		$keys .= '</div>'; //Keyrow 2 end

		$keys .= '<div class="keyrow">'; //Keyrow 3 start
		foreach ($keyrow3 as $letter) {
			$keys .= $this->checkKey($letter);
		}
		$keys .= '</div>'; //Keyrow 3 end

		$keys .= '</div>'; //Keyboard div end 

		return $keys;

	}

	//Check if the guessed key is in current phrase
	public function checkKey($letter) {

		if(!in_array($letter, $this->phrase->selected)) { //If letter not selected
			$button = '<input class="key" type="submit" id="' . $letter . '" button name="key" value="' . $letter . '">';	
		} else { //If letter selected
			if($this->phrase->checkLetter($letter)) { 
				//If selected letter is correct
				$button = '<input class="key correct" type="submit" id="' . $letter . '" button name="key" value="' . $letter . '" disabled>';
			} else { 
				//Else selected letter is wrong
				$button = '<input class="key incorrect" type="submit" id="' . $letter . '" button name="key" value="' . $letter . '" disabled>';
			}
		}
		return $button;

	}

	
	
}

	
?>