<?php
	
	
class CustomContent implements Develpr\Phindle\ContentInterface {
	
	private $id;
	
	public function __construct() {
		$this->id = $this->generateRandomString();
	}
	
	/**
	 *	The unique ID of this content, which is used when building a manifest
	 *	for the book, as well as when generating links to various sections.
	 */
	public function getUniqueIdentifier()
	{
		return $this->id;
	}
	
	/**
	 *	The anchor path is name of the html output file
	 *	todo: this should probably be always calculated based on unique id
	 */
	public function getAnchorPath($id = "")
	{
		return $this->id . '.html';
	}
	
	/**
	 *	Get a random title
	 */
	public function getTitle() {
	
		return ucwords($this->generateRandomPhrase());
	}
	
	/*
	 *	Get some random html to represent a "chapter" of a book
	 */
	function getHtml() {
		
		return $this->generateChapter();
	}
	
	/**
	 *	We can return any integer and Phindle will do it's best to determine
	 *	the order of your content. If the positions aren't useful, then the
	 *	default sort order will be used, essentially the order the content
	 *	is added.
	 */
	public function getPosition() {
		return 1;
	}
	
	/**
	 *	You can specify sections in your content, but it's likely you won't need
	 *	or want to.
	 */
	public function getSections(){
		return null;
	}

	
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
