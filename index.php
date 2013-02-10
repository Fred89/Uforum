<?php
# ------------------ BEGIN LICENSE BLOCK ------------------
#
# This file is part of µForum project: http://uforum.byethost5.com
#
# @update     09-02-2013
# @copyright  2011-2013  Frédéric Kaplon and contributors
# @copyright   ~   2008  Okkin  Avetenebrae
# @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE (LGPL) version 3
# @link       http://uforum.byethost5.com   µForum
# @version    Release: @package_version@
#
# ------------------- END LICENSE BLOCK -------------------
error_reporting(E_ALL);
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
$version = '0.9.5';
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
	// Bootstrap JS 2.3.0
    $js_bootstrap =
'LyogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09DQogKiBib290c3RyYXAtdHJhbnNpdGlvbi5qcyB2Mi4zLjANCiAqIGh0dHA6Ly90d2l0dGVyLmdpdGh1Yi5jb20vYm9vdHN0cmFwL2phdmFzY3JpcHQuaHRtbCN0cmFuc2l0aW9ucw0KICogPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PSAqLw0KIWZ1bmN0aW9uKGEpe2EoZnVuY3Rpb24oKXthLnN1cHBvcnQudHJhbnNpdGlvbj0oZnVuY3Rpb24oKXt2YXIgYj0oZnVuY3Rpb24oKXt2YXIgZT1kb2N1bWVudC5jcmVhdGVFbGVtZW50KCJib290c3RyYXAiKSxkPXtXZWJraXRUcmFuc2l0aW9uOiJ3ZWJraXRUcmFuc2l0aW9uRW5kIixNb3pUcmFuc2l0aW9uOiJ0cmFuc2l0aW9uZW5kIixPVHJhbnNpdGlvbjoib1RyYW5zaXRpb25FbmQgb3RyYW5zaXRpb25lbmQiLHRyYW5zaXRpb246InRyYW5zaXRpb25lbmQifSxjO2ZvcihjIGluIGQpe2lmKGUuc3R5bGVbY10hPT11bmRlZmluZWQpe3JldHVybiBkW2NdfX19KCkpO3JldHVybiBiJiZ7ZW5kOmJ9fSkoKX0pfSh3aW5kb3cualF1ZXJ5KTshZnVuY3Rpb24oZCl7dmFyIGM9J1tkYXRhLWRpc21pc3M9ImFsZXJ0Il0nLGI9ZnVuY3Rpb24oZSl7ZChlKS5vbigiY2xpY2siLGMsdGhpcy5jbG9zZSl9O2IucHJvdG90eXBlLmNsb3NlPWZ1bmN0aW9uKGope3ZhciBpPWQodGhpcyksZz1pLmF0dHIoImRhdGEtdGFyZ2V0IiksaDtpZighZyl7Zz1pLmF0dHIoImhyZWYiKTtnPWcmJmcucmVwbGFjZSgvLiooPz0jW15cc10qJCkvLCIiKX1oPWQoZyk7aiYmai5wcmV2ZW50RGVmYXVsdCgpO2gubGVuZ3RofHwoaD1pLmhhc0NsYXNzKCJhbGVydCIpP2k6aS5wYXJlbnQoKSk7aC50cmlnZ2VyKGo9ZC5FdmVudCgiY2xvc2UiKSk7aWYoai5pc0RlZmF1bHRQcmV2ZW50ZWQoKSl7cmV0dXJufWgucmVtb3ZlQ2xhc3MoImluIik7ZnVuY3Rpb24gZigpe2gudHJpZ2dlcigiY2xvc2VkIikucmVtb3ZlKCl9ZC5zdXBwb3J0LnRyYW5zaXRpb24mJmguaGFzQ2xhc3MoImZhZGUiKT9oLm9uKGQuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxmKTpmKCl9O3ZhciBhPWQuZm4uYWxlcnQ7ZC5mbi5hbGVydD1mdW5jdGlvbihlKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGc9ZCh0aGlzKSxmPWcuZGF0YSgiYWxlcnQiKTtpZighZil7Zy5kYXRhKCJhbGVydCIsKGY9bmV3IGIodGhpcykpKX1pZih0eXBlb2YgZT09InN0cmluZyIpe2ZbZV0uY2FsbChnKX19KX07ZC5mbi5hbGVydC5Db25zdHJ1Y3Rvcj1iO2QuZm4uYWxlcnQubm9Db25mbGljdD1mdW5jdGlvbigpe2QuZm4uYWxlcnQ9YTtyZXR1cm4gdGhpc307ZChkb2N1bWVudCkub24oImNsaWNrLmFsZXJ0LmRhdGEtYXBpIixjLGIucHJvdG90eXBlLmNsb3NlKX0od2luZG93LmpRdWVyeSk7IWZ1bmN0aW9uKGMpe3ZhciBiPWZ1bmN0aW9uKGUsZCl7dGhpcy4kZWxlbWVudD1jKGUpO3RoaXMub3B0aW9ucz1jLmV4dGVuZCh7fSxjLmZuLmJ1dHRvbi5kZWZhdWx0cyxkKX07Yi5wcm90b3R5cGUuc2V0U3RhdGU9ZnVuY3Rpb24oZyl7dmFyIGk9ImRpc2FibGVkIixlPXRoaXMuJGVsZW1lbnQsZj1lLmRhdGEoKSxoPWUuaXMoImlucHV0Iik/InZhbCI6Imh0bWwiO2c9ZysiVGV4dCI7Zi5yZXNldFRleHR8fGUuZGF0YSgicmVzZXRUZXh0IixlW2hdKCkpO2VbaF0oZltnXXx8dGhpcy5vcHRpb25zW2ddKTtzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7Zz09ImxvYWRpbmdUZXh0Ij9lLmFkZENsYXNzKGkpLmF0dHIoaSxpKTplLnJlbW92ZUNsYXNzKGkpLnJlbW92ZUF0dHIoaSl9LDApfTtiLnByb3RvdHlwZS50b2dnbGU9ZnVuY3Rpb24oKXt2YXIgZD10aGlzLiRlbGVtZW50LmNsb3Nlc3QoJ1tkYXRhLXRvZ2dsZT0iYnV0dG9ucy1yYWRpbyJdJyk7ZCYmZC5maW5kKCIuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpO3RoaXMuJGVsZW1lbnQudG9nZ2xlQ2xhc3MoImFjdGl2ZSIpfTt2YXIgYT1jLmZuLmJ1dHRvbjtjLmZuLmJ1dHRvbj1mdW5jdGlvbihkKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGc9Yyh0aGlzKSxmPWcuZGF0YSgiYnV0dG9uIiksZT10eXBlb2YgZD09Im9iamVjdCImJmQ7aWYoIWYpe2cuZGF0YSgiYnV0dG9uIiwoZj1uZXcgYih0aGlzLGUpKSl9aWYoZD09InRvZ2dsZSIpe2YudG9nZ2xlKCl9ZWxzZXtpZihkKXtmLnNldFN0YXRlKGQpfX19KX07Yy5mbi5idXR0b24uZGVmYXVsdHM9e2xvYWRpbmdUZXh0OiJsb2FkaW5nLi4uIn07Yy5mbi5idXR0b24uQ29uc3RydWN0b3I9YjtjLmZuLmJ1dHRvbi5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yy5mbi5idXR0b249YTtyZXR1cm4gdGhpc307Yyhkb2N1bWVudCkub24oImNsaWNrLmJ1dHRvbi5kYXRhLWFwaSIsIltkYXRhLXRvZ2dsZV49YnV0dG9uXSIsZnVuY3Rpb24oZil7dmFyIGQ9YyhmLnRhcmdldCk7aWYoIWQuaGFzQ2xhc3MoImJ0biIpKXtkPWQuY2xvc2VzdCgiLmJ0biIpfWQuYnV0dG9uKCJ0b2dnbGUiKX0pfSh3aW5kb3cualF1ZXJ5KTshZnVuY3Rpb24oYil7dmFyIGM9ZnVuY3Rpb24oZSxkKXt0aGlzLiRlbGVtZW50PWIoZSk7dGhpcy4kaW5kaWNhdG9ycz10aGlzLiRlbGVtZW50LmZpbmQoIi5jYXJvdXNlbC1pbmRpY2F0b3JzIik7dGhpcy5vcHRpb25zPWQ7dGhpcy5vcHRpb25zLnBhdXNlPT0iaG92ZXIiJiZ0aGlzLiRlbGVtZW50Lm9uKCJtb3VzZWVudGVyIixiLnByb3h5KHRoaXMucGF1c2UsdGhpcykpLm9uKCJtb3VzZWxlYXZlIixiLnByb3h5KHRoaXMuY3ljbGUsdGhpcykpfTtjLnByb3RvdHlwZT17Y3ljbGU6ZnVuY3Rpb24oZCl7aWYoIWQpe3RoaXMucGF1c2VkPWZhbHNlfWlmKHRoaXMuaW50ZXJ2YWwpe2NsZWFySW50ZXJ2YWwodGhpcy5pbnRlcnZhbCl9dGhpcy5vcHRpb25zLmludGVydmFsJiYhdGhpcy5wYXVzZWQmJih0aGlzLmludGVydmFsPXNldEludGVydmFsKGIucHJveHkodGhpcy5uZXh0LHRoaXMpLHRoaXMub3B0aW9ucy5pbnRlcnZhbCkpO3JldHVybiB0aGlzfSxnZXRBY3RpdmVJbmRleDpmdW5jdGlvbigpe3RoaXMuJGFjdGl2ZT10aGlzLiRlbGVtZW50LmZpbmQoIi5pdGVtLmFjdGl2ZSIpO3RoaXMuJGl0ZW1zPXRoaXMuJGFjdGl2ZS5wYXJlbnQoKS5jaGlsZHJlbigpO3JldHVybiB0aGlzLiRpdGVtcy5pbmRleCh0aGlzLiRhY3RpdmUpfSx0bzpmdW5jdGlvbihmKXt2YXIgZD10aGlzLmdldEFjdGl2ZUluZGV4KCksZT10aGlzO2lmKGY+KHRoaXMuJGl0ZW1zLmxlbmd0aC0xKXx8ZjwwKXtyZXR1cm59aWYodGhpcy5zbGlkaW5nKXtyZXR1cm4gdGhpcy4kZWxlbWVudC5vbmUoInNsaWQiLGZ1bmN0aW9uKCl7ZS50byhmKX0pfWlmKGQ9PWYpe3JldHVybiB0aGlzLnBhdXNlKCkuY3ljbGUoKX1yZXR1cm4gdGhpcy5zbGlkZShmPmQ/Im5leHQiOiJwcmV2IixiKHRoaXMuJGl0ZW1zW2ZdKSl9LHBhdXNlOmZ1bmN0aW9uKGQpe2lmKCFkKXt0aGlzLnBhdXNlZD10cnVlfWlmKHRoaXMuJGVsZW1lbnQuZmluZCgiLm5leHQsIC5wcmV2IikubGVuZ3RoJiZiLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQpe3RoaXMuJGVsZW1lbnQudHJpZ2dlcihiLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQpO3RoaXMuY3ljbGUoKX1jbGVhckludGVydmFsKHRoaXMuaW50ZXJ2YWwpO3RoaXMuaW50ZXJ2YWw9bnVsbDtyZXR1cm4gdGhpc30sbmV4dDpmdW5jdGlvbigpe2lmKHRoaXMuc2xpZGluZyl7cmV0dXJufXJldHVybiB0aGlzLnNsaWRlKCJuZXh0Iil9LHByZXY6ZnVuY3Rpb24oKXtpZih0aGlzLnNsaWRpbmcpe3JldHVybn1yZXR1cm4gdGhpcy5zbGlkZSgicHJldiIpfSxzbGlkZTpmdW5jdGlvbihrLGYpe3ZhciBtPXRoaXMuJGVsZW1lbnQuZmluZCgiLml0ZW0uYWN0aXZlIiksZD1mfHxtW2tdKCksaj10aGlzLmludGVydmFsLGw9az09Im5leHQiPyJsZWZ0IjoicmlnaHQiLGc9az09Im5leHQiPyJmaXJzdCI6Imxhc3QiLGg9dGhpcyxpO3RoaXMuc2xpZGluZz10cnVlO2omJnRoaXMucGF1c2UoKTtkPWQubGVuZ3RoP2Q6dGhpcy4kZWxlbWVudC5maW5kKCIuaXRlbSIpW2ddKCk7aT1iLkV2ZW50KCJzbGlkZSIse3JlbGF0ZWRUYXJnZXQ6ZFswXSxkaXJlY3Rpb246bH0pO2lmKGQuaGFzQ2xhc3MoImFjdGl2ZSIpKXtyZXR1cm59aWYodGhpcy4kaW5kaWNhdG9ycy5sZW5ndGgpe3RoaXMuJGluZGljYXRvcnMuZmluZCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKTt0aGlzLiRlbGVtZW50Lm9uZSgic2xpZCIsZnVuY3Rpb24oKXt2YXIgZT1iKGguJGluZGljYXRvcnMuY2hpbGRyZW4oKVtoLmdldEFjdGl2ZUluZGV4KCldKTtlJiZlLmFkZENsYXNzKCJhY3RpdmUiKX0pfWlmKGIuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJzbGlkZSIpKXt0aGlzLiRlbGVtZW50LnRyaWdnZXIoaSk7aWYoaS5pc0RlZmF1bHRQcmV2ZW50ZWQoKSl7cmV0dXJufWQuYWRkQ2xhc3Moayk7ZFswXS5vZmZzZXRXaWR0aDttLmFkZENsYXNzKGwpO2QuYWRkQ2xhc3MobCk7dGhpcy4kZWxlbWVudC5vbmUoYi5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGZ1bmN0aW9uKCl7ZC5yZW1vdmVDbGFzcyhbayxsXS5qb2luKCIgIikpLmFkZENsYXNzKCJhY3RpdmUiKTttLnJlbW92ZUNsYXNzKFsiYWN0aXZlIixsXS5qb2luKCIgIikpO2guc2xpZGluZz1mYWxzZTtzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7aC4kZWxlbWVudC50cmlnZ2VyKCJzbGlkIil9LDApfSl9ZWxzZXt0aGlzLiRlbGVtZW50LnRyaWdnZXIoaSk7aWYoaS5pc0RlZmF1bHRQcmV2ZW50ZWQoKSl7cmV0dXJufW0ucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpO2QuYWRkQ2xhc3MoImFjdGl2ZSIpO3RoaXMuc2xpZGluZz1mYWxzZTt0aGlzLiRlbGVtZW50LnRyaWdnZXIoInNsaWQiKX1qJiZ0aGlzLmN5Y2xlKCk7cmV0dXJuIHRoaXN9fTt2YXIgYT1iLmZuLmNhcm91c2VsO2IuZm4uY2Fyb3VzZWw9ZnVuY3Rpb24oZCl7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciBoPWIodGhpcyksZz1oLmRhdGEoImNhcm91c2VsIiksZT1iLmV4dGVuZCh7fSxiLmZuLmNhcm91c2VsLmRlZmF1bHRzLHR5cGVvZiBkPT0ib2JqZWN0IiYmZCksZj10eXBlb2YgZD09InN0cmluZyI/ZDplLnNsaWRlO2lmKCFnKXtoLmRhdGEoImNhcm91c2VsIiwoZz1uZXcgYyh0aGlzLGUpKSl9aWYodHlwZW9mIGQ9PSJudW1iZXIiKXtnLnRvKGQpfWVsc2V7aWYoZil7Z1tmXSgpfWVsc2V7aWYoZS5pbnRlcnZhbCl7Zy5wYXVzZSgpLmN5Y2xlKCl9fX19KX07Yi5mbi5jYXJvdXNlbC5kZWZhdWx0cz17aW50ZXJ2YWw6NTAwMCxwYXVzZToiaG92ZXIifTtiLmZuLmNhcm91c2VsLkNvbnN0cnVjdG9yPWM7Yi5mbi5jYXJvdXNlbC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yi5mbi5jYXJvdXNlbD1hO3JldHVybiB0aGlzfTtiKGRvY3VtZW50KS5vbigiY2xpY2suY2Fyb3VzZWwuZGF0YS1hcGkiLCJbZGF0YS1zbGlkZV0sIFtkYXRhLXNsaWRlLXRvXSIsZnVuY3Rpb24oail7dmFyIGk9Yih0aGlzKSxmLGQ9YihpLmF0dHIoImRhdGEtdGFyZ2V0Iil8fChmPWkuYXR0cigiaHJlZiIpKSYmZi5yZXBsYWNlKC8uKig/PSNbXlxzXSskKS8sIiIpKSxnPWIuZXh0ZW5kKHt9LGQuZGF0YSgpLGkuZGF0YSgpKSxoO2QuY2Fyb3VzZWwoZyk7aWYoaD1pLmF0dHIoImRhdGEtc2xpZGUtdG8iKSl7ZC5kYXRhKCJjYXJvdXNlbCIpLnBhdXNlKCkudG8oaCkuY3ljbGUoKX1qLnByZXZlbnREZWZhdWx0KCl9KX0od2luZG93LmpRdWVyeSk7IWZ1bmN0aW9uKGIpe3ZhciBjPWZ1bmN0aW9uKGUsZCl7dGhpcy4kZWxlbWVudD1iKGUpO3RoaXMub3B0aW9ucz1iLmV4dGVuZCh7fSxiLmZuLmNvbGxhcHNlLmRlZmF1bHRzLGQpO2lmKHRoaXMub3B0aW9ucy5wYXJlbnQpe3RoaXMuJHBhcmVudD1iKHRoaXMub3B0aW9ucy5wYXJlbnQpfXRoaXMub3B0aW9ucy50b2dnbGUmJnRoaXMudG9nZ2xlKCl9O2MucHJvdG90eXBlPXtjb25zdHJ1Y3RvcjpjLGRpbWVuc2lvbjpmdW5jdGlvbigpe3ZhciBkPXRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoIndpZHRoIik7cmV0dXJuIGQ/IndpZHRoIjoiaGVpZ2h0In0sc2hvdzpmdW5jdGlvbigpe3ZhciBnLGQsZixlO2lmKHRoaXMudHJhbnNpdGlvbmluZ3x8dGhpcy4kZWxlbWVudC5oYXNDbGFzcygiaW4iKSl7cmV0dXJufWc9dGhpcy5kaW1lbnNpb24oKTtkPWIuY2FtZWxDYXNlKFsic2Nyb2xsIixnXS5qb2luKCItIikpO2Y9dGhpcy4kcGFyZW50JiZ0aGlzLiRwYXJlbnQuZmluZCgiPiAuYWNjb3JkaW9uLWdyb3VwID4gLmluIik7aWYoZiYmZi5sZW5ndGgpe2U9Zi5kYXRhKCJjb2xsYXBzZSIpO2lmKGUmJmUudHJhbnNpdGlvbmluZyl7cmV0dXJufWYuY29sbGFwc2UoImhpZGUiKTtlfHxmLmRhdGEoImNvbGxhcHNlIixudWxsKX10aGlzLiRlbGVtZW50W2ddKDApO3RoaXMudHJhbnNpdGlvbigiYWRkQ2xhc3MiLGIuRXZlbnQoInNob3ciKSwic2hvd24iKTtiLnN1cHBvcnQudHJhbnNpdGlvbiYmdGhpcy4kZWxlbWVudFtnXSh0aGlzLiRlbGVtZW50WzBdW2RdKX0saGlkZTpmdW5jdGlvbigpe3ZhciBkO2lmKHRoaXMudHJhbnNpdGlvbmluZ3x8IXRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoImluIikpe3JldHVybn1kPXRoaXMuZGltZW5zaW9uKCk7dGhpcy5yZXNldCh0aGlzLiRlbGVtZW50W2RdKCkpO3RoaXMudHJhbnNpdGlvbigicmVtb3ZlQ2xhc3MiLGIuRXZlbnQoImhpZGUiKSwiaGlkZGVuIik7dGhpcy4kZWxlbWVudFtkXSgwKX0scmVzZXQ6ZnVuY3Rpb24oZCl7dmFyIGU9dGhpcy5kaW1lbnNpb24oKTt0aGlzLiRlbGVtZW50LnJlbW92ZUNsYXNzKCJjb2xsYXBzZSIpW2VdKGR8fCJhdXRvIilbMF0ub2Zmc2V0V2lkdGg7dGhpcy4kZWxlbWVudFtkIT09bnVsbD8iYWRkQ2xhc3MiOiJyZW1vdmVDbGFzcyJdKCJjb2xsYXBzZSIpO3JldHVybiB0aGlzfSx0cmFuc2l0aW9uOmZ1bmN0aW9uKGgsZSxmKXt2YXIgZz10aGlzLGQ9ZnVuY3Rpb24oKXtpZihlLnR5cGU9PSJzaG93Iil7Zy5yZXNldCgpfWcudHJhbnNpdGlvbmluZz0wO2cuJGVsZW1lbnQudHJpZ2dlcihmKX07dGhpcy4kZWxlbWVudC50cmlnZ2VyKGUpO2lmKGUuaXNEZWZhdWx0UHJldmVudGVkKCkpe3JldHVybn10aGlzLnRyYW5zaXRpb25pbmc9MTt0aGlzLiRlbGVtZW50W2hdKCJpbiIpO2Iuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJjb2xsYXBzZSIpP3RoaXMuJGVsZW1lbnQub25lKGIuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxkKTpkKCl9LHRvZ2dsZTpmdW5jdGlvbigpe3RoaXNbdGhpcy4kZWxlbWVudC5oYXNDbGFzcygiaW4iKT8iaGlkZSI6InNob3ciXSgpfX07dmFyIGE9Yi5mbi5jb2xsYXBzZTtiLmZuLmNvbGxhcHNlPWZ1bmN0aW9uKGQpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZz1iKHRoaXMpLGY9Zy5kYXRhKCJjb2xsYXBzZSIpLGU9Yi5leHRlbmQoe30sYi5mbi5jb2xsYXBzZS5kZWZhdWx0cyxnLmRhdGEoKSx0eXBlb2YgZD09Im9iamVjdCImJmQpO2lmKCFmKXtnLmRhdGEoImNvbGxhcHNlIiwoZj1uZXcgYyh0aGlzLGUpKSl9aWYodHlwZW9mIGQ9PSJzdHJpbmciKXtmW2RdKCl9fSl9O2IuZm4uY29sbGFwc2UuZGVmYXVsdHM9e3RvZ2dsZTp0cnVlfTtiLmZuLmNvbGxhcHNlLkNvbnN0cnVjdG9yPWM7Yi5mbi5jb2xsYXBzZS5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yi5mbi5jb2xsYXBzZT1hO3JldHVybiB0aGlzfTtiKGRvY3VtZW50KS5vbigiY2xpY2suY29sbGFwc2UuZGF0YS1hcGkiLCJbZGF0YS10b2dnbGU9Y29sbGFwc2VdIixmdW5jdGlvbihpKXt2YXIgaD1iKHRoaXMpLGQsZz1oLmF0dHIoImRhdGEtdGFyZ2V0Iil8fGkucHJldmVudERlZmF1bHQoKXx8KGQ9aC5hdHRyKCJocmVmIikpJiZkLnJlcGxhY2UoLy4qKD89I1teXHNdKyQpLywiIiksZj1iKGcpLmRhdGEoImNvbGxhcHNlIik/InRvZ2dsZSI6aC5kYXRhKCk7aFtiKGcpLmhhc0NsYXNzKCJpbiIpPyJhZGRDbGFzcyI6InJlbW92ZUNsYXNzIl0oImNvbGxhcHNlZCIpO2IoZykuY29sbGFwc2UoZil9KX0od2luZG93LmpRdWVyeSk7IWZ1bmN0aW9uKGYpe3ZhciBiPSJbZGF0YS10b2dnbGU9ZHJvcGRvd25dIixhPWZ1bmN0aW9uKGgpe3ZhciBnPWYoaCkub24oImNsaWNrLmRyb3Bkb3duLmRhdGEtYXBpIix0aGlzLnRvZ2dsZSk7ZigiaHRtbCIpLm9uKCJjbGljay5kcm9wZG93bi5kYXRhLWFwaSIsZnVuY3Rpb24oKXtnLnBhcmVudCgpLnJlbW92ZUNsYXNzKCJvcGVuIil9KX07YS5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmEsdG9nZ2xlOmZ1bmN0aW9uKGope3ZhciBpPWYodGhpcyksaCxnO2lmKGkuaXMoIi5kaXNhYmxlZCwgOmRpc2FibGVkIikpe3JldHVybn1oPWUoaSk7Zz1oLmhhc0NsYXNzKCJvcGVuIik7ZCgpO2lmKCFnKXtoLnRvZ2dsZUNsYXNzKCJvcGVuIil9aS5mb2N1cygpO3JldHVybiBmYWxzZX0sa2V5ZG93bjpmdW5jdGlvbihsKXt2YXIgayxtLGcsaixpLGg7aWYoIS8oMzh8NDB8MjcpLy50ZXN0KGwua2V5Q29kZSkpe3JldHVybn1rPWYodGhpcyk7bC5wcmV2ZW50RGVmYXVsdCgpO2wuc3RvcFByb3BhZ2F0aW9uKCk7aWYoay5pcygiLmRpc2FibGVkLCA6ZGlzYWJsZWQiKSl7cmV0dXJufWo9ZShrKTtpPWouaGFzQ2xhc3MoIm9wZW4iKTtpZighaXx8KGkmJmwua2V5Q29kZT09MjcpKXtpZihsLndoaWNoPT0yNyl7ai5maW5kKGIpLmZvY3VzKCl9cmV0dXJuIGsuY2xpY2soKX1tPWYoIltyb2xlPW1lbnVdIGxpOm5vdCguZGl2aWRlcik6dmlzaWJsZSBhIixqKTtpZighbS5sZW5ndGgpe3JldHVybn1oPW0uaW5kZXgobS5maWx0ZXIoIjpmb2N1cyIpKTtpZihsLmtleUNvZGU9PTM4JiZoPjApe2gtLX1pZihsLmtleUNvZGU9PTQwJiZoPG0ubGVuZ3RoLTEpe2grK31pZighfmgpe2g9MH1tLmVxKGgpLmZvY3VzKCl9fTtmdW5jdGlvbiBkKCl7ZihiKS5lYWNoKGZ1bmN0aW9uKCl7ZShmKHRoaXMpKS5yZW1vdmVDbGFzcygib3BlbiIpfSl9ZnVuY3Rpb24gZShpKXt2YXIgZz1pLmF0dHIoImRhdGEtdGFyZ2V0IiksaDtpZighZyl7Zz1pLmF0dHIoImhyZWYiKTtnPWcmJi8jLy50ZXN0KGcpJiZnLnJlcGxhY2UoLy4qKD89I1teXHNdKiQpLywiIil9aD1nJiZmKGcpO2lmKCFofHwhaC5sZW5ndGgpe2g9aS5wYXJlbnQoKX1yZXR1cm4gaH12YXIgYz1mLmZuLmRyb3Bkb3duO2YuZm4uZHJvcGRvd249ZnVuY3Rpb24oZyl7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciBpPWYodGhpcyksaD1pLmRhdGEoImRyb3Bkb3duIik7aWYoIWgpe2kuZGF0YSgiZHJvcGRvd24iLChoPW5ldyBhKHRoaXMpKSl9aWYodHlwZW9mIGc9PSJzdHJpbmciKXtoW2ddLmNhbGwoaSl9fSl9O2YuZm4uZHJvcGRvd24uQ29uc3RydWN0b3I9YTtmLmZuLmRyb3Bkb3duLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtmLmZuLmRyb3Bkb3duPWM7cmV0dXJuIHRoaXN9O2YoZG9jdW1lbnQpLm9uKCJjbGljay5kcm9wZG93bi5kYXRhLWFwaSIsZCkub24oImNsaWNrLmRyb3Bkb3duLmRhdGEtYXBpIiwiLmRyb3Bkb3duIGZvcm0iLGZ1bmN0aW9uKGcpe2cuc3RvcFByb3BhZ2F0aW9uKCl9KS5vbigiLmRyb3Bkb3duLW1lbnUiLGZ1bmN0aW9uKGcpe2cuc3RvcFByb3BhZ2F0aW9uKCl9KS5vbigiY2xpY2suZHJvcGRvd24uZGF0YS1hcGkiLGIsYS5wcm90b3R5cGUudG9nZ2xlKS5vbigia2V5ZG93bi5kcm9wZG93bi5kYXRhLWFwaSIsYisiLCBbcm9sZT1tZW51XSIsYS5wcm90b3R5cGUua2V5ZG93bil9KHdpbmRvdy5qUXVlcnkpOyFmdW5jdGlvbihjKXt2YXIgYj1mdW5jdGlvbihlLGQpe3RoaXMub3B0aW9ucz1kO3RoaXMuJGVsZW1lbnQ9YyhlKS5kZWxlZ2F0ZSgnW2RhdGEtZGlzbWlzcz0ibW9kYWwiXScsImNsaWNrLmRpc21pc3MubW9kYWwiLGMucHJveHkodGhpcy5oaWRlLHRoaXMpKTt0aGlzLm9wdGlvbnMucmVtb3RlJiZ0aGlzLiRlbGVtZW50LmZpbmQoIi5tb2RhbC1ib2R5IikubG9hZCh0aGlzLm9wdGlvbnMucmVtb3RlKX07Yi5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmIsdG9nZ2xlOmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXNbIXRoaXMuaXNTaG93bj8ic2hvdyI6ImhpZGUiXSgpfSxzaG93OmZ1bmN0aW9uKCl7dmFyIGQ9dGhpcyxmPWMuRXZlbnQoInNob3ciKTt0aGlzLiRlbGVtZW50LnRyaWdnZXIoZik7aWYodGhpcy5pc1Nob3dufHxmLmlzRGVmYXVsdFByZXZlbnRlZCgpKXtyZXR1cm59dGhpcy5pc1Nob3duPXRydWU7dGhpcy5lc2NhcGUoKTt0aGlzLmJhY2tkcm9wKGZ1bmN0aW9uKCl7dmFyIGU9Yy5zdXBwb3J0LnRyYW5zaXRpb24mJmQuJGVsZW1lbnQuaGFzQ2xhc3MoImZhZGUiKTtpZighZC4kZWxlbWVudC5wYXJlbnQoKS5sZW5ndGgpe2QuJGVsZW1lbnQuYXBwZW5kVG8oZG9jdW1lbnQuYm9keSl9ZC4kZWxlbWVudC5zaG93KCk7aWYoZSl7ZC4kZWxlbWVudFswXS5vZmZzZXRXaWR0aH1kLiRlbGVtZW50LmFkZENsYXNzKCJpbiIpLmF0dHIoImFyaWEtaGlkZGVuIixmYWxzZSk7ZC5lbmZvcmNlRm9jdXMoKTtlP2QuJGVsZW1lbnQub25lKGMuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxmdW5jdGlvbigpe2QuJGVsZW1lbnQuZm9jdXMoKS50cmlnZ2VyKCJzaG93biIpfSk6ZC4kZWxlbWVudC5mb2N1cygpLnRyaWdnZXIoInNob3duIil9KX0saGlkZTpmdW5jdGlvbihmKXtmJiZmLnByZXZlbnREZWZhdWx0KCk7dmFyIGQ9dGhpcztmPWMuRXZlbnQoImhpZGUiKTt0aGlzLiRlbGVtZW50LnRyaWdnZXIoZik7aWYoIXRoaXMuaXNTaG93bnx8Zi5pc0RlZmF1bHRQcmV2ZW50ZWQoKSl7cmV0dXJufXRoaXMuaXNTaG93bj1mYWxzZTt0aGlzLmVzY2FwZSgpO2MoZG9jdW1lbnQpLm9mZigiZm9jdXNpbi5tb2RhbCIpO3RoaXMuJGVsZW1lbnQucmVtb3ZlQ2xhc3MoImluIikuYXR0cigiYXJpYS1oaWRkZW4iLHRydWUpO2Muc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJmYWRlIik/dGhpcy5oaWRlV2l0aFRyYW5zaXRpb24oKTp0aGlzLmhpZGVNb2RhbCgpfSxlbmZvcmNlRm9jdXM6ZnVuY3Rpb24oKXt2YXIgZD10aGlzO2MoZG9jdW1lbnQpLm9uKCJmb2N1c2luLm1vZGFsIixmdW5jdGlvbihmKXtpZihkLiRlbGVtZW50WzBdIT09Zi50YXJnZXQmJiFkLiRlbGVtZW50LmhhcyhmLnRhcmdldCkubGVuZ3RoKXtkLiRlbGVtZW50LmZvY3VzKCl9fSl9LGVzY2FwZTpmdW5jdGlvbigpe3ZhciBkPXRoaXM7aWYodGhpcy5pc1Nob3duJiZ0aGlzLm9wdGlvbnMua2V5Ym9hcmQpe3RoaXMuJGVsZW1lbnQub24oImtleXVwLmRpc21pc3MubW9kYWwiLGZ1bmN0aW9uKGYpe2Yud2hpY2g9PTI3JiZkLmhpZGUoKX0pfWVsc2V7aWYoIXRoaXMuaXNTaG93bil7dGhpcy4kZWxlbWVudC5vZmYoImtleXVwLmRpc21pc3MubW9kYWwiKX19fSxoaWRlV2l0aFRyYW5zaXRpb246ZnVuY3Rpb24oKXt2YXIgZD10aGlzLGU9c2V0VGltZW91dChmdW5jdGlvbigpe2QuJGVsZW1lbnQub2ZmKGMuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCk7ZC5oaWRlTW9kYWwoKX0sNTAwKTt0aGlzLiRlbGVtZW50Lm9uZShjLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZnVuY3Rpb24oKXtjbGVhclRpbWVvdXQoZSk7ZC5oaWRlTW9kYWwoKX0pfSxoaWRlTW9kYWw6ZnVuY3Rpb24oKXt2YXIgZD10aGlzO3RoaXMuJGVsZW1lbnQuaGlkZSgpO3RoaXMuYmFja2Ryb3AoZnVuY3Rpb24oKXtkLnJlbW92ZUJhY2tkcm9wKCk7ZC4kZWxlbWVudC50cmlnZ2VyKCJoaWRkZW4iKX0pfSxyZW1vdmVCYWNrZHJvcDpmdW5jdGlvbigpe3RoaXMuJGJhY2tkcm9wLnJlbW92ZSgpO3RoaXMuJGJhY2tkcm9wPW51bGx9LGJhY2tkcm9wOmZ1bmN0aW9uKGcpe3ZhciBmPXRoaXMsZT10aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJmYWRlIik/ImZhZGUiOiIiO2lmKHRoaXMuaXNTaG93biYmdGhpcy5vcHRpb25zLmJhY2tkcm9wKXt2YXIgZD1jLnN1cHBvcnQudHJhbnNpdGlvbiYmZTt0aGlzLiRiYWNrZHJvcD1jKCc8ZGl2IGNsYXNzPSJtb2RhbC1iYWNrZHJvcCAnK2UrJyIgLz4nKS5hcHBlbmRUbyhkb2N1bWVudC5ib2R5KTt0aGlzLiRiYWNrZHJvcC5jbGljayh0aGlzLm9wdGlvbnMuYmFja2Ryb3A9PSJzdGF0aWMiP2MucHJveHkodGhpcy4kZWxlbWVudFswXS5mb2N1cyx0aGlzLiRlbGVtZW50WzBdKTpjLnByb3h5KHRoaXMuaGlkZSx0aGlzKSk7aWYoZCl7dGhpcy4kYmFja2Ryb3BbMF0ub2Zmc2V0V2lkdGh9dGhpcy4kYmFja2Ryb3AuYWRkQ2xhc3MoImluIik7aWYoIWcpe3JldHVybn1kP3RoaXMuJGJhY2tkcm9wLm9uZShjLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZyk6ZygpfWVsc2V7aWYoIXRoaXMuaXNTaG93biYmdGhpcy4kYmFja2Ryb3Ape3RoaXMuJGJhY2tkcm9wLnJlbW92ZUNsYXNzKCJpbiIpO2Muc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJmYWRlIik/dGhpcy4kYmFja2Ryb3Aub25lKGMuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxnKTpnKCl9ZWxzZXtpZihnKXtnKCl9fX19fTt2YXIgYT1jLmZuLm1vZGFsO2MuZm4ubW9kYWw9ZnVuY3Rpb24oZCl7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciBnPWModGhpcyksZj1nLmRhdGEoIm1vZGFsIiksZT1jLmV4dGVuZCh7fSxjLmZuLm1vZGFsLmRlZmF1bHRzLGcuZGF0YSgpLHR5cGVvZiBkPT0ib2JqZWN0IiYmZCk7aWYoIWYpe2cuZGF0YSgibW9kYWwiLChmPW5ldyBiKHRoaXMsZSkpKX1pZih0eXBlb2YgZD09InN0cmluZyIpe2ZbZF0oKX1lbHNle2lmKGUuc2hvdyl7Zi5zaG93KCl9fX0pfTtjLmZuLm1vZGFsLmRlZmF1bHRzPXtiYWNrZHJvcDp0cnVlLGtleWJvYXJkOnRydWUsc2hvdzp0cnVlfTtjLmZuLm1vZGFsLkNvbnN0cnVjdG9yPWI7Yy5mbi5tb2RhbC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yy5mbi5tb2RhbD1hO3JldHVybiB0aGlzfTtjKGRvY3VtZW50KS5vbigiY2xpY2subW9kYWwuZGF0YS1hcGkiLCdbZGF0YS10b2dnbGU9Im1vZGFsIl0nLGZ1bmN0aW9uKGkpe3ZhciBoPWModGhpcyksZj1oLmF0dHIoImhyZWYiKSxkPWMoaC5hdHRyKCJkYXRhLXRhcmdldCIpfHwoZiYmZi5yZXBsYWNlKC8uKig/PSNbXlxzXSskKS8sIiIpKSksZz1kLmRhdGEoIm1vZGFsIik/InRvZ2dsZSI6Yy5leHRlbmQoe3JlbW90ZTohLyMvLnRlc3QoZikmJmZ9LGQuZGF0YSgpLGguZGF0YSgpKTtpLnByZXZlbnREZWZhdWx0KCk7ZC5tb2RhbChnKS5vbmUoImhpZGUiLGZ1bmN0aW9uKCl7aC5mb2N1cygpfSl9KX0od2luZG93LmpRdWVyeSk7IWZ1bmN0aW9uKGMpe3ZhciBiPWZ1bmN0aW9uKGUsZCl7dGhpcy5pbml0KCJ0b29sdGlwIixlLGQpfTtiLnByb3RvdHlwZT17Y29uc3RydWN0b3I6Yixpbml0OmZ1bmN0aW9uKGssaCxmKXt2YXIgbCxkLGosZSxnO3RoaXMudHlwZT1rO3RoaXMuJGVsZW1lbnQ9YyhoKTt0aGlzLm9wdGlvbnM9dGhpcy5nZXRPcHRpb25zKGYpO3RoaXMuZW5hYmxlZD10cnVlO2o9dGhpcy5vcHRpb25zLnRyaWdnZXIuc3BsaXQoIiAiKTtmb3IoZz1qLmxlbmd0aDtnLS07KXtlPWpbZ107aWYoZT09ImNsaWNrIil7dGhpcy4kZWxlbWVudC5vbigiY2xpY2suIit0aGlzLnR5cGUsdGhpcy5vcHRpb25zLnNlbGVjdG9yLGMucHJveHkodGhpcy50b2dnbGUsdGhpcykpfWVsc2V7aWYoZSE9Im1hbnVhbCIpe2w9ZT09ImhvdmVyIj8ibW91c2VlbnRlciI6ImZvY3VzIjtkPWU9PSJob3ZlciI/Im1vdXNlbGVhdmUiOiJibHVyIjt0aGlzLiRlbGVtZW50Lm9uKGwrIi4iK3RoaXMudHlwZSx0aGlzLm9wdGlvbnMuc2VsZWN0b3IsYy5wcm94eSh0aGlzLmVudGVyLHRoaXMpKTt0aGlzLiRlbGVtZW50Lm9uKGQrIi4iK3RoaXMudHlwZSx0aGlzLm9wdGlvbnMuc2VsZWN0b3IsYy5wcm94eSh0aGlzLmxlYXZlLHRoaXMpKX19fXRoaXMub3B0aW9ucy5zZWxlY3Rvcj8odGhpcy5fb3B0aW9ucz1jLmV4dGVuZCh7fSx0aGlzLm9wdGlvbnMse3RyaWdnZXI6Im1hbnVhbCIsc2VsZWN0b3I6IiJ9KSk6dGhpcy5maXhUaXRsZSgpfSxnZXRPcHRpb25zOmZ1bmN0aW9uKGQpe2Q9Yy5leHRlbmQoe30sYy5mblt0aGlzLnR5cGVdLmRlZmF1bHRzLHRoaXMuJGVsZW1lbnQuZGF0YSgpLGQpO2lmKGQuZGVsYXkmJnR5cGVvZiBkLmRlbGF5PT0ibnVtYmVyIil7ZC5kZWxheT17c2hvdzpkLmRlbGF5LGhpZGU6ZC5kZWxheX19cmV0dXJuIGR9LGVudGVyOmZ1bmN0aW9uKGYpe3ZhciBkPWMoZi5jdXJyZW50VGFyZ2V0KVt0aGlzLnR5cGVdKHRoaXMuX29wdGlvbnMpLmRhdGEodGhpcy50eXBlKTtpZih0aGlzLm9wdGlvbnMuc2VsZWN0b3Ipe2MuZXh0ZW5kKGQub3B0aW9ucyxkLmdldE9wdGlvbnMoKSl9aWYoIWQub3B0aW9ucy5kZWxheXx8IWQub3B0aW9ucy5kZWxheS5zaG93KXtyZXR1cm4gZC5zaG93KCl9Y2xlYXJUaW1lb3V0KHRoaXMudGltZW91dCk7ZC5ob3ZlclN0YXRlPSJpbiI7dGhpcy50aW1lb3V0PXNldFRpbWVvdXQoZnVuY3Rpb24oKXtpZihkLmhvdmVyU3RhdGU9PSJpbiIpe2Quc2hvdygpfX0sZC5vcHRpb25zLmRlbGF5LnNob3cpfSxsZWF2ZTpmdW5jdGlvbihmKXt2YXIgZD1jKGYuY3VycmVudFRhcmdldClbdGhpcy50eXBlXSh0aGlzLl9vcHRpb25zKS5kYXRhKHRoaXMudHlwZSk7aWYodGhpcy50aW1lb3V0KXtjbGVhclRpbWVvdXQodGhpcy50aW1lb3V0KX1pZih0aGlzLm9wdGlvbnMuc2VsZWN0b3Ipe2MuZXh0ZW5kKGQub3B0aW9ucyxkLmdldE9wdGlvbnMoKSl9aWYoIWQub3B0aW9ucy5kZWxheXx8IWQub3B0aW9ucy5kZWxheS5oaWRlKXtyZXR1cm4gZC5oaWRlKCl9ZC5ob3ZlclN0YXRlPSJvdXQiO3RoaXMudGltZW91dD1zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7aWYoZC5ob3ZlclN0YXRlPT0ib3V0Iil7ZC5oaWRlKCl9fSxkLm9wdGlvbnMuZGVsYXkuaGlkZSl9LHNob3c6ZnVuY3Rpb24oKXt2YXIgaSxrLGcsaixkLGgsZj1jLkV2ZW50KCJzaG93Iik7aWYodGhpcy5oYXNDb250ZW50KCkmJnRoaXMuZW5hYmxlZCl7dGhpcy4kZWxlbWVudC50cmlnZ2VyKGYpO2lmKGYuaXNEZWZhdWx0UHJldmVudGVkKCkpe3JldHVybn1pPXRoaXMudGlwKCk7dGhpcy5zZXRDb250ZW50KCk7aWYodGhpcy5vcHRpb25zLmFuaW1hdGlvbil7aS5hZGRDbGFzcygiZmFkZSIpfWQ9dHlwZW9mIHRoaXMub3B0aW9ucy5wbGFjZW1lbnQ9PSJmdW5jdGlvbiI/dGhpcy5vcHRpb25zLnBsYWNlbWVudC5jYWxsKHRoaXMsaVswXSx0aGlzLiRlbGVtZW50WzBdKTp0aGlzLm9wdGlvbnMucGxhY2VtZW50O2kuZGV0YWNoKCkuY3NzKHt0b3A6MCxsZWZ0OjAsZGlzcGxheToiYmxvY2sifSk7dGhpcy5vcHRpb25zLmNvbnRhaW5lcj9pLmFwcGVuZFRvKHRoaXMub3B0aW9ucy5jb250YWluZXIpOmkuaW5zZXJ0QWZ0ZXIodGhpcy4kZWxlbWVudCk7az10aGlzLmdldFBvc2l0aW9uKCk7Zz1pWzBdLm9mZnNldFdpZHRoO2o9aVswXS5vZmZzZXRIZWlnaHQ7c3dpdGNoKGQpe2Nhc2UiYm90dG9tIjpoPXt0b3A6ay50b3Aray5oZWlnaHQsbGVmdDprLmxlZnQray53aWR0aC8yLWcvMn07YnJlYWs7Y2FzZSJ0b3AiOmg9e3RvcDprLnRvcC1qLGxlZnQ6ay5sZWZ0K2sud2lkdGgvMi1nLzJ9O2JyZWFrO2Nhc2UibGVmdCI6aD17dG9wOmsudG9wK2suaGVpZ2h0LzItai8yLGxlZnQ6ay5sZWZ0LWd9O2JyZWFrO2Nhc2UicmlnaHQiOmg9e3RvcDprLnRvcCtrLmhlaWdodC8yLWovMixsZWZ0OmsubGVmdCtrLndpZHRofTticmVha310aGlzLmFwcGx5UGxhY2VtZW50KGgsZCk7dGhpcy4kZWxlbWVudC50cmlnZ2VyKCJzaG93biIpfX0sYXBwbHlQbGFjZW1lbnQ6ZnVuY3Rpb24oZyxoKXt2YXIgaT10aGlzLnRpcCgpLGU9aVswXS5vZmZzZXRXaWR0aCxsPWlbMF0ub2Zmc2V0SGVpZ2h0LGQsaixrLGY7aS5vZmZzZXQoZykuYWRkQ2xhc3MoaCkuYWRkQ2xhc3MoImluIik7ZD1pWzBdLm9mZnNldFdpZHRoO2o9aVswXS5vZmZzZXRIZWlnaHQ7aWYoaD09InRvcCImJmohPWwpe2cudG9wPWcudG9wK2wtajtmPXRydWV9aWYoaD09ImJvdHRvbSJ8fGg9PSJ0b3AiKXtrPTA7aWYoZy5sZWZ0PDApe2s9Zy5sZWZ0Ki0yO2cubGVmdD0wO2kub2Zmc2V0KGcpO2Q9aVswXS5vZmZzZXRXaWR0aDtqPWlbMF0ub2Zmc2V0SGVpZ2h0fXRoaXMucmVwbGFjZUFycm93KGstZStkLGQsImxlZnQiKX1lbHNle3RoaXMucmVwbGFjZUFycm93KGotbCxqLCJ0b3AiKX1pZihmKXtpLm9mZnNldChnKX19LHJlcGxhY2VBcnJvdzpmdW5jdGlvbihmLGUsZCl7dGhpcy5hcnJvdygpLmNzcyhkLGY/KDUwKigxLWYvZSkrIiUiKToiIil9LHNldENvbnRlbnQ6ZnVuY3Rpb24oKXt2YXIgZT10aGlzLnRpcCgpLGQ9dGhpcy5nZXRUaXRsZSgpO2UuZmluZCgiLnRvb2x0aXAtaW5uZXIiKVt0aGlzLm9wdGlvbnMuaHRtbD8iaHRtbCI6InRleHQiXShkKTtlLnJlbW92ZUNsYXNzKCJmYWRlIGluIHRvcCBib3R0b20gbGVmdCByaWdodCIpfSxoaWRlOmZ1bmN0aW9uKCl7dmFyIGQ9dGhpcyxnPXRoaXMudGlwKCksZj1jLkV2ZW50KCJoaWRlIik7dGhpcy4kZWxlbWVudC50cmlnZ2VyKGYpO2lmKGYuaXNEZWZhdWx0UHJldmVudGVkKCkpe3JldHVybn1nLnJlbW92ZUNsYXNzKCJpbiIpO2Z1bmN0aW9uIGgoKXt2YXIgZT1zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7Zy5vZmYoYy5zdXBwb3J0LnRyYW5zaXRpb24uZW5kKS5kZXRhY2goKX0sNTAwKTtnLm9uZShjLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZnVuY3Rpb24oKXtjbGVhclRpbWVvdXQoZSk7Zy5kZXRhY2goKX0pfWMuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiR0aXAuaGFzQ2xhc3MoImZhZGUiKT9oKCk6Zy5kZXRhY2goKTt0aGlzLiRlbGVtZW50LnRyaWdnZXIoImhpZGRlbiIpO3JldHVybiB0aGlzfSxmaXhUaXRsZTpmdW5jdGlvbigpe3ZhciBkPXRoaXMuJGVsZW1lbnQ7aWYoZC5hdHRyKCJ0aXRsZSIpfHx0eXBlb2YoZC5hdHRyKCJkYXRhLW9yaWdpbmFsLXRpdGxlIikpIT0ic3RyaW5nIil7ZC5hdHRyKCJkYXRhLW9yaWdpbmFsLXRpdGxlIixkLmF0dHIoInRpdGxlIil8fCIiKS5hdHRyKCJ0aXRsZSIsIiIpfX0saGFzQ29udGVudDpmdW5jdGlvbigpe3JldHVybiB0aGlzLmdldFRpdGxlKCl9LGdldFBvc2l0aW9uOmZ1bmN0aW9uKCl7dmFyIGQ9dGhpcy4kZWxlbWVudFswXTtyZXR1cm4gYy5leHRlbmQoe30sKHR5cGVvZiBkLmdldEJvdW5kaW5nQ2xpZW50UmVjdD09ImZ1bmN0aW9uIik/ZC5nZXRCb3VuZGluZ0NsaWVudFJlY3QoKTp7d2lkdGg6ZC5vZmZzZXRXaWR0aCxoZWlnaHQ6ZC5vZmZzZXRIZWlnaHR9LHRoaXMuJGVsZW1lbnQub2Zmc2V0KCkpfSxnZXRUaXRsZTpmdW5jdGlvbigpe3ZhciBmLGQ9dGhpcy4kZWxlbWVudCxlPXRoaXMub3B0aW9ucztmPWQuYXR0cigiZGF0YS1vcmlnaW5hbC10aXRsZSIpfHwodHlwZW9mIGUudGl0bGU9PSJmdW5jdGlvbiI/ZS50aXRsZS5jYWxsKGRbMF0pOmUudGl0bGUpO3JldHVybiBmfSx0aXA6ZnVuY3Rpb24oKXtyZXR1cm4gdGhpcy4kdGlwPXRoaXMuJHRpcHx8Yyh0aGlzLm9wdGlvbnMudGVtcGxhdGUpfSxhcnJvdzpmdW5jdGlvbigpe3JldHVybiB0aGlzLiRhcnJvdz10aGlzLiRhcnJvd3x8dGhpcy50aXAoKS5maW5kKCIudG9vbHRpcC1hcnJvdyIpfSx2YWxpZGF0ZTpmdW5jdGlvbigpe2lmKCF0aGlzLiRlbGVtZW50WzBdLnBhcmVudE5vZGUpe3RoaXMuaGlkZSgpO3RoaXMuJGVsZW1lbnQ9bnVsbDt0aGlzLm9wdGlvbnM9bnVsbH19LGVuYWJsZTpmdW5jdGlvbigpe3RoaXMuZW5hYmxlZD10cnVlfSxkaXNhYmxlOmZ1bmN0aW9uKCl7dGhpcy5lbmFibGVkPWZhbHNlfSx0b2dnbGVFbmFibGVkOmZ1bmN0aW9uKCl7dGhpcy5lbmFibGVkPSF0aGlzLmVuYWJsZWR9LHRvZ2dsZTpmdW5jdGlvbihmKXt2YXIgZD1mP2MoZi5jdXJyZW50VGFyZ2V0KVt0aGlzLnR5cGVdKHRoaXMuX29wdGlvbnMpLmRhdGEodGhpcy50eXBlKTp0aGlzO2QudGlwKCkuaGFzQ2xhc3MoImluIik/ZC5oaWRlKCk6ZC5zaG93KCl9LGRlc3Ryb3k6ZnVuY3Rpb24oKXt0aGlzLmhpZGUoKS4kZWxlbWVudC5vZmYoIi4iK3RoaXMudHlwZSkucmVtb3ZlRGF0YSh0aGlzLnR5cGUpfX07dmFyIGE9Yy5mbi50b29sdGlwO2MuZm4udG9vbHRpcD1mdW5jdGlvbihkKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyIGc9Yyh0aGlzKSxmPWcuZGF0YSgidG9vbHRpcCIpLGU9dHlwZW9mIGQ9PSJvYmplY3QiJiZkO2lmKCFmKXtnLmRhdGEoInRvb2x0aXAiLChmPW5ldyBiKHRoaXMsZSkpKX1pZih0eXBlb2YgZD09InN0cmluZyIpe2ZbZF0oKX19KX07Yy5mbi50b29sdGlwLkNvbnN0cnVjdG9yPWI7Yy5mbi50b29sdGlwLmRlZmF1bHRzPXthbmltYXRpb246dHJ1ZSxwbGFjZW1lbnQ6InRvcCIsc2VsZWN0b3I6ZmFsc2UsdGVtcGxhdGU6JzxkaXYgY2xhc3M9InRvb2x0aXAiPjxkaXYgY2xhc3M9InRvb2x0aXAtYXJyb3ciPjwvZGl2PjxkaXYgY2xhc3M9InRvb2x0aXAtaW5uZXIiPjwvZGl2PjwvZGl2PicsdHJpZ2dlcjoiaG92ZXIgZm9jdXMiLHRpdGxlOiIiLGRlbGF5OjAsaHRtbDpmYWxzZSxjb250YWluZXI6ZmFsc2V9O2MuZm4udG9vbHRpcC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yy5mbi50b29sdGlwPWE7cmV0dXJuIHRoaXN9fSh3aW5kb3cualF1ZXJ5KTshZnVuY3Rpb24oYyl7dmFyIGI9ZnVuY3Rpb24oZSxkKXt0aGlzLmluaXQoInBvcG92ZXIiLGUsZCl9O2IucHJvdG90eXBlPWMuZXh0ZW5kKHt9LGMuZm4udG9vbHRpcC5Db25zdHJ1Y3Rvci5wcm90b3R5cGUse2NvbnN0cnVjdG9yOmIsc2V0Q29udGVudDpmdW5jdGlvbigpe3ZhciBmPXRoaXMudGlwKCksZT10aGlzLmdldFRpdGxlKCksZD10aGlzLmdldENvbnRlbnQoKTtmLmZpbmQoIi5wb3BvdmVyLXRpdGxlIilbdGhpcy5vcHRpb25zLmh0bWw/Imh0bWwiOiJ0ZXh0Il0oZSk7Zi5maW5kKCIucG9wb3Zlci1jb250ZW50IilbdGhpcy5vcHRpb25zLmh0bWw/Imh0bWwiOiJ0ZXh0Il0oZCk7Zi5yZW1vdmVDbGFzcygiZmFkZSB0b3AgYm90dG9tIGxlZnQgcmlnaHQgaW4iKX0saGFzQ29udGVudDpmdW5jdGlvbigpe3JldHVybiB0aGlzLmdldFRpdGxlKCl8fHRoaXMuZ2V0Q29udGVudCgpfSxnZXRDb250ZW50OmZ1bmN0aW9uKCl7dmFyIGUsZD10aGlzLiRlbGVtZW50LGY9dGhpcy5vcHRpb25zO2U9KHR5cGVvZiBmLmNvbnRlbnQ9PSJmdW5jdGlvbiI/Zi5jb250ZW50LmNhbGwoZFswXSk6Zi5jb250ZW50KXx8ZC5hdHRyKCJkYXRhLWNvbnRlbnQiKTtyZXR1cm4gZX0sdGlwOmZ1bmN0aW9uKCl7aWYoIXRoaXMuJHRpcCl7dGhpcy4kdGlwPWModGhpcy5vcHRpb25zLnRlbXBsYXRlKX1yZXR1cm4gdGhpcy4kdGlwfSxkZXN0cm95OmZ1bmN0aW9uKCl7dGhpcy5oaWRlKCkuJGVsZW1lbnQub2ZmKCIuIit0aGlzLnR5cGUpLnJlbW92ZURhdGEodGhpcy50eXBlKX19KTt2YXIgYT1jLmZuLnBvcG92ZXI7Yy5mbi5wb3BvdmVyPWZ1bmN0aW9uKGQpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZz1jKHRoaXMpLGY9Zy5kYXRhKCJwb3BvdmVyIiksZT10eXBlb2YgZD09Im9iamVjdCImJmQ7aWYoIWYpe2cuZGF0YSgicG9wb3ZlciIsKGY9bmV3IGIodGhpcyxlKSkpfWlmKHR5cGVvZiBkPT0ic3RyaW5nIil7ZltkXSgpfX0pfTtjLmZuLnBvcG92ZXIuQ29uc3RydWN0b3I9YjtjLmZuLnBvcG92ZXIuZGVmYXVsdHM9Yy5leHRlbmQoe30sYy5mbi50b29sdGlwLmRlZmF1bHRzLHtwbGFjZW1lbnQ6InJpZ2h0Iix0cmlnZ2VyOiJjbGljayIsY29udGVudDoiIix0ZW1wbGF0ZTonPGRpdiBjbGFzcz0icG9wb3ZlciI+PGRpdiBjbGFzcz0iYXJyb3ciPjwvZGl2PjxoMyBjbGFzcz0icG9wb3Zlci10aXRsZSI+PC9oMz48ZGl2IGNsYXNzPSJwb3BvdmVyLWNvbnRlbnQiPjwvZGl2PjwvZGl2Pid9KTtjLmZuLnBvcG92ZXIubm9Db25mbGljdD1mdW5jdGlvbigpe2MuZm4ucG9wb3Zlcj1hO3JldHVybiB0aGlzfX0od2luZG93LmpRdWVyeSk7IWZ1bmN0aW9uKGMpe2Z1bmN0aW9uIGIoZyxmKXt2YXIgaD1jLnByb3h5KHRoaXMucHJvY2Vzcyx0aGlzKSxkPWMoZykuaXMoImJvZHkiKT9jKHdpbmRvdyk6YyhnKSxlO3RoaXMub3B0aW9ucz1jLmV4dGVuZCh7fSxjLmZuLnNjcm9sbHNweS5kZWZhdWx0cyxmKTt0aGlzLiRzY3JvbGxFbGVtZW50PWQub24oInNjcm9sbC5zY3JvbGwtc3B5LmRhdGEtYXBpIixoKTt0aGlzLnNlbGVjdG9yPSh0aGlzLm9wdGlvbnMudGFyZ2V0fHwoKGU9YyhnKS5hdHRyKCJocmVmIikpJiZlLnJlcGxhY2UoLy4qKD89I1teXHNdKyQpLywiIikpfHwiIikrIiAubmF2IGxpID4gYSI7dGhpcy4kYm9keT1jKCJib2R5Iik7dGhpcy5yZWZyZXNoKCk7dGhpcy5wcm9jZXNzKCl9Yi5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOmIscmVmcmVzaDpmdW5jdGlvbigpe3ZhciBkPXRoaXMsZTt0aGlzLm9mZnNldHM9YyhbXSk7dGhpcy50YXJnZXRzPWMoW10pO2U9dGhpcy4kYm9keS5maW5kKHRoaXMuc2VsZWN0b3IpLm1hcChmdW5jdGlvbigpe3ZhciBnPWModGhpcyksZj1nLmRhdGEoInRhcmdldCIpfHxnLmF0dHIoImhyZWYiKSxoPS9eI1x3Ly50ZXN0KGYpJiZjKGYpO3JldHVybihoJiZoLmxlbmd0aCYmW1toLnBvc2l0aW9uKCkudG9wKyghYy5pc1dpbmRvdyhkLiRzY3JvbGxFbGVtZW50LmdldCgwKSkmJmQuJHNjcm9sbEVsZW1lbnQuc2Nyb2xsVG9wKCkpLGZdXSl8fG51bGx9KS5zb3J0KGZ1bmN0aW9uKGcsZil7cmV0dXJuIGdbMF0tZlswXX0pLmVhY2goZnVuY3Rpb24oKXtkLm9mZnNldHMucHVzaCh0aGlzWzBdKTtkLnRhcmdldHMucHVzaCh0aGlzWzFdKX0pfSxwcm9jZXNzOmZ1bmN0aW9uKCl7dmFyIGo9dGhpcy4kc2Nyb2xsRWxlbWVudC5zY3JvbGxUb3AoKSt0aGlzLm9wdGlvbnMub2Zmc2V0LGY9dGhpcy4kc2Nyb2xsRWxlbWVudFswXS5zY3JvbGxIZWlnaHR8fHRoaXMuJGJvZHlbMF0uc2Nyb2xsSGVpZ2h0LGg9Zi10aGlzLiRzY3JvbGxFbGVtZW50LmhlaWdodCgpLGc9dGhpcy5vZmZzZXRzLGQ9dGhpcy50YXJnZXRzLGs9dGhpcy5hY3RpdmVUYXJnZXQsZTtpZihqPj1oKXtyZXR1cm4gayE9KGU9ZC5sYXN0KClbMF0pJiZ0aGlzLmFjdGl2YXRlKGUpfWZvcihlPWcubGVuZ3RoO2UtLTspe2shPWRbZV0mJmo+PWdbZV0mJighZ1tlKzFdfHxqPD1nW2UrMV0pJiZ0aGlzLmFjdGl2YXRlKGRbZV0pfX0sYWN0aXZhdGU6ZnVuY3Rpb24oZil7dmFyIGUsZDt0aGlzLmFjdGl2ZVRhcmdldD1mO2ModGhpcy5zZWxlY3RvcikucGFyZW50KCIuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpO2Q9dGhpcy5zZWxlY3RvcisnW2RhdGEtdGFyZ2V0PSInK2YrJyJdLCcrdGhpcy5zZWxlY3RvcisnW2hyZWY9IicrZisnIl0nO2U9YyhkKS5wYXJlbnQoImxpIikuYWRkQ2xhc3MoImFjdGl2ZSIpO2lmKGUucGFyZW50KCIuZHJvcGRvd24tbWVudSIpLmxlbmd0aCl7ZT1lLmNsb3Nlc3QoImxpLmRyb3Bkb3duIikuYWRkQ2xhc3MoImFjdGl2ZSIpfWUudHJpZ2dlcigiYWN0aXZhdGUiKX19O3ZhciBhPWMuZm4uc2Nyb2xsc3B5O2MuZm4uc2Nyb2xsc3B5PWZ1bmN0aW9uKGQpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZz1jKHRoaXMpLGY9Zy5kYXRhKCJzY3JvbGxzcHkiKSxlPXR5cGVvZiBkPT0ib2JqZWN0IiYmZDtpZighZil7Zy5kYXRhKCJzY3JvbGxzcHkiLChmPW5ldyBiKHRoaXMsZSkpKX1pZih0eXBlb2YgZD09InN0cmluZyIpe2ZbZF0oKX19KX07Yy5mbi5zY3JvbGxzcHkuQ29uc3RydWN0b3I9YjtjLmZuLnNjcm9sbHNweS5kZWZhdWx0cz17b2Zmc2V0OjEwfTtjLmZuLnNjcm9sbHNweS5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yy5mbi5zY3JvbGxzcHk9YTtyZXR1cm4gdGhpc307Yyh3aW5kb3cpLm9uKCJsb2FkIixmdW5jdGlvbigpe2MoJ1tkYXRhLXNweT0ic2Nyb2xsIl0nKS5lYWNoKGZ1bmN0aW9uKCl7dmFyIGQ9Yyh0aGlzKTtkLnNjcm9sbHNweShkLmRhdGEoKSl9KX0pfSh3aW5kb3cualF1ZXJ5KTshZnVuY3Rpb24oYyl7dmFyIGI9ZnVuY3Rpb24oZCl7dGhpcy5lbGVtZW50PWMoZCl9O2IucHJvdG90eXBlPXtjb25zdHJ1Y3RvcjpiLHNob3c6ZnVuY3Rpb24oKXt2YXIgaj10aGlzLmVsZW1lbnQsZz1qLmNsb3Nlc3QoInVsOm5vdCguZHJvcGRvd24tbWVudSkiKSxmPWouYXR0cigiZGF0YS10YXJnZXQiKSxoLGQsaTtpZighZil7Zj1qLmF0dHIoImhyZWYiKTtmPWYmJmYucmVwbGFjZSgvLiooPz0jW15cc10qJCkvLCIiKX1pZihqLnBhcmVudCgibGkiKS5oYXNDbGFzcygiYWN0aXZlIikpe3JldHVybn1oPWcuZmluZCgiLmFjdGl2ZTpsYXN0IGEiKVswXTtpPWMuRXZlbnQoInNob3ciLHtyZWxhdGVkVGFyZ2V0Omh9KTtqLnRyaWdnZXIoaSk7aWYoaS5pc0RlZmF1bHRQcmV2ZW50ZWQoKSl7cmV0dXJufWQ9YyhmKTt0aGlzLmFjdGl2YXRlKGoucGFyZW50KCJsaSIpLGcpO3RoaXMuYWN0aXZhdGUoZCxkLnBhcmVudCgpLGZ1bmN0aW9uKCl7ai50cmlnZ2VyKHt0eXBlOiJzaG93biIscmVsYXRlZFRhcmdldDpofSl9KX0sYWN0aXZhdGU6ZnVuY3Rpb24oZixlLGkpe3ZhciBkPWUuZmluZCgiPiAuYWN0aXZlIiksaD1pJiZjLnN1cHBvcnQudHJhbnNpdGlvbiYmZC5oYXNDbGFzcygiZmFkZSIpO2Z1bmN0aW9uIGcoKXtkLnJlbW92ZUNsYXNzKCJhY3RpdmUiKS5maW5kKCI+IC5kcm9wZG93bi1tZW51ID4gLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKTtmLmFkZENsYXNzKCJhY3RpdmUiKTtpZihoKXtmWzBdLm9mZnNldFdpZHRoO2YuYWRkQ2xhc3MoImluIil9ZWxzZXtmLnJlbW92ZUNsYXNzKCJmYWRlIil9aWYoZi5wYXJlbnQoIi5kcm9wZG93bi1tZW51Iikpe2YuY2xvc2VzdCgibGkuZHJvcGRvd24iKS5hZGRDbGFzcygiYWN0aXZlIil9aSYmaSgpfWg/ZC5vbmUoYy5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGcpOmcoKTtkLnJlbW92ZUNsYXNzKCJpbiIpfX07dmFyIGE9Yy5mbi50YWI7Yy5mbi50YWI9ZnVuY3Rpb24oZCl7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciBmPWModGhpcyksZT1mLmRhdGEoInRhYiIpO2lmKCFlKXtmLmRhdGEoInRhYiIsKGU9bmV3IGIodGhpcykpKX1pZih0eXBlb2YgZD09InN0cmluZyIpe2VbZF0oKX19KX07Yy5mbi50YWIuQ29uc3RydWN0b3I9YjtjLmZuLnRhYi5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yy5mbi50YWI9YTtyZXR1cm4gdGhpc307Yyhkb2N1bWVudCkub24oImNsaWNrLnRhYi5kYXRhLWFwaSIsJ1tkYXRhLXRvZ2dsZT0idGFiIl0sIFtkYXRhLXRvZ2dsZT0icGlsbCJdJyxmdW5jdGlvbihkKXtkLnByZXZlbnREZWZhdWx0KCk7Yyh0aGlzKS50YWIoInNob3ciKX0pfSh3aW5kb3cualF1ZXJ5KTshZnVuY3Rpb24oYil7dmFyIGM9ZnVuY3Rpb24oZSxkKXt0aGlzLiRlbGVtZW50PWIoZSk7dGhpcy5vcHRpb25zPWIuZXh0ZW5kKHt9LGIuZm4udHlwZWFoZWFkLmRlZmF1bHRzLGQpO3RoaXMubWF0Y2hlcj10aGlzLm9wdGlvbnMubWF0Y2hlcnx8dGhpcy5tYXRjaGVyO3RoaXMuc29ydGVyPXRoaXMub3B0aW9ucy5zb3J0ZXJ8fHRoaXMuc29ydGVyO3RoaXMuaGlnaGxpZ2h0ZXI9dGhpcy5vcHRpb25zLmhpZ2hsaWdodGVyfHx0aGlzLmhpZ2hsaWdodGVyO3RoaXMudXBkYXRlcj10aGlzLm9wdGlvbnMudXBkYXRlcnx8dGhpcy51cGRhdGVyO3RoaXMuc291cmNlPXRoaXMub3B0aW9ucy5zb3VyY2U7dGhpcy4kbWVudT1iKHRoaXMub3B0aW9ucy5tZW51KTt0aGlzLnNob3duPWZhbHNlO3RoaXMubGlzdGVuKCl9O2MucHJvdG90eXBlPXtjb25zdHJ1Y3RvcjpjLHNlbGVjdDpmdW5jdGlvbigpe3ZhciBkPXRoaXMuJG1lbnUuZmluZCgiLmFjdGl2ZSIpLmF0dHIoImRhdGEtdmFsdWUiKTt0aGlzLiRlbGVtZW50LnZhbCh0aGlzLnVwZGF0ZXIoZCkpLmNoYW5nZSgpO3JldHVybiB0aGlzLmhpZGUoKX0sdXBkYXRlcjpmdW5jdGlvbihkKXtyZXR1cm4gZH0sc2hvdzpmdW5jdGlvbigpe3ZhciBkPWIuZXh0ZW5kKHt9LHRoaXMuJGVsZW1lbnQucG9zaXRpb24oKSx7aGVpZ2h0OnRoaXMuJGVsZW1lbnRbMF0ub2Zmc2V0SGVpZ2h0fSk7dGhpcy4kbWVudS5pbnNlcnRBZnRlcih0aGlzLiRlbGVtZW50KS5jc3Moe3RvcDpkLnRvcCtkLmhlaWdodCxsZWZ0OmQubGVmdH0pLnNob3coKTt0aGlzLnNob3duPXRydWU7cmV0dXJuIHRoaXN9LGhpZGU6ZnVuY3Rpb24oKXt0aGlzLiRtZW51LmhpZGUoKTt0aGlzLnNob3duPWZhbHNlO3JldHVybiB0aGlzfSxsb29rdXA6ZnVuY3Rpb24oZSl7dmFyIGQ7dGhpcy5xdWVyeT10aGlzLiRlbGVtZW50LnZhbCgpO2lmKCF0aGlzLnF1ZXJ5fHx0aGlzLnF1ZXJ5Lmxlbmd0aDx0aGlzLm9wdGlvbnMubWluTGVuZ3RoKXtyZXR1cm4gdGhpcy5zaG93bj90aGlzLmhpZGUoKTp0aGlzfWQ9Yi5pc0Z1bmN0aW9uKHRoaXMuc291cmNlKT90aGlzLnNvdXJjZSh0aGlzLnF1ZXJ5LGIucHJveHkodGhpcy5wcm9jZXNzLHRoaXMpKTp0aGlzLnNvdXJjZTtyZXR1cm4gZD90aGlzLnByb2Nlc3MoZCk6dGhpc30scHJvY2VzczpmdW5jdGlvbihkKXt2YXIgZT10aGlzO2Q9Yi5ncmVwKGQsZnVuY3Rpb24oZil7cmV0dXJuIGUubWF0Y2hlcihmKX0pO2Q9dGhpcy5zb3J0ZXIoZCk7aWYoIWQubGVuZ3RoKXtyZXR1cm4gdGhpcy5zaG93bj90aGlzLmhpZGUoKTp0aGlzfXJldHVybiB0aGlzLnJlbmRlcihkLnNsaWNlKDAsdGhpcy5vcHRpb25zLml0ZW1zKSkuc2hvdygpfSxtYXRjaGVyOmZ1bmN0aW9uKGQpe3JldHVybiB+ZC50b0xvd2VyQ2FzZSgpLmluZGV4T2YodGhpcy5xdWVyeS50b0xvd2VyQ2FzZSgpKX0sc29ydGVyOmZ1bmN0aW9uKGYpe3ZhciBnPVtdLGU9W10sZD1bXSxoO3doaWxlKGg9Zi5zaGlmdCgpKXtpZighaC50b0xvd2VyQ2FzZSgpLmluZGV4T2YodGhpcy5xdWVyeS50b0xvd2VyQ2FzZSgpKSl7Zy5wdXNoKGgpfWVsc2V7aWYofmguaW5kZXhPZih0aGlzLnF1ZXJ5KSl7ZS5wdXNoKGgpfWVsc2V7ZC5wdXNoKGgpfX19cmV0dXJuIGcuY29uY2F0KGUsZCl9LGhpZ2hsaWdodGVyOmZ1bmN0aW9uKGQpe3ZhciBlPXRoaXMucXVlcnkucmVwbGFjZSgvW1wtXFtcXXt9KCkqKz8uLFxcXF4kfCNcc10vZywiXFwkJiIpO3JldHVybiBkLnJlcGxhY2UobmV3IFJlZ0V4cCgiKCIrZSsiKSIsImlnIiksZnVuY3Rpb24oZixnKXtyZXR1cm4iPHN0cm9uZz4iK2crIjwvc3Ryb25nPiJ9KX0scmVuZGVyOmZ1bmN0aW9uKGQpe3ZhciBlPXRoaXM7ZD1iKGQpLm1hcChmdW5jdGlvbihmLGcpe2Y9YihlLm9wdGlvbnMuaXRlbSkuYXR0cigiZGF0YS12YWx1ZSIsZyk7Zi5maW5kKCJhIikuaHRtbChlLmhpZ2hsaWdodGVyKGcpKTtyZXR1cm4gZlswXX0pO2QuZmlyc3QoKS5hZGRDbGFzcygiYWN0aXZlIik7dGhpcy4kbWVudS5odG1sKGQpO3JldHVybiB0aGlzfSxuZXh0OmZ1bmN0aW9uKGUpe3ZhciBmPXRoaXMuJG1lbnUuZmluZCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSxkPWYubmV4dCgpO2lmKCFkLmxlbmd0aCl7ZD1iKHRoaXMuJG1lbnUuZmluZCgibGkiKVswXSl9ZC5hZGRDbGFzcygiYWN0aXZlIil9LHByZXY6ZnVuY3Rpb24oZSl7dmFyIGY9dGhpcy4kbWVudS5maW5kKCIuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpLGQ9Zi5wcmV2KCk7aWYoIWQubGVuZ3RoKXtkPXRoaXMuJG1lbnUuZmluZCgibGkiKS5sYXN0KCl9ZC5hZGRDbGFzcygiYWN0aXZlIil9LGxpc3RlbjpmdW5jdGlvbigpe3RoaXMuJGVsZW1lbnQub24oImZvY3VzIixiLnByb3h5KHRoaXMuZm9jdXMsdGhpcykpLm9uKCJibHVyIixiLnByb3h5KHRoaXMuYmx1cix0aGlzKSkub24oImtleXByZXNzIixiLnByb3h5KHRoaXMua2V5cHJlc3MsdGhpcykpLm9uKCJrZXl1cCIsYi5wcm94eSh0aGlzLmtleXVwLHRoaXMpKTtpZih0aGlzLmV2ZW50U3VwcG9ydGVkKCJrZXlkb3duIikpe3RoaXMuJGVsZW1lbnQub24oImtleWRvd24iLGIucHJveHkodGhpcy5rZXlkb3duLHRoaXMpKX10aGlzLiRtZW51Lm9uKCJjbGljayIsYi5wcm94eSh0aGlzLmNsaWNrLHRoaXMpKS5vbigibW91c2VlbnRlciIsImxpIixiLnByb3h5KHRoaXMubW91c2VlbnRlcix0aGlzKSkub24oIm1vdXNlbGVhdmUiLCJsaSIsYi5wcm94eSh0aGlzLm1vdXNlbGVhdmUsdGhpcykpfSxldmVudFN1cHBvcnRlZDpmdW5jdGlvbihkKXt2YXIgZT1kIGluIHRoaXMuJGVsZW1lbnQ7aWYoIWUpe3RoaXMuJGVsZW1lbnQuc2V0QXR0cmlidXRlKGQsInJldHVybjsiKTtlPXR5cGVvZiB0aGlzLiRlbGVtZW50W2RdPT09ImZ1bmN0aW9uIn1yZXR1cm4gZX0sbW92ZTpmdW5jdGlvbihkKXtpZighdGhpcy5zaG93bil7cmV0dXJufXN3aXRjaChkLmtleUNvZGUpe2Nhc2UgOTpjYXNlIDEzOmNhc2UgMjc6ZC5wcmV2ZW50RGVmYXVsdCgpO2JyZWFrO2Nhc2UgMzg6ZC5wcmV2ZW50RGVmYXVsdCgpO3RoaXMucHJldigpO2JyZWFrO2Nhc2UgNDA6ZC5wcmV2ZW50RGVmYXVsdCgpO3RoaXMubmV4dCgpO2JyZWFrfWQuc3RvcFByb3BhZ2F0aW9uKCl9LGtleWRvd246ZnVuY3Rpb24oZCl7dGhpcy5zdXBwcmVzc0tleVByZXNzUmVwZWF0PX5iLmluQXJyYXkoZC5rZXlDb2RlLFs0MCwzOCw5LDEzLDI3XSk7dGhpcy5tb3ZlKGQpfSxrZXlwcmVzczpmdW5jdGlvbihkKXtpZih0aGlzLnN1cHByZXNzS2V5UHJlc3NSZXBlYXQpe3JldHVybn10aGlzLm1vdmUoZCl9LGtleXVwOmZ1bmN0aW9uKGQpe3N3aXRjaChkLmtleUNvZGUpe2Nhc2UgNDA6Y2FzZSAzODpjYXNlIDE2OmNhc2UgMTc6Y2FzZSAxODpicmVhaztjYXNlIDk6Y2FzZSAxMzppZighdGhpcy5zaG93bil7cmV0dXJufXRoaXMuc2VsZWN0KCk7YnJlYWs7Y2FzZSAyNzppZighdGhpcy5zaG93bil7cmV0dXJufXRoaXMuaGlkZSgpO2JyZWFrO2RlZmF1bHQ6dGhpcy5sb29rdXAoKX1kLnN0b3BQcm9wYWdhdGlvbigpO2QucHJldmVudERlZmF1bHQoKX0sZm9jdXM6ZnVuY3Rpb24oZCl7dGhpcy5mb2N1c2VkPXRydWV9LGJsdXI6ZnVuY3Rpb24oZCl7dGhpcy5mb2N1c2VkPWZhbHNlO2lmKCF0aGlzLm1vdXNlZG92ZXImJnRoaXMuc2hvd24pe3RoaXMuaGlkZSgpfX0sY2xpY2s6ZnVuY3Rpb24oZCl7ZC5zdG9wUHJvcGFnYXRpb24oKTtkLnByZXZlbnREZWZhdWx0KCk7dGhpcy5zZWxlY3QoKTt0aGlzLiRlbGVtZW50LmZvY3VzKCl9LG1vdXNlZW50ZXI6ZnVuY3Rpb24oZCl7dGhpcy5tb3VzZWRvdmVyPXRydWU7dGhpcy4kbWVudS5maW5kKCIuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpO2IoZC5jdXJyZW50VGFyZ2V0KS5hZGRDbGFzcygiYWN0aXZlIil9LG1vdXNlbGVhdmU6ZnVuY3Rpb24oZCl7dGhpcy5tb3VzZWRvdmVyPWZhbHNlO2lmKCF0aGlzLmZvY3VzZWQmJnRoaXMuc2hvd24pe3RoaXMuaGlkZSgpfX19O3ZhciBhPWIuZm4udHlwZWFoZWFkO2IuZm4udHlwZWFoZWFkPWZ1bmN0aW9uKGQpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZz1iKHRoaXMpLGY9Zy5kYXRhKCJ0eXBlYWhlYWQiKSxlPXR5cGVvZiBkPT0ib2JqZWN0IiYmZDtpZighZil7Zy5kYXRhKCJ0eXBlYWhlYWQiLChmPW5ldyBjKHRoaXMsZSkpKX1pZih0eXBlb2YgZD09InN0cmluZyIpe2ZbZF0oKX19KX07Yi5mbi50eXBlYWhlYWQuZGVmYXVsdHM9e3NvdXJjZTpbXSxpdGVtczo4LG1lbnU6Jzx1bCBjbGFzcz0idHlwZWFoZWFkIGRyb3Bkb3duLW1lbnUiPjwvdWw+JyxpdGVtOic8bGk+PGEgaHJlZj0iIyI+PC9hPjwvbGk+JyxtaW5MZW5ndGg6MX07Yi5mbi50eXBlYWhlYWQuQ29uc3RydWN0b3I9YztiLmZuLnR5cGVhaGVhZC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yi5mbi50eXBlYWhlYWQ9YTtyZXR1cm4gdGhpc307Yihkb2N1bWVudCkub24oImZvY3VzLnR5cGVhaGVhZC5kYXRhLWFwaSIsJ1tkYXRhLXByb3ZpZGU9InR5cGVhaGVhZCJdJyxmdW5jdGlvbihmKXt2YXIgZD1iKHRoaXMpO2lmKGQuZGF0YSgidHlwZWFoZWFkIikpe3JldHVybn1kLnR5cGVhaGVhZChkLmRhdGEoKSl9KX0od2luZG93LmpRdWVyeSk7IWZ1bmN0aW9uKGMpe3ZhciBiPWZ1bmN0aW9uKGUsZCl7dGhpcy5vcHRpb25zPWMuZXh0ZW5kKHt9LGMuZm4uYWZmaXguZGVmYXVsdHMsZCk7dGhpcy4kd2luZG93PWMod2luZG93KS5vbigic2Nyb2xsLmFmZml4LmRhdGEtYXBpIixjLnByb3h5KHRoaXMuY2hlY2tQb3NpdGlvbix0aGlzKSkub24oImNsaWNrLmFmZml4LmRhdGEtYXBpIixjLnByb3h5KGZ1bmN0aW9uKCl7c2V0VGltZW91dChjLnByb3h5KHRoaXMuY2hlY2tQb3NpdGlvbix0aGlzKSwxKX0sdGhpcykpO3RoaXMuJGVsZW1lbnQ9YyhlKTt0aGlzLmNoZWNrUG9zaXRpb24oKX07Yi5wcm90b3R5cGUuY2hlY2tQb3NpdGlvbj1mdW5jdGlvbigpe2lmKCF0aGlzLiRlbGVtZW50LmlzKCI6dmlzaWJsZSIpKXtyZXR1cm59dmFyIGg9Yyhkb2N1bWVudCkuaGVpZ2h0KCksaj10aGlzLiR3aW5kb3cuc2Nyb2xsVG9wKCksZD10aGlzLiRlbGVtZW50Lm9mZnNldCgpLGs9dGhpcy5vcHRpb25zLm9mZnNldCxmPWsuYm90dG9tLGc9ay50b3AsaT0iYWZmaXggYWZmaXgtdG9wIGFmZml4LWJvdHRvbSIsZTtpZih0eXBlb2YgayE9Im9iamVjdCIpe2Y9Zz1rfWlmKHR5cGVvZiBnPT0iZnVuY3Rpb24iKXtnPWsudG9wKCl9aWYodHlwZW9mIGY9PSJmdW5jdGlvbiIpe2Y9ay5ib3R0b20oKX1lPXRoaXMudW5waW4hPW51bGwmJihqK3RoaXMudW5waW48PWQudG9wKT9mYWxzZTpmIT1udWxsJiYoZC50b3ArdGhpcy4kZWxlbWVudC5oZWlnaHQoKT49aC1mKT8iYm90dG9tIjpnIT1udWxsJiZqPD1nPyJ0b3AiOmZhbHNlO2lmKHRoaXMuYWZmaXhlZD09PWUpe3JldHVybn10aGlzLmFmZml4ZWQ9ZTt0aGlzLnVucGluPWU9PSJib3R0b20iP2QudG9wLWo6bnVsbDt0aGlzLiRlbGVtZW50LnJlbW92ZUNsYXNzKGkpLmFkZENsYXNzKCJhZmZpeCIrKGU/Ii0iK2U6IiIpKX07dmFyIGE9Yy5mbi5hZmZpeDtjLmZuLmFmZml4PWZ1bmN0aW9uKGQpe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgZz1jKHRoaXMpLGY9Zy5kYXRhKCJhZmZpeCIpLGU9dHlwZW9mIGQ9PSJvYmplY3QiJiZkO2lmKCFmKXtnLmRhdGEoImFmZml4IiwoZj1uZXcgYih0aGlzLGUpKSl9aWYodHlwZW9mIGQ9PSJzdHJpbmciKXtmW2RdKCl9fSl9O2MuZm4uYWZmaXguQ29uc3RydWN0b3I9YjtjLmZuLmFmZml4LmRlZmF1bHRzPXtvZmZzZXQ6MH07Yy5mbi5hZmZpeC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7Yy5mbi5hZmZpeD1hO3JldHVybiB0aGlzfTtjKHdpbmRvdykub24oImxvYWQiLGZ1bmN0aW9uKCl7YygnW2RhdGEtc3B5PSJhZmZpeCJdJykuZWFjaChmdW5jdGlvbigpe3ZhciBlPWModGhpcyksZD1lLmRhdGEoKTtkLm9mZnNldD1kLm9mZnNldHx8e307ZC5vZmZzZXRCb3R0b20mJihkLm9mZnNldC5ib3R0b209ZC5vZmZzZXRCb3R0b20pO2Qub2Zmc2V0VG9wJiYoZC5vZmZzZXQudG9wPWQub2Zmc2V0VG9wKTtlLmFmZml4KGQpfSl9KX0od2luZG93LmpRdWVyeSk7';    	
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
    // Bootstrap v2.3.0	   
    $css =   'LyohDQogKiBCb290c3RyYXAgdjIuMy4wDQogKg0KICogQ29weXJpZ2h0IDIwMTIgVHdpdHRlciwgSW5jDQogKiBMaWNlbnNlZCB1bmRlciB0aGUgQXBhY2hlIExpY2Vuc2UgdjIuMA0KICogaHR0cDovL3d3dy5hcGFjaGUub3JnL2xpY2Vuc2VzL0xJQ0VOU0UtMi4wDQogKg0KICogRGVzaWduZWQgYW5kIGJ1aWx0IHdpdGggYWxsIHRoZSBsb3ZlIGluIHRoZSB3b3JsZCBAdHdpdHRlciBieSBAbWRvIGFuZCBAZmF0Lg0KICovLmNsZWFyZml4eyp6b29tOjF9LmNsZWFyZml4OmJlZm9yZSwuY2xlYXJmaXg6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LmNsZWFyZml4OmFmdGVye2NsZWFyOmJvdGh9LmhpZGUtdGV4dHtmb250OjAvMCBhO2NvbG9yOnRyYW5zcGFyZW50O3RleHQtc2hhZG93Om5vbmU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXI6MH0uaW5wdXQtYmxvY2stbGV2ZWx7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3h9YXJ0aWNsZSxhc2lkZSxkZXRhaWxzLGZpZ2NhcHRpb24sZmlndXJlLGZvb3RlcixoZWFkZXIsaGdyb3VwLG5hdixzZWN0aW9ue2Rpc3BsYXk6YmxvY2t9YXVkaW8sY2FudmFzLHZpZGVve2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxfWF1ZGlvOm5vdChbY29udHJvbHNdKXtkaXNwbGF5Om5vbmV9aHRtbHtmb250LXNpemU6MTAwJTstd2Via2l0LXRleHQtc2l6ZS1hZGp1c3Q6MTAwJTstbXMtdGV4dC1zaXplLWFkanVzdDoxMDAlfWE6Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHh9YTpob3ZlcixhOmFjdGl2ZXtvdXRsaW5lOjB9c3ViLHN1cHtwb3NpdGlvbjpyZWxhdGl2ZTtmb250LXNpemU6NzUlO2xpbmUtaGVpZ2h0OjA7dmVydGljYWwtYWxpZ246YmFzZWxpbmV9c3Vwe3RvcDotMC41ZW19c3Vie2JvdHRvbTotMC4yNWVtfWltZ3t3aWR0aDphdXRvXDk7aGVpZ2h0OmF1dG87bWF4LXdpZHRoOjEwMCU7dmVydGljYWwtYWxpZ246bWlkZGxlO2JvcmRlcjowOy1tcy1pbnRlcnBvbGF0aW9uLW1vZGU6YmljdWJpY30jbWFwX2NhbnZhcyBpbWcsLmdvb2dsZS1tYXBzIGltZ3ttYXgtd2lkdGg6bm9uZX1idXR0b24saW5wdXQsc2VsZWN0LHRleHRhcmVhe21hcmdpbjowO2ZvbnQtc2l6ZToxMDAlO3ZlcnRpY2FsLWFsaWduOm1pZGRsZX1idXR0b24saW5wdXR7Km92ZXJmbG93OnZpc2libGU7bGluZS1oZWlnaHQ6bm9ybWFsfWJ1dHRvbjo6LW1vei1mb2N1cy1pbm5lcixpbnB1dDo6LW1vei1mb2N1cy1pbm5lcntwYWRkaW5nOjA7Ym9yZGVyOjB9YnV0dG9uLGh0bWwgaW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXXtjdXJzb3I6cG9pbnRlcjstd2Via2l0LWFwcGVhcmFuY2U6YnV0dG9ufWxhYmVsLHNlbGVjdCxidXR0b24saW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXSxpbnB1dFt0eXBlPSJyYWRpbyJdLGlucHV0W3R5cGU9ImNoZWNrYm94Il17Y3Vyc29yOnBvaW50ZXJ9aW5wdXRbdHlwZT0ic2VhcmNoIl17LXdlYmtpdC1ib3gtc2l6aW5nOmNvbnRlbnQtYm94Oy1tb3otYm94LXNpemluZzpjb250ZW50LWJveDtib3gtc2l6aW5nOmNvbnRlbnQtYm94Oy13ZWJraXQtYXBwZWFyYW5jZTp0ZXh0ZmllbGR9aW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWRlY29yYXRpb24saW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWNhbmNlbC1idXR0b257LXdlYmtpdC1hcHBlYXJhbmNlOm5vbmV9dGV4dGFyZWF7b3ZlcmZsb3c6YXV0bzt2ZXJ0aWNhbC1hbGlnbjp0b3B9QG1lZGlhIHByaW50eyp7Y29sb3I6IzAwMCFpbXBvcnRhbnQ7dGV4dC1zaGFkb3c6bm9uZSFpbXBvcnRhbnQ7YmFja2dyb3VuZDp0cmFuc3BhcmVudCFpbXBvcnRhbnQ7Ym94LXNoYWRvdzpub25lIWltcG9ydGFudH1hLGE6dmlzaXRlZHt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lfWFbaHJlZl06YWZ0ZXJ7Y29udGVudDoiICgiIGF0dHIoaHJlZikgIikifWFiYnJbdGl0bGVdOmFmdGVye2NvbnRlbnQ6IiAoIiBhdHRyKHRpdGxlKSAiKSJ9LmlyIGE6YWZ0ZXIsYVtocmVmXj0iamF2YXNjcmlwdDoiXTphZnRlcixhW2hyZWZePSIjIl06YWZ0ZXJ7Y29udGVudDoiIn1wcmUsYmxvY2txdW90ZXtib3JkZXI6MXB4IHNvbGlkICM5OTk7cGFnZS1icmVhay1pbnNpZGU6YXZvaWR9dGhlYWR7ZGlzcGxheTp0YWJsZS1oZWFkZXItZ3JvdXB9dHIsaW1ne3BhZ2UtYnJlYWstaW5zaWRlOmF2b2lkfWltZ3ttYXgtd2lkdGg6MTAwJSFpbXBvcnRhbnR9QHBhZ2V7bWFyZ2luOi41Y219cCxoMixoM3tvcnBoYW5zOjM7d2lkb3dzOjN9aDIsaDN7cGFnZS1icmVhay1hZnRlcjphdm9pZH19Ym9keXttYXJnaW46MDtmb250LWZhbWlseToiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxBcmlhbCxzYW5zLXNlcmlmO2ZvbnQtc2l6ZToxNHB4O2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6IzMzMztiYWNrZ3JvdW5kLWNvbG9yOiNmZmZ9YXtjb2xvcjojMDhjO3RleHQtZGVjb3JhdGlvbjpub25lfWE6aG92ZXIsYTpmb2N1c3tjb2xvcjojMDA1NTgwO3RleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmV9LmltZy1yb3VuZGVkey13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweH0uaW1nLXBvbGFyb2lke3BhZGRpbmc6NHB4O2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MXB4IHNvbGlkICNjY2M7Ym9yZGVyOjFweCBzb2xpZCByZ2JhKDAsMCwwLDAuMik7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsMCwwLDAuMSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsMCwwLDAuMSk7Ym94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLDAsMCwwLjEpfS5pbWctY2lyY2xley13ZWJraXQtYm9yZGVyLXJhZGl1czo1MDBweDstbW96LWJvcmRlci1yYWRpdXM6NTAwcHg7Ym9yZGVyLXJhZGl1czo1MDBweH0ucm93e21hcmdpbi1sZWZ0Oi0yMHB4Oyp6b29tOjF9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93OmFmdGVye2NsZWFyOmJvdGh9W2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MjBweH0uY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDo5NDBweH0uc3BhbjEye3dpZHRoOjk0MHB4fS5zcGFuMTF7d2lkdGg6ODYwcHh9LnNwYW4xMHt3aWR0aDo3ODBweH0uc3Bhbjl7d2lkdGg6NzAwcHh9LnNwYW44e3dpZHRoOjYyMHB4fS5zcGFuN3t3aWR0aDo1NDBweH0uc3BhbjZ7d2lkdGg6NDYwcHh9LnNwYW41e3dpZHRoOjM4MHB4fS5zcGFuNHt3aWR0aDozMDBweH0uc3BhbjN7d2lkdGg6MjIwcHh9LnNwYW4ye3dpZHRoOjE0MHB4fS5zcGFuMXt3aWR0aDo2MHB4fS5vZmZzZXQxMnttYXJnaW4tbGVmdDo5ODBweH0ub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTAwcHh9Lm9mZnNldDEwe21hcmdpbi1sZWZ0OjgyMHB4fS5vZmZzZXQ5e21hcmdpbi1sZWZ0Ojc0MHB4fS5vZmZzZXQ4e21hcmdpbi1sZWZ0OjY2MHB4fS5vZmZzZXQ3e21hcmdpbi1sZWZ0OjU4MHB4fS5vZmZzZXQ2e21hcmdpbi1sZWZ0OjUwMHB4fS5vZmZzZXQ1e21hcmdpbi1sZWZ0OjQyMHB4fS5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM0MHB4fS5vZmZzZXQze21hcmdpbi1sZWZ0OjI2MHB4fS5vZmZzZXQye21hcmdpbi1sZWZ0OjE4MHB4fS5vZmZzZXQxe21hcmdpbi1sZWZ0OjEwMHB4fS5yb3ctZmx1aWR7d2lkdGg6MTAwJTsqem9vbToxfS5yb3ctZmx1aWQ6YmVmb3JlLC5yb3ctZmx1aWQ6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LnJvdy1mbHVpZDphZnRlcntjbGVhcjpib3RofS5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJde2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bGVmdDt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDttYXJnaW4tbGVmdDoyLjEyNzY1OTU3NDQ2ODA4NSU7Km1hcmdpbi1sZWZ0OjIuMDc0NDY4MDg1MTA2MzgzJTstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3h9LnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl06Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MH0ucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyLjEyNzY1OTU3NDQ2ODA4NSV9LnJvdy1mbHVpZCAuc3BhbjEye3dpZHRoOjEwMCU7KndpZHRoOjk5Ljk0NjgwODUxMDYzODI5JX0ucm93LWZsdWlkIC5zcGFuMTF7d2lkdGg6OTEuNDg5MzYxNzAyMTI3NjUlOyp3aWR0aDo5MS40MzYxNzAyMTI3NjU5NCV9LnJvdy1mbHVpZCAuc3BhbjEwe3dpZHRoOjgyLjk3ODcyMzQwNDI1NTMyJTsqd2lkdGg6ODIuOTI1NTMxOTE0ODkzNjElfS5yb3ctZmx1aWQgLnNwYW45e3dpZHRoOjc0LjQ2ODA4NTEwNjM4Mjk3JTsqd2lkdGg6NzQuNDE0ODkzNjE3MDIxMjYlfS5yb3ctZmx1aWQgLnNwYW44e3dpZHRoOjY1Ljk1NzQ0NjgwODUxMDY0JTsqd2lkdGg6NjUuOTA0MjU1MzE5MTQ4OTMlfS5yb3ctZmx1aWQgLnNwYW43e3dpZHRoOjU3LjQ0NjgwODUxMDYzODI5JTsqd2lkdGg6NTcuMzkzNjE3MDIxMjc2NTklfS5yb3ctZmx1aWQgLnNwYW42e3dpZHRoOjQ4LjkzNjE3MDIxMjc2NTk1JTsqd2lkdGg6NDguODgyOTc4NzIzNDA0MjUlfS5yb3ctZmx1aWQgLnNwYW41e3dpZHRoOjQwLjQyNTUzMTkxNDg5MzYyJTsqd2lkdGg6NDAuMzcyMzQwNDI1NTMxOTIlfS5yb3ctZmx1aWQgLnNwYW40e3dpZHRoOjMxLjkxNDg5MzYxNzAyMTI3OCU7KndpZHRoOjMxLjg2MTcwMjEyNzY1OTU3NiV9LnJvdy1mbHVpZCAuc3BhbjN7d2lkdGg6MjMuNDA0MjU1MzE5MTQ4OTM0JTsqd2lkdGg6MjMuMzUxMDYzODI5Nzg3MjMzJX0ucm93LWZsdWlkIC5zcGFuMnt3aWR0aDoxNC44OTM2MTcwMjEyNzY1OTUlOyp3aWR0aDoxNC44NDA0MjU1MzE5MTQ4OTQlfS5yb3ctZmx1aWQgLnNwYW4xe3dpZHRoOjYuMzgyOTc4NzIzNDA0MjU1JTsqd2lkdGg6Ni4zMjk3ODcyMzQwNDI1NTMlfS5yb3ctZmx1aWQgLm9mZnNldDEye21hcmdpbi1sZWZ0OjEwNC4yNTUzMTkxNDg5MzYxNyU7Km1hcmdpbi1sZWZ0OjEwNC4xNDg5MzYxNzAyMTI3NSV9LnJvdy1mbHVpZCAub2Zmc2V0MTI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTAyLjEyNzY1OTU3NDQ2ODA4JTsqbWFyZ2luLWxlZnQ6MTAyLjAyMTI3NjU5NTc0NDY3JX0ucm93LWZsdWlkIC5vZmZzZXQxMXttYXJnaW4tbGVmdDo5NS43NDQ2ODA4NTEwNjM4MiU7Km1hcmdpbi1sZWZ0Ojk1LjYzODI5Nzg3MjM0MDQlfS5yb3ctZmx1aWQgLm9mZnNldDExOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjkzLjYxNzAyMTI3NjU5NTc0JTsqbWFyZ2luLWxlZnQ6OTMuNTEwNjM4Mjk3ODcyMzIlfS5yb3ctZmx1aWQgLm9mZnNldDEwe21hcmdpbi1sZWZ0Ojg3LjIzNDA0MjU1MzE5MTQ5JTsqbWFyZ2luLWxlZnQ6ODcuMTI3NjU5NTc0NDY4MDclfS5yb3ctZmx1aWQgLm9mZnNldDEwOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojg1LjEwNjM4Mjk3ODcyMzQlOyptYXJnaW4tbGVmdDo4NC45OTk5OTk5OTk5OTk5OSV9LnJvdy1mbHVpZCAub2Zmc2V0OXttYXJnaW4tbGVmdDo3OC43MjM0MDQyNTUzMTkxNCU7Km1hcmdpbi1sZWZ0Ojc4LjYxNzAyMTI3NjU5NTcyJX0ucm93LWZsdWlkIC5vZmZzZXQ5OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojc2LjU5NTc0NDY4MDg1MTA2JTsqbWFyZ2luLWxlZnQ6NzYuNDg5MzYxNzAyMTI3NjQlfS5yb3ctZmx1aWQgLm9mZnNldDh7bWFyZ2luLWxlZnQ6NzAuMjEyNzY1OTU3NDQ2OCU7Km1hcmdpbi1sZWZ0OjcwLjEwNjM4Mjk3ODcyMzM5JX0ucm93LWZsdWlkIC5vZmZzZXQ4OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjY4LjA4NTEwNjM4Mjk3ODcyJTsqbWFyZ2luLWxlZnQ6NjcuOTc4NzIzNDA0MjU1MyV9LnJvdy1mbHVpZCAub2Zmc2V0N3ttYXJnaW4tbGVmdDo2MS43MDIxMjc2NTk1NzQ0NiU7Km1hcmdpbi1sZWZ0OjYxLjU5NTc0NDY4MDg1MTA2JX0ucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5LjU3NDQ2ODA4NTEwNjM3NSU7Km1hcmdpbi1sZWZ0OjU5LjQ2ODA4NTEwNjM4Mjk3JX0ucm93LWZsdWlkIC5vZmZzZXQ2e21hcmdpbi1sZWZ0OjUzLjE5MTQ4OTM2MTcwMjEyNSU7Km1hcmdpbi1sZWZ0OjUzLjA4NTEwNjM4Mjk3ODcxNSV9LnJvdy1mbHVpZCAub2Zmc2V0NjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo1MS4wNjM4Mjk3ODcyMzQwMzUlOyptYXJnaW4tbGVmdDo1MC45NTc0NDY4MDg1MTA2MyV9LnJvdy1mbHVpZCAub2Zmc2V0NXttYXJnaW4tbGVmdDo0NC42ODA4NTEwNjM4Mjk3OSU7Km1hcmdpbi1sZWZ0OjQ0LjU3NDQ2ODA4NTEwNjM4JX0ucm93LWZsdWlkIC5vZmZzZXQ1OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjQyLjU1MzE5MTQ4OTM2MTclOyptYXJnaW4tbGVmdDo0Mi40NDY4MDg1MTA2MzgzJX0ucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM2LjE3MDIxMjc2NTk1NzQ0NCU7Km1hcmdpbi1sZWZ0OjM2LjA2MzgyOTc4NzIzNDA1JX0ucm93LWZsdWlkIC5vZmZzZXQ0OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjM0LjA0MjU1MzE5MTQ4OTM2JTsqbWFyZ2luLWxlZnQ6MzMuOTM2MTcwMjEyNzY1OTYlfS5yb3ctZmx1aWQgLm9mZnNldDN7bWFyZ2luLWxlZnQ6MjcuNjU5NTc0NDY4MDg1MTA0JTsqbWFyZ2luLWxlZnQ6MjcuNTUzMTkxNDg5MzYxNyV9LnJvdy1mbHVpZCAub2Zmc2V0MzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoyNS41MzE5MTQ4OTM2MTcwMiU7Km1hcmdpbi1sZWZ0OjI1LjQyNTUzMTkxNDg5MzYxOCV9LnJvdy1mbHVpZCAub2Zmc2V0MnttYXJnaW4tbGVmdDoxOS4xNDg5MzYxNzAyMTI3NjQlOyptYXJnaW4tbGVmdDoxOS4wNDI1NTMxOTE0ODkzNiV9LnJvdy1mbHVpZCAub2Zmc2V0MjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxNy4wMjEyNzY1OTU3NDQ2OCU7Km1hcmdpbi1sZWZ0OjE2LjkxNDg5MzYxNzAyMTI3OCV9LnJvdy1mbHVpZCAub2Zmc2V0MXttYXJnaW4tbGVmdDoxMC42MzgyOTc4NzIzNDA0MjUlOyptYXJnaW4tbGVmdDoxMC41MzE5MTQ4OTM2MTcwMiV9LnJvdy1mbHVpZCAub2Zmc2V0MTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4LjUxMDYzODI5Nzg3MjM0JTsqbWFyZ2luLWxlZnQ6OC40MDQyNTUzMTkxNDg5MzglfVtjbGFzcyo9InNwYW4iXS5oaWRlLC5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdLmhpZGV7ZGlzcGxheTpub25lfVtjbGFzcyo9InNwYW4iXS5wdWxsLXJpZ2h0LC5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdLnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHR9LmNvbnRhaW5lcnttYXJnaW4tcmlnaHQ6YXV0bzttYXJnaW4tbGVmdDphdXRvOyp6b29tOjF9LmNvbnRhaW5lcjpiZWZvcmUsLmNvbnRhaW5lcjphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0uY29udGFpbmVyOmFmdGVye2NsZWFyOmJvdGh9LmNvbnRhaW5lci1mbHVpZHtwYWRkaW5nLXJpZ2h0OjIwcHg7cGFkZGluZy1sZWZ0OjIwcHg7Knpvb206MX0uY29udGFpbmVyLWZsdWlkOmJlZm9yZSwuY29udGFpbmVyLWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5jb250YWluZXItZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aH1we21hcmdpbjowIDAgMTBweH0ubGVhZHttYXJnaW4tYm90dG9tOjIwcHg7Zm9udC1zaXplOjIxcHg7Zm9udC13ZWlnaHQ6MjAwO2xpbmUtaGVpZ2h0OjMwcHh9c21hbGx7Zm9udC1zaXplOjg1JX1zdHJvbmd7Zm9udC13ZWlnaHQ6Ym9sZH1lbXtmb250LXN0eWxlOml0YWxpY31jaXRle2ZvbnQtc3R5bGU6bm9ybWFsfS5tdXRlZHtjb2xvcjojOTk5fWEubXV0ZWQ6aG92ZXIsYS5tdXRlZDpmb2N1c3tjb2xvcjojODA4MDgwfS50ZXh0LXdhcm5pbmd7Y29sb3I6I2MwOTg1M31hLnRleHQtd2FybmluZzpob3ZlcixhLnRleHQtd2FybmluZzpmb2N1c3tjb2xvcjojYTQ3ZTNjfS50ZXh0LWVycm9ye2NvbG9yOiNiOTRhNDh9YS50ZXh0LWVycm9yOmhvdmVyLGEudGV4dC1lcnJvcjpmb2N1c3tjb2xvcjojOTUzYjM5fS50ZXh0LWluZm97Y29sb3I6IzNhODdhZH1hLnRleHQtaW5mbzpob3ZlcixhLnRleHQtaW5mbzpmb2N1c3tjb2xvcjojMmQ2OTg3fS50ZXh0LXN1Y2Nlc3N7Y29sb3I6IzQ2ODg0N31hLnRleHQtc3VjY2Vzczpob3ZlcixhLnRleHQtc3VjY2Vzczpmb2N1c3tjb2xvcjojMzU2NjM1fS50ZXh0LWxlZnR7dGV4dC1hbGlnbjpsZWZ0fS50ZXh0LXJpZ2h0e3RleHQtYWxpZ246cmlnaHR9LnRleHQtY2VudGVye3RleHQtYWxpZ246Y2VudGVyfWgxLGgyLGgzLGg0LGg1LGg2e21hcmdpbjoxMHB4IDA7Zm9udC1mYW1pbHk6aW5oZXJpdDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6aW5oZXJpdDt0ZXh0LXJlbmRlcmluZzpvcHRpbWl6ZWxlZ2liaWxpdHl9aDEgc21hbGwsaDIgc21hbGwsaDMgc21hbGwsaDQgc21hbGwsaDUgc21hbGwsaDYgc21hbGx7Zm9udC13ZWlnaHQ6bm9ybWFsO2xpbmUtaGVpZ2h0OjE7Y29sb3I6Izk5OX1oMSxoMixoM3tsaW5lLWhlaWdodDo0MHB4fWgxe2ZvbnQtc2l6ZTozOC41cHh9aDJ7Zm9udC1zaXplOjMxLjVweH1oM3tmb250LXNpemU6MjQuNXB4fWg0e2ZvbnQtc2l6ZToxNy41cHh9aDV7Zm9udC1zaXplOjE0cHh9aDZ7Zm9udC1zaXplOjExLjlweH1oMSBzbWFsbHtmb250LXNpemU6MjQuNXB4fWgyIHNtYWxse2ZvbnQtc2l6ZToxNy41cHh9aDMgc21hbGx7Zm9udC1zaXplOjE0cHh9aDQgc21hbGx7Zm9udC1zaXplOjE0cHh9LnBhZ2UtaGVhZGVye3BhZGRpbmctYm90dG9tOjlweDttYXJnaW46MjBweCAwIDMwcHg7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2VlZX11bCxvbHtwYWRkaW5nOjA7bWFyZ2luOjAgMCAxMHB4IDI1cHh9dWwgdWwsdWwgb2wsb2wgb2wsb2wgdWx7bWFyZ2luLWJvdHRvbTowfWxpe2xpbmUtaGVpZ2h0OjIwcHh9dWwudW5zdHlsZWQsb2wudW5zdHlsZWR7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmV9dWwuaW5saW5lLG9sLmlubGluZXttYXJnaW4tbGVmdDowO2xpc3Qtc3R5bGU6bm9uZX11bC5pbmxpbmU+bGksb2wuaW5saW5lPmxpe2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTtwYWRkaW5nLXJpZ2h0OjVweDtwYWRkaW5nLWxlZnQ6NXB4Oyp6b29tOjF9ZGx7bWFyZ2luLWJvdHRvbToyMHB4fWR0LGRke2xpbmUtaGVpZ2h0OjIwcHh9ZHR7Zm9udC13ZWlnaHQ6Ym9sZH1kZHttYXJnaW4tbGVmdDoxMHB4fS5kbC1ob3Jpem9udGFseyp6b29tOjF9LmRsLWhvcml6b250YWw6YmVmb3JlLC5kbC1ob3Jpem9udGFsOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5kbC1ob3Jpem9udGFsOmFmdGVye2NsZWFyOmJvdGh9LmRsLWhvcml6b250YWwgZHR7ZmxvYXQ6bGVmdDt3aWR0aDoxNjBweDtvdmVyZmxvdzpoaWRkZW47Y2xlYXI6bGVmdDt0ZXh0LWFsaWduOnJpZ2h0O3RleHQtb3ZlcmZsb3c6ZWxsaXBzaXM7d2hpdGUtc3BhY2U6bm93cmFwfS5kbC1ob3Jpem9udGFsIGRke21hcmdpbi1sZWZ0OjE4MHB4fWhye21hcmdpbjoyMHB4IDA7Ym9yZGVyOjA7Ym9yZGVyLXRvcDoxcHggc29saWQgI2VlZTtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZmZmfWFiYnJbdGl0bGVdLGFiYnJbZGF0YS1vcmlnaW5hbC10aXRsZV17Y3Vyc29yOmhlbHA7Ym9yZGVyLWJvdHRvbToxcHggZG90dGVkICM5OTl9YWJici5pbml0aWFsaXNte2ZvbnQtc2l6ZTo5MCU7dGV4dC10cmFuc2Zvcm06dXBwZXJjYXNlfWJsb2NrcXVvdGV7cGFkZGluZzowIDAgMCAxNXB4O21hcmdpbjowIDAgMjBweDtib3JkZXItbGVmdDo1cHggc29saWQgI2VlZX1ibG9ja3F1b3RlIHB7bWFyZ2luLWJvdHRvbTowO2ZvbnQtc2l6ZToxNy41cHg7Zm9udC13ZWlnaHQ6MzAwO2xpbmUtaGVpZ2h0OjEuMjV9YmxvY2txdW90ZSBzbWFsbHtkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6Izk5OX1ibG9ja3F1b3RlIHNtYWxsOmJlZm9yZXtjb250ZW50OidcMjAxNCBcMDBBMCd9YmxvY2txdW90ZS5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O3BhZGRpbmctcmlnaHQ6MTVweDtwYWRkaW5nLWxlZnQ6MDtib3JkZXItcmlnaHQ6NXB4IHNvbGlkICNlZWU7Ym9yZGVyLWxlZnQ6MH1ibG9ja3F1b3RlLnB1bGwtcmlnaHQgcCxibG9ja3F1b3RlLnB1bGwtcmlnaHQgc21hbGx7dGV4dC1hbGlnbjpyaWdodH1ibG9ja3F1b3RlLnB1bGwtcmlnaHQgc21hbGw6YmVmb3Jle2NvbnRlbnQ6Jyd9YmxvY2txdW90ZS5wdWxsLXJpZ2h0IHNtYWxsOmFmdGVye2NvbnRlbnQ6J1wwMEEwIFwyMDE0J31xOmJlZm9yZSxxOmFmdGVyLGJsb2NrcXVvdGU6YmVmb3JlLGJsb2NrcXVvdGU6YWZ0ZXJ7Y29udGVudDoiIn1hZGRyZXNze2Rpc3BsYXk6YmxvY2s7bWFyZ2luLWJvdHRvbToyMHB4O2ZvbnQtc3R5bGU6bm9ybWFsO2xpbmUtaGVpZ2h0OjIwcHh9Y29kZSxwcmV7cGFkZGluZzowIDNweCAycHg7Zm9udC1mYW1pbHk6TW9uYWNvLE1lbmxvLENvbnNvbGFzLCJDb3VyaWVyIE5ldyIsbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB4O2NvbG9yOiMzMzM7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4fWNvZGV7cGFkZGluZzoycHggNHB4O2NvbG9yOiNkMTQ7d2hpdGUtc3BhY2U6bm93cmFwO2JhY2tncm91bmQtY29sb3I6I2Y3ZjdmOTtib3JkZXI6MXB4IHNvbGlkICNlMWUxZTh9cHJle2Rpc3BsYXk6YmxvY2s7cGFkZGluZzo5LjVweDttYXJnaW46MCAwIDEwcHg7Zm9udC1zaXplOjEzcHg7bGluZS1oZWlnaHQ6MjBweDt3b3JkLWJyZWFrOmJyZWFrLWFsbDt3b3JkLXdyYXA6YnJlYWstd29yZDt3aGl0ZS1zcGFjZTpwcmU7d2hpdGUtc3BhY2U6cHJlLXdyYXA7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwwLDAsMC4xNSk7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fXByZS5wcmV0dHlwcmludHttYXJnaW4tYm90dG9tOjIwcHh9cHJlIGNvZGV7cGFkZGluZzowO2NvbG9yOmluaGVyaXQ7d2hpdGUtc3BhY2U6cHJlO3doaXRlLXNwYWNlOnByZS13cmFwO2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyOjB9LnByZS1zY3JvbGxhYmxle21heC1oZWlnaHQ6MzQwcHg7b3ZlcmZsb3cteTpzY3JvbGx9Zm9ybXttYXJnaW46MCAwIDIwcHh9ZmllbGRzZXR7cGFkZGluZzowO21hcmdpbjowO2JvcmRlcjowfWxlZ2VuZHtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7cGFkZGluZzowO21hcmdpbi1ib3R0b206MjBweDtmb250LXNpemU6MjFweDtsaW5lLWhlaWdodDo0MHB4O2NvbG9yOiMzMzM7Ym9yZGVyOjA7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2U1ZTVlNX1sZWdlbmQgc21hbGx7Zm9udC1zaXplOjE1cHg7Y29sb3I6Izk5OX1sYWJlbCxpbnB1dCxidXR0b24sc2VsZWN0LHRleHRhcmVhe2ZvbnQtc2l6ZToxNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoyMHB4fWlucHV0LGJ1dHRvbixzZWxlY3QsdGV4dGFyZWF7Zm9udC1mYW1pbHk6IkhlbHZldGljYSBOZXVlIixIZWx2ZXRpY2EsQXJpYWwsc2Fucy1zZXJpZn1sYWJlbHtkaXNwbGF5OmJsb2NrO21hcmdpbi1ib3R0b206NXB4fXNlbGVjdCx0ZXh0YXJlYSxpbnB1dFt0eXBlPSJ0ZXh0Il0saW5wdXRbdHlwZT0icGFzc3dvcmQiXSxpbnB1dFt0eXBlPSJkYXRldGltZSJdLGlucHV0W3R5cGU9ImRhdGV0aW1lLWxvY2FsIl0saW5wdXRbdHlwZT0iZGF0ZSJdLGlucHV0W3R5cGU9Im1vbnRoIl0saW5wdXRbdHlwZT0idGltZSJdLGlucHV0W3R5cGU9IndlZWsiXSxpbnB1dFt0eXBlPSJudW1iZXIiXSxpbnB1dFt0eXBlPSJlbWFpbCJdLGlucHV0W3R5cGU9InVybCJdLGlucHV0W3R5cGU9InNlYXJjaCJdLGlucHV0W3R5cGU9InRlbCJdLGlucHV0W3R5cGU9ImNvbG9yIl0sLnVuZWRpdGFibGUtaW5wdXR7ZGlzcGxheTppbmxpbmUtYmxvY2s7aGVpZ2h0OjIwcHg7cGFkZGluZzo0cHggNnB4O21hcmdpbi1ib3R0b206MTBweDtmb250LXNpemU6MTRweDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiM1NTU7dmVydGljYWwtYWxpZ246bWlkZGxlOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweH1pbnB1dCx0ZXh0YXJlYSwudW5lZGl0YWJsZS1pbnB1dHt3aWR0aDoyMDZweH10ZXh0YXJlYXtoZWlnaHQ6YXV0b310ZXh0YXJlYSxpbnB1dFt0eXBlPSJ0ZXh0Il0saW5wdXRbdHlwZT0icGFzc3dvcmQiXSxpbnB1dFt0eXBlPSJkYXRldGltZSJdLGlucHV0W3R5cGU9ImRhdGV0aW1lLWxvY2FsIl0saW5wdXRbdHlwZT0iZGF0ZSJdLGlucHV0W3R5cGU9Im1vbnRoIl0saW5wdXRbdHlwZT0idGltZSJdLGlucHV0W3R5cGU9IndlZWsiXSxpbnB1dFt0eXBlPSJudW1iZXIiXSxpbnB1dFt0eXBlPSJlbWFpbCJdLGlucHV0W3R5cGU9InVybCJdLGlucHV0W3R5cGU9InNlYXJjaCJdLGlucHV0W3R5cGU9InRlbCJdLGlucHV0W3R5cGU9ImNvbG9yIl0sLnVuZWRpdGFibGUtaW5wdXR7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2NjYzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7LXdlYmtpdC10cmFuc2l0aW9uOmJvcmRlciBsaW5lYXIgLjJzLGJveC1zaGFkb3cgbGluZWFyIC4yczstbW96LXRyYW5zaXRpb246Ym9yZGVyIGxpbmVhciAuMnMsYm94LXNoYWRvdyBsaW5lYXIgLjJzOy1vLXRyYW5zaXRpb246Ym9yZGVyIGxpbmVhciAuMnMsYm94LXNoYWRvdyBsaW5lYXIgLjJzO3RyYW5zaXRpb246Ym9yZGVyIGxpbmVhciAuMnMsYm94LXNoYWRvdyBsaW5lYXIgLjJzfXRleHRhcmVhOmZvY3VzLGlucHV0W3R5cGU9InRleHQiXTpmb2N1cyxpbnB1dFt0eXBlPSJwYXNzd29yZCJdOmZvY3VzLGlucHV0W3R5cGU9ImRhdGV0aW1lIl06Zm9jdXMsaW5wdXRbdHlwZT0iZGF0ZXRpbWUtbG9jYWwiXTpmb2N1cyxpbnB1dFt0eXBlPSJkYXRlIl06Zm9jdXMsaW5wdXRbdHlwZT0ibW9udGgiXTpmb2N1cyxpbnB1dFt0eXBlPSJ0aW1lIl06Zm9jdXMsaW5wdXRbdHlwZT0id2VlayJdOmZvY3VzLGlucHV0W3R5cGU9Im51bWJlciJdOmZvY3VzLGlucHV0W3R5cGU9ImVtYWlsIl06Zm9jdXMsaW5wdXRbdHlwZT0idXJsIl06Zm9jdXMsaW5wdXRbdHlwZT0ic2VhcmNoIl06Zm9jdXMsaW5wdXRbdHlwZT0idGVsIl06Zm9jdXMsaW5wdXRbdHlwZT0iY29sb3IiXTpmb2N1cywudW5lZGl0YWJsZS1pbnB1dDpmb2N1c3tib3JkZXItY29sb3I6cmdiYSg4MiwxNjgsMjM2LDAuOCk7b3V0bGluZTowO291dGxpbmU6dGhpbiBkb3R0ZWQgXDk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgOHB4IHJnYmEoODIsMTY4LDIzNiwwLjYpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDhweCByZ2JhKDgyLDE2OCwyMzYsMC42KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgOHB4IHJnYmEoODIsMTY4LDIzNiwwLjYpfWlucHV0W3R5cGU9InJhZGlvIl0saW5wdXRbdHlwZT0iY2hlY2tib3giXXttYXJnaW46NHB4IDAgMDttYXJnaW4tdG9wOjFweCBcOTsqbWFyZ2luLXRvcDowO2xpbmUtaGVpZ2h0Om5vcm1hbH1pbnB1dFt0eXBlPSJmaWxlIl0saW5wdXRbdHlwZT0iaW1hZ2UiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXSxpbnB1dFt0eXBlPSJyZXNldCJdLGlucHV0W3R5cGU9ImJ1dHRvbiJdLGlucHV0W3R5cGU9InJhZGlvIl0saW5wdXRbdHlwZT0iY2hlY2tib3giXXt3aWR0aDphdXRvfXNlbGVjdCxpbnB1dFt0eXBlPSJmaWxlIl17aGVpZ2h0OjMwcHg7Km1hcmdpbi10b3A6NHB4O2xpbmUtaGVpZ2h0OjMwcHh9c2VsZWN0e3dpZHRoOjIyMHB4O2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MXB4IHNvbGlkICNjY2N9c2VsZWN0W211bHRpcGxlXSxzZWxlY3Rbc2l6ZV17aGVpZ2h0OmF1dG99c2VsZWN0OmZvY3VzLGlucHV0W3R5cGU9ImZpbGUiXTpmb2N1cyxpbnB1dFt0eXBlPSJyYWRpbyJdOmZvY3VzLGlucHV0W3R5cGU9ImNoZWNrYm94Il06Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHh9LnVuZWRpdGFibGUtaW5wdXQsLnVuZWRpdGFibGUtdGV4dGFyZWF7Y29sb3I6Izk5OTtjdXJzb3I6bm90LWFsbG93ZWQ7YmFja2dyb3VuZC1jb2xvcjojZmNmY2ZjO2JvcmRlci1jb2xvcjojY2NjOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwwLjAyNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDI1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDI1KX0udW5lZGl0YWJsZS1pbnB1dHtvdmVyZmxvdzpoaWRkZW47d2hpdGUtc3BhY2U6bm93cmFwfS51bmVkaXRhYmxlLXRleHRhcmVhe3dpZHRoOmF1dG87aGVpZ2h0OmF1dG99aW5wdXQ6LW1vei1wbGFjZWhvbGRlcix0ZXh0YXJlYTotbW96LXBsYWNlaG9sZGVye2NvbG9yOiM5OTl9aW5wdXQ6LW1zLWlucHV0LXBsYWNlaG9sZGVyLHRleHRhcmVhOi1tcy1pbnB1dC1wbGFjZWhvbGRlcntjb2xvcjojOTk5fWlucHV0Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVyLHRleHRhcmVhOjotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiM5OTl9LnJhZGlvLC5jaGVja2JveHttaW4taGVpZ2h0OjIwcHg7cGFkZGluZy1sZWZ0OjIwcHh9LnJhZGlvIGlucHV0W3R5cGU9InJhZGlvIl0sLmNoZWNrYm94IGlucHV0W3R5cGU9ImNoZWNrYm94Il17ZmxvYXQ6bGVmdDttYXJnaW4tbGVmdDotMjBweH0uY29udHJvbHM+LnJhZGlvOmZpcnN0LWNoaWxkLC5jb250cm9scz4uY2hlY2tib3g6Zmlyc3QtY2hpbGR7cGFkZGluZy10b3A6NXB4fS5yYWRpby5pbmxpbmUsLmNoZWNrYm94LmlubGluZXtkaXNwbGF5OmlubGluZS1ibG9jaztwYWRkaW5nLXRvcDo1cHg7bWFyZ2luLWJvdHRvbTowO3ZlcnRpY2FsLWFsaWduOm1pZGRsZX0ucmFkaW8uaW5saW5lKy5yYWRpby5pbmxpbmUsLmNoZWNrYm94LmlubGluZSsuY2hlY2tib3guaW5saW5le21hcmdpbi1sZWZ0OjEwcHh9LmlucHV0LW1pbml7d2lkdGg6NjBweH0uaW5wdXQtc21hbGx7d2lkdGg6OTBweH0uaW5wdXQtbWVkaXVte3dpZHRoOjE1MHB4fS5pbnB1dC1sYXJnZXt3aWR0aDoyMTBweH0uaW5wdXQteGxhcmdle3dpZHRoOjI3MHB4fS5pbnB1dC14eGxhcmdle3dpZHRoOjUzMHB4fWlucHV0W2NsYXNzKj0ic3BhbiJdLHNlbGVjdFtjbGFzcyo9InNwYW4iXSx0ZXh0YXJlYVtjbGFzcyo9InNwYW4iXSwudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgc2VsZWN0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgdGV4dGFyZWFbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXXtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjB9LmlucHV0LWFwcGVuZCBpbnB1dFtjbGFzcyo9InNwYW4iXSwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1wcmVwZW5kIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCBzZWxlY3RbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0ZXh0YXJlYVtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLmlucHV0LXByZXBlbmQgW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLmlucHV0LWFwcGVuZCBbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTppbmxpbmUtYmxvY2t9aW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7bWFyZ2luLWxlZnQ6MH0uY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MjBweH1pbnB1dC5zcGFuMTIsdGV4dGFyZWEuc3BhbjEyLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMnt3aWR0aDo5MjZweH1pbnB1dC5zcGFuMTEsdGV4dGFyZWEuc3BhbjExLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMXt3aWR0aDo4NDZweH1pbnB1dC5zcGFuMTAsdGV4dGFyZWEuc3BhbjEwLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMHt3aWR0aDo3NjZweH1pbnB1dC5zcGFuOSx0ZXh0YXJlYS5zcGFuOSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOXt3aWR0aDo2ODZweH1pbnB1dC5zcGFuOCx0ZXh0YXJlYS5zcGFuOCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo2MDZweH1pbnB1dC5zcGFuNyx0ZXh0YXJlYS5zcGFuNywudW5lZGl0YWJsZS1pbnB1dC5zcGFuN3t3aWR0aDo1MjZweH1pbnB1dC5zcGFuNix0ZXh0YXJlYS5zcGFuNiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNnt3aWR0aDo0NDZweH1pbnB1dC5zcGFuNSx0ZXh0YXJlYS5zcGFuNSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDozNjZweH1pbnB1dC5zcGFuNCx0ZXh0YXJlYS5zcGFuNCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNHt3aWR0aDoyODZweH1pbnB1dC5zcGFuMyx0ZXh0YXJlYS5zcGFuMywudW5lZGl0YWJsZS1pbnB1dC5zcGFuM3t3aWR0aDoyMDZweH1pbnB1dC5zcGFuMix0ZXh0YXJlYS5zcGFuMiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDoxMjZweH1pbnB1dC5zcGFuMSx0ZXh0YXJlYS5zcGFuMSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMXt3aWR0aDo0NnB4fS5jb250cm9scy1yb3d7Knpvb206MX0uY29udHJvbHMtcm93OmJlZm9yZSwuY29udHJvbHMtcm93OmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5jb250cm9scy1yb3c6YWZ0ZXJ7Y2xlYXI6Ym90aH0uY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnR9LmNvbnRyb2xzLXJvdyAuY2hlY2tib3hbY2xhc3MqPSJzcGFuIl0sLmNvbnRyb2xzLXJvdyAucmFkaW9bY2xhc3MqPSJzcGFuIl17cGFkZGluZy10b3A6NXB4fWlucHV0W2Rpc2FibGVkXSxzZWxlY3RbZGlzYWJsZWRdLHRleHRhcmVhW2Rpc2FibGVkXSxpbnB1dFtyZWFkb25seV0sc2VsZWN0W3JlYWRvbmx5XSx0ZXh0YXJlYVtyZWFkb25seV17Y3Vyc29yOm5vdC1hbGxvd2VkO2JhY2tncm91bmQtY29sb3I6I2VlZX1pbnB1dFt0eXBlPSJyYWRpbyJdW2Rpc2FibGVkXSxpbnB1dFt0eXBlPSJjaGVja2JveCJdW2Rpc2FibGVkXSxpbnB1dFt0eXBlPSJyYWRpbyJdW3JlYWRvbmx5XSxpbnB1dFt0eXBlPSJjaGVja2JveCJdW3JlYWRvbmx5XXtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5jb250cm9sLWdyb3VwLndhcm5pbmcgLmNvbnRyb2wtbGFiZWwsLmNvbnRyb2wtZ3JvdXAud2FybmluZyAuaGVscC1ibG9jaywuY29udHJvbC1ncm91cC53YXJuaW5nIC5oZWxwLWlubGluZXtjb2xvcjojYzA5ODUzfS5jb250cm9sLWdyb3VwLndhcm5pbmcgLmNoZWNrYm94LC5jb250cm9sLWdyb3VwLndhcm5pbmcgLnJhZGlvLC5jb250cm9sLWdyb3VwLndhcm5pbmcgaW5wdXQsLmNvbnRyb2wtZ3JvdXAud2FybmluZyBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAud2FybmluZyB0ZXh0YXJlYXtjb2xvcjojYzA5ODUzfS5jb250cm9sLWdyb3VwLndhcm5pbmcgaW5wdXQsLmNvbnRyb2wtZ3JvdXAud2FybmluZyBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAud2FybmluZyB0ZXh0YXJlYXtib3JkZXItY29sb3I6I2MwOTg1Mzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSl9LmNvbnRyb2wtZ3JvdXAud2FybmluZyBpbnB1dDpmb2N1cywuY29udHJvbC1ncm91cC53YXJuaW5nIHNlbGVjdDpmb2N1cywuY29udHJvbC1ncm91cC53YXJuaW5nIHRleHRhcmVhOmZvY3Vze2JvcmRlci1jb2xvcjojYTQ3ZTNjOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjZGJjNTllOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjZGJjNTllO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggI2RiYzU5ZX0uY29udHJvbC1ncm91cC53YXJuaW5nIC5pbnB1dC1wcmVwZW5kIC5hZGQtb24sLmNvbnRyb2wtZ3JvdXAud2FybmluZyAuaW5wdXQtYXBwZW5kIC5hZGQtb257Y29sb3I6I2MwOTg1MztiYWNrZ3JvdW5kLWNvbG9yOiNmY2Y4ZTM7Ym9yZGVyLWNvbG9yOiNjMDk4NTN9LmNvbnRyb2wtZ3JvdXAuZXJyb3IgLmNvbnRyb2wtbGFiZWwsLmNvbnRyb2wtZ3JvdXAuZXJyb3IgLmhlbHAtYmxvY2ssLmNvbnRyb2wtZ3JvdXAuZXJyb3IgLmhlbHAtaW5saW5le2NvbG9yOiNiOTRhNDh9LmNvbnRyb2wtZ3JvdXAuZXJyb3IgLmNoZWNrYm94LC5jb250cm9sLWdyb3VwLmVycm9yIC5yYWRpbywuY29udHJvbC1ncm91cC5lcnJvciBpbnB1dCwuY29udHJvbC1ncm91cC5lcnJvciBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAuZXJyb3IgdGV4dGFyZWF7Y29sb3I6I2I5NGE0OH0uY29udHJvbC1ncm91cC5lcnJvciBpbnB1dCwuY29udHJvbC1ncm91cC5lcnJvciBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAuZXJyb3IgdGV4dGFyZWF7Ym9yZGVyLWNvbG9yOiNiOTRhNDg7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpfS5jb250cm9sLWdyb3VwLmVycm9yIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLmVycm9yIHNlbGVjdDpmb2N1cywuY29udHJvbC1ncm91cC5lcnJvciB0ZXh0YXJlYTpmb2N1c3tib3JkZXItY29sb3I6Izk1M2IzOTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggI2Q1OTM5MjstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggI2Q1OTM5Mjtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICNkNTkzOTJ9LmNvbnRyb2wtZ3JvdXAuZXJyb3IgLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC5lcnJvciAuaW5wdXQtYXBwZW5kIC5hZGQtb257Y29sb3I6I2I5NGE0ODtiYWNrZ3JvdW5kLWNvbG9yOiNmMmRlZGU7Ym9yZGVyLWNvbG9yOiNiOTRhNDh9LmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuY29udHJvbC1sYWJlbCwuY29udHJvbC1ncm91cC5zdWNjZXNzIC5oZWxwLWJsb2NrLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmhlbHAtaW5saW5le2NvbG9yOiM0Njg4NDd9LmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuY2hlY2tib3gsLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAucmFkaW8sLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyBpbnB1dCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHNlbGVjdCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHRleHRhcmVhe2NvbG9yOiM0Njg4NDd9LmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyBpbnB1dCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHNlbGVjdCwuY29udHJvbC1ncm91cC5zdWNjZXNzIHRleHRhcmVhe2JvcmRlci1jb2xvcjojNDY4ODQ3Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KX0uY29udHJvbC1ncm91cC5zdWNjZXNzIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3Mgc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgdGV4dGFyZWE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiMzNTY2MzU7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICM3YWJhN2I7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICM3YWJhN2I7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjN2FiYTdifS5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC5zdWNjZXNzIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojNDY4ODQ3O2JhY2tncm91bmQtY29sb3I6I2RmZjBkODtib3JkZXItY29sb3I6IzQ2ODg0N30uY29udHJvbC1ncm91cC5pbmZvIC5jb250cm9sLWxhYmVsLC5jb250cm9sLWdyb3VwLmluZm8gLmhlbHAtYmxvY2ssLmNvbnRyb2wtZ3JvdXAuaW5mbyAuaGVscC1pbmxpbmV7Y29sb3I6IzNhODdhZH0uY29udHJvbC1ncm91cC5pbmZvIC5jaGVja2JveCwuY29udHJvbC1ncm91cC5pbmZvIC5yYWRpbywuY29udHJvbC1ncm91cC5pbmZvIGlucHV0LC5jb250cm9sLWdyb3VwLmluZm8gc2VsZWN0LC5jb250cm9sLWdyb3VwLmluZm8gdGV4dGFyZWF7Y29sb3I6IzNhODdhZH0uY29udHJvbC1ncm91cC5pbmZvIGlucHV0LC5jb250cm9sLWdyb3VwLmluZm8gc2VsZWN0LC5jb250cm9sLWdyb3VwLmluZm8gdGV4dGFyZWF7Ym9yZGVyLWNvbG9yOiMzYTg3YWQ7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpfS5jb250cm9sLWdyb3VwLmluZm8gaW5wdXQ6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAuaW5mbyBzZWxlY3Q6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAuaW5mbyB0ZXh0YXJlYTpmb2N1c3tib3JkZXItY29sb3I6IzJkNjk4Nzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggIzdhYjVkMzstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggIzdhYjVkMztib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICM3YWI1ZDN9LmNvbnRyb2wtZ3JvdXAuaW5mbyAuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5jb250cm9sLWdyb3VwLmluZm8gLmlucHV0LWFwcGVuZCAuYWRkLW9ue2NvbG9yOiMzYTg3YWQ7YmFja2dyb3VuZC1jb2xvcjojZDllZGY3O2JvcmRlci1jb2xvcjojM2E4N2FkfWlucHV0OmZvY3VzOmludmFsaWQsdGV4dGFyZWE6Zm9jdXM6aW52YWxpZCxzZWxlY3Q6Zm9jdXM6aW52YWxpZHtjb2xvcjojYjk0YTQ4O2JvcmRlci1jb2xvcjojZWU1ZjVifWlucHV0OmZvY3VzOmludmFsaWQ6Zm9jdXMsdGV4dGFyZWE6Zm9jdXM6aW52YWxpZDpmb2N1cyxzZWxlY3Q6Zm9jdXM6aW52YWxpZDpmb2N1c3tib3JkZXItY29sb3I6I2U5MzIyZDstd2Via2l0LWJveC1zaGFkb3c6MCAwIDZweCAjZjhiOWI3Oy1tb3otYm94LXNoYWRvdzowIDAgNnB4ICNmOGI5Yjc7Ym94LXNoYWRvdzowIDAgNnB4ICNmOGI5Yjd9LmZvcm0tYWN0aW9uc3twYWRkaW5nOjE5cHggMjBweCAyMHB4O21hcmdpbi10b3A6MjBweDttYXJnaW4tYm90dG9tOjIwcHg7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O2JvcmRlci10b3A6MXB4IHNvbGlkICNlNWU1ZTU7Knpvb206MX0uZm9ybS1hY3Rpb25zOmJlZm9yZSwuZm9ybS1hY3Rpb25zOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5mb3JtLWFjdGlvbnM6YWZ0ZXJ7Y2xlYXI6Ym90aH0uaGVscC1ibG9jaywuaGVscC1pbmxpbmV7Y29sb3I6IzU5NTk1OX0uaGVscC1ibG9ja3tkaXNwbGF5OmJsb2NrO21hcmdpbi1ib3R0b206MTBweH0uaGVscC1pbmxpbmV7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lO3BhZGRpbmctbGVmdDo1cHg7dmVydGljYWwtYWxpZ246bWlkZGxlOyp6b29tOjF9LmlucHV0LWFwcGVuZCwuaW5wdXQtcHJlcGVuZHtkaXNwbGF5OmlubGluZS1ibG9jazttYXJnaW4tYm90dG9tOjEwcHg7Zm9udC1zaXplOjA7d2hpdGUtc3BhY2U6bm93cmFwO3ZlcnRpY2FsLWFsaWduOm1pZGRsZX0uaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1wcmVwZW5kIHNlbGVjdCwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0LC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0LC5pbnB1dC1hcHBlbmQgLmRyb3Bkb3duLW1lbnUsLmlucHV0LXByZXBlbmQgLmRyb3Bkb3duLW1lbnUsLmlucHV0LWFwcGVuZCAucG9wb3ZlciwuaW5wdXQtcHJlcGVuZCAucG9wb3Zlcntmb250LXNpemU6MTRweH0uaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1wcmVwZW5kIHNlbGVjdCwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0LC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0e3Bvc2l0aW9uOnJlbGF0aXZlO21hcmdpbi1ib3R0b206MDsqbWFyZ2luLWxlZnQ6MDt2ZXJ0aWNhbC1hbGlnbjp0b3A7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwfS5pbnB1dC1hcHBlbmQgaW5wdXQ6Zm9jdXMsLmlucHV0LXByZXBlbmQgaW5wdXQ6Zm9jdXMsLmlucHV0LWFwcGVuZCBzZWxlY3Q6Zm9jdXMsLmlucHV0LXByZXBlbmQgc2VsZWN0OmZvY3VzLC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQ6Zm9jdXMsLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXQ6Zm9jdXN7ei1pbmRleDoyfS5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtcHJlcGVuZCAuYWRkLW9ue2Rpc3BsYXk6aW5saW5lLWJsb2NrO3dpZHRoOmF1dG87aGVpZ2h0OjIwcHg7bWluLXdpZHRoOjE2cHg7cGFkZGluZzo0cHggNXB4O2ZvbnQtc2l6ZToxNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoyMHB4O3RleHQtYWxpZ246Y2VudGVyO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiNlZWU7Ym9yZGVyOjFweCBzb2xpZCAjY2NjfS5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5pbnB1dC1hcHBlbmQgLmJ0biwuaW5wdXQtcHJlcGVuZCAuYnRuLC5pbnB1dC1hcHBlbmQgLmJ0bi1ncm91cD4uZHJvcGRvd24tdG9nZ2xlLC5pbnB1dC1wcmVwZW5kIC5idG4tZ3JvdXA+LmRyb3Bkb3duLXRvZ2dsZXt2ZXJ0aWNhbC1hbGlnbjp0b3A7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowfS5pbnB1dC1hcHBlbmQgLmFjdGl2ZSwuaW5wdXQtcHJlcGVuZCAuYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2E5ZGJhOTtib3JkZXItY29sb3I6IzQ2YTU0Nn0uaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5pbnB1dC1wcmVwZW5kIC5idG57bWFyZ2luLXJpZ2h0Oi0xcHh9LmlucHV0LXByZXBlbmQgLmFkZC1vbjpmaXJzdC1jaGlsZCwuaW5wdXQtcHJlcGVuZCAuYnRuOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweH0uaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDtib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4fS5pbnB1dC1hcHBlbmQgaW5wdXQrLmJ0bi1ncm91cCAuYnRuOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCBzZWxlY3QrLmJ0bi1ncm91cCAuYnRuOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCAudW5lZGl0YWJsZS1pbnB1dCsuYnRuLWdyb3VwIC5idG46bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDB9LmlucHV0LWFwcGVuZCAuYWRkLW9uLC5pbnB1dC1hcHBlbmQgLmJ0biwuaW5wdXQtYXBwZW5kIC5idG4tZ3JvdXB7bWFyZ2luLWxlZnQ6LTFweH0uaW5wdXQtYXBwZW5kIC5hZGQtb246bGFzdC1jaGlsZCwuaW5wdXQtYXBwZW5kIC5idG46bGFzdC1jaGlsZCwuaW5wdXQtYXBwZW5kIC5idG4tZ3JvdXA6bGFzdC1jaGlsZD4uZHJvcGRvd24tdG9nZ2xley13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH0uaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgaW5wdXQsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIHNlbGVjdCwuaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowfS5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCBpbnB1dCsuYnRuLWdyb3VwIC5idG4sLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIHNlbGVjdCsuYnRuLWdyb3VwIC5idG4sLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0Ky5idG4tZ3JvdXAgLmJ0bnstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDB9LmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5hZGQtb246Zmlyc3QtY2hpbGQsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5idG46Zmlyc3QtY2hpbGR7bWFyZ2luLXJpZ2h0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDtib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4fS5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAuYWRkLW9uOmxhc3QtY2hpbGQsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5idG46bGFzdC1jaGlsZHttYXJnaW4tbGVmdDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH0uaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLmJ0bi1ncm91cDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowfWlucHV0LnNlYXJjaC1xdWVyeXtwYWRkaW5nLXJpZ2h0OjE0cHg7cGFkZGluZy1yaWdodDo0cHggXDk7cGFkZGluZy1sZWZ0OjE0cHg7cGFkZGluZy1sZWZ0OjRweCBcOTttYXJnaW4tYm90dG9tOjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjE1cHg7LW1vei1ib3JkZXItcmFkaXVzOjE1cHg7Ym9yZGVyLXJhZGl1czoxNXB4fS5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kIC5zZWFyY2gtcXVlcnksLmZvcm0tc2VhcmNoIC5pbnB1dC1wcmVwZW5kIC5zZWFyY2gtcXVlcnl7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowfS5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kIC5zZWFyY2gtcXVlcnl7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7LW1vei1ib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7Ym9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4fS5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kIC5idG57LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7Ym9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwfS5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCAuc2VhcmNoLXF1ZXJ5ey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwO2JvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMH0uZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQgLmJ0bnstd2Via2l0LWJvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDstbW96LWJvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDtib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHh9LmZvcm0tc2VhcmNoIGlucHV0LC5mb3JtLWlubGluZSBpbnB1dCwuZm9ybS1ob3Jpem9udGFsIGlucHV0LC5mb3JtLXNlYXJjaCB0ZXh0YXJlYSwuZm9ybS1pbmxpbmUgdGV4dGFyZWEsLmZvcm0taG9yaXpvbnRhbCB0ZXh0YXJlYSwuZm9ybS1zZWFyY2ggc2VsZWN0LC5mb3JtLWlubGluZSBzZWxlY3QsLmZvcm0taG9yaXpvbnRhbCBzZWxlY3QsLmZvcm0tc2VhcmNoIC5oZWxwLWlubGluZSwuZm9ybS1pbmxpbmUgLmhlbHAtaW5saW5lLC5mb3JtLWhvcml6b250YWwgLmhlbHAtaW5saW5lLC5mb3JtLXNlYXJjaCAudW5lZGl0YWJsZS1pbnB1dCwuZm9ybS1pbmxpbmUgLnVuZWRpdGFibGUtaW5wdXQsLmZvcm0taG9yaXpvbnRhbCAudW5lZGl0YWJsZS1pbnB1dCwuZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQsLmZvcm0taW5saW5lIC5pbnB1dC1wcmVwZW5kLC5mb3JtLWhvcml6b250YWwgLmlucHV0LXByZXBlbmQsLmZvcm0tc2VhcmNoIC5pbnB1dC1hcHBlbmQsLmZvcm0taW5saW5lIC5pbnB1dC1hcHBlbmQsLmZvcm0taG9yaXpvbnRhbCAuaW5wdXQtYXBwZW5ke2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTttYXJnaW4tYm90dG9tOjA7dmVydGljYWwtYWxpZ246bWlkZGxlOyp6b29tOjF9LmZvcm0tc2VhcmNoIC5oaWRlLC5mb3JtLWlubGluZSAuaGlkZSwuZm9ybS1ob3Jpem9udGFsIC5oaWRle2Rpc3BsYXk6bm9uZX0uZm9ybS1zZWFyY2ggbGFiZWwsLmZvcm0taW5saW5lIGxhYmVsLC5mb3JtLXNlYXJjaCAuYnRuLWdyb3VwLC5mb3JtLWlubGluZSAuYnRuLWdyb3Vwe2Rpc3BsYXk6aW5saW5lLWJsb2NrfS5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kLC5mb3JtLWlubGluZSAuaW5wdXQtYXBwZW5kLC5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCwuZm9ybS1pbmxpbmUgLmlucHV0LXByZXBlbmR7bWFyZ2luLWJvdHRvbTowfS5mb3JtLXNlYXJjaCAucmFkaW8sLmZvcm0tc2VhcmNoIC5jaGVja2JveCwuZm9ybS1pbmxpbmUgLnJhZGlvLC5mb3JtLWlubGluZSAuY2hlY2tib3h7cGFkZGluZy1sZWZ0OjA7bWFyZ2luLWJvdHRvbTowO3ZlcnRpY2FsLWFsaWduOm1pZGRsZX0uZm9ybS1zZWFyY2ggLnJhZGlvIGlucHV0W3R5cGU9InJhZGlvIl0sLmZvcm0tc2VhcmNoIC5jaGVja2JveCBpbnB1dFt0eXBlPSJjaGVja2JveCJdLC5mb3JtLWlubGluZSAucmFkaW8gaW5wdXRbdHlwZT0icmFkaW8iXSwuZm9ybS1pbmxpbmUgLmNoZWNrYm94IGlucHV0W3R5cGU9ImNoZWNrYm94Il17ZmxvYXQ6bGVmdDttYXJnaW4tcmlnaHQ6M3B4O21hcmdpbi1sZWZ0OjB9LmNvbnRyb2wtZ3JvdXB7bWFyZ2luLWJvdHRvbToxMHB4fWxlZ2VuZCsuY29udHJvbC1ncm91cHttYXJnaW4tdG9wOjIwcHg7LXdlYmtpdC1tYXJnaW4tdG9wLWNvbGxhcHNlOnNlcGFyYXRlfS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtZ3JvdXB7bWFyZ2luLWJvdHRvbToyMHB4Oyp6b29tOjF9LmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cDpiZWZvcmUsLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWdyb3VwOmFmdGVye2NsZWFyOmJvdGh9LmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1sYWJlbHtmbG9hdDpsZWZ0O3dpZHRoOjE2MHB4O3BhZGRpbmctdG9wOjVweDt0ZXh0LWFsaWduOnJpZ2h0fS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2xzeypkaXNwbGF5OmlubGluZS1ibG9jazsqcGFkZGluZy1sZWZ0OjIwcHg7bWFyZ2luLWxlZnQ6MTgwcHg7Km1hcmdpbi1sZWZ0OjB9LmZvcm0taG9yaXpvbnRhbCAuY29udHJvbHM6Zmlyc3QtY2hpbGR7KnBhZGRpbmctbGVmdDoxODBweH0uZm9ybS1ob3Jpem9udGFsIC5oZWxwLWJsb2Nre21hcmdpbi1ib3R0b206MH0uZm9ybS1ob3Jpem9udGFsIGlucHV0Ky5oZWxwLWJsb2NrLC5mb3JtLWhvcml6b250YWwgc2VsZWN0Ky5oZWxwLWJsb2NrLC5mb3JtLWhvcml6b250YWwgdGV4dGFyZWErLmhlbHAtYmxvY2ssLmZvcm0taG9yaXpvbnRhbCAudW5lZGl0YWJsZS1pbnB1dCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIC5pbnB1dC1wcmVwZW5kKy5oZWxwLWJsb2NrLC5mb3JtLWhvcml6b250YWwgLmlucHV0LWFwcGVuZCsuaGVscC1ibG9ja3ttYXJnaW4tdG9wOjEwcHh9LmZvcm0taG9yaXpvbnRhbCAuZm9ybS1hY3Rpb25ze3BhZGRpbmctbGVmdDoxODBweH10YWJsZXttYXgtd2lkdGg6MTAwJTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowfS50YWJsZXt3aWR0aDoxMDAlO21hcmdpbi1ib3R0b206MjBweH0udGFibGUgdGgsLnRhYmxlIHRke3BhZGRpbmc6OHB4O2xpbmUtaGVpZ2h0OjIwcHg7dGV4dC1hbGlnbjpsZWZ0O3ZlcnRpY2FsLWFsaWduOnRvcDtib3JkZXItdG9wOjFweCBzb2xpZCAjZGRkfS50YWJsZSB0aHtmb250LXdlaWdodDpib2xkfS50YWJsZSB0aGVhZCB0aHt2ZXJ0aWNhbC1hbGlnbjpib3R0b219LnRhYmxlIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZSBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0ZCwudGFibGUgdGhlYWQ6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRke2JvcmRlci10b3A6MH0udGFibGUgdGJvZHkrdGJvZHl7Ym9yZGVyLXRvcDoycHggc29saWQgI2RkZH0udGFibGUgLnRhYmxle2JhY2tncm91bmQtY29sb3I6I2ZmZn0udGFibGUtY29uZGVuc2VkIHRoLC50YWJsZS1jb25kZW5zZWQgdGR7cGFkZGluZzo0cHggNXB4fS50YWJsZS1ib3JkZXJlZHtib3JkZXI6MXB4IHNvbGlkICNkZGQ7Ym9yZGVyLWNvbGxhcHNlOnNlcGFyYXRlOypib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLWxlZnQ6MDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHh9LnRhYmxlLWJvcmRlcmVkIHRoLC50YWJsZS1ib3JkZXJlZCB0ZHtib3JkZXItbGVmdDoxcHggc29saWQgI2RkZH0udGFibGUtYm9yZGVyZWQgY2FwdGlvbit0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgY2FwdGlvbit0Ym9keSB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgY2FwdGlvbit0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZCwudGFibGUtYm9yZGVyZWQgdGhlYWQ6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0ZHtib3JkZXItdG9wOjB9LnRhYmxlLWJvcmRlcmVkIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRoOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZD50ZDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQ+dGg6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRkOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRoOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRoZWFkOmxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRkOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGg6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRmb290Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50ZDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGZvb3Q6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRoOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6NHB4fS50YWJsZS1ib3JkZXJlZCB0aGVhZDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGg6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRkOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50aDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Zm9vdDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGQ6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGZvb3Q6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRoOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRmb290K3Rib2R5Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZCB0ZDpmaXJzdC1jaGlsZHstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6MDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6MH0udGFibGUtYm9yZGVyZWQgdGZvb3QrdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkIHRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czowO2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjB9LnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGg6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQ6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZDpmaXJzdC1jaGlsZHstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjRweH0udGFibGUtYm9yZGVyZWQgY2FwdGlvbit0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHh9LnRhYmxlLXN0cmlwZWQgdGJvZHk+dHI6bnRoLWNoaWxkKG9kZCk+dGQsLnRhYmxlLXN0cmlwZWQgdGJvZHk+dHI6bnRoLWNoaWxkKG9kZCk+dGh7YmFja2dyb3VuZC1jb2xvcjojZjlmOWY5fS50YWJsZS1ob3ZlciB0Ym9keSB0cjpob3Zlcj50ZCwudGFibGUtaG92ZXIgdGJvZHkgdHI6aG92ZXI+dGh7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1fXRhYmxlIHRkW2NsYXNzKj0ic3BhbiJdLHRhYmxlIHRoW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgdGFibGUgdGRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0YWJsZSB0aFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OnRhYmxlLWNlbGw7ZmxvYXQ6bm9uZTttYXJnaW4tbGVmdDowfS50YWJsZSB0ZC5zcGFuMSwudGFibGUgdGguc3BhbjF7ZmxvYXQ6bm9uZTt3aWR0aDo0NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW4yLC50YWJsZSB0aC5zcGFuMntmbG9hdDpub25lO3dpZHRoOjEyNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW4zLC50YWJsZSB0aC5zcGFuM3tmbG9hdDpub25lO3dpZHRoOjIwNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW40LC50YWJsZSB0aC5zcGFuNHtmbG9hdDpub25lO3dpZHRoOjI4NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW41LC50YWJsZSB0aC5zcGFuNXtmbG9hdDpub25lO3dpZHRoOjM2NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW42LC50YWJsZSB0aC5zcGFuNntmbG9hdDpub25lO3dpZHRoOjQ0NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW43LC50YWJsZSB0aC5zcGFuN3tmbG9hdDpub25lO3dpZHRoOjUyNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW44LC50YWJsZSB0aC5zcGFuOHtmbG9hdDpub25lO3dpZHRoOjYwNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW45LC50YWJsZSB0aC5zcGFuOXtmbG9hdDpub25lO3dpZHRoOjY4NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW4xMCwudGFibGUgdGguc3BhbjEwe2Zsb2F0Om5vbmU7d2lkdGg6NzY0cHg7bWFyZ2luLWxlZnQ6MH0udGFibGUgdGQuc3BhbjExLC50YWJsZSB0aC5zcGFuMTF7ZmxvYXQ6bm9uZTt3aWR0aDo4NDRweDttYXJnaW4tbGVmdDowfS50YWJsZSB0ZC5zcGFuMTIsLnRhYmxlIHRoLnNwYW4xMntmbG9hdDpub25lO3dpZHRoOjkyNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRib2R5IHRyLnN1Y2Nlc3M+dGR7YmFja2dyb3VuZC1jb2xvcjojZGZmMGQ4fS50YWJsZSB0Ym9keSB0ci5lcnJvcj50ZHtiYWNrZ3JvdW5kLWNvbG9yOiNmMmRlZGV9LnRhYmxlIHRib2R5IHRyLndhcm5pbmc+dGR7YmFja2dyb3VuZC1jb2xvcjojZmNmOGUzfS50YWJsZSB0Ym9keSB0ci5pbmZvPnRke2JhY2tncm91bmQtY29sb3I6I2Q5ZWRmN30udGFibGUtaG92ZXIgdGJvZHkgdHIuc3VjY2Vzczpob3Zlcj50ZHtiYWNrZ3JvdW5kLWNvbG9yOiNkMGU5YzZ9LnRhYmxlLWhvdmVyIHRib2R5IHRyLmVycm9yOmhvdmVyPnRke2JhY2tncm91bmQtY29sb3I6I2ViY2NjY30udGFibGUtaG92ZXIgdGJvZHkgdHIud2FybmluZzpob3Zlcj50ZHtiYWNrZ3JvdW5kLWNvbG9yOiNmYWYyY2N9LnRhYmxlLWhvdmVyIHRib2R5IHRyLmluZm86aG92ZXI+dGR7YmFja2dyb3VuZC1jb2xvcjojYzRlM2YzfVtjbGFzc149Imljb24tIl0sW2NsYXNzKj0iIGljb24tIl17ZGlzcGxheTppbmxpbmUtYmxvY2s7d2lkdGg6MTRweDtoZWlnaHQ6MTRweDttYXJnaW4tdG9wOjFweDsqbWFyZ2luLXJpZ2h0Oi4zZW07bGluZS1oZWlnaHQ6MTRweDt2ZXJ0aWNhbC1hbGlnbjp0ZXh0LXRvcDtiYWNrZ3JvdW5kLWltYWdlOnVybCgiLi4vaW1nL2dseXBoaWNvbnMtaGFsZmxpbmdzLnBuZyIpO2JhY2tncm91bmQtcG9zaXRpb246MTRweCAxNHB4O2JhY2tncm91bmQtcmVwZWF0Om5vLXJlcGVhdH0uaWNvbi13aGl0ZSwubmF2LXBpbGxzPi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXYtcGlsbHM+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5uYXYtbGlzdD4uYWN0aXZlPmE+W2NsYXNzXj0iaWNvbi0iXSwubmF2LWxpc3Q+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5uYXZiYXItaW52ZXJzZSAubmF2Pi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXZiYXItaW52ZXJzZSAubmF2Pi5hY3RpdmU+YT5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tbWVudT5saT5hOmhvdmVyPltjbGFzc149Imljb24tIl0sLmRyb3Bkb3duLW1lbnU+bGk+YTpmb2N1cz5bY2xhc3NePSJpY29uLSJdLC5kcm9wZG93bi1tZW51PmxpPmE6aG92ZXI+W2NsYXNzKj0iIGljb24tIl0sLmRyb3Bkb3duLW1lbnU+bGk+YTpmb2N1cz5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE+W2NsYXNzXj0iaWNvbi0iXSwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE+W2NsYXNzKj0iIGljb24tIl0sLmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YT5bY2xhc3NePSJpY29uLSJdLC5kcm9wZG93bi1zdWJtZW51OmZvY3VzPmE+W2NsYXNzXj0iaWNvbi0iXSwuZHJvcGRvd24tc3VibWVudTpob3Zlcj5hPltjbGFzcyo9IiBpY29uLSJdLC5kcm9wZG93bi1zdWJtZW51OmZvY3VzPmE+W2NsYXNzKj0iIGljb24tIl17YmFja2dyb3VuZC1pbWFnZTp1cmwoIi4uL2ltZy9nbHlwaGljb25zLWhhbGZsaW5ncy13aGl0ZS5wbmciKX0uaWNvbi1nbGFzc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMH0uaWNvbi1tdXNpY3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IDB9Lmljb24tc2VhcmNoe2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggMH0uaWNvbi1lbnZlbG9wZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IDB9Lmljb24taGVhcnR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAwfS5pY29uLXN0YXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggMH0uaWNvbi1zdGFyLWVtcHR5e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IDB9Lmljb24tdXNlcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAwfS5pY29uLWZpbG17YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggMH0uaWNvbi10aC1sYXJnZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAwfS5pY29uLXRoe2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IDB9Lmljb24tdGgtbGlzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAwfS5pY29uLW9re2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IDB9Lmljb24tcmVtb3Zle2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IDB9Lmljb24tem9vbS1pbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAwfS5pY29uLXpvb20tb3V0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IDB9Lmljb24tb2Zme2JhY2tncm91bmQtcG9zaXRpb246LTM4NHB4IDB9Lmljb24tc2lnbmFse2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IDB9Lmljb24tY29ne2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IDB9Lmljb24tdHJhc2h7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggMH0uaWNvbi1ob21le2JhY2tncm91bmQtcG9zaXRpb246MCAtMjRweH0uaWNvbi1maWxle2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTI0cHh9Lmljb24tdGltZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC0yNHB4fS5pY29uLXJvYWR7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMjRweH0uaWNvbi1kb3dubG9hZC1hbHR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMjRweH0uaWNvbi1kb3dubG9hZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtMjRweH0uaWNvbi11cGxvYWR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTI0cHh9Lmljb24taW5ib3h7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTI0cHh9Lmljb24tcGxheS1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggLTI0cHh9Lmljb24tcmVwZWF0e2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0yNHB4fS5pY29uLXJlZnJlc2h7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTI0cHh9Lmljb24tbGlzdC1hbHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTI0cHh9Lmljb24tbG9ja3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODdweCAtMjRweH0uaWNvbi1mbGFne2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC0yNHB4fS5pY29uLWhlYWRwaG9uZXN7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTI0cHh9Lmljb24tdm9sdW1lLW9mZntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtMjRweH0uaWNvbi12b2x1bWUtZG93bntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMjRweH0uaWNvbi12b2x1bWUtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTI0cHh9Lmljb24tcXJjb2Rle2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0yNHB4fS5pY29uLWJhcmNvZGV7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTI0cHh9Lmljb24tdGFne2JhY2tncm91bmQtcG9zaXRpb246MCAtNDhweH0uaWNvbi10YWdze2JhY2tncm91bmQtcG9zaXRpb246LTI1cHggLTQ4cHh9Lmljb24tYm9va3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC00OHB4fS5pY29uLWJvb2ttYXJre2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTQ4cHh9Lmljb24tcHJpbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtNDhweH0uaWNvbi1jYW1lcmF7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTQ4cHh9Lmljb24tZm9udHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNDRweCAtNDhweH0uaWNvbi1ib2xke2JhY2tncm91bmQtcG9zaXRpb246LTE2N3B4IC00OHB4fS5pY29uLWl0YWxpY3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtNDhweH0uaWNvbi10ZXh0LWhlaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAtNDhweH0uaWNvbi10ZXh0LXdpZHRoe2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC00OHB4fS5pY29uLWFsaWduLWxlZnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTQ4cHh9Lmljb24tYWxpZ24tY2VudGVye2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IC00OHB4fS5pY29uLWFsaWduLXJpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC00OHB4fS5pY29uLWFsaWduLWp1c3RpZnl7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTQ4cHh9Lmljb24tbGlzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtNDhweH0uaWNvbi1pbmRlbnQtbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtNDhweH0uaWNvbi1pbmRlbnQtcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTQ4cHh9Lmljb24tZmFjZXRpbWUtdmlkZW97YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTQ4cHh9Lmljb24tcGljdHVyZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtNDhweH0uaWNvbi1wZW5jaWx7YmFja2dyb3VuZC1wb3NpdGlvbjowIC03MnB4fS5pY29uLW1hcC1tYXJrZXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtNzJweH0uaWNvbi1hZGp1c3R7YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtNzJweH0uaWNvbi10aW50e2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTcycHh9Lmljb24tZWRpdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC03MnB4fS5pY29uLXNoYXJle2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC03MnB4fS5pY29uLWNoZWNre2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC03MnB4fS5pY29uLW1vdmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTcycHh9Lmljb24tc3RlcC1iYWNrd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtNzJweH0uaWNvbi1mYXN0LWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC03MnB4fS5pY29uLWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC03MnB4fS5pY29uLXBsYXl7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTcycHh9Lmljb24tcGF1c2V7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTcycHh9Lmljb24tc3RvcHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMTJweCAtNzJweH0uaWNvbi1mb3J3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC03MnB4fS5pY29uLWZhc3QtZm9yd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtNzJweH0uaWNvbi1zdGVwLWZvcndhcmR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTcycHh9Lmljb24tZWplY3R7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTcycHh9Lmljb24tY2hldnJvbi1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC03MnB4fS5pY29uLWNoZXZyb24tcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTcycHh9Lmljb24tcGx1cy1zaWdue2JhY2tncm91bmQtcG9zaXRpb246MCAtOTZweH0uaWNvbi1taW51cy1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTk2cHh9Lmljb24tcmVtb3ZlLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtOTZweH0uaWNvbi1vay1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTk2cHh9Lmljb24tcXVlc3Rpb24tc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC05NnB4fS5pY29uLWluZm8tc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtOTZweH0uaWNvbi1zY3JlZW5zaG90e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC05NnB4fS5pY29uLXJlbW92ZS1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTk2cHh9Lmljb24tb2stY2lyY2xle2JhY2tncm91bmQtcG9zaXRpb246LTE5MnB4IC05NnB4fS5pY29uLWJhbi1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTk2cHh9Lmljb24tYXJyb3ctbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNDBweCAtOTZweH0uaWNvbi1hcnJvdy1yaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtOTZweH0uaWNvbi1hcnJvdy11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODlweCAtOTZweH0uaWNvbi1hcnJvdy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC05NnB4fS5pY29uLXNoYXJlLWFsdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtOTZweH0uaWNvbi1yZXNpemUtZnVsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtOTZweH0uaWNvbi1yZXNpemUtc21hbGx7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTk2cHh9Lmljb24tcGx1c3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtOTZweH0uaWNvbi1taW51c3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MzNweCAtOTZweH0uaWNvbi1hc3Rlcmlza3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtOTZweH0uaWNvbi1leGNsYW1hdGlvbi1zaWdue2JhY2tncm91bmQtcG9zaXRpb246MCAtMTIwcHh9Lmljb24tZ2lmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IC0xMjBweH0uaWNvbi1sZWFme2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggLTEyMHB4fS5pY29uLWZpcmV7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMTIwcHh9Lmljb24tZXllLW9wZW57YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMTIwcHh9Lmljb24tZXllLWNsb3Nle2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC0xMjBweH0uaWNvbi13YXJuaW5nLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTEyMHB4fS5pY29uLXBsYW5le2JhY2tncm91bmQtcG9zaXRpb246LTE2OHB4IC0xMjBweH0uaWNvbi1jYWxlbmRhcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMTIwcHh9Lmljb24tcmFuZG9te3dpZHRoOjE2cHg7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTEyMHB4fS5pY29uLWNvbW1lbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTEyMHB4fS5pY29uLW1hZ25ldHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtMTIwcHh9Lmljb24tY2hldnJvbi11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODhweCAtMTIwcHh9Lmljb24tY2hldnJvbi1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxM3B4IC0xMTlweH0uaWNvbi1yZXR3ZWV0e2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC0xMjBweH0uaWNvbi1zaG9wcGluZy1jYXJ0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0xMjBweH0uaWNvbi1mb2xkZXItY2xvc2V7d2lkdGg6MTZweDtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMTIwcHh9Lmljb24tZm9sZGVyLW9wZW57d2lkdGg6MTZweDtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtMTIwcHh9Lmljb24tcmVzaXplLXZlcnRpY2Fse2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0xMTlweH0uaWNvbi1yZXNpemUtaG9yaXpvbnRhbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtMTE4cHh9Lmljb24taGRke2JhY2tncm91bmQtcG9zaXRpb246MCAtMTQ0cHh9Lmljb24tYnVsbGhvcm57YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtMTQ0cHh9Lmljb24tYmVsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC0xNDRweH0uaWNvbi1jZXJ0aWZpY2F0ZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IC0xNDRweH0uaWNvbi10aHVtYnMtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMTQ0cHh9Lmljb24tdGh1bWJzLWRvd257YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTE0NHB4fS5pY29uLWhhbmQtcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTE0NHB4fS5pY29uLWhhbmQtbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAtMTQ0cHh9Lmljb24taGFuZC11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMTQ0cHh9Lmljb24taGFuZC1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0xNDRweH0uaWNvbi1jaXJjbGUtYXJyb3ctcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTE0NHB4fS5pY29uLWNpcmNsZS1hcnJvdy1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTI2NHB4IC0xNDRweH0uaWNvbi1jaXJjbGUtYXJyb3ctdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTE0NHB4fS5pY29uLWNpcmNsZS1hcnJvdy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC0xNDRweH0uaWNvbi1nbG9iZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtMTQ0cHh9Lmljb24td3JlbmNoe2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0xNDRweH0uaWNvbi10YXNrc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMTQ0cHh9Lmljb24tZmlsdGVye2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IC0xNDRweH0uaWNvbi1icmllZmNhc2V7YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTE0NHB4fS5pY29uLWZ1bGxzY3JlZW57YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTE0NHB4fS5kcm9wdXAsLmRyb3Bkb3due3Bvc2l0aW9uOnJlbGF0aXZlfS5kcm9wZG93bi10b2dnbGV7Km1hcmdpbi1ib3R0b206LTNweH0uZHJvcGRvd24tdG9nZ2xlOmFjdGl2ZSwub3BlbiAuZHJvcGRvd24tdG9nZ2xle291dGxpbmU6MH0uY2FyZXR7ZGlzcGxheTppbmxpbmUtYmxvY2s7d2lkdGg6MDtoZWlnaHQ6MDt2ZXJ0aWNhbC1hbGlnbjp0b3A7Ym9yZGVyLXRvcDo0cHggc29saWQgIzAwMDtib3JkZXItcmlnaHQ6NHB4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1sZWZ0OjRweCBzb2xpZCB0cmFuc3BhcmVudDtjb250ZW50OiIifS5kcm9wZG93biAuY2FyZXR7bWFyZ2luLXRvcDo4cHg7bWFyZ2luLWxlZnQ6MnB4fS5kcm9wZG93bi1tZW51e3Bvc2l0aW9uOmFic29sdXRlO3RvcDoxMDAlO2xlZnQ6MDt6LWluZGV4OjEwMDA7ZGlzcGxheTpub25lO2Zsb2F0OmxlZnQ7bWluLXdpZHRoOjE2MHB4O3BhZGRpbmc6NXB4IDA7bWFyZ2luOjJweCAwIDA7bGlzdC1zdHlsZTpub25lO2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MXB4IHNvbGlkICNjY2M7Ym9yZGVyOjFweCBzb2xpZCByZ2JhKDAsMCwwLDAuMik7KmJvcmRlci1yaWdodC13aWR0aDoycHg7KmJvcmRlci1ib3R0b20td2lkdGg6MnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDstd2Via2l0LWJveC1zaGFkb3c6MCA1cHggMTBweCByZ2JhKDAsMCwwLDAuMik7LW1vei1ib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLDAsMCwwLjIpO2JveC1zaGFkb3c6MCA1cHggMTBweCByZ2JhKDAsMCwwLDAuMik7LXdlYmtpdC1iYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3g7LW1vei1iYWNrZ3JvdW5kLWNsaXA6cGFkZGluZztiYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3h9LmRyb3Bkb3duLW1lbnUucHVsbC1yaWdodHtyaWdodDowO2xlZnQ6YXV0b30uZHJvcGRvd24tbWVudSAuZGl2aWRlcnsqd2lkdGg6MTAwJTtoZWlnaHQ6MXB4O21hcmdpbjo5cHggMXB4OyptYXJnaW46LTVweCAwIDVweDtvdmVyZmxvdzpoaWRkZW47YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNmZmZ9LmRyb3Bkb3duLW1lbnU+bGk+YXtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6M3B4IDIwcHg7Y2xlYXI6Ym90aDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojMzMzO3doaXRlLXNwYWNlOm5vd3JhcH0uZHJvcGRvd24tbWVudT5saT5hOmhvdmVyLC5kcm9wZG93bi1tZW51PmxpPmE6Zm9jdXMsLmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YSwuZHJvcGRvd24tc3VibWVudTpmb2N1cz5he2NvbG9yOiNmZmY7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojMDA4MWMyO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCMwOGMsIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzA4YyksdG8oIzAwNzdiMykpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCMwOGMsIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCMwOGMsIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCMwOGMsIzAwNzdiMyk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYwMDg4Y2MnLGVuZENvbG9yc3RyPScjZmYwMDc3YjMnLEdyYWRpZW50VHlwZT0wKX0uZHJvcGRvd24tbWVudT4uYWN0aXZlPmEsLmRyb3Bkb3duLW1lbnU+LmFjdGl2ZT5hOmhvdmVyLC5kcm9wZG93bi1tZW51Pi5hY3RpdmU+YTpmb2N1c3tjb2xvcjojZmZmO3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtY29sb3I6IzAwODFjMjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjMDhjLCMwMDc3YjMpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCMwOGMpLHRvKCMwMDc3YjMpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjMDhjLCMwMDc3YjMpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjMDhjLCMwMDc3YjMpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjMDhjLCMwMDc3YjMpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O291dGxpbmU6MDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjAwODhjYycsZW5kQ29sb3JzdHI9JyNmZjAwNzdiMycsR3JhZGllbnRUeXBlPTApfS5kcm9wZG93bi1tZW51Pi5kaXNhYmxlZD5hLC5kcm9wZG93bi1tZW51Pi5kaXNhYmxlZD5hOmhvdmVyLC5kcm9wZG93bi1tZW51Pi5kaXNhYmxlZD5hOmZvY3Vze2NvbG9yOiM5OTl9LmRyb3Bkb3duLW1lbnU+LmRpc2FibGVkPmE6aG92ZXIsLmRyb3Bkb3duLW1lbnU+LmRpc2FibGVkPmE6Zm9jdXN7dGV4dC1kZWNvcmF0aW9uOm5vbmU7Y3Vyc29yOmRlZmF1bHQ7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtiYWNrZ3JvdW5kLWltYWdlOm5vbmU7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0ub3Blbnsqei1pbmRleDoxMDAwfS5vcGVuPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2t9LnB1bGwtcmlnaHQ+LmRyb3Bkb3duLW1lbnV7cmlnaHQ6MDtsZWZ0OmF1dG99LmRyb3B1cCAuY2FyZXQsLm5hdmJhci1maXhlZC1ib3R0b20gLmRyb3Bkb3duIC5jYXJldHtib3JkZXItdG9wOjA7Ym9yZGVyLWJvdHRvbTo0cHggc29saWQgIzAwMDtjb250ZW50OiIifS5kcm9wdXAgLmRyb3Bkb3duLW1lbnUsLm5hdmJhci1maXhlZC1ib3R0b20gLmRyb3Bkb3duIC5kcm9wZG93bi1tZW51e3RvcDphdXRvO2JvdHRvbToxMDAlO21hcmdpbi1ib3R0b206MXB4fS5kcm9wZG93bi1zdWJtZW51e3Bvc2l0aW9uOnJlbGF0aXZlfS5kcm9wZG93bi1zdWJtZW51Pi5kcm9wZG93bi1tZW51e3RvcDowO2xlZnQ6MTAwJTttYXJnaW4tdG9wOi02cHg7bWFyZ2luLWxlZnQ6LTFweDstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA2cHggNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6MCA2cHggNnB4IDZweDtib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHh9LmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+LmRyb3Bkb3duLW1lbnV7ZGlzcGxheTpibG9ja30uZHJvcHVwIC5kcm9wZG93bi1zdWJtZW51Pi5kcm9wZG93bi1tZW51e3RvcDphdXRvO2JvdHRvbTowO21hcmdpbi10b3A6MDttYXJnaW4tYm90dG9tOi0ycHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjVweCA1cHggNXB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjVweCA1cHggNXB4IDA7Ym9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwfS5kcm9wZG93bi1zdWJtZW51PmE6YWZ0ZXJ7ZGlzcGxheTpibG9jaztmbG9hdDpyaWdodDt3aWR0aDowO2hlaWdodDowO21hcmdpbi10b3A6NXB4O21hcmdpbi1yaWdodDotMTBweDtib3JkZXItY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLWxlZnQtY29sb3I6I2NjYztib3JkZXItc3R5bGU6c29saWQ7Ym9yZGVyLXdpZHRoOjVweCAwIDVweCA1cHg7Y29udGVudDoiICJ9LmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YTphZnRlcntib3JkZXItbGVmdC1jb2xvcjojZmZmfS5kcm9wZG93bi1zdWJtZW51LnB1bGwtbGVmdHtmbG9hdDpub25lfS5kcm9wZG93bi1zdWJtZW51LnB1bGwtbGVmdD4uZHJvcGRvd24tbWVudXtsZWZ0Oi0xMDAlO21hcmdpbi1sZWZ0OjEwcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweCAwIDZweCA2cHg7Ym9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4fS5kcm9wZG93biAuZHJvcGRvd24tbWVudSAubmF2LWhlYWRlcntwYWRkaW5nLXJpZ2h0OjIwcHg7cGFkZGluZy1sZWZ0OjIwcHh9LnR5cGVhaGVhZHt6LWluZGV4OjEwNTE7bWFyZ2luLXRvcDoycHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fS53ZWxse21pbi1oZWlnaHQ6MjBweDtwYWRkaW5nOjE5cHg7bWFyZ2luLWJvdHRvbToyMHB4O2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTtib3JkZXI6MXB4IHNvbGlkICNlM2UzZTM7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA1KX0ud2VsbCBibG9ja3F1b3Rle2JvcmRlci1jb2xvcjojZGRkO2JvcmRlci1jb2xvcjpyZ2JhKDAsMCwwLDAuMTUpfS53ZWxsLWxhcmdle3BhZGRpbmc6MjRweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHh9LndlbGwtc21hbGx7cGFkZGluZzo5cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4fS5mYWRle29wYWNpdHk6MDstd2Via2l0LXRyYW5zaXRpb246b3BhY2l0eSAuMTVzIGxpbmVhcjstbW96LXRyYW5zaXRpb246b3BhY2l0eSAuMTVzIGxpbmVhcjstby10cmFuc2l0aW9uOm9wYWNpdHkgLjE1cyBsaW5lYXI7dHJhbnNpdGlvbjpvcGFjaXR5IC4xNXMgbGluZWFyfS5mYWRlLmlue29wYWNpdHk6MX0uY29sbGFwc2V7cG9zaXRpb246cmVsYXRpdmU7aGVpZ2h0OjA7b3ZlcmZsb3c6aGlkZGVuOy13ZWJraXQtdHJhbnNpdGlvbjpoZWlnaHQgLjM1cyBlYXNlOy1tb3otdHJhbnNpdGlvbjpoZWlnaHQgLjM1cyBlYXNlOy1vLXRyYW5zaXRpb246aGVpZ2h0IC4zNXMgZWFzZTt0cmFuc2l0aW9uOmhlaWdodCAuMzVzIGVhc2V9LmNvbGxhcHNlLmlue2hlaWdodDphdXRvfS5jbG9zZXtmbG9hdDpyaWdodDtmb250LXNpemU6MjBweDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6IzAwMDt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmY7b3BhY2l0eTouMjtmaWx0ZXI6YWxwaGEob3BhY2l0eT0yMCl9LmNsb3NlOmhvdmVyLC5jbG9zZTpmb2N1c3tjb2xvcjojMDAwO3RleHQtZGVjb3JhdGlvbjpub25lO2N1cnNvcjpwb2ludGVyO29wYWNpdHk6LjQ7ZmlsdGVyOmFscGhhKG9wYWNpdHk9NDApfWJ1dHRvbi5jbG9zZXtwYWRkaW5nOjA7Y3Vyc29yOnBvaW50ZXI7YmFja2dyb3VuZDp0cmFuc3BhcmVudDtib3JkZXI6MDstd2Via2l0LWFwcGVhcmFuY2U6bm9uZX0uYnRue2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTtwYWRkaW5nOjRweCAxMnB4O21hcmdpbi1ib3R0b206MDsqbWFyZ2luLWxlZnQ6LjNlbTtmb250LXNpemU6MTRweDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiMzMzM7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1zaGFkb3c6MCAxcHggMXB4IHJnYmEoMjU1LDI1NSwyNTUsMC43NSk7dmVydGljYWwtYWxpZ246bWlkZGxlO2N1cnNvcjpwb2ludGVyO2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTsqYmFja2dyb3VuZC1jb2xvcjojZTZlNmU2O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2ZmZiksdG8oI2U2ZTZlNikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyOjFweCBzb2xpZCAjY2NjOypib3JkZXI6MDtib3JkZXItY29sb3I6I2U2ZTZlNiAjZTZlNmU2ICNiZmJmYmY7Ym9yZGVyLWNvbG9yOnJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjI1KTtib3JkZXItYm90dG9tLWNvbG9yOiNiM2IzYjM7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZmZmZmZmJyxlbmRDb2xvcnN0cj0nI2ZmZTZlNmU2JyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKTsqem9vbToxOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsMC4yKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMiksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsMC4yKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KX0uYnRuOmhvdmVyLC5idG46Zm9jdXMsLmJ0bjphY3RpdmUsLmJ0bi5hY3RpdmUsLmJ0bi5kaXNhYmxlZCwuYnRuW2Rpc2FibGVkXXtjb2xvcjojMzMzO2JhY2tncm91bmQtY29sb3I6I2U2ZTZlNjsqYmFja2dyb3VuZC1jb2xvcjojZDlkOWQ5fS5idG46YWN0aXZlLC5idG4uYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2NjYyBcOX0uYnRuOmZpcnN0LWNoaWxkeyptYXJnaW4tbGVmdDowfS5idG46aG92ZXIsLmJ0bjpmb2N1c3tjb2xvcjojMzMzO3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtcG9zaXRpb246MCAtMTVweDstd2Via2l0LXRyYW5zaXRpb246YmFja2dyb3VuZC1wb3NpdGlvbiAuMXMgbGluZWFyOy1tb3otdHJhbnNpdGlvbjpiYWNrZ3JvdW5kLXBvc2l0aW9uIC4xcyBsaW5lYXI7LW8tdHJhbnNpdGlvbjpiYWNrZ3JvdW5kLXBvc2l0aW9uIC4xcyBsaW5lYXI7dHJhbnNpdGlvbjpiYWNrZ3JvdW5kLXBvc2l0aW9uIC4xcyBsaW5lYXJ9LmJ0bjpmb2N1c3tvdXRsaW5lOnRoaW4gZG90dGVkICMzMzM7b3V0bGluZTo1cHggYXV0byAtd2Via2l0LWZvY3VzLXJpbmctY29sb3I7b3V0bGluZS1vZmZzZXQ6LTJweH0uYnRuLmFjdGl2ZSwuYnRuOmFjdGl2ZXtiYWNrZ3JvdW5kLWltYWdlOm5vbmU7b3V0bGluZTowOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsMC4xNSksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KX0uYnRuLmRpc2FibGVkLC5idG5bZGlzYWJsZWRde2N1cnNvcjpkZWZhdWx0O2JhY2tncm91bmQtaW1hZ2U6bm9uZTtvcGFjaXR5Oi42NTtmaWx0ZXI6YWxwaGEob3BhY2l0eT02NSk7LXdlYmtpdC1ib3gtc2hhZG93Om5vbmU7LW1vei1ib3gtc2hhZG93Om5vbmU7Ym94LXNoYWRvdzpub25lfS5idG4tbGFyZ2V7cGFkZGluZzoxMXB4IDE5cHg7Zm9udC1zaXplOjE3LjVweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHh9LmJ0bi1sYXJnZSBbY2xhc3NePSJpY29uLSJdLC5idG4tbGFyZ2UgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXRvcDo0cHh9LmJ0bi1zbWFsbHtwYWRkaW5nOjJweCAxMHB4O2ZvbnQtc2l6ZToxMS45cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4fS5idG4tc21hbGwgW2NsYXNzXj0iaWNvbi0iXSwuYnRuLXNtYWxsIFtjbGFzcyo9IiBpY29uLSJde21hcmdpbi10b3A6MH0uYnRuLW1pbmkgW2NsYXNzXj0iaWNvbi0iXSwuYnRuLW1pbmkgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXRvcDotMXB4fS5idG4tbWluaXtwYWRkaW5nOjAgNnB4O2ZvbnQtc2l6ZToxMC41cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4fS5idG4tYmxvY2t7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO3BhZGRpbmctcmlnaHQ6MDtwYWRkaW5nLWxlZnQ6MDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3h9LmJ0bi1ibG9jaysuYnRuLWJsb2Nre21hcmdpbi10b3A6NXB4fWlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi1ibG9jayxpbnB1dFt0eXBlPSJyZXNldCJdLmJ0bi1ibG9jayxpbnB1dFt0eXBlPSJidXR0b24iXS5idG4tYmxvY2t7d2lkdGg6MTAwJX0uYnRuLXByaW1hcnkuYWN0aXZlLC5idG4td2FybmluZy5hY3RpdmUsLmJ0bi1kYW5nZXIuYWN0aXZlLC5idG4tc3VjY2Vzcy5hY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZSwuYnRuLWludmVyc2UuYWN0aXZle2NvbG9yOnJnYmEoMjU1LDI1NSwyNTUsMC43NSl9LmJ0bi1wcmltYXJ5e2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMwMDZkY2M7KmJhY2tncm91bmQtY29sb3I6IzA0YztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjMDhjLCMwNGMpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCMwOGMpLHRvKCMwNGMpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjMDhjLCMwNGMpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjMDhjLCMwNGMpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjMDhjLCMwNGMpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojMDRjICMwNGMgIzAwMmE4MDtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmMDA4OGNjJyxlbmRDb2xvcnN0cj0nI2ZmMDA0NGNjJyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0uYnRuLXByaW1hcnk6aG92ZXIsLmJ0bi1wcmltYXJ5OmZvY3VzLC5idG4tcHJpbWFyeTphY3RpdmUsLmJ0bi1wcmltYXJ5LmFjdGl2ZSwuYnRuLXByaW1hcnkuZGlzYWJsZWQsLmJ0bi1wcmltYXJ5W2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzA0YzsqYmFja2dyb3VuZC1jb2xvcjojMDAzYmIzfS5idG4tcHJpbWFyeTphY3RpdmUsLmJ0bi1wcmltYXJ5LmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMwMzkgXDl9LmJ0bi13YXJuaW5ne2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiNmYWE3MzI7KmJhY2tncm91bmQtY29sb3I6I2Y4OTQwNjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjZmJiNDUwLCNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNmYmI0NTApLHRvKCNmODk0MDYpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZmJiNDUwLCNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZmJiNDUwLCNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjZmJiNDUwLCNmODk0MDYpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojZjg5NDA2ICNmODk0MDYgI2FkNjcwNDtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZmJiNDUwJyxlbmRDb2xvcnN0cj0nI2ZmZjg5NDA2JyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0uYnRuLXdhcm5pbmc6aG92ZXIsLmJ0bi13YXJuaW5nOmZvY3VzLC5idG4td2FybmluZzphY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZSwuYnRuLXdhcm5pbmcuZGlzYWJsZWQsLmJ0bi13YXJuaW5nW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6I2Y4OTQwNjsqYmFja2dyb3VuZC1jb2xvcjojZGY4NTA1fS5idG4td2FybmluZzphY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNjNjc2MDUgXDl9LmJ0bi1kYW5nZXJ7Y29sb3I6I2ZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsMCwwLDAuMjUpO2JhY2tncm91bmQtY29sb3I6I2RhNGY0OTsqYmFja2dyb3VuZC1jb2xvcjojYmQzNjJmO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2VlNWY1YiksdG8oI2JkMzYyZikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyLWNvbG9yOiNiZDM2MmYgI2JkMzYyZiAjODAyNDIwO2JvcmRlci1jb2xvcjpyZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4yNSk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZlZTVmNWInLGVuZENvbG9yc3RyPScjZmZiZDM2MmYnLEdyYWRpZW50VHlwZT0wKTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQ9ZmFsc2UpfS5idG4tZGFuZ2VyOmhvdmVyLC5idG4tZGFuZ2VyOmZvY3VzLC5idG4tZGFuZ2VyOmFjdGl2ZSwuYnRuLWRhbmdlci5hY3RpdmUsLmJ0bi1kYW5nZXIuZGlzYWJsZWQsLmJ0bi1kYW5nZXJbZGlzYWJsZWRde2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjojYmQzNjJmOypiYWNrZ3JvdW5kLWNvbG9yOiNhOTMwMmF9LmJ0bi1kYW5nZXI6YWN0aXZlLC5idG4tZGFuZ2VyLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiM5NDJhMjUgXDl9LmJ0bi1zdWNjZXNze2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiM1YmI3NWI7KmJhY2tncm91bmQtY29sb3I6IzUxYTM1MTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCM2MmM0NjIpLHRvKCM1MWEzNTEpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojNTFhMzUxICM1MWEzNTEgIzM4NzAzODtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNjJjNDYyJyxlbmRDb2xvcnN0cj0nI2ZmNTFhMzUxJyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0uYnRuLXN1Y2Nlc3M6aG92ZXIsLmJ0bi1zdWNjZXNzOmZvY3VzLC5idG4tc3VjY2VzczphY3RpdmUsLmJ0bi1zdWNjZXNzLmFjdGl2ZSwuYnRuLXN1Y2Nlc3MuZGlzYWJsZWQsLmJ0bi1zdWNjZXNzW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzUxYTM1MTsqYmFja2dyb3VuZC1jb2xvcjojNDk5MjQ5fS5idG4tc3VjY2VzczphY3RpdmUsLmJ0bi1zdWNjZXNzLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiM0MDgxNDAgXDl9LmJ0bi1pbmZve2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiM0OWFmY2Q7KmJhY2tncm91bmQtY29sb3I6IzJmOTZiNDtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjNWJjMGRlLCMyZjk2YjQpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCM1YmMwZGUpLHRvKCMyZjk2YjQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjNWJjMGRlLCMyZjk2YjQpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjNWJjMGRlLCMyZjk2YjQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjNWJjMGRlLCMyZjk2YjQpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojMmY5NmI0ICMyZjk2YjQgIzFmNjM3Nztib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNWJjMGRlJyxlbmRDb2xvcnN0cj0nI2ZmMmY5NmI0JyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0uYnRuLWluZm86aG92ZXIsLmJ0bi1pbmZvOmZvY3VzLC5idG4taW5mbzphY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZSwuYnRuLWluZm8uZGlzYWJsZWQsLmJ0bi1pbmZvW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzJmOTZiNDsqYmFja2dyb3VuZC1jb2xvcjojMmE4NWEwfS5idG4taW5mbzphY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMyNDc0OGMgXDl9LmJ0bi1pbnZlcnNle2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMzNjM2MzY7KmJhY2tncm91bmQtY29sb3I6IzIyMjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjNDQ0LCMyMjIpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCM0NDQpLHRvKCMyMjIpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjNDQ0LCMyMjIpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjNDQ0LCMyMjIpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjNDQ0LCMyMjIpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojMjIyICMyMjIgIzAwMDtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNDQ0NDQ0JyxlbmRDb2xvcnN0cj0nI2ZmMjIyMjIyJyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0uYnRuLWludmVyc2U6aG92ZXIsLmJ0bi1pbnZlcnNlOmZvY3VzLC5idG4taW52ZXJzZTphY3RpdmUsLmJ0bi1pbnZlcnNlLmFjdGl2ZSwuYnRuLWludmVyc2UuZGlzYWJsZWQsLmJ0bi1pbnZlcnNlW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzIyMjsqYmFja2dyb3VuZC1jb2xvcjojMTUxNTE1fS5idG4taW52ZXJzZTphY3RpdmUsLmJ0bi1pbnZlcnNlLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMwODA4MDggXDl9YnV0dG9uLmJ0bixpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG57KnBhZGRpbmctdG9wOjNweDsqcGFkZGluZy1ib3R0b206M3B4fWJ1dHRvbi5idG46Oi1tb3otZm9jdXMtaW5uZXIsaW5wdXRbdHlwZT0ic3VibWl0Il0uYnRuOjotbW96LWZvY3VzLWlubmVye3BhZGRpbmc6MDtib3JkZXI6MH1idXR0b24uYnRuLmJ0bi1sYXJnZSxpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG4uYnRuLWxhcmdleypwYWRkaW5nLXRvcDo3cHg7KnBhZGRpbmctYm90dG9tOjdweH1idXR0b24uYnRuLmJ0bi1zbWFsbCxpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG4uYnRuLXNtYWxseypwYWRkaW5nLXRvcDozcHg7KnBhZGRpbmctYm90dG9tOjNweH1idXR0b24uYnRuLmJ0bi1taW5pLGlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi5idG4tbWluaXsqcGFkZGluZy10b3A6MXB4OypwYWRkaW5nLWJvdHRvbToxcHh9LmJ0bi1saW5rLC5idG4tbGluazphY3RpdmUsLmJ0bi1saW5rW2Rpc2FibGVkXXtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JhY2tncm91bmQtaW1hZ2U6bm9uZTstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmV9LmJ0bi1saW5re2NvbG9yOiMwOGM7Y3Vyc29yOnBvaW50ZXI7Ym9yZGVyLWNvbG9yOnRyYW5zcGFyZW50Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MH0uYnRuLWxpbms6aG92ZXIsLmJ0bi1saW5rOmZvY3Vze2NvbG9yOiMwMDU1ODA7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5idG4tbGlua1tkaXNhYmxlZF06aG92ZXIsLmJ0bi1saW5rW2Rpc2FibGVkXTpmb2N1c3tjb2xvcjojMzMzO3RleHQtZGVjb3JhdGlvbjpub25lfS5idG4tZ3JvdXB7cG9zaXRpb246cmVsYXRpdmU7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyptYXJnaW4tbGVmdDouM2VtO2ZvbnQtc2l6ZTowO3doaXRlLXNwYWNlOm5vd3JhcDt2ZXJ0aWNhbC1hbGlnbjptaWRkbGU7Knpvb206MX0uYnRuLWdyb3VwOmZpcnN0LWNoaWxkeyptYXJnaW4tbGVmdDowfS5idG4tZ3JvdXArLmJ0bi1ncm91cHttYXJnaW4tbGVmdDo1cHh9LmJ0bi10b29sYmFye21hcmdpbi10b3A6MTBweDttYXJnaW4tYm90dG9tOjEwcHg7Zm9udC1zaXplOjB9LmJ0bi10b29sYmFyPi5idG4rLmJ0biwuYnRuLXRvb2xiYXI+LmJ0bi1ncm91cCsuYnRuLC5idG4tdG9vbGJhcj4uYnRuKy5idG4tZ3JvdXB7bWFyZ2luLWxlZnQ6NXB4fS5idG4tZ3JvdXA+LmJ0bntwb3NpdGlvbjpyZWxhdGl2ZTstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9LmJ0bi1ncm91cD4uYnRuKy5idG57bWFyZ2luLWxlZnQ6LTFweH0uYnRuLWdyb3VwPi5idG4sLmJ0bi1ncm91cD4uZHJvcGRvd24tbWVudSwuYnRuLWdyb3VwPi5wb3BvdmVye2ZvbnQtc2l6ZToxNHB4fS5idG4tZ3JvdXA+LmJ0bi1taW5pe2ZvbnQtc2l6ZToxMC41cHh9LmJ0bi1ncm91cD4uYnRuLXNtYWxse2ZvbnQtc2l6ZToxMS45cHh9LmJ0bi1ncm91cD4uYnRuLWxhcmdle2ZvbnQtc2l6ZToxNy41cHh9LmJ0bi1ncm91cD4uYnRuOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9LmJ0bi1ncm91cD4uYnRuOmxhc3QtY2hpbGQsLmJ0bi1ncm91cD4uZHJvcGRvd24tdG9nZ2xley13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4fS5idG4tZ3JvdXA+LmJ0bi5sYXJnZTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowOy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo2cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo2cHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo2cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6NnB4fS5idG4tZ3JvdXA+LmJ0bi5sYXJnZTpsYXN0LWNoaWxkLC5idG4tZ3JvdXA+LmxhcmdlLmRyb3Bkb3duLXRvZ2dsZXstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjZweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo2cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo2cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo2cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjZweH0uYnRuLWdyb3VwPi5idG46aG92ZXIsLmJ0bi1ncm91cD4uYnRuOmZvY3VzLC5idG4tZ3JvdXA+LmJ0bjphY3RpdmUsLmJ0bi1ncm91cD4uYnRuLmFjdGl2ZXt6LWluZGV4OjJ9LmJ0bi1ncm91cCAuZHJvcGRvd24tdG9nZ2xlOmFjdGl2ZSwuYnRuLWdyb3VwLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZXtvdXRsaW5lOjB9LmJ0bi1ncm91cD4uYnRuKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjVweDtwYWRkaW5nLXJpZ2h0OjhweDsqcGFkZGluZy1ib3R0b206NXB4O3BhZGRpbmctbGVmdDo4cHg7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEyNSksaW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMiksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEyNSksaW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMiksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMjU1LDI1NSwyNTUsMC4xMjUpLGluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjIpLDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDUpfS5idG4tZ3JvdXA+LmJ0bi1taW5pKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjJweDtwYWRkaW5nLXJpZ2h0OjVweDsqcGFkZGluZy1ib3R0b206MnB4O3BhZGRpbmctbGVmdDo1cHh9LmJ0bi1ncm91cD4uYnRuLXNtYWxsKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjVweDsqcGFkZGluZy1ib3R0b206NHB4fS5idG4tZ3JvdXA+LmJ0bi1sYXJnZSsuZHJvcGRvd24tdG9nZ2xleypwYWRkaW5nLXRvcDo3cHg7cGFkZGluZy1yaWdodDoxMnB4OypwYWRkaW5nLWJvdHRvbTo3cHg7cGFkZGluZy1sZWZ0OjEycHh9LmJ0bi1ncm91cC5vcGVuIC5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1pbWFnZTpub25lOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsMC4xNSksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KX0uYnRuLWdyb3VwLm9wZW4gLmJ0bi5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojZTZlNmU2fS5idG4tZ3JvdXAub3BlbiAuYnRuLXByaW1hcnkuZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzA0Y30uYnRuLWdyb3VwLm9wZW4gLmJ0bi13YXJuaW5nLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDZ9LmJ0bi1ncm91cC5vcGVuIC5idG4tZGFuZ2VyLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNiZDM2MmZ9LmJ0bi1ncm91cC5vcGVuIC5idG4tc3VjY2Vzcy5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojNTFhMzUxfS5idG4tZ3JvdXAub3BlbiAuYnRuLWluZm8uZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzJmOTZiNH0uYnRuLWdyb3VwLm9wZW4gLmJ0bi1pbnZlcnNlLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiMyMjJ9LmJ0biAuY2FyZXR7bWFyZ2luLXRvcDo4cHg7bWFyZ2luLWxlZnQ6MH0uYnRuLWxhcmdlIC5jYXJldHttYXJnaW4tdG9wOjZweH0uYnRuLWxhcmdlIC5jYXJldHtib3JkZXItdG9wLXdpZHRoOjVweDtib3JkZXItcmlnaHQtd2lkdGg6NXB4O2JvcmRlci1sZWZ0LXdpZHRoOjVweH0uYnRuLW1pbmkgLmNhcmV0LC5idG4tc21hbGwgLmNhcmV0e21hcmdpbi10b3A6OHB4fS5kcm9wdXAgLmJ0bi1sYXJnZSAuY2FyZXR7Ym9yZGVyLWJvdHRvbS13aWR0aDo1cHh9LmJ0bi1wcmltYXJ5IC5jYXJldCwuYnRuLXdhcm5pbmcgLmNhcmV0LC5idG4tZGFuZ2VyIC5jYXJldCwuYnRuLWluZm8gLmNhcmV0LC5idG4tc3VjY2VzcyAuY2FyZXQsLmJ0bi1pbnZlcnNlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmfS5idG4tZ3JvdXAtdmVydGljYWx7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjF9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRue2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bm9uZTttYXgtd2lkdGg6MTAwJTstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRuKy5idG57bWFyZ2luLXRvcDotMXB4O21hcmdpbi1sZWZ0OjB9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRuOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggNHB4IDAgMDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7Ym9yZGVyLXJhZGl1czo0cHggNHB4IDAgMH0uYnRuLWdyb3VwLXZlcnRpY2FsPi5idG46bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA0cHggNHB4O2JvcmRlci1yYWRpdXM6MCAwIDRweCA0cHh9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRuLWxhcmdlOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHggNnB4IDAgMDstbW96LWJvcmRlci1yYWRpdXM6NnB4IDZweCAwIDA7Ym9yZGVyLXJhZGl1czo2cHggNnB4IDAgMH0uYnRuLWdyb3VwLXZlcnRpY2FsPi5idG4tbGFyZ2U6bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6MCAwIDZweCA2cHh9LmFsZXJ0e3BhZGRpbmc6OHB4IDM1cHggOHB4IDE0cHg7bWFyZ2luLWJvdHRvbToyMHB4O3RleHQtc2hhZG93OjAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjUpO2JhY2tncm91bmQtY29sb3I6I2ZjZjhlMztib3JkZXI6MXB4IHNvbGlkICNmYmVlZDU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fS5hbGVydCwuYWxlcnQgaDR7Y29sb3I6I2MwOTg1M30uYWxlcnQgaDR7bWFyZ2luOjB9LmFsZXJ0IC5jbG9zZXtwb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LTJweDtyaWdodDotMjFweDtsaW5lLWhlaWdodDoyMHB4fS5hbGVydC1zdWNjZXNze2NvbG9yOiM0Njg4NDc7YmFja2dyb3VuZC1jb2xvcjojZGZmMGQ4O2JvcmRlci1jb2xvcjojZDZlOWM2fS5hbGVydC1zdWNjZXNzIGg0e2NvbG9yOiM0Njg4NDd9LmFsZXJ0LWRhbmdlciwuYWxlcnQtZXJyb3J7Y29sb3I6I2I5NGE0ODtiYWNrZ3JvdW5kLWNvbG9yOiNmMmRlZGU7Ym9yZGVyLWNvbG9yOiNlZWQzZDd9LmFsZXJ0LWRhbmdlciBoNCwuYWxlcnQtZXJyb3IgaDR7Y29sb3I6I2I5NGE0OH0uYWxlcnQtaW5mb3tjb2xvcjojM2E4N2FkO2JhY2tncm91bmQtY29sb3I6I2Q5ZWRmNztib3JkZXItY29sb3I6I2JjZThmMX0uYWxlcnQtaW5mbyBoNHtjb2xvcjojM2E4N2FkfS5hbGVydC1ibG9ja3twYWRkaW5nLXRvcDoxNHB4O3BhZGRpbmctYm90dG9tOjE0cHh9LmFsZXJ0LWJsb2NrPnAsLmFsZXJ0LWJsb2NrPnVse21hcmdpbi1ib3R0b206MH0uYWxlcnQtYmxvY2sgcCtwe21hcmdpbi10b3A6NXB4fS5uYXZ7bWFyZ2luLWJvdHRvbToyMHB4O21hcmdpbi1sZWZ0OjA7bGlzdC1zdHlsZTpub25lfS5uYXY+bGk+YXtkaXNwbGF5OmJsb2NrfS5uYXY+bGk+YTpob3ZlciwubmF2PmxpPmE6Zm9jdXN7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZWVlfS5uYXY+bGk+YT5pbWd7bWF4LXdpZHRoOm5vbmV9Lm5hdj4ucHVsbC1yaWdodHtmbG9hdDpyaWdodH0ubmF2LWhlYWRlcntkaXNwbGF5OmJsb2NrO3BhZGRpbmc6M3B4IDE1cHg7Zm9udC1zaXplOjExcHg7Zm9udC13ZWlnaHQ6Ym9sZDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiM5OTk7dGV4dC1zaGFkb3c6MCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuNSk7dGV4dC10cmFuc2Zvcm06dXBwZXJjYXNlfS5uYXYgbGkrLm5hdi1oZWFkZXJ7bWFyZ2luLXRvcDo5cHh9Lm5hdi1saXN0e3BhZGRpbmctcmlnaHQ6MTVweDtwYWRkaW5nLWxlZnQ6MTVweDttYXJnaW4tYm90dG9tOjB9Lm5hdi1saXN0PmxpPmEsLm5hdi1saXN0IC5uYXYtaGVhZGVye21hcmdpbi1yaWdodDotMTVweDttYXJnaW4tbGVmdDotMTVweDt0ZXh0LXNoYWRvdzowIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsMC41KX0ubmF2LWxpc3Q+bGk+YXtwYWRkaW5nOjNweCAxNXB4fS5uYXYtbGlzdD4uYWN0aXZlPmEsLm5hdi1saXN0Pi5hY3RpdmU+YTpob3ZlciwubmF2LWxpc3Q+LmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjIpO2JhY2tncm91bmQtY29sb3I6IzA4Y30ubmF2LWxpc3QgW2NsYXNzXj0iaWNvbi0iXSwubmF2LWxpc3QgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXJpZ2h0OjJweH0ubmF2LWxpc3QgLmRpdmlkZXJ7KndpZHRoOjEwMCU7aGVpZ2h0OjFweDttYXJnaW46OXB4IDFweDsqbWFyZ2luOi01cHggMCA1cHg7b3ZlcmZsb3c6aGlkZGVuO2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZmZmfS5uYXYtdGFicywubmF2LXBpbGxzeyp6b29tOjF9Lm5hdi10YWJzOmJlZm9yZSwubmF2LXBpbGxzOmJlZm9yZSwubmF2LXRhYnM6YWZ0ZXIsLm5hdi1waWxsczphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ubmF2LXRhYnM6YWZ0ZXIsLm5hdi1waWxsczphZnRlcntjbGVhcjpib3RofS5uYXYtdGFicz5saSwubmF2LXBpbGxzPmxpe2Zsb2F0OmxlZnR9Lm5hdi10YWJzPmxpPmEsLm5hdi1waWxscz5saT5he3BhZGRpbmctcmlnaHQ6MTJweDtwYWRkaW5nLWxlZnQ6MTJweDttYXJnaW4tcmlnaHQ6MnB4O2xpbmUtaGVpZ2h0OjE0cHh9Lm5hdi10YWJze2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNkZGR9Lm5hdi10YWJzPmxpe21hcmdpbi1ib3R0b206LTFweH0ubmF2LXRhYnM+bGk+YXtwYWRkaW5nLXRvcDo4cHg7cGFkZGluZy1ib3R0b206OHB4O2xpbmUtaGVpZ2h0OjIwcHg7Ym9yZGVyOjFweCBzb2xpZCB0cmFuc3BhcmVudDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7LW1vei1ib3JkZXItcmFkaXVzOjRweCA0cHggMCAwO2JvcmRlci1yYWRpdXM6NHB4IDRweCAwIDB9Lm5hdi10YWJzPmxpPmE6aG92ZXIsLm5hdi10YWJzPmxpPmE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiNlZWUgI2VlZSAjZGRkfS5uYXYtdGFicz4uYWN0aXZlPmEsLm5hdi10YWJzPi5hY3RpdmU+YTpob3ZlciwubmF2LXRhYnM+LmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiM1NTU7Y3Vyc29yOmRlZmF1bHQ7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2RkZDtib3JkZXItYm90dG9tLWNvbG9yOnRyYW5zcGFyZW50fS5uYXYtcGlsbHM+bGk+YXtwYWRkaW5nLXRvcDo4cHg7cGFkZGluZy1ib3R0b206OHB4O21hcmdpbi10b3A6MnB4O21hcmdpbi1ib3R0b206MnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo1cHg7LW1vei1ib3JkZXItcmFkaXVzOjVweDtib3JkZXItcmFkaXVzOjVweH0ubmF2LXBpbGxzPi5hY3RpdmU+YSwubmF2LXBpbGxzPi5hY3RpdmU+YTpob3ZlciwubmF2LXBpbGxzPi5hY3RpdmU+YTpmb2N1c3tjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzA4Y30ubmF2LXN0YWNrZWQ+bGl7ZmxvYXQ6bm9uZX0ubmF2LXN0YWNrZWQ+bGk+YXttYXJnaW4tcmlnaHQ6MH0ubmF2LXRhYnMubmF2LXN0YWNrZWR7Ym9yZGVyLWJvdHRvbTowfS5uYXYtdGFicy5uYXYtc3RhY2tlZD5saT5he2JvcmRlcjoxcHggc29saWQgI2RkZDstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9Lm5hdi10YWJzLm5hdi1zdGFja2VkPmxpOmZpcnN0LWNoaWxkPmF7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9Lm5hdi10YWJzLm5hdi1zdGFja2VkPmxpOmxhc3QtY2hpbGQ+YXstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweH0ubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk+YTpob3ZlciwubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk+YTpmb2N1c3t6LWluZGV4OjI7Ym9yZGVyLWNvbG9yOiNkZGR9Lm5hdi1waWxscy5uYXYtc3RhY2tlZD5saT5he21hcmdpbi1ib3R0b206M3B4fS5uYXYtcGlsbHMubmF2LXN0YWNrZWQ+bGk6bGFzdC1jaGlsZD5he21hcmdpbi1ib3R0b206MXB4fS5uYXYtdGFicyAuZHJvcGRvd24tbWVudXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6MCAwIDZweCA2cHh9Lm5hdi1waWxscyAuZHJvcGRvd24tbWVudXstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHh9Lm5hdiAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHttYXJnaW4tdG9wOjZweDtib3JkZXItdG9wLWNvbG9yOiMwOGM7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDhjfS5uYXYgLmRyb3Bkb3duLXRvZ2dsZTpob3ZlciAuY2FyZXQsLm5hdiAuZHJvcGRvd24tdG9nZ2xlOmZvY3VzIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiMwMDU1ODA7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDA1NTgwfS5uYXYtdGFicyAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHttYXJnaW4tdG9wOjhweH0ubmF2IC5hY3RpdmUgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZn0ubmF2LXRhYnMgLmFjdGl2ZSAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM1NTU7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNTU1fS5uYXY+LmRyb3Bkb3duLmFjdGl2ZT5hOmhvdmVyLC5uYXY+LmRyb3Bkb3duLmFjdGl2ZT5hOmZvY3Vze2N1cnNvcjpwb2ludGVyfS5uYXYtdGFicyAub3BlbiAuZHJvcGRvd24tdG9nZ2xlLC5uYXYtcGlsbHMgLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZSwubmF2PmxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPmE6aG92ZXIsLm5hdj5saS5kcm9wZG93bi5vcGVuLmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjojOTk5O2JvcmRlci1jb2xvcjojOTk5fS5uYXYgbGkuZHJvcGRvd24ub3BlbiAuY2FyZXQsLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZSAuY2FyZXQsLm5hdiBsaS5kcm9wZG93bi5vcGVuIGE6aG92ZXIgLmNhcmV0LC5uYXYgbGkuZHJvcGRvd24ub3BlbiBhOmZvY3VzIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmO29wYWNpdHk6MTtmaWx0ZXI6YWxwaGEob3BhY2l0eT0xMDApfS50YWJzLXN0YWNrZWQgLm9wZW4+YTpob3ZlciwudGFicy1zdGFja2VkIC5vcGVuPmE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiM5OTl9LnRhYmJhYmxleyp6b29tOjF9LnRhYmJhYmxlOmJlZm9yZSwudGFiYmFibGU6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LnRhYmJhYmxlOmFmdGVye2NsZWFyOmJvdGh9LnRhYi1jb250ZW50e292ZXJmbG93OmF1dG99LnRhYnMtYmVsb3c+Lm5hdi10YWJzLC50YWJzLXJpZ2h0Pi5uYXYtdGFicywudGFicy1sZWZ0Pi5uYXYtdGFic3tib3JkZXItYm90dG9tOjB9LnRhYi1jb250ZW50Pi50YWItcGFuZSwucGlsbC1jb250ZW50Pi5waWxsLXBhbmV7ZGlzcGxheTpub25lfS50YWItY29udGVudD4uYWN0aXZlLC5waWxsLWNvbnRlbnQ+LmFjdGl2ZXtkaXNwbGF5OmJsb2NrfS50YWJzLWJlbG93Pi5uYXYtdGFic3tib3JkZXItdG9wOjFweCBzb2xpZCAjZGRkfS50YWJzLWJlbG93Pi5uYXYtdGFicz5saXttYXJnaW4tdG9wOi0xcHg7bWFyZ2luLWJvdHRvbTowfS50YWJzLWJlbG93Pi5uYXYtdGFicz5saT5hey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNHB4IDRweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7Ym9yZGVyLXJhZGl1czowIDAgNHB4IDRweH0udGFicy1iZWxvdz4ubmF2LXRhYnM+bGk+YTpob3ZlciwudGFicy1iZWxvdz4ubmF2LXRhYnM+bGk+YTpmb2N1c3tib3JkZXItdG9wLWNvbG9yOiNkZGQ7Ym9yZGVyLWJvdHRvbS1jb2xvcjp0cmFuc3BhcmVudH0udGFicy1iZWxvdz4ubmF2LXRhYnM+LmFjdGl2ZT5hLC50YWJzLWJlbG93Pi5uYXYtdGFicz4uYWN0aXZlPmE6aG92ZXIsLnRhYnMtYmVsb3c+Lm5hdi10YWJzPi5hY3RpdmU+YTpmb2N1c3tib3JkZXItY29sb3I6dHJhbnNwYXJlbnQgI2RkZCAjZGRkICNkZGR9LnRhYnMtbGVmdD4ubmF2LXRhYnM+bGksLnRhYnMtcmlnaHQ+Lm5hdi10YWJzPmxpe2Zsb2F0Om5vbmV9LnRhYnMtbGVmdD4ubmF2LXRhYnM+bGk+YSwudGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YXttaW4td2lkdGg6NzRweDttYXJnaW4tcmlnaHQ6MDttYXJnaW4tYm90dG9tOjNweH0udGFicy1sZWZ0Pi5uYXYtdGFic3tmbG9hdDpsZWZ0O21hcmdpbi1yaWdodDoxOXB4O2JvcmRlci1yaWdodDoxcHggc29saWQgI2RkZH0udGFicy1sZWZ0Pi5uYXYtdGFicz5saT5he21hcmdpbi1yaWdodDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweH0udGFicy1sZWZ0Pi5uYXYtdGFicz5saT5hOmhvdmVyLC50YWJzLWxlZnQ+Lm5hdi10YWJzPmxpPmE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiNlZWUgI2RkZCAjZWVlICNlZWV9LnRhYnMtbGVmdD4ubmF2LXRhYnMgLmFjdGl2ZT5hLC50YWJzLWxlZnQ+Lm5hdi10YWJzIC5hY3RpdmU+YTpob3ZlciwudGFicy1sZWZ0Pi5uYXYtdGFicyAuYWN0aXZlPmE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiNkZGQgdHJhbnNwYXJlbnQgI2RkZCAjZGRkOypib3JkZXItcmlnaHQtY29sb3I6I2ZmZn0udGFicy1yaWdodD4ubmF2LXRhYnN7ZmxvYXQ6cmlnaHQ7bWFyZ2luLWxlZnQ6MTlweDtib3JkZXItbGVmdDoxcHggc29saWQgI2RkZH0udGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YXttYXJnaW4tbGVmdDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH0udGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YTpob3ZlciwudGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YTpmb2N1c3tib3JkZXItY29sb3I6I2VlZSAjZWVlICNlZWUgI2RkZH0udGFicy1yaWdodD4ubmF2LXRhYnMgLmFjdGl2ZT5hLC50YWJzLXJpZ2h0Pi5uYXYtdGFicyAuYWN0aXZlPmE6aG92ZXIsLnRhYnMtcmlnaHQ+Lm5hdi10YWJzIC5hY3RpdmU+YTpmb2N1c3tib3JkZXItY29sb3I6I2RkZCAjZGRkICNkZGQgdHJhbnNwYXJlbnQ7KmJvcmRlci1sZWZ0LWNvbG9yOiNmZmZ9Lm5hdj4uZGlzYWJsZWQ+YXtjb2xvcjojOTk5fS5uYXY+LmRpc2FibGVkPmE6aG92ZXIsLm5hdj4uZGlzYWJsZWQ+YTpmb2N1c3t0ZXh0LWRlY29yYXRpb246bm9uZTtjdXJzb3I6ZGVmYXVsdDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5uYXZiYXJ7KnBvc2l0aW9uOnJlbGF0aXZlOyp6LWluZGV4OjI7bWFyZ2luLWJvdHRvbToyMHB4O292ZXJmbG93OnZpc2libGV9Lm5hdmJhci1pbm5lcnttaW4taGVpZ2h0OjQwcHg7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctbGVmdDoyMHB4O2JhY2tncm91bmQtY29sb3I6I2ZhZmFmYTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjZmZmLCNmMmYyZjIpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNmZmYpLHRvKCNmMmYyZjIpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZmZmLCNmMmYyZjIpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZmZmLCNmMmYyZjIpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjZmZmLCNmMmYyZjIpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlcjoxcHggc29saWQgI2Q0ZDRkNDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZmZmZmZmYnLGVuZENvbG9yc3RyPScjZmZmMmYyZjInLEdyYWRpZW50VHlwZT0wKTsqem9vbToxOy13ZWJraXQtYm94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLDAsMCwwLjA2NSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsMCwwLDAuMDY1KTtib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsMCwwLDAuMDY1KX0ubmF2YmFyLWlubmVyOmJlZm9yZSwubmF2YmFyLWlubmVyOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5uYXZiYXItaW5uZXI6YWZ0ZXJ7Y2xlYXI6Ym90aH0ubmF2YmFyIC5jb250YWluZXJ7d2lkdGg6YXV0b30ubmF2LWNvbGxhcHNlLmNvbGxhcHNle2hlaWdodDphdXRvO292ZXJmbG93OnZpc2libGV9Lm5hdmJhciAuYnJhbmR7ZGlzcGxheTpibG9jaztmbG9hdDpsZWZ0O3BhZGRpbmc6MTBweCAyMHB4IDEwcHg7bWFyZ2luLWxlZnQ6LTIwcHg7Zm9udC1zaXplOjIwcHg7Zm9udC13ZWlnaHQ6MjAwO2NvbG9yOiM3Nzc7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmfS5uYXZiYXIgLmJyYW5kOmhvdmVyLC5uYXZiYXIgLmJyYW5kOmZvY3Vze3RleHQtZGVjb3JhdGlvbjpub25lfS5uYXZiYXItdGV4dHttYXJnaW4tYm90dG9tOjA7bGluZS1oZWlnaHQ6NDBweDtjb2xvcjojNzc3fS5uYXZiYXItbGlua3tjb2xvcjojNzc3fS5uYXZiYXItbGluazpob3ZlciwubmF2YmFyLWxpbms6Zm9jdXN7Y29sb3I6IzMzM30ubmF2YmFyIC5kaXZpZGVyLXZlcnRpY2Fse2hlaWdodDo0MHB4O21hcmdpbjowIDlweDtib3JkZXItcmlnaHQ6MXB4IHNvbGlkICNmZmY7Ym9yZGVyLWxlZnQ6MXB4IHNvbGlkICNmMmYyZjJ9Lm5hdmJhciAuYnRuLC5uYXZiYXIgLmJ0bi1ncm91cHttYXJnaW4tdG9wOjVweH0ubmF2YmFyIC5idG4tZ3JvdXAgLmJ0biwubmF2YmFyIC5pbnB1dC1wcmVwZW5kIC5idG4sLm5hdmJhciAuaW5wdXQtYXBwZW5kIC5idG4sLm5hdmJhciAuaW5wdXQtcHJlcGVuZCAuYnRuLWdyb3VwLC5uYXZiYXIgLmlucHV0LWFwcGVuZCAuYnRuLWdyb3Vwe21hcmdpbi10b3A6MH0ubmF2YmFyLWZvcm17bWFyZ2luLWJvdHRvbTowOyp6b29tOjF9Lm5hdmJhci1mb3JtOmJlZm9yZSwubmF2YmFyLWZvcm06YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9Lm5hdmJhci1mb3JtOmFmdGVye2NsZWFyOmJvdGh9Lm5hdmJhci1mb3JtIGlucHV0LC5uYXZiYXItZm9ybSBzZWxlY3QsLm5hdmJhci1mb3JtIC5yYWRpbywubmF2YmFyLWZvcm0gLmNoZWNrYm94e21hcmdpbi10b3A6NXB4fS5uYXZiYXItZm9ybSBpbnB1dCwubmF2YmFyLWZvcm0gc2VsZWN0LC5uYXZiYXItZm9ybSAuYnRue2Rpc3BsYXk6aW5saW5lLWJsb2NrO21hcmdpbi1ib3R0b206MH0ubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0iaW1hZ2UiXSwubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0iY2hlY2tib3giXSwubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0icmFkaW8iXXttYXJnaW4tdG9wOjNweH0ubmF2YmFyLWZvcm0gLmlucHV0LWFwcGVuZCwubmF2YmFyLWZvcm0gLmlucHV0LXByZXBlbmR7bWFyZ2luLXRvcDo1cHg7d2hpdGUtc3BhY2U6bm93cmFwfS5uYXZiYXItZm9ybSAuaW5wdXQtYXBwZW5kIGlucHV0LC5uYXZiYXItZm9ybSAuaW5wdXQtcHJlcGVuZCBpbnB1dHttYXJnaW4tdG9wOjB9Lm5hdmJhci1zZWFyY2h7cG9zaXRpb246cmVsYXRpdmU7ZmxvYXQ6bGVmdDttYXJnaW4tdG9wOjVweDttYXJnaW4tYm90dG9tOjB9Lm5hdmJhci1zZWFyY2ggLnNlYXJjaC1xdWVyeXtwYWRkaW5nOjRweCAxNHB4O21hcmdpbi1ib3R0b206MDtmb250LWZhbWlseToiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxBcmlhbCxzYW5zLXNlcmlmO2ZvbnQtc2l6ZToxM3B4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoxOy13ZWJraXQtYm9yZGVyLXJhZGl1czoxNXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNXB4O2JvcmRlci1yYWRpdXM6MTVweH0ubmF2YmFyLXN0YXRpYy10b3B7cG9zaXRpb246c3RhdGljO21hcmdpbi1ib3R0b206MH0ubmF2YmFyLXN0YXRpYy10b3AgLm5hdmJhci1pbm5lcnstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9Lm5hdmJhci1maXhlZC10b3AsLm5hdmJhci1maXhlZC1ib3R0b217cG9zaXRpb246Zml4ZWQ7cmlnaHQ6MDtsZWZ0OjA7ei1pbmRleDoxMDMwO21hcmdpbi1ib3R0b206MH0ubmF2YmFyLWZpeGVkLXRvcCAubmF2YmFyLWlubmVyLC5uYXZiYXItc3RhdGljLXRvcCAubmF2YmFyLWlubmVye2JvcmRlci13aWR0aDowIDAgMXB4fS5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7Ym9yZGVyLXdpZHRoOjFweCAwIDB9Lm5hdmJhci1maXhlZC10b3AgLm5hdmJhci1pbm5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2YmFyLWlubmVye3BhZGRpbmctcmlnaHQ6MDtwYWRkaW5nLWxlZnQ6MDstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9Lm5hdmJhci1zdGF0aWMtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAuY29udGFpbmVye3dpZHRoOjk0MHB4fS5uYXZiYXItZml4ZWQtdG9we3RvcDowfS5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1zdGF0aWMtdG9wIC5uYXZiYXItaW5uZXJ7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpOy1tb3otYm94LXNoYWRvdzowIDFweCAxMHB4IHJnYmEoMCwwLDAsMC4xKTtib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpfS5uYXZiYXItZml4ZWQtYm90dG9te2JvdHRvbTowfS5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7LXdlYmtpdC1ib3gtc2hhZG93OjAgLTFweCAxMHB4IHJnYmEoMCwwLDAsMC4xKTstbW96LWJveC1zaGFkb3c6MCAtMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpO2JveC1zaGFkb3c6MCAtMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpfS5uYXZiYXIgLm5hdntwb3NpdGlvbjpyZWxhdGl2ZTtsZWZ0OjA7ZGlzcGxheTpibG9jaztmbG9hdDpsZWZ0O21hcmdpbjowIDEwcHggMCAwfS5uYXZiYXIgLm5hdi5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O21hcmdpbi1yaWdodDowfS5uYXZiYXIgLm5hdj5saXtmbG9hdDpsZWZ0fS5uYXZiYXIgLm5hdj5saT5he2Zsb2F0Om5vbmU7cGFkZGluZzoxMHB4IDE1cHggMTBweDtjb2xvcjojNzc3O3RleHQtZGVjb3JhdGlvbjpub25lO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZn0ubmF2YmFyIC5uYXYgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7bWFyZ2luLXRvcDo4cHh9Lm5hdmJhciAubmF2PmxpPmE6Zm9jdXMsLm5hdmJhciAubmF2PmxpPmE6aG92ZXJ7Y29sb3I6IzMzMzt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5uYXZiYXIgLm5hdj4uYWN0aXZlPmEsLm5hdmJhciAubmF2Pi5hY3RpdmU+YTpob3ZlciwubmF2YmFyIC5uYXY+LmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiM1NTU7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDNweCA4cHggcmdiYSgwLDAsMCwwLjEyNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgM3B4IDhweCByZ2JhKDAsMCwwLDAuMTI1KTtib3gtc2hhZG93Omluc2V0IDAgM3B4IDhweCByZ2JhKDAsMCwwLDAuMTI1KX0ubmF2YmFyIC5idG4tbmF2YmFye2Rpc3BsYXk6bm9uZTtmbG9hdDpyaWdodDtwYWRkaW5nOjdweCAxMHB4O21hcmdpbi1yaWdodDo1cHg7bWFyZ2luLWxlZnQ6NXB4O2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiNlZGVkZWQ7KmJhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNmMmYyZjIpLHRvKCNlNWU1ZTUpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojZTVlNWU1ICNlNWU1ZTUgI2JmYmZiZjtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZjJmMmYyJyxlbmRDb2xvcnN0cj0nI2ZmZTVlNWU1JyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEpLDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjA3NSl9Lm5hdmJhciAuYnRuLW5hdmJhcjpob3ZlciwubmF2YmFyIC5idG4tbmF2YmFyOmZvY3VzLC5uYXZiYXIgLmJ0bi1uYXZiYXI6YWN0aXZlLC5uYXZiYXIgLmJ0bi1uYXZiYXIuYWN0aXZlLC5uYXZiYXIgLmJ0bi1uYXZiYXIuZGlzYWJsZWQsLm5hdmJhciAuYnRuLW5hdmJhcltkaXNhYmxlZF17Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiNlNWU1ZTU7KmJhY2tncm91bmQtY29sb3I6I2Q5ZDlkOX0ubmF2YmFyIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyIC5idG4tbmF2YmFyLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNjY2MgXDl9Lm5hdmJhciAuYnRuLW5hdmJhciAuaWNvbi1iYXJ7ZGlzcGxheTpibG9jazt3aWR0aDoxOHB4O2hlaWdodDoycHg7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czoxcHg7LW1vei1ib3JkZXItcmFkaXVzOjFweDtib3JkZXItcmFkaXVzOjFweDstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggMCByZ2JhKDAsMCwwLDAuMjUpOy1tb3otYm94LXNoYWRvdzowIDFweCAwIHJnYmEoMCwwLDAsMC4yNSk7Ym94LXNoYWRvdzowIDFweCAwIHJnYmEoMCwwLDAsMC4yNSl9LmJ0bi1uYXZiYXIgLmljb24tYmFyKy5pY29uLWJhcnttYXJnaW4tdG9wOjNweH0ubmF2YmFyIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YmVmb3Jle3Bvc2l0aW9uOmFic29sdXRlO3RvcDotN3B4O2xlZnQ6OXB4O2Rpc3BsYXk6aW5saW5lLWJsb2NrO2JvcmRlci1yaWdodDo3cHggc29saWQgdHJhbnNwYXJlbnQ7Ym9yZGVyLWJvdHRvbTo3cHggc29saWQgI2NjYztib3JkZXItbGVmdDo3cHggc29saWQgdHJhbnNwYXJlbnQ7Ym9yZGVyLWJvdHRvbS1jb2xvcjpyZ2JhKDAsMCwwLDAuMik7Y29udGVudDonJ30ubmF2YmFyIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXJ7cG9zaXRpb246YWJzb2x1dGU7dG9wOi02cHg7bGVmdDoxMHB4O2Rpc3BsYXk6aW5saW5lLWJsb2NrO2JvcmRlci1yaWdodDo2cHggc29saWQgdHJhbnNwYXJlbnQ7Ym9yZGVyLWJvdHRvbTo2cHggc29saWQgI2ZmZjtib3JkZXItbGVmdDo2cHggc29saWQgdHJhbnNwYXJlbnQ7Y29udGVudDonJ30ubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZXt0b3A6YXV0bztib3R0b206LTdweDtib3JkZXItdG9wOjdweCBzb2xpZCAjY2NjO2JvcmRlci1ib3R0b206MDtib3JkZXItdG9wLWNvbG9yOnJnYmEoMCwwLDAsMC4yKX0ubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2PmxpPi5kcm9wZG93bi1tZW51OmFmdGVye3RvcDphdXRvO2JvdHRvbTotNnB4O2JvcmRlci10b3A6NnB4IHNvbGlkICNmZmY7Ym9yZGVyLWJvdHRvbTowfS5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bj5hOmhvdmVyIC5jYXJldCwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24+YTpmb2N1cyAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojMzMzO2JvcmRlci1ib3R0b20tY29sb3I6IzMzM30ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZXtjb2xvcjojNTU1O2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNX0ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojNzc3O2JvcmRlci1ib3R0b20tY29sb3I6Izc3N30ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldCwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM1NTU7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNTU1fS5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHR7cmlnaHQ6MDtsZWZ0OmF1dG99Lm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudTpiZWZvcmUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQ6YmVmb3Jle3JpZ2h0OjEycHg7bGVmdDphdXRvfS5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXIsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQ6YWZ0ZXJ7cmlnaHQ6MTNweDtsZWZ0OmF1dG99Lm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudSAuZHJvcGRvd24tbWVudSwubmF2YmFyIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnUucHVsbC1yaWdodCAuZHJvcGRvd24tbWVudXtyaWdodDoxMDAlO2xlZnQ6YXV0bzttYXJnaW4tcmlnaHQ6LTFweDttYXJnaW4tbGVmdDowOy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweH0ubmF2YmFyLWludmVyc2UgLm5hdmJhci1pbm5lcntiYWNrZ3JvdW5kLWNvbG9yOiMxYjFiMWI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzIyMiwjMTExKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjMjIyKSx0bygjMTExKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzIyMiwjMTExKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzIyMiwjMTExKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzIyMiwjMTExKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtib3JkZXItY29sb3I6IzI1MjUyNTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjIyMjIyMicsZW5kQ29sb3JzdHI9JyNmZjExMTExMScsR3JhZGllbnRUeXBlPTApfS5uYXZiYXItaW52ZXJzZSAuYnJhbmQsLm5hdmJhci1pbnZlcnNlIC5uYXY+bGk+YXtjb2xvcjojOTk5O3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSl9Lm5hdmJhci1pbnZlcnNlIC5icmFuZDpob3ZlciwubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAuYnJhbmQ6Zm9jdXMsLm5hdmJhci1pbnZlcnNlIC5uYXY+bGk+YTpmb2N1c3tjb2xvcjojZmZmfS5uYXZiYXItaW52ZXJzZSAuYnJhbmR7Y29sb3I6Izk5OX0ubmF2YmFyLWludmVyc2UgLm5hdmJhci10ZXh0e2NvbG9yOiM5OTl9Lm5hdmJhci1pbnZlcnNlIC5uYXY+bGk+YTpmb2N1cywubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmhvdmVye2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudH0ubmF2YmFyLWludmVyc2UgLm5hdiAuYWN0aXZlPmEsLm5hdmJhci1pbnZlcnNlIC5uYXYgLmFjdGl2ZT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2IC5hY3RpdmU+YTpmb2N1c3tjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzExMX0ubmF2YmFyLWludmVyc2UgLm5hdmJhci1saW5re2NvbG9yOiM5OTl9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItbGluazpob3ZlciwubmF2YmFyLWludmVyc2UgLm5hdmJhci1saW5rOmZvY3Vze2NvbG9yOiNmZmZ9Lm5hdmJhci1pbnZlcnNlIC5kaXZpZGVyLXZlcnRpY2Fse2JvcmRlci1yaWdodC1jb2xvcjojMjIyO2JvcmRlci1sZWZ0LWNvbG9yOiMxMTF9Lm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPi5kcm9wZG93bi10b2dnbGV7Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMxMTF9Lm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24+YTpob3ZlciAuY2FyZXQsLm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24+YTpmb2N1cyAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZn0ubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM5OTk7Ym9yZGVyLWJvdHRvbS1jb2xvcjojOTk5fS5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXQsLm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6I2ZmZjtib3JkZXItYm90dG9tLWNvbG9yOiNmZmZ9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnl7Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiM1MTUxNTE7Ym9yZGVyLWNvbG9yOiMxMTE7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMTUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwwLjEpLDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjE1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMTUpOy13ZWJraXQtdHJhbnNpdGlvbjpub25lOy1tb3otdHJhbnNpdGlvbjpub25lOy1vLXRyYW5zaXRpb246bm9uZTt0cmFuc2l0aW9uOm5vbmV9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6LW1vei1wbGFjZWhvbGRlcntjb2xvcjojY2NjfS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5Oi1tcy1pbnB1dC1wbGFjZWhvbGRlcntjb2xvcjojY2NjfS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiNjY2N9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6Zm9jdXMsLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnkuZm9jdXNlZHtwYWRkaW5nOjVweCAxNXB4O2NvbG9yOiMzMzM7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmO2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MDtvdXRsaW5lOjA7LXdlYmtpdC1ib3gtc2hhZG93OjAgMCAzcHggcmdiYSgwLDAsMCwwLjE1KTstbW96LWJveC1zaGFkb3c6MCAwIDNweCByZ2JhKDAsMCwwLDAuMTUpO2JveC1zaGFkb3c6MCAwIDNweCByZ2JhKDAsMCwwLDAuMTUpfS5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcntjb2xvcjojZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojMGUwZTBlOypiYWNrZ3JvdW5kLWNvbG9yOiMwNDA0MDQ7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjMTUxNTE1KSx0bygjMDQwNDA0KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtib3JkZXItY29sb3I6IzA0MDQwNCAjMDQwNDA0ICMwMDA7Ym9yZGVyLWNvbG9yOnJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjI1KTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjE1MTUxNScsZW5kQ29sb3JzdHI9JyNmZjA0MDQwNCcsR3JhZGllbnRUeXBlPTApO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZD1mYWxzZSl9Lm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcjpmb2N1cywubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXI6YWN0aXZlLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhci5hY3RpdmUsLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyLmRpc2FibGVkLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcltkaXNhYmxlZF17Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMwNDA0MDQ7KmJhY2tncm91bmQtY29sb3I6IzAwMH0ubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXI6YWN0aXZlLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhci5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojMDAwIFw5fS5icmVhZGNydW1ie3BhZGRpbmc6OHB4IDE1cHg7bWFyZ2luOjAgMCAyMHB4O2xpc3Qtc3R5bGU6bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fS5icmVhZGNydW1iPmxpe2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmY7Knpvb206MX0uYnJlYWRjcnVtYj5saT4uZGl2aWRlcntwYWRkaW5nOjAgNXB4O2NvbG9yOiNjY2N9LmJyZWFkY3J1bWI+LmFjdGl2ZXtjb2xvcjojOTk5fS5wYWdpbmF0aW9ue21hcmdpbjoyMHB4IDB9LnBhZ2luYXRpb24gdWx7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lO21hcmdpbi1ib3R0b206MDttYXJnaW4tbGVmdDowOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDsqem9vbToxOy13ZWJraXQtYm94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6MCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KX0ucGFnaW5hdGlvbiB1bD5saXtkaXNwbGF5OmlubGluZX0ucGFnaW5hdGlvbiB1bD5saT5hLC5wYWdpbmF0aW9uIHVsPmxpPnNwYW57ZmxvYXQ6bGVmdDtwYWRkaW5nOjRweCAxMnB4O2xpbmUtaGVpZ2h0OjIwcHg7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2RkZDtib3JkZXItbGVmdC13aWR0aDowfS5wYWdpbmF0aW9uIHVsPmxpPmE6aG92ZXIsLnBhZ2luYXRpb24gdWw+bGk+YTpmb2N1cywucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNX0ucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2NvbG9yOiM5OTk7Y3Vyc29yOmRlZmF1bHR9LnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPnNwYW4sLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmEsLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmE6aG92ZXIsLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmE6Zm9jdXN7Y29sb3I6Izk5OTtjdXJzb3I6ZGVmYXVsdDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5wYWdpbmF0aW9uIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24gdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbntib3JkZXItbGVmdC13aWR0aDoxcHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9LnBhZ2luYXRpb24gdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uIHVsPmxpOmxhc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjRweH0ucGFnaW5hdGlvbi1jZW50ZXJlZHt0ZXh0LWFsaWduOmNlbnRlcn0ucGFnaW5hdGlvbi1yaWdodHt0ZXh0LWFsaWduOnJpZ2h0fS5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk+c3BhbntwYWRkaW5nOjExcHggMTlweDtmb250LXNpemU6MTcuNXB4fS5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4O2JvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4Oy13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czo2cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjZweH0ucGFnaW5hdGlvbi1sYXJnZSB1bD5saTpsYXN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6bGFzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjZweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjZweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjZweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NnB4fS5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czozcHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czozcHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjNweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDozcHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6M3B4fS5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLXNtYWxsIHVsPmxpOmxhc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1taW5pIHVsPmxpOmxhc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpsYXN0LWNoaWxkPnNwYW57LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czozcHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6M3B4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6M3B4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6M3B4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDozcHh9LnBhZ2luYXRpb24tc21hbGwgdWw+bGk+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saT5zcGFue3BhZGRpbmc6MnB4IDEwcHg7Zm9udC1zaXplOjExLjlweH0ucGFnaW5hdGlvbi1taW5pIHVsPmxpPmEsLnBhZ2luYXRpb24tbWluaSB1bD5saT5zcGFue3BhZGRpbmc6MCA2cHg7Zm9udC1zaXplOjEwLjVweH0ucGFnZXJ7bWFyZ2luOjIwcHggMDt0ZXh0LWFsaWduOmNlbnRlcjtsaXN0LXN0eWxlOm5vbmU7Knpvb206MX0ucGFnZXI6YmVmb3JlLC5wYWdlcjphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucGFnZXI6YWZ0ZXJ7Y2xlYXI6Ym90aH0ucGFnZXIgbGl7ZGlzcGxheTppbmxpbmV9LnBhZ2VyIGxpPmEsLnBhZ2VyIGxpPnNwYW57ZGlzcGxheTppbmxpbmUtYmxvY2s7cGFkZGluZzo1cHggMTRweDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czoxNXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNXB4O2JvcmRlci1yYWRpdXM6MTVweH0ucGFnZXIgbGk+YTpob3ZlciwucGFnZXIgbGk+YTpmb2N1c3t0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjV9LnBhZ2VyIC5uZXh0PmEsLnBhZ2VyIC5uZXh0PnNwYW57ZmxvYXQ6cmlnaHR9LnBhZ2VyIC5wcmV2aW91cz5hLC5wYWdlciAucHJldmlvdXM+c3BhbntmbG9hdDpsZWZ0fS5wYWdlciAuZGlzYWJsZWQ+YSwucGFnZXIgLmRpc2FibGVkPmE6aG92ZXIsLnBhZ2VyIC5kaXNhYmxlZD5hOmZvY3VzLC5wYWdlciAuZGlzYWJsZWQ+c3Bhbntjb2xvcjojOTk5O2N1cnNvcjpkZWZhdWx0O2JhY2tncm91bmQtY29sb3I6I2ZmZn0ubW9kYWwtYmFja2Ryb3B7cG9zaXRpb246Zml4ZWQ7dG9wOjA7cmlnaHQ6MDtib3R0b206MDtsZWZ0OjA7ei1pbmRleDoxMDQwO2JhY2tncm91bmQtY29sb3I6IzAwMH0ubW9kYWwtYmFja2Ryb3AuZmFkZXtvcGFjaXR5OjB9Lm1vZGFsLWJhY2tkcm9wLC5tb2RhbC1iYWNrZHJvcC5mYWRlLmlue29wYWNpdHk6Ljg7ZmlsdGVyOmFscGhhKG9wYWNpdHk9ODApfS5tb2RhbHtwb3NpdGlvbjpmaXhlZDt0b3A6MTAlO2xlZnQ6NTAlO3otaW5kZXg6MTA1MDt3aWR0aDo1NjBweDttYXJnaW4tbGVmdDotMjgwcHg7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgIzk5OTtib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwwLDAsMC4zKTsqYm9yZGVyOjFweCBzb2xpZCAjOTk5Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDtvdXRsaW5lOjA7LXdlYmtpdC1ib3gtc2hhZG93OjAgM3B4IDdweCByZ2JhKDAsMCwwLDAuMyk7LW1vei1ib3gtc2hhZG93OjAgM3B4IDdweCByZ2JhKDAsMCwwLDAuMyk7Ym94LXNoYWRvdzowIDNweCA3cHggcmdiYSgwLDAsMCwwLjMpOy13ZWJraXQtYmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94Oy1tb3otYmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94O2JhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveH0ubW9kYWwuZmFkZXt0b3A6LTI1JTstd2Via2l0LXRyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLHRvcCAuM3MgZWFzZS1vdXQ7LW1vei10cmFuc2l0aW9uOm9wYWNpdHkgLjNzIGxpbmVhcix0b3AgLjNzIGVhc2Utb3V0Oy1vLXRyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLHRvcCAuM3MgZWFzZS1vdXQ7dHJhbnNpdGlvbjpvcGFjaXR5IC4zcyBsaW5lYXIsdG9wIC4zcyBlYXNlLW91dH0ubW9kYWwuZmFkZS5pbnt0b3A6MTAlfS5tb2RhbC1oZWFkZXJ7cGFkZGluZzo5cHggMTVweDtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZWVlfS5tb2RhbC1oZWFkZXIgLmNsb3Nle21hcmdpbi10b3A6MnB4fS5tb2RhbC1oZWFkZXIgaDN7bWFyZ2luOjA7bGluZS1oZWlnaHQ6MzBweH0ubW9kYWwtYm9keXtwb3NpdGlvbjpyZWxhdGl2ZTttYXgtaGVpZ2h0OjQwMHB4O3BhZGRpbmc6MTVweDtvdmVyZmxvdy15OmF1dG99Lm1vZGFsLWZvcm17bWFyZ2luLWJvdHRvbTowfS5tb2RhbC1mb290ZXJ7cGFkZGluZzoxNHB4IDE1cHggMTVweDttYXJnaW4tYm90dG9tOjA7dGV4dC1hbGlnbjpyaWdodDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyLXRvcDoxcHggc29saWQgI2RkZDstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7Knpvb206MTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCAjZmZmOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAwICNmZmY7Ym94LXNoYWRvdzppbnNldCAwIDFweCAwICNmZmZ9Lm1vZGFsLWZvb3RlcjpiZWZvcmUsLm1vZGFsLWZvb3RlcjphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ubW9kYWwtZm9vdGVyOmFmdGVye2NsZWFyOmJvdGh9Lm1vZGFsLWZvb3RlciAuYnRuKy5idG57bWFyZ2luLWJvdHRvbTowO21hcmdpbi1sZWZ0OjVweH0ubW9kYWwtZm9vdGVyIC5idG4tZ3JvdXAgLmJ0bisuYnRue21hcmdpbi1sZWZ0Oi0xcHh9Lm1vZGFsLWZvb3RlciAuYnRuLWJsb2NrKy5idG4tYmxvY2t7bWFyZ2luLWxlZnQ6MH0udG9vbHRpcHtwb3NpdGlvbjphYnNvbHV0ZTt6LWluZGV4OjEwMzA7ZGlzcGxheTpibG9jaztmb250LXNpemU6MTFweDtsaW5lLWhlaWdodDoxLjQ7b3BhY2l0eTowO2ZpbHRlcjphbHBoYShvcGFjaXR5PTApO3Zpc2liaWxpdHk6dmlzaWJsZX0udG9vbHRpcC5pbntvcGFjaXR5Oi44O2ZpbHRlcjphbHBoYShvcGFjaXR5PTgwKX0udG9vbHRpcC50b3B7cGFkZGluZzo1cHggMDttYXJnaW4tdG9wOi0zcHh9LnRvb2x0aXAucmlnaHR7cGFkZGluZzowIDVweDttYXJnaW4tbGVmdDozcHh9LnRvb2x0aXAuYm90dG9te3BhZGRpbmc6NXB4IDA7bWFyZ2luLXRvcDozcHh9LnRvb2x0aXAubGVmdHtwYWRkaW5nOjAgNXB4O21hcmdpbi1sZWZ0Oi0zcHh9LnRvb2x0aXAtaW5uZXJ7bWF4LXdpZHRoOjIwMHB4O3BhZGRpbmc6OHB4O2NvbG9yOiNmZmY7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojMDAwOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweH0udG9vbHRpcC1hcnJvd3twb3NpdGlvbjphYnNvbHV0ZTt3aWR0aDowO2hlaWdodDowO2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXItc3R5bGU6c29saWR9LnRvb2x0aXAudG9wIC50b29sdGlwLWFycm93e2JvdHRvbTowO2xlZnQ6NTAlO21hcmdpbi1sZWZ0Oi01cHg7Ym9yZGVyLXRvcC1jb2xvcjojMDAwO2JvcmRlci13aWR0aDo1cHggNXB4IDB9LnRvb2x0aXAucmlnaHQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtsZWZ0OjA7bWFyZ2luLXRvcDotNXB4O2JvcmRlci1yaWdodC1jb2xvcjojMDAwO2JvcmRlci13aWR0aDo1cHggNXB4IDVweCAwfS50b29sdGlwLmxlZnQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtyaWdodDowO21hcmdpbi10b3A6LTVweDtib3JkZXItbGVmdC1jb2xvcjojMDAwO2JvcmRlci13aWR0aDo1cHggMCA1cHggNXB4fS50b29sdGlwLmJvdHRvbSAudG9vbHRpcC1hcnJvd3t0b3A6MDtsZWZ0OjUwJTttYXJnaW4tbGVmdDotNXB4O2JvcmRlci1ib3R0b20tY29sb3I6IzAwMDtib3JkZXItd2lkdGg6MCA1cHggNXB4fS5wb3BvdmVye3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO2xlZnQ6MDt6LWluZGV4OjEwMTA7ZGlzcGxheTpub25lO21heC13aWR0aDoyNzZweDtwYWRkaW5nOjFweDt0ZXh0LWFsaWduOmxlZnQ7d2hpdGUtc3BhY2U6bm9ybWFsO2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MXB4IHNvbGlkICNjY2M7Ym9yZGVyOjFweCBzb2xpZCByZ2JhKDAsMCwwLDAuMik7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwwLDAsMC4yKTstbW96LWJveC1zaGFkb3c6MCA1cHggMTBweCByZ2JhKDAsMCwwLDAuMik7Ym94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwwLDAsMC4yKTstd2Via2l0LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDstbW96LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nO2JhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveH0ucG9wb3Zlci50b3B7bWFyZ2luLXRvcDotMTBweH0ucG9wb3Zlci5yaWdodHttYXJnaW4tbGVmdDoxMHB4fS5wb3BvdmVyLmJvdHRvbXttYXJnaW4tdG9wOjEwcHh9LnBvcG92ZXIubGVmdHttYXJnaW4tbGVmdDotMTBweH0ucG9wb3Zlci10aXRsZXtwYWRkaW5nOjhweCAxNHB4O21hcmdpbjowO2ZvbnQtc2l6ZToxNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoxOHB4O2JhY2tncm91bmQtY29sb3I6I2Y3ZjdmNztib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZWJlYmViOy13ZWJraXQtYm9yZGVyLXJhZGl1czo1cHggNXB4IDAgMDstbW96LWJvcmRlci1yYWRpdXM6NXB4IDVweCAwIDA7Ym9yZGVyLXJhZGl1czo1cHggNXB4IDAgMH0ucG9wb3Zlci10aXRsZTplbXB0eXtkaXNwbGF5Om5vbmV9LnBvcG92ZXItY29udGVudHtwYWRkaW5nOjlweCAxNHB4fS5wb3BvdmVyIC5hcnJvdywucG9wb3ZlciAuYXJyb3c6YWZ0ZXJ7cG9zaXRpb246YWJzb2x1dGU7ZGlzcGxheTpibG9jazt3aWR0aDowO2hlaWdodDowO2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXItc3R5bGU6c29saWR9LnBvcG92ZXIgLmFycm93e2JvcmRlci13aWR0aDoxMXB4fS5wb3BvdmVyIC5hcnJvdzphZnRlcntib3JkZXItd2lkdGg6MTBweDtjb250ZW50OiIifS5wb3BvdmVyLnRvcCAuYXJyb3d7Ym90dG9tOi0xMXB4O2xlZnQ6NTAlO21hcmdpbi1sZWZ0Oi0xMXB4O2JvcmRlci10b3AtY29sb3I6Izk5OTtib3JkZXItdG9wLWNvbG9yOnJnYmEoMCwwLDAsMC4yNSk7Ym9yZGVyLWJvdHRvbS13aWR0aDowfS5wb3BvdmVyLnRvcCAuYXJyb3c6YWZ0ZXJ7Ym90dG9tOjFweDttYXJnaW4tbGVmdDotMTBweDtib3JkZXItdG9wLWNvbG9yOiNmZmY7Ym9yZGVyLWJvdHRvbS13aWR0aDowfS5wb3BvdmVyLnJpZ2h0IC5hcnJvd3t0b3A6NTAlO2xlZnQ6LTExcHg7bWFyZ2luLXRvcDotMTFweDtib3JkZXItcmlnaHQtY29sb3I6Izk5OTtib3JkZXItcmlnaHQtY29sb3I6cmdiYSgwLDAsMCwwLjI1KTtib3JkZXItbGVmdC13aWR0aDowfS5wb3BvdmVyLnJpZ2h0IC5hcnJvdzphZnRlcntib3R0b206LTEwcHg7bGVmdDoxcHg7Ym9yZGVyLXJpZ2h0LWNvbG9yOiNmZmY7Ym9yZGVyLWxlZnQtd2lkdGg6MH0ucG9wb3Zlci5ib3R0b20gLmFycm93e3RvcDotMTFweDtsZWZ0OjUwJTttYXJnaW4tbGVmdDotMTFweDtib3JkZXItYm90dG9tLWNvbG9yOiM5OTk7Ym9yZGVyLWJvdHRvbS1jb2xvcjpyZ2JhKDAsMCwwLDAuMjUpO2JvcmRlci10b3Atd2lkdGg6MH0ucG9wb3Zlci5ib3R0b20gLmFycm93OmFmdGVye3RvcDoxcHg7bWFyZ2luLWxlZnQ6LTEwcHg7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmO2JvcmRlci10b3Atd2lkdGg6MH0ucG9wb3Zlci5sZWZ0IC5hcnJvd3t0b3A6NTAlO3JpZ2h0Oi0xMXB4O21hcmdpbi10b3A6LTExcHg7Ym9yZGVyLWxlZnQtY29sb3I6Izk5OTtib3JkZXItbGVmdC1jb2xvcjpyZ2JhKDAsMCwwLDAuMjUpO2JvcmRlci1yaWdodC13aWR0aDowfS5wb3BvdmVyLmxlZnQgLmFycm93OmFmdGVye3JpZ2h0OjFweDtib3R0b206LTEwcHg7Ym9yZGVyLWxlZnQtY29sb3I6I2ZmZjtib3JkZXItcmlnaHQtd2lkdGg6MH0udGh1bWJuYWlsc3ttYXJnaW4tbGVmdDotMjBweDtsaXN0LXN0eWxlOm5vbmU7Knpvb206MX0udGh1bWJuYWlsczpiZWZvcmUsLnRodW1ibmFpbHM6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LnRodW1ibmFpbHM6YWZ0ZXJ7Y2xlYXI6Ym90aH0ucm93LWZsdWlkIC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjB9LnRodW1ibmFpbHM+bGl7ZmxvYXQ6bGVmdDttYXJnaW4tYm90dG9tOjIwcHg7bWFyZ2luLWxlZnQ6MjBweH0udGh1bWJuYWlse2Rpc3BsYXk6YmxvY2s7cGFkZGluZzo0cHg7bGluZS1oZWlnaHQ6MjBweDtib3JkZXI6MXB4IHNvbGlkICNkZGQ7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLDAsMCwwLjA1NSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsMCwwLDAuMDU1KTtib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsMCwwLDAuMDU1KTstd2Via2l0LXRyYW5zaXRpb246YWxsIC4ycyBlYXNlLWluLW91dDstbW96LXRyYW5zaXRpb246YWxsIC4ycyBlYXNlLWluLW91dDstby10cmFuc2l0aW9uOmFsbCAuMnMgZWFzZS1pbi1vdXQ7dHJhbnNpdGlvbjphbGwgLjJzIGVhc2UtaW4tb3V0fWEudGh1bWJuYWlsOmhvdmVyLGEudGh1bWJuYWlsOmZvY3Vze2JvcmRlci1jb2xvcjojMDhjOy13ZWJraXQtYm94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLDEwNSwyMTQsMC4yNSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsMTA1LDIxNCwwLjI1KTtib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsMTA1LDIxNCwwLjI1KX0udGh1bWJuYWlsPmltZ3tkaXNwbGF5OmJsb2NrO21heC13aWR0aDoxMDAlO21hcmdpbi1yaWdodDphdXRvO21hcmdpbi1sZWZ0OmF1dG99LnRodW1ibmFpbCAuY2FwdGlvbntwYWRkaW5nOjlweDtjb2xvcjojNTU1fS5tZWRpYSwubWVkaWEtYm9keXtvdmVyZmxvdzpoaWRkZW47Km92ZXJmbG93OnZpc2libGU7em9vbToxfS5tZWRpYSwubWVkaWEgLm1lZGlhe21hcmdpbi10b3A6MTVweH0ubWVkaWE6Zmlyc3QtY2hpbGR7bWFyZ2luLXRvcDowfS5tZWRpYS1vYmplY3R7ZGlzcGxheTpibG9ja30ubWVkaWEtaGVhZGluZ3ttYXJnaW46MCAwIDVweH0ubWVkaWE+LnB1bGwtbGVmdHttYXJnaW4tcmlnaHQ6MTBweH0ubWVkaWE+LnB1bGwtcmlnaHR7bWFyZ2luLWxlZnQ6MTBweH0ubWVkaWEtbGlzdHttYXJnaW4tbGVmdDowO2xpc3Qtc3R5bGU6bm9uZX0ubGFiZWwsLmJhZGdle2Rpc3BsYXk6aW5saW5lLWJsb2NrO3BhZGRpbmc6MnB4IDRweDtmb250LXNpemU6MTEuODQ0cHg7Zm9udC13ZWlnaHQ6Ym9sZDtsaW5lLWhlaWdodDoxNHB4O2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTt3aGl0ZS1zcGFjZTpub3dyYXA7dmVydGljYWwtYWxpZ246YmFzZWxpbmU7YmFja2dyb3VuZC1jb2xvcjojOTk5fS5sYWJlbHstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHh9LmJhZGdle3BhZGRpbmctcmlnaHQ6OXB4O3BhZGRpbmctbGVmdDo5cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjlweDstbW96LWJvcmRlci1yYWRpdXM6OXB4O2JvcmRlci1yYWRpdXM6OXB4fS5sYWJlbDplbXB0eSwuYmFkZ2U6ZW1wdHl7ZGlzcGxheTpub25lfWEubGFiZWw6aG92ZXIsYS5sYWJlbDpmb2N1cyxhLmJhZGdlOmhvdmVyLGEuYmFkZ2U6Zm9jdXN7Y29sb3I6I2ZmZjt0ZXh0LWRlY29yYXRpb246bm9uZTtjdXJzb3I6cG9pbnRlcn0ubGFiZWwtaW1wb3J0YW50LC5iYWRnZS1pbXBvcnRhbnR7YmFja2dyb3VuZC1jb2xvcjojYjk0YTQ4fS5sYWJlbC1pbXBvcnRhbnRbaHJlZl0sLmJhZGdlLWltcG9ydGFudFtocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiM5NTNiMzl9LmxhYmVsLXdhcm5pbmcsLmJhZGdlLXdhcm5pbmd7YmFja2dyb3VuZC1jb2xvcjojZjg5NDA2fS5sYWJlbC13YXJuaW5nW2hyZWZdLC5iYWRnZS13YXJuaW5nW2hyZWZde2JhY2tncm91bmQtY29sb3I6I2M2NzYwNX0ubGFiZWwtc3VjY2VzcywuYmFkZ2Utc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiM0Njg4NDd9LmxhYmVsLXN1Y2Nlc3NbaHJlZl0sLmJhZGdlLXN1Y2Nlc3NbaHJlZl17YmFja2dyb3VuZC1jb2xvcjojMzU2NjM1fS5sYWJlbC1pbmZvLC5iYWRnZS1pbmZve2JhY2tncm91bmQtY29sb3I6IzNhODdhZH0ubGFiZWwtaW5mb1tocmVmXSwuYmFkZ2UtaW5mb1tocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiMyZDY5ODd9LmxhYmVsLWludmVyc2UsLmJhZGdlLWludmVyc2V7YmFja2dyb3VuZC1jb2xvcjojMzMzfS5sYWJlbC1pbnZlcnNlW2hyZWZdLC5iYWRnZS1pbnZlcnNlW2hyZWZde2JhY2tncm91bmQtY29sb3I6IzFhMWExYX0uYnRuIC5sYWJlbCwuYnRuIC5iYWRnZXtwb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LTFweH0uYnRuLW1pbmkgLmxhYmVsLC5idG4tbWluaSAuYmFkZ2V7dG9wOjB9QC13ZWJraXQta2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDB9dG97YmFja2dyb3VuZC1wb3NpdGlvbjowIDB9fUAtbW96LWtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwfXRve2JhY2tncm91bmQtcG9zaXRpb246MCAwfX1ALW1zLWtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwfXRve2JhY2tncm91bmQtcG9zaXRpb246MCAwfX1ALW8ta2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjowIDB9dG97YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDB9fUBrZXlmcmFtZXMgcHJvZ3Jlc3MtYmFyLXN0cmlwZXN7ZnJvbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOjQwcHggMH10b3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMH19LnByb2dyZXNze2hlaWdodDoyMHB4O21hcmdpbi1ib3R0b206MjBweDtvdmVyZmxvdzpoaWRkZW47YmFja2dyb3VuZC1jb2xvcjojZjdmN2Y3O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2Y1ZjVmNSksdG8oI2Y5ZjlmOSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZjVmNWY1JyxlbmRDb2xvcnN0cj0nI2ZmZjlmOWY5JyxHcmFkaWVudFR5cGU9MCk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwwLjEpfS5wcm9ncmVzcyAuYmFye2Zsb2F0OmxlZnQ7d2lkdGg6MDtoZWlnaHQ6MTAwJTtmb250LXNpemU6MTJweDtjb2xvcjojZmZmO3RleHQtYWxpZ246Y2VudGVyO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojMGU5MGQyO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzE0OWJkZiksdG8oIzA0ODBiZSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYxNDliZGYnLGVuZENvbG9yc3RyPScjZmYwNDgwYmUnLEdyYWRpZW50VHlwZT0wKTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwwLjE1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwwLjE1KTtib3gtc2hhZG93Omluc2V0IDAgLTFweCAwIHJnYmEoMCwwLDAsMC4xNSk7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94Oy13ZWJraXQtdHJhbnNpdGlvbjp3aWR0aCAuNnMgZWFzZTstbW96LXRyYW5zaXRpb246d2lkdGggLjZzIGVhc2U7LW8tdHJhbnNpdGlvbjp3aWR0aCAuNnMgZWFzZTt0cmFuc2l0aW9uOndpZHRoIC42cyBlYXNlfS5wcm9ncmVzcyAuYmFyKy5iYXJ7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgwLDAsMCwwLjE1KSxpbnNldCAwIC0xcHggMCByZ2JhKDAsMCwwLDAuMTUpOy1tb3otYm94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMCwwLDAsMC4xNSksaW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwwLjE1KTtib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgwLDAsMCwwLjE1KSxpbnNldCAwIC0xcHggMCByZ2JhKDAsMCwwLDAuMTUpfS5wcm9ncmVzcy1zdHJpcGVkIC5iYXJ7YmFja2dyb3VuZC1jb2xvcjojMTQ5YmRmO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpOy13ZWJraXQtYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDstbW96LWJhY2tncm91bmQtc2l6ZTo0MHB4IDQwcHg7LW8tYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDtiYWNrZ3JvdW5kLXNpemU6NDBweCA0MHB4fS5wcm9ncmVzcy5hY3RpdmUgLmJhcnstd2Via2l0LWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7LW1vei1hbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlOy1tcy1hbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlOy1vLWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7YW5pbWF0aW9uOnByb2dyZXNzLWJhci1zdHJpcGVzIDJzIGxpbmVhciBpbmZpbml0ZX0ucHJvZ3Jlc3MtZGFuZ2VyIC5iYXIsLnByb2dyZXNzIC5iYXItZGFuZ2Vye2JhY2tncm91bmQtY29sb3I6I2RkNTE0YztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNlZTVmNWIpLHRvKCNjNDNjMzUpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZWU1ZjViJyxlbmRDb2xvcnN0cj0nI2ZmYzQzYzM1JyxHcmFkaWVudFR5cGU9MCl9LnByb2dyZXNzLWRhbmdlci5wcm9ncmVzcy1zdHJpcGVkIC5iYXIsLnByb2dyZXNzLXN0cmlwZWQgLmJhci1kYW5nZXJ7YmFja2dyb3VuZC1jb2xvcjojZWU1ZjViO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5wcm9ncmVzcy1zdWNjZXNzIC5iYXIsLnByb2dyZXNzIC5iYXItc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiM1ZWI5NWU7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjNjJjNDYyKSx0bygjNTdhOTU3KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjYyYzQ2MicsZW5kQ29sb3JzdHI9JyNmZjU3YTk1NycsR3JhZGllbnRUeXBlPTApfS5wcm9ncmVzcy1zdWNjZXNzLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLXN1Y2Nlc3N7YmFja2dyb3VuZC1jb2xvcjojNjJjNDYyO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5wcm9ncmVzcy1pbmZvIC5iYXIsLnByb2dyZXNzIC5iYXItaW5mb3tiYWNrZ3JvdW5kLWNvbG9yOiM0YmIxY2Y7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjNWJjMGRlKSx0bygjMzM5YmI5KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjViYzBkZScsZW5kQ29sb3JzdHI9JyNmZjMzOWJiOScsR3JhZGllbnRUeXBlPTApfS5wcm9ncmVzcy1pbmZvLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLWluZm97YmFja2dyb3VuZC1jb2xvcjojNWJjMGRlO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5wcm9ncmVzcy13YXJuaW5nIC5iYXIsLnByb2dyZXNzIC5iYXItd2FybmluZ3tiYWNrZ3JvdW5kLWNvbG9yOiNmYWE3MzI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjZmJiNDUwKSx0bygjZjg5NDA2KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmZiYjQ1MCcsZW5kQ29sb3JzdHI9JyNmZmY4OTQwNicsR3JhZGllbnRUeXBlPTApfS5wcm9ncmVzcy13YXJuaW5nLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLXdhcm5pbmd7YmFja2dyb3VuZC1jb2xvcjojZmJiNDUwO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5hY2NvcmRpb257bWFyZ2luLWJvdHRvbToyMHB4fS5hY2NvcmRpb24tZ3JvdXB7bWFyZ2luLWJvdHRvbToycHg7Ym9yZGVyOjFweCBzb2xpZCAjZTVlNWU1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweH0uYWNjb3JkaW9uLWhlYWRpbmd7Ym9yZGVyLWJvdHRvbTowfS5hY2NvcmRpb24taGVhZGluZyAuYWNjb3JkaW9uLXRvZ2dsZXtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6OHB4IDE1cHh9LmFjY29yZGlvbi10b2dnbGV7Y3Vyc29yOnBvaW50ZXJ9LmFjY29yZGlvbi1pbm5lcntwYWRkaW5nOjlweCAxNXB4O2JvcmRlci10b3A6MXB4IHNvbGlkICNlNWU1ZTV9LmNhcm91c2Vse3Bvc2l0aW9uOnJlbGF0aXZlO21hcmdpbi1ib3R0b206MjBweDtsaW5lLWhlaWdodDoxfS5jYXJvdXNlbC1pbm5lcntwb3NpdGlvbjpyZWxhdGl2ZTt3aWR0aDoxMDAlO292ZXJmbG93OmhpZGRlbn0uY2Fyb3VzZWwtaW5uZXI+Lml0ZW17cG9zaXRpb246cmVsYXRpdmU7ZGlzcGxheTpub25lOy13ZWJraXQtdHJhbnNpdGlvbjouNnMgZWFzZS1pbi1vdXQgbGVmdDstbW96LXRyYW5zaXRpb246LjZzIGVhc2UtaW4tb3V0IGxlZnQ7LW8tdHJhbnNpdGlvbjouNnMgZWFzZS1pbi1vdXQgbGVmdDt0cmFuc2l0aW9uOi42cyBlYXNlLWluLW91dCBsZWZ0fS5jYXJvdXNlbC1pbm5lcj4uaXRlbT5pbWcsLmNhcm91c2VsLWlubmVyPi5pdGVtPmE+aW1ne2Rpc3BsYXk6YmxvY2s7bGluZS1oZWlnaHQ6MX0uY2Fyb3VzZWwtaW5uZXI+LmFjdGl2ZSwuY2Fyb3VzZWwtaW5uZXI+Lm5leHQsLmNhcm91c2VsLWlubmVyPi5wcmV2e2Rpc3BsYXk6YmxvY2t9LmNhcm91c2VsLWlubmVyPi5hY3RpdmV7bGVmdDowfS5jYXJvdXNlbC1pbm5lcj4ubmV4dCwuY2Fyb3VzZWwtaW5uZXI+LnByZXZ7cG9zaXRpb246YWJzb2x1dGU7dG9wOjA7d2lkdGg6MTAwJX0uY2Fyb3VzZWwtaW5uZXI+Lm5leHR7bGVmdDoxMDAlfS5jYXJvdXNlbC1pbm5lcj4ucHJldntsZWZ0Oi0xMDAlfS5jYXJvdXNlbC1pbm5lcj4ubmV4dC5sZWZ0LC5jYXJvdXNlbC1pbm5lcj4ucHJldi5yaWdodHtsZWZ0OjB9LmNhcm91c2VsLWlubmVyPi5hY3RpdmUubGVmdHtsZWZ0Oi0xMDAlfS5jYXJvdXNlbC1pbm5lcj4uYWN0aXZlLnJpZ2h0e2xlZnQ6MTAwJX0uY2Fyb3VzZWwtY29udHJvbHtwb3NpdGlvbjphYnNvbHV0ZTt0b3A6NDAlO2xlZnQ6MTVweDt3aWR0aDo0MHB4O2hlaWdodDo0MHB4O21hcmdpbi10b3A6LTIwcHg7Zm9udC1zaXplOjYwcHg7Zm9udC13ZWlnaHQ6MTAwO2xpbmUtaGVpZ2h0OjMwcHg7Y29sb3I6I2ZmZjt0ZXh0LWFsaWduOmNlbnRlcjtiYWNrZ3JvdW5kOiMyMjI7Ym9yZGVyOjNweCBzb2xpZCAjZmZmOy13ZWJraXQtYm9yZGVyLXJhZGl1czoyM3B4Oy1tb3otYm9yZGVyLXJhZGl1czoyM3B4O2JvcmRlci1yYWRpdXM6MjNweDtvcGFjaXR5Oi41O2ZpbHRlcjphbHBoYShvcGFjaXR5PTUwKX0uY2Fyb3VzZWwtY29udHJvbC5yaWdodHtyaWdodDoxNXB4O2xlZnQ6YXV0b30uY2Fyb3VzZWwtY29udHJvbDpob3ZlciwuY2Fyb3VzZWwtY29udHJvbDpmb2N1c3tjb2xvcjojZmZmO3RleHQtZGVjb3JhdGlvbjpub25lO29wYWNpdHk6Ljk7ZmlsdGVyOmFscGhhKG9wYWNpdHk9OTApfS5jYXJvdXNlbC1pbmRpY2F0b3Jze3Bvc2l0aW9uOmFic29sdXRlO3RvcDoxNXB4O3JpZ2h0OjE1cHg7ei1pbmRleDo1O21hcmdpbjowO2xpc3Qtc3R5bGU6bm9uZX0uY2Fyb3VzZWwtaW5kaWNhdG9ycyBsaXtkaXNwbGF5OmJsb2NrO2Zsb2F0OmxlZnQ7d2lkdGg6MTBweDtoZWlnaHQ6MTBweDttYXJnaW4tbGVmdDo1cHg7dGV4dC1pbmRlbnQ6LTk5OXB4O2JhY2tncm91bmQtY29sb3I6I2NjYztiYWNrZ3JvdW5kLWNvbG9yOnJnYmEoMjU1LDI1NSwyNTUsMC4yNSk7Ym9yZGVyLXJhZGl1czo1cHh9LmNhcm91c2VsLWluZGljYXRvcnMgLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZ9LmNhcm91c2VsLWNhcHRpb257cG9zaXRpb246YWJzb2x1dGU7cmlnaHQ6MDtib3R0b206MDtsZWZ0OjA7cGFkZGluZzoxNXB4O2JhY2tncm91bmQ6IzMzMztiYWNrZ3JvdW5kOnJnYmEoMCwwLDAsMC43NSl9LmNhcm91c2VsLWNhcHRpb24gaDQsLmNhcm91c2VsLWNhcHRpb24gcHtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiNmZmZ9LmNhcm91c2VsLWNhcHRpb24gaDR7bWFyZ2luOjAgMCA1cHh9LmNhcm91c2VsLWNhcHRpb24gcHttYXJnaW4tYm90dG9tOjB9Lmhlcm8tdW5pdHtwYWRkaW5nOjYwcHg7bWFyZ2luLWJvdHRvbTozMHB4O2ZvbnQtc2l6ZToxOHB4O2ZvbnQtd2VpZ2h0OjIwMDtsaW5lLWhlaWdodDozMHB4O2NvbG9yOmluaGVyaXQ7YmFja2dyb3VuZC1jb2xvcjojZWVlOy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweH0uaGVyby11bml0IGgxe21hcmdpbi1ib3R0b206MDtmb250LXNpemU6NjBweDtsaW5lLWhlaWdodDoxO2xldHRlci1zcGFjaW5nOi0xcHg7Y29sb3I6aW5oZXJpdH0uaGVyby11bml0IGxpe2xpbmUtaGVpZ2h0OjMwcHh9LnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHR9LnB1bGwtbGVmdHtmbG9hdDpsZWZ0fS5oaWRle2Rpc3BsYXk6bm9uZX0uc2hvd3tkaXNwbGF5OmJsb2NrfS5pbnZpc2libGV7dmlzaWJpbGl0eTpoaWRkZW59LmFmZml4e3Bvc2l0aW9uOmZpeGVkfQ==';
