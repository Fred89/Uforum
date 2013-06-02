<?php
# ------------------ BEGIN LICENSE BLOCK ------------------
#
# This file is part of µForum project: http://uforum.byethost5.com
#
# @update     03-06-2013
# @copyright  2011-2013  Frédéric Kaplon and contributors
# @copyright   ~   2008  Okkin  Avetenebrae
# @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE (LGPL) version 3
# @link       http://uforum.byethost5.com   µForum
# @version    Release: @package_version@
#
# ------------------- END LICENSE BLOCK -------------------
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
/**
*
* Déclaration des répertoires
*/
define('U_DATA', 'data/');
define('U_THREAD', U_DATA.'messages/');
define('U_MEMBER', U_DATA.'membres/');
/**
*
* Fixe les date en Français
*/
setlocale(LC_TIME, 'fr_FR.utf8','fra');
date_default_timezone_set('Europe/Paris');
/*
** Version de µForum
*/
$version = '0.9.6';
/**
*
* Vérification de la version de php
*/
if (version_compare(PHP_VERSION, '5.3', '<')) {
    die('Vous devez disposer d\'un serveur équipé de PHP 5.3 ou plus !');
}
/**
*
* Choix du style (en feature)
*/
$cNames=array('[lt]','[dk]','[lk]','[ct]','[bk]','[br]');
$cVals['defaut']=array('e8ebed','b1c5d0','91a5b0','f90','eee','999');
$cVals['black']=array('333','d0b1c5','b091a5','f90','eee','999');
/**
*
* TEXTE D'ACCEUIL ENCODÉ
*/
$wt = 'W2JdW2ldQmllbnZlbnVlIHN1ciDCtWZvcnVtWy9pXVsvYl0NCg0KQ2UgZm9ydW0gbW9ub3RocmVhZCBlc3QgYmFzw6kgc3VyIGRlcyBmaWNoaWVycyB1bmlxdWVtZW50IChwYXMgZGUgYmFzZSBkZSBkb25uw6llIHNxbCkuDQpMZSBjb25jZXB0IGVzdCB1biBwZXUgZGlmZsOpcmVudCBkZXMgYXV0cmVzIGZvcnVtcyBwdWlzcXVlIGwnaW5mb3JtYXRpb24gbGEgcGx1cyBpbXBvcnRhbnRlIG1pc2UgZW4gYXZhbnQgcG91ciByZWNvbm5haXRyZSB1biB1dGlsaXNhdGV1ciBlc3Qgc29uIGF2YXRhciAocG91ciB1bmUgZm9pcyBxdSdpbCBzZXJ0IMOgIHF1ZWxxdWUgY2hvc2UuLikNCg0KW3VdW2JdSWwgaW50w6hncmUgcGx1c2lldXJzIGZvbmN0aW9ubmFsaXTDqXMgOlsvYl1bL3VdIFtpXSjimIUgPSBOb3V2ZWF1dMOpKVsvaV0NCg0KW2Nd4pyUIEdlc3Rpb24gZGVzIG1lbWJyZXMgcGFyIGxvZ2luIC8gbW90IGRlIHBhc3NlIChwYXIgY29va2llcykuDQrinJQgNCBuaXZlYXV4IGQndXRpbGlzYXRldXJzIDogQWRtaW5pc3RyYXRldXIsIE1vZMOpcmF0ZXVyLCBNZW1icmUsIEFub255bWUuDQrinJQgTW9kZSBwcml2w6kgLyBwdWJsaWMsIHBvdXIgYXV0b3Jpc2VyIGxlcyBub24tbWVtYnJlcy4NCuKclCBMaXN0ZSBkZXMgbWVtYnJlcy4NCuKclCBQcm9maWwgdXRpbGlzYXRldXIgKCsgw6lkaXRpb24pLg0K4pyUIE1lc3NhZ2VyaWUgcHJpdsOpZSBlbnRyZSBsZXMgbWVtYnJlcy4NCuKclCBVcGxvYWQgZCdhdmF0YXIgZXQgZGUgcGnDqGNlcyBqb2ludGVzIChhdmVjIGZpbHRyZSBkJ2V4dGVuc2lvbnMpLg0K4pyUIFNtaWxleXMgZXQgQkJDb2RlcyAoYWpvdXQgYXV0b21hdGlxdWUgZGVzIGJhbGlzZXMgZmVybWFudGVzIG1hbnF1YW50ZXMpLg0K4piFIENvdXB1cmUgZGVzIGNoYWluZXMgdHJvcCBsb25ndWVzIHNhbnMgY291cGVyIGxlcyBwaHJhc2VzICENCuKclCBTa2lucy4NCuKclCBMaWVucyBhdXRvbWF0aXF1ZXMuDQrimIUgSHRtbDUgZXQgY3NzMyAoQm9vdHN0cmFwIGRlIHR3aXR0ZXIpLg0K4pyUIEFmZmljaGFnZSBkZXMgY29ubmVjdMOpcy4NCuKclCBjb2xvcmF0aW9uIHN5bnRheGlxdWUgZHUgY29kZS4NCuKclCBHZXN0aW9uIGRlcyBvcHRpb25zIGQnYWRtaW5pc3RyYXRpb25zLg0K4pyUIFN5c3TDqG1lIHNpbXBsZSBkZSBzYXV2ZWdhcmRlIGV0IHJlc3RhdXJhdGlvbi4gKHJldnVlKQ0K4piFIENhcHRjaGEgbG9ycyBkZSBsJ2luc2NyaXB0aW9uLg0K4piFIFByb3RlY3Rpb24gZGVzIG1haWxzIHN1ciBsYSBsaXN0ZSBkZXMgbWVtYnJlcyBwb3VyIGNvbnRyZXIgbGUgc3BhbS4gICANCuKYhSBJbmRpY2F0ZXVyIGRlIG1lc3NhZ2UgKFN0YXR1cyBJY8O0bmUpLiAgDQrimIUgRGF0ZSBkZSBuYWlzc2FuY2UgKyDDgmdlIGFmZmljaMOpIHNpIGNlbGxlLWNpIHJlbnNlaWduw6llLg0K4piFIERhdGUgcGlja2VyIChJbnNjcmlwdGlvbiBldCDDqWRpdGlvbiBkdSBwcm9maWwpLiANCuKYhSBNZXRhcyBEZXNjcmlwdGlvbiBwb3VyIGxlIFNFTy5bL2Nd';
/**
*
* NOMS DES IMAGES POUR LE DÉCODAGE
*/
$img_names = array('smile','wink','laugh','indifferent','sad','wry','tongue','sorry','arrow','glyphicons-halflings-white','glyphicons-halflings','avatar');
/**
*
* SAUVEGARDE LES OBJETS
*/
class SaveObj
{
	function saveObj() {
		if($fp=fopen($this->name,'w')) { 
			fputs($fp, serialize($this));
			fclose($fp);
		}
	}
}
/**
*
* CLASS GLOBAL RETOURNANT TABLEAUX
*/
class Forum extends SaveObj
{
	var $name='data/membres/members.dat';
	var $topics=array();
	var $members=array();
	function forum() { // Construteur de la classe
		$this->saveObj();
	}
	function addMember($name,$password,$mail,$quote='',$url='',$birthday,$pic='',$mod=0) {
		if(!count($this->members)) $mod=2;
		$this->members[$name]=array(md5($password),time(),$mail,$quote,$url,$birthday,$pic,$mod,0);
		ksort($this->members);
		$this->saveObj();
	}
	function removeMember($name) {
		unset($this->members[$name]);
		ksort($this->members);
		$this->saveObj();
	}
	function getMember($name) {
		return $this->members[$name];
	}
	function isMember($name) {
		return isset($this->members[$name]); 
	}
	function setMember($name,$mail,$quote='',$url='',$birthday,$pic='') {
		if($pic=='') $pic=$this->members[$name][6];
		$this->members[$name]=array($this->members[$name][0],$this->members[$name][1],$mail,$quote,$url,$birthday,$pic,$this->members[$name][7],$this->members[$name][8]);
		$this->saveObj();
	}
	function setPost($name) { 
		$this->members[$name][8]++;
		$this->saveObj();
	}
	function setMod($name) {
		$this->members[$name][7]=$this->members[$name][7]?0:1;
		$this->saveObj();
	}
	function listMember() {
		$tmp=array();
		foreach($this->members as $k=>$v) $tmp[]=$k;
		return $tmp;
	}
	function checkMember($name,$pass) {
		$login=(isset($this->members[$name]));
		if($login) {
			$pass=($this->members[$name][0]!=$pass)?false:true;
			$mod=$this->members[$name][7];
			return array($login,$pass,$mod);
		}
		return array(0,0,0);
	}
	function addTopic($title,$auth,$time,$attach,$type=false) {
		$this->topics[$time]=array($title,$auth,1,$auth,$time,$attach,$type);
		$this->lastSort();
		if(isset($this->members[$auth])) $this->members[$auth][8]++;
		$this->saveObj();
	}
	function updateTopic($time,$title,$auth,$post,$last,$ltime,$attach,$type) {
		$this->topics[$time]=array($title,$auth,$post,$last,$ltime,$attach,$type);
		$this->lastSort();
		$this->saveObj();
	}
	function delTopic($id) {
		unset($this->topics[$id]);
		$this->saveObj();
	}
	function setType($topic,$type) {
		$this->topics[$topic][6]=$type;
		$t = $this->openTopic($topic);
		$t->setType($type);
		unset($t);
		$this->lastSort();
		$this->saveObj();
	}
	function setTitle($topic,$title) {
		$this->topics[$topic][0]=$title;
		$t = $this->openTopic($topic);
		$t->setTitle($title);
		unset($t);
		$this->lastSort();
		$this->saveObj();
	}
	function getallTopic($nbr=false,$limit=false) {
		$tmp=array();
		$cnt=0;
		foreach($this->topics as $k=>$v) {
			if(!$limit || $cnt==$limit) {
				if(count($v)<7) $v[]=0;
				$v[]=$k; $tmp[]=$v; 
				if($nbr && (count($tmp)==$nbr)) break;
			} else if($limit) $cnt++;
		}
		return $tmp;
	}
	function getStat() {
		$tmp=0;
		$arr=array(0,"");
		foreach($this->getallTopic() as $v)  $tmp+=$v[2];
		foreach($this->members as $k=>$v) $arr=($v[1]>$arr[0])?array($v[1],$k):$arr;
		return array(count($this->members),$arr[1],count($this->topics),$tmp);
	}
	function openTopic($topic) {
		if($s = @file_get_contents(U_THREAD.$topic.'.dat')) return unserialize($s);
		else return false;
	}
	function lastSort() {
		$arr = array();
		$arrp = array();
		foreach($this->topics as $k=>$v) {
			$l=end($v);
			if($l>2) $v[]=0;
			$v[]=$k;
			if($l && $l<2) $arrp[$v[4]]=$v;
			else $arr[$v[4]]=$v;
		}
		unset($this->topics);
		if(count($arrp)>0) {
			ksort($arrp);
			foreach($arrp as $v) {
				$t=array_pop($v);
				$this->topics[$t]=$v;
			}
		}
		if(count($arr)>0) {
			krsort($arr);
			foreach($arr as $v) {
				$t=array_pop($v);
				$this->topics[$t]=$v;
			}
		}
	}
}
/**
*
* CLASS DE GESTION DES DISCUSSIONS
*/
class Topic extends SaveObj
{
	var $title;
	var $time;
	var $name;
	var $type=false;
	var $reply=array();
	var $pos=0;
	function Topic($auth,$title,$content,$attach='',$type=false) { // Construteur de la classe
		$this->addReply($auth,$content,$attach);
		$this->title=clean($title);
		$this->time=time();
		$this->type=$type;
		$this->name=U_THREAD.time().'.dat';
		$this->saveObj();
	}
	function removeTopic() {
		unlink($this->name);
	}
	function addReply($auth,$content,$attach='') {
		$this->reply[]= array($auth,time(),$content,$attach);
		$this->saveObj();
		return $this->getlastReply();
	}
	function removeReply($id) {
		$tmp=array();
		foreach($this->reply as $r) if($r[1]!=$id) $tmp[]=$r;
		$this->reply=$tmp;
		$this->saveObj();
	}
	function getlastReply() {
		return end($this->reply);
	}
	function setReply($id,$title,$content,$attach='') {
		if($title!='') $this->title=$title;
		foreach($this->reply as $k=>$r) { if($r[1]==$id) $this->reply[$k][2]=$content;}
		$this->saveObj();
	}
	function getReply($id) {
		foreach($this->reply as $v) {
			if($v[1]==$id) return $v;
		}
	}
	function nextReply() {
		if($this->pos<count($this->reply))return $this->reply[$this->pos++];
		else {$this->pos=0; return false;}
	}
	function setType($type) {
		$this->type=$type;
		$this->saveObj();
	}
	function setTitle($title) {
		$this->title=$title;
		$this->saveObj();
	}
	function getInfo($type) {
		$auths=array();
		$posts=0;
		$attach=0;
		$last=$this->getlastReply();
		foreach($this->reply as $v) {
			if(!in_array($v[0],$auths)) $auths[]=$v[0];
			if($v[3]!='') $attach=1;
			$posts++;
		}
		if($type) return array(count($auths),$auths);
		else return array($this->time,$this->title,$auths[0],$posts,$last[0],$last[1],$attach,$this->type);
	}
}
/**
*
* STATISTIQUES (Online)
*/
class Visit extends saveObj
{
	var $name='data/membres/connected.dat';
	var $conn=array();
	function visit($id='') {
		$this->conn[$_SERVER['REMOTE_ADDR']]=array($id,time());
		$this->saveObj();
	}
	function updateVisit($id='') {
		$r=$_SERVER['REMOTE_ADDR'];
		$cnt=0;
		$arr='';
		$this->conn[$r]=array($id,time());
		foreach($this->conn as $k=>$v) {
			if(((time()-$v[1])>120) && $k!=$r) unset($this->conn[$k]);
			else {
				if($this->conn[$k][0]!='') $arr.=($r==$k)?$id.' ':'<a href="?private='.$this->conn[$k][0].'" rel="tooltip" title="Envoyer un message privé">'.$this->conn[$k][0].'</a> ';
				else $cnt++;
			}
		}
		$this->saveObj();
		return array($arr,$cnt);
	}
}
/**
*
* INSCRIPTION DES MESSAGES PRIVÉS DES MEMBRES
*/
class Messages extends saveObj
{
	var $mess=array();
	var $name;
	function messages($name) {
		$this->name=U_MEMBER.$name.'/'.$name.'.mp';
	}
	function addMessage($from,$content) {
		$this->mess[]=array(time(),$from,$content);
		$this->saveObj();
	}
	function getMessage() {
		return $this->mess;
	}
}
/**
*
* NETTOIE LES NOMS D'UTILISATEURS
*/
function cleanUser($str,$charset='utf-8') 
{

		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		$str = str_replace(array(" ", '"', "'", "/", "&", ".", "!", "?", ":"), array("", '', "", "", "", "", "", "", ""), $str);
	    return $str;
}
/**
*
* SUPPRIME LES CARACTERES SPÉCIAUX
*/
function removeAccents($str,$charset='utf-8') 
{

		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		$str = str_replace(array(" ", '"', "'", "/", "&", ".", "!", "?", ":"), array("", '', "", "", "", "", "", "", ""), $str);
	    $str = preg_replace('#\&([A-za-z])(?:acute|cedil|circ|grave|ring|tilde|uml|uro)\;#', '\1', $str);
	    $str = preg_replace('#\&([A-za-z]{2})(?:lig)\;#', '\1', $str); # pour les ligatures e.g. '&oelig;'
	    $str = preg_replace('#\&[^;]+\;#', '', $str); # supprime les autres caractères
	    return $str;
}
/**
*
* RETOURNE LA BASE
*/
function baseURL()
{
	$dir = dirname($_SERVER['SCRIPT_NAME']);
	return 'http://' .$_SERVER['SERVER_NAME'].$dir.($dir === '/'? '' : '/');
}
/**
*
* RETOURNE L'URL
*/
function getURL()
{
    $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    return $url;
}    
/**
*
* INITIALISATION
*/
function init_forum() {
	global $error,$version, $forum, $conn;
	if(@file_get_contents('version')!=$version) {
		$d = baseURL();
		if($h=@fopen('version','w')) { fputs($h,$version); fclose($h); }
		if(!mkressources($d)) {
			@include('config.php');
			$config="<?\$uforum='$uforum';\$lang='$lang';\$metaDesc='$metaDesc';\$nbrMsgIndex=$nbrMsgIndex;\$extensionsAutorises='$extensionsAutorises';\$maxAvatarSize=$maxAvatarSize;\$forumMode=$forumMode;\$quoteMode=$quoteMode;\$siteUrl='$siteUrl';\$siteName='$siteName';\$siteBase='$d';?>";
			if($h=@fopen('config.php','w')) {fputs($h,utf8_encode($config));fclose($h);}
		}
		mkhtaccess();
		mklang();
		mkjs();
		if(@copy('index.php','index.bak')) {
			unlink('index.php');
			rename('index.bak','index.php');
			header('location: index.php?rc='.base64_encode($error));
			exit();
		}
	} else {
		$s = @file_get_contents(U_MEMBER.'members.dat');
		$forum = unserialize($s);
		$s = @file_get_contents(U_MEMBER.'connected.dat');
		$conn = unserialize($s);
	}
}
/**
*
* INSTALLATEUR
*/
function mkressources($d) {
	global $error,$forum,$conn,$lang;
	if (!file_exists(U_MEMBER) || !file_exists(U_MEMBER.'members.dat')) {
		$config="<?\$uforum='[b]&micro;[/b]Forum';\$lang='fr';\$metaDesc='Lightweight bulletin board without sql';\$nbrMsgIndex=15;\$extensionsAutorises='gif,bmp,png,jpg,mp3,zip,rar,txt';\$maxAvatarSize=30720;\$forumMode=1;\$quoteMode=1;\$siteUrl='';\$siteName='';\$siteBase='$d';?>";
		if($h=@fopen('config.php','w')) {fputs($h,utf8_encode($config));fclose($h);}
		$error.='';
		$error.= (@mkdir('css/'))? sprintf("&#10004; Création du répertoire css.\n") : sprintf("&#10008; Echec à la création du répertoire css.\n");
        $error.= (@mkdir('lang/'))? sprintf("&#10004; Création du répertoire lang.\n") : sprintf("&#10008; Echec à la création du répertoire lang.\n");
        $error.= (@mkdir('backup/'))? sprintf("&#10004; Création du répertoire backup.\n") : sprintf("&#10008; Echec à la création du répertoire backup.\n");
        $error.= (@mkdir('upload/'))? sprintf("&#10004; Création du répertoire upload.\n") : sprintf("&#10008; Echec à la création du répertoire upload.\n");
		$error.= (@mkdir(U_DATA))? sprintf("&#10004; Création du répertoire data.\n") : sprintf("&#10008; Echec à la création du répertoire data.\n");
		$error.= (@mkdir(U_MEMBER))? sprintf("&#10004; Création du répertoire membres.\n") : sprintf("&#10008; Echec à la création du répertoire membres.\n");
		$error.= (@mkdir(U_THREAD))? sprintf("&#10004; Création du répertoire messages.\n") : sprintf("&#10008; Echec à la création du répertoire messages.\n");
		$error.= (@mkdir('js/'))? sprintf("&#10004; Création du répertoire js.\n") : sprintf("&#10008; Echec à la création du répertoire js.\n");
		$error.= (mkimg())? sprintf("&#10004; Installation des images réussie.\n") : sprintf("&#10008; Echec à l\'installation des images.\n");
		mkcss();
		$forum = new Forum();
		$conn = new Visit();
		return true;
	}
	return false;
}
/**
*
* CRÉATION DU FICHIER LANG
*/
function mklang() {
	$fr = 'PD9waHANCg0KJGxhbmdbJ3JlZ2lzdGVyJ10gPSAnQ3LDqWVyIHVuIGNvbXB0ZSc7DQokbGFuZ1sncG9zdCddID0gJ0FydGljbGUnOw0KJGxhbmdbJ3JlcGx5J10gPSAnQ29tbWVudGFpcmUnOw0KJGxhbmdbJ3BsdWdpbiddID0gJ1BsdWdpbic7DQokbGFuZ1snbW9yZSddID0gJ0VuIGxpcmUgcGx1cy4uLic7DQokbGFuZ1snY29uZmlnJ10gPSAnQ29uZmlndXJhdGlvbic7DQokbGFuZ1snbG9nb3V0J10gPSAnRMOpY29ubmV4aW9uJzsNCiRsYW5nWydsb2dpbiddID0gJ0Nvbm5leGlvbic7DQokbGFuZ1sncmVkaXJlY3QnXSA9ICdSZWRpcmVjdGlvbiB2ZXJzJzsNCiRsYW5nWydhZGQnXSA9ICdBam91dGVyJzsNCiRsYW5nWydlZGl0J10gPSAnRWRpdGVyJzsNCiRsYW5nWydkZWxldGUnXSA9ICdTdXBwcmltZXInOw0KJGxhbmdbJ3RpdGxlJ10gPSAnVGl0cmUnOw0KJGxhbmdbJ2NvbnRlbnQnXSA9ICdNZXNzYWdlJzsNCiRsYW5nWyduYW1lJ10gPSAnTm9tJzsNCiRsYW5nWyd0cmlwJ10gPSAnTGFpc3NlciB2aWRlIHNpIEFub255bWUnOw0KJGxhbmdbJ3ZpZXcnXSA9ICdBZmZpY2hhZ2UnOw0KJGxhbmdbJ3NlYXJjaCddID0gJ1JlY2hlcmNoZSc7DQokbGFuZ1snbGluayddID0gJ0xpZW4nOw0KJGxhbmdbJ2NhdGVnb3J5J10gPSAnQ2F0w6lnb3JpZSc7DQokbGFuZ1snYXJjaGl2ZSddID0gJ0FyY2hpdmUnOw0KJGxhbmdbJ3VybCddID0gJ1VSTCc7DQokbGFuZ1sncGFzc3dvcmQnXSA9ICdNb3QgZGUgUGFzc2UnOw0KJGxhbmdbJ3Bvd2VyZWRCeSddID0gJ1Byb3B1bHPDqSBwYXIgPGEgaWQ9ImJvdHRvbSIgbmFtZT0iYm90dG9tIiBocmVmPSJodHRwOi8vdWZvcnVtLmJ5ZXRob3N0NS5jb20iIHJlbD0idG9vbHRpcCIgdGl0bGU9IkZvcnVtIHNhbnMgU3FsIj7CtUZvcnVtPC9hPic7DQokbGFuZ1snZmVlZCddID0gJ0ZpbCByc3MnOw0KJGxhbmdbJ3RoZW1lJ10gPSAnVGjDqG1lJzsNCiRsYW5nWydsYW5nJ10gPSAnTGFuZ3VhZ2UnOw0KJGxhbmdbJ25vbmUnXSA9ICdBdWN1bmUgZG9ubsOpZSBhY3R1ZWxsZW1lbnQnOw0KJGxhbmdbJ2NvbmZpcm0nXSA9ICdPayc7DQokbGFuZ1sndW5jYXRlZ29yaXplZCddID0gJ05vbiBjYXTDqWdvcmnDqSc7DQokbGFuZ1sneWVzJ10gPSAnT3VpJzsNCiRsYW5nWydubyddID0gJ05vbic7DQokbGFuZ1snbG9ja2VkJ10gPSAnRmVybcOpJzsNCiRsYW5nWydkYXknXSA9ICdKb3VyJzsNCiRsYW5nWydob3VyJ10gPSAnaGV1cmUnOw0KJGxhbmdbJ21pbnV0ZSddID0gJ21pbnV0ZSc7DQokbGFuZ1snc2Vjb25kJ10gPSAnc2Vjb25kZSc7DQokbGFuZ1sncGx1cmFsJ10gPSAncyc7DQokbGFuZ1snYWdvJ10gPSAnYXZhbnQnOw0KJGxhbmdbJ2VyckxlbiddID0gJ2VzdCB0cm9wIGxvbmcgb3UgdHJvcCBjb3VydCc7DQokbGFuZ1snZXJyQm90J10gPSAnQ0FQVENIQSBpbmNvcnJlY3RlJzsNCiRsYW5nWydyZXBsaWVkJ10gPSAncsOpcG9uZHVzIMOgJzsNCiRsYW5nWydub3RGb3VuZCddID0gJ09vcHMhIENldHRlIHBhZ2UgblwnZXhpc3RlIHBsdXMgOignOw0KJGxhbmdbJ2Vyck5vdE1hdGNoJ10gPSAnTGVzIG1vdHMgZGUgcGFzc2UgbmUgY29ycmVzcG9uZGVudCBwYXMnOw0KDQo/Pg==';
	if(!file_exists('lang/fr.lng.php')) {
		if($h=@fopen('lang/fr.lng.php','w')) { fputs($h,base64_decode($fr));fclose($h); }
	}
}
/**
*
* CRÉATION DU FICHIER JS
*/
function mkjs() {
    // Script
	$js_script = 'ICAgIC8vIEJvb3RzdHJhcCAyLjIuMiAgDQogICAgIWZ1bmN0aW9uKGEpew0KICAgICAgICBhKGZ1bmN0aW9uKCl7DQogICAgICAgICAgICAgICAgYSgiI3RvcCIpLnRvb2x0aXAoe3NlbGVjdG9yOiJhW3JlbD10b29sdGlwXSJ9KTsNCiAgICAgICAgICAgICAgICBhKCIjdG9wIikucG9wb3ZlcigpOw0KICAgICAgICAgICAgICAgIGEoImFbcmVsPXBvcG92ZXJdIikucG9wb3ZlcigpLmNsaWNrKGZ1bmN0aW9uKGIpe2IucHJldmVudERlZmF1bHQoKX0pDQogICAgICAgICAgICB9KQ0KICAgIH0od2luZG93LmpRdWVyeSk7IAkNCg0KICAgIC8vIEpxdWVyeSBEYXRlUGlja2VyDQogICAgJCgnaW5wdXRbbmFtZT0iYmlydGhkYXkiXScpLmRhdGVwaWNrZXIoew0KICAgICAgICBjaGFuZ2VNb250aDogdHJ1ZSwNCiAgICAgICAgY2hhbmdlWWVhcjogdHJ1ZQ0KICAgIH0pOyAgICAgIA0KCSQuZGF0ZXBpY2tlci5yZWdpb25hbFsnZnInXSA9IHsNCgkJY2xvc2VUZXh0OiAnRmVybWVyJywNCgkJcHJldlRleHQ6ICdQcsOpY8OpZGVudCcsDQoJCW5leHRUZXh0OiAnU3VpdmFudCcsDQoJCWN1cnJlbnRUZXh0OiAnQXVqb3VyZFwnaHVpJywNCgkJbW9udGhOYW1lczogWydKYW52aWVyJywnRsOpdnJpZXInLCdNYXJzJywnQXZyaWwnLCdNYWknLCdKdWluJywNCgkJJ0p1aWxsZXQnLCdBb8O7dCcsJ1NlcHRlbWJyZScsJ09jdG9icmUnLCdOb3ZlbWJyZScsJ0TDqWNlbWJyZSddLA0KCQltb250aE5hbWVzU2hvcnQ6IFsnSmFudi4nLCdGw6l2ci4nLCdNYXJzJywnQXZyaWwnLCdNYWknLCdKdWluJywNCgkJJ0p1aWwnLCdBb8O7dCcsJ1NlcHQnLCdPY3QnLCdOb3YnLCdEw6ljJ10sDQoJCWRheU5hbWVzOiBbJ0RpbWFuY2hlJywnTHVuZGknLCdNYXJkaScsJ01lcmNyZWRpJywnSmV1ZGknLCdWZW5kcmVkaScsJ1NhbWVkaSddLA0KCQlkYXlOYW1lc1Nob3J0OiBbJ0RpbScsJ0x1bicsJ01hcicsJ01lcicsJ0pldScsJ1ZlbicsJ1NhbSddLA0KCQlkYXlOYW1lc01pbjogWydEJywnTCcsJ00nLCdNJywnSicsJ1YnLCdTJ10sDQoJCXdlZWtIZWFkZXI6ICdTZW0uJywNCgkJZGF0ZUZvcm1hdDogJ2RkL21tL3l5JywNCgkJZmlyc3REYXk6IDEsDQoJCWlzUlRMOiBmYWxzZSwNCgkJc2hvd01vbnRoQWZ0ZXJZZWFyOiBmYWxzZSwNCgkJeWVhclN1ZmZpeDogJyd9Ow0KCSQuZGF0ZXBpY2tlci5zZXREZWZhdWx0cygkLmRhdGVwaWNrZXIucmVnaW9uYWxbJ2ZyJ10pOyANCgkgDQogICAgJC5kYXRlcGlja2VyLnNldERlZmF1bHRzKHsNCiAgICB5ZWFyUmFuZ2U6ICcxOTQwOjIwMDInLA0KICAgIGRlZmF1bHREYXRlOiAtMzY1KjQwICB9KTsgIA0KICAgICAgDQp2YXIgYWN0aXZlU3ViPTA7dmFyIFN1Yk51bT0wO3ZhciB0aW1lcklEPW51bGw7dmFyIHRpbWVyT249ZmFsc2U7dmFyIHRpbWVjb3VudD0zMDA7dmFyIHdoYXQ9bnVsbDt2YXIgbmV3YnJvd3Nlcj10cnVlO3ZhciBjaGVjaz1mYWxzZTt2YXIgbGF5ZXJSZWY9IiI7dmFyIHRtPSIiO3ZhciBjb25maXJtTXNnPSJDb25maXJtZXogbGEgc3VwcHJlc3Npb24gZGUgIjt2YXIgbXNpZT1uYXZpZ2F0b3IudXNlckFnZW50LnRvTG93ZXJDYXNlKCkuaW5kZXhPZigibXNpZSIpKzE7d210dD1udWxsO2RvY3VtZW50Lm9ubW91c2Vtb3ZlPXVwZGF0ZVdNVFQ7ZnVuY3Rpb24gaW5pdCgpe2lmKGRvY3VtZW50LmxheWVycyl7bGF5ZXJSZWY9ImRvY3VtZW50LmxheWVycyI7c3R5bGVTd2l0Y2g9IiI7dmlzaWJsZVZhcj0ic2hvdyI7d2hhdD0ibnM0In1lbHNle2lmKGRvY3VtZW50LmFsbCl7bGF5ZXJSZWY9ImRvY3VtZW50LmFsbCI7c3R5bGVTd2l0Y2g9Ii5zdHlsZSI7dmlzaWJsZVZhcj0idmlzaWJsZSI7d2hhdD0iaWUifWVsc2V7aWYoZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQpe2xheWVyUmVmPSJkb2N1bWVudC5nZXRFbGVtZW50QnlJRCI7c3R5bGVTd2l0Y2g9Ii5zdHlsZSI7dmlzaWJsZVZhcj0idmlzaWJsZSI7d2hhdD0ibW96In1lbHNle3doYXQ9Im5vbmUiO25ld2Jyb3dzZXI9ZmFsc2V9fX1jaGVjaz10cnVlfWZ1bmN0aW9uIHN3aXRjaExheWVyKGEpe2lmKGNoZWNrKXtpZih3aGF0PT0ibm9uZSIpe3JldHVybn1lbHNle2lmKHdoYXQ9PSJtb3oiKXtpZihkb2N1bWVudC5nZXRFbGVtZW50QnlJZChhKS5zdHlsZS52aXNpYmlsaXR5PT0idmlzaWJsZSIpe2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKGEpLnN0eWxlLnZpc2liaWxpdHk9ImhpZGRlbiI7ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoYSkuc3R5bGUuZGlzcGxheT0ibm9uZSJ9ZWxzZXtkb2N1bWVudC5nZXRFbGVtZW50QnlJZChhKS5zdHlsZS52aXNpYmlsaXR5PSJ2aXNpYmxlIjtkb2N1bWVudC5nZXRFbGVtZW50QnlJZChhKS5zdHlsZS5kaXNwbGF5PSJibG9jayJ9fWVsc2V7aWYoZG9jdW1lbnQuYWxsW2FdLnN0eWxlLnZpc2liaWxpdHk9PSJ2aXNpYmxlIil7ZG9jdW1lbnQuYWxsW2FdLnN0eWxlLnZpc2liaWxpdHk9ImhpZGRlbiI7ZG9jdW1lbnQuYWxsW2FdLnN0eWxlLmRpc3BsYXk9Im5vbmUifWVsc2V7ZG9jdW1lbnQuYWxsW2FdLnN0eWxlLnZpc2liaWxpdHk9InZpc2libGUiO2RvY3VtZW50LmFsbFthXS5zdHlsZS5kaXNwbGF5PSJibG9jayJ9fX19ZWxzZXtyZXR1cm59fWZ1bmN0aW9uIGNvdW50SW5zdGFuY2VzKGMsYil7dmFyIGE9ZG9jdW1lbnQuZm9ybXVsYWlyZS5tZXNzYWdlLnZhbHVlLnNwbGl0KGMpO3ZhciBkPWRvY3VtZW50LmZvcm11bGFpcmUubWVzc2FnZS52YWx1ZS5zcGxpdChiKTtyZXR1cm4gYS5sZW5ndGgrZC5sZW5ndGgtMn1mdW5jdGlvbiBpbnNlcnQoZSxjKXt2YXIgYj1kb2N1bWVudC5nZXRFbGVtZW50QnlJZCgibWVzc2FnZSIpO2lmKGRvY3VtZW50LnNlbGVjdGlvbil7dmFyIGc9ZG9jdW1lbnQuc2VsZWN0aW9uLmNyZWF0ZVJhbmdlKCkudGV4dDtkb2N1bWVudC5mb3JtdWxhaXJlLm1lc3NhZ2UuZm9jdXMoKTt2YXIgZD1kb2N1bWVudC5zZWxlY3Rpb24uY3JlYXRlUmFuZ2UoKTtpZihjIT0iIil7aWYoZz09IiIpe3ZhciBmPWNvdW50SW5zdGFuY2VzKGUsYyk7aWYoZiUyIT0wKXtkLnRleHQ9ZC50ZXh0K2N9ZWxzZXtkLnRleHQ9ZC50ZXh0K2V9fWVsc2V7ZC50ZXh0PWUrZC50ZXh0K2N9fWVsc2V7ZC50ZXh0PWQudGV4dCtlfX1lbHNle2lmKGIuc2VsZWN0aW9uU3RhcnR8Yi5zZWxlY3Rpb25TdGFydD09MCl7aWYoYi5zZWxlY3Rpb25FbmQ+Yi52YWx1ZS5sZW5ndGgpe2Iuc2VsZWN0aW9uRW5kPWIudmFsdWUubGVuZ3RofXZhciBoPWIuc2VsZWN0aW9uU3RhcnQ7dmFyIGE9Yi5zZWxlY3Rpb25FbmQrZS5sZW5ndGg7Yi52YWx1ZT1iLnZhbHVlLnNsaWNlKDAsaCkrZStiLnZhbHVlLnNsaWNlKGgpO2IudmFsdWU9Yi52YWx1ZS5zbGljZSgwLGEpK2MrYi52YWx1ZS5zbGljZShhKTtiLnNlbGVjdGlvblN0YXJ0PWgrZS5sZW5ndGg7Yi5zZWxlY3Rpb25FbmQ9YTtiLmZvY3VzKCl9ZWxzZXt2YXIgZD1kb2N1bWVudC5mb3JtdWxhaXJlLm1lc3NhZ2U7dmFyIGY9Y291bnRJbnN0YW5jZXMoZSxjKTtpZihmJTIhPTAmJmMhPSIiKXtkLnZhbHVlPWQudmFsdWUrY31lbHNle2QudmFsdWU9ZC52YWx1ZStlfX19fWZ1bmN0aW9uIHVwZGF0ZVdNVFQoYSl7aWYoZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnNjcm9sbFRvcCYmbXNpZSl7eD13aW5kb3cuZXZlbnQueCtkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc2Nyb2xsTGVmdCsxMDt5PXdpbmRvdy5ldmVudC55K2RvY3VtZW50LmRvY3VtZW50RWxlbWVudC5zY3JvbGxUb3ArMTB9ZWxzZXt4PShkb2N1bWVudC5hbGwpP3dpbmRvdy5ldmVudC54K2RvY3VtZW50LmJvZHkuc2Nyb2xsTGVmdCsxMDooYS5wYWdlWCsxMCkrInB4Ijt5PShkb2N1bWVudC5hbGwpP3dpbmRvdy5ldmVudC55K2RvY3VtZW50LmJvZHkuc2Nyb2xsVG9wKzEwOihhLnBhZ2VZKzEwKSsicHgifWlmKHdtdHQhPW51bGwpe3dtdHQuc3R5bGUubGVmdD14O3dtdHQuc3R5bGUudG9wPXl9fWZ1bmN0aW9uIHF1b3RlKGMsZil7dmFyIGE9ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInRkIitmKS5pbm5lckhUTUw7dmFyIGI9bmV3IEFycmF5KCI8ZmllbGRzZXQuKj8+Lio/PC9maWVsZHNldD4iLCI8YnI+fDxiciAvPiIsIjxzbWFsbD4uKj88L3NtYWxsPnw8cHJlPnw8L3ByZT58PGZvbnQuKj8+fDwvZm9udD58Jm5ic3A7IiwiPGI+IiwiPC9iPiIsIjxpPiIsIjwvaT4iLCI8dT4iLCI8L3U+IiwiJmFtcDtsdDt8Jmx0OyIsIiZhbXA7Z3Q7fCZndDsiLCI8aHIgLz4iLCc8aW1nKC4qPylzcmM9InBpY3R1cmVzLyguKj8pIiguKj8pPicpO3ZhciBlPW5ldyBBcnJheSgiIiwiXG4iLCIiLCJbYl0iLCJbL2JdIiwiW2ldIiwiWy9pXSIsIlt1XSIsIlsvdV0iLCI8IiwiPiIsIltocl0iLCJbc209JDJdIik7dmFyIGQ9MDtmb3IoaSBpbiBiKXtyZWdleD1uZXcgUmVnRXhwKGJbaV0sImdpIik7YT1hLnJlcGxhY2UocmVnZXgsZVtkKytdKX1pZihkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiZm9ybSIpLnN0eWxlLnZpc2liaWxpdHkhPSJ2aXNpYmxlIil7c3dpdGNoTGF5ZXIoImZvcm0iKX1kb2N1bWVudC5nZXRFbGVtZW50QnlJZCgibWVzc2FnZSIpLnZhbHVlKz0iW3E9IitjKyJdIithKyJbL3FdXG4ifWZ1bmN0aW9uIGNvbmZpcm1MaW5rKGIsYyl7dmFyIGE9Y29uZmlybShjb25maXJtTXNnKyIgOlxuIitjKTtpZihhKXtiLmhyZWYrPSImYW1wO2RvPTEifXJldHVybiBhfSAgICANCmZ1bmN0aW9uIGNoZWNrZm9ybShmKXt2YXIgZz0iIjtpZihmLnR4dElucHV0LnZhbHVlPT0iIil7Zys9Ii0gQ29kZSBkZSBzw6ljdXJpdMOpIG5lIGRvaXQgcGFzIMOqdHJlIHZpZGUuXG4ifWlmKGYudHh0SW5wdXQudmFsdWUhPSIiKXtpZihWYWxpZENhcHRjaGEoZi50eHRJbnB1dC52YWx1ZSk9PWZhbHNlKXtnKz0iLSBDb2RlIGRlIHPDqWN1cml0w6kgbmUgY29ycmVzcG9uZCBwYXMuXG4ifX1pZihnIT0iIil7YWxlcnQoZyk7cmV0dXJuIGZhbHNlfX12YXIgYT1NYXRoLmNlaWwoTWF0aC5yYW5kb20oKSo5KSsiIjt2YXIgYj1NYXRoLmNlaWwoTWF0aC5yYW5kb20oKSo5KSsiIjt2YXIgYz1NYXRoLmNlaWwoTWF0aC5yYW5kb20oKSo5KSsiIjt2YXIgZD1NYXRoLmNlaWwoTWF0aC5yYW5kb20oKSo5KSsiIjt2YXIgZT1NYXRoLmNlaWwoTWF0aC5yYW5kb20oKSo5KSsiIjt2YXIgY29kZT1hK2IrYytkK2U7ZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInR4dENhcHRjaGEiKS52YWx1ZT1jb2RlO2RvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJ0eHRDYXB0Y2hhRGl2IikuaW5uZXJIVE1MPWNvZGU7ZnVuY3Rpb24gVmFsaWRDYXB0Y2hhKCl7dmFyIGc9cmVtb3ZlU3BhY2VzKGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCJ0eHRDYXB0Y2hhIikudmFsdWUpO3ZhciBmPXJlbW92ZVNwYWNlcyhkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgidHh0SW5wdXQiKS52YWx1ZSk7aWYoZz09Zil7cmV0dXJuIHRydWV9ZWxzZXtyZXR1cm4gZmFsc2V9fWZ1bmN0aW9uIHJlbW92ZVNwYWNlcyhmKXtyZXR1cm4gZi5zcGxpdCgiICIpLmpvaW4oIiIpfTs=';
	// Bootstrap JS 2.3.2
    $js_bootstrap =
'LyoqDQoqIEJvb3RzdHJhcC5qcyBieSBAZmF0ICYgQG1kbw0KKiBwbHVnaW5zOiBib290c3RyYXAtdHJhbnNpdGlvbi5qcywgYm9vdHN0cmFwLW1vZGFsLmpzLCBib290c3RyYXAtZHJvcGRvd24uanMsIGJvb3RzdHJhcC1zY3JvbGxzcHkuanMsIGJvb3RzdHJhcC10YWIuanMsIGJvb3RzdHJhcC10b29sdGlwLmpzLCBib290c3RyYXAtcG9wb3Zlci5qcywgYm9vdHN0cmFwLWFmZml4LmpzLCBib290c3RyYXAtYWxlcnQuanMsIGJvb3RzdHJhcC1idXR0b24uanMsIGJvb3RzdHJhcC1jb2xsYXBzZS5qcywgYm9vdHN0cmFwLWNhcm91c2VsLmpzLCBib290c3RyYXAtdHlwZWFoZWFkLmpzDQoqIENvcHlyaWdodCAyMDEyIFR3aXR0ZXIsIEluYy4NCiogaHR0cDovL3d3dy5hcGFjaGUub3JnL2xpY2Vuc2VzL0xJQ0VOU0UtMi4wLnR4dA0KKi8NCiFmdW5jdGlvbihhKXthKGZ1bmN0aW9uKCl7YS5zdXBwb3J0LnRyYW5zaXRpb249ZnVuY3Rpb24oKXt2YXIgYT1mdW5jdGlvbigpe3ZhciBhPWRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoImJvb3RzdHJhcCIpLGI9e1dlYmtpdFRyYW5zaXRpb246IndlYmtpdFRyYW5zaXRpb25FbmQiLE1velRyYW5zaXRpb246InRyYW5zaXRpb25lbmQiLE9UcmFuc2l0aW9uOiJvVHJhbnNpdGlvbkVuZCBvdHJhbnNpdGlvbmVuZCIsdHJhbnNpdGlvbjoidHJhbnNpdGlvbmVuZCJ9LGM7Zm9yKGMgaW4gYilpZihhLnN0eWxlW2NdIT09dW5kZWZpbmVkKXJldHVybiBiW2NdfSgpO3JldHVybiBhJiZ7ZW5kOmF9fSgpfSl9KHdpbmRvdy5qUXVlcnkpLCFmdW5jdGlvbihhKXt2YXIgYj1mdW5jdGlvbihiLGMpe3RoaXMub3B0aW9ucz1jLHRoaXMuJGVsZW1lbnQ9YShiKS5kZWxlZ2F0ZSgnW2RhdGEtZGlzbWlzcz0ibW9kYWwiXScsImNsaWNrLmRpc21pc3MubW9kYWwiLGEucHJveHkodGhpcy5oaWRlLHRoaXMpKSx0aGlzLm9wdGlvbnMucmVtb3RlJiZ0aGlzLiRlbGVtZW50LmZpbmQoIi5tb2RhbC1ib2R5IikubG9hZCh0aGlzLm9wdGlvbnMucmVtb3RlKX07Yi5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmIsdG9nZ2xlOmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXNbdGhpcy5pc1Nob3duPyJoaWRlIjoic2hvdyJdKCl9LHNob3c6ZnVuY3Rpb24oKXt2YXIgYj10aGlzLGM9YS5FdmVudCgic2hvdyIpO3RoaXMuJGVsZW1lbnQudHJpZ2dlcihjKTtpZih0aGlzLmlzU2hvd258fGMuaXNEZWZhdWx0UHJldmVudGVkKCkpcmV0dXJuO3RoaXMuaXNTaG93bj0hMCx0aGlzLmVzY2FwZSgpLHRoaXMuYmFja2Ryb3AoZnVuY3Rpb24oKXt2YXIgYz1hLnN1cHBvcnQudHJhbnNpdGlvbiYmYi4kZWxlbWVudC5oYXNDbGFzcygiZmFkZSIpO2IuJGVsZW1lbnQucGFyZW50KCkubGVuZ3RofHxiLiRlbGVtZW50LmFwcGVuZFRvKGRvY3VtZW50LmJvZHkpLGIuJGVsZW1lbnQuc2hvdygpLGMmJmIuJGVsZW1lbnRbMF0ub2Zmc2V0V2lkdGgsYi4kZWxlbWVudC5hZGRDbGFzcygiaW4iKS5hdHRyKCJhcmlhLWhpZGRlbiIsITEpLGIuZW5mb3JjZUZvY3VzKCksYz9iLiRlbGVtZW50Lm9uZShhLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZnVuY3Rpb24oKXtiLiRlbGVtZW50LmZvY3VzKCkudHJpZ2dlcigic2hvd24iKX0pOmIuJGVsZW1lbnQuZm9jdXMoKS50cmlnZ2VyKCJzaG93biIpfSl9LGhpZGU6ZnVuY3Rpb24oYil7YiYmYi5wcmV2ZW50RGVmYXVsdCgpO3ZhciBjPXRoaXM7Yj1hLkV2ZW50KCJoaWRlIiksdGhpcy4kZWxlbWVudC50cmlnZ2VyKGIpO2lmKCF0aGlzLmlzU2hvd258fGIuaXNEZWZhdWx0UHJldmVudGVkKCkpcmV0dXJuO3RoaXMuaXNTaG93bj0hMSx0aGlzLmVzY2FwZSgpLGEoZG9jdW1lbnQpLm9mZigiZm9jdXNpbi5tb2RhbCIpLHRoaXMuJGVsZW1lbnQucmVtb3ZlQ2xhc3MoImluIikuYXR0cigiYXJpYS1oaWRkZW4iLCEwKSxhLnN1cHBvcnQudHJhbnNpdGlvbiYmdGhpcy4kZWxlbWVudC5oYXNDbGFzcygiZmFkZSIpP3RoaXMuaGlkZVdpdGhUcmFuc2l0aW9uKCk6dGhpcy5oaWRlTW9kYWwoKX0sZW5mb3JjZUZvY3VzOmZ1bmN0aW9uKCl7dmFyIGI9dGhpczthKGRvY3VtZW50KS5vbigiZm9jdXNpbi5tb2RhbCIsZnVuY3Rpb24oYSl7Yi4kZWxlbWVudFswXSE9PWEudGFyZ2V0JiYhYi4kZWxlbWVudC5oYXMoYS50YXJnZXQpLmxlbmd0aCYmYi4kZWxlbWVudC5mb2N1cygpfSl9LGVzY2FwZTpmdW5jdGlvbigpe3ZhciBhPXRoaXM7dGhpcy5pc1Nob3duJiZ0aGlzLm9wdGlvbnMua2V5Ym9hcmQ/dGhpcy4kZWxlbWVudC5vbigia2V5dXAuZGlzbWlzcy5tb2RhbCIsZnVuY3Rpb24oYil7Yi53aGljaD09MjcmJmEuaGlkZSgpfSk6dGhpcy5pc1Nob3dufHx0aGlzLiRlbGVtZW50Lm9mZigia2V5dXAuZGlzbWlzcy5tb2RhbCIpfSxoaWRlV2l0aFRyYW5zaXRpb246ZnVuY3Rpb24oKXt2YXIgYj10aGlzLGM9c2V0VGltZW91dChmdW5jdGlvbigpe2IuJGVsZW1lbnQub2ZmKGEuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCksYi5oaWRlTW9kYWwoKX0sNTAwKTt0aGlzLiRlbGVtZW50Lm9uZShhLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZnVuY3Rpb24oKXtjbGVhclRpbWVvdXQoYyksYi5oaWRlTW9kYWwoKX0pfSxoaWRlTW9kYWw6ZnVuY3Rpb24oKXt2YXIgYT10aGlzO3RoaXMuJGVsZW1lbnQuaGlkZSgpLHRoaXMuYmFja2Ryb3AoZnVuY3Rpb24oKXthLnJlbW92ZUJhY2tkcm9wKCksYS4kZWxlbWVudC50cmlnZ2VyKCJoaWRkZW4iKX0pfSxyZW1vdmVCYWNrZHJvcDpmdW5jdGlvbigpe3RoaXMuJGJhY2tkcm9wJiZ0aGlzLiRiYWNrZHJvcC5yZW1vdmUoKSx0aGlzLiRiYWNrZHJvcD1udWxsfSxiYWNrZHJvcDpmdW5jdGlvbihiKXt2YXIgYz10aGlzLGQ9dGhpcy4kZWxlbWVudC5oYXNDbGFzcygiZmFkZSIpPyJmYWRlIjoiIjtpZih0aGlzLmlzU2hvd24mJnRoaXMub3B0aW9ucy5iYWNrZHJvcCl7dmFyIGU9YS5zdXBwb3J0LnRyYW5zaXRpb24mJmQ7dGhpcy4kYmFja2Ryb3A9YSgnPGRpdiBjbGFzcz0ibW9kYWwtYmFja2Ryb3AgJytkKyciIC8+JykuYXBwZW5kVG8oZG9jdW1lbnQuYm9keSksdGhpcy4kYmFja2Ryb3AuY2xpY2sodGhpcy5vcHRpb25zLmJhY2tkcm9wPT0ic3RhdGljIj9hLnByb3h5KHRoaXMuJGVsZW1lbnRbMF0uZm9jdXMsdGhpcy4kZWxlbWVudFswXSk6YS5wcm94eSh0aGlzLmhpZGUsdGhpcykpLGUmJnRoaXMuJGJhY2tkcm9wWzBdLm9mZnNldFdpZHRoLHRoaXMuJGJhY2tkcm9wLmFkZENsYXNzKCJpbiIpO2lmKCFiKXJldHVybjtlP3RoaXMuJGJhY2tkcm9wLm9uZShhLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsYik6YigpfWVsc2UhdGhpcy5pc1Nob3duJiZ0aGlzLiRiYWNrZHJvcD8odGhpcy4kYmFja2Ryb3AucmVtb3ZlQ2xhc3MoImluIiksYS5zdXBwb3J0LnRyYW5zaXRpb24mJnRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoImZhZGUiKT90aGlzLiRiYWNrZHJvcC5vbmUoYS5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGIpOmIoKSk6YiYmYigpfX07dmFyIGM9YS5mbi5tb2RhbDthLmZuLm1vZGFsPWZ1bmN0aW9uKGMpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZD1hKHRoaXMpLGU9ZC5kYXRhKCJtb2RhbCIpLGY9YS5leHRlbmQoe30sYS5mbi5tb2RhbC5kZWZhdWx0cyxkLmRhdGEoKSx0eXBlb2YgYz09Im9iamVjdCImJmMpO2V8fGQuZGF0YSgibW9kYWwiLGU9bmV3IGIodGhpcyxmKSksdHlwZW9mIGM9PSJzdHJpbmciP2VbY10oKTpmLnNob3cmJmUuc2hvdygpfSl9LGEuZm4ubW9kYWwuZGVmYXVsdHM9e2JhY2tkcm9wOiEwLGtleWJvYXJkOiEwLHNob3c6ITB9LGEuZm4ubW9kYWwuQ29uc3RydWN0b3I9YixhLmZuLm1vZGFsLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gYS5mbi5tb2RhbD1jLHRoaXN9LGEoZG9jdW1lbnQpLm9uKCJjbGljay5tb2RhbC5kYXRhLWFwaSIsJ1tkYXRhLXRvZ2dsZT0ibW9kYWwiXScsZnVuY3Rpb24oYil7dmFyIGM9YSh0aGlzKSxkPWMuYXR0cigiaHJlZiIpLGU9YShjLmF0dHIoImRhdGEtdGFyZ2V0Iil8fGQmJmQucmVwbGFjZSgvLiooPz0jW15cc10rJCkvLCIiKSksZj1lLmRhdGEoIm1vZGFsIik/InRvZ2dsZSI6YS5leHRlbmQoe3JlbW90ZTohLyMvLnRlc3QoZCkmJmR9LGUuZGF0YSgpLGMuZGF0YSgpKTtiLnByZXZlbnREZWZhdWx0KCksZS5tb2RhbChmKS5vbmUoImhpZGUiLGZ1bmN0aW9uKCl7Yy5mb2N1cygpfSl9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKGEpe2Z1bmN0aW9uIGQoKXthKCIuZHJvcGRvd24tYmFja2Ryb3AiKS5yZW1vdmUoKSxhKGIpLmVhY2goZnVuY3Rpb24oKXtlKGEodGhpcykpLnJlbW92ZUNsYXNzKCJvcGVuIil9KX1mdW5jdGlvbiBlKGIpe3ZhciBjPWIuYXR0cigiZGF0YS10YXJnZXQiKSxkO2N8fChjPWIuYXR0cigiaHJlZiIpLGM9YyYmLyMvLnRlc3QoYykmJmMucmVwbGFjZSgvLiooPz0jW15cc10qJCkvLCIiKSksZD1jJiZhKGMpO2lmKCFkfHwhZC5sZW5ndGgpZD1iLnBhcmVudCgpO3JldHVybiBkfXZhciBiPSJbZGF0YS10b2dnbGU9ZHJvcGRvd25dIixjPWZ1bmN0aW9uKGIpe3ZhciBjPWEoYikub24oImNsaWNrLmRyb3Bkb3duLmRhdGEtYXBpIix0aGlzLnRvZ2dsZSk7YSgiaHRtbCIpLm9uKCJjbGljay5kcm9wZG93bi5kYXRhLWFwaSIsZnVuY3Rpb24oKXtjLnBhcmVudCgpLnJlbW92ZUNsYXNzKCJvcGVuIil9KX07Yy5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmMsdG9nZ2xlOmZ1bmN0aW9uKGIpe3ZhciBjPWEodGhpcyksZixnO2lmKGMuaXMoIi5kaXNhYmxlZCwgOmRpc2FibGVkIikpcmV0dXJuO3JldHVybiBmPWUoYyksZz1mLmhhc0NsYXNzKCJvcGVuIiksZCgpLGd8fCgib250b3VjaHN0YXJ0ImluIGRvY3VtZW50LmRvY3VtZW50RWxlbWVudCYmYSgnPGRpdiBjbGFzcz0iZHJvcGRvd24tYmFja2Ryb3AiLz4nKS5pbnNlcnRCZWZvcmUoYSh0aGlzKSkub24oImNsaWNrIixkKSxmLnRvZ2dsZUNsYXNzKCJvcGVuIikpLGMuZm9jdXMoKSwhMX0sa2V5ZG93bjpmdW5jdGlvbihjKXt2YXIgZCxmLGcsaCxpLGo7aWYoIS8oMzh8NDB8MjcpLy50ZXN0KGMua2V5Q29kZSkpcmV0dXJuO2Q9YSh0aGlzKSxjLnByZXZlbnREZWZhdWx0KCksYy5zdG9wUHJvcGFnYXRpb24oKTtpZihkLmlzKCIuZGlzYWJsZWQsIDpkaXNhYmxlZCIpKXJldHVybjtoPWUoZCksaT1oLmhhc0NsYXNzKCJvcGVuIik7aWYoIWl8fGkmJmMua2V5Q29kZT09MjcpcmV0dXJuIGMud2hpY2g9PTI3JiZoLmZpbmQoYikuZm9jdXMoKSxkLmNsaWNrKCk7Zj1hKCJbcm9sZT1tZW51XSBsaTpub3QoLmRpdmlkZXIpOnZpc2libGUgYSIsaCk7aWYoIWYubGVuZ3RoKXJldHVybjtqPWYuaW5kZXgoZi5maWx0ZXIoIjpmb2N1cyIpKSxjLmtleUNvZGU9PTM4JiZqPjAmJmotLSxjLmtleUNvZGU9PTQwJiZqPGYubGVuZ3RoLTEmJmorKyx+anx8KGo9MCksZi5lcShqKS5mb2N1cygpfX07dmFyIGY9YS5mbi5kcm9wZG93bjthLmZuLmRyb3Bkb3duPWZ1bmN0aW9uKGIpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZD1hKHRoaXMpLGU9ZC5kYXRhKCJkcm9wZG93biIpO2V8fGQuZGF0YSgiZHJvcGRvd24iLGU9bmV3IGModGhpcykpLHR5cGVvZiBiPT0ic3RyaW5nIiYmZVtiXS5jYWxsKGQpfSl9LGEuZm4uZHJvcGRvd24uQ29uc3RydWN0b3I9YyxhLmZuLmRyb3Bkb3duLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gYS5mbi5kcm9wZG93bj1mLHRoaXN9LGEoZG9jdW1lbnQpLm9uKCJjbGljay5kcm9wZG93bi5kYXRhLWFwaSIsZCkub24oImNsaWNrLmRyb3Bkb3duLmRhdGEtYXBpIiwiLmRyb3Bkb3duIGZvcm0iLGZ1bmN0aW9uKGEpe2Euc3RvcFByb3BhZ2F0aW9uKCl9KS5vbigiY2xpY2suZHJvcGRvd24uZGF0YS1hcGkiLGIsYy5wcm90b3R5cGUudG9nZ2xlKS5vbigia2V5ZG93bi5kcm9wZG93bi5kYXRhLWFwaSIsYisiLCBbcm9sZT1tZW51XSIsYy5wcm90b3R5cGUua2V5ZG93bil9KHdpbmRvdy5qUXVlcnkpLCFmdW5jdGlvbihhKXtmdW5jdGlvbiBiKGIsYyl7dmFyIGQ9YS5wcm94eSh0aGlzLnByb2Nlc3MsdGhpcyksZT1hKGIpLmlzKCJib2R5Iik/YSh3aW5kb3cpOmEoYiksZjt0aGlzLm9wdGlvbnM9YS5leHRlbmQoe30sYS5mbi5zY3JvbGxzcHkuZGVmYXVsdHMsYyksdGhpcy4kc2Nyb2xsRWxlbWVudD1lLm9uKCJzY3JvbGwuc2Nyb2xsLXNweS5kYXRhLWFwaSIsZCksdGhpcy5zZWxlY3Rvcj0odGhpcy5vcHRpb25zLnRhcmdldHx8KGY9YShiKS5hdHRyKCJocmVmIikpJiZmLnJlcGxhY2UoLy4qKD89I1teXHNdKyQpLywiIil8fCIiKSsiIC5uYXYgbGkgPiBhIix0aGlzLiRib2R5PWEoImJvZHkiKSx0aGlzLnJlZnJlc2goKSx0aGlzLnByb2Nlc3MoKX1iLnByb3RvdHlwZT17Y29uc3RydWN0b3I6YixyZWZyZXNoOmZ1bmN0aW9uKCl7dmFyIGI9dGhpcyxjO3RoaXMub2Zmc2V0cz1hKFtdKSx0aGlzLnRhcmdldHM9YShbXSksYz10aGlzLiRib2R5LmZpbmQodGhpcy5zZWxlY3RvcikubWFwKGZ1bmN0aW9uKCl7dmFyIGM9YSh0aGlzKSxkPWMuZGF0YSgidGFyZ2V0Iil8fGMuYXR0cigiaHJlZiIpLGU9L14jXHcvLnRlc3QoZCkmJmEoZCk7cmV0dXJuIGUmJmUubGVuZ3RoJiZbW2UucG9zaXRpb24oKS50b3ArKCFhLmlzV2luZG93KGIuJHNjcm9sbEVsZW1lbnQuZ2V0KDApKSYmYi4kc2Nyb2xsRWxlbWVudC5zY3JvbGxUb3AoKSksZF1dfHxudWxsfSkuc29ydChmdW5jdGlvbihhLGIpe3JldHVybiBhWzBdLWJbMF19KS5lYWNoKGZ1bmN0aW9uKCl7Yi5vZmZzZXRzLnB1c2godGhpc1swXSksYi50YXJnZXRzLnB1c2godGhpc1sxXSl9KX0scHJvY2VzczpmdW5jdGlvbigpe3ZhciBhPXRoaXMuJHNjcm9sbEVsZW1lbnQuc2Nyb2xsVG9wKCkrdGhpcy5vcHRpb25zLm9mZnNldCxiPXRoaXMuJHNjcm9sbEVsZW1lbnRbMF0uc2Nyb2xsSGVpZ2h0fHx0aGlzLiRib2R5WzBdLnNjcm9sbEhlaWdodCxjPWItdGhpcy4kc2Nyb2xsRWxlbWVudC5oZWlnaHQoKSxkPXRoaXMub2Zmc2V0cyxlPXRoaXMudGFyZ2V0cyxmPXRoaXMuYWN0aXZlVGFyZ2V0LGc7aWYoYT49YylyZXR1cm4gZiE9KGc9ZS5sYXN0KClbMF0pJiZ0aGlzLmFjdGl2YXRlKGcpO2ZvcihnPWQubGVuZ3RoO2ctLTspZiE9ZVtnXSYmYT49ZFtnXSYmKCFkW2crMV18fGE8PWRbZysxXSkmJnRoaXMuYWN0aXZhdGUoZVtnXSl9LGFjdGl2YXRlOmZ1bmN0aW9uKGIpe3ZhciBjLGQ7dGhpcy5hY3RpdmVUYXJnZXQ9YixhKHRoaXMuc2VsZWN0b3IpLnBhcmVudCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSxkPXRoaXMuc2VsZWN0b3IrJ1tkYXRhLXRhcmdldD0iJytiKyciXSwnK3RoaXMuc2VsZWN0b3IrJ1tocmVmPSInK2IrJyJdJyxjPWEoZCkucGFyZW50KCJsaSIpLmFkZENsYXNzKCJhY3RpdmUiKSxjLnBhcmVudCgiLmRyb3Bkb3duLW1lbnUiKS5sZW5ndGgmJihjPWMuY2xvc2VzdCgibGkuZHJvcGRvd24iKS5hZGRDbGFzcygiYWN0aXZlIikpLGMudHJpZ2dlcigiYWN0aXZhdGUiKX19O3ZhciBjPWEuZm4uc2Nyb2xsc3B5O2EuZm4uc2Nyb2xsc3B5PWZ1bmN0aW9uKGMpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZD1hKHRoaXMpLGU9ZC5kYXRhKCJzY3JvbGxzcHkiKSxmPXR5cGVvZiBjPT0ib2JqZWN0IiYmYztlfHxkLmRhdGEoInNjcm9sbHNweSIsZT1uZXcgYih0aGlzLGYpKSx0eXBlb2YgYz09InN0cmluZyImJmVbY10oKX0pfSxhLmZuLnNjcm9sbHNweS5Db25zdHJ1Y3Rvcj1iLGEuZm4uc2Nyb2xsc3B5LmRlZmF1bHRzPXtvZmZzZXQ6MTB9LGEuZm4uc2Nyb2xsc3B5Lm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gYS5mbi5zY3JvbGxzcHk9Yyx0aGlzfSxhKHdpbmRvdykub24oImxvYWQiLGZ1bmN0aW9uKCl7YSgnW2RhdGEtc3B5PSJzY3JvbGwiXScpLmVhY2goZnVuY3Rpb24oKXt2YXIgYj1hKHRoaXMpO2Iuc2Nyb2xsc3B5KGIuZGF0YSgpKX0pfSl9KHdpbmRvdy5qUXVlcnkpLCFmdW5jdGlvbihhKXt2YXIgYj1mdW5jdGlvbihiKXt0aGlzLmVsZW1lbnQ9YShiKX07Yi5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmIsc2hvdzpmdW5jdGlvbigpe3ZhciBiPXRoaXMuZWxlbWVudCxjPWIuY2xvc2VzdCgidWw6bm90KC5kcm9wZG93bi1tZW51KSIpLGQ9Yi5hdHRyKCJkYXRhLXRhcmdldCIpLGUsZixnO2R8fChkPWIuYXR0cigiaHJlZiIpLGQ9ZCYmZC5yZXBsYWNlKC8uKig/PSNbXlxzXSokKS8sIiIpKTtpZihiLnBhcmVudCgibGkiKS5oYXNDbGFzcygiYWN0aXZlIikpcmV0dXJuO2U9Yy5maW5kKCIuYWN0aXZlOmxhc3QgYSIpWzBdLGc9YS5FdmVudCgic2hvdyIse3JlbGF0ZWRUYXJnZXQ6ZX0pLGIudHJpZ2dlcihnKTtpZihnLmlzRGVmYXVsdFByZXZlbnRlZCgpKXJldHVybjtmPWEoZCksdGhpcy5hY3RpdmF0ZShiLnBhcmVudCgibGkiKSxjKSx0aGlzLmFjdGl2YXRlKGYsZi5wYXJlbnQoKSxmdW5jdGlvbigpe2IudHJpZ2dlcih7dHlwZToic2hvd24iLHJlbGF0ZWRUYXJnZXQ6ZX0pfSl9LGFjdGl2YXRlOmZ1bmN0aW9uKGIsYyxkKXtmdW5jdGlvbiBnKCl7ZS5yZW1vdmVDbGFzcygiYWN0aXZlIikuZmluZCgiPiAuZHJvcGRvd24tbWVudSA+IC5hY3RpdmUiKS5yZW1vdmVDbGFzcygiYWN0aXZlIiksYi5hZGRDbGFzcygiYWN0aXZlIiksZj8oYlswXS5vZmZzZXRXaWR0aCxiLmFkZENsYXNzKCJpbiIpKTpiLnJlbW92ZUNsYXNzKCJmYWRlIiksYi5wYXJlbnQoIi5kcm9wZG93bi1tZW51IikmJmIuY2xvc2VzdCgibGkuZHJvcGRvd24iKS5hZGRDbGFzcygiYWN0aXZlIiksZCYmZCgpfXZhciBlPWMuZmluZCgiPiAuYWN0aXZlIiksZj1kJiZhLnN1cHBvcnQudHJhbnNpdGlvbiYmZS5oYXNDbGFzcygiZmFkZSIpO2Y/ZS5vbmUoYS5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGcpOmcoKSxlLnJlbW92ZUNsYXNzKCJpbiIpfX07dmFyIGM9YS5mbi50YWI7YS5mbi50YWI9ZnVuY3Rpb24oYyl7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciBkPWEodGhpcyksZT1kLmRhdGEoInRhYiIpO2V8fGQuZGF0YSgidGFiIixlPW5ldyBiKHRoaXMpKSx0eXBlb2YgYz09InN0cmluZyImJmVbY10oKX0pfSxhLmZuLnRhYi5Db25zdHJ1Y3Rvcj1iLGEuZm4udGFiLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gYS5mbi50YWI9Yyx0aGlzfSxhKGRvY3VtZW50KS5vbigiY2xpY2sudGFiLmRhdGEtYXBpIiwnW2RhdGEtdG9nZ2xlPSJ0YWIiXSwgW2RhdGEtdG9nZ2xlPSJwaWxsIl0nLGZ1bmN0aW9uKGIpe2IucHJldmVudERlZmF1bHQoKSxhKHRoaXMpLnRhYigic2hvdyIpfSl9KHdpbmRvdy5qUXVlcnkpLCFmdW5jdGlvbihhKXt2YXIgYj1mdW5jdGlvbihhLGIpe3RoaXMuaW5pdCgidG9vbHRpcCIsYSxiKX07Yi5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmIsaW5pdDpmdW5jdGlvbihiLGMsZCl7dmFyIGUsZixnLGgsaTt0aGlzLnR5cGU9Yix0aGlzLiRlbGVtZW50PWEoYyksdGhpcy5vcHRpb25zPXRoaXMuZ2V0T3B0aW9ucyhkKSx0aGlzLmVuYWJsZWQ9ITAsZz10aGlzLm9wdGlvbnMudHJpZ2dlci5zcGxpdCgiICIpO2ZvcihpPWcubGVuZ3RoO2ktLTspaD1nW2ldLGg9PSJjbGljayI/dGhpcy4kZWxlbWVudC5vbigiY2xpY2suIit0aGlzLnR5cGUsdGhpcy5vcHRpb25zLnNlbGVjdG9yLGEucHJveHkodGhpcy50b2dnbGUsdGhpcykpOmghPSJtYW51YWwiJiYoZT1oPT0iaG92ZXIiPyJtb3VzZWVudGVyIjoiZm9jdXMiLGY9aD09ImhvdmVyIj8ibW91c2VsZWF2ZSI6ImJsdXIiLHRoaXMuJGVsZW1lbnQub24oZSsiLiIrdGhpcy50eXBlLHRoaXMub3B0aW9ucy5zZWxlY3RvcixhLnByb3h5KHRoaXMuZW50ZXIsdGhpcykpLHRoaXMuJGVsZW1lbnQub24oZisiLiIrdGhpcy50eXBlLHRoaXMub3B0aW9ucy5zZWxlY3RvcixhLnByb3h5KHRoaXMubGVhdmUsdGhpcykpKTt0aGlzLm9wdGlvbnMuc2VsZWN0b3I/dGhpcy5fb3B0aW9ucz1hLmV4dGVuZCh7fSx0aGlzLm9wdGlvbnMse3RyaWdnZXI6Im1hbnVhbCIsc2VsZWN0b3I6IiJ9KTp0aGlzLmZpeFRpdGxlKCl9LGdldE9wdGlvbnM6ZnVuY3Rpb24oYil7cmV0dXJuIGI9YS5leHRlbmQoe30sYS5mblt0aGlzLnR5cGVdLmRlZmF1bHRzLHRoaXMuJGVsZW1lbnQuZGF0YSgpLGIpLGIuZGVsYXkmJnR5cGVvZiBiLmRlbGF5PT0ibnVtYmVyIiYmKGIuZGVsYXk9e3Nob3c6Yi5kZWxheSxoaWRlOmIuZGVsYXl9KSxifSxlbnRlcjpmdW5jdGlvbihiKXt2YXIgYz1hLmZuW3RoaXMudHlwZV0uZGVmYXVsdHMsZD17fSxlO3RoaXMuX29wdGlvbnMmJmEuZWFjaCh0aGlzLl9vcHRpb25zLGZ1bmN0aW9uKGEsYil7Y1thXSE9YiYmKGRbYV09Yil9LHRoaXMpLGU9YShiLmN1cnJlbnRUYXJnZXQpW3RoaXMudHlwZV0oZCkuZGF0YSh0aGlzLnR5cGUpO2lmKCFlLm9wdGlvbnMuZGVsYXl8fCFlLm9wdGlvbnMuZGVsYXkuc2hvdylyZXR1cm4gZS5zaG93KCk7Y2xlYXJUaW1lb3V0KHRoaXMudGltZW91dCksZS5ob3ZlclN0YXRlPSJpbiIsdGhpcy50aW1lb3V0PXNldFRpbWVvdXQoZnVuY3Rpb24oKXtlLmhvdmVyU3RhdGU9PSJpbiImJmUuc2hvdygpfSxlLm9wdGlvbnMuZGVsYXkuc2hvdyl9LGxlYXZlOmZ1bmN0aW9uKGIpe3ZhciBjPWEoYi5jdXJyZW50VGFyZ2V0KVt0aGlzLnR5cGVdKHRoaXMuX29wdGlvbnMpLmRhdGEodGhpcy50eXBlKTt0aGlzLnRpbWVvdXQmJmNsZWFyVGltZW91dCh0aGlzLnRpbWVvdXQpO2lmKCFjLm9wdGlvbnMuZGVsYXl8fCFjLm9wdGlvbnMuZGVsYXkuaGlkZSlyZXR1cm4gYy5oaWRlKCk7Yy5ob3ZlclN0YXRlPSJvdXQiLHRoaXMudGltZW91dD1zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7Yy5ob3ZlclN0YXRlPT0ib3V0IiYmYy5oaWRlKCl9LGMub3B0aW9ucy5kZWxheS5oaWRlKX0sc2hvdzpmdW5jdGlvbigpe3ZhciBiLGMsZCxlLGYsZyxoPWEuRXZlbnQoInNob3ciKTtpZih0aGlzLmhhc0NvbnRlbnQoKSYmdGhpcy5lbmFibGVkKXt0aGlzLiRlbGVtZW50LnRyaWdnZXIoaCk7aWYoaC5pc0RlZmF1bHRQcmV2ZW50ZWQoKSlyZXR1cm47Yj10aGlzLnRpcCgpLHRoaXMuc2V0Q29udGVudCgpLHRoaXMub3B0aW9ucy5hbmltYXRpb24mJmIuYWRkQ2xhc3MoImZhZGUiKSxmPXR5cGVvZiB0aGlzLm9wdGlvbnMucGxhY2VtZW50PT0iZnVuY3Rpb24iP3RoaXMub3B0aW9ucy5wbGFjZW1lbnQuY2FsbCh0aGlzLGJbMF0sdGhpcy4kZWxlbWVudFswXSk6dGhpcy5vcHRpb25zLnBsYWNlbWVudCxiLmRldGFjaCgpLmNzcyh7dG9wOjAsbGVmdDowLGRpc3BsYXk6ImJsb2NrIn0pLHRoaXMub3B0aW9ucy5jb250YWluZXI/Yi5hcHBlbmRUbyh0aGlzLm9wdGlvbnMuY29udGFpbmVyKTpiLmluc2VydEFmdGVyKHRoaXMuJGVsZW1lbnQpLGM9dGhpcy5nZXRQb3NpdGlvbigpLGQ9YlswXS5vZmZzZXRXaWR0aCxlPWJbMF0ub2Zmc2V0SGVpZ2h0O3N3aXRjaChmKXtjYXNlImJvdHRvbSI6Zz17dG9wOmMudG9wK2MuaGVpZ2h0LGxlZnQ6Yy5sZWZ0K2Mud2lkdGgvMi1kLzJ9O2JyZWFrO2Nhc2UidG9wIjpnPXt0b3A6Yy50b3AtZSxsZWZ0OmMubGVmdCtjLndpZHRoLzItZC8yfTticmVhaztjYXNlImxlZnQiOmc9e3RvcDpjLnRvcCtjLmhlaWdodC8yLWUvMixsZWZ0OmMubGVmdC1kfTticmVhaztjYXNlInJpZ2h0IjpnPXt0b3A6Yy50b3ArYy5oZWlnaHQvMi1lLzIsbGVmdDpjLmxlZnQrYy53aWR0aH19dGhpcy5hcHBseVBsYWNlbWVudChnLGYpLHRoaXMuJGVsZW1lbnQudHJpZ2dlcigic2hvd24iKX19LGFwcGx5UGxhY2VtZW50OmZ1bmN0aW9uKGEsYil7dmFyIGM9dGhpcy50aXAoKSxkPWNbMF0ub2Zmc2V0V2lkdGgsZT1jWzBdLm9mZnNldEhlaWdodCxmLGcsaCxpO2Mub2Zmc2V0KGEpLmFkZENsYXNzKGIpLmFkZENsYXNzKCJpbiIpLGY9Y1swXS5vZmZzZXRXaWR0aCxnPWNbMF0ub2Zmc2V0SGVpZ2h0LGI9PSJ0b3AiJiZnIT1lJiYoYS50b3A9YS50b3ArZS1nLGk9ITApLGI9PSJib3R0b20ifHxiPT0idG9wIj8oaD0wLGEubGVmdDwwJiYoaD1hLmxlZnQqLTIsYS5sZWZ0PTAsYy5vZmZzZXQoYSksZj1jWzBdLm9mZnNldFdpZHRoLGc9Y1swXS5vZmZzZXRIZWlnaHQpLHRoaXMucmVwbGFjZUFycm93KGgtZCtmLGYsImxlZnQiKSk6dGhpcy5yZXBsYWNlQXJyb3coZy1lLGcsInRvcCIpLGkmJmMub2Zmc2V0KGEpfSxyZXBsYWNlQXJyb3c6ZnVuY3Rpb24oYSxiLGMpe3RoaXMuYXJyb3coKS5jc3MoYyxhPzUwKigxLWEvYikrIiUiOiIiKX0sc2V0Q29udGVudDpmdW5jdGlvbigpe3ZhciBhPXRoaXMudGlwKCksYj10aGlzLmdldFRpdGxlKCk7YS5maW5kKCIudG9vbHRpcC1pbm5lciIpW3RoaXMub3B0aW9ucy5odG1sPyJodG1sIjoidGV4dCJdKGIpLGEucmVtb3ZlQ2xhc3MoImZhZGUgaW4gdG9wIGJvdHRvbSBsZWZ0IHJpZ2h0Iil9LGhpZGU6ZnVuY3Rpb24oKXtmdW5jdGlvbiBlKCl7dmFyIGI9c2V0VGltZW91dChmdW5jdGlvbigpe2Mub2ZmKGEuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCkuZGV0YWNoKCl9LDUwMCk7Yy5vbmUoYS5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGZ1bmN0aW9uKCl7Y2xlYXJUaW1lb3V0KGIpLGMuZGV0YWNoKCl9KX12YXIgYj10aGlzLGM9dGhpcy50aXAoKSxkPWEuRXZlbnQoImhpZGUiKTt0aGlzLiRlbGVtZW50LnRyaWdnZXIoZCk7aWYoZC5pc0RlZmF1bHRQcmV2ZW50ZWQoKSlyZXR1cm47cmV0dXJuIGMucmVtb3ZlQ2xhc3MoImluIiksYS5zdXBwb3J0LnRyYW5zaXRpb24mJnRoaXMuJHRpcC5oYXNDbGFzcygiZmFkZSIpP2UoKTpjLmRldGFjaCgpLHRoaXMuJGVsZW1lbnQudHJpZ2dlcigiaGlkZGVuIiksdGhpc30sZml4VGl0bGU6ZnVuY3Rpb24oKXt2YXIgYT10aGlzLiRlbGVtZW50OyhhLmF0dHIoInRpdGxlIil8fHR5cGVvZiBhLmF0dHIoImRhdGEtb3JpZ2luYWwtdGl0bGUiKSE9InN0cmluZyIpJiZhLmF0dHIoImRhdGEtb3JpZ2luYWwtdGl0bGUiLGEuYXR0cigidGl0bGUiKXx8IiIpLmF0dHIoInRpdGxlIiwiIil9LGhhc0NvbnRlbnQ6ZnVuY3Rpb24oKXtyZXR1cm4gdGhpcy5nZXRUaXRsZSgpfSxnZXRQb3NpdGlvbjpmdW5jdGlvbigpe3ZhciBiPXRoaXMuJGVsZW1lbnRbMF07cmV0dXJuIGEuZXh0ZW5kKHt9LHR5cGVvZiBiLmdldEJvdW5kaW5nQ2xpZW50UmVjdD09ImZ1bmN0aW9uIj9iLmdldEJvdW5kaW5nQ2xpZW50UmVjdCgpOnt3aWR0aDpiLm9mZnNldFdpZHRoLGhlaWdodDpiLm9mZnNldEhlaWdodH0sdGhpcy4kZWxlbWVudC5vZmZzZXQoKSl9LGdldFRpdGxlOmZ1bmN0aW9uKCl7dmFyIGEsYj10aGlzLiRlbGVtZW50LGM9dGhpcy5vcHRpb25zO3JldHVybiBhPWIuYXR0cigiZGF0YS1vcmlnaW5hbC10aXRsZSIpfHwodHlwZW9mIGMudGl0bGU9PSJmdW5jdGlvbiI/Yy50aXRsZS5jYWxsKGJbMF0pOmMudGl0bGUpLGF9LHRpcDpmdW5jdGlvbigpe3JldHVybiB0aGlzLiR0aXA9dGhpcy4kdGlwfHxhKHRoaXMub3B0aW9ucy50ZW1wbGF0ZSl9LGFycm93OmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuJGFycm93PXRoaXMuJGFycm93fHx0aGlzLnRpcCgpLmZpbmQoIi50b29sdGlwLWFycm93Iil9LHZhbGlkYXRlOmZ1bmN0aW9uKCl7dGhpcy4kZWxlbWVudFswXS5wYXJlbnROb2RlfHwodGhpcy5oaWRlKCksdGhpcy4kZWxlbWVudD1udWxsLHRoaXMub3B0aW9ucz1udWxsKX0sZW5hYmxlOmZ1bmN0aW9uKCl7dGhpcy5lbmFibGVkPSEwfSxkaXNhYmxlOmZ1bmN0aW9uKCl7dGhpcy5lbmFibGVkPSExfSx0b2dnbGVFbmFibGVkOmZ1bmN0aW9uKCl7dGhpcy5lbmFibGVkPSF0aGlzLmVuYWJsZWR9LHRvZ2dsZTpmdW5jdGlvbihiKXt2YXIgYz1iP2EoYi5jdXJyZW50VGFyZ2V0KVt0aGlzLnR5cGVdKHRoaXMuX29wdGlvbnMpLmRhdGEodGhpcy50eXBlKTp0aGlzO2MudGlwKCkuaGFzQ2xhc3MoImluIik/Yy5oaWRlKCk6Yy5zaG93KCl9LGRlc3Ryb3k6ZnVuY3Rpb24oKXt0aGlzLmhpZGUoKS4kZWxlbWVudC5vZmYoIi4iK3RoaXMudHlwZSkucmVtb3ZlRGF0YSh0aGlzLnR5cGUpfX07dmFyIGM9YS5mbi50b29sdGlwO2EuZm4udG9vbHRpcD1mdW5jdGlvbihjKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGQ9YSh0aGlzKSxlPWQuZGF0YSgidG9vbHRpcCIpLGY9dHlwZW9mIGM9PSJvYmplY3QiJiZjO2V8fGQuZGF0YSgidG9vbHRpcCIsZT1uZXcgYih0aGlzLGYpKSx0eXBlb2YgYz09InN0cmluZyImJmVbY10oKX0pfSxhLmZuLnRvb2x0aXAuQ29uc3RydWN0b3I9YixhLmZuLnRvb2x0aXAuZGVmYXVsdHM9e2FuaW1hdGlvbjohMCxwbGFjZW1lbnQ6InRvcCIsc2VsZWN0b3I6ITEsdGVtcGxhdGU6JzxkaXYgY2xhc3M9InRvb2x0aXAiPjxkaXYgY2xhc3M9InRvb2x0aXAtYXJyb3ciPjwvZGl2PjxkaXYgY2xhc3M9InRvb2x0aXAtaW5uZXIiPjwvZGl2PjwvZGl2PicsdHJpZ2dlcjoiaG92ZXIgZm9jdXMiLHRpdGxlOiIiLGRlbGF5OjAsaHRtbDohMSxjb250YWluZXI6ITF9LGEuZm4udG9vbHRpcC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7cmV0dXJuIGEuZm4udG9vbHRpcD1jLHRoaXN9fSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oYSl7dmFyIGI9ZnVuY3Rpb24oYSxiKXt0aGlzLmluaXQoInBvcG92ZXIiLGEsYil9O2IucHJvdG90eXBlPWEuZXh0ZW5kKHt9LGEuZm4udG9vbHRpcC5Db25zdHJ1Y3Rvci5wcm90b3R5cGUse2NvbnN0cnVjdG9yOmIsc2V0Q29udGVudDpmdW5jdGlvbigpe3ZhciBhPXRoaXMudGlwKCksYj10aGlzLmdldFRpdGxlKCksYz10aGlzLmdldENvbnRlbnQoKTthLmZpbmQoIi5wb3BvdmVyLXRpdGxlIilbdGhpcy5vcHRpb25zLmh0bWw/Imh0bWwiOiJ0ZXh0Il0oYiksYS5maW5kKCIucG9wb3Zlci1jb250ZW50IilbdGhpcy5vcHRpb25zLmh0bWw/Imh0bWwiOiJ0ZXh0Il0oYyksYS5yZW1vdmVDbGFzcygiZmFkZSB0b3AgYm90dG9tIGxlZnQgcmlnaHQgaW4iKX0saGFzQ29udGVudDpmdW5jdGlvbigpe3JldHVybiB0aGlzLmdldFRpdGxlKCl8fHRoaXMuZ2V0Q29udGVudCgpfSxnZXRDb250ZW50OmZ1bmN0aW9uKCl7dmFyIGEsYj10aGlzLiRlbGVtZW50LGM9dGhpcy5vcHRpb25zO3JldHVybiBhPSh0eXBlb2YgYy5jb250ZW50PT0iZnVuY3Rpb24iP2MuY29udGVudC5jYWxsKGJbMF0pOmMuY29udGVudCl8fGIuYXR0cigiZGF0YS1jb250ZW50IiksYX0sdGlwOmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuJHRpcHx8KHRoaXMuJHRpcD1hKHRoaXMub3B0aW9ucy50ZW1wbGF0ZSkpLHRoaXMuJHRpcH0sZGVzdHJveTpmdW5jdGlvbigpe3RoaXMuaGlkZSgpLiRlbGVtZW50Lm9mZigiLiIrdGhpcy50eXBlKS5yZW1vdmVEYXRhKHRoaXMudHlwZSl9fSk7dmFyIGM9YS5mbi5wb3BvdmVyO2EuZm4ucG9wb3Zlcj1mdW5jdGlvbihjKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGQ9YSh0aGlzKSxlPWQuZGF0YSgicG9wb3ZlciIpLGY9dHlwZW9mIGM9PSJvYmplY3QiJiZjO2V8fGQuZGF0YSgicG9wb3ZlciIsZT1uZXcgYih0aGlzLGYpKSx0eXBlb2YgYz09InN0cmluZyImJmVbY10oKX0pfSxhLmZuLnBvcG92ZXIuQ29uc3RydWN0b3I9YixhLmZuLnBvcG92ZXIuZGVmYXVsdHM9YS5leHRlbmQoe30sYS5mbi50b29sdGlwLmRlZmF1bHRzLHtwbGFjZW1lbnQ6InJpZ2h0Iix0cmlnZ2VyOiJjbGljayIsY29udGVudDoiIix0ZW1wbGF0ZTonPGRpdiBjbGFzcz0icG9wb3ZlciI+PGRpdiBjbGFzcz0iYXJyb3ciPjwvZGl2PjxoMyBjbGFzcz0icG9wb3Zlci10aXRsZSI+PC9oMz48ZGl2IGNsYXNzPSJwb3BvdmVyLWNvbnRlbnQiPjwvZGl2PjwvZGl2Pid9KSxhLmZuLnBvcG92ZXIubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiBhLmZuLnBvcG92ZXI9Yyx0aGlzfX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKGEpe3ZhciBiPWZ1bmN0aW9uKGIsYyl7dGhpcy5vcHRpb25zPWEuZXh0ZW5kKHt9LGEuZm4uYWZmaXguZGVmYXVsdHMsYyksdGhpcy4kd2luZG93PWEod2luZG93KS5vbigic2Nyb2xsLmFmZml4LmRhdGEtYXBpIixhLnByb3h5KHRoaXMuY2hlY2tQb3NpdGlvbix0aGlzKSkub24oImNsaWNrLmFmZml4LmRhdGEtYXBpIixhLnByb3h5KGZ1bmN0aW9uKCl7c2V0VGltZW91dChhLnByb3h5KHRoaXMuY2hlY2tQb3NpdGlvbix0aGlzKSwxKX0sdGhpcykpLHRoaXMuJGVsZW1lbnQ9YShiKSx0aGlzLmNoZWNrUG9zaXRpb24oKX07Yi5wcm90b3R5cGUuY2hlY2tQb3NpdGlvbj1mdW5jdGlvbigpe2lmKCF0aGlzLiRlbGVtZW50LmlzKCI6dmlzaWJsZSIpKXJldHVybjt2YXIgYj1hKGRvY3VtZW50KS5oZWlnaHQoKSxjPXRoaXMuJHdpbmRvdy5zY3JvbGxUb3AoKSxkPXRoaXMuJGVsZW1lbnQub2Zmc2V0KCksZT10aGlzLm9wdGlvbnMub2Zmc2V0LGY9ZS5ib3R0b20sZz1lLnRvcCxoPSJhZmZpeCBhZmZpeC10b3AgYWZmaXgtYm90dG9tIixpO3R5cGVvZiBlIT0ib2JqZWN0IiYmKGY9Zz1lKSx0eXBlb2YgZz09ImZ1bmN0aW9uIiYmKGc9ZS50b3AoKSksdHlwZW9mIGY9PSJmdW5jdGlvbiImJihmPWUuYm90dG9tKCkpLGk9dGhpcy51bnBpbiE9bnVsbCYmYyt0aGlzLnVucGluPD1kLnRvcD8hMTpmIT1udWxsJiZkLnRvcCt0aGlzLiRlbGVtZW50LmhlaWdodCgpPj1iLWY/ImJvdHRvbSI6ZyE9bnVsbCYmYzw9Zz8idG9wIjohMTtpZih0aGlzLmFmZml4ZWQ9PT1pKXJldHVybjt0aGlzLmFmZml4ZWQ9aSx0aGlzLnVucGluPWk9PSJib3R0b20iP2QudG9wLWM6bnVsbCx0aGlzLiRlbGVtZW50LnJlbW92ZUNsYXNzKGgpLmFkZENsYXNzKCJhZmZpeCIrKGk/Ii0iK2k6IiIpKX07dmFyIGM9YS5mbi5hZmZpeDthLmZuLmFmZml4PWZ1bmN0aW9uKGMpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZD1hKHRoaXMpLGU9ZC5kYXRhKCJhZmZpeCIpLGY9dHlwZW9mIGM9PSJvYmplY3QiJiZjO2V8fGQuZGF0YSgiYWZmaXgiLGU9bmV3IGIodGhpcyxmKSksdHlwZW9mIGM9PSJzdHJpbmciJiZlW2NdKCl9KX0sYS5mbi5hZmZpeC5Db25zdHJ1Y3Rvcj1iLGEuZm4uYWZmaXguZGVmYXVsdHM9e29mZnNldDowfSxhLmZuLmFmZml4Lm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gYS5mbi5hZmZpeD1jLHRoaXN9LGEod2luZG93KS5vbigibG9hZCIsZnVuY3Rpb24oKXthKCdbZGF0YS1zcHk9ImFmZml4Il0nKS5lYWNoKGZ1bmN0aW9uKCl7dmFyIGI9YSh0aGlzKSxjPWIuZGF0YSgpO2Mub2Zmc2V0PWMub2Zmc2V0fHx7fSxjLm9mZnNldEJvdHRvbSYmKGMub2Zmc2V0LmJvdHRvbT1jLm9mZnNldEJvdHRvbSksYy5vZmZzZXRUb3AmJihjLm9mZnNldC50b3A9Yy5vZmZzZXRUb3ApLGIuYWZmaXgoYyl9KX0pfSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oYSl7dmFyIGI9J1tkYXRhLWRpc21pc3M9ImFsZXJ0Il0nLGM9ZnVuY3Rpb24oYyl7YShjKS5vbigiY2xpY2siLGIsdGhpcy5jbG9zZSl9O2MucHJvdG90eXBlLmNsb3NlPWZ1bmN0aW9uKGIpe2Z1bmN0aW9uIGYoKXtlLnRyaWdnZXIoImNsb3NlZCIpLnJlbW92ZSgpfXZhciBjPWEodGhpcyksZD1jLmF0dHIoImRhdGEtdGFyZ2V0IiksZTtkfHwoZD1jLmF0dHIoImhyZWYiKSxkPWQmJmQucmVwbGFjZSgvLiooPz0jW15cc10qJCkvLCIiKSksZT1hKGQpLGImJmIucHJldmVudERlZmF1bHQoKSxlLmxlbmd0aHx8KGU9Yy5oYXNDbGFzcygiYWxlcnQiKT9jOmMucGFyZW50KCkpLGUudHJpZ2dlcihiPWEuRXZlbnQoImNsb3NlIikpO2lmKGIuaXNEZWZhdWx0UHJldmVudGVkKCkpcmV0dXJuO2UucmVtb3ZlQ2xhc3MoImluIiksYS5zdXBwb3J0LnRyYW5zaXRpb24mJmUuaGFzQ2xhc3MoImZhZGUiKT9lLm9uKGEuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxmKTpmKCl9O3ZhciBkPWEuZm4uYWxlcnQ7YS5mbi5hbGVydD1mdW5jdGlvbihiKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGQ9YSh0aGlzKSxlPWQuZGF0YSgiYWxlcnQiKTtlfHxkLmRhdGEoImFsZXJ0IixlPW5ldyBjKHRoaXMpKSx0eXBlb2YgYj09InN0cmluZyImJmVbYl0uY2FsbChkKX0pfSxhLmZuLmFsZXJ0LkNvbnN0cnVjdG9yPWMsYS5mbi5hbGVydC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7cmV0dXJuIGEuZm4uYWxlcnQ9ZCx0aGlzfSxhKGRvY3VtZW50KS5vbigiY2xpY2suYWxlcnQuZGF0YS1hcGkiLGIsYy5wcm90b3R5cGUuY2xvc2UpfSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oYSl7dmFyIGI9ZnVuY3Rpb24oYixjKXt0aGlzLiRlbGVtZW50PWEoYiksdGhpcy5vcHRpb25zPWEuZXh0ZW5kKHt9LGEuZm4uYnV0dG9uLmRlZmF1bHRzLGMpfTtiLnByb3RvdHlwZS5zZXRTdGF0ZT1mdW5jdGlvbihhKXt2YXIgYj0iZGlzYWJsZWQiLGM9dGhpcy4kZWxlbWVudCxkPWMuZGF0YSgpLGU9Yy5pcygiaW5wdXQiKT8idmFsIjoiaHRtbCI7YSs9IlRleHQiLGQucmVzZXRUZXh0fHxjLmRhdGEoInJlc2V0VGV4dCIsY1tlXSgpKSxjW2VdKGRbYV18fHRoaXMub3B0aW9uc1thXSksc2V0VGltZW91dChmdW5jdGlvbigpe2E9PSJsb2FkaW5nVGV4dCI/Yy5hZGRDbGFzcyhiKS5hdHRyKGIsYik6Yy5yZW1vdmVDbGFzcyhiKS5yZW1vdmVBdHRyKGIpfSwwKX0sYi5wcm90b3R5cGUudG9nZ2xlPWZ1bmN0aW9uKCl7dmFyIGE9dGhpcy4kZWxlbWVudC5jbG9zZXN0KCdbZGF0YS10b2dnbGU9ImJ1dHRvbnMtcmFkaW8iXScpO2EmJmEuZmluZCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSx0aGlzLiRlbGVtZW50LnRvZ2dsZUNsYXNzKCJhY3RpdmUiKX07dmFyIGM9YS5mbi5idXR0b247YS5mbi5idXR0b249ZnVuY3Rpb24oYyl7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciBkPWEodGhpcyksZT1kLmRhdGEoImJ1dHRvbiIpLGY9dHlwZW9mIGM9PSJvYmplY3QiJiZjO2V8fGQuZGF0YSgiYnV0dG9uIixlPW5ldyBiKHRoaXMsZikpLGM9PSJ0b2dnbGUiP2UudG9nZ2xlKCk6YyYmZS5zZXRTdGF0ZShjKX0pfSxhLmZuLmJ1dHRvbi5kZWZhdWx0cz17bG9hZGluZ1RleHQ6ImxvYWRpbmcuLi4ifSxhLmZuLmJ1dHRvbi5Db25zdHJ1Y3Rvcj1iLGEuZm4uYnV0dG9uLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gYS5mbi5idXR0b249Yyx0aGlzfSxhKGRvY3VtZW50KS5vbigiY2xpY2suYnV0dG9uLmRhdGEtYXBpIiwiW2RhdGEtdG9nZ2xlXj1idXR0b25dIixmdW5jdGlvbihiKXt2YXIgYz1hKGIudGFyZ2V0KTtjLmhhc0NsYXNzKCJidG4iKXx8KGM9Yy5jbG9zZXN0KCIuYnRuIikpLGMuYnV0dG9uKCJ0b2dnbGUiKX0pfSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oYSl7dmFyIGI9ZnVuY3Rpb24oYixjKXt0aGlzLiRlbGVtZW50PWEoYiksdGhpcy5vcHRpb25zPWEuZXh0ZW5kKHt9LGEuZm4uY29sbGFwc2UuZGVmYXVsdHMsYyksdGhpcy5vcHRpb25zLnBhcmVudCYmKHRoaXMuJHBhcmVudD1hKHRoaXMub3B0aW9ucy5wYXJlbnQpKSx0aGlzLm9wdGlvbnMudG9nZ2xlJiZ0aGlzLnRvZ2dsZSgpfTtiLnByb3RvdHlwZT17Y29uc3RydWN0b3I6YixkaW1lbnNpb246ZnVuY3Rpb24oKXt2YXIgYT10aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJ3aWR0aCIpO3JldHVybiBhPyJ3aWR0aCI6ImhlaWdodCJ9LHNob3c6ZnVuY3Rpb24oKXt2YXIgYixjLGQsZTtpZih0aGlzLnRyYW5zaXRpb25pbmd8fHRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoImluIikpcmV0dXJuO2I9dGhpcy5kaW1lbnNpb24oKSxjPWEuY2FtZWxDYXNlKFsic2Nyb2xsIixiXS5qb2luKCItIikpLGQ9dGhpcy4kcGFyZW50JiZ0aGlzLiRwYXJlbnQuZmluZCgiPiAuYWNjb3JkaW9uLWdyb3VwID4gLmluIik7aWYoZCYmZC5sZW5ndGgpe2U9ZC5kYXRhKCJjb2xsYXBzZSIpO2lmKGUmJmUudHJhbnNpdGlvbmluZylyZXR1cm47ZC5jb2xsYXBzZSgiaGlkZSIpLGV8fGQuZGF0YSgiY29sbGFwc2UiLG51bGwpfXRoaXMuJGVsZW1lbnRbYl0oMCksdGhpcy50cmFuc2l0aW9uKCJhZGRDbGFzcyIsYS5FdmVudCgic2hvdyIpLCJzaG93biIpLGEuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50W2JdKHRoaXMuJGVsZW1lbnRbMF1bY10pfSxoaWRlOmZ1bmN0aW9uKCl7dmFyIGI7aWYodGhpcy50cmFuc2l0aW9uaW5nfHwhdGhpcy4kZWxlbWVudC5oYXNDbGFzcygiaW4iKSlyZXR1cm47Yj10aGlzLmRpbWVuc2lvbigpLHRoaXMucmVzZXQodGhpcy4kZWxlbWVudFtiXSgpKSx0aGlzLnRyYW5zaXRpb24oInJlbW92ZUNsYXNzIixhLkV2ZW50KCJoaWRlIiksImhpZGRlbiIpLHRoaXMuJGVsZW1lbnRbYl0oMCl9LHJlc2V0OmZ1bmN0aW9uKGEpe3ZhciBiPXRoaXMuZGltZW5zaW9uKCk7cmV0dXJuIHRoaXMuJGVsZW1lbnQucmVtb3ZlQ2xhc3MoImNvbGxhcHNlIilbYl0oYXx8ImF1dG8iKVswXS5vZmZzZXRXaWR0aCx0aGlzLiRlbGVtZW50W2EhPT1udWxsPyJhZGRDbGFzcyI6InJlbW92ZUNsYXNzIl0oImNvbGxhcHNlIiksdGhpc30sdHJhbnNpdGlvbjpmdW5jdGlvbihiLGMsZCl7dmFyIGU9dGhpcyxmPWZ1bmN0aW9uKCl7Yy50eXBlPT0ic2hvdyImJmUucmVzZXQoKSxlLnRyYW5zaXRpb25pbmc9MCxlLiRlbGVtZW50LnRyaWdnZXIoZCl9O3RoaXMuJGVsZW1lbnQudHJpZ2dlcihjKTtpZihjLmlzRGVmYXVsdFByZXZlbnRlZCgpKXJldHVybjt0aGlzLnRyYW5zaXRpb25pbmc9MSx0aGlzLiRlbGVtZW50W2JdKCJpbiIpLGEuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJjb2xsYXBzZSIpP3RoaXMuJGVsZW1lbnQub25lKGEuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxmKTpmKCl9LHRvZ2dsZTpmdW5jdGlvbigpe3RoaXNbdGhpcy4kZWxlbWVudC5oYXNDbGFzcygiaW4iKT8iaGlkZSI6InNob3ciXSgpfX07dmFyIGM9YS5mbi5jb2xsYXBzZTthLmZuLmNvbGxhcHNlPWZ1bmN0aW9uKGMpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZD1hKHRoaXMpLGU9ZC5kYXRhKCJjb2xsYXBzZSIpLGY9YS5leHRlbmQoe30sYS5mbi5jb2xsYXBzZS5kZWZhdWx0cyxkLmRhdGEoKSx0eXBlb2YgYz09Im9iamVjdCImJmMpO2V8fGQuZGF0YSgiY29sbGFwc2UiLGU9bmV3IGIodGhpcyxmKSksdHlwZW9mIGM9PSJzdHJpbmciJiZlW2NdKCl9KX0sYS5mbi5jb2xsYXBzZS5kZWZhdWx0cz17dG9nZ2xlOiEwfSxhLmZuLmNvbGxhcHNlLkNvbnN0cnVjdG9yPWIsYS5mbi5jb2xsYXBzZS5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7cmV0dXJuIGEuZm4uY29sbGFwc2U9Yyx0aGlzfSxhKGRvY3VtZW50KS5vbigiY2xpY2suY29sbGFwc2UuZGF0YS1hcGkiLCJbZGF0YS10b2dnbGU9Y29sbGFwc2VdIixmdW5jdGlvbihiKXt2YXIgYz1hKHRoaXMpLGQsZT1jLmF0dHIoImRhdGEtdGFyZ2V0Iil8fGIucHJldmVudERlZmF1bHQoKXx8KGQ9Yy5hdHRyKCJocmVmIikpJiZkLnJlcGxhY2UoLy4qKD89I1teXHNdKyQpLywiIiksZj1hKGUpLmRhdGEoImNvbGxhcHNlIik/InRvZ2dsZSI6Yy5kYXRhKCk7Y1thKGUpLmhhc0NsYXNzKCJpbiIpPyJhZGRDbGFzcyI6InJlbW92ZUNsYXNzIl0oImNvbGxhcHNlZCIpLGEoZSkuY29sbGFwc2UoZil9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKGEpe3ZhciBiPWZ1bmN0aW9uKGIsYyl7dGhpcy4kZWxlbWVudD1hKGIpLHRoaXMuJGluZGljYXRvcnM9dGhpcy4kZWxlbWVudC5maW5kKCIuY2Fyb3VzZWwtaW5kaWNhdG9ycyIpLHRoaXMub3B0aW9ucz1jLHRoaXMub3B0aW9ucy5wYXVzZT09ImhvdmVyIiYmdGhpcy4kZWxlbWVudC5vbigibW91c2VlbnRlciIsYS5wcm94eSh0aGlzLnBhdXNlLHRoaXMpKS5vbigibW91c2VsZWF2ZSIsYS5wcm94eSh0aGlzLmN5Y2xlLHRoaXMpKX07Yi5wcm90b3R5cGU9e2N5Y2xlOmZ1bmN0aW9uKGIpe3JldHVybiBifHwodGhpcy5wYXVzZWQ9ITEpLHRoaXMuaW50ZXJ2YWwmJmNsZWFySW50ZXJ2YWwodGhpcy5pbnRlcnZhbCksdGhpcy5vcHRpb25zLmludGVydmFsJiYhdGhpcy5wYXVzZWQmJih0aGlzLmludGVydmFsPXNldEludGVydmFsKGEucHJveHkodGhpcy5uZXh0LHRoaXMpLHRoaXMub3B0aW9ucy5pbnRlcnZhbCkpLHRoaXN9LGdldEFjdGl2ZUluZGV4OmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuJGFjdGl2ZT10aGlzLiRlbGVtZW50LmZpbmQoIi5pdGVtLmFjdGl2ZSIpLHRoaXMuJGl0ZW1zPXRoaXMuJGFjdGl2ZS5wYXJlbnQoKS5jaGlsZHJlbigpLHRoaXMuJGl0ZW1zLmluZGV4KHRoaXMuJGFjdGl2ZSl9LHRvOmZ1bmN0aW9uKGIpe3ZhciBjPXRoaXMuZ2V0QWN0aXZlSW5kZXgoKSxkPXRoaXM7aWYoYj50aGlzLiRpdGVtcy5sZW5ndGgtMXx8YjwwKXJldHVybjtyZXR1cm4gdGhpcy5zbGlkaW5nP3RoaXMuJGVsZW1lbnQub25lKCJzbGlkIixmdW5jdGlvbigpe2QudG8oYil9KTpjPT1iP3RoaXMucGF1c2UoKS5jeWNsZSgpOnRoaXMuc2xpZGUoYj5jPyJuZXh0IjoicHJldiIsYSh0aGlzLiRpdGVtc1tiXSkpfSxwYXVzZTpmdW5jdGlvbihiKXtyZXR1cm4gYnx8KHRoaXMucGF1c2VkPSEwKSx0aGlzLiRlbGVtZW50LmZpbmQoIi5uZXh0LCAucHJldiIpLmxlbmd0aCYmYS5zdXBwb3J0LnRyYW5zaXRpb24uZW5kJiYodGhpcy4kZWxlbWVudC50cmlnZ2VyKGEuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCksdGhpcy5jeWNsZSghMCkpLGNsZWFySW50ZXJ2YWwodGhpcy5pbnRlcnZhbCksdGhpcy5pbnRlcnZhbD1udWxsLHRoaXN9LG5leHQ6ZnVuY3Rpb24oKXtpZih0aGlzLnNsaWRpbmcpcmV0dXJuO3JldHVybiB0aGlzLnNsaWRlKCJuZXh0Iil9LHByZXY6ZnVuY3Rpb24oKXtpZih0aGlzLnNsaWRpbmcpcmV0dXJuO3JldHVybiB0aGlzLnNsaWRlKCJwcmV2Iil9LHNsaWRlOmZ1bmN0aW9uKGIsYyl7dmFyIGQ9dGhpcy4kZWxlbWVudC5maW5kKCIuaXRlbS5hY3RpdmUiKSxlPWN8fGRbYl0oKSxmPXRoaXMuaW50ZXJ2YWwsZz1iPT0ibmV4dCI/ImxlZnQiOiJyaWdodCIsaD1iPT0ibmV4dCI/ImZpcnN0IjoibGFzdCIsaT10aGlzLGo7dGhpcy5zbGlkaW5nPSEwLGYmJnRoaXMucGF1c2UoKSxlPWUubGVuZ3RoP2U6dGhpcy4kZWxlbWVudC5maW5kKCIuaXRlbSIpW2hdKCksaj1hLkV2ZW50KCJzbGlkZSIse3JlbGF0ZWRUYXJnZXQ6ZVswXSxkaXJlY3Rpb246Z30pO2lmKGUuaGFzQ2xhc3MoImFjdGl2ZSIpKXJldHVybjt0aGlzLiRpbmRpY2F0b3JzLmxlbmd0aCYmKHRoaXMuJGluZGljYXRvcnMuZmluZCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSx0aGlzLiRlbGVtZW50Lm9uZSgic2xpZCIsZnVuY3Rpb24oKXt2YXIgYj1hKGkuJGluZGljYXRvcnMuY2hpbGRyZW4oKVtpLmdldEFjdGl2ZUluZGV4KCldKTtiJiZiLmFkZENsYXNzKCJhY3RpdmUiKX0pKTtpZihhLnN1cHBvcnQudHJhbnNpdGlvbiYmdGhpcy4kZWxlbWVudC5oYXNDbGFzcygic2xpZGUiKSl7dGhpcy4kZWxlbWVudC50cmlnZ2VyKGopO2lmKGouaXNEZWZhdWx0UHJldmVudGVkKCkpcmV0dXJuO2UuYWRkQ2xhc3MoYiksZVswXS5vZmZzZXRXaWR0aCxkLmFkZENsYXNzKGcpLGUuYWRkQ2xhc3MoZyksdGhpcy4kZWxlbWVudC5vbmUoYS5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGZ1bmN0aW9uKCl7ZS5yZW1vdmVDbGFzcyhbYixnXS5qb2luKCIgIikpLmFkZENsYXNzKCJhY3RpdmUiKSxkLnJlbW92ZUNsYXNzKFsiYWN0aXZlIixnXS5qb2luKCIgIikpLGkuc2xpZGluZz0hMSxzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7aS4kZWxlbWVudC50cmlnZ2VyKCJzbGlkIil9LDApfSl9ZWxzZXt0aGlzLiRlbGVtZW50LnRyaWdnZXIoaik7aWYoai5pc0RlZmF1bHRQcmV2ZW50ZWQoKSlyZXR1cm47ZC5yZW1vdmVDbGFzcygiYWN0aXZlIiksZS5hZGRDbGFzcygiYWN0aXZlIiksdGhpcy5zbGlkaW5nPSExLHRoaXMuJGVsZW1lbnQudHJpZ2dlcigic2xpZCIpfXJldHVybiBmJiZ0aGlzLmN5Y2xlKCksdGhpc319O3ZhciBjPWEuZm4uY2Fyb3VzZWw7YS5mbi5jYXJvdXNlbD1mdW5jdGlvbihjKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGQ9YSh0aGlzKSxlPWQuZGF0YSgiY2Fyb3VzZWwiKSxmPWEuZXh0ZW5kKHt9LGEuZm4uY2Fyb3VzZWwuZGVmYXVsdHMsdHlwZW9mIGM9PSJvYmplY3QiJiZjKSxnPXR5cGVvZiBjPT0ic3RyaW5nIj9jOmYuc2xpZGU7ZXx8ZC5kYXRhKCJjYXJvdXNlbCIsZT1uZXcgYih0aGlzLGYpKSx0eXBlb2YgYz09Im51bWJlciI/ZS50byhjKTpnP2VbZ10oKTpmLmludGVydmFsJiZlLnBhdXNlKCkuY3ljbGUoKX0pfSxhLmZuLmNhcm91c2VsLmRlZmF1bHRzPXtpbnRlcnZhbDo1ZTMscGF1c2U6ImhvdmVyIn0sYS5mbi5jYXJvdXNlbC5Db25zdHJ1Y3Rvcj1iLGEuZm4uY2Fyb3VzZWwubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiBhLmZuLmNhcm91c2VsPWMsdGhpc30sYShkb2N1bWVudCkub24oImNsaWNrLmNhcm91c2VsLmRhdGEtYXBpIiwiW2RhdGEtc2xpZGVdLCBbZGF0YS1zbGlkZS10b10iLGZ1bmN0aW9uKGIpe3ZhciBjPWEodGhpcyksZCxlPWEoYy5hdHRyKCJkYXRhLXRhcmdldCIpfHwoZD1jLmF0dHIoImhyZWYiKSkmJmQucmVwbGFjZSgvLiooPz0jW15cc10rJCkvLCIiKSksZj1hLmV4dGVuZCh7fSxlLmRhdGEoKSxjLmRhdGEoKSksZztlLmNhcm91c2VsKGYpLChnPWMuYXR0cigiZGF0YS1zbGlkZS10byIpKSYmZS5kYXRhKCJjYXJvdXNlbCIpLnBhdXNlKCkudG8oZykuY3ljbGUoKSxiLnByZXZlbnREZWZhdWx0KCl9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKGEpe3ZhciBiPWZ1bmN0aW9uKGIsYyl7dGhpcy4kZWxlbWVudD1hKGIpLHRoaXMub3B0aW9ucz1hLmV4dGVuZCh7fSxhLmZuLnR5cGVhaGVhZC5kZWZhdWx0cyxjKSx0aGlzLm1hdGNoZXI9dGhpcy5vcHRpb25zLm1hdGNoZXJ8fHRoaXMubWF0Y2hlcix0aGlzLnNvcnRlcj10aGlzLm9wdGlvbnMuc29ydGVyfHx0aGlzLnNvcnRlcix0aGlzLmhpZ2hsaWdodGVyPXRoaXMub3B0aW9ucy5oaWdobGlnaHRlcnx8dGhpcy5oaWdobGlnaHRlcix0aGlzLnVwZGF0ZXI9dGhpcy5vcHRpb25zLnVwZGF0ZXJ8fHRoaXMudXBkYXRlcix0aGlzLnNvdXJjZT10aGlzLm9wdGlvbnMuc291cmNlLHRoaXMuJG1lbnU9YSh0aGlzLm9wdGlvbnMubWVudSksdGhpcy5zaG93bj0hMSx0aGlzLmxpc3RlbigpfTtiLnByb3RvdHlwZT17Y29uc3RydWN0b3I6YixzZWxlY3Q6ZnVuY3Rpb24oKXt2YXIgYT10aGlzLiRtZW51LmZpbmQoIi5hY3RpdmUiKS5hdHRyKCJkYXRhLXZhbHVlIik7cmV0dXJuIHRoaXMuJGVsZW1lbnQudmFsKHRoaXMudXBkYXRlcihhKSkuY2hhbmdlKCksdGhpcy5oaWRlKCl9LHVwZGF0ZXI6ZnVuY3Rpb24oYSl7cmV0dXJuIGF9LHNob3c6ZnVuY3Rpb24oKXt2YXIgYj1hLmV4dGVuZCh7fSx0aGlzLiRlbGVtZW50LnBvc2l0aW9uKCkse2hlaWdodDp0aGlzLiRlbGVtZW50WzBdLm9mZnNldEhlaWdodH0pO3JldHVybiB0aGlzLiRtZW51Lmluc2VydEFmdGVyKHRoaXMuJGVsZW1lbnQpLmNzcyh7dG9wOmIudG9wK2IuaGVpZ2h0LGxlZnQ6Yi5sZWZ0fSkuc2hvdygpLHRoaXMuc2hvd249ITAsdGhpc30saGlkZTpmdW5jdGlvbigpe3JldHVybiB0aGlzLiRtZW51LmhpZGUoKSx0aGlzLnNob3duPSExLHRoaXN9LGxvb2t1cDpmdW5jdGlvbihiKXt2YXIgYztyZXR1cm4gdGhpcy5xdWVyeT10aGlzLiRlbGVtZW50LnZhbCgpLCF0aGlzLnF1ZXJ5fHx0aGlzLnF1ZXJ5Lmxlbmd0aDx0aGlzLm9wdGlvbnMubWluTGVuZ3RoP3RoaXMuc2hvd24/dGhpcy5oaWRlKCk6dGhpczooYz1hLmlzRnVuY3Rpb24odGhpcy5zb3VyY2UpP3RoaXMuc291cmNlKHRoaXMucXVlcnksYS5wcm94eSh0aGlzLnByb2Nlc3MsdGhpcykpOnRoaXMuc291cmNlLGM/dGhpcy5wcm9jZXNzKGMpOnRoaXMpfSxwcm9jZXNzOmZ1bmN0aW9uKGIpe3ZhciBjPXRoaXM7cmV0dXJuIGI9YS5ncmVwKGIsZnVuY3Rpb24oYSl7cmV0dXJuIGMubWF0Y2hlcihhKX0pLGI9dGhpcy5zb3J0ZXIoYiksYi5sZW5ndGg/dGhpcy5yZW5kZXIoYi5zbGljZSgwLHRoaXMub3B0aW9ucy5pdGVtcykpLnNob3coKTp0aGlzLnNob3duP3RoaXMuaGlkZSgpOnRoaXN9LG1hdGNoZXI6ZnVuY3Rpb24oYSl7cmV0dXJufmEudG9Mb3dlckNhc2UoKS5pbmRleE9mKHRoaXMucXVlcnkudG9Mb3dlckNhc2UoKSl9LHNvcnRlcjpmdW5jdGlvbihhKXt2YXIgYj1bXSxjPVtdLGQ9W10sZTt3aGlsZShlPWEuc2hpZnQoKSllLnRvTG93ZXJDYXNlKCkuaW5kZXhPZih0aGlzLnF1ZXJ5LnRvTG93ZXJDYXNlKCkpP35lLmluZGV4T2YodGhpcy5xdWVyeSk/Yy5wdXNoKGUpOmQucHVzaChlKTpiLnB1c2goZSk7cmV0dXJuIGIuY29uY2F0KGMsZCl9LGhpZ2hsaWdodGVyOmZ1bmN0aW9uKGEpe3ZhciBiPXRoaXMucXVlcnkucmVwbGFjZSgvW1wtXFtcXXt9KCkqKz8uLFxcXF4kfCNcc10vZywiXFwkJiIpO3JldHVybiBhLnJlcGxhY2UobmV3IFJlZ0V4cCgiKCIrYisiKSIsImlnIiksZnVuY3Rpb24oYSxiKXtyZXR1cm4iPHN0cm9uZz4iK2IrIjwvc3Ryb25nPiJ9KX0scmVuZGVyOmZ1bmN0aW9uKGIpe3ZhciBjPXRoaXM7cmV0dXJuIGI9YShiKS5tYXAoZnVuY3Rpb24oYixkKXtyZXR1cm4gYj1hKGMub3B0aW9ucy5pdGVtKS5hdHRyKCJkYXRhLXZhbHVlIixkKSxiLmZpbmQoImEiKS5odG1sKGMuaGlnaGxpZ2h0ZXIoZCkpLGJbMF19KSxiLmZpcnN0KCkuYWRkQ2xhc3MoImFjdGl2ZSIpLHRoaXMuJG1lbnUuaHRtbChiKSx0aGlzfSxuZXh0OmZ1bmN0aW9uKGIpe3ZhciBjPXRoaXMuJG1lbnUuZmluZCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSxkPWMubmV4dCgpO2QubGVuZ3RofHwoZD1hKHRoaXMuJG1lbnUuZmluZCgibGkiKVswXSkpLGQuYWRkQ2xhc3MoImFjdGl2ZSIpfSxwcmV2OmZ1bmN0aW9uKGEpe3ZhciBiPXRoaXMuJG1lbnUuZmluZCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSxjPWIucHJldigpO2MubGVuZ3RofHwoYz10aGlzLiRtZW51LmZpbmQoImxpIikubGFzdCgpKSxjLmFkZENsYXNzKCJhY3RpdmUiKX0sbGlzdGVuOmZ1bmN0aW9uKCl7dGhpcy4kZWxlbWVudC5vbigiZm9jdXMiLGEucHJveHkodGhpcy5mb2N1cyx0aGlzKSkub24oImJsdXIiLGEucHJveHkodGhpcy5ibHVyLHRoaXMpKS5vbigia2V5cHJlc3MiLGEucHJveHkodGhpcy5rZXlwcmVzcyx0aGlzKSkub24oImtleXVwIixhLnByb3h5KHRoaXMua2V5dXAsdGhpcykpLHRoaXMuZXZlbnRTdXBwb3J0ZWQoImtleWRvd24iKSYmdGhpcy4kZWxlbWVudC5vbigia2V5ZG93biIsYS5wcm94eSh0aGlzLmtleWRvd24sdGhpcykpLHRoaXMuJG1lbnUub24oImNsaWNrIixhLnByb3h5KHRoaXMuY2xpY2ssdGhpcykpLm9uKCJtb3VzZWVudGVyIiwibGkiLGEucHJveHkodGhpcy5tb3VzZWVudGVyLHRoaXMpKS5vbigibW91c2VsZWF2ZSIsImxpIixhLnByb3h5KHRoaXMubW91c2VsZWF2ZSx0aGlzKSl9LGV2ZW50U3VwcG9ydGVkOmZ1bmN0aW9uKGEpe3ZhciBiPWEgaW4gdGhpcy4kZWxlbWVudDtyZXR1cm4gYnx8KHRoaXMuJGVsZW1lbnQuc2V0QXR0cmlidXRlKGEsInJldHVybjsiKSxiPXR5cGVvZiB0aGlzLiRlbGVtZW50W2FdPT0iZnVuY3Rpb24iKSxifSxtb3ZlOmZ1bmN0aW9uKGEpe2lmKCF0aGlzLnNob3duKXJldHVybjtzd2l0Y2goYS5rZXlDb2RlKXtjYXNlIDk6Y2FzZSAxMzpjYXNlIDI3OmEucHJldmVudERlZmF1bHQoKTticmVhaztjYXNlIDM4OmEucHJldmVudERlZmF1bHQoKSx0aGlzLnByZXYoKTticmVhaztjYXNlIDQwOmEucHJldmVudERlZmF1bHQoKSx0aGlzLm5leHQoKX1hLnN0b3BQcm9wYWdhdGlvbigpfSxrZXlkb3duOmZ1bmN0aW9uKGIpe3RoaXMuc3VwcHJlc3NLZXlQcmVzc1JlcGVhdD1+YS5pbkFycmF5KGIua2V5Q29kZSxbNDAsMzgsOSwxMywyN10pLHRoaXMubW92ZShiKX0sa2V5cHJlc3M6ZnVuY3Rpb24oYSl7aWYodGhpcy5zdXBwcmVzc0tleVByZXNzUmVwZWF0KXJldHVybjt0aGlzLm1vdmUoYSl9LGtleXVwOmZ1bmN0aW9uKGEpe3N3aXRjaChhLmtleUNvZGUpe2Nhc2UgNDA6Y2FzZSAzODpjYXNlIDE2OmNhc2UgMTc6Y2FzZSAxODpicmVhaztjYXNlIDk6Y2FzZSAxMzppZighdGhpcy5zaG93bilyZXR1cm47dGhpcy5zZWxlY3QoKTticmVhaztjYXNlIDI3OmlmKCF0aGlzLnNob3duKXJldHVybjt0aGlzLmhpZGUoKTticmVhaztkZWZhdWx0OnRoaXMubG9va3VwKCl9YS5zdG9wUHJvcGFnYXRpb24oKSxhLnByZXZlbnREZWZhdWx0KCl9LGZvY3VzOmZ1bmN0aW9uKGEpe3RoaXMuZm9jdXNlZD0hMH0sYmx1cjpmdW5jdGlvbihhKXt0aGlzLmZvY3VzZWQ9ITEsIXRoaXMubW91c2Vkb3ZlciYmdGhpcy5zaG93biYmdGhpcy5oaWRlKCl9LGNsaWNrOmZ1bmN0aW9uKGEpe2Euc3RvcFByb3BhZ2F0aW9uKCksYS5wcmV2ZW50RGVmYXVsdCgpLHRoaXMuc2VsZWN0KCksdGhpcy4kZWxlbWVudC5mb2N1cygpfSxtb3VzZWVudGVyOmZ1bmN0aW9uKGIpe3RoaXMubW91c2Vkb3Zlcj0hMCx0aGlzLiRtZW51LmZpbmQoIi5hY3RpdmUiKS5yZW1vdmVDbGFzcygiYWN0aXZlIiksYShiLmN1cnJlbnRUYXJnZXQpLmFkZENsYXNzKCJhY3RpdmUiKX0sbW91c2VsZWF2ZTpmdW5jdGlvbihhKXt0aGlzLm1vdXNlZG92ZXI9ITEsIXRoaXMuZm9jdXNlZCYmdGhpcy5zaG93biYmdGhpcy5oaWRlKCl9fTt2YXIgYz1hLmZuLnR5cGVhaGVhZDthLmZuLnR5cGVhaGVhZD1mdW5jdGlvbihjKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGQ9YSh0aGlzKSxlPWQuZGF0YSgidHlwZWFoZWFkIiksZj10eXBlb2YgYz09Im9iamVjdCImJmM7ZXx8ZC5kYXRhKCJ0eXBlYWhlYWQiLGU9bmV3IGIodGhpcyxmKSksdHlwZW9mIGM9PSJzdHJpbmciJiZlW2NdKCl9KX0sYS5mbi50eXBlYWhlYWQuZGVmYXVsdHM9e3NvdXJjZTpbXSxpdGVtczo4LG1lbnU6Jzx1bCBjbGFzcz0idHlwZWFoZWFkIGRyb3Bkb3duLW1lbnUiPjwvdWw+JyxpdGVtOic8bGk+PGEgaHJlZj0iIyI+PC9hPjwvbGk+JyxtaW5MZW5ndGg6MX0sYS5mbi50eXBlYWhlYWQuQ29uc3RydWN0b3I9YixhLmZuLnR5cGVhaGVhZC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7cmV0dXJuIGEuZm4udHlwZWFoZWFkPWMsdGhpc30sYShkb2N1bWVudCkub24oImZvY3VzLnR5cGVhaGVhZC5kYXRhLWFwaSIsJ1tkYXRhLXByb3ZpZGU9InR5cGVhaGVhZCJdJyxmdW5jdGlvbihiKXt2YXIgYz1hKHRoaXMpO2lmKGMuZGF0YSgidHlwZWFoZWFkIikpcmV0dXJuO2MudHlwZWFoZWFkKGMuZGF0YSgpKX0pfSh3aW5kb3cualF1ZXJ5KQ==';    	
	if(!file_exists('js/script.js')) {
		if($h=@fopen('js/script.js','w')) { fputs($h,base64_decode($js_script));fclose($h); }
	}
	if(!file_exists('js/bootstrap.js')) {
		if($h=@fopen('js/bootstrap.js','w')) { fputs($h,base64_decode($js_bootstrap));fclose($h); }
	}	
}
/**
*
* CRÉATION DES FEUILLES DE STYLE (css)
*/
function mkcss() {
	global $cNames,$cVals;
    // Bootstrap v2.3.2	   
    $css =   'LyohDQogKiBCb290c3RyYXAgdjIuMy4yDQogKg0KICogQ29weXJpZ2h0IDIwMTIgVHdpdHRlciwgSW5jDQogKiBMaWNlbnNlZCB1bmRlciB0aGUgQXBhY2hlIExpY2Vuc2UgdjIuMA0KICogaHR0cDovL3d3dy5hcGFjaGUub3JnL2xpY2Vuc2VzL0xJQ0VOU0UtMi4wDQogKg0KICogRGVzaWduZWQgYW5kIGJ1aWx0IHdpdGggYWxsIHRoZSBsb3ZlIGluIHRoZSB3b3JsZCBAdHdpdHRlciBieSBAbWRvIGFuZCBAZmF0Lg0KICovDQouY2xlYXJmaXh7Knpvb206MTt9LmNsZWFyZml4OmJlZm9yZSwuY2xlYXJmaXg6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLmNsZWFyZml4OmFmdGVye2NsZWFyOmJvdGg7fQ0KLmhpZGUtdGV4dHtmb250OjAvMCBhO2NvbG9yOnRyYW5zcGFyZW50O3RleHQtc2hhZG93Om5vbmU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXI6MDt9DQouaW5wdXQtYmxvY2stbGV2ZWx7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3g7fQ0KYXJ0aWNsZSxhc2lkZSxkZXRhaWxzLGZpZ2NhcHRpb24sZmlndXJlLGZvb3RlcixoZWFkZXIsaGdyb3VwLG5hdixzZWN0aW9ue2Rpc3BsYXk6YmxvY2s7fQ0KYXVkaW8sY2FudmFzLHZpZGVve2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxO30NCmF1ZGlvOm5vdChbY29udHJvbHNdKXtkaXNwbGF5Om5vbmU7fQ0KaHRtbHtmb250LXNpemU6MTAwJTstd2Via2l0LXRleHQtc2l6ZS1hZGp1c3Q6MTAwJTstbXMtdGV4dC1zaXplLWFkanVzdDoxMDAlO30NCmE6Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHg7fQ0KYTpob3ZlcixhOmFjdGl2ZXtvdXRsaW5lOjA7fQ0Kc3ViLHN1cHtwb3NpdGlvbjpyZWxhdGl2ZTtmb250LXNpemU6NzUlO2xpbmUtaGVpZ2h0OjA7dmVydGljYWwtYWxpZ246YmFzZWxpbmU7fQ0Kc3Vwe3RvcDotMC41ZW07fQ0Kc3Vie2JvdHRvbTotMC4yNWVtO30NCmltZ3ttYXgtd2lkdGg6MTAwJTt3aWR0aDphdXRvXDk7aGVpZ2h0OmF1dG87dmVydGljYWwtYWxpZ246bWlkZGxlO2JvcmRlcjowOy1tcy1pbnRlcnBvbGF0aW9uLW1vZGU6YmljdWJpYzt9DQojbWFwX2NhbnZhcyBpbWcsLmdvb2dsZS1tYXBzIGltZ3ttYXgtd2lkdGg6bm9uZTt9DQpidXR0b24saW5wdXQsc2VsZWN0LHRleHRhcmVhe21hcmdpbjowO2ZvbnQtc2l6ZToxMDAlO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTt9DQpidXR0b24saW5wdXR7Km92ZXJmbG93OnZpc2libGU7bGluZS1oZWlnaHQ6bm9ybWFsO30NCmJ1dHRvbjo6LW1vei1mb2N1cy1pbm5lcixpbnB1dDo6LW1vei1mb2N1cy1pbm5lcntwYWRkaW5nOjA7Ym9yZGVyOjA7fQ0KYnV0dG9uLGh0bWwgaW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXXstd2Via2l0LWFwcGVhcmFuY2U6YnV0dG9uO2N1cnNvcjpwb2ludGVyO30NCmxhYmVsLHNlbGVjdCxidXR0b24saW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXSxpbnB1dFt0eXBlPSJyYWRpbyJdLGlucHV0W3R5cGU9ImNoZWNrYm94Il17Y3Vyc29yOnBvaW50ZXI7fQ0KaW5wdXRbdHlwZT0ic2VhcmNoIl17LXdlYmtpdC1ib3gtc2l6aW5nOmNvbnRlbnQtYm94Oy1tb3otYm94LXNpemluZzpjb250ZW50LWJveDtib3gtc2l6aW5nOmNvbnRlbnQtYm94Oy13ZWJraXQtYXBwZWFyYW5jZTp0ZXh0ZmllbGQ7fQ0KaW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWRlY29yYXRpb24saW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWNhbmNlbC1idXR0b257LXdlYmtpdC1hcHBlYXJhbmNlOm5vbmU7fQ0KdGV4dGFyZWF7b3ZlcmZsb3c6YXV0bzt2ZXJ0aWNhbC1hbGlnbjp0b3A7fQ0KQG1lZGlhIHByaW50eyp7dGV4dC1zaGFkb3c6bm9uZSAhaW1wb3J0YW50O2NvbG9yOiMwMDAgIWltcG9ydGFudDtiYWNrZ3JvdW5kOnRyYW5zcGFyZW50ICFpbXBvcnRhbnQ7Ym94LXNoYWRvdzpub25lICFpbXBvcnRhbnQ7fSBhLGE6dmlzaXRlZHt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lO30gYVtocmVmXTphZnRlcntjb250ZW50OiIgKCIgYXR0cihocmVmKSAiKSI7fSBhYmJyW3RpdGxlXTphZnRlcntjb250ZW50OiIgKCIgYXR0cih0aXRsZSkgIikiO30gLmlyIGE6YWZ0ZXIsYVtocmVmXj0iamF2YXNjcmlwdDoiXTphZnRlcixhW2hyZWZePSIjIl06YWZ0ZXJ7Y29udGVudDoiIjt9IHByZSxibG9ja3F1b3Rle2JvcmRlcjoxcHggc29saWQgIzk5OTtwYWdlLWJyZWFrLWluc2lkZTphdm9pZDt9IHRoZWFke2Rpc3BsYXk6dGFibGUtaGVhZGVyLWdyb3VwO30gdHIsaW1ne3BhZ2UtYnJlYWstaW5zaWRlOmF2b2lkO30gaW1ne21heC13aWR0aDoxMDAlICFpbXBvcnRhbnQ7fSBAcGFnZSB7bWFyZ2luOjAuNWNtO31wLGgyLGgze29ycGhhbnM6Mzt3aWRvd3M6Mzt9IGgyLGgze3BhZ2UtYnJlYWstYWZ0ZXI6YXZvaWQ7fX1ib2R5e21hcmdpbjowO2ZvbnQtZmFtaWx5OiJIZWx2ZXRpY2EgTmV1ZSIsSGVsdmV0aWNhLEFyaWFsLHNhbnMtc2VyaWY7Zm9udC1zaXplOjE0cHg7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojMzMzMzMzO2JhY2tncm91bmQtY29sb3I6I2ZmZmZmZjt9DQphe2NvbG9yOiMwMDg4Y2M7dGV4dC1kZWNvcmF0aW9uOm5vbmU7fQ0KYTpob3ZlcixhOmZvY3Vze2NvbG9yOiMwMDU1ODA7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZTt9DQouaW1nLXJvdW5kZWR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4O30NCi5pbWctcG9sYXJvaWR7cGFkZGluZzo0cHg7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwgMCwgMCwgMC4yKTstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xKTstbW96LWJveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xKTtib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMSk7fQ0KLmltZy1jaXJjbGV7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjUwMHB4Oy1tb3otYm9yZGVyLXJhZGl1czo1MDBweDtib3JkZXItcmFkaXVzOjUwMHB4O30NCi5yb3d7bWFyZ2luLWxlZnQ6LTIwcHg7Knpvb206MTt9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoucm93OmFmdGVye2NsZWFyOmJvdGg7fQ0KW2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MjBweDt9DQouY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDo5NDBweDt9DQouc3BhbjEye3dpZHRoOjk0MHB4O30NCi5zcGFuMTF7d2lkdGg6ODYwcHg7fQ0KLnNwYW4xMHt3aWR0aDo3ODBweDt9DQouc3Bhbjl7d2lkdGg6NzAwcHg7fQ0KLnNwYW44e3dpZHRoOjYyMHB4O30NCi5zcGFuN3t3aWR0aDo1NDBweDt9DQouc3BhbjZ7d2lkdGg6NDYwcHg7fQ0KLnNwYW41e3dpZHRoOjM4MHB4O30NCi5zcGFuNHt3aWR0aDozMDBweDt9DQouc3BhbjN7d2lkdGg6MjIwcHg7fQ0KLnNwYW4ye3dpZHRoOjE0MHB4O30NCi5zcGFuMXt3aWR0aDo2MHB4O30NCi5vZmZzZXQxMnttYXJnaW4tbGVmdDo5ODBweDt9DQoub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTAwcHg7fQ0KLm9mZnNldDEwe21hcmdpbi1sZWZ0OjgyMHB4O30NCi5vZmZzZXQ5e21hcmdpbi1sZWZ0Ojc0MHB4O30NCi5vZmZzZXQ4e21hcmdpbi1sZWZ0OjY2MHB4O30NCi5vZmZzZXQ3e21hcmdpbi1sZWZ0OjU4MHB4O30NCi5vZmZzZXQ2e21hcmdpbi1sZWZ0OjUwMHB4O30NCi5vZmZzZXQ1e21hcmdpbi1sZWZ0OjQyMHB4O30NCi5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM0MHB4O30NCi5vZmZzZXQze21hcmdpbi1sZWZ0OjI2MHB4O30NCi5vZmZzZXQye21hcmdpbi1sZWZ0OjE4MHB4O30NCi5vZmZzZXQxe21hcmdpbi1sZWZ0OjEwMHB4O30NCi5yb3ctZmx1aWR7d2lkdGg6MTAwJTsqem9vbToxO30ucm93LWZsdWlkOmJlZm9yZSwucm93LWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5yb3ctZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQoucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4Oy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDtmbG9hdDpsZWZ0O21hcmdpbi1sZWZ0OjIuMTI3NjU5NTc0NDY4MDg1JTsqbWFyZ2luLWxlZnQ6Mi4wNzQ0NjgwODUxMDYzODMlO30NCi5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7fQ0KLnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6Mi4xMjc2NTk1NzQ0NjgwODUlO30NCi5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSU7fQ0KLnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQ4OTM2MTcwMjEyNzY1JTsqd2lkdGg6OTEuNDM2MTcwMjEyNzY1OTQlO30NCi5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi45Nzg3MjM0MDQyNTUzMiU7KndpZHRoOjgyLjkyNTUzMTkxNDg5MzYxJTt9DQoucm93LWZsdWlkIC5zcGFuOXt3aWR0aDo3NC40NjgwODUxMDYzODI5NyU7KndpZHRoOjc0LjQxNDg5MzYxNzAyMTI2JTt9DQoucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS45NTc0NDY4MDg1MTA2NCU7KndpZHRoOjY1LjkwNDI1NTMxOTE0ODkzJTt9DQoucm93LWZsdWlkIC5zcGFuN3t3aWR0aDo1Ny40NDY4MDg1MTA2MzgyOSU7KndpZHRoOjU3LjM5MzYxNzAyMTI3NjU5JTt9DQoucm93LWZsdWlkIC5zcGFuNnt3aWR0aDo0OC45MzYxNzAyMTI3NjU5NSU7KndpZHRoOjQ4Ljg4Mjk3ODcyMzQwNDI1JTt9DQoucm93LWZsdWlkIC5zcGFuNXt3aWR0aDo0MC40MjU1MzE5MTQ4OTM2MiU7KndpZHRoOjQwLjM3MjM0MDQyNTUzMTkyJTt9DQoucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS45MTQ4OTM2MTcwMjEyNzglOyp3aWR0aDozMS44NjE3MDIxMjc2NTk1NzYlO30NCi5yb3ctZmx1aWQgLnNwYW4ze3dpZHRoOjIzLjQwNDI1NTMxOTE0ODkzNCU7KndpZHRoOjIzLjM1MTA2MzgyOTc4NzIzMyU7fQ0KLnJvdy1mbHVpZCAuc3BhbjJ7d2lkdGg6MTQuODkzNjE3MDIxMjc2NTk1JTsqd2lkdGg6MTQuODQwNDI1NTMxOTE0ODk0JTt9DQoucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo2LjM4Mjk3ODcyMzQwNDI1NSU7KndpZHRoOjYuMzI5Nzg3MjM0MDQyNTUzJTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMDQuMjU1MzE5MTQ4OTM2MTclOyptYXJnaW4tbGVmdDoxMDQuMTQ4OTM2MTcwMjEyNzUlO30NCi5yb3ctZmx1aWQgLm9mZnNldDEyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjEwMi4xMjc2NTk1NzQ0NjgwOCU7Km1hcmdpbi1sZWZ0OjEwMi4wMjEyNzY1OTU3NDQ2NyU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTUuNzQ0NjgwODUxMDYzODIlOyptYXJnaW4tbGVmdDo5NS42MzgyOTc4NzIzNDA0JTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo5My42MTcwMjEyNzY1OTU3NCU7Km1hcmdpbi1sZWZ0OjkzLjUxMDYzODI5Nzg3MjMyJTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMHttYXJnaW4tbGVmdDo4Ny4yMzQwNDI1NTMxOTE0OSU7Km1hcmdpbi1sZWZ0Ojg3LjEyNzY1OTU3NDQ2ODA3JTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4NS4xMDYzODI5Nzg3MjM0JTsqbWFyZ2luLWxlZnQ6ODQuOTk5OTk5OTk5OTk5OTklO30NCi5yb3ctZmx1aWQgLm9mZnNldDl7bWFyZ2luLWxlZnQ6NzguNzIzNDA0MjU1MzE5MTQlOyptYXJnaW4tbGVmdDo3OC42MTcwMjEyNzY1OTU3MiU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ni41OTU3NDQ2ODA4NTEwNiU7Km1hcmdpbi1sZWZ0Ojc2LjQ4OTM2MTcwMjEyNzY0JTt9DQoucm93LWZsdWlkIC5vZmZzZXQ4e21hcmdpbi1sZWZ0OjcwLjIxMjc2NTk1NzQ0NjglOyptYXJnaW4tbGVmdDo3MC4xMDYzODI5Nzg3MjMzOSU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC4wODUxMDYzODI5Nzg3MiU7Km1hcmdpbi1sZWZ0OjY3Ljk3ODcyMzQwNDI1NTMlO30NCi5yb3ctZmx1aWQgLm9mZnNldDd7bWFyZ2luLWxlZnQ6NjEuNzAyMTI3NjU5NTc0NDYlOyptYXJnaW4tbGVmdDo2MS41OTU3NDQ2ODA4NTEwNiU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo1OS41NzQ0NjgwODUxMDYzNzUlOyptYXJnaW4tbGVmdDo1OS40NjgwODUxMDYzODI5NyU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NnttYXJnaW4tbGVmdDo1My4xOTE0ODkzNjE3MDIxMjUlOyptYXJnaW4tbGVmdDo1My4wODUxMDYzODI5Nzg3MTUlO30NCi5yb3ctZmx1aWQgLm9mZnNldDY6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTEuMDYzODI5Nzg3MjM0MDM1JTsqbWFyZ2luLWxlZnQ6NTAuOTU3NDQ2ODA4NTEwNjMlO30NCi5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDQuNjgwODUxMDYzODI5NzklOyptYXJnaW4tbGVmdDo0NC41NzQ0NjgwODUxMDYzOCU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi41NTMxOTE0ODkzNjE3JTsqbWFyZ2luLWxlZnQ6NDIuNDQ2ODA4NTEwNjM4MyU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NHttYXJnaW4tbGVmdDozNi4xNzAyMTI3NjU5NTc0NDQlOyptYXJnaW4tbGVmdDozNi4wNjM4Mjk3ODcyMzQwNSU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDozNC4wNDI1NTMxOTE0ODkzNiU7Km1hcmdpbi1sZWZ0OjMzLjkzNjE3MDIxMjc2NTk2JTt9DQoucm93LWZsdWlkIC5vZmZzZXQze21hcmdpbi1sZWZ0OjI3LjY1OTU3NDQ2ODA4NTEwNCU7Km1hcmdpbi1sZWZ0OjI3LjU1MzE5MTQ4OTM2MTclO30NCi5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNTMxOTE0ODkzNjE3MDIlOyptYXJnaW4tbGVmdDoyNS40MjU1MzE5MTQ4OTM2MTglO30NCi5yb3ctZmx1aWQgLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTkuMTQ4OTM2MTcwMjEyNzY0JTsqbWFyZ2luLWxlZnQ6MTkuMDQyNTUzMTkxNDg5MzYlO30NCi5yb3ctZmx1aWQgLm9mZnNldDI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTcuMDIxMjc2NTk1NzQ0NjglOyptYXJnaW4tbGVmdDoxNi45MTQ4OTM2MTcwMjEyNzglO30NCi5yb3ctZmx1aWQgLm9mZnNldDF7bWFyZ2luLWxlZnQ6MTAuNjM4Mjk3ODcyMzQwNDI1JTsqbWFyZ2luLWxlZnQ6MTAuNTMxOTE0ODkzNjE3MDIlO30NCi5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41MTA2MzgyOTc4NzIzNCU7Km1hcmdpbi1sZWZ0OjguNDA0MjU1MzE5MTQ4OTM4JTt9DQpbY2xhc3MqPSJzcGFuIl0uaGlkZSwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXS5oaWRle2Rpc3BsYXk6bm9uZTt9DQpbY2xhc3MqPSJzcGFuIl0ucHVsbC1yaWdodCwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXS5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O30NCi5jb250YWluZXJ7bWFyZ2luLXJpZ2h0OmF1dG87bWFyZ2luLWxlZnQ6YXV0bzsqem9vbToxO30uY29udGFpbmVyOmJlZm9yZSwuY29udGFpbmVyOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5jb250YWluZXI6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQouY29udGFpbmVyLWZsdWlke3BhZGRpbmctcmlnaHQ6MjBweDtwYWRkaW5nLWxlZnQ6MjBweDsqem9vbToxO30uY29udGFpbmVyLWZsdWlkOmJlZm9yZSwuY29udGFpbmVyLWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5jb250YWluZXItZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQpwe21hcmdpbjowIDAgMTBweDt9DQoubGVhZHttYXJnaW4tYm90dG9tOjIwcHg7Zm9udC1zaXplOjIxcHg7Zm9udC13ZWlnaHQ6MjAwO2xpbmUtaGVpZ2h0OjMwcHg7fQ0Kc21hbGx7Zm9udC1zaXplOjg1JTt9DQpzdHJvbmd7Zm9udC13ZWlnaHQ6Ym9sZDt9DQplbXtmb250LXN0eWxlOml0YWxpYzt9DQpjaXRle2ZvbnQtc3R5bGU6bm9ybWFsO30NCi5tdXRlZHtjb2xvcjojOTk5OTk5O30NCmEubXV0ZWQ6aG92ZXIsYS5tdXRlZDpmb2N1c3tjb2xvcjojODA4MDgwO30NCi50ZXh0LXdhcm5pbmd7Y29sb3I6I2MwOTg1Mzt9DQphLnRleHQtd2FybmluZzpob3ZlcixhLnRleHQtd2FybmluZzpmb2N1c3tjb2xvcjojYTQ3ZTNjO30NCi50ZXh0LWVycm9ye2NvbG9yOiNiOTRhNDg7fQ0KYS50ZXh0LWVycm9yOmhvdmVyLGEudGV4dC1lcnJvcjpmb2N1c3tjb2xvcjojOTUzYjM5O30NCi50ZXh0LWluZm97Y29sb3I6IzNhODdhZDt9DQphLnRleHQtaW5mbzpob3ZlcixhLnRleHQtaW5mbzpmb2N1c3tjb2xvcjojMmQ2OTg3O30NCi50ZXh0LXN1Y2Nlc3N7Y29sb3I6IzQ2ODg0Nzt9DQphLnRleHQtc3VjY2Vzczpob3ZlcixhLnRleHQtc3VjY2Vzczpmb2N1c3tjb2xvcjojMzU2NjM1O30NCi50ZXh0LWxlZnR7dGV4dC1hbGlnbjpsZWZ0O30NCi50ZXh0LXJpZ2h0e3RleHQtYWxpZ246cmlnaHQ7fQ0KLnRleHQtY2VudGVye3RleHQtYWxpZ246Y2VudGVyO30NCmgxLGgyLGgzLGg0LGg1LGg2e21hcmdpbjoxMHB4IDA7Zm9udC1mYW1pbHk6aW5oZXJpdDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6aW5oZXJpdDt0ZXh0LXJlbmRlcmluZzpvcHRpbWl6ZWxlZ2liaWxpdHk7fWgxIHNtYWxsLGgyIHNtYWxsLGgzIHNtYWxsLGg0IHNtYWxsLGg1IHNtYWxsLGg2IHNtYWxse2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoxO2NvbG9yOiM5OTk5OTk7fQ0KaDEsaDIsaDN7bGluZS1oZWlnaHQ6NDBweDt9DQpoMXtmb250LXNpemU6MzguNXB4O30NCmgye2ZvbnQtc2l6ZTozMS41cHg7fQ0KaDN7Zm9udC1zaXplOjI0LjVweDt9DQpoNHtmb250LXNpemU6MTcuNXB4O30NCmg1e2ZvbnQtc2l6ZToxNHB4O30NCmg2e2ZvbnQtc2l6ZToxMS45cHg7fQ0KaDEgc21hbGx7Zm9udC1zaXplOjI0LjVweDt9DQpoMiBzbWFsbHtmb250LXNpemU6MTcuNXB4O30NCmgzIHNtYWxse2ZvbnQtc2l6ZToxNHB4O30NCmg0IHNtYWxse2ZvbnQtc2l6ZToxNHB4O30NCi5wYWdlLWhlYWRlcntwYWRkaW5nLWJvdHRvbTo5cHg7bWFyZ2luOjIwcHggMCAzMHB4O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNlZWVlZWU7fQ0KdWwsb2x7cGFkZGluZzowO21hcmdpbjowIDAgMTBweCAyNXB4O30NCnVsIHVsLHVsIG9sLG9sIG9sLG9sIHVse21hcmdpbi1ib3R0b206MDt9DQpsaXtsaW5lLWhlaWdodDoyMHB4O30NCnVsLnVuc3R5bGVkLG9sLnVuc3R5bGVke21hcmdpbi1sZWZ0OjA7bGlzdC1zdHlsZTpub25lO30NCnVsLmlubGluZSxvbC5pbmxpbmV7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmU7fXVsLmlubGluZT5saSxvbC5pbmxpbmU+bGl7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7cGFkZGluZy1sZWZ0OjVweDtwYWRkaW5nLXJpZ2h0OjVweDt9DQpkbHttYXJnaW4tYm90dG9tOjIwcHg7fQ0KZHQsZGR7bGluZS1oZWlnaHQ6MjBweDt9DQpkdHtmb250LXdlaWdodDpib2xkO30NCmRke21hcmdpbi1sZWZ0OjEwcHg7fQ0KLmRsLWhvcml6b250YWx7Knpvb206MTt9LmRsLWhvcml6b250YWw6YmVmb3JlLC5kbC1ob3Jpem9udGFsOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5kbC1ob3Jpem9udGFsOmFmdGVye2NsZWFyOmJvdGg7fQ0KLmRsLWhvcml6b250YWwgZHR7ZmxvYXQ6bGVmdDt3aWR0aDoxNjBweDtjbGVhcjpsZWZ0O3RleHQtYWxpZ246cmlnaHQ7b3ZlcmZsb3c6aGlkZGVuO3RleHQtb3ZlcmZsb3c6ZWxsaXBzaXM7d2hpdGUtc3BhY2U6bm93cmFwO30NCi5kbC1ob3Jpem9udGFsIGRke21hcmdpbi1sZWZ0OjE4MHB4O30NCmhye21hcmdpbjoyMHB4IDA7Ym9yZGVyOjA7Ym9yZGVyLXRvcDoxcHggc29saWQgI2VlZWVlZTtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZmZmZmZmO30NCmFiYnJbdGl0bGVdLGFiYnJbZGF0YS1vcmlnaW5hbC10aXRsZV17Y3Vyc29yOmhlbHA7Ym9yZGVyLWJvdHRvbToxcHggZG90dGVkICM5OTk5OTk7fQ0KYWJici5pbml0aWFsaXNte2ZvbnQtc2l6ZTo5MCU7dGV4dC10cmFuc2Zvcm06dXBwZXJjYXNlO30NCmJsb2NrcXVvdGV7cGFkZGluZzowIDAgMCAxNXB4O21hcmdpbjowIDAgMjBweDtib3JkZXItbGVmdDo1cHggc29saWQgI2VlZWVlZTt9YmxvY2txdW90ZSBwe21hcmdpbi1ib3R0b206MDtmb250LXNpemU6MTcuNXB4O2ZvbnQtd2VpZ2h0OjMwMDtsaW5lLWhlaWdodDoxLjI1O30NCmJsb2NrcXVvdGUgc21hbGx7ZGlzcGxheTpibG9jaztsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiM5OTk5OTk7fWJsb2NrcXVvdGUgc21hbGw6YmVmb3Jle2NvbnRlbnQ6J1wyMDE0IFwwMEEwJzt9DQpibG9ja3F1b3RlLnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHQ7cGFkZGluZy1yaWdodDoxNXB4O3BhZGRpbmctbGVmdDowO2JvcmRlci1yaWdodDo1cHggc29saWQgI2VlZWVlZTtib3JkZXItbGVmdDowO31ibG9ja3F1b3RlLnB1bGwtcmlnaHQgcCxibG9ja3F1b3RlLnB1bGwtcmlnaHQgc21hbGx7dGV4dC1hbGlnbjpyaWdodDt9DQpibG9ja3F1b3RlLnB1bGwtcmlnaHQgc21hbGw6YmVmb3Jle2NvbnRlbnQ6Jyc7fQ0KYmxvY2txdW90ZS5wdWxsLXJpZ2h0IHNtYWxsOmFmdGVye2NvbnRlbnQ6J1wwMEEwIFwyMDE0Jzt9DQpxOmJlZm9yZSxxOmFmdGVyLGJsb2NrcXVvdGU6YmVmb3JlLGJsb2NrcXVvdGU6YWZ0ZXJ7Y29udGVudDoiIjt9DQphZGRyZXNze2Rpc3BsYXk6YmxvY2s7bWFyZ2luLWJvdHRvbToyMHB4O2ZvbnQtc3R5bGU6bm9ybWFsO2xpbmUtaGVpZ2h0OjIwcHg7fQ0KY29kZSxwcmV7cGFkZGluZzowIDNweCAycHg7Zm9udC1mYW1pbHk6TW9uYWNvLE1lbmxvLENvbnNvbGFzLCJDb3VyaWVyIE5ldyIsbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB4O2NvbG9yOiMzMzMzMzM7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4O30NCmNvZGV7cGFkZGluZzoycHggNHB4O2NvbG9yOiNkMTQ7YmFja2dyb3VuZC1jb2xvcjojZjdmN2Y5O2JvcmRlcjoxcHggc29saWQgI2UxZTFlODt3aGl0ZS1zcGFjZTpub3dyYXA7fQ0KcHJle2Rpc3BsYXk6YmxvY2s7cGFkZGluZzo5LjVweDttYXJnaW46MCAwIDEwcHg7Zm9udC1zaXplOjEzcHg7bGluZS1oZWlnaHQ6MjBweDt3b3JkLWJyZWFrOmJyZWFrLWFsbDt3b3JkLXdyYXA6YnJlYWstd29yZDt3aGl0ZS1zcGFjZTpwcmU7d2hpdGUtc3BhY2U6cHJlLXdyYXA7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwgMCwgMCwgMC4xNSk7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O31wcmUucHJldHR5cHJpbnR7bWFyZ2luLWJvdHRvbToyMHB4O30NCnByZSBjb2Rle3BhZGRpbmc6MDtjb2xvcjppbmhlcml0O3doaXRlLXNwYWNlOnByZTt3aGl0ZS1zcGFjZTpwcmUtd3JhcDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjowO30NCi5wcmUtc2Nyb2xsYWJsZXttYXgtaGVpZ2h0OjM0MHB4O292ZXJmbG93LXk6c2Nyb2xsO30NCi5sYWJlbCwuYmFkZ2V7ZGlzcGxheTppbmxpbmUtYmxvY2s7cGFkZGluZzoycHggNHB4O2ZvbnQtc2l6ZToxMS44NDRweDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjE0cHg7Y29sb3I6I2ZmZmZmZjt2ZXJ0aWNhbC1hbGlnbjpiYXNlbGluZTt3aGl0ZS1zcGFjZTpub3dyYXA7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiM5OTk5OTk7fQ0KLmxhYmVsey13ZWJraXQtYm9yZGVyLXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzOjNweDtib3JkZXItcmFkaXVzOjNweDt9DQouYmFkZ2V7cGFkZGluZy1sZWZ0OjlweDtwYWRkaW5nLXJpZ2h0OjlweDstd2Via2l0LWJvcmRlci1yYWRpdXM6OXB4Oy1tb3otYm9yZGVyLXJhZGl1czo5cHg7Ym9yZGVyLXJhZGl1czo5cHg7fQ0KLmxhYmVsOmVtcHR5LC5iYWRnZTplbXB0eXtkaXNwbGF5Om5vbmU7fQ0KYS5sYWJlbDpob3ZlcixhLmxhYmVsOmZvY3VzLGEuYmFkZ2U6aG92ZXIsYS5iYWRnZTpmb2N1c3tjb2xvcjojZmZmZmZmO3RleHQtZGVjb3JhdGlvbjpub25lO2N1cnNvcjpwb2ludGVyO30NCi5sYWJlbC1pbXBvcnRhbnQsLmJhZGdlLWltcG9ydGFudHtiYWNrZ3JvdW5kLWNvbG9yOiNiOTRhNDg7fQ0KLmxhYmVsLWltcG9ydGFudFtocmVmXSwuYmFkZ2UtaW1wb3J0YW50W2hyZWZde2JhY2tncm91bmQtY29sb3I6Izk1M2IzOTt9DQoubGFiZWwtd2FybmluZywuYmFkZ2Utd2FybmluZ3tiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDY7fQ0KLmxhYmVsLXdhcm5pbmdbaHJlZl0sLmJhZGdlLXdhcm5pbmdbaHJlZl17YmFja2dyb3VuZC1jb2xvcjojYzY3NjA1O30NCi5sYWJlbC1zdWNjZXNzLC5iYWRnZS1zdWNjZXNze2JhY2tncm91bmQtY29sb3I6IzQ2ODg0Nzt9DQoubGFiZWwtc3VjY2Vzc1tocmVmXSwuYmFkZ2Utc3VjY2Vzc1tocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiMzNTY2MzU7fQ0KLmxhYmVsLWluZm8sLmJhZGdlLWluZm97YmFja2dyb3VuZC1jb2xvcjojM2E4N2FkO30NCi5sYWJlbC1pbmZvW2hyZWZdLC5iYWRnZS1pbmZvW2hyZWZde2JhY2tncm91bmQtY29sb3I6IzJkNjk4Nzt9DQoubGFiZWwtaW52ZXJzZSwuYmFkZ2UtaW52ZXJzZXtiYWNrZ3JvdW5kLWNvbG9yOiMzMzMzMzM7fQ0KLmxhYmVsLWludmVyc2VbaHJlZl0sLmJhZGdlLWludmVyc2VbaHJlZl17YmFja2dyb3VuZC1jb2xvcjojMWExYTFhO30NCi5idG4gLmxhYmVsLC5idG4gLmJhZGdle3Bvc2l0aW9uOnJlbGF0aXZlO3RvcDotMXB4O30NCi5idG4tbWluaSAubGFiZWwsLmJ0bi1taW5pIC5iYWRnZXt0b3A6MDt9DQp0YWJsZXttYXgtd2lkdGg6MTAwJTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowO30NCi50YWJsZXt3aWR0aDoxMDAlO21hcmdpbi1ib3R0b206MjBweDt9LnRhYmxlIHRoLC50YWJsZSB0ZHtwYWRkaW5nOjhweDtsaW5lLWhlaWdodDoyMHB4O3RleHQtYWxpZ246bGVmdDt2ZXJ0aWNhbC1hbGlnbjp0b3A7Ym9yZGVyLXRvcDoxcHggc29saWQgI2RkZGRkZDt9DQoudGFibGUgdGh7Zm9udC13ZWlnaHQ6Ym9sZDt9DQoudGFibGUgdGhlYWQgdGh7dmVydGljYWwtYWxpZ246Ym90dG9tO30NCi50YWJsZSBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZSBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRkLC50YWJsZSBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUgY29sZ3JvdXArdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZSB0aGVhZDpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0ZHtib3JkZXItdG9wOjA7fQ0KLnRhYmxlIHRib2R5K3Rib2R5e2JvcmRlci10b3A6MnB4IHNvbGlkICNkZGRkZGQ7fQ0KLnRhYmxlIC50YWJsZXtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZmZmY7fQ0KLnRhYmxlLWNvbmRlbnNlZCB0aCwudGFibGUtY29uZGVuc2VkIHRke3BhZGRpbmc6NHB4IDVweDt9DQoudGFibGUtYm9yZGVyZWR7Ym9yZGVyOjFweCBzb2xpZCAjZGRkZGRkO2JvcmRlci1jb2xsYXBzZTpzZXBhcmF0ZTsqYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O30udGFibGUtYm9yZGVyZWQgdGgsLnRhYmxlLWJvcmRlcmVkIHRke2JvcmRlci1sZWZ0OjFweCBzb2xpZCAjZGRkZGRkO30NCi50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkLC50YWJsZS1ib3JkZXJlZCB0aGVhZDpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRke2JvcmRlci10b3A6MDt9DQoudGFibGUtYm9yZGVyZWQgdGhlYWQ6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQ+dGg6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRkOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZD50aDpmaXJzdC1jaGlsZHstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDt9DQoudGFibGUtYm9yZGVyZWQgdGhlYWQ6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQ+dGg6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQ+dGQ6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQ+dGg6bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDt9DQoudGFibGUtYm9yZGVyZWQgdGhlYWQ6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRoOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGQ6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGZvb3Q6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRkOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Zm9vdDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGg6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7fQ0KLnRhYmxlLWJvcmRlcmVkIHRoZWFkOmxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50aDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGQ6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRmb290Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50ZDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Zm9vdDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGg6bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDt9DQoudGFibGUtYm9yZGVyZWQgdGZvb3QrdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkIHRkOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjA7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czowO30NCi50YWJsZS1ib3JkZXJlZCB0Zm9vdCt0Ym9keTpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQgdGQ6bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjA7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6MDt9DQoudGFibGUtYm9yZGVyZWQgY2FwdGlvbit0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgY2FwdGlvbit0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGg6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O30NCi50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQ6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGg6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQ6bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDt9DQoudGFibGUtc3RyaXBlZCB0Ym9keT50cjpudGgtY2hpbGQob2RkKT50ZCwudGFibGUtc3RyaXBlZCB0Ym9keT50cjpudGgtY2hpbGQob2RkKT50aHtiYWNrZ3JvdW5kLWNvbG9yOiNmOWY5Zjk7fQ0KLnRhYmxlLWhvdmVyIHRib2R5IHRyOmhvdmVyPnRkLC50YWJsZS1ob3ZlciB0Ym9keSB0cjpob3Zlcj50aHtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7fQ0KdGFibGUgdGRbY2xhc3MqPSJzcGFuIl0sdGFibGUgdGhbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0YWJsZSB0ZFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIHRhYmxlIHRoW2NsYXNzKj0ic3BhbiJde2Rpc3BsYXk6dGFibGUtY2VsbDtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjA7fQ0KLnRhYmxlIHRkLnNwYW4xLC50YWJsZSB0aC5zcGFuMXtmbG9hdDpub25lO3dpZHRoOjQ0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjIsLnRhYmxlIHRoLnNwYW4ye2Zsb2F0Om5vbmU7d2lkdGg6MTI0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjMsLnRhYmxlIHRoLnNwYW4ze2Zsb2F0Om5vbmU7d2lkdGg6MjA0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjQsLnRhYmxlIHRoLnNwYW40e2Zsb2F0Om5vbmU7d2lkdGg6Mjg0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjUsLnRhYmxlIHRoLnNwYW41e2Zsb2F0Om5vbmU7d2lkdGg6MzY0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjYsLnRhYmxlIHRoLnNwYW42e2Zsb2F0Om5vbmU7d2lkdGg6NDQ0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjcsLnRhYmxlIHRoLnNwYW43e2Zsb2F0Om5vbmU7d2lkdGg6NTI0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjgsLnRhYmxlIHRoLnNwYW44e2Zsb2F0Om5vbmU7d2lkdGg6NjA0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjksLnRhYmxlIHRoLnNwYW45e2Zsb2F0Om5vbmU7d2lkdGg6Njg0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjEwLC50YWJsZSB0aC5zcGFuMTB7ZmxvYXQ6bm9uZTt3aWR0aDo3NjRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuMTEsLnRhYmxlIHRoLnNwYW4xMXtmbG9hdDpub25lO3dpZHRoOjg0NHB4O21hcmdpbi1sZWZ0OjA7fQ0KLnRhYmxlIHRkLnNwYW4xMiwudGFibGUgdGguc3BhbjEye2Zsb2F0Om5vbmU7d2lkdGg6OTI0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGJvZHkgdHIuc3VjY2Vzcz50ZHtiYWNrZ3JvdW5kLWNvbG9yOiNkZmYwZDg7fQ0KLnRhYmxlIHRib2R5IHRyLmVycm9yPnRke2JhY2tncm91bmQtY29sb3I6I2YyZGVkZTt9DQoudGFibGUgdGJvZHkgdHIud2FybmluZz50ZHtiYWNrZ3JvdW5kLWNvbG9yOiNmY2Y4ZTM7fQ0KLnRhYmxlIHRib2R5IHRyLmluZm8+dGR7YmFja2dyb3VuZC1jb2xvcjojZDllZGY3O30NCi50YWJsZS1ob3ZlciB0Ym9keSB0ci5zdWNjZXNzOmhvdmVyPnRke2JhY2tncm91bmQtY29sb3I6I2QwZTljNjt9DQoudGFibGUtaG92ZXIgdGJvZHkgdHIuZXJyb3I6aG92ZXI+dGR7YmFja2dyb3VuZC1jb2xvcjojZWJjY2NjO30NCi50YWJsZS1ob3ZlciB0Ym9keSB0ci53YXJuaW5nOmhvdmVyPnRke2JhY2tncm91bmQtY29sb3I6I2ZhZjJjYzt9DQoudGFibGUtaG92ZXIgdGJvZHkgdHIuaW5mbzpob3Zlcj50ZHtiYWNrZ3JvdW5kLWNvbG9yOiNjNGUzZjM7fQ0KZm9ybXttYXJnaW46MCAwIDIwcHg7fQ0KZmllbGRzZXR7cGFkZGluZzowO21hcmdpbjowO2JvcmRlcjowO30NCmxlZ2VuZHtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7cGFkZGluZzowO21hcmdpbi1ib3R0b206MjBweDtmb250LXNpemU6MjFweDtsaW5lLWhlaWdodDo0MHB4O2NvbG9yOiMzMzMzMzM7Ym9yZGVyOjA7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2U1ZTVlNTt9bGVnZW5kIHNtYWxse2ZvbnQtc2l6ZToxNXB4O2NvbG9yOiM5OTk5OTk7fQ0KbGFiZWwsaW5wdXQsYnV0dG9uLHNlbGVjdCx0ZXh0YXJlYXtmb250LXNpemU6MTRweDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MjBweDt9DQppbnB1dCxidXR0b24sc2VsZWN0LHRleHRhcmVhe2ZvbnQtZmFtaWx5OiJIZWx2ZXRpY2EgTmV1ZSIsSGVsdmV0aWNhLEFyaWFsLHNhbnMtc2VyaWY7fQ0KbGFiZWx7ZGlzcGxheTpibG9jazttYXJnaW4tYm90dG9tOjVweDt9DQpzZWxlY3QsdGV4dGFyZWEsaW5wdXRbdHlwZT0idGV4dCJdLGlucHV0W3R5cGU9InBhc3N3b3JkIl0saW5wdXRbdHlwZT0iZGF0ZXRpbWUiXSxpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdLGlucHV0W3R5cGU9ImRhdGUiXSxpbnB1dFt0eXBlPSJtb250aCJdLGlucHV0W3R5cGU9InRpbWUiXSxpbnB1dFt0eXBlPSJ3ZWVrIl0saW5wdXRbdHlwZT0ibnVtYmVyIl0saW5wdXRbdHlwZT0iZW1haWwiXSxpbnB1dFt0eXBlPSJ1cmwiXSxpbnB1dFt0eXBlPSJzZWFyY2giXSxpbnB1dFt0eXBlPSJ0ZWwiXSxpbnB1dFt0eXBlPSJjb2xvciJdLC51bmVkaXRhYmxlLWlucHV0e2Rpc3BsYXk6aW5saW5lLWJsb2NrO2hlaWdodDoyMHB4O3BhZGRpbmc6NHB4IDZweDttYXJnaW4tYm90dG9tOjEwcHg7Zm9udC1zaXplOjE0cHg7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojNTU1NTU1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt2ZXJ0aWNhbC1hbGlnbjptaWRkbGU7fQ0KaW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7d2lkdGg6MjA2cHg7fQ0KdGV4dGFyZWF7aGVpZ2h0OmF1dG87fQ0KdGV4dGFyZWEsaW5wdXRbdHlwZT0idGV4dCJdLGlucHV0W3R5cGU9InBhc3N3b3JkIl0saW5wdXRbdHlwZT0iZGF0ZXRpbWUiXSxpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdLGlucHV0W3R5cGU9ImRhdGUiXSxpbnB1dFt0eXBlPSJtb250aCJdLGlucHV0W3R5cGU9InRpbWUiXSxpbnB1dFt0eXBlPSJ3ZWVrIl0saW5wdXRbdHlwZT0ibnVtYmVyIl0saW5wdXRbdHlwZT0iZW1haWwiXSxpbnB1dFt0eXBlPSJ1cmwiXSxpbnB1dFt0eXBlPSJzZWFyY2giXSxpbnB1dFt0eXBlPSJ0ZWwiXSxpbnB1dFt0eXBlPSJjb2xvciJdLC51bmVkaXRhYmxlLWlucHV0e2JhY2tncm91bmQtY29sb3I6I2ZmZmZmZjtib3JkZXI6MXB4IHNvbGlkICNjY2NjY2M7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpOy13ZWJraXQtdHJhbnNpdGlvbjpib3JkZXIgbGluZWFyIC4ycywgYm94LXNoYWRvdyBsaW5lYXIgLjJzOy1tb3otdHJhbnNpdGlvbjpib3JkZXIgbGluZWFyIC4ycywgYm94LXNoYWRvdyBsaW5lYXIgLjJzOy1vLXRyYW5zaXRpb246Ym9yZGVyIGxpbmVhciAuMnMsIGJveC1zaGFkb3cgbGluZWFyIC4yczt0cmFuc2l0aW9uOmJvcmRlciBsaW5lYXIgLjJzLCBib3gtc2hhZG93IGxpbmVhciAuMnM7fXRleHRhcmVhOmZvY3VzLGlucHV0W3R5cGU9InRleHQiXTpmb2N1cyxpbnB1dFt0eXBlPSJwYXNzd29yZCJdOmZvY3VzLGlucHV0W3R5cGU9ImRhdGV0aW1lIl06Zm9jdXMsaW5wdXRbdHlwZT0iZGF0ZXRpbWUtbG9jYWwiXTpmb2N1cyxpbnB1dFt0eXBlPSJkYXRlIl06Zm9jdXMsaW5wdXRbdHlwZT0ibW9udGgiXTpmb2N1cyxpbnB1dFt0eXBlPSJ0aW1lIl06Zm9jdXMsaW5wdXRbdHlwZT0id2VlayJdOmZvY3VzLGlucHV0W3R5cGU9Im51bWJlciJdOmZvY3VzLGlucHV0W3R5cGU9ImVtYWlsIl06Zm9jdXMsaW5wdXRbdHlwZT0idXJsIl06Zm9jdXMsaW5wdXRbdHlwZT0ic2VhcmNoIl06Zm9jdXMsaW5wdXRbdHlwZT0idGVsIl06Zm9jdXMsaW5wdXRbdHlwZT0iY29sb3IiXTpmb2N1cywudW5lZGl0YWJsZS1pbnB1dDpmb2N1c3tib3JkZXItY29sb3I6cmdiYSg4MiwgMTY4LCAyMzYsIDAuOCk7b3V0bGluZTowO291dGxpbmU6dGhpbiBkb3R0ZWQgXDk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLC4wNzUpLCAwIDAgOHB4IHJnYmEoODIsMTY4LDIzNiwuNik7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLC4wNzUpLCAwIDAgOHB4IHJnYmEoODIsMTY4LDIzNiwuNik7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwuMDc1KSwgMCAwIDhweCByZ2JhKDgyLDE2OCwyMzYsLjYpO30NCmlucHV0W3R5cGU9InJhZGlvIl0saW5wdXRbdHlwZT0iY2hlY2tib3giXXttYXJnaW46NHB4IDAgMDsqbWFyZ2luLXRvcDowO21hcmdpbi10b3A6MXB4IFw5O2xpbmUtaGVpZ2h0Om5vcm1hbDt9DQppbnB1dFt0eXBlPSJmaWxlIl0saW5wdXRbdHlwZT0iaW1hZ2UiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXSxpbnB1dFt0eXBlPSJyZXNldCJdLGlucHV0W3R5cGU9ImJ1dHRvbiJdLGlucHV0W3R5cGU9InJhZGlvIl0saW5wdXRbdHlwZT0iY2hlY2tib3giXXt3aWR0aDphdXRvO30NCnNlbGVjdCxpbnB1dFt0eXBlPSJmaWxlIl17aGVpZ2h0OjMwcHg7Km1hcmdpbi10b3A6NHB4O2xpbmUtaGVpZ2h0OjMwcHg7fQ0Kc2VsZWN0e3dpZHRoOjIyMHB4O2JvcmRlcjoxcHggc29saWQgI2NjY2NjYztiYWNrZ3JvdW5kLWNvbG9yOiNmZmZmZmY7fQ0Kc2VsZWN0W211bHRpcGxlXSxzZWxlY3Rbc2l6ZV17aGVpZ2h0OmF1dG87fQ0Kc2VsZWN0OmZvY3VzLGlucHV0W3R5cGU9ImZpbGUiXTpmb2N1cyxpbnB1dFt0eXBlPSJyYWRpbyJdOmZvY3VzLGlucHV0W3R5cGU9ImNoZWNrYm94Il06Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHg7fQ0KLnVuZWRpdGFibGUtaW5wdXQsLnVuZWRpdGFibGUtdGV4dGFyZWF7Y29sb3I6Izk5OTk5OTtiYWNrZ3JvdW5kLWNvbG9yOiNmY2ZjZmM7Ym9yZGVyLWNvbG9yOiNjY2NjY2M7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMDI1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwgMCwgMCwgMC4wMjUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwgMCwgMCwgMC4wMjUpO2N1cnNvcjpub3QtYWxsb3dlZDt9DQoudW5lZGl0YWJsZS1pbnB1dHtvdmVyZmxvdzpoaWRkZW47d2hpdGUtc3BhY2U6bm93cmFwO30NCi51bmVkaXRhYmxlLXRleHRhcmVhe3dpZHRoOmF1dG87aGVpZ2h0OmF1dG87fQ0KaW5wdXQ6LW1vei1wbGFjZWhvbGRlcix0ZXh0YXJlYTotbW96LXBsYWNlaG9sZGVye2NvbG9yOiM5OTk5OTk7fQ0KaW5wdXQ6LW1zLWlucHV0LXBsYWNlaG9sZGVyLHRleHRhcmVhOi1tcy1pbnB1dC1wbGFjZWhvbGRlcntjb2xvcjojOTk5OTk5O30NCmlucHV0Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVyLHRleHRhcmVhOjotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiM5OTk5OTk7fQ0KLnJhZGlvLC5jaGVja2JveHttaW4taGVpZ2h0OjIwcHg7cGFkZGluZy1sZWZ0OjIwcHg7fQ0KLnJhZGlvIGlucHV0W3R5cGU9InJhZGlvIl0sLmNoZWNrYm94IGlucHV0W3R5cGU9ImNoZWNrYm94Il17ZmxvYXQ6bGVmdDttYXJnaW4tbGVmdDotMjBweDt9DQouY29udHJvbHM+LnJhZGlvOmZpcnN0LWNoaWxkLC5jb250cm9scz4uY2hlY2tib3g6Zmlyc3QtY2hpbGR7cGFkZGluZy10b3A6NXB4O30NCi5yYWRpby5pbmxpbmUsLmNoZWNrYm94LmlubGluZXtkaXNwbGF5OmlubGluZS1ibG9jaztwYWRkaW5nLXRvcDo1cHg7bWFyZ2luLWJvdHRvbTowO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTt9DQoucmFkaW8uaW5saW5lKy5yYWRpby5pbmxpbmUsLmNoZWNrYm94LmlubGluZSsuY2hlY2tib3guaW5saW5le21hcmdpbi1sZWZ0OjEwcHg7fQ0KLmlucHV0LW1pbml7d2lkdGg6NjBweDt9DQouaW5wdXQtc21hbGx7d2lkdGg6OTBweDt9DQouaW5wdXQtbWVkaXVte3dpZHRoOjE1MHB4O30NCi5pbnB1dC1sYXJnZXt3aWR0aDoyMTBweDt9DQouaW5wdXQteGxhcmdle3dpZHRoOjI3MHB4O30NCi5pbnB1dC14eGxhcmdle3dpZHRoOjUzMHB4O30NCmlucHV0W2NsYXNzKj0ic3BhbiJdLHNlbGVjdFtjbGFzcyo9InNwYW4iXSx0ZXh0YXJlYVtjbGFzcyo9InNwYW4iXSwudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgc2VsZWN0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgdGV4dGFyZWFbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXXtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjA7fQ0KLmlucHV0LWFwcGVuZCBpbnB1dFtjbGFzcyo9InNwYW4iXSwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1wcmVwZW5kIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCBzZWxlY3RbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0ZXh0YXJlYVtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLmlucHV0LXByZXBlbmQgW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLmlucHV0LWFwcGVuZCBbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTppbmxpbmUtYmxvY2s7fQ0KaW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7bWFyZ2luLWxlZnQ6MDt9DQouY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MjBweDt9DQppbnB1dC5zcGFuMTIsdGV4dGFyZWEuc3BhbjEyLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMnt3aWR0aDo5MjZweDt9DQppbnB1dC5zcGFuMTEsdGV4dGFyZWEuc3BhbjExLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMXt3aWR0aDo4NDZweDt9DQppbnB1dC5zcGFuMTAsdGV4dGFyZWEuc3BhbjEwLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMHt3aWR0aDo3NjZweDt9DQppbnB1dC5zcGFuOSx0ZXh0YXJlYS5zcGFuOSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOXt3aWR0aDo2ODZweDt9DQppbnB1dC5zcGFuOCx0ZXh0YXJlYS5zcGFuOCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo2MDZweDt9DQppbnB1dC5zcGFuNyx0ZXh0YXJlYS5zcGFuNywudW5lZGl0YWJsZS1pbnB1dC5zcGFuN3t3aWR0aDo1MjZweDt9DQppbnB1dC5zcGFuNix0ZXh0YXJlYS5zcGFuNiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNnt3aWR0aDo0NDZweDt9DQppbnB1dC5zcGFuNSx0ZXh0YXJlYS5zcGFuNSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDozNjZweDt9DQppbnB1dC5zcGFuNCx0ZXh0YXJlYS5zcGFuNCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNHt3aWR0aDoyODZweDt9DQppbnB1dC5zcGFuMyx0ZXh0YXJlYS5zcGFuMywudW5lZGl0YWJsZS1pbnB1dC5zcGFuM3t3aWR0aDoyMDZweDt9DQppbnB1dC5zcGFuMix0ZXh0YXJlYS5zcGFuMiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDoxMjZweDt9DQppbnB1dC5zcGFuMSx0ZXh0YXJlYS5zcGFuMSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMXt3aWR0aDo0NnB4O30NCi5jb250cm9scy1yb3d7Knpvb206MTt9LmNvbnRyb2xzLXJvdzpiZWZvcmUsLmNvbnRyb2xzLXJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQouY29udHJvbHMtcm93OmFmdGVye2NsZWFyOmJvdGg7fQ0KLmNvbnRyb2xzLXJvdyBbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXXtmbG9hdDpsZWZ0O30NCi5jb250cm9scy1yb3cgLmNoZWNrYm94W2NsYXNzKj0ic3BhbiJdLC5jb250cm9scy1yb3cgLnJhZGlvW2NsYXNzKj0ic3BhbiJde3BhZGRpbmctdG9wOjVweDt9DQppbnB1dFtkaXNhYmxlZF0sc2VsZWN0W2Rpc2FibGVkXSx0ZXh0YXJlYVtkaXNhYmxlZF0saW5wdXRbcmVhZG9ubHldLHNlbGVjdFtyZWFkb25seV0sdGV4dGFyZWFbcmVhZG9ubHlde2N1cnNvcjpub3QtYWxsb3dlZDtiYWNrZ3JvdW5kLWNvbG9yOiNlZWVlZWU7fQ0KaW5wdXRbdHlwZT0icmFkaW8iXVtkaXNhYmxlZF0saW5wdXRbdHlwZT0iY2hlY2tib3giXVtkaXNhYmxlZF0saW5wdXRbdHlwZT0icmFkaW8iXVtyZWFkb25seV0saW5wdXRbdHlwZT0iY2hlY2tib3giXVtyZWFkb25seV17YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDt9DQouY29udHJvbC1ncm91cC53YXJuaW5nIC5jb250cm9sLWxhYmVsLC5jb250cm9sLWdyb3VwLndhcm5pbmcgLmhlbHAtYmxvY2ssLmNvbnRyb2wtZ3JvdXAud2FybmluZyAuaGVscC1pbmxpbmV7Y29sb3I6I2MwOTg1Mzt9DQouY29udHJvbC1ncm91cC53YXJuaW5nIC5jaGVja2JveCwuY29udHJvbC1ncm91cC53YXJuaW5nIC5yYWRpbywuY29udHJvbC1ncm91cC53YXJuaW5nIGlucHV0LC5jb250cm9sLWdyb3VwLndhcm5pbmcgc2VsZWN0LC5jb250cm9sLWdyb3VwLndhcm5pbmcgdGV4dGFyZWF7Y29sb3I6I2MwOTg1Mzt9DQouY29udHJvbC1ncm91cC53YXJuaW5nIGlucHV0LC5jb250cm9sLWdyb3VwLndhcm5pbmcgc2VsZWN0LC5jb250cm9sLWdyb3VwLndhcm5pbmcgdGV4dGFyZWF7Ym9yZGVyLWNvbG9yOiNjMDk4NTM7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO30uY29udHJvbC1ncm91cC53YXJuaW5nIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLndhcm5pbmcgc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLndhcm5pbmcgdGV4dGFyZWE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiNhNDdlM2M7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICNkYmM1OWU7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICNkYmM1OWU7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjZGJjNTllO30NCi5jb250cm9sLWdyb3VwLndhcm5pbmcgLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC53YXJuaW5nIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojYzA5ODUzO2JhY2tncm91bmQtY29sb3I6I2ZjZjhlMztib3JkZXItY29sb3I6I2MwOTg1Mzt9DQouY29udHJvbC1ncm91cC5lcnJvciAuY29udHJvbC1sYWJlbCwuY29udHJvbC1ncm91cC5lcnJvciAuaGVscC1ibG9jaywuY29udHJvbC1ncm91cC5lcnJvciAuaGVscC1pbmxpbmV7Y29sb3I6I2I5NGE0ODt9DQouY29udHJvbC1ncm91cC5lcnJvciAuY2hlY2tib3gsLmNvbnRyb2wtZ3JvdXAuZXJyb3IgLnJhZGlvLC5jb250cm9sLWdyb3VwLmVycm9yIGlucHV0LC5jb250cm9sLWdyb3VwLmVycm9yIHNlbGVjdCwuY29udHJvbC1ncm91cC5lcnJvciB0ZXh0YXJlYXtjb2xvcjojYjk0YTQ4O30NCi5jb250cm9sLWdyb3VwLmVycm9yIGlucHV0LC5jb250cm9sLWdyb3VwLmVycm9yIHNlbGVjdCwuY29udHJvbC1ncm91cC5lcnJvciB0ZXh0YXJlYXtib3JkZXItY29sb3I6I2I5NGE0ODstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7fS5jb250cm9sLWdyb3VwLmVycm9yIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLmVycm9yIHNlbGVjdDpmb2N1cywuY29udHJvbC1ncm91cC5lcnJvciB0ZXh0YXJlYTpmb2N1c3tib3JkZXItY29sb3I6Izk1M2IzOTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggI2Q1OTM5MjstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggI2Q1OTM5Mjtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICNkNTkzOTI7fQ0KLmNvbnRyb2wtZ3JvdXAuZXJyb3IgLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC5lcnJvciAuaW5wdXQtYXBwZW5kIC5hZGQtb257Y29sb3I6I2I5NGE0ODtiYWNrZ3JvdW5kLWNvbG9yOiNmMmRlZGU7Ym9yZGVyLWNvbG9yOiNiOTRhNDg7fQ0KLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuY29udHJvbC1sYWJlbCwuY29udHJvbC1ncm91cC5zdWNjZXNzIC5oZWxwLWJsb2NrLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmhlbHAtaW5saW5le2NvbG9yOiM0Njg4NDc7fQ0KLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuY2hlY2tib3gsLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAucmFkaW8sLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyBpbnB1dCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHNlbGVjdCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHRleHRhcmVhe2NvbG9yOiM0Njg4NDc7fQ0KLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyBpbnB1dCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHNlbGVjdCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHRleHRhcmVhe2JvcmRlci1jb2xvcjojNDY4ODQ3Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTt9LmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyBpbnB1dDpmb2N1cywuY29udHJvbC1ncm91cC5zdWNjZXNzIHNlbGVjdDpmb2N1cywuY29udHJvbC1ncm91cC5zdWNjZXNzIHRleHRhcmVhOmZvY3Vze2JvcmRlci1jb2xvcjojMzU2NjM1Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjN2FiYTdiOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjN2FiYTdiO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggIzdhYmE3Yjt9DQouY29udHJvbC1ncm91cC5zdWNjZXNzIC5pbnB1dC1wcmVwZW5kIC5hZGQtb24sLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuaW5wdXQtYXBwZW5kIC5hZGQtb257Y29sb3I6IzQ2ODg0NztiYWNrZ3JvdW5kLWNvbG9yOiNkZmYwZDg7Ym9yZGVyLWNvbG9yOiM0Njg4NDc7fQ0KLmNvbnRyb2wtZ3JvdXAuaW5mbyAuY29udHJvbC1sYWJlbCwuY29udHJvbC1ncm91cC5pbmZvIC5oZWxwLWJsb2NrLC5jb250cm9sLWdyb3VwLmluZm8gLmhlbHAtaW5saW5le2NvbG9yOiMzYTg3YWQ7fQ0KLmNvbnRyb2wtZ3JvdXAuaW5mbyAuY2hlY2tib3gsLmNvbnRyb2wtZ3JvdXAuaW5mbyAucmFkaW8sLmNvbnRyb2wtZ3JvdXAuaW5mbyBpbnB1dCwuY29udHJvbC1ncm91cC5pbmZvIHNlbGVjdCwuY29udHJvbC1ncm91cC5pbmZvIHRleHRhcmVhe2NvbG9yOiMzYTg3YWQ7fQ0KLmNvbnRyb2wtZ3JvdXAuaW5mbyBpbnB1dCwuY29udHJvbC1ncm91cC5pbmZvIHNlbGVjdCwuY29udHJvbC1ncm91cC5pbmZvIHRleHRhcmVhe2JvcmRlci1jb2xvcjojM2E4N2FkOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTt9LmNvbnRyb2wtZ3JvdXAuaW5mbyBpbnB1dDpmb2N1cywuY29udHJvbC1ncm91cC5pbmZvIHNlbGVjdDpmb2N1cywuY29udHJvbC1ncm91cC5pbmZvIHRleHRhcmVhOmZvY3Vze2JvcmRlci1jb2xvcjojMmQ2OTg3Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjN2FiNWQzOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjN2FiNWQzO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggIzdhYjVkMzt9DQouY29udHJvbC1ncm91cC5pbmZvIC5pbnB1dC1wcmVwZW5kIC5hZGQtb24sLmNvbnRyb2wtZ3JvdXAuaW5mbyAuaW5wdXQtYXBwZW5kIC5hZGQtb257Y29sb3I6IzNhODdhZDtiYWNrZ3JvdW5kLWNvbG9yOiNkOWVkZjc7Ym9yZGVyLWNvbG9yOiMzYTg3YWQ7fQ0KaW5wdXQ6Zm9jdXM6aW52YWxpZCx0ZXh0YXJlYTpmb2N1czppbnZhbGlkLHNlbGVjdDpmb2N1czppbnZhbGlke2NvbG9yOiNiOTRhNDg7Ym9yZGVyLWNvbG9yOiNlZTVmNWI7fWlucHV0OmZvY3VzOmludmFsaWQ6Zm9jdXMsdGV4dGFyZWE6Zm9jdXM6aW52YWxpZDpmb2N1cyxzZWxlY3Q6Zm9jdXM6aW52YWxpZDpmb2N1c3tib3JkZXItY29sb3I6I2U5MzIyZDstd2Via2l0LWJveC1zaGFkb3c6MCAwIDZweCAjZjhiOWI3Oy1tb3otYm94LXNoYWRvdzowIDAgNnB4ICNmOGI5Yjc7Ym94LXNoYWRvdzowIDAgNnB4ICNmOGI5Yjc7fQ0KLmZvcm0tYWN0aW9uc3twYWRkaW5nOjE5cHggMjBweCAyMHB4O21hcmdpbi10b3A6MjBweDttYXJnaW4tYm90dG9tOjIwcHg7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O2JvcmRlci10b3A6MXB4IHNvbGlkICNlNWU1ZTU7Knpvb206MTt9LmZvcm0tYWN0aW9uczpiZWZvcmUsLmZvcm0tYWN0aW9uczphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQouZm9ybS1hY3Rpb25zOmFmdGVye2NsZWFyOmJvdGg7fQ0KLmhlbHAtYmxvY2ssLmhlbHAtaW5saW5le2NvbG9yOiM1OTU5NTk7fQ0KLmhlbHAtYmxvY2t7ZGlzcGxheTpibG9jazttYXJnaW4tYm90dG9tOjEwcHg7fQ0KLmhlbHAtaW5saW5le2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTtwYWRkaW5nLWxlZnQ6NXB4O30NCi5pbnB1dC1hcHBlbmQsLmlucHV0LXByZXBlbmR7ZGlzcGxheTppbmxpbmUtYmxvY2s7bWFyZ2luLWJvdHRvbToxMHB4O3ZlcnRpY2FsLWFsaWduOm1pZGRsZTtmb250LXNpemU6MDt3aGl0ZS1zcGFjZTpub3dyYXA7fS5pbnB1dC1hcHBlbmQgaW5wdXQsLmlucHV0LXByZXBlbmQgaW5wdXQsLmlucHV0LWFwcGVuZCBzZWxlY3QsLmlucHV0LXByZXBlbmQgc2VsZWN0LC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQsLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXQsLmlucHV0LWFwcGVuZCAuZHJvcGRvd24tbWVudSwuaW5wdXQtcHJlcGVuZCAuZHJvcGRvd24tbWVudSwuaW5wdXQtYXBwZW5kIC5wb3BvdmVyLC5pbnB1dC1wcmVwZW5kIC5wb3BvdmVye2ZvbnQtc2l6ZToxNHB4O30NCi5pbnB1dC1hcHBlbmQgaW5wdXQsLmlucHV0LXByZXBlbmQgaW5wdXQsLmlucHV0LWFwcGVuZCBzZWxlY3QsLmlucHV0LXByZXBlbmQgc2VsZWN0LC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQsLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXR7cG9zaXRpb246cmVsYXRpdmU7bWFyZ2luLWJvdHRvbTowOyptYXJnaW4tbGVmdDowO3ZlcnRpY2FsLWFsaWduOnRvcDstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7fS5pbnB1dC1hcHBlbmQgaW5wdXQ6Zm9jdXMsLmlucHV0LXByZXBlbmQgaW5wdXQ6Zm9jdXMsLmlucHV0LWFwcGVuZCBzZWxlY3Q6Zm9jdXMsLmlucHV0LXByZXBlbmQgc2VsZWN0OmZvY3VzLC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQ6Zm9jdXMsLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXQ6Zm9jdXN7ei1pbmRleDoyO30NCi5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtcHJlcGVuZCAuYWRkLW9ue2Rpc3BsYXk6aW5saW5lLWJsb2NrO3dpZHRoOmF1dG87aGVpZ2h0OjIwcHg7bWluLXdpZHRoOjE2cHg7cGFkZGluZzo0cHggNXB4O2ZvbnQtc2l6ZToxNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoyMHB4O3RleHQtYWxpZ246Y2VudGVyO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiNlZWVlZWU7Ym9yZGVyOjFweCBzb2xpZCAjY2NjO30NCi5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5pbnB1dC1hcHBlbmQgLmJ0biwuaW5wdXQtcHJlcGVuZCAuYnRuLC5pbnB1dC1hcHBlbmQgLmJ0bi1ncm91cD4uZHJvcGRvd24tdG9nZ2xlLC5pbnB1dC1wcmVwZW5kIC5idG4tZ3JvdXA+LmRyb3Bkb3duLXRvZ2dsZXt2ZXJ0aWNhbC1hbGlnbjp0b3A7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowO30NCi5pbnB1dC1hcHBlbmQgLmFjdGl2ZSwuaW5wdXQtcHJlcGVuZCAuYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2E5ZGJhOTtib3JkZXItY29sb3I6IzQ2YTU0Njt9DQouaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5pbnB1dC1wcmVwZW5kIC5idG57bWFyZ2luLXJpZ2h0Oi0xcHg7fQ0KLmlucHV0LXByZXBlbmQgLmFkZC1vbjpmaXJzdC1jaGlsZCwuaW5wdXQtcHJlcGVuZCAuYnRuOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweDt9DQouaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDtib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4O30uaW5wdXQtYXBwZW5kIGlucHV0Ky5idG4tZ3JvdXAgLmJ0bjpsYXN0LWNoaWxkLC5pbnB1dC1hcHBlbmQgc2VsZWN0Ky5idG4tZ3JvdXAgLmJ0bjpsYXN0LWNoaWxkLC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQrLmJ0bi1ncm91cCAuYnRuOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO30NCi5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtYXBwZW5kIC5idG4sLmlucHV0LWFwcGVuZCAuYnRuLWdyb3Vwe21hcmdpbi1sZWZ0Oi0xcHg7fQ0KLmlucHV0LWFwcGVuZCAuYWRkLW9uOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCAuYnRuOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCAuYnRuLWdyb3VwOmxhc3QtY2hpbGQ+LmRyb3Bkb3duLXRvZ2dsZXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7fQ0KLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCBzZWxlY3QsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0ey13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9LmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIGlucHV0Ky5idG4tZ3JvdXAgLmJ0biwuaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgc2VsZWN0Ky5idG4tZ3JvdXAgLmJ0biwuaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQrLmJ0bi1ncm91cCAuYnRuey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMDt9DQouaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLmFkZC1vbjpmaXJzdC1jaGlsZCwuaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLmJ0bjpmaXJzdC1jaGlsZHttYXJnaW4tcmlnaHQ6LTFweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4O2JvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7fQ0KLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5hZGQtb246bGFzdC1jaGlsZCwuaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLmJ0bjpsYXN0LWNoaWxke21hcmdpbi1sZWZ0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO30NCi5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAuYnRuLWdyb3VwOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7fQ0KaW5wdXQuc2VhcmNoLXF1ZXJ5e3BhZGRpbmctcmlnaHQ6MTRweDtwYWRkaW5nLXJpZ2h0OjRweCBcOTtwYWRkaW5nLWxlZnQ6MTRweDtwYWRkaW5nLWxlZnQ6NHB4IFw5O21hcmdpbi1ib3R0b206MDstd2Via2l0LWJvcmRlci1yYWRpdXM6MTVweDstbW96LWJvcmRlci1yYWRpdXM6MTVweDtib3JkZXItcmFkaXVzOjE1cHg7fQ0KLmZvcm0tc2VhcmNoIC5pbnB1dC1hcHBlbmQgLnNlYXJjaC1xdWVyeSwuZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQgLnNlYXJjaC1xdWVyeXstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjA7fQ0KLmZvcm0tc2VhcmNoIC5pbnB1dC1hcHBlbmQgLnNlYXJjaC1xdWVyeXstd2Via2l0LWJvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDstbW96LWJvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDtib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7fQ0KLmZvcm0tc2VhcmNoIC5pbnB1dC1hcHBlbmQgLmJ0bnstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMDtib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7fQ0KLmZvcm0tc2VhcmNoIC5pbnB1dC1wcmVwZW5kIC5zZWFyY2gtcXVlcnl7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7Ym9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwO30NCi5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCAuYnRuey13ZWJraXQtYm9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4O2JvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDt9DQouZm9ybS1zZWFyY2ggaW5wdXQsLmZvcm0taW5saW5lIGlucHV0LC5mb3JtLWhvcml6b250YWwgaW5wdXQsLmZvcm0tc2VhcmNoIHRleHRhcmVhLC5mb3JtLWlubGluZSB0ZXh0YXJlYSwuZm9ybS1ob3Jpem9udGFsIHRleHRhcmVhLC5mb3JtLXNlYXJjaCBzZWxlY3QsLmZvcm0taW5saW5lIHNlbGVjdCwuZm9ybS1ob3Jpem9udGFsIHNlbGVjdCwuZm9ybS1zZWFyY2ggLmhlbHAtaW5saW5lLC5mb3JtLWlubGluZSAuaGVscC1pbmxpbmUsLmZvcm0taG9yaXpvbnRhbCAuaGVscC1pbmxpbmUsLmZvcm0tc2VhcmNoIC51bmVkaXRhYmxlLWlucHV0LC5mb3JtLWlubGluZSAudW5lZGl0YWJsZS1pbnB1dCwuZm9ybS1ob3Jpem9udGFsIC51bmVkaXRhYmxlLWlucHV0LC5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCwuZm9ybS1pbmxpbmUgLmlucHV0LXByZXBlbmQsLmZvcm0taG9yaXpvbnRhbCAuaW5wdXQtcHJlcGVuZCwuZm9ybS1zZWFyY2ggLmlucHV0LWFwcGVuZCwuZm9ybS1pbmxpbmUgLmlucHV0LWFwcGVuZCwuZm9ybS1ob3Jpem9udGFsIC5pbnB1dC1hcHBlbmR7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7bWFyZ2luLWJvdHRvbTowO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTt9DQouZm9ybS1zZWFyY2ggLmhpZGUsLmZvcm0taW5saW5lIC5oaWRlLC5mb3JtLWhvcml6b250YWwgLmhpZGV7ZGlzcGxheTpub25lO30NCi5mb3JtLXNlYXJjaCBsYWJlbCwuZm9ybS1pbmxpbmUgbGFiZWwsLmZvcm0tc2VhcmNoIC5idG4tZ3JvdXAsLmZvcm0taW5saW5lIC5idG4tZ3JvdXB7ZGlzcGxheTppbmxpbmUtYmxvY2s7fQ0KLmZvcm0tc2VhcmNoIC5pbnB1dC1hcHBlbmQsLmZvcm0taW5saW5lIC5pbnB1dC1hcHBlbmQsLmZvcm0tc2VhcmNoIC5pbnB1dC1wcmVwZW5kLC5mb3JtLWlubGluZSAuaW5wdXQtcHJlcGVuZHttYXJnaW4tYm90dG9tOjA7fQ0KLmZvcm0tc2VhcmNoIC5yYWRpbywuZm9ybS1zZWFyY2ggLmNoZWNrYm94LC5mb3JtLWlubGluZSAucmFkaW8sLmZvcm0taW5saW5lIC5jaGVja2JveHtwYWRkaW5nLWxlZnQ6MDttYXJnaW4tYm90dG9tOjA7dmVydGljYWwtYWxpZ246bWlkZGxlO30NCi5mb3JtLXNlYXJjaCAucmFkaW8gaW5wdXRbdHlwZT0icmFkaW8iXSwuZm9ybS1zZWFyY2ggLmNoZWNrYm94IGlucHV0W3R5cGU9ImNoZWNrYm94Il0sLmZvcm0taW5saW5lIC5yYWRpbyBpbnB1dFt0eXBlPSJyYWRpbyJdLC5mb3JtLWlubGluZSAuY2hlY2tib3ggaW5wdXRbdHlwZT0iY2hlY2tib3giXXtmbG9hdDpsZWZ0O21hcmdpbi1yaWdodDozcHg7bWFyZ2luLWxlZnQ6MDt9DQouY29udHJvbC1ncm91cHttYXJnaW4tYm90dG9tOjEwcHg7fQ0KbGVnZW5kKy5jb250cm9sLWdyb3Vwe21hcmdpbi10b3A6MjBweDstd2Via2l0LW1hcmdpbi10b3AtY29sbGFwc2U6c2VwYXJhdGU7fQ0KLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cHttYXJnaW4tYm90dG9tOjIwcHg7Knpvb206MTt9LmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cDpiZWZvcmUsLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cDphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQouZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWdyb3VwOmFmdGVye2NsZWFyOmJvdGg7fQ0KLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1sYWJlbHtmbG9hdDpsZWZ0O3dpZHRoOjE2MHB4O3BhZGRpbmctdG9wOjVweDt0ZXh0LWFsaWduOnJpZ2h0O30NCi5mb3JtLWhvcml6b250YWwgLmNvbnRyb2xzeypkaXNwbGF5OmlubGluZS1ibG9jazsqcGFkZGluZy1sZWZ0OjIwcHg7bWFyZ2luLWxlZnQ6MTgwcHg7Km1hcmdpbi1sZWZ0OjA7fS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2xzOmZpcnN0LWNoaWxkeypwYWRkaW5nLWxlZnQ6MTgwcHg7fQ0KLmZvcm0taG9yaXpvbnRhbCAuaGVscC1ibG9ja3ttYXJnaW4tYm90dG9tOjA7fQ0KLmZvcm0taG9yaXpvbnRhbCBpbnB1dCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIHNlbGVjdCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIHRleHRhcmVhKy5oZWxwLWJsb2NrLC5mb3JtLWhvcml6b250YWwgLnVuZWRpdGFibGUtaW5wdXQrLmhlbHAtYmxvY2ssLmZvcm0taG9yaXpvbnRhbCAuaW5wdXQtcHJlcGVuZCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIC5pbnB1dC1hcHBlbmQrLmhlbHAtYmxvY2t7bWFyZ2luLXRvcDoxMHB4O30NCi5mb3JtLWhvcml6b250YWwgLmZvcm0tYWN0aW9uc3twYWRkaW5nLWxlZnQ6MTgwcHg7fQ0KLmJ0bntkaXNwbGF5OmlubGluZS1ibG9jazsqZGlzcGxheTppbmxpbmU7Knpvb206MTtwYWRkaW5nOjRweCAxMnB4O21hcmdpbi1ib3R0b206MDtmb250LXNpemU6MTRweDtsaW5lLWhlaWdodDoyMHB4O3RleHQtYWxpZ246Y2VudGVyO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTtjdXJzb3I6cG9pbnRlcjtjb2xvcjojMzMzMzMzO3RleHQtc2hhZG93OjAgMXB4IDFweCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuNzUpO2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgI2ZmZmZmZiwgI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oI2ZmZmZmZiksIHRvKCNlNmU2ZTYpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgI2ZmZmZmZiwgI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjZmZmZmZmLCAjZTZlNmU2KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICNmZmZmZmYsICNlNmU2ZTYpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZmZmZmZmJywgZW5kQ29sb3JzdHI9JyNmZmU2ZTZlNicsIEdyYWRpZW50VHlwZT0wKTtib3JkZXItY29sb3I6I2U2ZTZlNiAjZTZlNmU2ICNiZmJmYmY7Ym9yZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjI1KTsqYmFja2dyb3VuZC1jb2xvcjojZTZlNmU2O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZCA9IGZhbHNlKTtib3JkZXI6MXB4IHNvbGlkICNjY2NjY2M7KmJvcmRlcjowO2JvcmRlci1ib3R0b20tY29sb3I6I2IzYjNiMzstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7Km1hcmdpbi1sZWZ0Oi4zZW07LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMiksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMiksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjIpLCAwIDFweCAycHggcmdiYSgwLDAsMCwuMDUpO30uYnRuOmhvdmVyLC5idG46Zm9jdXMsLmJ0bjphY3RpdmUsLmJ0bi5hY3RpdmUsLmJ0bi5kaXNhYmxlZCwuYnRuW2Rpc2FibGVkXXtjb2xvcjojMzMzMzMzO2JhY2tncm91bmQtY29sb3I6I2U2ZTZlNjsqYmFja2dyb3VuZC1jb2xvcjojZDlkOWQ5O30NCi5idG46YWN0aXZlLC5idG4uYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2NjY2NjYyBcOTt9DQouYnRuOmZpcnN0LWNoaWxkeyptYXJnaW4tbGVmdDowO30NCi5idG46aG92ZXIsLmJ0bjpmb2N1c3tjb2xvcjojMzMzMzMzO3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtcG9zaXRpb246MCAtMTVweDstd2Via2l0LXRyYW5zaXRpb246YmFja2dyb3VuZC1wb3NpdGlvbiAwLjFzIGxpbmVhcjstbW96LXRyYW5zaXRpb246YmFja2dyb3VuZC1wb3NpdGlvbiAwLjFzIGxpbmVhcjstby10cmFuc2l0aW9uOmJhY2tncm91bmQtcG9zaXRpb24gMC4xcyBsaW5lYXI7dHJhbnNpdGlvbjpiYWNrZ3JvdW5kLXBvc2l0aW9uIDAuMXMgbGluZWFyO30NCi5idG46Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHg7fQ0KLmJ0bi5hY3RpdmUsLmJ0bjphY3RpdmV7YmFja2dyb3VuZC1pbWFnZTpub25lO291dGxpbmU6MDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsLjE1KSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsLjE1KSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTtib3gtc2hhZG93Omluc2V0IDAgMnB4IDRweCByZ2JhKDAsMCwwLC4xNSksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7fQ0KLmJ0bi5kaXNhYmxlZCwuYnRuW2Rpc2FibGVkXXtjdXJzb3I6ZGVmYXVsdDtiYWNrZ3JvdW5kLWltYWdlOm5vbmU7b3BhY2l0eTowLjY1O2ZpbHRlcjphbHBoYShvcGFjaXR5PTY1KTstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmU7fQ0KLmJ0bi1sYXJnZXtwYWRkaW5nOjExcHggMTlweDtmb250LXNpemU6MTcuNXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDt9DQouYnRuLWxhcmdlIFtjbGFzc149Imljb24tIl0sLmJ0bi1sYXJnZSBbY2xhc3MqPSIgaWNvbi0iXXttYXJnaW4tdG9wOjRweDt9DQouYnRuLXNtYWxse3BhZGRpbmc6MnB4IDEwcHg7Zm9udC1zaXplOjExLjlweDstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHg7fQ0KLmJ0bi1zbWFsbCBbY2xhc3NePSJpY29uLSJdLC5idG4tc21hbGwgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXRvcDowO30NCi5idG4tbWluaSBbY2xhc3NePSJpY29uLSJdLC5idG4tbWluaSBbY2xhc3MqPSIgaWNvbi0iXXttYXJnaW4tdG9wOi0xcHg7fQ0KLmJ0bi1taW5pe3BhZGRpbmc6MCA2cHg7Zm9udC1zaXplOjEwLjVweDstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHg7fQ0KLmJ0bi1ibG9ja3tkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7cGFkZGluZy1sZWZ0OjA7cGFkZGluZy1yaWdodDowOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDt9DQouYnRuLWJsb2NrKy5idG4tYmxvY2t7bWFyZ2luLXRvcDo1cHg7fQ0KaW5wdXRbdHlwZT0ic3VibWl0Il0uYnRuLWJsb2NrLGlucHV0W3R5cGU9InJlc2V0Il0uYnRuLWJsb2NrLGlucHV0W3R5cGU9ImJ1dHRvbiJdLmJ0bi1ibG9ja3t3aWR0aDoxMDAlO30NCi5idG4tcHJpbWFyeS5hY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZSwuYnRuLWRhbmdlci5hY3RpdmUsLmJ0bi1zdWNjZXNzLmFjdGl2ZSwuYnRuLWluZm8uYWN0aXZlLC5idG4taW52ZXJzZS5hY3RpdmV7Y29sb3I6cmdiYSgyNTUsIDI1NSwgMjU1LCAwLjc1KTt9DQouYnRuLXByaW1hcnl7Y29sb3I6I2ZmZmZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO2JhY2tncm91bmQtY29sb3I6IzAwNmRjYztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNDRjYyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzAwODhjYyksIHRvKCMwMDQ0Y2MpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNDRjYyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjMDA4OGNjLCAjMDA0NGNjKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICMwMDg4Y2MsICMwMDQ0Y2MpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmMDA4OGNjJywgZW5kQ29sb3JzdHI9JyNmZjAwNDRjYycsIEdyYWRpZW50VHlwZT0wKTtib3JkZXItY29sb3I6IzAwNDRjYyAjMDA0NGNjICMwMDJhODA7Ym9yZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjI1KTsqYmFja2dyb3VuZC1jb2xvcjojMDA0NGNjO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZCA9IGZhbHNlKTt9LmJ0bi1wcmltYXJ5OmhvdmVyLC5idG4tcHJpbWFyeTpmb2N1cywuYnRuLXByaW1hcnk6YWN0aXZlLC5idG4tcHJpbWFyeS5hY3RpdmUsLmJ0bi1wcmltYXJ5LmRpc2FibGVkLC5idG4tcHJpbWFyeVtkaXNhYmxlZF17Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMwMDQ0Y2M7KmJhY2tncm91bmQtY29sb3I6IzAwM2JiMzt9DQouYnRuLXByaW1hcnk6YWN0aXZlLC5idG4tcHJpbWFyeS5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojMDAzMzk5IFw5O30NCi5idG4td2FybmluZ3tjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojZmFhNzMyO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZmJiNDUwLCAjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZmJiNDUwKSwgdG8oI2Y4OTQwNikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZmJiNDUwLCAjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNmYmI0NTAsICNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2ZiYjQ1MCwgI2Y4OTQwNik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZmYmI0NTAnLCBlbmRDb2xvcnN0cj0nI2ZmZjg5NDA2JywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojZjg5NDA2ICNmODk0MDYgI2FkNjcwNDtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDY7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO30uYnRuLXdhcm5pbmc6aG92ZXIsLmJ0bi13YXJuaW5nOmZvY3VzLC5idG4td2FybmluZzphY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZSwuYnRuLXdhcm5pbmcuZGlzYWJsZWQsLmJ0bi13YXJuaW5nW2Rpc2FibGVkXXtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6I2Y4OTQwNjsqYmFja2dyb3VuZC1jb2xvcjojZGY4NTA1O30NCi5idG4td2FybmluZzphY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNjNjc2MDUgXDk7fQ0KLmJ0bi1kYW5nZXJ7Y29sb3I6I2ZmZmZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO2JhY2tncm91bmQtY29sb3I6I2RhNGY0OTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgI2VlNWY1YiwgI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oI2VlNWY1YiksIHRvKCNiZDM2MmYpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgI2VlNWY1YiwgI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjZWU1ZjViLCAjYmQzNjJmKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICNlZTVmNWIsICNiZDM2MmYpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZWU1ZjViJywgZW5kQ29sb3JzdHI9JyNmZmJkMzYyZicsIEdyYWRpZW50VHlwZT0wKTtib3JkZXItY29sb3I6I2JkMzYyZiAjYmQzNjJmICM4MDI0MjA7Ym9yZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjI1KTsqYmFja2dyb3VuZC1jb2xvcjojYmQzNjJmO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZCA9IGZhbHNlKTt9LmJ0bi1kYW5nZXI6aG92ZXIsLmJ0bi1kYW5nZXI6Zm9jdXMsLmJ0bi1kYW5nZXI6YWN0aXZlLC5idG4tZGFuZ2VyLmFjdGl2ZSwuYnRuLWRhbmdlci5kaXNhYmxlZCwuYnRuLWRhbmdlcltkaXNhYmxlZF17Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiNiZDM2MmY7KmJhY2tncm91bmQtY29sb3I6I2E5MzAyYTt9DQouYnRuLWRhbmdlcjphY3RpdmUsLmJ0bi1kYW5nZXIuYWN0aXZle2JhY2tncm91bmQtY29sb3I6Izk0MmEyNSBcOTt9DQouYnRuLXN1Y2Nlc3N7Y29sb3I6I2ZmZmZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO2JhY2tncm91bmQtY29sb3I6IzViYjc1YjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzYyYzQ2MiwgIzUxYTM1MSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzYyYzQ2MiksIHRvKCM1MWEzNTEpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzYyYzQ2MiwgIzUxYTM1MSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjNjJjNDYyLCAjNTFhMzUxKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICM2MmM0NjIsICM1MWEzNTEpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNjJjNDYyJywgZW5kQ29sb3JzdHI9JyNmZjUxYTM1MScsIEdyYWRpZW50VHlwZT0wKTtib3JkZXItY29sb3I6IzUxYTM1MSAjNTFhMzUxICMzODcwMzg7Ym9yZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjI1KTsqYmFja2dyb3VuZC1jb2xvcjojNTFhMzUxO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZCA9IGZhbHNlKTt9LmJ0bi1zdWNjZXNzOmhvdmVyLC5idG4tc3VjY2Vzczpmb2N1cywuYnRuLXN1Y2Nlc3M6YWN0aXZlLC5idG4tc3VjY2Vzcy5hY3RpdmUsLmJ0bi1zdWNjZXNzLmRpc2FibGVkLC5idG4tc3VjY2Vzc1tkaXNhYmxlZF17Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiM1MWEzNTE7KmJhY2tncm91bmQtY29sb3I6IzQ5OTI0OTt9DQouYnRuLXN1Y2Nlc3M6YWN0aXZlLC5idG4tc3VjY2Vzcy5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojNDA4MTQwIFw5O30NCi5idG4taW5mb3tjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojNDlhZmNkO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjNWJjMGRlLCAjMmY5NmI0KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjNWJjMGRlKSwgdG8oIzJmOTZiNCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjNWJjMGRlLCAjMmY5NmI0KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICM1YmMwZGUsICMyZjk2YjQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgIzViYzBkZSwgIzJmOTZiNCk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmY1YmMwZGUnLCBlbmRDb2xvcnN0cj0nI2ZmMmY5NmI0JywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojMmY5NmI0ICMyZjk2YjQgIzFmNjM3Nztib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiMyZjk2YjQ7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO30uYnRuLWluZm86aG92ZXIsLmJ0bi1pbmZvOmZvY3VzLC5idG4taW5mbzphY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZSwuYnRuLWluZm8uZGlzYWJsZWQsLmJ0bi1pbmZvW2Rpc2FibGVkXXtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6IzJmOTZiNDsqYmFja2dyb3VuZC1jb2xvcjojMmE4NWEwO30NCi5idG4taW5mbzphY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMyNDc0OGMgXDk7fQ0KLmJ0bi1pbnZlcnNle2NvbG9yOiNmZmZmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMzNjM2MzY7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICM0NDQ0NDQsICMyMjIyMjIpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCM0NDQ0NDQpLCB0bygjMjIyMjIyKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICM0NDQ0NDQsICMyMjIyMjIpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzQ0NDQ0NCwgIzIyMjIyMik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjNDQ0NDQ0LCAjMjIyMjIyKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjQ0NDQ0NCcsIGVuZENvbG9yc3RyPScjZmYyMjIyMjInLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyLWNvbG9yOiMyMjIyMjIgIzIyMjIyMiAjMDAwMDAwO2JvcmRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4yNSk7KmJhY2tncm91bmQtY29sb3I6IzIyMjIyMjtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQgPSBmYWxzZSk7fS5idG4taW52ZXJzZTpob3ZlciwuYnRuLWludmVyc2U6Zm9jdXMsLmJ0bi1pbnZlcnNlOmFjdGl2ZSwuYnRuLWludmVyc2UuYWN0aXZlLC5idG4taW52ZXJzZS5kaXNhYmxlZCwuYnRuLWludmVyc2VbZGlzYWJsZWRde2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojMjIyMjIyOypiYWNrZ3JvdW5kLWNvbG9yOiMxNTE1MTU7fQ0KLmJ0bi1pbnZlcnNlOmFjdGl2ZSwuYnRuLWludmVyc2UuYWN0aXZle2JhY2tncm91bmQtY29sb3I6IzA4MDgwOCBcOTt9DQpidXR0b24uYnRuLGlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bnsqcGFkZGluZy10b3A6M3B4OypwYWRkaW5nLWJvdHRvbTozcHg7fWJ1dHRvbi5idG46Oi1tb3otZm9jdXMtaW5uZXIsaW5wdXRbdHlwZT0ic3VibWl0Il0uYnRuOjotbW96LWZvY3VzLWlubmVye3BhZGRpbmc6MDtib3JkZXI6MDt9DQpidXR0b24uYnRuLmJ0bi1sYXJnZSxpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG4uYnRuLWxhcmdleypwYWRkaW5nLXRvcDo3cHg7KnBhZGRpbmctYm90dG9tOjdweDt9DQpidXR0b24uYnRuLmJ0bi1zbWFsbCxpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG4uYnRuLXNtYWxseypwYWRkaW5nLXRvcDozcHg7KnBhZGRpbmctYm90dG9tOjNweDt9DQpidXR0b24uYnRuLmJ0bi1taW5pLGlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi5idG4tbWluaXsqcGFkZGluZy10b3A6MXB4OypwYWRkaW5nLWJvdHRvbToxcHg7fQ0KLmJ0bi1saW5rLC5idG4tbGluazphY3RpdmUsLmJ0bi1saW5rW2Rpc2FibGVkXXtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JhY2tncm91bmQtaW1hZ2U6bm9uZTstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmU7fQ0KLmJ0bi1saW5re2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudDtjdXJzb3I6cG9pbnRlcjtjb2xvcjojMDA4OGNjOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQouYnRuLWxpbms6aG92ZXIsLmJ0bi1saW5rOmZvY3Vze2NvbG9yOiMwMDU1ODA7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O30NCi5idG4tbGlua1tkaXNhYmxlZF06aG92ZXIsLmJ0bi1saW5rW2Rpc2FibGVkXTpmb2N1c3tjb2xvcjojMzMzMzMzO3RleHQtZGVjb3JhdGlvbjpub25lO30NCltjbGFzc149Imljb24tIl0sW2NsYXNzKj0iIGljb24tIl17ZGlzcGxheTppbmxpbmUtYmxvY2s7d2lkdGg6MTRweDtoZWlnaHQ6MTRweDsqbWFyZ2luLXJpZ2h0Oi4zZW07bGluZS1oZWlnaHQ6MTRweDt2ZXJ0aWNhbC1hbGlnbjp0ZXh0LXRvcDtiYWNrZ3JvdW5kLWltYWdlOnVybCgiLi4vaW1nL2dseXBoaWNvbnMtaGFsZmxpbmdzLnBuZyIpO2JhY2tncm91bmQtcG9zaXRpb246MTRweCAxNHB4O2JhY2tncm91bmQtcmVwZWF0Om5vLXJlcGVhdDttYXJnaW4tdG9wOjFweDt9DQouaWNvbi13aGl0ZSwubmF2LXBpbGxzPi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXYtcGlsbHM+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5uYXYtbGlzdD4uYWN0aXZlPmE+W2NsYXNzXj0iaWNvbi0iXSwubmF2LWxpc3Q+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5uYXZiYXItaW52ZXJzZSAubmF2Pi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXZiYXItaW52ZXJzZSAubmF2Pi5hY3RpdmU+YT5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tbWVudT5saT5hOmhvdmVyPltjbGFzc149Imljb24tIl0sLmRyb3Bkb3duLW1lbnU+bGk+YTpmb2N1cz5bY2xhc3NePSJpY29uLSJdLC5kcm9wZG93bi1tZW51PmxpPmE6aG92ZXI+W2NsYXNzKj0iIGljb24tIl0sLmRyb3Bkb3duLW1lbnU+bGk+YTpmb2N1cz5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE+W2NsYXNzXj0iaWNvbi0iXSwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE+W2NsYXNzKj0iIGljb24tIl0sLmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YT5bY2xhc3NePSJpY29uLSJdLC5kcm9wZG93bi1zdWJtZW51OmZvY3VzPmE+W2NsYXNzXj0iaWNvbi0iXSwuZHJvcGRvd24tc3VibWVudTpob3Zlcj5hPltjbGFzcyo9IiBpY29uLSJdLC5kcm9wZG93bi1zdWJtZW51OmZvY3VzPmE+W2NsYXNzKj0iIGljb24tIl17YmFja2dyb3VuZC1pbWFnZTp1cmwoIi4uL2ltZy9nbHlwaGljb25zLWhhbGZsaW5ncy13aGl0ZS5wbmciKTt9DQouaWNvbi1nbGFzc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMDt9DQouaWNvbi1tdXNpY3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IDA7fQ0KLmljb24tc2VhcmNoe2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggMDt9DQouaWNvbi1lbnZlbG9wZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IDA7fQ0KLmljb24taGVhcnR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAwO30NCi5pY29uLXN0YXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggMDt9DQouaWNvbi1zdGFyLWVtcHR5e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IDA7fQ0KLmljb24tdXNlcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAwO30NCi5pY29uLWZpbG17YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggMDt9DQouaWNvbi10aC1sYXJnZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAwO30NCi5pY29uLXRoe2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IDA7fQ0KLmljb24tdGgtbGlzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAwO30NCi5pY29uLW9re2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IDA7fQ0KLmljb24tcmVtb3Zle2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IDA7fQ0KLmljb24tem9vbS1pbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAwO30NCi5pY29uLXpvb20tb3V0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IDA7fQ0KLmljb24tb2Zme2JhY2tncm91bmQtcG9zaXRpb246LTM4NHB4IDA7fQ0KLmljb24tc2lnbmFse2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IDA7fQ0KLmljb24tY29ne2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IDA7fQ0KLmljb24tdHJhc2h7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggMDt9DQouaWNvbi1ob21le2JhY2tncm91bmQtcG9zaXRpb246MCAtMjRweDt9DQouaWNvbi1maWxle2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTI0cHg7fQ0KLmljb24tdGltZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC0yNHB4O30NCi5pY29uLXJvYWR7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMjRweDt9DQouaWNvbi1kb3dubG9hZC1hbHR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMjRweDt9DQouaWNvbi1kb3dubG9hZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtMjRweDt9DQouaWNvbi11cGxvYWR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTI0cHg7fQ0KLmljb24taW5ib3h7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTI0cHg7fQ0KLmljb24tcGxheS1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggLTI0cHg7fQ0KLmljb24tcmVwZWF0e2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0yNHB4O30NCi5pY29uLXJlZnJlc2h7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTI0cHg7fQ0KLmljb24tbGlzdC1hbHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTI0cHg7fQ0KLmljb24tbG9ja3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODdweCAtMjRweDt9DQouaWNvbi1mbGFne2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC0yNHB4O30NCi5pY29uLWhlYWRwaG9uZXN7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTI0cHg7fQ0KLmljb24tdm9sdW1lLW9mZntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtMjRweDt9DQouaWNvbi12b2x1bWUtZG93bntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMjRweDt9DQouaWNvbi12b2x1bWUtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTI0cHg7fQ0KLmljb24tcXJjb2Rle2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0yNHB4O30NCi5pY29uLWJhcmNvZGV7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTI0cHg7fQ0KLmljb24tdGFne2JhY2tncm91bmQtcG9zaXRpb246MCAtNDhweDt9DQouaWNvbi10YWdze2JhY2tncm91bmQtcG9zaXRpb246LTI1cHggLTQ4cHg7fQ0KLmljb24tYm9va3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC00OHB4O30NCi5pY29uLWJvb2ttYXJre2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTQ4cHg7fQ0KLmljb24tcHJpbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtNDhweDt9DQouaWNvbi1jYW1lcmF7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTQ4cHg7fQ0KLmljb24tZm9udHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNDRweCAtNDhweDt9DQouaWNvbi1ib2xke2JhY2tncm91bmQtcG9zaXRpb246LTE2N3B4IC00OHB4O30NCi5pY29uLWl0YWxpY3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtNDhweDt9DQouaWNvbi10ZXh0LWhlaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAtNDhweDt9DQouaWNvbi10ZXh0LXdpZHRoe2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC00OHB4O30NCi5pY29uLWFsaWduLWxlZnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTQ4cHg7fQ0KLmljb24tYWxpZ24tY2VudGVye2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IC00OHB4O30NCi5pY29uLWFsaWduLXJpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC00OHB4O30NCi5pY29uLWFsaWduLWp1c3RpZnl7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTQ4cHg7fQ0KLmljb24tbGlzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtNDhweDt9DQouaWNvbi1pbmRlbnQtbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtNDhweDt9DQouaWNvbi1pbmRlbnQtcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTQ4cHg7fQ0KLmljb24tZmFjZXRpbWUtdmlkZW97YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTQ4cHg7fQ0KLmljb24tcGljdHVyZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtNDhweDt9DQouaWNvbi1wZW5jaWx7YmFja2dyb3VuZC1wb3NpdGlvbjowIC03MnB4O30NCi5pY29uLW1hcC1tYXJrZXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtNzJweDt9DQouaWNvbi1hZGp1c3R7YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtNzJweDt9DQouaWNvbi10aW50e2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTcycHg7fQ0KLmljb24tZWRpdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC03MnB4O30NCi5pY29uLXNoYXJle2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC03MnB4O30NCi5pY29uLWNoZWNre2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC03MnB4O30NCi5pY29uLW1vdmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTcycHg7fQ0KLmljb24tc3RlcC1iYWNrd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtNzJweDt9DQouaWNvbi1mYXN0LWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC03MnB4O30NCi5pY29uLWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC03MnB4O30NCi5pY29uLXBsYXl7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTcycHg7fQ0KLmljb24tcGF1c2V7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTcycHg7fQ0KLmljb24tc3RvcHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMTJweCAtNzJweDt9DQouaWNvbi1mb3J3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC03MnB4O30NCi5pY29uLWZhc3QtZm9yd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtNzJweDt9DQouaWNvbi1zdGVwLWZvcndhcmR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTcycHg7fQ0KLmljb24tZWplY3R7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTcycHg7fQ0KLmljb24tY2hldnJvbi1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC03MnB4O30NCi5pY29uLWNoZXZyb24tcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTcycHg7fQ0KLmljb24tcGx1cy1zaWdue2JhY2tncm91bmQtcG9zaXRpb246MCAtOTZweDt9DQouaWNvbi1taW51cy1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTk2cHg7fQ0KLmljb24tcmVtb3ZlLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtOTZweDt9DQouaWNvbi1vay1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTk2cHg7fQ0KLmljb24tcXVlc3Rpb24tc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC05NnB4O30NCi5pY29uLWluZm8tc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtOTZweDt9DQouaWNvbi1zY3JlZW5zaG90e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC05NnB4O30NCi5pY29uLXJlbW92ZS1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTk2cHg7fQ0KLmljb24tb2stY2lyY2xle2JhY2tncm91bmQtcG9zaXRpb246LTE5MnB4IC05NnB4O30NCi5pY29uLWJhbi1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTk2cHg7fQ0KLmljb24tYXJyb3ctbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNDBweCAtOTZweDt9DQouaWNvbi1hcnJvdy1yaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtOTZweDt9DQouaWNvbi1hcnJvdy11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODlweCAtOTZweDt9DQouaWNvbi1hcnJvdy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC05NnB4O30NCi5pY29uLXNoYXJlLWFsdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtOTZweDt9DQouaWNvbi1yZXNpemUtZnVsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtOTZweDt9DQouaWNvbi1yZXNpemUtc21hbGx7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTk2cHg7fQ0KLmljb24tcGx1c3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtOTZweDt9DQouaWNvbi1taW51c3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MzNweCAtOTZweDt9DQouaWNvbi1hc3Rlcmlza3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtOTZweDt9DQouaWNvbi1leGNsYW1hdGlvbi1zaWdue2JhY2tncm91bmQtcG9zaXRpb246MCAtMTIwcHg7fQ0KLmljb24tZ2lmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IC0xMjBweDt9DQouaWNvbi1sZWFme2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggLTEyMHB4O30NCi5pY29uLWZpcmV7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMTIwcHg7fQ0KLmljb24tZXllLW9wZW57YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMTIwcHg7fQ0KLmljb24tZXllLWNsb3Nle2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC0xMjBweDt9DQouaWNvbi13YXJuaW5nLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTEyMHB4O30NCi5pY29uLXBsYW5le2JhY2tncm91bmQtcG9zaXRpb246LTE2OHB4IC0xMjBweDt9DQouaWNvbi1jYWxlbmRhcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMTIwcHg7fQ0KLmljb24tcmFuZG9te2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0xMjBweDt3aWR0aDoxNnB4O30NCi5pY29uLWNvbW1lbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTEyMHB4O30NCi5pY29uLW1hZ25ldHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtMTIwcHg7fQ0KLmljb24tY2hldnJvbi11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODhweCAtMTIwcHg7fQ0KLmljb24tY2hldnJvbi1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxM3B4IC0xMTlweDt9DQouaWNvbi1yZXR3ZWV0e2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC0xMjBweDt9DQouaWNvbi1zaG9wcGluZy1jYXJ0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0xMjBweDt9DQouaWNvbi1mb2xkZXItY2xvc2V7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTEyMHB4O3dpZHRoOjE2cHg7fQ0KLmljb24tZm9sZGVyLW9wZW57YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTEyMHB4O3dpZHRoOjE2cHg7fQ0KLmljb24tcmVzaXplLXZlcnRpY2Fse2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0xMTlweDt9DQouaWNvbi1yZXNpemUtaG9yaXpvbnRhbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtMTE4cHg7fQ0KLmljb24taGRke2JhY2tncm91bmQtcG9zaXRpb246MCAtMTQ0cHg7fQ0KLmljb24tYnVsbGhvcm57YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtMTQ0cHg7fQ0KLmljb24tYmVsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC0xNDRweDt9DQouaWNvbi1jZXJ0aWZpY2F0ZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IC0xNDRweDt9DQouaWNvbi10aHVtYnMtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMTQ0cHg7fQ0KLmljb24tdGh1bWJzLWRvd257YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTE0NHB4O30NCi5pY29uLWhhbmQtcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTE0NHB4O30NCi5pY29uLWhhbmQtbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAtMTQ0cHg7fQ0KLmljb24taGFuZC11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMTQ0cHg7fQ0KLmljb24taGFuZC1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0xNDRweDt9DQouaWNvbi1jaXJjbGUtYXJyb3ctcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTE0NHB4O30NCi5pY29uLWNpcmNsZS1hcnJvdy1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTI2NHB4IC0xNDRweDt9DQouaWNvbi1jaXJjbGUtYXJyb3ctdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTE0NHB4O30NCi5pY29uLWNpcmNsZS1hcnJvdy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC0xNDRweDt9DQouaWNvbi1nbG9iZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtMTQ0cHg7fQ0KLmljb24td3JlbmNoe2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0xNDRweDt9DQouaWNvbi10YXNrc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMTQ0cHg7fQ0KLmljb24tZmlsdGVye2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IC0xNDRweDt9DQouaWNvbi1icmllZmNhc2V7YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTE0NHB4O30NCi5pY29uLWZ1bGxzY3JlZW57YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTE0NHB4O30NCi5idG4tZ3JvdXB7cG9zaXRpb246cmVsYXRpdmU7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7Zm9udC1zaXplOjA7dmVydGljYWwtYWxpZ246bWlkZGxlO3doaXRlLXNwYWNlOm5vd3JhcDsqbWFyZ2luLWxlZnQ6LjNlbTt9LmJ0bi1ncm91cDpmaXJzdC1jaGlsZHsqbWFyZ2luLWxlZnQ6MDt9DQouYnRuLWdyb3VwKy5idG4tZ3JvdXB7bWFyZ2luLWxlZnQ6NXB4O30NCi5idG4tdG9vbGJhcntmb250LXNpemU6MDttYXJnaW4tdG9wOjEwcHg7bWFyZ2luLWJvdHRvbToxMHB4O30uYnRuLXRvb2xiYXI+LmJ0bisuYnRuLC5idG4tdG9vbGJhcj4uYnRuLWdyb3VwKy5idG4sLmJ0bi10b29sYmFyPi5idG4rLmJ0bi1ncm91cHttYXJnaW4tbGVmdDo1cHg7fQ0KLmJ0bi1ncm91cD4uYnRue3Bvc2l0aW9uOnJlbGF0aXZlOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQouYnRuLWdyb3VwPi5idG4rLmJ0bnttYXJnaW4tbGVmdDotMXB4O30NCi5idG4tZ3JvdXA+LmJ0biwuYnRuLWdyb3VwPi5kcm9wZG93bi1tZW51LC5idG4tZ3JvdXA+LnBvcG92ZXJ7Zm9udC1zaXplOjE0cHg7fQ0KLmJ0bi1ncm91cD4uYnRuLW1pbml7Zm9udC1zaXplOjEwLjVweDt9DQouYnRuLWdyb3VwPi5idG4tc21hbGx7Zm9udC1zaXplOjExLjlweDt9DQouYnRuLWdyb3VwPi5idG4tbGFyZ2V7Zm9udC1zaXplOjE3LjVweDt9DQouYnRuLWdyb3VwPi5idG46Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDt9DQouYnRuLWdyb3VwPi5idG46bGFzdC1jaGlsZCwuYnRuLWdyb3VwPi5kcm9wZG93bi10b2dnbGV7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjRweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjRweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7fQ0KLmJ0bi1ncm91cD4uYnRuLmxhcmdlOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo2cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo2cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo2cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo2cHg7fQ0KLmJ0bi1ncm91cD4uYnRuLmxhcmdlOmxhc3QtY2hpbGQsLmJ0bi1ncm91cD4ubGFyZ2UuZHJvcGRvd24tdG9nZ2xley13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo2cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo2cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4O30NCi5idG4tZ3JvdXA+LmJ0bjpob3ZlciwuYnRuLWdyb3VwPi5idG46Zm9jdXMsLmJ0bi1ncm91cD4uYnRuOmFjdGl2ZSwuYnRuLWdyb3VwPi5idG4uYWN0aXZle3otaW5kZXg6Mjt9DQouYnRuLWdyb3VwIC5kcm9wZG93bi10b2dnbGU6YWN0aXZlLC5idG4tZ3JvdXAub3BlbiAuZHJvcGRvd24tdG9nZ2xle291dGxpbmU6MDt9DQouYnRuLWdyb3VwPi5idG4rLmRyb3Bkb3duLXRvZ2dsZXtwYWRkaW5nLWxlZnQ6OHB4O3BhZGRpbmctcmlnaHQ6OHB4Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEyNSksIGluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMiksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgyNTUsMjU1LDI1NSwuMTI1KSwgaW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4yKSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTtib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgyNTUsMjU1LDI1NSwuMTI1KSwgaW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4yKSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTsqcGFkZGluZy10b3A6NXB4OypwYWRkaW5nLWJvdHRvbTo1cHg7fQ0KLmJ0bi1ncm91cD4uYnRuLW1pbmkrLmRyb3Bkb3duLXRvZ2dsZXtwYWRkaW5nLWxlZnQ6NXB4O3BhZGRpbmctcmlnaHQ6NXB4OypwYWRkaW5nLXRvcDoycHg7KnBhZGRpbmctYm90dG9tOjJweDt9DQouYnRuLWdyb3VwPi5idG4tc21hbGwrLmRyb3Bkb3duLXRvZ2dsZXsqcGFkZGluZy10b3A6NXB4OypwYWRkaW5nLWJvdHRvbTo0cHg7fQ0KLmJ0bi1ncm91cD4uYnRuLWxhcmdlKy5kcm9wZG93bi10b2dnbGV7cGFkZGluZy1sZWZ0OjEycHg7cGFkZGluZy1yaWdodDoxMnB4OypwYWRkaW5nLXRvcDo3cHg7KnBhZGRpbmctYm90dG9tOjdweDt9DQouYnRuLWdyb3VwLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWltYWdlOm5vbmU7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMnB4IDRweCByZ2JhKDAsMCwwLC4xNSksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMnB4IDRweCByZ2JhKDAsMCwwLC4xNSksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwuMTUpLCAwIDFweCAycHggcmdiYSgwLDAsMCwuMDUpO30NCi5idG4tZ3JvdXAub3BlbiAuYnRuLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNlNmU2ZTY7fQ0KLmJ0bi1ncm91cC5vcGVuIC5idG4tcHJpbWFyeS5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojMDA0NGNjO30NCi5idG4tZ3JvdXAub3BlbiAuYnRuLXdhcm5pbmcuZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6I2Y4OTQwNjt9DQouYnRuLWdyb3VwLm9wZW4gLmJ0bi1kYW5nZXIuZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6I2JkMzYyZjt9DQouYnRuLWdyb3VwLm9wZW4gLmJ0bi1zdWNjZXNzLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiM1MWEzNTE7fQ0KLmJ0bi1ncm91cC5vcGVuIC5idG4taW5mby5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojMmY5NmI0O30NCi5idG4tZ3JvdXAub3BlbiAuYnRuLWludmVyc2UuZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzIyMjIyMjt9DQouYnRuIC5jYXJldHttYXJnaW4tdG9wOjhweDttYXJnaW4tbGVmdDowO30NCi5idG4tbGFyZ2UgLmNhcmV0e21hcmdpbi10b3A6NnB4O30NCi5idG4tbGFyZ2UgLmNhcmV0e2JvcmRlci1sZWZ0LXdpZHRoOjVweDtib3JkZXItcmlnaHQtd2lkdGg6NXB4O2JvcmRlci10b3Atd2lkdGg6NXB4O30NCi5idG4tbWluaSAuY2FyZXQsLmJ0bi1zbWFsbCAuY2FyZXR7bWFyZ2luLXRvcDo4cHg7fQ0KLmRyb3B1cCAuYnRuLWxhcmdlIC5jYXJldHtib3JkZXItYm90dG9tLXdpZHRoOjVweDt9DQouYnRuLXByaW1hcnkgLmNhcmV0LC5idG4td2FybmluZyAuY2FyZXQsLmJ0bi1kYW5nZXIgLmNhcmV0LC5idG4taW5mbyAuY2FyZXQsLmJ0bi1zdWNjZXNzIC5jYXJldCwuYnRuLWludmVyc2UgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6I2ZmZmZmZjtib3JkZXItYm90dG9tLWNvbG9yOiNmZmZmZmY7fQ0KLmJ0bi1ncm91cC12ZXJ0aWNhbHtkaXNwbGF5OmlubGluZS1ibG9jazsqZGlzcGxheTppbmxpbmU7Knpvb206MTt9DQouYnRuLWdyb3VwLXZlcnRpY2FsPi5idG57ZGlzcGxheTpibG9jaztmbG9hdDpub25lO21heC13aWR0aDoxMDAlOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQouYnRuLWdyb3VwLXZlcnRpY2FsPi5idG4rLmJ0bnttYXJnaW4tbGVmdDowO21hcmdpbi10b3A6LTFweDt9DQouYnRuLWdyb3VwLXZlcnRpY2FsPi5idG46Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCA0cHggMCAwOy1tb3otYm9yZGVyLXJhZGl1czo0cHggNHB4IDAgMDtib3JkZXItcmFkaXVzOjRweCA0cHggMCAwO30NCi5idG4tZ3JvdXAtdmVydGljYWw+LmJ0bjpsYXN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNHB4IDRweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7Ym9yZGVyLXJhZGl1czowIDAgNHB4IDRweDt9DQouYnRuLWdyb3VwLXZlcnRpY2FsPi5idG4tbGFyZ2U6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweCA2cHggMCAwOy1tb3otYm9yZGVyLXJhZGl1czo2cHggNnB4IDAgMDtib3JkZXItcmFkaXVzOjZweCA2cHggMCAwO30NCi5idG4tZ3JvdXAtdmVydGljYWw+LmJ0bi1sYXJnZTpsYXN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDAgNnB4IDZweDt9DQoubmF2e21hcmdpbi1sZWZ0OjA7bWFyZ2luLWJvdHRvbToyMHB4O2xpc3Qtc3R5bGU6bm9uZTt9DQoubmF2PmxpPmF7ZGlzcGxheTpibG9jazt9DQoubmF2PmxpPmE6aG92ZXIsLm5hdj5saT5hOmZvY3Vze3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtY29sb3I6I2VlZWVlZTt9DQoubmF2PmxpPmE+aW1ne21heC13aWR0aDpub25lO30NCi5uYXY+LnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHQ7fQ0KLm5hdi1oZWFkZXJ7ZGlzcGxheTpibG9jaztwYWRkaW5nOjNweCAxNXB4O2ZvbnQtc2l6ZToxMXB4O2ZvbnQtd2VpZ2h0OmJvbGQ7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojOTk5OTk5O3RleHQtc2hhZG93OjAgMXB4IDAgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjUpO3RleHQtdHJhbnNmb3JtOnVwcGVyY2FzZTt9DQoubmF2IGxpKy5uYXYtaGVhZGVye21hcmdpbi10b3A6OXB4O30NCi5uYXYtbGlzdHtwYWRkaW5nLWxlZnQ6MTVweDtwYWRkaW5nLXJpZ2h0OjE1cHg7bWFyZ2luLWJvdHRvbTowO30NCi5uYXYtbGlzdD5saT5hLC5uYXYtbGlzdCAubmF2LWhlYWRlcnttYXJnaW4tbGVmdDotMTVweDttYXJnaW4tcmlnaHQ6LTE1cHg7dGV4dC1zaGFkb3c6MCAxcHggMCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuNSk7fQ0KLm5hdi1saXN0PmxpPmF7cGFkZGluZzozcHggMTVweDt9DQoubmF2LWxpc3Q+LmFjdGl2ZT5hLC5uYXYtbGlzdD4uYWN0aXZlPmE6aG92ZXIsLm5hdi1saXN0Pi5hY3RpdmU+YTpmb2N1c3tjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yKTtiYWNrZ3JvdW5kLWNvbG9yOiMwMDg4Y2M7fQ0KLm5hdi1saXN0IFtjbGFzc149Imljb24tIl0sLm5hdi1saXN0IFtjbGFzcyo9IiBpY29uLSJde21hcmdpbi1yaWdodDoycHg7fQ0KLm5hdi1saXN0IC5kaXZpZGVyeyp3aWR0aDoxMDAlO2hlaWdodDoxcHg7bWFyZ2luOjlweCAxcHg7Km1hcmdpbjotNXB4IDAgNXB4O292ZXJmbG93OmhpZGRlbjtiYWNrZ3JvdW5kLWNvbG9yOiNlNWU1ZTU7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2ZmZmZmZjt9DQoubmF2LXRhYnMsLm5hdi1waWxsc3sqem9vbToxO30ubmF2LXRhYnM6YmVmb3JlLC5uYXYtcGlsbHM6YmVmb3JlLC5uYXYtdGFiczphZnRlciwubmF2LXBpbGxzOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5uYXYtdGFiczphZnRlciwubmF2LXBpbGxzOmFmdGVye2NsZWFyOmJvdGg7fQ0KLm5hdi10YWJzPmxpLC5uYXYtcGlsbHM+bGl7ZmxvYXQ6bGVmdDt9DQoubmF2LXRhYnM+bGk+YSwubmF2LXBpbGxzPmxpPmF7cGFkZGluZy1yaWdodDoxMnB4O3BhZGRpbmctbGVmdDoxMnB4O21hcmdpbi1yaWdodDoycHg7bGluZS1oZWlnaHQ6MTRweDt9DQoubmF2LXRhYnN7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2RkZDt9DQoubmF2LXRhYnM+bGl7bWFyZ2luLWJvdHRvbTotMXB4O30NCi5uYXYtdGFicz5saT5he3BhZGRpbmctdG9wOjhweDtwYWRkaW5nLWJvdHRvbTo4cHg7bGluZS1oZWlnaHQ6MjBweDtib3JkZXI6MXB4IHNvbGlkIHRyYW5zcGFyZW50Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggNHB4IDAgMDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7Ym9yZGVyLXJhZGl1czo0cHggNHB4IDAgMDt9Lm5hdi10YWJzPmxpPmE6aG92ZXIsLm5hdi10YWJzPmxpPmE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiNlZWVlZWUgI2VlZWVlZSAjZGRkZGRkO30NCi5uYXYtdGFicz4uYWN0aXZlPmEsLm5hdi10YWJzPi5hY3RpdmU+YTpob3ZlciwubmF2LXRhYnM+LmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiM1NTU1NTU7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO2JvcmRlcjoxcHggc29saWQgI2RkZDtib3JkZXItYm90dG9tLWNvbG9yOnRyYW5zcGFyZW50O2N1cnNvcjpkZWZhdWx0O30NCi5uYXYtcGlsbHM+bGk+YXtwYWRkaW5nLXRvcDo4cHg7cGFkZGluZy1ib3R0b206OHB4O21hcmdpbi10b3A6MnB4O21hcmdpbi1ib3R0b206MnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo1cHg7LW1vei1ib3JkZXItcmFkaXVzOjVweDtib3JkZXItcmFkaXVzOjVweDt9DQoubmF2LXBpbGxzPi5hY3RpdmU+YSwubmF2LXBpbGxzPi5hY3RpdmU+YTpob3ZlciwubmF2LXBpbGxzPi5hY3RpdmU+YTpmb2N1c3tjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6IzAwODhjYzt9DQoubmF2LXN0YWNrZWQ+bGl7ZmxvYXQ6bm9uZTt9DQoubmF2LXN0YWNrZWQ+bGk+YXttYXJnaW4tcmlnaHQ6MDt9DQoubmF2LXRhYnMubmF2LXN0YWNrZWR7Ym9yZGVyLWJvdHRvbTowO30NCi5uYXYtdGFicy5uYXYtc3RhY2tlZD5saT5he2JvcmRlcjoxcHggc29saWQgI2RkZDstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjA7fQ0KLm5hdi10YWJzLm5hdi1zdGFja2VkPmxpOmZpcnN0LWNoaWxkPmF7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjRweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7fQ0KLm5hdi10YWJzLm5hdi1zdGFja2VkPmxpOmxhc3QtY2hpbGQ+YXstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDt9DQoubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk+YTpob3ZlciwubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk+YTpmb2N1c3tib3JkZXItY29sb3I6I2RkZDt6LWluZGV4OjI7fQ0KLm5hdi1waWxscy5uYXYtc3RhY2tlZD5saT5he21hcmdpbi1ib3R0b206M3B4O30NCi5uYXYtcGlsbHMubmF2LXN0YWNrZWQ+bGk6bGFzdC1jaGlsZD5he21hcmdpbi1ib3R0b206MXB4O30NCi5uYXYtdGFicyAuZHJvcGRvd24tbWVudXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7fQ0KLm5hdi1waWxscyAuZHJvcGRvd24tbWVudXstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7fQ0KLm5hdiAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiMwMDg4Y2M7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDA4OGNjO21hcmdpbi10b3A6NnB4O30NCi5uYXYgLmRyb3Bkb3duLXRvZ2dsZTpob3ZlciAuY2FyZXQsLm5hdiAuZHJvcGRvd24tdG9nZ2xlOmZvY3VzIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiMwMDU1ODA7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDA1NTgwO30NCi5uYXYtdGFicyAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHttYXJnaW4tdG9wOjhweDt9DQoubmF2IC5hY3RpdmUgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZjt9DQoubmF2LXRhYnMgLmFjdGl2ZSAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM1NTU1NTU7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNTU1NTU1O30NCi5uYXY+LmRyb3Bkb3duLmFjdGl2ZT5hOmhvdmVyLC5uYXY+LmRyb3Bkb3duLmFjdGl2ZT5hOmZvY3Vze2N1cnNvcjpwb2ludGVyO30NCi5uYXYtdGFicyAub3BlbiAuZHJvcGRvd24tdG9nZ2xlLC5uYXYtcGlsbHMgLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZSwubmF2PmxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPmE6aG92ZXIsLm5hdj5saS5kcm9wZG93bi5vcGVuLmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojOTk5OTk5O2JvcmRlci1jb2xvcjojOTk5OTk5O30NCi5uYXYgbGkuZHJvcGRvd24ub3BlbiAuY2FyZXQsLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZSAuY2FyZXQsLm5hdiBsaS5kcm9wZG93bi5vcGVuIGE6aG92ZXIgLmNhcmV0LC5uYXYgbGkuZHJvcGRvd24ub3BlbiBhOmZvY3VzIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmZmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmZmZmO29wYWNpdHk6MTtmaWx0ZXI6YWxwaGEob3BhY2l0eT0xMDApO30NCi50YWJzLXN0YWNrZWQgLm9wZW4+YTpob3ZlciwudGFicy1zdGFja2VkIC5vcGVuPmE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiM5OTk5OTk7fQ0KLnRhYmJhYmxleyp6b29tOjE7fS50YWJiYWJsZTpiZWZvcmUsLnRhYmJhYmxlOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi50YWJiYWJsZTphZnRlcntjbGVhcjpib3RoO30NCi50YWItY29udGVudHtvdmVyZmxvdzphdXRvO30NCi50YWJzLWJlbG93Pi5uYXYtdGFicywudGFicy1yaWdodD4ubmF2LXRhYnMsLnRhYnMtbGVmdD4ubmF2LXRhYnN7Ym9yZGVyLWJvdHRvbTowO30NCi50YWItY29udGVudD4udGFiLXBhbmUsLnBpbGwtY29udGVudD4ucGlsbC1wYW5le2Rpc3BsYXk6bm9uZTt9DQoudGFiLWNvbnRlbnQ+LmFjdGl2ZSwucGlsbC1jb250ZW50Pi5hY3RpdmV7ZGlzcGxheTpibG9jazt9DQoudGFicy1iZWxvdz4ubmF2LXRhYnN7Ym9yZGVyLXRvcDoxcHggc29saWQgI2RkZDt9DQoudGFicy1iZWxvdz4ubmF2LXRhYnM+bGl7bWFyZ2luLXRvcDotMXB4O21hcmdpbi1ib3R0b206MDt9DQoudGFicy1iZWxvdz4ubmF2LXRhYnM+bGk+YXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA0cHggNHB4O2JvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7fS50YWJzLWJlbG93Pi5uYXYtdGFicz5saT5hOmhvdmVyLC50YWJzLWJlbG93Pi5uYXYtdGFicz5saT5hOmZvY3Vze2JvcmRlci1ib3R0b20tY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLXRvcC1jb2xvcjojZGRkO30NCi50YWJzLWJlbG93Pi5uYXYtdGFicz4uYWN0aXZlPmEsLnRhYnMtYmVsb3c+Lm5hdi10YWJzPi5hY3RpdmU+YTpob3ZlciwudGFicy1iZWxvdz4ubmF2LXRhYnM+LmFjdGl2ZT5hOmZvY3Vze2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudCAjZGRkICNkZGQgI2RkZDt9DQoudGFicy1sZWZ0Pi5uYXYtdGFicz5saSwudGFicy1yaWdodD4ubmF2LXRhYnM+bGl7ZmxvYXQ6bm9uZTt9DQoudGFicy1sZWZ0Pi5uYXYtdGFicz5saT5hLC50YWJzLXJpZ2h0Pi5uYXYtdGFicz5saT5he21pbi13aWR0aDo3NHB4O21hcmdpbi1yaWdodDowO21hcmdpbi1ib3R0b206M3B4O30NCi50YWJzLWxlZnQ+Lm5hdi10YWJze2Zsb2F0OmxlZnQ7bWFyZ2luLXJpZ2h0OjE5cHg7Ym9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZGRkO30NCi50YWJzLWxlZnQ+Lm5hdi10YWJzPmxpPmF7bWFyZ2luLXJpZ2h0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDtib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4O30NCi50YWJzLWxlZnQ+Lm5hdi10YWJzPmxpPmE6aG92ZXIsLnRhYnMtbGVmdD4ubmF2LXRhYnM+bGk+YTpmb2N1c3tib3JkZXItY29sb3I6I2VlZWVlZSAjZGRkZGRkICNlZWVlZWUgI2VlZWVlZTt9DQoudGFicy1sZWZ0Pi5uYXYtdGFicyAuYWN0aXZlPmEsLnRhYnMtbGVmdD4ubmF2LXRhYnMgLmFjdGl2ZT5hOmhvdmVyLC50YWJzLWxlZnQ+Lm5hdi10YWJzIC5hY3RpdmU+YTpmb2N1c3tib3JkZXItY29sb3I6I2RkZCB0cmFuc3BhcmVudCAjZGRkICNkZGQ7KmJvcmRlci1yaWdodC1jb2xvcjojZmZmZmZmO30NCi50YWJzLXJpZ2h0Pi5uYXYtdGFic3tmbG9hdDpyaWdodDttYXJnaW4tbGVmdDoxOXB4O2JvcmRlci1sZWZ0OjFweCBzb2xpZCAjZGRkO30NCi50YWJzLXJpZ2h0Pi5uYXYtdGFicz5saT5he21hcmdpbi1sZWZ0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO30NCi50YWJzLXJpZ2h0Pi5uYXYtdGFicz5saT5hOmhvdmVyLC50YWJzLXJpZ2h0Pi5uYXYtdGFicz5saT5hOmZvY3Vze2JvcmRlci1jb2xvcjojZWVlZWVlICNlZWVlZWUgI2VlZWVlZSAjZGRkZGRkO30NCi50YWJzLXJpZ2h0Pi5uYXYtdGFicyAuYWN0aXZlPmEsLnRhYnMtcmlnaHQ+Lm5hdi10YWJzIC5hY3RpdmU+YTpob3ZlciwudGFicy1yaWdodD4ubmF2LXRhYnMgLmFjdGl2ZT5hOmZvY3Vze2JvcmRlci1jb2xvcjojZGRkICNkZGQgI2RkZCB0cmFuc3BhcmVudDsqYm9yZGVyLWxlZnQtY29sb3I6I2ZmZmZmZjt9DQoubmF2Pi5kaXNhYmxlZD5he2NvbG9yOiM5OTk5OTk7fQ0KLm5hdj4uZGlzYWJsZWQ+YTpob3ZlciwubmF2Pi5kaXNhYmxlZD5hOmZvY3Vze3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Y3Vyc29yOmRlZmF1bHQ7fQ0KLm5hdmJhcntvdmVyZmxvdzp2aXNpYmxlO21hcmdpbi1ib3R0b206MjBweDsqcG9zaXRpb246cmVsYXRpdmU7KnotaW5kZXg6Mjt9DQoubmF2YmFyLWlubmVye21pbi1oZWlnaHQ6NDBweDtwYWRkaW5nLWxlZnQ6MjBweDtwYWRkaW5nLXJpZ2h0OjIwcHg7YmFja2dyb3VuZC1jb2xvcjojZmFmYWZhO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZmZmZmZmLCAjZjJmMmYyKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZmZmZmZmKSwgdG8oI2YyZjJmMikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZmZmZmZmLCAjZjJmMmYyKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNmZmZmZmYsICNmMmYyZjIpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2ZmZmZmZiwgI2YyZjJmMik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZmZmZmZmYnLCBlbmRDb2xvcnN0cj0nI2ZmZjJmMmYyJywgR3JhZGllbnRUeXBlPTApO2JvcmRlcjoxcHggc29saWQgI2Q0ZDRkNDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsIDAsIDAsIDAuMDY1KTstbW96LWJveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwgMCwgMCwgMC4wNjUpO2JveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwgMCwgMCwgMC4wNjUpOyp6b29tOjE7fS5uYXZiYXItaW5uZXI6YmVmb3JlLC5uYXZiYXItaW5uZXI6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLm5hdmJhci1pbm5lcjphZnRlcntjbGVhcjpib3RoO30NCi5uYXZiYXIgLmNvbnRhaW5lcnt3aWR0aDphdXRvO30NCi5uYXYtY29sbGFwc2UuY29sbGFwc2V7aGVpZ2h0OmF1dG87b3ZlcmZsb3c6dmlzaWJsZTt9DQoubmF2YmFyIC5icmFuZHtmbG9hdDpsZWZ0O2Rpc3BsYXk6YmxvY2s7cGFkZGluZzoxMHB4IDIwcHggMTBweDttYXJnaW4tbGVmdDotMjBweDtmb250LXNpemU6MjBweDtmb250LXdlaWdodDoyMDA7Y29sb3I6Izc3Nzc3Nzt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmZmZmY7fS5uYXZiYXIgLmJyYW5kOmhvdmVyLC5uYXZiYXIgLmJyYW5kOmZvY3Vze3RleHQtZGVjb3JhdGlvbjpub25lO30NCi5uYXZiYXItdGV4dHttYXJnaW4tYm90dG9tOjA7bGluZS1oZWlnaHQ6NDBweDtjb2xvcjojNzc3Nzc3O30NCi5uYXZiYXItbGlua3tjb2xvcjojNzc3Nzc3O30ubmF2YmFyLWxpbms6aG92ZXIsLm5hdmJhci1saW5rOmZvY3Vze2NvbG9yOiMzMzMzMzM7fQ0KLm5hdmJhciAuZGl2aWRlci12ZXJ0aWNhbHtoZWlnaHQ6NDBweDttYXJnaW46MCA5cHg7Ym9yZGVyLWxlZnQ6MXB4IHNvbGlkICNmMmYyZjI7Ym9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZmZmZmZmO30NCi5uYXZiYXIgLmJ0biwubmF2YmFyIC5idG4tZ3JvdXB7bWFyZ2luLXRvcDo1cHg7fQ0KLm5hdmJhciAuYnRuLWdyb3VwIC5idG4sLm5hdmJhciAuaW5wdXQtcHJlcGVuZCAuYnRuLC5uYXZiYXIgLmlucHV0LWFwcGVuZCAuYnRuLC5uYXZiYXIgLmlucHV0LXByZXBlbmQgLmJ0bi1ncm91cCwubmF2YmFyIC5pbnB1dC1hcHBlbmQgLmJ0bi1ncm91cHttYXJnaW4tdG9wOjA7fQ0KLm5hdmJhci1mb3Jte21hcmdpbi1ib3R0b206MDsqem9vbToxO30ubmF2YmFyLWZvcm06YmVmb3JlLC5uYXZiYXItZm9ybTphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoubmF2YmFyLWZvcm06YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQoubmF2YmFyLWZvcm0gaW5wdXQsLm5hdmJhci1mb3JtIHNlbGVjdCwubmF2YmFyLWZvcm0gLnJhZGlvLC5uYXZiYXItZm9ybSAuY2hlY2tib3h7bWFyZ2luLXRvcDo1cHg7fQ0KLm5hdmJhci1mb3JtIGlucHV0LC5uYXZiYXItZm9ybSBzZWxlY3QsLm5hdmJhci1mb3JtIC5idG57ZGlzcGxheTppbmxpbmUtYmxvY2s7bWFyZ2luLWJvdHRvbTowO30NCi5uYXZiYXItZm9ybSBpbnB1dFt0eXBlPSJpbWFnZSJdLC5uYXZiYXItZm9ybSBpbnB1dFt0eXBlPSJjaGVja2JveCJdLC5uYXZiYXItZm9ybSBpbnB1dFt0eXBlPSJyYWRpbyJde21hcmdpbi10b3A6M3B4O30NCi5uYXZiYXItZm9ybSAuaW5wdXQtYXBwZW5kLC5uYXZiYXItZm9ybSAuaW5wdXQtcHJlcGVuZHttYXJnaW4tdG9wOjVweDt3aGl0ZS1zcGFjZTpub3dyYXA7fS5uYXZiYXItZm9ybSAuaW5wdXQtYXBwZW5kIGlucHV0LC5uYXZiYXItZm9ybSAuaW5wdXQtcHJlcGVuZCBpbnB1dHttYXJnaW4tdG9wOjA7fQ0KLm5hdmJhci1zZWFyY2h7cG9zaXRpb246cmVsYXRpdmU7ZmxvYXQ6bGVmdDttYXJnaW4tdG9wOjVweDttYXJnaW4tYm90dG9tOjA7fS5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnl7bWFyZ2luLWJvdHRvbTowO3BhZGRpbmc6NHB4IDE0cHg7Zm9udC1mYW1pbHk6IkhlbHZldGljYSBOZXVlIixIZWx2ZXRpY2EsQXJpYWwsc2Fucy1zZXJpZjtmb250LXNpemU6MTNweDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MTstd2Via2l0LWJvcmRlci1yYWRpdXM6MTVweDstbW96LWJvcmRlci1yYWRpdXM6MTVweDtib3JkZXItcmFkaXVzOjE1cHg7fQ0KLm5hdmJhci1zdGF0aWMtdG9we3Bvc2l0aW9uOnN0YXRpYzttYXJnaW4tYm90dG9tOjA7fS5uYXZiYXItc3RhdGljLXRvcCAubmF2YmFyLWlubmVyey13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQoubmF2YmFyLWZpeGVkLXRvcCwubmF2YmFyLWZpeGVkLWJvdHRvbXtwb3NpdGlvbjpmaXhlZDtyaWdodDowO2xlZnQ6MDt6LWluZGV4OjEwMzA7bWFyZ2luLWJvdHRvbTowO30NCi5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1zdGF0aWMtdG9wIC5uYXZiYXItaW5uZXJ7Ym9yZGVyLXdpZHRoOjAgMCAxcHg7fQ0KLm5hdmJhci1maXhlZC1ib3R0b20gLm5hdmJhci1pbm5lcntib3JkZXItd2lkdGg6MXB4IDAgMDt9DQoubmF2YmFyLWZpeGVkLXRvcCAubmF2YmFyLWlubmVyLC5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7cGFkZGluZy1sZWZ0OjA7cGFkZGluZy1yaWdodDowOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQoubmF2YmFyLXN0YXRpYy10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtYm90dG9tIC5jb250YWluZXJ7d2lkdGg6OTQwcHg7fQ0KLm5hdmJhci1maXhlZC10b3B7dG9wOjA7fQ0KLm5hdmJhci1maXhlZC10b3AgLm5hdmJhci1pbm5lciwubmF2YmFyLXN0YXRpYy10b3AgLm5hdmJhci1pbm5lcnstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggMTBweCByZ2JhKDAsMCwwLC4xKTstbW96LWJveC1zaGFkb3c6MCAxcHggMTBweCByZ2JhKDAsMCwwLC4xKTtib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwuMSk7fQ0KLm5hdmJhci1maXhlZC1ib3R0b217Ym90dG9tOjA7fS5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7LXdlYmtpdC1ib3gtc2hhZG93OjAgLTFweCAxMHB4IHJnYmEoMCwwLDAsLjEpOy1tb3otYm94LXNoYWRvdzowIC0xcHggMTBweCByZ2JhKDAsMCwwLC4xKTtib3gtc2hhZG93OjAgLTFweCAxMHB4IHJnYmEoMCwwLDAsLjEpO30NCi5uYXZiYXIgLm5hdntwb3NpdGlvbjpyZWxhdGl2ZTtsZWZ0OjA7ZGlzcGxheTpibG9jaztmbG9hdDpsZWZ0O21hcmdpbjowIDEwcHggMCAwO30NCi5uYXZiYXIgLm5hdi5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O21hcmdpbi1yaWdodDowO30NCi5uYXZiYXIgLm5hdj5saXtmbG9hdDpsZWZ0O30NCi5uYXZiYXIgLm5hdj5saT5he2Zsb2F0Om5vbmU7cGFkZGluZzoxMHB4IDE1cHggMTBweDtjb2xvcjojNzc3Nzc3O3RleHQtZGVjb3JhdGlvbjpub25lO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZmZmZjt9DQoubmF2YmFyIC5uYXYgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7bWFyZ2luLXRvcDo4cHg7fQ0KLm5hdmJhciAubmF2PmxpPmE6Zm9jdXMsLm5hdmJhciAubmF2PmxpPmE6aG92ZXJ7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtjb2xvcjojMzMzMzMzO3RleHQtZGVjb3JhdGlvbjpub25lO30NCi5uYXZiYXIgLm5hdj4uYWN0aXZlPmEsLm5hdmJhciAubmF2Pi5hY3RpdmU+YTpob3ZlciwubmF2YmFyIC5uYXY+LmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiM1NTU1NTU7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDNweCA4cHggcmdiYSgwLCAwLCAwLCAwLjEyNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgM3B4IDhweCByZ2JhKDAsIDAsIDAsIDAuMTI1KTtib3gtc2hhZG93Omluc2V0IDAgM3B4IDhweCByZ2JhKDAsIDAsIDAsIDAuMTI1KTt9DQoubmF2YmFyIC5idG4tbmF2YmFye2Rpc3BsYXk6bm9uZTtmbG9hdDpyaWdodDtwYWRkaW5nOjdweCAxMHB4O21hcmdpbi1sZWZ0OjVweDttYXJnaW4tcmlnaHQ6NXB4O2NvbG9yOiNmZmZmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiNlZGVkZWQ7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICNmMmYyZjIsICNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCNmMmYyZjIpLCB0bygjZTVlNWU1KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICNmMmYyZjIsICNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgI2YyZjJmMiwgI2U1ZTVlNSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjZjJmMmYyLCAjZTVlNWU1KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmYyZjJmMicsIGVuZENvbG9yc3RyPScjZmZlNWU1ZTUnLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyLWNvbG9yOiNlNWU1ZTUgI2U1ZTVlNSAjYmZiZmJmO2JvcmRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4yNSk7KmJhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQgPSBmYWxzZSk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMSksIDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xKSwgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xKSwgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4wNzUpO30ubmF2YmFyIC5idG4tbmF2YmFyOmhvdmVyLC5uYXZiYXIgLmJ0bi1uYXZiYXI6Zm9jdXMsLm5hdmJhciAuYnRuLW5hdmJhcjphY3RpdmUsLm5hdmJhciAuYnRuLW5hdmJhci5hY3RpdmUsLm5hdmJhciAuYnRuLW5hdmJhci5kaXNhYmxlZCwubmF2YmFyIC5idG4tbmF2YmFyW2Rpc2FibGVkXXtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNTsqYmFja2dyb3VuZC1jb2xvcjojZDlkOWQ5O30NCi5uYXZiYXIgLmJ0bi1uYXZiYXI6YWN0aXZlLC5uYXZiYXIgLmJ0bi1uYXZiYXIuYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2NjY2NjYyBcOTt9DQoubmF2YmFyIC5idG4tbmF2YmFyIC5pY29uLWJhcntkaXNwbGF5OmJsb2NrO3dpZHRoOjE4cHg7aGVpZ2h0OjJweDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjFweDstbW96LWJvcmRlci1yYWRpdXM6MXB4O2JvcmRlci1yYWRpdXM6MXB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtib3gtc2hhZG93OjAgMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTt9DQouYnRuLW5hdmJhciAuaWNvbi1iYXIrLmljb24tYmFye21hcmdpbi10b3A6M3B4O30NCi5uYXZiYXIgLm5hdj5saT4uZHJvcGRvd24tbWVudTpiZWZvcmV7Y29udGVudDonJztkaXNwbGF5OmlubGluZS1ibG9jaztib3JkZXItbGVmdDo3cHggc29saWQgdHJhbnNwYXJlbnQ7Ym9yZGVyLXJpZ2h0OjdweCBzb2xpZCB0cmFuc3BhcmVudDtib3JkZXItYm90dG9tOjdweCBzb2xpZCAjY2NjO2JvcmRlci1ib3R0b20tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjIpO3Bvc2l0aW9uOmFic29sdXRlO3RvcDotN3B4O2xlZnQ6OXB4O30NCi5uYXZiYXIgLm5hdj5saT4uZHJvcGRvd24tbWVudTphZnRlcntjb250ZW50OicnO2Rpc3BsYXk6aW5saW5lLWJsb2NrO2JvcmRlci1sZWZ0OjZweCBzb2xpZCB0cmFuc3BhcmVudDtib3JkZXItcmlnaHQ6NnB4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1ib3R0b206NnB4IHNvbGlkICNmZmZmZmY7cG9zaXRpb246YWJzb2x1dGU7dG9wOi02cHg7bGVmdDoxMHB4O30NCi5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YmVmb3Jle2JvcmRlci10b3A6N3B4IHNvbGlkICNjY2M7Ym9yZGVyLXRvcC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMik7Ym9yZGVyLWJvdHRvbTowO2JvdHRvbTotN3B4O3RvcDphdXRvO30NCi5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXJ7Ym9yZGVyLXRvcDo2cHggc29saWQgI2ZmZmZmZjtib3JkZXItYm90dG9tOjA7Ym90dG9tOi02cHg7dG9wOmF1dG87fQ0KLm5hdmJhciAubmF2IGxpLmRyb3Bkb3duPmE6aG92ZXIgLmNhcmV0LC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bj5hOmZvY3VzIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiMzMzMzMzM7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMzMzMzMzO30NCi5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5vcGVuPi5kcm9wZG93bi10b2dnbGUsLm5hdmJhciAubmF2IGxpLmRyb3Bkb3duLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtjb2xvcjojNTU1NTU1O30NCi5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM3Nzc3Nzc7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNzc3Nzc3O30NCi5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5vcGVuPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXQsLm5hdmJhciAubmF2IGxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6IzU1NTU1NTtib3JkZXItYm90dG9tLWNvbG9yOiM1NTU1NTU7fQ0KLm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudSwubmF2YmFyIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnUucHVsbC1yaWdodHtsZWZ0OmF1dG87cmlnaHQ6MDt9Lm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudTpiZWZvcmUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQ6YmVmb3Jle2xlZnQ6YXV0bztyaWdodDoxMnB4O30NCi5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXIsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQ6YWZ0ZXJ7bGVmdDphdXRvO3JpZ2h0OjEzcHg7fQ0KLm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudSAuZHJvcGRvd24tbWVudSwubmF2YmFyIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnUucHVsbC1yaWdodCAuZHJvcGRvd24tbWVudXtsZWZ0OmF1dG87cmlnaHQ6MTAwJTttYXJnaW4tbGVmdDowO21hcmdpbi1yaWdodDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDt9DQoubmF2YmFyLWludmVyc2UgLm5hdmJhci1pbm5lcntiYWNrZ3JvdW5kLWNvbG9yOiMxYjFiMWI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICMyMjIyMjIsICMxMTExMTEpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCMyMjIyMjIpLCB0bygjMTExMTExKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICMyMjIyMjIsICMxMTExMTEpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzIyMjIyMiwgIzExMTExMSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjMjIyMjIyLCAjMTExMTExKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjIyMjIyMicsIGVuZENvbG9yc3RyPScjZmYxMTExMTEnLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyLWNvbG9yOiMyNTI1MjU7fQ0KLm5hdmJhci1pbnZlcnNlIC5icmFuZCwubmF2YmFyLWludmVyc2UgLm5hdj5saT5he2NvbG9yOiM5OTk5OTk7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTt9Lm5hdmJhci1pbnZlcnNlIC5icmFuZDpob3ZlciwubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAuYnJhbmQ6Zm9jdXMsLm5hdmJhci1pbnZlcnNlIC5uYXY+bGk+YTpmb2N1c3tjb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAuYnJhbmR7Y29sb3I6Izk5OTk5OTt9DQoubmF2YmFyLWludmVyc2UgLm5hdmJhci10ZXh0e2NvbG9yOiM5OTk5OTk7fQ0KLm5hdmJhci1pbnZlcnNlIC5uYXY+bGk+YTpmb2N1cywubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmhvdmVye2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Y29sb3I6I2ZmZmZmZjt9DQoubmF2YmFyLWludmVyc2UgLm5hdiAuYWN0aXZlPmEsLm5hdmJhci1pbnZlcnNlIC5uYXYgLmFjdGl2ZT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2IC5hY3RpdmU+YTpmb2N1c3tjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6IzExMTExMTt9DQoubmF2YmFyLWludmVyc2UgLm5hdmJhci1saW5re2NvbG9yOiM5OTk5OTk7fS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLWxpbms6aG92ZXIsLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItbGluazpmb2N1c3tjb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAuZGl2aWRlci12ZXJ0aWNhbHtib3JkZXItbGVmdC1jb2xvcjojMTExMTExO2JvcmRlci1yaWdodC1jb2xvcjojMjIyMjIyO30NCi5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzExMTExMTtjb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duPmE6aG92ZXIgLmNhcmV0LC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duPmE6Zm9jdXMgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6I2ZmZmZmZjtib3JkZXItYm90dG9tLWNvbG9yOiNmZmZmZmY7fQ0KLm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojOTk5OTk5O2JvcmRlci1ib3R0b20tY29sb3I6Izk5OTk5OTt9DQoubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5vcGVuPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldCwubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmZmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5e2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojNTE1MTUxO2JvcmRlci1jb2xvcjojMTExMTExOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwuMSksIDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMTUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwuMSksIDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMTUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjE1KTstd2Via2l0LXRyYW5zaXRpb246bm9uZTstbW96LXRyYW5zaXRpb246bm9uZTstby10cmFuc2l0aW9uOm5vbmU7dHJhbnNpdGlvbjpub25lO30ubmF2YmFyLWludmVyc2UgLm5hdmJhci1zZWFyY2ggLnNlYXJjaC1xdWVyeTotbW96LXBsYWNlaG9sZGVye2NvbG9yOiNjY2NjY2M7fQ0KLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6LW1zLWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiNjY2NjY2M7fQ0KLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXJ7Y29sb3I6I2NjY2NjYzt9DQoubmF2YmFyLWludmVyc2UgLm5hdmJhci1zZWFyY2ggLnNlYXJjaC1xdWVyeTpmb2N1cywubmF2YmFyLWludmVyc2UgLm5hdmJhci1zZWFyY2ggLnNlYXJjaC1xdWVyeS5mb2N1c2Vke3BhZGRpbmc6NXB4IDE1cHg7Y29sb3I6IzMzMzMzMzt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO2JvcmRlcjowOy13ZWJraXQtYm94LXNoYWRvdzowIDAgM3B4IHJnYmEoMCwgMCwgMCwgMC4xNSk7LW1vei1ib3gtc2hhZG93OjAgMCAzcHggcmdiYSgwLCAwLCAwLCAwLjE1KTtib3gtc2hhZG93OjAgMCAzcHggcmdiYSgwLCAwLCAwLCAwLjE1KTtvdXRsaW5lOjA7fQ0KLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFye2NvbG9yOiNmZmZmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMwZTBlMGU7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICMxNTE1MTUsICMwNDA0MDQpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCMxNTE1MTUpLCB0bygjMDQwNDA0KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICMxNTE1MTUsICMwNDA0MDQpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzE1MTUxNSwgIzA0MDQwNCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjMTUxNTE1LCAjMDQwNDA0KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjE1MTUxNScsIGVuZENvbG9yc3RyPScjZmYwNDA0MDQnLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyLWNvbG9yOiMwNDA0MDQgIzA0MDQwNCAjMDAwMDAwO2JvcmRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4yNSk7KmJhY2tncm91bmQtY29sb3I6IzA0MDQwNDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQgPSBmYWxzZSk7fS5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcjpob3ZlciwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXI6Zm9jdXMsLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXIuYWN0aXZlLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhci5kaXNhYmxlZCwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXJbZGlzYWJsZWRde2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojMDQwNDA0OypiYWNrZ3JvdW5kLWNvbG9yOiMwMDAwMDA7fQ0KLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXIuYWN0aXZle2JhY2tncm91bmQtY29sb3I6IzAwMDAwMCBcOTt9DQouYnJlYWRjcnVtYntwYWRkaW5nOjhweCAxNXB4O21hcmdpbjowIDAgMjBweDtsaXN0LXN0eWxlOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9LmJyZWFkY3J1bWI+bGl7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmZmZmO30uYnJlYWRjcnVtYj5saT4uZGl2aWRlcntwYWRkaW5nOjAgNXB4O2NvbG9yOiNjY2M7fQ0KLmJyZWFkY3J1bWI+LmFjdGl2ZXtjb2xvcjojOTk5OTk5O30NCi5wYWdpbmF0aW9ue21hcmdpbjoyMHB4IDA7fQ0KLnBhZ2luYXRpb24gdWx7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7bWFyZ2luLWxlZnQ6MDttYXJnaW4tYm90dG9tOjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLCAwLCAwLCAwLjA1KTstbW96LWJveC1zaGFkb3c6MCAxcHggMnB4IHJnYmEoMCwgMCwgMCwgMC4wNSk7Ym94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLCAwLCAwLCAwLjA1KTt9DQoucGFnaW5hdGlvbiB1bD5saXtkaXNwbGF5OmlubGluZTt9DQoucGFnaW5hdGlvbiB1bD5saT5hLC5wYWdpbmF0aW9uIHVsPmxpPnNwYW57ZmxvYXQ6bGVmdDtwYWRkaW5nOjRweCAxMnB4O2xpbmUtaGVpZ2h0OjIwcHg7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO2JvcmRlcjoxcHggc29saWQgI2RkZGRkZDtib3JkZXItbGVmdC13aWR0aDowO30NCi5wYWdpbmF0aW9uIHVsPmxpPmE6aG92ZXIsLnBhZ2luYXRpb24gdWw+bGk+YTpmb2N1cywucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTt9DQoucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2NvbG9yOiM5OTk5OTk7Y3Vyc29yOmRlZmF1bHQ7fQ0KLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPnNwYW4sLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmEsLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmE6aG92ZXIsLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmE6Zm9jdXN7Y29sb3I6Izk5OTk5OTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2N1cnNvcjpkZWZhdWx0O30NCi5wYWdpbmF0aW9uIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24gdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbntib3JkZXItbGVmdC13aWR0aDoxcHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7fQ0KLnBhZ2luYXRpb24gdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uIHVsPmxpOmxhc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDt9DQoucGFnaW5hdGlvbi1jZW50ZXJlZHt0ZXh0LWFsaWduOmNlbnRlcjt9DQoucGFnaW5hdGlvbi1yaWdodHt0ZXh0LWFsaWduOnJpZ2h0O30NCi5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk+c3BhbntwYWRkaW5nOjExcHggMTlweDtmb250LXNpemU6MTcuNXB4O30NCi5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjZweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjZweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjZweDt9DQoucGFnaW5hdGlvbi1sYXJnZSB1bD5saTpsYXN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6bGFzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo2cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo2cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4O30NCi5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6M3B4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6M3B4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6M3B4O2JvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6M3B4O30NCi5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLXNtYWxsIHVsPmxpOmxhc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1taW5pIHVsPmxpOmxhc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpsYXN0LWNoaWxkPnNwYW57LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjNweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czozcHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjNweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czozcHg7fQ0KLnBhZ2luYXRpb24tc21hbGwgdWw+bGk+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saT5zcGFue3BhZGRpbmc6MnB4IDEwcHg7Zm9udC1zaXplOjExLjlweDt9DQoucGFnaW5hdGlvbi1taW5pIHVsPmxpPmEsLnBhZ2luYXRpb24tbWluaSB1bD5saT5zcGFue3BhZGRpbmc6MCA2cHg7Zm9udC1zaXplOjEwLjVweDt9DQoucGFnZXJ7bWFyZ2luOjIwcHggMDtsaXN0LXN0eWxlOm5vbmU7dGV4dC1hbGlnbjpjZW50ZXI7Knpvb206MTt9LnBhZ2VyOmJlZm9yZSwucGFnZXI6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLnBhZ2VyOmFmdGVye2NsZWFyOmJvdGg7fQ0KLnBhZ2VyIGxpe2Rpc3BsYXk6aW5saW5lO30NCi5wYWdlciBsaT5hLC5wYWdlciBsaT5zcGFue2Rpc3BsYXk6aW5saW5lLWJsb2NrO3BhZGRpbmc6NXB4IDE0cHg7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2RkZDstd2Via2l0LWJvcmRlci1yYWRpdXM6MTVweDstbW96LWJvcmRlci1yYWRpdXM6MTVweDtib3JkZXItcmFkaXVzOjE1cHg7fQ0KLnBhZ2VyIGxpPmE6aG92ZXIsLnBhZ2VyIGxpPmE6Zm9jdXN7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O30NCi5wYWdlciAubmV4dD5hLC5wYWdlciAubmV4dD5zcGFue2Zsb2F0OnJpZ2h0O30NCi5wYWdlciAucHJldmlvdXM+YSwucGFnZXIgLnByZXZpb3VzPnNwYW57ZmxvYXQ6bGVmdDt9DQoucGFnZXIgLmRpc2FibGVkPmEsLnBhZ2VyIC5kaXNhYmxlZD5hOmhvdmVyLC5wYWdlciAuZGlzYWJsZWQ+YTpmb2N1cywucGFnZXIgLmRpc2FibGVkPnNwYW57Y29sb3I6Izk5OTk5OTtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Y3Vyc29yOmRlZmF1bHQ7fQ0KLnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6LTIwcHg7bGlzdC1zdHlsZTpub25lOyp6b29tOjE7fS50aHVtYm5haWxzOmJlZm9yZSwudGh1bWJuYWlsczphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoudGh1bWJuYWlsczphZnRlcntjbGVhcjpib3RoO30NCi5yb3ctZmx1aWQgLnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6MDt9DQoudGh1bWJuYWlscz5saXtmbG9hdDpsZWZ0O21hcmdpbi1ib3R0b206MjBweDttYXJnaW4tbGVmdDoyMHB4O30NCi50aHVtYm5haWx7ZGlzcGxheTpibG9jaztwYWRkaW5nOjRweDtsaW5lLWhlaWdodDoyMHB4O2JvcmRlcjoxcHggc29saWQgI2RkZDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMDU1KTstbW96LWJveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4wNTUpO2JveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4wNTUpOy13ZWJraXQtdHJhbnNpdGlvbjphbGwgMC4ycyBlYXNlLWluLW91dDstbW96LXRyYW5zaXRpb246YWxsIDAuMnMgZWFzZS1pbi1vdXQ7LW8tdHJhbnNpdGlvbjphbGwgMC4ycyBlYXNlLWluLW91dDt0cmFuc2l0aW9uOmFsbCAwLjJzIGVhc2UtaW4tb3V0O30NCmEudGh1bWJuYWlsOmhvdmVyLGEudGh1bWJuYWlsOmZvY3Vze2JvcmRlci1jb2xvcjojMDA4OGNjOy13ZWJraXQtYm94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLCAxMDUsIDIxNCwgMC4yNSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsIDEwNSwgMjE0LCAwLjI1KTtib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsIDEwNSwgMjE0LCAwLjI1KTt9DQoudGh1bWJuYWlsPmltZ3tkaXNwbGF5OmJsb2NrO21heC13aWR0aDoxMDAlO21hcmdpbi1sZWZ0OmF1dG87bWFyZ2luLXJpZ2h0OmF1dG87fQ0KLnRodW1ibmFpbCAuY2FwdGlvbntwYWRkaW5nOjlweDtjb2xvcjojNTU1NTU1O30NCi5hbGVydHtwYWRkaW5nOjhweCAzNXB4IDhweCAxNHB4O21hcmdpbi1ib3R0b206MjBweDt0ZXh0LXNoYWRvdzowIDFweCAwIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC41KTtiYWNrZ3JvdW5kLWNvbG9yOiNmY2Y4ZTM7Ym9yZGVyOjFweCBzb2xpZCAjZmJlZWQ1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9DQouYWxlcnQsLmFsZXJ0IGg0e2NvbG9yOiNjMDk4NTM7fQ0KLmFsZXJ0IGg0e21hcmdpbjowO30NCi5hbGVydCAuY2xvc2V7cG9zaXRpb246cmVsYXRpdmU7dG9wOi0ycHg7cmlnaHQ6LTIxcHg7bGluZS1oZWlnaHQ6MjBweDt9DQouYWxlcnQtc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiNkZmYwZDg7Ym9yZGVyLWNvbG9yOiNkNmU5YzY7Y29sb3I6IzQ2ODg0Nzt9DQouYWxlcnQtc3VjY2VzcyBoNHtjb2xvcjojNDY4ODQ3O30NCi5hbGVydC1kYW5nZXIsLmFsZXJ0LWVycm9ye2JhY2tncm91bmQtY29sb3I6I2YyZGVkZTtib3JkZXItY29sb3I6I2VlZDNkNztjb2xvcjojYjk0YTQ4O30NCi5hbGVydC1kYW5nZXIgaDQsLmFsZXJ0LWVycm9yIGg0e2NvbG9yOiNiOTRhNDg7fQ0KLmFsZXJ0LWluZm97YmFja2dyb3VuZC1jb2xvcjojZDllZGY3O2JvcmRlci1jb2xvcjojYmNlOGYxO2NvbG9yOiMzYTg3YWQ7fQ0KLmFsZXJ0LWluZm8gaDR7Y29sb3I6IzNhODdhZDt9DQouYWxlcnQtYmxvY2t7cGFkZGluZy10b3A6MTRweDtwYWRkaW5nLWJvdHRvbToxNHB4O30NCi5hbGVydC1ibG9jaz5wLC5hbGVydC1ibG9jaz51bHttYXJnaW4tYm90dG9tOjA7fQ0KLmFsZXJ0LWJsb2NrIHArcHttYXJnaW4tdG9wOjVweDt9DQpALXdlYmtpdC1rZXlmcmFtZXMgcHJvZ3Jlc3MtYmFyLXN0cmlwZXN7ZnJvbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOjQwcHggMDt9IHRve2JhY2tncm91bmQtcG9zaXRpb246MCAwO319QC1tb3ota2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDA7fSB0b3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMDt9fUAtbXMta2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDA7fSB0b3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMDt9fUAtby1rZXlmcmFtZXMgcHJvZ3Jlc3MtYmFyLXN0cmlwZXN7ZnJvbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMDt9IHRve2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwO319QGtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwO30gdG97YmFja2dyb3VuZC1wb3NpdGlvbjowIDA7fX0ucHJvZ3Jlc3N7b3ZlcmZsb3c6aGlkZGVuO2hlaWdodDoyMHB4O21hcmdpbi1ib3R0b206MjBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmN2Y3Zjc7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICNmNWY1ZjUsICNmOWY5ZjkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCNmNWY1ZjUpLCB0bygjZjlmOWY5KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICNmNWY1ZjUsICNmOWY5ZjkpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgI2Y1ZjVmNSwgI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjZjVmNWY1LCAjZjlmOWY5KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmY1ZjVmNScsIGVuZENvbG9yc3RyPScjZmZmOWY5ZjknLCBHcmFkaWVudFR5cGU9MCk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLCAwLCAwLCAwLjEpOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9DQoucHJvZ3Jlc3MgLmJhcnt3aWR0aDowJTtoZWlnaHQ6MTAwJTtjb2xvcjojZmZmZmZmO2Zsb2F0OmxlZnQ7Zm9udC1zaXplOjEycHg7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMwZTkwZDI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICMxNDliZGYsICMwNDgwYmUpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCMxNDliZGYpLCB0bygjMDQ4MGJlKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICMxNDliZGYsICMwNDgwYmUpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzE0OWJkZiwgIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjMTQ5YmRmLCAjMDQ4MGJlKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjE0OWJkZicsIGVuZENvbG9yc3RyPScjZmYwNDgwYmUnLCBHcmFkaWVudFR5cGU9MCk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4xNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4xNSk7Ym94LXNoYWRvdzppbnNldCAwIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMTUpOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDstd2Via2l0LXRyYW5zaXRpb246d2lkdGggMC42cyBlYXNlOy1tb3otdHJhbnNpdGlvbjp3aWR0aCAwLjZzIGVhc2U7LW8tdHJhbnNpdGlvbjp3aWR0aCAwLjZzIGVhc2U7dHJhbnNpdGlvbjp3aWR0aCAwLjZzIGVhc2U7fQ0KLnByb2dyZXNzIC5iYXIrLmJhcnstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMXB4IDAgMCByZ2JhKDAsMCwwLC4xNSksIGluc2V0IDAgLTFweCAwIHJnYmEoMCwwLDAsLjE1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMXB4IDAgMCByZ2JhKDAsMCwwLC4xNSksIGluc2V0IDAgLTFweCAwIHJnYmEoMCwwLDAsLjE1KTtib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgwLDAsMCwuMTUpLCBpbnNldCAwIC0xcHggMCByZ2JhKDAsMCwwLC4xNSk7fQ0KLnByb2dyZXNzLXN0cmlwZWQgLmJhcntiYWNrZ3JvdW5kLWNvbG9yOiMxNDliZGY7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAxMDAlLCAxMDAlIDAsIGNvbG9yLXN0b3AoMC4yNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC4yNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgdHJhbnNwYXJlbnQpLCB0byh0cmFuc3BhcmVudCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpOy13ZWJraXQtYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDstbW96LWJhY2tncm91bmQtc2l6ZTo0MHB4IDQwcHg7LW8tYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDtiYWNrZ3JvdW5kLXNpemU6NDBweCA0MHB4O30NCi5wcm9ncmVzcy5hY3RpdmUgLmJhcnstd2Via2l0LWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7LW1vei1hbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlOy1tcy1hbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlOy1vLWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7YW5pbWF0aW9uOnByb2dyZXNzLWJhci1zdHJpcGVzIDJzIGxpbmVhciBpbmZpbml0ZTt9DQoucHJvZ3Jlc3MtZGFuZ2VyIC5iYXIsLnByb2dyZXNzIC5iYXItZGFuZ2Vye2JhY2tncm91bmQtY29sb3I6I2RkNTE0YztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgI2VlNWY1YiwgI2M0M2MzNSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oI2VlNWY1YiksIHRvKCNjNDNjMzUpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgI2VlNWY1YiwgI2M0M2MzNSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjZWU1ZjViLCAjYzQzYzM1KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICNlZTVmNWIsICNjNDNjMzUpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZWU1ZjViJywgZW5kQ29sb3JzdHI9JyNmZmM0M2MzNScsIEdyYWRpZW50VHlwZT0wKTt9DQoucHJvZ3Jlc3MtZGFuZ2VyLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLWRhbmdlcntiYWNrZ3JvdW5kLWNvbG9yOiNlZTVmNWI7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAxMDAlLCAxMDAlIDAsIGNvbG9yLXN0b3AoMC4yNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC4yNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgdHJhbnNwYXJlbnQpLCB0byh0cmFuc3BhcmVudCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO30NCi5wcm9ncmVzcy1zdWNjZXNzIC5iYXIsLnByb2dyZXNzIC5iYXItc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiM1ZWI5NWU7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICM2MmM0NjIsICM1N2E5NTcpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCM2MmM0NjIpLCB0bygjNTdhOTU3KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICM2MmM0NjIsICM1N2E5NTcpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzYyYzQ2MiwgIzU3YTk1Nyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjNjJjNDYyLCAjNTdhOTU3KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjYyYzQ2MicsIGVuZENvbG9yc3RyPScjZmY1N2E5NTcnLCBHcmFkaWVudFR5cGU9MCk7fQ0KLnByb2dyZXNzLXN1Y2Nlc3MucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLC5wcm9ncmVzcy1zdHJpcGVkIC5iYXItc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiM2MmM0NjI7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAxMDAlLCAxMDAlIDAsIGNvbG9yLXN0b3AoMC4yNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC4yNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgdHJhbnNwYXJlbnQpLCB0byh0cmFuc3BhcmVudCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO30NCi5wcm9ncmVzcy1pbmZvIC5iYXIsLnByb2dyZXNzIC5iYXItaW5mb3tiYWNrZ3JvdW5kLWNvbG9yOiM0YmIxY2Y7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICM1YmMwZGUsICMzMzliYjkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCM1YmMwZGUpLCB0bygjMzM5YmI5KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICM1YmMwZGUsICMzMzliYjkpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzViYzBkZSwgIzMzOWJiOSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjNWJjMGRlLCAjMzM5YmI5KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjViYzBkZScsIGVuZENvbG9yc3RyPScjZmYzMzliYjknLCBHcmFkaWVudFR5cGU9MCk7fQ0KLnByb2dyZXNzLWluZm8ucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLC5wcm9ncmVzcy1zdHJpcGVkIC5iYXItaW5mb3tiYWNrZ3JvdW5kLWNvbG9yOiM1YmMwZGU7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAxMDAlLCAxMDAlIDAsIGNvbG9yLXN0b3AoMC4yNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC4yNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgdHJhbnNwYXJlbnQpLCB0byh0cmFuc3BhcmVudCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO30NCi5wcm9ncmVzcy13YXJuaW5nIC5iYXIsLnByb2dyZXNzIC5iYXItd2FybmluZ3tiYWNrZ3JvdW5kLWNvbG9yOiNmYWE3MzI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICNmYmI0NTAsICNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCNmYmI0NTApLCB0bygjZjg5NDA2KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICNmYmI0NTAsICNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgI2ZiYjQ1MCwgI2Y4OTQwNik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjZmJiNDUwLCAjZjg5NDA2KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmZiYjQ1MCcsIGVuZENvbG9yc3RyPScjZmZmODk0MDYnLCBHcmFkaWVudFR5cGU9MCk7fQ0KLnByb2dyZXNzLXdhcm5pbmcucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLC5wcm9ncmVzcy1zdHJpcGVkIC5iYXItd2FybmluZ3tiYWNrZ3JvdW5kLWNvbG9yOiNmYmI0NTA7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAxMDAlLCAxMDAlIDAsIGNvbG9yLXN0b3AoMC4yNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC4yNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgdHJhbnNwYXJlbnQpLCBjb2xvci1zdG9wKDAuNSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSksIGNvbG9yLXN0b3AoMC43NSwgdHJhbnNwYXJlbnQpLCB0byh0cmFuc3BhcmVudCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO30NCi5oZXJvLXVuaXR7cGFkZGluZzo2MHB4O21hcmdpbi1ib3R0b206MzBweDtmb250LXNpemU6MThweDtmb250LXdlaWdodDoyMDA7bGluZS1oZWlnaHQ6MzBweDtjb2xvcjppbmhlcml0O2JhY2tncm91bmQtY29sb3I6I2VlZWVlZTstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7fS5oZXJvLXVuaXQgaDF7bWFyZ2luLWJvdHRvbTowO2ZvbnQtc2l6ZTo2MHB4O2xpbmUtaGVpZ2h0OjE7Y29sb3I6aW5oZXJpdDtsZXR0ZXItc3BhY2luZzotMXB4O30NCi5oZXJvLXVuaXQgbGl7bGluZS1oZWlnaHQ6MzBweDt9DQoubWVkaWEsLm1lZGlhLWJvZHl7b3ZlcmZsb3c6aGlkZGVuOypvdmVyZmxvdzp2aXNpYmxlO3pvb206MTt9DQoubWVkaWEsLm1lZGlhIC5tZWRpYXttYXJnaW4tdG9wOjE1cHg7fQ0KLm1lZGlhOmZpcnN0LWNoaWxke21hcmdpbi10b3A6MDt9DQoubWVkaWEtb2JqZWN0e2Rpc3BsYXk6YmxvY2s7fQ0KLm1lZGlhLWhlYWRpbmd7bWFyZ2luOjAgMCA1cHg7fQ0KLm1lZGlhPi5wdWxsLWxlZnR7bWFyZ2luLXJpZ2h0OjEwcHg7fQ0KLm1lZGlhPi5wdWxsLXJpZ2h0e21hcmdpbi1sZWZ0OjEwcHg7fQ0KLm1lZGlhLWxpc3R7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmU7fQ0KLnRvb2x0aXB7cG9zaXRpb246YWJzb2x1dGU7ei1pbmRleDoxMDMwO2Rpc3BsYXk6YmxvY2s7dmlzaWJpbGl0eTp2aXNpYmxlO2ZvbnQtc2l6ZToxMXB4O2xpbmUtaGVpZ2h0OjEuNDtvcGFjaXR5OjA7ZmlsdGVyOmFscGhhKG9wYWNpdHk9MCk7fS50b29sdGlwLmlue29wYWNpdHk6MC44O2ZpbHRlcjphbHBoYShvcGFjaXR5PTgwKTt9DQoudG9vbHRpcC50b3B7bWFyZ2luLXRvcDotM3B4O3BhZGRpbmc6NXB4IDA7fQ0KLnRvb2x0aXAucmlnaHR7bWFyZ2luLWxlZnQ6M3B4O3BhZGRpbmc6MCA1cHg7fQ0KLnRvb2x0aXAuYm90dG9te21hcmdpbi10b3A6M3B4O3BhZGRpbmc6NXB4IDA7fQ0KLnRvb2x0aXAubGVmdHttYXJnaW4tbGVmdDotM3B4O3BhZGRpbmc6MCA1cHg7fQ0KLnRvb2x0aXAtaW5uZXJ7bWF4LXdpZHRoOjIwMHB4O3BhZGRpbmc6OHB4O2NvbG9yOiNmZmZmZmY7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojMDAwMDAwOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9DQoudG9vbHRpcC1hcnJvd3twb3NpdGlvbjphYnNvbHV0ZTt3aWR0aDowO2hlaWdodDowO2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXItc3R5bGU6c29saWQ7fQ0KLnRvb2x0aXAudG9wIC50b29sdGlwLWFycm93e2JvdHRvbTowO2xlZnQ6NTAlO21hcmdpbi1sZWZ0Oi01cHg7Ym9yZGVyLXdpZHRoOjVweCA1cHggMDtib3JkZXItdG9wLWNvbG9yOiMwMDAwMDA7fQ0KLnRvb2x0aXAucmlnaHQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtsZWZ0OjA7bWFyZ2luLXRvcDotNXB4O2JvcmRlci13aWR0aDo1cHggNXB4IDVweCAwO2JvcmRlci1yaWdodC1jb2xvcjojMDAwMDAwO30NCi50b29sdGlwLmxlZnQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtyaWdodDowO21hcmdpbi10b3A6LTVweDtib3JkZXItd2lkdGg6NXB4IDAgNXB4IDVweDtib3JkZXItbGVmdC1jb2xvcjojMDAwMDAwO30NCi50b29sdGlwLmJvdHRvbSAudG9vbHRpcC1hcnJvd3t0b3A6MDtsZWZ0OjUwJTttYXJnaW4tbGVmdDotNXB4O2JvcmRlci13aWR0aDowIDVweCA1cHg7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDAwMDAwO30NCi5wb3BvdmVye3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO2xlZnQ6MDt6LWluZGV4OjEwMTA7ZGlzcGxheTpub25lO21heC13aWR0aDoyNzZweDtwYWRkaW5nOjFweDt0ZXh0LWFsaWduOmxlZnQ7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmOy13ZWJraXQtYmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94Oy1tb3otYmFja2dyb3VuZC1jbGlwOnBhZGRpbmc7YmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94O2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwgMCwgMCwgMC4yKTstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLCAwLCAwLCAwLjIpOy1tb3otYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLCAwLCAwLCAwLjIpO3doaXRlLXNwYWNlOm5vcm1hbDt9LnBvcG92ZXIudG9we21hcmdpbi10b3A6LTEwcHg7fQ0KLnBvcG92ZXIucmlnaHR7bWFyZ2luLWxlZnQ6MTBweDt9DQoucG9wb3Zlci5ib3R0b217bWFyZ2luLXRvcDoxMHB4O30NCi5wb3BvdmVyLmxlZnR7bWFyZ2luLWxlZnQ6LTEwcHg7fQ0KLnBvcG92ZXItdGl0bGV7bWFyZ2luOjA7cGFkZGluZzo4cHggMTRweDtmb250LXNpemU6MTRweDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MThweDtiYWNrZ3JvdW5kLWNvbG9yOiNmN2Y3Zjc7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2ViZWJlYjstd2Via2l0LWJvcmRlci1yYWRpdXM6NXB4IDVweCAwIDA7LW1vei1ib3JkZXItcmFkaXVzOjVweCA1cHggMCAwO2JvcmRlci1yYWRpdXM6NXB4IDVweCAwIDA7fS5wb3BvdmVyLXRpdGxlOmVtcHR5e2Rpc3BsYXk6bm9uZTt9DQoucG9wb3Zlci1jb250ZW50e3BhZGRpbmc6OXB4IDE0cHg7fQ0KLnBvcG92ZXIgLmFycm93LC5wb3BvdmVyIC5hcnJvdzphZnRlcntwb3NpdGlvbjphYnNvbHV0ZTtkaXNwbGF5OmJsb2NrO3dpZHRoOjA7aGVpZ2h0OjA7Ym9yZGVyLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlci1zdHlsZTpzb2xpZDt9DQoucG9wb3ZlciAuYXJyb3d7Ym9yZGVyLXdpZHRoOjExcHg7fQ0KLnBvcG92ZXIgLmFycm93OmFmdGVye2JvcmRlci13aWR0aDoxMHB4O2NvbnRlbnQ6IiI7fQ0KLnBvcG92ZXIudG9wIC5hcnJvd3tsZWZ0OjUwJTttYXJnaW4tbGVmdDotMTFweDtib3JkZXItYm90dG9tLXdpZHRoOjA7Ym9yZGVyLXRvcC1jb2xvcjojOTk5O2JvcmRlci10b3AtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjI1KTtib3R0b206LTExcHg7fS5wb3BvdmVyLnRvcCAuYXJyb3c6YWZ0ZXJ7Ym90dG9tOjFweDttYXJnaW4tbGVmdDotMTBweDtib3JkZXItYm90dG9tLXdpZHRoOjA7Ym9yZGVyLXRvcC1jb2xvcjojZmZmZmZmO30NCi5wb3BvdmVyLnJpZ2h0IC5hcnJvd3t0b3A6NTAlO2xlZnQ6LTExcHg7bWFyZ2luLXRvcDotMTFweDtib3JkZXItbGVmdC13aWR0aDowO2JvcmRlci1yaWdodC1jb2xvcjojOTk5O2JvcmRlci1yaWdodC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMjUpO30ucG9wb3Zlci5yaWdodCAuYXJyb3c6YWZ0ZXJ7bGVmdDoxcHg7Ym90dG9tOi0xMHB4O2JvcmRlci1sZWZ0LXdpZHRoOjA7Ym9yZGVyLXJpZ2h0LWNvbG9yOiNmZmZmZmY7fQ0KLnBvcG92ZXIuYm90dG9tIC5hcnJvd3tsZWZ0OjUwJTttYXJnaW4tbGVmdDotMTFweDtib3JkZXItdG9wLXdpZHRoOjA7Ym9yZGVyLWJvdHRvbS1jb2xvcjojOTk5O2JvcmRlci1ib3R0b20tY29sb3I6cmdiYSgwLCAwLCAwLCAwLjI1KTt0b3A6LTExcHg7fS5wb3BvdmVyLmJvdHRvbSAuYXJyb3c6YWZ0ZXJ7dG9wOjFweDttYXJnaW4tbGVmdDotMTBweDtib3JkZXItdG9wLXdpZHRoOjA7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmZmZmO30NCi5wb3BvdmVyLmxlZnQgLmFycm93e3RvcDo1MCU7cmlnaHQ6LTExcHg7bWFyZ2luLXRvcDotMTFweDtib3JkZXItcmlnaHQtd2lkdGg6MDtib3JkZXItbGVmdC1jb2xvcjojOTk5O2JvcmRlci1sZWZ0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4yNSk7fS5wb3BvdmVyLmxlZnQgLmFycm93OmFmdGVye3JpZ2h0OjFweDtib3JkZXItcmlnaHQtd2lkdGg6MDtib3JkZXItbGVmdC1jb2xvcjojZmZmZmZmO2JvdHRvbTotMTBweDt9DQoubW9kYWwtYmFja2Ryb3B7cG9zaXRpb246Zml4ZWQ7dG9wOjA7cmlnaHQ6MDtib3R0b206MDtsZWZ0OjA7ei1pbmRleDoxMDQwO2JhY2tncm91bmQtY29sb3I6IzAwMDAwMDt9Lm1vZGFsLWJhY2tkcm9wLmZhZGV7b3BhY2l0eTowO30NCi5tb2RhbC1iYWNrZHJvcCwubW9kYWwtYmFja2Ryb3AuZmFkZS5pbntvcGFjaXR5OjAuODtmaWx0ZXI6YWxwaGEob3BhY2l0eT04MCk7fQ0KLm1vZGFse3Bvc2l0aW9uOmZpeGVkO3RvcDoxMCU7bGVmdDo1MCU7ei1pbmRleDoxMDUwO3dpZHRoOjU2MHB4O21hcmdpbi1sZWZ0Oi0yODBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZmZmY7Ym9yZGVyOjFweCBzb2xpZCAjOTk5O2JvcmRlcjoxcHggc29saWQgcmdiYSgwLCAwLCAwLCAwLjMpOypib3JkZXI6MXB4IHNvbGlkICM5OTk7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDNweCA3cHggcmdiYSgwLCAwLCAwLCAwLjMpOy1tb3otYm94LXNoYWRvdzowIDNweCA3cHggcmdiYSgwLCAwLCAwLCAwLjMpO2JveC1zaGFkb3c6MCAzcHggN3B4IHJnYmEoMCwgMCwgMCwgMC4zKTstd2Via2l0LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDstbW96LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDtiYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3g7b3V0bGluZTpub25lO30ubW9kYWwuZmFkZXstd2Via2l0LXRyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLCB0b3AgLjNzIGVhc2Utb3V0Oy1tb3otdHJhbnNpdGlvbjpvcGFjaXR5IC4zcyBsaW5lYXIsIHRvcCAuM3MgZWFzZS1vdXQ7LW8tdHJhbnNpdGlvbjpvcGFjaXR5IC4zcyBsaW5lYXIsIHRvcCAuM3MgZWFzZS1vdXQ7dHJhbnNpdGlvbjpvcGFjaXR5IC4zcyBsaW5lYXIsIHRvcCAuM3MgZWFzZS1vdXQ7dG9wOi0yNSU7fQ0KLm1vZGFsLmZhZGUuaW57dG9wOjEwJTt9DQoubW9kYWwtaGVhZGVye3BhZGRpbmc6OXB4IDE1cHg7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2VlZTt9Lm1vZGFsLWhlYWRlciAuY2xvc2V7bWFyZ2luLXRvcDoycHg7fQ0KLm1vZGFsLWhlYWRlciBoM3ttYXJnaW46MDtsaW5lLWhlaWdodDozMHB4O30NCi5tb2RhbC1ib2R5e3Bvc2l0aW9uOnJlbGF0aXZlO292ZXJmbG93LXk6YXV0bzttYXgtaGVpZ2h0OjQwMHB4O3BhZGRpbmc6MTVweDt9DQoubW9kYWwtZm9ybXttYXJnaW4tYm90dG9tOjA7fQ0KLm1vZGFsLWZvb3RlcntwYWRkaW5nOjE0cHggMTVweCAxNXB4O21hcmdpbi1ib3R0b206MDt0ZXh0LWFsaWduOnJpZ2h0O2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTtib3JkZXItdG9wOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDAgNnB4IDZweDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCAjZmZmZmZmOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAwICNmZmZmZmY7Ym94LXNoYWRvdzppbnNldCAwIDFweCAwICNmZmZmZmY7Knpvb206MTt9Lm1vZGFsLWZvb3RlcjpiZWZvcmUsLm1vZGFsLWZvb3RlcjphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoubW9kYWwtZm9vdGVyOmFmdGVye2NsZWFyOmJvdGg7fQ0KLm1vZGFsLWZvb3RlciAuYnRuKy5idG57bWFyZ2luLWxlZnQ6NXB4O21hcmdpbi1ib3R0b206MDt9DQoubW9kYWwtZm9vdGVyIC5idG4tZ3JvdXAgLmJ0bisuYnRue21hcmdpbi1sZWZ0Oi0xcHg7fQ0KLm1vZGFsLWZvb3RlciAuYnRuLWJsb2NrKy5idG4tYmxvY2t7bWFyZ2luLWxlZnQ6MDt9DQouZHJvcHVwLC5kcm9wZG93bntwb3NpdGlvbjpyZWxhdGl2ZTt9DQouZHJvcGRvd24tdG9nZ2xleyptYXJnaW4tYm90dG9tOi0zcHg7fQ0KLmRyb3Bkb3duLXRvZ2dsZTphY3RpdmUsLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZXtvdXRsaW5lOjA7fQ0KLmNhcmV0e2Rpc3BsYXk6aW5saW5lLWJsb2NrO3dpZHRoOjA7aGVpZ2h0OjA7dmVydGljYWwtYWxpZ246dG9wO2JvcmRlci10b3A6NHB4IHNvbGlkICMwMDAwMDA7Ym9yZGVyLXJpZ2h0OjRweCBzb2xpZCB0cmFuc3BhcmVudDtib3JkZXItbGVmdDo0cHggc29saWQgdHJhbnNwYXJlbnQ7Y29udGVudDoiIjt9DQouZHJvcGRvd24gLmNhcmV0e21hcmdpbi10b3A6OHB4O21hcmdpbi1sZWZ0OjJweDt9DQouZHJvcGRvd24tbWVudXtwb3NpdGlvbjphYnNvbHV0ZTt0b3A6MTAwJTtsZWZ0OjA7ei1pbmRleDoxMDAwO2Rpc3BsYXk6bm9uZTtmbG9hdDpsZWZ0O21pbi13aWR0aDoxNjBweDtwYWRkaW5nOjVweCAwO21hcmdpbjoycHggMCAwO2xpc3Qtc3R5bGU6bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZmZmY7Ym9yZGVyOjFweCBzb2xpZCAjY2NjO2JvcmRlcjoxcHggc29saWQgcmdiYSgwLCAwLCAwLCAwLjIpOypib3JkZXItcmlnaHQtd2lkdGg6MnB4Oypib3JkZXItYm90dG9tLXdpZHRoOjJweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLCAwLCAwLCAwLjIpOy1tb3otYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTtib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLCAwLCAwLCAwLjIpOy13ZWJraXQtYmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94Oy1tb3otYmFja2dyb3VuZC1jbGlwOnBhZGRpbmc7YmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94O30uZHJvcGRvd24tbWVudS5wdWxsLXJpZ2h0e3JpZ2h0OjA7bGVmdDphdXRvO30NCi5kcm9wZG93bi1tZW51IC5kaXZpZGVyeyp3aWR0aDoxMDAlO2hlaWdodDoxcHg7bWFyZ2luOjlweCAxcHg7Km1hcmdpbjotNXB4IDAgNXB4O292ZXJmbG93OmhpZGRlbjtiYWNrZ3JvdW5kLWNvbG9yOiNlNWU1ZTU7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2ZmZmZmZjt9DQouZHJvcGRvd24tbWVudT5saT5he2Rpc3BsYXk6YmxvY2s7cGFkZGluZzozcHggMjBweDtjbGVhcjpib3RoO2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiMzMzMzMzM7d2hpdGUtc3BhY2U6bm93cmFwO30NCi5kcm9wZG93bi1tZW51PmxpPmE6aG92ZXIsLmRyb3Bkb3duLW1lbnU+bGk+YTpmb2N1cywuZHJvcGRvd24tc3VibWVudTpob3Zlcj5hLC5kcm9wZG93bi1zdWJtZW51OmZvY3VzPmF7dGV4dC1kZWNvcmF0aW9uOm5vbmU7Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMwMDgxYzI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICMwMDg4Y2MsICMwMDc3YjMpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCMwMDg4Y2MpLCB0bygjMDA3N2IzKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICMwMDg4Y2MsICMwMDc3YjMpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjMDA4OGNjLCAjMDA3N2IzKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjAwODhjYycsIGVuZENvbG9yc3RyPScjZmYwMDc3YjMnLCBHcmFkaWVudFR5cGU9MCk7fQ0KLmRyb3Bkb3duLW1lbnU+LmFjdGl2ZT5hLC5kcm9wZG93bi1tZW51Pi5hY3RpdmU+YTpob3ZlciwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE6Zm9jdXN7Y29sb3I6I2ZmZmZmZjt0ZXh0LWRlY29yYXRpb246bm9uZTtvdXRsaW5lOjA7YmFja2dyb3VuZC1jb2xvcjojMDA4MWMyO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjMDA4OGNjLCAjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjMDA4OGNjKSwgdG8oIzAwNzdiMykpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjMDA4OGNjLCAjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICMwMDg4Y2MsICMwMDc3YjMpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgIzAwODhjYywgIzAwNzdiMyk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYwMDg4Y2MnLCBlbmRDb2xvcnN0cj0nI2ZmMDA3N2IzJywgR3JhZGllbnRUeXBlPTApO30NCi5kcm9wZG93bi1tZW51Pi5kaXNhYmxlZD5hLC5kcm9wZG93bi1tZW51Pi5kaXNhYmxlZD5hOmhvdmVyLC5kcm9wZG93bi1tZW51Pi5kaXNhYmxlZD5hOmZvY3Vze2NvbG9yOiM5OTk5OTk7fQ0KLmRyb3Bkb3duLW1lbnU+LmRpc2FibGVkPmE6aG92ZXIsLmRyb3Bkb3duLW1lbnU+LmRpc2FibGVkPmE6Zm9jdXN7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtiYWNrZ3JvdW5kLWltYWdlOm5vbmU7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO2N1cnNvcjpkZWZhdWx0O30NCi5vcGVueyp6LWluZGV4OjEwMDA7fS5vcGVuPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2s7fQ0KLmRyb3Bkb3duLWJhY2tkcm9we3Bvc2l0aW9uOmZpeGVkO2xlZnQ6MDtyaWdodDowO2JvdHRvbTowO3RvcDowO3otaW5kZXg6OTkwO30NCi5wdWxsLXJpZ2h0Pi5kcm9wZG93bi1tZW51e3JpZ2h0OjA7bGVmdDphdXRvO30NCi5kcm9wdXAgLmNhcmV0LC5uYXZiYXItZml4ZWQtYm90dG9tIC5kcm9wZG93biAuY2FyZXR7Ym9yZGVyLXRvcDowO2JvcmRlci1ib3R0b206NHB4IHNvbGlkICMwMDAwMDA7Y29udGVudDoiIjt9DQouZHJvcHVwIC5kcm9wZG93bi1tZW51LC5uYXZiYXItZml4ZWQtYm90dG9tIC5kcm9wZG93biAuZHJvcGRvd24tbWVudXt0b3A6YXV0bztib3R0b206MTAwJTttYXJnaW4tYm90dG9tOjFweDt9DQouZHJvcGRvd24tc3VibWVudXtwb3NpdGlvbjpyZWxhdGl2ZTt9DQouZHJvcGRvd24tc3VibWVudT4uZHJvcGRvd24tbWVudXt0b3A6MDtsZWZ0OjEwMCU7bWFyZ2luLXRvcDotNnB4O21hcmdpbi1sZWZ0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDZweCA2cHggNnB4O30NCi5kcm9wZG93bi1zdWJtZW51OmhvdmVyPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2s7fQ0KLmRyb3B1cCAuZHJvcGRvd24tc3VibWVudT4uZHJvcGRvd24tbWVudXt0b3A6YXV0bztib3R0b206MDttYXJnaW4tdG9wOjA7bWFyZ2luLWJvdHRvbTotMnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwOy1tb3otYm9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwO2JvcmRlci1yYWRpdXM6NXB4IDVweCA1cHggMDt9DQouZHJvcGRvd24tc3VibWVudT5hOmFmdGVye2Rpc3BsYXk6YmxvY2s7Y29udGVudDoiICI7ZmxvYXQ6cmlnaHQ7d2lkdGg6MDtoZWlnaHQ6MDtib3JkZXItY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLXN0eWxlOnNvbGlkO2JvcmRlci13aWR0aDo1cHggMCA1cHggNXB4O2JvcmRlci1sZWZ0LWNvbG9yOiNjY2NjY2M7bWFyZ2luLXRvcDo1cHg7bWFyZ2luLXJpZ2h0Oi0xMHB4O30NCi5kcm9wZG93bi1zdWJtZW51OmhvdmVyPmE6YWZ0ZXJ7Ym9yZGVyLWxlZnQtY29sb3I6I2ZmZmZmZjt9DQouZHJvcGRvd24tc3VibWVudS5wdWxsLWxlZnR7ZmxvYXQ6bm9uZTt9LmRyb3Bkb3duLXN1Ym1lbnUucHVsbC1sZWZ0Pi5kcm9wZG93bi1tZW51e2xlZnQ6LTEwMCU7bWFyZ2luLWxlZnQ6MTBweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDtib3JkZXItcmFkaXVzOjZweCAwIDZweCA2cHg7fQ0KLmRyb3Bkb3duIC5kcm9wZG93bi1tZW51IC5uYXYtaGVhZGVye3BhZGRpbmctbGVmdDoyMHB4O3BhZGRpbmctcmlnaHQ6MjBweDt9DQoudHlwZWFoZWFke3otaW5kZXg6MTA1MTttYXJnaW4tdG9wOjJweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7fQ0KLmFjY29yZGlvbnttYXJnaW4tYm90dG9tOjIwcHg7fQ0KLmFjY29yZGlvbi1ncm91cHttYXJnaW4tYm90dG9tOjJweDtib3JkZXI6MXB4IHNvbGlkICNlNWU1ZTU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O30NCi5hY2NvcmRpb24taGVhZGluZ3tib3JkZXItYm90dG9tOjA7fQ0KLmFjY29yZGlvbi1oZWFkaW5nIC5hY2NvcmRpb24tdG9nZ2xle2Rpc3BsYXk6YmxvY2s7cGFkZGluZzo4cHggMTVweDt9DQouYWNjb3JkaW9uLXRvZ2dsZXtjdXJzb3I6cG9pbnRlcjt9DQouYWNjb3JkaW9uLWlubmVye3BhZGRpbmc6OXB4IDE1cHg7Ym9yZGVyLXRvcDoxcHggc29saWQgI2U1ZTVlNTt9DQouY2Fyb3VzZWx7cG9zaXRpb246cmVsYXRpdmU7bWFyZ2luLWJvdHRvbToyMHB4O2xpbmUtaGVpZ2h0OjE7fQ0KLmNhcm91c2VsLWlubmVye292ZXJmbG93OmhpZGRlbjt3aWR0aDoxMDAlO3Bvc2l0aW9uOnJlbGF0aXZlO30NCi5jYXJvdXNlbC1pbm5lcj4uaXRlbXtkaXNwbGF5Om5vbmU7cG9zaXRpb246cmVsYXRpdmU7LXdlYmtpdC10cmFuc2l0aW9uOjAuNnMgZWFzZS1pbi1vdXQgbGVmdDstbW96LXRyYW5zaXRpb246MC42cyBlYXNlLWluLW91dCBsZWZ0Oy1vLXRyYW5zaXRpb246MC42cyBlYXNlLWluLW91dCBsZWZ0O3RyYW5zaXRpb246MC42cyBlYXNlLWluLW91dCBsZWZ0O30uY2Fyb3VzZWwtaW5uZXI+Lml0ZW0+aW1nLC5jYXJvdXNlbC1pbm5lcj4uaXRlbT5hPmltZ3tkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjE7fQ0KLmNhcm91c2VsLWlubmVyPi5hY3RpdmUsLmNhcm91c2VsLWlubmVyPi5uZXh0LC5jYXJvdXNlbC1pbm5lcj4ucHJldntkaXNwbGF5OmJsb2NrO30NCi5jYXJvdXNlbC1pbm5lcj4uYWN0aXZle2xlZnQ6MDt9DQouY2Fyb3VzZWwtaW5uZXI+Lm5leHQsLmNhcm91c2VsLWlubmVyPi5wcmV2e3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO3dpZHRoOjEwMCU7fQ0KLmNhcm91c2VsLWlubmVyPi5uZXh0e2xlZnQ6MTAwJTt9DQouY2Fyb3VzZWwtaW5uZXI+LnByZXZ7bGVmdDotMTAwJTt9DQouY2Fyb3VzZWwtaW5uZXI+Lm5leHQubGVmdCwuY2Fyb3VzZWwtaW5uZXI+LnByZXYucmlnaHR7bGVmdDowO30NCi5jYXJvdXNlbC1pbm5lcj4uYWN0aXZlLmxlZnR7bGVmdDotMTAwJTt9DQouY2Fyb3VzZWwtaW5uZXI+LmFjdGl2ZS5yaWdodHtsZWZ0OjEwMCU7fQ0KLmNhcm91c2VsLWNvbnRyb2x7cG9zaXRpb246YWJzb2x1dGU7dG9wOjQwJTtsZWZ0OjE1cHg7d2lkdGg6NDBweDtoZWlnaHQ6NDBweDttYXJnaW4tdG9wOi0yMHB4O2ZvbnQtc2l6ZTo2MHB4O2ZvbnQtd2VpZ2h0OjEwMDtsaW5lLWhlaWdodDozMHB4O2NvbG9yOiNmZmZmZmY7dGV4dC1hbGlnbjpjZW50ZXI7YmFja2dyb3VuZDojMjIyMjIyO2JvcmRlcjozcHggc29saWQgI2ZmZmZmZjstd2Via2l0LWJvcmRlci1yYWRpdXM6MjNweDstbW96LWJvcmRlci1yYWRpdXM6MjNweDtib3JkZXItcmFkaXVzOjIzcHg7b3BhY2l0eTowLjU7ZmlsdGVyOmFscGhhKG9wYWNpdHk9NTApO30uY2Fyb3VzZWwtY29udHJvbC5yaWdodHtsZWZ0OmF1dG87cmlnaHQ6MTVweDt9DQouY2Fyb3VzZWwtY29udHJvbDpob3ZlciwuY2Fyb3VzZWwtY29udHJvbDpmb2N1c3tjb2xvcjojZmZmZmZmO3RleHQtZGVjb3JhdGlvbjpub25lO29wYWNpdHk6MC45O2ZpbHRlcjphbHBoYShvcGFjaXR5PTkwKTt9DQouY2Fyb3VzZWwtaW5kaWNhdG9yc3twb3NpdGlvbjphYnNvbHV0ZTt0b3A6MTVweDtyaWdodDoxNXB4O3otaW5kZXg6NTttYXJnaW46MDtsaXN0LXN0eWxlOm5vbmU7fS5jYXJvdXNlbC1pbmRpY2F0b3JzIGxpe2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bGVmdDt3aWR0aDoxMHB4O2hlaWdodDoxMHB4O21hcmdpbi1sZWZ0OjVweDt0ZXh0LWluZGVudDotOTk5cHg7YmFja2dyb3VuZC1jb2xvcjojY2NjO2JhY2tncm91bmQtY29sb3I6cmdiYSgyNTUsIDI1NSwgMjU1LCAwLjI1KTtib3JkZXItcmFkaXVzOjVweDt9DQouY2Fyb3VzZWwtaW5kaWNhdG9ycyAuYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2ZmZjt9DQouY2Fyb3VzZWwtY2FwdGlvbntwb3NpdGlvbjphYnNvbHV0ZTtsZWZ0OjA7cmlnaHQ6MDtib3R0b206MDtwYWRkaW5nOjE1cHg7YmFja2dyb3VuZDojMzMzMzMzO2JhY2tncm91bmQ6cmdiYSgwLCAwLCAwLCAwLjc1KTt9DQouY2Fyb3VzZWwtY2FwdGlvbiBoNCwuY2Fyb3VzZWwtY2FwdGlvbiBwe2NvbG9yOiNmZmZmZmY7bGluZS1oZWlnaHQ6MjBweDt9DQouY2Fyb3VzZWwtY2FwdGlvbiBoNHttYXJnaW46MCAwIDVweDt9DQouY2Fyb3VzZWwtY2FwdGlvbiBwe21hcmdpbi1ib3R0b206MDt9DQoud2VsbHttaW4taGVpZ2h0OjIwcHg7cGFkZGluZzoxOXB4O21hcmdpbi1ib3R0b206MjBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyOjFweCBzb2xpZCAjZTNlM2UzOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNSk7fS53ZWxsIGJsb2NrcXVvdGV7Ym9yZGVyLWNvbG9yOiNkZGQ7Ym9yZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xNSk7fQ0KLndlbGwtbGFyZ2V7cGFkZGluZzoyNHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDt9DQoud2VsbC1zbWFsbHtwYWRkaW5nOjlweDstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHg7fQ0KLmNsb3Nle2Zsb2F0OnJpZ2h0O2ZvbnQtc2l6ZToyMHB4O2ZvbnQtd2VpZ2h0OmJvbGQ7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojMDAwMDAwO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZmZmZjtvcGFjaXR5OjAuMjtmaWx0ZXI6YWxwaGEob3BhY2l0eT0yMCk7fS5jbG9zZTpob3ZlciwuY2xvc2U6Zm9jdXN7Y29sb3I6IzAwMDAwMDt0ZXh0LWRlY29yYXRpb246bm9uZTtjdXJzb3I6cG9pbnRlcjtvcGFjaXR5OjAuNDtmaWx0ZXI6YWxwaGEob3BhY2l0eT00MCk7fQ0KYnV0dG9uLmNsb3Nle3BhZGRpbmc6MDtjdXJzb3I6cG9pbnRlcjtiYWNrZ3JvdW5kOnRyYW5zcGFyZW50O2JvcmRlcjowOy13ZWJraXQtYXBwZWFyYW5jZTpub25lO30NCi5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O30NCi5wdWxsLWxlZnR7ZmxvYXQ6bGVmdDt9DQouaGlkZXtkaXNwbGF5Om5vbmU7fQ0KLnNob3d7ZGlzcGxheTpibG9jazt9DQouaW52aXNpYmxle3Zpc2liaWxpdHk6aGlkZGVuO30NCi5hZmZpeHtwb3NpdGlvbjpmaXhlZDt9DQouZmFkZXtvcGFjaXR5OjA7LXdlYmtpdC10cmFuc2l0aW9uOm9wYWNpdHkgMC4xNXMgbGluZWFyOy1tb3otdHJhbnNpdGlvbjpvcGFjaXR5IDAuMTVzIGxpbmVhcjstby10cmFuc2l0aW9uOm9wYWNpdHkgMC4xNXMgbGluZWFyO3RyYW5zaXRpb246b3BhY2l0eSAwLjE1cyBsaW5lYXI7fS5mYWRlLmlue29wYWNpdHk6MTt9DQouY29sbGFwc2V7cG9zaXRpb246cmVsYXRpdmU7aGVpZ2h0OjA7b3ZlcmZsb3c6aGlkZGVuOy13ZWJraXQtdHJhbnNpdGlvbjpoZWlnaHQgMC4zNXMgZWFzZTstbW96LXRyYW5zaXRpb246aGVpZ2h0IDAuMzVzIGVhc2U7LW8tdHJhbnNpdGlvbjpoZWlnaHQgMC4zNXMgZWFzZTt0cmFuc2l0aW9uOmhlaWdodCAwLjM1cyBlYXNlO30uY29sbGFwc2UuaW57aGVpZ2h0OmF1dG87fQ0KQC1tcy12aWV3cG9ydHt3aWR0aDpkZXZpY2Utd2lkdGg7fS5oaWRkZW57ZGlzcGxheTpub25lO3Zpc2liaWxpdHk6aGlkZGVuO30NCi52aXNpYmxlLXBob25le2Rpc3BsYXk6bm9uZSAhaW1wb3J0YW50O30NCi52aXNpYmxlLXRhYmxldHtkaXNwbGF5Om5vbmUgIWltcG9ydGFudDt9DQouaGlkZGVuLWRlc2t0b3B7ZGlzcGxheTpub25lICFpbXBvcnRhbnQ7fQ0KLnZpc2libGUtZGVza3RvcHtkaXNwbGF5OmluaGVyaXQgIWltcG9ydGFudDt9DQpAbWVkaWEgKG1pbi13aWR0aDo3NjhweCkgYW5kIChtYXgtd2lkdGg6OTc5cHgpey5oaWRkZW4tZGVza3RvcHtkaXNwbGF5OmluaGVyaXQgIWltcG9ydGFudDt9IC52aXNpYmxlLWRlc2t0b3B7ZGlzcGxheTpub25lICFpbXBvcnRhbnQgO30gLnZpc2libGUtdGFibGV0e2Rpc3BsYXk6aW5oZXJpdCAhaW1wb3J0YW50O30gLmhpZGRlbi10YWJsZXR7ZGlzcGxheTpub25lICFpbXBvcnRhbnQ7fX1AbWVkaWEgKG1heC13aWR0aDo3NjdweCl7LmhpZGRlbi1kZXNrdG9we2Rpc3BsYXk6aW5oZXJpdCAhaW1wb3J0YW50O30gLnZpc2libGUtZGVza3RvcHtkaXNwbGF5Om5vbmUgIWltcG9ydGFudDt9IC52aXNpYmxlLXBob25le2Rpc3BsYXk6aW5oZXJpdCAhaW1wb3J0YW50O30gLmhpZGRlbi1waG9uZXtkaXNwbGF5Om5vbmUgIWltcG9ydGFudDt9fS52aXNpYmxlLXByaW50e2Rpc3BsYXk6bm9uZSAhaW1wb3J0YW50O30NCkBtZWRpYSBwcmludHsudmlzaWJsZS1wcmludHtkaXNwbGF5OmluaGVyaXQgIWltcG9ydGFudDt9IC5oaWRkZW4tcHJpbnR7ZGlzcGxheTpub25lICFpbXBvcnRhbnQ7fX1AbWVkaWEgKG1heC13aWR0aDo3NjdweCl7Ym9keXtwYWRkaW5nLWxlZnQ6MjBweDtwYWRkaW5nLXJpZ2h0OjIwcHg7fSAubmF2YmFyLWZpeGVkLXRvcCwubmF2YmFyLWZpeGVkLWJvdHRvbSwubmF2YmFyLXN0YXRpYy10b3B7bWFyZ2luLWxlZnQ6LTIwcHg7bWFyZ2luLXJpZ2h0Oi0yMHB4O30gLmNvbnRhaW5lci1mbHVpZHtwYWRkaW5nOjA7fSAuZGwtaG9yaXpvbnRhbCBkdHtmbG9hdDpub25lO2NsZWFyOm5vbmU7d2lkdGg6YXV0bzt0ZXh0LWFsaWduOmxlZnQ7fSAuZGwtaG9yaXpvbnRhbCBkZHttYXJnaW4tbGVmdDowO30gLmNvbnRhaW5lcnt3aWR0aDphdXRvO30gLnJvdy1mbHVpZHt3aWR0aDoxMDAlO30gLnJvdywudGh1bWJuYWlsc3ttYXJnaW4tbGVmdDowO30gLnRodW1ibmFpbHM+bGl7ZmxvYXQ6bm9uZTttYXJnaW4tbGVmdDowO30gW2NsYXNzKj0ic3BhbiJdLC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJde2Zsb2F0Om5vbmU7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21hcmdpbi1sZWZ0OjA7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94O30gLnNwYW4xMiwucm93LWZsdWlkIC5zcGFuMTJ7d2lkdGg6MTAwJTstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3g7fSAucm93LWZsdWlkIFtjbGFzcyo9Im9mZnNldCJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7fSAuaW5wdXQtbGFyZ2UsLmlucHV0LXhsYXJnZSwuaW5wdXQteHhsYXJnZSxpbnB1dFtjbGFzcyo9InNwYW4iXSxzZWxlY3RbY2xhc3MqPSJzcGFuIl0sdGV4dGFyZWFbY2xhc3MqPSJzcGFuIl0sLnVuZWRpdGFibGUtaW5wdXR7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3g7fSAuaW5wdXQtcHJlcGVuZCBpbnB1dCwuaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1hcHBlbmQgaW5wdXRbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTppbmxpbmUtYmxvY2s7d2lkdGg6YXV0bzt9IC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDowO30gLm1vZGFse3Bvc2l0aW9uOmZpeGVkO3RvcDoyMHB4O2xlZnQ6MjBweDtyaWdodDoyMHB4O3dpZHRoOmF1dG87bWFyZ2luOjA7fS5tb2RhbC5mYWRle3RvcDotMTAwcHg7fSAubW9kYWwuZmFkZS5pbnt0b3A6MjBweDt9fUBtZWRpYSAobWF4LXdpZHRoOjQ4MHB4KXsubmF2LWNvbGxhcHNley13ZWJraXQtdHJhbnNmb3JtOnRyYW5zbGF0ZTNkKDAsIDAsIDApO30gLnBhZ2UtaGVhZGVyIGgxIHNtYWxse2Rpc3BsYXk6YmxvY2s7bGluZS1oZWlnaHQ6MjBweDt9IGlucHV0W3R5cGU9ImNoZWNrYm94Il0saW5wdXRbdHlwZT0icmFkaW8iXXtib3JkZXI6MXB4IHNvbGlkICNjY2M7fSAuZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWxhYmVse2Zsb2F0Om5vbmU7d2lkdGg6YXV0bztwYWRkaW5nLXRvcDowO3RleHQtYWxpZ246bGVmdDt9IC5mb3JtLWhvcml6b250YWwgLmNvbnRyb2xze21hcmdpbi1sZWZ0OjA7fSAuZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWxpc3R7cGFkZGluZy10b3A6MDt9IC5mb3JtLWhvcml6b250YWwgLmZvcm0tYWN0aW9uc3twYWRkaW5nLWxlZnQ6MTBweDtwYWRkaW5nLXJpZ2h0OjEwcHg7fSAubWVkaWEgLnB1bGwtbGVmdCwubWVkaWEgLnB1bGwtcmlnaHR7ZmxvYXQ6bm9uZTtkaXNwbGF5OmJsb2NrO21hcmdpbi1ib3R0b206MTBweDt9IC5tZWRpYS1vYmplY3R7bWFyZ2luLXJpZ2h0OjA7bWFyZ2luLWxlZnQ6MDt9IC5tb2RhbHt0b3A6MTBweDtsZWZ0OjEwcHg7cmlnaHQ6MTBweDt9IC5tb2RhbC1oZWFkZXIgLmNsb3Nle3BhZGRpbmc6MTBweDttYXJnaW46LTEwcHg7fSAuY2Fyb3VzZWwtY2FwdGlvbntwb3NpdGlvbjpzdGF0aWM7fX1AbWVkaWEgKG1pbi13aWR0aDo3NjhweCkgYW5kIChtYXgtd2lkdGg6OTc5cHgpey5yb3d7bWFyZ2luLWxlZnQ6LTIwcHg7Knpvb206MTt9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9IC5yb3c6YWZ0ZXJ7Y2xlYXI6Ym90aDt9IFtjbGFzcyo9InNwYW4iXXtmbG9hdDpsZWZ0O21pbi1oZWlnaHQ6MXB4O21hcmdpbi1sZWZ0OjIwcHg7fSAuY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDo3MjRweDt9IC5zcGFuMTJ7d2lkdGg6NzI0cHg7fSAuc3BhbjExe3dpZHRoOjY2MnB4O30gLnNwYW4xMHt3aWR0aDo2MDBweDt9IC5zcGFuOXt3aWR0aDo1MzhweDt9IC5zcGFuOHt3aWR0aDo0NzZweDt9IC5zcGFuN3t3aWR0aDo0MTRweDt9IC5zcGFuNnt3aWR0aDozNTJweDt9IC5zcGFuNXt3aWR0aDoyOTBweDt9IC5zcGFuNHt3aWR0aDoyMjhweDt9IC5zcGFuM3t3aWR0aDoxNjZweDt9IC5zcGFuMnt3aWR0aDoxMDRweDt9IC5zcGFuMXt3aWR0aDo0MnB4O30gLm9mZnNldDEye21hcmdpbi1sZWZ0Ojc2NHB4O30gLm9mZnNldDExe21hcmdpbi1sZWZ0OjcwMnB4O30gLm9mZnNldDEwe21hcmdpbi1sZWZ0OjY0MHB4O30gLm9mZnNldDl7bWFyZ2luLWxlZnQ6NTc4cHg7fSAub2Zmc2V0OHttYXJnaW4tbGVmdDo1MTZweDt9IC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjQ1NHB4O30gLm9mZnNldDZ7bWFyZ2luLWxlZnQ6MzkycHg7fSAub2Zmc2V0NXttYXJnaW4tbGVmdDozMzBweDt9IC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjI2OHB4O30gLm9mZnNldDN7bWFyZ2luLWxlZnQ6MjA2cHg7fSAub2Zmc2V0MnttYXJnaW4tbGVmdDoxNDRweDt9IC5vZmZzZXQxe21hcmdpbi1sZWZ0OjgycHg7fSAucm93LWZsdWlke3dpZHRoOjEwMCU7Knpvb206MTt9LnJvdy1mbHVpZDpiZWZvcmUsLnJvdy1mbHVpZDphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9IC5yb3ctZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aDt9IC5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJde2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTttaW4taGVpZ2h0OjMwcHg7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94O2Zsb2F0OmxlZnQ7bWFyZ2luLWxlZnQ6Mi43NjI0MzA5MzkyMjY1MTk0JTsqbWFyZ2luLWxlZnQ6Mi43MDkyMzk0NDk4NjQ4MTclO30gLnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl06Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MDt9IC5yb3ctZmx1aWQgLmNvbnRyb2xzLXJvdyBbY2xhc3MqPSJzcGFuIl0rW2NsYXNzKj0ic3BhbiJde21hcmdpbi1sZWZ0OjIuNzYyNDMwOTM5MjI2NTE5NCU7fSAucm93LWZsdWlkIC5zcGFuMTJ7d2lkdGg6MTAwJTsqd2lkdGg6OTkuOTQ2ODA4NTEwNjM4MjklO30gLnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQzNjQ2NDA4ODM5Nzc4JTsqd2lkdGg6OTEuMzgzMjcyNTk5MDM2MDglO30gLnJvdy1mbHVpZCAuc3BhbjEwe3dpZHRoOjgyLjg3MjkyODE3Njc5NTU4JTsqd2lkdGg6ODIuODE5NzM2Njg3NDMzODclO30gLnJvdy1mbHVpZCAuc3Bhbjl7d2lkdGg6NzQuMzA5MzkyMjY1MTkzMzclOyp3aWR0aDo3NC4yNTYyMDA3NzU4MzE2NiU7fSAucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS43NDU4NTYzNTM1OTExNyU7KndpZHRoOjY1LjY5MjY2NDg2NDIyOTQ2JTt9IC5yb3ctZmx1aWQgLnNwYW43e3dpZHRoOjU3LjE4MjMyMDQ0MTk4ODk1JTsqd2lkdGg6NTcuMTI5MTI4OTUyNjI3MjUlO30gLnJvdy1mbHVpZCAuc3BhbjZ7d2lkdGg6NDguNjE4Nzg0NTMwMzg2NzQlOyp3aWR0aDo0OC41NjU1OTMwNDEwMjUwNCU7fSAucm93LWZsdWlkIC5zcGFuNXt3aWR0aDo0MC4wNTUyNDg2MTg3ODQ1MyU7KndpZHRoOjQwLjAwMjA1NzEyOTQyMjgzJTt9IC5yb3ctZmx1aWQgLnNwYW40e3dpZHRoOjMxLjQ5MTcxMjcwNzE4MjMyMyU7KndpZHRoOjMxLjQzODUyMTIxNzgyMDYyJTt9IC5yb3ctZmx1aWQgLnNwYW4ze3dpZHRoOjIyLjkyODE3Njc5NTU4MDExJTsqd2lkdGg6MjIuODc0OTg1MzA2MjE4NDElO30gLnJvdy1mbHVpZCAuc3BhbjJ7d2lkdGg6MTQuMzY0NjQwODgzOTc3OSU7KndpZHRoOjE0LjMxMTQ0OTM5NDYxNjE5OSU7fSAucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo1LjgwMTEwNDk3MjM3NTY5MSU7KndpZHRoOjUuNzQ3OTEzNDgzMDEzOTg4JTt9IC5yb3ctZmx1aWQgLm9mZnNldDEye21hcmdpbi1sZWZ0OjEwNS41MjQ4NjE4Nzg0NTMwNCU7Km1hcmdpbi1sZWZ0OjEwNS40MTg0Nzg4OTk3Mjk2MiU7fSAucm93LWZsdWlkIC5vZmZzZXQxMjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxMDIuNzYyNDMwOTM5MjI2NTIlOyptYXJnaW4tbGVmdDoxMDIuNjU2MDQ3OTYwNTAzMSU7fSAucm93LWZsdWlkIC5vZmZzZXQxMXttYXJnaW4tbGVmdDo5Ni45NjEzMjU5NjY4NTA4MiU7Km1hcmdpbi1sZWZ0Ojk2Ljg1NDk0Mjk4ODEyNzQlO30gLnJvdy1mbHVpZCAub2Zmc2V0MTE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OTQuMTk4ODk1MDI3NjI0MyU7Km1hcmdpbi1sZWZ0Ojk0LjA5MjUxMjA0ODkwMDg5JTt9IC5yb3ctZmx1aWQgLm9mZnNldDEwe21hcmdpbi1sZWZ0Ojg4LjM5Nzc5MDA1NTI0ODYyJTsqbWFyZ2luLWxlZnQ6ODguMjkxNDA3MDc2NTI1MiU7fSAucm93LWZsdWlkIC5vZmZzZXQxMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4NS42MzUzNTkxMTYwMjIxJTsqbWFyZ2luLWxlZnQ6ODUuNTI4OTc2MTM3Mjk4NjglO30gLnJvdy1mbHVpZCAub2Zmc2V0OXttYXJnaW4tbGVmdDo3OS44MzQyNTQxNDM2NDY0JTsqbWFyZ2luLWxlZnQ6NzkuNzI3ODcxMTY0OTIyOTklO30gLnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ny4wNzE4MjMyMDQ0MTk4OSU7Km1hcmdpbi1sZWZ0Ojc2Ljk2NTQ0MDIyNTY5NjQ3JTt9IC5yb3ctZmx1aWQgLm9mZnNldDh7bWFyZ2luLWxlZnQ6NzEuMjcwNzE4MjMyMDQ0MiU7Km1hcmdpbi1sZWZ0OjcxLjE2NDMzNTI1MzMyMDc5JTt9IC5yb3ctZmx1aWQgLm9mZnNldDg6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NjguNTA4Mjg3MjkyODE3NjglOyptYXJnaW4tbGVmdDo2OC40MDE5MDQzMTQwOTQyNyU7fSAucm93LWZsdWlkIC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjYyLjcwNzE4MjMyMDQ0MTk5JTsqbWFyZ2luLWxlZnQ6NjIuNjAwNzk5MzQxNzE4NTg0JTt9IC5yb3ctZmx1aWQgLm9mZnNldDc6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTkuOTQ0NzUxMzgxMjE1NDclOyptYXJnaW4tbGVmdDo1OS44MzgzNjg0MDI0OTIwNjUlO30gLnJvdy1mbHVpZCAub2Zmc2V0NnttYXJnaW4tbGVmdDo1NC4xNDM2NDY0MDg4Mzk3OCU7Km1hcmdpbi1sZWZ0OjU0LjAzNzI2MzQzMDExNjM3NiU7fSAucm93LWZsdWlkIC5vZmZzZXQ2OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjUxLjM4MTIxNTQ2OTYxMzI2JTsqbWFyZ2luLWxlZnQ6NTEuMjc0ODMyNDkwODg5ODYlO30gLnJvdy1mbHVpZCAub2Zmc2V0NXttYXJnaW4tbGVmdDo0NS41ODAxMTA0OTcyMzc1NyU7Km1hcmdpbi1sZWZ0OjQ1LjQ3MzcyNzUxODUxNDE3JTt9IC5yb3ctZmx1aWQgLm9mZnNldDU6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NDIuODE3Njc5NTU4MDExMDUlOyptYXJnaW4tbGVmdDo0Mi43MTEyOTY1NzkyODc2NSU7fSAucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM3LjAxNjU3NDU4NTYzNTM2JTsqbWFyZ2luLWxlZnQ6MzYuOTEwMTkxNjA2OTExOTYlO30gLnJvdy1mbHVpZCAub2Zmc2V0NDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDozNC4yNTQxNDM2NDY0MDg4NCU7Km1hcmdpbi1sZWZ0OjM0LjE0Nzc2MDY2NzY4NTQ0JTt9IC5yb3ctZmx1aWQgLm9mZnNldDN7bWFyZ2luLWxlZnQ6MjguNDUzMDM4Njc0MDMzMTUlOyptYXJnaW4tbGVmdDoyOC4zNDY2NTU2OTUzMDk3NDYlO30gLnJvdy1mbHVpZCAub2Zmc2V0MzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoyNS42OTA2MDc3MzQ4MDY2MyU7Km1hcmdpbi1sZWZ0OjI1LjU4NDIyNDc1NjA4MzIyNyU7fSAucm93LWZsdWlkIC5vZmZzZXQye21hcmdpbi1sZWZ0OjE5Ljg4OTUwMjc2MjQzMDk0JTsqbWFyZ2luLWxlZnQ6MTkuNzgzMTE5NzgzNzA3NTM3JTt9IC5yb3ctZmx1aWQgLm9mZnNldDI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTcuMTI3MDcxODIzMjA0NDIlOyptYXJnaW4tbGVmdDoxNy4wMjA2ODg4NDQ0ODEwMiU7fSAucm93LWZsdWlkIC5vZmZzZXQxe21hcmdpbi1sZWZ0OjExLjMyNTk2Njg1MDgyODczJTsqbWFyZ2luLWxlZnQ6MTEuMjE5NTgzODcyMTA1MzI1JTt9IC5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41NjM1MzU5MTE2MDIyMSU7Km1hcmdpbi1sZWZ0OjguNDU3MTUyOTMyODc4ODA2JTt9IGlucHV0LHRleHRhcmVhLC51bmVkaXRhYmxlLWlucHV0e21hcmdpbi1sZWZ0OjA7fSAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MjBweDt9IGlucHV0LnNwYW4xMix0ZXh0YXJlYS5zcGFuMTIsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEye3dpZHRoOjcxMHB4O30gaW5wdXQuc3BhbjExLHRleHRhcmVhLnNwYW4xMSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMTF7d2lkdGg6NjQ4cHg7fSBpbnB1dC5zcGFuMTAsdGV4dGFyZWEuc3BhbjEwLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMHt3aWR0aDo1ODZweDt9IGlucHV0LnNwYW45LHRleHRhcmVhLnNwYW45LC51bmVkaXRhYmxlLWlucHV0LnNwYW45e3dpZHRoOjUyNHB4O30gaW5wdXQuc3BhbjgsdGV4dGFyZWEuc3BhbjgsLnVuZWRpdGFibGUtaW5wdXQuc3Bhbjh7d2lkdGg6NDYycHg7fSBpbnB1dC5zcGFuNyx0ZXh0YXJlYS5zcGFuNywudW5lZGl0YWJsZS1pbnB1dC5zcGFuN3t3aWR0aDo0MDBweDt9IGlucHV0LnNwYW42LHRleHRhcmVhLnNwYW42LC51bmVkaXRhYmxlLWlucHV0LnNwYW42e3dpZHRoOjMzOHB4O30gaW5wdXQuc3BhbjUsdGV4dGFyZWEuc3BhbjUsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjV7d2lkdGg6Mjc2cHg7fSBpbnB1dC5zcGFuNCx0ZXh0YXJlYS5zcGFuNCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNHt3aWR0aDoyMTRweDt9IGlucHV0LnNwYW4zLHRleHRhcmVhLnNwYW4zLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ze3dpZHRoOjE1MnB4O30gaW5wdXQuc3BhbjIsdGV4dGFyZWEuc3BhbjIsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjJ7d2lkdGg6OTBweDt9IGlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjI4cHg7fX1AbWVkaWEgKG1pbi13aWR0aDoxMjAwcHgpey5yb3d7bWFyZ2luLWxlZnQ6LTMwcHg7Knpvb206MTt9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9IC5yb3c6YWZ0ZXJ7Y2xlYXI6Ym90aDt9IFtjbGFzcyo9InNwYW4iXXtmbG9hdDpsZWZ0O21pbi1oZWlnaHQ6MXB4O21hcmdpbi1sZWZ0OjMwcHg7fSAuY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDoxMTcwcHg7fSAuc3BhbjEye3dpZHRoOjExNzBweDt9IC5zcGFuMTF7d2lkdGg6MTA3MHB4O30gLnNwYW4xMHt3aWR0aDo5NzBweDt9IC5zcGFuOXt3aWR0aDo4NzBweDt9IC5zcGFuOHt3aWR0aDo3NzBweDt9IC5zcGFuN3t3aWR0aDo2NzBweDt9IC5zcGFuNnt3aWR0aDo1NzBweDt9IC5zcGFuNXt3aWR0aDo0NzBweDt9IC5zcGFuNHt3aWR0aDozNzBweDt9IC5zcGFuM3t3aWR0aDoyNzBweDt9IC5zcGFuMnt3aWR0aDoxNzBweDt9IC5zcGFuMXt3aWR0aDo3MHB4O30gLm9mZnNldDEye21hcmdpbi1sZWZ0OjEyMzBweDt9IC5vZmZzZXQxMXttYXJnaW4tbGVmdDoxMTMwcHg7fSAub2Zmc2V0MTB7bWFyZ2luLWxlZnQ6MTAzMHB4O30gLm9mZnNldDl7bWFyZ2luLWxlZnQ6OTMwcHg7fSAub2Zmc2V0OHttYXJnaW4tbGVmdDo4MzBweDt9IC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjczMHB4O30gLm9mZnNldDZ7bWFyZ2luLWxlZnQ6NjMwcHg7fSAub2Zmc2V0NXttYXJnaW4tbGVmdDo1MzBweDt9IC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjQzMHB4O30gLm9mZnNldDN7bWFyZ2luLWxlZnQ6MzMwcHg7fSAub2Zmc2V0MnttYXJnaW4tbGVmdDoyMzBweDt9IC5vZmZzZXQxe21hcmdpbi1sZWZ0OjEzMHB4O30gLnJvdy1mbHVpZHt3aWR0aDoxMDAlOyp6b29tOjE7fS5yb3ctZmx1aWQ6YmVmb3JlLC5yb3ctZmx1aWQ6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fSAucm93LWZsdWlkOmFmdGVye2NsZWFyOmJvdGg7fSAucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4Oy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDtmbG9hdDpsZWZ0O21hcmdpbi1sZWZ0OjIuNTY0MTAyNTY0MTAyNTY0JTsqbWFyZ2luLWxlZnQ6Mi41MTA5MTEwNzQ3NDA4NjE2JTt9IC5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7fSAucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyLjU2NDEwMjU2NDEwMjU2NCU7fSAucm93LWZsdWlkIC5zcGFuMTJ7d2lkdGg6MTAwJTsqd2lkdGg6OTkuOTQ2ODA4NTEwNjM4MjklO30gLnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQ1Mjk5MTQ1Mjk5MTQ1JTsqd2lkdGg6OTEuMzk5Nzk5OTYzNjI5NzUlO30gLnJvdy1mbHVpZCAuc3BhbjEwe3dpZHRoOjgyLjkwNTk4MjkwNTk4MjkxJTsqd2lkdGg6ODIuODUyNzkxNDE2NjIxMiU7fSAucm93LWZsdWlkIC5zcGFuOXt3aWR0aDo3NC4zNTg5NzQzNTg5NzQzNiU7KndpZHRoOjc0LjMwNTc4Mjg2OTYxMjY2JTt9IC5yb3ctZmx1aWQgLnNwYW44e3dpZHRoOjY1LjgxMTk2NTgxMTk2NTgyJTsqd2lkdGg6NjUuNzU4Nzc0MzIyNjA0MTElO30gLnJvdy1mbHVpZCAuc3Bhbjd7d2lkdGg6NTcuMjY0OTU3MjY0OTU3MjYlOyp3aWR0aDo1Ny4yMTE3NjU3NzU1OTU1NiU7fSAucm93LWZsdWlkIC5zcGFuNnt3aWR0aDo0OC43MTc5NDg3MTc5NDg3MTUlOyp3aWR0aDo0OC42NjQ3NTcyMjg1ODcwMTQlO30gLnJvdy1mbHVpZCAuc3BhbjV7d2lkdGg6NDAuMTcwOTQwMTcwOTQwMTclOyp3aWR0aDo0MC4xMTc3NDg2ODE1Nzg0NyU7fSAucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS42MjM5MzE2MjM5MzE2MjUlOyp3aWR0aDozMS41NzA3NDAxMzQ1Njk5MjQlO30gLnJvdy1mbHVpZCAuc3BhbjN7d2lkdGg6MjMuMDc2OTIzMDc2OTIzMDc3JTsqd2lkdGg6MjMuMDIzNzMxNTg3NTYxMzc1JTt9IC5yb3ctZmx1aWQgLnNwYW4ye3dpZHRoOjE0LjUyOTkxNDUyOTkxNDUzJTsqd2lkdGg6MTQuNDc2NzIzMDQwNTUyODI4JTt9IC5yb3ctZmx1aWQgLnNwYW4xe3dpZHRoOjUuOTgyOTA1OTgyOTA1OTgzJTsqd2lkdGg6NS45Mjk3MTQ0OTM1NDQyODElO30gLnJvdy1mbHVpZCAub2Zmc2V0MTJ7bWFyZ2luLWxlZnQ6MTA1LjEyODIwNTEyODIwNTEyJTsqbWFyZ2luLWxlZnQ6MTA1LjAyMTgyMjE0OTQ4MTcxJTt9IC5yb3ctZmx1aWQgLm9mZnNldDEyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjEwMi41NjQxMDI1NjQxMDI1NyU7Km1hcmdpbi1sZWZ0OjEwMi40NTc3MTk1ODUzNzkxNSU7fSAucm93LWZsdWlkIC5vZmZzZXQxMXttYXJnaW4tbGVmdDo5Ni41ODExOTY1ODExOTY1OCU7Km1hcmdpbi1sZWZ0Ojk2LjQ3NDgxMzYwMjQ3MzE2JTt9IC5yb3ctZmx1aWQgLm9mZnNldDExOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojk0LjAxNzA5NDAxNzA5NDAyJTsqbWFyZ2luLWxlZnQ6OTMuOTEwNzExMDM4MzcwNjElO30gLnJvdy1mbHVpZCAub2Zmc2V0MTB7bWFyZ2luLWxlZnQ6ODguMDM0MTg4MDM0MTg4MDMlOyptYXJnaW4tbGVmdDo4Ny45Mjc4MDUwNTU0NjQ2MiU7fSAucm93LWZsdWlkIC5vZmZzZXQxMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4NS40NzAwODU0NzAwODU0OCU7Km1hcmdpbi1sZWZ0Ojg1LjM2MzcwMjQ5MTM2MjA2JTt9IC5yb3ctZmx1aWQgLm9mZnNldDl7bWFyZ2luLWxlZnQ6NzkuNDg3MTc5NDg3MTc5NDklOyptYXJnaW4tbGVmdDo3OS4zODA3OTY1MDg0NTYwNyU7fSAucm93LWZsdWlkIC5vZmZzZXQ5OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojc2LjkyMzA3NjkyMzA3NjkzJTsqbWFyZ2luLWxlZnQ6NzYuODE2NjkzOTQ0MzUzNTIlO30gLnJvdy1mbHVpZCAub2Zmc2V0OHttYXJnaW4tbGVmdDo3MC45NDAxNzA5NDAxNzA5NCU7Km1hcmdpbi1sZWZ0OjcwLjgzMzc4Nzk2MTQ0NzUzJTt9IC5yb3ctZmx1aWQgLm9mZnNldDg6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NjguMzc2MDY4Mzc2MDY4MzklOyptYXJnaW4tbGVmdDo2OC4yNjk2ODUzOTczNDQ5NyU7fSAucm93LWZsdWlkIC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjYyLjM5MzE2MjM5MzE2MjM4NSU7Km1hcmdpbi1sZWZ0OjYyLjI4Njc3OTQxNDQzODk5JTt9IC5yb3ctZmx1aWQgLm9mZnNldDc6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTkuODI5MDU5ODI5MDU5ODIlOyptYXJnaW4tbGVmdDo1OS43MjI2NzY4NTAzMzY0MiU7fSAucm93LWZsdWlkIC5vZmZzZXQ2e21hcmdpbi1sZWZ0OjUzLjg0NjE1Mzg0NjE1Mzg0JTsqbWFyZ2luLWxlZnQ6NTMuNzM5NzcwODY3NDMwNDQ0JTt9IC5yb3ctZmx1aWQgLm9mZnNldDY6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTEuMjgyMDUxMjgyMDUxMjglOyptYXJnaW4tbGVmdDo1MS4xNzU2NjgzMDMzMjc4NzUlO30gLnJvdy1mbHVpZCAub2Zmc2V0NXttYXJnaW4tbGVmdDo0NS4yOTkxNDUyOTkxNDUyOTUlOyptYXJnaW4tbGVmdDo0NS4xOTI3NjIzMjA0MjE5JTt9IC5yb3ctZmx1aWQgLm9mZnNldDU6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NDIuNzM1MDQyNzM1MDQyNzMlOyptYXJnaW4tbGVmdDo0Mi42Mjg2NTk3NTYzMTkzMyU7fSAucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM2Ljc1MjEzNjc1MjEzNjc1JTsqbWFyZ2luLWxlZnQ6MzYuNjQ1NzUzNzczNDEzMzU0JTt9IC5yb3ctZmx1aWQgLm9mZnNldDQ6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MzQuMTg4MDM0MTg4MDM0MTklOyptYXJnaW4tbGVmdDozNC4wODE2NTEyMDkzMTA3ODUlO30gLnJvdy1mbHVpZCAub2Zmc2V0M3ttYXJnaW4tbGVmdDoyOC4yMDUxMjgyMDUxMjgyMDQlOyptYXJnaW4tbGVmdDoyOC4wOTg3NDUyMjY0MDQ4JTt9IC5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNjQxMDI1NjQxMDI1NjQyJTsqbWFyZ2luLWxlZnQ6MjUuNTM0NjQyNjYyMzAyMjQlO30gLnJvdy1mbHVpZCAub2Zmc2V0MnttYXJnaW4tbGVmdDoxOS42NTgxMTk2NTgxMTk2NiU7Km1hcmdpbi1sZWZ0OjE5LjU1MTczNjY3OTM5NjI1NyU7fSAucm93LWZsdWlkIC5vZmZzZXQyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjE3LjA5NDAxNzA5NDAxNzA5NCU7Km1hcmdpbi1sZWZ0OjE2Ljk4NzYzNDExNTI5MzY5JTt9IC5yb3ctZmx1aWQgLm9mZnNldDF7bWFyZ2luLWxlZnQ6MTEuMTExMTExMTExMTExMTElOyptYXJnaW4tbGVmdDoxMS4wMDQ3MjgxMzIzODc3MDglO30gLnJvdy1mbHVpZCAub2Zmc2V0MTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4LjU0NzAwODU0NzAwODU0NyU7Km1hcmdpbi1sZWZ0OjguNDQwNjI1NTY4Mjg1MTQyJTt9IGlucHV0LHRleHRhcmVhLC51bmVkaXRhYmxlLWlucHV0e21hcmdpbi1sZWZ0OjA7fSAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MzBweDt9IGlucHV0LnNwYW4xMix0ZXh0YXJlYS5zcGFuMTIsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEye3dpZHRoOjExNTZweDt9IGlucHV0LnNwYW4xMSx0ZXh0YXJlYS5zcGFuMTEsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjExe3dpZHRoOjEwNTZweDt9IGlucHV0LnNwYW4xMCx0ZXh0YXJlYS5zcGFuMTAsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEwe3dpZHRoOjk1NnB4O30gaW5wdXQuc3BhbjksdGV4dGFyZWEuc3BhbjksLnVuZWRpdGFibGUtaW5wdXQuc3Bhbjl7d2lkdGg6ODU2cHg7fSBpbnB1dC5zcGFuOCx0ZXh0YXJlYS5zcGFuOCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo3NTZweDt9IGlucHV0LnNwYW43LHRleHRhcmVhLnNwYW43LC51bmVkaXRhYmxlLWlucHV0LnNwYW43e3dpZHRoOjY1NnB4O30gaW5wdXQuc3BhbjYsdGV4dGFyZWEuc3BhbjYsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjZ7d2lkdGg6NTU2cHg7fSBpbnB1dC5zcGFuNSx0ZXh0YXJlYS5zcGFuNSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDo0NTZweDt9IGlucHV0LnNwYW40LHRleHRhcmVhLnNwYW40LC51bmVkaXRhYmxlLWlucHV0LnNwYW40e3dpZHRoOjM1NnB4O30gaW5wdXQuc3BhbjMsdGV4dGFyZWEuc3BhbjMsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjN7d2lkdGg6MjU2cHg7fSBpbnB1dC5zcGFuMix0ZXh0YXJlYS5zcGFuMiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDoxNTZweDt9IGlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjU2cHg7fSAudGh1bWJuYWlsc3ttYXJnaW4tbGVmdDotMzBweDt9IC50aHVtYm5haWxzPmxpe21hcmdpbi1sZWZ0OjMwcHg7fSAucm93LWZsdWlkIC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjA7fX1AbWVkaWEgKG1heC13aWR0aDo5NzlweCl7Ym9keXtwYWRkaW5nLXRvcDowO30gLm5hdmJhci1maXhlZC10b3AsLm5hdmJhci1maXhlZC1ib3R0b217cG9zaXRpb246c3RhdGljO30gLm5hdmJhci1maXhlZC10b3B7bWFyZ2luLWJvdHRvbToyMHB4O30gLm5hdmJhci1maXhlZC1ib3R0b217bWFyZ2luLXRvcDoyMHB4O30gLm5hdmJhci1maXhlZC10b3AgLm5hdmJhci1pbm5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2YmFyLWlubmVye3BhZGRpbmc6NXB4O30gLm5hdmJhciAuY29udGFpbmVye3dpZHRoOmF1dG87cGFkZGluZzowO30gLm5hdmJhciAuYnJhbmR7cGFkZGluZy1sZWZ0OjEwcHg7cGFkZGluZy1yaWdodDoxMHB4O21hcmdpbjowIDAgMCAtNXB4O30gLm5hdi1jb2xsYXBzZXtjbGVhcjpib3RoO30gLm5hdi1jb2xsYXBzZSAubmF2e2Zsb2F0Om5vbmU7bWFyZ2luOjAgMCAxMHB4O30gLm5hdi1jb2xsYXBzZSAubmF2Pmxpe2Zsb2F0Om5vbmU7fSAubmF2LWNvbGxhcHNlIC5uYXY+bGk+YXttYXJnaW4tYm90dG9tOjJweDt9IC5uYXYtY29sbGFwc2UgLm5hdj4uZGl2aWRlci12ZXJ0aWNhbHtkaXNwbGF5Om5vbmU7fSAubmF2LWNvbGxhcHNlIC5uYXYgLm5hdi1oZWFkZXJ7Y29sb3I6Izc3Nzc3Nzt0ZXh0LXNoYWRvdzpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2PmxpPmEsLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhe3BhZGRpbmc6OXB4IDE1cHg7Zm9udC13ZWlnaHQ6Ym9sZDtjb2xvcjojNzc3Nzc3Oy13ZWJraXQtYm9yZGVyLXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzOjNweDtib3JkZXItcmFkaXVzOjNweDt9IC5uYXYtY29sbGFwc2UgLmJ0bntwYWRkaW5nOjRweCAxMHB4IDRweDtmb250LXdlaWdodDpub3JtYWw7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O30gLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBsaStsaSBhe21hcmdpbi1ib3R0b206MnB4O30gLm5hdi1jb2xsYXBzZSAubmF2PmxpPmE6aG92ZXIsLm5hdi1jb2xsYXBzZSAubmF2PmxpPmE6Zm9jdXMsLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhOmhvdmVyLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYTpmb2N1c3tiYWNrZ3JvdW5kLWNvbG9yOiNmMmYyZjI7fSAubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAubmF2PmxpPmEsLm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYXtjb2xvcjojOTk5OTk5O30gLm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXY+bGk+YTpmb2N1cywubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51IGE6Zm9jdXN7YmFja2dyb3VuZC1jb2xvcjojMTExMTExO30gLm5hdi1jb2xsYXBzZS5pbiAuYnRuLWdyb3Vwe21hcmdpbi10b3A6NXB4O3BhZGRpbmc6MDt9IC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnV7cG9zaXRpb246c3RhdGljO3RvcDphdXRvO2xlZnQ6YXV0bztmbG9hdDpub25lO2Rpc3BsYXk6bm9uZTttYXgtd2lkdGg6bm9uZTttYXJnaW46MCAxNXB4O3BhZGRpbmc6MDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjpub25lOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmU7fSAubmF2LWNvbGxhcHNlIC5vcGVuPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2s7fSAubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51OmJlZm9yZSwubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51OmFmdGVye2Rpc3BsYXk6bm9uZTt9IC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgLmRpdmlkZXJ7ZGlzcGxheTpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZSwubmF2LWNvbGxhcHNlIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXJ7ZGlzcGxheTpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2YmFyLWZvcm0sLm5hdi1jb2xsYXBzZSAubmF2YmFyLXNlYXJjaHtmbG9hdDpub25lO3BhZGRpbmc6MTBweCAxNXB4O21hcmdpbjoxMHB4IDA7Ym9yZGVyLXRvcDoxcHggc29saWQgI2YyZjJmMjtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZjJmMmYyOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xKSwgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xKTt9IC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXZiYXItZm9ybSwubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAubmF2YmFyLXNlYXJjaHtib3JkZXItdG9wLWNvbG9yOiMxMTExMTE7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMTExMTExO30gLm5hdmJhciAubmF2LWNvbGxhcHNlIC5uYXYucHVsbC1yaWdodHtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjA7fSAubmF2LWNvbGxhcHNlLC5uYXYtY29sbGFwc2UuY29sbGFwc2V7b3ZlcmZsb3c6aGlkZGVuO2hlaWdodDowO30gLm5hdmJhciAuYnRuLW5hdmJhcntkaXNwbGF5OmJsb2NrO30gLm5hdmJhci1zdGF0aWMgLm5hdmJhci1pbm5lcntwYWRkaW5nLWxlZnQ6MTBweDtwYWRkaW5nLXJpZ2h0OjEwcHg7fX1AbWVkaWEgKG1pbi13aWR0aDo5ODBweCl7Lm5hdi1jb2xsYXBzZS5jb2xsYXBzZXtoZWlnaHQ6YXV0byAhaW1wb3J0YW50O292ZXJmbG93OnZpc2libGUgIWltcG9ydGFudDt9fQ==';
// main.css	
$main_style='Ym9keXsgcGFkZGluZy10b3A6MjBweDsgIHBhZGRpbmctYm90dG9tOjQwcHh9DQouY29udGFpbmVyLW5hcnJvd3sgbWFyZ2luOjAgYXV0bzsgIG1heC13aWR0aDo5MDBweH0NCi5jb250YWluZXItbmFycm93ID5ocnsgbWFyZ2luOjMwcHggMH0NCi5qdW1ib3Ryb257IG1hcmdpbjo2MHB4IDA7ICB0ZXh0LWFsaWduOmNlbnRlcn0NCi5qdW1ib3Ryb24gaDF7IGZvbnQtc2l6ZTo3MnB4OyAgbGluZS1oZWlnaHQ6MX0NCi5qdW1ib3Ryb24gLmJ0bnsgZm9udC1zaXplOjIxcHg7ICBwYWRkaW5nOjE0cHggMjRweH0NCi5icmFuZCBpeyBmb250LXNpemU6MTRweDsgIHBhZGRpbmc6MTNweDsgY29sb3I6IzMwMzAzMH0NCnVsLnNtaWxleXMge3dpZHRoOiAxNzBweH0NCi5zbWlsZXlzIGxpe2Zsb2F0OmxlZnR9';
// bootstrap-responsive.min.css	v2.3.2
$bs_responsive=
'LyohDQogKiBCb290c3RyYXAgUmVzcG9uc2l2ZSB2Mi4zLjINCiAqDQogKiBDb3B5cmlnaHQgMjAxMiBUd2l0dGVyLCBJbmMNCiAqIExpY2Vuc2VkIHVuZGVyIHRoZSBBcGFjaGUgTGljZW5zZSB2Mi4wDQogKiBodHRwOi8vd3d3LmFwYWNoZS5vcmcvbGljZW5zZXMvTElDRU5TRS0yLjANCiAqDQogKiBEZXNpZ25lZCBhbmQgYnVpbHQgd2l0aCBhbGwgdGhlIGxvdmUgaW4gdGhlIHdvcmxkIEB0d2l0dGVyIGJ5IEBtZG8gYW5kIEBmYXQuDQogKi8uY2xlYXJmaXh7Knpvb206MX0uY2xlYXJmaXg6YmVmb3JlLC5jbGVhcmZpeDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0uY2xlYXJmaXg6YWZ0ZXJ7Y2xlYXI6Ym90aH0uaGlkZS10ZXh0e2ZvbnQ6MC8wIGE7Y29sb3I6dHJhbnNwYXJlbnQ7dGV4dC1zaGFkb3c6bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjowfS5pbnB1dC1ibG9jay1sZXZlbHtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4Oy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH1ALW1zLXZpZXdwb3J0e3dpZHRoOmRldmljZS13aWR0aH0uaGlkZGVue2Rpc3BsYXk6bm9uZTt2aXNpYmlsaXR5OmhpZGRlbn0udmlzaWJsZS1waG9uZXtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS52aXNpYmxlLXRhYmxldHtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS5oaWRkZW4tZGVza3RvcHtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS52aXNpYmxlLWRlc2t0b3B7ZGlzcGxheTppbmhlcml0IWltcG9ydGFudH1AbWVkaWEobWluLXdpZHRoOjc2OHB4KSBhbmQgKG1heC13aWR0aDo5NzlweCl7LmhpZGRlbi1kZXNrdG9we2Rpc3BsYXk6aW5oZXJpdCFpbXBvcnRhbnR9LnZpc2libGUtZGVza3RvcHtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS52aXNpYmxlLXRhYmxldHtkaXNwbGF5OmluaGVyaXQhaW1wb3J0YW50fS5oaWRkZW4tdGFibGV0e2Rpc3BsYXk6bm9uZSFpbXBvcnRhbnR9fUBtZWRpYShtYXgtd2lkdGg6NzY3cHgpey5oaWRkZW4tZGVza3RvcHtkaXNwbGF5OmluaGVyaXQhaW1wb3J0YW50fS52aXNpYmxlLWRlc2t0b3B7ZGlzcGxheTpub25lIWltcG9ydGFudH0udmlzaWJsZS1waG9uZXtkaXNwbGF5OmluaGVyaXQhaW1wb3J0YW50fS5oaWRkZW4tcGhvbmV7ZGlzcGxheTpub25lIWltcG9ydGFudH19LnZpc2libGUtcHJpbnR7ZGlzcGxheTpub25lIWltcG9ydGFudH1AbWVkaWEgcHJpbnR7LnZpc2libGUtcHJpbnR7ZGlzcGxheTppbmhlcml0IWltcG9ydGFudH0uaGlkZGVuLXByaW50e2Rpc3BsYXk6bm9uZSFpbXBvcnRhbnR9fUBtZWRpYShtaW4td2lkdGg6MTIwMHB4KXsucm93e21hcmdpbi1sZWZ0Oi0zMHB4Oyp6b29tOjF9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93OmFmdGVye2NsZWFyOmJvdGh9W2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MzBweH0uY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDoxMTcwcHh9LnNwYW4xMnt3aWR0aDoxMTcwcHh9LnNwYW4xMXt3aWR0aDoxMDcwcHh9LnNwYW4xMHt3aWR0aDo5NzBweH0uc3Bhbjl7d2lkdGg6ODcwcHh9LnNwYW44e3dpZHRoOjc3MHB4fS5zcGFuN3t3aWR0aDo2NzBweH0uc3BhbjZ7d2lkdGg6NTcwcHh9LnNwYW41e3dpZHRoOjQ3MHB4fS5zcGFuNHt3aWR0aDozNzBweH0uc3BhbjN7d2lkdGg6MjcwcHh9LnNwYW4ye3dpZHRoOjE3MHB4fS5zcGFuMXt3aWR0aDo3MHB4fS5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMjMwcHh9Lm9mZnNldDExe21hcmdpbi1sZWZ0OjExMzBweH0ub2Zmc2V0MTB7bWFyZ2luLWxlZnQ6MTAzMHB4fS5vZmZzZXQ5e21hcmdpbi1sZWZ0OjkzMHB4fS5vZmZzZXQ4e21hcmdpbi1sZWZ0OjgzMHB4fS5vZmZzZXQ3e21hcmdpbi1sZWZ0OjczMHB4fS5vZmZzZXQ2e21hcmdpbi1sZWZ0OjYzMHB4fS5vZmZzZXQ1e21hcmdpbi1sZWZ0OjUzMHB4fS5vZmZzZXQ0e21hcmdpbi1sZWZ0OjQzMHB4fS5vZmZzZXQze21hcmdpbi1sZWZ0OjMzMHB4fS5vZmZzZXQye21hcmdpbi1sZWZ0OjIzMHB4fS5vZmZzZXQxe21hcmdpbi1sZWZ0OjEzMHB4fS5yb3ctZmx1aWR7d2lkdGg6MTAwJTsqem9vbToxfS5yb3ctZmx1aWQ6YmVmb3JlLC5yb3ctZmx1aWQ6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LnJvdy1mbHVpZDphZnRlcntjbGVhcjpib3RofS5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJde2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bGVmdDt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDttYXJnaW4tbGVmdDoyLjU2NDEwMjU2NDEwMjU2NCU7Km1hcmdpbi1sZWZ0OjIuNTEwOTExMDc0NzQwODYxNiU7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94fS5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjB9LnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6Mi41NjQxMDI1NjQxMDI1NjQlfS5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSV9LnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQ1Mjk5MTQ1Mjk5MTQ1JTsqd2lkdGg6OTEuMzk5Nzk5OTYzNjI5NzUlfS5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi45MDU5ODI5MDU5ODI5MSU7KndpZHRoOjgyLjg1Mjc5MTQxNjYyMTIlfS5yb3ctZmx1aWQgLnNwYW45e3dpZHRoOjc0LjM1ODk3NDM1ODk3NDM2JTsqd2lkdGg6NzQuMzA1NzgyODY5NjEyNjYlfS5yb3ctZmx1aWQgLnNwYW44e3dpZHRoOjY1LjgxMTk2NTgxMTk2NTgyJTsqd2lkdGg6NjUuNzU4Nzc0MzIyNjA0MTElfS5yb3ctZmx1aWQgLnNwYW43e3dpZHRoOjU3LjI2NDk1NzI2NDk1NzI2JTsqd2lkdGg6NTcuMjExNzY1Nzc1NTk1NTYlfS5yb3ctZmx1aWQgLnNwYW42e3dpZHRoOjQ4LjcxNzk0ODcxNzk0ODcxNSU7KndpZHRoOjQ4LjY2NDc1NzIyODU4NzAxNCV9LnJvdy1mbHVpZCAuc3BhbjV7d2lkdGg6NDAuMTcwOTQwMTcwOTQwMTclOyp3aWR0aDo0MC4xMTc3NDg2ODE1Nzg0NyV9LnJvdy1mbHVpZCAuc3BhbjR7d2lkdGg6MzEuNjIzOTMxNjIzOTMxNjI1JTsqd2lkdGg6MzEuNTcwNzQwMTM0NTY5OTI0JX0ucm93LWZsdWlkIC5zcGFuM3t3aWR0aDoyMy4wNzY5MjMwNzY5MjMwNzclOyp3aWR0aDoyMy4wMjM3MzE1ODc1NjEzNzUlfS5yb3ctZmx1aWQgLnNwYW4ye3dpZHRoOjE0LjUyOTkxNDUyOTkxNDUzJTsqd2lkdGg6MTQuNDc2NzIzMDQwNTUyODI4JX0ucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo1Ljk4MjkwNTk4MjkwNTk4MyU7KndpZHRoOjUuOTI5NzE0NDkzNTQ0MjgxJX0ucm93LWZsdWlkIC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMDUuMTI4MjA1MTI4MjA1MTIlOyptYXJnaW4tbGVmdDoxMDUuMDIxODIyMTQ5NDgxNzElfS5yb3ctZmx1aWQgLm9mZnNldDEyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjEwMi41NjQxMDI1NjQxMDI1NyU7Km1hcmdpbi1sZWZ0OjEwMi40NTc3MTk1ODUzNzkxNSV9LnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTYuNTgxMTk2NTgxMTk2NTglOyptYXJnaW4tbGVmdDo5Ni40NzQ4MTM2MDI0NzMxNiV9LnJvdy1mbHVpZCAub2Zmc2V0MTE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OTQuMDE3MDk0MDE3MDk0MDIlOyptYXJnaW4tbGVmdDo5My45MTA3MTEwMzgzNzA2MSV9LnJvdy1mbHVpZCAub2Zmc2V0MTB7bWFyZ2luLWxlZnQ6ODguMDM0MTg4MDM0MTg4MDMlOyptYXJnaW4tbGVmdDo4Ny45Mjc4MDUwNTU0NjQ2MiV9LnJvdy1mbHVpZCAub2Zmc2V0MTA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6ODUuNDcwMDg1NDcwMDg1NDglOyptYXJnaW4tbGVmdDo4NS4zNjM3MDI0OTEzNjIwNiV9LnJvdy1mbHVpZCAub2Zmc2V0OXttYXJnaW4tbGVmdDo3OS40ODcxNzk0ODcxNzk0OSU7Km1hcmdpbi1sZWZ0Ojc5LjM4MDc5NjUwODQ1NjA3JX0ucm93LWZsdWlkIC5vZmZzZXQ5OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojc2LjkyMzA3NjkyMzA3NjkzJTsqbWFyZ2luLWxlZnQ6NzYuODE2NjkzOTQ0MzUzNTIlfS5yb3ctZmx1aWQgLm9mZnNldDh7bWFyZ2luLWxlZnQ6NzAuOTQwMTcwOTQwMTcwOTQlOyptYXJnaW4tbGVmdDo3MC44MzM3ODc5NjE0NDc1MyV9LnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC4zNzYwNjgzNzYwNjgzOSU7Km1hcmdpbi1sZWZ0OjY4LjI2OTY4NTM5NzM0NDk3JX0ucm93LWZsdWlkIC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjYyLjM5MzE2MjM5MzE2MjM4NSU7Km1hcmdpbi1sZWZ0OjYyLjI4Njc3OTQxNDQzODk5JX0ucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5LjgyOTA1OTgyOTA1OTgyJTsqbWFyZ2luLWxlZnQ6NTkuNzIyNjc2ODUwMzM2NDIlfS5yb3ctZmx1aWQgLm9mZnNldDZ7bWFyZ2luLWxlZnQ6NTMuODQ2MTUzODQ2MTUzODQlOyptYXJnaW4tbGVmdDo1My43Mzk3NzA4Njc0MzA0NDQlfS5yb3ctZmx1aWQgLm9mZnNldDY6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTEuMjgyMDUxMjgyMDUxMjglOyptYXJnaW4tbGVmdDo1MS4xNzU2NjgzMDMzMjc4NzUlfS5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDUuMjk5MTQ1Mjk5MTQ1Mjk1JTsqbWFyZ2luLWxlZnQ6NDUuMTkyNzYyMzIwNDIxOSV9LnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi43MzUwNDI3MzUwNDI3MyU7Km1hcmdpbi1sZWZ0OjQyLjYyODY1OTc1NjMxOTMzJX0ucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM2Ljc1MjEzNjc1MjEzNjc1JTsqbWFyZ2luLWxlZnQ6MzYuNjQ1NzUzNzczNDEzMzU0JX0ucm93LWZsdWlkIC5vZmZzZXQ0OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjM0LjE4ODAzNDE4ODAzNDE5JTsqbWFyZ2luLWxlZnQ6MzQuMDgxNjUxMjA5MzEwNzg1JX0ucm93LWZsdWlkIC5vZmZzZXQze21hcmdpbi1sZWZ0OjI4LjIwNTEyODIwNTEyODIwNCU7Km1hcmdpbi1sZWZ0OjI4LjA5ODc0NTIyNjQwNDglfS5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNjQxMDI1NjQxMDI1NjQyJTsqbWFyZ2luLWxlZnQ6MjUuNTM0NjQyNjYyMzAyMjQlfS5yb3ctZmx1aWQgLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTkuNjU4MTE5NjU4MTE5NjYlOyptYXJnaW4tbGVmdDoxOS41NTE3MzY2NzkzOTYyNTclfS5yb3ctZmx1aWQgLm9mZnNldDI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTcuMDk0MDE3MDk0MDE3MDk0JTsqbWFyZ2luLWxlZnQ6MTYuOTg3NjM0MTE1MjkzNjklfS5yb3ctZmx1aWQgLm9mZnNldDF7bWFyZ2luLWxlZnQ6MTEuMTExMTExMTExMTExMTElOyptYXJnaW4tbGVmdDoxMS4wMDQ3MjgxMzIzODc3MDglfS5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41NDcwMDg1NDcwMDg1NDclOyptYXJnaW4tbGVmdDo4LjQ0MDYyNTU2ODI4NTE0MiV9aW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7bWFyZ2luLWxlZnQ6MH0uY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MzBweH1pbnB1dC5zcGFuMTIsdGV4dGFyZWEuc3BhbjEyLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMnt3aWR0aDoxMTU2cHh9aW5wdXQuc3BhbjExLHRleHRhcmVhLnNwYW4xMSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMTF7d2lkdGg6MTA1NnB4fWlucHV0LnNwYW4xMCx0ZXh0YXJlYS5zcGFuMTAsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEwe3dpZHRoOjk1NnB4fWlucHV0LnNwYW45LHRleHRhcmVhLnNwYW45LC51bmVkaXRhYmxlLWlucHV0LnNwYW45e3dpZHRoOjg1NnB4fWlucHV0LnNwYW44LHRleHRhcmVhLnNwYW44LC51bmVkaXRhYmxlLWlucHV0LnNwYW44e3dpZHRoOjc1NnB4fWlucHV0LnNwYW43LHRleHRhcmVhLnNwYW43LC51bmVkaXRhYmxlLWlucHV0LnNwYW43e3dpZHRoOjY1NnB4fWlucHV0LnNwYW42LHRleHRhcmVhLnNwYW42LC51bmVkaXRhYmxlLWlucHV0LnNwYW42e3dpZHRoOjU1NnB4fWlucHV0LnNwYW41LHRleHRhcmVhLnNwYW41LC51bmVkaXRhYmxlLWlucHV0LnNwYW41e3dpZHRoOjQ1NnB4fWlucHV0LnNwYW40LHRleHRhcmVhLnNwYW40LC51bmVkaXRhYmxlLWlucHV0LnNwYW40e3dpZHRoOjM1NnB4fWlucHV0LnNwYW4zLHRleHRhcmVhLnNwYW4zLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ze3dpZHRoOjI1NnB4fWlucHV0LnNwYW4yLHRleHRhcmVhLnNwYW4yLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ye3dpZHRoOjE1NnB4fWlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjU2cHh9LnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6LTMwcHh9LnRodW1ibmFpbHM+bGl7bWFyZ2luLWxlZnQ6MzBweH0ucm93LWZsdWlkIC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjB9fUBtZWRpYShtaW4td2lkdGg6NzY4cHgpIGFuZCAobWF4LXdpZHRoOjk3OXB4KXsucm93e21hcmdpbi1sZWZ0Oi0yMHB4Oyp6b29tOjF9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93OmFmdGVye2NsZWFyOmJvdGh9W2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MjBweH0uY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDo3MjRweH0uc3BhbjEye3dpZHRoOjcyNHB4fS5zcGFuMTF7d2lkdGg6NjYycHh9LnNwYW4xMHt3aWR0aDo2MDBweH0uc3Bhbjl7d2lkdGg6NTM4cHh9LnNwYW44e3dpZHRoOjQ3NnB4fS5zcGFuN3t3aWR0aDo0MTRweH0uc3BhbjZ7d2lkdGg6MzUycHh9LnNwYW41e3dpZHRoOjI5MHB4fS5zcGFuNHt3aWR0aDoyMjhweH0uc3BhbjN7d2lkdGg6MTY2cHh9LnNwYW4ye3dpZHRoOjEwNHB4fS5zcGFuMXt3aWR0aDo0MnB4fS5vZmZzZXQxMnttYXJnaW4tbGVmdDo3NjRweH0ub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6NzAycHh9Lm9mZnNldDEwe21hcmdpbi1sZWZ0OjY0MHB4fS5vZmZzZXQ5e21hcmdpbi1sZWZ0OjU3OHB4fS5vZmZzZXQ4e21hcmdpbi1sZWZ0OjUxNnB4fS5vZmZzZXQ3e21hcmdpbi1sZWZ0OjQ1NHB4fS5vZmZzZXQ2e21hcmdpbi1sZWZ0OjM5MnB4fS5vZmZzZXQ1e21hcmdpbi1sZWZ0OjMzMHB4fS5vZmZzZXQ0e21hcmdpbi1sZWZ0OjI2OHB4fS5vZmZzZXQze21hcmdpbi1sZWZ0OjIwNnB4fS5vZmZzZXQye21hcmdpbi1sZWZ0OjE0NHB4fS5vZmZzZXQxe21hcmdpbi1sZWZ0OjgycHh9LnJvdy1mbHVpZHt3aWR0aDoxMDAlOyp6b29tOjF9LnJvdy1mbHVpZDpiZWZvcmUsLnJvdy1mbHVpZDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93LWZsdWlkOmFmdGVye2NsZWFyOmJvdGh9LnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTpibG9jaztmbG9hdDpsZWZ0O3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4O21hcmdpbi1sZWZ0OjIuNzYyNDMwOTM5MjI2NTE5NCU7Km1hcmdpbi1sZWZ0OjIuNzA5MjM5NDQ5ODY0ODE3JTstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3h9LnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl06Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MH0ucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyLjc2MjQzMDkzOTIyNjUxOTQlfS5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSV9LnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQzNjQ2NDA4ODM5Nzc4JTsqd2lkdGg6OTEuMzgzMjcyNTk5MDM2MDglfS5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi44NzI5MjgxNzY3OTU1OCU7KndpZHRoOjgyLjgxOTczNjY4NzQzMzg3JX0ucm93LWZsdWlkIC5zcGFuOXt3aWR0aDo3NC4zMDkzOTIyNjUxOTMzNyU7KndpZHRoOjc0LjI1NjIwMDc3NTgzMTY2JX0ucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS43NDU4NTYzNTM1OTExNyU7KndpZHRoOjY1LjY5MjY2NDg2NDIyOTQ2JX0ucm93LWZsdWlkIC5zcGFuN3t3aWR0aDo1Ny4xODIzMjA0NDE5ODg5NSU7KndpZHRoOjU3LjEyOTEyODk1MjYyNzI1JX0ucm93LWZsdWlkIC5zcGFuNnt3aWR0aDo0OC42MTg3ODQ1MzAzODY3NCU7KndpZHRoOjQ4LjU2NTU5MzA0MTAyNTA0JX0ucm93LWZsdWlkIC5zcGFuNXt3aWR0aDo0MC4wNTUyNDg2MTg3ODQ1MyU7KndpZHRoOjQwLjAwMjA1NzEyOTQyMjgzJX0ucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS40OTE3MTI3MDcxODIzMjMlOyp3aWR0aDozMS40Mzg1MjEyMTc4MjA2MiV9LnJvdy1mbHVpZCAuc3BhbjN7d2lkdGg6MjIuOTI4MTc2Nzk1NTgwMTElOyp3aWR0aDoyMi44NzQ5ODUzMDYyMTg0MSV9LnJvdy1mbHVpZCAuc3BhbjJ7d2lkdGg6MTQuMzY0NjQwODgzOTc3OSU7KndpZHRoOjE0LjMxMTQ0OTM5NDYxNjE5OSV9LnJvdy1mbHVpZCAuc3BhbjF7d2lkdGg6NS44MDExMDQ5NzIzNzU2OTElOyp3aWR0aDo1Ljc0NzkxMzQ4MzAxMzk4OCV9LnJvdy1mbHVpZCAub2Zmc2V0MTJ7bWFyZ2luLWxlZnQ6MTA1LjUyNDg2MTg3ODQ1MzA0JTsqbWFyZ2luLWxlZnQ6MTA1LjQxODQ3ODg5OTcyOTYyJX0ucm93LWZsdWlkIC5vZmZzZXQxMjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxMDIuNzYyNDMwOTM5MjI2NTIlOyptYXJnaW4tbGVmdDoxMDIuNjU2MDQ3OTYwNTAzMSV9LnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTYuOTYxMzI1OTY2ODUwODIlOyptYXJnaW4tbGVmdDo5Ni44NTQ5NDI5ODgxMjc0JX0ucm93LWZsdWlkIC5vZmZzZXQxMTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo5NC4xOTg4OTUwMjc2MjQzJTsqbWFyZ2luLWxlZnQ6OTQuMDkyNTEyMDQ4OTAwODklfS5yb3ctZmx1aWQgLm9mZnNldDEwe21hcmdpbi1sZWZ0Ojg4LjM5Nzc5MDA1NTI0ODYyJTsqbWFyZ2luLWxlZnQ6ODguMjkxNDA3MDc2NTI1MiV9LnJvdy1mbHVpZCAub2Zmc2V0MTA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6ODUuNjM1MzU5MTE2MDIyMSU7Km1hcmdpbi1sZWZ0Ojg1LjUyODk3NjEzNzI5ODY4JX0ucm93LWZsdWlkIC5vZmZzZXQ5e21hcmdpbi1sZWZ0Ojc5LjgzNDI1NDE0MzY0NjQlOyptYXJnaW4tbGVmdDo3OS43Mjc4NzExNjQ5MjI5OSV9LnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ny4wNzE4MjMyMDQ0MTk4OSU7Km1hcmdpbi1sZWZ0Ojc2Ljk2NTQ0MDIyNTY5NjQ3JX0ucm93LWZsdWlkIC5vZmZzZXQ4e21hcmdpbi1sZWZ0OjcxLjI3MDcxODIzMjA0NDIlOyptYXJnaW4tbGVmdDo3MS4xNjQzMzUyNTMzMjA3OSV9LnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC41MDgyODcyOTI4MTc2OCU7Km1hcmdpbi1sZWZ0OjY4LjQwMTkwNDMxNDA5NDI3JX0ucm93LWZsdWlkIC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjYyLjcwNzE4MjMyMDQ0MTk5JTsqbWFyZ2luLWxlZnQ6NjIuNjAwNzk5MzQxNzE4NTg0JX0ucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5Ljk0NDc1MTM4MTIxNTQ3JTsqbWFyZ2luLWxlZnQ6NTkuODM4MzY4NDAyNDkyMDY1JX0ucm93LWZsdWlkIC5vZmZzZXQ2e21hcmdpbi1sZWZ0OjU0LjE0MzY0NjQwODgzOTc4JTsqbWFyZ2luLWxlZnQ6NTQuMDM3MjYzNDMwMTE2Mzc2JX0ucm93LWZsdWlkIC5vZmZzZXQ2OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjUxLjM4MTIxNTQ2OTYxMzI2JTsqbWFyZ2luLWxlZnQ6NTEuMjc0ODMyNDkwODg5ODYlfS5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDUuNTgwMTEwNDk3MjM3NTclOyptYXJnaW4tbGVmdDo0NS40NzM3Mjc1MTg1MTQxNyV9LnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi44MTc2Nzk1NTgwMTEwNSU7Km1hcmdpbi1sZWZ0OjQyLjcxMTI5NjU3OTI4NzY1JX0ucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM3LjAxNjU3NDU4NTYzNTM2JTsqbWFyZ2luLWxlZnQ6MzYuOTEwMTkxNjA2OTExOTYlfS5yb3ctZmx1aWQgLm9mZnNldDQ6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MzQuMjU0MTQzNjQ2NDA4ODQlOyptYXJnaW4tbGVmdDozNC4xNDc3NjA2Njc2ODU0NCV9LnJvdy1mbHVpZCAub2Zmc2V0M3ttYXJnaW4tbGVmdDoyOC40NTMwMzg2NzQwMzMxNSU7Km1hcmdpbi1sZWZ0OjI4LjM0NjY1NTY5NTMwOTc0NiV9LnJvdy1mbHVpZCAub2Zmc2V0MzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoyNS42OTA2MDc3MzQ4MDY2MyU7Km1hcmdpbi1sZWZ0OjI1LjU4NDIyNDc1NjA4MzIyNyV9LnJvdy1mbHVpZCAub2Zmc2V0MnttYXJnaW4tbGVmdDoxOS44ODk1MDI3NjI0MzA5NCU7Km1hcmdpbi1sZWZ0OjE5Ljc4MzExOTc4MzcwNzUzNyV9LnJvdy1mbHVpZCAub2Zmc2V0MjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxNy4xMjcwNzE4MjMyMDQ0MiU7Km1hcmdpbi1sZWZ0OjE3LjAyMDY4ODg0NDQ4MTAyJX0ucm93LWZsdWlkIC5vZmZzZXQxe21hcmdpbi1sZWZ0OjExLjMyNTk2Njg1MDgyODczJTsqbWFyZ2luLWxlZnQ6MTEuMjE5NTgzODcyMTA1MzI1JX0ucm93LWZsdWlkIC5vZmZzZXQxOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjguNTYzNTM1OTExNjAyMjElOyptYXJnaW4tbGVmdDo4LjQ1NzE1MjkzMjg3ODgwNiV9aW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7bWFyZ2luLWxlZnQ6MH0uY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MjBweH1pbnB1dC5zcGFuMTIsdGV4dGFyZWEuc3BhbjEyLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMnt3aWR0aDo3MTBweH1pbnB1dC5zcGFuMTEsdGV4dGFyZWEuc3BhbjExLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMXt3aWR0aDo2NDhweH1pbnB1dC5zcGFuMTAsdGV4dGFyZWEuc3BhbjEwLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMHt3aWR0aDo1ODZweH1pbnB1dC5zcGFuOSx0ZXh0YXJlYS5zcGFuOSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOXt3aWR0aDo1MjRweH1pbnB1dC5zcGFuOCx0ZXh0YXJlYS5zcGFuOCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo0NjJweH1pbnB1dC5zcGFuNyx0ZXh0YXJlYS5zcGFuNywudW5lZGl0YWJsZS1pbnB1dC5zcGFuN3t3aWR0aDo0MDBweH1pbnB1dC5zcGFuNix0ZXh0YXJlYS5zcGFuNiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNnt3aWR0aDozMzhweH1pbnB1dC5zcGFuNSx0ZXh0YXJlYS5zcGFuNSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDoyNzZweH1pbnB1dC5zcGFuNCx0ZXh0YXJlYS5zcGFuNCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNHt3aWR0aDoyMTRweH1pbnB1dC5zcGFuMyx0ZXh0YXJlYS5zcGFuMywudW5lZGl0YWJsZS1pbnB1dC5zcGFuM3t3aWR0aDoxNTJweH1pbnB1dC5zcGFuMix0ZXh0YXJlYS5zcGFuMiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDo5MHB4fWlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjI4cHh9fUBtZWRpYShtYXgtd2lkdGg6NzY3cHgpe2JvZHl7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctbGVmdDoyMHB4fS5uYXZiYXItZml4ZWQtdG9wLC5uYXZiYXItZml4ZWQtYm90dG9tLC5uYXZiYXItc3RhdGljLXRvcHttYXJnaW4tcmlnaHQ6LTIwcHg7bWFyZ2luLWxlZnQ6LTIwcHh9LmNvbnRhaW5lci1mbHVpZHtwYWRkaW5nOjB9LmRsLWhvcml6b250YWwgZHR7ZmxvYXQ6bm9uZTt3aWR0aDphdXRvO2NsZWFyOm5vbmU7dGV4dC1hbGlnbjpsZWZ0fS5kbC1ob3Jpem9udGFsIGRke21hcmdpbi1sZWZ0OjB9LmNvbnRhaW5lcnt3aWR0aDphdXRvfS5yb3ctZmx1aWR7d2lkdGg6MTAwJX0ucm93LC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjB9LnRodW1ibmFpbHM+bGl7ZmxvYXQ6bm9uZTttYXJnaW4tbGVmdDowfVtjbGFzcyo9InNwYW4iXSwudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO2Zsb2F0Om5vbmU7d2lkdGg6MTAwJTttYXJnaW4tbGVmdDowOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0uc3BhbjEyLC5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0ucm93LWZsdWlkIFtjbGFzcyo9Im9mZnNldCJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjB9LmlucHV0LWxhcmdlLC5pbnB1dC14bGFyZ2UsLmlucHV0LXh4bGFyZ2UsaW5wdXRbY2xhc3MqPSJzcGFuIl0sc2VsZWN0W2NsYXNzKj0ic3BhbiJdLHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC51bmVkaXRhYmxlLWlucHV0e2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTttaW4taGVpZ2h0OjMwcHg7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94fS5pbnB1dC1wcmVwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgaW5wdXQsLmlucHV0LXByZXBlbmQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLmlucHV0LWFwcGVuZCBpbnB1dFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmlubGluZS1ibG9jazt3aWR0aDphdXRvfS5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDowfS5tb2RhbHtwb3NpdGlvbjpmaXhlZDt0b3A6MjBweDtyaWdodDoyMHB4O2xlZnQ6MjBweDt3aWR0aDphdXRvO21hcmdpbjowfS5tb2RhbC5mYWRle3RvcDotMTAwcHh9Lm1vZGFsLmZhZGUuaW57dG9wOjIwcHh9fUBtZWRpYShtYXgtd2lkdGg6NDgwcHgpey5uYXYtY29sbGFwc2V7LXdlYmtpdC10cmFuc2Zvcm06dHJhbnNsYXRlM2QoMCwwLDApfS5wYWdlLWhlYWRlciBoMSBzbWFsbHtkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjIwcHh9aW5wdXRbdHlwZT0iY2hlY2tib3giXSxpbnB1dFt0eXBlPSJyYWRpbyJde2JvcmRlcjoxcHggc29saWQgI2NjY30uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWxhYmVse2Zsb2F0Om5vbmU7d2lkdGg6YXV0bztwYWRkaW5nLXRvcDowO3RleHQtYWxpZ246bGVmdH0uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sc3ttYXJnaW4tbGVmdDowfS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtbGlzdHtwYWRkaW5nLXRvcDowfS5mb3JtLWhvcml6b250YWwgLmZvcm0tYWN0aW9uc3twYWRkaW5nLXJpZ2h0OjEwcHg7cGFkZGluZy1sZWZ0OjEwcHh9Lm1lZGlhIC5wdWxsLWxlZnQsLm1lZGlhIC5wdWxsLXJpZ2h0e2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bm9uZTttYXJnaW4tYm90dG9tOjEwcHh9Lm1lZGlhLW9iamVjdHttYXJnaW4tcmlnaHQ6MDttYXJnaW4tbGVmdDowfS5tb2RhbHt0b3A6MTBweDtyaWdodDoxMHB4O2xlZnQ6MTBweH0ubW9kYWwtaGVhZGVyIC5jbG9zZXtwYWRkaW5nOjEwcHg7bWFyZ2luOi0xMHB4fS5jYXJvdXNlbC1jYXB0aW9ue3Bvc2l0aW9uOnN0YXRpY319QG1lZGlhKG1heC13aWR0aDo5NzlweCl7Ym9keXtwYWRkaW5nLXRvcDowfS5uYXZiYXItZml4ZWQtdG9wLC5uYXZiYXItZml4ZWQtYm90dG9te3Bvc2l0aW9uOnN0YXRpY30ubmF2YmFyLWZpeGVkLXRvcHttYXJnaW4tYm90dG9tOjIwcHh9Lm5hdmJhci1maXhlZC1ib3R0b217bWFyZ2luLXRvcDoyMHB4fS5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLm5hdmJhci1pbm5lcntwYWRkaW5nOjVweH0ubmF2YmFyIC5jb250YWluZXJ7d2lkdGg6YXV0bztwYWRkaW5nOjB9Lm5hdmJhciAuYnJhbmR7cGFkZGluZy1yaWdodDoxMHB4O3BhZGRpbmctbGVmdDoxMHB4O21hcmdpbjowIDAgMCAtNXB4fS5uYXYtY29sbGFwc2V7Y2xlYXI6Ym90aH0ubmF2LWNvbGxhcHNlIC5uYXZ7ZmxvYXQ6bm9uZTttYXJnaW46MCAwIDEwcHh9Lm5hdi1jb2xsYXBzZSAubmF2Pmxpe2Zsb2F0Om5vbmV9Lm5hdi1jb2xsYXBzZSAubmF2PmxpPmF7bWFyZ2luLWJvdHRvbToycHh9Lm5hdi1jb2xsYXBzZSAubmF2Pi5kaXZpZGVyLXZlcnRpY2Fse2Rpc3BsYXk6bm9uZX0ubmF2LWNvbGxhcHNlIC5uYXYgLm5hdi1oZWFkZXJ7Y29sb3I6Izc3Nzt0ZXh0LXNoYWRvdzpub25lfS5uYXYtY29sbGFwc2UgLm5hdj5saT5hLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYXtwYWRkaW5nOjlweCAxNXB4O2ZvbnQtd2VpZ2h0OmJvbGQ7Y29sb3I6Izc3Nzstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHh9Lm5hdi1jb2xsYXBzZSAuYnRue3BhZGRpbmc6NHB4IDEwcHggNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHh9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBsaStsaSBhe21hcmdpbi1ib3R0b206MnB4fS5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmZvY3VzLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYTpob3ZlciwubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51IGE6Zm9jdXN7YmFja2dyb3VuZC1jb2xvcjojZjJmMmYyfS5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXY+bGk+YSwubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhe2NvbG9yOiM5OTl9Lm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXY+bGk+YTpmb2N1cywubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51IGE6Zm9jdXN7YmFja2dyb3VuZC1jb2xvcjojMTExfS5uYXYtY29sbGFwc2UuaW4gLmJ0bi1ncm91cHtwYWRkaW5nOjA7bWFyZ2luLXRvcDo1cHh9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudXtwb3NpdGlvbjpzdGF0aWM7dG9wOmF1dG87bGVmdDphdXRvO2Rpc3BsYXk6bm9uZTtmbG9hdDpub25lO21heC13aWR0aDpub25lO3BhZGRpbmc6MDttYXJnaW46MCAxNXB4O2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyOjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowOy13ZWJraXQtYm94LXNoYWRvdzpub25lOy1tb3otYm94LXNoYWRvdzpub25lO2JveC1zaGFkb3c6bm9uZX0ubmF2LWNvbGxhcHNlIC5vcGVuPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2t9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudTpiZWZvcmUsLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudTphZnRlcntkaXNwbGF5Om5vbmV9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSAuZGl2aWRlcntkaXNwbGF5Om5vbmV9Lm5hdi1jb2xsYXBzZSAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZSwubmF2LWNvbGxhcHNlIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXJ7ZGlzcGxheTpub25lfS5uYXYtY29sbGFwc2UgLm5hdmJhci1mb3JtLC5uYXYtY29sbGFwc2UgLm5hdmJhci1zZWFyY2h7ZmxvYXQ6bm9uZTtwYWRkaW5nOjEwcHggMTVweDttYXJnaW46MTBweCAwO2JvcmRlci10b3A6MXB4IHNvbGlkICNmMmYyZjI7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2YyZjJmMjstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEpLDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSl9Lm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLm5hdmJhci1mb3JtLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXZiYXItc2VhcmNoe2JvcmRlci10b3AtY29sb3I6IzExMTtib3JkZXItYm90dG9tLWNvbG9yOiMxMTF9Lm5hdmJhciAubmF2LWNvbGxhcHNlIC5uYXYucHVsbC1yaWdodHtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjB9Lm5hdi1jb2xsYXBzZSwubmF2LWNvbGxhcHNlLmNvbGxhcHNle2hlaWdodDowO292ZXJmbG93OmhpZGRlbn0ubmF2YmFyIC5idG4tbmF2YmFye2Rpc3BsYXk6YmxvY2t9Lm5hdmJhci1zdGF0aWMgLm5hdmJhci1pbm5lcntwYWRkaW5nLXJpZ2h0OjEwcHg7cGFkZGluZy1sZWZ0OjEwcHh9fUBtZWRpYShtaW4td2lkdGg6OTgwcHgpey5uYXYtY29sbGFwc2UuY29sbGFwc2V7aGVpZ2h0OmF1dG8haW1wb3J0YW50O292ZXJmbG93OnZpc2libGUhaW1wb3J0YW50fX0=';
	@mkdir('css');
	$css = base64_decode($css);
	foreach($cVals as $k=>$v) {
		$css_copy=$css;
		for($i=0;$i<count($cNames);$i++) $css_copy=str_replace($cNames[$i],'#'.$v[$i],$css_copy);
		if($h=@fopen('css/style_'.$k.'.css','w')) {fputs($h,$css_copy);fclose($h);}
	}
	if(!file_exists('css/bootstrap-responsive.min.css')) {
		if($h=@fopen('css/bootstrap-responsive.min.css','w')) { fputs($h,base64_decode($bs_responsive));fclose($h); }
	}		
	if(!file_exists('css/main.css')) {
		if($h=@fopen('css/main.css','w')) { fputs($h,base64_decode($main_style));fclose($h); }
	}	
}
/**
*
* CRÉATION DU FICHIER .HTACCESS
*/
function mkhtaccess() {
	$s = $_SERVER['SCRIPT_NAME'];
	$mainHt = "<Files *.dat>\n";
	$mainHt .= "order allow,deny\n";
	$mainHt .= "deny from all\n";
	$mainHt .= "</Files>\n";
	$mainHt .= "options -indexes \n";
	if(!file_exists('data/.htaccess')) {
		if($h=@fopen('data/.htaccess','w')) { fputs($h,$mainHt);fclose($h); }
	}
	if(!file_exists('backup/.htaccess')) {
		if($h=@fopen('backup/.htaccess','w')) { fputs($h,$mainHt);fclose($h); }
	}	
}
/**
*
* CRÉATION DES IMAGES
*/
function mkimg() {
	global $img_names;
	$ret=true;
	if(!file_exists('img/') || !file_exists('img/'.$img_names[0].'.png')) {
		$image_array = array('iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACt0lEQVQ4jW2TTWhUZxSGn3vnzkySiTNREwnmx8ZKEUUJWLPQ/kDpIiB0I7Sl7aLbcSEUSTbdl5KoSKHOxp2UUixKF0KgPynYVYq0lGQi6czciIkmM47j/OTOvff7vjkuguNEfeHA93Le7z1wfiwRoRP3fxkfEJE0MIkwIQAiCwJzCJmDZ/8rdeqtTgP35vEpO7ZrJjn8Pt39R+lKjQHgV122SotU78+jw/r0Wx8vzb5ikPv52NXUyHvpvjc+JBrvhZaPiNoWWVGwu1B+nXLhV56485kjn9871zZY+enoTGrk3al9hz8CXQH1GNE1aHnbZeweLCcJ0X5wdvNw8Rblwp+zx7/8f9rK/nB4KBJPrb156jyW2oBgnYU/5kA0J98ZB+Dvv/4Fy2Hig0mIDyHOINn5i4ReZdjW2qRTg+NYXgGpLSINl3x2hfxyAcImhE3yywXy2RWk4SK1RaxmgT1DJ9DKpB2tzJlETxetahZUBcS0myqhv2NCEjQgbCKhz67eAZQyZxytzZG4KSP+ox2fAUT5r+fKJx4Frc2Yo5Rp6sajWKS11RZ+euEaACb3/Ws5QEuXUMpEHK2M26yXxxOxVjuply/vqPwyB/D8IlqZnK2Vvv2k/BRRIaJCFv550H6/HJ25YrGCVua2rZTJPNhsYEIfdMDo6AHu3F1jY7NK4HkEnsfGZpU7d9cYSEVBB5jQZ/VhFa1NJnL9d6++9Ns3CaX06f6EhdP/Nt1dCe65ZbJuhfy6Ry2IMzY8wP6hUeywzNJqnVIlmD37rXezvcq3vu69OrInmj64v4/u5CB28hCW07vdfd2gVcvhVdbIrVdZLQaZTy4FL1b5OW5Md0/FIswc2OuwLxmhr8cGoLJlKNYMbknhh63pz66oV4/pOX78KjYokEZkUmCC7XteEGEOyHzxnd7o1D8DrtiWZZW1vjgAAAAASUVORK5CYII=',// Smile
		
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACtUlEQVQ4jW2TT2hUVxTGf+/Nm3+ZOBPTRIL5Z2woQVECSQUtrZsuBMGNoqIuup0uCkWSjfsiiYoU6my6K6W0SoILQWlLBBdCihRKMoY4ZiKZaDLT8WUyyct77977rosx42j84MI5537fd/9wjqG1phEv7g62a63TwAk0RzSA1tMa7qPJ7D/9X6mRbzQa5CcOj5iRXWPJruPE2w4SS/UB4FbybJZmqLyYQvrV0c/Ozo7vMMjdOXQr1f1VumXf14SjzRC4aC1qJCMMZgzhVikv/Mnr/FTmwMW5b+sG878fHEt1fzmyZ+AUSBvE/2i5DoFTO8ZswrCSEG4DazcvZyYpLzwcP/zNs1Ej++tAZyiaKnx67DsMsQLeMlquQeCClm/vaYEZw7BaINqJtjrITl3Dd+wuS0qVbu0dxHAW0FsLINbeCd/in8czAHx+bBA8GyPu0No5RCH7IG1JoU4mmmIElSwIG7TiQzyfXwJgeKgf/C2077KruR0h1ElLSnUgqspo9xVoxR93HteFZ88cfc9IC7cWCJdoGKRUfZYQaktuvIqEgk0Azl/+uS5QuZ/eq23nAIEsIYQKWVKo/Fa1PJiIBADIpzd2POFjNcctIoXKmVLIe6/La2jho4XP9L9L9fjD1bhXLNpIoe6ZQqjM0uoGyndBevT09PLoSYGV1Qqe4+A5DiurFR49KdCeCoP0UL7L4ssKUqpM6Je/nersXz8khJBftCUMrLZh4rEEc/ky2bzN82WHdS9KX1c7ezt7MP0ys4tVSrY3fvqqM1Fv5ckrzbe6W8Pp/XtbiCc7MJP9GFZz7fflBsF6DscukFuusFj0Mueue+9aeRu3R+MjkRBjvZ9Y7EmGaGkyAbA3FcV1Rb4kcP1g9MJNsXOYtvHb95EODWm0PqHhCLV5ntaa+0Dm0o9ypZH/Bgvug8m/BV65AAAAAElFTkSuQmCC',// Wink
					
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACvklEQVQ4jXWTT2jTZxjHP7/klz+NSRM7WwtpXWupirJSqFQYVC8eBMXDHNvcPHjxEJGCh+bixYOn1MFwwx42cQeHykQRFAoKLR4EhaHUrnPWJiurtjZNY5Ka/Jr3ffN4iNYE8QPP4YHv8314Hp7HEhFqmb3Z2ywiMWAfQr8AiDwUGEUY2XxoIl2rt2oNUtd7hlzeUKKxbQ8NG3bgD3cC4ORSvElPkpsdQ5cL8S3f/D38kcHza1+cD7fvjkU69uLxBaHiIKKqIssDLj/KKZBJ3mE5NTay/Yenx9cMnl3dkQi3Dwy1bDsIOgtqCdF5qBSrbVwBLLsRPBvAXs/LyRtkkuPDPUen49bUH9uibl94ruvLQSy1AKsvuPzLOQC+O/YVAFd+vQ7A4ROD4IsiditTY2cpF7NtLq1NLNzai1VMIvlJZCX1YUPlUjXeISspJD+JVUrSFO1DKxOztTL71wX8VHJToLIghsPxCwBU/r9U7Vybl0tI2SEUbEYps9/W2mz3mQzizIMYAEzyN6zgVkQ5a3kdysHnAa1Np62UKemVee/4+KN6ERN8ilDQR99OG6WM29bKpEqFTG8wYNO95yKhzZ2fLPT4m1j6Z4KZ8SMUc4toZZ7bWunby5nXvS2RBqYf/4zrrxKB5i4wq+D21RkU0zMUi3k2RRpYXMyilbltjZ5pinpt11x/d5AlJ0IxNEDXrqN4wh31Y+f+Y+bB71hzV2nfGODek2WcVdNmiQi3TkcS0SZ7aOvAIAtP7/Lvs2kKhXz93KFGutrCbOo5wJN7F5h95Qx/nSjF1075xqng+Y7W9bHuvkP4m3vA7a9fgHFw0hNM3b9Ear4w8u2Pqx9O+T1/xhuGvG4Sn39m09LoJhJwAZB9Y1jMG1JphVOuxL//SX38TO+5fNLbKhBDZJ9AP9V/fijCKDBy5JxeqNW/BWFuUNI4hK7zAAAAAElFTkSuQmCC',// Laugh
					
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACgklEQVQ4jY2TSWiTURDHf1/yZWmtTe0ixbRo3SiKElx6EBcQhULBi6K4HLzGg+AhuXjx4ClVEA8WvHgSEZciKBQEK+KpiojGVGqTWHCpqWntkuZL3nvfeAjGaov4v8wb3n/+M2/ejCUiLMTYg0iLiESBboQuARAZEhhA6Ft7+M3EQr61UCB7f2vM41+eqG/bR03zZoKhDgCc6SyFiSTTY4Po8mx849F3vYsERu9uuRZq3xttWHMAX6AOXAcRVSFZPvAEUc4s+cxjJrODfZtOvj9TFRi5vTkRat8TW9l5CPQUqO+IngF3vpLGU4tl14OvGewVfEn2k8887d16+kPcSt3sDHsDoU/rdp3FUuNQ+szQkwEQzc7dEQBePH8Nlk3X/m4IhBG7ldTgJcrzU20erU001BrBms8gM0lkLks6NUJ6OAPlIpSLpIczpFMjyFwWmUliFTM0hrejlYnaWpmeZbVB3OkUqCkQU22qlJ0/fkhKc1AuImWH5XUtKGV6bK3NpoDJI87XavDx2A0ATPb6kj7KIeADrU2HrZQp6rmvfq9bqGbSI1f/yPy3D+DqCZQyXlsrky3O5iPL/O4i0r8w7+TQyozaWulHk/kfkdrmYPXy3uPRJYMOH1xfPedyBbQyj6yBi41hv+351LWhDq/HAsDTvK1im3ZUys2/rNjvryq9cIVnbydxSqbNEhEeXmhIhBvtWOeqIP+D5FiBsW9O75FEMV4d5f7zddfaG33RjhabGr9n6XeXXNLjJT7mSn3HLpd+j/Iv3InXxPxeEqubbFbWe2morQhNFQy5GUN2QuGU3fiJK2rxMv3CrXP+VoEoIt0CXVT2eUiEAaDv1FU9vpD/E0IIRZyy9OiQAAAAAElFTkSuQmCC',// Indifferent
					
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACqUlEQVQ4jW2TPWyTVxiFn8++/osT2wQHQUNKA2oVgYoikBiQKAuVqFAZ2qr8FAlWM1TqYC9ZOjtFQgxY6tIyIEAgECoIKoZ06sCI0ghRiAkBHJw4jpPY/ux77/d2+BrXIT3be3XuOUfvjyMidGPm7uiAiGSAowgHBEDkscBDhMLOr5/Md/OdboHi7b3ZQLgvn9h+mFh6D9HkMABurUh9fpLazASmvZL75Nu/xjcIPL/16eXk0GeZ1EdHCEV6wXMR0T7JCUEginZXqEw/YrE4Udj93dPzHYFnN/bkk0OHsltGjoOpgl5AzDJ4Dd8m0IOjEhBKg9rE28k7VKb/GN977u+cM3V1ZDAYSb7edfB7HD0HrTeIWQLPBTH/5lQQiOKoFEQGEbWVqYmfaDeq25UxNtO/YxSnMY00p0Evcf3X3wA4efYLAK5feeDX576EVhUn1qB/cD+vp37PKKPtsXhPFK82BboKYjtNlba7bkLSWoV2E2m79PUOoLU9poyxuyO2grilzudT2V8AsMWfO7UT/xgzmfWVtEskBMbYYaW1bZrVUjjo1TtO5tmldc7v1wCemUdrG1RG22JzpTIaD3sbSBug4mB8o4Zbxmj7XBlt7i9WlkZ70lE/ncQoLVpevFpgZXkJgL5Eil0fptm8ySEeaANQLtcx2t5XWtvC7LvVsW0JCAYc3pQWmS032HfwK5LpIQBqC7M8+fM2SvcST8ewnvDybQ1jbMEREe79mMoP9qvsyAd+iuC2z7GlR+vSd79NztSZeeeOf5Nv5jqrfGes9/JQfygzPKCIhQP/24JGy+PFXIuX5VbhxIXWf6u8hpu5WDYcJL9js2JLIkiqxxeq1i3lZUtxXuO2vdzpi3rjMa3h2g/hrQIZRI4KHMC/58ciPAQKZy6ZuW7+P55nU0QMP9uoAAAAAElFTkSuQmCC',// Sad
					
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAC9UlEQVQ4jWWTX2ibZRTGf9+XL0n/JlmT/qFpM1uHlE3DLNoLhw5awV2JtjCtc2W3FVF70cDqrXbSIgwvlhsvFJExlQ0vBoOpU5rdVNbCWMfQ2nSs29rENKbpvubL+345XoTVzD5w4OWc530eDuccQ0Soxd0fD7eKyDhwDGFAAETmBa4gJHtHbmZr+UatQPpifNL0Nc8Euo5SHzlEXbAHgFIhzaPsLQp3r6HLxcQzx5dm9wgs//DcuWD3K+Ohp17F62+CSgkRVSUZXjDrUKUiuZWrbKavJQ+euPPersAfFw7NBLtfnmzrex10HtTfiN6Cil21MRswrAB4I2Dt48GtS+RWfp2Nn/ozYdz+ti/q8QfXfll5lq/OXyWTLfDS8xEQl6/PDPAwW2Lko+uAiWFYZDYdEu+/yZHoAmU732UkTrRfuL564LhtV92mpqYAmJiY4GjcAGCn7kVGR0dxSjaffHqGcDhMe3s7MfO371j4snexuPChPB0LSSqVkrGxMRkcHJTh4WHx+/3i9XollUrJ9PS0xONx6e/vl97ukBR+/0DmznYuWlq7B/1ujpOvhRkaGnpipKdPRgH25se68LtZtHZ7LKXcHb390Hf67Rbe6NcAuBVhX6iBaEczAKcGfbgVwfJUW+poa8bdyaKU67G0ctM7xdzhRl+Fvp7gE06inOqHFt+evF3KoJW7bGqlL2/m/kFUGVFl5hfv7b7/H7W1TCaPVu5lUyk3eW9jG7dcAu0Qi+1n7sYa6xsFHNvGsW3WNwrM3VijNegF7eCWS6w+KKC1m/R887NdXPppulEpfSTSaGBFXqC+rpE76Ry303n+um+z5fjp6WqlMxrDLOdYWi2SzTuzI5/ZF3dX+dLHTee6W7zjvZ0h6gMdmIEDGFZTtWe9TWVrGTu/xvL9AqsZJ/nW585/q/wY3yfqJ30eZvaHLdoCHkINJgD5Ry6ZLZd0VlEqVxLvnFV7j+kxzk/4OgTGETkmMED1nudFuAIk3/1Cr9fy/wUBjo0aF2abWAAAAABJRU5ErkJggg==',// Wry
					
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACx0lEQVQ4jX2TTWhcdRTFf+/Nm6/MJFPrxAZmSps2JiXBMiBGMH6guAikuKkIbV24nS4EF5m1CxFJupAuOtCNCxERpeKiEPAjKnVh3EjNTG3MzDR02qaZTj7m482b9/+/d7sYGtKmeHYXzj0H7rnHEBH2Yu2HzKCIZIFphEkBEFkSWEDIHzt9vbaXb+wVqFw5OWuG+ucG0m8QTU4QSQwD4OxUaNeW2VlbRLvN3Oh7hfl9AqvfvXApcfj17IGjbxMMx8F3EFE9khEEM4JymtTLP7JZWcyPn/v3/K7AyjcTc4nDr80+d+Id0FugHiC6Ab7dszH7MKwBCCbBeoa7y99TL/86f/KD/3JG8asTqUA4UT3+yocYah26d1j6ZQFE89KrGQD+uvY3GBaTb01DOIVYQxQXL+DaW2lTay+bGMpg2GWksYy0KpSKK5RulMHtgNuhdKNMqbiCtCpIYxmjU+Zg6kW08rKWVt5MrC+Cv1MEtQXi7R5VXOexhKTbAreDuA798UGU8mYsrb3xsFdHnHu7y2dmvwDAq1x+6oxyCAdBa2/YUsrr6Na9UMBv7zrplYuPOT85A/i6hlJewNLKq3Sa9Uws5O8j/R9sZwOtvFVLK311s76d6UtGAPiz2MJXDUbSB4hELAAcR7Na3cYMDvDyeByAjY02WnlXjYVPDqZCllmdfD5OwDTw+ye4Wb7P6h+3efRkxk6UkZlBxo4dwmwW8Hzh9382cbpeOvDlz3az8NOnMaX0VDJmYDjrJKNNNn8b4/jImxyKT+BXXTJTaxjOOvgehVtNalvd+dOf2VdMgFMfb+du3XfyhbU2tt1FdO+Fh0dTDI+mehFqRbvd5XqpQfmunX93rpODJ8r0bS46Gwowd+RZi1inn+q1MQDSUzdpRRtUagrH9XNnP1f7y/QIX38UGhLIIjItMEmvz0siLAD59y/q9b38hzrNcm0ko8GmAAAAAElFTkSuQmCC',// Tongue
					
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAACpklEQVQ4jX2TT2jTZxjHP7/kl6Q2NYm1LS211VYU8R9xwx7GVBg7FIRdNjbUHbzGg+AhuXjxnCoMDwa8eBKRjZWBQmFs3WCnCnWMLI5oknY606aLadKk+eX3vm8eD8UY1+H39sDn+X5fnvd5LBGhW8s/RAdFJAZMI0wJgMiCwBxCavLzP9a6eavboPD98bjHvzMZ2nOGHQNH6AlPAOBUCzTW0lSX59HuRuLgl3/ObDN49t2xW+Gx07HIvk/xBfqg7SCitiDLB54elLNBOf8jrwrzqcMX/rrUMcjeP5IMj52KDx36DHQF1L+IrkF7cyvG04tlh8A3APYuXqZnKed/mTl+8WnCytw9NOoNhF/s/+gyllqB1j8s/DwHojn5cRSAR7/9DpbN1CfTEBhF7GEy89dxNyt7PFqbWHg4irWZR2pppF4gl8mSe5IHtwluk9yTPLlMFqkXkFoaq5mnf/RDtDIxWytzNtjbQ7uaAVUBMZ2hiuu880PSqoPbRFyHnX2DKGXO2lqbwwFTRpxip/lc/A4ApnD7f2uUQ8AHWpsJWynT1PWi39tudJJ09uY7yf+tAdp6DaWM19bKFJob5WjQ3yb/d4XFdHEb3K0Pjo4wOb6LTaeEVuaZrZV++Kq8Hu0d6GExXcT6Nfxeg0WKTIwEKZUaaGUe2kqZ1PPV+tWR0BbQ128BMLk3QiR8EID1apb88joAG4BxHZZeVtHapCwR4cG1SHK0344HPMLjp7X3vuDEgRCNVpvlVWfmi2Qz0Vnl2at9t8b6fbGJQZvg8Ak8oQNYwfFOoyn+RL34mNxKi6VSK/XVjdbbVX6jbxM74n4vyb27bYZCXiK9HgAqDUOpZiisKRy3nTj/jdp+TG9074p/WCCGyLTAFFv3vCDCHJD6+qZe6eZfA2K8WtbNliWgAAAAAElFTkSuQmCC',// Sorry	
									
					'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',// Arrow
					
					'iVBORw0KGgoAAAANSUhEUgAAAdUAAACfCAMAAACY07N7AAAC2VBMVEX///8AAAAAAAD5+fn///8AAAD////9/f1tbW0AAAD///////////8AAAAAAAD////w8PD+/v729vYAAAD8/PwAAAAAAAD////////a2toAAADCwsL09PT////////09PT39/f///8AAAAAAACzs7P9/f0AAADi4uKwsLD////////7+/vn5+f+/v7///8AAADt7e0AAADPz88AAAD9/f329vbt7e37+/vn5+f6+vrh4eGSkpL+/v7+/v7BwcGYmJh0dHTh4eHQ0NAAAADz8/O7u7uhoaGAgID9/f3U1NRiYmL////V1dX4+Pjc3Nz6+vr7+/vp6en7+/v9/f39/f3R0dHy8vL8/Pz4+Pjr6+v8/Py2trbGxsbl5eXu7u719fX9/f1lZWVnZ2fw8PC2trbg4OD39/f6+vrp6enl5eX6+vr4+PjLy8v///+EhITx8fF4eHj39/fd3d35+fnIyMjS0tLs7Oz6+vre3t7i4uLm5ubz8/Obm5uoqKilpaXc3Nzu7u7////x8fHJycnw8PD////////e3t7Gxsa8vLzr6+vW1tbQ0NDi4uL5+fn09PTi4uLs7Oz19fW0tLT////9/f37+/v8/Pz6+vrm5uYAAADk5OT8/Pz39/ewsLCZmZn9/f3s7Oz8/PzBwcHp6en////a2trw8PDw8PD19fXx8fH+/v74+Pj+/v6Ojo7i4uL7+/v5+fnc3Nz////y8vL6+vqfn5/t7e339/f29vbo6Ojz8/P6+vr19fX19fWmpqbLy8v6+vr4+PjT09Pr6+v6+vrr6+uqqqrz8/Pt7e2ioqLPz8/a2trW1taioqLr6+vi4uL5+flVVVXNzc3////W1tbj4+Ph4eHq6ur8/Pz////29vb7+/vz8/P09PTMzMz////////5+fn19fX////y8vL9/f0AAADZ2dn8/Pz7+/v8/Pzp6em/v7/7+/vq6urp6en+/v7////4ck/mAAAA8nRSTlMAGgDUzwIP8SMQ759fCgUvqfDGFeIYA78fbxNTt98/hsV/BhdD4Q1rRI+vwo3ATxJTD18IoKWasozTETbQ4D40IX5hC6dAMR7RXydvEsRuotKLkZCATYahkzOxQlFqmbZwJiUhFWy1wyJYcXI7gB2XIEFbgjxg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',// Glyphicons-halflings-white
					
					'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',// Glyphicons-halflings
					
					'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');// Avatar
		@mkdir('img');
		for($i=0;$i<sizeof($image_array);$i++) {
			if($h=fopen('img/'.$img_names[$i].'.png','w')) { fputs($h,base64_decode($image_array[$i])); fclose($h);}
			else $ret=false;
		}
		return $ret;
	} else return false;
}
/**
*
* RETOURNE LES IMAGES DÉCODÉES
*/
function img($nr, $class='') { global $img_names; return  '<img src="img/'.$img_names[$nr].'.png" alt="'.$img_names[$nr].'"'.($class!=''?' class="' .$class. '"':'').' />';}
# function callback($buffer) { return htmlentities($buffer,ENT_NOQUOTES,"UTF-8"); }
/**
*
* FORMULAIRE D'INSCRIPTION
*/
function registerForm() {
	global $maxAvatarSize,$forum,$forumMode,$lang;

	$form ='<br />';
    
    ///////// INSCRIPTION
	$form .='<!-- Formulaire inscription -->
  <div class="page-header">
    <h1>Rejoindre notre communauté</h1>
  </div>
 <div class="container-narrow">
 <form action="index.php" method="post" enctype="multipart/form-data" autocomplete="off" class="form-horizontal" onsubmit="return checkform(this);">
  <input type="hidden" name="action" value="newuser" />
  <input type="hidden" name="MAX_FILE_SIZE" value=".$maxAvatarSize." />
  
  ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     input('Nom d\'utilisateur', 'login', '', 'text', '', '20', '', '', 'user', 'success').
     input('Mot de Passe', 'password', '', 'password', '', '50', '', '', 'lock', 'success'). 
     input('Date d\'Anniversaire', 'birthday', '', 'text', 'Jour/Mois/Année', '10', true, '', 'calendar', 'success').
     input('Adresse Mail', 'email', '', 'email', '', '50', '', '', 'envelope', 'success').
     input('Site Web', 'site', '', 'url', 'http://', '255', '', 'input-xlarge', 'globe').
     textarea('Signature', 'signature', '', '10', '2', 'Aucune mise en forme possible et limité a 150 caractères', '150', '', 'input-xxlarge'). '
  
  <div class="control-group">
    <label class="control-label" for="avatar">Avatar <span class="badge badge-warning">&lt; '.($maxAvatarSize/1024).'ko</span></label>
    <div class="controls">
      <input type="file" id="avatar" name="avatar">
    </div>
  </div>
  
  <div class="control-group success">
    <label class="control-label" for="txtInput">Code de vérification</label>
    <div class="controls">
     <div class="input-prepend input-append">
       <p class="add-on"><span id="txtCaptchaDiv" class="text-success"></span></p>
       <input type="hidden" id="txtCaptcha" />
       <input class="span2" type="text" name="txtInput" id="txtInput">
       <button type="submit" class="btn btn-success"><i class="icon-hand-right icon-white"></i> S\'inscrire</button>
     </div>
    </div>     
  </div> 
  
  <div class="help-inline alert alert-info"><i class="icon-exclamation-sign"></i> Les champs indiqué en vert sont obligatoires. 
  Si l\'identifiant comporte les caractères suivant:
  <pre>/ \ &amp; " \' . ! ? :</pre> ou des espaces, ils seront automatiquement retirés.
  </div>  
     
</form>
</div>';
	return $form;
}
/**
*
* TEXTE D'ACCUEIL
*/
function welcomeText() {
	global $wt,$ismember,$lang;
	$buf='<!-- Welcome text -->';
	$buf.='<div class="page-header">
            <h1>Information</h1>
          </div>
          <div class="lead">';
	if(!$wtp=@file_get_contents('welcome.txt')) $wtp=base64_decode($wt);
	$buf.=decode($wtp).'</div>';
	return $buf;
}
/**
*
* ÉDITION DU PROFIL
*/
function editProfilForm() {
	global $cLogin,$maxAvatarSize,$forum,$lang;
	list($pwd,$time,$email,$signature,$site,$birthday,$pic,$mod,$post)=$forum->getMember($cLogin);
	$avatar=($pic!='')?'<img src="'.$pic.'" class="img-polaroid" alt="Avatar" width="80px" />':img(11,'img-polaroid');	
	
	$form = '<!-- Edit profil form -->';
	$form .= '<div class="page-header">
            <h1>Édition du profil ~ '.$cLogin.'</h1>
          </div>';
	$form .= '
  <div class="container-narrow">	
     <div class="row">
       <div class="span1">
          '.$avatar.'
       </div> 
       <div class="span5">
           '.listFiles().'
       </div>
       <div class="span3">
       </div>       
     </div> 
    <div class="clearfix"></div>
  <hr />
  <div class="well">  
  <form action="index.php" method="post" enctype="multipart/form-data" class="form-horizontal">
  <input type="hidden" name="action" value="editprofil" />
  <input type="hidden" name="MAX_FILE_SIZE" value=".$maxAvatarSize." /> 

  ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     input('Date d\'Anniversaire', 'birthday', $birthday, 'text', 'Jour/Mois/Année', '10', true, '', 'calendar').
     input('Adresse Mail', 'email', $email, 'email', '', '50', '', '', 'envelope').
     input('Site Web', 'site', $site, 'url', 'http://', '255', '', 'input-xlarge', 'globe').
     textarea('Signature', 'signature', $signature, '10', '2', 'Aucune mise en forme possible et limité a 150 caractères', '150', '', 'input-xxlarge'). '
     
  <div class="control-group">
    <label class="control-label" for="site">Avatar <span class="badge badge-warning">&lt; '.($maxAvatarSize/1024).'ko</span></label>
    <div class="controls">
      <input type="file" id="avatar" name="avatar">
    </div>
  </div>      
  <div class="form-actions">
     <button type="submit" class="btn btn-primary">Sauvegarder mon profil</button>
  </div>';
	$form .= '</form>
           </div><!-- well -->
  </div><!-- container-narrow -->';
	
	return $form;
}
/**
*
* AIDE FORMATTAGE BBCODE (Éditeur)
*/
function formattingHelp() {
    global $lang;
	$buff = '';
	$smileys='';
	$s=array(':)',';)',':D',':|',':(','8(',':p',':$','->'); // smileys
	for($i=0;$i<sizeof($s);$i++) { $smileys .= "<li><a href=\"javascript:insert(' ".$s[$i]." ','');\" title='".$s[$i]."'>".img($i)."</a></li>"; }
	$buff .= '<div class="control-group">
   <label class="control-label">Formatage</label>
   <div class="controls">
   <div class="btn-toolbar">
                  
    <div class="btn-group">           
       <a class="btn" href="javascript:insert(\'[b]\',\'[/b]\')" rel="tooltip" title="Gras"><i class="icon-bold"></i></a>
       <a class="btn" href="javascript:insert(\'[i]\',\'[/i]\')" rel="tooltip" title="Italique"><i class="icon-italic"></i></a>
       <a class="btn" href="javascript:insert(\'[u]\',\'[/u]\')" rel="tooltip" title="Souligné"><i class="icon-text-width"></i></a>
       <a class="btn" href="javascript:insert(\'[s]\',\'[/s]\')" rel="tooltip" title="Barré"><i class="icon-ban-circle"></i></a>
       <a class="btn" href="javascript:insert(\'[quote]\',\'[/quote]\')" rel="tooltip" title="Citation"><i class="icon-comment"></i></a>
       <a class="btn" href="javascript:insert(\'[c]\',\'[/c]\')" rel="tooltip" title="Code"><i class="icon-list-alt"></i></a>
       <a class="btn" href="javascript:insert(\'[url]\',\'[/url]\')" rel="tooltip" title="Insérer un lien"><i class="icon-share"></i></a>
       <a class="btn" href="javascript:insert(\'[img]\',\'[/img]\')" rel="tooltip" title="Insérer une image"><i class="icon-picture"></i></a>
       <a class="btn" href="javascript:insert(\'[youtube]\',\'[/youtube]\')" rel="tooltip" title="Youtube"><i class="icon-film"></i></a>
    </div><!-- /btn-group --> 
    
    <div class="btn-group">
       <a class="btn dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Smileys">&#9787; <span class="caret"></span></a>
          <ul class="dropdown-menu smileys">'.$smileys.'</ul>
    </div>
        
   </div>       
  </div>
</div>';
	return $buff;
}
/**
*
* AFFICHAGE FIL D'ARIANE (Breadcrumbs)
*/
function breadcrumbs() {
	global $cLogin,$isadmin,$havemp,$cStyle,$cVals,$forum,$nbrMsgIndex,$ismember,$siteUrl,$siteName,$lang;
	$mn='';	
	$tLogin=$ismember?$cLogin:'Invité';
	$mn .= '<ul class="breadcrumb"><li><i class="icon-play-circle"></i> Bienvenue <span class="';	
	$mn .= ($isadmin)?'text-error':'text-info';
	$mn .= '"><strong>'.$tLogin.'</strong></span>';	
	if($havemp) $mn .= ' <a href="#privatebox" rel="tooltip" title="Nouveau Message Privé" role="button" class="blink" data-toggle="modal"> <i class="icon-inbox"></i></a><script>function blink(selector){$(selector).fadeOut("slow", function(){$(this).fadeIn("slow", function(){blink(this);});});}blink(".blink");</script>';
	$mn .= 	'</li>
	       </ul>';
	return $mn;
}
/**
*
* AFFICHAGE DU MENU
*/
function menu() {
	global $cLogin,$havemp,$cStyle,$cVals,$forum,$nbrMsgIndex,$ismember,$siteUrl,$siteName,$lang;
	$mn='<ul class="nav">'; 	 
	if($siteUrl!='') $mn .='<li><a href="'.$siteUrl.'" title="'.$siteName.'"><i class="icon-home"></i> '.$siteName.'</a></li><li class="divider-vertical"></li>';
	$stats=$forum->getStat();
	if($nbrMsgIndex<$stats[2]) $mn .='<li><a href="?showall=1" rel="tooltip" data-placement="bottom" title="Lister toutes les discussions"><i class="icon-bookmark"></i> Archives</a></li><li class="divider-vertical"></li>';	
	if($ismember) {
		$mn .='<li><a href="?logout=1" rel="tooltip" data-placement="bottom" title="Quitter la session"><i class="icon-off"></i> Déconnexion</a></li><li class="divider-vertical"></li>';
		$mn .='<li><a href="?editprofil=1" rel="tooltip" data-placement="bottom" title="Modifier mon profil"><i class="icon-eye-open"></i> Profil</a></li><li class="divider-vertical"></li>';
		$mn .='<li><a href="?memberlist=1" rel="tooltip" data-placement="bottom" title="Liste des membres"><i class="icon-user"></i> Membres</a></li><li class="divider-vertical"></li>
		       </ul>';
	} else {
		$mn .='</ul>
		    <form action="index.php" method="post" autocomplete="off" class="navbar-form pull-right">
		        <input type="hidden" name="action" value="enter" />
                <input class="span2" type="text" name="login" placeholder="Identifiant">
                <input class="span2" type="password" name="password" placeholder="Password">
                <button type="submit" class="btn btn btn-info"><i class="icon-ok icon-white"></i> S\'identifier</button>
            </form>';		
	}	
	return $mn;
}
/**
*
* NAVIGATION (Admin seulement!)
*/
function menu_admin() {
	global $isadmin,$isowner,$lang;
	$mn='';
	if($isadmin && $isowner) {
		$mn .= '<ul class="nav pull-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" rel="tooltip" data-placement="right" title="Paramètres"><i class="icon-cog"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu">';
		$mn .= '<li><a href="?conf=1" title="Paramètre Général"><i class="icon-wrench"></i> Configuration</a></li>';
		$mn .= '<li><a href="?backup=1" title="Créer une sauvegarde"><i class="icon-hdd"></i> Sauvegarde</a></li>';
		$mn .= '<li><a href="?restore=1" title="Restaurer depuis une sauvegarde"><i class="icon-refresh"></i> Restauration</a></li>';
		$mn .= '        </ul>
                      </li>
                </ul>';
	}
	return $mn;
}
/**
*
* AFFICHAGE DE LA LISTE DES SUJETS (Forumhome)
*/
function showTopics() {
	global $isadmin,$nbrMsgIndex,$forum,$showall,$lang;
    $buffer='';
	$buffer .= '<table class="table table-bordered table-hover table-condensed">
	             <tr class="info">
	                 <td style="width:60%;">Titre du sujet</td>
	                 <td style="width:5%; text-align:center;">Messages</td>
	                 <td style="width:30%;">Dernier message</td>';
	    if($isadmin) $buffer .= '<td style="width:5%">Admin</td>';
	$buffer .= '</tr>';

	$topicList=($showall)?$forum->getallTopic(0,$nbrMsgIndex):$forum->getallTopic($nbrMsgIndex);
	foreach($topicList as $t) {
		list($titre,$auteur,$nombrePosts,$dernierPar,$dernierLe,$attachment,$postType,$topicID)=$t;
		$dernierLe = date("d M Y à H:i",$dernierLe); //strftime("%a %d %b %Y à %H:%M",$dernierLe);
		$started = date("d M Y", $topicID);          //strftime("%e %B %Y", $topicID);
		$attachment=($attachment!='')?'<i class="icon-file"></i> ':'';
		$postType=$postType?'<i class="icon-star"></i> ':'';
		$statusIcon = (isset($_COOKIE["uFread$topicID"]))?'<i class="icon-folder-open"></i>':'<i class="icon-fire"></i>';
		$buffer .= '<tr>
		              <td>'.$postType.$attachment.$statusIcon.' <a href="?topic='.$topicID.'" title="afficher le sujet">'.$titre.'</a><br />
		                <small class="pull-right muted">Débuté le '.$started.', Par ';
		$buffer .= $forum->isMember($auteur)?'<a href="index.php?private='.$auteur.'" rel="tooltip" title="Envoyer un message privé">'.$auteur.'</a></span></td>':$auteur.'</small></td>';
		$buffer .= '<td class="mess">'.$nombrePosts.'</td>
		              <td><em>Le :</em> <a href="?topic='.$topicID.'#bottom" rel="tooltip" title="Aller au dernier message">'.$dernierLe.'</a><br /><em>Par:</em> ';
		$buffer .= $forum->isMember($dernierPar)?'<a href="index.php?private='.$dernierPar.'" rel="tooltip" title="Envoyer un message privé">'.$dernierPar.'</a></td>':$dernierPar.'</td>';
		if($isadmin) $buffer .= "<td><a href='?topic=".$topicID."&amp;delpost=".$topicID."' onclick='return confirmLink(this,\"$titre\")' rel='tooltip' title='Supprimer le sujet ?'><i class='icon-trash'></i></a></td>\n";
		$buffer .= '</tr>';
	}
	$buffer .= '</table>';

	$buffer .= replyForm("newtopic",count($topicList));	
	return $buffer;
}
/**
*
* --/ Index du forum Fin /--
*
* AFFICHAGE DE LA DISCUSSION (Posbit)
*/
function showPosts() {
	global $topic,$forum,$isadmin,$quoteMode,$lang;
	$buffer='';
	$avatars=array();
	$quotes=array();
	$modo=array();
	if($s = implode('', file(U_THREAD.$topic.'.dat'))) {
		$topicObj = unserialize($s);
		list($time,$titre,$auteur,$posts,$last,$lasttime,$attach,$type)=$topicObj->getInfo(0);
		$buffer .= '<div class="input-prepend input-append">';
		if($isadmin) {
			$buffer .= '<form name="sub" method="post"><input type="hidden" name="topicID" value="'.$topic.'" />';
			$buffer .= "<span class='btn'><i class='icon-star'></i> <input style='border:none;' type='checkbox' onclick=\"window.location='?topic=".$topic."&postit=".($type?"off":"on")."'\"";/*** On epingle le sujet ou pas ***/
			$buffer .= $type?"checked='checked' />":"/>";
			$buffer .= "</span><input class='span3' id='appendedPrepended' type='text' value=\"".clean($titre)."\" name='ntitle'><input class='btn' type='submit' value='Modifier' /></form>";/*** Modification du Titre du sujet ***/
		} else $buffer .= '<div class="page-header">
            <h1>'.$titre.'</h1>
          </div>';
		$buffer .= '</div>';
		// tooltips
		list($num,$auths)=$topicObj->getInfo(1);
		foreach($auths as $m) {
			if($forum->isMember($m)) {
				list($password,$time,$mail,$quote,$url,$birthday,$pic,$mod,$max)=$forum->getMember($m);
				// Déclaration de l'avatar ou défaut avatar
				$avatars[$m]=($pic!='')?'<img class="avatar" src="'.$pic.'" alt="avatar"/>':img(11,'img-circle');
				$buffer .= '<!-- Modal -->
<div id="show_'.cleanUser($m).'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="show_'.cleanUser($m).'" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Profil de <b>'.$m.'</b></h3>
  </div>
  <div class="modal-body">
    <p class="pull-right"><span class="thumbnail">'.$avatars[$m].'</span></p>
    <p><b>Inscrit(e) le:</b> '.date('d M Y à H:i',$time).'</p>
    <p><b>Messages:</b> '.$max.'</p>
    <p><b>Mail:</b> '.protect_email($mail).'</p>';
	if(!empty($url)) $buffer .= '<p><b>Site Web:</b> '.$url.'</p>';
	if(!empty($birthday)) $buffer .= '<p><b>Né le:</b> '.$birthday.' <span class="badge">'.birthday($birthday, $pattern = 'eu').' ans</span></p>';
	if(!empty($quote)) {
		$buffer .= '<p><b>Signature:</b> <blockquote><p class="text-info">'.$quote.'</p></blockquote></p>';
		if($quoteMode) $quotes[$m]=$quote;
	}  
$buffer .= '				  
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary" href="?private='.$m.'">Envoyer un message privé</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>';
				if($mod) $modo[$m]=($mod>1)?'<span class="label label-important">Fondateur</span>':'<span class="label label-success">Modérateur</span>';
				else $modo[$m]='<span class="label">Membre</span>';
			} else $pic='';
		}
		$cnt=0;
		while(list($auth,$time,$content,$attach)=$topicObj->nextReply()) {
			$buffer .= '<div class="row-fluid">';
			if($forum->isMember($auth)) {
				$buffer .= '<div class="span3 well">
            <ul class="nav nav-list">
               <li class="nav-header"><a href="?private='.$auth.'" rel="tooltip" title="Envoyer un message privé">'.$auth.'</a></li>				
               <li>
                <a class="thumbnail" href="#show_'.cleanUser($auth).'" role="button" data-toggle="modal" rel="tooltip" title="Afficher le profil">
                  '.$avatars[$auth].'
                </a>
               </li>
               <div class="clearfix"></div>
               <li class="divider"></li>
               <li>'.$modo[$auth].'</li>
               <li class="divider"></li>';
			} else {
				$buffer .= '<div class="span3 well">
            <ul class="nav nav-list">
              <li>
                <a class="thumbnail" href="?private='.$auth.'" title="">
                  '.$avatars[$auth].'
                </a>
              </li>
              <div class="clearfix"></div>
              <li class="divider"></li>
			  <li><span class="label">'.$auth.'</span></li>
			  <li class="divider"></li>';
			} 
			// Édition & Suppression
			$buffer .= '<li><div class="btn-group">';
			if($isadmin) { 
				$delmsg = $cnt?'Réponse de '.$auth:' Tout le sujet';
				$buffer .= "<a class='btn btn-mini btn-inverse' href='?topic=$topic&amp;editpost=$time' rel='tooltip' title='Éditer'><i class='icon-pencil icon-white'></i></a><a class='btn btn-mini btn-inverse' href='?topic=$topic&amp;delpost=$time' rel='tooltip' title='Supprimer' onclick='return confirmLink(this,\"$delmsg\")'><i class='icon-remove icon-white'></i></a>\n";
			}
			// Citation
            $buffer .= '<a class="btn btn-mini" href="' .getURL(). '#bottom" data-toggle="collapse" data-target="#newpost" onclick="quote("'.$auth.'",'.$cnt.')" rel="tooltip" title="citer le message de '.$auth.'" /><i class="icon-comment"></i> Citer</a></div></li>
			<li class="divider"></li>
			<li class="muted"><i class="icon-time"></i> '.date('d/m/y à H:i', $time).'</li>
			    </ul>
		</div><!-- /span3 well -->';
			// Message
			$buffer .= '<div id="message'.$cnt.'" class="span8">'.decode($content).'<div class="clearfix"></div>';
			if(!empty($attach)){
				$attachment = explode('/', $attach);
				$buffer .= '<p class="pull-right"><a href="?pid='.base64_encode($attach).'" rel="tooltip" title="Télécharger"><i class="icon-file"></i> '.$attachment[3].'</a></p>';
			}
			// Citation									
			if(isset($quotes[$auth])) $buffer .= '<hr /><blockquote><p class="text-info">'.$quotes[$auth].'</p></blockquote>';					
			$buffer .= '</div><!-- /span8 -->
			<div class="clearfix"></div><hr />';
			
			$cnt++;
		}
		$buffer .= '</div><!-- /row-fluid -->';
		$buffer .= replyForm('newpost');	

	} else {
		$buffer .= '<div class="alert">
                       <button type="button" class="close" data-dismiss="alert">×</button>
                       <strong>Sujet inexistant</strong>
                    </div>';
	}
	return $buffer;
}
/**
*
* SYNTAXE HILGHTER
*/
function colorSyntax($txt) { 
	// Utilisation de la fonction PHP dedie
	if(preg_match('%\&lt;\?[php]?%',$txt)) {
		$txt = html_entity_decode($txt);
		$txt = preg_replace("/(\r|\n)/i","\n",$txt);
		ob_start();
		@highlight_string($txt);
		$code = ob_get_contents();
		ob_end_clean();
		$code = preg_replace('%\(<code>|</code>)%','',$code);
		$txt = '<pre>'.trim($code).'<br />&nbsp;</pre>&nbsp;';
	} else { // Sinon, traitement classique
		$txt = "<pre>" . $txt;
		$txt = preg_replace("/([a-zA-Z0-9\-\_]+)(\(+)([^\n\t]*)(\)+)/i", "<span class='text-info'>\\0</span>", $txt);
		$txt = preg_replace("/((\n|\t))([^\n\r]+)/i", "<span class='muted'>\\0</span>", $txt);	
		$txt = preg_replace("/\\$([a-zA-Z0-9]*)/i", "<span class='text-warning'>\\0</span>", $txt);
		$txt = preg_replace("/\"([^\n\r]+)\"/i", "<span class='text-error'>\\0</span>", $txt);
		$txt .= '<br />&nbsp;</pre>&nbsp;';
		return nl2br(trim($txt));
	}
	return $txt;
}
/**
*
* PARSER BBcode 
*/
function bbCode($text, $summary = true)
{
	//the pattern to be matched
	//the replacement
	global $pattern, $replace;

	$pattern[] = '%\[c\]([^\a]+?)\[/c\]%e';
	$replace[] = $summary? '\'[...]\'' : '\'<pre class="prettyprint linenums">\'.str_replace(\'<br />\', \'\', \'$1\').\'</pre>\'';

	$pattern[] = '%\[b\]([^\n]+?)\[/b\]%';
	$replace[] = '<b>$1</b>';

	$pattern[] = '%\[i\]([^\n]+?)\[/i\]%';
	$replace[] = '<i>$1</i>';

	$pattern[] = '%\[u\]([^\n]+?)\[/u\]%';
	$replace[] = '<ins>$1</ins>';

	$pattern[] = '%\[s\]([^\n]+?)\[/s\]%';
	$replace[] = '<del>$1</del>';

	$pattern[] = '%\[img\]([^\n\[]+?)\[/img\]%';
	$replace[] = '<img class="thumbnail" src="$1" alt=""/>';
	
	$pattern[] = '%\[url=([^\n\[]+?)\]([^\n]+?)\[/url\]%';
	$replace[] = '<a target="_blank" href="$1">$2</a>';
	
	$pattern[] = '%\[url\]([^\n]+?)\[/url\]%';
	$replace[] = '<a target="_blank" href="$1">$1</a>';	

	$pattern[] = '%\[youtube\]([-\w]{11})\[/youtube\]%';
	$replace[] = '<iframe class="thumbnail" width="560" height="315" src="http://www.youtube.com/embed/$1?rel=0" frameborder="0"></iframe>';

	$pattern[] = '%\[quote\](\d{4}-\d{2}-\d{8}[a-z\d]{5})\[/quote\]%e';
	$replace[] = '<blockquote>$1</blockquote>';
	
	$pattern[] = '%\[q=(.*)\](.*)\[/q\]%e';
	$replace[] = '<fieldset><legend>Citation: $1</legend>$2</fieldset>';

	$pattern[] = '%\[e\]([^\n]+?)\[/e\]%';
	$replace[] = '<p class="muted">Édité par: $1</p>';
	
    /* smiley */
    $pattern[] = '%:\)%';    $replace[] = '<img src="img/smile.png" alt="smile"/>';
    $pattern[] = '%;\)%';    $replace[] = '<img src="img/wink.png" alt="wink"/>';
    $pattern[] = '%:D%' ;    $replace[] = '<img src="img/laugh.png" alt="laugh"/>';    
    $pattern[] = '%:\|%';    $replace[] = '<img src="img/indifferent.png" alt="indifferent"/>';
    $pattern[] = '%:\(%';    $replace[] = '<img src="img/sad.png" alt="sad"/>';
    $pattern[] = '%8\(%' ;   $replace[] = '<img src="img/wry.png" alt="wry"/>'; 
    $pattern[] = '%:p%';     $replace[] = '<img src="img/tongue.png" alt="tongue"/>';
    $pattern[] = '%:\$%';    $replace[] = '<img src="img/sorry.png" alt="sorry"/>';
    $pattern[] = '%-&gt;%' ; $replace[] = '<img src="img/arrow.png" alt="arrow"/>';
    	
	return preg_replace($pattern, $replace, $text);
}
/**
* tronquer_texte
* Coupe une chaine sans couper les mots
*
* @param string $texte Texte à couper
* @param integer $nbreCar Longueur à garder en nbre de caractères
* @return string
*/
function tronquer_texte($texte, $nbchar)
{
    return (strlen($texte) > $nbchar ? substr(substr($texte,0,$nbchar),0,
    strrpos(substr($texte,0,$nbchar),' ')).'…' : $texte);
}
/**
*
* DÉCODE LES FICHIERS
*/
function decode($txt) {

	$txt=str_replace ("\t", "     ", $txt);
	$txt=str_replace ("\r\n", " <br />", $txt);
	$res=preg_split("|\[c\].*\[/c\]|U", $txt);
	preg_match_all("|\[c\](.*)\[/c\](.*)|U",$txt,$code,PREG_SET_ORDER);
	$txt=bbCode($res[0]);
	for($i=0;$i<count($code);$i++) {
		$txt.=colorSyntax($code[$i][1]);
		$txt.=bbCode($res[$i+1]);
	}
	return $txt;
}
/*
** Protège le mail via un affichage js
*  Usage:
** protect_email("youremail@here.com");
*/
function protect_email($phpemail)
{
	global $lang;    
	$pieces = explode("@", $phpemail);

	return '
		<script type="text/javascript">
			var a = "<a href=\'mailto:";
			var b = "' . $pieces[0] . '";
			var c = "' . $pieces[1] .'";
			var d = "\' class=\'email\' rel=\'tooltip\' title=\'Envoyer un mail\'><i class=\'icon-envelope\'></i>";
			var e = "</a>";
			document.write(a+b+"@"+c+d+e);
		</script>
		<noscript>Activer JavaScript pour afficher le mail</noscript>';
}
/**
 * Méthode qui nettoie les champs
 *
**/
function clean($text)
{
	if(get_magic_quotes_gpc())
		$text = stripslashes($text);
	return htmlspecialchars(trim($text), ENT_QUOTES);
}
/**
 * Méthode qui retourne la date en Français
 * Exemple : 
 *   echo "Nous sommes le ". datefr(mktime()); 
 *   $hier=mktime()-3600*24; 
 *   echo "<p>hier nous étions le ".datefr($hier); 
 * Pour le premier du mois 
 *   $lepremiermars2012=mktime(0, 0, 0, 3, 1, 2012); 
 *   echo "<p>le 1/03/2012 donne ".datefr($lepremiermars2012); 
 *
**/
function datefr($arg)
{ 
    $Jour = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi','Samedi');
    $Mois = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    $datefr = $Jour[date('w')].' '.date('d').' '.$Mois[date('n')].' '.date('Y');
    return $datefr; 
} 
/**
 * Méthode qui retourne l'âge i18n
 *
**/
function birthday($birthdate, $pattern = 'eu')
{
    $patterns = array(
        'eu'    => 'd/m/Y',
        'mysql' => 'Y-m-d',
        'us'    => 'm/d/Y',
    );

    $now      = new DateTime();
    $in       = DateTime::createFromFormat($patterns[$pattern], $birthdate);
    $interval = $now->diff($in);
    return $interval->y;
}
/**
 * Méthode qui traite les champ de type input
 *
**/
function input($label, $name, $value='', $type='text', $placeholder='', $maxlength='', $readonly=false, $class='', $icon='', $require='')
{
        global $lang;
        $form = '';
		$form .= '<div class="control-group';
		if($require)
			$form .= ' '.$require.'">';
		else
			$form .= '">';		    
        $form .= '<label class="control-label" for="'.$name.'">' .$label. '</label>
    <div class="controls">';
		if($icon)
			$form .= '<div class="input-prepend">
			               <span class="add-on"><i class="icon-'.$icon.'"></i></span>';	
		else
			$form .= '';			               		      
		if($readonly)
			$form .= '<input id="'.$name.'" name="'.$name.'" type="'.$type.'" class="readonly" value="'.$value.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').' readonly="readonly" />';
		else
			$form .= '<input id="'.$name.'" name="'.$name.'" type="'.$type.'"'.($class!=''?' class="'.$class.'"':'').' value="'.$value.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').' />';
		if($icon)
			$form .= '</div>';		
     $form .= '</div>
  </div>';
  return $form;
}
/**
 * Méthode qui traite une zone de texte
 *
**/	
function textarea($label, $name, $value='', $cols='', $rows='', $placeholder='', $maxlength='', $readonly=false, $class='') 
{
    global $lang;
    $form = '';
    $form .= '<div class="control-group">
    <label class="control-label" for="'.$name.'">'.$label.'</label>
    <div class="controls">';
	if($readonly)
		$form .= '<textarea id="'.$name.'" name="'.$name.'" class="readonly" cols="'.$cols.'" rows="'.$rows.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').' readonly="readonly">'.$value.'</textarea>';
	else
		$form .= '<textarea id="'.$name.'" name="'.$name.'"'.($class!=''?' class="'.$class.'"':'').' cols="'.$cols.'" rows="'.$rows.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').'>'.$value.'</textarea>';
		
    $form .='</div>
  </div>';
	return $form;
}	
/**
*
* LISTE DES MEMBRES
*/
function showMemberlist() {
	global $isadmin,$cLogin,$forum,$lang;
    $annu ='';
	$wd=$isadmin?45:60;
	$annu .= '<table class="table table-hover table-condensed"><tr class="warning">
	              <td style="width:15%;">Membre</td>   
	              <td style="width:'.$wd.'%;">Signature</td>
	              <td style="width:18%;">Naissance</td>
	              <td style="width:7%;">eMail</td>';
	if($isadmin) $annu .= '<td colspan="2" style="width:15%;">Admin</td>';
	$annu .= '</tr>';
	$mb=$forum->listMember();
	foreach($mb as $m) {
		list($pass,$time,$mail,$quote,$url,$birthday,$pic,$mod,$post)=$forum->getMember($m);
		$mail= protect_email($mail);
		$signature=($quote!='')? '<a href="#" class="muted" rel="popover" title="Signature de '.$m.'" data-content="'.$quote.'">'.tronquer_texte($quote, 50).'</a>':'&nbsp;';
		if($url!='') {
			if (!preg_match('|http://|',$url)) $url='http://'.$url;
			$url='<a href="'.$url.'" rel="tooltip" title="Visiter le site de '.$m.'" target="_blank"><i class="icon-globe"></i></a>';
		}
		$avatar=($pic != '')?'<img style="width:80px; height:80px;" src="'.$pic.'" alt="Avatar" />':img(11,'img-circle');
		// PopOver
		$annu .= '<!-- Modal -->
<div id="show_'.cleanUser($m).'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="show_'.cleanUser($m).'" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3>Mini profil de <b>'.$m.'</b></h3>
  </div>
  <div class="modal-body">
    <p class="pull-right"><span class="thumbnail">'.$avatar.'</span></p>
    <p><b>Inscrit(e) le:</b> '.date('d M Y à H:i',$time).'</p>
    <p><b>Mail:</b> '.$mail.'</p>';
	if(!empty($url)) $annu .= '<p><b>Site Web:</b> '.$url.'</p>';
	if(!empty($birthday)) $annu .= '<p><b>Né le:</b> '.$birthday.' <span class="badge">'.birthday($birthday, $pattern = 'eu').' ans</span></p>';
	if(!empty($quote)) {
		$annu .= '<p><b>Signature:</b> <blockquote><p class="text-info">'.$quote.'</p></blockquote></p>';
	}  
$annu .= '				  
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary" href="?private='.$m.'">Envoyer un message privé</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>';
					
		$annu .= '<tr>';
		$annu .= '<td><a href="#show_'.cleanUser($m).'" role="button" data-toggle="modal" rel="tooltip" title="Afficher le profil">'.$m.'</a></td>';
		$annu .= '<td>'.$signature.'</td>';
		$annu .= '<td>'.$birthday.'</td>';
		$annu .= '<td>'.$mail.' '.$url.'</td>';
		if($isadmin) {
			if($mod) {
				if($m==$cLogin || $mod==2) {
					$str=($mod>1)?'Admin':'Modo';
					$annu .= '<td>&nbsp;</td>';
					$annu .= "<td><form><input style='border:none;' type='checkbox' checked='checked' onclick=\"this.checked='checked'\"/> $str!</form></td>\n";
				} else {
					$annu .= "<td><a chref='?memberlist=1&deluser=".$m."' onclick='return confirmLink(this,\"$m\")' rel='tooltip' title='Supprimer le membre'><i class='icon-trash'></i></a></td>\n";
					$annu .= "<td><form><input style='border:none;' type='checkbox' checked='checked' onclick=\"window.location='?memberlist=1&switchuser=".$m."';\" /> Modo?</form></td>\n";
				}
			} else {
				$annu .= "<td><a href='?memberlist=1&deluser=".$m."' onclick='return confirmLink(this,\"$m\")' rel='tooltip' title='Supprimer cet utilisateur'><i class='icon-trash'></a></td>\n";
				$annu .= "<td><form><input style='border:none;' type='checkbox' onclick=\"window.location='?memberlist=1&switchuser=".$m."';\"/> Modo?</form></td>\n";
			}
		}
		$annu .= '</tr>';
	}
	$annu .= '</table>';
	return $annu;
}
/**
*
* VÉRIFIE L'ENVOIE D'AVATAR
*/
function checkUpload($dir,$type=false) {
	global $maxAvatarSize,$error,$extensionsAutorises,$forum,$cLogin,$lang;
	if($type) {
		$match="/.gif$|.jpg$|.png$/i";
		$name='avatar';
		$size=$maxAvatarSize;
	} else {
		$match=$extensionsAutorises;
		$name='attachment';
		$size=1024*200;
	}
	$avatar='';
	if(is_uploaded_file($_FILES[$name]['tmp_name'])) {
		if(preg_match($match,$_FILES[$name]['name'])) {
			if(($_FILES[$name]['size']<$size) || !$type){
				if (move_uploaded_file($_FILES[$name]['tmp_name'],$dir.'/'.str_replace(" ","",$_FILES[$name]['name']))) { 
					$avatar=$dir.'/'.str_replace("+","",urlencode($_FILES[$name]['name']));
					if($type) { 
						$old=$forum->getMember($cLogin);
						if($old[6]!='') unlink($old[6]);
					}
				} else $error=$type?'Erreur d\'écriture de l\'avatar !':'La pièce jointe n\'a pas pu être enregistrée !';
			} else $error='Avatar trop gros';
		} else $error='Type de fichier interdit !';
	} else return false;
	return $avatar;
}
/**
*
* FORMULAIRE DE RÉPONSE
*/
function replyForm($type,$mpTo='') {
	global $topic,$editpost,$topicObj,$cLogin,$isadmin,$lang;
	$avatars=array();
	$edit=0; $join=0; $show=0;
	if($type=='newtopic') {
		$name='<i class="icon-plus-sign icon-white"></i> Nouveau sujet';
		$join=1;
		$show=$mpTo?0:1;
	} else if($type=='newpost') {
		$name='<i class="icon-comment icon-white"></i> Répondre';
		$join=1;
	} else if($type=='editpost') {
		if($s = implode('', file(U_THREAD.$topic.'.dat'))) $topicObj = unserialize($s);
		else return false;
		list($auth,$time,$content,$attach)=$topicObj->getReply($editpost);
		$content = preg_replace('/[e](.*)[e]\r\n/i','',$content);
		$name='Édition';
		$edit=1;
	} else {
		$name='Envoyer un message privé à '.$mpTo;
		$show=1;
	}
	$buffer = '<!-- Reply form -->';
	if($edit || $show) { 
		$buffer .= '<h2>'.$name.'</h2>';
	} else { 
		$buffer .= '<button type="button" class="btn btn-large btn-primary" data-toggle="collapse" data-target="#'.$type.'">'.$name.'</button>';
		$buffer .= '<div class="collapse" id="'.$type.'">';
	} 
	$buffer .= '<hr />
	            <form id="formulaire" action="index.php" method="post" enctype="multipart/form-data" class="well form-horizontal"> 
	                 <input type="hidden" name="action" value="'.$type.'" />';
	// Réponse                 
	if($type=="newpost" || $edit) $buffer .= '<input type="hidden" name="topicID" value="'.$topic.'" />';
	// Mesage privé
	if($mpTo) $buffer .= '<input type="hidden" name="mpTo" value="'.$mpTo.'" />';
	// Edition
	if($edit) $buffer .= '<input type="hidden" name="postID" value="'.$editpost.'" />';
	// Nouveau Sujet
	if($type=="newtopic") { 
		$buffer .= input('Titre du sujet', 'titre', '', 'text', '', '35');
		if($isadmin) $buffer .= '
  <div class="control-group">
    <label class="control-label" for="postit"><i class="icon-star"></i> Épinglé</label>
    <div class="controls">
      <input type="checkbox" id="postit" name="postit" value="1">
    </div>
  </div>';
	}
	if(!$cLogin) $buffer .= input('Utilisateur (obligatoire)', 'anonymous', '', 'text', '', '35');
	
    $buffer .= formattingHelp();
	if($edit) { 
		$buffer .= textarea('Message', 'message', $content, '40', '10', '', '', '', 'input-xxlarge');
	} else { 
		$buffer .= textarea('Message', 'message', '', '40', '10', '', '', '', 'input-xxlarge');
	} 
	
	if($join) $buffer .= '<div class="control-group">
    <label class="control-label" for="attachment">Joindre un fichier</label>
    <div class="controls">
      <input type="file" id="attachment" name="attachment" />
    </div>
  </div>';

   $buffer .= '<div class="form-actions">
  <button type="submit" class="btn btn-success"><i class="icon-arrow-right icon-white"></i> Envoyer</button>
</div>
     </form>
  </div><!-- collapse '.$type.' -->';
	return $buffer;
}
/**
*
* LISTE LES FICHIERS ENVOYÉS DANS LE PROFIL DE L'UTILISATEUR
*/
function listFiles() {
	global $cLogin,$forum,$lang;
	$dir=U_MEMBER.$cLogin.'/';
	$a=$forum->getMember($cLogin); 
	$list='';
	$list.='<a href="#personal_files" role="button" class="btn btn-mini btn-inverse" data-toggle="modal"><i class="icon-file icon-white"></i> Mes Fichiers personnels</a>
	<!-- Modal -->
<div id="personal_files" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Fichiers personnels</h3>
  </div>
  <div class="modal-body">';
	$h=dir($dir);
	$id=1;
	while ($f=$h->read()) {
		if (($f!='.') && ($f!='..') && ($f!= $cLogin.'.mp')) {
			$cl=($a[6]!=($dir.urlencode($f)))?'text-warning':'text-error';
			$list.=$id.' | <a class="'.$cl.'" href="'.$dir.urlencode($f).'" title="fichier">'.$f.'</a><br />';
			$id++;
		}
	}
    $list.='</div>
</div>';	
	return $list;
}
/**
*
* AFFICHE LE MODAL DES MESSAGES PRIVÉ
*/
function showPrivateMsg() {
	global $cLogin,$forum,$lang;
	
	$s=implode('', file(U_MEMBER.$cLogin.'/'.$cLogin.'.mp'));
	$mp = unserialize($s);
	$mess=$mp->getMessage();
	$pvtBox = '<!-- Modal -->
<div id="privatebox" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Messagerie Privé</h3>
  </div>
  <div class="modal-body">';
	foreach($mess as $m) {
		if($forum->isMember($m[1])) $pvtBox .= '
  <h3 id="myModalLabel"><a href="?private='.$m[1].'" title="message privé">'.$m[1].'</a> <small>le '.date('d/m/Y @ H:i',$m[0]).'</small></h3>';
		else {
			// eregi("([0-9]{1,3}\.[0-9]{1,3})",$m[1],$reg);
			$m[1]=preg_replace('/(([0-9]{1,3}\.[0-9]{1,3})\.([0-9]{1,3}\.[0-9]{1,3}))/i','\\2.x.x',$m[1]);
			$pvtBox .= $m[1].' le '.date('d/m/Y @ H:i',$m[0]);
		}
		$pvtBox .= '<p>'.decode(clean($m[2])).'<p><hr />';
	}
	$pvtBox .= '
</div>	
  <div class="modal-footer">
       <a href="?private='.$m[1].'" class="btn btn-success"><i class="icon-comment icon-white"></i> Répondre à '.$m[1].'</a>
       <a href="?delprivate=1" class="btn btn-inverse"><i class="icon-trash icon-white"></i> Vider votre boite</a>
  </div>
</div>';
	return $pvtBox;
}
/**
*
* ÉXÉCUTE LA SAUVEGARDE
*/
function do_backup($source, $destination)
{
    global $error;
    $error='';
    if (is_string($source)) $source_arr = array($source); // convert it to array

    if (!extension_loaded('zip')) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    foreach ($source_arr as $source)
    {
        if (!file_exists($source)) continue;
$source = str_replace('\\', '/', realpath($source));

if (is_dir($source) === true)
{
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

    foreach ($files as $file)
    {
        $file = str_replace('\\', '/', realpath($file));

        if (is_dir($file) === true)
        {
            $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
        }
        else if (is_file($file) === true)
        {
            $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
        }
    }
}
else if (is_file($source) === true)
{
    $zip->addFromString(basename($source), file_get_contents($source));
}

    }

    $zip->close();
    $error= 'Archive crée avec succès !  <a class="btn btn-success pull-right" href="'.$destination.'" title="Télécharger"><i class="icon-download-alt icon-white"></i> Télécharger l\'archive</a>';
}
/**
*
* RÉSTAURATION D'UN FICHIER DE SAUVEGARDE
*/
function restore_forum() {
   global $error;
   $error='';
   if($_FILES["backup"]["name"]) {
	$filename = $_FILES["backup"]["name"];
	$source = $_FILES["backup"]["tmp_name"];
	$type = $_FILES["backup"]["type"];
	
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$error = "Le fichier que vous essayez d'envoyer n'est pas un fichier au format .zip. Merci de recommencer.";
	}

	$target_path = './'.$filename;  // Path ou sera stokée votre sauvegarde envoyée
	if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			$zip->extractTo(U_DATA); // Path ou sera décompressée l'archive
			$zip->close();
	
			unlink($target_path);
		}
		$error = "Votre sauvegarde a été envoyée et décompressé. La restauration est terminée";
	} else {	
		$error = "Une erreur est survenue lors de l'envoie. Merci de recommencer.";
	}
   }
}
/**
*
* FORMULAIRE DE RÉSTAURATION DE LA SAUVEGARDE
*/
function frestore() {
	$form = '<!-- Restauration form -->
          <div class="page-header">
            <h1>Restauration du forum</h1>
          </div>	
	<form action="index.php" method="post" enctype="multipart/form-data" class="form-inline">
	          <input type="hidden" name="restore" value="1" />
	          <input type="hidden" name="action" value="restore" />';
	$form .= '  <div class="control-group">
    <label class="control-label muted">Envoyer une sauvegarde à restaurer</label>
    <div class="controls">
      <input type="file" id="backup" name="backup">
    </div>
  </div>
  <input class="btn" type="submit" value="Envoyer" />
       </form>
	</div>';
	
	return $form;
}
/**
*
* ÉDITION DE LA CONFIGURATION
*/
function editConf() {
	global $uforum,$nbrMsgIndex,$extStr,$maxAvatarSize,$wt,$forumMode,$quoteMode,$siteUrl,$siteName,$lang,$metaDesc;
	
	$fmode = $forumMode?'checked="checked" ':'';
	$qmode = $quoteMode?'checked="checked" ':'';
	if(!$wtp=@file_get_contents('welcome.txt')) $wtp=base64_decode(clean($wt));
	$form = '<!-- Edit config form -->';
	$form .= '<div class="page-header">
            <h1>Options de configuration</h1>
          </div>';
	$form .= '<div style="padding-top:10px;">';
	$form .= '<form action="index.php" method="post" enctype="multipart/form-data" class="form-horizontal">
  <input type="hidden" name="action" value="editoption" />
  
  <div class="control-group">
    <label class="control-label">Titre du forum / Logo</label>
    <div class="controls">
      <input type="text" name="uftitle" maxlength="60" value="'.clean($uforum).'" />
      &nbsp;<input type="file" name="attachment" />
    </div>
  </div> 

  <div class="control-group">
    <label class="control-label">Nom &amp; Url du site</label>
    <div class="controls">
      <input type="text" name="ufsitename" value="'.clean($siteName).'" placeholder="µForum" />
      &nbsp;<input type="url" maxlength="80" name="ufsite" value="'.$siteUrl.'" placeholder="http://…" />
    </div>
  </div> 
  
  ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     textarea('Meta Description', 'ufmetadesc', clean($metaDesc), '10', '2', 'Lightweight bulletin board without sql', '150', '', 'input-xxlarge').
     input('Max. messages en index', 'nbmess', $nbrMsgIndex, 'number', '', '2', '', 'span1').
     input('Langue', 'uflang', $lang, 'text', '', '2', '', 'span1').
     input('Poid max. d\'un avatar', 'maxav', ($maxAvatarSize/1024), 'number', '', '10', '', 'span1', 'resize-small').
     input('Extensions autorisées', 'exts', clean($extStr), 'text', '', '50', '', 'input-xlarge'). ' 

  <div class="control-group">
    <label class="control-label">Forum mode privé</label>
    <div class="controls">
      <input name="fmode" value="1" type="checkbox" '.$fmode.'/>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label">Afficher les signatures</label>
    <div class="controls">
      <input name="qmode" value="1" type="checkbox" '.$qmode.'/>
    </div>
  </div>  
  ' .textarea('Message d\'accueil', 'message', $wtp, '40', '20', '', '', '', 'input-xxlarge'). '       

  <div class="form-actions">
     <button type="submit" class="btn btn-primary">Enregistrer</button>
  </div>  
</form>';
	$form .= '</div>';
	
	return $form;
}
/**
*
* INITIALISATION
*/
header('Content-Type: text/html; charset=utf-8');
$error='';
init_forum();

$siteUrl=baseURL(); // pour une upgrade,  enlever dans les futurs versions
require 'config.php';
//require 'lang/' .$lang. '.lng.php';
$extStr=$extensionsAutorises;
$extensionsAutorises= '/.'.str_replace(",","$|.",$extensionsAutorises).'$/i';
/**
*
* GET & POST
*/
$gets=array('topic','action','logout','memberlist','login','password','editprofil','email','birthday','site','signature','titre','message','topicID','postID','deluser','switchuser','delpost','editpost','style','private','delprivate','mpTo','backup','restore','read','conf','uftitle','nbmess','maxav','exts','fmode','anonymous','qmode','postit','ufsite','uflang','ufsitename','ufmetadesc','rc','ntitle','pid');
foreach($gets as $o) {
	$$o=(isset($_GET[$o]) && is_string($_GET[$o]))?$_GET[$o]:'';
	if(!$$o) $$o=(isset($_POST[$o]) && is_string($_POST[$o]))?$_POST[$o]:'';
}
if($pid) {
	$pid = base64_decode($pid);
	if(count($pid_name=explode('/',$pid))>2) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/force-download');
		header('Content-Length: ' .filesize($pid));
		header('Content-Disposition: attachment; filename='.basename($pid));
		@readfile($pid);
	} else $error .= 'Ce fichier n\'existe pas.';
}
if($rc) $error=base64_decode($rc);
if($topic && !$editpost) setCookie('uFread'.$topic,1,time()+2592000);
$cPass=(isset($_COOKIE['CookiePassword']))?$_COOKIE['CookiePassword']:'';
$cLogin=(isset($_COOKIE['CookieLogin']))?base64_decode($_COOKIE['CookieLogin']):'';
$cStyle=(isset($_COOKIE['CookieStyle']))?$_COOKIE['CookieStyle']:'defaut';
/**
*
* TEST DU MOT DE PASSE
*/
if (!empty($cLogin) && !empty($cPass)) {
	list($ismember,$goodpass,$isadmin)=$forum->checkMember($cLogin,$cPass);
	$havemp=@file_exists(U_MEMBER.$cLogin.'/'.$cLogin.'.mp');
	if(!$ismember || !$goodpass) {
		if(!$goodpass) $error .= 'Mauvais mot de passe pour '.$cLogin.' !<br>';
		if(!$ismember) $error .= 'Attention : l\'identifiant '.$cLogin.' est sensible à la casse !<br>';
		$ismember=0;
		$isadmin=0;
		setCookie('CookiePassword', '', time());
		setCookie('CookieLogin', '', time());
	} else if($isadmin==2){$isadmin=1;$isowner=1;}	
} else { $ismember=0;$isadmin=0;$isowner=0;}
/**
*
* DÉCONNEXION
*/
if ($ismember && $logout) {
	setCookie('CookiePassword', '', time());
	setCookie('CookieLogin', '', time());
	header('Location: index.php');
	exit();
}
if($style) { setCookie('CookieStyle',$style,time()+(3600*24*30)); $cStyle=$style; }
if($delprivate) { unlink(U_MEMBER.$cLogin.'/'.$cLogin.'.mp'); $havemp=0;}
/**
*
* DIFFÉRENTES ACTIONS
*/
switch ($action) {
case 'enter':
	setCookie('CookiePassword',md5($password),time()+(3600*24*30));
	setCookie('CookieLogin',base64_encode($login),time()+(3600*24*30));
	header('Location: index.php');
	exit();
	break;
case 'newuser':
	// on nettoie le nom d'utilisateur
	$login = str_replace(array(" ", '"', "'", "/", "&", ".", "!", "?", ":"), array("", '', "", "", "", "", "", "", ""), $login);
	$login = clean($login);
	$avatar='';
	if(in_array($login,$forum->listMember())) $error .= 'Cet utilisateur existe déjà !';
	else if($login != '' && $password != '' && $email != '' && $birthday != ''){
		if((preg_match('/(^[0-9a-zA-Z_\.-]{1,}@[0-9a-zA-Z_\-]{1,}\.[0-9a-zA-Z_\-]{2,}$)/', $email)) && (strlen($login)<13)) {
			$memberDir = U_MEMBER.$login;
			@mkdir($memberDir);
			$avatar=checkUpload($memberDir,1);
			$forum->addMember($login,$password,$email,$signature,$site,$birthday,$avatar);
			setCookie('CookiePassword', md5($password), time() + (3600 * 24 * 30));
			setCookie('CookieLogin', base64_encode($login), time() + (3600 * 24 * 30));
			header('Location: index.php');
			exit();
		} else {
			$error .= 'Vous avez fourni une adresse mail non valide !';
		}
	} else {
		$error .= 'Merci de remplir les champs Identifiant, Mot de passe, adresse mail et date de naissance !';
	}
		break;
case 'editprofil':
	$memberDir = U_MEMBER.$cLogin;
	if( preg_match('/(^[0-9a-zA-Z_\.-]{1,}@[0-9a-zA-Z_\-]{1,}\.[0-9a-zA-Z_\-]{2,}$)/', $email)) {
		$avatar=checkUpload($memberDir,1);
		if($avatar && $error!="") {
			header('Location: index.php?editprofil=1');
			exit();
		} else if(!$avatar) $avatar = "";
		$signature=clean($signature);
		$forum->setMember($cLogin,$email,$signature,$site,$birthday,$avatar);
	} else { header('Location: index.php?editprofil=1'); exit(); }
	break;
case 'newpost':
	if ($message !='' && $topicID != '' && ($ismember || !$forumMode)) {
		$anonymous=$anonymous?str_replace(array(" ", "\"", "'", "/", "&", "."), array("", "", "", "", "", ""), $anonymous):0;
		if(!$ismember && (!$anonymous || $anonymous=='')) {
			$error .= 'Vous n\'avez pas indiqué de pseudonyme valide.';
		} else if ($forum->isMember($anonymous)) {
		    $error .= 'Un membre est déjà inscrit sous ce pseudonyme.';
		} else {
			if($s = implode('', file(U_THREAD.$topicID.'.dat'))) {
				$tLogin=$cLogin?$cLogin:$anonymous;
				$topicObj = unserialize($s);
				$message = clean($message);
				$topicObj->addReply($tLogin,$message,checkUpload(U_MEMBER.$tLogin,0));
				list($time,$title,$auth,$post,$last,$tlast,$attach,$postType)=$topicObj->getInfo(0);
				$forum->updateTopic($time,$title,$auth,$post,$last,$tlast,$attach,$postType);
				if($ismember) $forum->setPost($cLogin);
				header('Location: index.php?topic='.$topicID);
				exit();
			} else $error .= 'Ce sujet n\'existe pas.';
		}
	}
	break;
case 'newtopic':
	if($titre!='' && $message!='' && ($ismember || !$forumMode)){
		if(!$ismember && !$anonymous) {
			$error .= 'Vous n\'avez pas indiqué de pseudonyme.';
		} else if ($forum->isMember($anonymous)) {
		    $error .= 'Un membre est déjà inscrit sous ce pseudonyme.';
		} else {
			$tLogin=$cLogin?$cLogin:$anonymous;
			$postType=$postit?1:0;
			$message = clean($message);
			$topicObj = new Topic($tLogin,$titre,$message,checkUpload(U_MEMBER.$tLogin,0),$postType);
			list($time,$title,$auth,$post,$last,$tlast,$attach,$postit)=$topicObj->getInfo(0);
			$forum->addTopic($title,$auth,$time,$attach,$postit);
			$topic=$time;
			setCookie('uFread'.$topic,1,time()+2592000);
		}
	}
	break;
case 'mp':
	if(file_exists(U_MEMBER.$mpTo.'/'.$mpTo.'.mp')) {
		$s=implode('', file(U_MEMBER.$mpTo.'/'.$mpTo.'.mp'));
		$mpObj=unserialize($s);
	}
	else $mpObj= new Messages($mpTo);
	if($anonymous) $mpObj->addMessage($anonymous.' ('.$_SERVER['REMOTE_ADDR'].')',$message);
	else if(!$ismember) $error.='Vous n\'avez pas indiqué de pseudonyme !';
	else $mpObj->addMessage($cLogin,$message);
	break;
case 'editoption':
	$tmp=checkUpload('upload',0);
	if(($uftitle!=$uforum) || ($tmp)) {
		if(file_exists($uforum)) unlink($uforum);
		$uforum=$tmp?$tmp:$uftitle;
	}
	$nbrMsgIndex=$nbmess?$nbmess:$nbrMsgIndex;
	$extStr=$exts?$exts:$extStr;
	$maxAvatarSize=$maxav?($maxav*1024):$maxAvatarSize;
	$forumMode=$fmode?1:0;
	$quoteMode=$qmode?1:0;
	$siteUrl=$ufsite?$ufsite:'';
	$lang=$uflang?$uflang:'fr';
	$metaDesc=$ufmetadesc?$ufmetadesc:'';
	$siteName=$ufsitename?$ufsitename:'';
	$config ="<?\$uforum='$uforum';\$utitle='$uftitle';\$lang='$uflang';\$metaDesc='$ufmetadesc';\$nbrMsgIndex=$nbrMsgIndex;\$extensionsAutorises='$extStr';\$maxAvatarSize=$maxAvatarSize;\$forumMode=$forumMode;\$quoteMode=$quoteMode;\$siteUrl='$siteUrl';\$siteName='$siteName';\$siteBase='$siteBase';?>";
	if($h=@fopen('config.php','w')) {fputs($h,$config);fclose($h);}
	if(empty($message) && file_exists('welcome.txt')) @unlink('welcome.txt');
	else {
		if($h=@fopen('welcome.txt','w')) {fputs($h,clean($message));fclose($h);}
	}
}
/**
*
* TÂCHES ADMIN
*/
if($isadmin) {
	if($deluser) { $forum->removeMember($deluser); }
	else if($switchuser) { $forum->setMod($switchuser); }
	else if($topic && $postit && !$action) { $type=$postit=="on"?1:0; $forum->setType($topic,$type); }
	else if($topic && $ntitle) { $forum->setTitle($topic,$ntitle); }
	else if($topicID && $action=='editpost' && $postID && $message!='') {
		if($s = implode('', file(U_THREAD.$topicID.'.dat'))) {
			$message = clean($message);
			$message = '[e]'.$cLogin.' le '.date('d/m/y \à H:i',time()).'[/e]'.$message;
			$topicObj = unserialize($s);
			$topicObj->setReply($postID,'',$message);
			$topic=$topicID;
		}
	}
	else if($topic && $delpost) {
		if($topic==$delpost) {
			if(@unlink(U_THREAD.$topic.'.dat')) {
				$forum->delTopic($topic);
				header('Location: index.php');
				exit();
			}
		} else {
			if($s=implode('', file(U_THREAD.$topic.'.dat'))) {
				$topicObj = unserialize($s);
				$r=$topicObj->getReply($delpost);
				@unlink($r[3]);
				$topicObj->removeReply($delpost);
				list($time,$title,$auth,$post,$last,$tlast,$attach,$postType)=$topicObj->getInfo(0);
				$forum->updateTopic($time,$title,$auth,$post,$last,$tlast,$attach,$postType);
			}
		}
	}
	else if($backup) {$r=do_backup(U_DATA, 'backup/data_' . date('d-m-Y-h:i:s'). '.zip');}
	else if($restore && $action=='restore') {
		if(@is_uploaded_file($_FILES['backup']['tmp_name'])) {
			$r=restore_forum($_FILES['backup']['tmp_name']);
		}
		$restore=0;
		$r=init_forum();
	}
}
/**
*
* RENDUS HTML (Template)
*/
?>
<!DOCTYPE html>
<html lang="<? echo $lang; ?>">
  <head>
    <meta charset="utf-8"> 
    <meta name="description" content="<? echo $metaDesc; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<?php
echo '<base href="'.$siteBase.'" />';
echo '<link rel="stylesheet" href="css/style_'.$cStyle.'.css" />
      <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
      <link rel="stylesheet" href="css/main.css" />
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />';
?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]--> 
    <!-- Chargement de Jquery
    ================================================== -->    
    <script src="http://code.jquery.com/jquery.min.js"></script>              
<?php
if(preg_match('/.gif$|.jpg$|.png$/i',$uforum) && file_exists($uforum)) {
	//$tmp='<a href="index.php" title="'.clean($siteName).'"><img src="'.$uforum.'" alt="'.clean($siteName).'" /></a>';
	$tmp='<img class="logo" src="'.$uforum.'" alt="'.clean($siteName).'" />';
	echo '<title>'.$siteName.'</title>';
} else {
	$tmp=decode($uforum);
	$bbcodes=array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[e]','[/e]','[hr]');
	echo '<title>'.str_replace($bbcodes,'',$uforum).'</title>';
}

echo '<script>function quote(c,f){var a=document.getElementById("td"+f).innerHTML;var b=new Array("<fieldset.*?>.*?</fieldset>","<br>|<br />","<small>.*?</small>|<pre>|</pre>|<font.*?>|</font>|&nbsp;","<b>","</b>","<i>","</i>","<u>","</u>","&amp;lt;|&lt;","&amp;gt;|&gt;","<hr />","<img(.*?)src="pictures/(.*?)"(.*?)>");var e=new Array("","\n","","[b]","[/b]","[i]","[/i]","[u]","[/u]","<",">","[hr]","[sm=$2]");var d=0;for(i in b){regex=new RegExp(b[i],"gi");a=a.replace(regex,e[d++])}if(document.getElementById("form").style.visibility!="visible"){switchLayer("form")}document.getElementById("message").value+="[q="+c+"]"+a+"[/q]\n"}</script>
      </head>';
echo '<body onload="init();" id="top">';
echo '    <!-- Navbar
    ================================================== -->    
    <div class="container-narrow">

      <div class="masthead">
        <h3 class="muted"><a class="brand" href="./" title="Accueil du Forum">'.$tmp.'</a></h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>            
                  <div class="nav-collapse collapse navbar-responsive-collapse">';
        //if($ismember || !$forumMode){ echo menu(); } 
                       echo menu();      
        if($ismember || !$forumMode){ echo menu_admin(); }
echo '            </div><!-- /.nav-collapse -->
            </div>
          </div><!-- /.navbar-inner -->
        </div><!-- /.navbar -->
      </div>

          <div>
      <hr />
<noscript><div class="alert alert-block alert-error">
  <button type="button" class="close" data-dismiss="alert"><i class="icon-warning-sign"></i></button>
  <h4>Javascript désactivé détecté</h4>
  Vous avez actuellement le javascript qui est désactivé. Plusieurs fonctionnalités peuvent ne pas marcher. Veuillez réactiver le javascript pour accéder à toutes les fonctionnalités. 
</div></noscript>';

// message d'erreur (en cas de mauvais mot de passe, membre déjà existant etc...)
if($error != '') { echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button>'.$error.'<div class="clearfix"></div></div>'; }

if($ismember || !$forumMode){
    echo breadcrumbs();
    	
	if($editpost) echo replyForm('editpost');
	else if($conf) echo editConf();
	else if($topic) echo showPosts();
	else if($memberlist) echo showMemberlist();
	else if($editprofil) echo editProfilForm();
	else if($private) echo replyForm('mp',$private);
	else if($restore) echo frestore();
	//else { echo showTopics(); $st=1; }
	//if(!$forumMode && !$ismember) { echo registerForm(); if(isset($st)) echo welcomeText();}
	
	// MODE LIBRE
	else if(!$forumMode && !$ismember) {
	      $st=1; 
    echo '<div class="container-narrow">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab"><i class="icon-home"></i> Accueil</a></li>
              <li><a href="#reg" data-toggle="tab"><i class="icon-user"></i> S\'inscrire</a></li>
              <li><a href="#bb" data-toggle="tab"><i class="icon-th-list"></i> Forums</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="home">
                '.welcomeText().'
              </div>
              
              <div class="tab-pane fade" id="reg">
                '.registerForm().'
              </div>
              
              <div class="tab-pane fade" id="bb">
                '.showTopics().'
              </div>
              
            </div>
       </div>';	       
	}
	else 
	{ #on est connecté, alors on affiche uniquement la liste des forums
	echo showTopics(); 
	}
	if($havemp) echo showPrivateMsg();
} 
else 
{   // MODE PRIVÉ
	echo '<div class="container-narrow">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active"><a href="#home" data-toggle="tab"><i class="icon-home"></i> Accueil</a></li>
              <li><a href="#reg" data-toggle="tab"><i class="icon-user"></i> S\'inscrire</a></li>
            </ul>
            
            <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade in active" id="home">
                '.welcomeText().'
              </div>
              
              <div class="tab-pane fade" id="reg">
                '.registerForm().'
              </div>
              
            </div>
       </div>';
}


$arr_cnct=$conn->updateVisit($cLogin);
$stats=$forum->getStat();
echo '<hr />

      <div class="row-fluid container-narrow">
       <div class="span12 well">
        <div class="span6"><h4>Statistiques</h4>';
if($stats[0]>1) {$a[0]='s';$a[1]='ont';}
else {$a[0]='';$a[1]='a';}//Total membre
$m=($stats[3]>1)?'s':'';//Message
$s=($stats[2]>1)?'s':'';//Sujet
$arr_cnct[0]=($arr_cnct[0])?$arr_cnct[0]:'aucun';
//$u=($arr_cnct[3]>1)?'s':'';//Membre
//$n=($arr_cnct[2]>1)?'s':'';//actuellemnt connecté
//$v=($arr_cnct[1]>1)?'s':'';//Visiteur

echo '<p>Nous avons '.$stats[3].' message'.$m.' dans '.$stats[2].' sujet'.$s.'. </p>';
echo '<p>Bienvenue à notre nouveau membre, <span class="text-warning">'.$stats[1].'</span><p>
      <p>Total Membre'.$a[0].': '. $stats[0].'</p>
      </div>
      <div class="span6">
      <h4>Qui est en ligne ?</h4>
      <p>Membre actuellement connecté : <b>'.$arr_cnct[0].'</b> ,Visiteur : '.$arr_cnct[1];
echo ' </p>
      <h4>Légende</h4>
      <p><i class="icon-folder-open"></i> Ne contient pas de messages non lus. <i class="icon-star"></i> Épinglé</p> 
      <p><i class="icon-fire"></i> Contient des messages non lus. <i class="icon-file"></i> Pièce jointe</p>
        </div>
       </div>
      </div>';

echo '<hr />


      <div class="footer container-narrow" id="bottom">
        <p>© 2011-'.date('Y').' '.clean($siteName).'.  
             <span class="pull-right">Propulsé par <a href="http://uforum.byethost5.com" rel="tooltip" title="Forum ultra légé sans SQL">µForum v.'.$version.'</a>&nbsp;&nbsp;
             &nbsp;&nbsp;<a href="' .getURL(). '#top" rel="tooltip" title="Haut de page"><i class="icon-chevron-up"></i></a></span>
        </p>
      </div>';
?>
    <!-- Le javascript
    ================================================== -->    
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>  
    <script src="js/bootstrap.js"></script>   
    <script src="js/script.js"></script> 
  </body>
</html>