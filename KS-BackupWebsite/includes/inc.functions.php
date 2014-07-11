<?php
/****************************************
* Author - Dev Team
* Company - Internet Concepts Limited
* Revision - 1.0 
*****************************************/

function getDir($current_dir)
{
	$final_dir = '';
	if (stristr(PHP_OS, 'WIND')) 
	{ 
		$separator = '\\';
		$broken_dir = explode($separator,$current_dir);  
	} 
	else  
	{ 
		$separator = '/';
		$broken_dir = explode($separator,$current_dir);
	}	
	$dir_no = count($broken_dir);
	$i = ($dir_no - 2);
	for($j=0;$j<$i;$j++)
	{
		$final_dir .= $broken_dir[$j].$separator; 
	}
	return $final_dir;
}


function hex2bin($str) {
    $bin = "";
    $i = 0;
    do {
        $bin .= chr(hexdec($str{$i}.$str{($i + 1)}));
        $i += 2;
    } while ($i < strlen($str));
    return $bin;
}

//check if a particular class exists
//or is availible to the system at a particular runtime 
function class_exists_sensitive( $classname )
{
   return ( class_exists( $classname ) && in_array( $classname, get_declared_classes() ) );
}
 
 
function createWhere($getPostArgs,$exclude='')
{
	$where = '1=1'; 
	$i=1; 
	foreach($getPostArgs as $key=>$val)
	{
		if($key=='submit') continue;
		if($key=='max_occupancy') continue;
		if(array_key_exists($key,$exclude)) continue;
		if($val!='')
		{
		$where .= ' AND '.$key.' = "'.$val.'"';	
		}
		$i++;
	}
	return $where;
}

function escape($var)
{
	return mysql_real_escape_string($var);
}


//$last contains the number of total variables passed
function createInsert($getPostArgs)
{
	unset($getPostArgs['submit']);
	unset($getPostArgs['remLen1']);

	
	$arraylength = count($getPostArgs);
	$i=1;
	
	//unset($getPostArgs['submit']);
	foreach($getPostArgs as $key=>$val)
	{		
		if($i == $arraylength)
		{			
			$insert .= $key. ")";
			if($val==NULL)$values .= " ".$val. ")";
			else $values .= "'" . $val . "')";

			break;
		}
		elseif ($i == 1)
		{   $i++;
			$insert .= "(" . $key.  ",";
			if($val==NULL) $values .= "(" . $val . ",";
			else $values .= "('" . $val . "',";
		}
		else
		{   $i++;
			$insert .= $key . ",";
			if($val==NULL) $values .= $val.",";
			$values .= "'" . $val . "',";
		}
			
	}

	$insert = $insert ." VALUES " .$values;
	
	return $insert;
}

function createDelete($getPostArgs,$last)
{
	unset($getPostArgs['submit']);
	foreach($getPostArgs as $key=>$val)
	{
		if($key=='submit') continue;
		if($key=='id') continue;
		if($key=='property_id') continue;
		if($key == $last)
		{
			$update .= $key." = '".$val."'";
			break;
		}
		else
		{
			$update .= $key." = '".$val."',";
		}
	}
	return $update;
}

//convert hexadecimal to ascii
function hex2ascii($hex){
	if (preg_match("/\b%\b/i", $hex))
	{
		$asc='';
		$hexArr = explode("%", $hex);

		for ($i=1; $i<count($hexArr); $i++)
			{
				$str = $hexArr[$i];
				$asc .= chr(hexdec($str));	
			}
	$errmsg = "Illegal Input detected. CANNOT complete the request.";
	require_once(COMMON_ROOT."/admin/templates/successError/success.php");
	exit(0);	
	//return($asc);
	
	}
	else
	{
	return $hex;
	}
	
}


function createUpdate($getPostArgs,$last)
{
	unset($getPostArgs['submit']);
	foreach($getPostArgs as $key=>$val)
	{
		if($key=='submit') continue;
		if($key=='id') continue;
		if($key=='property_id') continue;
		if($key == $last)
		{
			if($val=='NULL') $update.= $key."=".$val;
			else	$update .= $key." = '".$val."'";
			break;
		}
		else
		{
			if($val=='NULL') $update .= $key." = ".$val.",";
			else $update .= $key." = '".$val."',";
		}
	}
	return $update;
}

function dateDiff($dformat, $endDate, $beginDate)
{
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
	$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
	return $end_date - $start_date;
}


function getSeparator()
{
	if (stristr(PHP_OS, 'WIND')) 
	{ 
		$separator = '\\';		
	} 
	else 
	{
		$separator = '/';
	}	
	return $separator;
}

