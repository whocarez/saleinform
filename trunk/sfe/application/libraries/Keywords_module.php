<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Keywords module
 * Mazvv 12-06-2007
*/
class Keywords_module 
{
	private $ciObject;
	private $objectsArr = array();
	//declare variables
	//the site contents
	private $contents;
	private $encoding;
	//the generated keywords
	private $keywords;
	//minimum word length for inclusion into the single word
	//metakeys
	private $wordLengthMin;
	private $wordOccuredMin;
	//minimum word length for inclusion into the 2 word
	//phrase metakeys
	private $word2WordPhraseLengthMin;
	private $phrase2WordLengthMinOccur;
	//minimum word length for inclusion into the 3 word
	//phrase metakeys
	private $word3WordPhraseLengthMin;
	//minimum phrase length for inclusion into the 2 word
	//phrase metakeys
	private $phrase2WordLengthMin;
	private $phrase3WordLengthMinOccur;
	//minimum phrase length for inclusion into the 3 word
	//phrase metakeys
	private $phrase3WordLengthMin;
	private $_current_keywords_controller;

	public function __construct()
	{
		$this->ciObject = &get_instance();
		$this->ciObject->lang->load('keywords_module');
		$this->_current_keywords_controller = $this->ciObject->uri->segment(1);
		$encoding = 'UTF-8';
		$params=array();
		$params['min_word_length'] = 5;  //minimum length of single words
		$params['min_word_occur'] = 1;  //minimum occur of single words

		$params['min_2words_length'] = 3;  //minimum length of words for 2 word phrases
		$params['min_2words_phrase_length'] = 10; //minimum length of 2 word phrases
		$params['min_2words_phrase_occur'] = 2; //minimum occur of 2 words phrase

		$params['min_3words_length'] = 3;  //minimum length of words for 3 word phrases
		$params['min_3words_phrase_length'] = 10; //minimum length of 3 word phrases
		$params['min_3words_phrase_occur'] = 2; //minimum occur of 3 words phrase
		
		//get parameters
		$this->encoding = $encoding;
		mb_internal_encoding($encoding);

		// single word
		$this->wordLengthMin = $params['min_word_length'];
		$this->wordOccuredMin = $params['min_word_occur'];
		// 2 word phrase
		$this->word2WordPhraseLengthMin = $params['min_2words_length'];
		$this->phrase2WordLengthMin = $params['min_2words_phrase_length'];
		$this->phrase2WordLengthMinOccur = $params['min_2words_phrase_occur'];

		// 3 word phrase
		$this->word3WordPhraseLengthMin = $params['min_3words_length'];
		$this->phrase3WordLengthMin = $params['min_3words_phrase_length'];
		$this->phrase3WordLengthMinOccur = $params['min_3words_phrase_occur'];

		//parse single, two words and three words

	}

	public function RenderKeywordsArea($content)
	{
		if(!$content) return '';
		$this->contents = $this->replace_chars($content);
		$keywords = $this->parse_words().$this->parse_2words().$this->parse_3words();
		return substr($keywords, 0, -1);
	}

	//turn the site contents into an array
	//then replace common html tags.
	public function replace_chars($content)
	{
		//convert all characters to lower case
		$content = mb_strtolower($content);
		#$content = strip_tags($content);
		$search = array('@<script[^>]*?>.*?</script>@si',   // Strip out javascript
        		       	'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
               			'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
               			'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
						);	
		$content = preg_replace($search, ' ', $content);							
		$punctuations = array(',', ')', '(', '.', "'", '"',
		'<', '>', ';', '!', '?', '/', '-',
		'_', '[', ']', ':', '+', '=', '#',
		'$', '&quot;', '&copy;', '&gt;', '&lt;',
		'&nbsp',
		chr(10), chr(13), chr(9));
		
		$content = str_replace($punctuations, " ", $content);
		// replace multiple gaps
		$content = preg_replace('/ {2,}/si', " ", $content);

		return $content;
	}

