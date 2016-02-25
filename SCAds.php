<?php
 // no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin'); 

class plgContentSCAds extends JPlugin
{

	public function __construct(&$subject, $config){
		parent::__construct($subject, $config);
	}
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    protected $autoloadLanguage = true ;	
	function onContentPrepare($context, $article, $params, $limitstart)
     {   
                   
$words= (explode(" ",($article->text)));
$counter= $this->params->get('wcount');


$string1 = '';
$string2 = '';

$mycount =count($words);
$a=false;

if($mycount>= $counter)
 {

	for ($i=0; $i<=$counter ; $i++)
	{
	$string1 .= $words[$i].' ';
	}

//echo $string1; 

	for ($counter++;$counter <$mycount ;$counter++)
	{
		
		//if($words[$counter] != '</p>')
		if ((preg_match('@</p>@',$words[$counter],  $match)) and ($a==false))
		{
		   $string2 .=$words[$counter].' {loadposition sc_position} ';
		   $a=true;
	    }
	    else 
	    {
			$string2 .=$words[$counter].' ';
		}
	}

  $total = $string1.$string2;

  $article->text=  $total;


 }
//==========================================================================================================
else 
 {
	$p=0;
	$count=0;
	
//-------------------------------------------------------------- tedade p ha
	for ($i=0; $i<$mycount ; $i++)
	{
		if (preg_match_all('@</p>@',$words[$i],  $match))
		{
		   $count++;
		   
	    }
	}
//--------------------------------------------------------------
   for ($i=0; $i<$mycount ; $i++)
	{
	if (preg_match('@</p>@',$words[$i],  $match))
		{
            $p++;
			if ($p == $count)
			{
		       $string1 .=$words[$i].' {loadposition sc_position} ';
		       $i++;
		    }
			
	    }
	    if ($i == $mycount) {break;}
	$string1 .=$words[$i].' ';
	    
	}
     
$article->text=  $string1;
 }


}
	
}
