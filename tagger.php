<?php


	// $the_text = $_GET['text'] ;
	//$the_text = "The enormous broad tires of the chariots and the padded feet of the animals brought forth no sound from the moss-covered sea bottom; and so we moved in utter silence, like some huge phantasmagoria, except when the stillness was broken by the guttural growling of a goaded zitidar, or the squealing of fighting thoats.";
	$the_text = "Once upon a time there was a dear little girl who was loved by everyone who looked at her, but most of all by her grandmother, and there was nothing that she would not have given to the child. Once she gave her a little riding hood of red velvet, which suited her so well that she would never wear anything else; so she was always called 'Little Red Riding Hood.'
	One day her mother said to her: 'Come, Little Red Riding Hood, here is a piece of cake and a bottle of wine; take them to your grandmother, she is ill and weak, and they will do her good. Set out before it gets hot, and when you are going, walk nicely and quietly and do not run off the path, or you may fall and break the bottle, and then your grandmother will get nothing; and when you go into her room, don't forget to say, \"Good morning\", and don't peep into every corner before you do it.'
	'I will take great care,' said Little Red Riding Hood to her mother, and gave her hand on it.
	The grandmother lived out in the wood, half a league from the village, and just as Little Red Riding Hood entered the wood, a wolf met her. Red Riding Hood did not know what a wicked creature he was, and was not at all afraid of him." 	;

process_the_content( $the_text );


function process_the_content( $the_text ){

	// split text into an array of sentences
	$sentenceArray = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $the_text);
	//echo json_encode($sentenceArray);

	
	foreach ($sentenceArray as $sentence)  // for each sentence, 

		$this_result = tag_the_content( $sentence ); // run the tagger
		echo json_encode($this_result);
		echo "\n";
		set_time_limit(40);

		$taggedSpans = "";

		// create spans with tag as class
		foreach ($this_result as $element) {
			set_time_limit(40);
			$text = $element[0];
			$tag = $element[1];
			$span = "<span class=" + $tag + ">" + $text + "</span>";
			$taggedSpans.append($span);
		}

		echo $taggedSpans;

	}





function tag_the_content( $the_text ){

	$time_start = microtime(true);
	// sets DIR path variable
	$dir = dirname(__FILE__);
	// loads tagger
	include($dir.'/PHP-Stanford-NLP/autoload.php');
	// creates tagger
	$pos = new \StanfordNLP\POSTagger(
	  ($dir.'/PHP-Stanford-NLP/stanford-postagger-2015-04-20/models/english-left3words-distsim.tagger'),
	($dir.'/PHP-Stanford-NLP/stanford-postagger-2015-04-20/stanford-postagger.jar')
	);
	// calls tagger to tag the_content 
	// $result = $pos->tag(explode(' ', get_the_content() )); //  *** change back to this in production *** 

	$result = $pos->tag(explode(' ', $the_text ));

	// echo json_encode($result);
	return $result;

}


