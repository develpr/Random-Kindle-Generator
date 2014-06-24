<?php
	
class CustomContent{
	
	public function generateChapter() {
		$paragraphs = rand(7, 21);
		$images = ['https://farm3.staticflickr.com/2903/14152746038_2a6dcf8679_c.jpg', 'https://farm3.staticflickr.com/2938/14152435290_bd627629f6_c.jpg', 'https://farm4.staticflickr.com/3898/14358800113_5866e1a8d6_c.jpg', 'images/14086750705_419447b9e1_b.jpg'];
	
		$return = '';

		for($i = 0; $i < $paragraphs; $i++){
			$image = rand(1, 3);
		
			$return .= "<p>";
		
			$return .= $this->generateRandomParagraph();
		
			$return .= "</p>";
		
			if($image === 1){
				$return .= '<img src="' . $images[rand(0, count($images)-1)] . '" alt="" />';
			}
		}
	
		return $return;
	}
	
	
	public function generateRandomParagraph(){
		$length = rand(3, 10);
		$return = '';
	
		for($i = 0; $i < $length; $i++){
			$return .= ucfirst($this->generateRandomPhrase()) . '. ';
		}
	
		return $return;
	}

	public function generateRandomPhrase(){

		$length = rand(1, 10);
		$phrase = '';
	
		for($i = 0; $i < $length; $i++){
			$phrase .= ' ' . $this->generateRandomString();
		}
	
		return trim ($phrase);
	}

	public function generateRandomString() {
	
		$length = rand(1, 10);
	
	    $characters = 'abcdefghijklmnopqrstuvwxyz';
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, strlen($characters) - 1)];
	    }
	    return $randomString;
	}
	
}
