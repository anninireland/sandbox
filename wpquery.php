<html>
<head>
	<title>GG</title>
	<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jsFunctions.js"></script>

	<?php 
	$game = "nouns";
	$the_text = "The enormous broad tires of the chariots and the padded feet of the animals brought forth no sound from the moss-covered sea bottom; and so we moved in utter silence, like some huge phantasmagoria, except when the stillness was broken by the guttural growling of a goaded zitidar, or the squealing of fighting thoats.";
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

					<!--
					<form action="taggerWchecker.php" method="get">
						<input class="helpButton" type="button" value="Help!" /> 
						<input type="hidden" name="text" value="<?php $the_text ?>">
						<input class="doneButton" type="submit" name="done" value="I'm Done" />
					</form>
				-->

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
					<form action="taggerWchecker.php" method="get" >
						<input class="closehelpButton" type="button" value="close" />
						<input class="doneButton" type="submit" name="done" value="I'm Done" />
					</form>
				</div>  <!-- .help-view -->

				<div id="results-view" class="side-view">
					<?php // if success, show "Well Done!", else show "Almost!" ?>
					<h1>Results! </h1>
					<h2>You selected these words: </h2>
					<ul class="selected-words"></ul>
					<?php // if success, show Star, else show tryagain button ?>
					<input class="tryagainButton" type="button" value="Try Again" />
					<a href="<?php echo $link ?>"><input class="quitButton" type="button" value="Quit" /></a>
				</div>  <!-- .results-view -->


				<div id="article-view">
					<h2>Princess Mars</h2>	
					<div class="news-content">
						<p><?php $the_text ?></p>
						<p class="news-content">The enormous broad tires of the chariots and the padded feet of the animals brought forth no sound from the moss-covered sea bottom; and so we moved in utter silence, like some huge phantasmagoria, except when the stillness was broken by the guttural growling of a goaded zitidar, or the squealing of fighting thoats.</p>
					</div>
				</div>  <!-- .article-view -->





			</div> <!-- .ggmain -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php 	
/*
if(isset($_POST['submit'])){
	$name_entered = $_POST['name'];
	gg_save_record(); 	
}

require_once(ABSPATH . 'wp-settings.php');

	// function for saving to db -- somehow is ruuning on pageload and when form submitted. 
function gg_save_record(){
	
	global $wpdb;
	global $origin_id;
	global $game;
	global $name_entered;
	$wpdb->insert($wpdb->prefix . 'gg_practice_results', 
		array("gg_post" => $origin_id, "type" => $game, "name" => "test"),
		array("%d", "%s", "%s"));
	///echo "Saved!";
}
*/
?>