	//single words META KEYWORDS
	public function parse_words()
	{
		//list of commonly used words
		// this can be edited to suit your needs
		$common = array("able", "about", "above", "act", "add", "afraid", "after", "again", 
						"against", "age", "ago", "agree", "all", "almost", "alone", "along", "already", 
						"also", "although", "always", "am", "amount", "an", "and", "anger", "angry", 
						"animal", "another", "answer", "any", "appear", "apple", "are", "arrive", "arm", 
						"arms", "around", "arrive", "as", "ask", "at", "attempt", "aunt", "away", "back", 
						"bad", "bag", "bay", "be", "became", "because", "become", "been", "before", "began", 
						"begin", "behind", "being", "bell", "belong", "below", "beside", "best", "better", 
						"between", "beyond", "big", "body", "bone", "born", "borrow", "both", "bottom", "box",
						"boy", "break", "bring", "brought", "bug", "built", "busy", "but", "buy", "by", "call", 
						"came", "can", "cause", "choose", "close", "close", "consider", "come", "consider", 
						"considerable", "contain", "continue", "could", "cry", "cut", "dare", "dark", "deal", 
						"dear", "decide", "deep", "did", "die", "do", "does", "dog", "done", "doubt", "down", 
						"during", "each", "ear", "early", "eat", "effort", "either", "else", "end", "enjoy", 
						"enough", "enter", "even", "ever", "every", "except", "expect", "explain", "fail", 
						"fall", "far", "fat", "favor", "fear", "feel", "feet", "fell", "felt", "few", 
						"fill", "find", "fit", "fly", "follow", "for", "forever", "forget", "from", "front", 
						"gave", "get", "gives", "goes", "gone", "good", "got", "gray", "great", "green", 
						"grew", "grow", "guess", "had", "half", "hang", "happen", "has", "hat", "have", 
						"he", "hear", "heard", "held", "hello", "help", "her", "here", "hers", "high", "hill", 
						"him", "his", "hit", "hold", "hot", "how", "however", "I", "if", "ill", "in", 
						"indeed", "instead", "into", "iron", "is", "it", "its", "just", "keep", "kept", 
						"knew", "know", "known", "late", "least", "led", "left", "lend", "less", "let", 
						"like", "likely", "likr", "lone", "long", "look", "lot", "make", "many", "may", "me", 
						"mean", "met", "might", "mile", "mine", "moon", "more", "most", "move", "much", "must",
						"my", "near", "nearly", "necessary", "neither", "never", "next", "no", "none", "nor", 
						"not", "note", "nothing", "now", "number", "of", "off", "often", "oh", "on", "once", 
						"only", "or", "other", "ought", "our", "out", "please", "prepare", "probable", "pull", 
						"pure", "push", "put", "raise", "ran", "rather", "reach", "realize", "reply", 
						"require", "rest", "run", "said", "same", "sat", "saw", "say", "see", "seem", 
						"seen", "self", "sell", "sent", "separate", "set", "shall", "she", "should", 
						"side", "sign", "since", "so", "sold", "some", "soon", "sorry", "stay", "step", 
						"stick", "still", "stood", "such", "sudden", "suppose", "take", "taken", "talk", 
						"tall", "tell", "ten", "than", "thank", "that", "the", "their", "them", "then", 
						"there", "therefore", "these", "they", "this", "those", "though", "through", 
						"till", "to", "today", "told", "tomorrow", "too", "took", "tore", "tought", 
						"toward", "tried", "tries", "trust", "try", "turn", "two", "under", "until", 
						"up", "upon", "us", "use", "usual", "various", "verb", "very", "visit", "want", 
						"was", "we", "well", "went", "were", "what", "when", "where", "whether", "which", 
						"while", "white", "who", "whom", "whose", "why", "will", "with", "within", 
						"without", "would", "yes", "yet", "you", "young", "your", "br", "img", "p",
						"lt", "gt", "quot", "copy",
						"для", "и", "по", "до");
		//create an array out of the site contents
		$s = split(" ", $this->contents);
		//initialize array
		$k = array();
		//iterate inside the array
		foreach( $s as $key=>$val ) {
			//delete single or two letter words and
			//Add it to the list if the word is not
			//contained in the common words list.
			if(mb_strlen(trim($val)) >= $this->wordLengthMin  && !in_array(trim($val), $common)  && !is_numeric(trim($val))) 
			{
				$k[] = trim($val);
			}
		}
		//count the words
		$k = array_count_values($k);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($k, $this->wordOccuredMin);
		arsort($occur_filtered);

		$imploded = $this->implode(",", $occur_filtered);
		//release unused variables
		unset($k);
		unset($s);

		return $imploded;
	}

