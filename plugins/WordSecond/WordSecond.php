<?php

/*

Plugin Name: Word Second
Description: Show a word depends of a second is even or no.
Author: O.B
*/

//Exit if Access by Path
if(!defined('ABSPATH')){
  exit;
}
//Class Words
require __DIR__ . '/includes/Words.php';
if (  defined( 'WP_CLI' ) && WP_CLI ) {
  // Do WP-CLI specific things.
  echo 'YES';
}

// include files via shortcode
function random_words() {
// Get 3 words from API
	$words = array();   
for ($x = 0; $x <= 2; $x++) {
  $data=file_get_contents("https://random-words-api.vercel.app/word");
//get the word
  $word=explode(" \"word\": \"", $data)[1];
  $word=explode("\"", $word)[0];
//get the definition
$definition=explode(" \"definition\": \"", $data)[1];
$definition=explode("\"", $definition)[0];
//get the pronunciation
$pronunciation=explode(" \"pronunciation\": \"", $data)[1];
$pronunciation=explode("\"", $pronunciation)[0];
//create object
  $words[$x] = new Word($word, $definition,$pronunciation);
}
if ( defined( 'cli' ) && WP_CLI ) {
  echo 'Yes';
}
//Script
$content='  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
</script> <script> 
var words = '. json_encode($words). ';
$(document).ready(function () {
  
  intr = setInterval(yourfun, 1000);

  function yourfun() {
  
  
  time = new Date();   
  currentSeconds = time.getSeconds();
  
  if(currentSeconds == 0 ){
    $("#wordrand").html("'.$words[1]->get_word().' :");
    $("#defrand").html("'.$words[1]->get_definition().' ");
    $("#prorand").html("'.$words[1]->get_pronunciation().' ");
}
else if(currentSeconds % 2 ==0){
    $("#wordrand").html("'.$words[2]->get_word().' :");
    $("#defrand").html("'.$words[2]->get_definition().' ");
    $("#prorand").html("'.$words[2]->get_pronunciation().' ");
}
else {
  $("#wordrand").html("'.$words[0]->get_word().' :");
  $("#defrand").html("'.$words[0]->get_definition().' ");
  $("#prorand").html("'.$words[0]->get_pronunciation().' ");
}
     
  }
});

</script> ';
//title 
$content .='<div id="app">
<h1>Dictionary</h1> </div>';

 //the display of words 
$content .='<div > <dl>
  <dt >
    <p   id="wordrand">' . htmlspecialchars($words[0]->get_word()) . ': </p>
  </dt>
  <dd>
    <ol>
        <p id="defrand">' . htmlspecialchars($words[0]->get_definition())  . '</p>
        
        <dl>
          <dt id="prorand">' . htmlspecialchars($words[0]->get_pronunciation())  . '</dt>
        </dl>
    </ol>
  </dd>
  
</dl>
</div>';

return $content;
}
//add the short code
add_shortcode('random_words', 'random_words');