// main.css	
$main_style='Ym9keXsgcGFkZGluZy10b3A6MjBweDsgIHBhZGRpbmctYm90dG9tOjQwcHh9DQouY29udGFpbmVyLW5hcnJvd3sgbWFyZ2luOjAgYXV0bzsgIG1heC13aWR0aDo5MDBweH0NCi5jb250YWluZXItbmFycm93ID5ocnsgbWFyZ2luOjMwcHggMH0NCi5qdW1ib3Ryb257IG1hcmdpbjo2MHB4IDA7ICB0ZXh0LWFsaWduOmNlbnRlcn0NCi5qdW1ib3Ryb24gaDF7IGZvbnQtc2l6ZTo3MnB4OyAgbGluZS1oZWlnaHQ6MX0NCi5qdW1ib3Ryb24gLmJ0bnsgZm9udC1zaXplOjIxcHg7ICBwYWRkaW5nOjE0cHggMjRweH0NCi5icmFuZCBpeyBmb250LXNpemU6MTRweDsgIHBhZGRpbmc6MTNweDsgY29sb3I6IzMwMzAzMH0NCnVsLnNtaWxleXMge3dpZHRoOiAxNzBweH0NCi5zbWlsZXlzIGxpe2Zsb2F0OmxlZnR9';
// bootstrap-responsive.min.css	v2.3.0
$bs_responsive=
'LyohDQogKiBCb290c3RyYXAgUmVzcG9uc2l2ZSB2Mi4zLjANCiAqDQogKiBDb3B5cmlnaHQgMjAxMiBUd2l0dGVyLCBJbmMNCiAqIExpY2Vuc2VkIHVuZGVyIHRoZSBBcGFjaGUgTGljZW5zZSB2Mi4wDQogKiBodHRwOi8vd3d3LmFwYWNoZS5vcmcvbGljZW5zZXMvTElDRU5TRS0yLjANCiAqDQogKiBEZXNpZ25lZCBhbmQgYnVpbHQgd2l0aCBhbGwgdGhlIGxvdmUgaW4gdGhlIHdvcmxkIEB0d2l0dGVyIGJ5IEBtZG8gYW5kIEBmYXQuDQogKi8uY2xlYXJmaXh7Knpvb206MX0uY2xlYXJmaXg6YmVmb3JlLC5jbGVhcmZpeDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0uY2xlYXJmaXg6YWZ0ZXJ7Y2xlYXI6Ym90aH0uaGlkZS10ZXh0e2ZvbnQ6MC8wIGE7Y29sb3I6dHJhbnNwYXJlbnQ7dGV4dC1zaGFkb3c6bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjowfS5pbnB1dC1ibG9jay1sZXZlbHtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4Oy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH1ALW1zLXZpZXdwb3J0e3dpZHRoOmRldmljZS13aWR0aH0uaGlkZGVue2Rpc3BsYXk6bm9uZTt2aXNpYmlsaXR5OmhpZGRlbn0udmlzaWJsZS1waG9uZXtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS52aXNpYmxlLXRhYmxldHtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS5oaWRkZW4tZGVza3RvcHtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS52aXNpYmxlLWRlc2t0b3B7ZGlzcGxheTppbmhlcml0IWltcG9ydGFudH1AbWVkaWEobWluLXdpZHRoOjc2OHB4KSBhbmQgKG1heC13aWR0aDo5NzlweCl7LmhpZGRlbi1kZXNrdG9we2Rpc3BsYXk6aW5oZXJpdCFpbXBvcnRhbnR9LnZpc2libGUtZGVza3RvcHtkaXNwbGF5Om5vbmUhaW1wb3J0YW50fS52aXNpYmxlLXRhYmxldHtkaXNwbGF5OmluaGVyaXQhaW1wb3J0YW50fS5oaWRkZW4tdGFibGV0e2Rpc3BsYXk6bm9uZSFpbXBvcnRhbnR9fUBtZWRpYShtYXgtd2lkdGg6NzY3cHgpey5oaWRkZW4tZGVza3RvcHtkaXNwbGF5OmluaGVyaXQhaW1wb3J0YW50fS52aXNpYmxlLWRlc2t0b3B7ZGlzcGxheTpub25lIWltcG9ydGFudH0udmlzaWJsZS1waG9uZXtkaXNwbGF5OmluaGVyaXQhaW1wb3J0YW50fS5oaWRkZW4tcGhvbmV7ZGlzcGxheTpub25lIWltcG9ydGFudH19LnZpc2libGUtcHJpbnR7ZGlzcGxheTpub25lIWltcG9ydGFudH1AbWVkaWEgcHJpbnR7LnZpc2libGUtcHJpbnR7ZGlzcGxheTppbmhlcml0IWltcG9ydGFudH0uaGlkZGVuLXByaW50e2Rpc3BsYXk6bm9uZSFpbXBvcnRhbnR9fUBtZWRpYShtaW4td2lkdGg6MTIwMHB4KXsucm93e21hcmdpbi1sZWZ0Oi0zMHB4Oyp6b29tOjF9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93OmFmdGVye2NsZWFyOmJvdGh9W2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MzBweH0uY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDoxMTcwcHh9LnNwYW4xMnt3aWR0aDoxMTcwcHh9LnNwYW4xMXt3aWR0aDoxMDcwcHh9LnNwYW4xMHt3aWR0aDo5NzBweH0uc3Bhbjl7d2lkdGg6ODcwcHh9LnNwYW44e3dpZHRoOjc3MHB4fS5zcGFuN3t3aWR0aDo2NzBweH0uc3BhbjZ7d2lkdGg6NTcwcHh9LnNwYW41e3dpZHRoOjQ3MHB4fS5zcGFuNHt3aWR0aDozNzBweH0uc3BhbjN7d2lkdGg6MjcwcHh9LnNwYW4ye3dpZHRoOjE3MHB4fS5zcGFuMXt3aWR0aDo3MHB4fS5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMjMwcHh9Lm9mZnNldDExe21hcmdpbi1sZWZ0OjExMzBweH0ub2Zmc2V0MTB7bWFyZ2luLWxlZnQ6MTAzMHB4fS5vZmZzZXQ5e21hcmdpbi1sZWZ0OjkzMHB4fS5vZmZzZXQ4e21hcmdpbi1sZWZ0OjgzMHB4fS5vZmZzZXQ3e21hcmdpbi1sZWZ0OjczMHB4fS5vZmZzZXQ2e21hcmdpbi1sZWZ0OjYzMHB4fS5vZmZzZXQ1e21hcmdpbi1sZWZ0OjUzMHB4fS5vZmZzZXQ0e21hcmdpbi1sZWZ0OjQzMHB4fS5vZmZzZXQze21hcmdpbi1sZWZ0OjMzMHB4fS5vZmZzZXQye21hcmdpbi1sZWZ0OjIzMHB4fS5vZmZzZXQxe21hcmdpbi1sZWZ0OjEzMHB4fS5yb3ctZmx1aWR7d2lkdGg6MTAwJTsqem9vbToxfS5yb3ctZmx1aWQ6YmVmb3JlLC5yb3ctZmx1aWQ6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LnJvdy1mbHVpZDphZnRlcntjbGVhcjpib3RofS5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJde2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bGVmdDt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDttYXJnaW4tbGVmdDoyLjU2NDEwMjU2NDEwMjU2NCU7Km1hcmdpbi1sZWZ0OjIuNTEwOTExMDc0NzQwODYxNiU7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94fS5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjB9LnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6Mi41NjQxMDI1NjQxMDI1NjQlfS5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSV9LnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQ1Mjk5MTQ1Mjk5MTQ1JTsqd2lkdGg6OTEuMzk5Nzk5OTYzNjI5NzUlfS5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi45MDU5ODI5MDU5ODI5MSU7KndpZHRoOjgyLjg1Mjc5MTQxNjYyMTIlfS5yb3ctZmx1aWQgLnNwYW45e3dpZHRoOjc0LjM1ODk3NDM1ODk3NDM2JTsqd2lkdGg6NzQuMzA1NzgyODY5NjEyNjYlfS5yb3ctZmx1aWQgLnNwYW44e3dpZHRoOjY1LjgxMTk2NTgxMTk2NTgyJTsqd2lkdGg6NjUuNzU4Nzc0MzIyNjA0MTElfS5yb3ctZmx1aWQgLnNwYW43e3dpZHRoOjU3LjI2NDk1NzI2NDk1NzI2JTsqd2lkdGg6NTcuMjExNzY1Nzc1NTk1NTYlfS5yb3ctZmx1aWQgLnNwYW42e3dpZHRoOjQ4LjcxNzk0ODcxNzk0ODcxNSU7KndpZHRoOjQ4LjY2NDc1NzIyODU4NzAxNCV9LnJvdy1mbHVpZCAuc3BhbjV7d2lkdGg6NDAuMTcwOTQwMTcwOTQwMTclOyp3aWR0aDo0MC4xMTc3NDg2ODE1Nzg0NyV9LnJvdy1mbHVpZCAuc3BhbjR7d2lkdGg6MzEuNjIzOTMxNjIzOTMxNjI1JTsqd2lkdGg6MzEuNTcwNzQwMTM0NTY5OTI0JX0ucm93LWZsdWlkIC5zcGFuM3t3aWR0aDoyMy4wNzY5MjMwNzY5MjMwNzclOyp3aWR0aDoyMy4wMjM3MzE1ODc1NjEzNzUlfS5yb3ctZmx1aWQgLnNwYW4ye3dpZHRoOjE0LjUyOTkxNDUyOTkxNDUzJTsqd2lkdGg6MTQuNDc2NzIzMDQwNTUyODI4JX0ucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo1Ljk4MjkwNTk4MjkwNTk4MyU7KndpZHRoOjUuOTI5NzE0NDkzNTQ0MjgxJX0ucm93LWZsdWlkIC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMDUuMTI4MjA1MTI4MjA1MTIlOyptYXJnaW4tbGVmdDoxMDUuMDIxODIyMTQ5NDgxNzElfS5yb3ctZmx1aWQgLm9mZnNldDEyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjEwMi41NjQxMDI1NjQxMDI1NyU7Km1hcmdpbi1sZWZ0OjEwMi40NTc3MTk1ODUzNzkxNSV9LnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTYuNTgxMTk2NTgxMTk2NTglOyptYXJnaW4tbGVmdDo5Ni40NzQ4MTM2MDI0NzMxNiV9LnJvdy1mbHVpZCAub2Zmc2V0MTE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OTQuMDE3MDk0MDE3MDk0MDIlOyptYXJnaW4tbGVmdDo5My45MTA3MTEwMzgzNzA2MSV9LnJvdy1mbHVpZCAub2Zmc2V0MTB7bWFyZ2luLWxlZnQ6ODguMDM0MTg4MDM0MTg4MDMlOyptYXJnaW4tbGVmdDo4Ny45Mjc4MDUwNTU0NjQ2MiV9LnJvdy1mbHVpZCAub2Zmc2V0MTA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6ODUuNDcwMDg1NDcwMDg1NDglOyptYXJnaW4tbGVmdDo4NS4zNjM3MDI0OTEzNjIwNiV9LnJvdy1mbHVpZCAub2Zmc2V0OXttYXJnaW4tbGVmdDo3OS40ODcxNzk0ODcxNzk0OSU7Km1hcmdpbi1sZWZ0Ojc5LjM4MDc5NjUwODQ1NjA3JX0ucm93LWZsdWlkIC5vZmZzZXQ5OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojc2LjkyMzA3NjkyMzA3NjkzJTsqbWFyZ2luLWxlZnQ6NzYuODE2NjkzOTQ0MzUzNTIlfS5yb3ctZmx1aWQgLm9mZnNldDh7bWFyZ2luLWxlZnQ6NzAuOTQwMTcwOTQwMTcwOTQlOyptYXJnaW4tbGVmdDo3MC44MzM3ODc5NjE0NDc1MyV9LnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC4zNzYwNjgzNzYwNjgzOSU7Km1hcmdpbi1sZWZ0OjY4LjI2OTY4NTM5NzM0NDk3JX0ucm93LWZsdWlkIC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjYyLjM5MzE2MjM5MzE2MjM4NSU7Km1hcmdpbi1sZWZ0OjYyLjI4Njc3OTQxNDQzODk5JX0ucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5LjgyOTA1OTgyOTA1OTgyJTsqbWFyZ2luLWxlZnQ6NTkuNzIyNjc2ODUwMzM2NDIlfS5yb3ctZmx1aWQgLm9mZnNldDZ7bWFyZ2luLWxlZnQ6NTMuODQ2MTUzODQ2MTUzODQlOyptYXJnaW4tbGVmdDo1My43Mzk3NzA4Njc0MzA0NDQlfS5yb3ctZmx1aWQgLm9mZnNldDY6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTEuMjgyMDUxMjgyMDUxMjglOyptYXJnaW4tbGVmdDo1MS4xNzU2NjgzMDMzMjc4NzUlfS5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDUuMjk5MTQ1Mjk5MTQ1Mjk1JTsqbWFyZ2luLWxlZnQ6NDUuMTkyNzYyMzIwNDIxOSV9LnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi43MzUwNDI3MzUwNDI3MyU7Km1hcmdpbi1sZWZ0OjQyLjYyODY1OTc1NjMxOTMzJX0ucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM2Ljc1MjEzNjc1MjEzNjc1JTsqbWFyZ2luLWxlZnQ6MzYuNjQ1NzUzNzczNDEzMzU0JX0ucm93LWZsdWlkIC5vZmZzZXQ0OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjM0LjE4ODAzNDE4ODAzNDE5JTsqbWFyZ2luLWxlZnQ6MzQuMDgxNjUxMjA5MzEwNzg1JX0ucm93LWZsdWlkIC5vZmZzZXQze21hcmdpbi1sZWZ0OjI4LjIwNTEyODIwNTEyODIwNCU7Km1hcmdpbi1sZWZ0OjI4LjA5ODc0NTIyNjQwNDglfS5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNjQxMDI1NjQxMDI1NjQyJTsqbWFyZ2luLWxlZnQ6MjUuNTM0NjQyNjYyMzAyMjQlfS5yb3ctZmx1aWQgLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTkuNjU4MTE5NjU4MTE5NjYlOyptYXJnaW4tbGVmdDoxOS41NTE3MzY2NzkzOTYyNTclfS5yb3ctZmx1aWQgLm9mZnNldDI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTcuMDk0MDE3MDk0MDE3MDk0JTsqbWFyZ2luLWxlZnQ6MTYuOTg3NjM0MTE1MjkzNjklfS5yb3ctZmx1aWQgLm9mZnNldDF7bWFyZ2luLWxlZnQ6MTEuMTExMTExMTExMTExMTElOyptYXJnaW4tbGVmdDoxMS4wMDQ3MjgxMzIzODc3MDglfS5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41NDcwMDg1NDcwMDg1NDclOyptYXJnaW4tbGVmdDo4LjQ0MDYyNTU2ODI4NTE0MiV9aW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7bWFyZ2luLWxlZnQ6MH0uY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MzBweH1pbnB1dC5zcGFuMTIsdGV4dGFyZWEuc3BhbjEyLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMnt3aWR0aDoxMTU2cHh9aW5wdXQuc3BhbjExLHRleHRhcmVhLnNwYW4xMSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMTF7d2lkdGg6MTA1NnB4fWlucHV0LnNwYW4xMCx0ZXh0YXJlYS5zcGFuMTAsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEwe3dpZHRoOjk1NnB4fWlucHV0LnNwYW45LHRleHRhcmVhLnNwYW45LC51bmVkaXRhYmxlLWlucHV0LnNwYW45e3dpZHRoOjg1NnB4fWlucHV0LnNwYW44LHRleHRhcmVhLnNwYW44LC51bmVkaXRhYmxlLWlucHV0LnNwYW44e3dpZHRoOjc1NnB4fWlucHV0LnNwYW43LHRleHRhcmVhLnNwYW43LC51bmVkaXRhYmxlLWlucHV0LnNwYW43e3dpZHRoOjY1NnB4fWlucHV0LnNwYW42LHRleHRhcmVhLnNwYW42LC51bmVkaXRhYmxlLWlucHV0LnNwYW42e3dpZHRoOjU1NnB4fWlucHV0LnNwYW41LHRleHRhcmVhLnNwYW41LC51bmVkaXRhYmxlLWlucHV0LnNwYW41e3dpZHRoOjQ1NnB4fWlucHV0LnNwYW40LHRleHRhcmVhLnNwYW40LC51bmVkaXRhYmxlLWlucHV0LnNwYW40e3dpZHRoOjM1NnB4fWlucHV0LnNwYW4zLHRleHRhcmVhLnNwYW4zLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ze3dpZHRoOjI1NnB4fWlucHV0LnNwYW4yLHRleHRhcmVhLnNwYW4yLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ye3dpZHRoOjE1NnB4fWlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjU2cHh9LnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6LTMwcHh9LnRodW1ibmFpbHM+bGl7bWFyZ2luLWxlZnQ6MzBweH0ucm93LWZsdWlkIC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjB9fUBtZWRpYShtaW4td2lkdGg6NzY4cHgpIGFuZCAobWF4LXdpZHRoOjk3OXB4KXsucm93e21hcmdpbi1sZWZ0Oi0yMHB4Oyp6b29tOjF9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93OmFmdGVye2NsZWFyOmJvdGh9W2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MjBweH0uY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDo3MjRweH0uc3BhbjEye3dpZHRoOjcyNHB4fS5zcGFuMTF7d2lkdGg6NjYycHh9LnNwYW4xMHt3aWR0aDo2MDBweH0uc3Bhbjl7d2lkdGg6NTM4cHh9LnNwYW44e3dpZHRoOjQ3NnB4fS5zcGFuN3t3aWR0aDo0MTRweH0uc3BhbjZ7d2lkdGg6MzUycHh9LnNwYW41e3dpZHRoOjI5MHB4fS5zcGFuNHt3aWR0aDoyMjhweH0uc3BhbjN7d2lkdGg6MTY2cHh9LnNwYW4ye3dpZHRoOjEwNHB4fS5zcGFuMXt3aWR0aDo0MnB4fS5vZmZzZXQxMnttYXJnaW4tbGVmdDo3NjRweH0ub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6NzAycHh9Lm9mZnNldDEwe21hcmdpbi1sZWZ0OjY0MHB4fS5vZmZzZXQ5e21hcmdpbi1sZWZ0OjU3OHB4fS5vZmZzZXQ4e21hcmdpbi1sZWZ0OjUxNnB4fS5vZmZzZXQ3e21hcmdpbi1sZWZ0OjQ1NHB4fS5vZmZzZXQ2e21hcmdpbi1sZWZ0OjM5MnB4fS5vZmZzZXQ1e21hcmdpbi1sZWZ0OjMzMHB4fS5vZmZzZXQ0e21hcmdpbi1sZWZ0OjI2OHB4fS5vZmZzZXQze21hcmdpbi1sZWZ0OjIwNnB4fS5vZmZzZXQye21hcmdpbi1sZWZ0OjE0NHB4fS5vZmZzZXQxe21hcmdpbi1sZWZ0OjgycHh9LnJvdy1mbHVpZHt3aWR0aDoxMDAlOyp6b29tOjF9LnJvdy1mbHVpZDpiZWZvcmUsLnJvdy1mbHVpZDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucm93LWZsdWlkOmFmdGVye2NsZWFyOmJvdGh9LnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTpibG9jaztmbG9hdDpsZWZ0O3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4O21hcmdpbi1sZWZ0OjIuNzYyNDMwOTM5MjI2NTE5NCU7Km1hcmdpbi1sZWZ0OjIuNzA5MjM5NDQ5ODY0ODE3JTstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3h9LnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl06Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MH0ucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyLjc2MjQzMDkzOTIyNjUxOTQlfS5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSV9LnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQzNjQ2NDA4ODM5Nzc4JTsqd2lkdGg6OTEuMzgzMjcyNTk5MDM2MDglfS5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi44NzI5MjgxNzY3OTU1OCU7KndpZHRoOjgyLjgxOTczNjY4NzQzMzg3JX0ucm93LWZsdWlkIC5zcGFuOXt3aWR0aDo3NC4zMDkzOTIyNjUxOTMzNyU7KndpZHRoOjc0LjI1NjIwMDc3NTgzMTY2JX0ucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS43NDU4NTYzNTM1OTExNyU7KndpZHRoOjY1LjY5MjY2NDg2NDIyOTQ2JX0ucm93LWZsdWlkIC5zcGFuN3t3aWR0aDo1Ny4xODIzMjA0NDE5ODg5NSU7KndpZHRoOjU3LjEyOTEyODk1MjYyNzI1JX0ucm93LWZsdWlkIC5zcGFuNnt3aWR0aDo0OC42MTg3ODQ1MzAzODY3NCU7KndpZHRoOjQ4LjU2NTU5MzA0MTAyNTA0JX0ucm93LWZsdWlkIC5zcGFuNXt3aWR0aDo0MC4wNTUyNDg2MTg3ODQ1MyU7KndpZHRoOjQwLjAwMjA1NzEyOTQyMjgzJX0ucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS40OTE3MTI3MDcxODIzMjMlOyp3aWR0aDozMS40Mzg1MjEyMTc4MjA2MiV9LnJvdy1mbHVpZCAuc3BhbjN7d2lkdGg6MjIuOTI4MTc2Nzk1NTgwMTElOyp3aWR0aDoyMi44NzQ5ODUzMDYyMTg0MSV9LnJvdy1mbHVpZCAuc3BhbjJ7d2lkdGg6MTQuMzY0NjQwODgzOTc3OSU7KndpZHRoOjE0LjMxMTQ0OTM5NDYxNjE5OSV9LnJvdy1mbHVpZCAuc3BhbjF7d2lkdGg6NS44MDExMDQ5NzIzNzU2OTElOyp3aWR0aDo1Ljc0NzkxMzQ4MzAxMzk4OCV9LnJvdy1mbHVpZCAub2Zmc2V0MTJ7bWFyZ2luLWxlZnQ6MTA1LjUyNDg2MTg3ODQ1MzA0JTsqbWFyZ2luLWxlZnQ6MTA1LjQxODQ3ODg5OTcyOTYyJX0ucm93LWZsdWlkIC5vZmZzZXQxMjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxMDIuNzYyNDMwOTM5MjI2NTIlOyptYXJnaW4tbGVmdDoxMDIuNjU2MDQ3OTYwNTAzMSV9LnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTYuOTYxMzI1OTY2ODUwODIlOyptYXJnaW4tbGVmdDo5Ni44NTQ5NDI5ODgxMjc0JX0ucm93LWZsdWlkIC5vZmZzZXQxMTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo5NC4xOTg4OTUwMjc2MjQzJTsqbWFyZ2luLWxlZnQ6OTQuMDkyNTEyMDQ4OTAwODklfS5yb3ctZmx1aWQgLm9mZnNldDEwe21hcmdpbi1sZWZ0Ojg4LjM5Nzc5MDA1NTI0ODYyJTsqbWFyZ2luLWxlZnQ6ODguMjkxNDA3MDc2NTI1MiV9LnJvdy1mbHVpZCAub2Zmc2V0MTA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6ODUuNjM1MzU5MTE2MDIyMSU7Km1hcmdpbi1sZWZ0Ojg1LjUyODk3NjEzNzI5ODY4JX0ucm93LWZsdWlkIC5vZmZzZXQ5e21hcmdpbi1sZWZ0Ojc5LjgzNDI1NDE0MzY0NjQlOyptYXJnaW4tbGVmdDo3OS43Mjc4NzExNjQ5MjI5OSV9LnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ny4wNzE4MjMyMDQ0MTk4OSU7Km1hcmdpbi1sZWZ0Ojc2Ljk2NTQ0MDIyNTY5NjQ3JX0ucm93LWZsdWlkIC5vZmZzZXQ4e21hcmdpbi1sZWZ0OjcxLjI3MDcxODIzMjA0NDIlOyptYXJnaW4tbGVmdDo3MS4xNjQzMzUyNTMzMjA3OSV9LnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC41MDgyODcyOTI4MTc2OCU7Km1hcmdpbi1sZWZ0OjY4LjQwMTkwNDMxNDA5NDI3JX0ucm93LWZsdWlkIC5vZmZzZXQ3e21hcmdpbi1sZWZ0OjYyLjcwNzE4MjMyMDQ0MTk5JTsqbWFyZ2luLWxlZnQ6NjIuNjAwNzk5MzQxNzE4NTg0JX0ucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5Ljk0NDc1MTM4MTIxNTQ3JTsqbWFyZ2luLWxlZnQ6NTkuODM4MzY4NDAyNDkyMDY1JX0ucm93LWZsdWlkIC5vZmZzZXQ2e21hcmdpbi1sZWZ0OjU0LjE0MzY0NjQwODgzOTc4JTsqbWFyZ2luLWxlZnQ6NTQuMDM3MjYzNDMwMTE2Mzc2JX0ucm93LWZsdWlkIC5vZmZzZXQ2OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjUxLjM4MTIxNTQ2OTYxMzI2JTsqbWFyZ2luLWxlZnQ6NTEuMjc0ODMyNDkwODg5ODYlfS5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDUuNTgwMTEwNDk3MjM3NTclOyptYXJnaW4tbGVmdDo0NS40NzM3Mjc1MTg1MTQxNyV9LnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi44MTc2Nzk1NTgwMTEwNSU7Km1hcmdpbi1sZWZ0OjQyLjcxMTI5NjU3OTI4NzY1JX0ucm93LWZsdWlkIC5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM3LjAxNjU3NDU4NTYzNTM2JTsqbWFyZ2luLWxlZnQ6MzYuOTEwMTkxNjA2OTExOTYlfS5yb3ctZmx1aWQgLm9mZnNldDQ6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MzQuMjU0MTQzNjQ2NDA4ODQlOyptYXJnaW4tbGVmdDozNC4xNDc3NjA2Njc2ODU0NCV9LnJvdy1mbHVpZCAub2Zmc2V0M3ttYXJnaW4tbGVmdDoyOC40NTMwMzg2NzQwMzMxNSU7Km1hcmdpbi1sZWZ0OjI4LjM0NjY1NTY5NTMwOTc0NiV9LnJvdy1mbHVpZCAub2Zmc2V0MzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoyNS42OTA2MDc3MzQ4MDY2MyU7Km1hcmdpbi1sZWZ0OjI1LjU4NDIyNDc1NjA4MzIyNyV9LnJvdy1mbHVpZCAub2Zmc2V0MnttYXJnaW4tbGVmdDoxOS44ODk1MDI3NjI0MzA5NCU7Km1hcmdpbi1sZWZ0OjE5Ljc4MzExOTc4MzcwNzUzNyV9LnJvdy1mbHVpZCAub2Zmc2V0MjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxNy4xMjcwNzE4MjMyMDQ0MiU7Km1hcmdpbi1sZWZ0OjE3LjAyMDY4ODg0NDQ4MTAyJX0ucm93LWZsdWlkIC5vZmZzZXQxe21hcmdpbi1sZWZ0OjExLjMyNTk2Njg1MDgyODczJTsqbWFyZ2luLWxlZnQ6MTEuMjE5NTgzODcyMTA1MzI1JX0ucm93LWZsdWlkIC5vZmZzZXQxOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjguNTYzNTM1OTExNjAyMjElOyptYXJnaW4tbGVmdDo4LjQ1NzE1MjkzMjg3ODgwNiV9aW5wdXQsdGV4dGFyZWEsLnVuZWRpdGFibGUtaW5wdXR7bWFyZ2luLWxlZnQ6MH0uY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MjBweH1pbnB1dC5zcGFuMTIsdGV4dGFyZWEuc3BhbjEyLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMnt3aWR0aDo3MTBweH1pbnB1dC5zcGFuMTEsdGV4dGFyZWEuc3BhbjExLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMXt3aWR0aDo2NDhweH1pbnB1dC5zcGFuMTAsdGV4dGFyZWEuc3BhbjEwLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMHt3aWR0aDo1ODZweH1pbnB1dC5zcGFuOSx0ZXh0YXJlYS5zcGFuOSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOXt3aWR0aDo1MjRweH1pbnB1dC5zcGFuOCx0ZXh0YXJlYS5zcGFuOCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo0NjJweH1pbnB1dC5zcGFuNyx0ZXh0YXJlYS5zcGFuNywudW5lZGl0YWJsZS1pbnB1dC5zcGFuN3t3aWR0aDo0MDBweH1pbnB1dC5zcGFuNix0ZXh0YXJlYS5zcGFuNiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNnt3aWR0aDozMzhweH1pbnB1dC5zcGFuNSx0ZXh0YXJlYS5zcGFuNSwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDoyNzZweH1pbnB1dC5zcGFuNCx0ZXh0YXJlYS5zcGFuNCwudW5lZGl0YWJsZS1pbnB1dC5zcGFuNHt3aWR0aDoyMTRweH1pbnB1dC5zcGFuMyx0ZXh0YXJlYS5zcGFuMywudW5lZGl0YWJsZS1pbnB1dC5zcGFuM3t3aWR0aDoxNTJweH1pbnB1dC5zcGFuMix0ZXh0YXJlYS5zcGFuMiwudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDo5MHB4fWlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjI4cHh9fUBtZWRpYShtYXgtd2lkdGg6NzY3cHgpe2JvZHl7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctbGVmdDoyMHB4fS5uYXZiYXItZml4ZWQtdG9wLC5uYXZiYXItZml4ZWQtYm90dG9tLC5uYXZiYXItc3RhdGljLXRvcHttYXJnaW4tcmlnaHQ6LTIwcHg7bWFyZ2luLWxlZnQ6LTIwcHh9LmNvbnRhaW5lci1mbHVpZHtwYWRkaW5nOjB9LmRsLWhvcml6b250YWwgZHR7ZmxvYXQ6bm9uZTt3aWR0aDphdXRvO2NsZWFyOm5vbmU7dGV4dC1hbGlnbjpsZWZ0fS5kbC1ob3Jpem9udGFsIGRke21hcmdpbi1sZWZ0OjB9LmNvbnRhaW5lcnt3aWR0aDphdXRvfS5yb3ctZmx1aWR7d2lkdGg6MTAwJX0ucm93LC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjB9LnRodW1ibmFpbHM+bGl7ZmxvYXQ6bm9uZTttYXJnaW4tbGVmdDowfVtjbGFzcyo9InNwYW4iXSwudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO2Zsb2F0Om5vbmU7d2lkdGg6MTAwJTttYXJnaW4tbGVmdDowOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0uc3BhbjEyLC5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0ucm93LWZsdWlkIFtjbGFzcyo9Im9mZnNldCJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjB9LmlucHV0LWxhcmdlLC5pbnB1dC14bGFyZ2UsLmlucHV0LXh4bGFyZ2UsaW5wdXRbY2xhc3MqPSJzcGFuIl0sc2VsZWN0W2NsYXNzKj0ic3BhbiJdLHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC51bmVkaXRhYmxlLWlucHV0e2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTttaW4taGVpZ2h0OjMwcHg7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94fS5pbnB1dC1wcmVwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgaW5wdXQsLmlucHV0LXByZXBlbmQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLmlucHV0LWFwcGVuZCBpbnB1dFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmlubGluZS1ibG9jazt3aWR0aDphdXRvfS5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDowfS5tb2RhbHtwb3NpdGlvbjpmaXhlZDt0b3A6MjBweDtyaWdodDoyMHB4O2xlZnQ6MjBweDt3aWR0aDphdXRvO21hcmdpbjowfS5tb2RhbC5mYWRle3RvcDotMTAwcHh9Lm1vZGFsLmZhZGUuaW57dG9wOjIwcHh9fUBtZWRpYShtYXgtd2lkdGg6NDgwcHgpey5uYXYtY29sbGFwc2V7LXdlYmtpdC10cmFuc2Zvcm06dHJhbnNsYXRlM2QoMCwwLDApfS5wYWdlLWhlYWRlciBoMSBzbWFsbHtkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjIwcHh9aW5wdXRbdHlwZT0iY2hlY2tib3giXSxpbnB1dFt0eXBlPSJyYWRpbyJde2JvcmRlcjoxcHggc29saWQgI2NjY30uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWxhYmVse2Zsb2F0Om5vbmU7d2lkdGg6YXV0bztwYWRkaW5nLXRvcDowO3RleHQtYWxpZ246bGVmdH0uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sc3ttYXJnaW4tbGVmdDowfS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtbGlzdHtwYWRkaW5nLXRvcDowfS5mb3JtLWhvcml6b250YWwgLmZvcm0tYWN0aW9uc3twYWRkaW5nLXJpZ2h0OjEwcHg7cGFkZGluZy1sZWZ0OjEwcHh9Lm1lZGlhIC5wdWxsLWxlZnQsLm1lZGlhIC5wdWxsLXJpZ2h0e2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bm9uZTttYXJnaW4tYm90dG9tOjEwcHh9Lm1lZGlhLW9iamVjdHttYXJnaW4tcmlnaHQ6MDttYXJnaW4tbGVmdDowfS5tb2RhbHt0b3A6MTBweDtyaWdodDoxMHB4O2xlZnQ6MTBweH0ubW9kYWwtaGVhZGVyIC5jbG9zZXtwYWRkaW5nOjEwcHg7bWFyZ2luOi0xMHB4fS5jYXJvdXNlbC1jYXB0aW9ue3Bvc2l0aW9uOnN0YXRpY319QG1lZGlhKG1heC13aWR0aDo5NzlweCl7Ym9keXtwYWRkaW5nLXRvcDowfS5uYXZiYXItZml4ZWQtdG9wLC5uYXZiYXItZml4ZWQtYm90dG9te3Bvc2l0aW9uOnN0YXRpY30ubmF2YmFyLWZpeGVkLXRvcHttYXJnaW4tYm90dG9tOjIwcHh9Lm5hdmJhci1maXhlZC1ib3R0b217bWFyZ2luLXRvcDoyMHB4fS5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLm5hdmJhci1pbm5lcntwYWRkaW5nOjVweH0ubmF2YmFyIC5jb250YWluZXJ7d2lkdGg6YXV0bztwYWRkaW5nOjB9Lm5hdmJhciAuYnJhbmR7cGFkZGluZy1yaWdodDoxMHB4O3BhZGRpbmctbGVmdDoxMHB4O21hcmdpbjowIDAgMCAtNXB4fS5uYXYtY29sbGFwc2V7Y2xlYXI6Ym90aH0ubmF2LWNvbGxhcHNlIC5uYXZ7ZmxvYXQ6bm9uZTttYXJnaW46MCAwIDEwcHh9Lm5hdi1jb2xsYXBzZSAubmF2Pmxpe2Zsb2F0Om5vbmV9Lm5hdi1jb2xsYXBzZSAubmF2PmxpPmF7bWFyZ2luLWJvdHRvbToycHh9Lm5hdi1jb2xsYXBzZSAubmF2Pi5kaXZpZGVyLXZlcnRpY2Fse2Rpc3BsYXk6bm9uZX0ubmF2LWNvbGxhcHNlIC5uYXYgLm5hdi1oZWFkZXJ7Y29sb3I6Izc3Nzt0ZXh0LXNoYWRvdzpub25lfS5uYXYtY29sbGFwc2UgLm5hdj5saT5hLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYXtwYWRkaW5nOjlweCAxNXB4O2ZvbnQtd2VpZ2h0OmJvbGQ7Y29sb3I6Izc3Nzstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHh9Lm5hdi1jb2xsYXBzZSAuYnRue3BhZGRpbmc6NHB4IDEwcHggNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHh9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBsaStsaSBhe21hcmdpbi1ib3R0b206MnB4fS5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmZvY3VzLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYTpob3ZlciwubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51IGE6Zm9jdXN7YmFja2dyb3VuZC1jb2xvcjojZjJmMmYyfS5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXY+bGk+YSwubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhe2NvbG9yOiM5OTl9Lm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXY+bGk+YTpmb2N1cywubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSBhOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51IGE6Zm9jdXN7YmFja2dyb3VuZC1jb2xvcjojMTExfS5uYXYtY29sbGFwc2UuaW4gLmJ0bi1ncm91cHtwYWRkaW5nOjA7bWFyZ2luLXRvcDo1cHh9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudXtwb3NpdGlvbjpzdGF0aWM7dG9wOmF1dG87bGVmdDphdXRvO2Rpc3BsYXk6bm9uZTtmbG9hdDpub25lO21heC13aWR0aDpub25lO3BhZGRpbmc6MDttYXJnaW46MCAxNXB4O2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyOjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowOy13ZWJraXQtYm94LXNoYWRvdzpub25lOy1tb3otYm94LXNoYWRvdzpub25lO2JveC1zaGFkb3c6bm9uZX0ubmF2LWNvbGxhcHNlIC5vcGVuPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2t9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudTpiZWZvcmUsLm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudTphZnRlcntkaXNwbGF5Om5vbmV9Lm5hdi1jb2xsYXBzZSAuZHJvcGRvd24tbWVudSAuZGl2aWRlcntkaXNwbGF5Om5vbmV9Lm5hdi1jb2xsYXBzZSAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZSwubmF2LWNvbGxhcHNlIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXJ7ZGlzcGxheTpub25lfS5uYXYtY29sbGFwc2UgLm5hdmJhci1mb3JtLC5uYXYtY29sbGFwc2UgLm5hdmJhci1zZWFyY2h7ZmxvYXQ6bm9uZTtwYWRkaW5nOjEwcHggMTVweDttYXJnaW46MTBweCAwO2JvcmRlci10b3A6MXB4IHNvbGlkICNmMmYyZjI7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2YyZjJmMjstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEpLDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSl9Lm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLm5hdmJhci1mb3JtLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXZiYXItc2VhcmNoe2JvcmRlci10b3AtY29sb3I6IzExMTtib3JkZXItYm90dG9tLWNvbG9yOiMxMTF9Lm5hdmJhciAubmF2LWNvbGxhcHNlIC5uYXYucHVsbC1yaWdodHtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjB9Lm5hdi1jb2xsYXBzZSwubmF2LWNvbGxhcHNlLmNvbGxhcHNle2hlaWdodDowO292ZXJmbG93OmhpZGRlbn0ubmF2YmFyIC5idG4tbmF2YmFye2Rpc3BsYXk6YmxvY2t9Lm5hdmJhci1zdGF0aWMgLm5hdmJhci1pbm5lcntwYWRkaW5nLXJpZ2h0OjEwcHg7cGFkZGluZy1sZWZ0OjEwcHh9fUBtZWRpYShtaW4td2lkdGg6OTgwcHgpey5uYXYtY29sbGFwc2UuY29sbGFwc2V7aGVpZ2h0OmF1dG8haW1wb3J0YW50O292ZXJmbG93OnZpc2libGUhaW1wb3J0YW50fX0=';
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
   <label class="control-label">Formattage</label>
   <div class="controls">
   <div class="btn-toolbar">
                  
    <div class="btn-group">           
       <a class="btn" href="javascript:insert(\'[b]\',\'[/b]\')" rel="tooltip" title="Gras"><i class="icon-bold"></i></a>
       <a class="btn" href="javascript:insert(\'[i]\',\'[/i]\')" rel="tooltip" title="Italique"><i class="icon-italic"></i></a>
       <a class="btn" href="javascript:insert(\'[u]\',\'[/u]\')" rel="tooltip" title="Souligné"><i class="icon-text-width"></i></a>
       <a class="btn" href="javascript:insert(\'[s]\',\'[/s]\')" rel="tooltip" title="Barré"><i class="icon-ban-circle"></i></a>
       <a class="btn" href="javascript:insert(\'[quote]\',\'[/quote]\')" rel="tooltip" title="Citation"><i class="icon-comment"></i></a>
       <a class="btn" href="javascript:insert(\'[c]\',\'[/c]\')" rel="tooltip" title="Code"><i class="icon-list-alt"></i></a>
       <a class="btn" href="javascript:insert(\'[url]\',\'[/url]\')" rel="tooltip" title="Inséré un lien"><i class="icon-share"></i></a>
       <a class="btn" href="javascript:insert(\'[img]\',\'[/img]\')" rel="tooltip" title="Inséré une image"><i class="icon-picture"></i></a>
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
            $buffer .= '<a class="btn btn-mini" href="' .getURL(). '#bottom" onclick="quote("'.$auth.'",'.$cnt.')" rel="tooltip" title="citer le message de '.$auth.'" /><i class="icon-comment"></i> Citer</a></div></li>
			<li class="divider"></li>
			<li class="muted"><i class="icon-time"></i> '.date('d/m/y à H:i', $time).'</li>
			    </ul>
		</div><!-- /span3 well -->';
			// Message
			$buffer .= '<div class="span8" id="td'.$cnt.'">'.decode($content).'<div class="clearfix"></div>';
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
  <h3 id="myModalLabel"><a href="?private='.$m[1].'" title="message privé">'.clean($m[1]).'</a> <small>le '.date('d/m/Y @ H:i',$m[0]).'</small></h3>';
		else {
			// eregi("([0-9]{1,3}\.[0-9]{1,3})",$m[1],$reg);
			$m[1]=preg_replace('/(([0-9]{1,3}\.[0-9]{1,3})\.([0-9]{1,3}\.[0-9]{1,3}))/i','\\2.x.x',$m[1]);
			$pvtBox .= $m[1].' le '.date('d/m/Y @ H:i',$m[0]);
		}
		$pvtBox .= '<p>'.decode($m[2]).'<p><hr />';
	}
	$pvtBox .= '
