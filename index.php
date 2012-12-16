<?php
# ------------------ BEGIN LICENSE BLOCK ------------------
#
# This file is part of µForum project: http://uforum.byethost5.com
#
# @update     15-12-2012
# @copyright  2012-2013  Frédéric Kaplon and contributors
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
/*
** Version de µForum
*/
$version = '0.9.2';
/**
*
* Vérification de la version de php
*/
if (version_compare(PHP_VERSION, '5.3', '<')) {
    die('Vous devez disposer d\'un serveur équipé de PHP 5.3 ou plus !');
}
/**
*
* light dark link contrast back border
*/
$cNames=array('[lt]','[dk]','[lk]','[ct]','[bk]','[br]');
$cVals['defaut']=array('e8ebed','b1c5d0','91a5b0','f90','eee','999');
$cVals['black']=array('333','d0b1c5','b091a5','f90','eee','999');
/**
*
* TEXTE D'ACCEUIL ENCODÉ
*/
$wt = 'W2JdW2ldQmllbnZlbnVlIHN1ciDCtWZvcnVtIHYwLjkuMVsvaV1bL2JdDQoNCkNlIGZvcnVtIG1vbm90aHJlYWQgZXN0IGJhc8OpIHN1ciBkZXMgZmljaGllcnMgdW5pcXVlbWVudCAocGFzIGRlIGJhc2UgZGUgZG9ubsOpZSBzcWwpLg0KTGUgY29uY2VwdCBlc3QgdW4gcGV1IGRpZmbDqXJlbnQgZGVzIGF1dHJlcyBmb3J1bXMgcHVpc3F1ZSBsJ2luZm9ybWF0aW9uIGxhIHBsdXMgaW1wb3J0YW50ZSBtaXNlIGVuIGF2YW50IHBvdXIgcmVjb25uYWl0cmUgdW4gdXRpbGlzYXRldXIgZXN0IHNvbiBhdmF0YXIgKHBvdXIgdW5lIGZvaXMgcXUnaWwgc2VydCDDoCBxdWVscXVlIGNob3NlLi4pDQoNClt1XVtiXUlsIGludMOoZ3JlIHBsdXNpZXVycyBmb25jdGlvbm5hbGl0w6lzIDpbL2JdWy91XSBbaV0o4piFID0gTm91dmVhdXTDqSlbL2ldDQoNCltjXeKclCBHZXN0aW9uIGRlcyBtZW1icmVzIHBhciBsb2dpbiAvIG1vdCBkZSBwYXNzZSAocGFyIGNvb2tpZXMpLg0K4pyUIDQgbml2ZWF1eCBkJ3V0aWxpc2F0ZXVycyA6IEFkbWluaXN0cmF0ZXVyLCBNb2TDqXJhdGV1ciwgTWVtYnJlLCBBbm9ueW1lLg0K4pyUIE1vZGUgcHJpdsOpIC8gcHVibGljLCBwb3VyIGF1dG9yaXNlciBsZXMgbm9uLW1lbWJyZXMuDQrinJQgTGlzdGUgZGVzIG1lbWJyZXMuDQrinJQgUHJvZmlsIHV0aWxpc2F0ZXVyICgrIMOpZGl0aW9uKS4NCuKclCBNZXNzYWdlcmllIHByaXbDqWUgZW50cmUgbGVzIG1lbWJyZXMuDQrinJQgVXBsb2FkIGQnYXZhdGFyIGV0IGRlIHBpw6hjZXMgam9pbnRlcyAoYXZlYyBmaWx0cmUgZCdleHRlbnNpb25zKS4NCuKclCBTbWlsZXlzIGV0IEJCQ29kZXMgKGFqb3V0IGF1dG9tYXRpcXVlIGRlcyBiYWxpc2VzIGZlcm1hbnRlcyBtYW5xdWFudGVzKS4NCuKYhSBDb3VwdXJlIGRlcyBjaGFpbmVzIHRyb3AgbG9uZ3VlcyBzYW5zIGNvdXBlciBsZXMgcGhyYXNlcyAhDQrinJQgU2tpbnMuDQrinJQgTGllbnMgYXV0b21hdGlxdWVzLg0K4piFIEh0bWw1IGV0IGNzczMgKEJvb3RzdHJhcCBkZSB0d2l0dGVyKS4NCuKclCBBZmZpY2hhZ2UgZGVzIGNvbm5lY3TDqXMuDQrinJQgY29sb3JhdGlvbiBzeW50YXhpcXVlIGR1IGNvZGUuDQrinJQgR2VzdGlvbiBkZXMgb3B0aW9ucyBkJ2FkbWluaXN0cmF0aW9ucy4NCuKclCBTeXN0w6htZSBzaW1wbGUgZGUgc2F1dmVnYXJkZSBldCByZXN0YXVyYXRpb24uDQrimIUgQ2FwdGNoYSBsb3JzIGRlIGwnaW5zY3JpcHRpb24uDQrimIUgUHJvdGVjdGlvbiBkZXMgbWFpbHMgc3VyIGxhIGxpc3RlIGRlcyBtZW1icmVzIHBvdXIgY29udHJlciBsZSBzcGFtDQrimIUgRGF0ZSBkZSBuYWlzc2FuY2UgZXQgYWZmaWNoYWdlIGRlIGwnw6JnZSBzaSByZW5zZWlnbsOpLg0K4piFIERhdGUgcGlja2VyLlsvY10=';
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
	global $error,$forum,$conn;
	if (!file_exists(U_MEMBER) || !file_exists(U_MEMBER.'members.dat')) {
		$config="<?\$uforum='[b]&micro;[/b]Forum';\$lang='fr';\$metaDesc='Lightweight bulletin board without sql';\$nbrMsgIndex=15;\$extensionsAutorises='gif,bmp,png,jpg,mp3,zip,rar,txt';\$maxAvatarSize=30720;\$forumMode=1;\$quoteMode=1;\$siteUrl='';\$siteName='';\$siteBase='$d';?>";
		if($h=@fopen('config.php','w')) {fputs($h,utf8_encode($config));fclose($h);}

        $error=  (@mkdir('lang/'))?'&#10004; Création du répertoire lang.<br>' : '&#10008; Echec à la création du répertoire lang<br>';
		$error.= (@mkdir(U_DATA))?'&#10004; Création du répertoire data.<br>' : '&#10008; Echec à la création du répertoire data<br>';
		$error.= (@mkdir(U_MEMBER))?'&#10004; Création du répertoire membres.<br>' : '&#10008; Echec à la création du répertoire membres<br>';
		$error.= (@mkdir(U_THREAD))?'&#10004; Création du répertoire messages.<br>' : '&#10008; Echec à la création du répertoire messages<br>';
		$error.= (@mkdir('js/'))?'&#10004; Création du répertoire js.<br>' : '&#10008; Echec à la création du répertoire js<br>';
		$error.= (mkimg())?'&#10004; Installation des images réussie.<br>' : '&#10008; Echec à l\'installation des images<br>';
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
	// Bootstrap 2.2.2
    $js_bootstrap =
'LyohDQoqIEJvb3RzdHJhcC5qcyBieSBAZmF0ICYgQG1kbw0KKiBDb3B5cmlnaHQgMjAxMiBUd2l0dGVyLCBJbmMuDQoqIGh0dHA6Ly93d3cuYXBhY2hlLm9yZy9saWNlbnNlcy9MSUNFTlNFLTIuMC50eHQNCiovDQohZnVuY3Rpb24oJCl7InVzZSBzdHJpY3QiOyQoZnVuY3Rpb24oKXskLnN1cHBvcnQudHJhbnNpdGlvbj1mdW5jdGlvbigpe3ZhciB0cmFuc2l0aW9uRW5kPWZ1bmN0aW9uKCl7dmFyIG5hbWUsZWw9ZG9jdW1lbnQuY3JlYXRlRWxlbWVudCgiYm9vdHN0cmFwIiksdHJhbnNFbmRFdmVudE5hbWVzPXtXZWJraXRUcmFuc2l0aW9uOiJ3ZWJraXRUcmFuc2l0aW9uRW5kIixNb3pUcmFuc2l0aW9uOiJ0cmFuc2l0aW9uZW5kIixPVHJhbnNpdGlvbjoib1RyYW5zaXRpb25FbmQgb3RyYW5zaXRpb25lbmQiLHRyYW5zaXRpb246InRyYW5zaXRpb25lbmQifTtmb3IobmFtZSBpbiB0cmFuc0VuZEV2ZW50TmFtZXMpaWYodm9pZCAwIT09ZWwuc3R5bGVbbmFtZV0pcmV0dXJuIHRyYW5zRW5kRXZlbnROYW1lc1tuYW1lXX0oKTtyZXR1cm4gdHJhbnNpdGlvbkVuZCYme2VuZDp0cmFuc2l0aW9uRW5kfX0oKX0pfSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oJCl7InVzZSBzdHJpY3QiO3ZhciBkaXNtaXNzPSdbZGF0YS1kaXNtaXNzPSJhbGVydCJdJyxBbGVydD1mdW5jdGlvbihlbCl7JChlbCkub24oImNsaWNrIixkaXNtaXNzLHRoaXMuY2xvc2UpfTtBbGVydC5wcm90b3R5cGUuY2xvc2U9ZnVuY3Rpb24oZSl7ZnVuY3Rpb24gcmVtb3ZlRWxlbWVudCgpeyRwYXJlbnQudHJpZ2dlcigiY2xvc2VkIikucmVtb3ZlKCl9dmFyICRwYXJlbnQsJHRoaXM9JCh0aGlzKSxzZWxlY3Rvcj0kdGhpcy5hdHRyKCJkYXRhLXRhcmdldCIpO3NlbGVjdG9yfHwoc2VsZWN0b3I9JHRoaXMuYXR0cigiaHJlZiIpLHNlbGVjdG9yPXNlbGVjdG9yJiZzZWxlY3Rvci5yZXBsYWNlKC8uKig/PSNbXlxzXSokKS8sIiIpKSwkcGFyZW50PSQoc2VsZWN0b3IpLGUmJmUucHJldmVudERlZmF1bHQoKSwkcGFyZW50Lmxlbmd0aHx8KCRwYXJlbnQ9JHRoaXMuaGFzQ2xhc3MoImFsZXJ0Iik/JHRoaXM6JHRoaXMucGFyZW50KCkpLCRwYXJlbnQudHJpZ2dlcihlPSQuRXZlbnQoImNsb3NlIikpLGUuaXNEZWZhdWx0UHJldmVudGVkKCl8fCgkcGFyZW50LnJlbW92ZUNsYXNzKCJpbiIpLCQuc3VwcG9ydC50cmFuc2l0aW9uJiYkcGFyZW50Lmhhc0NsYXNzKCJmYWRlIik/JHBhcmVudC5vbigkLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQscmVtb3ZlRWxlbWVudCk6cmVtb3ZlRWxlbWVudCgpKX07dmFyIG9sZD0kLmZuLmFsZXJ0OyQuZm4uYWxlcnQ9ZnVuY3Rpb24ob3B0aW9uKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyICR0aGlzPSQodGhpcyksZGF0YT0kdGhpcy5kYXRhKCJhbGVydCIpO2RhdGF8fCR0aGlzLmRhdGEoImFsZXJ0IixkYXRhPW5ldyBBbGVydCh0aGlzKSksInN0cmluZyI9PXR5cGVvZiBvcHRpb24mJmRhdGFbb3B0aW9uXS5jYWxsKCR0aGlzKX0pfSwkLmZuLmFsZXJ0LkNvbnN0cnVjdG9yPUFsZXJ0LCQuZm4uYWxlcnQubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiAkLmZuLmFsZXJ0PW9sZCx0aGlzfSwkKGRvY3VtZW50KS5vbigiY2xpY2suYWxlcnQuZGF0YS1hcGkiLGRpc21pc3MsQWxlcnQucHJvdG90eXBlLmNsb3NlKX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0Ijt2YXIgQnV0dG9uPWZ1bmN0aW9uKGVsZW1lbnQsb3B0aW9ucyl7dGhpcy4kZWxlbWVudD0kKGVsZW1lbnQpLHRoaXMub3B0aW9ucz0kLmV4dGVuZCh7fSwkLmZuLmJ1dHRvbi5kZWZhdWx0cyxvcHRpb25zKX07QnV0dG9uLnByb3RvdHlwZS5zZXRTdGF0ZT1mdW5jdGlvbihzdGF0ZSl7dmFyIGQ9ImRpc2FibGVkIiwkZWw9dGhpcy4kZWxlbWVudCxkYXRhPSRlbC5kYXRhKCksdmFsPSRlbC5pcygiaW5wdXQiKT8idmFsIjoiaHRtbCI7c3RhdGUrPSJUZXh0IixkYXRhLnJlc2V0VGV4dHx8JGVsLmRhdGEoInJlc2V0VGV4dCIsJGVsW3ZhbF0oKSksJGVsW3ZhbF0oZGF0YVtzdGF0ZV18fHRoaXMub3B0aW9uc1tzdGF0ZV0pLHNldFRpbWVvdXQoZnVuY3Rpb24oKXsibG9hZGluZ1RleHQiPT1zdGF0ZT8kZWwuYWRkQ2xhc3MoZCkuYXR0cihkLGQpOiRlbC5yZW1vdmVDbGFzcyhkKS5yZW1vdmVBdHRyKGQpfSwwKX0sQnV0dG9uLnByb3RvdHlwZS50b2dnbGU9ZnVuY3Rpb24oKXt2YXIgJHBhcmVudD10aGlzLiRlbGVtZW50LmNsb3Nlc3QoJ1tkYXRhLXRvZ2dsZT0iYnV0dG9ucy1yYWRpbyJdJyk7JHBhcmVudCYmJHBhcmVudC5maW5kKCIuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpLHRoaXMuJGVsZW1lbnQudG9nZ2xlQ2xhc3MoImFjdGl2ZSIpfTt2YXIgb2xkPSQuZm4uYnV0dG9uOyQuZm4uYnV0dG9uPWZ1bmN0aW9uKG9wdGlvbil7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciAkdGhpcz0kKHRoaXMpLGRhdGE9JHRoaXMuZGF0YSgiYnV0dG9uIiksb3B0aW9ucz0ib2JqZWN0Ij09dHlwZW9mIG9wdGlvbiYmb3B0aW9uO2RhdGF8fCR0aGlzLmRhdGEoImJ1dHRvbiIsZGF0YT1uZXcgQnV0dG9uKHRoaXMsb3B0aW9ucykpLCJ0b2dnbGUiPT1vcHRpb24/ZGF0YS50b2dnbGUoKTpvcHRpb24mJmRhdGEuc2V0U3RhdGUob3B0aW9uKX0pfSwkLmZuLmJ1dHRvbi5kZWZhdWx0cz17bG9hZGluZ1RleHQ6ImxvYWRpbmcuLi4ifSwkLmZuLmJ1dHRvbi5Db25zdHJ1Y3Rvcj1CdXR0b24sJC5mbi5idXR0b24ubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiAkLmZuLmJ1dHRvbj1vbGQsdGhpc30sJChkb2N1bWVudCkub24oImNsaWNrLmJ1dHRvbi5kYXRhLWFwaSIsIltkYXRhLXRvZ2dsZV49YnV0dG9uXSIsZnVuY3Rpb24oZSl7dmFyICRidG49JChlLnRhcmdldCk7JGJ0bi5oYXNDbGFzcygiYnRuIil8fCgkYnRuPSRidG4uY2xvc2VzdCgiLmJ0biIpKSwkYnRuLmJ1dHRvbigidG9nZ2xlIil9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0Ijt2YXIgQ2Fyb3VzZWw9ZnVuY3Rpb24oZWxlbWVudCxvcHRpb25zKXt0aGlzLiRlbGVtZW50PSQoZWxlbWVudCksdGhpcy5vcHRpb25zPW9wdGlvbnMsImhvdmVyIj09dGhpcy5vcHRpb25zLnBhdXNlJiZ0aGlzLiRlbGVtZW50Lm9uKCJtb3VzZWVudGVyIiwkLnByb3h5KHRoaXMucGF1c2UsdGhpcykpLm9uKCJtb3VzZWxlYXZlIiwkLnByb3h5KHRoaXMuY3ljbGUsdGhpcykpfTtDYXJvdXNlbC5wcm90b3R5cGU9e2N5Y2xlOmZ1bmN0aW9uKGUpe3JldHVybiBlfHwodGhpcy5wYXVzZWQ9ITEpLHRoaXMub3B0aW9ucy5pbnRlcnZhbCYmIXRoaXMucGF1c2VkJiYodGhpcy5pbnRlcnZhbD1zZXRJbnRlcnZhbCgkLnByb3h5KHRoaXMubmV4dCx0aGlzKSx0aGlzLm9wdGlvbnMuaW50ZXJ2YWwpKSx0aGlzfSx0bzpmdW5jdGlvbihwb3Mpe3ZhciAkYWN0aXZlPXRoaXMuJGVsZW1lbnQuZmluZCgiLml0ZW0uYWN0aXZlIiksY2hpbGRyZW49JGFjdGl2ZS5wYXJlbnQoKS5jaGlsZHJlbigpLGFjdGl2ZVBvcz1jaGlsZHJlbi5pbmRleCgkYWN0aXZlKSx0aGF0PXRoaXM7aWYoIShwb3M+Y2hpbGRyZW4ubGVuZ3RoLTF8fDA+cG9zKSlyZXR1cm4gdGhpcy5zbGlkaW5nP3RoaXMuJGVsZW1lbnQub25lKCJzbGlkIixmdW5jdGlvbigpe3RoYXQudG8ocG9zKX0pOmFjdGl2ZVBvcz09cG9zP3RoaXMucGF1c2UoKS5jeWNsZSgpOnRoaXMuc2xpZGUocG9zPmFjdGl2ZVBvcz8ibmV4dCI6InByZXYiLCQoY2hpbGRyZW5bcG9zXSkpfSxwYXVzZTpmdW5jdGlvbihlKXtyZXR1cm4gZXx8KHRoaXMucGF1c2VkPSEwKSx0aGlzLiRlbGVtZW50LmZpbmQoIi5uZXh0LCAucHJldiIpLmxlbmd0aCYmJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kJiYodGhpcy4kZWxlbWVudC50cmlnZ2VyKCQuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCksdGhpcy5jeWNsZSgpKSxjbGVhckludGVydmFsKHRoaXMuaW50ZXJ2YWwpLHRoaXMuaW50ZXJ2YWw9bnVsbCx0aGlzfSxuZXh0OmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuc2xpZGluZz92b2lkIDA6dGhpcy5zbGlkZSgibmV4dCIpfSxwcmV2OmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuc2xpZGluZz92b2lkIDA6dGhpcy5zbGlkZSgicHJldiIpfSxzbGlkZTpmdW5jdGlvbih0eXBlLG5leHQpe3ZhciBlLCRhY3RpdmU9dGhpcy4kZWxlbWVudC5maW5kKCIuaXRlbS5hY3RpdmUiKSwkbmV4dD1uZXh0fHwkYWN0aXZlW3R5cGVdKCksaXNDeWNsaW5nPXRoaXMuaW50ZXJ2YWwsZGlyZWN0aW9uPSJuZXh0Ij09dHlwZT8ibGVmdCI6InJpZ2h0IixmYWxsYmFjaz0ibmV4dCI9PXR5cGU/ImZpcnN0IjoibGFzdCIsdGhhdD10aGlzO2lmKHRoaXMuc2xpZGluZz0hMCxpc0N5Y2xpbmcmJnRoaXMucGF1c2UoKSwkbmV4dD0kbmV4dC5sZW5ndGg/JG5leHQ6dGhpcy4kZWxlbWVudC5maW5kKCIuaXRlbSIpW2ZhbGxiYWNrXSgpLGU9JC5FdmVudCgic2xpZGUiLHtyZWxhdGVkVGFyZ2V0OiRuZXh0WzBdfSksISRuZXh0Lmhhc0NsYXNzKCJhY3RpdmUiKSl7aWYoJC5zdXBwb3J0LnRyYW5zaXRpb24mJnRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoInNsaWRlIikpe2lmKHRoaXMuJGVsZW1lbnQudHJpZ2dlcihlKSxlLmlzRGVmYXVsdFByZXZlbnRlZCgpKXJldHVybjskbmV4dC5hZGRDbGFzcyh0eXBlKSwkbmV4dFswXS5vZmZzZXRXaWR0aCwkYWN0aXZlLmFkZENsYXNzKGRpcmVjdGlvbiksJG5leHQuYWRkQ2xhc3MoZGlyZWN0aW9uKSx0aGlzLiRlbGVtZW50Lm9uZSgkLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZnVuY3Rpb24oKXskbmV4dC5yZW1vdmVDbGFzcyhbdHlwZSxkaXJlY3Rpb25dLmpvaW4oIiAiKSkuYWRkQ2xhc3MoImFjdGl2ZSIpLCRhY3RpdmUucmVtb3ZlQ2xhc3MoWyJhY3RpdmUiLGRpcmVjdGlvbl0uam9pbigiICIpKSx0aGF0LnNsaWRpbmc9ITEsc2V0VGltZW91dChmdW5jdGlvbigpe3RoYXQuJGVsZW1lbnQudHJpZ2dlcigic2xpZCIpfSwwKX0pfWVsc2V7aWYodGhpcy4kZWxlbWVudC50cmlnZ2VyKGUpLGUuaXNEZWZhdWx0UHJldmVudGVkKCkpcmV0dXJuOyRhY3RpdmUucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpLCRuZXh0LmFkZENsYXNzKCJhY3RpdmUiKSx0aGlzLnNsaWRpbmc9ITEsdGhpcy4kZWxlbWVudC50cmlnZ2VyKCJzbGlkIil9cmV0dXJuIGlzQ3ljbGluZyYmdGhpcy5jeWNsZSgpLHRoaXN9fX07dmFyIG9sZD0kLmZuLmNhcm91c2VsOyQuZm4uY2Fyb3VzZWw9ZnVuY3Rpb24ob3B0aW9uKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyICR0aGlzPSQodGhpcyksZGF0YT0kdGhpcy5kYXRhKCJjYXJvdXNlbCIpLG9wdGlvbnM9JC5leHRlbmQoe30sJC5mbi5jYXJvdXNlbC5kZWZhdWx0cywib2JqZWN0Ij09dHlwZW9mIG9wdGlvbiYmb3B0aW9uKSxhY3Rpb249InN0cmluZyI9PXR5cGVvZiBvcHRpb24/b3B0aW9uOm9wdGlvbnMuc2xpZGU7ZGF0YXx8JHRoaXMuZGF0YSgiY2Fyb3VzZWwiLGRhdGE9bmV3IENhcm91c2VsKHRoaXMsb3B0aW9ucykpLCJudW1iZXIiPT10eXBlb2Ygb3B0aW9uP2RhdGEudG8ob3B0aW9uKTphY3Rpb24/ZGF0YVthY3Rpb25dKCk6b3B0aW9ucy5pbnRlcnZhbCYmZGF0YS5jeWNsZSgpfSl9LCQuZm4uY2Fyb3VzZWwuZGVmYXVsdHM9e2ludGVydmFsOjVlMyxwYXVzZToiaG92ZXIifSwkLmZuLmNhcm91c2VsLkNvbnN0cnVjdG9yPUNhcm91c2VsLCQuZm4uY2Fyb3VzZWwubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiAkLmZuLmNhcm91c2VsPW9sZCx0aGlzfSwkKGRvY3VtZW50KS5vbigiY2xpY2suY2Fyb3VzZWwuZGF0YS1hcGkiLCJbZGF0YS1zbGlkZV0iLGZ1bmN0aW9uKGUpe3ZhciBocmVmLCR0aGlzPSQodGhpcyksJHRhcmdldD0kKCR0aGlzLmF0dHIoImRhdGEtdGFyZ2V0Iil8fChocmVmPSR0aGlzLmF0dHIoImhyZWYiKSkmJmhyZWYucmVwbGFjZSgvLiooPz0jW15cc10rJCkvLCIiKSksb3B0aW9ucz0kLmV4dGVuZCh7fSwkdGFyZ2V0LmRhdGEoKSwkdGhpcy5kYXRhKCkpOyR0YXJnZXQuY2Fyb3VzZWwob3B0aW9ucyksZS5wcmV2ZW50RGVmYXVsdCgpfSl9KHdpbmRvdy5qUXVlcnkpLCFmdW5jdGlvbigkKXsidXNlIHN0cmljdCI7dmFyIENvbGxhcHNlPWZ1bmN0aW9uKGVsZW1lbnQsb3B0aW9ucyl7dGhpcy4kZWxlbWVudD0kKGVsZW1lbnQpLHRoaXMub3B0aW9ucz0kLmV4dGVuZCh7fSwkLmZuLmNvbGxhcHNlLmRlZmF1bHRzLG9wdGlvbnMpLHRoaXMub3B0aW9ucy5wYXJlbnQmJih0aGlzLiRwYXJlbnQ9JCh0aGlzLm9wdGlvbnMucGFyZW50KSksdGhpcy5vcHRpb25zLnRvZ2dsZSYmdGhpcy50b2dnbGUoKX07Q29sbGFwc2UucHJvdG90eXBlPXtjb25zdHJ1Y3RvcjpDb2xsYXBzZSxkaW1lbnNpb246ZnVuY3Rpb24oKXt2YXIgaGFzV2lkdGg9dGhpcy4kZWxlbWVudC5oYXNDbGFzcygid2lkdGgiKTtyZXR1cm4gaGFzV2lkdGg/IndpZHRoIjoiaGVpZ2h0In0sc2hvdzpmdW5jdGlvbigpe3ZhciBkaW1lbnNpb24sc2Nyb2xsLGFjdGl2ZXMsaGFzRGF0YTtpZighdGhpcy50cmFuc2l0aW9uaW5nKXtpZihkaW1lbnNpb249dGhpcy5kaW1lbnNpb24oKSxzY3JvbGw9JC5jYW1lbENhc2UoWyJzY3JvbGwiLGRpbWVuc2lvbl0uam9pbigiLSIpKSxhY3RpdmVzPXRoaXMuJHBhcmVudCYmdGhpcy4kcGFyZW50LmZpbmQoIj4gLmFjY29yZGlvbi1ncm91cCA+IC5pbiIpLGFjdGl2ZXMmJmFjdGl2ZXMubGVuZ3RoKXtpZihoYXNEYXRhPWFjdGl2ZXMuZGF0YSgiY29sbGFwc2UiKSxoYXNEYXRhJiZoYXNEYXRhLnRyYW5zaXRpb25pbmcpcmV0dXJuO2FjdGl2ZXMuY29sbGFwc2UoImhpZGUiKSxoYXNEYXRhfHxhY3RpdmVzLmRhdGEoImNvbGxhcHNlIixudWxsKX10aGlzLiRlbGVtZW50W2RpbWVuc2lvbl0oMCksdGhpcy50cmFuc2l0aW9uKCJhZGRDbGFzcyIsJC5FdmVudCgic2hvdyIpLCJzaG93biIpLCQuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50W2RpbWVuc2lvbl0odGhpcy4kZWxlbWVudFswXVtzY3JvbGxdKX19LGhpZGU6ZnVuY3Rpb24oKXt2YXIgZGltZW5zaW9uO3RoaXMudHJhbnNpdGlvbmluZ3x8KGRpbWVuc2lvbj10aGlzLmRpbWVuc2lvbigpLHRoaXMucmVzZXQodGhpcy4kZWxlbWVudFtkaW1lbnNpb25dKCkpLHRoaXMudHJhbnNpdGlvbigicmVtb3ZlQ2xhc3MiLCQuRXZlbnQoImhpZGUiKSwiaGlkZGVuIiksdGhpcy4kZWxlbWVudFtkaW1lbnNpb25dKDApKX0scmVzZXQ6ZnVuY3Rpb24oc2l6ZSl7dmFyIGRpbWVuc2lvbj10aGlzLmRpbWVuc2lvbigpO3JldHVybiB0aGlzLiRlbGVtZW50LnJlbW92ZUNsYXNzKCJjb2xsYXBzZSIpW2RpbWVuc2lvbl0oc2l6ZXx8ImF1dG8iKVswXS5vZmZzZXRXaWR0aCx0aGlzLiRlbGVtZW50W251bGwhPT1zaXplPyJhZGRDbGFzcyI6InJlbW92ZUNsYXNzIl0oImNvbGxhcHNlIiksdGhpc30sdHJhbnNpdGlvbjpmdW5jdGlvbihtZXRob2Qsc3RhcnRFdmVudCxjb21wbGV0ZUV2ZW50KXt2YXIgdGhhdD10aGlzLGNvbXBsZXRlPWZ1bmN0aW9uKCl7InNob3ciPT1zdGFydEV2ZW50LnR5cGUmJnRoYXQucmVzZXQoKSx0aGF0LnRyYW5zaXRpb25pbmc9MCx0aGF0LiRlbGVtZW50LnRyaWdnZXIoY29tcGxldGVFdmVudCl9O3RoaXMuJGVsZW1lbnQudHJpZ2dlcihzdGFydEV2ZW50KSxzdGFydEV2ZW50LmlzRGVmYXVsdFByZXZlbnRlZCgpfHwodGhpcy50cmFuc2l0aW9uaW5nPTEsdGhpcy4kZWxlbWVudFttZXRob2RdKCJpbiIpLCQuc3VwcG9ydC50cmFuc2l0aW9uJiZ0aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJjb2xsYXBzZSIpP3RoaXMuJGVsZW1lbnQub25lKCQuc3VwcG9ydC50cmFuc2l0aW9uLmVuZCxjb21wbGV0ZSk6Y29tcGxldGUoKSl9LHRvZ2dsZTpmdW5jdGlvbigpe3RoaXNbdGhpcy4kZWxlbWVudC5oYXNDbGFzcygiaW4iKT8iaGlkZSI6InNob3ciXSgpfX07dmFyIG9sZD0kLmZuLmNvbGxhcHNlOyQuZm4uY29sbGFwc2U9ZnVuY3Rpb24ob3B0aW9uKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyICR0aGlzPSQodGhpcyksZGF0YT0kdGhpcy5kYXRhKCJjb2xsYXBzZSIpLG9wdGlvbnM9Im9iamVjdCI9PXR5cGVvZiBvcHRpb24mJm9wdGlvbjtkYXRhfHwkdGhpcy5kYXRhKCJjb2xsYXBzZSIsZGF0YT1uZXcgQ29sbGFwc2UodGhpcyxvcHRpb25zKSksInN0cmluZyI9PXR5cGVvZiBvcHRpb24mJmRhdGFbb3B0aW9uXSgpfSl9LCQuZm4uY29sbGFwc2UuZGVmYXVsdHM9e3RvZ2dsZTohMH0sJC5mbi5jb2xsYXBzZS5Db25zdHJ1Y3Rvcj1Db2xsYXBzZSwkLmZuLmNvbGxhcHNlLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gJC5mbi5jb2xsYXBzZT1vbGQsdGhpc30sJChkb2N1bWVudCkub24oImNsaWNrLmNvbGxhcHNlLmRhdGEtYXBpIiwiW2RhdGEtdG9nZ2xlPWNvbGxhcHNlXSIsZnVuY3Rpb24oZSl7dmFyIGhyZWYsJHRoaXM9JCh0aGlzKSx0YXJnZXQ9JHRoaXMuYXR0cigiZGF0YS10YXJnZXQiKXx8ZS5wcmV2ZW50RGVmYXVsdCgpfHwoaHJlZj0kdGhpcy5hdHRyKCJocmVmIikpJiZocmVmLnJlcGxhY2UoLy4qKD89I1teXHNdKyQpLywiIiksb3B0aW9uPSQodGFyZ2V0KS5kYXRhKCJjb2xsYXBzZSIpPyJ0b2dnbGUiOiR0aGlzLmRhdGEoKTskdGhpc1skKHRhcmdldCkuaGFzQ2xhc3MoImluIik/ImFkZENsYXNzIjoicmVtb3ZlQ2xhc3MiXSgiY29sbGFwc2VkIiksJCh0YXJnZXQpLmNvbGxhcHNlKG9wdGlvbil9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0IjtmdW5jdGlvbiBjbGVhck1lbnVzKCl7JCh0b2dnbGUpLmVhY2goZnVuY3Rpb24oKXtnZXRQYXJlbnQoJCh0aGlzKSkucmVtb3ZlQ2xhc3MoIm9wZW4iKX0pfWZ1bmN0aW9uIGdldFBhcmVudCgkdGhpcyl7dmFyICRwYXJlbnQsc2VsZWN0b3I9JHRoaXMuYXR0cigiZGF0YS10YXJnZXQiKTtyZXR1cm4gc2VsZWN0b3J8fChzZWxlY3Rvcj0kdGhpcy5hdHRyKCJocmVmIiksc2VsZWN0b3I9c2VsZWN0b3ImJi8jLy50ZXN0KHNlbGVjdG9yKSYmc2VsZWN0b3IucmVwbGFjZSgvLiooPz0jW15cc10qJCkvLCIiKSksJHBhcmVudD0kKHNlbGVjdG9yKSwkcGFyZW50Lmxlbmd0aHx8KCRwYXJlbnQ9JHRoaXMucGFyZW50KCkpLCRwYXJlbnR9dmFyIHRvZ2dsZT0iW2RhdGEtdG9nZ2xlPWRyb3Bkb3duXSIsRHJvcGRvd249ZnVuY3Rpb24oZWxlbWVudCl7dmFyICRlbD0kKGVsZW1lbnQpLm9uKCJjbGljay5kcm9wZG93bi5kYXRhLWFwaSIsdGhpcy50b2dnbGUpOyQoImh0bWwiKS5vbigiY2xpY2suZHJvcGRvd24uZGF0YS1hcGkiLGZ1bmN0aW9uKCl7JGVsLnBhcmVudCgpLnJlbW92ZUNsYXNzKCJvcGVuIil9KX07RHJvcGRvd24ucHJvdG90eXBlPXtjb25zdHJ1Y3RvcjpEcm9wZG93bix0b2dnbGU6ZnVuY3Rpb24oKXt2YXIgJHBhcmVudCxpc0FjdGl2ZSwkdGhpcz0kKHRoaXMpO2lmKCEkdGhpcy5pcygiLmRpc2FibGVkLCA6ZGlzYWJsZWQiKSlyZXR1cm4gJHBhcmVudD1nZXRQYXJlbnQoJHRoaXMpLGlzQWN0aXZlPSRwYXJlbnQuaGFzQ2xhc3MoIm9wZW4iKSxjbGVhck1lbnVzKCksaXNBY3RpdmV8fCRwYXJlbnQudG9nZ2xlQ2xhc3MoIm9wZW4iKSwkdGhpcy5mb2N1cygpLCExfSxrZXlkb3duOmZ1bmN0aW9uKGUpe3ZhciAkdGhpcywkaXRlbXMsJHBhcmVudCxpc0FjdGl2ZSxpbmRleDtpZigvKDM4fDQwfDI3KS8udGVzdChlLmtleUNvZGUpJiYoJHRoaXM9JCh0aGlzKSxlLnByZXZlbnREZWZhdWx0KCksZS5zdG9wUHJvcGFnYXRpb24oKSwhJHRoaXMuaXMoIi5kaXNhYmxlZCwgOmRpc2FibGVkIikpKXtpZigkcGFyZW50PWdldFBhcmVudCgkdGhpcyksaXNBY3RpdmU9JHBhcmVudC5oYXNDbGFzcygib3BlbiIpLCFpc0FjdGl2ZXx8aXNBY3RpdmUmJjI3PT1lLmtleUNvZGUpcmV0dXJuICR0aGlzLmNsaWNrKCk7JGl0ZW1zPSQoIltyb2xlPW1lbnVdIGxpOm5vdCguZGl2aWRlcik6dmlzaWJsZSBhIiwkcGFyZW50KSwkaXRlbXMubGVuZ3RoJiYoaW5kZXg9JGl0ZW1zLmluZGV4KCRpdGVtcy5maWx0ZXIoIjpmb2N1cyIpKSwzOD09ZS5rZXlDb2RlJiZpbmRleD4wJiZpbmRleC0tLDQwPT1lLmtleUNvZGUmJiRpdGVtcy5sZW5ndGgtMT5pbmRleCYmaW5kZXgrKyx+aW5kZXh8fChpbmRleD0wKSwkaXRlbXMuZXEoaW5kZXgpLmZvY3VzKCkpfX19O3ZhciBvbGQ9JC5mbi5kcm9wZG93bjskLmZuLmRyb3Bkb3duPWZ1bmN0aW9uKG9wdGlvbil7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciAkdGhpcz0kKHRoaXMpLGRhdGE9JHRoaXMuZGF0YSgiZHJvcGRvd24iKTtkYXRhfHwkdGhpcy5kYXRhKCJkcm9wZG93biIsZGF0YT1uZXcgRHJvcGRvd24odGhpcykpLCJzdHJpbmciPT10eXBlb2Ygb3B0aW9uJiZkYXRhW29wdGlvbl0uY2FsbCgkdGhpcyl9KX0sJC5mbi5kcm9wZG93bi5Db25zdHJ1Y3Rvcj1Ecm9wZG93biwkLmZuLmRyb3Bkb3duLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gJC5mbi5kcm9wZG93bj1vbGQsdGhpc30sJChkb2N1bWVudCkub24oImNsaWNrLmRyb3Bkb3duLmRhdGEtYXBpIHRvdWNoc3RhcnQuZHJvcGRvd24uZGF0YS1hcGkiLGNsZWFyTWVudXMpLm9uKCJjbGljay5kcm9wZG93biB0b3VjaHN0YXJ0LmRyb3Bkb3duLmRhdGEtYXBpIiwiLmRyb3Bkb3duIGZvcm0iLGZ1bmN0aW9uKGUpe2Uuc3RvcFByb3BhZ2F0aW9uKCl9KS5vbigidG91Y2hzdGFydC5kcm9wZG93bi5kYXRhLWFwaSIsIi5kcm9wZG93bi1tZW51IixmdW5jdGlvbihlKXtlLnN0b3BQcm9wYWdhdGlvbigpfSkub24oImNsaWNrLmRyb3Bkb3duLmRhdGEtYXBpIHRvdWNoc3RhcnQuZHJvcGRvd24uZGF0YS1hcGkiLHRvZ2dsZSxEcm9wZG93bi5wcm90b3R5cGUudG9nZ2xlKS5vbigia2V5ZG93bi5kcm9wZG93bi5kYXRhLWFwaSB0b3VjaHN0YXJ0LmRyb3Bkb3duLmRhdGEtYXBpIix0b2dnbGUrIiwgW3JvbGU9bWVudV0iLERyb3Bkb3duLnByb3RvdHlwZS5rZXlkb3duKX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0Ijt2YXIgTW9kYWw9ZnVuY3Rpb24oZWxlbWVudCxvcHRpb25zKXt0aGlzLm9wdGlvbnM9b3B0aW9ucyx0aGlzLiRlbGVtZW50PSQoZWxlbWVudCkuZGVsZWdhdGUoJ1tkYXRhLWRpc21pc3M9Im1vZGFsIl0nLCJjbGljay5kaXNtaXNzLm1vZGFsIiwkLnByb3h5KHRoaXMuaGlkZSx0aGlzKSksdGhpcy5vcHRpb25zLnJlbW90ZSYmdGhpcy4kZWxlbWVudC5maW5kKCIubW9kYWwtYm9keSIpLmxvYWQodGhpcy5vcHRpb25zLnJlbW90ZSl9O01vZGFsLnByb3RvdHlwZT17Y29uc3RydWN0b3I6TW9kYWwsdG9nZ2xlOmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXNbdGhpcy5pc1Nob3duPyJoaWRlIjoic2hvdyJdKCl9LHNob3c6ZnVuY3Rpb24oKXt2YXIgdGhhdD10aGlzLGU9JC5FdmVudCgic2hvdyIpO3RoaXMuJGVsZW1lbnQudHJpZ2dlcihlKSx0aGlzLmlzU2hvd258fGUuaXNEZWZhdWx0UHJldmVudGVkKCl8fCh0aGlzLmlzU2hvd249ITAsdGhpcy5lc2NhcGUoKSx0aGlzLmJhY2tkcm9wKGZ1bmN0aW9uKCl7dmFyIHRyYW5zaXRpb249JC5zdXBwb3J0LnRyYW5zaXRpb24mJnRoYXQuJGVsZW1lbnQuaGFzQ2xhc3MoImZhZGUiKTt0aGF0LiRlbGVtZW50LnBhcmVudCgpLmxlbmd0aHx8dGhhdC4kZWxlbWVudC5hcHBlbmRUbyhkb2N1bWVudC5ib2R5KSx0aGF0LiRlbGVtZW50LnNob3coKSx0cmFuc2l0aW9uJiZ0aGF0LiRlbGVtZW50WzBdLm9mZnNldFdpZHRoLHRoYXQuJGVsZW1lbnQuYWRkQ2xhc3MoImluIikuYXR0cigiYXJpYS1oaWRkZW4iLCExKSx0aGF0LmVuZm9yY2VGb2N1cygpLHRyYW5zaXRpb24/dGhhdC4kZWxlbWVudC5vbmUoJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGZ1bmN0aW9uKCl7dGhhdC4kZWxlbWVudC5mb2N1cygpLnRyaWdnZXIoInNob3duIil9KTp0aGF0LiRlbGVtZW50LmZvY3VzKCkudHJpZ2dlcigic2hvd24iKX0pKX0saGlkZTpmdW5jdGlvbihlKXtlJiZlLnByZXZlbnREZWZhdWx0KCksZT0kLkV2ZW50KCJoaWRlIiksdGhpcy4kZWxlbWVudC50cmlnZ2VyKGUpLHRoaXMuaXNTaG93biYmIWUuaXNEZWZhdWx0UHJldmVudGVkKCkmJih0aGlzLmlzU2hvd249ITEsdGhpcy5lc2NhcGUoKSwkKGRvY3VtZW50KS5vZmYoImZvY3VzaW4ubW9kYWwiKSx0aGlzLiRlbGVtZW50LnJlbW92ZUNsYXNzKCJpbiIpLmF0dHIoImFyaWEtaGlkZGVuIiwhMCksJC5zdXBwb3J0LnRyYW5zaXRpb24mJnRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoImZhZGUiKT90aGlzLmhpZGVXaXRoVHJhbnNpdGlvbigpOnRoaXMuaGlkZU1vZGFsKCkpfSxlbmZvcmNlRm9jdXM6ZnVuY3Rpb24oKXt2YXIgdGhhdD10aGlzOyQoZG9jdW1lbnQpLm9uKCJmb2N1c2luLm1vZGFsIixmdW5jdGlvbihlKXt0aGF0LiRlbGVtZW50WzBdPT09ZS50YXJnZXR8fHRoYXQuJGVsZW1lbnQuaGFzKGUudGFyZ2V0KS5sZW5ndGh8fHRoYXQuJGVsZW1lbnQuZm9jdXMoKX0pfSxlc2NhcGU6ZnVuY3Rpb24oKXt2YXIgdGhhdD10aGlzO3RoaXMuaXNTaG93biYmdGhpcy5vcHRpb25zLmtleWJvYXJkP3RoaXMuJGVsZW1lbnQub24oImtleXVwLmRpc21pc3MubW9kYWwiLGZ1bmN0aW9uKGUpezI3PT1lLndoaWNoJiZ0aGF0LmhpZGUoKX0pOnRoaXMuaXNTaG93bnx8dGhpcy4kZWxlbWVudC5vZmYoImtleXVwLmRpc21pc3MubW9kYWwiKX0saGlkZVdpdGhUcmFuc2l0aW9uOmZ1bmN0aW9uKCl7dmFyIHRoYXQ9dGhpcyx0aW1lb3V0PXNldFRpbWVvdXQoZnVuY3Rpb24oKXt0aGF0LiRlbGVtZW50Lm9mZigkLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQpLHRoYXQuaGlkZU1vZGFsKCl9LDUwMCk7dGhpcy4kZWxlbWVudC5vbmUoJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGZ1bmN0aW9uKCl7Y2xlYXJUaW1lb3V0KHRpbWVvdXQpLHRoYXQuaGlkZU1vZGFsKCl9KX0saGlkZU1vZGFsOmZ1bmN0aW9uKCl7dGhpcy4kZWxlbWVudC5oaWRlKCkudHJpZ2dlcigiaGlkZGVuIiksdGhpcy5iYWNrZHJvcCgpfSxyZW1vdmVCYWNrZHJvcDpmdW5jdGlvbigpe3RoaXMuJGJhY2tkcm9wLnJlbW92ZSgpLHRoaXMuJGJhY2tkcm9wPW51bGx9LGJhY2tkcm9wOmZ1bmN0aW9uKGNhbGxiYWNrKXt2YXIgYW5pbWF0ZT10aGlzLiRlbGVtZW50Lmhhc0NsYXNzKCJmYWRlIik/ImZhZGUiOiIiO2lmKHRoaXMuaXNTaG93biYmdGhpcy5vcHRpb25zLmJhY2tkcm9wKXt2YXIgZG9BbmltYXRlPSQuc3VwcG9ydC50cmFuc2l0aW9uJiZhbmltYXRlO3RoaXMuJGJhY2tkcm9wPSQoJzxkaXYgY2xhc3M9Im1vZGFsLWJhY2tkcm9wICcrYW5pbWF0ZSsnIiAvPicpLmFwcGVuZFRvKGRvY3VtZW50LmJvZHkpLHRoaXMuJGJhY2tkcm9wLmNsaWNrKCJzdGF0aWMiPT10aGlzLm9wdGlvbnMuYmFja2Ryb3A/JC5wcm94eSh0aGlzLiRlbGVtZW50WzBdLmZvY3VzLHRoaXMuJGVsZW1lbnRbMF0pOiQucHJveHkodGhpcy5oaWRlLHRoaXMpKSxkb0FuaW1hdGUmJnRoaXMuJGJhY2tkcm9wWzBdLm9mZnNldFdpZHRoLHRoaXMuJGJhY2tkcm9wLmFkZENsYXNzKCJpbiIpLGRvQW5pbWF0ZT90aGlzLiRiYWNrZHJvcC5vbmUoJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLGNhbGxiYWNrKTpjYWxsYmFjaygpfWVsc2UhdGhpcy5pc1Nob3duJiZ0aGlzLiRiYWNrZHJvcD8odGhpcy4kYmFja2Ryb3AucmVtb3ZlQ2xhc3MoImluIiksJC5zdXBwb3J0LnRyYW5zaXRpb24mJnRoaXMuJGVsZW1lbnQuaGFzQ2xhc3MoImZhZGUiKT90aGlzLiRiYWNrZHJvcC5vbmUoJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLCQucHJveHkodGhpcy5yZW1vdmVCYWNrZHJvcCx0aGlzKSk6dGhpcy5yZW1vdmVCYWNrZHJvcCgpKTpjYWxsYmFjayYmY2FsbGJhY2soKX19O3ZhciBvbGQ9JC5mbi5tb2RhbDskLmZuLm1vZGFsPWZ1bmN0aW9uKG9wdGlvbil7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciAkdGhpcz0kKHRoaXMpLGRhdGE9JHRoaXMuZGF0YSgibW9kYWwiKSxvcHRpb25zPSQuZXh0ZW5kKHt9LCQuZm4ubW9kYWwuZGVmYXVsdHMsJHRoaXMuZGF0YSgpLCJvYmplY3QiPT10eXBlb2Ygb3B0aW9uJiZvcHRpb24pO2RhdGF8fCR0aGlzLmRhdGEoIm1vZGFsIixkYXRhPW5ldyBNb2RhbCh0aGlzLG9wdGlvbnMpKSwic3RyaW5nIj09dHlwZW9mIG9wdGlvbj9kYXRhW29wdGlvbl0oKTpvcHRpb25zLnNob3cmJmRhdGEuc2hvdygpfSl9LCQuZm4ubW9kYWwuZGVmYXVsdHM9e2JhY2tkcm9wOiEwLGtleWJvYXJkOiEwLHNob3c6ITB9LCQuZm4ubW9kYWwuQ29uc3RydWN0b3I9TW9kYWwsJC5mbi5tb2RhbC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7cmV0dXJuICQuZm4ubW9kYWw9b2xkLHRoaXN9LCQoZG9jdW1lbnQpLm9uKCJjbGljay5tb2RhbC5kYXRhLWFwaSIsJ1tkYXRhLXRvZ2dsZT0ibW9kYWwiXScsZnVuY3Rpb24oZSl7dmFyICR0aGlzPSQodGhpcyksaHJlZj0kdGhpcy5hdHRyKCJocmVmIiksJHRhcmdldD0kKCR0aGlzLmF0dHIoImRhdGEtdGFyZ2V0Iil8fGhyZWYmJmhyZWYucmVwbGFjZSgvLiooPz0jW15cc10rJCkvLCIiKSksb3B0aW9uPSR0YXJnZXQuZGF0YSgibW9kYWwiKT8idG9nZ2xlIjokLmV4dGVuZCh7cmVtb3RlOiEvIy8udGVzdChocmVmKSYmaHJlZn0sJHRhcmdldC5kYXRhKCksJHRoaXMuZGF0YSgpKTtlLnByZXZlbnREZWZhdWx0KCksJHRhcmdldC5tb2RhbChvcHRpb24pLm9uZSgiaGlkZSIsZnVuY3Rpb24oKXskdGhpcy5mb2N1cygpfSl9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0Ijt2YXIgVG9vbHRpcD1mdW5jdGlvbihlbGVtZW50LG9wdGlvbnMpe3RoaXMuaW5pdCgidG9vbHRpcCIsZWxlbWVudCxvcHRpb25zKX07VG9vbHRpcC5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOlRvb2x0aXAsaW5pdDpmdW5jdGlvbih0eXBlLGVsZW1lbnQsb3B0aW9ucyl7dmFyIGV2ZW50SW4sZXZlbnRPdXQ7dGhpcy50eXBlPXR5cGUsdGhpcy4kZWxlbWVudD0kKGVsZW1lbnQpLHRoaXMub3B0aW9ucz10aGlzLmdldE9wdGlvbnMob3B0aW9ucyksdGhpcy5lbmFibGVkPSEwLCJjbGljayI9PXRoaXMub3B0aW9ucy50cmlnZ2VyP3RoaXMuJGVsZW1lbnQub24oImNsaWNrLiIrdGhpcy50eXBlLHRoaXMub3B0aW9ucy5zZWxlY3RvciwkLnByb3h5KHRoaXMudG9nZ2xlLHRoaXMpKToibWFudWFsIiE9dGhpcy5vcHRpb25zLnRyaWdnZXImJihldmVudEluPSJob3ZlciI9PXRoaXMub3B0aW9ucy50cmlnZ2VyPyJtb3VzZWVudGVyIjoiZm9jdXMiLGV2ZW50T3V0PSJob3ZlciI9PXRoaXMub3B0aW9ucy50cmlnZ2VyPyJtb3VzZWxlYXZlIjoiYmx1ciIsdGhpcy4kZWxlbWVudC5vbihldmVudEluKyIuIit0aGlzLnR5cGUsdGhpcy5vcHRpb25zLnNlbGVjdG9yLCQucHJveHkodGhpcy5lbnRlcix0aGlzKSksdGhpcy4kZWxlbWVudC5vbihldmVudE91dCsiLiIrdGhpcy50eXBlLHRoaXMub3B0aW9ucy5zZWxlY3RvciwkLnByb3h5KHRoaXMubGVhdmUsdGhpcykpKSx0aGlzLm9wdGlvbnMuc2VsZWN0b3I/dGhpcy5fb3B0aW9ucz0kLmV4dGVuZCh7fSx0aGlzLm9wdGlvbnMse3RyaWdnZXI6Im1hbnVhbCIsc2VsZWN0b3I6IiJ9KTp0aGlzLmZpeFRpdGxlKCl9LGdldE9wdGlvbnM6ZnVuY3Rpb24ob3B0aW9ucyl7cmV0dXJuIG9wdGlvbnM9JC5leHRlbmQoe30sJC5mblt0aGlzLnR5cGVdLmRlZmF1bHRzLG9wdGlvbnMsdGhpcy4kZWxlbWVudC5kYXRhKCkpLG9wdGlvbnMuZGVsYXkmJiJudW1iZXIiPT10eXBlb2Ygb3B0aW9ucy5kZWxheSYmKG9wdGlvbnMuZGVsYXk9e3Nob3c6b3B0aW9ucy5kZWxheSxoaWRlOm9wdGlvbnMuZGVsYXl9KSxvcHRpb25zfSxlbnRlcjpmdW5jdGlvbihlKXt2YXIgc2VsZj0kKGUuY3VycmVudFRhcmdldClbdGhpcy50eXBlXSh0aGlzLl9vcHRpb25zKS5kYXRhKHRoaXMudHlwZSk7cmV0dXJuIHNlbGYub3B0aW9ucy5kZWxheSYmc2VsZi5vcHRpb25zLmRlbGF5LnNob3c/KGNsZWFyVGltZW91dCh0aGlzLnRpbWVvdXQpLHNlbGYuaG92ZXJTdGF0ZT0iaW4iLHRoaXMudGltZW91dD1zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7ImluIj09c2VsZi5ob3ZlclN0YXRlJiZzZWxmLnNob3coKX0sc2VsZi5vcHRpb25zLmRlbGF5LnNob3cpLHZvaWQgMCk6c2VsZi5zaG93KCl9LGxlYXZlOmZ1bmN0aW9uKGUpe3ZhciBzZWxmPSQoZS5jdXJyZW50VGFyZ2V0KVt0aGlzLnR5cGVdKHRoaXMuX29wdGlvbnMpLmRhdGEodGhpcy50eXBlKTtyZXR1cm4gdGhpcy50aW1lb3V0JiZjbGVhclRpbWVvdXQodGhpcy50aW1lb3V0KSxzZWxmLm9wdGlvbnMuZGVsYXkmJnNlbGYub3B0aW9ucy5kZWxheS5oaWRlPyhzZWxmLmhvdmVyU3RhdGU9Im91dCIsdGhpcy50aW1lb3V0PXNldFRpbWVvdXQoZnVuY3Rpb24oKXsib3V0Ij09c2VsZi5ob3ZlclN0YXRlJiZzZWxmLmhpZGUoKX0sc2VsZi5vcHRpb25zLmRlbGF5LmhpZGUpLHZvaWQgMCk6c2VsZi5oaWRlKCl9LHNob3c6ZnVuY3Rpb24oKXt2YXIgJHRpcCxpbnNpZGUscG9zLGFjdHVhbFdpZHRoLGFjdHVhbEhlaWdodCxwbGFjZW1lbnQsdHA7aWYodGhpcy5oYXNDb250ZW50KCkmJnRoaXMuZW5hYmxlZCl7c3dpdGNoKCR0aXA9dGhpcy50aXAoKSx0aGlzLnNldENvbnRlbnQoKSx0aGlzLm9wdGlvbnMuYW5pbWF0aW9uJiYkdGlwLmFkZENsYXNzKCJmYWRlIikscGxhY2VtZW50PSJmdW5jdGlvbiI9PXR5cGVvZiB0aGlzLm9wdGlvbnMucGxhY2VtZW50P3RoaXMub3B0aW9ucy5wbGFjZW1lbnQuY2FsbCh0aGlzLCR0aXBbMF0sdGhpcy4kZWxlbWVudFswXSk6dGhpcy5vcHRpb25zLnBsYWNlbWVudCxpbnNpZGU9L2luLy50ZXN0KHBsYWNlbWVudCksJHRpcC5kZXRhY2goKS5jc3Moe3RvcDowLGxlZnQ6MCxkaXNwbGF5OiJibG9jayJ9KS5pbnNlcnRBZnRlcih0aGlzLiRlbGVtZW50KSxwb3M9dGhpcy5nZXRQb3NpdGlvbihpbnNpZGUpLGFjdHVhbFdpZHRoPSR0aXBbMF0ub2Zmc2V0V2lkdGgsYWN0dWFsSGVpZ2h0PSR0aXBbMF0ub2Zmc2V0SGVpZ2h0LGluc2lkZT9wbGFjZW1lbnQuc3BsaXQoIiAiKVsxXTpwbGFjZW1lbnQpe2Nhc2UiYm90dG9tIjp0cD17dG9wOnBvcy50b3ArcG9zLmhlaWdodCxsZWZ0OnBvcy5sZWZ0K3Bvcy53aWR0aC8yLWFjdHVhbFdpZHRoLzJ9O2JyZWFrO2Nhc2UidG9wIjp0cD17dG9wOnBvcy50b3AtYWN0dWFsSGVpZ2h0LGxlZnQ6cG9zLmxlZnQrcG9zLndpZHRoLzItYWN0dWFsV2lkdGgvMn07YnJlYWs7Y2FzZSJsZWZ0Ijp0cD17dG9wOnBvcy50b3ArcG9zLmhlaWdodC8yLWFjdHVhbEhlaWdodC8yLGxlZnQ6cG9zLmxlZnQtYWN0dWFsV2lkdGh9O2JyZWFrO2Nhc2UicmlnaHQiOnRwPXt0b3A6cG9zLnRvcCtwb3MuaGVpZ2h0LzItYWN0dWFsSGVpZ2h0LzIsbGVmdDpwb3MubGVmdCtwb3Mud2lkdGh9fSR0aXAub2Zmc2V0KHRwKS5hZGRDbGFzcyhwbGFjZW1lbnQpLmFkZENsYXNzKCJpbiIpfX0sc2V0Q29udGVudDpmdW5jdGlvbigpe3ZhciAkdGlwPXRoaXMudGlwKCksdGl0bGU9dGhpcy5nZXRUaXRsZSgpOyR0aXAuZmluZCgiLnRvb2x0aXAtaW5uZXIiKVt0aGlzLm9wdGlvbnMuaHRtbD8iaHRtbCI6InRleHQiXSh0aXRsZSksJHRpcC5yZW1vdmVDbGFzcygiZmFkZSBpbiB0b3AgYm90dG9tIGxlZnQgcmlnaHQiKX0saGlkZTpmdW5jdGlvbigpe2Z1bmN0aW9uIHJlbW92ZVdpdGhBbmltYXRpb24oKXt2YXIgdGltZW91dD1zZXRUaW1lb3V0KGZ1bmN0aW9uKCl7JHRpcC5vZmYoJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kKS5kZXRhY2goKX0sNTAwKTskdGlwLm9uZSgkLnN1cHBvcnQudHJhbnNpdGlvbi5lbmQsZnVuY3Rpb24oKXtjbGVhclRpbWVvdXQodGltZW91dCksJHRpcC5kZXRhY2goKX0pfXZhciAkdGlwPXRoaXMudGlwKCk7cmV0dXJuICR0aXAucmVtb3ZlQ2xhc3MoImluIiksJC5zdXBwb3J0LnRyYW5zaXRpb24mJnRoaXMuJHRpcC5oYXNDbGFzcygiZmFkZSIpP3JlbW92ZVdpdGhBbmltYXRpb24oKTokdGlwLmRldGFjaCgpLHRoaXN9LGZpeFRpdGxlOmZ1bmN0aW9uKCl7dmFyICRlPXRoaXMuJGVsZW1lbnQ7KCRlLmF0dHIoInRpdGxlIil8fCJzdHJpbmciIT10eXBlb2YgJGUuYXR0cigiZGF0YS1vcmlnaW5hbC10aXRsZSIpKSYmJGUuYXR0cigiZGF0YS1vcmlnaW5hbC10aXRsZSIsJGUuYXR0cigidGl0bGUiKXx8IiIpLnJlbW92ZUF0dHIoInRpdGxlIil9LGhhc0NvbnRlbnQ6ZnVuY3Rpb24oKXtyZXR1cm4gdGhpcy5nZXRUaXRsZSgpfSxnZXRQb3NpdGlvbjpmdW5jdGlvbihpbnNpZGUpe3JldHVybiAkLmV4dGVuZCh7fSxpbnNpZGU/e3RvcDowLGxlZnQ6MH06dGhpcy4kZWxlbWVudC5vZmZzZXQoKSx7d2lkdGg6dGhpcy4kZWxlbWVudFswXS5vZmZzZXRXaWR0aCxoZWlnaHQ6dGhpcy4kZWxlbWVudFswXS5vZmZzZXRIZWlnaHR9KX0sZ2V0VGl0bGU6ZnVuY3Rpb24oKXt2YXIgdGl0bGUsJGU9dGhpcy4kZWxlbWVudCxvPXRoaXMub3B0aW9ucztyZXR1cm4gdGl0bGU9JGUuYXR0cigiZGF0YS1vcmlnaW5hbC10aXRsZSIpfHwoImZ1bmN0aW9uIj09dHlwZW9mIG8udGl0bGU/by50aXRsZS5jYWxsKCRlWzBdKTpvLnRpdGxlKX0sdGlwOmZ1bmN0aW9uKCl7cmV0dXJuIHRoaXMuJHRpcD10aGlzLiR0aXB8fCQodGhpcy5vcHRpb25zLnRlbXBsYXRlKX0sdmFsaWRhdGU6ZnVuY3Rpb24oKXt0aGlzLiRlbGVtZW50WzBdLnBhcmVudE5vZGV8fCh0aGlzLmhpZGUoKSx0aGlzLiRlbGVtZW50PW51bGwsdGhpcy5vcHRpb25zPW51bGwpfSxlbmFibGU6ZnVuY3Rpb24oKXt0aGlzLmVuYWJsZWQ9ITB9LGRpc2FibGU6ZnVuY3Rpb24oKXt0aGlzLmVuYWJsZWQ9ITF9LHRvZ2dsZUVuYWJsZWQ6ZnVuY3Rpb24oKXt0aGlzLmVuYWJsZWQ9IXRoaXMuZW5hYmxlZH0sdG9nZ2xlOmZ1bmN0aW9uKGUpe3ZhciBzZWxmPSQoZS5jdXJyZW50VGFyZ2V0KVt0aGlzLnR5cGVdKHRoaXMuX29wdGlvbnMpLmRhdGEodGhpcy50eXBlKTtzZWxmW3NlbGYudGlwKCkuaGFzQ2xhc3MoImluIik/ImhpZGUiOiJzaG93Il0oKX0sZGVzdHJveTpmdW5jdGlvbigpe3RoaXMuaGlkZSgpLiRlbGVtZW50Lm9mZigiLiIrdGhpcy50eXBlKS5yZW1vdmVEYXRhKHRoaXMudHlwZSl9fTt2YXIgb2xkPSQuZm4udG9vbHRpcDskLmZuLnRvb2x0aXA9ZnVuY3Rpb24ob3B0aW9uKXtyZXR1cm4gdGhpcy5lYWNoKGZ1bmN0aW9uKCl7dmFyICR0aGlzPSQodGhpcyksZGF0YT0kdGhpcy5kYXRhKCJ0b29sdGlwIiksb3B0aW9ucz0ib2JqZWN0Ij09dHlwZW9mIG9wdGlvbiYmb3B0aW9uO2RhdGF8fCR0aGlzLmRhdGEoInRvb2x0aXAiLGRhdGE9bmV3IFRvb2x0aXAodGhpcyxvcHRpb25zKSksInN0cmluZyI9PXR5cGVvZiBvcHRpb24mJmRhdGFbb3B0aW9uXSgpfSl9LCQuZm4udG9vbHRpcC5Db25zdHJ1Y3Rvcj1Ub29sdGlwLCQuZm4udG9vbHRpcC5kZWZhdWx0cz17YW5pbWF0aW9uOiEwLHBsYWNlbWVudDoidG9wIixzZWxlY3RvcjohMSx0ZW1wbGF0ZTonPGRpdiBjbGFzcz0idG9vbHRpcCI+PGRpdiBjbGFzcz0idG9vbHRpcC1hcnJvdyI+PC9kaXY+PGRpdiBjbGFzcz0idG9vbHRpcC1pbm5lciI+PC9kaXY+PC9kaXY+Jyx0cmlnZ2VyOiJob3ZlciIsdGl0bGU6IiIsZGVsYXk6MCxodG1sOiExfSwkLmZuLnRvb2x0aXAubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiAkLmZuLnRvb2x0aXA9b2xkLHRoaXN9fSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oJCl7InVzZSBzdHJpY3QiO3ZhciBQb3BvdmVyPWZ1bmN0aW9uKGVsZW1lbnQsb3B0aW9ucyl7dGhpcy5pbml0KCJwb3BvdmVyIixlbGVtZW50LG9wdGlvbnMpfTtQb3BvdmVyLnByb3RvdHlwZT0kLmV4dGVuZCh7fSwkLmZuLnRvb2x0aXAuQ29uc3RydWN0b3IucHJvdG90eXBlLHtjb25zdHJ1Y3RvcjpQb3BvdmVyLHNldENvbnRlbnQ6ZnVuY3Rpb24oKXt2YXIgJHRpcD10aGlzLnRpcCgpLHRpdGxlPXRoaXMuZ2V0VGl0bGUoKSxjb250ZW50PXRoaXMuZ2V0Q29udGVudCgpOyR0aXAuZmluZCgiLnBvcG92ZXItdGl0bGUiKVt0aGlzLm9wdGlvbnMuaHRtbD8iaHRtbCI6InRleHQiXSh0aXRsZSksJHRpcC5maW5kKCIucG9wb3Zlci1jb250ZW50IilbdGhpcy5vcHRpb25zLmh0bWw/Imh0bWwiOiJ0ZXh0Il0oY29udGVudCksJHRpcC5yZW1vdmVDbGFzcygiZmFkZSB0b3AgYm90dG9tIGxlZnQgcmlnaHQgaW4iKX0saGFzQ29udGVudDpmdW5jdGlvbigpe3JldHVybiB0aGlzLmdldFRpdGxlKCl8fHRoaXMuZ2V0Q29udGVudCgpfSxnZXRDb250ZW50OmZ1bmN0aW9uKCl7dmFyIGNvbnRlbnQsJGU9dGhpcy4kZWxlbWVudCxvPXRoaXMub3B0aW9ucztyZXR1cm4gY29udGVudD0kZS5hdHRyKCJkYXRhLWNvbnRlbnQiKXx8KCJmdW5jdGlvbiI9PXR5cGVvZiBvLmNvbnRlbnQ/by5jb250ZW50LmNhbGwoJGVbMF0pOm8uY29udGVudCl9LHRpcDpmdW5jdGlvbigpe3JldHVybiB0aGlzLiR0aXB8fCh0aGlzLiR0aXA9JCh0aGlzLm9wdGlvbnMudGVtcGxhdGUpKSx0aGlzLiR0aXB9LGRlc3Ryb3k6ZnVuY3Rpb24oKXt0aGlzLmhpZGUoKS4kZWxlbWVudC5vZmYoIi4iK3RoaXMudHlwZSkucmVtb3ZlRGF0YSh0aGlzLnR5cGUpfX0pO3ZhciBvbGQ9JC5mbi5wb3BvdmVyOyQuZm4ucG9wb3Zlcj1mdW5jdGlvbihvcHRpb24pe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgJHRoaXM9JCh0aGlzKSxkYXRhPSR0aGlzLmRhdGEoInBvcG92ZXIiKSxvcHRpb25zPSJvYmplY3QiPT10eXBlb2Ygb3B0aW9uJiZvcHRpb247ZGF0YXx8JHRoaXMuZGF0YSgicG9wb3ZlciIsZGF0YT1uZXcgUG9wb3Zlcih0aGlzLG9wdGlvbnMpKSwic3RyaW5nIj09dHlwZW9mIG9wdGlvbiYmZGF0YVtvcHRpb25dKCl9KX0sJC5mbi5wb3BvdmVyLkNvbnN0cnVjdG9yPVBvcG92ZXIsJC5mbi5wb3BvdmVyLmRlZmF1bHRzPSQuZXh0ZW5kKHt9LCQuZm4udG9vbHRpcC5kZWZhdWx0cyx7cGxhY2VtZW50OiJyaWdodCIsdHJpZ2dlcjoiY2xpY2siLGNvbnRlbnQ6IiIsdGVtcGxhdGU6JzxkaXYgY2xhc3M9InBvcG92ZXIiPjxkaXYgY2xhc3M9ImFycm93Ij48L2Rpdj48ZGl2IGNsYXNzPSJwb3BvdmVyLWlubmVyIj48aDMgY2xhc3M9InBvcG92ZXItdGl0bGUiPjwvaDM+PGRpdiBjbGFzcz0icG9wb3Zlci1jb250ZW50Ij48L2Rpdj48L2Rpdj48L2Rpdj4nfSksJC5mbi5wb3BvdmVyLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gJC5mbi5wb3BvdmVyPW9sZCx0aGlzfX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0IjtmdW5jdGlvbiBTY3JvbGxTcHkoZWxlbWVudCxvcHRpb25zKXt2YXIgaHJlZixwcm9jZXNzPSQucHJveHkodGhpcy5wcm9jZXNzLHRoaXMpLCRlbGVtZW50PSQoZWxlbWVudCkuaXMoImJvZHkiKT8kKHdpbmRvdyk6JChlbGVtZW50KTt0aGlzLm9wdGlvbnM9JC5leHRlbmQoe30sJC5mbi5zY3JvbGxzcHkuZGVmYXVsdHMsb3B0aW9ucyksdGhpcy4kc2Nyb2xsRWxlbWVudD0kZWxlbWVudC5vbigic2Nyb2xsLnNjcm9sbC1zcHkuZGF0YS1hcGkiLHByb2Nlc3MpLHRoaXMuc2VsZWN0b3I9KHRoaXMub3B0aW9ucy50YXJnZXR8fChocmVmPSQoZWxlbWVudCkuYXR0cigiaHJlZiIpKSYmaHJlZi5yZXBsYWNlKC8uKig/PSNbXlxzXSskKS8sIiIpfHwiIikrIiAubmF2IGxpID4gYSIsdGhpcy4kYm9keT0kKCJib2R5IiksdGhpcy5yZWZyZXNoKCksdGhpcy5wcm9jZXNzKCl9U2Nyb2xsU3B5LnByb3RvdHlwZT17Y29uc3RydWN0b3I6U2Nyb2xsU3B5LHJlZnJlc2g6ZnVuY3Rpb24oKXt2YXIgJHRhcmdldHMsc2VsZj10aGlzO3RoaXMub2Zmc2V0cz0kKFtdKSx0aGlzLnRhcmdldHM9JChbXSksJHRhcmdldHM9dGhpcy4kYm9keS5maW5kKHRoaXMuc2VsZWN0b3IpLm1hcChmdW5jdGlvbigpe3ZhciAkZWw9JCh0aGlzKSxocmVmPSRlbC5kYXRhKCJ0YXJnZXQiKXx8JGVsLmF0dHIoImhyZWYiKSwkaHJlZj0vXiNcdy8udGVzdChocmVmKSYmJChocmVmKTtyZXR1cm4gJGhyZWYmJiRocmVmLmxlbmd0aCYmW1skaHJlZi5wb3NpdGlvbigpLnRvcCtzZWxmLiRzY3JvbGxFbGVtZW50LnNjcm9sbFRvcCgpLGhyZWZdXXx8bnVsbH0pLnNvcnQoZnVuY3Rpb24oYSxiKXtyZXR1cm4gYVswXS1iWzBdfSkuZWFjaChmdW5jdGlvbigpe3NlbGYub2Zmc2V0cy5wdXNoKHRoaXNbMF0pLHNlbGYudGFyZ2V0cy5wdXNoKHRoaXNbMV0pfSl9LHByb2Nlc3M6ZnVuY3Rpb24oKXt2YXIgaSxzY3JvbGxUb3A9dGhpcy4kc2Nyb2xsRWxlbWVudC5zY3JvbGxUb3AoKSt0aGlzLm9wdGlvbnMub2Zmc2V0LHNjcm9sbEhlaWdodD10aGlzLiRzY3JvbGxFbGVtZW50WzBdLnNjcm9sbEhlaWdodHx8dGhpcy4kYm9keVswXS5zY3JvbGxIZWlnaHQsbWF4U2Nyb2xsPXNjcm9sbEhlaWdodC10aGlzLiRzY3JvbGxFbGVtZW50LmhlaWdodCgpLG9mZnNldHM9dGhpcy5vZmZzZXRzLHRhcmdldHM9dGhpcy50YXJnZXRzLGFjdGl2ZVRhcmdldD10aGlzLmFjdGl2ZVRhcmdldDtpZihzY3JvbGxUb3A+PW1heFNjcm9sbClyZXR1cm4gYWN0aXZlVGFyZ2V0IT0oaT10YXJnZXRzLmxhc3QoKVswXSkmJnRoaXMuYWN0aXZhdGUoaSk7Zm9yKGk9b2Zmc2V0cy5sZW5ndGg7aS0tOylhY3RpdmVUYXJnZXQhPXRhcmdldHNbaV0mJnNjcm9sbFRvcD49b2Zmc2V0c1tpXSYmKCFvZmZzZXRzW2krMV18fG9mZnNldHNbaSsxXT49c2Nyb2xsVG9wKSYmdGhpcy5hY3RpdmF0ZSh0YXJnZXRzW2ldKX0sYWN0aXZhdGU6ZnVuY3Rpb24odGFyZ2V0KXt2YXIgYWN0aXZlLHNlbGVjdG9yO3RoaXMuYWN0aXZlVGFyZ2V0PXRhcmdldCwkKHRoaXMuc2VsZWN0b3IpLnBhcmVudCgiLmFjdGl2ZSIpLnJlbW92ZUNsYXNzKCJhY3RpdmUiKSxzZWxlY3Rvcj10aGlzLnNlbGVjdG9yKydbZGF0YS10YXJnZXQ9IicrdGFyZ2V0KyciXSwnK3RoaXMuc2VsZWN0b3IrJ1tocmVmPSInK3RhcmdldCsnIl0nLGFjdGl2ZT0kKHNlbGVjdG9yKS5wYXJlbnQoImxpIikuYWRkQ2xhc3MoImFjdGl2ZSIpLGFjdGl2ZS5wYXJlbnQoIi5kcm9wZG93bi1tZW51IikubGVuZ3RoJiYoYWN0aXZlPWFjdGl2ZS5jbG9zZXN0KCJsaS5kcm9wZG93biIpLmFkZENsYXNzKCJhY3RpdmUiKSksYWN0aXZlLnRyaWdnZXIoImFjdGl2YXRlIil9fTt2YXIgb2xkPSQuZm4uc2Nyb2xsc3B5OyQuZm4uc2Nyb2xsc3B5PWZ1bmN0aW9uKG9wdGlvbil7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciAkdGhpcz0kKHRoaXMpLGRhdGE9JHRoaXMuZGF0YSgic2Nyb2xsc3B5Iiksb3B0aW9ucz0ib2JqZWN0Ij09dHlwZW9mIG9wdGlvbiYmb3B0aW9uO2RhdGF8fCR0aGlzLmRhdGEoInNjcm9sbHNweSIsZGF0YT1uZXcgU2Nyb2xsU3B5KHRoaXMsb3B0aW9ucykpLCJzdHJpbmciPT10eXBlb2Ygb3B0aW9uJiZkYXRhW29wdGlvbl0oKX0pfSwkLmZuLnNjcm9sbHNweS5Db25zdHJ1Y3Rvcj1TY3JvbGxTcHksJC5mbi5zY3JvbGxzcHkuZGVmYXVsdHM9e29mZnNldDoxMH0sJC5mbi5zY3JvbGxzcHkubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiAkLmZuLnNjcm9sbHNweT1vbGQsdGhpc30sJCh3aW5kb3cpLm9uKCJsb2FkIixmdW5jdGlvbigpeyQoJ1tkYXRhLXNweT0ic2Nyb2xsIl0nKS5lYWNoKGZ1bmN0aW9uKCl7dmFyICRzcHk9JCh0aGlzKTskc3B5LnNjcm9sbHNweSgkc3B5LmRhdGEoKSl9KX0pfSh3aW5kb3cualF1ZXJ5KSwhZnVuY3Rpb24oJCl7InVzZSBzdHJpY3QiO3ZhciBUYWI9ZnVuY3Rpb24oZWxlbWVudCl7dGhpcy5lbGVtZW50PSQoZWxlbWVudCl9O1RhYi5wcm90b3R5cGU9e2NvbnN0cnVjdG9yOlRhYixzaG93OmZ1bmN0aW9uKCl7dmFyIHByZXZpb3VzLCR0YXJnZXQsZSwkdGhpcz10aGlzLmVsZW1lbnQsJHVsPSR0aGlzLmNsb3Nlc3QoInVsOm5vdCguZHJvcGRvd24tbWVudSkiKSxzZWxlY3Rvcj0kdGhpcy5hdHRyKCJkYXRhLXRhcmdldCIpO3NlbGVjdG9yfHwoc2VsZWN0b3I9JHRoaXMuYXR0cigiaHJlZiIpLHNlbGVjdG9yPXNlbGVjdG9yJiZzZWxlY3Rvci5yZXBsYWNlKC8uKig/PSNbXlxzXSokKS8sIiIpKSwkdGhpcy5wYXJlbnQoImxpIikuaGFzQ2xhc3MoImFjdGl2ZSIpfHwocHJldmlvdXM9JHVsLmZpbmQoIi5hY3RpdmU6bGFzdCBhIilbMF0sZT0kLkV2ZW50KCJzaG93Iix7cmVsYXRlZFRhcmdldDpwcmV2aW91c30pLCR0aGlzLnRyaWdnZXIoZSksZS5pc0RlZmF1bHRQcmV2ZW50ZWQoKXx8KCR0YXJnZXQ9JChzZWxlY3RvciksdGhpcy5hY3RpdmF0ZSgkdGhpcy5wYXJlbnQoImxpIiksJHVsKSx0aGlzLmFjdGl2YXRlKCR0YXJnZXQsJHRhcmdldC5wYXJlbnQoKSxmdW5jdGlvbigpeyR0aGlzLnRyaWdnZXIoe3R5cGU6InNob3duIixyZWxhdGVkVGFyZ2V0OnByZXZpb3VzfSl9KSkpfSxhY3RpdmF0ZTpmdW5jdGlvbihlbGVtZW50LGNvbnRhaW5lcixjYWxsYmFjayl7ZnVuY3Rpb24gbmV4dCgpeyRhY3RpdmUucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpLmZpbmQoIj4gLmRyb3Bkb3duLW1lbnUgPiAuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpLGVsZW1lbnQuYWRkQ2xhc3MoImFjdGl2ZSIpLHRyYW5zaXRpb24/KGVsZW1lbnRbMF0ub2Zmc2V0V2lkdGgsZWxlbWVudC5hZGRDbGFzcygiaW4iKSk6ZWxlbWVudC5yZW1vdmVDbGFzcygiZmFkZSIpLGVsZW1lbnQucGFyZW50KCIuZHJvcGRvd24tbWVudSIpJiZlbGVtZW50LmNsb3Nlc3QoImxpLmRyb3Bkb3duIikuYWRkQ2xhc3MoImFjdGl2ZSIpLGNhbGxiYWNrJiZjYWxsYmFjaygpfXZhciAkYWN0aXZlPWNvbnRhaW5lci5maW5kKCI+IC5hY3RpdmUiKSx0cmFuc2l0aW9uPWNhbGxiYWNrJiYkLnN1cHBvcnQudHJhbnNpdGlvbiYmJGFjdGl2ZS5oYXNDbGFzcygiZmFkZSIpO3RyYW5zaXRpb24/JGFjdGl2ZS5vbmUoJC5zdXBwb3J0LnRyYW5zaXRpb24uZW5kLG5leHQpOm5leHQoKSwkYWN0aXZlLnJlbW92ZUNsYXNzKCJpbiIpfX07dmFyIG9sZD0kLmZuLnRhYjskLmZuLnRhYj1mdW5jdGlvbihvcHRpb24pe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgJHRoaXM9JCh0aGlzKSxkYXRhPSR0aGlzLmRhdGEoInRhYiIpO2RhdGF8fCR0aGlzLmRhdGEoInRhYiIsZGF0YT1uZXcgVGFiKHRoaXMpKSwic3RyaW5nIj09dHlwZW9mIG9wdGlvbiYmZGF0YVtvcHRpb25dKCl9KX0sJC5mbi50YWIuQ29uc3RydWN0b3I9VGFiLCQuZm4udGFiLm5vQ29uZmxpY3Q9ZnVuY3Rpb24oKXtyZXR1cm4gJC5mbi50YWI9b2xkLHRoaXN9LCQoZG9jdW1lbnQpLm9uKCJjbGljay50YWIuZGF0YS1hcGkiLCdbZGF0YS10b2dnbGU9InRhYiJdLCBbZGF0YS10b2dnbGU9InBpbGwiXScsZnVuY3Rpb24oZSl7ZS5wcmV2ZW50RGVmYXVsdCgpLCQodGhpcykudGFiKCJzaG93Iil9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0Ijt2YXIgVHlwZWFoZWFkPWZ1bmN0aW9uKGVsZW1lbnQsb3B0aW9ucyl7dGhpcy4kZWxlbWVudD0kKGVsZW1lbnQpLHRoaXMub3B0aW9ucz0kLmV4dGVuZCh7fSwkLmZuLnR5cGVhaGVhZC5kZWZhdWx0cyxvcHRpb25zKSx0aGlzLm1hdGNoZXI9dGhpcy5vcHRpb25zLm1hdGNoZXJ8fHRoaXMubWF0Y2hlcix0aGlzLnNvcnRlcj10aGlzLm9wdGlvbnMuc29ydGVyfHx0aGlzLnNvcnRlcix0aGlzLmhpZ2hsaWdodGVyPXRoaXMub3B0aW9ucy5oaWdobGlnaHRlcnx8dGhpcy5oaWdobGlnaHRlcix0aGlzLnVwZGF0ZXI9dGhpcy5vcHRpb25zLnVwZGF0ZXJ8fHRoaXMudXBkYXRlcix0aGlzLnNvdXJjZT10aGlzLm9wdGlvbnMuc291cmNlLHRoaXMuJG1lbnU9JCh0aGlzLm9wdGlvbnMubWVudSksdGhpcy5zaG93bj0hMSx0aGlzLmxpc3RlbigpfTtUeXBlYWhlYWQucHJvdG90eXBlPXtjb25zdHJ1Y3RvcjpUeXBlYWhlYWQsc2VsZWN0OmZ1bmN0aW9uKCl7dmFyIHZhbD10aGlzLiRtZW51LmZpbmQoIi5hY3RpdmUiKS5hdHRyKCJkYXRhLXZhbHVlIik7cmV0dXJuIHRoaXMuJGVsZW1lbnQudmFsKHRoaXMudXBkYXRlcih2YWwpKS5jaGFuZ2UoKSx0aGlzLmhpZGUoKX0sdXBkYXRlcjpmdW5jdGlvbihpdGVtKXtyZXR1cm4gaXRlbX0sc2hvdzpmdW5jdGlvbigpe3ZhciBwb3M9JC5leHRlbmQoe30sdGhpcy4kZWxlbWVudC5wb3NpdGlvbigpLHtoZWlnaHQ6dGhpcy4kZWxlbWVudFswXS5vZmZzZXRIZWlnaHR9KTtyZXR1cm4gdGhpcy4kbWVudS5pbnNlcnRBZnRlcih0aGlzLiRlbGVtZW50KS5jc3Moe3RvcDpwb3MudG9wK3Bvcy5oZWlnaHQsbGVmdDpwb3MubGVmdH0pLnNob3coKSx0aGlzLnNob3duPSEwLHRoaXN9LGhpZGU6ZnVuY3Rpb24oKXtyZXR1cm4gdGhpcy4kbWVudS5oaWRlKCksdGhpcy5zaG93bj0hMSx0aGlzfSxsb29rdXA6ZnVuY3Rpb24oKXt2YXIgaXRlbXM7cmV0dXJuIHRoaXMucXVlcnk9dGhpcy4kZWxlbWVudC52YWwoKSwhdGhpcy5xdWVyeXx8dGhpcy5xdWVyeS5sZW5ndGg8dGhpcy5vcHRpb25zLm1pbkxlbmd0aD90aGlzLnNob3duP3RoaXMuaGlkZSgpOnRoaXM6KGl0ZW1zPSQuaXNGdW5jdGlvbih0aGlzLnNvdXJjZSk/dGhpcy5zb3VyY2UodGhpcy5xdWVyeSwkLnByb3h5KHRoaXMucHJvY2Vzcyx0aGlzKSk6dGhpcy5zb3VyY2UsaXRlbXM/dGhpcy5wcm9jZXNzKGl0ZW1zKTp0aGlzKX0scHJvY2VzczpmdW5jdGlvbihpdGVtcyl7dmFyIHRoYXQ9dGhpcztyZXR1cm4gaXRlbXM9JC5ncmVwKGl0ZW1zLGZ1bmN0aW9uKGl0ZW0pe3JldHVybiB0aGF0Lm1hdGNoZXIoaXRlbSl9KSxpdGVtcz10aGlzLnNvcnRlcihpdGVtcyksaXRlbXMubGVuZ3RoP3RoaXMucmVuZGVyKGl0ZW1zLnNsaWNlKDAsdGhpcy5vcHRpb25zLml0ZW1zKSkuc2hvdygpOnRoaXMuc2hvd24/dGhpcy5oaWRlKCk6dGhpc30sbWF0Y2hlcjpmdW5jdGlvbihpdGVtKXtyZXR1cm5+aXRlbS50b0xvd2VyQ2FzZSgpLmluZGV4T2YodGhpcy5xdWVyeS50b0xvd2VyQ2FzZSgpKX0sc29ydGVyOmZ1bmN0aW9uKGl0ZW1zKXtmb3IodmFyIGl0ZW0sYmVnaW5zd2l0aD1bXSxjYXNlU2Vuc2l0aXZlPVtdLGNhc2VJbnNlbnNpdGl2ZT1bXTtpdGVtPWl0ZW1zLnNoaWZ0KCk7KWl0ZW0udG9Mb3dlckNhc2UoKS5pbmRleE9mKHRoaXMucXVlcnkudG9Mb3dlckNhc2UoKSk/fml0ZW0uaW5kZXhPZih0aGlzLnF1ZXJ5KT9jYXNlU2Vuc2l0aXZlLnB1c2goaXRlbSk6Y2FzZUluc2Vuc2l0aXZlLnB1c2goaXRlbSk6YmVnaW5zd2l0aC5wdXNoKGl0ZW0pO3JldHVybiBiZWdpbnN3aXRoLmNvbmNhdChjYXNlU2Vuc2l0aXZlLGNhc2VJbnNlbnNpdGl2ZSl9LGhpZ2hsaWdodGVyOmZ1bmN0aW9uKGl0ZW0pe3ZhciBxdWVyeT10aGlzLnF1ZXJ5LnJlcGxhY2UoL1tcLVxbXF17fSgpKis/LixcXFxeJHwjXHNdL2csIlxcJCYiKTtyZXR1cm4gaXRlbS5yZXBsYWNlKFJlZ0V4cCgiKCIrcXVlcnkrIikiLCJpZyIpLGZ1bmN0aW9uKCQxLG1hdGNoKXtyZXR1cm4iPHN0cm9uZz4iK21hdGNoKyI8L3N0cm9uZz4ifSl9LHJlbmRlcjpmdW5jdGlvbihpdGVtcyl7dmFyIHRoYXQ9dGhpcztyZXR1cm4gaXRlbXM9JChpdGVtcykubWFwKGZ1bmN0aW9uKGksaXRlbSl7cmV0dXJuIGk9JCh0aGF0Lm9wdGlvbnMuaXRlbSkuYXR0cigiZGF0YS12YWx1ZSIsaXRlbSksaS5maW5kKCJhIikuaHRtbCh0aGF0LmhpZ2hsaWdodGVyKGl0ZW0pKSxpWzBdfSksaXRlbXMuZmlyc3QoKS5hZGRDbGFzcygiYWN0aXZlIiksdGhpcy4kbWVudS5odG1sKGl0ZW1zKSx0aGlzfSxuZXh0OmZ1bmN0aW9uKCl7dmFyIGFjdGl2ZT10aGlzLiRtZW51LmZpbmQoIi5hY3RpdmUiKS5yZW1vdmVDbGFzcygiYWN0aXZlIiksbmV4dD1hY3RpdmUubmV4dCgpO25leHQubGVuZ3RofHwobmV4dD0kKHRoaXMuJG1lbnUuZmluZCgibGkiKVswXSkpLG5leHQuYWRkQ2xhc3MoImFjdGl2ZSIpfSxwcmV2OmZ1bmN0aW9uKCl7dmFyIGFjdGl2ZT10aGlzLiRtZW51LmZpbmQoIi5hY3RpdmUiKS5yZW1vdmVDbGFzcygiYWN0aXZlIikscHJldj1hY3RpdmUucHJldigpO3ByZXYubGVuZ3RofHwocHJldj10aGlzLiRtZW51LmZpbmQoImxpIikubGFzdCgpKSxwcmV2LmFkZENsYXNzKCJhY3RpdmUiKX0sbGlzdGVuOmZ1bmN0aW9uKCl7dGhpcy4kZWxlbWVudC5vbigiYmx1ciIsJC5wcm94eSh0aGlzLmJsdXIsdGhpcykpLm9uKCJrZXlwcmVzcyIsJC5wcm94eSh0aGlzLmtleXByZXNzLHRoaXMpKS5vbigia2V5dXAiLCQucHJveHkodGhpcy5rZXl1cCx0aGlzKSksdGhpcy5ldmVudFN1cHBvcnRlZCgia2V5ZG93biIpJiZ0aGlzLiRlbGVtZW50Lm9uKCJrZXlkb3duIiwkLnByb3h5KHRoaXMua2V5ZG93bix0aGlzKSksdGhpcy4kbWVudS5vbigiY2xpY2siLCQucHJveHkodGhpcy5jbGljayx0aGlzKSkub24oIm1vdXNlZW50ZXIiLCJsaSIsJC5wcm94eSh0aGlzLm1vdXNlZW50ZXIsdGhpcykpfSxldmVudFN1cHBvcnRlZDpmdW5jdGlvbihldmVudE5hbWUpe3ZhciBpc1N1cHBvcnRlZD1ldmVudE5hbWUgaW4gdGhpcy4kZWxlbWVudDtyZXR1cm4gaXNTdXBwb3J0ZWR8fCh0aGlzLiRlbGVtZW50LnNldEF0dHJpYnV0ZShldmVudE5hbWUsInJldHVybjsiKSxpc1N1cHBvcnRlZD0iZnVuY3Rpb24iPT10eXBlb2YgdGhpcy4kZWxlbWVudFtldmVudE5hbWVdKSxpc1N1cHBvcnRlZH0sbW92ZTpmdW5jdGlvbihlKXtpZih0aGlzLnNob3duKXtzd2l0Y2goZS5rZXlDb2RlKXtjYXNlIDk6Y2FzZSAxMzpjYXNlIDI3OmUucHJldmVudERlZmF1bHQoKTticmVhaztjYXNlIDM4OmUucHJldmVudERlZmF1bHQoKSx0aGlzLnByZXYoKTticmVhaztjYXNlIDQwOmUucHJldmVudERlZmF1bHQoKSx0aGlzLm5leHQoKX1lLnN0b3BQcm9wYWdhdGlvbigpfX0sa2V5ZG93bjpmdW5jdGlvbihlKXt0aGlzLnN1cHByZXNzS2V5UHJlc3NSZXBlYXQ9fiQuaW5BcnJheShlLmtleUNvZGUsWzQwLDM4LDksMTMsMjddKSx0aGlzLm1vdmUoZSl9LGtleXByZXNzOmZ1bmN0aW9uKGUpe3RoaXMuc3VwcHJlc3NLZXlQcmVzc1JlcGVhdHx8dGhpcy5tb3ZlKGUpfSxrZXl1cDpmdW5jdGlvbihlKXtzd2l0Y2goZS5rZXlDb2RlKXtjYXNlIDQwOmNhc2UgMzg6Y2FzZSAxNjpjYXNlIDE3OmNhc2UgMTg6YnJlYWs7Y2FzZSA5OmNhc2UgMTM6aWYoIXRoaXMuc2hvd24pcmV0dXJuO3RoaXMuc2VsZWN0KCk7YnJlYWs7Y2FzZSAyNzppZighdGhpcy5zaG93bilyZXR1cm47dGhpcy5oaWRlKCk7YnJlYWs7ZGVmYXVsdDp0aGlzLmxvb2t1cCgpfWUuc3RvcFByb3BhZ2F0aW9uKCksZS5wcmV2ZW50RGVmYXVsdCgpfSxibHVyOmZ1bmN0aW9uKCl7dmFyIHRoYXQ9dGhpcztzZXRUaW1lb3V0KGZ1bmN0aW9uKCl7dGhhdC5oaWRlKCl9LDE1MCl9LGNsaWNrOmZ1bmN0aW9uKGUpe2Uuc3RvcFByb3BhZ2F0aW9uKCksZS5wcmV2ZW50RGVmYXVsdCgpLHRoaXMuc2VsZWN0KCl9LG1vdXNlZW50ZXI6ZnVuY3Rpb24oZSl7dGhpcy4kbWVudS5maW5kKCIuYWN0aXZlIikucmVtb3ZlQ2xhc3MoImFjdGl2ZSIpLCQoZS5jdXJyZW50VGFyZ2V0KS5hZGRDbGFzcygiYWN0aXZlIil9fTt2YXIgb2xkPSQuZm4udHlwZWFoZWFkOyQuZm4udHlwZWFoZWFkPWZ1bmN0aW9uKG9wdGlvbil7cmV0dXJuIHRoaXMuZWFjaChmdW5jdGlvbigpe3ZhciAkdGhpcz0kKHRoaXMpLGRhdGE9JHRoaXMuZGF0YSgidHlwZWFoZWFkIiksb3B0aW9ucz0ib2JqZWN0Ij09dHlwZW9mIG9wdGlvbiYmb3B0aW9uO2RhdGF8fCR0aGlzLmRhdGEoInR5cGVhaGVhZCIsZGF0YT1uZXcgVHlwZWFoZWFkKHRoaXMsb3B0aW9ucykpLCJzdHJpbmciPT10eXBlb2Ygb3B0aW9uJiZkYXRhW29wdGlvbl0oKX0pfSwkLmZuLnR5cGVhaGVhZC5kZWZhdWx0cz17c291cmNlOltdLGl0ZW1zOjgsbWVudTonPHVsIGNsYXNzPSJ0eXBlYWhlYWQgZHJvcGRvd24tbWVudSI+PC91bD4nLGl0ZW06JzxsaT48YSBocmVmPSIjIj48L2E+PC9saT4nLG1pbkxlbmd0aDoxfSwkLmZuLnR5cGVhaGVhZC5Db25zdHJ1Y3Rvcj1UeXBlYWhlYWQsJC5mbi50eXBlYWhlYWQubm9Db25mbGljdD1mdW5jdGlvbigpe3JldHVybiAkLmZuLnR5cGVhaGVhZD1vbGQsdGhpc30sJChkb2N1bWVudCkub24oImZvY3VzLnR5cGVhaGVhZC5kYXRhLWFwaSIsJ1tkYXRhLXByb3ZpZGU9InR5cGVhaGVhZCJdJyxmdW5jdGlvbihlKXt2YXIgJHRoaXM9JCh0aGlzKTskdGhpcy5kYXRhKCJ0eXBlYWhlYWQiKXx8KGUucHJldmVudERlZmF1bHQoKSwkdGhpcy50eXBlYWhlYWQoJHRoaXMuZGF0YSgpKSl9KX0od2luZG93LmpRdWVyeSksIWZ1bmN0aW9uKCQpeyJ1c2Ugc3RyaWN0Ijt2YXIgQWZmaXg9ZnVuY3Rpb24oZWxlbWVudCxvcHRpb25zKXt0aGlzLm9wdGlvbnM9JC5leHRlbmQoe30sJC5mbi5hZmZpeC5kZWZhdWx0cyxvcHRpb25zKSx0aGlzLiR3aW5kb3c9JCh3aW5kb3cpLm9uKCJzY3JvbGwuYWZmaXguZGF0YS1hcGkiLCQucHJveHkodGhpcy5jaGVja1Bvc2l0aW9uLHRoaXMpKS5vbigiY2xpY2suYWZmaXguZGF0YS1hcGkiLCQucHJveHkoZnVuY3Rpb24oKXtzZXRUaW1lb3V0KCQucHJveHkodGhpcy5jaGVja1Bvc2l0aW9uLHRoaXMpLDEpfSx0aGlzKSksdGhpcy4kZWxlbWVudD0kKGVsZW1lbnQpLHRoaXMuY2hlY2tQb3NpdGlvbigpfTtBZmZpeC5wcm90b3R5cGUuY2hlY2tQb3NpdGlvbj1mdW5jdGlvbigpe2lmKHRoaXMuJGVsZW1lbnQuaXMoIjp2aXNpYmxlIikpe3ZhciBhZmZpeCxzY3JvbGxIZWlnaHQ9JChkb2N1bWVudCkuaGVpZ2h0KCksc2Nyb2xsVG9wPXRoaXMuJHdpbmRvdy5zY3JvbGxUb3AoKSxwb3NpdGlvbj10aGlzLiRlbGVtZW50Lm9mZnNldCgpLG9mZnNldD10aGlzLm9wdGlvbnMub2Zmc2V0LG9mZnNldEJvdHRvbT1vZmZzZXQuYm90dG9tLG9mZnNldFRvcD1vZmZzZXQudG9wLHJlc2V0PSJhZmZpeCBhZmZpeC10b3AgYWZmaXgtYm90dG9tIjsib2JqZWN0IiE9dHlwZW9mIG9mZnNldCYmKG9mZnNldEJvdHRvbT1vZmZzZXRUb3A9b2Zmc2V0KSwiZnVuY3Rpb24iPT10eXBlb2Ygb2Zmc2V0VG9wJiYob2Zmc2V0VG9wPW9mZnNldC50b3AoKSksImZ1bmN0aW9uIj09dHlwZW9mIG9mZnNldEJvdHRvbSYmKG9mZnNldEJvdHRvbT1vZmZzZXQuYm90dG9tKCkpLGFmZml4PW51bGwhPXRoaXMudW5waW4mJnNjcm9sbFRvcCt0aGlzLnVucGluPD1wb3NpdGlvbi50b3A/ITE6bnVsbCE9b2Zmc2V0Qm90dG9tJiZwb3NpdGlvbi50b3ArdGhpcy4kZWxlbWVudC5oZWlnaHQoKT49c2Nyb2xsSGVpZ2h0LW9mZnNldEJvdHRvbT8iYm90dG9tIjpudWxsIT1vZmZzZXRUb3AmJm9mZnNldFRvcD49c2Nyb2xsVG9wPyJ0b3AiOiExLHRoaXMuYWZmaXhlZCE9PWFmZml4JiYodGhpcy5hZmZpeGVkPWFmZml4LHRoaXMudW5waW49ImJvdHRvbSI9PWFmZml4P3Bvc2l0aW9uLnRvcC1zY3JvbGxUb3A6bnVsbCx0aGlzLiRlbGVtZW50LnJlbW92ZUNsYXNzKHJlc2V0KS5hZGRDbGFzcygiYWZmaXgiKyhhZmZpeD8iLSIrYWZmaXg6IiIpKSl9fTt2YXIgb2xkPSQuZm4uYWZmaXg7JC5mbi5hZmZpeD1mdW5jdGlvbihvcHRpb24pe3JldHVybiB0aGlzLmVhY2goZnVuY3Rpb24oKXt2YXIgJHRoaXM9JCh0aGlzKSxkYXRhPSR0aGlzLmRhdGEoImFmZml4Iiksb3B0aW9ucz0ib2JqZWN0Ij09dHlwZW9mIG9wdGlvbiYmb3B0aW9uO2RhdGF8fCR0aGlzLmRhdGEoImFmZml4IixkYXRhPW5ldyBBZmZpeCh0aGlzLG9wdGlvbnMpKSwic3RyaW5nIj09dHlwZW9mIG9wdGlvbiYmZGF0YVtvcHRpb25dKCl9KX0sJC5mbi5hZmZpeC5Db25zdHJ1Y3Rvcj1BZmZpeCwkLmZuLmFmZml4LmRlZmF1bHRzPXtvZmZzZXQ6MH0sJC5mbi5hZmZpeC5ub0NvbmZsaWN0PWZ1bmN0aW9uKCl7cmV0dXJuICQuZm4uYWZmaXg9b2xkLHRoaXN9LCQod2luZG93KS5vbigibG9hZCIsZnVuY3Rpb24oKXskKCdbZGF0YS1zcHk9ImFmZml4Il0nKS5lYWNoKGZ1bmN0aW9uKCl7dmFyICRzcHk9JCh0aGlzKSxkYXRhPSRzcHkuZGF0YSgpO2RhdGEub2Zmc2V0PWRhdGEub2Zmc2V0fHx7fSxkYXRhLm9mZnNldEJvdHRvbSYmKGRhdGEub2Zmc2V0LmJvdHRvbT1kYXRhLm9mZnNldEJvdHRvbSksZGF0YS5vZmZzZXRUb3AmJihkYXRhLm9mZnNldC50b3A9ZGF0YS5vZmZzZXRUb3ApLCRzcHkuYWZmaXgoZGF0YSl9KX0pfSh3aW5kb3cualF1ZXJ5KTs=';    	
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
    // Bootstrap v2.2.2	   
    $css =   'LyohDQogKiBCb290c3RyYXAgdjIuMi4yDQogKg0KICogQ29weXJpZ2h0IDIwMTIgVHdpdHRlciwgSW5jDQogKiBMaWNlbnNlZCB1bmRlciB0aGUgQXBhY2hlIExpY2Vuc2UgdjIuMA0KICogaHR0cDovL3d3dy5hcGFjaGUub3JnL2xpY2Vuc2VzL0xJQ0VOU0UtMi4wDQogKg0KICogRGVzaWduZWQgYW5kIGJ1aWx0IHdpdGggYWxsIHRoZSBsb3ZlIGluIHRoZSB3b3JsZCBAdHdpdHRlciBieSBAbWRvIGFuZCBAZmF0Lg0KICovYXJ0aWNsZSxhc2lkZSxkZXRhaWxzLGZpZ2NhcHRpb24sZmlndXJlLGZvb3RlcixoZWFkZXIsaGdyb3VwLG5hdixzZWN0aW9ue2Rpc3BsYXk6YmxvY2t9YXVkaW8sY2FudmFzLHZpZGVve2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxfWF1ZGlvOm5vdChbY29udHJvbHNdKXtkaXNwbGF5Om5vbmV9aHRtbHtmb250LXNpemU6MTAwJTstd2Via2l0LXRleHQtc2l6ZS1hZGp1c3Q6MTAwJTstbXMtdGV4dC1zaXplLWFkanVzdDoxMDAlfWE6Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHh9YTpob3ZlcixhOmFjdGl2ZXtvdXRsaW5lOjB9c3ViLHN1cHtwb3NpdGlvbjpyZWxhdGl2ZTtmb250LXNpemU6NzUlO2xpbmUtaGVpZ2h0OjA7dmVydGljYWwtYWxpZ246YmFzZWxpbmV9c3Vwe3RvcDotMC41ZW19c3Vie2JvdHRvbTotMC4yNWVtfWltZ3t3aWR0aDphdXRvXDk7aGVpZ2h0OmF1dG87bWF4LXdpZHRoOjEwMCU7dmVydGljYWwtYWxpZ246bWlkZGxlO2JvcmRlcjowOy1tcy1pbnRlcnBvbGF0aW9uLW1vZGU6YmljdWJpY30jbWFwX2NhbnZhcyBpbWcsLmdvb2dsZS1tYXBzIGltZ3ttYXgtd2lkdGg6bm9uZX1idXR0b24saW5wdXQsc2VsZWN0LHRleHRhcmVhe21hcmdpbjowO2ZvbnQtc2l6ZToxMDAlO3ZlcnRpY2FsLWFsaWduOm1pZGRsZX1idXR0b24saW5wdXR7Km92ZXJmbG93OnZpc2libGU7bGluZS1oZWlnaHQ6bm9ybWFsfWJ1dHRvbjo6LW1vei1mb2N1cy1pbm5lcixpbnB1dDo6LW1vei1mb2N1cy1pbm5lcntwYWRkaW5nOjA7Ym9yZGVyOjB9YnV0dG9uLGh0bWwgaW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXXtjdXJzb3I6cG9pbnRlcjstd2Via2l0LWFwcGVhcmFuY2U6YnV0dG9ufWxhYmVsLHNlbGVjdCxidXR0b24saW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXSxpbnB1dFt0eXBlPSJyYWRpbyJdLGlucHV0W3R5cGU9ImNoZWNrYm94Il17Y3Vyc29yOnBvaW50ZXJ9aW5wdXRbdHlwZT0ic2VhcmNoIl17LXdlYmtpdC1ib3gtc2l6aW5nOmNvbnRlbnQtYm94Oy1tb3otYm94LXNpemluZzpjb250ZW50LWJveDtib3gtc2l6aW5nOmNvbnRlbnQtYm94Oy13ZWJraXQtYXBwZWFyYW5jZTp0ZXh0ZmllbGR9aW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWRlY29yYXRpb24saW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWNhbmNlbC1idXR0b257LXdlYmtpdC1hcHBlYXJhbmNlOm5vbmV9dGV4dGFyZWF7b3ZlcmZsb3c6YXV0bzt2ZXJ0aWNhbC1hbGlnbjp0b3B9QG1lZGlhIHByaW50eyp7Y29sb3I6IzAwMCFpbXBvcnRhbnQ7dGV4dC1zaGFkb3c6bm9uZSFpbXBvcnRhbnQ7YmFja2dyb3VuZDp0cmFuc3BhcmVudCFpbXBvcnRhbnQ7Ym94LXNoYWRvdzpub25lIWltcG9ydGFudH1hLGE6dmlzaXRlZHt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lfWFbaHJlZl06YWZ0ZXJ7Y29udGVudDoiICgiIGF0dHIoaHJlZikgIikifWFiYnJbdGl0bGVdOmFmdGVye2NvbnRlbnQ6IiAoIiBhdHRyKHRpdGxlKSAiKSJ9LmlyIGE6YWZ0ZXIsYVtocmVmXj0iamF2YXNjcmlwdDoiXTphZnRlcixhW2hyZWZePSIjIl06YWZ0ZXJ7Y29udGVudDoiIn1wcmUsYmxvY2txdW90ZXtib3JkZXI6MXB4IHNvbGlkICM5OTk7cGFnZS1icmVhay1pbnNpZGU6YXZvaWR9dGhlYWR7ZGlzcGxheTp0YWJsZS1oZWFkZXItZ3JvdXB9dHIsaW1ne3BhZ2UtYnJlYWstaW5zaWRlOmF2b2lkfWltZ3ttYXgtd2lkdGg6MTAwJSFpbXBvcnRhbnR9QHBhZ2V7bWFyZ2luOi41Y219cCxoMixoM3tvcnBoYW5zOjM7d2lkb3dzOjN9aDIsaDN7cGFnZS1icmVhay1hZnRlcjphdm9pZH19LmNsZWFyZml4eyp6b29tOjF9LmNsZWFyZml4OmJlZm9yZSwuY2xlYXJmaXg6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LmNsZWFyZml4OmFmdGVye2NsZWFyOmJvdGh9LmhpZGUtdGV4dHtmb250OjAvMCBhO2NvbG9yOnRyYW5zcGFyZW50O3RleHQtc2hhZG93Om5vbmU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXI6MH0uaW5wdXQtYmxvY2stbGV2ZWx7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3h9Ym9keXttYXJnaW46MDtmb250LWZhbWlseToiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxBcmlhbCxzYW5zLXNlcmlmO2ZvbnQtc2l6ZToxNHB4O2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6IzMzMztiYWNrZ3JvdW5kLWNvbG9yOiNmZmZ9YXtjb2xvcjojMDhjO3RleHQtZGVjb3JhdGlvbjpub25lfWE6aG92ZXJ7Y29sb3I6IzAwNTU4MDt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lfS5pbWctcm91bmRlZHstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHh9LmltZy1wb2xhcm9pZHtwYWRkaW5nOjRweDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjY2NjO2JvcmRlcjoxcHggc29saWQgcmdiYSgwLDAsMCwwLjIpOy13ZWJraXQtYm94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLDAsMCwwLjEpOy1tb3otYm94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLDAsMCwwLjEpO2JveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwwLDAsMC4xKX0uaW1nLWNpcmNsZXstd2Via2l0LWJvcmRlci1yYWRpdXM6NTAwcHg7LW1vei1ib3JkZXItcmFkaXVzOjUwMHB4O2JvcmRlci1yYWRpdXM6NTAwcHh9LnJvd3ttYXJnaW4tbGVmdDotMjBweDsqem9vbToxfS5yb3c6YmVmb3JlLC5yb3c6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LnJvdzphZnRlcntjbGVhcjpib3RofVtjbGFzcyo9InNwYW4iXXtmbG9hdDpsZWZ0O21pbi1oZWlnaHQ6MXB4O21hcmdpbi1sZWZ0OjIwcHh9LmNvbnRhaW5lciwubmF2YmFyLXN0YXRpYy10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtYm90dG9tIC5jb250YWluZXJ7d2lkdGg6OTQwcHh9LnNwYW4xMnt3aWR0aDo5NDBweH0uc3BhbjExe3dpZHRoOjg2MHB4fS5zcGFuMTB7d2lkdGg6NzgwcHh9LnNwYW45e3dpZHRoOjcwMHB4fS5zcGFuOHt3aWR0aDo2MjBweH0uc3Bhbjd7d2lkdGg6NTQwcHh9LnNwYW42e3dpZHRoOjQ2MHB4fS5zcGFuNXt3aWR0aDozODBweH0uc3BhbjR7d2lkdGg6MzAwcHh9LnNwYW4ze3dpZHRoOjIyMHB4fS5zcGFuMnt3aWR0aDoxNDBweH0uc3BhbjF7d2lkdGg6NjBweH0ub2Zmc2V0MTJ7bWFyZ2luLWxlZnQ6OTgwcHh9Lm9mZnNldDExe21hcmdpbi1sZWZ0OjkwMHB4fS5vZmZzZXQxMHttYXJnaW4tbGVmdDo4MjBweH0ub2Zmc2V0OXttYXJnaW4tbGVmdDo3NDBweH0ub2Zmc2V0OHttYXJnaW4tbGVmdDo2NjBweH0ub2Zmc2V0N3ttYXJnaW4tbGVmdDo1ODBweH0ub2Zmc2V0NnttYXJnaW4tbGVmdDo1MDBweH0ub2Zmc2V0NXttYXJnaW4tbGVmdDo0MjBweH0ub2Zmc2V0NHttYXJnaW4tbGVmdDozNDBweH0ub2Zmc2V0M3ttYXJnaW4tbGVmdDoyNjBweH0ub2Zmc2V0MnttYXJnaW4tbGVmdDoxODBweH0ub2Zmc2V0MXttYXJnaW4tbGVmdDoxMDBweH0ucm93LWZsdWlke3dpZHRoOjEwMCU7Knpvb206MX0ucm93LWZsdWlkOmJlZm9yZSwucm93LWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5yb3ctZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aH0ucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO2Zsb2F0OmxlZnQ7d2lkdGg6MTAwJTttaW4taGVpZ2h0OjMwcHg7bWFyZ2luLWxlZnQ6Mi4xMjc2NTk1NzQ0NjgwODUlOyptYXJnaW4tbGVmdDoyLjA3NDQ2ODA4NTEwNjM4MyU7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94fS5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjB9LnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6Mi4xMjc2NTk1NzQ0NjgwODUlfS5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSV9LnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQ4OTM2MTcwMjEyNzY1JTsqd2lkdGg6OTEuNDM2MTcwMjEyNzY1OTQlfS5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi45Nzg3MjM0MDQyNTUzMiU7KndpZHRoOjgyLjkyNTUzMTkxNDg5MzYxJX0ucm93LWZsdWlkIC5zcGFuOXt3aWR0aDo3NC40NjgwODUxMDYzODI5NyU7KndpZHRoOjc0LjQxNDg5MzYxNzAyMTI2JX0ucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS45NTc0NDY4MDg1MTA2NCU7KndpZHRoOjY1LjkwNDI1NTMxOTE0ODkzJX0ucm93LWZsdWlkIC5zcGFuN3t3aWR0aDo1Ny40NDY4MDg1MTA2MzgyOSU7KndpZHRoOjU3LjM5MzYxNzAyMTI3NjU5JX0ucm93LWZsdWlkIC5zcGFuNnt3aWR0aDo0OC45MzYxNzAyMTI3NjU5NSU7KndpZHRoOjQ4Ljg4Mjk3ODcyMzQwNDI1JX0ucm93LWZsdWlkIC5zcGFuNXt3aWR0aDo0MC40MjU1MzE5MTQ4OTM2MiU7KndpZHRoOjQwLjM3MjM0MDQyNTUzMTkyJX0ucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS45MTQ4OTM2MTcwMjEyNzglOyp3aWR0aDozMS44NjE3MDIxMjc2NTk1NzYlfS5yb3ctZmx1aWQgLnNwYW4ze3dpZHRoOjIzLjQwNDI1NTMxOTE0ODkzNCU7KndpZHRoOjIzLjM1MTA2MzgyOTc4NzIzMyV9LnJvdy1mbHVpZCAuc3BhbjJ7d2lkdGg6MTQuODkzNjE3MDIxMjc2NTk1JTsqd2lkdGg6MTQuODQwNDI1NTMxOTE0ODk0JX0ucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo2LjM4Mjk3ODcyMzQwNDI1NSU7KndpZHRoOjYuMzI5Nzg3MjM0MDQyNTUzJX0ucm93LWZsdWlkIC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMDQuMjU1MzE5MTQ4OTM2MTclOyptYXJnaW4tbGVmdDoxMDQuMTQ4OTM2MTcwMjEyNzUlfS5yb3ctZmx1aWQgLm9mZnNldDEyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjEwMi4xMjc2NTk1NzQ0NjgwOCU7Km1hcmdpbi1sZWZ0OjEwMi4wMjEyNzY1OTU3NDQ2NyV9LnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTUuNzQ0NjgwODUxMDYzODIlOyptYXJnaW4tbGVmdDo5NS42MzgyOTc4NzIzNDA0JX0ucm93LWZsdWlkIC5vZmZzZXQxMTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo5My42MTcwMjEyNzY1OTU3NCU7Km1hcmdpbi1sZWZ0OjkzLjUxMDYzODI5Nzg3MjMyJX0ucm93LWZsdWlkIC5vZmZzZXQxMHttYXJnaW4tbGVmdDo4Ny4yMzQwNDI1NTMxOTE0OSU7Km1hcmdpbi1sZWZ0Ojg3LjEyNzY1OTU3NDQ2ODA3JX0ucm93LWZsdWlkIC5vZmZzZXQxMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4NS4xMDYzODI5Nzg3MjM0JTsqbWFyZ2luLWxlZnQ6ODQuOTk5OTk5OTk5OTk5OTklfS5yb3ctZmx1aWQgLm9mZnNldDl7bWFyZ2luLWxlZnQ6NzguNzIzNDA0MjU1MzE5MTQlOyptYXJnaW4tbGVmdDo3OC42MTcwMjEyNzY1OTU3MiV9LnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ni41OTU3NDQ2ODA4NTEwNiU7Km1hcmdpbi1sZWZ0Ojc2LjQ4OTM2MTcwMjEyNzY0JX0ucm93LWZsdWlkIC5vZmZzZXQ4e21hcmdpbi1sZWZ0OjcwLjIxMjc2NTk1NzQ0NjglOyptYXJnaW4tbGVmdDo3MC4xMDYzODI5Nzg3MjMzOSV9LnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC4wODUxMDYzODI5Nzg3MiU7Km1hcmdpbi1sZWZ0OjY3Ljk3ODcyMzQwNDI1NTMlfS5yb3ctZmx1aWQgLm9mZnNldDd7bWFyZ2luLWxlZnQ6NjEuNzAyMTI3NjU5NTc0NDYlOyptYXJnaW4tbGVmdDo2MS41OTU3NDQ2ODA4NTEwNiV9LnJvdy1mbHVpZCAub2Zmc2V0NzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo1OS41NzQ0NjgwODUxMDYzNzUlOyptYXJnaW4tbGVmdDo1OS40NjgwODUxMDYzODI5NyV9LnJvdy1mbHVpZCAub2Zmc2V0NnttYXJnaW4tbGVmdDo1My4xOTE0ODkzNjE3MDIxMjUlOyptYXJnaW4tbGVmdDo1My4wODUxMDYzODI5Nzg3MTUlfS5yb3ctZmx1aWQgLm9mZnNldDY6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTEuMDYzODI5Nzg3MjM0MDM1JTsqbWFyZ2luLWxlZnQ6NTAuOTU3NDQ2ODA4NTEwNjMlfS5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDQuNjgwODUxMDYzODI5NzklOyptYXJnaW4tbGVmdDo0NC41NzQ0NjgwODUxMDYzOCV9LnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi41NTMxOTE0ODkzNjE3JTsqbWFyZ2luLWxlZnQ6NDIuNDQ2ODA4NTEwNjM4MyV9LnJvdy1mbHVpZCAub2Zmc2V0NHttYXJnaW4tbGVmdDozNi4xNzAyMTI3NjU5NTc0NDQlOyptYXJnaW4tbGVmdDozNi4wNjM4Mjk3ODcyMzQwNSV9LnJvdy1mbHVpZCAub2Zmc2V0NDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDozNC4wNDI1NTMxOTE0ODkzNiU7Km1hcmdpbi1sZWZ0OjMzLjkzNjE3MDIxMjc2NTk2JX0ucm93LWZsdWlkIC5vZmZzZXQze21hcmdpbi1sZWZ0OjI3LjY1OTU3NDQ2ODA4NTEwNCU7Km1hcmdpbi1sZWZ0OjI3LjU1MzE5MTQ4OTM2MTclfS5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNTMxOTE0ODkzNjE3MDIlOyptYXJnaW4tbGVmdDoyNS40MjU1MzE5MTQ4OTM2MTglfS5yb3ctZmx1aWQgLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTkuMTQ4OTM2MTcwMjEyNzY0JTsqbWFyZ2luLWxlZnQ6MTkuMDQyNTUzMTkxNDg5MzYlfS5yb3ctZmx1aWQgLm9mZnNldDI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTcuMDIxMjc2NTk1NzQ0NjglOyptYXJnaW4tbGVmdDoxNi45MTQ4OTM2MTcwMjEyNzglfS5yb3ctZmx1aWQgLm9mZnNldDF7bWFyZ2luLWxlZnQ6MTAuNjM4Mjk3ODcyMzQwNDI1JTsqbWFyZ2luLWxlZnQ6MTAuNTMxOTE0ODkzNjE3MDIlfS5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41MTA2MzgyOTc4NzIzNCU7Km1hcmdpbi1sZWZ0OjguNDA0MjU1MzE5MTQ4OTM4JX1bY2xhc3MqPSJzcGFuIl0uaGlkZSwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXS5oaWRle2Rpc3BsYXk6bm9uZX1bY2xhc3MqPSJzcGFuIl0ucHVsbC1yaWdodCwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXS5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0fS5jb250YWluZXJ7bWFyZ2luLXJpZ2h0OmF1dG87bWFyZ2luLWxlZnQ6YXV0bzsqem9vbToxfS5jb250YWluZXI6YmVmb3JlLC5jb250YWluZXI6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LmNvbnRhaW5lcjphZnRlcntjbGVhcjpib3RofS5jb250YWluZXItZmx1aWR7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctbGVmdDoyMHB4Oyp6b29tOjF9LmNvbnRhaW5lci1mbHVpZDpiZWZvcmUsLmNvbnRhaW5lci1mbHVpZDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0uY29udGFpbmVyLWZsdWlkOmFmdGVye2NsZWFyOmJvdGh9cHttYXJnaW46MCAwIDEwcHh9LmxlYWR7bWFyZ2luLWJvdHRvbToyMHB4O2ZvbnQtc2l6ZToyMXB4O2ZvbnQtd2VpZ2h0OjIwMDtsaW5lLWhlaWdodDozMHB4fXNtYWxse2ZvbnQtc2l6ZTo4NSV9c3Ryb25ne2ZvbnQtd2VpZ2h0OmJvbGR9ZW17Zm9udC1zdHlsZTppdGFsaWN9Y2l0ZXtmb250LXN0eWxlOm5vcm1hbH0ubXV0ZWR7Y29sb3I6Izk5OX1hLm11dGVkOmhvdmVye2NvbG9yOiM4MDgwODB9LnRleHQtd2FybmluZ3tjb2xvcjojYzA5ODUzfWEudGV4dC13YXJuaW5nOmhvdmVye2NvbG9yOiNhNDdlM2N9LnRleHQtZXJyb3J7Y29sb3I6I2I5NGE0OH1hLnRleHQtZXJyb3I6aG92ZXJ7Y29sb3I6Izk1M2IzOX0udGV4dC1pbmZve2NvbG9yOiMzYTg3YWR9YS50ZXh0LWluZm86aG92ZXJ7Y29sb3I6IzJkNjk4N30udGV4dC1zdWNjZXNze2NvbG9yOiM0Njg4NDd9YS50ZXh0LXN1Y2Nlc3M6aG92ZXJ7Y29sb3I6IzM1NjYzNX1oMSxoMixoMyxoNCxoNSxoNnttYXJnaW46MTBweCAwO2ZvbnQtZmFtaWx5OmluaGVyaXQ7Zm9udC13ZWlnaHQ6Ym9sZDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOmluaGVyaXQ7dGV4dC1yZW5kZXJpbmc6b3B0aW1pemVsZWdpYmlsaXR5fWgxIHNtYWxsLGgyIHNtYWxsLGgzIHNtYWxsLGg0IHNtYWxsLGg1IHNtYWxsLGg2IHNtYWxse2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoxO2NvbG9yOiM5OTl9aDEsaDIsaDN7bGluZS1oZWlnaHQ6NDBweH1oMXtmb250LXNpemU6MzguNXB4fWgye2ZvbnQtc2l6ZTozMS41cHh9aDN7Zm9udC1zaXplOjI0LjVweH1oNHtmb250LXNpemU6MTcuNXB4fWg1e2ZvbnQtc2l6ZToxNHB4fWg2e2ZvbnQtc2l6ZToxMS45cHh9aDEgc21hbGx7Zm9udC1zaXplOjI0LjVweH1oMiBzbWFsbHtmb250LXNpemU6MTcuNXB4fWgzIHNtYWxse2ZvbnQtc2l6ZToxNHB4fWg0IHNtYWxse2ZvbnQtc2l6ZToxNHB4fS5wYWdlLWhlYWRlcntwYWRkaW5nLWJvdHRvbTo5cHg7bWFyZ2luOjIwcHggMCAzMHB4O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNlZWV9dWwsb2x7cGFkZGluZzowO21hcmdpbjowIDAgMTBweCAyNXB4fXVsIHVsLHVsIG9sLG9sIG9sLG9sIHVse21hcmdpbi1ib3R0b206MH1saXtsaW5lLWhlaWdodDoyMHB4fXVsLnVuc3R5bGVkLG9sLnVuc3R5bGVke21hcmdpbi1sZWZ0OjA7bGlzdC1zdHlsZTpub25lfXVsLmlubGluZSxvbC5pbmxpbmV7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmV9dWwuaW5saW5lPmxpLG9sLmlubGluZT5saXtkaXNwbGF5OmlubGluZS1ibG9jaztwYWRkaW5nLXJpZ2h0OjVweDtwYWRkaW5nLWxlZnQ6NXB4fWRse21hcmdpbi1ib3R0b206MjBweH1kdCxkZHtsaW5lLWhlaWdodDoyMHB4fWR0e2ZvbnQtd2VpZ2h0OmJvbGR9ZGR7bWFyZ2luLWxlZnQ6MTBweH0uZGwtaG9yaXpvbnRhbHsqem9vbToxfS5kbC1ob3Jpem9udGFsOmJlZm9yZSwuZGwtaG9yaXpvbnRhbDphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0uZGwtaG9yaXpvbnRhbDphZnRlcntjbGVhcjpib3RofS5kbC1ob3Jpem9udGFsIGR0e2Zsb2F0OmxlZnQ7d2lkdGg6MTYwcHg7b3ZlcmZsb3c6aGlkZGVuO2NsZWFyOmxlZnQ7dGV4dC1hbGlnbjpyaWdodDt0ZXh0LW92ZXJmbG93OmVsbGlwc2lzO3doaXRlLXNwYWNlOm5vd3JhcH0uZGwtaG9yaXpvbnRhbCBkZHttYXJnaW4tbGVmdDoxODBweH1ocnttYXJnaW46MjBweCAwO2JvcmRlcjowO2JvcmRlci10b3A6MXB4IHNvbGlkICNlZWU7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2ZmZn1hYmJyW3RpdGxlXSxhYmJyW2RhdGEtb3JpZ2luYWwtdGl0bGVde2N1cnNvcjpoZWxwO2JvcmRlci1ib3R0b206MXB4IGRvdHRlZCAjOTk5fWFiYnIuaW5pdGlhbGlzbXtmb250LXNpemU6OTAlO3RleHQtdHJhbnNmb3JtOnVwcGVyY2FzZX1ibG9ja3F1b3Rle3BhZGRpbmc6MCAwIDAgMTVweDttYXJnaW46MCAwIDIwcHg7Ym9yZGVyLWxlZnQ6NXB4IHNvbGlkICNlZWV9YmxvY2txdW90ZSBwe21hcmdpbi1ib3R0b206MDtmb250LXNpemU6MTZweDtmb250LXdlaWdodDozMDA7bGluZS1oZWlnaHQ6MjVweH1ibG9ja3F1b3RlIHNtYWxse2Rpc3BsYXk6YmxvY2s7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojOTk5fWJsb2NrcXVvdGUgc21hbGw6YmVmb3Jle2NvbnRlbnQ6J1wyMDE0IFwwMEEwJ31ibG9ja3F1b3RlLnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHQ7cGFkZGluZy1yaWdodDoxNXB4O3BhZGRpbmctbGVmdDowO2JvcmRlci1yaWdodDo1cHggc29saWQgI2VlZTtib3JkZXItbGVmdDowfWJsb2NrcXVvdGUucHVsbC1yaWdodCBwLGJsb2NrcXVvdGUucHVsbC1yaWdodCBzbWFsbHt0ZXh0LWFsaWduOnJpZ2h0fWJsb2NrcXVvdGUucHVsbC1yaWdodCBzbWFsbDpiZWZvcmV7Y29udGVudDonJ31ibG9ja3F1b3RlLnB1bGwtcmlnaHQgc21hbGw6YWZ0ZXJ7Y29udGVudDonXDAwQTAgXDIwMTQnfXE6YmVmb3JlLHE6YWZ0ZXIsYmxvY2txdW90ZTpiZWZvcmUsYmxvY2txdW90ZTphZnRlcntjb250ZW50OiIifWFkZHJlc3N7ZGlzcGxheTpibG9jazttYXJnaW4tYm90dG9tOjIwcHg7Zm9udC1zdHlsZTpub3JtYWw7bGluZS1oZWlnaHQ6MjBweH1jb2RlLHByZXtwYWRkaW5nOjAgM3B4IDJweDtmb250LWZhbWlseTpNb25hY28sTWVubG8sQ29uc29sYXMsIkNvdXJpZXIgTmV3Iixtb25vc3BhY2U7Zm9udC1zaXplOjEycHg7Y29sb3I6IzMzMzstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHh9Y29kZXtwYWRkaW5nOjJweCA0cHg7Y29sb3I6I2QxNDt3aGl0ZS1zcGFjZTpub3dyYXA7YmFja2dyb3VuZC1jb2xvcjojZjdmN2Y5O2JvcmRlcjoxcHggc29saWQgI2UxZTFlOH1wcmV7ZGlzcGxheTpibG9jaztwYWRkaW5nOjkuNXB4O21hcmdpbjowIDAgMTBweDtmb250LXNpemU6MTNweDtsaW5lLWhlaWdodDoyMHB4O3dvcmQtYnJlYWs6YnJlYWstYWxsO3dvcmQtd3JhcDpicmVhay13b3JkO3doaXRlLXNwYWNlOnByZTt3aGl0ZS1zcGFjZTpwcmUtd3JhcDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyOjFweCBzb2xpZCAjY2NjO2JvcmRlcjoxcHggc29saWQgcmdiYSgwLDAsMCwwLjE1KTstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHh9cHJlLnByZXR0eXByaW50e21hcmdpbi1ib3R0b206MjBweH1wcmUgY29kZXtwYWRkaW5nOjA7Y29sb3I6aW5oZXJpdDt3aGl0ZS1zcGFjZTpwcmU7d2hpdGUtc3BhY2U6cHJlLXdyYXA7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXI6MH0ucHJlLXNjcm9sbGFibGV7bWF4LWhlaWdodDozNDBweDtvdmVyZmxvdy15OnNjcm9sbH1mb3Jte21hcmdpbjowIDAgMjBweH1maWVsZHNldHtwYWRkaW5nOjA7bWFyZ2luOjA7Ym9yZGVyOjB9bGVnZW5ke2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTtwYWRkaW5nOjA7bWFyZ2luLWJvdHRvbToyMHB4O2ZvbnQtc2l6ZToyMXB4O2xpbmUtaGVpZ2h0OjQwcHg7Y29sb3I6IzMzMztib3JkZXI6MDtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZTVlNWU1fWxlZ2VuZCBzbWFsbHtmb250LXNpemU6MTVweDtjb2xvcjojOTk5fWxhYmVsLGlucHV0LGJ1dHRvbixzZWxlY3QsdGV4dGFyZWF7Zm9udC1zaXplOjE0cHg7Zm9udC13ZWlnaHQ6bm9ybWFsO2xpbmUtaGVpZ2h0OjIwcHh9aW5wdXQsYnV0dG9uLHNlbGVjdCx0ZXh0YXJlYXtmb250LWZhbWlseToiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxBcmlhbCxzYW5zLXNlcmlmfWxhYmVse2Rpc3BsYXk6YmxvY2s7bWFyZ2luLWJvdHRvbTo1cHh9c2VsZWN0LHRleHRhcmVhLGlucHV0W3R5cGU9InRleHQiXSxpbnB1dFt0eXBlPSJwYXNzd29yZCJdLGlucHV0W3R5cGU9ImRhdGV0aW1lIl0saW5wdXRbdHlwZT0iZGF0ZXRpbWUtbG9jYWwiXSxpbnB1dFt0eXBlPSJkYXRlIl0saW5wdXRbdHlwZT0ibW9udGgiXSxpbnB1dFt0eXBlPSJ0aW1lIl0saW5wdXRbdHlwZT0id2VlayJdLGlucHV0W3R5cGU9Im51bWJlciJdLGlucHV0W3R5cGU9ImVtYWlsIl0saW5wdXRbdHlwZT0idXJsIl0saW5wdXRbdHlwZT0ic2VhcmNoIl0saW5wdXRbdHlwZT0idGVsIl0saW5wdXRbdHlwZT0iY29sb3IiXSwudW5lZGl0YWJsZS1pbnB1dHtkaXNwbGF5OmlubGluZS1ibG9jaztoZWlnaHQ6MjBweDtwYWRkaW5nOjRweCA2cHg7bWFyZ2luLWJvdHRvbToxMHB4O2ZvbnQtc2l6ZToxNHB4O2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6IzU1NTt2ZXJ0aWNhbC1hbGlnbjptaWRkbGU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fWlucHV0LHRleHRhcmVhLC51bmVkaXRhYmxlLWlucHV0e3dpZHRoOjIwNnB4fXRleHRhcmVhe2hlaWdodDphdXRvfXRleHRhcmVhLGlucHV0W3R5cGU9InRleHQiXSxpbnB1dFt0eXBlPSJwYXNzd29yZCJdLGlucHV0W3R5cGU9ImRhdGV0aW1lIl0saW5wdXRbdHlwZT0iZGF0ZXRpbWUtbG9jYWwiXSxpbnB1dFt0eXBlPSJkYXRlIl0saW5wdXRbdHlwZT0ibW9udGgiXSxpbnB1dFt0eXBlPSJ0aW1lIl0saW5wdXRbdHlwZT0id2VlayJdLGlucHV0W3R5cGU9Im51bWJlciJdLGlucHV0W3R5cGU9ImVtYWlsIl0saW5wdXRbdHlwZT0idXJsIl0saW5wdXRbdHlwZT0ic2VhcmNoIl0saW5wdXRbdHlwZT0idGVsIl0saW5wdXRbdHlwZT0iY29sb3IiXSwudW5lZGl0YWJsZS1pbnB1dHtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjY2NjOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTstd2Via2l0LXRyYW5zaXRpb246Ym9yZGVyIGxpbmVhciAuMnMsYm94LXNoYWRvdyBsaW5lYXIgLjJzOy1tb3otdHJhbnNpdGlvbjpib3JkZXIgbGluZWFyIC4ycyxib3gtc2hhZG93IGxpbmVhciAuMnM7LW8tdHJhbnNpdGlvbjpib3JkZXIgbGluZWFyIC4ycyxib3gtc2hhZG93IGxpbmVhciAuMnM7dHJhbnNpdGlvbjpib3JkZXIgbGluZWFyIC4ycyxib3gtc2hhZG93IGxpbmVhciAuMnN9dGV4dGFyZWE6Zm9jdXMsaW5wdXRbdHlwZT0idGV4dCJdOmZvY3VzLGlucHV0W3R5cGU9InBhc3N3b3JkIl06Zm9jdXMsaW5wdXRbdHlwZT0iZGF0ZXRpbWUiXTpmb2N1cyxpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdOmZvY3VzLGlucHV0W3R5cGU9ImRhdGUiXTpmb2N1cyxpbnB1dFt0eXBlPSJtb250aCJdOmZvY3VzLGlucHV0W3R5cGU9InRpbWUiXTpmb2N1cyxpbnB1dFt0eXBlPSJ3ZWVrIl06Zm9jdXMsaW5wdXRbdHlwZT0ibnVtYmVyIl06Zm9jdXMsaW5wdXRbdHlwZT0iZW1haWwiXTpmb2N1cyxpbnB1dFt0eXBlPSJ1cmwiXTpmb2N1cyxpbnB1dFt0eXBlPSJzZWFyY2giXTpmb2N1cyxpbnB1dFt0eXBlPSJ0ZWwiXTpmb2N1cyxpbnB1dFt0eXBlPSJjb2xvciJdOmZvY3VzLC51bmVkaXRhYmxlLWlucHV0OmZvY3Vze2JvcmRlci1jb2xvcjpyZ2JhKDgyLDE2OCwyMzYsMC44KTtvdXRsaW5lOjA7b3V0bGluZTp0aGluIGRvdHRlZCBcOTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA4cHggcmdiYSg4MiwxNjgsMjM2LDAuNik7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgOHB4IHJnYmEoODIsMTY4LDIzNiwwLjYpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA4cHggcmdiYSg4MiwxNjgsMjM2LDAuNil9aW5wdXRbdHlwZT0icmFkaW8iXSxpbnB1dFt0eXBlPSJjaGVja2JveCJde21hcmdpbjo0cHggMCAwO21hcmdpbi10b3A6MXB4IFw5OyptYXJnaW4tdG9wOjA7bGluZS1oZWlnaHQ6bm9ybWFsfWlucHV0W3R5cGU9ImZpbGUiXSxpbnB1dFt0eXBlPSJpbWFnZSJdLGlucHV0W3R5cGU9InN1Ym1pdCJdLGlucHV0W3R5cGU9InJlc2V0Il0saW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmFkaW8iXSxpbnB1dFt0eXBlPSJjaGVja2JveCJde3dpZHRoOmF1dG99c2VsZWN0LGlucHV0W3R5cGU9ImZpbGUiXXtoZWlnaHQ6MzBweDsqbWFyZ2luLXRvcDo0cHg7bGluZS1oZWlnaHQ6MzBweH1zZWxlY3R7d2lkdGg6MjIwcHg7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2NjY31zZWxlY3RbbXVsdGlwbGVdLHNlbGVjdFtzaXplXXtoZWlnaHQ6YXV0b31zZWxlY3Q6Zm9jdXMsaW5wdXRbdHlwZT0iZmlsZSJdOmZvY3VzLGlucHV0W3R5cGU9InJhZGlvIl06Zm9jdXMsaW5wdXRbdHlwZT0iY2hlY2tib3giXTpmb2N1c3tvdXRsaW5lOnRoaW4gZG90dGVkICMzMzM7b3V0bGluZTo1cHggYXV0byAtd2Via2l0LWZvY3VzLXJpbmctY29sb3I7b3V0bGluZS1vZmZzZXQ6LTJweH0udW5lZGl0YWJsZS1pbnB1dCwudW5lZGl0YWJsZS10ZXh0YXJlYXtjb2xvcjojOTk5O2N1cnNvcjpub3QtYWxsb3dlZDtiYWNrZ3JvdW5kLWNvbG9yOiNmY2ZjZmM7Ym9yZGVyLWNvbG9yOiNjY2M7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDI1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wMjUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wMjUpfS51bmVkaXRhYmxlLWlucHV0e292ZXJmbG93OmhpZGRlbjt3aGl0ZS1zcGFjZTpub3dyYXB9LnVuZWRpdGFibGUtdGV4dGFyZWF7d2lkdGg6YXV0bztoZWlnaHQ6YXV0b31pbnB1dDotbW96LXBsYWNlaG9sZGVyLHRleHRhcmVhOi1tb3otcGxhY2Vob2xkZXJ7Y29sb3I6Izk5OX1pbnB1dDotbXMtaW5wdXQtcGxhY2Vob2xkZXIsdGV4dGFyZWE6LW1zLWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiM5OTl9aW5wdXQ6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXIsdGV4dGFyZWE6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXJ7Y29sb3I6Izk5OX0ucmFkaW8sLmNoZWNrYm94e21pbi1oZWlnaHQ6MjBweDtwYWRkaW5nLWxlZnQ6MjBweH0ucmFkaW8gaW5wdXRbdHlwZT0icmFkaW8iXSwuY2hlY2tib3ggaW5wdXRbdHlwZT0iY2hlY2tib3giXXtmbG9hdDpsZWZ0O21hcmdpbi1sZWZ0Oi0yMHB4fS5jb250cm9scz4ucmFkaW86Zmlyc3QtY2hpbGQsLmNvbnRyb2xzPi5jaGVja2JveDpmaXJzdC1jaGlsZHtwYWRkaW5nLXRvcDo1cHh9LnJhZGlvLmlubGluZSwuY2hlY2tib3guaW5saW5le2Rpc3BsYXk6aW5saW5lLWJsb2NrO3BhZGRpbmctdG9wOjVweDttYXJnaW4tYm90dG9tOjA7dmVydGljYWwtYWxpZ246bWlkZGxlfS5yYWRpby5pbmxpbmUrLnJhZGlvLmlubGluZSwuY2hlY2tib3guaW5saW5lKy5jaGVja2JveC5pbmxpbmV7bWFyZ2luLWxlZnQ6MTBweH0uaW5wdXQtbWluaXt3aWR0aDo2MHB4fS5pbnB1dC1zbWFsbHt3aWR0aDo5MHB4fS5pbnB1dC1tZWRpdW17d2lkdGg6MTUwcHh9LmlucHV0LWxhcmdle3dpZHRoOjIxMHB4fS5pbnB1dC14bGFyZ2V7d2lkdGg6MjcwcHh9LmlucHV0LXh4bGFyZ2V7d2lkdGg6NTMwcHh9aW5wdXRbY2xhc3MqPSJzcGFuIl0sc2VsZWN0W2NsYXNzKj0ic3BhbiJdLHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCBzZWxlY3RbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0ZXh0YXJlYVtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJde2Zsb2F0Om5vbmU7bWFyZ2luLWxlZnQ6MH0uaW5wdXQtYXBwZW5kIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXRbY2xhc3MqPSJzcGFuIl0sLmlucHV0LXByZXBlbmQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCBpbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIHNlbGVjdFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLnVuZWRpdGFibGUtaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAuaW5wdXQtcHJlcGVuZCBbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAuaW5wdXQtYXBwZW5kIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmlubGluZS1ibG9ja31pbnB1dCx0ZXh0YXJlYSwudW5lZGl0YWJsZS1pbnB1dHttYXJnaW4tbGVmdDowfS5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyMHB4fWlucHV0LnNwYW4xMix0ZXh0YXJlYS5zcGFuMTIsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEye3dpZHRoOjkyNnB4fWlucHV0LnNwYW4xMSx0ZXh0YXJlYS5zcGFuMTEsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjExe3dpZHRoOjg0NnB4fWlucHV0LnNwYW4xMCx0ZXh0YXJlYS5zcGFuMTAsLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEwe3dpZHRoOjc2NnB4fWlucHV0LnNwYW45LHRleHRhcmVhLnNwYW45LC51bmVkaXRhYmxlLWlucHV0LnNwYW45e3dpZHRoOjY4NnB4fWlucHV0LnNwYW44LHRleHRhcmVhLnNwYW44LC51bmVkaXRhYmxlLWlucHV0LnNwYW44e3dpZHRoOjYwNnB4fWlucHV0LnNwYW43LHRleHRhcmVhLnNwYW43LC51bmVkaXRhYmxlLWlucHV0LnNwYW43e3dpZHRoOjUyNnB4fWlucHV0LnNwYW42LHRleHRhcmVhLnNwYW42LC51bmVkaXRhYmxlLWlucHV0LnNwYW42e3dpZHRoOjQ0NnB4fWlucHV0LnNwYW41LHRleHRhcmVhLnNwYW41LC51bmVkaXRhYmxlLWlucHV0LnNwYW41e3dpZHRoOjM2NnB4fWlucHV0LnNwYW40LHRleHRhcmVhLnNwYW40LC51bmVkaXRhYmxlLWlucHV0LnNwYW40e3dpZHRoOjI4NnB4fWlucHV0LnNwYW4zLHRleHRhcmVhLnNwYW4zLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ze3dpZHRoOjIwNnB4fWlucHV0LnNwYW4yLHRleHRhcmVhLnNwYW4yLC51bmVkaXRhYmxlLWlucHV0LnNwYW4ye3dpZHRoOjEyNnB4fWlucHV0LnNwYW4xLHRleHRhcmVhLnNwYW4xLC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjQ2cHh9LmNvbnRyb2xzLXJvd3sqem9vbToxfS5jb250cm9scy1yb3c6YmVmb3JlLC5jb250cm9scy1yb3c6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LmNvbnRyb2xzLXJvdzphZnRlcntjbGVhcjpib3RofS5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLmNvbnRyb2xzLXJvdyBbY2xhc3MqPSJzcGFuIl17ZmxvYXQ6bGVmdH0uY29udHJvbHMtcm93IC5jaGVja2JveFtjbGFzcyo9InNwYW4iXSwuY29udHJvbHMtcm93IC5yYWRpb1tjbGFzcyo9InNwYW4iXXtwYWRkaW5nLXRvcDo1cHh9aW5wdXRbZGlzYWJsZWRdLHNlbGVjdFtkaXNhYmxlZF0sdGV4dGFyZWFbZGlzYWJsZWRdLGlucHV0W3JlYWRvbmx5XSxzZWxlY3RbcmVhZG9ubHldLHRleHRhcmVhW3JlYWRvbmx5XXtjdXJzb3I6bm90LWFsbG93ZWQ7YmFja2dyb3VuZC1jb2xvcjojZWVlfWlucHV0W3R5cGU9InJhZGlvIl1bZGlzYWJsZWRdLGlucHV0W3R5cGU9ImNoZWNrYm94Il1bZGlzYWJsZWRdLGlucHV0W3R5cGU9InJhZGlvIl1bcmVhZG9ubHldLGlucHV0W3R5cGU9ImNoZWNrYm94Il1bcmVhZG9ubHlde2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnR9LmNvbnRyb2wtZ3JvdXAud2FybmluZyAuY29udHJvbC1sYWJlbCwuY29udHJvbC1ncm91cC53YXJuaW5nIC5oZWxwLWJsb2NrLC5jb250cm9sLWdyb3VwLndhcm5pbmcgLmhlbHAtaW5saW5le2NvbG9yOiNjMDk4NTN9LmNvbnRyb2wtZ3JvdXAud2FybmluZyAuY2hlY2tib3gsLmNvbnRyb2wtZ3JvdXAud2FybmluZyAucmFkaW8sLmNvbnRyb2wtZ3JvdXAud2FybmluZyBpbnB1dCwuY29udHJvbC1ncm91cC53YXJuaW5nIHNlbGVjdCwuY29udHJvbC1ncm91cC53YXJuaW5nIHRleHRhcmVhe2NvbG9yOiNjMDk4NTN9LmNvbnRyb2wtZ3JvdXAud2FybmluZyBpbnB1dCwuY29udHJvbC1ncm91cC53YXJuaW5nIHNlbGVjdCwuY29udHJvbC1ncm91cC53YXJuaW5nIHRleHRhcmVhe2JvcmRlci1jb2xvcjojYzA5ODUzOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KX0uY29udHJvbC1ncm91cC53YXJuaW5nIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLndhcm5pbmcgc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLndhcm5pbmcgdGV4dGFyZWE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiNhNDdlM2M7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICNkYmM1OWU7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICNkYmM1OWU7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjZGJjNTllfS5jb250cm9sLWdyb3VwLndhcm5pbmcgLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC53YXJuaW5nIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojYzA5ODUzO2JhY2tncm91bmQtY29sb3I6I2ZjZjhlMztib3JkZXItY29sb3I6I2MwOTg1M30uY29udHJvbC1ncm91cC5lcnJvciAuY29udHJvbC1sYWJlbCwuY29udHJvbC1ncm91cC5lcnJvciAuaGVscC1ibG9jaywuY29udHJvbC1ncm91cC5lcnJvciAuaGVscC1pbmxpbmV7Y29sb3I6I2I5NGE0OH0uY29udHJvbC1ncm91cC5lcnJvciAuY2hlY2tib3gsLmNvbnRyb2wtZ3JvdXAuZXJyb3IgLnJhZGlvLC5jb250cm9sLWdyb3VwLmVycm9yIGlucHV0LC5jb250cm9sLWdyb3VwLmVycm9yIHNlbGVjdCwuY29udHJvbC1ncm91cC5lcnJvciB0ZXh0YXJlYXtjb2xvcjojYjk0YTQ4fS5jb250cm9sLWdyb3VwLmVycm9yIGlucHV0LC5jb250cm9sLWdyb3VwLmVycm9yIHNlbGVjdCwuY29udHJvbC1ncm91cC5lcnJvciB0ZXh0YXJlYXtib3JkZXItY29sb3I6I2I5NGE0ODstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSl9LmNvbnRyb2wtZ3JvdXAuZXJyb3IgaW5wdXQ6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAuZXJyb3Igc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLmVycm9yIHRleHRhcmVhOmZvY3Vze2JvcmRlci1jb2xvcjojOTUzYjM5Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjZDU5MzkyOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjZDU5MzkyO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggI2Q1OTM5Mn0uY29udHJvbC1ncm91cC5lcnJvciAuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5jb250cm9sLWdyb3VwLmVycm9yIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojYjk0YTQ4O2JhY2tncm91bmQtY29sb3I6I2YyZGVkZTtib3JkZXItY29sb3I6I2I5NGE0OH0uY29udHJvbC1ncm91cC5zdWNjZXNzIC5jb250cm9sLWxhYmVsLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmhlbHAtYmxvY2ssLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuaGVscC1pbmxpbmV7Y29sb3I6IzQ2ODg0N30uY29udHJvbC1ncm91cC5zdWNjZXNzIC5jaGVja2JveCwuY29udHJvbC1ncm91cC5zdWNjZXNzIC5yYWRpbywuY29udHJvbC1ncm91cC5zdWNjZXNzIGlucHV0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3Mgc2VsZWN0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgdGV4dGFyZWF7Y29sb3I6IzQ2ODg0N30uY29udHJvbC1ncm91cC5zdWNjZXNzIGlucHV0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3Mgc2VsZWN0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgdGV4dGFyZWF7Ym9yZGVyLWNvbG9yOiM0Njg4NDc7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpfS5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgaW5wdXQ6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyBzZWxlY3Q6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyB0ZXh0YXJlYTpmb2N1c3tib3JkZXItY29sb3I6IzM1NjYzNTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggIzdhYmE3YjstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggIzdhYmE3Yjtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDc1KSwwIDAgNnB4ICM3YWJhN2J9LmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmlucHV0LWFwcGVuZCAuYWRkLW9ue2NvbG9yOiM0Njg4NDc7YmFja2dyb3VuZC1jb2xvcjojZGZmMGQ4O2JvcmRlci1jb2xvcjojNDY4ODQ3fS5jb250cm9sLWdyb3VwLmluZm8gLmNvbnRyb2wtbGFiZWwsLmNvbnRyb2wtZ3JvdXAuaW5mbyAuaGVscC1ibG9jaywuY29udHJvbC1ncm91cC5pbmZvIC5oZWxwLWlubGluZXtjb2xvcjojM2E4N2FkfS5jb250cm9sLWdyb3VwLmluZm8gLmNoZWNrYm94LC5jb250cm9sLWdyb3VwLmluZm8gLnJhZGlvLC5jb250cm9sLWdyb3VwLmluZm8gaW5wdXQsLmNvbnRyb2wtZ3JvdXAuaW5mbyBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAuaW5mbyB0ZXh0YXJlYXtjb2xvcjojM2E4N2FkfS5jb250cm9sLWdyb3VwLmluZm8gaW5wdXQsLmNvbnRyb2wtZ3JvdXAuaW5mbyBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAuaW5mbyB0ZXh0YXJlYXtib3JkZXItY29sb3I6IzNhODdhZDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSl9LmNvbnRyb2wtZ3JvdXAuaW5mbyBpbnB1dDpmb2N1cywuY29udHJvbC1ncm91cC5pbmZvIHNlbGVjdDpmb2N1cywuY29udHJvbC1ncm91cC5pbmZvIHRleHRhcmVhOmZvY3Vze2JvcmRlci1jb2xvcjojMmQ2OTg3Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjN2FiNWQzOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLDAsMCwwLjA3NSksMCAwIDZweCAjN2FiNWQzO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNzUpLDAgMCA2cHggIzdhYjVkM30uY29udHJvbC1ncm91cC5pbmZvIC5pbnB1dC1wcmVwZW5kIC5hZGQtb24sLmNvbnRyb2wtZ3JvdXAuaW5mbyAuaW5wdXQtYXBwZW5kIC5hZGQtb257Y29sb3I6IzNhODdhZDtiYWNrZ3JvdW5kLWNvbG9yOiNkOWVkZjc7Ym9yZGVyLWNvbG9yOiMzYTg3YWR9aW5wdXQ6Zm9jdXM6aW52YWxpZCx0ZXh0YXJlYTpmb2N1czppbnZhbGlkLHNlbGVjdDpmb2N1czppbnZhbGlke2NvbG9yOiNiOTRhNDg7Ym9yZGVyLWNvbG9yOiNlZTVmNWJ9aW5wdXQ6Zm9jdXM6aW52YWxpZDpmb2N1cyx0ZXh0YXJlYTpmb2N1czppbnZhbGlkOmZvY3VzLHNlbGVjdDpmb2N1czppbnZhbGlkOmZvY3Vze2JvcmRlci1jb2xvcjojZTkzMjJkOy13ZWJraXQtYm94LXNoYWRvdzowIDAgNnB4ICNmOGI5Yjc7LW1vei1ib3gtc2hhZG93OjAgMCA2cHggI2Y4YjliNztib3gtc2hhZG93OjAgMCA2cHggI2Y4YjliN30uZm9ybS1hY3Rpb25ze3BhZGRpbmc6MTlweCAyMHB4IDIwcHg7bWFyZ2luLXRvcDoyMHB4O21hcmdpbi1ib3R0b206MjBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyLXRvcDoxcHggc29saWQgI2U1ZTVlNTsqem9vbToxfS5mb3JtLWFjdGlvbnM6YmVmb3JlLC5mb3JtLWFjdGlvbnM6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LmZvcm0tYWN0aW9uczphZnRlcntjbGVhcjpib3RofS5oZWxwLWJsb2NrLC5oZWxwLWlubGluZXtjb2xvcjojNTk1OTU5fS5oZWxwLWJsb2Nre2Rpc3BsYXk6YmxvY2s7bWFyZ2luLWJvdHRvbToxMHB4fS5oZWxwLWlubGluZXtkaXNwbGF5OmlubGluZS1ibG9jazsqZGlzcGxheTppbmxpbmU7cGFkZGluZy1sZWZ0OjVweDt2ZXJ0aWNhbC1hbGlnbjptaWRkbGU7Knpvb206MX0uaW5wdXQtYXBwZW5kLC5pbnB1dC1wcmVwZW5ke21hcmdpbi1ib3R0b206NXB4O2ZvbnQtc2l6ZTowO3doaXRlLXNwYWNlOm5vd3JhcH0uaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1wcmVwZW5kIHNlbGVjdCwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0LC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0LC5pbnB1dC1hcHBlbmQgLmRyb3Bkb3duLW1lbnUsLmlucHV0LXByZXBlbmQgLmRyb3Bkb3duLW1lbnV7Zm9udC1zaXplOjE0cHh9LmlucHV0LWFwcGVuZCBpbnB1dCwuaW5wdXQtcHJlcGVuZCBpbnB1dCwuaW5wdXQtYXBwZW5kIHNlbGVjdCwuaW5wdXQtcHJlcGVuZCBzZWxlY3QsLmlucHV0LWFwcGVuZCAudW5lZGl0YWJsZS1pbnB1dCwuaW5wdXQtcHJlcGVuZCAudW5lZGl0YWJsZS1pbnB1dHtwb3NpdGlvbjpyZWxhdGl2ZTttYXJnaW4tYm90dG9tOjA7Km1hcmdpbi1sZWZ0OjA7dmVydGljYWwtYWxpZ246dG9wOy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH0uaW5wdXQtYXBwZW5kIGlucHV0OmZvY3VzLC5pbnB1dC1wcmVwZW5kIGlucHV0OmZvY3VzLC5pbnB1dC1hcHBlbmQgc2VsZWN0OmZvY3VzLC5pbnB1dC1wcmVwZW5kIHNlbGVjdDpmb2N1cywuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0OmZvY3VzLC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0OmZvY3Vze3otaW5kZXg6Mn0uaW5wdXQtYXBwZW5kIC5hZGQtb24sLmlucHV0LXByZXBlbmQgLmFkZC1vbntkaXNwbGF5OmlubGluZS1ibG9jazt3aWR0aDphdXRvO2hlaWdodDoyMHB4O21pbi13aWR0aDoxNnB4O3BhZGRpbmc6NHB4IDVweDtmb250LXNpemU6MTRweDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MjBweDt0ZXh0LWFsaWduOmNlbnRlcjt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmY7YmFja2dyb3VuZC1jb2xvcjojZWVlO2JvcmRlcjoxcHggc29saWQgI2NjY30uaW5wdXQtYXBwZW5kIC5hZGQtb24sLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuaW5wdXQtYXBwZW5kIC5idG4sLmlucHV0LXByZXBlbmQgLmJ0biwuaW5wdXQtYXBwZW5kIC5idG4tZ3JvdXA+LmRyb3Bkb3duLXRvZ2dsZSwuaW5wdXQtcHJlcGVuZCAuYnRuLWdyb3VwPi5kcm9wZG93bi10b2dnbGV7dmVydGljYWwtYWxpZ246dG9wOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MH0uaW5wdXQtYXBwZW5kIC5hY3RpdmUsLmlucHV0LXByZXBlbmQgLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNhOWRiYTk7Ym9yZGVyLWNvbG9yOiM0NmE1NDZ9LmlucHV0LXByZXBlbmQgLmFkZC1vbiwuaW5wdXQtcHJlcGVuZCAuYnRue21hcmdpbi1yaWdodDotMXB4fS5pbnB1dC1wcmVwZW5kIC5hZGQtb246Zmlyc3QtY2hpbGQsLmlucHV0LXByZXBlbmQgLmJ0bjpmaXJzdC1jaGlsZHstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4O2JvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHh9LmlucHV0LWFwcGVuZCBpbnB1dCwuaW5wdXQtYXBwZW5kIHNlbGVjdCwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0ey13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweH0uaW5wdXQtYXBwZW5kIGlucHV0Ky5idG4tZ3JvdXAgLmJ0bjpsYXN0LWNoaWxkLC5pbnB1dC1hcHBlbmQgc2VsZWN0Ky5idG4tZ3JvdXAgLmJ0bjpsYXN0LWNoaWxkLC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQrLmJ0bi1ncm91cCAuYnRuOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwfS5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtYXBwZW5kIC5idG4sLmlucHV0LWFwcGVuZCAuYnRuLWdyb3Vwe21hcmdpbi1sZWZ0Oi0xcHh9LmlucHV0LWFwcGVuZCAuYWRkLW9uOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCAuYnRuOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCAuYnRuLWdyb3VwOmxhc3QtY2hpbGQ+LmRyb3Bkb3duLXRvZ2dsZXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDB9LmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCBzZWxlY3QsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0ey13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MH0uaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgaW5wdXQrLmJ0bi1ncm91cCAuYnRuLC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCBzZWxlY3QrLmJ0bi1ncm91cCAuYnRuLC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAudW5lZGl0YWJsZS1pbnB1dCsuYnRuLWdyb3VwIC5idG57LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwfS5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAuYWRkLW9uOmZpcnN0LWNoaWxkLC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAuYnRuOmZpcnN0LWNoaWxke21hcmdpbi1yaWdodDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweH0uaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLmFkZC1vbjpsYXN0LWNoaWxkLC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAuYnRuOmxhc3QtY2hpbGR7bWFyZ2luLWxlZnQ6LTFweDstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDB9LmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5idG4tZ3JvdXA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MH1pbnB1dC5zZWFyY2gtcXVlcnl7cGFkZGluZy1yaWdodDoxNHB4O3BhZGRpbmctcmlnaHQ6NHB4IFw5O3BhZGRpbmctbGVmdDoxNHB4O3BhZGRpbmctbGVmdDo0cHggXDk7bWFyZ2luLWJvdHRvbTowOy13ZWJraXQtYm9yZGVyLXJhZGl1czoxNXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNXB4O2JvcmRlci1yYWRpdXM6MTVweH0uZm9ybS1zZWFyY2ggLmlucHV0LWFwcGVuZCAuc2VhcmNoLXF1ZXJ5LC5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCAuc2VhcmNoLXF1ZXJ5ey13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MH0uZm9ybS1zZWFyY2ggLmlucHV0LWFwcGVuZCAuc2VhcmNoLXF1ZXJ5ey13ZWJraXQtYm9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4O2JvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweH0uZm9ybS1zZWFyY2ggLmlucHV0LWFwcGVuZCAuYnRuey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwO2JvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMH0uZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQgLnNlYXJjaC1xdWVyeXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMDtib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDB9LmZvcm0tc2VhcmNoIC5pbnB1dC1wcmVwZW5kIC5idG57LXdlYmtpdC1ib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7LW1vei1ib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7Ym9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4fS5mb3JtLXNlYXJjaCBpbnB1dCwuZm9ybS1pbmxpbmUgaW5wdXQsLmZvcm0taG9yaXpvbnRhbCBpbnB1dCwuZm9ybS1zZWFyY2ggdGV4dGFyZWEsLmZvcm0taW5saW5lIHRleHRhcmVhLC5mb3JtLWhvcml6b250YWwgdGV4dGFyZWEsLmZvcm0tc2VhcmNoIHNlbGVjdCwuZm9ybS1pbmxpbmUgc2VsZWN0LC5mb3JtLWhvcml6b250YWwgc2VsZWN0LC5mb3JtLXNlYXJjaCAuaGVscC1pbmxpbmUsLmZvcm0taW5saW5lIC5oZWxwLWlubGluZSwuZm9ybS1ob3Jpem9udGFsIC5oZWxwLWlubGluZSwuZm9ybS1zZWFyY2ggLnVuZWRpdGFibGUtaW5wdXQsLmZvcm0taW5saW5lIC51bmVkaXRhYmxlLWlucHV0LC5mb3JtLWhvcml6b250YWwgLnVuZWRpdGFibGUtaW5wdXQsLmZvcm0tc2VhcmNoIC5pbnB1dC1wcmVwZW5kLC5mb3JtLWlubGluZSAuaW5wdXQtcHJlcGVuZCwuZm9ybS1ob3Jpem9udGFsIC5pbnB1dC1wcmVwZW5kLC5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kLC5mb3JtLWlubGluZSAuaW5wdXQtYXBwZW5kLC5mb3JtLWhvcml6b250YWwgLmlucHV0LWFwcGVuZHtkaXNwbGF5OmlubGluZS1ibG9jazsqZGlzcGxheTppbmxpbmU7bWFyZ2luLWJvdHRvbTowO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTsqem9vbToxfS5mb3JtLXNlYXJjaCAuaGlkZSwuZm9ybS1pbmxpbmUgLmhpZGUsLmZvcm0taG9yaXpvbnRhbCAuaGlkZXtkaXNwbGF5Om5vbmV9LmZvcm0tc2VhcmNoIGxhYmVsLC5mb3JtLWlubGluZSBsYWJlbCwuZm9ybS1zZWFyY2ggLmJ0bi1ncm91cCwuZm9ybS1pbmxpbmUgLmJ0bi1ncm91cHtkaXNwbGF5OmlubGluZS1ibG9ja30uZm9ybS1zZWFyY2ggLmlucHV0LWFwcGVuZCwuZm9ybS1pbmxpbmUgLmlucHV0LWFwcGVuZCwuZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQsLmZvcm0taW5saW5lIC5pbnB1dC1wcmVwZW5ke21hcmdpbi1ib3R0b206MH0uZm9ybS1zZWFyY2ggLnJhZGlvLC5mb3JtLXNlYXJjaCAuY2hlY2tib3gsLmZvcm0taW5saW5lIC5yYWRpbywuZm9ybS1pbmxpbmUgLmNoZWNrYm94e3BhZGRpbmctbGVmdDowO21hcmdpbi1ib3R0b206MDt2ZXJ0aWNhbC1hbGlnbjptaWRkbGV9LmZvcm0tc2VhcmNoIC5yYWRpbyBpbnB1dFt0eXBlPSJyYWRpbyJdLC5mb3JtLXNlYXJjaCAuY2hlY2tib3ggaW5wdXRbdHlwZT0iY2hlY2tib3giXSwuZm9ybS1pbmxpbmUgLnJhZGlvIGlucHV0W3R5cGU9InJhZGlvIl0sLmZvcm0taW5saW5lIC5jaGVja2JveCBpbnB1dFt0eXBlPSJjaGVja2JveCJde2Zsb2F0OmxlZnQ7bWFyZ2luLXJpZ2h0OjNweDttYXJnaW4tbGVmdDowfS5jb250cm9sLWdyb3Vwe21hcmdpbi1ib3R0b206MTBweH1sZWdlbmQrLmNvbnRyb2wtZ3JvdXB7bWFyZ2luLXRvcDoyMHB4Oy13ZWJraXQtbWFyZ2luLXRvcC1jb2xsYXBzZTpzZXBhcmF0ZX0uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sLWdyb3Vwe21hcmdpbi1ib3R0b206MjBweDsqem9vbToxfS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtZ3JvdXA6YmVmb3JlLC5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtZ3JvdXA6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9LmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cDphZnRlcntjbGVhcjpib3RofS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtbGFiZWx7ZmxvYXQ6bGVmdDt3aWR0aDoxNjBweDtwYWRkaW5nLXRvcDo1cHg7dGV4dC1hbGlnbjpyaWdodH0uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sc3sqZGlzcGxheTppbmxpbmUtYmxvY2s7KnBhZGRpbmctbGVmdDoyMHB4O21hcmdpbi1sZWZ0OjE4MHB4OyptYXJnaW4tbGVmdDowfS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2xzOmZpcnN0LWNoaWxkeypwYWRkaW5nLWxlZnQ6MTgwcHh9LmZvcm0taG9yaXpvbnRhbCAuaGVscC1ibG9ja3ttYXJnaW4tYm90dG9tOjB9LmZvcm0taG9yaXpvbnRhbCBpbnB1dCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIHNlbGVjdCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIHRleHRhcmVhKy5oZWxwLWJsb2NrLC5mb3JtLWhvcml6b250YWwgLnVuZWRpdGFibGUtaW5wdXQrLmhlbHAtYmxvY2ssLmZvcm0taG9yaXpvbnRhbCAuaW5wdXQtcHJlcGVuZCsuaGVscC1ibG9jaywuZm9ybS1ob3Jpem9udGFsIC5pbnB1dC1hcHBlbmQrLmhlbHAtYmxvY2t7bWFyZ2luLXRvcDoxMHB4fS5mb3JtLWhvcml6b250YWwgLmZvcm0tYWN0aW9uc3twYWRkaW5nLWxlZnQ6MTgwcHh9dGFibGV7bWF4LXdpZHRoOjEwMCU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLXNwYWNpbmc6MH0udGFibGV7d2lkdGg6MTAwJTttYXJnaW4tYm90dG9tOjIwcHh9LnRhYmxlIHRoLC50YWJsZSB0ZHtwYWRkaW5nOjhweDtsaW5lLWhlaWdodDoyMHB4O3RleHQtYWxpZ246bGVmdDt2ZXJ0aWNhbC1hbGlnbjp0b3A7Ym9yZGVyLXRvcDoxcHggc29saWQgI2RkZH0udGFibGUgdGh7Zm9udC13ZWlnaHQ6Ym9sZH0udGFibGUgdGhlYWQgdGh7dmVydGljYWwtYWxpZ246Ym90dG9tfS50YWJsZSBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZSBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRkLC50YWJsZSBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUgY29sZ3JvdXArdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZSB0aGVhZDpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0ZHtib3JkZXItdG9wOjB9LnRhYmxlIHRib2R5K3Rib2R5e2JvcmRlci10b3A6MnB4IHNvbGlkICNkZGR9LnRhYmxlIC50YWJsZXtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZ9LnRhYmxlLWNvbmRlbnNlZCB0aCwudGFibGUtY29uZGVuc2VkIHRke3BhZGRpbmc6NHB4IDVweH0udGFibGUtYm9yZGVyZWR7Ym9yZGVyOjFweCBzb2xpZCAjZGRkO2JvcmRlci1jb2xsYXBzZTpzZXBhcmF0ZTsqYm9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fS50YWJsZS1ib3JkZXJlZCB0aCwudGFibGUtYm9yZGVyZWQgdGR7Ym9yZGVyLWxlZnQ6MXB4IHNvbGlkICNkZGR9LnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0Ym9keSB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlLWJvcmRlcmVkIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGR7Ym9yZGVyLXRvcDowfS50YWJsZS1ib3JkZXJlZCB0aGVhZDpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZD50aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQ+dGQ6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkPnRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRoZWFkOmxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRkOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Zm9vdDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGQ6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRoZWFkOmxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZD50aDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQ+dGQ6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGZvb3Q6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkPnRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo0cHh9LnRhYmxlLWJvcmRlcmVkIHRmb290K3Rib2R5Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZCB0ZDpmaXJzdC1jaGlsZHstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6MDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6MH0udGFibGUtYm9yZGVyZWQgdGZvb3QrdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkIHRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czowO2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjB9LnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGg6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQ6Zmlyc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZDpmaXJzdC1jaGlsZHstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjRweH0udGFibGUtYm9yZGVyZWQgY2FwdGlvbit0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHh9LnRhYmxlLXN0cmlwZWQgdGJvZHk+dHI6bnRoLWNoaWxkKG9kZCk+dGQsLnRhYmxlLXN0cmlwZWQgdGJvZHk+dHI6bnRoLWNoaWxkKG9kZCk+dGh7YmFja2dyb3VuZC1jb2xvcjojZjlmOWY5fS50YWJsZS1ob3ZlciB0Ym9keSB0cjpob3ZlciB0ZCwudGFibGUtaG92ZXIgdGJvZHkgdHI6aG92ZXIgdGh7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1fXRhYmxlIHRkW2NsYXNzKj0ic3BhbiJdLHRhYmxlIHRoW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgdGFibGUgdGRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0YWJsZSB0aFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OnRhYmxlLWNlbGw7ZmxvYXQ6bm9uZTttYXJnaW4tbGVmdDowfS50YWJsZSB0ZC5zcGFuMSwudGFibGUgdGguc3BhbjF7ZmxvYXQ6bm9uZTt3aWR0aDo0NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW4yLC50YWJsZSB0aC5zcGFuMntmbG9hdDpub25lO3dpZHRoOjEyNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW4zLC50YWJsZSB0aC5zcGFuM3tmbG9hdDpub25lO3dpZHRoOjIwNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW40LC50YWJsZSB0aC5zcGFuNHtmbG9hdDpub25lO3dpZHRoOjI4NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW41LC50YWJsZSB0aC5zcGFuNXtmbG9hdDpub25lO3dpZHRoOjM2NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW42LC50YWJsZSB0aC5zcGFuNntmbG9hdDpub25lO3dpZHRoOjQ0NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW43LC50YWJsZSB0aC5zcGFuN3tmbG9hdDpub25lO3dpZHRoOjUyNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW44LC50YWJsZSB0aC5zcGFuOHtmbG9hdDpub25lO3dpZHRoOjYwNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW45LC50YWJsZSB0aC5zcGFuOXtmbG9hdDpub25lO3dpZHRoOjY4NHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRkLnNwYW4xMCwudGFibGUgdGguc3BhbjEwe2Zsb2F0Om5vbmU7d2lkdGg6NzY0cHg7bWFyZ2luLWxlZnQ6MH0udGFibGUgdGQuc3BhbjExLC50YWJsZSB0aC5zcGFuMTF7ZmxvYXQ6bm9uZTt3aWR0aDo4NDRweDttYXJnaW4tbGVmdDowfS50YWJsZSB0ZC5zcGFuMTIsLnRhYmxlIHRoLnNwYW4xMntmbG9hdDpub25lO3dpZHRoOjkyNHB4O21hcmdpbi1sZWZ0OjB9LnRhYmxlIHRib2R5IHRyLnN1Y2Nlc3MgdGR7YmFja2dyb3VuZC1jb2xvcjojZGZmMGQ4fS50YWJsZSB0Ym9keSB0ci5lcnJvciB0ZHtiYWNrZ3JvdW5kLWNvbG9yOiNmMmRlZGV9LnRhYmxlIHRib2R5IHRyLndhcm5pbmcgdGR7YmFja2dyb3VuZC1jb2xvcjojZmNmOGUzfS50YWJsZSB0Ym9keSB0ci5pbmZvIHRke2JhY2tncm91bmQtY29sb3I6I2Q5ZWRmN30udGFibGUtaG92ZXIgdGJvZHkgdHIuc3VjY2Vzczpob3ZlciB0ZHtiYWNrZ3JvdW5kLWNvbG9yOiNkMGU5YzZ9LnRhYmxlLWhvdmVyIHRib2R5IHRyLmVycm9yOmhvdmVyIHRke2JhY2tncm91bmQtY29sb3I6I2ViY2NjY30udGFibGUtaG92ZXIgdGJvZHkgdHIud2FybmluZzpob3ZlciB0ZHtiYWNrZ3JvdW5kLWNvbG9yOiNmYWYyY2N9LnRhYmxlLWhvdmVyIHRib2R5IHRyLmluZm86aG92ZXIgdGR7YmFja2dyb3VuZC1jb2xvcjojYzRlM2YzfVtjbGFzc149Imljb24tIl0sW2NsYXNzKj0iIGljb24tIl17ZGlzcGxheTppbmxpbmUtYmxvY2s7d2lkdGg6MTRweDtoZWlnaHQ6MTRweDttYXJnaW4tdG9wOjFweDsqbWFyZ2luLXJpZ2h0Oi4zZW07bGluZS1oZWlnaHQ6MTRweDt2ZXJ0aWNhbC1hbGlnbjp0ZXh0LXRvcDtiYWNrZ3JvdW5kLWltYWdlOnVybCgiLi4vaW1nL2dseXBoaWNvbnMtaGFsZmxpbmdzLnBuZyIpO2JhY2tncm91bmQtcG9zaXRpb246MTRweCAxNHB4O2JhY2tncm91bmQtcmVwZWF0Om5vLXJlcGVhdH0uaWNvbi13aGl0ZSwubmF2LXBpbGxzPi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXYtcGlsbHM+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5uYXYtbGlzdD4uYWN0aXZlPmE+W2NsYXNzXj0iaWNvbi0iXSwubmF2LWxpc3Q+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5uYXZiYXItaW52ZXJzZSAubmF2Pi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXZiYXItaW52ZXJzZSAubmF2Pi5hY3RpdmU+YT5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tbWVudT5saT5hOmhvdmVyPltjbGFzc149Imljb24tIl0sLmRyb3Bkb3duLW1lbnU+bGk+YTpob3Zlcj5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE+W2NsYXNzXj0iaWNvbi0iXSwuZHJvcGRvd24tbWVudT4uYWN0aXZlPmE+W2NsYXNzKj0iIGljb24tIl0sLmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YT5bY2xhc3NePSJpY29uLSJdLC5kcm9wZG93bi1zdWJtZW51OmhvdmVyPmE+W2NsYXNzKj0iIGljb24tIl17YmFja2dyb3VuZC1pbWFnZTp1cmwoIi4uL2ltZy9nbHlwaGljb25zLWhhbGZsaW5ncy13aGl0ZS5wbmciKX0uaWNvbi1nbGFzc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMH0uaWNvbi1tdXNpY3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IDB9Lmljb24tc2VhcmNoe2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggMH0uaWNvbi1lbnZlbG9wZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IDB9Lmljb24taGVhcnR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAwfS5pY29uLXN0YXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggMH0uaWNvbi1zdGFyLWVtcHR5e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IDB9Lmljb24tdXNlcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAwfS5pY29uLWZpbG17YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggMH0uaWNvbi10aC1sYXJnZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAwfS5pY29uLXRoe2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IDB9Lmljb24tdGgtbGlzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAwfS5pY29uLW9re2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IDB9Lmljb24tcmVtb3Zle2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IDB9Lmljb24tem9vbS1pbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAwfS5pY29uLXpvb20tb3V0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IDB9Lmljb24tb2Zme2JhY2tncm91bmQtcG9zaXRpb246LTM4NHB4IDB9Lmljb24tc2lnbmFse2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IDB9Lmljb24tY29ne2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IDB9Lmljb24tdHJhc2h7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggMH0uaWNvbi1ob21le2JhY2tncm91bmQtcG9zaXRpb246MCAtMjRweH0uaWNvbi1maWxle2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTI0cHh9Lmljb24tdGltZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC0yNHB4fS5pY29uLXJvYWR7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMjRweH0uaWNvbi1kb3dubG9hZC1hbHR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMjRweH0uaWNvbi1kb3dubG9hZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtMjRweH0uaWNvbi11cGxvYWR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTI0cHh9Lmljb24taW5ib3h7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTI0cHh9Lmljb24tcGxheS1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggLTI0cHh9Lmljb24tcmVwZWF0e2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0yNHB4fS5pY29uLXJlZnJlc2h7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTI0cHh9Lmljb24tbGlzdC1hbHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTI0cHh9Lmljb24tbG9ja3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODdweCAtMjRweH0uaWNvbi1mbGFne2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC0yNHB4fS5pY29uLWhlYWRwaG9uZXN7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTI0cHh9Lmljb24tdm9sdW1lLW9mZntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtMjRweH0uaWNvbi12b2x1bWUtZG93bntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMjRweH0uaWNvbi12b2x1bWUtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTI0cHh9Lmljb24tcXJjb2Rle2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0yNHB4fS5pY29uLWJhcmNvZGV7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTI0cHh9Lmljb24tdGFne2JhY2tncm91bmQtcG9zaXRpb246MCAtNDhweH0uaWNvbi10YWdze2JhY2tncm91bmQtcG9zaXRpb246LTI1cHggLTQ4cHh9Lmljb24tYm9va3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC00OHB4fS5pY29uLWJvb2ttYXJre2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTQ4cHh9Lmljb24tcHJpbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtNDhweH0uaWNvbi1jYW1lcmF7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTQ4cHh9Lmljb24tZm9udHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNDRweCAtNDhweH0uaWNvbi1ib2xke2JhY2tncm91bmQtcG9zaXRpb246LTE2N3B4IC00OHB4fS5pY29uLWl0YWxpY3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtNDhweH0uaWNvbi10ZXh0LWhlaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAtNDhweH0uaWNvbi10ZXh0LXdpZHRoe2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC00OHB4fS5pY29uLWFsaWduLWxlZnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTQ4cHh9Lmljb24tYWxpZ24tY2VudGVye2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IC00OHB4fS5pY29uLWFsaWduLXJpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC00OHB4fS5pY29uLWFsaWduLWp1c3RpZnl7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTQ4cHh9Lmljb24tbGlzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtNDhweH0uaWNvbi1pbmRlbnQtbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtNDhweH0uaWNvbi1pbmRlbnQtcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTQ4cHh9Lmljb24tZmFjZXRpbWUtdmlkZW97YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTQ4cHh9Lmljb24tcGljdHVyZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtNDhweH0uaWNvbi1wZW5jaWx7YmFja2dyb3VuZC1wb3NpdGlvbjowIC03MnB4fS5pY29uLW1hcC1tYXJrZXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtNzJweH0uaWNvbi1hZGp1c3R7YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtNzJweH0uaWNvbi10aW50e2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTcycHh9Lmljb24tZWRpdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC03MnB4fS5pY29uLXNoYXJle2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC03MnB4fS5pY29uLWNoZWNre2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC03MnB4fS5pY29uLW1vdmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTcycHh9Lmljb24tc3RlcC1iYWNrd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtNzJweH0uaWNvbi1mYXN0LWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC03MnB4fS5pY29uLWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC03MnB4fS5pY29uLXBsYXl7YmFja2dyb3VuZC1wb3NpdGlvbjotMjY0cHggLTcycHh9Lmljb24tcGF1c2V7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTcycHh9Lmljb24tc3RvcHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMTJweCAtNzJweH0uaWNvbi1mb3J3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC03MnB4fS5pY29uLWZhc3QtZm9yd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtNzJweH0uaWNvbi1zdGVwLWZvcndhcmR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTcycHh9Lmljb24tZWplY3R7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTcycHh9Lmljb24tY2hldnJvbi1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC03MnB4fS5pY29uLWNoZXZyb24tcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTcycHh9Lmljb24tcGx1cy1zaWdue2JhY2tncm91bmQtcG9zaXRpb246MCAtOTZweH0uaWNvbi1taW51cy1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTk2cHh9Lmljb24tcmVtb3ZlLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtOTZweH0uaWNvbi1vay1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTcycHggLTk2cHh9Lmljb24tcXVlc3Rpb24tc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC05NnB4fS5pY29uLWluZm8tc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtOTZweH0uaWNvbi1zY3JlZW5zaG90e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC05NnB4fS5pY29uLXJlbW92ZS1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTk2cHh9Lmljb24tb2stY2lyY2xle2JhY2tncm91bmQtcG9zaXRpb246LTE5MnB4IC05NnB4fS5pY29uLWJhbi1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTk2cHh9Lmljb24tYXJyb3ctbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNDBweCAtOTZweH0uaWNvbi1hcnJvdy1yaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtOTZweH0uaWNvbi1hcnJvdy11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODlweCAtOTZweH0uaWNvbi1hcnJvdy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC05NnB4fS5pY29uLXNoYXJlLWFsdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtOTZweH0uaWNvbi1yZXNpemUtZnVsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtOTZweH0uaWNvbi1yZXNpemUtc21hbGx7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTk2cHh9Lmljb24tcGx1c3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtOTZweH0uaWNvbi1taW51c3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MzNweCAtOTZweH0uaWNvbi1hc3Rlcmlza3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtOTZweH0uaWNvbi1leGNsYW1hdGlvbi1zaWdue2JhY2tncm91bmQtcG9zaXRpb246MCAtMTIwcHh9Lmljb24tZ2lmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IC0xMjBweH0uaWNvbi1sZWFme2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggLTEyMHB4fS5pY29uLWZpcmV7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMTIwcHh9Lmljb24tZXllLW9wZW57YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMTIwcHh9Lmljb24tZXllLWNsb3Nle2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC0xMjBweH0uaWNvbi13YXJuaW5nLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTEyMHB4fS5pY29uLXBsYW5le2JhY2tncm91bmQtcG9zaXRpb246LTE2OHB4IC0xMjBweH0uaWNvbi1jYWxlbmRhcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMTIwcHh9Lmljb24tcmFuZG9te3dpZHRoOjE2cHg7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTEyMHB4fS5pY29uLWNvbW1lbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTEyMHB4fS5pY29uLW1hZ25ldHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtMTIwcHh9Lmljb24tY2hldnJvbi11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODhweCAtMTIwcHh9Lmljb24tY2hldnJvbi1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxM3B4IC0xMTlweH0uaWNvbi1yZXR3ZWV0e2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC0xMjBweH0uaWNvbi1zaG9wcGluZy1jYXJ0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0xMjBweH0uaWNvbi1mb2xkZXItY2xvc2V7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTEyMHB4fS5pY29uLWZvbGRlci1vcGVue3dpZHRoOjE2cHg7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTEyMHB4fS5pY29uLXJlc2l6ZS12ZXJ0aWNhbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MzJweCAtMTE5cHh9Lmljb24tcmVzaXplLWhvcml6b250YWx7YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTExOHB4fS5pY29uLWhkZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgLTE0NHB4fS5pY29uLWJ1bGxob3Jue2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTE0NHB4fS5pY29uLWJlbGx7YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtMTQ0cHh9Lmljb24tY2VydGlmaWNhdGV7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtMTQ0cHh9Lmljb24tdGh1bWJzLXVwe2JhY2tncm91bmQtcG9zaXRpb246LTk2cHggLTE0NHB4fS5pY29uLXRodW1icy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC0xNDRweH0uaWNvbi1oYW5kLXJpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC0xNDRweH0uaWNvbi1oYW5kLWxlZnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTE0NHB4fS5pY29uLWhhbmQtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggLTE0NHB4fS5pY29uLWhhbmQtZG93bntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAtMTQ0cHh9Lmljb24tY2lyY2xlLWFycm93LXJpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC0xNDRweH0uaWNvbi1jaXJjbGUtYXJyb3ctbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtMTQ0cHh9Lmljb24tY2lyY2xlLWFycm93LXVwe2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IC0xNDRweH0uaWNvbi1jaXJjbGUtYXJyb3ctZG93bntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMTJweCAtMTQ0cHh9Lmljb24tZ2xvYmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTE0NHB4fS5pY29uLXdyZW5jaHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zNjBweCAtMTQ0cHh9Lmljb24tdGFza3N7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggLTE0NHB4fS5pY29uLWZpbHRlcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtMTQ0cHh9Lmljb24tYnJpZWZjYXNle2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0xNDRweH0uaWNvbi1mdWxsc2NyZWVue2JhY2tncm91bmQtcG9zaXRpb246LTQ1NnB4IC0xNDRweH0uZHJvcHVwLC5kcm9wZG93bntwb3NpdGlvbjpyZWxhdGl2ZX0uZHJvcGRvd24tdG9nZ2xleyptYXJnaW4tYm90dG9tOi0zcHh9LmRyb3Bkb3duLXRvZ2dsZTphY3RpdmUsLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZXtvdXRsaW5lOjB9LmNhcmV0e2Rpc3BsYXk6aW5saW5lLWJsb2NrO3dpZHRoOjA7aGVpZ2h0OjA7dmVydGljYWwtYWxpZ246dG9wO2JvcmRlci10b3A6NHB4IHNvbGlkICMwMDA7Ym9yZGVyLXJpZ2h0OjRweCBzb2xpZCB0cmFuc3BhcmVudDtib3JkZXItbGVmdDo0cHggc29saWQgdHJhbnNwYXJlbnQ7Y29udGVudDoiIn0uZHJvcGRvd24gLmNhcmV0e21hcmdpbi10b3A6OHB4O21hcmdpbi1sZWZ0OjJweH0uZHJvcGRvd24tbWVudXtwb3NpdGlvbjphYnNvbHV0ZTt0b3A6MTAwJTtsZWZ0OjA7ei1pbmRleDoxMDAwO2Rpc3BsYXk6bm9uZTtmbG9hdDpsZWZ0O21pbi13aWR0aDoxNjBweDtwYWRkaW5nOjVweCAwO21hcmdpbjoycHggMCAwO2xpc3Qtc3R5bGU6bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjY2NjO2JvcmRlcjoxcHggc29saWQgcmdiYSgwLDAsMCwwLjIpOypib3JkZXItcmlnaHQtd2lkdGg6MnB4Oypib3JkZXItYm90dG9tLXdpZHRoOjJweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLDAsMCwwLjIpOy1tb3otYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwwLDAsMC4yKTtib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLDAsMCwwLjIpOy13ZWJraXQtYmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94Oy1tb3otYmFja2dyb3VuZC1jbGlwOnBhZGRpbmc7YmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94fS5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHR7cmlnaHQ6MDtsZWZ0OmF1dG99LmRyb3Bkb3duLW1lbnUgLmRpdmlkZXJ7KndpZHRoOjEwMCU7aGVpZ2h0OjFweDttYXJnaW46OXB4IDFweDsqbWFyZ2luOi01cHggMCA1cHg7b3ZlcmZsb3c6aGlkZGVuO2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZmZmfS5kcm9wZG93bi1tZW51IGxpPmF7ZGlzcGxheTpibG9jaztwYWRkaW5nOjNweCAyMHB4O2NsZWFyOmJvdGg7Zm9udC13ZWlnaHQ6bm9ybWFsO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6IzMzMzt3aGl0ZS1zcGFjZTpub3dyYXB9LmRyb3Bkb3duLW1lbnUgbGk+YTpob3ZlciwuZHJvcGRvd24tbWVudSBsaT5hOmZvY3VzLC5kcm9wZG93bi1zdWJtZW51OmhvdmVyPmF7Y29sb3I6I2ZmZjt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiMwMDgxYzI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjMDhjKSx0bygjMDA3N2IzKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjAwODhjYycsZW5kQ29sb3JzdHI9JyNmZjAwNzdiMycsR3JhZGllbnRUeXBlPTApfS5kcm9wZG93bi1tZW51IC5hY3RpdmU+YSwuZHJvcGRvd24tbWVudSAuYWN0aXZlPmE6aG92ZXJ7Y29sb3I6I2ZmZjt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiMwMDgxYzI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjMDhjKSx0bygjMDA3N2IzKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzA4YywjMDA3N2IzKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtvdXRsaW5lOjA7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYwMDg4Y2MnLGVuZENvbG9yc3RyPScjZmYwMDc3YjMnLEdyYWRpZW50VHlwZT0wKX0uZHJvcGRvd24tbWVudSAuZGlzYWJsZWQ+YSwuZHJvcGRvd24tbWVudSAuZGlzYWJsZWQ+YTpob3Zlcntjb2xvcjojOTk5fS5kcm9wZG93bi1tZW51IC5kaXNhYmxlZD5hOmhvdmVye3RleHQtZGVjb3JhdGlvbjpub25lO2N1cnNvcjpkZWZhdWx0O2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7YmFja2dyb3VuZC1pbWFnZTpub25lO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZD1mYWxzZSl9Lm9wZW57KnotaW5kZXg6MTAwMH0ub3Blbj4uZHJvcGRvd24tbWVudXtkaXNwbGF5OmJsb2NrfS5wdWxsLXJpZ2h0Pi5kcm9wZG93bi1tZW51e3JpZ2h0OjA7bGVmdDphdXRvfS5kcm9wdXAgLmNhcmV0LC5uYXZiYXItZml4ZWQtYm90dG9tIC5kcm9wZG93biAuY2FyZXR7Ym9yZGVyLXRvcDowO2JvcmRlci1ib3R0b206NHB4IHNvbGlkICMwMDA7Y29udGVudDoiIn0uZHJvcHVwIC5kcm9wZG93bi1tZW51LC5uYXZiYXItZml4ZWQtYm90dG9tIC5kcm9wZG93biAuZHJvcGRvd24tbWVudXt0b3A6YXV0bztib3R0b206MTAwJTttYXJnaW4tYm90dG9tOjFweH0uZHJvcGRvd24tc3VibWVudXtwb3NpdGlvbjpyZWxhdGl2ZX0uZHJvcGRvd24tc3VibWVudT4uZHJvcGRvd24tbWVudXt0b3A6MDtsZWZ0OjEwMCU7bWFyZ2luLXRvcDotNnB4O21hcmdpbi1sZWZ0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDZweCA2cHggNnB4fS5kcm9wZG93bi1zdWJtZW51OmhvdmVyPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2t9LmRyb3B1cCAuZHJvcGRvd24tc3VibWVudT4uZHJvcGRvd24tbWVudXt0b3A6YXV0bztib3R0b206MDttYXJnaW4tdG9wOjA7bWFyZ2luLWJvdHRvbTotMnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwOy1tb3otYm9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwO2JvcmRlci1yYWRpdXM6NXB4IDVweCA1cHggMH0uZHJvcGRvd24tc3VibWVudT5hOmFmdGVye2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6cmlnaHQ7d2lkdGg6MDtoZWlnaHQ6MDttYXJnaW4tdG9wOjVweDttYXJnaW4tcmlnaHQ6LTEwcHg7Ym9yZGVyLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlci1sZWZ0LWNvbG9yOiNjY2M7Ym9yZGVyLXN0eWxlOnNvbGlkO2JvcmRlci13aWR0aDo1cHggMCA1cHggNXB4O2NvbnRlbnQ6IiAifS5kcm9wZG93bi1zdWJtZW51OmhvdmVyPmE6YWZ0ZXJ7Ym9yZGVyLWxlZnQtY29sb3I6I2ZmZn0uZHJvcGRvd24tc3VibWVudS5wdWxsLWxlZnR7ZmxvYXQ6bm9uZX0uZHJvcGRvd24tc3VibWVudS5wdWxsLWxlZnQ+LmRyb3Bkb3duLW1lbnV7bGVmdDotMTAwJTttYXJnaW4tbGVmdDoxMHB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweH0uZHJvcGRvd24gLmRyb3Bkb3duLW1lbnUgLm5hdi1oZWFkZXJ7cGFkZGluZy1yaWdodDoyMHB4O3BhZGRpbmctbGVmdDoyMHB4fS50eXBlYWhlYWR7ei1pbmRleDoxMDUxO21hcmdpbi10b3A6MnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweH0ud2VsbHttaW4taGVpZ2h0OjIwcHg7cGFkZGluZzoxOXB4O21hcmdpbi1ib3R0b206MjBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyOjFweCBzb2xpZCAjZTNlM2UzOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLDAuMDUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsMC4wNSl9LndlbGwgYmxvY2txdW90ZXtib3JkZXItY29sb3I6I2RkZDtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjE1KX0ud2VsbC1sYXJnZXtwYWRkaW5nOjI0cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4fS53ZWxsLXNtYWxse3BhZGRpbmc6OXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzOjNweDtib3JkZXItcmFkaXVzOjNweH0uZmFkZXtvcGFjaXR5OjA7LXdlYmtpdC10cmFuc2l0aW9uOm9wYWNpdHkgLjE1cyBsaW5lYXI7LW1vei10cmFuc2l0aW9uOm9wYWNpdHkgLjE1cyBsaW5lYXI7LW8tdHJhbnNpdGlvbjpvcGFjaXR5IC4xNXMgbGluZWFyO3RyYW5zaXRpb246b3BhY2l0eSAuMTVzIGxpbmVhcn0uZmFkZS5pbntvcGFjaXR5OjF9LmNvbGxhcHNle3Bvc2l0aW9uOnJlbGF0aXZlO2hlaWdodDowO292ZXJmbG93OmhpZGRlbjstd2Via2l0LXRyYW5zaXRpb246aGVpZ2h0IC4zNXMgZWFzZTstbW96LXRyYW5zaXRpb246aGVpZ2h0IC4zNXMgZWFzZTstby10cmFuc2l0aW9uOmhlaWdodCAuMzVzIGVhc2U7dHJhbnNpdGlvbjpoZWlnaHQgLjM1cyBlYXNlfS5jb2xsYXBzZS5pbntoZWlnaHQ6YXV0b30uY2xvc2V7ZmxvYXQ6cmlnaHQ7Zm9udC1zaXplOjIwcHg7Zm9udC13ZWlnaHQ6Ym9sZDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiMwMDA7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmO29wYWNpdHk6LjI7ZmlsdGVyOmFscGhhKG9wYWNpdHk9MjApfS5jbG9zZTpob3Zlcntjb2xvcjojMDAwO3RleHQtZGVjb3JhdGlvbjpub25lO2N1cnNvcjpwb2ludGVyO29wYWNpdHk6LjQ7ZmlsdGVyOmFscGhhKG9wYWNpdHk9NDApfWJ1dHRvbi5jbG9zZXtwYWRkaW5nOjA7Y3Vyc29yOnBvaW50ZXI7YmFja2dyb3VuZDp0cmFuc3BhcmVudDtib3JkZXI6MDstd2Via2l0LWFwcGVhcmFuY2U6bm9uZX0uYnRue2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTtwYWRkaW5nOjRweCAxMnB4O21hcmdpbi1ib3R0b206MDsqbWFyZ2luLWxlZnQ6LjNlbTtmb250LXNpemU6MTRweDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiMzMzM7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1zaGFkb3c6MCAxcHggMXB4IHJnYmEoMjU1LDI1NSwyNTUsMC43NSk7dmVydGljYWwtYWxpZ246bWlkZGxlO2N1cnNvcjpwb2ludGVyO2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTsqYmFja2dyb3VuZC1jb2xvcjojZTZlNmU2O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2ZmZiksdG8oI2U2ZTZlNikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNmZmYsI2U2ZTZlNik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyOjFweCBzb2xpZCAjYmJiOypib3JkZXI6MDtib3JkZXItY29sb3I6I2U2ZTZlNiAjZTZlNmU2ICNiZmJmYmY7Ym9yZGVyLWNvbG9yOnJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjI1KTtib3JkZXItYm90dG9tLWNvbG9yOiNhMmEyYTI7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZmZmZmZmJyxlbmRDb2xvcnN0cj0nI2ZmZTZlNmU2JyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKTsqem9vbToxOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsMC4yKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMiksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsMC4yKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KX0uYnRuOmhvdmVyLC5idG46YWN0aXZlLC5idG4uYWN0aXZlLC5idG4uZGlzYWJsZWQsLmJ0bltkaXNhYmxlZF17Y29sb3I6IzMzMztiYWNrZ3JvdW5kLWNvbG9yOiNlNmU2ZTY7KmJhY2tncm91bmQtY29sb3I6I2Q5ZDlkOX0uYnRuOmFjdGl2ZSwuYnRuLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNjY2MgXDl9LmJ0bjpmaXJzdC1jaGlsZHsqbWFyZ2luLWxlZnQ6MH0uYnRuOmhvdmVye2NvbG9yOiMzMzM7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1wb3NpdGlvbjowIC0xNXB4Oy13ZWJraXQtdHJhbnNpdGlvbjpiYWNrZ3JvdW5kLXBvc2l0aW9uIC4xcyBsaW5lYXI7LW1vei10cmFuc2l0aW9uOmJhY2tncm91bmQtcG9zaXRpb24gLjFzIGxpbmVhcjstby10cmFuc2l0aW9uOmJhY2tncm91bmQtcG9zaXRpb24gLjFzIGxpbmVhcjt0cmFuc2l0aW9uOmJhY2tncm91bmQtcG9zaXRpb24gLjFzIGxpbmVhcn0uYnRuOmZvY3Vze291dGxpbmU6dGhpbiBkb3R0ZWQgIzMzMztvdXRsaW5lOjVweCBhdXRvIC13ZWJraXQtZm9jdXMtcmluZy1jb2xvcjtvdXRsaW5lLW9mZnNldDotMnB4fS5idG4uYWN0aXZlLC5idG46YWN0aXZle2JhY2tncm91bmQtaW1hZ2U6bm9uZTtvdXRsaW5lOjA7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMnB4IDRweCByZ2JhKDAsMCwwLDAuMTUpLDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTtib3gtc2hhZG93Omluc2V0IDAgMnB4IDRweCByZ2JhKDAsMCwwLDAuMTUpLDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDUpfS5idG4uZGlzYWJsZWQsLmJ0bltkaXNhYmxlZF17Y3Vyc29yOmRlZmF1bHQ7YmFja2dyb3VuZC1pbWFnZTpub25lO29wYWNpdHk6LjY1O2ZpbHRlcjphbHBoYShvcGFjaXR5PTY1KTstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmV9LmJ0bi1sYXJnZXtwYWRkaW5nOjExcHggMTlweDtmb250LXNpemU6MTcuNXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweH0uYnRuLWxhcmdlIFtjbGFzc149Imljb24tIl0sLmJ0bi1sYXJnZSBbY2xhc3MqPSIgaWNvbi0iXXttYXJnaW4tdG9wOjRweH0uYnRuLXNtYWxse3BhZGRpbmc6MnB4IDEwcHg7Zm9udC1zaXplOjExLjlweDstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHh9LmJ0bi1zbWFsbCBbY2xhc3NePSJpY29uLSJdLC5idG4tc21hbGwgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXRvcDowfS5idG4tbWluaSBbY2xhc3NePSJpY29uLSJdLC5idG4tbWluaSBbY2xhc3MqPSIgaWNvbi0iXXttYXJnaW4tdG9wOi0xcHh9LmJ0bi1taW5pe3BhZGRpbmc6MCA2cHg7Zm9udC1zaXplOjEwLjVweDstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHh9LmJ0bi1ibG9ja3tkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7cGFkZGluZy1yaWdodDowO3BhZGRpbmctbGVmdDowOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0uYnRuLWJsb2NrKy5idG4tYmxvY2t7bWFyZ2luLXRvcDo1cHh9aW5wdXRbdHlwZT0ic3VibWl0Il0uYnRuLWJsb2NrLGlucHV0W3R5cGU9InJlc2V0Il0uYnRuLWJsb2NrLGlucHV0W3R5cGU9ImJ1dHRvbiJdLmJ0bi1ibG9ja3t3aWR0aDoxMDAlfS5idG4tcHJpbWFyeS5hY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZSwuYnRuLWRhbmdlci5hY3RpdmUsLmJ0bi1zdWNjZXNzLmFjdGl2ZSwuYnRuLWluZm8uYWN0aXZlLC5idG4taW52ZXJzZS5hY3RpdmV7Y29sb3I6cmdiYSgyNTUsMjU1LDI1NSwwLjc1KX0uYnRue2JvcmRlci1jb2xvcjojYzVjNWM1O2JvcmRlci1jb2xvcjpyZ2JhKDAsMCwwLDAuMTUpIHJnYmEoMCwwLDAsMC4xNSkgcmdiYSgwLDAsMCwwLjI1KX0uYnRuLXByaW1hcnl7Y29sb3I6I2ZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsMCwwLDAuMjUpO2JhY2tncm91bmQtY29sb3I6IzAwNmRjYzsqYmFja2dyb3VuZC1jb2xvcjojMDRjO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCMwOGMsIzA0Yyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzA4YyksdG8oIzA0YykpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCMwOGMsIzA0Yyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCMwOGMsIzA0Yyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCMwOGMsIzA0Yyk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyLWNvbG9yOiMwNGMgIzA0YyAjMDAyYTgwO2JvcmRlci1jb2xvcjpyZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4yNSk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYwMDg4Y2MnLGVuZENvbG9yc3RyPScjZmYwMDQ0Y2MnLEdyYWRpZW50VHlwZT0wKTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQ9ZmFsc2UpfS5idG4tcHJpbWFyeTpob3ZlciwuYnRuLXByaW1hcnk6YWN0aXZlLC5idG4tcHJpbWFyeS5hY3RpdmUsLmJ0bi1wcmltYXJ5LmRpc2FibGVkLC5idG4tcHJpbWFyeVtkaXNhYmxlZF17Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMwNGM7KmJhY2tncm91bmQtY29sb3I6IzAwM2JiM30uYnRuLXByaW1hcnk6YWN0aXZlLC5idG4tcHJpbWFyeS5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojMDM5IFw5fS5idG4td2FybmluZ3tjb2xvcjojZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojZmFhNzMyOypiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDY7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjZmJiNDUwKSx0bygjZjg5NDA2KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtib3JkZXItY29sb3I6I2Y4OTQwNiAjZjg5NDA2ICNhZDY3MDQ7Ym9yZGVyLWNvbG9yOnJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjI1KTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmZiYjQ1MCcsZW5kQ29sb3JzdHI9JyNmZmY4OTQwNicsR3JhZGllbnRUeXBlPTApO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZD1mYWxzZSl9LmJ0bi13YXJuaW5nOmhvdmVyLC5idG4td2FybmluZzphY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZSwuYnRuLXdhcm5pbmcuZGlzYWJsZWQsLmJ0bi13YXJuaW5nW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6I2Y4OTQwNjsqYmFja2dyb3VuZC1jb2xvcjojZGY4NTA1fS5idG4td2FybmluZzphY3RpdmUsLmJ0bi13YXJuaW5nLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiNjNjc2MDUgXDl9LmJ0bi1kYW5nZXJ7Y29sb3I6I2ZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsMCwwLDAuMjUpO2JhY2tncm91bmQtY29sb3I6I2RhNGY0OTsqYmFja2dyb3VuZC1jb2xvcjojYmQzNjJmO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2VlNWY1YiksdG8oI2JkMzYyZikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNlZTVmNWIsI2JkMzYyZik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyLWNvbG9yOiNiZDM2MmYgI2JkMzYyZiAjODAyNDIwO2JvcmRlci1jb2xvcjpyZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4yNSk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZlZTVmNWInLGVuZENvbG9yc3RyPScjZmZiZDM2MmYnLEdyYWRpZW50VHlwZT0wKTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQ9ZmFsc2UpfS5idG4tZGFuZ2VyOmhvdmVyLC5idG4tZGFuZ2VyOmFjdGl2ZSwuYnRuLWRhbmdlci5hY3RpdmUsLmJ0bi1kYW5nZXIuZGlzYWJsZWQsLmJ0bi1kYW5nZXJbZGlzYWJsZWRde2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjojYmQzNjJmOypiYWNrZ3JvdW5kLWNvbG9yOiNhOTMwMmF9LmJ0bi1kYW5nZXI6YWN0aXZlLC5idG4tZGFuZ2VyLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiM5NDJhMjUgXDl9LmJ0bi1zdWNjZXNze2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiM1YmI3NWI7KmJhY2tncm91bmQtY29sb3I6IzUxYTM1MTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCM2MmM0NjIpLHRvKCM1MWEzNTEpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjNjJjNDYyLCM1MWEzNTEpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojNTFhMzUxICM1MWEzNTEgIzM4NzAzODtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNjJjNDYyJyxlbmRDb2xvcnN0cj0nI2ZmNTFhMzUxJyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKX0uYnRuLXN1Y2Nlc3M6aG92ZXIsLmJ0bi1zdWNjZXNzOmFjdGl2ZSwuYnRuLXN1Y2Nlc3MuYWN0aXZlLC5idG4tc3VjY2Vzcy5kaXNhYmxlZCwuYnRuLXN1Y2Nlc3NbZGlzYWJsZWRde2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjojNTFhMzUxOypiYWNrZ3JvdW5kLWNvbG9yOiM0OTkyNDl9LmJ0bi1zdWNjZXNzOmFjdGl2ZSwuYnRuLXN1Y2Nlc3MuYWN0aXZle2JhY2tncm91bmQtY29sb3I6IzQwODE0MCBcOX0uYnRuLWluZm97Y29sb3I6I2ZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsMCwwLDAuMjUpO2JhY2tncm91bmQtY29sb3I6IzQ5YWZjZDsqYmFja2dyb3VuZC1jb2xvcjojMmY5NmI0O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCM1YmMwZGUsIzJmOTZiNCk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzViYzBkZSksdG8oIzJmOTZiNCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCM1YmMwZGUsIzJmOTZiNCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCM1YmMwZGUsIzJmOTZiNCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCM1YmMwZGUsIzJmOTZiNCk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyLWNvbG9yOiMyZjk2YjQgIzJmOTZiNCAjMWY2Mzc3O2JvcmRlci1jb2xvcjpyZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4yNSk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmY1YmMwZGUnLGVuZENvbG9yc3RyPScjZmYyZjk2YjQnLEdyYWRpZW50VHlwZT0wKTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQ9ZmFsc2UpfS5idG4taW5mbzpob3ZlciwuYnRuLWluZm86YWN0aXZlLC5idG4taW5mby5hY3RpdmUsLmJ0bi1pbmZvLmRpc2FibGVkLC5idG4taW5mb1tkaXNhYmxlZF17Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMyZjk2YjQ7KmJhY2tncm91bmQtY29sb3I6IzJhODVhMH0uYnRuLWluZm86YWN0aXZlLC5idG4taW5mby5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojMjQ3NDhjIFw5fS5idG4taW52ZXJzZXtjb2xvcjojZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojMzYzNjM2OypiYWNrZ3JvdW5kLWNvbG9yOiMyMjI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzQ0NCwjMjIyKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjNDQ0KSx0bygjMjIyKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzQ0NCwjMjIyKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzQ0NCwjMjIyKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzQ0NCwjMjIyKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtib3JkZXItY29sb3I6IzIyMiAjMjIyICMwMDA7Ym9yZGVyLWNvbG9yOnJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjI1KTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjQ0NDQ0NCcsZW5kQ29sb3JzdHI9JyNmZjIyMjIyMicsR3JhZGllbnRUeXBlPTApO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZD1mYWxzZSl9LmJ0bi1pbnZlcnNlOmhvdmVyLC5idG4taW52ZXJzZTphY3RpdmUsLmJ0bi1pbnZlcnNlLmFjdGl2ZSwuYnRuLWludmVyc2UuZGlzYWJsZWQsLmJ0bi1pbnZlcnNlW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzIyMjsqYmFja2dyb3VuZC1jb2xvcjojMTUxNTE1fS5idG4taW52ZXJzZTphY3RpdmUsLmJ0bi1pbnZlcnNlLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMwODA4MDggXDl9YnV0dG9uLmJ0bixpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG57KnBhZGRpbmctdG9wOjNweDsqcGFkZGluZy1ib3R0b206M3B4fWJ1dHRvbi5idG46Oi1tb3otZm9jdXMtaW5uZXIsaW5wdXRbdHlwZT0ic3VibWl0Il0uYnRuOjotbW96LWZvY3VzLWlubmVye3BhZGRpbmc6MDtib3JkZXI6MH1idXR0b24uYnRuLmJ0bi1sYXJnZSxpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG4uYnRuLWxhcmdleypwYWRkaW5nLXRvcDo3cHg7KnBhZGRpbmctYm90dG9tOjdweH1idXR0b24uYnRuLmJ0bi1zbWFsbCxpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG4uYnRuLXNtYWxseypwYWRkaW5nLXRvcDozcHg7KnBhZGRpbmctYm90dG9tOjNweH1idXR0b24uYnRuLmJ0bi1taW5pLGlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi5idG4tbWluaXsqcGFkZGluZy10b3A6MXB4OypwYWRkaW5nLWJvdHRvbToxcHh9LmJ0bi1saW5rLC5idG4tbGluazphY3RpdmUsLmJ0bi1saW5rW2Rpc2FibGVkXXtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JhY2tncm91bmQtaW1hZ2U6bm9uZTstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmV9LmJ0bi1saW5re2NvbG9yOiMwOGM7Y3Vyc29yOnBvaW50ZXI7Ym9yZGVyLWNvbG9yOnRyYW5zcGFyZW50Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MH0uYnRuLWxpbms6aG92ZXJ7Y29sb3I6IzAwNTU4MDt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lO2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnR9LmJ0bi1saW5rW2Rpc2FibGVkXTpob3Zlcntjb2xvcjojMzMzO3RleHQtZGVjb3JhdGlvbjpub25lfS5idG4tZ3JvdXB7cG9zaXRpb246cmVsYXRpdmU7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyptYXJnaW4tbGVmdDouM2VtO2ZvbnQtc2l6ZTowO3doaXRlLXNwYWNlOm5vd3JhcDt2ZXJ0aWNhbC1hbGlnbjptaWRkbGU7Knpvb206MX0uYnRuLWdyb3VwOmZpcnN0LWNoaWxkeyptYXJnaW4tbGVmdDowfS5idG4tZ3JvdXArLmJ0bi1ncm91cHttYXJnaW4tbGVmdDo1cHh9LmJ0bi10b29sYmFye21hcmdpbi10b3A6MTBweDttYXJnaW4tYm90dG9tOjEwcHg7Zm9udC1zaXplOjB9LmJ0bi10b29sYmFyPi5idG4rLmJ0biwuYnRuLXRvb2xiYXI+LmJ0bi1ncm91cCsuYnRuLC5idG4tdG9vbGJhcj4uYnRuKy5idG4tZ3JvdXB7bWFyZ2luLWxlZnQ6NXB4fS5idG4tZ3JvdXA+LmJ0bntwb3NpdGlvbjpyZWxhdGl2ZTstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9LmJ0bi1ncm91cD4uYnRuKy5idG57bWFyZ2luLWxlZnQ6LTFweH0uYnRuLWdyb3VwPi5idG4sLmJ0bi1ncm91cD4uZHJvcGRvd24tbWVudSwuYnRuLWdyb3VwPi5wb3BvdmVye2ZvbnQtc2l6ZToxNHB4fS5idG4tZ3JvdXA+LmJ0bi1taW5pe2ZvbnQtc2l6ZToxMC41cHh9LmJ0bi1ncm91cD4uYnRuLXNtYWxse2ZvbnQtc2l6ZToxMS45cHh9LmJ0bi1ncm91cD4uYnRuLWxhcmdle2ZvbnQtc2l6ZToxNy41cHh9LmJ0bi1ncm91cD4uYnRuOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9LmJ0bi1ncm91cD4uYnRuOmxhc3QtY2hpbGQsLmJ0bi1ncm91cD4uZHJvcGRvd24tdG9nZ2xley13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4fS5idG4tZ3JvdXA+LmJ0bi5sYXJnZTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowOy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo2cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo2cHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo2cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6NnB4fS5idG4tZ3JvdXA+LmJ0bi5sYXJnZTpsYXN0LWNoaWxkLC5idG4tZ3JvdXA+LmxhcmdlLmRyb3Bkb3duLXRvZ2dsZXstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjZweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo2cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo2cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo2cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjZweH0uYnRuLWdyb3VwPi5idG46aG92ZXIsLmJ0bi1ncm91cD4uYnRuOmZvY3VzLC5idG4tZ3JvdXA+LmJ0bjphY3RpdmUsLmJ0bi1ncm91cD4uYnRuLmFjdGl2ZXt6LWluZGV4OjJ9LmJ0bi1ncm91cCAuZHJvcGRvd24tdG9nZ2xlOmFjdGl2ZSwuYnRuLWdyb3VwLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZXtvdXRsaW5lOjB9LmJ0bi1ncm91cD4uYnRuKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjVweDtwYWRkaW5nLXJpZ2h0OjhweDsqcGFkZGluZy1ib3R0b206NXB4O3BhZGRpbmctbGVmdDo4cHg7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEyNSksaW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMiksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEyNSksaW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMiksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMjU1LDI1NSwyNTUsMC4xMjUpLGluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjIpLDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDUpfS5idG4tZ3JvdXA+LmJ0bi1taW5pKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjJweDtwYWRkaW5nLXJpZ2h0OjVweDsqcGFkZGluZy1ib3R0b206MnB4O3BhZGRpbmctbGVmdDo1cHh9LmJ0bi1ncm91cD4uYnRuLXNtYWxsKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjVweDsqcGFkZGluZy1ib3R0b206NHB4fS5idG4tZ3JvdXA+LmJ0bi1sYXJnZSsuZHJvcGRvd24tdG9nZ2xleypwYWRkaW5nLXRvcDo3cHg7cGFkZGluZy1yaWdodDoxMnB4OypwYWRkaW5nLWJvdHRvbTo3cHg7cGFkZGluZy1sZWZ0OjEycHh9LmJ0bi1ncm91cC5vcGVuIC5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1pbWFnZTpub25lOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsMC4xNSksMCAxcHggMnB4IHJnYmEoMCwwLDAsMC4wNSk7Ym94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwwLjE1KSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KX0uYnRuLWdyb3VwLm9wZW4gLmJ0bi5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojZTZlNmU2fS5idG4tZ3JvdXAub3BlbiAuYnRuLXByaW1hcnkuZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzA0Y30uYnRuLWdyb3VwLm9wZW4gLmJ0bi13YXJuaW5nLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDZ9LmJ0bi1ncm91cC5vcGVuIC5idG4tZGFuZ2VyLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNiZDM2MmZ9LmJ0bi1ncm91cC5vcGVuIC5idG4tc3VjY2Vzcy5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojNTFhMzUxfS5idG4tZ3JvdXAub3BlbiAuYnRuLWluZm8uZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzJmOTZiNH0uYnRuLWdyb3VwLm9wZW4gLmJ0bi1pbnZlcnNlLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiMyMjJ9LmJ0biAuY2FyZXR7bWFyZ2luLXRvcDo4cHg7bWFyZ2luLWxlZnQ6MH0uYnRuLW1pbmkgLmNhcmV0LC5idG4tc21hbGwgLmNhcmV0LC5idG4tbGFyZ2UgLmNhcmV0e21hcmdpbi10b3A6NnB4fS5idG4tbGFyZ2UgLmNhcmV0e2JvcmRlci10b3Atd2lkdGg6NXB4O2JvcmRlci1yaWdodC13aWR0aDo1cHg7Ym9yZGVyLWxlZnQtd2lkdGg6NXB4fS5kcm9wdXAgLmJ0bi1sYXJnZSAuY2FyZXR7Ym9yZGVyLWJvdHRvbS13aWR0aDo1cHh9LmJ0bi1wcmltYXJ5IC5jYXJldCwuYnRuLXdhcm5pbmcgLmNhcmV0LC5idG4tZGFuZ2VyIC5jYXJldCwuYnRuLWluZm8gLmNhcmV0LC5idG4tc3VjY2VzcyAuY2FyZXQsLmJ0bi1pbnZlcnNlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmfS5idG4tZ3JvdXAtdmVydGljYWx7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjF9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRue2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bm9uZTttYXgtd2lkdGg6MTAwJTstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRuKy5idG57bWFyZ2luLXRvcDotMXB4O21hcmdpbi1sZWZ0OjB9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRuOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggNHB4IDAgMDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7Ym9yZGVyLXJhZGl1czo0cHggNHB4IDAgMH0uYnRuLWdyb3VwLXZlcnRpY2FsPi5idG46bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA0cHggNHB4O2JvcmRlci1yYWRpdXM6MCAwIDRweCA0cHh9LmJ0bi1ncm91cC12ZXJ0aWNhbD4uYnRuLWxhcmdlOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHggNnB4IDAgMDstbW96LWJvcmRlci1yYWRpdXM6NnB4IDZweCAwIDA7Ym9yZGVyLXJhZGl1czo2cHggNnB4IDAgMH0uYnRuLWdyb3VwLXZlcnRpY2FsPi5idG4tbGFyZ2U6bGFzdC1jaGlsZHstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6MCAwIDZweCA2cHh9LmFsZXJ0e3BhZGRpbmc6OHB4IDM1cHggOHB4IDE0cHg7bWFyZ2luLWJvdHRvbToyMHB4O3RleHQtc2hhZG93OjAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjUpO2JhY2tncm91bmQtY29sb3I6I2ZjZjhlMztib3JkZXI6MXB4IHNvbGlkICNmYmVlZDU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4fS5hbGVydCwuYWxlcnQgaDR7Y29sb3I6I2MwOTg1M30uYWxlcnQgaDR7bWFyZ2luOjB9LmFsZXJ0IC5jbG9zZXtwb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LTJweDtyaWdodDotMjFweDtsaW5lLWhlaWdodDoyMHB4fS5hbGVydC1zdWNjZXNze2NvbG9yOiM0Njg4NDc7YmFja2dyb3VuZC1jb2xvcjojZGZmMGQ4O2JvcmRlci1jb2xvcjojZDZlOWM2fS5hbGVydC1zdWNjZXNzIGg0e2NvbG9yOiM0Njg4NDd9LmFsZXJ0LWRhbmdlciwuYWxlcnQtZXJyb3J7Y29sb3I6I2I5NGE0ODtiYWNrZ3JvdW5kLWNvbG9yOiNmMmRlZGU7Ym9yZGVyLWNvbG9yOiNlZWQzZDd9LmFsZXJ0LWRhbmdlciBoNCwuYWxlcnQtZXJyb3IgaDR7Y29sb3I6I2I5NGE0OH0uYWxlcnQtaW5mb3tjb2xvcjojM2E4N2FkO2JhY2tncm91bmQtY29sb3I6I2Q5ZWRmNztib3JkZXItY29sb3I6I2JjZThmMX0uYWxlcnQtaW5mbyBoNHtjb2xvcjojM2E4N2FkfS5hbGVydC1ibG9ja3twYWRkaW5nLXRvcDoxNHB4O3BhZGRpbmctYm90dG9tOjE0cHh9LmFsZXJ0LWJsb2NrPnAsLmFsZXJ0LWJsb2NrPnVse21hcmdpbi1ib3R0b206MH0uYWxlcnQtYmxvY2sgcCtwe21hcmdpbi10b3A6NXB4fS5uYXZ7bWFyZ2luLWJvdHRvbToyMHB4O21hcmdpbi1sZWZ0OjA7bGlzdC1zdHlsZTpub25lfS5uYXY+bGk+YXtkaXNwbGF5OmJsb2NrfS5uYXY+bGk+YTpob3Zlcnt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNlZWV9Lm5hdj5saT5hPmltZ3ttYXgtd2lkdGg6bm9uZX0ubmF2Pi5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0fS5uYXYtaGVhZGVye2Rpc3BsYXk6YmxvY2s7cGFkZGluZzozcHggMTVweDtmb250LXNpemU6MTFweDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6Izk5OTt0ZXh0LXNoYWRvdzowIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsMC41KTt0ZXh0LXRyYW5zZm9ybTp1cHBlcmNhc2V9Lm5hdiBsaSsubmF2LWhlYWRlcnttYXJnaW4tdG9wOjlweH0ubmF2LWxpc3R7cGFkZGluZy1yaWdodDoxNXB4O3BhZGRpbmctbGVmdDoxNXB4O21hcmdpbi1ib3R0b206MH0ubmF2LWxpc3Q+bGk+YSwubmF2LWxpc3QgLm5hdi1oZWFkZXJ7bWFyZ2luLXJpZ2h0Oi0xNXB4O21hcmdpbi1sZWZ0Oi0xNXB4O3RleHQtc2hhZG93OjAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjUpfS5uYXYtbGlzdD5saT5he3BhZGRpbmc6M3B4IDE1cHh9Lm5hdi1saXN0Pi5hY3RpdmU+YSwubmF2LWxpc3Q+LmFjdGl2ZT5hOmhvdmVye2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjIpO2JhY2tncm91bmQtY29sb3I6IzA4Y30ubmF2LWxpc3QgW2NsYXNzXj0iaWNvbi0iXSwubmF2LWxpc3QgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXJpZ2h0OjJweH0ubmF2LWxpc3QgLmRpdmlkZXJ7KndpZHRoOjEwMCU7aGVpZ2h0OjFweDttYXJnaW46OXB4IDFweDsqbWFyZ2luOi01cHggMCA1cHg7b3ZlcmZsb3c6aGlkZGVuO2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZmZmfS5uYXYtdGFicywubmF2LXBpbGxzeyp6b29tOjF9Lm5hdi10YWJzOmJlZm9yZSwubmF2LXBpbGxzOmJlZm9yZSwubmF2LXRhYnM6YWZ0ZXIsLm5hdi1waWxsczphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ubmF2LXRhYnM6YWZ0ZXIsLm5hdi1waWxsczphZnRlcntjbGVhcjpib3RofS5uYXYtdGFicz5saSwubmF2LXBpbGxzPmxpe2Zsb2F0OmxlZnR9Lm5hdi10YWJzPmxpPmEsLm5hdi1waWxscz5saT5he3BhZGRpbmctcmlnaHQ6MTJweDtwYWRkaW5nLWxlZnQ6MTJweDttYXJnaW4tcmlnaHQ6MnB4O2xpbmUtaGVpZ2h0OjE0cHh9Lm5hdi10YWJze2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNkZGR9Lm5hdi10YWJzPmxpe21hcmdpbi1ib3R0b206LTFweH0ubmF2LXRhYnM+bGk+YXtwYWRkaW5nLXRvcDo4cHg7cGFkZGluZy1ib3R0b206OHB4O2xpbmUtaGVpZ2h0OjIwcHg7Ym9yZGVyOjFweCBzb2xpZCB0cmFuc3BhcmVudDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7LW1vei1ib3JkZXItcmFkaXVzOjRweCA0cHggMCAwO2JvcmRlci1yYWRpdXM6NHB4IDRweCAwIDB9Lm5hdi10YWJzPmxpPmE6aG92ZXJ7Ym9yZGVyLWNvbG9yOiNlZWUgI2VlZSAjZGRkfS5uYXYtdGFicz4uYWN0aXZlPmEsLm5hdi10YWJzPi5hY3RpdmU+YTpob3Zlcntjb2xvcjojNTU1O2N1cnNvcjpkZWZhdWx0O2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MXB4IHNvbGlkICNkZGQ7Ym9yZGVyLWJvdHRvbS1jb2xvcjp0cmFuc3BhcmVudH0ubmF2LXBpbGxzPmxpPmF7cGFkZGluZy10b3A6OHB4O3BhZGRpbmctYm90dG9tOjhweDttYXJnaW4tdG9wOjJweDttYXJnaW4tYm90dG9tOjJweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NXB4Oy1tb3otYm9yZGVyLXJhZGl1czo1cHg7Ym9yZGVyLXJhZGl1czo1cHh9Lm5hdi1waWxscz4uYWN0aXZlPmEsLm5hdi1waWxscz4uYWN0aXZlPmE6aG92ZXJ7Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMwOGN9Lm5hdi1zdGFja2VkPmxpe2Zsb2F0Om5vbmV9Lm5hdi1zdGFja2VkPmxpPmF7bWFyZ2luLXJpZ2h0OjB9Lm5hdi10YWJzLm5hdi1zdGFja2Vke2JvcmRlci1ib3R0b206MH0ubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk+YXtib3JkZXI6MXB4IHNvbGlkICNkZGQ7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowfS5uYXYtdGFicy5uYXYtc3RhY2tlZD5saTpmaXJzdC1jaGlsZD5hey13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6NHB4fS5uYXYtdGFicy5uYXYtc3RhY2tlZD5saTpsYXN0LWNoaWxkPmF7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo0cHh9Lm5hdi10YWJzLm5hdi1zdGFja2VkPmxpPmE6aG92ZXJ7ei1pbmRleDoyO2JvcmRlci1jb2xvcjojZGRkfS5uYXYtcGlsbHMubmF2LXN0YWNrZWQ+bGk+YXttYXJnaW4tYm90dG9tOjNweH0ubmF2LXBpbGxzLm5hdi1zdGFja2VkPmxpOmxhc3QtY2hpbGQ+YXttYXJnaW4tYm90dG9tOjFweH0ubmF2LXRhYnMgLmRyb3Bkb3duLW1lbnV7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4Oy1tb3otYm9yZGVyLXJhZGl1czowIDAgNnB4IDZweDtib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4fS5uYXYtcGlsbHMgLmRyb3Bkb3duLW1lbnV7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4fS5uYXYgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7bWFyZ2luLXRvcDo2cHg7Ym9yZGVyLXRvcC1jb2xvcjojMDhjO2JvcmRlci1ib3R0b20tY29sb3I6IzA4Y30ubmF2IC5kcm9wZG93bi10b2dnbGU6aG92ZXIgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6IzAwNTU4MDtib3JkZXItYm90dG9tLWNvbG9yOiMwMDU1ODB9Lm5hdi10YWJzIC5kcm9wZG93bi10b2dnbGUgLmNhcmV0e21hcmdpbi10b3A6OHB4fS5uYXYgLmFjdGl2ZSAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmfS5uYXYtdGFicyAuYWN0aXZlIC5kcm9wZG93bi10b2dnbGUgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6IzU1NTtib3JkZXItYm90dG9tLWNvbG9yOiM1NTV9Lm5hdj4uZHJvcGRvd24uYWN0aXZlPmE6aG92ZXJ7Y3Vyc29yOnBvaW50ZXJ9Lm5hdi10YWJzIC5vcGVuIC5kcm9wZG93bi10b2dnbGUsLm5hdi1waWxscyAub3BlbiAuZHJvcGRvd24tdG9nZ2xlLC5uYXY+bGkuZHJvcGRvd24ub3Blbi5hY3RpdmU+YTpob3Zlcntjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6Izk5OTtib3JkZXItY29sb3I6Izk5OX0ubmF2IGxpLmRyb3Bkb3duLm9wZW4gLmNhcmV0LC5uYXYgbGkuZHJvcGRvd24ub3Blbi5hY3RpdmUgLmNhcmV0LC5uYXYgbGkuZHJvcGRvd24ub3BlbiBhOmhvdmVyIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmO29wYWNpdHk6MTtmaWx0ZXI6YWxwaGEob3BhY2l0eT0xMDApfS50YWJzLXN0YWNrZWQgLm9wZW4+YTpob3Zlcntib3JkZXItY29sb3I6Izk5OX0udGFiYmFibGV7Knpvb206MX0udGFiYmFibGU6YmVmb3JlLC50YWJiYWJsZTphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0udGFiYmFibGU6YWZ0ZXJ7Y2xlYXI6Ym90aH0udGFiLWNvbnRlbnR7b3ZlcmZsb3c6YXV0b30udGFicy1iZWxvdz4ubmF2LXRhYnMsLnRhYnMtcmlnaHQ+Lm5hdi10YWJzLC50YWJzLWxlZnQ+Lm5hdi10YWJze2JvcmRlci1ib3R0b206MH0udGFiLWNvbnRlbnQ+LnRhYi1wYW5lLC5waWxsLWNvbnRlbnQ+LnBpbGwtcGFuZXtkaXNwbGF5Om5vbmV9LnRhYi1jb250ZW50Pi5hY3RpdmUsLnBpbGwtY29udGVudD4uYWN0aXZle2Rpc3BsYXk6YmxvY2t9LnRhYnMtYmVsb3c+Lm5hdi10YWJze2JvcmRlci10b3A6MXB4IHNvbGlkICNkZGR9LnRhYnMtYmVsb3c+Lm5hdi10YWJzPmxpe21hcmdpbi10b3A6LTFweDttYXJnaW4tYm90dG9tOjB9LnRhYnMtYmVsb3c+Lm5hdi10YWJzPmxpPmF7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgMCA0cHggNHB4Oy1tb3otYm9yZGVyLXJhZGl1czowIDAgNHB4IDRweDtib3JkZXItcmFkaXVzOjAgMCA0cHggNHB4fS50YWJzLWJlbG93Pi5uYXYtdGFicz5saT5hOmhvdmVye2JvcmRlci10b3AtY29sb3I6I2RkZDtib3JkZXItYm90dG9tLWNvbG9yOnRyYW5zcGFyZW50fS50YWJzLWJlbG93Pi5uYXYtdGFicz4uYWN0aXZlPmEsLnRhYnMtYmVsb3c+Lm5hdi10YWJzPi5hY3RpdmU+YTpob3Zlcntib3JkZXItY29sb3I6dHJhbnNwYXJlbnQgI2RkZCAjZGRkICNkZGR9LnRhYnMtbGVmdD4ubmF2LXRhYnM+bGksLnRhYnMtcmlnaHQ+Lm5hdi10YWJzPmxpe2Zsb2F0Om5vbmV9LnRhYnMtbGVmdD4ubmF2LXRhYnM+bGk+YSwudGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YXttaW4td2lkdGg6NzRweDttYXJnaW4tcmlnaHQ6MDttYXJnaW4tYm90dG9tOjNweH0udGFicy1sZWZ0Pi5uYXYtdGFic3tmbG9hdDpsZWZ0O21hcmdpbi1yaWdodDoxOXB4O2JvcmRlci1yaWdodDoxcHggc29saWQgI2RkZH0udGFicy1sZWZ0Pi5uYXYtdGFicz5saT5he21hcmdpbi1yaWdodDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweH0udGFicy1sZWZ0Pi5uYXYtdGFicz5saT5hOmhvdmVye2JvcmRlci1jb2xvcjojZWVlICNkZGQgI2VlZSAjZWVlfS50YWJzLWxlZnQ+Lm5hdi10YWJzIC5hY3RpdmU+YSwudGFicy1sZWZ0Pi5uYXYtdGFicyAuYWN0aXZlPmE6aG92ZXJ7Ym9yZGVyLWNvbG9yOiNkZGQgdHJhbnNwYXJlbnQgI2RkZCAjZGRkOypib3JkZXItcmlnaHQtY29sb3I6I2ZmZn0udGFicy1yaWdodD4ubmF2LXRhYnN7ZmxvYXQ6cmlnaHQ7bWFyZ2luLWxlZnQ6MTlweDtib3JkZXItbGVmdDoxcHggc29saWQgI2RkZH0udGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YXttYXJnaW4tbGVmdDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH0udGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YTpob3Zlcntib3JkZXItY29sb3I6I2VlZSAjZWVlICNlZWUgI2RkZH0udGFicy1yaWdodD4ubmF2LXRhYnMgLmFjdGl2ZT5hLC50YWJzLXJpZ2h0Pi5uYXYtdGFicyAuYWN0aXZlPmE6aG92ZXJ7Ym9yZGVyLWNvbG9yOiNkZGQgI2RkZCAjZGRkIHRyYW5zcGFyZW50Oypib3JkZXItbGVmdC1jb2xvcjojZmZmfS5uYXY+LmRpc2FibGVkPmF7Y29sb3I6Izk5OX0ubmF2Pi5kaXNhYmxlZD5hOmhvdmVye3RleHQtZGVjb3JhdGlvbjpub25lO2N1cnNvcjpkZWZhdWx0O2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnR9Lm5hdmJhcnsqcG9zaXRpb246cmVsYXRpdmU7KnotaW5kZXg6MjttYXJnaW4tYm90dG9tOjIwcHg7b3ZlcmZsb3c6dmlzaWJsZX0ubmF2YmFyLWlubmVye21pbi1oZWlnaHQ6NDBweDtwYWRkaW5nLXJpZ2h0OjIwcHg7cGFkZGluZy1sZWZ0OjIwcHg7YmFja2dyb3VuZC1jb2xvcjojZmFmYWZhO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2YyZjJmMik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2ZmZiksdG8oI2YyZjJmMikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2YyZjJmMik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmZmYsI2YyZjJmMik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNmZmYsI2YyZjJmMik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7Ym9yZGVyOjFweCBzb2xpZCAjZDRkNGQ0Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmZmZmZmZicsZW5kQ29sb3JzdHI9JyNmZmYyZjJmMicsR3JhZGllbnRUeXBlPTApOyp6b29tOjE7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDRweCByZ2JhKDAsMCwwLDAuMDY1KTstbW96LWJveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwwLDAsMC4wNjUpO2JveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwwLDAsMC4wNjUpfS5uYXZiYXItaW5uZXI6YmVmb3JlLC5uYXZiYXItaW5uZXI6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9Lm5hdmJhci1pbm5lcjphZnRlcntjbGVhcjpib3RofS5uYXZiYXIgLmNvbnRhaW5lcnt3aWR0aDphdXRvfS5uYXYtY29sbGFwc2UuY29sbGFwc2V7aGVpZ2h0OmF1dG87b3ZlcmZsb3c6dmlzaWJsZX0ubmF2YmFyIC5icmFuZHtkaXNwbGF5OmJsb2NrO2Zsb2F0OmxlZnQ7cGFkZGluZzoxMHB4IDIwcHggMTBweDttYXJnaW4tbGVmdDotMjBweDtmb250LXNpemU6MjBweDtmb250LXdlaWdodDoyMDA7Y29sb3I6Izc3Nzt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmZ9Lm5hdmJhciAuYnJhbmQ6aG92ZXJ7dGV4dC1kZWNvcmF0aW9uOm5vbmV9Lm5hdmJhci10ZXh0e21hcmdpbi1ib3R0b206MDtsaW5lLWhlaWdodDo0MHB4O2NvbG9yOiM3Nzd9Lm5hdmJhci1saW5re2NvbG9yOiM3Nzd9Lm5hdmJhci1saW5rOmhvdmVye2NvbG9yOiMzMzN9Lm5hdmJhciAuZGl2aWRlci12ZXJ0aWNhbHtoZWlnaHQ6NDBweDttYXJnaW46MCA5cHg7Ym9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZmZmO2JvcmRlci1sZWZ0OjFweCBzb2xpZCAjZjJmMmYyfS5uYXZiYXIgLmJ0biwubmF2YmFyIC5idG4tZ3JvdXB7bWFyZ2luLXRvcDo1cHh9Lm5hdmJhciAuYnRuLWdyb3VwIC5idG4sLm5hdmJhciAuaW5wdXQtcHJlcGVuZCAuYnRuLC5uYXZiYXIgLmlucHV0LWFwcGVuZCAuYnRue21hcmdpbi10b3A6MH0ubmF2YmFyLWZvcm17bWFyZ2luLWJvdHRvbTowOyp6b29tOjF9Lm5hdmJhci1mb3JtOmJlZm9yZSwubmF2YmFyLWZvcm06YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtsaW5lLWhlaWdodDowO2NvbnRlbnQ6IiJ9Lm5hdmJhci1mb3JtOmFmdGVye2NsZWFyOmJvdGh9Lm5hdmJhci1mb3JtIGlucHV0LC5uYXZiYXItZm9ybSBzZWxlY3QsLm5hdmJhci1mb3JtIC5yYWRpbywubmF2YmFyLWZvcm0gLmNoZWNrYm94e21hcmdpbi10b3A6NXB4fS5uYXZiYXItZm9ybSBpbnB1dCwubmF2YmFyLWZvcm0gc2VsZWN0LC5uYXZiYXItZm9ybSAuYnRue2Rpc3BsYXk6aW5saW5lLWJsb2NrO21hcmdpbi1ib3R0b206MH0ubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0iaW1hZ2UiXSwubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0iY2hlY2tib3giXSwubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0icmFkaW8iXXttYXJnaW4tdG9wOjNweH0ubmF2YmFyLWZvcm0gLmlucHV0LWFwcGVuZCwubmF2YmFyLWZvcm0gLmlucHV0LXByZXBlbmR7bWFyZ2luLXRvcDo1cHg7d2hpdGUtc3BhY2U6bm93cmFwfS5uYXZiYXItZm9ybSAuaW5wdXQtYXBwZW5kIGlucHV0LC5uYXZiYXItZm9ybSAuaW5wdXQtcHJlcGVuZCBpbnB1dHttYXJnaW4tdG9wOjB9Lm5hdmJhci1zZWFyY2h7cG9zaXRpb246cmVsYXRpdmU7ZmxvYXQ6bGVmdDttYXJnaW4tdG9wOjVweDttYXJnaW4tYm90dG9tOjB9Lm5hdmJhci1zZWFyY2ggLnNlYXJjaC1xdWVyeXtwYWRkaW5nOjRweCAxNHB4O21hcmdpbi1ib3R0b206MDtmb250LWZhbWlseToiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxBcmlhbCxzYW5zLXNlcmlmO2ZvbnQtc2l6ZToxM3B4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoxOy13ZWJraXQtYm9yZGVyLXJhZGl1czoxNXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNXB4O2JvcmRlci1yYWRpdXM6MTVweH0ubmF2YmFyLXN0YXRpYy10b3B7cG9zaXRpb246c3RhdGljO21hcmdpbi1ib3R0b206MH0ubmF2YmFyLXN0YXRpYy10b3AgLm5hdmJhci1pbm5lcnstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9Lm5hdmJhci1maXhlZC10b3AsLm5hdmJhci1maXhlZC1ib3R0b217cG9zaXRpb246Zml4ZWQ7cmlnaHQ6MDtsZWZ0OjA7ei1pbmRleDoxMDMwO21hcmdpbi1ib3R0b206MH0ubmF2YmFyLWZpeGVkLXRvcCAubmF2YmFyLWlubmVyLC5uYXZiYXItc3RhdGljLXRvcCAubmF2YmFyLWlubmVye2JvcmRlci13aWR0aDowIDAgMXB4fS5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7Ym9yZGVyLXdpZHRoOjFweCAwIDB9Lm5hdmJhci1maXhlZC10b3AgLm5hdmJhci1pbm5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2YmFyLWlubmVye3BhZGRpbmctcmlnaHQ6MDtwYWRkaW5nLWxlZnQ6MDstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjB9Lm5hdmJhci1zdGF0aWMtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAuY29udGFpbmVye3dpZHRoOjk0MHB4fS5uYXZiYXItZml4ZWQtdG9we3RvcDowfS5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1zdGF0aWMtdG9wIC5uYXZiYXItaW5uZXJ7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpOy1tb3otYm94LXNoYWRvdzowIDFweCAxMHB4IHJnYmEoMCwwLDAsMC4xKTtib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpfS5uYXZiYXItZml4ZWQtYm90dG9te2JvdHRvbTowfS5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7LXdlYmtpdC1ib3gtc2hhZG93OjAgLTFweCAxMHB4IHJnYmEoMCwwLDAsMC4xKTstbW96LWJveC1zaGFkb3c6MCAtMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpO2JveC1zaGFkb3c6MCAtMXB4IDEwcHggcmdiYSgwLDAsMCwwLjEpfS5uYXZiYXIgLm5hdntwb3NpdGlvbjpyZWxhdGl2ZTtsZWZ0OjA7ZGlzcGxheTpibG9jaztmbG9hdDpsZWZ0O21hcmdpbjowIDEwcHggMCAwfS5uYXZiYXIgLm5hdi5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O21hcmdpbi1yaWdodDowfS5uYXZiYXIgLm5hdj5saXtmbG9hdDpsZWZ0fS5uYXZiYXIgLm5hdj5saT5he2Zsb2F0Om5vbmU7cGFkZGluZzoxMHB4IDE1cHggMTBweDtjb2xvcjojNzc3O3RleHQtZGVjb3JhdGlvbjpub25lO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZn0ubmF2YmFyIC5uYXYgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7bWFyZ2luLXRvcDo4cHh9Lm5hdmJhciAubmF2PmxpPmE6Zm9jdXMsLm5hdmJhciAubmF2PmxpPmE6aG92ZXJ7Y29sb3I6IzMzMzt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5uYXZiYXIgLm5hdj4uYWN0aXZlPmEsLm5hdmJhciAubmF2Pi5hY3RpdmU+YTpob3ZlciwubmF2YmFyIC5uYXY+LmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiM1NTU7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDNweCA4cHggcmdiYSgwLDAsMCwwLjEyNSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgM3B4IDhweCByZ2JhKDAsMCwwLDAuMTI1KTtib3gtc2hhZG93Omluc2V0IDAgM3B4IDhweCByZ2JhKDAsMCwwLDAuMTI1KX0ubmF2YmFyIC5idG4tbmF2YmFye2Rpc3BsYXk6bm9uZTtmbG9hdDpyaWdodDtwYWRkaW5nOjdweCAxMHB4O21hcmdpbi1yaWdodDo1cHg7bWFyZ2luLWxlZnQ6NXB4O2NvbG9yOiNmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiNlZGVkZWQ7KmJhY2tncm91bmQtY29sb3I6I2U1ZTVlNTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNmMmYyZjIpLHRvKCNlNWU1ZTUpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjZjJmMmYyLCNlNWU1ZTUpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2JvcmRlci1jb2xvcjojZTVlNWU1ICNlNWU1ZTUgI2JmYmZiZjtib3JkZXItY29sb3I6cmdiYSgwLDAsMCwwLjEpIHJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMjUpO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZjJmMmYyJyxlbmRDb2xvcnN0cj0nI2ZmZTVlNWU1JyxHcmFkaWVudFR5cGU9MCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkPWZhbHNlKTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjEpLDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjA3NSl9Lm5hdmJhciAuYnRuLW5hdmJhcjpob3ZlciwubmF2YmFyIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyIC5idG4tbmF2YmFyLmFjdGl2ZSwubmF2YmFyIC5idG4tbmF2YmFyLmRpc2FibGVkLC5uYXZiYXIgLmJ0bi1uYXZiYXJbZGlzYWJsZWRde2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1OypiYWNrZ3JvdW5kLWNvbG9yOiNkOWQ5ZDl9Lm5hdmJhciAuYnRuLW5hdmJhcjphY3RpdmUsLm5hdmJhciAuYnRuLW5hdmJhci5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojY2NjIFw5fS5uYXZiYXIgLmJ0bi1uYXZiYXIgLmljb24tYmFye2Rpc3BsYXk6YmxvY2s7d2lkdGg6MThweDtoZWlnaHQ6MnB4O2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTstd2Via2l0LWJvcmRlci1yYWRpdXM6MXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxcHg7Ym9yZGVyLXJhZGl1czoxcHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDAgcmdiYSgwLDAsMCwwLjI1KTstbW96LWJveC1zaGFkb3c6MCAxcHggMCByZ2JhKDAsMCwwLDAuMjUpO2JveC1zaGFkb3c6MCAxcHggMCByZ2JhKDAsMCwwLDAuMjUpfS5idG4tbmF2YmFyIC5pY29uLWJhcisuaWNvbi1iYXJ7bWFyZ2luLXRvcDozcHh9Lm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZXtwb3NpdGlvbjphYnNvbHV0ZTt0b3A6LTdweDtsZWZ0OjlweDtkaXNwbGF5OmlubGluZS1ibG9jaztib3JkZXItcmlnaHQ6N3B4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1ib3R0b206N3B4IHNvbGlkICNjY2M7Ym9yZGVyLWxlZnQ6N3B4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1ib3R0b20tY29sb3I6cmdiYSgwLDAsMCwwLjIpO2NvbnRlbnQ6Jyd9Lm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51OmFmdGVye3Bvc2l0aW9uOmFic29sdXRlO3RvcDotNnB4O2xlZnQ6MTBweDtkaXNwbGF5OmlubGluZS1ibG9jaztib3JkZXItcmlnaHQ6NnB4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1ib3R0b206NnB4IHNvbGlkICNmZmY7Ym9yZGVyLWxlZnQ6NnB4IHNvbGlkIHRyYW5zcGFyZW50O2NvbnRlbnQ6Jyd9Lm5hdmJhci1maXhlZC1ib3R0b20gLm5hdj5saT4uZHJvcGRvd24tbWVudTpiZWZvcmV7dG9wOmF1dG87Ym90dG9tOi03cHg7Ym9yZGVyLXRvcDo3cHggc29saWQgI2NjYztib3JkZXItYm90dG9tOjA7Ym9yZGVyLXRvcC1jb2xvcjpyZ2JhKDAsMCwwLDAuMil9Lm5hdmJhci1maXhlZC1ib3R0b20gLm5hdj5saT4uZHJvcGRvd24tbWVudTphZnRlcnt0b3A6YXV0bztib3R0b206LTZweDtib3JkZXItdG9wOjZweCBzb2xpZCAjZmZmO2JvcmRlci1ib3R0b206MH0ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24+YTpob3ZlciAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojNTU1O2JvcmRlci1ib3R0b20tY29sb3I6IzU1NX0ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZXtjb2xvcjojNTU1O2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNX0ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojNzc3O2JvcmRlci1ib3R0b20tY29sb3I6Izc3N30ubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldCwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM1NTU7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNTU1fS5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHR7cmlnaHQ6MDtsZWZ0OmF1dG99Lm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudTpiZWZvcmUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQ6YmVmb3Jle3JpZ2h0OjEycHg7bGVmdDphdXRvfS5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXIsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQ6YWZ0ZXJ7cmlnaHQ6MTNweDtsZWZ0OmF1dG99Lm5hdmJhciAucHVsbC1yaWdodD5saT4uZHJvcGRvd24tbWVudSAuZHJvcGRvd24tbWVudSwubmF2YmFyIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnUucHVsbC1yaWdodCAuZHJvcGRvd24tbWVudXtyaWdodDoxMDAlO2xlZnQ6YXV0bzttYXJnaW4tcmlnaHQ6LTFweDttYXJnaW4tbGVmdDowOy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHggMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweH0ubmF2YmFyLWludmVyc2UgLm5hdmJhci1pbm5lcntiYWNrZ3JvdW5kLWNvbG9yOiMxYjFiMWI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzIyMiwjMTExKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjMjIyKSx0bygjMTExKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzIyMiwjMTExKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzIyMiwjMTExKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzIyMiwjMTExKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtib3JkZXItY29sb3I6IzI1MjUyNTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjIyMjIyMicsZW5kQ29sb3JzdHI9JyNmZjExMTExMScsR3JhZGllbnRUeXBlPTApfS5uYXZiYXItaW52ZXJzZSAuYnJhbmQsLm5hdmJhci1pbnZlcnNlIC5uYXY+bGk+YXtjb2xvcjojOTk5O3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSl9Lm5hdmJhci1pbnZlcnNlIC5icmFuZDpob3ZlciwubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmhvdmVye2NvbG9yOiNmZmZ9Lm5hdmJhci1pbnZlcnNlIC5icmFuZHtjb2xvcjojOTk5fS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXRleHR7Y29sb3I6Izk5OX0ubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmZvY3VzLC5uYXZiYXItaW52ZXJzZSAubmF2PmxpPmE6aG92ZXJ7Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5uYXZiYXItaW52ZXJzZSAubmF2IC5hY3RpdmU+YSwubmF2YmFyLWludmVyc2UgLm5hdiAuYWN0aXZlPmE6aG92ZXIsLm5hdmJhci1pbnZlcnNlIC5uYXYgLmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiNmZmY7YmFja2dyb3VuZC1jb2xvcjojMTExfS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLWxpbmt7Y29sb3I6Izk5OX0ubmF2YmFyLWludmVyc2UgLm5hdmJhci1saW5rOmhvdmVye2NvbG9yOiNmZmZ9Lm5hdmJhci1pbnZlcnNlIC5kaXZpZGVyLXZlcnRpY2Fse2JvcmRlci1yaWdodC1jb2xvcjojMjIyO2JvcmRlci1sZWZ0LWNvbG9yOiMxMTF9Lm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPi5kcm9wZG93bi10b2dnbGV7Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMxMTF9Lm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24+YTpob3ZlciAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZn0ubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM5OTk7Ym9yZGVyLWJvdHRvbS1jb2xvcjojOTk5fS5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXQsLm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6I2ZmZjtib3JkZXItYm90dG9tLWNvbG9yOiNmZmZ9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnl7Y29sb3I6I2ZmZjtiYWNrZ3JvdW5kLWNvbG9yOiM1MTUxNTE7Ym9yZGVyLWNvbG9yOiMxMTE7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMTUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwwLjEpLDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwwLjE1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSksMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LDAuMTUpOy13ZWJraXQtdHJhbnNpdGlvbjpub25lOy1tb3otdHJhbnNpdGlvbjpub25lOy1vLXRyYW5zaXRpb246bm9uZTt0cmFuc2l0aW9uOm5vbmV9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6LW1vei1wbGFjZWhvbGRlcntjb2xvcjojY2NjfS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5Oi1tcy1pbnB1dC1wbGFjZWhvbGRlcntjb2xvcjojY2NjfS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiNjY2N9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6Zm9jdXMsLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnkuZm9jdXNlZHtwYWRkaW5nOjVweCAxNXB4O2NvbG9yOiMzMzM7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmO2JhY2tncm91bmQtY29sb3I6I2ZmZjtib3JkZXI6MDtvdXRsaW5lOjA7LXdlYmtpdC1ib3gtc2hhZG93OjAgMCAzcHggcmdiYSgwLDAsMCwwLjE1KTstbW96LWJveC1zaGFkb3c6MCAwIDNweCByZ2JhKDAsMCwwLDAuMTUpO2JveC1zaGFkb3c6MCAwIDNweCByZ2JhKDAsMCwwLDAuMTUpfS5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcntjb2xvcjojZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojMGUwZTBlOypiYWNrZ3JvdW5kLWNvbG9yOiMwNDA0MDQ7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjMTUxNTE1KSx0bygjMDQwNDA0KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzE1MTUxNSwjMDQwNDA0KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtib3JkZXItY29sb3I6IzA0MDQwNCAjMDQwNDA0ICMwMDA7Ym9yZGVyLWNvbG9yOnJnYmEoMCwwLDAsMC4xKSByZ2JhKDAsMCwwLDAuMSkgcmdiYSgwLDAsMCwwLjI1KTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjE1MTUxNScsZW5kQ29sb3JzdHI9JyNmZjA0MDQwNCcsR3JhZGllbnRUeXBlPTApO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZD1mYWxzZSl9Lm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcjphY3RpdmUsLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyLmFjdGl2ZSwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXIuZGlzYWJsZWQsLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyW2Rpc2FibGVkXXtjb2xvcjojZmZmO2JhY2tncm91bmQtY29sb3I6IzA0MDQwNDsqYmFja2dyb3VuZC1jb2xvcjojMDAwfS5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcjphY3RpdmUsLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMwMDAgXDl9LmJyZWFkY3J1bWJ7cGFkZGluZzo4cHggMTVweDttYXJnaW46MCAwIDIwcHg7bGlzdC1zdHlsZTpub25lO2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHh9LmJyZWFkY3J1bWI+bGl7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lO3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZjsqem9vbToxfS5icmVhZGNydW1iPmxpPi5kaXZpZGVye3BhZGRpbmc6MCA1cHg7Y29sb3I6I2NjY30uYnJlYWRjcnVtYj4uYWN0aXZle2NvbG9yOiM5OTl9LnBhZ2luYXRpb257bWFyZ2luOjIwcHggMH0ucGFnaW5hdGlvbiB1bHtkaXNwbGF5OmlubGluZS1ibG9jazsqZGlzcGxheTppbmxpbmU7bWFyZ2luLWJvdHRvbTowO21hcmdpbi1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4Oyp6b29tOjE7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDUpOy1tb3otYm94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLDAsMCwwLjA1KTtib3gtc2hhZG93OjAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMDUpfS5wYWdpbmF0aW9uIHVsPmxpe2Rpc3BsYXk6aW5saW5lfS5wYWdpbmF0aW9uIHVsPmxpPmEsLnBhZ2luYXRpb24gdWw+bGk+c3BhbntmbG9hdDpsZWZ0O3BhZGRpbmc6NHB4IDEycHg7bGluZS1oZWlnaHQ6MjBweDt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZGRkO2JvcmRlci1sZWZ0LXdpZHRoOjB9LnBhZ2luYXRpb24gdWw+bGk+YTpob3ZlciwucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNX0ucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2NvbG9yOiM5OTk7Y3Vyc29yOmRlZmF1bHR9LnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPnNwYW4sLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmEsLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmE6aG92ZXJ7Y29sb3I6Izk5OTtjdXJzb3I6ZGVmYXVsdDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50fS5wYWdpbmF0aW9uIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24gdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbntib3JkZXItbGVmdC13aWR0aDoxcHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHh9LnBhZ2luYXRpb24gdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uIHVsPmxpOmxhc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjRweH0ucGFnaW5hdGlvbi1jZW50ZXJlZHt0ZXh0LWFsaWduOmNlbnRlcn0ucGFnaW5hdGlvbi1yaWdodHt0ZXh0LWFsaWduOnJpZ2h0fS5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk+c3BhbntwYWRkaW5nOjExcHggMTlweDtmb250LXNpemU6MTcuNXB4fS5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4O2JvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4Oy13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czo2cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjZweH0ucGFnaW5hdGlvbi1sYXJnZSB1bD5saTpsYXN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6bGFzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjZweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjZweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjZweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NnB4fS5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czozcHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czozcHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjNweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDozcHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6M3B4fS5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLXNtYWxsIHVsPmxpOmxhc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1taW5pIHVsPmxpOmxhc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpsYXN0LWNoaWxkPnNwYW57LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czozcHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6M3B4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6M3B4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6M3B4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDozcHh9LnBhZ2luYXRpb24tc21hbGwgdWw+bGk+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saT5zcGFue3BhZGRpbmc6MnB4IDEwcHg7Zm9udC1zaXplOjExLjlweH0ucGFnaW5hdGlvbi1taW5pIHVsPmxpPmEsLnBhZ2luYXRpb24tbWluaSB1bD5saT5zcGFue3BhZGRpbmc6MCA2cHg7Zm9udC1zaXplOjEwLjVweH0ucGFnZXJ7bWFyZ2luOjIwcHggMDt0ZXh0LWFsaWduOmNlbnRlcjtsaXN0LXN0eWxlOm5vbmU7Knpvb206MX0ucGFnZXI6YmVmb3JlLC5wYWdlcjphZnRlcntkaXNwbGF5OnRhYmxlO2xpbmUtaGVpZ2h0OjA7Y29udGVudDoiIn0ucGFnZXI6YWZ0ZXJ7Y2xlYXI6Ym90aH0ucGFnZXIgbGl7ZGlzcGxheTppbmxpbmV9LnBhZ2VyIGxpPmEsLnBhZ2VyIGxpPnNwYW57ZGlzcGxheTppbmxpbmUtYmxvY2s7cGFkZGluZzo1cHggMTRweDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czoxNXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNXB4O2JvcmRlci1yYWRpdXM6MTVweH0ucGFnZXIgbGk+YTpob3Zlcnt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjV9LnBhZ2VyIC5uZXh0PmEsLnBhZ2VyIC5uZXh0PnNwYW57ZmxvYXQ6cmlnaHR9LnBhZ2VyIC5wcmV2aW91cz5hLC5wYWdlciAucHJldmlvdXM+c3BhbntmbG9hdDpsZWZ0fS5wYWdlciAuZGlzYWJsZWQ+YSwucGFnZXIgLmRpc2FibGVkPmE6aG92ZXIsLnBhZ2VyIC5kaXNhYmxlZD5zcGFue2NvbG9yOiM5OTk7Y3Vyc29yOmRlZmF1bHQ7YmFja2dyb3VuZC1jb2xvcjojZmZmfS5tb2RhbC1iYWNrZHJvcHtwb3NpdGlvbjpmaXhlZDt0b3A6MDtyaWdodDowO2JvdHRvbTowO2xlZnQ6MDt6LWluZGV4OjEwNDA7YmFja2dyb3VuZC1jb2xvcjojMDAwfS5tb2RhbC1iYWNrZHJvcC5mYWRle29wYWNpdHk6MH0ubW9kYWwtYmFja2Ryb3AsLm1vZGFsLWJhY2tkcm9wLmZhZGUuaW57b3BhY2l0eTouODtmaWx0ZXI6YWxwaGEob3BhY2l0eT04MCl9Lm1vZGFse3Bvc2l0aW9uOmZpeGVkO3RvcDoxMCU7bGVmdDo1MCU7ei1pbmRleDoxMDUwO3dpZHRoOjU2MHB4O21hcmdpbi1sZWZ0Oi0yODBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjOTk5O2JvcmRlcjoxcHggc29saWQgcmdiYSgwLDAsMCwwLjMpOypib3JkZXI6MXB4IHNvbGlkICM5OTk7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4O291dGxpbmU6MDstd2Via2l0LWJveC1zaGFkb3c6MCAzcHggN3B4IHJnYmEoMCwwLDAsMC4zKTstbW96LWJveC1zaGFkb3c6MCAzcHggN3B4IHJnYmEoMCwwLDAsMC4zKTtib3gtc2hhZG93OjAgM3B4IDdweCByZ2JhKDAsMCwwLDAuMyk7LXdlYmtpdC1iYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3g7LW1vei1iYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3g7YmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94fS5tb2RhbC5mYWRle3RvcDotMjUlOy13ZWJraXQtdHJhbnNpdGlvbjpvcGFjaXR5IC4zcyBsaW5lYXIsdG9wIC4zcyBlYXNlLW91dDstbW96LXRyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLHRvcCAuM3MgZWFzZS1vdXQ7LW8tdHJhbnNpdGlvbjpvcGFjaXR5IC4zcyBsaW5lYXIsdG9wIC4zcyBlYXNlLW91dDt0cmFuc2l0aW9uOm9wYWNpdHkgLjNzIGxpbmVhcix0b3AgLjNzIGVhc2Utb3V0fS5tb2RhbC5mYWRlLmlue3RvcDoxMCV9Lm1vZGFsLWhlYWRlcntwYWRkaW5nOjlweCAxNXB4O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNlZWV9Lm1vZGFsLWhlYWRlciAuY2xvc2V7bWFyZ2luLXRvcDoycHh9Lm1vZGFsLWhlYWRlciBoM3ttYXJnaW46MDtsaW5lLWhlaWdodDozMHB4fS5tb2RhbC1ib2R5e3Bvc2l0aW9uOnJlbGF0aXZlO21heC1oZWlnaHQ6NDAwcHg7cGFkZGluZzoxNXB4O292ZXJmbG93LXk6YXV0b30ubW9kYWwtZm9ybXttYXJnaW4tYm90dG9tOjB9Lm1vZGFsLWZvb3RlcntwYWRkaW5nOjE0cHggMTVweCAxNXB4O21hcmdpbi1ib3R0b206MDt0ZXh0LWFsaWduOnJpZ2h0O2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTtib3JkZXItdG9wOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDAgNnB4IDZweDsqem9vbToxOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAwICNmZmY7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgI2ZmZjtib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgI2ZmZn0ubW9kYWwtZm9vdGVyOmJlZm9yZSwubW9kYWwtZm9vdGVyOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS5tb2RhbC1mb290ZXI6YWZ0ZXJ7Y2xlYXI6Ym90aH0ubW9kYWwtZm9vdGVyIC5idG4rLmJ0bnttYXJnaW4tYm90dG9tOjA7bWFyZ2luLWxlZnQ6NXB4fS5tb2RhbC1mb290ZXIgLmJ0bi1ncm91cCAuYnRuKy5idG57bWFyZ2luLWxlZnQ6LTFweH0ubW9kYWwtZm9vdGVyIC5idG4tYmxvY2srLmJ0bi1ibG9ja3ttYXJnaW4tbGVmdDowfS50b29sdGlwe3Bvc2l0aW9uOmFic29sdXRlO3otaW5kZXg6MTAzMDtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6NXB4O2ZvbnQtc2l6ZToxMXB4O29wYWNpdHk6MDtmaWx0ZXI6YWxwaGEob3BhY2l0eT0wKTt2aXNpYmlsaXR5OnZpc2libGV9LnRvb2x0aXAuaW57b3BhY2l0eTouODtmaWx0ZXI6YWxwaGEob3BhY2l0eT04MCl9LnRvb2x0aXAudG9we21hcmdpbi10b3A6LTNweH0udG9vbHRpcC5yaWdodHttYXJnaW4tbGVmdDozcHh9LnRvb2x0aXAuYm90dG9te21hcmdpbi10b3A6M3B4fS50b29sdGlwLmxlZnR7bWFyZ2luLWxlZnQ6LTNweH0udG9vbHRpcC1pbm5lcnttYXgtd2lkdGg6MjAwcHg7cGFkZGluZzozcHggOHB4O2NvbG9yOiNmZmY7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojMDAwOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweH0udG9vbHRpcC1hcnJvd3twb3NpdGlvbjphYnNvbHV0ZTt3aWR0aDowO2hlaWdodDowO2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXItc3R5bGU6c29saWR9LnRvb2x0aXAudG9wIC50b29sdGlwLWFycm93e2JvdHRvbTowO2xlZnQ6NTAlO21hcmdpbi1sZWZ0Oi01cHg7Ym9yZGVyLXRvcC1jb2xvcjojMDAwO2JvcmRlci13aWR0aDo1cHggNXB4IDB9LnRvb2x0aXAucmlnaHQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtsZWZ0OjA7bWFyZ2luLXRvcDotNXB4O2JvcmRlci1yaWdodC1jb2xvcjojMDAwO2JvcmRlci13aWR0aDo1cHggNXB4IDVweCAwfS50b29sdGlwLmxlZnQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtyaWdodDowO21hcmdpbi10b3A6LTVweDtib3JkZXItbGVmdC1jb2xvcjojMDAwO2JvcmRlci13aWR0aDo1cHggMCA1cHggNXB4fS50b29sdGlwLmJvdHRvbSAudG9vbHRpcC1hcnJvd3t0b3A6MDtsZWZ0OjUwJTttYXJnaW4tbGVmdDotNXB4O2JvcmRlci1ib3R0b20tY29sb3I6IzAwMDtib3JkZXItd2lkdGg6MCA1cHggNXB4fS5wb3BvdmVye3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO2xlZnQ6MDt6LWluZGV4OjEwMTA7ZGlzcGxheTpub25lO3dpZHRoOjIzNnB4O3BhZGRpbmc6MXB4O3RleHQtYWxpZ246bGVmdDt3aGl0ZS1zcGFjZTpub3JtYWw7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwwLDAsMC4yKTstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLDAsMCwwLjIpOy1tb3otYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwwLDAsMC4yKTtib3gtc2hhZG93OjAgNXB4IDEwcHggcmdiYSgwLDAsMCwwLjIpOy13ZWJraXQtYmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94Oy1tb3otYmFja2dyb3VuZC1jbGlwOnBhZGRpbmc7YmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94fS5wb3BvdmVyLnRvcHttYXJnaW4tdG9wOi0xMHB4fS5wb3BvdmVyLnJpZ2h0e21hcmdpbi1sZWZ0OjEwcHh9LnBvcG92ZXIuYm90dG9te21hcmdpbi10b3A6MTBweH0ucG9wb3Zlci5sZWZ0e21hcmdpbi1sZWZ0Oi0xMHB4fS5wb3BvdmVyLXRpdGxle3BhZGRpbmc6OHB4IDE0cHg7bWFyZ2luOjA7Zm9udC1zaXplOjE0cHg7Zm9udC13ZWlnaHQ6bm9ybWFsO2xpbmUtaGVpZ2h0OjE4cHg7YmFja2dyb3VuZC1jb2xvcjojZjdmN2Y3O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNlYmViZWI7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjVweCA1cHggMCAwOy1tb3otYm9yZGVyLXJhZGl1czo1cHggNXB4IDAgMDtib3JkZXItcmFkaXVzOjVweCA1cHggMCAwfS5wb3BvdmVyLWNvbnRlbnR7cGFkZGluZzo5cHggMTRweH0ucG9wb3ZlciAuYXJyb3csLnBvcG92ZXIgLmFycm93OmFmdGVye3Bvc2l0aW9uOmFic29sdXRlO2Rpc3BsYXk6YmxvY2s7d2lkdGg6MDtoZWlnaHQ6MDtib3JkZXItY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLXN0eWxlOnNvbGlkfS5wb3BvdmVyIC5hcnJvd3tib3JkZXItd2lkdGg6MTFweH0ucG9wb3ZlciAuYXJyb3c6YWZ0ZXJ7Ym9yZGVyLXdpZHRoOjEwcHg7Y29udGVudDoiIn0ucG9wb3Zlci50b3AgLmFycm93e2JvdHRvbTotMTFweDtsZWZ0OjUwJTttYXJnaW4tbGVmdDotMTFweDtib3JkZXItdG9wLWNvbG9yOiM5OTk7Ym9yZGVyLXRvcC1jb2xvcjpyZ2JhKDAsMCwwLDAuMjUpO2JvcmRlci1ib3R0b20td2lkdGg6MH0ucG9wb3Zlci50b3AgLmFycm93OmFmdGVye2JvdHRvbToxcHg7bWFyZ2luLWxlZnQ6LTEwcHg7Ym9yZGVyLXRvcC1jb2xvcjojZmZmO2JvcmRlci1ib3R0b20td2lkdGg6MH0ucG9wb3Zlci5yaWdodCAuYXJyb3d7dG9wOjUwJTtsZWZ0Oi0xMXB4O21hcmdpbi10b3A6LTExcHg7Ym9yZGVyLXJpZ2h0LWNvbG9yOiM5OTk7Ym9yZGVyLXJpZ2h0LWNvbG9yOnJnYmEoMCwwLDAsMC4yNSk7Ym9yZGVyLWxlZnQtd2lkdGg6MH0ucG9wb3Zlci5yaWdodCAuYXJyb3c6YWZ0ZXJ7Ym90dG9tOi0xMHB4O2xlZnQ6MXB4O2JvcmRlci1yaWdodC1jb2xvcjojZmZmO2JvcmRlci1sZWZ0LXdpZHRoOjB9LnBvcG92ZXIuYm90dG9tIC5hcnJvd3t0b3A6LTExcHg7bGVmdDo1MCU7bWFyZ2luLWxlZnQ6LTExcHg7Ym9yZGVyLWJvdHRvbS1jb2xvcjojOTk5O2JvcmRlci1ib3R0b20tY29sb3I6cmdiYSgwLDAsMCwwLjI1KTtib3JkZXItdG9wLXdpZHRoOjB9LnBvcG92ZXIuYm90dG9tIC5hcnJvdzphZnRlcnt0b3A6MXB4O21hcmdpbi1sZWZ0Oi0xMHB4O2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZjtib3JkZXItdG9wLXdpZHRoOjB9LnBvcG92ZXIubGVmdCAuYXJyb3d7dG9wOjUwJTtyaWdodDotMTFweDttYXJnaW4tdG9wOi0xMXB4O2JvcmRlci1sZWZ0LWNvbG9yOiM5OTk7Ym9yZGVyLWxlZnQtY29sb3I6cmdiYSgwLDAsMCwwLjI1KTtib3JkZXItcmlnaHQtd2lkdGg6MH0ucG9wb3Zlci5sZWZ0IC5hcnJvdzphZnRlcntyaWdodDoxcHg7Ym90dG9tOi0xMHB4O2JvcmRlci1sZWZ0LWNvbG9yOiNmZmY7Ym9yZGVyLXJpZ2h0LXdpZHRoOjB9LnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6LTIwcHg7bGlzdC1zdHlsZTpub25lOyp6b29tOjF9LnRodW1ibmFpbHM6YmVmb3JlLC50aHVtYm5haWxzOmFmdGVye2Rpc3BsYXk6dGFibGU7bGluZS1oZWlnaHQ6MDtjb250ZW50OiIifS50aHVtYm5haWxzOmFmdGVye2NsZWFyOmJvdGh9LnJvdy1mbHVpZCAudGh1bWJuYWlsc3ttYXJnaW4tbGVmdDowfS50aHVtYm5haWxzPmxpe2Zsb2F0OmxlZnQ7bWFyZ2luLWJvdHRvbToyMHB4O21hcmdpbi1sZWZ0OjIwcHh9LnRodW1ibmFpbHtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6NHB4O2xpbmUtaGVpZ2h0OjIwcHg7Ym9yZGVyOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwwLDAsMC4wNTUpOy1tb3otYm94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLDAsMCwwLjA1NSk7Ym94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLDAsMCwwLjA1NSk7LXdlYmtpdC10cmFuc2l0aW9uOmFsbCAuMnMgZWFzZS1pbi1vdXQ7LW1vei10cmFuc2l0aW9uOmFsbCAuMnMgZWFzZS1pbi1vdXQ7LW8tdHJhbnNpdGlvbjphbGwgLjJzIGVhc2UtaW4tb3V0O3RyYW5zaXRpb246YWxsIC4ycyBlYXNlLWluLW91dH1hLnRodW1ibmFpbDpob3Zlcntib3JkZXItY29sb3I6IzA4Yzstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwxMDUsMjE0LDAuMjUpOy1tb3otYm94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLDEwNSwyMTQsMC4yNSk7Ym94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLDEwNSwyMTQsMC4yNSl9LnRodW1ibmFpbD5pbWd7ZGlzcGxheTpibG9jazttYXgtd2lkdGg6MTAwJTttYXJnaW4tcmlnaHQ6YXV0bzttYXJnaW4tbGVmdDphdXRvfS50aHVtYm5haWwgLmNhcHRpb257cGFkZGluZzo5cHg7Y29sb3I6IzU1NX0ubWVkaWEsLm1lZGlhLWJvZHl7b3ZlcmZsb3c6aGlkZGVuOypvdmVyZmxvdzp2aXNpYmxlO3pvb206MX0ubWVkaWEsLm1lZGlhIC5tZWRpYXttYXJnaW4tdG9wOjE1cHh9Lm1lZGlhOmZpcnN0LWNoaWxke21hcmdpbi10b3A6MH0ubWVkaWEtb2JqZWN0e2Rpc3BsYXk6YmxvY2t9Lm1lZGlhLWhlYWRpbmd7bWFyZ2luOjAgMCA1cHh9Lm1lZGlhIC5wdWxsLWxlZnR7bWFyZ2luLXJpZ2h0OjEwcHh9Lm1lZGlhIC5wdWxsLXJpZ2h0e21hcmdpbi1sZWZ0OjEwcHh9Lm1lZGlhLWxpc3R7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmV9LmxhYmVsLC5iYWRnZXtkaXNwbGF5OmlubGluZS1ibG9jaztwYWRkaW5nOjJweCA0cHg7Zm9udC1zaXplOjExLjg0NHB4O2ZvbnQtd2VpZ2h0OmJvbGQ7bGluZS1oZWlnaHQ6MTRweDtjb2xvcjojZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7d2hpdGUtc3BhY2U6bm93cmFwO3ZlcnRpY2FsLWFsaWduOmJhc2VsaW5lO2JhY2tncm91bmQtY29sb3I6Izk5OX0ubGFiZWx7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4fS5iYWRnZXtwYWRkaW5nLXJpZ2h0OjlweDtwYWRkaW5nLWxlZnQ6OXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo5cHg7LW1vei1ib3JkZXItcmFkaXVzOjlweDtib3JkZXItcmFkaXVzOjlweH0ubGFiZWw6ZW1wdHksLmJhZGdlOmVtcHR5e2Rpc3BsYXk6bm9uZX1hLmxhYmVsOmhvdmVyLGEuYmFkZ2U6aG92ZXJ7Y29sb3I6I2ZmZjt0ZXh0LWRlY29yYXRpb246bm9uZTtjdXJzb3I6cG9pbnRlcn0ubGFiZWwtaW1wb3J0YW50LC5iYWRnZS1pbXBvcnRhbnR7YmFja2dyb3VuZC1jb2xvcjojYjk0YTQ4fS5sYWJlbC1pbXBvcnRhbnRbaHJlZl0sLmJhZGdlLWltcG9ydGFudFtocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiM5NTNiMzl9LmxhYmVsLXdhcm5pbmcsLmJhZGdlLXdhcm5pbmd7YmFja2dyb3VuZC1jb2xvcjojZjg5NDA2fS5sYWJlbC13YXJuaW5nW2hyZWZdLC5iYWRnZS13YXJuaW5nW2hyZWZde2JhY2tncm91bmQtY29sb3I6I2M2NzYwNX0ubGFiZWwtc3VjY2VzcywuYmFkZ2Utc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiM0Njg4NDd9LmxhYmVsLXN1Y2Nlc3NbaHJlZl0sLmJhZGdlLXN1Y2Nlc3NbaHJlZl17YmFja2dyb3VuZC1jb2xvcjojMzU2NjM1fS5sYWJlbC1pbmZvLC5iYWRnZS1pbmZve2JhY2tncm91bmQtY29sb3I6IzNhODdhZH0ubGFiZWwtaW5mb1tocmVmXSwuYmFkZ2UtaW5mb1tocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiMyZDY5ODd9LmxhYmVsLWludmVyc2UsLmJhZGdlLWludmVyc2V7YmFja2dyb3VuZC1jb2xvcjojMzMzfS5sYWJlbC1pbnZlcnNlW2hyZWZdLC5iYWRnZS1pbnZlcnNlW2hyZWZde2JhY2tncm91bmQtY29sb3I6IzFhMWExYX0uYnRuIC5sYWJlbCwuYnRuIC5iYWRnZXtwb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LTFweH0uYnRuLW1pbmkgLmxhYmVsLC5idG4tbWluaSAuYmFkZ2V7dG9wOjB9QC13ZWJraXQta2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDB9dG97YmFja2dyb3VuZC1wb3NpdGlvbjowIDB9fUAtbW96LWtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwfXRve2JhY2tncm91bmQtcG9zaXRpb246MCAwfX1ALW1zLWtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwfXRve2JhY2tncm91bmQtcG9zaXRpb246MCAwfX1ALW8ta2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjowIDB9dG97YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDB9fUBrZXlmcmFtZXMgcHJvZ3Jlc3MtYmFyLXN0cmlwZXN7ZnJvbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOjQwcHggMH10b3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMH19LnByb2dyZXNze2hlaWdodDoyMHB4O21hcmdpbi1ib3R0b206MjBweDtvdmVyZmxvdzpoaWRkZW47YmFja2dyb3VuZC1jb2xvcjojZjdmN2Y3O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2Y1ZjVmNSksdG8oI2Y5ZjlmOSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCNmNWY1ZjUsI2Y5ZjlmOSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZjVmNWY1JyxlbmRDb2xvcnN0cj0nI2ZmZjlmOWY5JyxHcmFkaWVudFR5cGU9MCk7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLDAsMCwwLjEpfS5wcm9ncmVzcyAuYmFye2Zsb2F0OmxlZnQ7d2lkdGg6MDtoZWlnaHQ6MTAwJTtmb250LXNpemU6MTJweDtjb2xvcjojZmZmO3RleHQtYWxpZ246Y2VudGVyO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwwLDAsMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojMGU5MGQyO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzE0OWJkZiksdG8oIzA0ODBiZSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCMxNDliZGYsIzA0ODBiZSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYxNDliZGYnLGVuZENvbG9yc3RyPScjZmYwNDgwYmUnLEdyYWRpZW50VHlwZT0wKTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwwLjE1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwwLjE1KTtib3gtc2hhZG93Omluc2V0IDAgLTFweCAwIHJnYmEoMCwwLDAsMC4xNSk7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94Oy13ZWJraXQtdHJhbnNpdGlvbjp3aWR0aCAuNnMgZWFzZTstbW96LXRyYW5zaXRpb246d2lkdGggLjZzIGVhc2U7LW8tdHJhbnNpdGlvbjp3aWR0aCAuNnMgZWFzZTt0cmFuc2l0aW9uOndpZHRoIC42cyBlYXNlfS5wcm9ncmVzcyAuYmFyKy5iYXJ7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgwLDAsMCwwLjE1KSxpbnNldCAwIC0xcHggMCByZ2JhKDAsMCwwLDAuMTUpOy1tb3otYm94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMCwwLDAsMC4xNSksaW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwwLjE1KTtib3gtc2hhZG93Omluc2V0IDFweCAwIDAgcmdiYSgwLDAsMCwwLjE1KSxpbnNldCAwIC0xcHggMCByZ2JhKDAsMCwwLDAuMTUpfS5wcm9ncmVzcy1zdHJpcGVkIC5iYXJ7YmFja2dyb3VuZC1jb2xvcjojMTQ5YmRmO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpOy13ZWJraXQtYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDstbW96LWJhY2tncm91bmQtc2l6ZTo0MHB4IDQwcHg7LW8tYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDtiYWNrZ3JvdW5kLXNpemU6NDBweCA0MHB4fS5wcm9ncmVzcy5hY3RpdmUgLmJhcnstd2Via2l0LWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7LW1vei1hbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlOy1tcy1hbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlOy1vLWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7YW5pbWF0aW9uOnByb2dyZXNzLWJhci1zdHJpcGVzIDJzIGxpbmVhciBpbmZpbml0ZX0ucHJvZ3Jlc3MtZGFuZ2VyIC5iYXIsLnByb2dyZXNzIC5iYXItZGFuZ2Vye2JhY2tncm91bmQtY29sb3I6I2RkNTE0YztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNlZTVmNWIpLHRvKCNjNDNjMzUpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwjZWU1ZjViLCNjNDNjMzUpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZWU1ZjViJyxlbmRDb2xvcnN0cj0nI2ZmYzQzYzM1JyxHcmFkaWVudFR5cGU9MCl9LnByb2dyZXNzLWRhbmdlci5wcm9ncmVzcy1zdHJpcGVkIC5iYXIsLnByb2dyZXNzLXN0cmlwZWQgLmJhci1kYW5nZXJ7YmFja2dyb3VuZC1jb2xvcjojZWU1ZjViO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5wcm9ncmVzcy1zdWNjZXNzIC5iYXIsLnByb2dyZXNzIC5iYXItc3VjY2Vzc3tiYWNrZ3JvdW5kLWNvbG9yOiM1ZWI5NWU7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjNjJjNDYyKSx0bygjNTdhOTU3KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzYyYzQ2MiwjNTdhOTU3KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjYyYzQ2MicsZW5kQ29sb3JzdHI9JyNmZjU3YTk1NycsR3JhZGllbnRUeXBlPTApfS5wcm9ncmVzcy1zdWNjZXNzLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLXN1Y2Nlc3N7YmFja2dyb3VuZC1jb2xvcjojNjJjNDYyO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5wcm9ncmVzcy1pbmZvIC5iYXIsLnByb2dyZXNzIC5iYXItaW5mb3tiYWNrZ3JvdW5kLWNvbG9yOiM0YmIxY2Y7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjNWJjMGRlKSx0bygjMzM5YmI5KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sIzViYzBkZSwjMzM5YmI5KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjViYzBkZScsZW5kQ29sb3JzdHI9JyNmZjMzOWJiOScsR3JhZGllbnRUeXBlPTApfS5wcm9ncmVzcy1pbmZvLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLWluZm97YmFja2dyb3VuZC1jb2xvcjojNWJjMGRlO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5wcm9ncmVzcy13YXJuaW5nIC5iYXIsLnByb2dyZXNzIC5iYXItd2FybmluZ3tiYWNrZ3JvdW5kLWNvbG9yOiNmYWE3MzI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjZmJiNDUwKSx0bygjZjg5NDA2KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sI2ZiYjQ1MCwjZjg5NDA2KTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmZiYjQ1MCcsZW5kQ29sb3JzdHI9JyNmZmY4OTQwNicsR3JhZGllbnRUeXBlPTApfS5wcm9ncmVzcy13YXJuaW5nLnByb2dyZXNzLXN0cmlwZWQgLmJhciwucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLXdhcm5pbmd7YmFja2dyb3VuZC1jb2xvcjojZmJiNDUwO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAxMDAlLDEwMCUgMCxjb2xvci1zdG9wKDAuMjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjI1LHRyYW5zcGFyZW50KSxjb2xvci1zdG9wKDAuNSx0cmFuc3BhcmVudCksY29sb3Itc3RvcCgwLjUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSksY29sb3Itc3RvcCgwLjc1LHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkpLGNvbG9yLXN0b3AoMC43NSx0cmFuc3BhcmVudCksdG8odHJhbnNwYXJlbnQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KDQ1ZGVnLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgMjUlLHRyYW5zcGFyZW50IDI1JSx0cmFuc3BhcmVudCA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA1MCUscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSA3NSUsdHJhbnNwYXJlbnQgNzUlLHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZyxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDI1JSx0cmFuc3BhcmVudCAyNSUsdHJhbnNwYXJlbnQgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNTAlLHJnYmEoMjU1LDI1NSwyNTUsMC4xNSkgNzUlLHRyYW5zcGFyZW50IDc1JSx0cmFuc3BhcmVudCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQoNDVkZWcscmdiYSgyNTUsMjU1LDI1NSwwLjE1KSAyNSUsdHJhbnNwYXJlbnQgMjUlLHRyYW5zcGFyZW50IDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDUwJSxyZ2JhKDI1NSwyNTUsMjU1LDAuMTUpIDc1JSx0cmFuc3BhcmVudCA3NSUsdHJhbnNwYXJlbnQpfS5hY2NvcmRpb257bWFyZ2luLWJvdHRvbToyMHB4fS5hY2NvcmRpb24tZ3JvdXB7bWFyZ2luLWJvdHRvbToycHg7Ym9yZGVyOjFweCBzb2xpZCAjZTVlNWU1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweH0uYWNjb3JkaW9uLWhlYWRpbmd7Ym9yZGVyLWJvdHRvbTowfS5hY2NvcmRpb24taGVhZGluZyAuYWNjb3JkaW9uLXRvZ2dsZXtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6OHB4IDE1cHh9LmFjY29yZGlvbi10b2dnbGV7Y3Vyc29yOnBvaW50ZXJ9LmFjY29yZGlvbi1pbm5lcntwYWRkaW5nOjlweCAxNXB4O2JvcmRlci10b3A6MXB4IHNvbGlkICNlNWU1ZTV9LmNhcm91c2Vse3Bvc2l0aW9uOnJlbGF0aXZlO21hcmdpbi1ib3R0b206MjBweDtsaW5lLWhlaWdodDoxfS5jYXJvdXNlbC1pbm5lcntwb3NpdGlvbjpyZWxhdGl2ZTt3aWR0aDoxMDAlO292ZXJmbG93OmhpZGRlbn0uY2Fyb3VzZWwtaW5uZXI+Lml0ZW17cG9zaXRpb246cmVsYXRpdmU7ZGlzcGxheTpub25lOy13ZWJraXQtdHJhbnNpdGlvbjouNnMgZWFzZS1pbi1vdXQgbGVmdDstbW96LXRyYW5zaXRpb246LjZzIGVhc2UtaW4tb3V0IGxlZnQ7LW8tdHJhbnNpdGlvbjouNnMgZWFzZS1pbi1vdXQgbGVmdDt0cmFuc2l0aW9uOi42cyBlYXNlLWluLW91dCBsZWZ0fS5jYXJvdXNlbC1pbm5lcj4uaXRlbT5pbWd7ZGlzcGxheTpibG9jaztsaW5lLWhlaWdodDoxfS5jYXJvdXNlbC1pbm5lcj4uYWN0aXZlLC5jYXJvdXNlbC1pbm5lcj4ubmV4dCwuY2Fyb3VzZWwtaW5uZXI+LnByZXZ7ZGlzcGxheTpibG9ja30uY2Fyb3VzZWwtaW5uZXI+LmFjdGl2ZXtsZWZ0OjB9LmNhcm91c2VsLWlubmVyPi5uZXh0LC5jYXJvdXNlbC1pbm5lcj4ucHJldntwb3NpdGlvbjphYnNvbHV0ZTt0b3A6MDt3aWR0aDoxMDAlfS5jYXJvdXNlbC1pbm5lcj4ubmV4dHtsZWZ0OjEwMCV9LmNhcm91c2VsLWlubmVyPi5wcmV2e2xlZnQ6LTEwMCV9LmNhcm91c2VsLWlubmVyPi5uZXh0LmxlZnQsLmNhcm91c2VsLWlubmVyPi5wcmV2LnJpZ2h0e2xlZnQ6MH0uY2Fyb3VzZWwtaW5uZXI+LmFjdGl2ZS5sZWZ0e2xlZnQ6LTEwMCV9LmNhcm91c2VsLWlubmVyPi5hY3RpdmUucmlnaHR7bGVmdDoxMDAlfS5jYXJvdXNlbC1jb250cm9se3Bvc2l0aW9uOmFic29sdXRlO3RvcDo0MCU7bGVmdDoxNXB4O3dpZHRoOjQwcHg7aGVpZ2h0OjQwcHg7bWFyZ2luLXRvcDotMjBweDtmb250LXNpemU6NjBweDtmb250LXdlaWdodDoxMDA7bGluZS1oZWlnaHQ6MzBweDtjb2xvcjojZmZmO3RleHQtYWxpZ246Y2VudGVyO2JhY2tncm91bmQ6IzIyMjtib3JkZXI6M3B4IHNvbGlkICNmZmY7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjIzcHg7LW1vei1ib3JkZXItcmFkaXVzOjIzcHg7Ym9yZGVyLXJhZGl1czoyM3B4O29wYWNpdHk6LjU7ZmlsdGVyOmFscGhhKG9wYWNpdHk9NTApfS5jYXJvdXNlbC1jb250cm9sLnJpZ2h0e3JpZ2h0OjE1cHg7bGVmdDphdXRvfS5jYXJvdXNlbC1jb250cm9sOmhvdmVye2NvbG9yOiNmZmY7dGV4dC1kZWNvcmF0aW9uOm5vbmU7b3BhY2l0eTouOTtmaWx0ZXI6YWxwaGEob3BhY2l0eT05MCl9LmNhcm91c2VsLWNhcHRpb257cG9zaXRpb246YWJzb2x1dGU7cmlnaHQ6MDtib3R0b206MDtsZWZ0OjA7cGFkZGluZzoxNXB4O2JhY2tncm91bmQ6IzMzMztiYWNrZ3JvdW5kOnJnYmEoMCwwLDAsMC43NSl9LmNhcm91c2VsLWNhcHRpb24gaDQsLmNhcm91c2VsLWNhcHRpb24gcHtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiNmZmZ9LmNhcm91c2VsLWNhcHRpb24gaDR7bWFyZ2luOjAgMCA1cHh9LmNhcm91c2VsLWNhcHRpb24gcHttYXJnaW4tYm90dG9tOjB9Lmhlcm8tdW5pdHtwYWRkaW5nOjYwcHg7bWFyZ2luLWJvdHRvbTozMHB4O2ZvbnQtc2l6ZToxOHB4O2ZvbnQtd2VpZ2h0OjIwMDtsaW5lLWhlaWdodDozMHB4O2NvbG9yOmluaGVyaXQ7YmFja2dyb3VuZC1jb2xvcjojZWVlOy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweH0uaGVyby11bml0IGgxe21hcmdpbi1ib3R0b206MDtmb250LXNpemU6NjBweDtsaW5lLWhlaWdodDoxO2xldHRlci1zcGFjaW5nOi0xcHg7Y29sb3I6aW5oZXJpdH0uaGVyby11bml0IGxpe2xpbmUtaGVpZ2h0OjMwcHh9LnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHR9LnB1bGwtbGVmdHtmbG9hdDpsZWZ0fS5oaWRle2Rpc3BsYXk6bm9uZX0uc2hvd3tkaXNwbGF5OmJsb2NrfS5pbnZpc2libGV7dmlzaWJpbGl0eTpoaWRkZW59LmFmZml4e3Bvc2l0aW9uOmZpeGVkfQ==';
// main.css	
$mainstyle='Ym9keXsgcGFkZGluZy10b3A6MjBweDsgIHBhZGRpbmctYm90dG9tOjQwcHh9DQouY29udGFpbmVyLW5hcnJvd3sgbWFyZ2luOjAgYXV0bzsgIG1heC13aWR0aDo5MDBweH0NCi5jb250YWluZXItbmFycm93ID5ocnsgbWFyZ2luOjMwcHggMH0NCi5qdW1ib3Ryb257IG1hcmdpbjo2MHB4IDA7ICB0ZXh0LWFsaWduOmNlbnRlcn0NCi5qdW1ib3Ryb24gaDF7IGZvbnQtc2l6ZTo3MnB4OyAgbGluZS1oZWlnaHQ6MX0NCi5qdW1ib3Ryb24gLmJ0bnsgZm9udC1zaXplOjIxcHg7ICBwYWRkaW5nOjE0cHggMjRweH0NCi5icmFuZCBpeyBmb250LXNpemU6MTRweDsgIHBhZGRpbmc6MTNweDsgY29sb3I6IzMwMzAzMH0NCnVsLnNtaWxleXMge3dpZHRoOiAxNzBweH0NCi5zbWlsZXlzIGxpe2Zsb2F0OmxlZnR9';	
	@mkdir('css');
	$css = base64_decode($css);
	foreach($cVals as $k=>$v) {
		$css_copy=$css;
		for($i=0;$i<count($cNames);$i++) $css_copy=str_replace($cNames[$i],'#'.$v[$i],$css_copy);
		if($h=@fopen('css/style_'.$k.'.css','w')) {fputs($h,$css_copy);fclose($h);}
	}
	if(!file_exists('css/main.css')) {
		if($h=@fopen('css/main.css','w')) { fputs($h,base64_decode($mainstyle));fclose($h); }
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
	#$mainHt =  "ErrorDocument 401 $s\n";
	#$mainHt .= "ErrorDocument 403 $s\n";
	#$mainHt .= "ErrorDocument 404 $s\n";
	$mainHt .= "options -indexes \n";
	if(!file_exists('data/.htaccess')) {
		if($h=@fopen('data/.htaccess','w')) { fputs($h,$mainHt);fclose($h); }
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
	global $maxAvatarSize,$forum,$forumMode;

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
  
  <div class="help-inline alert alert-info"><i class="icon-exclamation-sign"></i> Les champs de couleur verte sont obligatoires. 
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
	global $wt,$ismember;
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
	global $cLogin,$maxAvatarSize,$forum;
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
	global $cLogin,$isadmin,$havemp,$cStyle,$cVals,$forum,$nbrMsgIndex,$ismember,$siteUrl,$siteName;
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
	global $cLogin,$havemp,$cStyle,$cVals,$forum,$nbrMsgIndex,$ismember,$siteUrl,$siteName;
	$mn='<ul class="nav">'; 	 
	if($siteUrl!='') $mn .='<li><a href="'.$siteUrl.'" title="'.$siteName.'"><i class="icon-home"></i> '.$siteName.'</a></li><li class="divider-vertical"></li>';
	$stats=$forum->getStat();
	if($nbrMsgIndex<$stats[2]) $mn .='<li><a href="?showall=1" title=""><i class="icon-bookmark"></i> Archives</a></li><li class="divider-vertical"></li>';	
	if($ismember) {
		$mn .='<li><a href="?logout=1" title="Quitter la session"><i class="icon-off"></i> Déconnexion</a></li><li class="divider-vertical"></li>';
		$mn .='<li><a href="?editprofil=1" title="Editer mon profil"><i class="icon-eye-open"></i> Profil</a></li><li class="divider-vertical"></li>';
		$mn .='<li><a href="?memberlist=1" title="Afficher la liste des membres"><i class="icon-user"></i> Membres</a></li><li class="divider-vertical"></li>
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
	global $isadmin,$isowner;
	$mn='';
	if($isadmin && $isowner) {
		$mn .= '<ul class="nav pull-right">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Tab. de Bord <b class="caret"></b></a>
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
	global $isadmin,$nbrMsgIndex,$forum,$showall;
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
		$dernierLe = date("d M Y à H:i",$dernierLe);
		$started = date("d M Y", $topicID);
		$attachment=($attachment!='')?'<i class="icon-file"></i> ':'';
		$postType=$postType?'<i class="icon-star"></i> ':'';
		$statusIcon = (isset($_COOKIE['uFread'.$topicID]))?'<i class="icon-folder-open"></i>':'<i class="icon-folder-close"></i>';
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
	global $topic,$forum,$isadmin,$quoteMode;
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
				$buffer .= '<p class="pull-right"><a href="?pid='.base64_encode($attach).'" rel="tooltip" title="Télécharger"><i class="icon-file"></i> '.$attachment[2].'</a></p>';
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
			<noscript>Activer JavaScript pour afficher le mail</noscript>
		';
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
	global $isadmin,$cLogin,$forum;
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
	global $maxAvatarSize,$error,$extensionsAutorises,$forum,$cLogin;
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
	global $topic,$editpost,$topicObj,$cLogin,$isadmin;
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
	global $cLogin,$forum;
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
	global $cLogin,$forum;
	
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
* DÉFINI LES DOSSIERS A SAUVEGARDER
*/
function backup_dirs($dir) {
  $match='/.mp$|.dat$/i';
  $buf='';
  $h=opendir($dir);
  while ($item=readdir($h))
  {
     if($item != '.' && $item != '..') 
     {  
		if(is_dir($dir.'/'.$item)) {
	   		$buf .= '[folder]'.$dir.'/'.$item; $buf .= backup_dirs($dir.'/'.$item);
		} else if (preg_match($match,$item)) {
			$buf .= '[file]'.$dir.'/'.$item; $buf .= '[content]'.file_get_contents($dir.'/'.$item);
		}
     }  
  }
  closedir($h);
  return $buf;
}
/**
*
* ÉXÉCUTE LA SAUVEGARDE
*/
function do_backup($folders,$archive=NULL) {
	@mkdir('backup');
	if($folders) {
		$buf = '';
		foreach($folders as $fld) $buf .= backup_dirs($fld);
		if(!$archive) $archive='backup/forumbkp.gz';
		if(function_exists('gzopen')) {
			$h=gzopen($archive, 'w');
			gzputs($h,$buf);
			gzclose($h);
		} else {
			$h=fopen($archive, 'w');
			fputs($h,$buf);
			fclose($h);
		}
		header('Content-Description: File Transfer');
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment; filename='.basename($archive));
		@readfile($archive);
		return true;
	}
	return false;
}
/**
*
* RÉSTAURATION D'UN FICHIER DE SAUVEGARDE
*/
function restore_forum($archive='',$folder='') {
	$rstFolds=0;
	$rstFiles=0;
	$folder.='data/';
	$buffer='';
	if ($folder) { @mkdir($folder); }
	@mkdir($folder.'messages');
	@mkdir($folder.'membres');
	
	if(!$archive) $archive = 'backup/forumbkp.gz';
	if(function_exists('gzopen')) {
		if ($zp=gzopen($archive, 'r'))
		{
	  		while (!gzeof($zp)) { $buffer .= gzgets ($zp, 4096) ; }                
		}            
		gzclose($zp) ;
	} else {
		if ($zp=fopen($archive, 'r'))
		{
	  		while (!feof($zp)) { $buffer .= fgets ($zp, 4096) ; }                
		}            
		fclose($zp) ;
	}
	
	$dirArray = explode('[folder]',$buffer);
	foreach($dirArray as $key) {
		if(!empty($key)) { 
			$fileArray = explode('[file]',$key);
			if (@mkdir($folder.$fileArray[0])) $rstFolds++;
			for ($i=1;$i<sizeof($fileArray);$i++) {
				$contentArray = explode('[content]',$fileArray[$i]);
				if(!empty($contentArray[0])) {
					if($h = @fopen($folder.$contentArray[0],'w+')) { fputs($h,$contentArray[1]); fclose($h); $rstFiles++;}
				}
			}
		}
	}
	return array($rstFolds,$rstFiles);
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
	if(file_exists("backup/forumbkp.gz")) $form .= '
<div class="alert alert-block">
  <button type="button" class="close" data-dismiss="alert">×</button>
  Archive forumbkp.gz présente sur le serveur, si vous voulez restaurer à partir de ce fichier appuyez directement sur Envoyer.
</div>';
	$form .= '  <div class="control-group">
    <label class="control-label muted">Restaurer à partir de</label>
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
$error='';
init_forum();

$siteUrl=baseURL(); // pour une upgrade,  enlever dans les futurs versions
require('config.php');
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
	$config ="<?\$uforum='$uforum';\$utitle='$uftitle';\$lang=$uflang;\$metaDesc='$ufmetadesc';\$nbrMsgIndex=$nbrMsgIndex;\$extensionsAutorises='$extStr';\$maxAvatarSize=$maxAvatarSize;\$forumMode=$forumMode;\$quoteMode=$quoteMode;\$siteUrl='$siteUrl';\$siteName='$siteName';\$siteBase='$siteBase';?>";
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
	else if($backup) {$r=do_backup(array(U_MEMBER,U_THREAD));}
	else if($restore && $action=='restore') {
		if(@is_uploaded_file($_FILES['backup']['tmp_name']) && preg_match('/.gz$/i',$_FILES['backup']['name'])) {
			$r=restore_forum($_FILES['backup']['tmp_name']);
		} else if(file_exists('backup/forumbkp.gz')) $r=restore_forum('backup/forumbkp.gz');
		$error .='Restauration réussie de '.$r[1].' fichiers.<br>';
		$restore=0;
		$r=init_forum();
	}
}
header('Content-Type: text/html; charset=utf-8');
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
echo '    <div class="container-narrow">
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
$u=($arr_cnct[3]>1)?'s':'';//Membre
$n=($arr_cnct[2]>1)?'s':'';//actuellemnt connecté
$v=($arr_cnct[1]>1)?'s':'';//Visiteur

echo '<p>Nous avons '.$stats[3].' message'.$m.' dans '.$stats[2].' sujet'.$s.'. </p>';
echo '<p>Bienvenue à notre nouveau membre, <span class="text-warning">'.$stats[1].'</span><p>
      <p>Total Membre'.$a[0].': '. $stats[0].'</p>
      </div>
      <div class="span6">
      <h4>Qui est en ligne ?</h4>
      <p>Membre'.$u.' actuellement connecté'.$n.' : <b>'.$arr_cnct[0].'</b> ,Visiteur'.$v.' : '.$arr_cnct[1];
echo ' </p>
      <h4>Légende</h4>
      <p><i class="icon-folder-open"></i> Ne contient pas de messages non lus. <i class="icon-star"></i> Épinglé</p> 
      <p><i class="icon-folder-close"></i> Contient des messages non lus. <i class="icon-file"></i> Pièce jointe</p>
        </div>
       </div>
      </div>';

echo '<hr />


      <div class="footer container-narrow" id="bottom">
        <p>© '.date('Y').' '.$tmp.' est propulsé par <a href="http://uforum.byethost5.com" rel="tooltip" title="Forum ultra légé sans SQL">µForum v'.$version.'</a>  
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
