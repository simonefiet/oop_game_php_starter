<?php 

//Class to handle the phrases
class Phrase 
{
	public $activePhrase; //Active phrase in game
	public $selected = array(); //Array of selected letters in game
	public $phrase = array(
		"How are you",
		"What a lovely day",
		"Techdegree PHP Development",
		"OOP PHP Game Show App",
		"Designing Interfaces in PHP"
	); //Array with phrases;

	public function __construct($phrase = null, $selected = null) //EFTERSE ****
	{
		if(!empty($phrase)) {
			$this->activePhrase = $phrase;
		} elseif (!isset($phrase)) {
			$randPhrase = array_rand($this->phrase);
			$this->activePhrase = $this->phrase[$randPhrase];
		}
		if(!empty($selected)) {
			$this->selected = $selected;
		}
	}

	public function displayPhrase() 
	{
		$output = '<div id="phrase" class="section"><ul>'; //Phrase div start
		$phraseLetters = str_split(strtolower($this->activePhrase));

		foreach($phraseLetters as $letter) {
			if($letter == ' ') { //Check if letter is space
				$output .= '<li class="space">' . $letter . '</li>'; 
			} elseif(in_array($letter, $this->selected)) {
				$output .= '<li class="show letter ' . $letter . '">' . $letter . '</li>';
			} else {
				$output .= '<li class="hide letter ' . $letter . '">' . $letter . '</li>';
			}
		}

		$output .= '</ul></div>'; //Phrase div end

		return $output;
	}

	public function getLetters()
    {
    	$output = array_unique(str_split(str_replace(' ', '', strtolower($this->activePhrase)))); //Remove spaces and set all letters to lowercase
    	return $output;
    }

    public function checkLetter($letter)
    {
    	if (in_array($letter, $this->getLetters())) {
        	return true;
      	} else {
      		return false;
      	}

    }

    public function counter()
    {
    	$count = count(array_diff($this->selected, $this->getLetters()));
     	return $count;
    }

}


	
?>