	public function parse_2words()
	{
		//create an array out of the site contents
		$x = split(" ", $this->contents);
		//initilize array

		//$y = array();
		for ($i=0; $i < count($x)-1; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($x[$i])) >= $this->word2WordPhraseLengthMin ) && (mb_strlen(trim($x[$i+1])) >= $this->word2WordPhraseLengthMin) )
			{
				$y[] = trim($x[$i])." ".trim($x[$i+1]);
			}
		}

		//count the 2 word phrases
		$y = array_count_values($y);

		$occur_filtered = $this->occure_filter($y, $this->phrase2WordLengthMinOccur);
		//sort the words from highest count to the lowest.
		arsort($occur_filtered);

		$imploded = $this->implode(",", $occur_filtered);
		//release unused variables
		unset($y);
		unset($x);

		return $imploded;
	}

	public function parse_3words()
	{
		//create an array out of the site contents
		$a = split(" ", $this->contents);
		//initilize array
		$b = array();

		for ($i=0; $i < count($a)-2; $i++) {
			//delete phrases lesser than 5 characters
			if( (mb_strlen(trim($a[$i])) >= $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i+1])) > $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i+2])) > $this->word3WordPhraseLengthMin) && (mb_strlen(trim($a[$i]).trim($a[$i+1]).trim($a[$i+2])) > $this->phrase3WordLengthMin) )
			{
				$b[] = trim($a[$i])." ".trim($a[$i+1])." ".trim($a[$i+2]);
			}
		}

		//count the 3 word phrases
		$b = array_count_values($b);
		//sort the words from
		//highest count to the
		//lowest.
		$occur_filtered = $this->occure_filter($b, $this->phrase3WordLengthMinOccur);
		arsort($occur_filtered);

		$imploded = $this->implode(",", $occur_filtered);
		//release unused variables
		unset($a);
		unset($b);

		return $imploded;
	}

	public function occure_filter($array_count_values, $min_occur)
	{
		$occur_filtered = array();
		foreach ($array_count_values as $word => $occured) {
			if ($occured >= $min_occur) {
				$occur_filtered[$word] = $occured;
			}
		}

		return $occur_filtered;
	}

	public function implode($gule, $array)
	{
		$c = "";
		foreach($array as $key=>$val) {
			@$c .= $key.$gule;
		}
		return $c;
	}
	
	public function RenderMetatitleArea()
	{
		if($this->_current_keywords_controller=='categories')
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CATEGORIES_TITLE');
		}
		else if($this->_current_keywords_controller=='brands')
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_BRANDS_TITLE');
		}
		else if($this->_current_keywords_controller=='clients') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CLIENTS_TITLE');
		}
		else if($this->_current_keywords_controller=='cluops')
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CLUOPS_TITLE');
		}
		else if($this->_current_keywords_controller=='contacts') 
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CONTACTS_TITLE');
		}
		else if($this->_current_keywords_controller=='guides') 
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_GUIDES_TITLE');
		}
		else if($this->_current_keywords_controller=='news') 
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_NEWS_TITLE');
		}
		else if($this->_current_keywords_controller=='settings') 
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_SETTINGS_TITLE');
		}
		else if($this->_current_keywords_controller=='ware') 
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_WARE_TITLE');
		}
		else if($this->_current_keywords_controller=='wareuops') 
		{ 
			return $this->ciObject->lang->line('KEYWORDS_MODULE_WAREUOPS_TITLE');
		}
		else return $this->ciObject->lang->line('KEYWORDS_MODULE_WELCOME_TITLE');
	}

	public function RenderMetadescriptionArea()
	{
		if($this->_current_keywords_controller=='categories')
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CATEGORIES_DESCR');
		}
		else if($this->_current_keywords_controller=='brands') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_BRANDS_DESCR');
		}
		else if($this->_current_keywords_controller=='clients') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CLIENTS_DESCR');
		}
		else if($this->_current_keywords_controller=='cluops') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CLUOPS_DESCR');
		}
		else if($this->_current_keywords_controller=='contacts') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_CONTACTS_DESCR');
		}
		else if($this->_current_keywords_controller=='guides') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_GUIDES_DESCR');
		}
		else if($this->_current_keywords_controller=='news') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_NEWS_DESCR');
		}
		else if($this->_current_keywords_controller=='settings') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_SETTINGS_DESCR');
		}
		else if($this->_current_keywords_controller=='ware') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_WARE_DESCR');
		}
		else if($this->_current_keywords_controller=='wareuops') 
		{
			return $this->ciObject->lang->line('KEYWORDS_MODULE_WAREUOPS_DESCR');
		}
		else return $this->ciObject->lang->line('KEYWORDS_MODULE_WELCOME_DESCR');
	}
	
}
?>