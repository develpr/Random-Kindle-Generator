<?php

require_once './vendor/autoload.php';

//This is sloppy, could/should use PSR standards and have composer autoload this, but
//  I'm going to say that's outside of the scope of this tutorial
require_once './CustomContent.php';


$phindle = new Develpr\Phindle\Phindle(array(
	'title' => "Chaos Theory: Randomness is Beautiful",
	'publisher' => "Develpr",
	'creator' => 'Kevin Mitchell',
	'language' => Develpr\Phindle\OpfRenderer::LANGUAGE_ENGLISH_US,
	'subject' => 'Computers', //@see https://www.bisg.org/complete-bisac-subject-headings-2013-edition
	'description' => 'A wonderfully random ebook',
	'path'	=> __DIR__ . '/ebooks', //The path that temp files will be stored, as well as the location of the final ebook mobi file
	'isbn'  => '4242424242424242',
	'staticResourcePath' => __DIR__, //The absolute path to your static resources referenced in html (images, css, etc)
	'cover'	=> '/images/14086750705_419447b9e1_b.jpg' , //The relative path of your cover image
	'kindlegenPath' => '/usr/local/bin/kindlegen', //The path to the kindlegen utility
    'downloadImages' => true, //Should images be downloaded from the web if found in your html?
));

$phindle->setAttribute('isbn', '4222222222222222');

for($i = 0; $i < 30; $i++)
{

	/** @var Illuminate\View\View $html */
	$html = getHtml();
	$title = getTitle();

	$content = new Develpr\Phindle\Content();

	$content->setHtml($html);
	$content->setTitle($title);

	$phindle->addContent($content);

}

//This is where all of the magic happens and the mobi file is actually generated
$phindle->process();

$path = __DIR__ . '/ebooks/' . $phindle->getAttribute('uniqueId') . '.mobi';


header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"Chaos_Theory_Randomness_is_Beautiful.mobi\""); 
readfile($path);



/**
 *	Get a random title
 */
function getTitle() {
	
	$customContent = new CustomContent();
	
	return ucwords($customContent->generateRandomPhrase());
}

/*
 *	Get some random html to represent a "chapter" of a book
 */
function getHtml() {
	
	$customContent = new CustomContent();
	
	return $customContent->generateChapter();
}

