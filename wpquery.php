<html>
<head>
	<title>GG</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jsFunctions.js"></script>

	<?php 
	$game = "nouns";
	$the_text = "Nutraloaf, an awful tasting, rancid looking prison 'meal', has been banned in New York.

Nutraloaf made its debut as a punishment in the American prison system in the 1970s. Prisoners who threw food, utensils or even bodily fluids at guards and other inmates would see their regular prison fare replaced with the unsavoury loaf, which some find so disgusting it’s incentive enough to behave.


“Food is very important to prisoners in a deprived and harsh environment; it is one of the very few things they have to look forward to,” explains David Fathi, director of the American Civil Liberties Union National Prison Project.

The ingredients vary from state to state. Pennsylvania prison chefs invented a chickpea version, while Illinois included ground beef and applesauce in its court-contested recipe.

The version in New York State prisons uses an assortment of baking staples and hard-to-overcook vegetables, including shredded carrots and unskinned potatoes.

But there’s good news for prisoners in those New York prisons — they will no longer have to choke down this awful meal. On Wednesday, it was announced nutraloaf was being removed from the menu.

Ongoing lawsuits regarding nutraloaf are taking place in several other states, including Illinois, Maryland, Nebraska, Pennsylvania and Washington."
     ;
	 ?>

</head>
<body>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="ggmain">			
				<h1>Grammar Guru</h1>
				<div id="challenge-view" class="side-view">								
					<h2>Your challenge: Find <span class="findThis">three <?php echo $game; ?></span> in this article.</h2>
					<h3>Click on a word to select it;</h3>
					<h3>To remove it, click again</h3>

					<input class="doneButton" type="button" name="done" value="I'm Done" />

				</div>  <!-- .challenge-view -->
				
				<div id="help-view" class="side-view">
					<?php 
					switch ($game) {
						case "nouns": ?>
								<h3><span class="mark">Nouns</span> are words that name an object or person</h3>
								<br>
								<p>The broad <span class="mark">river</span> is flowing swiftly.</p>
							<?php ;
							break;

						case "verbs": ?>
								<h3><span class="mark">Verbs</span> are words that tell the state or action of the subject.</h3>
								<br>
								<p>The broad river is <span class="mark">flowing</span> swiftly.</p>
							<?php ;
							break;

						case "adjectives": ?>
								<h3><span class="mark">Adjectives</span> are words used to describe and give more information about a noun, which could be a person, place or object.</h3>
								<br>
								<p>The <span class="mark">large</span> box is on the shelf.</p>
								<p>She held the <span class="mark">shiny</span> penny.</p>
								<p>The sun shone <span class="mark">bright</span> in the <span class="mark">blue</span> sky.</p>
								<p>I have <span class="mark">five</span> books.</p>
								<p>The <span class="mark">broad</span> river is flowing swiftly.</p>
								<?php ;
							break;

						case "adverbs": ?>
								<h3><span class="mark">Adverbs</span> are words that describe or give more information about a verb.</h3>
								<br>
								<p>The broad river is flowing <span class="mark">swiftly</span>.</p>
							<?php ;
							break;
					}
					?>
						<input class="closehelpButton" type="button" value="close" />
						<input class="doneButton" type="submit" name="done" value="I'm Done" />
				</div>  <!-- .help-view -->

				<div id="almost-view" class="side-view">
					<h1>Nice effort!</h1>
					<h2><span id="numCorrect"></span> correct out of 3</h2>
					<ul class="matched-words"></ul>
					<ul class="unmatched-words"></ul>
					<p>You need all 3 words correct to earn a star</p>
					<p>Would you like to try again?</p>
					<input class="tryagainButton" type="button" value="Try Again" />
					<a href="<?php echo $link ?>"><input class="quitButton" type="button" value="Quit" /></a>
				</div>  <!-- .almost-view -->



				<div id="success-view" class="side-view">
					<h1>Well Done! </h1>
					<h2>All of your words are <?php $game ?></h2>
					<ul class="matched-words"></ul>
					<p>You have earned a STAR! </p>
					<a href="<?php echo $link ?>"><input class="quitButton" type="button" value="Quit" /></a>
				</div>  <!-- .success-view -->



				<div id="article-view">
					<h2>Title</h2>	
					<div class="news-content">
						<p class="news-content"><?php echo $the_text ?></p>

					</div>
				</div>  <!-- .article-view -->


<?php 

// process_the_content( $the_text );


// function process_the_content( $the_text ){



$sentenceArray = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $the_text);

/*
foreach ($sentenceArray as $sentence){
	$result = explode(' ', $sentence );
	print_r($result);
	echo "\n";
}
*/
	// for each sentence,
	foreach ($sentenceArray as $sentence){
		//print_r($sentence);

		//echo "  exploded ===>  ";
		$exploded = explode(' ', $sentence);
		//print_r( $exploded);
		//echo "            next.................. ";

		$this_result = tag_the_content( $sentence ); // run the tagger
		//print_r( $this_result);
		//echo ".              JSON                 . ";
		//echo json_encode( $this_result);

		set_time_limit(40);

		$taggedSpans = "";

		// create spans with tag as class
		foreach ($this_result as $element) {
			set_time_limit(40);
			$text = $element[0];
			$tag = $element[1];
			// if text is punctuation, do not add space 
			$punct = array(".", ",", ";", ":", "!", "?", "(", ")", "[", "]", "{", "}", "'", "`", "\"");
			if (in_array ( $text , $punct)){
				$span = ("<span class=" . $tag . ">" . $text . "</span>");
			}
			else{
				$span = ("<span class=" . $tag . "> " . $text . "</span>");
			}
			$taggedSpans .= $span; 
		}
		echo $taggedSpans;
	}

//	}


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

?>


			</div> <!-- .ggmain -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->


