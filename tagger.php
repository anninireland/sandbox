<?php


	// $the_text = $_GET['text'] ;
	$the_text = "The enormous broad tires of the chariots and the padded feet of the animals brought forth no sound from the moss-covered sea bottom; and so we moved in utter silence, like some huge phantasmagoria, except when the stillness was broken by the guttural growling of a goaded zitidar, or the squealing of fighting thoats.";

	$tagged_text = tag_the_content( $the_text );

	$posArrays = build_pos_arrays( $tagged_text );

	echo json_encode( $posArrays );

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

function build_pos_arrays( $result ){
	$noun_tags = Array ( "NN", "NNS", "NNP", "NNPS");
	$verb_tags = Array ( "VB", "VBD", "VBG", "VBN", "VBP", "VBZ");
	$adjective_tags = Array ( "JJ", "JJR", "JJS");
	$adverb_tags = Array ( "RB", "RBR", "RBS");

	$nouns_list = Array();
	foreach($result as $word){
	     if ( in_array( $word[1], $noun_tags )){
	     	$nouns_list[] = $word[0];
	     }
	}
	// echo "Nouns: ";
	// print_r($nouns_list);

	$verbs_list = Array();
	foreach($result as $word){
	     if ( in_array( $word[1], $verb_tags )){
	     	$verbs_list[] = $word[0];
	     }
	}
	// echo "Verbs: ";
	// print_r($verbs_list);

	$adjectives_list = Array();
	foreach($result as $word){
	     if ( in_array( $word[1], $adjective_tags )){
	     	$adjectives_list[] = $word[0];
	     }
	}
	// echo "adjectives: ";
	// print_r($adjectives_list);

	$adverbs_list = Array();
	foreach($result as $word){
	     if ( in_array( $word[1], $adverb_tags )){
	     	$adverbs_list[] = $word[0];
	     }
	}
	// echo "adverbs: ";
	// print_r($adverbs_list);

	return array( $nouns_list, $verbs_list, $adjectives_list, $adverbs_list );
}