</div>	
  <div class="modal-footer">
    <a href="?delprivate=1" class="btn btn-inverse"><i class="icon-trash icon-white"></i> Vider votre boite</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
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
      <input type="text" name="ufsitename" value="'.clean($siteName).'" placeholder="Portail" />
      &nbsp;<input type="url" maxlength="80" name="ufsite" value="'.$siteUrl.'" placeholder="http://…" />
    </div>
  </div> 
  
  ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     textarea('Meta Description', 'ufmetadesc', clean($metaDesc), '10', '2', '', '150', '', 'input-xxlarge').
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
	$metaDesc=$ufmetadesc?$ufmetadesc:'Lightweight bulletin board without sql';
	$siteName=$ufsitename?$ufsitename:'Retour';
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
	$tmp='<a href="index.php" title="'.clean($siteName).'"><img src="'.$uforum.'" alt="'.clean($siteName).'" /></a>';
	echo '<title>'.$siteName.'</title>';
} else {
	$tmp=decode($uforum);
	$bbcodes=array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[e]','[/e]','[hr]');
	echo '<title>'.str_replace($bbcodes,'',$uforum).'</title>';
}

echo '</head>';
echo '<body onload="init();" id="top">';
echo '    <!-- Navbar
    ================================================== -->    
    <div class="container-narrow">
            <div class="navbar">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="./" title="Accueil du Forum">'.$tmp.'</a>
                  <div class="nav-collapse collapse navbar-responsive-collapse">';
        //if($ismember || !$forumMode){ echo menu(); } 
                       echo menu();      
        if($ismember || !$forumMode){ echo menu_admin(); }
echo '            </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
            </div><!-- /navbar -->
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
        <p>© 2011-'.date('Y').' '.$tmp.' est propulsé par <a href="http://uforum.byethost5.com" rel="tooltip" title="Forum ultra légé sans SQL">µForum v'.$version.'</a>  
             <span class="pull-right"><a href="' .getURL(). '#top" rel="tooltip" title="Haut de page"><i class="icon-chevron-up"></i></a></span>
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