function getTLDDomain($url)
{
	$tld2 = array('wattle.id.au','emu.id.au','csiro.au','name.tr','conf.au','info.tr','info.au','gov.au','k12.tr','lel.br','ltd.uk','mat.br','jor.br','med.br','net.hk','net.eg','net.cn','net.br','net.au','mus.br','mil.tr','mil.br','net.lu','inf.br','fnd.br','fot.br','fst.br','g12.br','gb.com','gb.net','gen.tr','ggf.br','gob.mx','gov.br','gov.cn','gov.hk','gov.tr','idv.tw','imb.br','ind.br','far.br','net.mx','se.com','rec.br','qsl.br','psi.br','psc.br','pro.br','ppg.br','pol.tr','se.net','slg.br','vet.br','uk.net','uk.com','tur.br','trd.br','tmp.br','tel.tr','srv.br','plc.uk','org.uk','ntr.br','not.br','nom.br','no.com','net.uk','net.tw','net.tr','net.ru','odo.br','oop.br','org.tw','org.tr','org.ru','org.lu','org.hk','org.cn','org.br','org.au','web.tr','eun.eg','zlg.br','cng.br','com.eg','bio.br','agr.br','biz.tr','cnt.br','art.br','com.hk','adv.br','cim.br','com.mx','arq.br','com.ru','com.tr','bmd.br','com.tw','adm.br','ecn.br','edu.br','etc.br','eng.br','esp.br','com.au','com.br','ato.br','com.cn','eti.br','edu.au','bel.tr','edu.tr','asn.au','jl.cn','mo.cn','sh.cn','nm.cn','js.cn','jx.cn','am.br','sc.cn','sn.cn','me.uk','co.jp','ne.jp','sx.cn','ln.cn','co.uk','co.at','sd.cn','tj.cn','cq.cn','qh.cn','gs.cn','gr.jp','dr.tr','ac.jp','hb.cn','ac.cn','gd.cn','pp.ru','xj.cn','xz.cn','yn.cn','av.tr','fm.br','fj.cn','zj.cn','gx.cn','gz.cn','ha.cn','ah.cn','nx.cn','tv.br','tw.cn','bj.cn','id.au','or.at','hn.cn','ad.jp','hl.cn','hk.cn','ac.uk','hi.cn','he.cn','or.jp','name','info','aero','edu','org','int','biz','mil','net','com','ua','st','tw','sg','uk','au','za','yu','ws','at','us','vg','as','va','tv','pt','si','sk','ag','sm','ca','su','al','am','tc','th','tm','ro','tn','to','ru','se','sh','eu','dk','ie','il','de','cz','cy','cx','is','it','jp','ke','kr','la','hu','hm','hk','fi','fj','fo','fr','es','gb','eg','ge','ee','gl','ac','gr','gs','li','lk','cd','nl','no','cc','by','br','nu','nz','bg','be','ba','az','pk','ch','ck','cl','lt','lu','lv','ma','mc','md','mk','mn','ms','mt','mx','dz','cn','pl');
	$url_parts = parse_url($url);
	$getDomain = $url_parts['host'];
	$counter = 1;
	do 
	{
		$tmp_tld = substr($getDomain, -strlen(".".$tld2[$counter]));
		if ($tmp_tld == ".".$tld2[$counter]) 
		{
			$tld = ltrim($tld2[$counter], ".");
			$getDomainLeft = substr($getDomain, 0, -(strlen($tld) + 1));
			if (strpos($getDomainLeft, ".") === false) 
			{
				$subgetDomain = "";
				$finalgetDomain = $getDomainLeft;
			} 
			else 
			{
				$getDomain_parts = explode(".", $getDomainLeft);
				$finalgetDomain = array_pop($getDomain_parts);
			}
			return $finalgetDomain;	
		}
		$counter++;
	} 
	while ($counter < count($tld2));
}


function getdomain($url) 
{
	$url = strtolower($url);
	$slds = 
    '\.co\.uk|\.me\.uk|\.net\.uk|\.org\.uk|\.sch\.uk|
    \.ac\.uk|\.gov\.uk|\.nhs\.uk|\.police\.uk|
    \.mod\.uk|\.asn\.au|\.com\.au|\.net\.au|\.id\.au|
    \.org\.au|\.edu\.au|\.gov\.au|\.csiro\.au';
    preg_match (
        "/^(http:\/\/|https:\/\/|)[a-zA-Z-]([^\/]+)/i",
        $url, $matches
    );
    $host = $matches[2];
    if (preg_match("/$slds$/", $host, $matches)) 
	{
        preg_match (
            "/[^\.\/]+\.[^\.\/]+\.[^\.\/]+$/", 
            $host, $matches
        );
    } 
    else 
	{
        preg_match (
            "/[^\.\/]+\.[^\.\/]+$/", 
            $host, $matches
        );
    }
    return "{$matches[0]}";
}  

function toFixed($number, $round=2)
{
   
    $tempd = $number*pow(10,$round);
    $tempd1 = round($tempd);
    $number = $tempd1/pow(10,$round);
    return $number;
    
} 

function count_days( $a, $b )
{
	// First we need to break these dates into their constituent parts:
	$gd_a = getdate( $a );
	$gd_b = getdate( $b );
	// Now recreate these timestamps, based upon noon on each day
	// The specific time doesn't matter but it must be the same each day
	$a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
	$b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
	// Subtract these two numbers and divide by the number of seconds in a
	// day. Round the result since crossing over a daylight savings time
	// barrier will cause this time to be off by an hour or two.
	return round( abs( $a_new - $b_new ) / 86400 );
}

	function includeClasses()
	{
		$dir = COMMON_ROOT."/classes/";
		// Open a known directory, and proceed to read its contents
		if(is_dir($dir)) 
		{
			if($dh = opendir($dir)) 
			{
				while(($file = readdir($dh)) !== false) 
				{
					//excluding the Database class form the list			
					if ($file=="DataBase.class.php" || $file==".." || $file==".")
					continue;
					//echo COMMON_ROOT."/classes/".$file.'<br />';
					include(COMMON_ROOT."/classes/".$file);
				}
				closedir($dh);
			}
		}	
	}