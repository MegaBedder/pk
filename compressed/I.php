<?php class I{static function __callStatic($a,$b){$c=array('session'=>'_SESSION','post'=>'_POST','get'=>'_GET','server'=>'_SERVER','files'=>'_FILES','cookie'=>'_COOKIE','env'=>'_ENV','request'=>'_REQUEST');$a=$c[$a];if(isset($d[$a][$b[0]])){return$d[$a][$b[0]];}returnisset($b[1])?$b[1]:NULL;}}