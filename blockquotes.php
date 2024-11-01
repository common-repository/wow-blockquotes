<?php
/*
Plugin Name: WoW BlueQuotes
Plugin URI: http://zeaks.org/index.php/plugins
Description: Warcraft Custom Blockquotes.
Version: 1.2
Date: May 24, 2010
Author: Zeaks
Co-Author: Bless
Author URI: http://www.zeaks.org
Co-Author URI: http://www.hordereview.com
Original Author: http://wonkosworld.co.uk
*/ 


$tlurl = get_bloginfo('url')."/wp-content/plugins/wow-blockquotes/tl.gif";
$trurl = get_bloginfo('url')."/wp-content/plugins/wow-blockquotes/tr.gif";
$blurl = get_bloginfo('url')."/wp-content/plugins/wow-blockquotes/bl.gif";
$brurl = get_bloginfo('url')."/wp-content/plugins/wow-blockquotes/br.gif";

/* Change the 1 to 0 below to leave <blockquote>...</blockquote> tags intact */
$replacebq = 0;

$bqpre_replacement = '<div style="color: #089ade; margin: auto; width: 90%; padding: 0; background: url('.$trurl.') no-repeat right top;"><div style="margin: 0; padding: 0; background: url('.$tlurl.') no-repeat left top; position: relative; right: 10px;"><div style="margin: 0px; padding: 0; background: url('.$brurl.') no-repeat right bottom; position: relative; top: 13px; left: 10px;"><div style="margin: 0; padding: 0; background: url('.$blurl.') no-repeat left bottom; position: relative; right: 10px;"><div style="margin: 0; padding: 5px 10px;">';
$bqpost_replacement = '</div></div></div></div></div><div class="clear">&nbsp;</div>';

function bqsimpleTags($bqtext) {
    
    global $bqpre_replacement;
    global $bqpost_replacement;
    global $replacebq;
	
	if($replacebq==1)
	{
		$bqtext = str_replace('<blockquote>', '[bluepost]<p>', $bqtext);
		$bqtext = str_replace('</blockquote>', '</p>[/bluepost]', $bqtext);
	}
	
	/* Divs inside paragraphs are naughty so they need swapping round */
	$bqtext = str_replace('<p>[bluepost]', '[bluepost]<p>', $bqtext);
	$bqtext = str_replace('[/bluepost]</p>', '</p>[/bluepost]', $bqtext);
	
	$bqtext = str_replace('[bluepost]', $bqpre_replacement, $bqtext);
	$bqtext = str_replace('[/bluepost]', $bqpost_replacement, $bqtext);
    
    return $bqtext;
}

add_filter('the_content', 'bqsimpleTags');
add_filter('comment_text', 'bqsimpleTags');

?>