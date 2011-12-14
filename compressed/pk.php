<?php
class DB{$i='`',$p;static $q;function DB($c){$this->c=$c;}function column($q,$p=NULL,$k=0){if($s=$this->query($q,$p))return$s->fetchColumn($k);}function row($q,$p=NULL){if($s=$this->query($q,$p))return$s->fetch();}function fetch($q,$p=NULL){if($s=$this->query($q,$p))return$s->fetchAll();}function query($q,$p=NULL){$s=$this->c->prepare(self::$q[]=strtr($q,'`',$this->i));$s->execute($p);return$s;}function insert($t,$d){$x=$this;$q="INSERT INTO `$t`(`".implode('`,`',array_keys($d)).'`)VALUES('.rtrim(str_repeat('?,',count($d=array_values($d))),',').')';return$x->p?$x->column($q.'RETURNING `id`',$d):($x->query($q,$d)?$x->c->lastInsertId():NULL);}function update($t,$d,$w){$q="UPDATE `$t` SET `".implode('`=?,`',array_keys($d)).'`=? WHERE '.(is_array($w)?$this->where($w,$d):$w);if($s=$this->query($q,array_values($d)))return$s->rowCount();}function delete($t,$w){$p;if($s=$this->query("DELETE FROM `$t` WHERE ".(is_array($w)?$this->where($w,$p):$w),$p))return$s->rowCount();}function where($w,&$p){$s;foreach($w as$c=>$v){$s[]="`$c`=?";$p[]=$v;}return join(' AND ',$s);}}
class _{static function convert($s,$e=0,$c=1){if(function_exists('mb_detect_encoding'))$e=mb_detect_encoding($s,'auto');if(($s=@iconv(!$e?'UTF-8':$e,'UTF-8//IGNORE',$s))!==false){return$c?preg_replace('~\p{C}+~u','',$s):preg_replace(array('~\r\n?~','~[^\P{C}\t\n]+~u'),array("\n",''),$s);}}static function date($l=0,$d=IntlDateFormatter::MEDIUM,$t=IntlDateFormatter::SHORT,$z=NULL){returnnew IntlDateFormatter($l?:setlocale(LC_ALL,0),$d,$t,$z);}static function format($s,array$p=NULL){return msgfmt_format_message(setlocale(LC_ALL,0),$s,$p);}static function normalize($s,$f=Normalizer::FORM_D){return normalizer_normalize($s,$f);}static function unaccent($s){if(strpos($s=htmlentities($s,ENT_QUOTES,'UTF-8'),'&')!==false)$s=html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|tilde|uml);~i','$1',$s),ENT_QUOTES,'UTF-8');return$s;}static function slug($s,$c='-',$e=null){return strtolower(trim(preg_replace('~[^0-9a-z'.preg_quote($e,'~').']+~i',$c,self::unaccent($s)),$c));}}
class I{static function __callStatic($method,$args){$types=array('session'=>'_SESSION','post'=>'_POST','get'=>'_GET','server'=>'_SERVER','files'=>'_FILES','cookie'=>'_COOKIE','env'=>'_ENV','request'=>'_REQUEST');$method=$types[$method];if(isset($GLOBALS[$method][$args[0]])){return$GLOBALS[$method][$args[0]];}returnisset($args[1])?$args[1]:NULL;}}
class View{$__v;function __construct($file,$path=__DIR__){$this->__v="$path/view/$file.php";}function __call($key,$args){$this->$key=$args[0];return$this;}function set($array){foreach($array as$k=>$v)$this->$k=$v;return$this;}function __toString(){try{ob_start();extract((array)$this);require$__v;return ob_get_clean();}catch(\Exception$e){return''.$e;}}}function view($file){returnnew View($file);}
class ParsePHP{$parser_tokens;function __construct($tokens){if(!is_array($tokens)){$tokens=token_get_all($tokens);}$this->tokens=$tokens;for($i=100;$i<500;$i++){if(($name=@token_name($i))=='UNKNOWN')continue;$this->parser_tokens[$i]=$name;}}function minimize(){$remove=array_flip(array(T_END_HEREDOC,T_PRIVATE,T_PUBLIC,T_PROTECTED,T_WHITESPACE,T_COMMENT,T_DOC_COMMENT,T_BAD_CHARACTER,));$replace=array(T_PRINT=>'echo',T_LOGICAL_AND=>'&&',T_LOGICAL_OR=>'||',T_BOOL_CAST=>'(bool)',T_INT_CAST=>'(int)',);$add_space_before=array_flip(array(T_AS,));$add_space_after=array_flip(array(T_CLASS,T_CLONE,T_CONST,T_FINAL,T_FUNCTION,T_INSTANCEOF,T_NAMESPACE,T_NEW,T_STATIC,T_THROW,T_USE));$add_space=array_flip(array(T_EXTENDS,T_IMPLEMENTS,T_INTERFACE));$tokens=$this->tokens;foreach($tokens as$id=>$token){if(!is_array($token))continue;list($code,$string,$line)=$token;if(isset($replace[$code])){$tokens[$id]=array($code,$replace[$code],$line);continue;}if(isset($remove[$code])){unset($tokens[$id]);continue;}if(isset($add_space[$code])){$tokens[$id]=array($code,' '.$string.' ',$line);}if(isset($add_space_before[$code])){$tokens[$id]=array($code,' '.$string,$line);}if(isset($add_space_after[$code])){$tokens[$id]=array($code,$string.' ',$line);}if($code==T_RETURN){if(isset($tokens[$id+2][0])){$next=$tokens[$id+2];if($next[0]==T_STRING){$tokens[$id]=array($code,$string.' ',$line);}}}}return$this->tokens=$tokens;}function __toString(){$output='';foreach($this->tokens as$id=>$token){if(!is_array($token)){$output.=$token;continue;}$output.=$token[1];}return$output;}}
class Validation{$s=array();function __set($k,$c){$this->s[$k]=$c;}function __get($k){return$this->s[$k]($this);}function validate($d){$a;foreach($this->s as$k=>$f){if($e=$f(isset($d[$k])?$d[$k]:NULL,$k)){$a[$k]=$e;}}return$a;}}