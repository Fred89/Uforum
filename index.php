<?php
# ------------------ BEGIN LICENSE BLOCK ------------------
#
# This file is part of µForum : http://uforum.byethost5.com/
# @update   28-11-2012
# Copyright (c) 2012 Frédéric Kaplon and contributors
# Copyright (c) 2008 ~ Okkin  Avetenebrae
# Licensed under the GPL license.
# See http://www.gnu.org/licenses/gpl.html
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
$version = '0.9';
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
$wt = 'W2JdW2ldQmllbnZlbnVlIHN1ciDCtWZvcnVtIHYwLjZbL2ldWy9iXQ0KDQpDZSBmb3J1bSBtb25vdGhyZWFkIGVzdCBiYXPDqSBzdXIgZGVzIGZpY2hpZXJzIHVuaXF1ZW1lbnQgKHBhcyBkZSBiYXNlIGRlIGRvbm7DqWUgc3FsKS4NCkxlIGNvbmNlcHQgZXN0IHVuIHBldSBkaWZmw6lyZW50IGRlcyBhdXRyZXMgZm9ydW1zIHB1aXNxdWUgbCdpbmZvcm1hdGlvbiBsYSBwbHVzIGltcG9ydGFudGUgbWlzZSBlbiBhdmFudCBwb3VyIHJlY29ubmFpdHJlIHVuIHV0aWxpc2F0ZXVyIGVzdCBzb24gYXZhdGFyIChwb3VyIHVuZSBmb2lzIHF1J2lsIHNlcnQgw6AgcXVlbHF1ZSBjaG9zZS4uKQ0KDQpbdV1bYl1JbCBpbnTDqGdyZSBwbHVzaWV1cnMgZm9uY3Rpb25uYWxpdMOpcyA6Wy9iXVsvdV0gW2ldKOKYhSA9IE5vdXZlYXV0w6kpWy9pXQ0KDQpbY13inJQgR2VzdGlvbiBkZXMgbWVtYnJlcyBwYXIgbG9naW4gLyBtb3QgZGUgcGFzc2UgKHBhciBjb29raWVzKS4NCuKclCA0IG5pdmVhdSBkJ3V0aWxpc2F0ZXVycyA6IEFkbWluaXN0cmF0ZXVyLCBNb2TDqXJhdGV1ciwgTWVtYnJlLCBBbm9ueW1lLg0K4pyUIE1vZGUgcHJpdsOpIC8gcHVibGljLCBwb3VyIGF1dG9yaXNlciBsZXMgbm9uLW1lbWJyZXMuDQrinJQgTGlzdGUgZGVzIG1lbWJyZXMuDQrinJQgUHJvZmlsIHV0aWxpc2F0ZXVyICjDqWRpdGlvbikuDQrinJQgTWVzc2FnZXJpZSBwcml2w6llIGVudHJlIGxlcyBtZW1icmVzLg0K4pyUIFVwbG9hZCBkJ2F2YXRhciBldCBkZSBwacOoY2VzIGpvaW50ZXMgKGF2ZWMgZmlsdHJlIGQnZXh0ZW5zaW9ucykuDQrinJQgU21pbGV5cyBldCBCQkNvZGVzIChham91dCBhdXRvbWF0aXF1ZSBkZXMgYmFsaXNlcyBmZXJtYW50ZXMgbWFucXVhbnRlcykuDQrimIUgQ291cHVyZSBkZXMgY2hhaW5lcyB0cm9wIGxvbmd1ZXMgc2FucyBjb3VwZXIgbGVzIHBocmFzZXMgIQ0K4pyUIFNraW5zLg0K4pyUIExpZW4gYXV0b21hdGlxdWVzLg0K4piFIEh0bWw1IGV0IGNzczMgKEJvb3RzdHJhcCBkZSB0d2l0dGVyKS4NCuKclCBBZmZpY2hhZ2UgZGVzIGNvbm5lY3TDqXMuDQrinJQgY29sb3JhdGlvbiBzeW50YXhpcXVlIGR1IGNvZGUuDQrinJQgR2VzdGlvbiBkZXMgb3B0aW9ucyBkJ2FkbWluaXN0cmF0aW9ucy4NCuKclCBTeXN0w6htZSBzaW1wbGUgZGUgc2F1dmVnYXJkZSBldCByZXN0YXVyYXRpb24uDQrimIUgQ2FwdGNoYSBsb3JzIGRlIGwnaW5zY3JpcHRpb24uDQrimIUgUHJvdGVjdGlvbiBkZXMgbWFpbHMgc3VyIGxhIGxpc3RlIGRlcyBtZW1icmVzIHBvdXIgY29udHJlciBsZSBzcGFtWy9jXQ==';
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
* RETOURNE L'URL
*/
function baseURL()
{
	$dir = dirname($_SERVER['SCRIPT_NAME']);
	return 'http://' .$_SERVER['SERVER_NAME'].$dir.($dir === '/'? '' : '/');
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
			$config="<?\$uforum='$uforum';\$lang='$lang';\$nbrMsgIndex=$nbrMsgIndex;\$extensionsAutorises='$extensionsAutorises';\$maxAvatarSize=$maxAvatarSize;\$forumMode=$forumMode;\$quoteMode=$quoteMode;\$siteUrl='$siteUrl';\$siteName='$siteName';\$siteBase='$d';?>";
			if($h=@fopen('config.php','w')) {fputs($h,utf8_encode($config));fclose($h);}
		}
		mkhtaccess();
		mklang();
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
		$config="<?\$uforum='[b]&micro;[/b]Forum';\$lang='fr';\$nbrMsgIndex=15;\$extensionsAutorises='gif,bmp,png,jpg,mp3,zip,rar,txt';\$maxAvatarSize=30720;\$forumMode=1;\$quoteMode=1;\$siteUrl='';\$siteName='';\$siteBase='$d';?>";
		if($h=@fopen('config.php','w')) {fputs($h,utf8_encode($config));fclose($h);}

        $error= (@mkdir('lang/'))?'&#10004; Création du répertoire lang.<br>' : '&#10008; Echec à la création du répertoire lang<br>';
		$error.= (@mkdir('data/'))?'&#10004; Création du répertoire data.<br>' : '&#10008; Echec à la création du répertoire data<br>';
		$error.= (@mkdir(U_MEMBER))?'&#10004; Création du répertoire membres.<br>' : '&#10008; Echec à la création du répertoire membres<br>';
		$error.= (@mkdir(U_THREAD))?'&#10004; Création du répertoire messages.<br>' : '&#10008; Echec à la création du répertoire messages<br>';
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
* CRÉATION DES FEUILLES DE STYLE (css)
*/
function mkcss() {
	global $cNames,$cVals;
	$css='Ym9keXsgcGFkZGluZy10b3A6MjBweDsgIHBhZGRpbmctYm90dG9tOjQwcHh9DQoNCi8qIEN1c3RvbSBjb250YWluZXIgKi8NCi5jb250YWluZXItbmFycm93eyBtYXJnaW46MCBhdXRvOyAgbWF4LXdpZHRoOjkwMHB4fQ0KLmNvbnRhaW5lci1uYXJyb3cgPmhyeyBtYXJnaW46MzBweCAwfQ0KDQovKiBNYWluIG1hcmtldGluZyBtZXNzYWdlIGFuZCBzaWduIHVwIGJ1dHRvbiAqLw0KLmp1bWJvdHJvbnsgbWFyZ2luOjYwcHggMDsgIHRleHQtYWxpZ246Y2VudGVyfQ0KLmp1bWJvdHJvbiBoMXsgZm9udC1zaXplOjcycHg7ICBsaW5lLWhlaWdodDoxfQ0KLmp1bWJvdHJvbiAuYnRueyBmb250LXNpemU6MjFweDsgIHBhZGRpbmc6MTRweCAyNHB4fQ0KLyohDQogKiBCb290c3RyYXAgdjIuMi4xDQogKg0KICogQ29weXJpZ2h0IDIwMTIgVHdpdHRlciwgSW5jDQogKiBMaWNlbnNlZCB1bmRlciB0aGUgQXBhY2hlIExpY2Vuc2UgdjIuMA0KICogaHR0cDovL3d3dy5hcGFjaGUub3JnL2xpY2Vuc2VzL0xJQ0VOU0UtMi4wDQogKg0KICogRGVzaWduZWQgYW5kIGJ1aWx0IHdpdGggYWxsIHRoZSBsb3ZlIGluIHRoZSB3b3JsZCBAdHdpdHRlciBieSBAbWRvIGFuZCBAZmF0Lg0KICovDQouY2xlYXJmaXh7Knpvb206MTt9LmNsZWFyZml4OmJlZm9yZSwuY2xlYXJmaXg6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLmNsZWFyZml4OmFmdGVye2NsZWFyOmJvdGg7fQ0KLmhpZGUtdGV4dHtmb250OjAvMCBhO2NvbG9yOnRyYW5zcGFyZW50O3RleHQtc2hhZG93Om5vbmU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXI6MDt9DQouaW5wdXQtYmxvY2stbGV2ZWx7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3g7fQ0KYXJ0aWNsZSxhc2lkZSxkZXRhaWxzLGZpZ2NhcHRpb24sZmlndXJlLGZvb3RlcixoZWFkZXIsaGdyb3VwLG5hdixzZWN0aW9ue2Rpc3BsYXk6YmxvY2s7fQ0KYXVkaW8sY2FudmFzLHZpZGVve2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxO30NCmF1ZGlvOm5vdChbY29udHJvbHNdKXtkaXNwbGF5Om5vbmU7fQ0KaHRtbHtmb250LXNpemU6MTAwJTstd2Via2l0LXRleHQtc2l6ZS1hZGp1c3Q6MTAwJTstbXMtdGV4dC1zaXplLWFkanVzdDoxMDAlO30NCmE6Zm9jdXN7b3V0bGluZTp0aGluIGRvdHRlZCAjMzMzO291dGxpbmU6NXB4IGF1dG8gLXdlYmtpdC1mb2N1cy1yaW5nLWNvbG9yO291dGxpbmUtb2Zmc2V0Oi0ycHg7fQ0KYTpob3ZlcixhOmFjdGl2ZXtvdXRsaW5lOjA7fQ0Kc3ViLHN1cHtwb3NpdGlvbjpyZWxhdGl2ZTtmb250LXNpemU6NzUlO2xpbmUtaGVpZ2h0OjA7dmVydGljYWwtYWxpZ246YmFzZWxpbmU7fQ0Kc3Vwe3RvcDotMC41ZW07fQ0Kc3Vie2JvdHRvbTotMC4yNWVtO30NCmltZ3ttYXgtd2lkdGg6MTAwJTt3aWR0aDphdXRvXDk7aGVpZ2h0OmF1dG87dmVydGljYWwtYWxpZ246bWlkZGxlO2JvcmRlcjowOy1tcy1pbnRlcnBvbGF0aW9uLW1vZGU6YmljdWJpYzt9DQojbWFwX2NhbnZhcyBpbWcsLmdvb2dsZS1tYXBzIGltZ3ttYXgtd2lkdGg6bm9uZTt9DQpidXR0b24saW5wdXQsc2VsZWN0LHRleHRhcmVhe21hcmdpbjowO2ZvbnQtc2l6ZToxMDAlO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTt9DQpidXR0b24saW5wdXR7Km92ZXJmbG93OnZpc2libGU7bGluZS1oZWlnaHQ6bm9ybWFsO30NCmJ1dHRvbjo6LW1vei1mb2N1cy1pbm5lcixpbnB1dDo6LW1vei1mb2N1cy1pbm5lcntwYWRkaW5nOjA7Ym9yZGVyOjA7fQ0KYnV0dG9uLGh0bWwgaW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmVzZXQiXSxpbnB1dFt0eXBlPSJzdWJtaXQiXXstd2Via2l0LWFwcGVhcmFuY2U6YnV0dG9uO2N1cnNvcjpwb2ludGVyO30NCmlucHV0W3R5cGU9InNlYXJjaCJdey13ZWJraXQtYm94LXNpemluZzpjb250ZW50LWJveDstbW96LWJveC1zaXppbmc6Y29udGVudC1ib3g7Ym94LXNpemluZzpjb250ZW50LWJveDstd2Via2l0LWFwcGVhcmFuY2U6dGV4dGZpZWxkO30NCmlucHV0W3R5cGU9InNlYXJjaCJdOjotd2Via2l0LXNlYXJjaC1kZWNvcmF0aW9uLGlucHV0W3R5cGU9InNlYXJjaCJdOjotd2Via2l0LXNlYXJjaC1jYW5jZWwtYnV0dG9uey13ZWJraXQtYXBwZWFyYW5jZTpub25lO30NCnRleHRhcmVhe292ZXJmbG93OmF1dG87dmVydGljYWwtYWxpZ246dG9wO30NCmJvZHl7bWFyZ2luOjA7Zm9udC1mYW1pbHk6IkhlbHZldGljYSBOZXVlIixIZWx2ZXRpY2EsQXJpYWwsc2Fucy1zZXJpZjtmb250LXNpemU6MTRweDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiMzMzMzMzM7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO30NCmF7Y29sb3I6IzAwODhjYzt0ZXh0LWRlY29yYXRpb246bm9uZTt9DQphOmhvdmVye2NvbG9yOiMwMDU1ODA7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZTt9DQouaW1nLXJvdW5kZWR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4O30NCi5pbWctcG9sYXJvaWR7cGFkZGluZzo0cHg7YmFja2dyb3VuZC1jb2xvcjojZmZmO2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwgMCwgMCwgMC4yKTstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xKTstbW96LWJveC1zaGFkb3c6MCAxcHggM3B4IHJnYmEoMCwgMCwgMCwgMC4xKTtib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMSk7fQ0KLmltZy1jaXJjbGV7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjUwMHB4Oy1tb3otYm9yZGVyLXJhZGl1czo1MDBweDtib3JkZXItcmFkaXVzOjUwMHB4O30NCi5yb3d7bWFyZ2luLWxlZnQ6LTIwcHg7Knpvb206MTt9LnJvdzpiZWZvcmUsLnJvdzphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoucm93OmFmdGVye2NsZWFyOmJvdGg7fQ0KW2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7bWluLWhlaWdodDoxcHg7bWFyZ2luLWxlZnQ6MjBweDt9DQouY29udGFpbmVyLC5uYXZiYXItc3RhdGljLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLmNvbnRhaW5lcnt3aWR0aDo5NDBweDt9DQouc3BhbjEye3dpZHRoOjk0MHB4O30NCi5zcGFuMTF7d2lkdGg6ODYwcHg7fQ0KLnNwYW4xMHt3aWR0aDo3ODBweDt9DQouc3Bhbjl7d2lkdGg6NzAwcHg7fQ0KLnNwYW44e3dpZHRoOjYyMHB4O30NCi5zcGFuN3t3aWR0aDo1NDBweDt9DQouc3BhbjZ7d2lkdGg6NDYwcHg7fQ0KLnNwYW41e3dpZHRoOjM4MHB4O30NCi5zcGFuNHt3aWR0aDozMDBweDt9DQouc3BhbjN7d2lkdGg6MjIwcHg7fQ0KLnNwYW4ye3dpZHRoOjE0MHB4O30NCi5zcGFuMXt3aWR0aDo2MHB4O30NCi5vZmZzZXQxMnttYXJnaW4tbGVmdDo5ODBweDt9DQoub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTAwcHg7fQ0KLm9mZnNldDEwe21hcmdpbi1sZWZ0OjgyMHB4O30NCi5vZmZzZXQ5e21hcmdpbi1sZWZ0Ojc0MHB4O30NCi5vZmZzZXQ4e21hcmdpbi1sZWZ0OjY2MHB4O30NCi5vZmZzZXQ3e21hcmdpbi1sZWZ0OjU4MHB4O30NCi5vZmZzZXQ2e21hcmdpbi1sZWZ0OjUwMHB4O30NCi5vZmZzZXQ1e21hcmdpbi1sZWZ0OjQyMHB4O30NCi5vZmZzZXQ0e21hcmdpbi1sZWZ0OjM0MHB4O30NCi5vZmZzZXQze21hcmdpbi1sZWZ0OjI2MHB4O30NCi5vZmZzZXQye21hcmdpbi1sZWZ0OjE4MHB4O30NCi5vZmZzZXQxe21hcmdpbi1sZWZ0OjEwMHB4O30NCi5yb3ctZmx1aWR7d2lkdGg6MTAwJTsqem9vbToxO30ucm93LWZsdWlkOmJlZm9yZSwucm93LWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5yb3ctZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQoucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4Oy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDtmbG9hdDpsZWZ0O21hcmdpbi1sZWZ0OjIuMTI3NjU5NTc0NDY4MDg1JTsqbWFyZ2luLWxlZnQ6Mi4wNzQ0NjgwODUxMDYzODMlO30NCi5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7fQ0KLnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6Mi4xMjc2NTk1NzQ0NjgwODUlO30NCi5yb3ctZmx1aWQgLnNwYW4xMnt3aWR0aDoxMDAlOyp3aWR0aDo5OS45NDY4MDg1MTA2MzgyOSU7fQ0KLnJvdy1mbHVpZCAuc3BhbjExe3dpZHRoOjkxLjQ4OTM2MTcwMjEyNzY1JTsqd2lkdGg6OTEuNDM2MTcwMjEyNzY1OTQlO30NCi5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi45Nzg3MjM0MDQyNTUzMiU7KndpZHRoOjgyLjkyNTUzMTkxNDg5MzYxJTt9DQoucm93LWZsdWlkIC5zcGFuOXt3aWR0aDo3NC40NjgwODUxMDYzODI5NyU7KndpZHRoOjc0LjQxNDg5MzYxNzAyMTI2JTt9DQoucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS45NTc0NDY4MDg1MTA2NCU7KndpZHRoOjY1LjkwNDI1NTMxOTE0ODkzJTt9DQoucm93LWZsdWlkIC5zcGFuN3t3aWR0aDo1Ny40NDY4MDg1MTA2MzgyOSU7KndpZHRoOjU3LjM5MzYxNzAyMTI3NjU5JTt9DQoucm93LWZsdWlkIC5zcGFuNnt3aWR0aDo0OC45MzYxNzAyMTI3NjU5NSU7KndpZHRoOjQ4Ljg4Mjk3ODcyMzQwNDI1JTt9DQoucm93LWZsdWlkIC5zcGFuNXt3aWR0aDo0MC40MjU1MzE5MTQ4OTM2MiU7KndpZHRoOjQwLjM3MjM0MDQyNTUzMTkyJTt9DQoucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS45MTQ4OTM2MTcwMjEyNzglOyp3aWR0aDozMS44NjE3MDIxMjc2NTk1NzYlO30NCi5yb3ctZmx1aWQgLnNwYW4ze3dpZHRoOjIzLjQwNDI1NTMxOTE0ODkzNCU7KndpZHRoOjIzLjM1MTA2MzgyOTc4NzIzMyU7fQ0KLnJvdy1mbHVpZCAuc3BhbjJ7d2lkdGg6MTQuODkzNjE3MDIxMjc2NTk1JTsqd2lkdGg6MTQuODQwNDI1NTMxOTE0ODk0JTt9DQoucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo2LjM4Mjk3ODcyMzQwNDI1NSU7KndpZHRoOjYuMzI5Nzg3MjM0MDQyNTUzJTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMDQuMjU1MzE5MTQ4OTM2MTclOyptYXJnaW4tbGVmdDoxMDQuMTQ4OTM2MTcwMjEyNzUlO30NCi5yb3ctZmx1aWQgLm9mZnNldDEyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjEwMi4xMjc2NTk1NzQ0NjgwOCU7Km1hcmdpbi1sZWZ0OjEwMi4wMjEyNzY1OTU3NDQ2NyU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTUuNzQ0NjgwODUxMDYzODIlOyptYXJnaW4tbGVmdDo5NS42MzgyOTc4NzIzNDA0JTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo5My42MTcwMjEyNzY1OTU3NCU7Km1hcmdpbi1sZWZ0OjkzLjUxMDYzODI5Nzg3MjMyJTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMHttYXJnaW4tbGVmdDo4Ny4yMzQwNDI1NTMxOTE0OSU7Km1hcmdpbi1sZWZ0Ojg3LjEyNzY1OTU3NDQ2ODA3JTt9DQoucm93LWZsdWlkIC5vZmZzZXQxMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo4NS4xMDYzODI5Nzg3MjM0JTsqbWFyZ2luLWxlZnQ6ODQuOTk5OTk5OTk5OTk5OTklO30NCi5yb3ctZmx1aWQgLm9mZnNldDl7bWFyZ2luLWxlZnQ6NzguNzIzNDA0MjU1MzE5MTQlOyptYXJnaW4tbGVmdDo3OC42MTcwMjEyNzY1OTU3MiU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ni41OTU3NDQ2ODA4NTEwNiU7Km1hcmdpbi1sZWZ0Ojc2LjQ4OTM2MTcwMjEyNzY0JTt9DQoucm93LWZsdWlkIC5vZmZzZXQ4e21hcmdpbi1sZWZ0OjcwLjIxMjc2NTk1NzQ0NjglOyptYXJnaW4tbGVmdDo3MC4xMDYzODI5Nzg3MjMzOSU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0ODpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo2OC4wODUxMDYzODI5Nzg3MiU7Km1hcmdpbi1sZWZ0OjY3Ljk3ODcyMzQwNDI1NTMlO30NCi5yb3ctZmx1aWQgLm9mZnNldDd7bWFyZ2luLWxlZnQ6NjEuNzAyMTI3NjU5NTc0NDYlOyptYXJnaW4tbGVmdDo2MS41OTU3NDQ2ODA4NTEwNiU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NzpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo1OS41NzQ0NjgwODUxMDYzNzUlOyptYXJnaW4tbGVmdDo1OS40NjgwODUxMDYzODI5NyU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NnttYXJnaW4tbGVmdDo1My4xOTE0ODkzNjE3MDIxMjUlOyptYXJnaW4tbGVmdDo1My4wODUxMDYzODI5Nzg3MTUlO30NCi5yb3ctZmx1aWQgLm9mZnNldDY6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NTEuMDYzODI5Nzg3MjM0MDM1JTsqbWFyZ2luLWxlZnQ6NTAuOTU3NDQ2ODA4NTEwNjMlO30NCi5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDQuNjgwODUxMDYzODI5NzklOyptYXJnaW4tbGVmdDo0NC41NzQ0NjgwODUxMDYzOCU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo0Mi41NTMxOTE0ODkzNjE3JTsqbWFyZ2luLWxlZnQ6NDIuNDQ2ODA4NTEwNjM4MyU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NHttYXJnaW4tbGVmdDozNi4xNzAyMTI3NjU5NTc0NDQlOyptYXJnaW4tbGVmdDozNi4wNjM4Mjk3ODcyMzQwNSU7fQ0KLnJvdy1mbHVpZCAub2Zmc2V0NDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDozNC4wNDI1NTMxOTE0ODkzNiU7Km1hcmdpbi1sZWZ0OjMzLjkzNjE3MDIxMjc2NTk2JTt9DQoucm93LWZsdWlkIC5vZmZzZXQze21hcmdpbi1sZWZ0OjI3LjY1OTU3NDQ2ODA4NTEwNCU7Km1hcmdpbi1sZWZ0OjI3LjU1MzE5MTQ4OTM2MTclO30NCi5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNTMxOTE0ODkzNjE3MDIlOyptYXJnaW4tbGVmdDoyNS40MjU1MzE5MTQ4OTM2MTglO30NCi5yb3ctZmx1aWQgLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTkuMTQ4OTM2MTcwMjEyNzY0JTsqbWFyZ2luLWxlZnQ6MTkuMDQyNTUzMTkxNDg5MzYlO30NCi5yb3ctZmx1aWQgLm9mZnNldDI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTcuMDIxMjc2NTk1NzQ0NjglOyptYXJnaW4tbGVmdDoxNi45MTQ4OTM2MTcwMjEyNzglO30NCi5yb3ctZmx1aWQgLm9mZnNldDF7bWFyZ2luLWxlZnQ6MTAuNjM4Mjk3ODcyMzQwNDI1JTsqbWFyZ2luLWxlZnQ6MTAuNTMxOTE0ODkzNjE3MDIlO30NCi5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41MTA2MzgyOTc4NzIzNCU7Km1hcmdpbi1sZWZ0OjguNDA0MjU1MzE5MTQ4OTM4JTt9DQpbY2xhc3MqPSJzcGFuIl0uaGlkZSwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXS5oaWRle2Rpc3BsYXk6bm9uZTt9DQpbY2xhc3MqPSJzcGFuIl0ucHVsbC1yaWdodCwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXS5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O30NCi5jb250YWluZXJ7bWFyZ2luLXJpZ2h0OmF1dG87bWFyZ2luLWxlZnQ6YXV0bzsqem9vbToxO30uY29udGFpbmVyOmJlZm9yZSwuY29udGFpbmVyOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5jb250YWluZXI6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQouY29udGFpbmVyLWZsdWlke3BhZGRpbmctcmlnaHQ6MjBweDtwYWRkaW5nLWxlZnQ6MjBweDsqem9vbToxO30uY29udGFpbmVyLWZsdWlkOmJlZm9yZSwuY29udGFpbmVyLWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5jb250YWluZXItZmx1aWQ6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQpwe21hcmdpbjowIDAgMTBweDt9DQoubGVhZHttYXJnaW4tYm90dG9tOjIwcHg7Zm9udC1zaXplOjIxcHg7Zm9udC13ZWlnaHQ6MjAwO2xpbmUtaGVpZ2h0OjMwcHg7fQ0Kc21hbGx7Zm9udC1zaXplOjg1JTt9DQpzdHJvbmd7Zm9udC13ZWlnaHQ6Ym9sZDt9DQplbXtmb250LXN0eWxlOml0YWxpYzt9DQpjaXRle2ZvbnQtc3R5bGU6bm9ybWFsO30NCi5tdXRlZHtjb2xvcjojOTk5OTk5O30NCi50ZXh0LXdhcm5pbmd7Y29sb3I6I2MwOTg1Mzt9DQphLnRleHQtd2FybmluZzpob3Zlcntjb2xvcjojYTQ3ZTNjO30NCi50ZXh0LWVycm9ye2NvbG9yOiNiOTRhNDg7fQ0KYS50ZXh0LWVycm9yOmhvdmVye2NvbG9yOiM5NTNiMzk7fQ0KLnRleHQtaW5mb3tjb2xvcjojM2E4N2FkO30NCmEudGV4dC1pbmZvOmhvdmVye2NvbG9yOiMyZDY5ODc7fQ0KLnRleHQtc3VjY2Vzc3tjb2xvcjojNDY4ODQ3O30NCmEudGV4dC1zdWNjZXNzOmhvdmVye2NvbG9yOiMzNTY2MzU7fQ0KaDEsaDIsaDMsaDQsaDUsaDZ7bWFyZ2luOjEwcHggMDtmb250LWZhbWlseTppbmhlcml0O2ZvbnQtd2VpZ2h0OmJvbGQ7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjppbmhlcml0O3RleHQtcmVuZGVyaW5nOm9wdGltaXplbGVnaWJpbGl0eTt9aDEgc21hbGwsaDIgc21hbGwsaDMgc21hbGwsaDQgc21hbGwsaDUgc21hbGwsaDYgc21hbGx7Zm9udC13ZWlnaHQ6bm9ybWFsO2xpbmUtaGVpZ2h0OjE7Y29sb3I6Izk5OTk5OTt9DQpoMSxoMixoM3tsaW5lLWhlaWdodDo0MHB4O30NCmgxe2ZvbnQtc2l6ZTozOC41cHg7fQ0KaDJ7Zm9udC1zaXplOjMxLjVweDt9DQpoM3tmb250LXNpemU6MjQuNXB4O30NCmg0e2ZvbnQtc2l6ZToxNy41cHg7fQ0KaDV7Zm9udC1zaXplOjE0cHg7fQ0KaDZ7Zm9udC1zaXplOjExLjlweDt9DQpoMSBzbWFsbHtmb250LXNpemU6MjQuNXB4O30NCmgyIHNtYWxse2ZvbnQtc2l6ZToxNy41cHg7fQ0KaDMgc21hbGx7Zm9udC1zaXplOjE0cHg7fQ0KaDQgc21hbGx7Zm9udC1zaXplOjE0cHg7fQ0KLnBhZ2UtaGVhZGVye3BhZGRpbmctYm90dG9tOjlweDttYXJnaW46MjBweCAwIDMwcHg7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2VlZWVlZTt9DQp1bCxvbHtwYWRkaW5nOjA7bWFyZ2luOjAgMCAxMHB4IDI1cHg7fQ0KdWwgdWwsdWwgb2wsb2wgb2wsb2wgdWx7bWFyZ2luLWJvdHRvbTowO30NCmxpe2xpbmUtaGVpZ2h0OjIwcHg7fQ0KdWwudW5zdHlsZWQsb2wudW5zdHlsZWR7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmU7fQ0KZGx7bWFyZ2luLWJvdHRvbToyMHB4O30NCmR0LGRke2xpbmUtaGVpZ2h0OjIwcHg7fQ0KZHR7Zm9udC13ZWlnaHQ6Ym9sZDt9DQpkZHttYXJnaW4tbGVmdDoxMHB4O30NCi5kbC1ob3Jpem9udGFseyp6b29tOjE7fS5kbC1ob3Jpem9udGFsOmJlZm9yZSwuZGwtaG9yaXpvbnRhbDphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQouZGwtaG9yaXpvbnRhbDphZnRlcntjbGVhcjpib3RoO30NCi5kbC1ob3Jpem9udGFsIGR0e2Zsb2F0OmxlZnQ7d2lkdGg6MTYwcHg7Y2xlYXI6bGVmdDt0ZXh0LWFsaWduOnJpZ2h0O292ZXJmbG93OmhpZGRlbjt0ZXh0LW92ZXJmbG93OmVsbGlwc2lzO3doaXRlLXNwYWNlOm5vd3JhcDt9DQouZGwtaG9yaXpvbnRhbCBkZHttYXJnaW4tbGVmdDoxODBweDt9DQpocnttYXJnaW46MjBweCAwO2JvcmRlcjowO2JvcmRlci10b3A6MXB4IHNvbGlkICNlZWVlZWU7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2ZmZmZmZjt9DQphYmJyW3RpdGxlXSxhYmJyW2RhdGEtb3JpZ2luYWwtdGl0bGVde2N1cnNvcjpoZWxwO2JvcmRlci1ib3R0b206MXB4IGRvdHRlZCAjOTk5OTk5O30NCmFiYnIuaW5pdGlhbGlzbXtmb250LXNpemU6OTAlO3RleHQtdHJhbnNmb3JtOnVwcGVyY2FzZTt9DQpibG9ja3F1b3Rle3BhZGRpbmc6MCAwIDAgMTVweDttYXJnaW46MCAwIDIwcHg7Ym9yZGVyLWxlZnQ6NXB4IHNvbGlkICNlZWVlZWU7fWJsb2NrcXVvdGUgcHttYXJnaW4tYm90dG9tOjA7Zm9udC1zaXplOjE2cHg7Zm9udC13ZWlnaHQ6MzAwO2xpbmUtaGVpZ2h0OjI1cHg7fQ0KYmxvY2txdW90ZSBzbWFsbHtkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6Izk5OTk5OTt9YmxvY2txdW90ZSBzbWFsbDpiZWZvcmV7Y29udGVudDonXDIwMTQgXDAwQTAnO30NCmJsb2NrcXVvdGUucHVsbC1yaWdodHtmbG9hdDpyaWdodDtwYWRkaW5nLXJpZ2h0OjE1cHg7cGFkZGluZy1sZWZ0OjA7Ym9yZGVyLXJpZ2h0OjVweCBzb2xpZCAjZWVlZWVlO2JvcmRlci1sZWZ0OjA7fWJsb2NrcXVvdGUucHVsbC1yaWdodCBwLGJsb2NrcXVvdGUucHVsbC1yaWdodCBzbWFsbHt0ZXh0LWFsaWduOnJpZ2h0O30NCmJsb2NrcXVvdGUucHVsbC1yaWdodCBzbWFsbDpiZWZvcmV7Y29udGVudDonJzt9DQpibG9ja3F1b3RlLnB1bGwtcmlnaHQgc21hbGw6YWZ0ZXJ7Y29udGVudDonXDAwQTAgXDIwMTQnO30NCnE6YmVmb3JlLHE6YWZ0ZXIsYmxvY2txdW90ZTpiZWZvcmUsYmxvY2txdW90ZTphZnRlcntjb250ZW50OiIiO30NCmFkZHJlc3N7ZGlzcGxheTpibG9jazttYXJnaW4tYm90dG9tOjIwcHg7Zm9udC1zdHlsZTpub3JtYWw7bGluZS1oZWlnaHQ6MjBweDt9DQpjb2RlLHByZXtwYWRkaW5nOjAgM3B4IDJweDtmb250LWZhbWlseTpNb25hY28sTWVubG8sQ29uc29sYXMsIkNvdXJpZXIgTmV3Iixtb25vc3BhY2U7Zm9udC1zaXplOjEycHg7Y29sb3I6IzMzMzMzMzstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHg7fQ0KY29kZXtwYWRkaW5nOjJweCA0cHg7Y29sb3I6I2QxNDtiYWNrZ3JvdW5kLWNvbG9yOiNmN2Y3Zjk7Ym9yZGVyOjFweCBzb2xpZCAjZTFlMWU4O30NCnByZXtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6OS41cHg7bWFyZ2luOjAgMCAxMHB4O2ZvbnQtc2l6ZToxM3B4O2xpbmUtaGVpZ2h0OjIwcHg7d29yZC1icmVhazpicmVhay1hbGw7d29yZC13cmFwOmJyZWFrLXdvcmQ7d2hpdGUtc3BhY2U6cHJlO3doaXRlLXNwYWNlOnByZS13cmFwO2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTtib3JkZXI6MXB4IHNvbGlkICNjY2M7Ym9yZGVyOjFweCBzb2xpZCByZ2JhKDAsIDAsIDAsIDAuMTUpOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9cHJlLnByZXR0eXByaW50e21hcmdpbi1ib3R0b206MjBweDt9DQpwcmUgY29kZXtwYWRkaW5nOjA7Y29sb3I6aW5oZXJpdDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjowO30NCi5wcmUtc2Nyb2xsYWJsZXttYXgtaGVpZ2h0OjM0MHB4O292ZXJmbG93LXk6c2Nyb2xsO30NCi5sYWJlbCwuYmFkZ2V7ZGlzcGxheTppbmxpbmUtYmxvY2s7cGFkZGluZzoycHggNHB4O2ZvbnQtc2l6ZToxMS44NDRweDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjE0cHg7Y29sb3I6I2ZmZmZmZjt2ZXJ0aWNhbC1hbGlnbjpiYXNlbGluZTt3aGl0ZS1zcGFjZTpub3dyYXA7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiM5OTk5OTk7fQ0KLmxhYmVsey13ZWJraXQtYm9yZGVyLXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzOjNweDtib3JkZXItcmFkaXVzOjNweDt9DQouYmFkZ2V7cGFkZGluZy1sZWZ0OjlweDtwYWRkaW5nLXJpZ2h0OjlweDstd2Via2l0LWJvcmRlci1yYWRpdXM6OXB4Oy1tb3otYm9yZGVyLXJhZGl1czo5cHg7Ym9yZGVyLXJhZGl1czo5cHg7fQ0KYS5sYWJlbDpob3ZlcixhLmJhZGdlOmhvdmVye2NvbG9yOiNmZmZmZmY7dGV4dC1kZWNvcmF0aW9uOm5vbmU7Y3Vyc29yOnBvaW50ZXI7fQ0KLmxhYmVsLWltcG9ydGFudCwuYmFkZ2UtaW1wb3J0YW50e2JhY2tncm91bmQtY29sb3I6I2I5NGE0ODt9DQoubGFiZWwtaW1wb3J0YW50W2hyZWZdLC5iYWRnZS1pbXBvcnRhbnRbaHJlZl17YmFja2dyb3VuZC1jb2xvcjojOTUzYjM5O30NCi5sYWJlbC13YXJuaW5nLC5iYWRnZS13YXJuaW5ne2JhY2tncm91bmQtY29sb3I6I2Y4OTQwNjt9DQoubGFiZWwtd2FybmluZ1tocmVmXSwuYmFkZ2Utd2FybmluZ1tocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiNjNjc2MDU7fQ0KLmxhYmVsLXN1Y2Nlc3MsLmJhZGdlLXN1Y2Nlc3N7YmFja2dyb3VuZC1jb2xvcjojNDY4ODQ3O30NCi5sYWJlbC1zdWNjZXNzW2hyZWZdLC5iYWRnZS1zdWNjZXNzW2hyZWZde2JhY2tncm91bmQtY29sb3I6IzM1NjYzNTt9DQoubGFiZWwtaW5mbywuYmFkZ2UtaW5mb3tiYWNrZ3JvdW5kLWNvbG9yOiMzYTg3YWQ7fQ0KLmxhYmVsLWluZm9baHJlZl0sLmJhZGdlLWluZm9baHJlZl17YmFja2dyb3VuZC1jb2xvcjojMmQ2OTg3O30NCi5sYWJlbC1pbnZlcnNlLC5iYWRnZS1pbnZlcnNle2JhY2tncm91bmQtY29sb3I6IzMzMzMzMzt9DQoubGFiZWwtaW52ZXJzZVtocmVmXSwuYmFkZ2UtaW52ZXJzZVtocmVmXXtiYWNrZ3JvdW5kLWNvbG9yOiMxYTFhMWE7fQ0KLmJ0biAubGFiZWwsLmJ0biAuYmFkZ2V7cG9zaXRpb246cmVsYXRpdmU7dG9wOi0xcHg7fQ0KLmJ0bi1taW5pIC5sYWJlbCwuYnRuLW1pbmkgLmJhZGdle3RvcDowO30NCnRhYmxle21heC13aWR0aDoxMDAlO2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLWNvbGxhcHNlOmNvbGxhcHNlO2JvcmRlci1zcGFjaW5nOjA7fQ0KLnRhYmxle3dpZHRoOjEwMCU7bWFyZ2luLWJvdHRvbToyMHB4O30udGFibGUgdGgsLnRhYmxlIHRke3BhZGRpbmc6OHB4O2xpbmUtaGVpZ2h0OjIwcHg7dGV4dC1hbGlnbjpsZWZ0O3ZlcnRpY2FsLWFsaWduOnRvcDtib3JkZXItdG9wOjFweCBzb2xpZCAjZGRkZGRkO30NCi50YWJsZSB0aHtmb250LXdlaWdodDpib2xkO30NCi50YWJsZSB0aGVhZCB0aHt2ZXJ0aWNhbC1hbGlnbjpib3R0b207fQ0KLnRhYmxlIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZSBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0ZCwudGFibGUgdGhlYWQ6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRke2JvcmRlci10b3A6MDt9DQoudGFibGUgdGJvZHkrdGJvZHl7Ym9yZGVyLXRvcDoycHggc29saWQgI2RkZGRkZDt9DQoudGFibGUtY29uZGVuc2VkIHRoLC50YWJsZS1jb25kZW5zZWQgdGR7cGFkZGluZzo0cHggNXB4O30NCi50YWJsZS1ib3JkZXJlZHtib3JkZXI6MXB4IHNvbGlkICNkZGRkZGQ7Ym9yZGVyLWNvbGxhcHNlOnNlcGFyYXRlOypib3JkZXItY29sbGFwc2U6Y29sbGFwc2U7Ym9yZGVyLWxlZnQ6MDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7fS50YWJsZS1ib3JkZXJlZCB0aCwudGFibGUtYm9yZGVyZWQgdGR7Ym9yZGVyLWxlZnQ6MXB4IHNvbGlkICNkZGRkZGQ7fQ0KLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGgsLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlLWJvcmRlcmVkIGNvbGdyb3VwK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0Ym9keSB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQsLnRhYmxlLWJvcmRlcmVkIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRoLC50YWJsZS1ib3JkZXJlZCB0Ym9keTpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0aCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGR7Ym9yZGVyLXRvcDowO30NCi50YWJsZS1ib3JkZXJlZCB0aGVhZDpmaXJzdC1jaGlsZCB0cjpmaXJzdC1jaGlsZCB0aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6Zmlyc3QtY2hpbGQgdHI6Zmlyc3QtY2hpbGQgdGQ6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHg7fQ0KLnRhYmxlLWJvcmRlcmVkIHRoZWFkOmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRoOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRib2R5OmZpcnN0LWNoaWxkIHRyOmZpcnN0LWNoaWxkIHRkOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHg7fQ0KLnRhYmxlLWJvcmRlcmVkIHRoZWFkOmxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZCB0aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkIHRkOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCB0Zm9vdDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQgdGQ6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDAgNHB4O2JvcmRlci1yYWRpdXM6MCAwIDAgNHB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6NHB4O30NCi50YWJsZS1ib3JkZXJlZCB0aGVhZDpsYXN0LWNoaWxkIHRyOmxhc3QtY2hpbGQgdGg6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgdGJvZHk6bGFzdC1jaGlsZCB0cjpsYXN0LWNoaWxkIHRkOmxhc3QtY2hpbGQsLnRhYmxlLWJvcmRlcmVkIHRmb290Omxhc3QtY2hpbGQgdHI6bGFzdC1jaGlsZCB0ZDpsYXN0LWNoaWxkey13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4O30NCi50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3RoZWFkIHRyOmZpcnN0LWNoaWxkIHRoOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjYXB0aW9uK3Rib2R5IHRyOmZpcnN0LWNoaWxkIHRkOmZpcnN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aDpmaXJzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgY29sZ3JvdXArdGJvZHkgdHI6Zmlyc3QtY2hpbGQgdGQ6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHg7fQ0KLnRhYmxlLWJvcmRlcmVkIGNhcHRpb24rdGhlYWQgdHI6Zmlyc3QtY2hpbGQgdGg6bGFzdC1jaGlsZCwudGFibGUtYm9yZGVyZWQgY2FwdGlvbit0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0aGVhZCB0cjpmaXJzdC1jaGlsZCB0aDpsYXN0LWNoaWxkLC50YWJsZS1ib3JkZXJlZCBjb2xncm91cCt0Ym9keSB0cjpmaXJzdC1jaGlsZCB0ZDpsYXN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NHB4O30NCi50YWJsZS1zdHJpcGVkIHRib2R5IHRyOm50aC1jaGlsZChvZGQpIHRkLC50YWJsZS1zdHJpcGVkIHRib2R5IHRyOm50aC1jaGlsZChvZGQpIHRoe2JhY2tncm91bmQtY29sb3I6I2Y5ZjlmOTt9DQoudGFibGUtaG92ZXIgdGJvZHkgdHI6aG92ZXIgdGQsLnRhYmxlLWhvdmVyIHRib2R5IHRyOmhvdmVyIHRoe2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTt9DQp0YWJsZSB0ZFtjbGFzcyo9InNwYW4iXSx0YWJsZSB0aFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIHRhYmxlIHRkW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgdGFibGUgdGhbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTp0YWJsZS1jZWxsO2Zsb2F0Om5vbmU7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjEsLnRhYmxlIHRoLnNwYW4xe2Zsb2F0Om5vbmU7d2lkdGg6NDRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuMiwudGFibGUgdGguc3BhbjJ7ZmxvYXQ6bm9uZTt3aWR0aDoxMjRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuMywudGFibGUgdGguc3BhbjN7ZmxvYXQ6bm9uZTt3aWR0aDoyMDRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuNCwudGFibGUgdGguc3BhbjR7ZmxvYXQ6bm9uZTt3aWR0aDoyODRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuNSwudGFibGUgdGguc3BhbjV7ZmxvYXQ6bm9uZTt3aWR0aDozNjRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuNiwudGFibGUgdGguc3BhbjZ7ZmxvYXQ6bm9uZTt3aWR0aDo0NDRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuNywudGFibGUgdGguc3Bhbjd7ZmxvYXQ6bm9uZTt3aWR0aDo1MjRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuOCwudGFibGUgdGguc3Bhbjh7ZmxvYXQ6bm9uZTt3aWR0aDo2MDRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuOSwudGFibGUgdGguc3Bhbjl7ZmxvYXQ6bm9uZTt3aWR0aDo2ODRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0ZC5zcGFuMTAsLnRhYmxlIHRoLnNwYW4xMHtmbG9hdDpub25lO3dpZHRoOjc2NHB4O21hcmdpbi1sZWZ0OjA7fQ0KLnRhYmxlIHRkLnNwYW4xMSwudGFibGUgdGguc3BhbjExe2Zsb2F0Om5vbmU7d2lkdGg6ODQ0cHg7bWFyZ2luLWxlZnQ6MDt9DQoudGFibGUgdGQuc3BhbjEyLC50YWJsZSB0aC5zcGFuMTJ7ZmxvYXQ6bm9uZTt3aWR0aDo5MjRweDttYXJnaW4tbGVmdDowO30NCi50YWJsZSB0Ym9keSB0ci5zdWNjZXNzIHRke2JhY2tncm91bmQtY29sb3I6I2RmZjBkODt9DQoudGFibGUgdGJvZHkgdHIuZXJyb3IgdGR7YmFja2dyb3VuZC1jb2xvcjojZjJkZWRlO30NCi50YWJsZSB0Ym9keSB0ci53YXJuaW5nIHRke2JhY2tncm91bmQtY29sb3I6I2ZjZjhlMzt9DQoudGFibGUgdGJvZHkgdHIuaW5mbyB0ZHtiYWNrZ3JvdW5kLWNvbG9yOiNkOWVkZjc7fQ0KLnRhYmxlLWhvdmVyIHRib2R5IHRyLnN1Y2Nlc3M6aG92ZXIgdGR7YmFja2dyb3VuZC1jb2xvcjojZDBlOWM2O30NCi50YWJsZS1ob3ZlciB0Ym9keSB0ci5lcnJvcjpob3ZlciB0ZHtiYWNrZ3JvdW5kLWNvbG9yOiNlYmNjY2M7fQ0KLnRhYmxlLWhvdmVyIHRib2R5IHRyLndhcm5pbmc6aG92ZXIgdGR7YmFja2dyb3VuZC1jb2xvcjojZmFmMmNjO30NCi50YWJsZS1ob3ZlciB0Ym9keSB0ci5pbmZvOmhvdmVyIHRke2JhY2tncm91bmQtY29sb3I6I2M0ZTNmMzt9DQpmb3Jte21hcmdpbjowIDAgMjBweDt9DQpmaWVsZHNldHtwYWRkaW5nOjA7bWFyZ2luOjA7Ym9yZGVyOjA7fQ0KbGVnZW5ke2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTtwYWRkaW5nOjA7bWFyZ2luLWJvdHRvbToyMHB4O2ZvbnQtc2l6ZToyMXB4O2xpbmUtaGVpZ2h0OjQwcHg7Y29sb3I6IzMzMzMzMztib3JkZXI6MDtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZTVlNWU1O31sZWdlbmQgc21hbGx7Zm9udC1zaXplOjE1cHg7Y29sb3I6Izk5OTk5OTt9DQpsYWJlbCxpbnB1dCxidXR0b24sc2VsZWN0LHRleHRhcmVhe2ZvbnQtc2l6ZToxNHB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtsaW5lLWhlaWdodDoyMHB4O30NCmlucHV0LGJ1dHRvbixzZWxlY3QsdGV4dGFyZWF7Zm9udC1mYW1pbHk6IkhlbHZldGljYSBOZXVlIixIZWx2ZXRpY2EsQXJpYWwsc2Fucy1zZXJpZjt9DQpsYWJlbHtkaXNwbGF5OmJsb2NrO21hcmdpbi1ib3R0b206NXB4O30NCnNlbGVjdCx0ZXh0YXJlYSxpbnB1dFt0eXBlPSJ0ZXh0Il0saW5wdXRbdHlwZT0icGFzc3dvcmQiXSxpbnB1dFt0eXBlPSJkYXRldGltZSJdLGlucHV0W3R5cGU9ImRhdGV0aW1lLWxvY2FsIl0saW5wdXRbdHlwZT0iZGF0ZSJdLGlucHV0W3R5cGU9Im1vbnRoIl0saW5wdXRbdHlwZT0idGltZSJdLGlucHV0W3R5cGU9IndlZWsiXSxpbnB1dFt0eXBlPSJudW1iZXIiXSxpbnB1dFt0eXBlPSJlbWFpbCJdLGlucHV0W3R5cGU9InVybCJdLGlucHV0W3R5cGU9InNlYXJjaCJdLGlucHV0W3R5cGU9InRlbCJdLGlucHV0W3R5cGU9ImNvbG9yIl0sLnVuZWRpdGFibGUtaW5wdXR7ZGlzcGxheTppbmxpbmUtYmxvY2s7aGVpZ2h0OjIwcHg7cGFkZGluZzo0cHggNnB4O21hcmdpbi1ib3R0b206MTBweDtmb250LXNpemU6MTRweDtsaW5lLWhlaWdodDoyMHB4O2NvbG9yOiM1NTU1NTU7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O3ZlcnRpY2FsLWFsaWduOm1pZGRsZTt9DQppbnB1dCx0ZXh0YXJlYSwudW5lZGl0YWJsZS1pbnB1dHt3aWR0aDoyMDZweDt9DQp0ZXh0YXJlYXtoZWlnaHQ6YXV0bzt9DQp0ZXh0YXJlYSxpbnB1dFt0eXBlPSJ0ZXh0Il0saW5wdXRbdHlwZT0icGFzc3dvcmQiXSxpbnB1dFt0eXBlPSJkYXRldGltZSJdLGlucHV0W3R5cGU9ImRhdGV0aW1lLWxvY2FsIl0saW5wdXRbdHlwZT0iZGF0ZSJdLGlucHV0W3R5cGU9Im1vbnRoIl0saW5wdXRbdHlwZT0idGltZSJdLGlucHV0W3R5cGU9IndlZWsiXSxpbnB1dFt0eXBlPSJudW1iZXIiXSxpbnB1dFt0eXBlPSJlbWFpbCJdLGlucHV0W3R5cGU9InVybCJdLGlucHV0W3R5cGU9InNlYXJjaCJdLGlucHV0W3R5cGU9InRlbCJdLGlucHV0W3R5cGU9ImNvbG9yIl0sLnVuZWRpdGFibGUtaW5wdXR7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO2JvcmRlcjoxcHggc29saWQgI2NjY2NjYzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7LXdlYmtpdC10cmFuc2l0aW9uOmJvcmRlciBsaW5lYXIgLjJzLCBib3gtc2hhZG93IGxpbmVhciAuMnM7LW1vei10cmFuc2l0aW9uOmJvcmRlciBsaW5lYXIgLjJzLCBib3gtc2hhZG93IGxpbmVhciAuMnM7LW8tdHJhbnNpdGlvbjpib3JkZXIgbGluZWFyIC4ycywgYm94LXNoYWRvdyBsaW5lYXIgLjJzO3RyYW5zaXRpb246Ym9yZGVyIGxpbmVhciAuMnMsIGJveC1zaGFkb3cgbGluZWFyIC4yczt9dGV4dGFyZWE6Zm9jdXMsaW5wdXRbdHlwZT0idGV4dCJdOmZvY3VzLGlucHV0W3R5cGU9InBhc3N3b3JkIl06Zm9jdXMsaW5wdXRbdHlwZT0iZGF0ZXRpbWUiXTpmb2N1cyxpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdOmZvY3VzLGlucHV0W3R5cGU9ImRhdGUiXTpmb2N1cyxpbnB1dFt0eXBlPSJtb250aCJdOmZvY3VzLGlucHV0W3R5cGU9InRpbWUiXTpmb2N1cyxpbnB1dFt0eXBlPSJ3ZWVrIl06Zm9jdXMsaW5wdXRbdHlwZT0ibnVtYmVyIl06Zm9jdXMsaW5wdXRbdHlwZT0iZW1haWwiXTpmb2N1cyxpbnB1dFt0eXBlPSJ1cmwiXTpmb2N1cyxpbnB1dFt0eXBlPSJzZWFyY2giXTpmb2N1cyxpbnB1dFt0eXBlPSJ0ZWwiXTpmb2N1cyxpbnB1dFt0eXBlPSJjb2xvciJdOmZvY3VzLC51bmVkaXRhYmxlLWlucHV0OmZvY3Vze2JvcmRlci1jb2xvcjpyZ2JhKDgyLCAxNjgsIDIzNiwgMC44KTtvdXRsaW5lOjA7b3V0bGluZTp0aGluIGRvdHRlZCBcOTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsLjA3NSksIDAgMCA4cHggcmdiYSg4MiwxNjgsMjM2LC42KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwwLDAsLjA3NSksIDAgMCA4cHggcmdiYSg4MiwxNjgsMjM2LC42KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsMCwwLC4wNzUpLCAwIDAgOHB4IHJnYmEoODIsMTY4LDIzNiwuNik7fQ0KaW5wdXRbdHlwZT0icmFkaW8iXSxpbnB1dFt0eXBlPSJjaGVja2JveCJde21hcmdpbjo0cHggMCAwOyptYXJnaW4tdG9wOjA7bWFyZ2luLXRvcDoxcHggXDk7bGluZS1oZWlnaHQ6bm9ybWFsO2N1cnNvcjpwb2ludGVyO30NCmlucHV0W3R5cGU9ImZpbGUiXSxpbnB1dFt0eXBlPSJpbWFnZSJdLGlucHV0W3R5cGU9InN1Ym1pdCJdLGlucHV0W3R5cGU9InJlc2V0Il0saW5wdXRbdHlwZT0iYnV0dG9uIl0saW5wdXRbdHlwZT0icmFkaW8iXSxpbnB1dFt0eXBlPSJjaGVja2JveCJde3dpZHRoOmF1dG87fQ0Kc2VsZWN0LGlucHV0W3R5cGU9ImZpbGUiXXtoZWlnaHQ6MzBweDsqbWFyZ2luLXRvcDo0cHg7bGluZS1oZWlnaHQ6MzBweDt9DQpzZWxlY3R7d2lkdGg6MjIwcHg7Ym9yZGVyOjFweCBzb2xpZCAjY2NjY2NjO2JhY2tncm91bmQtY29sb3I6I2ZmZmZmZjt9DQpzZWxlY3RbbXVsdGlwbGVdLHNlbGVjdFtzaXplXXtoZWlnaHQ6YXV0bzt9DQpzZWxlY3Q6Zm9jdXMsaW5wdXRbdHlwZT0iZmlsZSJdOmZvY3VzLGlucHV0W3R5cGU9InJhZGlvIl06Zm9jdXMsaW5wdXRbdHlwZT0iY2hlY2tib3giXTpmb2N1c3tvdXRsaW5lOnRoaW4gZG90dGVkICMzMzM7b3V0bGluZTo1cHggYXV0byAtd2Via2l0LWZvY3VzLXJpbmctY29sb3I7b3V0bGluZS1vZmZzZXQ6LTJweDt9DQoudW5lZGl0YWJsZS1pbnB1dCwudW5lZGl0YWJsZS10ZXh0YXJlYXtjb2xvcjojOTk5OTk5O2JhY2tncm91bmQtY29sb3I6I2ZjZmNmYztib3JkZXItY29sb3I6I2NjY2NjYzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwgMCwgMCwgMC4wMjUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLCAwLCAwLCAwLjAyNSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAycHggcmdiYSgwLCAwLCAwLCAwLjAyNSk7Y3Vyc29yOm5vdC1hbGxvd2VkO30NCi51bmVkaXRhYmxlLWlucHV0e292ZXJmbG93OmhpZGRlbjt3aGl0ZS1zcGFjZTpub3dyYXA7fQ0KLnVuZWRpdGFibGUtdGV4dGFyZWF7d2lkdGg6YXV0bztoZWlnaHQ6YXV0bzt9DQppbnB1dDotbW96LXBsYWNlaG9sZGVyLHRleHRhcmVhOi1tb3otcGxhY2Vob2xkZXJ7Y29sb3I6Izk5OTk5OTt9DQppbnB1dDotbXMtaW5wdXQtcGxhY2Vob2xkZXIsdGV4dGFyZWE6LW1zLWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiM5OTk5OTk7fQ0KaW5wdXQ6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXIsdGV4dGFyZWE6Oi13ZWJraXQtaW5wdXQtcGxhY2Vob2xkZXJ7Y29sb3I6Izk5OTk5OTt9DQoucmFkaW8sLmNoZWNrYm94e21pbi1oZWlnaHQ6MjBweDtwYWRkaW5nLWxlZnQ6MjBweDt9DQoucmFkaW8gaW5wdXRbdHlwZT0icmFkaW8iXSwuY2hlY2tib3ggaW5wdXRbdHlwZT0iY2hlY2tib3giXXtmbG9hdDpsZWZ0O21hcmdpbi1sZWZ0Oi0yMHB4O30NCi5jb250cm9scz4ucmFkaW86Zmlyc3QtY2hpbGQsLmNvbnRyb2xzPi5jaGVja2JveDpmaXJzdC1jaGlsZHtwYWRkaW5nLXRvcDo1cHg7fQ0KLnJhZGlvLmlubGluZSwuY2hlY2tib3guaW5saW5le2Rpc3BsYXk6aW5saW5lLWJsb2NrO3BhZGRpbmctdG9wOjVweDttYXJnaW4tYm90dG9tOjA7dmVydGljYWwtYWxpZ246bWlkZGxlO30NCi5yYWRpby5pbmxpbmUrLnJhZGlvLmlubGluZSwuY2hlY2tib3guaW5saW5lKy5jaGVja2JveC5pbmxpbmV7bWFyZ2luLWxlZnQ6MTBweDt9DQouaW5wdXQtbWluaXt3aWR0aDo2MHB4O30NCi5pbnB1dC1zbWFsbHt3aWR0aDo5MHB4O30NCi5pbnB1dC1tZWRpdW17d2lkdGg6MTUwcHg7fQ0KLmlucHV0LWxhcmdle3dpZHRoOjIxMHB4O30NCi5pbnB1dC14bGFyZ2V7d2lkdGg6MjcwcHg7fQ0KLmlucHV0LXh4bGFyZ2V7d2lkdGg6NTMwcHg7fQ0KaW5wdXRbY2xhc3MqPSJzcGFuIl0sc2VsZWN0W2NsYXNzKj0ic3BhbiJdLHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCBzZWxlY3RbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCB0ZXh0YXJlYVtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIC51bmVkaXRhYmxlLWlucHV0W2NsYXNzKj0ic3BhbiJde2Zsb2F0Om5vbmU7bWFyZ2luLWxlZnQ6MDt9DQouaW5wdXQtYXBwZW5kIGlucHV0W2NsYXNzKj0ic3BhbiJdLC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXRbY2xhc3MqPSJzcGFuIl0sLmlucHV0LXByZXBlbmQgaW5wdXRbY2xhc3MqPSJzcGFuIl0sLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCBpbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIHNlbGVjdFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC5yb3ctZmx1aWQgLnVuZWRpdGFibGUtaW5wdXRbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAuaW5wdXQtcHJlcGVuZCBbY2xhc3MqPSJzcGFuIl0sLnJvdy1mbHVpZCAuaW5wdXQtYXBwZW5kIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmlubGluZS1ibG9jazt9DQppbnB1dCx0ZXh0YXJlYSwudW5lZGl0YWJsZS1pbnB1dHttYXJnaW4tbGVmdDowO30NCi5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyMHB4O30NCmlucHV0LnNwYW4xMiwgdGV4dGFyZWEuc3BhbjEyLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMTJ7d2lkdGg6OTI2cHg7fQ0KaW5wdXQuc3BhbjExLCB0ZXh0YXJlYS5zcGFuMTEsIC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMXt3aWR0aDo4NDZweDt9DQppbnB1dC5zcGFuMTAsIHRleHRhcmVhLnNwYW4xMCwgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEwe3dpZHRoOjc2NnB4O30NCmlucHV0LnNwYW45LCB0ZXh0YXJlYS5zcGFuOSwgLnVuZWRpdGFibGUtaW5wdXQuc3Bhbjl7d2lkdGg6Njg2cHg7fQ0KaW5wdXQuc3BhbjgsIHRleHRhcmVhLnNwYW44LCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo2MDZweDt9DQppbnB1dC5zcGFuNywgdGV4dGFyZWEuc3BhbjcsIC51bmVkaXRhYmxlLWlucHV0LnNwYW43e3dpZHRoOjUyNnB4O30NCmlucHV0LnNwYW42LCB0ZXh0YXJlYS5zcGFuNiwgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjZ7d2lkdGg6NDQ2cHg7fQ0KaW5wdXQuc3BhbjUsIHRleHRhcmVhLnNwYW41LCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDozNjZweDt9DQppbnB1dC5zcGFuNCwgdGV4dGFyZWEuc3BhbjQsIC51bmVkaXRhYmxlLWlucHV0LnNwYW40e3dpZHRoOjI4NnB4O30NCmlucHV0LnNwYW4zLCB0ZXh0YXJlYS5zcGFuMywgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjN7d2lkdGg6MjA2cHg7fQ0KaW5wdXQuc3BhbjIsIHRleHRhcmVhLnNwYW4yLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDoxMjZweDt9DQppbnB1dC5zcGFuMSwgdGV4dGFyZWEuc3BhbjEsIC51bmVkaXRhYmxlLWlucHV0LnNwYW4xe3dpZHRoOjQ2cHg7fQ0KLmNvbnRyb2xzLXJvd3sqem9vbToxO30uY29udHJvbHMtcm93OmJlZm9yZSwuY29udHJvbHMtcm93OmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5jb250cm9scy1yb3c6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQouY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJde2Zsb2F0OmxlZnQ7fQ0KLmNvbnRyb2xzLXJvdyAuY2hlY2tib3hbY2xhc3MqPSJzcGFuIl0sLmNvbnRyb2xzLXJvdyAucmFkaW9bY2xhc3MqPSJzcGFuIl17cGFkZGluZy10b3A6NXB4O30NCmlucHV0W2Rpc2FibGVkXSxzZWxlY3RbZGlzYWJsZWRdLHRleHRhcmVhW2Rpc2FibGVkXSxpbnB1dFtyZWFkb25seV0sc2VsZWN0W3JlYWRvbmx5XSx0ZXh0YXJlYVtyZWFkb25seV17Y3Vyc29yOm5vdC1hbGxvd2VkO2JhY2tncm91bmQtY29sb3I6I2VlZWVlZTt9DQppbnB1dFt0eXBlPSJyYWRpbyJdW2Rpc2FibGVkXSxpbnB1dFt0eXBlPSJjaGVja2JveCJdW2Rpc2FibGVkXSxpbnB1dFt0eXBlPSJyYWRpbyJdW3JlYWRvbmx5XSxpbnB1dFt0eXBlPSJjaGVja2JveCJdW3JlYWRvbmx5XXtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O30NCi5jb250cm9sLWdyb3VwLndhcm5pbmc+bGFiZWwsLmNvbnRyb2wtZ3JvdXAud2FybmluZyAuaGVscC1ibG9jaywuY29udHJvbC1ncm91cC53YXJuaW5nIC5oZWxwLWlubGluZXtjb2xvcjojYzA5ODUzO30NCi5jb250cm9sLWdyb3VwLndhcm5pbmcgLmNoZWNrYm94LC5jb250cm9sLWdyb3VwLndhcm5pbmcgLnJhZGlvLC5jb250cm9sLWdyb3VwLndhcm5pbmcgaW5wdXQsLmNvbnRyb2wtZ3JvdXAud2FybmluZyBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAud2FybmluZyB0ZXh0YXJlYXtjb2xvcjojYzA5ODUzO30NCi5jb250cm9sLWdyb3VwLndhcm5pbmcgaW5wdXQsLmNvbnRyb2wtZ3JvdXAud2FybmluZyBzZWxlY3QsLmNvbnRyb2wtZ3JvdXAud2FybmluZyB0ZXh0YXJlYXtib3JkZXItY29sb3I6I2MwOTg1Mzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7fS5jb250cm9sLWdyb3VwLndhcm5pbmcgaW5wdXQ6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAud2FybmluZyBzZWxlY3Q6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAud2FybmluZyB0ZXh0YXJlYTpmb2N1c3tib3JkZXItY29sb3I6I2E0N2UzYzstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggI2RiYzU5ZTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggI2RiYzU5ZTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICNkYmM1OWU7fQ0KLmNvbnRyb2wtZ3JvdXAud2FybmluZyAuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5jb250cm9sLWdyb3VwLndhcm5pbmcgLmlucHV0LWFwcGVuZCAuYWRkLW9ue2NvbG9yOiNjMDk4NTM7YmFja2dyb3VuZC1jb2xvcjojZmNmOGUzO2JvcmRlci1jb2xvcjojYzA5ODUzO30NCi5jb250cm9sLWdyb3VwLmVycm9yPmxhYmVsLC5jb250cm9sLWdyb3VwLmVycm9yIC5oZWxwLWJsb2NrLC5jb250cm9sLWdyb3VwLmVycm9yIC5oZWxwLWlubGluZXtjb2xvcjojYjk0YTQ4O30NCi5jb250cm9sLWdyb3VwLmVycm9yIC5jaGVja2JveCwuY29udHJvbC1ncm91cC5lcnJvciAucmFkaW8sLmNvbnRyb2wtZ3JvdXAuZXJyb3IgaW5wdXQsLmNvbnRyb2wtZ3JvdXAuZXJyb3Igc2VsZWN0LC5jb250cm9sLWdyb3VwLmVycm9yIHRleHRhcmVhe2NvbG9yOiNiOTRhNDg7fQ0KLmNvbnRyb2wtZ3JvdXAuZXJyb3IgaW5wdXQsLmNvbnRyb2wtZ3JvdXAuZXJyb3Igc2VsZWN0LC5jb250cm9sLWdyb3VwLmVycm9yIHRleHRhcmVhe2JvcmRlci1jb2xvcjojYjk0YTQ4Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTt9LmNvbnRyb2wtZ3JvdXAuZXJyb3IgaW5wdXQ6Zm9jdXMsLmNvbnRyb2wtZ3JvdXAuZXJyb3Igc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLmVycm9yIHRleHRhcmVhOmZvY3Vze2JvcmRlci1jb2xvcjojOTUzYjM5Oy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjZDU5MzkyOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjZDU5MzkyO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpLDAgMCA2cHggI2Q1OTM5Mjt9DQouY29udHJvbC1ncm91cC5lcnJvciAuaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5jb250cm9sLWdyb3VwLmVycm9yIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojYjk0YTQ4O2JhY2tncm91bmQtY29sb3I6I2YyZGVkZTtib3JkZXItY29sb3I6I2I5NGE0ODt9DQouY29udHJvbC1ncm91cC5zdWNjZXNzPmxhYmVsLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmhlbHAtYmxvY2ssLmNvbnRyb2wtZ3JvdXAuc3VjY2VzcyAuaGVscC1pbmxpbmV7Y29sb3I6IzQ2ODg0Nzt9DQouY29udHJvbC1ncm91cC5zdWNjZXNzIC5jaGVja2JveCwuY29udHJvbC1ncm91cC5zdWNjZXNzIC5yYWRpbywuY29udHJvbC1ncm91cC5zdWNjZXNzIGlucHV0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3Mgc2VsZWN0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgdGV4dGFyZWF7Y29sb3I6IzQ2ODg0Nzt9DQouY29udHJvbC1ncm91cC5zdWNjZXNzIGlucHV0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3Mgc2VsZWN0LC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgdGV4dGFyZWF7Ym9yZGVyLWNvbG9yOiM0Njg4NDc7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO30uY29udHJvbC1ncm91cC5zdWNjZXNzIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3Mgc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgdGV4dGFyZWE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiMzNTY2MzU7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICM3YWJhN2I7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICM3YWJhN2I7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjN2FiYTdiO30NCi5jb250cm9sLWdyb3VwLnN1Y2Nlc3MgLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC5zdWNjZXNzIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojNDY4ODQ3O2JhY2tncm91bmQtY29sb3I6I2RmZjBkODtib3JkZXItY29sb3I6IzQ2ODg0Nzt9DQouY29udHJvbC1ncm91cC5pbmZvPmxhYmVsLC5jb250cm9sLWdyb3VwLmluZm8gLmhlbHAtYmxvY2ssLmNvbnRyb2wtZ3JvdXAuaW5mbyAuaGVscC1pbmxpbmV7Y29sb3I6IzNhODdhZDt9DQouY29udHJvbC1ncm91cC5pbmZvIC5jaGVja2JveCwuY29udHJvbC1ncm91cC5pbmZvIC5yYWRpbywuY29udHJvbC1ncm91cC5pbmZvIGlucHV0LC5jb250cm9sLWdyb3VwLmluZm8gc2VsZWN0LC5jb250cm9sLWdyb3VwLmluZm8gdGV4dGFyZWF7Y29sb3I6IzNhODdhZDt9DQouY29udHJvbC1ncm91cC5pbmZvIGlucHV0LC5jb250cm9sLWdyb3VwLmluZm8gc2VsZWN0LC5jb250cm9sLWdyb3VwLmluZm8gdGV4dGFyZWF7Ym9yZGVyLWNvbG9yOiMzYTg3YWQ7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMXB4IHJnYmEoMCwgMCwgMCwgMC4wNzUpO30uY29udHJvbC1ncm91cC5pbmZvIGlucHV0OmZvY3VzLC5jb250cm9sLWdyb3VwLmluZm8gc2VsZWN0OmZvY3VzLC5jb250cm9sLWdyb3VwLmluZm8gdGV4dGFyZWE6Zm9jdXN7Ym9yZGVyLWNvbG9yOiMyZDY5ODc7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICM3YWI1ZDM7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDc1KSwwIDAgNnB4ICM3YWI1ZDM7Ym94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA3NSksMCAwIDZweCAjN2FiNWQzO30NCi5jb250cm9sLWdyb3VwLmluZm8gLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuY29udHJvbC1ncm91cC5pbmZvIC5pbnB1dC1hcHBlbmQgLmFkZC1vbntjb2xvcjojM2E4N2FkO2JhY2tncm91bmQtY29sb3I6I2Q5ZWRmNztib3JkZXItY29sb3I6IzNhODdhZDt9DQppbnB1dDpmb2N1czpyZXF1aXJlZDppbnZhbGlkLHRleHRhcmVhOmZvY3VzOnJlcXVpcmVkOmludmFsaWQsc2VsZWN0OmZvY3VzOnJlcXVpcmVkOmludmFsaWR7Y29sb3I6I2I5NGE0ODtib3JkZXItY29sb3I6I2VlNWY1Yjt9aW5wdXQ6Zm9jdXM6cmVxdWlyZWQ6aW52YWxpZDpmb2N1cyx0ZXh0YXJlYTpmb2N1czpyZXF1aXJlZDppbnZhbGlkOmZvY3VzLHNlbGVjdDpmb2N1czpyZXF1aXJlZDppbnZhbGlkOmZvY3Vze2JvcmRlci1jb2xvcjojZTkzMjJkOy13ZWJraXQtYm94LXNoYWRvdzowIDAgNnB4ICNmOGI5Yjc7LW1vei1ib3gtc2hhZG93OjAgMCA2cHggI2Y4YjliNztib3gtc2hhZG93OjAgMCA2cHggI2Y4YjliNzt9DQouZm9ybS1hY3Rpb25ze3BhZGRpbmc6MTlweCAyMHB4IDIwcHg7bWFyZ2luLXRvcDoyMHB4O21hcmdpbi1ib3R0b206MjBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyLXRvcDoxcHggc29saWQgI2U1ZTVlNTsqem9vbToxO30uZm9ybS1hY3Rpb25zOmJlZm9yZSwuZm9ybS1hY3Rpb25zOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi5mb3JtLWFjdGlvbnM6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQouaGVscC1ibG9jaywuaGVscC1pbmxpbmV7Y29sb3I6IzU5NTk1OTt9DQouaGVscC1ibG9ja3tkaXNwbGF5OmJsb2NrO21hcmdpbi1ib3R0b206MTBweDt9DQouaGVscC1pbmxpbmV7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7dmVydGljYWwtYWxpZ246bWlkZGxlO3BhZGRpbmctbGVmdDo1cHg7fQ0KLmlucHV0LWFwcGVuZCwuaW5wdXQtcHJlcGVuZHttYXJnaW4tYm90dG9tOjVweDtmb250LXNpemU6MDt3aGl0ZS1zcGFjZTpub3dyYXA7fS5pbnB1dC1hcHBlbmQgaW5wdXQsLmlucHV0LXByZXBlbmQgaW5wdXQsLmlucHV0LWFwcGVuZCBzZWxlY3QsLmlucHV0LXByZXBlbmQgc2VsZWN0LC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXQsLmlucHV0LXByZXBlbmQgLnVuZWRpdGFibGUtaW5wdXQsLmlucHV0LWFwcGVuZCAuZHJvcGRvd24tbWVudSwuaW5wdXQtcHJlcGVuZCAuZHJvcGRvd24tbWVudXtmb250LXNpemU6MTRweDt9DQouaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1wcmVwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1wcmVwZW5kIHNlbGVjdCwuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0LC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0e3Bvc2l0aW9uOnJlbGF0aXZlO21hcmdpbi1ib3R0b206MDsqbWFyZ2luLWxlZnQ6MDt2ZXJ0aWNhbC1hbGlnbjp0b3A7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO30uaW5wdXQtYXBwZW5kIGlucHV0OmZvY3VzLC5pbnB1dC1wcmVwZW5kIGlucHV0OmZvY3VzLC5pbnB1dC1hcHBlbmQgc2VsZWN0OmZvY3VzLC5pbnB1dC1wcmVwZW5kIHNlbGVjdDpmb2N1cywuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0OmZvY3VzLC5pbnB1dC1wcmVwZW5kIC51bmVkaXRhYmxlLWlucHV0OmZvY3Vze3otaW5kZXg6Mjt9DQouaW5wdXQtYXBwZW5kIC5hZGQtb24sLmlucHV0LXByZXBlbmQgLmFkZC1vbntkaXNwbGF5OmlubGluZS1ibG9jazt3aWR0aDphdXRvO2hlaWdodDoyMHB4O21pbi13aWR0aDoxNnB4O3BhZGRpbmc6NHB4IDVweDtmb250LXNpemU6MTRweDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MjBweDt0ZXh0LWFsaWduOmNlbnRlcjt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojZWVlZWVlO2JvcmRlcjoxcHggc29saWQgI2NjYzt9DQouaW5wdXQtYXBwZW5kIC5hZGQtb24sLmlucHV0LXByZXBlbmQgLmFkZC1vbiwuaW5wdXQtYXBwZW5kIC5idG4sLmlucHV0LXByZXBlbmQgLmJ0bnt2ZXJ0aWNhbC1hbGlnbjp0b3A7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowO30NCi5pbnB1dC1hcHBlbmQgLmFjdGl2ZSwuaW5wdXQtcHJlcGVuZCAuYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2E5ZGJhOTtib3JkZXItY29sb3I6IzQ2YTU0Njt9DQouaW5wdXQtcHJlcGVuZCAuYWRkLW9uLC5pbnB1dC1wcmVwZW5kIC5idG57bWFyZ2luLXJpZ2h0Oi0xcHg7fQ0KLmlucHV0LXByZXBlbmQgLmFkZC1vbjpmaXJzdC1jaGlsZCwuaW5wdXQtcHJlcGVuZCAuYnRuOmZpcnN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweDt9DQouaW5wdXQtYXBwZW5kIGlucHV0LC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1hcHBlbmQgLnVuZWRpdGFibGUtaW5wdXR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDtib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4O30uaW5wdXQtYXBwZW5kIGlucHV0Ky5idG4tZ3JvdXAgLmJ0biwuaW5wdXQtYXBwZW5kIHNlbGVjdCsuYnRuLWdyb3VwIC5idG4sLmlucHV0LWFwcGVuZCAudW5lZGl0YWJsZS1pbnB1dCsuYnRuLWdyb3VwIC5idG57LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO30NCi5pbnB1dC1hcHBlbmQgLmFkZC1vbiwuaW5wdXQtYXBwZW5kIC5idG4sLmlucHV0LWFwcGVuZCAuYnRuLWdyb3Vwe21hcmdpbi1sZWZ0Oi0xcHg7fQ0KLmlucHV0LWFwcGVuZCAuYWRkLW9uOmxhc3QtY2hpbGQsLmlucHV0LWFwcGVuZCAuYnRuOmxhc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDtib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO30NCi5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCBpbnB1dCwuaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgc2VsZWN0LC5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAudW5lZGl0YWJsZS1pbnB1dHstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjA7fS5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCBpbnB1dCsuYnRuLWdyb3VwIC5idG4sLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIHNlbGVjdCsuYnRuLWdyb3VwIC5idG4sLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC51bmVkaXRhYmxlLWlucHV0Ky5idG4tZ3JvdXAgLmJ0bnstd2Via2l0LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgNHB4IDRweCAwO2JvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7fQ0KLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5hZGQtb246Zmlyc3QtY2hpbGQsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5idG46Zmlyc3QtY2hpbGR7bWFyZ2luLXJpZ2h0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDtib3JkZXItcmFkaXVzOjRweCAwIDAgNHB4O30NCi5pbnB1dC1wcmVwZW5kLmlucHV0LWFwcGVuZCAuYWRkLW9uOmxhc3QtY2hpbGQsLmlucHV0LXByZXBlbmQuaW5wdXQtYXBwZW5kIC5idG46bGFzdC1jaGlsZHttYXJnaW4tbGVmdDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMDt9DQouaW5wdXQtcHJlcGVuZC5pbnB1dC1hcHBlbmQgLmJ0bi1ncm91cDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowO30NCmlucHV0LnNlYXJjaC1xdWVyeXtwYWRkaW5nLXJpZ2h0OjE0cHg7cGFkZGluZy1yaWdodDo0cHggXDk7cGFkZGluZy1sZWZ0OjE0cHg7cGFkZGluZy1sZWZ0OjRweCBcOTttYXJnaW4tYm90dG9tOjA7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjE1cHg7LW1vei1ib3JkZXItcmFkaXVzOjE1cHg7Ym9yZGVyLXJhZGl1czoxNXB4O30NCi5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kIC5zZWFyY2gtcXVlcnksLmZvcm0tc2VhcmNoIC5pbnB1dC1wcmVwZW5kIC5zZWFyY2gtcXVlcnl7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowO30NCi5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kIC5zZWFyY2gtcXVlcnl7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7LW1vei1ib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7Ym9yZGVyLXJhZGl1czoxNHB4IDAgMCAxNHB4O30NCi5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kIC5idG57LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7LW1vei1ib3JkZXItcmFkaXVzOjAgMTRweCAxNHB4IDA7Ym9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwO30NCi5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCAuc2VhcmNoLXF1ZXJ5ey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwOy1tb3otYm9yZGVyLXJhZGl1czowIDE0cHggMTRweCAwO2JvcmRlci1yYWRpdXM6MCAxNHB4IDE0cHggMDt9DQouZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQgLmJ0bnstd2Via2l0LWJvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDstbW96LWJvcmRlci1yYWRpdXM6MTRweCAwIDAgMTRweDtib3JkZXItcmFkaXVzOjE0cHggMCAwIDE0cHg7fQ0KLmZvcm0tc2VhcmNoIGlucHV0LC5mb3JtLWlubGluZSBpbnB1dCwuZm9ybS1ob3Jpem9udGFsIGlucHV0LC5mb3JtLXNlYXJjaCB0ZXh0YXJlYSwuZm9ybS1pbmxpbmUgdGV4dGFyZWEsLmZvcm0taG9yaXpvbnRhbCB0ZXh0YXJlYSwuZm9ybS1zZWFyY2ggc2VsZWN0LC5mb3JtLWlubGluZSBzZWxlY3QsLmZvcm0taG9yaXpvbnRhbCBzZWxlY3QsLmZvcm0tc2VhcmNoIC5oZWxwLWlubGluZSwuZm9ybS1pbmxpbmUgLmhlbHAtaW5saW5lLC5mb3JtLWhvcml6b250YWwgLmhlbHAtaW5saW5lLC5mb3JtLXNlYXJjaCAudW5lZGl0YWJsZS1pbnB1dCwuZm9ybS1pbmxpbmUgLnVuZWRpdGFibGUtaW5wdXQsLmZvcm0taG9yaXpvbnRhbCAudW5lZGl0YWJsZS1pbnB1dCwuZm9ybS1zZWFyY2ggLmlucHV0LXByZXBlbmQsLmZvcm0taW5saW5lIC5pbnB1dC1wcmVwZW5kLC5mb3JtLWhvcml6b250YWwgLmlucHV0LXByZXBlbmQsLmZvcm0tc2VhcmNoIC5pbnB1dC1hcHBlbmQsLmZvcm0taW5saW5lIC5pbnB1dC1hcHBlbmQsLmZvcm0taG9yaXpvbnRhbCAuaW5wdXQtYXBwZW5ke2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxO21hcmdpbi1ib3R0b206MDt2ZXJ0aWNhbC1hbGlnbjptaWRkbGU7fQ0KLmZvcm0tc2VhcmNoIC5oaWRlLC5mb3JtLWlubGluZSAuaGlkZSwuZm9ybS1ob3Jpem9udGFsIC5oaWRle2Rpc3BsYXk6bm9uZTt9DQouZm9ybS1zZWFyY2ggbGFiZWwsLmZvcm0taW5saW5lIGxhYmVsLC5mb3JtLXNlYXJjaCAuYnRuLWdyb3VwLC5mb3JtLWlubGluZSAuYnRuLWdyb3Vwe2Rpc3BsYXk6aW5saW5lLWJsb2NrO30NCi5mb3JtLXNlYXJjaCAuaW5wdXQtYXBwZW5kLC5mb3JtLWlubGluZSAuaW5wdXQtYXBwZW5kLC5mb3JtLXNlYXJjaCAuaW5wdXQtcHJlcGVuZCwuZm9ybS1pbmxpbmUgLmlucHV0LXByZXBlbmR7bWFyZ2luLWJvdHRvbTowO30NCi5mb3JtLXNlYXJjaCAucmFkaW8sLmZvcm0tc2VhcmNoIC5jaGVja2JveCwuZm9ybS1pbmxpbmUgLnJhZGlvLC5mb3JtLWlubGluZSAuY2hlY2tib3h7cGFkZGluZy1sZWZ0OjA7bWFyZ2luLWJvdHRvbTowO3ZlcnRpY2FsLWFsaWduOm1pZGRsZTt9DQouZm9ybS1zZWFyY2ggLnJhZGlvIGlucHV0W3R5cGU9InJhZGlvIl0sLmZvcm0tc2VhcmNoIC5jaGVja2JveCBpbnB1dFt0eXBlPSJjaGVja2JveCJdLC5mb3JtLWlubGluZSAucmFkaW8gaW5wdXRbdHlwZT0icmFkaW8iXSwuZm9ybS1pbmxpbmUgLmNoZWNrYm94IGlucHV0W3R5cGU9ImNoZWNrYm94Il17ZmxvYXQ6bGVmdDttYXJnaW4tcmlnaHQ6M3B4O21hcmdpbi1sZWZ0OjA7fQ0KLmNvbnRyb2wtZ3JvdXB7bWFyZ2luLWJvdHRvbToxMHB4O30NCmxlZ2VuZCsuY29udHJvbC1ncm91cHttYXJnaW4tdG9wOjIwcHg7LXdlYmtpdC1tYXJnaW4tdG9wLWNvbGxhcHNlOnNlcGFyYXRlO30NCi5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtZ3JvdXB7bWFyZ2luLWJvdHRvbToyMHB4Oyp6b29tOjE7fS5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtZ3JvdXA6YmVmb3JlLC5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtZ3JvdXA6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1ncm91cDphZnRlcntjbGVhcjpib3RoO30NCi5mb3JtLWhvcml6b250YWwgLmNvbnRyb2wtbGFiZWx7ZmxvYXQ6bGVmdDt3aWR0aDoxNjBweDtwYWRkaW5nLXRvcDo1cHg7dGV4dC1hbGlnbjpyaWdodDt9DQouZm9ybS1ob3Jpem9udGFsIC5jb250cm9sc3sqZGlzcGxheTppbmxpbmUtYmxvY2s7KnBhZGRpbmctbGVmdDoyMHB4O21hcmdpbi1sZWZ0OjE4MHB4OyptYXJnaW4tbGVmdDowO30uZm9ybS1ob3Jpem9udGFsIC5jb250cm9sczpmaXJzdC1jaGlsZHsqcGFkZGluZy1sZWZ0OjE4MHB4O30NCi5mb3JtLWhvcml6b250YWwgLmhlbHAtYmxvY2t7bWFyZ2luLWJvdHRvbTowO30NCi5mb3JtLWhvcml6b250YWwgaW5wdXQrLmhlbHAtYmxvY2ssLmZvcm0taG9yaXpvbnRhbCBzZWxlY3QrLmhlbHAtYmxvY2ssLmZvcm0taG9yaXpvbnRhbCB0ZXh0YXJlYSsuaGVscC1ibG9ja3ttYXJnaW4tdG9wOjEwcHg7fQ0KLmZvcm0taG9yaXpvbnRhbCAuZm9ybS1hY3Rpb25ze3BhZGRpbmctbGVmdDoxODBweDt9DQouYnRue2Rpc3BsYXk6aW5saW5lLWJsb2NrOypkaXNwbGF5OmlubGluZTsqem9vbToxO3BhZGRpbmc6NHB4IDEycHg7bWFyZ2luLWJvdHRvbTowO2ZvbnQtc2l6ZToxNHB4O2xpbmUtaGVpZ2h0OjIwcHg7KmxpbmUtaGVpZ2h0OjIwcHg7dGV4dC1hbGlnbjpjZW50ZXI7dmVydGljYWwtYWxpZ246bWlkZGxlO2N1cnNvcjpwb2ludGVyO2NvbG9yOiMzMzMzMzM7dGV4dC1zaGFkb3c6MCAxcHggMXB4IHJnYmEoMjU1LCAyNTUsIDI1NSwgMC43NSk7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZmZmZmZmLCAjZTZlNmU2KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZmZmZmZmKSwgdG8oI2U2ZTZlNikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZmZmZmZmLCAjZTZlNmU2KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNmZmZmZmYsICNlNmU2ZTYpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2ZmZmZmZiwgI2U2ZTZlNik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZmZmZmZmYnLCBlbmRDb2xvcnN0cj0nI2ZmZTZlNmU2JywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojZTZlNmU2ICNlNmU2ZTYgI2JmYmZiZjtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiNlNmU2ZTY7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO2JvcmRlcjoxcHggc29saWQgI2JiYmJiYjsqYm9yZGVyOjA7Ym9yZGVyLWJvdHRvbS1jb2xvcjojYTJhMmEyOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDsqbWFyZ2luLWxlZnQ6LjNlbTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4yKSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4yKSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMiksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7fS5idG46aG92ZXIsLmJ0bjphY3RpdmUsLmJ0bi5hY3RpdmUsLmJ0bi5kaXNhYmxlZCwuYnRuW2Rpc2FibGVkXXtjb2xvcjojMzMzMzMzO2JhY2tncm91bmQtY29sb3I6I2U2ZTZlNjsqYmFja2dyb3VuZC1jb2xvcjojZDlkOWQ5O30NCi5idG46YWN0aXZlLC5idG4uYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2NjY2NjYyBcOTt9DQouYnRuOmZpcnN0LWNoaWxkeyptYXJnaW4tbGVmdDowO30NCi5idG46aG92ZXJ7Y29sb3I6IzMzMzMzMzt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNlNmU2ZTY7KmJhY2tncm91bmQtY29sb3I6I2Q5ZDlkOTtiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgLTE1cHg7LXdlYmtpdC10cmFuc2l0aW9uOmJhY2tncm91bmQtcG9zaXRpb24gMC4xcyBsaW5lYXI7LW1vei10cmFuc2l0aW9uOmJhY2tncm91bmQtcG9zaXRpb24gMC4xcyBsaW5lYXI7LW8tdHJhbnNpdGlvbjpiYWNrZ3JvdW5kLXBvc2l0aW9uIDAuMXMgbGluZWFyO3RyYW5zaXRpb246YmFja2dyb3VuZC1wb3NpdGlvbiAwLjFzIGxpbmVhcjt9DQouYnRuOmZvY3Vze291dGxpbmU6dGhpbiBkb3R0ZWQgIzMzMztvdXRsaW5lOjVweCBhdXRvIC13ZWJraXQtZm9jdXMtcmluZy1jb2xvcjtvdXRsaW5lLW9mZnNldDotMnB4O30NCi5idG4uYWN0aXZlLC5idG46YWN0aXZle2JhY2tncm91bmQtY29sb3I6I2U2ZTZlNjtiYWNrZ3JvdW5kLWNvbG9yOiNkOWQ5ZDkgXDk7YmFja2dyb3VuZC1pbWFnZTpub25lO291dGxpbmU6MDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsLjE1KSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsLjE1KSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTtib3gtc2hhZG93Omluc2V0IDAgMnB4IDRweCByZ2JhKDAsMCwwLC4xNSksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7fQ0KLmJ0bi5kaXNhYmxlZCwuYnRuW2Rpc2FibGVkXXtjdXJzb3I6ZGVmYXVsdDtiYWNrZ3JvdW5kLWNvbG9yOiNlNmU2ZTY7YmFja2dyb3VuZC1pbWFnZTpub25lO29wYWNpdHk6MC42NTtmaWx0ZXI6YWxwaGEob3BhY2l0eT02NSk7LXdlYmtpdC1ib3gtc2hhZG93Om5vbmU7LW1vei1ib3gtc2hhZG93Om5vbmU7Ym94LXNoYWRvdzpub25lO30NCi5idG4tbGFyZ2V7cGFkZGluZzoxMXB4IDE5cHg7Zm9udC1zaXplOjE3LjVweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7fQ0KLmJ0bi1sYXJnZSBbY2xhc3NePSJpY29uLSJdLC5idG4tbGFyZ2UgW2NsYXNzKj0iIGljb24tIl17bWFyZ2luLXRvcDoycHg7fQ0KLmJ0bi1zbWFsbHtwYWRkaW5nOjJweCAxMHB4O2ZvbnQtc2l6ZToxMS45cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4O30NCi5idG4tc21hbGwgW2NsYXNzXj0iaWNvbi0iXSwuYnRuLXNtYWxsIFtjbGFzcyo9IiBpY29uLSJde21hcmdpbi10b3A6MDt9DQouYnRuLW1pbml7cGFkZGluZzoxcHggNnB4O2ZvbnQtc2l6ZToxMC41cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4O30NCi5idG4tYmxvY2t7ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO3BhZGRpbmctbGVmdDowO3BhZGRpbmctcmlnaHQ6MDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3g7fQ0KLmJ0bi1ibG9jaysuYnRuLWJsb2Nre21hcmdpbi10b3A6NXB4O30NCmlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi1ibG9jayxpbnB1dFt0eXBlPSJyZXNldCJdLmJ0bi1ibG9jayxpbnB1dFt0eXBlPSJidXR0b24iXS5idG4tYmxvY2t7d2lkdGg6MTAwJTt9DQouYnRuLXByaW1hcnkuYWN0aXZlLC5idG4td2FybmluZy5hY3RpdmUsLmJ0bi1kYW5nZXIuYWN0aXZlLC5idG4tc3VjY2Vzcy5hY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZSwuYnRuLWludmVyc2UuYWN0aXZle2NvbG9yOnJnYmEoMjU1LCAyNTUsIDI1NSwgMC43NSk7fQ0KLmJ0bntib3JkZXItY29sb3I6I2M1YzVjNTtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjE1KSByZ2JhKDAsIDAsIDAsIDAuMTUpIHJnYmEoMCwgMCwgMCwgMC4yNSk7fQ0KLmJ0bi1wcmltYXJ5e2NvbG9yOiNmZmZmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMwMDZkY2M7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICMwMDg4Y2MsICMwMDQ0Y2MpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCMwMDg4Y2MpLCB0bygjMDA0NGNjKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICMwMDg4Y2MsICMwMDQ0Y2MpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNDRjYyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjMDA4OGNjLCAjMDA0NGNjKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjAwODhjYycsIGVuZENvbG9yc3RyPScjZmYwMDQ0Y2MnLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyLWNvbG9yOiMwMDQ0Y2MgIzAwNDRjYyAjMDAyYTgwO2JvcmRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4yNSk7KmJhY2tncm91bmQtY29sb3I6IzAwNDRjYztmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQgPSBmYWxzZSk7fS5idG4tcHJpbWFyeTpob3ZlciwuYnRuLXByaW1hcnk6YWN0aXZlLC5idG4tcHJpbWFyeS5hY3RpdmUsLmJ0bi1wcmltYXJ5LmRpc2FibGVkLC5idG4tcHJpbWFyeVtkaXNhYmxlZF17Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMwMDQ0Y2M7KmJhY2tncm91bmQtY29sb3I6IzAwM2JiMzt9DQouYnRuLXByaW1hcnk6YWN0aXZlLC5idG4tcHJpbWFyeS5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojMDAzMzk5IFw5O30NCi5idG4td2FybmluZ3tjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojZmFhNzMyO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZmJiNDUwLCAjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZmJiNDUwKSwgdG8oI2Y4OTQwNikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZmJiNDUwLCAjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNmYmI0NTAsICNmODk0MDYpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2ZiYjQ1MCwgI2Y4OTQwNik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZmYmI0NTAnLCBlbmRDb2xvcnN0cj0nI2ZmZjg5NDA2JywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojZjg5NDA2ICNmODk0MDYgI2FkNjcwNDtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDY7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO30uYnRuLXdhcm5pbmc6aG92ZXIsLmJ0bi13YXJuaW5nOmFjdGl2ZSwuYnRuLXdhcm5pbmcuYWN0aXZlLC5idG4td2FybmluZy5kaXNhYmxlZCwuYnRuLXdhcm5pbmdbZGlzYWJsZWRde2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojZjg5NDA2OypiYWNrZ3JvdW5kLWNvbG9yOiNkZjg1MDU7fQ0KLmJ0bi13YXJuaW5nOmFjdGl2ZSwuYnRuLXdhcm5pbmcuYWN0aXZle2JhY2tncm91bmQtY29sb3I6I2M2NzYwNSBcOTt9DQouYnRuLWRhbmdlcntjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojZGE0ZjQ5O2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZWU1ZjViLCAjYmQzNjJmKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZWU1ZjViKSwgdG8oI2JkMzYyZikpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZWU1ZjViLCAjYmQzNjJmKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNlZTVmNWIsICNiZDM2MmYpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2VlNWY1YiwgI2JkMzYyZik7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZlZTVmNWInLCBlbmRDb2xvcnN0cj0nI2ZmYmQzNjJmJywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojYmQzNjJmICNiZDM2MmYgIzgwMjQyMDtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiNiZDM2MmY7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO30uYnRuLWRhbmdlcjpob3ZlciwuYnRuLWRhbmdlcjphY3RpdmUsLmJ0bi1kYW5nZXIuYWN0aXZlLC5idG4tZGFuZ2VyLmRpc2FibGVkLC5idG4tZGFuZ2VyW2Rpc2FibGVkXXtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6I2JkMzYyZjsqYmFja2dyb3VuZC1jb2xvcjojYTkzMDJhO30NCi5idG4tZGFuZ2VyOmFjdGl2ZSwuYnRuLWRhbmdlci5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojOTQyYTI1IFw5O30NCi5idG4tc3VjY2Vzc3tjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojNWJiNzViO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjNjJjNDYyLCAjNTFhMzUxKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjNjJjNDYyKSwgdG8oIzUxYTM1MSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjNjJjNDYyLCAjNTFhMzUxKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICM2MmM0NjIsICM1MWEzNTEpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgIzYyYzQ2MiwgIzUxYTM1MSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmY2MmM0NjInLCBlbmRDb2xvcnN0cj0nI2ZmNTFhMzUxJywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojNTFhMzUxICM1MWEzNTEgIzM4NzAzODtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiM1MWEzNTE7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO30uYnRuLXN1Y2Nlc3M6aG92ZXIsLmJ0bi1zdWNjZXNzOmFjdGl2ZSwuYnRuLXN1Y2Nlc3MuYWN0aXZlLC5idG4tc3VjY2Vzcy5kaXNhYmxlZCwuYnRuLXN1Y2Nlc3NbZGlzYWJsZWRde2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojNTFhMzUxOypiYWNrZ3JvdW5kLWNvbG9yOiM0OTkyNDk7fQ0KLmJ0bi1zdWNjZXNzOmFjdGl2ZSwuYnRuLXN1Y2Nlc3MuYWN0aXZle2JhY2tncm91bmQtY29sb3I6IzQwODE0MCBcOTt9DQouYnRuLWluZm97Y29sb3I6I2ZmZmZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO2JhY2tncm91bmQtY29sb3I6IzQ5YWZjZDtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzViYzBkZSwgIzJmOTZiNCk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzViYzBkZSksIHRvKCMyZjk2YjQpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzViYzBkZSwgIzJmOTZiNCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjNWJjMGRlLCAjMmY5NmI0KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICM1YmMwZGUsICMyZjk2YjQpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNWJjMGRlJywgZW5kQ29sb3JzdHI9JyNmZjJmOTZiNCcsIEdyYWRpZW50VHlwZT0wKTtib3JkZXItY29sb3I6IzJmOTZiNCAjMmY5NmI0ICMxZjYzNzc7Ym9yZGVyLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjI1KTsqYmFja2dyb3VuZC1jb2xvcjojMmY5NmI0O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoZW5hYmxlZCA9IGZhbHNlKTt9LmJ0bi1pbmZvOmhvdmVyLC5idG4taW5mbzphY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZSwuYnRuLWluZm8uZGlzYWJsZWQsLmJ0bi1pbmZvW2Rpc2FibGVkXXtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6IzJmOTZiNDsqYmFja2dyb3VuZC1jb2xvcjojMmE4NWEwO30NCi5idG4taW5mbzphY3RpdmUsLmJ0bi1pbmZvLmFjdGl2ZXtiYWNrZ3JvdW5kLWNvbG9yOiMyNDc0OGMgXDk7fQ0KLmJ0bi1pbnZlcnNle2NvbG9yOiNmZmZmZmY7dGV4dC1zaGFkb3c6MCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTtiYWNrZ3JvdW5kLWNvbG9yOiMzNjM2MzY7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICM0NDQ0NDQsICMyMjIyMjIpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCM0NDQ0NDQpLCB0bygjMjIyMjIyKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICM0NDQ0NDQsICMyMjIyMjIpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgIzQ0NDQ0NCwgIzIyMjIyMik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjNDQ0NDQ0LCAjMjIyMjIyKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZjQ0NDQ0NCcsIGVuZENvbG9yc3RyPScjZmYyMjIyMjInLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyLWNvbG9yOiMyMjIyMjIgIzIyMjIyMiAjMDAwMDAwO2JvcmRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMSkgcmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4yNSk7KmJhY2tncm91bmQtY29sb3I6IzIyMjIyMjtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KGVuYWJsZWQgPSBmYWxzZSk7fS5idG4taW52ZXJzZTpob3ZlciwuYnRuLWludmVyc2U6YWN0aXZlLC5idG4taW52ZXJzZS5hY3RpdmUsLmJ0bi1pbnZlcnNlLmRpc2FibGVkLC5idG4taW52ZXJzZVtkaXNhYmxlZF17Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiMyMjIyMjI7KmJhY2tncm91bmQtY29sb3I6IzE1MTUxNTt9DQouYnRuLWludmVyc2U6YWN0aXZlLC5idG4taW52ZXJzZS5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojMDgwODA4IFw5O30NCmJ1dHRvbi5idG4saW5wdXRbdHlwZT0ic3VibWl0Il0uYnRueypwYWRkaW5nLXRvcDozcHg7KnBhZGRpbmctYm90dG9tOjNweDt9YnV0dG9uLmJ0bjo6LW1vei1mb2N1cy1pbm5lcixpbnB1dFt0eXBlPSJzdWJtaXQiXS5idG46Oi1tb3otZm9jdXMtaW5uZXJ7cGFkZGluZzowO2JvcmRlcjowO30NCmJ1dHRvbi5idG4uYnRuLWxhcmdlLGlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi5idG4tbGFyZ2V7KnBhZGRpbmctdG9wOjdweDsqcGFkZGluZy1ib3R0b206N3B4O30NCmJ1dHRvbi5idG4uYnRuLXNtYWxsLGlucHV0W3R5cGU9InN1Ym1pdCJdLmJ0bi5idG4tc21hbGx7KnBhZGRpbmctdG9wOjNweDsqcGFkZGluZy1ib3R0b206M3B4O30NCmJ1dHRvbi5idG4uYnRuLW1pbmksaW5wdXRbdHlwZT0ic3VibWl0Il0uYnRuLmJ0bi1taW5peypwYWRkaW5nLXRvcDoxcHg7KnBhZGRpbmctYm90dG9tOjFweDt9DQouYnRuLWxpbmssLmJ0bi1saW5rOmFjdGl2ZSwuYnRuLWxpbmtbZGlzYWJsZWRde2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7YmFja2dyb3VuZC1pbWFnZTpub25lOy13ZWJraXQtYm94LXNoYWRvdzpub25lOy1tb3otYm94LXNoYWRvdzpub25lO2JveC1zaGFkb3c6bm9uZTt9DQouYnRuLWxpbmt7Ym9yZGVyLWNvbG9yOnRyYW5zcGFyZW50O2N1cnNvcjpwb2ludGVyO2NvbG9yOiMwMDg4Y2M7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjA7LW1vei1ib3JkZXItcmFkaXVzOjA7Ym9yZGVyLXJhZGl1czowO30NCi5idG4tbGluazpob3Zlcntjb2xvcjojMDA1NTgwO3RleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmU7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDt9DQouYnRuLWxpbmtbZGlzYWJsZWRdOmhvdmVye2NvbG9yOiMzMzMzMzM7dGV4dC1kZWNvcmF0aW9uOm5vbmU7fQ0KW2NsYXNzXj0iaWNvbi0iXSxbY2xhc3MqPSIgaWNvbi0iXXtkaXNwbGF5OmlubGluZS1ibG9jazt3aWR0aDoxNHB4O2hlaWdodDoxNHB4OyptYXJnaW4tcmlnaHQ6LjNlbTtsaW5lLWhlaWdodDoxNHB4O3ZlcnRpY2FsLWFsaWduOnRleHQtdG9wO2JhY2tncm91bmQtaW1hZ2U6dXJsKCIuLi9pbWcvZ2x5cGhpY29ucy1oYWxmbGluZ3MucG5nIik7YmFja2dyb3VuZC1wb3NpdGlvbjoxNHB4IDE0cHg7YmFja2dyb3VuZC1yZXBlYXQ6bm8tcmVwZWF0O21hcmdpbi10b3A6MXB4O30NCi5pY29uLXdoaXRlLC5uYXYtcGlsbHM+LmFjdGl2ZT5hPltjbGFzc149Imljb24tIl0sLm5hdi1waWxscz4uYWN0aXZlPmE+W2NsYXNzKj0iIGljb24tIl0sLm5hdi1saXN0Pi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5uYXYtbGlzdD4uYWN0aXZlPmE+W2NsYXNzKj0iIGljb24tIl0sLm5hdmJhci1pbnZlcnNlIC5uYXY+LmFjdGl2ZT5hPltjbGFzc149Imljb24tIl0sLm5hdmJhci1pbnZlcnNlIC5uYXY+LmFjdGl2ZT5hPltjbGFzcyo9IiBpY29uLSJdLC5kcm9wZG93bi1tZW51PmxpPmE6aG92ZXI+W2NsYXNzXj0iaWNvbi0iXSwuZHJvcGRvd24tbWVudT5saT5hOmhvdmVyPltjbGFzcyo9IiBpY29uLSJdLC5kcm9wZG93bi1tZW51Pi5hY3RpdmU+YT5bY2xhc3NePSJpY29uLSJdLC5kcm9wZG93bi1tZW51Pi5hY3RpdmU+YT5bY2xhc3MqPSIgaWNvbi0iXSwuZHJvcGRvd24tc3VibWVudTpob3Zlcj5hPltjbGFzc149Imljb24tIl0sLmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YT5bY2xhc3MqPSIgaWNvbi0iXXtiYWNrZ3JvdW5kLWltYWdlOnVybCgiLi4vaW1nL2dseXBoaWNvbnMtaGFsZmxpbmdzLXdoaXRlLnBuZyIpO30NCi5pY29uLWdsYXNze2JhY2tncm91bmQtcG9zaXRpb246MCAwO30NCi5pY29uLW11c2lje2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggMDt9DQouaWNvbi1zZWFyY2h7YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAwO30NCi5pY29uLWVudmVsb3Ble2JhY2tncm91bmQtcG9zaXRpb246LTcycHggMDt9DQouaWNvbi1oZWFydHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IDA7fQ0KLmljb24tc3RhcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAwO30NCi5pY29uLXN0YXItZW1wdHl7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggMDt9DQouaWNvbi11c2Vye2JhY2tncm91bmQtcG9zaXRpb246LTE2OHB4IDA7fQ0KLmljb24tZmlsbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAwO30NCi5pY29uLXRoLWxhcmdle2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IDA7fQ0KLmljb24tdGh7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggMDt9DQouaWNvbi10aC1saXN0e2JhY2tncm91bmQtcG9zaXRpb246LTI2NHB4IDA7fQ0KLmljb24tb2t7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggMDt9DQouaWNvbi1yZW1vdmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMzEycHggMDt9DQouaWNvbi16b29tLWlue2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IDA7fQ0KLmljb24tem9vbS1vdXR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzYwcHggMDt9DQouaWNvbi1vZmZ7YmFja2dyb3VuZC1wb3NpdGlvbjotMzg0cHggMDt9DQouaWNvbi1zaWduYWx7YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggMDt9DQouaWNvbi1jb2d7YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggMDt9DQouaWNvbi10cmFzaHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAwO30NCi5pY29uLWhvbWV7YmFja2dyb3VuZC1wb3NpdGlvbjowIC0yNHB4O30NCi5pY29uLWZpbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtMjRweDt9DQouaWNvbi10aW1le2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggLTI0cHg7fQ0KLmljb24tcm9hZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IC0yNHB4O30NCi5pY29uLWRvd25sb2FkLWFsdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC0yNHB4O30NCi5pY29uLWRvd25sb2Fke2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC0yNHB4O30NCi5pY29uLXVwbG9hZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNDRweCAtMjRweDt9DQouaWNvbi1pbmJveHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAtMjRweDt9DQouaWNvbi1wbGF5LWNpcmNsZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMjRweDt9DQouaWNvbi1yZXBlYXR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTI0cHg7fQ0KLmljb24tcmVmcmVzaHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNDBweCAtMjRweDt9DQouaWNvbi1saXN0LWFsdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtMjRweDt9DQouaWNvbi1sb2Nre2JhY2tncm91bmQtcG9zaXRpb246LTI4N3B4IC0yNHB4O30NCi5pY29uLWZsYWd7YmFja2dyb3VuZC1wb3NpdGlvbjotMzEycHggLTI0cHg7fQ0KLmljb24taGVhZHBob25lc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtMjRweDt9DQouaWNvbi12b2x1bWUtb2Zme2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0yNHB4O30NCi5pY29uLXZvbHVtZS1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTM4NHB4IC0yNHB4O30NCi5pY29uLXZvbHVtZS11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtMjRweDt9DQouaWNvbi1xcmNvZGV7YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTI0cHg7fQ0KLmljb24tYmFyY29kZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtMjRweDt9DQouaWNvbi10YWd7YmFja2dyb3VuZC1wb3NpdGlvbjowIC00OHB4O30NCi5pY29uLXRhZ3N7YmFja2dyb3VuZC1wb3NpdGlvbjotMjVweCAtNDhweDt9DQouaWNvbi1ib29re2JhY2tncm91bmQtcG9zaXRpb246LTQ4cHggLTQ4cHg7fQ0KLmljb24tYm9va21hcmt7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtNDhweDt9DQouaWNvbi1wcmludHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC00OHB4O30NCi5pY29uLWNhbWVyYXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xMjBweCAtNDhweDt9DQouaWNvbi1mb250e2JhY2tncm91bmQtcG9zaXRpb246LTE0NHB4IC00OHB4O30NCi5pY29uLWJvbGR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY3cHggLTQ4cHg7fQ0KLmljb24taXRhbGlje2JhY2tncm91bmQtcG9zaXRpb246LTE5MnB4IC00OHB4O30NCi5pY29uLXRleHQtaGVpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC00OHB4O30NCi5pY29uLXRleHQtd2lkdGh7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTQ4cHg7fQ0KLmljb24tYWxpZ24tbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtNDhweDt9DQouaWNvbi1hbGlnbi1jZW50ZXJ7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTQ4cHg7fQ0KLmljb24tYWxpZ24tcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzEycHggLTQ4cHg7fQ0KLmljb24tYWxpZ24tanVzdGlmeXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtNDhweDt9DQouaWNvbi1saXN0e2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC00OHB4O30NCi5pY29uLWluZGVudC1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTM4NHB4IC00OHB4O30NCi5pY29uLWluZGVudC1yaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtNDhweDt9DQouaWNvbi1mYWNldGltZS12aWRlb3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MzJweCAtNDhweDt9DQouaWNvbi1waWN0dXJle2JhY2tncm91bmQtcG9zaXRpb246LTQ1NnB4IC00OHB4O30NCi5pY29uLXBlbmNpbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgLTcycHg7fQ0KLmljb24tbWFwLW1hcmtlcntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNHB4IC03MnB4O30NCi5pY29uLWFkanVzdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC03MnB4O30NCi5pY29uLXRpbnR7YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtNzJweDt9DQouaWNvbi1lZGl0e2JhY2tncm91bmQtcG9zaXRpb246LTk2cHggLTcycHg7fQ0KLmljb24tc2hhcmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTcycHg7fQ0KLmljb24tY2hlY2t7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTcycHg7fQ0KLmljb24tbW92ZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAtNzJweDt9DQouaWNvbi1zdGVwLWJhY2t3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTE5MnB4IC03MnB4O30NCi5pY29uLWZhc3QtYmFja3dhcmR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTcycHg7fQ0KLmljb24tYmFja3dhcmR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTcycHg7fQ0KLmljb24tcGxheXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNjRweCAtNzJweDt9DQouaWNvbi1wYXVzZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yODhweCAtNzJweDt9DQouaWNvbi1zdG9we2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC03MnB4O30NCi5pY29uLWZvcndhcmR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTcycHg7fQ0KLmljb24tZmFzdC1mb3J3YXJke2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC03MnB4O30NCi5pY29uLXN0ZXAtZm9yd2FyZHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtNzJweDt9DQouaWNvbi1lamVjdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00MDhweCAtNzJweDt9DQouaWNvbi1jaGV2cm9uLWxlZnR7YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTcycHg7fQ0KLmljb24tY2hldnJvbi1yaWdodHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtNzJweDt9DQouaWNvbi1wbHVzLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjowIC05NnB4O30NCi5pY29uLW1pbnVzLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtOTZweDt9DQouaWNvbi1yZW1vdmUtc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC05NnB4O30NCi5pY29uLW9rLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjotNzJweCAtOTZweDt9DQouaWNvbi1xdWVzdGlvbi1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTk2cHggLTk2cHg7fQ0KLmljb24taW5mby1zaWdue2JhY2tncm91bmQtcG9zaXRpb246LTEyMHB4IC05NnB4O30NCi5pY29uLXNjcmVlbnNob3R7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTk2cHg7fQ0KLmljb24tcmVtb3ZlLWNpcmNsZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAtOTZweDt9DQouaWNvbi1vay1jaXJjbGV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTkycHggLTk2cHg7fQ0KLmljb24tYmFuLWNpcmNsZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yMTZweCAtOTZweDt9DQouaWNvbi1hcnJvdy1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTI0MHB4IC05NnB4O30NCi5pY29uLWFycm93LXJpZ2h0e2JhY2tncm91bmQtcG9zaXRpb246LTI2NHB4IC05NnB4O30NCi5pY29uLWFycm93LXVwe2JhY2tncm91bmQtcG9zaXRpb246LTI4OXB4IC05NnB4O30NCi5pY29uLWFycm93LWRvd257YmFja2dyb3VuZC1wb3NpdGlvbjotMzEycHggLTk2cHg7fQ0KLmljb24tc2hhcmUtYWx0e2JhY2tncm91bmQtcG9zaXRpb246LTMzNnB4IC05NnB4O30NCi5pY29uLXJlc2l6ZS1mdWxse2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC05NnB4O30NCi5pY29uLXJlc2l6ZS1zbWFsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtOTZweDt9DQouaWNvbi1wbHVze2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IC05NnB4O30NCi5pY29uLW1pbnVze2JhY2tncm91bmQtcG9zaXRpb246LTQzM3B4IC05NnB4O30NCi5pY29uLWFzdGVyaXNre2JhY2tncm91bmQtcG9zaXRpb246LTQ1NnB4IC05NnB4O30NCi5pY29uLWV4Y2xhbWF0aW9uLXNpZ257YmFja2dyb3VuZC1wb3NpdGlvbjowIC0xMjBweDt9DQouaWNvbi1naWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTI0cHggLTEyMHB4O30NCi5pY29uLWxlYWZ7YmFja2dyb3VuZC1wb3NpdGlvbjotNDhweCAtMTIwcHg7fQ0KLmljb24tZmlyZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IC0xMjBweDt9DQouaWNvbi1leWUtb3BlbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi05NnB4IC0xMjBweDt9DQouaWNvbi1leWUtY2xvc2V7YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTEyMHB4O30NCi5pY29uLXdhcm5pbmctc2lnbntiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNDRweCAtMTIwcHg7fQ0KLmljb24tcGxhbmV7YmFja2dyb3VuZC1wb3NpdGlvbjotMTY4cHggLTEyMHB4O30NCi5pY29uLWNhbGVuZGFye2JhY2tncm91bmQtcG9zaXRpb246LTE5MnB4IC0xMjBweDt9DQouaWNvbi1yYW5kb217YmFja2dyb3VuZC1wb3NpdGlvbjotMjE2cHggLTEyMHB4O3dpZHRoOjE2cHg7fQ0KLmljb24tY29tbWVudHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0yNDBweCAtMTIwcHg7fQ0KLmljb24tbWFnbmV0e2JhY2tncm91bmQtcG9zaXRpb246LTI2NHB4IC0xMjBweDt9DQouaWNvbi1jaGV2cm9uLXVwe2JhY2tncm91bmQtcG9zaXRpb246LTI4OHB4IC0xMjBweDt9DQouaWNvbi1jaGV2cm9uLWRvd257YmFja2dyb3VuZC1wb3NpdGlvbjotMzEzcHggLTExOXB4O30NCi5pY29uLXJldHdlZXR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzM2cHggLTEyMHB4O30NCi5pY29uLXNob3BwaW5nLWNhcnR7YmFja2dyb3VuZC1wb3NpdGlvbjotMzYwcHggLTEyMHB4O30NCi5pY29uLWZvbGRlci1jbG9zZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMTIwcHg7fQ0KLmljb24tZm9sZGVyLW9wZW57YmFja2dyb3VuZC1wb3NpdGlvbjotNDA4cHggLTEyMHB4O3dpZHRoOjE2cHg7fQ0KLmljb24tcmVzaXplLXZlcnRpY2Fse2JhY2tncm91bmQtcG9zaXRpb246LTQzMnB4IC0xMTlweDt9DQouaWNvbi1yZXNpemUtaG9yaXpvbnRhbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00NTZweCAtMTE4cHg7fQ0KLmljb24taGRke2JhY2tncm91bmQtcG9zaXRpb246MCAtMTQ0cHg7fQ0KLmljb24tYnVsbGhvcm57YmFja2dyb3VuZC1wb3NpdGlvbjotMjRweCAtMTQ0cHg7fQ0KLmljb24tYmVsbHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi00OHB4IC0xNDRweDt9DQouaWNvbi1jZXJ0aWZpY2F0ZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi03MnB4IC0xNDRweDt9DQouaWNvbi10aHVtYnMtdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotOTZweCAtMTQ0cHg7fQ0KLmljb24tdGh1bWJzLWRvd257YmFja2dyb3VuZC1wb3NpdGlvbjotMTIwcHggLTE0NHB4O30NCi5pY29uLWhhbmQtcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMTQ0cHggLTE0NHB4O30NCi5pY29uLWhhbmQtbGVmdHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xNjhweCAtMTQ0cHg7fQ0KLmljb24taGFuZC11cHtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0xOTJweCAtMTQ0cHg7fQ0KLmljb24taGFuZC1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTIxNnB4IC0xNDRweDt9DQouaWNvbi1jaXJjbGUtYXJyb3ctcmlnaHR7YmFja2dyb3VuZC1wb3NpdGlvbjotMjQwcHggLTE0NHB4O30NCi5pY29uLWNpcmNsZS1hcnJvdy1sZWZ0e2JhY2tncm91bmQtcG9zaXRpb246LTI2NHB4IC0xNDRweDt9DQouaWNvbi1jaXJjbGUtYXJyb3ctdXB7YmFja2dyb3VuZC1wb3NpdGlvbjotMjg4cHggLTE0NHB4O30NCi5pY29uLWNpcmNsZS1hcnJvdy1kb3due2JhY2tncm91bmQtcG9zaXRpb246LTMxMnB4IC0xNDRweDt9DQouaWNvbi1nbG9iZXtiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zMzZweCAtMTQ0cHg7fQ0KLmljb24td3JlbmNoe2JhY2tncm91bmQtcG9zaXRpb246LTM2MHB4IC0xNDRweDt9DQouaWNvbi10YXNrc3tiYWNrZ3JvdW5kLXBvc2l0aW9uOi0zODRweCAtMTQ0cHg7fQ0KLmljb24tZmlsdGVye2JhY2tncm91bmQtcG9zaXRpb246LTQwOHB4IC0xNDRweDt9DQouaWNvbi1icmllZmNhc2V7YmFja2dyb3VuZC1wb3NpdGlvbjotNDMycHggLTE0NHB4O30NCi5pY29uLWZ1bGxzY3JlZW57YmFja2dyb3VuZC1wb3NpdGlvbjotNDU2cHggLTE0NHB4O30NCi5idG4tZ3JvdXB7cG9zaXRpb246cmVsYXRpdmU7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7Zm9udC1zaXplOjA7dmVydGljYWwtYWxpZ246bWlkZGxlO3doaXRlLXNwYWNlOm5vd3JhcDsqbWFyZ2luLWxlZnQ6LjNlbTt9LmJ0bi1ncm91cDpmaXJzdC1jaGlsZHsqbWFyZ2luLWxlZnQ6MDt9DQouYnRuLWdyb3VwKy5idG4tZ3JvdXB7bWFyZ2luLWxlZnQ6NXB4O30NCi5idG4tdG9vbGJhcntmb250LXNpemU6MDttYXJnaW4tdG9wOjEwcHg7bWFyZ2luLWJvdHRvbToxMHB4O30uYnRuLXRvb2xiYXIgLmJ0bisuYnRuLC5idG4tdG9vbGJhciAuYnRuLWdyb3VwKy5idG4sLmJ0bi10b29sYmFyIC5idG4rLmJ0bi1ncm91cHttYXJnaW4tbGVmdDo1cHg7fQ0KLmJ0bi1ncm91cD4uYnRue3Bvc2l0aW9uOnJlbGF0aXZlOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQouYnRuLWdyb3VwPi5idG4rLmJ0bnttYXJnaW4tbGVmdDotMXB4O30NCi5idG4tZ3JvdXA+LmJ0biwuYnRuLWdyb3VwPi5kcm9wZG93bi1tZW51e2ZvbnQtc2l6ZToxNHB4O30NCi5idG4tZ3JvdXA+LmJ0bi1taW5pe2ZvbnQtc2l6ZToxMXB4O30NCi5idG4tZ3JvdXA+LmJ0bi1zbWFsbHtmb250LXNpemU6MTJweDt9DQouYnRuLWdyb3VwPi5idG4tbGFyZ2V7Zm9udC1zaXplOjE2cHg7fQ0KLmJ0bi1ncm91cD4uYnRuOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7fQ0KLmJ0bi1ncm91cD4uYnRuOmxhc3QtY2hpbGQsLmJ0bi1ncm91cD4uZHJvcGRvd24tdG9nZ2xley13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo0cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NHB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4O30NCi5idG4tZ3JvdXA+LmJ0bi5sYXJnZTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowOy13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6NnB4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6NnB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6NnB4O2JvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4O30NCi5idG4tZ3JvdXA+LmJ0bi5sYXJnZTpsYXN0LWNoaWxkLC5idG4tZ3JvdXA+LmxhcmdlLmRyb3Bkb3duLXRvZ2dsZXstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NnB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjZweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NnB4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjZweDt9DQouYnRuLWdyb3VwPi5idG46aG92ZXIsLmJ0bi1ncm91cD4uYnRuOmZvY3VzLC5idG4tZ3JvdXA+LmJ0bjphY3RpdmUsLmJ0bi1ncm91cD4uYnRuLmFjdGl2ZXt6LWluZGV4OjI7fQ0KLmJ0bi1ncm91cCAuZHJvcGRvd24tdG9nZ2xlOmFjdGl2ZSwuYnRuLWdyb3VwLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZXtvdXRsaW5lOjA7fQ0KLmJ0bi1ncm91cD4uYnRuKy5kcm9wZG93bi10b2dnbGV7cGFkZGluZy1sZWZ0OjhweDtwYWRkaW5nLXJpZ2h0OjhweDstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMXB4IDAgMCByZ2JhKDI1NSwyNTUsMjU1LC4xMjUpLCBpbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjIpLCAwIDFweCAycHggcmdiYSgwLDAsMCwuMDUpOy1tb3otYm94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEyNSksIGluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMiksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7Ym94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEyNSksIGluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMiksIDAgMXB4IDJweCByZ2JhKDAsMCwwLC4wNSk7KnBhZGRpbmctdG9wOjVweDsqcGFkZGluZy1ib3R0b206NXB4O30NCi5idG4tZ3JvdXA+LmJ0bi1taW5pKy5kcm9wZG93bi10b2dnbGV7cGFkZGluZy1sZWZ0OjVweDtwYWRkaW5nLXJpZ2h0OjVweDsqcGFkZGluZy10b3A6MnB4OypwYWRkaW5nLWJvdHRvbToycHg7fQ0KLmJ0bi1ncm91cD4uYnRuLXNtYWxsKy5kcm9wZG93bi10b2dnbGV7KnBhZGRpbmctdG9wOjVweDsqcGFkZGluZy1ib3R0b206NHB4O30NCi5idG4tZ3JvdXA+LmJ0bi1sYXJnZSsuZHJvcGRvd24tdG9nZ2xle3BhZGRpbmctbGVmdDoxMnB4O3BhZGRpbmctcmlnaHQ6MTJweDsqcGFkZGluZy10b3A6N3B4OypwYWRkaW5nLWJvdHRvbTo3cHg7fQ0KLmJ0bi1ncm91cC5vcGVuIC5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1pbWFnZTpub25lOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwuMTUpLCAwIDFweCAycHggcmdiYSgwLDAsMCwuMDUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDJweCA0cHggcmdiYSgwLDAsMCwuMTUpLCAwIDFweCAycHggcmdiYSgwLDAsMCwuMDUpO2JveC1zaGFkb3c6aW5zZXQgMCAycHggNHB4IHJnYmEoMCwwLDAsLjE1KSwgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjA1KTt9DQouYnRuLWdyb3VwLm9wZW4gLmJ0bi5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojZTZlNmU2O30NCi5idG4tZ3JvdXAub3BlbiAuYnRuLXByaW1hcnkuZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzAwNDRjYzt9DQouYnRuLWdyb3VwLm9wZW4gLmJ0bi13YXJuaW5nLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNmODk0MDY7fQ0KLmJ0bi1ncm91cC5vcGVuIC5idG4tZGFuZ2VyLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNiZDM2MmY7fQ0KLmJ0bi1ncm91cC5vcGVuIC5idG4tc3VjY2Vzcy5kcm9wZG93bi10b2dnbGV7YmFja2dyb3VuZC1jb2xvcjojNTFhMzUxO30NCi5idG4tZ3JvdXAub3BlbiAuYnRuLWluZm8uZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzJmOTZiNDt9DQouYnRuLWdyb3VwLm9wZW4gLmJ0bi1pbnZlcnNlLmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiMyMjIyMjI7fQ0KLmJ0biAuY2FyZXR7bWFyZ2luLXRvcDo4cHg7bWFyZ2luLWxlZnQ6MDt9DQouYnRuLW1pbmkgLmNhcmV0LC5idG4tc21hbGwgLmNhcmV0LC5idG4tbGFyZ2UgLmNhcmV0e21hcmdpbi10b3A6NnB4O30NCi5idG4tbGFyZ2UgLmNhcmV0e2JvcmRlci1sZWZ0LXdpZHRoOjVweDtib3JkZXItcmlnaHQtd2lkdGg6NXB4O2JvcmRlci10b3Atd2lkdGg6NXB4O30NCi5kcm9wdXAgLmJ0bi1sYXJnZSAuY2FyZXR7Ym9yZGVyLWJvdHRvbS13aWR0aDo1cHg7fQ0KLmJ0bi1wcmltYXJ5IC5jYXJldCwuYnRuLXdhcm5pbmcgLmNhcmV0LC5idG4tZGFuZ2VyIC5jYXJldCwuYnRuLWluZm8gLmNhcmV0LC5idG4tc3VjY2VzcyAuY2FyZXQsLmJ0bi1pbnZlcnNlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiNmZmZmZmY7Ym9yZGVyLWJvdHRvbS1jb2xvcjojZmZmZmZmO30NCi5idG4tZ3JvdXAtdmVydGljYWx7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7fQ0KLmJ0bi1ncm91cC12ZXJ0aWNhbCAuYnRue2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bm9uZTt3aWR0aDoxMDAlOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQouYnRuLWdyb3VwLXZlcnRpY2FsIC5idG4rLmJ0bnttYXJnaW4tbGVmdDowO21hcmdpbi10b3A6LTFweDt9DQouYnRuLWdyb3VwLXZlcnRpY2FsIC5idG46Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweCA0cHggMCAwOy1tb3otYm9yZGVyLXJhZGl1czo0cHggNHB4IDAgMDtib3JkZXItcmFkaXVzOjRweCA0cHggMCAwO30NCi5idG4tZ3JvdXAtdmVydGljYWwgLmJ0bjpsYXN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNHB4IDRweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7Ym9yZGVyLXJhZGl1czowIDAgNHB4IDRweDt9DQouYnRuLWdyb3VwLXZlcnRpY2FsIC5idG4tbGFyZ2U6Zmlyc3QtY2hpbGR7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweCA2cHggMCAwOy1tb3otYm9yZGVyLXJhZGl1czo2cHggNnB4IDAgMDtib3JkZXItcmFkaXVzOjZweCA2cHggMCAwO30NCi5idG4tZ3JvdXAtdmVydGljYWwgLmJ0bi1sYXJnZTpsYXN0LWNoaWxkey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDAgNnB4IDZweDt9DQoubmF2e21hcmdpbi1sZWZ0OjA7bWFyZ2luLWJvdHRvbToyMHB4O2xpc3Qtc3R5bGU6bm9uZTt9DQoubmF2PmxpPmF7ZGlzcGxheTpibG9jazt9DQoubmF2PmxpPmE6aG92ZXJ7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZWVlZWVlO30NCi5uYXY+LnB1bGwtcmlnaHR7ZmxvYXQ6cmlnaHQ7fQ0KLm5hdi1oZWFkZXJ7ZGlzcGxheTpibG9jaztwYWRkaW5nOjNweCAxNXB4O2ZvbnQtc2l6ZToxMXB4O2ZvbnQtd2VpZ2h0OmJvbGQ7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojOTk5OTk5O3RleHQtc2hhZG93OjAgMXB4IDAgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjUpO3RleHQtdHJhbnNmb3JtOnVwcGVyY2FzZTt9DQoubmF2IGxpKy5uYXYtaGVhZGVye21hcmdpbi10b3A6OXB4O30NCi5uYXYtbGlzdHtwYWRkaW5nLWxlZnQ6MTVweDtwYWRkaW5nLXJpZ2h0OjE1cHg7bWFyZ2luLWJvdHRvbTowO30NCi5uYXYtbGlzdD5saT5hLC5uYXYtbGlzdCAubmF2LWhlYWRlcnttYXJnaW4tbGVmdDotMTVweDttYXJnaW4tcmlnaHQ6LTE1cHg7dGV4dC1zaGFkb3c6MCAxcHggMCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuNSk7fQ0KLm5hdi1saXN0PmxpPmF7cGFkZGluZzozcHggMTVweDt9DQoubmF2LWxpc3Q+LmFjdGl2ZT5hLC5uYXYtbGlzdD4uYWN0aXZlPmE6aG92ZXJ7Y29sb3I6I2ZmZmZmZjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMik7YmFja2dyb3VuZC1jb2xvcjojMDA4OGNjO30NCi5uYXYtbGlzdCBbY2xhc3NePSJpY29uLSJdLC5uYXYtbGlzdCBbY2xhc3MqPSIgaWNvbi0iXXttYXJnaW4tcmlnaHQ6MnB4O30NCi5uYXYtbGlzdCAuZGl2aWRlcnsqd2lkdGg6MTAwJTtoZWlnaHQ6MXB4O21hcmdpbjo5cHggMXB4OyptYXJnaW46LTVweCAwIDVweDtvdmVyZmxvdzpoaWRkZW47YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNmZmZmZmY7fQ0KLm5hdi10YWJzLC5uYXYtcGlsbHN7Knpvb206MTt9Lm5hdi10YWJzOmJlZm9yZSwubmF2LXBpbGxzOmJlZm9yZSwubmF2LXRhYnM6YWZ0ZXIsLm5hdi1waWxsczphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoubmF2LXRhYnM6YWZ0ZXIsLm5hdi1waWxsczphZnRlcntjbGVhcjpib3RoO30NCi5uYXYtdGFicz5saSwubmF2LXBpbGxzPmxpe2Zsb2F0OmxlZnQ7fQ0KLm5hdi10YWJzPmxpPmEsLm5hdi1waWxscz5saT5he3BhZGRpbmctcmlnaHQ6MTJweDtwYWRkaW5nLWxlZnQ6MTJweDttYXJnaW4tcmlnaHQ6MnB4O2xpbmUtaGVpZ2h0OjE0cHg7fQ0KLm5hdi10YWJze2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNkZGQ7fQ0KLm5hdi10YWJzPmxpe21hcmdpbi1ib3R0b206LTFweDt9DQoubmF2LXRhYnM+bGk+YXtwYWRkaW5nLXRvcDo4cHg7cGFkZGluZy1ib3R0b206OHB4O2xpbmUtaGVpZ2h0OjIwcHg7Ym9yZGVyOjFweCBzb2xpZCB0cmFuc3BhcmVudDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7LW1vei1ib3JkZXItcmFkaXVzOjRweCA0cHggMCAwO2JvcmRlci1yYWRpdXM6NHB4IDRweCAwIDA7fS5uYXYtdGFicz5saT5hOmhvdmVye2JvcmRlci1jb2xvcjojZWVlZWVlICNlZWVlZWUgI2RkZGRkZDt9DQoubmF2LXRhYnM+LmFjdGl2ZT5hLC5uYXYtdGFicz4uYWN0aXZlPmE6aG92ZXJ7Y29sb3I6IzU1NTU1NTtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZGRkO2JvcmRlci1ib3R0b20tY29sb3I6dHJhbnNwYXJlbnQ7Y3Vyc29yOmRlZmF1bHQ7fQ0KLm5hdi1waWxscz5saT5he3BhZGRpbmctdG9wOjhweDtwYWRkaW5nLWJvdHRvbTo4cHg7bWFyZ2luLXRvcDoycHg7bWFyZ2luLWJvdHRvbToycHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjVweDstbW96LWJvcmRlci1yYWRpdXM6NXB4O2JvcmRlci1yYWRpdXM6NXB4O30NCi5uYXYtcGlsbHM+LmFjdGl2ZT5hLC5uYXYtcGlsbHM+LmFjdGl2ZT5hOmhvdmVye2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojMDA4OGNjO30NCi5uYXYtc3RhY2tlZD5saXtmbG9hdDpub25lO30NCi5uYXYtc3RhY2tlZD5saT5he21hcmdpbi1yaWdodDowO30NCi5uYXYtdGFicy5uYXYtc3RhY2tlZHtib3JkZXItYm90dG9tOjA7fQ0KLm5hdi10YWJzLm5hdi1zdGFja2VkPmxpPmF7Ym9yZGVyOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDt9DQoubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk6Zmlyc3QtY2hpbGQ+YXstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjRweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDt9DQoubmF2LXRhYnMubmF2LXN0YWNrZWQ+bGk6bGFzdC1jaGlsZD5hey13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo0cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NHB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6NHB4O2JvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NHB4O30NCi5uYXYtdGFicy5uYXYtc3RhY2tlZD5saT5hOmhvdmVye2JvcmRlci1jb2xvcjojZGRkO3otaW5kZXg6Mjt9DQoubmF2LXBpbGxzLm5hdi1zdGFja2VkPmxpPmF7bWFyZ2luLWJvdHRvbTozcHg7fQ0KLm5hdi1waWxscy5uYXYtc3RhY2tlZD5saTpsYXN0LWNoaWxkPmF7bWFyZ2luLWJvdHRvbToxcHg7fQ0KLm5hdi10YWJzIC5kcm9wZG93bi1tZW51ey13ZWJraXQtYm9yZGVyLXJhZGl1czowIDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDAgNnB4IDZweDt9DQoubmF2LXBpbGxzIC5kcm9wZG93bi1tZW51ey13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDt9DQoubmF2IC5kcm9wZG93bi10b2dnbGUgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6IzAwODhjYztib3JkZXItYm90dG9tLWNvbG9yOiMwMDg4Y2M7bWFyZ2luLXRvcDo2cHg7fQ0KLm5hdiAuZHJvcGRvd24tdG9nZ2xlOmhvdmVyIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiMwMDU1ODA7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDA1NTgwO30NCi5uYXYtdGFicyAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHttYXJnaW4tdG9wOjhweDt9DQoubmF2IC5hY3RpdmUgLmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZjt9DQoubmF2LXRhYnMgLmFjdGl2ZSAuZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM1NTU1NTU7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNTU1NTU1O30NCi5uYXY+LmRyb3Bkb3duLmFjdGl2ZT5hOmhvdmVye2N1cnNvcjpwb2ludGVyO30NCi5uYXYtdGFicyAub3BlbiAuZHJvcGRvd24tdG9nZ2xlLC5uYXYtcGlsbHMgLm9wZW4gLmRyb3Bkb3duLXRvZ2dsZSwubmF2PmxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlPmE6aG92ZXJ7Y29sb3I6I2ZmZmZmZjtiYWNrZ3JvdW5kLWNvbG9yOiM5OTk5OTk7Ym9yZGVyLWNvbG9yOiM5OTk5OTk7fQ0KLm5hdiBsaS5kcm9wZG93bi5vcGVuIC5jYXJldCwubmF2IGxpLmRyb3Bkb3duLm9wZW4uYWN0aXZlIC5jYXJldCwubmF2IGxpLmRyb3Bkb3duLm9wZW4gYTpob3ZlciAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZmZmZjtvcGFjaXR5OjE7ZmlsdGVyOmFscGhhKG9wYWNpdHk9MTAwKTt9DQoudGFicy1zdGFja2VkIC5vcGVuPmE6aG92ZXJ7Ym9yZGVyLWNvbG9yOiM5OTk5OTk7fQ0KLnRhYmJhYmxleyp6b29tOjE7fS50YWJiYWJsZTpiZWZvcmUsLnRhYmJhYmxlOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30NCi50YWJiYWJsZTphZnRlcntjbGVhcjpib3RoO30NCi50YWItY29udGVudHtvdmVyZmxvdzphdXRvO30NCi50YWJzLWJlbG93Pi5uYXYtdGFicywudGFicy1yaWdodD4ubmF2LXRhYnMsLnRhYnMtbGVmdD4ubmF2LXRhYnN7Ym9yZGVyLWJvdHRvbTowO30NCi50YWItY29udGVudD4udGFiLXBhbmUsLnBpbGwtY29udGVudD4ucGlsbC1wYW5le2Rpc3BsYXk6bm9uZTt9DQoudGFiLWNvbnRlbnQ+LmFjdGl2ZSwucGlsbC1jb250ZW50Pi5hY3RpdmV7ZGlzcGxheTpibG9jazt9DQoudGFicy1iZWxvdz4ubmF2LXRhYnN7Ym9yZGVyLXRvcDoxcHggc29saWQgI2RkZDt9DQoudGFicy1iZWxvdz4ubmF2LXRhYnM+bGl7bWFyZ2luLXRvcDotMXB4O21hcmdpbi1ib3R0b206MDt9DQoudGFicy1iZWxvdz4ubmF2LXRhYnM+bGk+YXstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA0cHggNHB4O2JvcmRlci1yYWRpdXM6MCAwIDRweCA0cHg7fS50YWJzLWJlbG93Pi5uYXYtdGFicz5saT5hOmhvdmVye2JvcmRlci1ib3R0b20tY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLXRvcC1jb2xvcjojZGRkO30NCi50YWJzLWJlbG93Pi5uYXYtdGFicz4uYWN0aXZlPmEsLnRhYnMtYmVsb3c+Lm5hdi10YWJzPi5hY3RpdmU+YTpob3Zlcntib3JkZXItY29sb3I6dHJhbnNwYXJlbnQgI2RkZCAjZGRkICNkZGQ7fQ0KLnRhYnMtbGVmdD4ubmF2LXRhYnM+bGksLnRhYnMtcmlnaHQ+Lm5hdi10YWJzPmxpe2Zsb2F0Om5vbmU7fQ0KLnRhYnMtbGVmdD4ubmF2LXRhYnM+bGk+YSwudGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YXttaW4td2lkdGg6NzRweDttYXJnaW4tcmlnaHQ6MDttYXJnaW4tYm90dG9tOjNweDt9DQoudGFicy1sZWZ0Pi5uYXYtdGFic3tmbG9hdDpsZWZ0O21hcmdpbi1yaWdodDoxOXB4O2JvcmRlci1yaWdodDoxcHggc29saWQgI2RkZDt9DQoudGFicy1sZWZ0Pi5uYXYtdGFicz5saT5he21hcmdpbi1yaWdodDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHggMCAwIDRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHg7Ym9yZGVyLXJhZGl1czo0cHggMCAwIDRweDt9DQoudGFicy1sZWZ0Pi5uYXYtdGFicz5saT5hOmhvdmVye2JvcmRlci1jb2xvcjojZWVlZWVlICNkZGRkZGQgI2VlZWVlZSAjZWVlZWVlO30NCi50YWJzLWxlZnQ+Lm5hdi10YWJzIC5hY3RpdmU+YSwudGFicy1sZWZ0Pi5uYXYtdGFicyAuYWN0aXZlPmE6aG92ZXJ7Ym9yZGVyLWNvbG9yOiNkZGQgdHJhbnNwYXJlbnQgI2RkZCAjZGRkOypib3JkZXItcmlnaHQtY29sb3I6I2ZmZmZmZjt9DQoudGFicy1yaWdodD4ubmF2LXRhYnN7ZmxvYXQ6cmlnaHQ7bWFyZ2luLWxlZnQ6MTlweDtib3JkZXItbGVmdDoxcHggc29saWQgI2RkZDt9DQoudGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YXttYXJnaW4tbGVmdDotMXB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czowIDRweCA0cHggMDstbW96LWJvcmRlci1yYWRpdXM6MCA0cHggNHB4IDA7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMDt9DQoudGFicy1yaWdodD4ubmF2LXRhYnM+bGk+YTpob3Zlcntib3JkZXItY29sb3I6I2VlZWVlZSAjZWVlZWVlICNlZWVlZWUgI2RkZGRkZDt9DQoudGFicy1yaWdodD4ubmF2LXRhYnMgLmFjdGl2ZT5hLC50YWJzLXJpZ2h0Pi5uYXYtdGFicyAuYWN0aXZlPmE6aG92ZXJ7Ym9yZGVyLWNvbG9yOiNkZGQgI2RkZCAjZGRkIHRyYW5zcGFyZW50Oypib3JkZXItbGVmdC1jb2xvcjojZmZmZmZmO30NCi5uYXY+LmRpc2FibGVkPmF7Y29sb3I6Izk5OTk5OTt9DQoubmF2Pi5kaXNhYmxlZD5hOmhvdmVye3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Y3Vyc29yOmRlZmF1bHQ7fQ0KLm5hdmJhcntvdmVyZmxvdzp2aXNpYmxlO21hcmdpbi1ib3R0b206MjBweDtjb2xvcjojNzc3Nzc3Oypwb3NpdGlvbjpyZWxhdGl2ZTsqei1pbmRleDoyO30NCi5uYXZiYXItaW5uZXJ7bWluLWhlaWdodDo0MHB4O3BhZGRpbmctbGVmdDoyMHB4O3BhZGRpbmctcmlnaHQ6MjBweDtiYWNrZ3JvdW5kLWNvbG9yOiNmYWZhZmE7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsICNmZmZmZmYsICNmMmYyZjIpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsIDAgMCwgMCAxMDAlLCBmcm9tKCNmZmZmZmYpLCB0bygjZjJmMmYyKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsICNmZmZmZmYsICNmMmYyZjIpO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwgI2ZmZmZmZiwgI2YyZjJmMik7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG8gYm90dG9tLCAjZmZmZmZmLCAjZjJmMmYyKTtiYWNrZ3JvdW5kLXJlcGVhdDpyZXBlYXQteDtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyNmZmZmZmZmZicsIGVuZENvbG9yc3RyPScjZmZmMmYyZjInLCBHcmFkaWVudFR5cGU9MCk7Ym9yZGVyOjFweCBzb2xpZCAjZDRkNGQ0Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwgMCwgMCwgMC4wNjUpOy1tb3otYm94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLCAwLCAwLCAwLjA2NSk7Ym94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLCAwLCAwLCAwLjA2NSk7Knpvb206MTt9Lm5hdmJhci1pbm5lcjpiZWZvcmUsLm5hdmJhci1pbm5lcjphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoubmF2YmFyLWlubmVyOmFmdGVye2NsZWFyOmJvdGg7fQ0KLm5hdmJhciAuY29udGFpbmVye3dpZHRoOmF1dG87fQ0KLm5hdi1jb2xsYXBzZS5jb2xsYXBzZXtoZWlnaHQ6YXV0bztvdmVyZmxvdzp2aXNpYmxlO30NCi5uYXZiYXIgLmJyYW5ke2Zsb2F0OmxlZnQ7ZGlzcGxheTpibG9jaztwYWRkaW5nOjEwcHggMjBweCAxMHB4O21hcmdpbi1sZWZ0Oi0yMHB4O2ZvbnQtc2l6ZToyMHB4O2ZvbnQtd2VpZ2h0OjIwMDtjb2xvcjojNzc3Nzc3O3RleHQtc2hhZG93OjAgMXB4IDAgI2ZmZmZmZjt9Lm5hdmJhciAuYnJhbmQ6aG92ZXJ7dGV4dC1kZWNvcmF0aW9uOm5vbmU7fQ0KLm5hdmJhci10ZXh0e21hcmdpbi1ib3R0b206MDtsaW5lLWhlaWdodDo0MHB4O30NCi5uYXZiYXItbGlua3tjb2xvcjojNzc3Nzc3O30ubmF2YmFyLWxpbms6aG92ZXJ7Y29sb3I6IzMzMzMzMzt9DQoubmF2YmFyIC5kaXZpZGVyLXZlcnRpY2Fse2hlaWdodDo0MHB4O21hcmdpbjowIDlweDtib3JkZXItbGVmdDoxcHggc29saWQgI2YyZjJmMjtib3JkZXItcmlnaHQ6MXB4IHNvbGlkICNmZmZmZmY7fQ0KLm5hdmJhciAuYnRuLC5uYXZiYXIgLmJ0bi1ncm91cHttYXJnaW4tdG9wOjVweDt9DQoubmF2YmFyIC5idG4tZ3JvdXAgLmJ0biwubmF2YmFyIC5pbnB1dC1wcmVwZW5kIC5idG4sLm5hdmJhciAuaW5wdXQtYXBwZW5kIC5idG57bWFyZ2luLXRvcDowO30NCi5uYXZiYXItZm9ybXttYXJnaW4tYm90dG9tOjA7Knpvb206MTt9Lm5hdmJhci1mb3JtOmJlZm9yZSwubmF2YmFyLWZvcm06YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLm5hdmJhci1mb3JtOmFmdGVye2NsZWFyOmJvdGg7fQ0KLm5hdmJhci1mb3JtIGlucHV0LC5uYXZiYXItZm9ybSBzZWxlY3QsLm5hdmJhci1mb3JtIC5yYWRpbywubmF2YmFyLWZvcm0gLmNoZWNrYm94e21hcmdpbi10b3A6NXB4O30NCi5uYXZiYXItZm9ybSBpbnB1dCwubmF2YmFyLWZvcm0gc2VsZWN0LC5uYXZiYXItZm9ybSAuYnRue2Rpc3BsYXk6aW5saW5lLWJsb2NrO21hcmdpbi1ib3R0b206MDt9DQoubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0iaW1hZ2UiXSwubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0iY2hlY2tib3giXSwubmF2YmFyLWZvcm0gaW5wdXRbdHlwZT0icmFkaW8iXXttYXJnaW4tdG9wOjNweDt9DQoubmF2YmFyLWZvcm0gLmlucHV0LWFwcGVuZCwubmF2YmFyLWZvcm0gLmlucHV0LXByZXBlbmR7bWFyZ2luLXRvcDo2cHg7d2hpdGUtc3BhY2U6bm93cmFwO30ubmF2YmFyLWZvcm0gLmlucHV0LWFwcGVuZCBpbnB1dCwubmF2YmFyLWZvcm0gLmlucHV0LXByZXBlbmQgaW5wdXR7bWFyZ2luLXRvcDowO30NCi5uYXZiYXItc2VhcmNoe3Bvc2l0aW9uOnJlbGF0aXZlO2Zsb2F0OmxlZnQ7bWFyZ2luLXRvcDo1cHg7bWFyZ2luLWJvdHRvbTowO30ubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5e21hcmdpbi1ib3R0b206MDtwYWRkaW5nOjRweCAxNHB4O2ZvbnQtZmFtaWx5OiJIZWx2ZXRpY2EgTmV1ZSIsSGVsdmV0aWNhLEFyaWFsLHNhbnMtc2VyaWY7Zm9udC1zaXplOjEzcHg7Zm9udC13ZWlnaHQ6bm9ybWFsO2xpbmUtaGVpZ2h0OjE7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjE1cHg7LW1vei1ib3JkZXItcmFkaXVzOjE1cHg7Ym9yZGVyLXJhZGl1czoxNXB4O30NCi5uYXZiYXItc3RhdGljLXRvcHtwb3NpdGlvbjpzdGF0aWM7bWFyZ2luLWJvdHRvbTowO30ubmF2YmFyLXN0YXRpYy10b3AgLm5hdmJhci1pbm5lcnstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjA7fQ0KLm5hdmJhci1maXhlZC10b3AsLm5hdmJhci1maXhlZC1ib3R0b217cG9zaXRpb246Zml4ZWQ7cmlnaHQ6MDtsZWZ0OjA7ei1pbmRleDoxMDMwO21hcmdpbi1ib3R0b206MDt9DQoubmF2YmFyLWZpeGVkLXRvcCAubmF2YmFyLWlubmVyLC5uYXZiYXItc3RhdGljLXRvcCAubmF2YmFyLWlubmVye2JvcmRlci13aWR0aDowIDAgMXB4O30NCi5uYXZiYXItZml4ZWQtYm90dG9tIC5uYXZiYXItaW5uZXJ7Ym9yZGVyLXdpZHRoOjFweCAwIDA7fQ0KLm5hdmJhci1maXhlZC10b3AgLm5hdmJhci1pbm5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2YmFyLWlubmVye3BhZGRpbmctbGVmdDowO3BhZGRpbmctcmlnaHQ6MDstd2Via2l0LWJvcmRlci1yYWRpdXM6MDstbW96LWJvcmRlci1yYWRpdXM6MDtib3JkZXItcmFkaXVzOjA7fQ0KLm5hdmJhci1zdGF0aWMtdG9wIC5jb250YWluZXIsLm5hdmJhci1maXhlZC10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLWJvdHRvbSAuY29udGFpbmVye3dpZHRoOjk0MHB4O30NCi5uYXZiYXItZml4ZWQtdG9we3RvcDowO30NCi5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1zdGF0aWMtdG9wIC5uYXZiYXItaW5uZXJ7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwuMSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDEwcHggcmdiYSgwLDAsMCwuMSk7Ym94LXNoYWRvdzowIDFweCAxMHB4IHJnYmEoMCwwLDAsLjEpO30NCi5uYXZiYXItZml4ZWQtYm90dG9te2JvdHRvbTowO30ubmF2YmFyLWZpeGVkLWJvdHRvbSAubmF2YmFyLWlubmVyey13ZWJraXQtYm94LXNoYWRvdzowIC0xcHggMTBweCByZ2JhKDAsMCwwLC4xKTstbW96LWJveC1zaGFkb3c6MCAtMXB4IDEwcHggcmdiYSgwLDAsMCwuMSk7Ym94LXNoYWRvdzowIC0xcHggMTBweCByZ2JhKDAsMCwwLC4xKTt9DQoubmF2YmFyIC5uYXZ7cG9zaXRpb246cmVsYXRpdmU7bGVmdDowO2Rpc3BsYXk6YmxvY2s7ZmxvYXQ6bGVmdDttYXJnaW46MCAxMHB4IDAgMDt9DQoubmF2YmFyIC5uYXYucHVsbC1yaWdodHtmbG9hdDpyaWdodDttYXJnaW4tcmlnaHQ6MDt9DQoubmF2YmFyIC5uYXY+bGl7ZmxvYXQ6bGVmdDt9DQoubmF2YmFyIC5uYXY+bGk+YXtmbG9hdDpub25lO3BhZGRpbmc6MTBweCAxNXB4IDEwcHg7Y29sb3I6Izc3Nzc3Nzt0ZXh0LWRlY29yYXRpb246bm9uZTt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmZmZmY7fQ0KLm5hdmJhciAubmF2IC5kcm9wZG93bi10b2dnbGUgLmNhcmV0e21hcmdpbi10b3A6OHB4O30NCi5uYXZiYXIgLm5hdj5saT5hOmZvY3VzLC5uYXZiYXIgLm5hdj5saT5hOmhvdmVye2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7Y29sb3I6IzMzMzMzMzt0ZXh0LWRlY29yYXRpb246bm9uZTt9DQoubmF2YmFyIC5uYXY+LmFjdGl2ZT5hLC5uYXZiYXIgLm5hdj4uYWN0aXZlPmE6aG92ZXIsLm5hdmJhciAubmF2Pi5hY3RpdmU+YTpmb2N1c3tjb2xvcjojNTU1NTU1O3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtY29sb3I6I2U1ZTVlNTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAzcHggOHB4IHJnYmEoMCwgMCwgMCwgMC4xMjUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDNweCA4cHggcmdiYSgwLCAwLCAwLCAwLjEyNSk7Ym94LXNoYWRvdzppbnNldCAwIDNweCA4cHggcmdiYSgwLCAwLCAwLCAwLjEyNSk7fQ0KLm5hdmJhciAuYnRuLW5hdmJhcntkaXNwbGF5Om5vbmU7ZmxvYXQ6cmlnaHQ7cGFkZGluZzo3cHggMTBweDttYXJnaW4tbGVmdDo1cHg7bWFyZ2luLXJpZ2h0OjVweDtjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojZWRlZGVkO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZjJmMmYyLCAjZTVlNWU1KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZjJmMmYyKSwgdG8oI2U1ZTVlNSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZjJmMmYyLCAjZTVlNWU1KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNmMmYyZjIsICNlNWU1ZTUpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2YyZjJmMiwgI2U1ZTVlNSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZmMmYyZjInLCBlbmRDb2xvcnN0cj0nI2ZmZTVlNWU1JywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojZTVlNWU1ICNlNWU1ZTUgI2JmYmZiZjtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiNlNWU1ZTU7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjA3NSk7LW1vei1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMSksIDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMDc1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMSksIDAgMXB4IDAgcmdiYSgyNTUsMjU1LDI1NSwuMDc1KTt9Lm5hdmJhciAuYnRuLW5hdmJhcjpob3ZlciwubmF2YmFyIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyIC5idG4tbmF2YmFyLmFjdGl2ZSwubmF2YmFyIC5idG4tbmF2YmFyLmRpc2FibGVkLC5uYXZiYXIgLmJ0bi1uYXZiYXJbZGlzYWJsZWRde2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1OypiYWNrZ3JvdW5kLWNvbG9yOiNkOWQ5ZDk7fQ0KLm5hdmJhciAuYnRuLW5hdmJhcjphY3RpdmUsLm5hdmJhciAuYnRuLW5hdmJhci5hY3RpdmV7YmFja2dyb3VuZC1jb2xvcjojY2NjY2NjIFw5O30NCi5uYXZiYXIgLmJ0bi1uYXZiYXIgLmljb24tYmFye2Rpc3BsYXk6YmxvY2s7d2lkdGg6MThweDtoZWlnaHQ6MnB4O2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTstd2Via2l0LWJvcmRlci1yYWRpdXM6MXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxcHg7Ym9yZGVyLXJhZGl1czoxcHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjI1KTstbW96LWJveC1zaGFkb3c6MCAxcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO2JveC1zaGFkb3c6MCAxcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO30NCi5idG4tbmF2YmFyIC5pY29uLWJhcisuaWNvbi1iYXJ7bWFyZ2luLXRvcDozcHg7fQ0KLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZXtjb250ZW50OicnO2Rpc3BsYXk6aW5saW5lLWJsb2NrO2JvcmRlci1sZWZ0OjdweCBzb2xpZCB0cmFuc3BhcmVudDtib3JkZXItcmlnaHQ6N3B4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1ib3R0b206N3B4IHNvbGlkICNjY2M7Ym9yZGVyLWJvdHRvbS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMik7cG9zaXRpb246YWJzb2x1dGU7dG9wOi03cHg7bGVmdDo5cHg7fQ0KLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51OmFmdGVye2NvbnRlbnQ6Jyc7ZGlzcGxheTppbmxpbmUtYmxvY2s7Ym9yZGVyLWxlZnQ6NnB4IHNvbGlkIHRyYW5zcGFyZW50O2JvcmRlci1yaWdodDo2cHggc29saWQgdHJhbnNwYXJlbnQ7Ym9yZGVyLWJvdHRvbTo2cHggc29saWQgI2ZmZmZmZjtwb3NpdGlvbjphYnNvbHV0ZTt0b3A6LTZweDtsZWZ0OjEwcHg7fQ0KLm5hdmJhci1maXhlZC1ib3R0b20gLm5hdj5saT4uZHJvcGRvd24tbWVudTpiZWZvcmV7Ym9yZGVyLXRvcDo3cHggc29saWQgI2NjYztib3JkZXItdG9wLWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4yKTtib3JkZXItYm90dG9tOjA7Ym90dG9tOi03cHg7dG9wOmF1dG87fQ0KLm5hdmJhci1maXhlZC1ib3R0b20gLm5hdj5saT4uZHJvcGRvd24tbWVudTphZnRlcntib3JkZXItdG9wOjZweCBzb2xpZCAjZmZmZmZmO2JvcmRlci1ib3R0b206MDtib3R0b206LTZweDt0b3A6YXV0bzt9DQoubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlLC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZXtiYWNrZ3JvdW5kLWNvbG9yOiNlNWU1ZTU7Y29sb3I6IzU1NTU1NTt9DQoubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojNzc3Nzc3O2JvcmRlci1ib3R0b20tY29sb3I6Izc3Nzc3Nzt9DQoubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldCwubmF2YmFyIC5uYXYgbGkuZHJvcGRvd24uYWN0aXZlPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0LC5uYXZiYXIgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldHtib3JkZXItdG9wLWNvbG9yOiM1NTU1NTU7Ym9yZGVyLWJvdHRvbS1jb2xvcjojNTU1NTU1O30NCi5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHR7bGVmdDphdXRvO3JpZ2h0OjA7fS5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnU6YmVmb3JlLC5uYXZiYXIgLm5hdj5saT4uZHJvcGRvd24tbWVudS5wdWxsLXJpZ2h0OmJlZm9yZXtsZWZ0OmF1dG87cmlnaHQ6MTJweDt9DQoubmF2YmFyIC5wdWxsLXJpZ2h0PmxpPi5kcm9wZG93bi1tZW51OmFmdGVyLC5uYXZiYXIgLm5hdj5saT4uZHJvcGRvd24tbWVudS5wdWxsLXJpZ2h0OmFmdGVye2xlZnQ6YXV0bztyaWdodDoxM3B4O30NCi5uYXZiYXIgLnB1bGwtcmlnaHQ+bGk+LmRyb3Bkb3duLW1lbnUgLmRyb3Bkb3duLW1lbnUsLm5hdmJhciAubmF2PmxpPi5kcm9wZG93bi1tZW51LnB1bGwtcmlnaHQgLmRyb3Bkb3duLW1lbnV7bGVmdDphdXRvO3JpZ2h0OjEwMCU7bWFyZ2luLWxlZnQ6MDttYXJnaW4tcmlnaHQ6LTFweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDtib3JkZXItcmFkaXVzOjZweCAwIDZweCA2cHg7fQ0KLm5hdmJhci1pbnZlcnNle2NvbG9yOiM5OTk5OTk7fS5uYXZiYXItaW52ZXJzZSAubmF2YmFyLWlubmVye2JhY2tncm91bmQtY29sb3I6IzFiMWIxYjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzIyMjIyMiwgIzExMTExMSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzIyMjIyMiksIHRvKCMxMTExMTEpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzIyMjIyMiwgIzExMTExMSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjMjIyMjIyLCAjMTExMTExKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICMyMjIyMjIsICMxMTExMTEpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmMjIyMjIyJywgZW5kQ29sb3JzdHI9JyNmZjExMTExMScsIEdyYWRpZW50VHlwZT0wKTtib3JkZXItY29sb3I6IzI1MjUyNTt9DQoubmF2YmFyLWludmVyc2UgLmJyYW5kLC5uYXZiYXItaW52ZXJzZSAubmF2PmxpPmF7Y29sb3I6Izk5OTk5OTt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO30ubmF2YmFyLWludmVyc2UgLmJyYW5kOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2PmxpPmE6aG92ZXJ7Y29sb3I6I2ZmZmZmZjt9DQoubmF2YmFyLWludmVyc2UgLm5hdj5saT5hOmZvY3VzLC5uYXZiYXItaW52ZXJzZSAubmF2PmxpPmE6aG92ZXJ7YmFja2dyb3VuZC1jb2xvcjp0cmFuc3BhcmVudDtjb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAubmF2IC5hY3RpdmU+YSwubmF2YmFyLWludmVyc2UgLm5hdiAuYWN0aXZlPmE6aG92ZXIsLm5hdmJhci1pbnZlcnNlIC5uYXYgLmFjdGl2ZT5hOmZvY3Vze2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojMTExMTExO30NCi5uYXZiYXItaW52ZXJzZSAubmF2YmFyLWxpbmt7Y29sb3I6Izk5OTk5OTt9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItbGluazpob3Zlcntjb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAuZGl2aWRlci12ZXJ0aWNhbHtib3JkZXItbGVmdC1jb2xvcjojMTExMTExO2JvcmRlci1yaWdodC1jb2xvcjojMjIyMjIyO30NCi5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duLm9wZW4+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSwubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5vcGVuLmFjdGl2ZT4uZHJvcGRvd24tdG9nZ2xle2JhY2tncm91bmQtY29sb3I6IzExMTExMTtjb2xvcjojZmZmZmZmO30NCi5uYXZiYXItaW52ZXJzZSAubmF2IGxpLmRyb3Bkb3duPi5kcm9wZG93bi10b2dnbGUgLmNhcmV0e2JvcmRlci10b3AtY29sb3I6Izk5OTk5OTtib3JkZXItYm90dG9tLWNvbG9yOiM5OTk5OTk7fQ0KLm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24ub3Blbj4uZHJvcGRvd24tdG9nZ2xlIC5jYXJldCwubmF2YmFyLWludmVyc2UgLm5hdiBsaS5kcm9wZG93bi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXQsLm5hdmJhci1pbnZlcnNlIC5uYXYgbGkuZHJvcGRvd24ub3Blbi5hY3RpdmU+LmRyb3Bkb3duLXRvZ2dsZSAuY2FyZXR7Ym9yZGVyLXRvcC1jb2xvcjojZmZmZmZmO2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZmZmZjt9DQoubmF2YmFyLWludmVyc2UgLm5hdmJhci1zZWFyY2ggLnNlYXJjaC1xdWVyeXtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6IzUxNTE1MTtib3JkZXItY29sb3I6IzExMTExMTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjE1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwwLDAsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjE1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsMCwwLC4xKSwgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xNSk7LXdlYmtpdC10cmFuc2l0aW9uOm5vbmU7LW1vei10cmFuc2l0aW9uOm5vbmU7LW8tdHJhbnNpdGlvbjpub25lO3RyYW5zaXRpb246bm9uZTt9Lm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6LW1vei1wbGFjZWhvbGRlcntjb2xvcjojY2NjY2NjO30NCi5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5Oi1tcy1pbnB1dC1wbGFjZWhvbGRlcntjb2xvcjojY2NjY2NjO30NCi5uYXZiYXItaW52ZXJzZSAubmF2YmFyLXNlYXJjaCAuc2VhcmNoLXF1ZXJ5Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiNjY2NjY2M7fQ0KLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnk6Zm9jdXMsLm5hdmJhci1pbnZlcnNlIC5uYXZiYXItc2VhcmNoIC5zZWFyY2gtcXVlcnkuZm9jdXNlZHtwYWRkaW5nOjVweCAxNXB4O2NvbG9yOiMzMzMzMzM7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmZmZmO2JhY2tncm91bmQtY29sb3I6I2ZmZmZmZjtib3JkZXI6MDstd2Via2l0LWJveC1zaGFkb3c6MCAwIDNweCByZ2JhKDAsIDAsIDAsIDAuMTUpOy1tb3otYm94LXNoYWRvdzowIDAgM3B4IHJnYmEoMCwgMCwgMCwgMC4xNSk7Ym94LXNoYWRvdzowIDAgM3B4IHJnYmEoMCwgMCwgMCwgMC4xNSk7b3V0bGluZTowO30NCi5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhcntjb2xvcjojZmZmZmZmO3RleHQtc2hhZG93OjAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4yNSk7YmFja2dyb3VuZC1jb2xvcjojMGUwZTBlO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjMTUxNTE1LCAjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjMTUxNTE1KSwgdG8oIzA0MDQwNCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjMTUxNTE1LCAjMDQwNDA0KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICMxNTE1MTUsICMwNDA0MDQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgIzE1MTUxNSwgIzA0MDQwNCk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmYxNTE1MTUnLCBlbmRDb2xvcnN0cj0nI2ZmMDQwNDA0JywgR3JhZGllbnRUeXBlPTApO2JvcmRlci1jb2xvcjojMDQwNDA0ICMwNDA0MDQgIzAwMDAwMDtib3JkZXItY29sb3I6cmdiYSgwLCAwLCAwLCAwLjEpIHJnYmEoMCwgMCwgMCwgMC4xKSByZ2JhKDAsIDAsIDAsIDAuMjUpOypiYWNrZ3JvdW5kLWNvbG9yOiMwNDA0MDQ7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChlbmFibGVkID0gZmFsc2UpO30ubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXI6aG92ZXIsLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXIuYWN0aXZlLC5uYXZiYXItaW52ZXJzZSAuYnRuLW5hdmJhci5kaXNhYmxlZCwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXJbZGlzYWJsZWRde2NvbG9yOiNmZmZmZmY7YmFja2dyb3VuZC1jb2xvcjojMDQwNDA0OypiYWNrZ3JvdW5kLWNvbG9yOiMwMDAwMDA7fQ0KLm5hdmJhci1pbnZlcnNlIC5idG4tbmF2YmFyOmFjdGl2ZSwubmF2YmFyLWludmVyc2UgLmJ0bi1uYXZiYXIuYWN0aXZle2JhY2tncm91bmQtY29sb3I6IzAwMDAwMCBcOTt9DQouYnJlYWRjcnVtYntwYWRkaW5nOjhweCAxNXB4O21hcmdpbjowIDAgMjBweDtsaXN0LXN0eWxlOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9LmJyZWFkY3J1bWIgbGl7ZGlzcGxheTppbmxpbmUtYmxvY2s7KmRpc3BsYXk6aW5saW5lOyp6b29tOjE7dGV4dC1zaGFkb3c6MCAxcHggMCAjZmZmZmZmO30NCi5icmVhZGNydW1iIC5kaXZpZGVye3BhZGRpbmc6MCA1cHg7Y29sb3I6I2NjYzt9DQouYnJlYWRjcnVtYiAuYWN0aXZle2NvbG9yOiM5OTk5OTk7fQ0KLnBhZ2luYXRpb257bWFyZ2luOjIwcHggMDt9DQoucGFnaW5hdGlvbiB1bHtkaXNwbGF5OmlubGluZS1ibG9jazsqZGlzcGxheTppbmxpbmU7Knpvb206MTttYXJnaW4tbGVmdDowO21hcmdpbi1ib3R0b206MDstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7LXdlYmtpdC1ib3gtc2hhZG93OjAgMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMDUpOy1tb3otYm94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLCAwLCAwLCAwLjA1KTtib3gtc2hhZG93OjAgMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMDUpO30NCi5wYWdpbmF0aW9uIHVsPmxpe2Rpc3BsYXk6aW5saW5lO30NCi5wYWdpbmF0aW9uIHVsPmxpPmEsLnBhZ2luYXRpb24gdWw+bGk+c3BhbntmbG9hdDpsZWZ0O3BhZGRpbmc6NHB4IDEycHg7bGluZS1oZWlnaHQ6MjBweDt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmZmZmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZGRkZGRkO2JvcmRlci1sZWZ0LXdpZHRoOjA7fQ0KLnBhZ2luYXRpb24gdWw+bGk+YTpob3ZlciwucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNTt9DQoucGFnaW5hdGlvbiB1bD4uYWN0aXZlPmEsLnBhZ2luYXRpb24gdWw+LmFjdGl2ZT5zcGFue2NvbG9yOiM5OTk5OTk7Y3Vyc29yOmRlZmF1bHQ7fQ0KLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPnNwYW4sLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmEsLnBhZ2luYXRpb24gdWw+LmRpc2FibGVkPmE6aG92ZXJ7Y29sb3I6Izk5OTk5OTtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2N1cnNvcjpkZWZhdWx0O30NCi5wYWdpbmF0aW9uIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24gdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbntib3JkZXItbGVmdC13aWR0aDoxcHg7LXdlYmtpdC1ib3JkZXItdG9wLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wbGVmdDo0cHg7Ym9yZGVyLXRvcC1sZWZ0LXJhZGl1czo0cHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tbGVmdDo0cHg7Ym9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czo0cHg7fQ0KLnBhZ2luYXRpb24gdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uIHVsPmxpOmxhc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtdG9wcmlnaHQ6NHB4O2JvcmRlci10b3AtcmlnaHQtcmFkaXVzOjRweDstd2Via2l0LWJvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXMtYm90dG9tcmlnaHQ6NHB4O2JvcmRlci1ib3R0b20tcmlnaHQtcmFkaXVzOjRweDt9DQoucGFnaW5hdGlvbi1jZW50ZXJlZHt0ZXh0LWFsaWduOmNlbnRlcjt9DQoucGFnaW5hdGlvbi1yaWdodHt0ZXh0LWFsaWduOnJpZ2h0O30NCi5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk+c3BhbntwYWRkaW5nOjExcHggMTlweDtmb250LXNpemU6MTcuNXB4O30NCi5wYWdpbmF0aW9uLWxhcmdlIHVsPmxpOmZpcnN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6Zmlyc3QtY2hpbGQ+c3Bhbnstd2Via2l0LWJvcmRlci10b3AtbGVmdC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3BsZWZ0OjZweDtib3JkZXItdG9wLWxlZnQtcmFkaXVzOjZweDstd2Via2l0LWJvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21sZWZ0OjZweDtib3JkZXItYm90dG9tLWxlZnQtcmFkaXVzOjZweDt9DQoucGFnaW5hdGlvbi1sYXJnZSB1bD5saTpsYXN0LWNoaWxkPmEsLnBhZ2luYXRpb24tbGFyZ2UgdWw+bGk6bGFzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy10b3ByaWdodDo2cHg7Ym9yZGVyLXRvcC1yaWdodC1yYWRpdXM6NnB4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1cy1ib3R0b21yaWdodDo2cHg7Ym9yZGVyLWJvdHRvbS1yaWdodC1yYWRpdXM6NnB4O30NCi5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6Zmlyc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpmaXJzdC1jaGlsZD5zcGFuey13ZWJraXQtYm9yZGVyLXRvcC1sZWZ0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcGxlZnQ6M3B4O2JvcmRlci10b3AtbGVmdC1yYWRpdXM6M3B4Oy13ZWJraXQtYm9yZGVyLWJvdHRvbS1sZWZ0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbWxlZnQ6M3B4O2JvcmRlci1ib3R0b20tbGVmdC1yYWRpdXM6M3B4O30NCi5wYWdpbmF0aW9uLW1pbmkgdWw+bGk6bGFzdC1jaGlsZD5hLC5wYWdpbmF0aW9uLXNtYWxsIHVsPmxpOmxhc3QtY2hpbGQ+YSwucGFnaW5hdGlvbi1taW5pIHVsPmxpOmxhc3QtY2hpbGQ+c3BhbiwucGFnaW5hdGlvbi1zbWFsbCB1bD5saTpsYXN0LWNoaWxkPnNwYW57LXdlYmtpdC1ib3JkZXItdG9wLXJpZ2h0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLXRvcHJpZ2h0OjNweDtib3JkZXItdG9wLXJpZ2h0LXJhZGl1czozcHg7LXdlYmtpdC1ib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czozcHg7LW1vei1ib3JkZXItcmFkaXVzLWJvdHRvbXJpZ2h0OjNweDtib3JkZXItYm90dG9tLXJpZ2h0LXJhZGl1czozcHg7fQ0KLnBhZ2luYXRpb24tc21hbGwgdWw+bGk+YSwucGFnaW5hdGlvbi1zbWFsbCB1bD5saT5zcGFue3BhZGRpbmc6MnB4IDEwcHg7Zm9udC1zaXplOjExLjlweDt9DQoucGFnaW5hdGlvbi1taW5pIHVsPmxpPmEsLnBhZ2luYXRpb24tbWluaSB1bD5saT5zcGFue3BhZGRpbmc6MXB4IDZweDtmb250LXNpemU6MTAuNXB4O30NCi5wYWdlcnttYXJnaW46MjBweCAwO2xpc3Qtc3R5bGU6bm9uZTt0ZXh0LWFsaWduOmNlbnRlcjsqem9vbToxO30ucGFnZXI6YmVmb3JlLC5wYWdlcjphZnRlcntkaXNwbGF5OnRhYmxlO2NvbnRlbnQ6IiI7bGluZS1oZWlnaHQ6MDt9DQoucGFnZXI6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQoucGFnZXIgbGl7ZGlzcGxheTppbmxpbmU7fQ0KLnBhZ2VyIGxpPmEsLnBhZ2VyIGxpPnNwYW57ZGlzcGxheTppbmxpbmUtYmxvY2s7cGFkZGluZzo1cHggMTRweDtiYWNrZ3JvdW5kLWNvbG9yOiNmZmY7Ym9yZGVyOjFweCBzb2xpZCAjZGRkOy13ZWJraXQtYm9yZGVyLXJhZGl1czoxNXB4Oy1tb3otYm9yZGVyLXJhZGl1czoxNXB4O2JvcmRlci1yYWRpdXM6MTVweDt9DQoucGFnZXIgbGk+YTpob3Zlcnt0ZXh0LWRlY29yYXRpb246bm9uZTtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7fQ0KLnBhZ2VyIC5uZXh0PmEsLnBhZ2VyIC5uZXh0PnNwYW57ZmxvYXQ6cmlnaHQ7fQ0KLnBhZ2VyIC5wcmV2aW91cz5hLC5wYWdlciAucHJldmlvdXM+c3BhbntmbG9hdDpsZWZ0O30NCi5wYWdlciAuZGlzYWJsZWQ+YSwucGFnZXIgLmRpc2FibGVkPmE6aG92ZXIsLnBhZ2VyIC5kaXNhYmxlZD5zcGFue2NvbG9yOiM5OTk5OTk7YmFja2dyb3VuZC1jb2xvcjojZmZmO2N1cnNvcjpkZWZhdWx0O30NCi50aHVtYm5haWxze21hcmdpbi1sZWZ0Oi0yMHB4O2xpc3Qtc3R5bGU6bm9uZTsqem9vbToxO30udGh1bWJuYWlsczpiZWZvcmUsLnRodW1ibmFpbHM6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLnRodW1ibmFpbHM6YWZ0ZXJ7Y2xlYXI6Ym90aDt9DQoucm93LWZsdWlkIC50aHVtYm5haWxze21hcmdpbi1sZWZ0OjA7fQ0KLnRodW1ibmFpbHM+bGl7ZmxvYXQ6bGVmdDttYXJnaW4tYm90dG9tOjIwcHg7bWFyZ2luLWxlZnQ6MjBweDt9DQoudGh1bWJuYWlse2Rpc3BsYXk6YmxvY2s7cGFkZGluZzo0cHg7bGluZS1oZWlnaHQ6MjBweDtib3JkZXI6MXB4IHNvbGlkICNkZGQ7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDFweCAzcHggcmdiYSgwLCAwLCAwLCAwLjA1NSk7LW1vei1ib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMDU1KTtib3gtc2hhZG93OjAgMXB4IDNweCByZ2JhKDAsIDAsIDAsIDAuMDU1KTstd2Via2l0LXRyYW5zaXRpb246YWxsIDAuMnMgZWFzZS1pbi1vdXQ7LW1vei10cmFuc2l0aW9uOmFsbCAwLjJzIGVhc2UtaW4tb3V0Oy1vLXRyYW5zaXRpb246YWxsIDAuMnMgZWFzZS1pbi1vdXQ7dHJhbnNpdGlvbjphbGwgMC4ycyBlYXNlLWluLW91dDt9DQphLnRodW1ibmFpbDpob3Zlcntib3JkZXItY29sb3I6IzAwODhjYzstd2Via2l0LWJveC1zaGFkb3c6MCAxcHggNHB4IHJnYmEoMCwgMTA1LCAyMTQsIDAuMjUpOy1tb3otYm94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLCAxMDUsIDIxNCwgMC4yNSk7Ym94LXNoYWRvdzowIDFweCA0cHggcmdiYSgwLCAxMDUsIDIxNCwgMC4yNSk7fQ0KLnRodW1ibmFpbD5pbWd7ZGlzcGxheTpibG9jazttYXgtd2lkdGg6MTAwJTttYXJnaW4tbGVmdDphdXRvO21hcmdpbi1yaWdodDphdXRvO30NCi50aHVtYm5haWwgLmNhcHRpb257cGFkZGluZzo5cHg7Y29sb3I6IzU1NTU1NTt9DQouYWxlcnR7cGFkZGluZzo4cHggMzVweCA4cHggMTRweDttYXJnaW4tYm90dG9tOjIwcHg7dGV4dC1zaGFkb3c6MCAxcHggMCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuNSk7YmFja2dyb3VuZC1jb2xvcjojZmNmOGUzO2JvcmRlcjoxcHggc29saWQgI2ZiZWVkNTstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7Y29sb3I6I2MwOTg1Mzt9DQouYWxlcnQgaDR7bWFyZ2luOjA7fQ0KLmFsZXJ0IC5jbG9zZXtwb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LTJweDtyaWdodDotMjFweDtsaW5lLWhlaWdodDoyMHB4O30NCi5hbGVydC1zdWNjZXNze2JhY2tncm91bmQtY29sb3I6I2RmZjBkODtib3JkZXItY29sb3I6I2Q2ZTljNjtjb2xvcjojNDY4ODQ3O30NCi5hbGVydC1kYW5nZXIsLmFsZXJ0LWVycm9ye2JhY2tncm91bmQtY29sb3I6I2YyZGVkZTtib3JkZXItY29sb3I6I2VlZDNkNztjb2xvcjojYjk0YTQ4O30NCi5hbGVydC1pbmZve2JhY2tncm91bmQtY29sb3I6I2Q5ZWRmNztib3JkZXItY29sb3I6I2JjZThmMTtjb2xvcjojM2E4N2FkO30NCi5hbGVydC1ibG9ja3twYWRkaW5nLXRvcDoxNHB4O3BhZGRpbmctYm90dG9tOjE0cHg7fQ0KLmFsZXJ0LWJsb2NrPnAsLmFsZXJ0LWJsb2NrPnVse21hcmdpbi1ib3R0b206MDt9DQouYWxlcnQtYmxvY2sgcCtwe21hcmdpbi10b3A6NXB4O30NCkAtd2Via2l0LWtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246NDBweCAwO30gdG97YmFja2dyb3VuZC1wb3NpdGlvbjowIDA7fX1ALW1vei1rZXlmcmFtZXMgcHJvZ3Jlc3MtYmFyLXN0cmlwZXN7ZnJvbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOjQwcHggMDt9IHRve2JhY2tncm91bmQtcG9zaXRpb246MCAwO319QC1tcy1rZXlmcmFtZXMgcHJvZ3Jlc3MtYmFyLXN0cmlwZXN7ZnJvbXtiYWNrZ3JvdW5kLXBvc2l0aW9uOjQwcHggMDt9IHRve2JhY2tncm91bmQtcG9zaXRpb246MCAwO319QC1vLWtleWZyYW1lcyBwcm9ncmVzcy1iYXItc3RyaXBlc3tmcm9te2JhY2tncm91bmQtcG9zaXRpb246MCAwO30gdG97YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDA7fX1Aa2V5ZnJhbWVzIHByb2dyZXNzLWJhci1zdHJpcGVze2Zyb217YmFja2dyb3VuZC1wb3NpdGlvbjo0MHB4IDA7fSB0b3tiYWNrZ3JvdW5kLXBvc2l0aW9uOjAgMDt9fS5wcm9ncmVzc3tvdmVyZmxvdzpoaWRkZW47aGVpZ2h0OjIwcHg7bWFyZ2luLWJvdHRvbToyMHB4O2JhY2tncm91bmQtY29sb3I6I2Y3ZjdmNztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgI2Y1ZjVmNSwgI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oI2Y1ZjVmNSksIHRvKCNmOWY5ZjkpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgI2Y1ZjVmNSwgI2Y5ZjlmOSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjZjVmNWY1LCAjZjlmOWY5KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICNmNWY1ZjUsICNmOWY5ZjkpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZjVmNWY1JywgZW5kQ29sb3JzdHI9JyNmZmY5ZjlmOScsIEdyYWRpZW50VHlwZT0wKTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xKTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMnB4IHJnYmEoMCwgMCwgMCwgMC4xKTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDJweCByZ2JhKDAsIDAsIDAsIDAuMSk7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjRweDstbW96LWJvcmRlci1yYWRpdXM6NHB4O2JvcmRlci1yYWRpdXM6NHB4O30NCi5wcm9ncmVzcyAuYmFye3dpZHRoOjAlO2hlaWdodDoxMDAlO2NvbG9yOiNmZmZmZmY7ZmxvYXQ6bGVmdDtmb250LXNpemU6MTJweDt0ZXh0LWFsaWduOmNlbnRlcjt0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsIDAsIDAsIDAuMjUpO2JhY2tncm91bmQtY29sb3I6IzBlOTBkMjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzE0OWJkZiwgIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzE0OWJkZiksIHRvKCMwNDgwYmUpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzE0OWJkZiwgIzA0ODBiZSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjMTQ5YmRmLCAjMDQ4MGJlKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICMxNDliZGYsICMwNDgwYmUpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmMTQ5YmRmJywgZW5kQ29sb3JzdHI9JyNmZjA0ODBiZScsIEdyYWRpZW50VHlwZT0wKTstd2Via2l0LWJveC1zaGFkb3c6aW5zZXQgMCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjE1KTstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAtMXB4IDAgcmdiYSgwLCAwLCAwLCAwLjE1KTtib3gtc2hhZG93Omluc2V0IDAgLTFweCAwIHJnYmEoMCwgMCwgMCwgMC4xNSk7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94Oy13ZWJraXQtdHJhbnNpdGlvbjp3aWR0aCAwLjZzIGVhc2U7LW1vei10cmFuc2l0aW9uOndpZHRoIDAuNnMgZWFzZTstby10cmFuc2l0aW9uOndpZHRoIDAuNnMgZWFzZTt0cmFuc2l0aW9uOndpZHRoIDAuNnMgZWFzZTt9DQoucHJvZ3Jlc3MgLmJhcisuYmFyey13ZWJraXQtYm94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMCwwLDAsLjE1KSwgaW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwuMTUpOy1tb3otYm94LXNoYWRvdzppbnNldCAxcHggMCAwIHJnYmEoMCwwLDAsLjE1KSwgaW5zZXQgMCAtMXB4IDAgcmdiYSgwLDAsMCwuMTUpO2JveC1zaGFkb3c6aW5zZXQgMXB4IDAgMCByZ2JhKDAsMCwwLC4xNSksIGluc2V0IDAgLTFweCAwIHJnYmEoMCwwLDAsLjE1KTt9DQoucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFye2JhY2tncm91bmQtY29sb3I6IzE0OWJkZjtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDEwMCUsIDEwMCUgMCwgY29sb3Itc3RvcCgwLjI1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjI1LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCB0cmFuc3BhcmVudCksIHRvKHRyYW5zcGFyZW50KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7LXdlYmtpdC1iYWNrZ3JvdW5kLXNpemU6NDBweCA0MHB4Oy1tb3otYmFja2dyb3VuZC1zaXplOjQwcHggNDBweDstby1iYWNrZ3JvdW5kLXNpemU6NDBweCA0MHB4O2JhY2tncm91bmQtc2l6ZTo0MHB4IDQwcHg7fQ0KLnByb2dyZXNzLmFjdGl2ZSAuYmFyey13ZWJraXQtYW5pbWF0aW9uOnByb2dyZXNzLWJhci1zdHJpcGVzIDJzIGxpbmVhciBpbmZpbml0ZTstbW96LWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7LW1zLWFuaW1hdGlvbjpwcm9ncmVzcy1iYXItc3RyaXBlcyAycyBsaW5lYXIgaW5maW5pdGU7LW8tYW5pbWF0aW9uOnByb2dyZXNzLWJhci1zdHJpcGVzIDJzIGxpbmVhciBpbmZpbml0ZTthbmltYXRpb246cHJvZ3Jlc3MtYmFyLXN0cmlwZXMgMnMgbGluZWFyIGluZmluaXRlO30NCi5wcm9ncmVzcy1kYW5nZXIgLmJhciwucHJvZ3Jlc3MgLmJhci1kYW5nZXJ7YmFja2dyb3VuZC1jb2xvcjojZGQ1MTRjO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCAjZWU1ZjViLCAjYzQzYzM1KTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDAsIDAgMTAwJSwgZnJvbSgjZWU1ZjViKSwgdG8oI2M0M2MzNSkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCAjZWU1ZjViLCAjYzQzYzM1KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsICNlZTVmNWIsICNjNDNjMzUpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvIGJvdHRvbSwgI2VlNWY1YiwgI2M0M2MzNSk7YmFja2dyb3VuZC1yZXBlYXQ6cmVwZWF0LXg7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZmZlZTVmNWInLCBlbmRDb2xvcnN0cj0nI2ZmYzQzYzM1JywgR3JhZGllbnRUeXBlPTApO30NCi5wcm9ncmVzcy1kYW5nZXIucHJvZ3Jlc3Mtc3RyaXBlZCAuYmFyLC5wcm9ncmVzcy1zdHJpcGVkIC5iYXItZGFuZ2Vye2JhY2tncm91bmQtY29sb3I6I2VlNWY1YjtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDEwMCUsIDEwMCUgMCwgY29sb3Itc3RvcCgwLjI1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjI1LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCB0cmFuc3BhcmVudCksIHRvKHRyYW5zcGFyZW50KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7fQ0KLnByb2dyZXNzLXN1Y2Nlc3MgLmJhciwucHJvZ3Jlc3MgLmJhci1zdWNjZXNze2JhY2tncm91bmQtY29sb3I6IzVlYjk1ZTtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzYyYzQ2MiwgIzU3YTk1Nyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzYyYzQ2MiksIHRvKCM1N2E5NTcpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzYyYzQ2MiwgIzU3YTk1Nyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjNjJjNDYyLCAjNTdhOTU3KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICM2MmM0NjIsICM1N2E5NTcpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNjJjNDYyJywgZW5kQ29sb3JzdHI9JyNmZjU3YTk1NycsIEdyYWRpZW50VHlwZT0wKTt9DQoucHJvZ3Jlc3Mtc3VjY2Vzcy5wcm9ncmVzcy1zdHJpcGVkIC5iYXIsLnByb2dyZXNzLXN0cmlwZWQgLmJhci1zdWNjZXNze2JhY2tncm91bmQtY29sb3I6IzYyYzQ2MjtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDEwMCUsIDEwMCUgMCwgY29sb3Itc3RvcCgwLjI1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjI1LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCB0cmFuc3BhcmVudCksIHRvKHRyYW5zcGFyZW50KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7fQ0KLnByb2dyZXNzLWluZm8gLmJhciwucHJvZ3Jlc3MgLmJhci1pbmZve2JhY2tncm91bmQtY29sb3I6IzRiYjFjZjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzViYzBkZSwgIzMzOWJiOSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzViYzBkZSksIHRvKCMzMzliYjkpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzViYzBkZSwgIzMzOWJiOSk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjNWJjMGRlLCAjMzM5YmI5KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICM1YmMwZGUsICMzMzliYjkpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmNWJjMGRlJywgZW5kQ29sb3JzdHI9JyNmZjMzOWJiOScsIEdyYWRpZW50VHlwZT0wKTt9DQoucHJvZ3Jlc3MtaW5mby5wcm9ncmVzcy1zdHJpcGVkIC5iYXIsLnByb2dyZXNzLXN0cmlwZWQgLmJhci1pbmZve2JhY2tncm91bmQtY29sb3I6IzViYzBkZTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDEwMCUsIDEwMCUgMCwgY29sb3Itc3RvcCgwLjI1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjI1LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCB0cmFuc3BhcmVudCksIHRvKHRyYW5zcGFyZW50KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7fQ0KLnByb2dyZXNzLXdhcm5pbmcgLmJhciwucHJvZ3Jlc3MgLmJhci13YXJuaW5ne2JhY2tncm91bmQtY29sb3I6I2ZhYTczMjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgI2ZiYjQ1MCwgI2Y4OTQwNik7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oI2ZiYjQ1MCksIHRvKCNmODk0MDYpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgI2ZiYjQ1MCwgI2Y4OTQwNik7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjZmJiNDUwLCAjZjg5NDA2KTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICNmYmI0NTAsICNmODk0MDYpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmZmJiNDUwJywgZW5kQ29sb3JzdHI9JyNmZmY4OTQwNicsIEdyYWRpZW50VHlwZT0wKTt9DQoucHJvZ3Jlc3Mtd2FybmluZy5wcm9ncmVzcy1zdHJpcGVkIC5iYXIsLnByb2dyZXNzLXN0cmlwZWQgLmJhci13YXJuaW5ne2JhY2tncm91bmQtY29sb3I6I2ZiYjQ1MDtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLCAwIDEwMCUsIDEwMCUgMCwgY29sb3Itc3RvcCgwLjI1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjI1LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCB0cmFuc3BhcmVudCksIGNvbG9yLXN0b3AoMC41LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpKSwgY29sb3Itc3RvcCgwLjc1LCB0cmFuc3BhcmVudCksIHRvKHRyYW5zcGFyZW50KSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQoNDVkZWcsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgMjUlLCB0cmFuc3BhcmVudCAyNSUsIHRyYW5zcGFyZW50IDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNzUlLCB0cmFuc3BhcmVudCA3NSUsIHRyYW5zcGFyZW50KTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCg0NWRlZywgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSAyNSUsIHRyYW5zcGFyZW50IDI1JSwgdHJhbnNwYXJlbnQgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDUwJSwgcmdiYSgyNTUsIDI1NSwgMjU1LCAwLjE1KSA3NSUsIHRyYW5zcGFyZW50IDc1JSwgdHJhbnNwYXJlbnQpO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KDQ1ZGVnLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDI1JSwgdHJhbnNwYXJlbnQgMjUlLCB0cmFuc3BhcmVudCA1MCUsIHJnYmEoMjU1LCAyNTUsIDI1NSwgMC4xNSkgNTAlLCByZ2JhKDI1NSwgMjU1LCAyNTUsIDAuMTUpIDc1JSwgdHJhbnNwYXJlbnQgNzUlLCB0cmFuc3BhcmVudCk7fQ0KLmhlcm8tdW5pdHtwYWRkaW5nOjYwcHg7bWFyZ2luLWJvdHRvbTozMHB4O2ZvbnQtc2l6ZToxOHB4O2ZvbnQtd2VpZ2h0OjIwMDtsaW5lLWhlaWdodDozMHB4O2NvbG9yOmluaGVyaXQ7YmFja2dyb3VuZC1jb2xvcjojZWVlZWVlOy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDt9Lmhlcm8tdW5pdCBoMXttYXJnaW4tYm90dG9tOjA7Zm9udC1zaXplOjYwcHg7bGluZS1oZWlnaHQ6MTtjb2xvcjppbmhlcml0O2xldHRlci1zcGFjaW5nOi0xcHg7fQ0KLmhlcm8tdW5pdCBsaXtsaW5lLWhlaWdodDozMHB4O30NCi5tZWRpYSwubWVkaWEtYm9keXtvdmVyZmxvdzpoaWRkZW47Km92ZXJmbG93OnZpc2libGU7em9vbToxO30NCi5tZWRpYSwubWVkaWEgLm1lZGlhe21hcmdpbi10b3A6MTVweDt9DQoubWVkaWE6Zmlyc3QtY2hpbGR7bWFyZ2luLXRvcDowO30NCi5tZWRpYS1vYmplY3R7ZGlzcGxheTpibG9jazt9DQoubWVkaWEtaGVhZGluZ3ttYXJnaW46MCAwIDVweDt9DQoubWVkaWEgLnB1bGwtbGVmdHttYXJnaW4tcmlnaHQ6MTBweDt9DQoubWVkaWEgLnB1bGwtcmlnaHR7bWFyZ2luLWxlZnQ6MTBweDt9DQoubWVkaWEtbGlzdHttYXJnaW4tbGVmdDowO2xpc3Qtc3R5bGU6bm9uZTt9DQoudG9vbHRpcHtwb3NpdGlvbjphYnNvbHV0ZTt6LWluZGV4OjEwMzA7ZGlzcGxheTpibG9jazt2aXNpYmlsaXR5OnZpc2libGU7cGFkZGluZzo1cHg7Zm9udC1zaXplOjExcHg7b3BhY2l0eTowO2ZpbHRlcjphbHBoYShvcGFjaXR5PTApO30udG9vbHRpcC5pbntvcGFjaXR5OjAuODtmaWx0ZXI6YWxwaGEob3BhY2l0eT04MCk7fQ0KLnRvb2x0aXAudG9we21hcmdpbi10b3A6LTNweDt9DQoudG9vbHRpcC5yaWdodHttYXJnaW4tbGVmdDozcHg7fQ0KLnRvb2x0aXAuYm90dG9te21hcmdpbi10b3A6M3B4O30NCi50b29sdGlwLmxlZnR7bWFyZ2luLWxlZnQ6LTNweDt9DQoudG9vbHRpcC1pbm5lcnttYXgtd2lkdGg6MjAwcHg7cGFkZGluZzozcHggOHB4O2NvbG9yOiNmZmZmZmY7dGV4dC1hbGlnbjpjZW50ZXI7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojMDAwMDAwOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9DQoudG9vbHRpcC1hcnJvd3twb3NpdGlvbjphYnNvbHV0ZTt3aWR0aDowO2hlaWdodDowO2JvcmRlci1jb2xvcjp0cmFuc3BhcmVudDtib3JkZXItc3R5bGU6c29saWQ7fQ0KLnRvb2x0aXAudG9wIC50b29sdGlwLWFycm93e2JvdHRvbTowO2xlZnQ6NTAlO21hcmdpbi1sZWZ0Oi01cHg7Ym9yZGVyLXdpZHRoOjVweCA1cHggMDtib3JkZXItdG9wLWNvbG9yOiMwMDAwMDA7fQ0KLnRvb2x0aXAucmlnaHQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtsZWZ0OjA7bWFyZ2luLXRvcDotNXB4O2JvcmRlci13aWR0aDo1cHggNXB4IDVweCAwO2JvcmRlci1yaWdodC1jb2xvcjojMDAwMDAwO30NCi50b29sdGlwLmxlZnQgLnRvb2x0aXAtYXJyb3d7dG9wOjUwJTtyaWdodDowO21hcmdpbi10b3A6LTVweDtib3JkZXItd2lkdGg6NXB4IDAgNXB4IDVweDtib3JkZXItbGVmdC1jb2xvcjojMDAwMDAwO30NCi50b29sdGlwLmJvdHRvbSAudG9vbHRpcC1hcnJvd3t0b3A6MDtsZWZ0OjUwJTttYXJnaW4tbGVmdDotNXB4O2JvcmRlci13aWR0aDowIDVweCA1cHg7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMDAwMDAwO30NCi5wb3BvdmVye3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO2xlZnQ6MDt6LWluZGV4OjEwMTA7ZGlzcGxheTpub25lO3dpZHRoOjIzNnB4O3BhZGRpbmc6MXB4O2JhY2tncm91bmQtY29sb3I6I2ZmZmZmZjstd2Via2l0LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDstbW96LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nO2JhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDtib3JkZXI6MXB4IHNvbGlkICNjY2M7Ym9yZGVyOjFweCBzb2xpZCByZ2JhKDAsIDAsIDAsIDAuMik7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTstbW96LWJveC1zaGFkb3c6MCA1cHggMTBweCByZ2JhKDAsIDAsIDAsIDAuMik7Ym94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTt9LnBvcG92ZXIudG9we21hcmdpbi10b3A6LTEwcHg7fQ0KLnBvcG92ZXIucmlnaHR7bWFyZ2luLWxlZnQ6MTBweDt9DQoucG9wb3Zlci5ib3R0b217bWFyZ2luLXRvcDoxMHB4O30NCi5wb3BvdmVyLmxlZnR7bWFyZ2luLWxlZnQ6LTEwcHg7fQ0KLnBvcG92ZXItdGl0bGV7bWFyZ2luOjA7cGFkZGluZzo4cHggMTRweDtmb250LXNpemU6MTRweDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MThweDtiYWNrZ3JvdW5kLWNvbG9yOiNmN2Y3Zjc7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2ViZWJlYjstd2Via2l0LWJvcmRlci1yYWRpdXM6NXB4IDVweCAwIDA7LW1vei1ib3JkZXItcmFkaXVzOjVweCA1cHggMCAwO2JvcmRlci1yYWRpdXM6NXB4IDVweCAwIDA7fQ0KLnBvcG92ZXItY29udGVudHtwYWRkaW5nOjlweCAxNHB4O30ucG9wb3Zlci1jb250ZW50IHAsLnBvcG92ZXItY29udGVudCB1bCwucG9wb3Zlci1jb250ZW50IG9se21hcmdpbi1ib3R0b206MDt9DQoucG9wb3ZlciAuYXJyb3csLnBvcG92ZXIgLmFycm93OmFmdGVye3Bvc2l0aW9uOmFic29sdXRlO2Rpc3BsYXk6aW5saW5lLWJsb2NrO3dpZHRoOjA7aGVpZ2h0OjA7Ym9yZGVyLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlci1zdHlsZTpzb2xpZDt9DQoucG9wb3ZlciAuYXJyb3c6YWZ0ZXJ7Y29udGVudDoiIjt6LWluZGV4Oi0xO30NCi5wb3BvdmVyLnRvcCAuYXJyb3d7Ym90dG9tOi0xMHB4O2xlZnQ6NTAlO21hcmdpbi1sZWZ0Oi0xMHB4O2JvcmRlci13aWR0aDoxMHB4IDEwcHggMDtib3JkZXItdG9wLWNvbG9yOiNmZmZmZmY7fS5wb3BvdmVyLnRvcCAuYXJyb3c6YWZ0ZXJ7Ym9yZGVyLXdpZHRoOjExcHggMTFweCAwO2JvcmRlci10b3AtY29sb3I6cmdiYSgwLCAwLCAwLCAwLjI1KTtib3R0b206LTFweDtsZWZ0Oi0xMXB4O30NCi5wb3BvdmVyLnJpZ2h0IC5hcnJvd3t0b3A6NTAlO2xlZnQ6LTEwcHg7bWFyZ2luLXRvcDotMTBweDtib3JkZXItd2lkdGg6MTBweCAxMHB4IDEwcHggMDtib3JkZXItcmlnaHQtY29sb3I6I2ZmZmZmZjt9LnBvcG92ZXIucmlnaHQgLmFycm93OmFmdGVye2JvcmRlci13aWR0aDoxMXB4IDExcHggMTFweCAwO2JvcmRlci1yaWdodC1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMjUpO2JvdHRvbTotMTFweDtsZWZ0Oi0xcHg7fQ0KLnBvcG92ZXIuYm90dG9tIC5hcnJvd3t0b3A6LTEwcHg7bGVmdDo1MCU7bWFyZ2luLWxlZnQ6LTEwcHg7Ym9yZGVyLXdpZHRoOjAgMTBweCAxMHB4O2JvcmRlci1ib3R0b20tY29sb3I6I2ZmZmZmZjt9LnBvcG92ZXIuYm90dG9tIC5hcnJvdzphZnRlcntib3JkZXItd2lkdGg6MCAxMXB4IDExcHg7Ym9yZGVyLWJvdHRvbS1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMjUpO3RvcDotMXB4O2xlZnQ6LTExcHg7fQ0KLnBvcG92ZXIubGVmdCAuYXJyb3d7dG9wOjUwJTtyaWdodDotMTBweDttYXJnaW4tdG9wOi0xMHB4O2JvcmRlci13aWR0aDoxMHB4IDAgMTBweCAxMHB4O2JvcmRlci1sZWZ0LWNvbG9yOiNmZmZmZmY7fS5wb3BvdmVyLmxlZnQgLmFycm93OmFmdGVye2JvcmRlci13aWR0aDoxMXB4IDAgMTFweCAxMXB4O2JvcmRlci1sZWZ0LWNvbG9yOnJnYmEoMCwgMCwgMCwgMC4yNSk7Ym90dG9tOi0xMXB4O3JpZ2h0Oi0xcHg7fQ0KLm1vZGFsLWJhY2tkcm9we3Bvc2l0aW9uOmZpeGVkO3RvcDowO3JpZ2h0OjA7Ym90dG9tOjA7bGVmdDowO3otaW5kZXg6MTA0MDtiYWNrZ3JvdW5kLWNvbG9yOiMwMDAwMDA7fS5tb2RhbC1iYWNrZHJvcC5mYWRle29wYWNpdHk6MDt9DQoubW9kYWwtYmFja2Ryb3AsLm1vZGFsLWJhY2tkcm9wLmZhZGUuaW57b3BhY2l0eTowLjg7ZmlsdGVyOmFscGhhKG9wYWNpdHk9ODApO30NCi5tb2RhbHtwb3NpdGlvbjpmaXhlZDt0b3A6NTAlO2xlZnQ6NTAlO3otaW5kZXg6MTA1MDt3aWR0aDo1NjBweDttYXJnaW46LTI1MHB4IDAgMCAtMjgwcHg7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO2JvcmRlcjoxcHggc29saWQgIzk5OTtib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwgMCwgMCwgMC4zKTsqYm9yZGVyOjFweCBzb2xpZCAjOTk5Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo2cHg7LW1vei1ib3JkZXItcmFkaXVzOjZweDtib3JkZXItcmFkaXVzOjZweDstd2Via2l0LWJveC1zaGFkb3c6MCAzcHggN3B4IHJnYmEoMCwgMCwgMCwgMC4zKTstbW96LWJveC1zaGFkb3c6MCAzcHggN3B4IHJnYmEoMCwgMCwgMCwgMC4zKTtib3gtc2hhZG93OjAgM3B4IDdweCByZ2JhKDAsIDAsIDAsIDAuMyk7LXdlYmtpdC1iYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3g7LW1vei1iYWNrZ3JvdW5kLWNsaXA6cGFkZGluZy1ib3g7YmFja2dyb3VuZC1jbGlwOnBhZGRpbmctYm94O291dGxpbmU6bm9uZTt9Lm1vZGFsLmZhZGV7LXdlYmtpdC10cmFuc2l0aW9uOm9wYWNpdHkgLjNzIGxpbmVhciwgdG9wIC4zcyBlYXNlLW91dDstbW96LXRyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLCB0b3AgLjNzIGVhc2Utb3V0Oy1vLXRyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLCB0b3AgLjNzIGVhc2Utb3V0O3RyYW5zaXRpb246b3BhY2l0eSAuM3MgbGluZWFyLCB0b3AgLjNzIGVhc2Utb3V0O3RvcDotMjUlO30NCi5tb2RhbC5mYWRlLmlue3RvcDo1MCU7fQ0KLm1vZGFsLWhlYWRlcntwYWRkaW5nOjlweCAxNXB4O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNlZWU7fS5tb2RhbC1oZWFkZXIgLmNsb3Nle21hcmdpbi10b3A6MnB4O30NCi5tb2RhbC1oZWFkZXIgaDN7bWFyZ2luOjA7bGluZS1oZWlnaHQ6MzBweDt9DQoubW9kYWwtYm9keXtvdmVyZmxvdy15OmF1dG87bWF4LWhlaWdodDo0MDBweDtwYWRkaW5nOjE1cHg7fQ0KLm1vZGFsLWZvcm17bWFyZ2luLWJvdHRvbTowO30NCi5tb2RhbC1mb290ZXJ7cGFkZGluZzoxNHB4IDE1cHggMTVweDttYXJnaW4tYm90dG9tOjA7dGV4dC1hbGlnbjpyaWdodDtiYWNrZ3JvdW5kLWNvbG9yOiNmNWY1ZjU7Ym9yZGVyLXRvcDoxcHggc29saWQgI2RkZDstd2Via2l0LWJvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgMCA2cHggNnB4O2JvcmRlci1yYWRpdXM6MCAwIDZweCA2cHg7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDAgI2ZmZmZmZjstbW96LWJveC1zaGFkb3c6aW5zZXQgMCAxcHggMCAjZmZmZmZmO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMCAjZmZmZmZmOyp6b29tOjE7fS5tb2RhbC1mb290ZXI6YmVmb3JlLC5tb2RhbC1mb290ZXI6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fQ0KLm1vZGFsLWZvb3RlcjphZnRlcntjbGVhcjpib3RoO30NCi5tb2RhbC1mb290ZXIgLmJ0bisuYnRue21hcmdpbi1sZWZ0OjVweDttYXJnaW4tYm90dG9tOjA7fQ0KLm1vZGFsLWZvb3RlciAuYnRuLWdyb3VwIC5idG4rLmJ0bnttYXJnaW4tbGVmdDotMXB4O30NCi5tb2RhbC1mb290ZXIgLmJ0bi1ibG9jaysuYnRuLWJsb2Nre21hcmdpbi1sZWZ0OjA7fQ0KLmRyb3B1cCwuZHJvcGRvd257cG9zaXRpb246cmVsYXRpdmU7fQ0KLmRyb3Bkb3duLXRvZ2dsZXsqbWFyZ2luLWJvdHRvbTotM3B4O30NCi5kcm9wZG93bi10b2dnbGU6YWN0aXZlLC5vcGVuIC5kcm9wZG93bi10b2dnbGV7b3V0bGluZTowO30NCi5jYXJldHtkaXNwbGF5OmlubGluZS1ibG9jazt3aWR0aDowO2hlaWdodDowO3ZlcnRpY2FsLWFsaWduOnRvcDtib3JkZXItdG9wOjRweCBzb2xpZCAjMDAwMDAwO2JvcmRlci1yaWdodDo0cHggc29saWQgdHJhbnNwYXJlbnQ7Ym9yZGVyLWxlZnQ6NHB4IHNvbGlkIHRyYW5zcGFyZW50O2NvbnRlbnQ6IiI7fQ0KLmRyb3Bkb3duIC5jYXJldHttYXJnaW4tdG9wOjhweDttYXJnaW4tbGVmdDoycHg7fQ0KLmRyb3Bkb3duLW1lbnV7cG9zaXRpb246YWJzb2x1dGU7dG9wOjEwMCU7bGVmdDowO3otaW5kZXg6MTAwMDtkaXNwbGF5Om5vbmU7ZmxvYXQ6bGVmdDttaW4td2lkdGg6MTYwcHg7cGFkZGluZzo1cHggMDttYXJnaW46MnB4IDAgMDtsaXN0LXN0eWxlOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZmZmZmZmO2JvcmRlcjoxcHggc29saWQgI2NjYztib3JkZXI6MXB4IHNvbGlkIHJnYmEoMCwgMCwgMCwgMC4yKTsqYm9yZGVyLXJpZ2h0LXdpZHRoOjJweDsqYm9yZGVyLWJvdHRvbS13aWR0aDoycHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4O2JvcmRlci1yYWRpdXM6NnB4Oy13ZWJraXQtYm94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTstbW96LWJveC1zaGFkb3c6MCA1cHggMTBweCByZ2JhKDAsIDAsIDAsIDAuMik7Ym94LXNoYWRvdzowIDVweCAxMHB4IHJnYmEoMCwgMCwgMCwgMC4yKTstd2Via2l0LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDstbW96LWJhY2tncm91bmQtY2xpcDpwYWRkaW5nO2JhY2tncm91bmQtY2xpcDpwYWRkaW5nLWJveDt9LmRyb3Bkb3duLW1lbnUucHVsbC1yaWdodHtyaWdodDowO2xlZnQ6YXV0bzt9DQouZHJvcGRvd24tbWVudSAuZGl2aWRlcnsqd2lkdGg6MTAwJTtoZWlnaHQ6MXB4O21hcmdpbjo5cHggMXB4OyptYXJnaW46LTVweCAwIDVweDtvdmVyZmxvdzpoaWRkZW47YmFja2dyb3VuZC1jb2xvcjojZTVlNWU1O2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNmZmZmZmY7fQ0KLmRyb3Bkb3duLW1lbnUgbGk+YXtkaXNwbGF5OmJsb2NrO3BhZGRpbmc6M3B4IDIwcHg7Y2xlYXI6Ym90aDtmb250LXdlaWdodDpub3JtYWw7bGluZS1oZWlnaHQ6MjBweDtjb2xvcjojMzMzMzMzO3doaXRlLXNwYWNlOm5vd3JhcDt9DQouZHJvcGRvd24tbWVudSBsaT5hOmhvdmVyLC5kcm9wZG93bi1tZW51IGxpPmE6Zm9jdXMsLmRyb3Bkb3duLXN1Ym1lbnU6aG92ZXI+YXt0ZXh0LWRlY29yYXRpb246bm9uZTtjb2xvcjojZmZmZmZmO2JhY2tncm91bmQtY29sb3I6IzAwODFjMjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzAwODhjYyksIHRvKCMwMDc3YjMpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjMDA4OGNjLCAjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICMwMDg4Y2MsICMwMDc3YjMpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmMDA4OGNjJywgZW5kQ29sb3JzdHI9JyNmZjAwNzdiMycsIEdyYWRpZW50VHlwZT0wKTt9DQouZHJvcGRvd24tbWVudSAuYWN0aXZlPmEsLmRyb3Bkb3duLW1lbnUgLmFjdGl2ZT5hOmhvdmVye2NvbG9yOiMzMzMzMzM7dGV4dC1kZWNvcmF0aW9uOm5vbmU7b3V0bGluZTowO2JhY2tncm91bmQtY29sb3I6IzAwODFjMjtiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwgMCAwLCAwIDEwMCUsIGZyb20oIzAwODhjYyksIHRvKCMwMDc3YjMpKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwgIzAwODhjYywgIzAwNzdiMyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCAjMDA4OGNjLCAjMDA3N2IzKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0byBib3R0b20sICMwMDg4Y2MsICMwMDc3YjMpO2JhY2tncm91bmQtcmVwZWF0OnJlcGVhdC14O2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZmMDA4OGNjJywgZW5kQ29sb3JzdHI9JyNmZjAwNzdiMycsIEdyYWRpZW50VHlwZT0wKTt9DQouZHJvcGRvd24tbWVudSAuZGlzYWJsZWQ+YSwuZHJvcGRvd24tbWVudSAuZGlzYWJsZWQ+YTpob3Zlcntjb2xvcjojOTk5OTk5O30NCi5kcm9wZG93bi1tZW51IC5kaXNhYmxlZD5hOmhvdmVye3RleHQtZGVjb3JhdGlvbjpub25lO2JhY2tncm91bmQtY29sb3I6dHJhbnNwYXJlbnQ7YmFja2dyb3VuZC1pbWFnZTpub25lO2N1cnNvcjpkZWZhdWx0O30NCi5vcGVueyp6LWluZGV4OjEwMDA7fS5vcGVuID4uZHJvcGRvd24tbWVudXtkaXNwbGF5OmJsb2NrO30NCi5wdWxsLXJpZ2h0Pi5kcm9wZG93bi1tZW51e3JpZ2h0OjA7bGVmdDphdXRvO30NCi5kcm9wdXAgLmNhcmV0LC5uYXZiYXItZml4ZWQtYm90dG9tIC5kcm9wZG93biAuY2FyZXR7Ym9yZGVyLXRvcDowO2JvcmRlci1ib3R0b206NHB4IHNvbGlkICMwMDAwMDA7Y29udGVudDoiIjt9DQouZHJvcHVwIC5kcm9wZG93bi1tZW51LC5uYXZiYXItZml4ZWQtYm90dG9tIC5kcm9wZG93biAuZHJvcGRvd24tbWVudXt0b3A6YXV0bztib3R0b206MTAwJTttYXJnaW4tYm90dG9tOjFweDt9DQouZHJvcGRvd24tc3VibWVudXtwb3NpdGlvbjpyZWxhdGl2ZTt9DQouZHJvcGRvd24tc3VibWVudT4uZHJvcGRvd24tbWVudXt0b3A6MDtsZWZ0OjEwMCU7bWFyZ2luLXRvcDotNnB4O21hcmdpbi1sZWZ0Oi0xcHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHg7LW1vei1ib3JkZXItcmFkaXVzOjAgNnB4IDZweCA2cHg7Ym9yZGVyLXJhZGl1czowIDZweCA2cHggNnB4O30NCi5kcm9wZG93bi1zdWJtZW51OmhvdmVyPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2s7fQ0KLmRyb3B1cCAuZHJvcGRvd24tc3VibWVudT4uZHJvcGRvd24tbWVudXt0b3A6YXV0bztib3R0b206MDttYXJnaW4tdG9wOjA7bWFyZ2luLWJvdHRvbTotMnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwOy1tb3otYm9yZGVyLXJhZGl1czo1cHggNXB4IDVweCAwO2JvcmRlci1yYWRpdXM6NXB4IDVweCA1cHggMDt9DQouZHJvcGRvd24tc3VibWVudT5hOmFmdGVye2Rpc3BsYXk6YmxvY2s7Y29udGVudDoiICI7ZmxvYXQ6cmlnaHQ7d2lkdGg6MDtoZWlnaHQ6MDtib3JkZXItY29sb3I6dHJhbnNwYXJlbnQ7Ym9yZGVyLXN0eWxlOnNvbGlkO2JvcmRlci13aWR0aDo1cHggMCA1cHggNXB4O2JvcmRlci1sZWZ0LWNvbG9yOiNjY2NjY2M7bWFyZ2luLXRvcDo1cHg7bWFyZ2luLXJpZ2h0Oi0xMHB4O30NCi5kcm9wZG93bi1zdWJtZW51OmhvdmVyPmE6YWZ0ZXJ7Ym9yZGVyLWxlZnQtY29sb3I6I2ZmZmZmZjt9DQouZHJvcGRvd24tc3VibWVudS5wdWxsLWxlZnR7ZmxvYXQ6bm9uZTt9LmRyb3Bkb3duLXN1Ym1lbnUucHVsbC1sZWZ0Pi5kcm9wZG93bi1tZW51e2xlZnQ6LTEwMCU7bWFyZ2luLWxlZnQ6MTBweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDstbW96LWJvcmRlci1yYWRpdXM6NnB4IDAgNnB4IDZweDtib3JkZXItcmFkaXVzOjZweCAwIDZweCA2cHg7fQ0KLmRyb3Bkb3duIC5kcm9wZG93bi1tZW51IC5uYXYtaGVhZGVye3BhZGRpbmctbGVmdDoyMHB4O3BhZGRpbmctcmlnaHQ6MjBweDt9DQoudHlwZWFoZWFke21hcmdpbi10b3A6MnB4Oy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9DQouYWNjb3JkaW9ue21hcmdpbi1ib3R0b206MjBweDt9DQouYWNjb3JkaW9uLWdyb3Vwe21hcmdpbi1ib3R0b206MnB4O2JvcmRlcjoxcHggc29saWQgI2U1ZTVlNTstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7fQ0KLmFjY29yZGlvbi1oZWFkaW5ne2JvcmRlci1ib3R0b206MDt9DQouYWNjb3JkaW9uLWhlYWRpbmcgLmFjY29yZGlvbi10b2dnbGV7ZGlzcGxheTpibG9jaztwYWRkaW5nOjhweCAxNXB4O30NCi5hY2NvcmRpb24tdG9nZ2xle2N1cnNvcjpwb2ludGVyO30NCi5hY2NvcmRpb24taW5uZXJ7cGFkZGluZzo5cHggMTVweDtib3JkZXItdG9wOjFweCBzb2xpZCAjZTVlNWU1O30NCi5jYXJvdXNlbHtwb3NpdGlvbjpyZWxhdGl2ZTttYXJnaW4tYm90dG9tOjIwcHg7bGluZS1oZWlnaHQ6MTt9DQouY2Fyb3VzZWwtaW5uZXJ7b3ZlcmZsb3c6aGlkZGVuO3dpZHRoOjEwMCU7cG9zaXRpb246cmVsYXRpdmU7fQ0KLmNhcm91c2VsIC5pdGVte2Rpc3BsYXk6bm9uZTtwb3NpdGlvbjpyZWxhdGl2ZTstd2Via2l0LXRyYW5zaXRpb246MC42cyBlYXNlLWluLW91dCBsZWZ0Oy1tb3otdHJhbnNpdGlvbjowLjZzIGVhc2UtaW4tb3V0IGxlZnQ7LW8tdHJhbnNpdGlvbjowLjZzIGVhc2UtaW4tb3V0IGxlZnQ7dHJhbnNpdGlvbjowLjZzIGVhc2UtaW4tb3V0IGxlZnQ7fQ0KLmNhcm91c2VsIC5pdGVtPmltZ3tkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjE7fQ0KLmNhcm91c2VsIC5hY3RpdmUsLmNhcm91c2VsIC5uZXh0LC5jYXJvdXNlbCAucHJldntkaXNwbGF5OmJsb2NrO30NCi5jYXJvdXNlbCAuYWN0aXZle2xlZnQ6MDt9DQouY2Fyb3VzZWwgLm5leHQsLmNhcm91c2VsIC5wcmV2e3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO3dpZHRoOjEwMCU7fQ0KLmNhcm91c2VsIC5uZXh0e2xlZnQ6MTAwJTt9DQouY2Fyb3VzZWwgLnByZXZ7bGVmdDotMTAwJTt9DQouY2Fyb3VzZWwgLm5leHQubGVmdCwuY2Fyb3VzZWwgLnByZXYucmlnaHR7bGVmdDowO30NCi5jYXJvdXNlbCAuYWN0aXZlLmxlZnR7bGVmdDotMTAwJTt9DQouY2Fyb3VzZWwgLmFjdGl2ZS5yaWdodHtsZWZ0OjEwMCU7fQ0KLmNhcm91c2VsLWNvbnRyb2x7cG9zaXRpb246YWJzb2x1dGU7dG9wOjQwJTtsZWZ0OjE1cHg7d2lkdGg6NDBweDtoZWlnaHQ6NDBweDttYXJnaW4tdG9wOi0yMHB4O2ZvbnQtc2l6ZTo2MHB4O2ZvbnQtd2VpZ2h0OjEwMDtsaW5lLWhlaWdodDozMHB4O2NvbG9yOiNmZmZmZmY7dGV4dC1hbGlnbjpjZW50ZXI7YmFja2dyb3VuZDojMjIyMjIyO2JvcmRlcjozcHggc29saWQgI2ZmZmZmZjstd2Via2l0LWJvcmRlci1yYWRpdXM6MjNweDstbW96LWJvcmRlci1yYWRpdXM6MjNweDtib3JkZXItcmFkaXVzOjIzcHg7b3BhY2l0eTowLjU7ZmlsdGVyOmFscGhhKG9wYWNpdHk9NTApO30uY2Fyb3VzZWwtY29udHJvbC5yaWdodHtsZWZ0OmF1dG87cmlnaHQ6MTVweDt9DQouY2Fyb3VzZWwtY29udHJvbDpob3Zlcntjb2xvcjojZmZmZmZmO3RleHQtZGVjb3JhdGlvbjpub25lO29wYWNpdHk6MC45O2ZpbHRlcjphbHBoYShvcGFjaXR5PTkwKTt9DQouY2Fyb3VzZWwtY2FwdGlvbntwb3NpdGlvbjphYnNvbHV0ZTtsZWZ0OjA7cmlnaHQ6MDtib3R0b206MDtwYWRkaW5nOjE1cHg7YmFja2dyb3VuZDojMzMzMzMzO2JhY2tncm91bmQ6cmdiYSgwLCAwLCAwLCAwLjc1KTt9DQouY2Fyb3VzZWwtY2FwdGlvbiBoNCwuY2Fyb3VzZWwtY2FwdGlvbiBwe2NvbG9yOiNmZmZmZmY7bGluZS1oZWlnaHQ6MjBweDt9DQouY2Fyb3VzZWwtY2FwdGlvbiBoNHttYXJnaW46MCAwIDVweDt9DQouY2Fyb3VzZWwtY2FwdGlvbiBwe21hcmdpbi1ib3R0b206MDt9DQoubWVkaWEsLm1lZGlhLWJvZHl7b3ZlcmZsb3c6aGlkZGVuOypvdmVyZmxvdzp2aXNpYmxlO3pvb206MTt9DQoubWVkaWEsLm1lZGlhIC5tZWRpYXttYXJnaW4tdG9wOjE1cHg7fQ0KLm1lZGlhOmZpcnN0LWNoaWxke21hcmdpbi10b3A6MDt9DQoubWVkaWEtb2JqZWN0e2Rpc3BsYXk6YmxvY2s7fQ0KLm1lZGlhLWhlYWRpbmd7bWFyZ2luOjAgMCA1cHg7fQ0KLm1lZGlhIC5wdWxsLWxlZnR7bWFyZ2luLXJpZ2h0OjEwcHg7fQ0KLm1lZGlhIC5wdWxsLXJpZ2h0e21hcmdpbi1sZWZ0OjEwcHg7fQ0KLm1lZGlhLWxpc3R7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmU7fQ0KLndlbGx7bWluLWhlaWdodDoyMHB4O3BhZGRpbmc6MTlweDttYXJnaW4tYm90dG9tOjIwcHg7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1O2JvcmRlcjoxcHggc29saWQgI2UzZTNlMzstd2Via2l0LWJvcmRlci1yYWRpdXM6NHB4Oy1tb3otYm9yZGVyLXJhZGl1czo0cHg7Ym9yZGVyLXJhZGl1czo0cHg7LXdlYmtpdC1ib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDUpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAxcHggcmdiYSgwLCAwLCAwLCAwLjA1KTtib3gtc2hhZG93Omluc2V0IDAgMXB4IDFweCByZ2JhKDAsIDAsIDAsIDAuMDUpO30ud2VsbCBibG9ja3F1b3Rle2JvcmRlci1jb2xvcjojZGRkO2JvcmRlci1jb2xvcjpyZ2JhKDAsIDAsIDAsIDAuMTUpO30NCi53ZWxsLWxhcmdle3BhZGRpbmc6MjRweDstd2Via2l0LWJvcmRlci1yYWRpdXM6NnB4Oy1tb3otYm9yZGVyLXJhZGl1czo2cHg7Ym9yZGVyLXJhZGl1czo2cHg7fQ0KLndlbGwtc21hbGx7cGFkZGluZzo5cHg7LXdlYmtpdC1ib3JkZXItcmFkaXVzOjNweDstbW96LWJvcmRlci1yYWRpdXM6M3B4O2JvcmRlci1yYWRpdXM6M3B4O30NCi5jbG9zZXtmbG9hdDpyaWdodDtmb250LXNpemU6MjBweDtmb250LXdlaWdodDpib2xkO2xpbmUtaGVpZ2h0OjIwcHg7Y29sb3I6IzAwMDAwMDt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmZmZmY7b3BhY2l0eTowLjI7ZmlsdGVyOmFscGhhKG9wYWNpdHk9MjApO30uY2xvc2U6aG92ZXJ7Y29sb3I6IzAwMDAwMDt0ZXh0LWRlY29yYXRpb246bm9uZTtjdXJzb3I6cG9pbnRlcjtvcGFjaXR5OjAuNDtmaWx0ZXI6YWxwaGEob3BhY2l0eT00MCk7fQ0KYnV0dG9uLmNsb3Nle3BhZGRpbmc6MDtjdXJzb3I6cG9pbnRlcjtiYWNrZ3JvdW5kOnRyYW5zcGFyZW50O2JvcmRlcjowOy13ZWJraXQtYXBwZWFyYW5jZTpub25lO30NCi5wdWxsLXJpZ2h0e2Zsb2F0OnJpZ2h0O30NCi5wdWxsLWxlZnR7ZmxvYXQ6bGVmdDt9DQouaGlkZXtkaXNwbGF5Om5vbmU7fQ0KLnNob3d7ZGlzcGxheTpibG9jazt9DQouaW52aXNpYmxle3Zpc2liaWxpdHk6aGlkZGVuO30NCi5hZmZpeHtwb3NpdGlvbjpmaXhlZDt9DQouZmFkZXtvcGFjaXR5OjA7LXdlYmtpdC10cmFuc2l0aW9uOm9wYWNpdHkgMC4xNXMgbGluZWFyOy1tb3otdHJhbnNpdGlvbjpvcGFjaXR5IDAuMTVzIGxpbmVhcjstby10cmFuc2l0aW9uOm9wYWNpdHkgMC4xNXMgbGluZWFyO3RyYW5zaXRpb246b3BhY2l0eSAwLjE1cyBsaW5lYXI7fS5mYWRlLmlue29wYWNpdHk6MTt9DQouY29sbGFwc2V7cG9zaXRpb246cmVsYXRpdmU7aGVpZ2h0OjA7b3ZlcmZsb3c6aGlkZGVuOy13ZWJraXQtdHJhbnNpdGlvbjpoZWlnaHQgMC4zNXMgZWFzZTstbW96LXRyYW5zaXRpb246aGVpZ2h0IDAuMzVzIGVhc2U7LW8tdHJhbnNpdGlvbjpoZWlnaHQgMC4zNXMgZWFzZTt0cmFuc2l0aW9uOmhlaWdodCAwLjM1cyBlYXNlO30uY29sbGFwc2UuaW57aGVpZ2h0OmF1dG87fQ0KLmhpZGRlbntkaXNwbGF5Om5vbmU7dmlzaWJpbGl0eTpoaWRkZW47fQ0KLnZpc2libGUtcGhvbmV7ZGlzcGxheTpub25lICFpbXBvcnRhbnQ7fQ0KLnZpc2libGUtdGFibGV0e2Rpc3BsYXk6bm9uZSAhaW1wb3J0YW50O30NCi5oaWRkZW4tZGVza3RvcHtkaXNwbGF5Om5vbmUgIWltcG9ydGFudDt9DQoudmlzaWJsZS1kZXNrdG9we2Rpc3BsYXk6aW5oZXJpdCAhaW1wb3J0YW50O30NCkBtZWRpYSAobWluLXdpZHRoOjc2OHB4KSBhbmQgKG1heC13aWR0aDo5NzlweCl7LmhpZGRlbi1kZXNrdG9we2Rpc3BsYXk6aW5oZXJpdCAhaW1wb3J0YW50O30gLnZpc2libGUtZGVza3RvcHtkaXNwbGF5Om5vbmUgIWltcG9ydGFudCA7fSAudmlzaWJsZS10YWJsZXR7ZGlzcGxheTppbmhlcml0ICFpbXBvcnRhbnQ7fSAuaGlkZGVuLXRhYmxldHtkaXNwbGF5Om5vbmUgIWltcG9ydGFudDt9fUBtZWRpYSAobWF4LXdpZHRoOjc2N3B4KXsuaGlkZGVuLWRlc2t0b3B7ZGlzcGxheTppbmhlcml0ICFpbXBvcnRhbnQ7fSAudmlzaWJsZS1kZXNrdG9we2Rpc3BsYXk6bm9uZSAhaW1wb3J0YW50O30gLnZpc2libGUtcGhvbmV7ZGlzcGxheTppbmhlcml0ICFpbXBvcnRhbnQ7fSAuaGlkZGVuLXBob25le2Rpc3BsYXk6bm9uZSAhaW1wb3J0YW50O319QG1lZGlhIChtYXgtd2lkdGg6NzY3cHgpe2JvZHl7cGFkZGluZy1sZWZ0OjIwcHg7cGFkZGluZy1yaWdodDoyMHB4O30gLm5hdmJhci1maXhlZC10b3AsLm5hdmJhci1maXhlZC1ib3R0b20sLm5hdmJhci1zdGF0aWMtdG9we21hcmdpbi1sZWZ0Oi0yMHB4O21hcmdpbi1yaWdodDotMjBweDt9IC5jb250YWluZXItZmx1aWR7cGFkZGluZzowO30gLmRsLWhvcml6b250YWwgZHR7ZmxvYXQ6bm9uZTtjbGVhcjpub25lO3dpZHRoOmF1dG87dGV4dC1hbGlnbjpsZWZ0O30gLmRsLWhvcml6b250YWwgZGR7bWFyZ2luLWxlZnQ6MDt9IC5jb250YWluZXJ7d2lkdGg6YXV0bzt9IC5yb3ctZmx1aWR7d2lkdGg6MTAwJTt9IC5yb3csLnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6MDt9IC50aHVtYm5haWxzPmxpe2Zsb2F0Om5vbmU7bWFyZ2luLWxlZnQ6MDt9IFtjbGFzcyo9InNwYW4iXSwudW5lZGl0YWJsZS1pbnB1dFtjbGFzcyo9InNwYW4iXSwucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtmbG9hdDpub25lO2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTttYXJnaW4tbGVmdDowOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDt9IC5zcGFuMTIsLnJvdy1mbHVpZCAuc3BhbjEye3dpZHRoOjEwMCU7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94O30gLnJvdy1mbHVpZCBbY2xhc3MqPSJvZmZzZXQiXTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowO30gLmlucHV0LWxhcmdlLC5pbnB1dC14bGFyZ2UsLmlucHV0LXh4bGFyZ2UsaW5wdXRbY2xhc3MqPSJzcGFuIl0sc2VsZWN0W2NsYXNzKj0ic3BhbiJdLHRleHRhcmVhW2NsYXNzKj0ic3BhbiJdLC51bmVkaXRhYmxlLWlucHV0e2Rpc3BsYXk6YmxvY2s7d2lkdGg6MTAwJTttaW4taGVpZ2h0OjMwcHg7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94O30gLmlucHV0LXByZXBlbmQgaW5wdXQsLmlucHV0LWFwcGVuZCBpbnB1dCwuaW5wdXQtcHJlcGVuZCBpbnB1dFtjbGFzcyo9InNwYW4iXSwuaW5wdXQtYXBwZW5kIGlucHV0W2NsYXNzKj0ic3BhbiJde2Rpc3BsYXk6aW5saW5lLWJsb2NrO3dpZHRoOmF1dG87fSAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6MDt9IC5tb2RhbHtwb3NpdGlvbjpmaXhlZDt0b3A6MjBweDtsZWZ0OjIwcHg7cmlnaHQ6MjBweDt3aWR0aDphdXRvO21hcmdpbjowO30ubW9kYWwuZmFkZXt0b3A6LTEwMHB4O30gLm1vZGFsLmZhZGUuaW57dG9wOjIwcHg7fX1AbWVkaWEgKG1heC13aWR0aDo0ODBweCl7Lm5hdi1jb2xsYXBzZXstd2Via2l0LXRyYW5zZm9ybTp0cmFuc2xhdGUzZCgwLCAwLCAwKTt9IC5wYWdlLWhlYWRlciBoMSBzbWFsbHtkaXNwbGF5OmJsb2NrO2xpbmUtaGVpZ2h0OjIwcHg7fSBpbnB1dFt0eXBlPSJjaGVja2JveCJdLGlucHV0W3R5cGU9InJhZGlvIl17Ym9yZGVyOjFweCBzb2xpZCAjY2NjO30gLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1sYWJlbHtmbG9hdDpub25lO3dpZHRoOmF1dG87cGFkZGluZy10b3A6MDt0ZXh0LWFsaWduOmxlZnQ7fSAuZm9ybS1ob3Jpem9udGFsIC5jb250cm9sc3ttYXJnaW4tbGVmdDowO30gLmZvcm0taG9yaXpvbnRhbCAuY29udHJvbC1saXN0e3BhZGRpbmctdG9wOjA7fSAuZm9ybS1ob3Jpem9udGFsIC5mb3JtLWFjdGlvbnN7cGFkZGluZy1sZWZ0OjEwcHg7cGFkZGluZy1yaWdodDoxMHB4O30gLm1lZGlhIC5wdWxsLWxlZnQsLm1lZGlhIC5wdWxsLXJpZ2h0e2Zsb2F0Om5vbmU7ZGlzcGxheTpibG9jazttYXJnaW4tYm90dG9tOjEwcHg7fSAubWVkaWEtb2JqZWN0e21hcmdpbi1yaWdodDowO21hcmdpbi1sZWZ0OjA7fSAubW9kYWx7dG9wOjEwcHg7bGVmdDoxMHB4O3JpZ2h0OjEwcHg7fSAubW9kYWwtaGVhZGVyIC5jbG9zZXtwYWRkaW5nOjEwcHg7bWFyZ2luOi0xMHB4O30gLmNhcm91c2VsLWNhcHRpb257cG9zaXRpb246c3RhdGljO319QG1lZGlhIChtaW4td2lkdGg6NzY4cHgpIGFuZCAobWF4LXdpZHRoOjk3OXB4KXsucm93e21hcmdpbi1sZWZ0Oi0yMHB4Oyp6b29tOjE7fS5yb3c6YmVmb3JlLC5yb3c6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fSAucm93OmFmdGVye2NsZWFyOmJvdGg7fSBbY2xhc3MqPSJzcGFuIl17ZmxvYXQ6bGVmdDttaW4taGVpZ2h0OjFweDttYXJnaW4tbGVmdDoyMHB4O30gLmNvbnRhaW5lciwubmF2YmFyLXN0YXRpYy10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtYm90dG9tIC5jb250YWluZXJ7d2lkdGg6NzI0cHg7fSAuc3BhbjEye3dpZHRoOjcyNHB4O30gLnNwYW4xMXt3aWR0aDo2NjJweDt9IC5zcGFuMTB7d2lkdGg6NjAwcHg7fSAuc3Bhbjl7d2lkdGg6NTM4cHg7fSAuc3Bhbjh7d2lkdGg6NDc2cHg7fSAuc3Bhbjd7d2lkdGg6NDE0cHg7fSAuc3BhbjZ7d2lkdGg6MzUycHg7fSAuc3BhbjV7d2lkdGg6MjkwcHg7fSAuc3BhbjR7d2lkdGg6MjI4cHg7fSAuc3BhbjN7d2lkdGg6MTY2cHg7fSAuc3BhbjJ7d2lkdGg6MTA0cHg7fSAuc3BhbjF7d2lkdGg6NDJweDt9IC5vZmZzZXQxMnttYXJnaW4tbGVmdDo3NjRweDt9IC5vZmZzZXQxMXttYXJnaW4tbGVmdDo3MDJweDt9IC5vZmZzZXQxMHttYXJnaW4tbGVmdDo2NDBweDt9IC5vZmZzZXQ5e21hcmdpbi1sZWZ0OjU3OHB4O30gLm9mZnNldDh7bWFyZ2luLWxlZnQ6NTE2cHg7fSAub2Zmc2V0N3ttYXJnaW4tbGVmdDo0NTRweDt9IC5vZmZzZXQ2e21hcmdpbi1sZWZ0OjM5MnB4O30gLm9mZnNldDV7bWFyZ2luLWxlZnQ6MzMwcHg7fSAub2Zmc2V0NHttYXJnaW4tbGVmdDoyNjhweDt9IC5vZmZzZXQze21hcmdpbi1sZWZ0OjIwNnB4O30gLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTQ0cHg7fSAub2Zmc2V0MXttYXJnaW4tbGVmdDo4MnB4O30gLnJvdy1mbHVpZHt3aWR0aDoxMDAlOyp6b29tOjE7fS5yb3ctZmx1aWQ6YmVmb3JlLC5yb3ctZmx1aWQ6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fSAucm93LWZsdWlkOmFmdGVye2NsZWFyOmJvdGg7fSAucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXXtkaXNwbGF5OmJsb2NrO3dpZHRoOjEwMCU7bWluLWhlaWdodDozMHB4Oy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveDtmbG9hdDpsZWZ0O21hcmdpbi1sZWZ0OjIuNzYyNDMwOTM5MjI2NTE5NCU7Km1hcmdpbi1sZWZ0OjIuNzA5MjM5NDQ5ODY0ODE3JTt9IC5yb3ctZmx1aWQgW2NsYXNzKj0ic3BhbiJdOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjA7fSAucm93LWZsdWlkIC5jb250cm9scy1yb3cgW2NsYXNzKj0ic3BhbiJdK1tjbGFzcyo9InNwYW4iXXttYXJnaW4tbGVmdDoyLjc2MjQzMDkzOTIyNjUxOTQlO30gLnJvdy1mbHVpZCAuc3BhbjEye3dpZHRoOjEwMCU7KndpZHRoOjk5Ljk0NjgwODUxMDYzODI5JTt9IC5yb3ctZmx1aWQgLnNwYW4xMXt3aWR0aDo5MS40MzY0NjQwODgzOTc3OCU7KndpZHRoOjkxLjM4MzI3MjU5OTAzNjA4JTt9IC5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi44NzI5MjgxNzY3OTU1OCU7KndpZHRoOjgyLjgxOTczNjY4NzQzMzg3JTt9IC5yb3ctZmx1aWQgLnNwYW45e3dpZHRoOjc0LjMwOTM5MjI2NTE5MzM3JTsqd2lkdGg6NzQuMjU2MjAwNzc1ODMxNjYlO30gLnJvdy1mbHVpZCAuc3Bhbjh7d2lkdGg6NjUuNzQ1ODU2MzUzNTkxMTclOyp3aWR0aDo2NS42OTI2NjQ4NjQyMjk0NiU7fSAucm93LWZsdWlkIC5zcGFuN3t3aWR0aDo1Ny4xODIzMjA0NDE5ODg5NSU7KndpZHRoOjU3LjEyOTEyODk1MjYyNzI1JTt9IC5yb3ctZmx1aWQgLnNwYW42e3dpZHRoOjQ4LjYxODc4NDUzMDM4Njc0JTsqd2lkdGg6NDguNTY1NTkzMDQxMDI1MDQlO30gLnJvdy1mbHVpZCAuc3BhbjV7d2lkdGg6NDAuMDU1MjQ4NjE4Nzg0NTMlOyp3aWR0aDo0MC4wMDIwNTcxMjk0MjI4MyU7fSAucm93LWZsdWlkIC5zcGFuNHt3aWR0aDozMS40OTE3MTI3MDcxODIzMjMlOyp3aWR0aDozMS40Mzg1MjEyMTc4MjA2MiU7fSAucm93LWZsdWlkIC5zcGFuM3t3aWR0aDoyMi45MjgxNzY3OTU1ODAxMSU7KndpZHRoOjIyLjg3NDk4NTMwNjIxODQxJTt9IC5yb3ctZmx1aWQgLnNwYW4ye3dpZHRoOjE0LjM2NDY0MDg4Mzk3NzklOyp3aWR0aDoxNC4zMTE0NDkzOTQ2MTYxOTklO30gLnJvdy1mbHVpZCAuc3BhbjF7d2lkdGg6NS44MDExMDQ5NzIzNzU2OTElOyp3aWR0aDo1Ljc0NzkxMzQ4MzAxMzk4OCU7fSAucm93LWZsdWlkIC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMDUuNTI0ODYxODc4NDUzMDQlOyptYXJnaW4tbGVmdDoxMDUuNDE4NDc4ODk5NzI5NjIlO30gLnJvdy1mbHVpZCAub2Zmc2V0MTI6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MTAyLjc2MjQzMDkzOTIyNjUyJTsqbWFyZ2luLWxlZnQ6MTAyLjY1NjA0Nzk2MDUwMzElO30gLnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTYuOTYxMzI1OTY2ODUwODIlOyptYXJnaW4tbGVmdDo5Ni44NTQ5NDI5ODgxMjc0JTt9IC5yb3ctZmx1aWQgLm9mZnNldDExOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0Ojk0LjE5ODg5NTAyNzYyNDMlOyptYXJnaW4tbGVmdDo5NC4wOTI1MTIwNDg5MDA4OSU7fSAucm93LWZsdWlkIC5vZmZzZXQxMHttYXJnaW4tbGVmdDo4OC4zOTc3OTAwNTUyNDg2MiU7Km1hcmdpbi1sZWZ0Ojg4LjI5MTQwNzA3NjUyNTIlO30gLnJvdy1mbHVpZCAub2Zmc2V0MTA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6ODUuNjM1MzU5MTE2MDIyMSU7Km1hcmdpbi1sZWZ0Ojg1LjUyODk3NjEzNzI5ODY4JTt9IC5yb3ctZmx1aWQgLm9mZnNldDl7bWFyZ2luLWxlZnQ6NzkuODM0MjU0MTQzNjQ2NCU7Km1hcmdpbi1sZWZ0Ojc5LjcyNzg3MTE2NDkyMjk5JTt9IC5yb3ctZmx1aWQgLm9mZnNldDk6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6NzcuMDcxODIzMjA0NDE5ODklOyptYXJnaW4tbGVmdDo3Ni45NjU0NDAyMjU2OTY0NyU7fSAucm93LWZsdWlkIC5vZmZzZXQ4e21hcmdpbi1sZWZ0OjcxLjI3MDcxODIzMjA0NDIlOyptYXJnaW4tbGVmdDo3MS4xNjQzMzUyNTMzMjA3OSU7fSAucm93LWZsdWlkIC5vZmZzZXQ4OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjY4LjUwODI4NzI5MjgxNzY4JTsqbWFyZ2luLWxlZnQ6NjguNDAxOTA0MzE0MDk0MjclO30gLnJvdy1mbHVpZCAub2Zmc2V0N3ttYXJnaW4tbGVmdDo2Mi43MDcxODIzMjA0NDE5OSU7Km1hcmdpbi1sZWZ0OjYyLjYwMDc5OTM0MTcxODU4NCU7fSAucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5Ljk0NDc1MTM4MTIxNTQ3JTsqbWFyZ2luLWxlZnQ6NTkuODM4MzY4NDAyNDkyMDY1JTt9IC5yb3ctZmx1aWQgLm9mZnNldDZ7bWFyZ2luLWxlZnQ6NTQuMTQzNjQ2NDA4ODM5NzglOyptYXJnaW4tbGVmdDo1NC4wMzcyNjM0MzAxMTYzNzYlO30gLnJvdy1mbHVpZCAub2Zmc2V0NjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo1MS4zODEyMTU0Njk2MTMyNiU7Km1hcmdpbi1sZWZ0OjUxLjI3NDgzMjQ5MDg4OTg2JTt9IC5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDUuNTgwMTEwNDk3MjM3NTclOyptYXJnaW4tbGVmdDo0NS40NzM3Mjc1MTg1MTQxNyU7fSAucm93LWZsdWlkIC5vZmZzZXQ1OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjQyLjgxNzY3OTU1ODAxMTA1JTsqbWFyZ2luLWxlZnQ6NDIuNzExMjk2NTc5Mjg3NjUlO30gLnJvdy1mbHVpZCAub2Zmc2V0NHttYXJnaW4tbGVmdDozNy4wMTY1NzQ1ODU2MzUzNiU7Km1hcmdpbi1sZWZ0OjM2LjkxMDE5MTYwNjkxMTk2JTt9IC5yb3ctZmx1aWQgLm9mZnNldDQ6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MzQuMjU0MTQzNjQ2NDA4ODQlOyptYXJnaW4tbGVmdDozNC4xNDc3NjA2Njc2ODU0NCU7fSAucm93LWZsdWlkIC5vZmZzZXQze21hcmdpbi1sZWZ0OjI4LjQ1MzAzODY3NDAzMzE1JTsqbWFyZ2luLWxlZnQ6MjguMzQ2NjU1Njk1MzA5NzQ2JTt9IC5yb3ctZmx1aWQgLm9mZnNldDM6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6MjUuNjkwNjA3NzM0ODA2NjMlOyptYXJnaW4tbGVmdDoyNS41ODQyMjQ3NTYwODMyMjclO30gLnJvdy1mbHVpZCAub2Zmc2V0MnttYXJnaW4tbGVmdDoxOS44ODk1MDI3NjI0MzA5NCU7Km1hcmdpbi1sZWZ0OjE5Ljc4MzExOTc4MzcwNzUzNyU7fSAucm93LWZsdWlkIC5vZmZzZXQyOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjE3LjEyNzA3MTgyMzIwNDQyJTsqbWFyZ2luLWxlZnQ6MTcuMDIwNjg4ODQ0NDgxMDIlO30gLnJvdy1mbHVpZCAub2Zmc2V0MXttYXJnaW4tbGVmdDoxMS4zMjU5NjY4NTA4Mjg3MyU7Km1hcmdpbi1sZWZ0OjExLjIxOTU4Mzg3MjEwNTMyNSU7fSAucm93LWZsdWlkIC5vZmZzZXQxOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjguNTYzNTM1OTExNjAyMjElOyptYXJnaW4tbGVmdDo4LjQ1NzE1MjkzMjg3ODgwNiU7fSBpbnB1dCx0ZXh0YXJlYSwudW5lZGl0YWJsZS1pbnB1dHttYXJnaW4tbGVmdDowO30gLmNvbnRyb2xzLXJvdyBbY2xhc3MqPSJzcGFuIl0rW2NsYXNzKj0ic3BhbiJde21hcmdpbi1sZWZ0OjIwcHg7fSBpbnB1dC5zcGFuMTIsIHRleHRhcmVhLnNwYW4xMiwgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEye3dpZHRoOjcxMHB4O30gaW5wdXQuc3BhbjExLCB0ZXh0YXJlYS5zcGFuMTEsIC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMXt3aWR0aDo2NDhweDt9IGlucHV0LnNwYW4xMCwgdGV4dGFyZWEuc3BhbjEwLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMTB7d2lkdGg6NTg2cHg7fSBpbnB1dC5zcGFuOSwgdGV4dGFyZWEuc3BhbjksIC51bmVkaXRhYmxlLWlucHV0LnNwYW45e3dpZHRoOjUyNHB4O30gaW5wdXQuc3BhbjgsIHRleHRhcmVhLnNwYW44LCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuOHt3aWR0aDo0NjJweDt9IGlucHV0LnNwYW43LCB0ZXh0YXJlYS5zcGFuNywgLnVuZWRpdGFibGUtaW5wdXQuc3Bhbjd7d2lkdGg6NDAwcHg7fSBpbnB1dC5zcGFuNiwgdGV4dGFyZWEuc3BhbjYsIC51bmVkaXRhYmxlLWlucHV0LnNwYW42e3dpZHRoOjMzOHB4O30gaW5wdXQuc3BhbjUsIHRleHRhcmVhLnNwYW41LCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuNXt3aWR0aDoyNzZweDt9IGlucHV0LnNwYW40LCB0ZXh0YXJlYS5zcGFuNCwgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjR7d2lkdGg6MjE0cHg7fSBpbnB1dC5zcGFuMywgdGV4dGFyZWEuc3BhbjMsIC51bmVkaXRhYmxlLWlucHV0LnNwYW4ze3dpZHRoOjE1MnB4O30gaW5wdXQuc3BhbjIsIHRleHRhcmVhLnNwYW4yLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMnt3aWR0aDo5MHB4O30gaW5wdXQuc3BhbjEsIHRleHRhcmVhLnNwYW4xLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMXt3aWR0aDoyOHB4O319QG1lZGlhIChtaW4td2lkdGg6MTIwMHB4KXsucm93e21hcmdpbi1sZWZ0Oi0zMHB4Oyp6b29tOjE7fS5yb3c6YmVmb3JlLC5yb3c6YWZ0ZXJ7ZGlzcGxheTp0YWJsZTtjb250ZW50OiIiO2xpbmUtaGVpZ2h0OjA7fSAucm93OmFmdGVye2NsZWFyOmJvdGg7fSBbY2xhc3MqPSJzcGFuIl17ZmxvYXQ6bGVmdDttaW4taGVpZ2h0OjFweDttYXJnaW4tbGVmdDozMHB4O30gLmNvbnRhaW5lciwubmF2YmFyLXN0YXRpYy10b3AgLmNvbnRhaW5lciwubmF2YmFyLWZpeGVkLXRvcCAuY29udGFpbmVyLC5uYXZiYXItZml4ZWQtYm90dG9tIC5jb250YWluZXJ7d2lkdGg6MTE3MHB4O30gLnNwYW4xMnt3aWR0aDoxMTcwcHg7fSAuc3BhbjExe3dpZHRoOjEwNzBweDt9IC5zcGFuMTB7d2lkdGg6OTcwcHg7fSAuc3Bhbjl7d2lkdGg6ODcwcHg7fSAuc3Bhbjh7d2lkdGg6NzcwcHg7fSAuc3Bhbjd7d2lkdGg6NjcwcHg7fSAuc3BhbjZ7d2lkdGg6NTcwcHg7fSAuc3BhbjV7d2lkdGg6NDcwcHg7fSAuc3BhbjR7d2lkdGg6MzcwcHg7fSAuc3BhbjN7d2lkdGg6MjcwcHg7fSAuc3BhbjJ7d2lkdGg6MTcwcHg7fSAuc3BhbjF7d2lkdGg6NzBweDt9IC5vZmZzZXQxMnttYXJnaW4tbGVmdDoxMjMwcHg7fSAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6MTEzMHB4O30gLm9mZnNldDEwe21hcmdpbi1sZWZ0OjEwMzBweDt9IC5vZmZzZXQ5e21hcmdpbi1sZWZ0OjkzMHB4O30gLm9mZnNldDh7bWFyZ2luLWxlZnQ6ODMwcHg7fSAub2Zmc2V0N3ttYXJnaW4tbGVmdDo3MzBweDt9IC5vZmZzZXQ2e21hcmdpbi1sZWZ0OjYzMHB4O30gLm9mZnNldDV7bWFyZ2luLWxlZnQ6NTMwcHg7fSAub2Zmc2V0NHttYXJnaW4tbGVmdDo0MzBweDt9IC5vZmZzZXQze21hcmdpbi1sZWZ0OjMzMHB4O30gLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MjMwcHg7fSAub2Zmc2V0MXttYXJnaW4tbGVmdDoxMzBweDt9IC5yb3ctZmx1aWR7d2lkdGg6MTAwJTsqem9vbToxO30ucm93LWZsdWlkOmJlZm9yZSwucm93LWZsdWlkOmFmdGVye2Rpc3BsYXk6dGFibGU7Y29udGVudDoiIjtsaW5lLWhlaWdodDowO30gLnJvdy1mbHVpZDphZnRlcntjbGVhcjpib3RoO30gLnJvdy1mbHVpZCBbY2xhc3MqPSJzcGFuIl17ZGlzcGxheTpibG9jazt3aWR0aDoxMDAlO21pbi1oZWlnaHQ6MzBweDstd2Via2l0LWJveC1zaXppbmc6Ym9yZGVyLWJveDstbW96LWJveC1zaXppbmc6Ym9yZGVyLWJveDtib3gtc2l6aW5nOmJvcmRlci1ib3g7ZmxvYXQ6bGVmdDttYXJnaW4tbGVmdDoyLjU2NDEwMjU2NDEwMjU2NCU7Km1hcmdpbi1sZWZ0OjIuNTEwOTExMDc0NzQwODYxNiU7fSAucm93LWZsdWlkIFtjbGFzcyo9InNwYW4iXTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowO30gLnJvdy1mbHVpZCAuY29udHJvbHMtcm93IFtjbGFzcyo9InNwYW4iXStbY2xhc3MqPSJzcGFuIl17bWFyZ2luLWxlZnQ6Mi41NjQxMDI1NjQxMDI1NjQlO30gLnJvdy1mbHVpZCAuc3BhbjEye3dpZHRoOjEwMCU7KndpZHRoOjk5Ljk0NjgwODUxMDYzODI5JTt9IC5yb3ctZmx1aWQgLnNwYW4xMXt3aWR0aDo5MS40NTI5OTE0NTI5OTE0NSU7KndpZHRoOjkxLjM5OTc5OTk2MzYyOTc1JTt9IC5yb3ctZmx1aWQgLnNwYW4xMHt3aWR0aDo4Mi45MDU5ODI5MDU5ODI5MSU7KndpZHRoOjgyLjg1Mjc5MTQxNjYyMTIlO30gLnJvdy1mbHVpZCAuc3Bhbjl7d2lkdGg6NzQuMzU4OTc0MzU4OTc0MzYlOyp3aWR0aDo3NC4zMDU3ODI4Njk2MTI2NiU7fSAucm93LWZsdWlkIC5zcGFuOHt3aWR0aDo2NS44MTE5NjU4MTE5NjU4MiU7KndpZHRoOjY1Ljc1ODc3NDMyMjYwNDExJTt9IC5yb3ctZmx1aWQgLnNwYW43e3dpZHRoOjU3LjI2NDk1NzI2NDk1NzI2JTsqd2lkdGg6NTcuMjExNzY1Nzc1NTk1NTYlO30gLnJvdy1mbHVpZCAuc3BhbjZ7d2lkdGg6NDguNzE3OTQ4NzE3OTQ4NzE1JTsqd2lkdGg6NDguNjY0NzU3MjI4NTg3MDE0JTt9IC5yb3ctZmx1aWQgLnNwYW41e3dpZHRoOjQwLjE3MDk0MDE3MDk0MDE3JTsqd2lkdGg6NDAuMTE3NzQ4NjgxNTc4NDclO30gLnJvdy1mbHVpZCAuc3BhbjR7d2lkdGg6MzEuNjIzOTMxNjIzOTMxNjI1JTsqd2lkdGg6MzEuNTcwNzQwMTM0NTY5OTI0JTt9IC5yb3ctZmx1aWQgLnNwYW4ze3dpZHRoOjIzLjA3NjkyMzA3NjkyMzA3NyU7KndpZHRoOjIzLjAyMzczMTU4NzU2MTM3NSU7fSAucm93LWZsdWlkIC5zcGFuMnt3aWR0aDoxNC41Mjk5MTQ1Mjk5MTQ1MyU7KndpZHRoOjE0LjQ3NjcyMzA0MDU1MjgyOCU7fSAucm93LWZsdWlkIC5zcGFuMXt3aWR0aDo1Ljk4MjkwNTk4MjkwNTk4MyU7KndpZHRoOjUuOTI5NzE0NDkzNTQ0MjgxJTt9IC5yb3ctZmx1aWQgLm9mZnNldDEye21hcmdpbi1sZWZ0OjEwNS4xMjgyMDUxMjgyMDUxMiU7Km1hcmdpbi1sZWZ0OjEwNS4wMjE4MjIxNDk0ODE3MSU7fSAucm93LWZsdWlkIC5vZmZzZXQxMjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxMDIuNTY0MTAyNTY0MTAyNTclOyptYXJnaW4tbGVmdDoxMDIuNDU3NzE5NTg1Mzc5MTUlO30gLnJvdy1mbHVpZCAub2Zmc2V0MTF7bWFyZ2luLWxlZnQ6OTYuNTgxMTk2NTgxMTk2NTglOyptYXJnaW4tbGVmdDo5Ni40NzQ4MTM2MDI0NzMxNiU7fSAucm93LWZsdWlkIC5vZmZzZXQxMTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo5NC4wMTcwOTQwMTcwOTQwMiU7Km1hcmdpbi1sZWZ0OjkzLjkxMDcxMTAzODM3MDYxJTt9IC5yb3ctZmx1aWQgLm9mZnNldDEwe21hcmdpbi1sZWZ0Ojg4LjAzNDE4ODAzNDE4ODAzJTsqbWFyZ2luLWxlZnQ6ODcuOTI3ODA1MDU1NDY0NjIlO30gLnJvdy1mbHVpZCAub2Zmc2V0MTA6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6ODUuNDcwMDg1NDcwMDg1NDglOyptYXJnaW4tbGVmdDo4NS4zNjM3MDI0OTEzNjIwNiU7fSAucm93LWZsdWlkIC5vZmZzZXQ5e21hcmdpbi1sZWZ0Ojc5LjQ4NzE3OTQ4NzE3OTQ5JTsqbWFyZ2luLWxlZnQ6NzkuMzgwNzk2NTA4NDU2MDclO30gLnJvdy1mbHVpZCAub2Zmc2V0OTpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDo3Ni45MjMwNzY5MjMwNzY5MyU7Km1hcmdpbi1sZWZ0Ojc2LjgxNjY5Mzk0NDM1MzUyJTt9IC5yb3ctZmx1aWQgLm9mZnNldDh7bWFyZ2luLWxlZnQ6NzAuOTQwMTcwOTQwMTcwOTQlOyptYXJnaW4tbGVmdDo3MC44MzM3ODc5NjE0NDc1MyU7fSAucm93LWZsdWlkIC5vZmZzZXQ4OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjY4LjM3NjA2ODM3NjA2ODM5JTsqbWFyZ2luLWxlZnQ6NjguMjY5Njg1Mzk3MzQ0OTclO30gLnJvdy1mbHVpZCAub2Zmc2V0N3ttYXJnaW4tbGVmdDo2Mi4zOTMxNjIzOTMxNjIzODUlOyptYXJnaW4tbGVmdDo2Mi4yODY3Nzk0MTQ0Mzg5OSU7fSAucm93LWZsdWlkIC5vZmZzZXQ3OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjU5LjgyOTA1OTgyOTA1OTgyJTsqbWFyZ2luLWxlZnQ6NTkuNzIyNjc2ODUwMzM2NDIlO30gLnJvdy1mbHVpZCAub2Zmc2V0NnttYXJnaW4tbGVmdDo1My44NDYxNTM4NDYxNTM4NCU7Km1hcmdpbi1sZWZ0OjUzLjczOTc3MDg2NzQzMDQ0NCU7fSAucm93LWZsdWlkIC5vZmZzZXQ2OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjUxLjI4MjA1MTI4MjA1MTI4JTsqbWFyZ2luLWxlZnQ6NTEuMTc1NjY4MzAzMzI3ODc1JTt9IC5yb3ctZmx1aWQgLm9mZnNldDV7bWFyZ2luLWxlZnQ6NDUuMjk5MTQ1Mjk5MTQ1Mjk1JTsqbWFyZ2luLWxlZnQ6NDUuMTkyNzYyMzIwNDIxOSU7fSAucm93LWZsdWlkIC5vZmZzZXQ1OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjQyLjczNTA0MjczNTA0MjczJTsqbWFyZ2luLWxlZnQ6NDIuNjI4NjU5NzU2MzE5MzMlO30gLnJvdy1mbHVpZCAub2Zmc2V0NHttYXJnaW4tbGVmdDozNi43NTIxMzY3NTIxMzY3NSU7Km1hcmdpbi1sZWZ0OjM2LjY0NTc1Mzc3MzQxMzM1NCU7fSAucm93LWZsdWlkIC5vZmZzZXQ0OmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjM0LjE4ODAzNDE4ODAzNDE5JTsqbWFyZ2luLWxlZnQ6MzQuMDgxNjUxMjA5MzEwNzg1JTt9IC5yb3ctZmx1aWQgLm9mZnNldDN7bWFyZ2luLWxlZnQ6MjguMjA1MTI4MjA1MTI4MjA0JTsqbWFyZ2luLWxlZnQ6MjguMDk4NzQ1MjI2NDA0OCU7fSAucm93LWZsdWlkIC5vZmZzZXQzOmZpcnN0LWNoaWxke21hcmdpbi1sZWZ0OjI1LjY0MTAyNTY0MTAyNTY0MiU7Km1hcmdpbi1sZWZ0OjI1LjUzNDY0MjY2MjMwMjI0JTt9IC5yb3ctZmx1aWQgLm9mZnNldDJ7bWFyZ2luLWxlZnQ6MTkuNjU4MTE5NjU4MTE5NjYlOyptYXJnaW4tbGVmdDoxOS41NTE3MzY2NzkzOTYyNTclO30gLnJvdy1mbHVpZCAub2Zmc2V0MjpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDoxNy4wOTQwMTcwOTQwMTcwOTQlOyptYXJnaW4tbGVmdDoxNi45ODc2MzQxMTUyOTM2OSU7fSAucm93LWZsdWlkIC5vZmZzZXQxe21hcmdpbi1sZWZ0OjExLjExMTExMTExMTExMTExJTsqbWFyZ2luLWxlZnQ6MTEuMDA0NzI4MTMyMzg3NzA4JTt9IC5yb3ctZmx1aWQgLm9mZnNldDE6Zmlyc3QtY2hpbGR7bWFyZ2luLWxlZnQ6OC41NDcwMDg1NDcwMDg1NDclOyptYXJnaW4tbGVmdDo4LjQ0MDYyNTU2ODI4NTE0MiU7fSBpbnB1dCx0ZXh0YXJlYSwudW5lZGl0YWJsZS1pbnB1dHttYXJnaW4tbGVmdDowO30gLmNvbnRyb2xzLXJvdyBbY2xhc3MqPSJzcGFuIl0rW2NsYXNzKj0ic3BhbiJde21hcmdpbi1sZWZ0OjMwcHg7fSBpbnB1dC5zcGFuMTIsIHRleHRhcmVhLnNwYW4xMiwgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjEye3dpZHRoOjExNTZweDt9IGlucHV0LnNwYW4xMSwgdGV4dGFyZWEuc3BhbjExLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMTF7d2lkdGg6MTA1NnB4O30gaW5wdXQuc3BhbjEwLCB0ZXh0YXJlYS5zcGFuMTAsIC51bmVkaXRhYmxlLWlucHV0LnNwYW4xMHt3aWR0aDo5NTZweDt9IGlucHV0LnNwYW45LCB0ZXh0YXJlYS5zcGFuOSwgLnVuZWRpdGFibGUtaW5wdXQuc3Bhbjl7d2lkdGg6ODU2cHg7fSBpbnB1dC5zcGFuOCwgdGV4dGFyZWEuc3BhbjgsIC51bmVkaXRhYmxlLWlucHV0LnNwYW44e3dpZHRoOjc1NnB4O30gaW5wdXQuc3BhbjcsIHRleHRhcmVhLnNwYW43LCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuN3t3aWR0aDo2NTZweDt9IGlucHV0LnNwYW42LCB0ZXh0YXJlYS5zcGFuNiwgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjZ7d2lkdGg6NTU2cHg7fSBpbnB1dC5zcGFuNSwgdGV4dGFyZWEuc3BhbjUsIC51bmVkaXRhYmxlLWlucHV0LnNwYW41e3dpZHRoOjQ1NnB4O30gaW5wdXQuc3BhbjQsIHRleHRhcmVhLnNwYW40LCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuNHt3aWR0aDozNTZweDt9IGlucHV0LnNwYW4zLCB0ZXh0YXJlYS5zcGFuMywgLnVuZWRpdGFibGUtaW5wdXQuc3BhbjN7d2lkdGg6MjU2cHg7fSBpbnB1dC5zcGFuMiwgdGV4dGFyZWEuc3BhbjIsIC51bmVkaXRhYmxlLWlucHV0LnNwYW4ye3dpZHRoOjE1NnB4O30gaW5wdXQuc3BhbjEsIHRleHRhcmVhLnNwYW4xLCAudW5lZGl0YWJsZS1pbnB1dC5zcGFuMXt3aWR0aDo1NnB4O30gLnRodW1ibmFpbHN7bWFyZ2luLWxlZnQ6LTMwcHg7fSAudGh1bWJuYWlscz5saXttYXJnaW4tbGVmdDozMHB4O30gLnJvdy1mbHVpZCAudGh1bWJuYWlsc3ttYXJnaW4tbGVmdDowO319QG1lZGlhIChtYXgtd2lkdGg6OTc5cHgpe2JvZHl7cGFkZGluZy10b3A6MDt9IC5uYXZiYXItZml4ZWQtdG9wLC5uYXZiYXItZml4ZWQtYm90dG9te3Bvc2l0aW9uOnN0YXRpYzt9IC5uYXZiYXItZml4ZWQtdG9we21hcmdpbi1ib3R0b206MjBweDt9IC5uYXZiYXItZml4ZWQtYm90dG9te21hcmdpbi10b3A6MjBweDt9IC5uYXZiYXItZml4ZWQtdG9wIC5uYXZiYXItaW5uZXIsLm5hdmJhci1maXhlZC1ib3R0b20gLm5hdmJhci1pbm5lcntwYWRkaW5nOjVweDt9IC5uYXZiYXIgLmNvbnRhaW5lcnt3aWR0aDphdXRvO3BhZGRpbmc6MDt9IC5uYXZiYXIgLmJyYW5ke3BhZGRpbmctbGVmdDoxMHB4O3BhZGRpbmctcmlnaHQ6MTBweDttYXJnaW46MCAwIDAgLTVweDt9IC5uYXYtY29sbGFwc2V7Y2xlYXI6Ym90aDt9IC5uYXYtY29sbGFwc2UgLm5hdntmbG9hdDpub25lO21hcmdpbjowIDAgMTBweDt9IC5uYXYtY29sbGFwc2UgLm5hdj5saXtmbG9hdDpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2PmxpPmF7bWFyZ2luLWJvdHRvbToycHg7fSAubmF2LWNvbGxhcHNlIC5uYXY+LmRpdmlkZXItdmVydGljYWx7ZGlzcGxheTpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2IC5uYXYtaGVhZGVye2NvbG9yOiM3Nzc3Nzc7dGV4dC1zaGFkb3c6bm9uZTt9IC5uYXYtY29sbGFwc2UgLm5hdj5saT5hLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYXtwYWRkaW5nOjlweCAxNXB4O2ZvbnQtd2VpZ2h0OmJvbGQ7Y29sb3I6Izc3Nzc3Nzstd2Via2l0LWJvcmRlci1yYWRpdXM6M3B4Oy1tb3otYm9yZGVyLXJhZGl1czozcHg7Ym9yZGVyLXJhZGl1czozcHg7fSAubmF2LWNvbGxhcHNlIC5idG57cGFkZGluZzo0cHggMTBweCA0cHg7Zm9udC13ZWlnaHQ6bm9ybWFsOy13ZWJraXQtYm9yZGVyLXJhZGl1czo0cHg7LW1vei1ib3JkZXItcmFkaXVzOjRweDtib3JkZXItcmFkaXVzOjRweDt9IC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgbGkrbGkgYXttYXJnaW4tYm90dG9tOjJweDt9IC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYTpob3ZlcntiYWNrZ3JvdW5kLWNvbG9yOiNmMmYyZjI7fSAubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAubmF2PmxpPmEsLm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgYXtjb2xvcjojOTk5OTk5O30gLm5hdmJhci1pbnZlcnNlIC5uYXYtY29sbGFwc2UgLm5hdj5saT5hOmhvdmVyLC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51IGE6aG92ZXJ7YmFja2dyb3VuZC1jb2xvcjojMTExMTExO30gLm5hdi1jb2xsYXBzZS5pbiAuYnRuLWdyb3Vwe21hcmdpbi10b3A6NXB4O3BhZGRpbmc6MDt9IC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnV7cG9zaXRpb246c3RhdGljO3RvcDphdXRvO2xlZnQ6YXV0bztmbG9hdDpub25lO2Rpc3BsYXk6bm9uZTttYXgtd2lkdGg6bm9uZTttYXJnaW46MCAxNXB4O3BhZGRpbmc6MDtiYWNrZ3JvdW5kLWNvbG9yOnRyYW5zcGFyZW50O2JvcmRlcjpub25lOy13ZWJraXQtYm9yZGVyLXJhZGl1czowOy1tb3otYm9yZGVyLXJhZGl1czowO2JvcmRlci1yYWRpdXM6MDstd2Via2l0LWJveC1zaGFkb3c6bm9uZTstbW96LWJveC1zaGFkb3c6bm9uZTtib3gtc2hhZG93Om5vbmU7fSAubmF2LWNvbGxhcHNlIC5vcGVuPi5kcm9wZG93bi1tZW51e2Rpc3BsYXk6YmxvY2s7fSAubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51OmJlZm9yZSwubmF2LWNvbGxhcHNlIC5kcm9wZG93bi1tZW51OmFmdGVye2Rpc3BsYXk6bm9uZTt9IC5uYXYtY29sbGFwc2UgLmRyb3Bkb3duLW1lbnUgLmRpdmlkZXJ7ZGlzcGxheTpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2PmxpPi5kcm9wZG93bi1tZW51OmJlZm9yZSwubmF2LWNvbGxhcHNlIC5uYXY+bGk+LmRyb3Bkb3duLW1lbnU6YWZ0ZXJ7ZGlzcGxheTpub25lO30gLm5hdi1jb2xsYXBzZSAubmF2YmFyLWZvcm0sLm5hdi1jb2xsYXBzZSAubmF2YmFyLXNlYXJjaHtmbG9hdDpub25lO3BhZGRpbmc6MTBweCAxNXB4O21hcmdpbjoxMHB4IDA7Ym9yZGVyLXRvcDoxcHggc29saWQgI2YyZjJmMjtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZjJmMmYyOy13ZWJraXQtYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpOy1tb3otYm94LXNoYWRvdzppbnNldCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpLCAwIDFweCAwIHJnYmEoMjU1LDI1NSwyNTUsLjEpO2JveC1zaGFkb3c6aW5zZXQgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xKSwgMCAxcHggMCByZ2JhKDI1NSwyNTUsMjU1LC4xKTt9IC5uYXZiYXItaW52ZXJzZSAubmF2LWNvbGxhcHNlIC5uYXZiYXItZm9ybSwubmF2YmFyLWludmVyc2UgLm5hdi1jb2xsYXBzZSAubmF2YmFyLXNlYXJjaHtib3JkZXItdG9wLWNvbG9yOiMxMTExMTE7Ym9yZGVyLWJvdHRvbS1jb2xvcjojMTExMTExO30gLm5hdmJhciAubmF2LWNvbGxhcHNlIC5uYXYucHVsbC1yaWdodHtmbG9hdDpub25lO21hcmdpbi1sZWZ0OjA7fSAubmF2LWNvbGxhcHNlLC5uYXYtY29sbGFwc2UuY29sbGFwc2V7b3ZlcmZsb3c6aGlkZGVuO2hlaWdodDowO30gLm5hdmJhciAuYnRuLW5hdmJhcntkaXNwbGF5OmJsb2NrO30gLm5hdmJhci1zdGF0aWMgLm5hdmJhci1pbm5lcntwYWRkaW5nLWxlZnQ6MTBweDtwYWRkaW5nLXJpZ2h0OjEwcHg7fX1AbWVkaWEgKG1pbi13aWR0aDo5ODBweCl7Lm5hdi1jb2xsYXBzZS5jb2xsYXBzZXtoZWlnaHQ6YXV0byAhaW1wb3J0YW50O292ZXJmbG93OnZpc2libGUgIWltcG9ydGFudDt9fQ==';
	@mkdir('css');
	$css = base64_decode($css);
	foreach($cVals as $k=>$v) {
		$css_copy=$css;
		for($i=0;$i<count($cNames);$i++) $css_copy=str_replace($cNames[$i],'#'.$v[$i],$css_copy);
		if($h=@fopen('css/style_'.$k.'.css','w')) {fputs($h,$css_copy);fclose($h);}
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

	$form ='<br /><a class="btn btn-warning" href="#register" data-toggle="collapse" data-target="#register"><i class="icon-user icon-white"></i> Créer un compte <span class="caret"></span></a>';
    
    ///////// INSCRIPTION
	$form .='<!-- Modal -->
<div class="collapse" id="register">
  <div class="page-header">
    <h3>Nouvelle Inscription</h3>
  </div>
  
 <form action="index.php" method="post" enctype="multipart/form-data" class="form-horizontal" onsubmit="return checkform(this);">
  <input type="hidden" name="action" value="newuser" />
  <input type="hidden" name="MAX_FILE_SIZE" value=".$maxAvatarSize." />
  
  <div class="control-group success">
    <label class="control-label" for="login">Nom d\'utilisateur</label>
    <div class="controls">
     <div class="input-prepend">
      <span class="add-on"><i class="icon-user"></i></span>
      <input type="text" name="login">
     </div>
    </div>
  </div>
  <div class="control-group success">
    <label class="control-label" for="password">Mot de passe</label>
    <div class="controls">
     <div class="input-prepend">
      <span class="add-on"><i class="icon-lock"></i></span>
      <input type="password" id="password" name="password">
     </div>
    </div>
  </div>
  <div class="control-group success">
    <label class="control-label" for="birthday">Date d\'anniversaire</label>
    <div class="controls">
     <div class="input-prepend">
      <span class="add-on"><i class="icon-calendar"></i></span>
      <input type="text" id="birthday" name="birthday" placeholder="Jour/Mois/Année">
     </div>
    </div>
  </div>
  <div class="control-group success">
    <label class="control-label" for="email">Adresse email</label>
    <div class="controls">
     <div class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="input-xlarge" type="email" id="email" name="email">
     </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="site">Site Web</label>
    <div class="controls">
     <div class="input-prepend">
      <span class="add-on"><i class="icon-globe"></i></span>
      <input class="input-xlarge" type="url" id="site" name="site">
     </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="site">Signature</label>
    <div class="controls">
      <textarea class="input-xxlarge" rows="2" id="signature" name="signature" maxlength="150" placeholder="Aucune mise en forme possible et limité a 150 caractères"></textarea>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="site">Avatar <span class="badge badge-warning">&lt; '.($maxAvatarSize/1024).'ko</span></label>
    <div class="controls">
      <input type="file" id="avatar" name="avatar">
      <span class="help-inline alert alert-info"><i class="icon-exclamation-sign"></i> Les champs de couleur verte sont obligatoires. Si l\'identifiant comporte / \ &amp; \" \' . ou des espaces, ils seront retirés.</span>
    </div>
  </div>
  <div class="control-group success">
    <label class="control-label" for="code">Code de vérification</label>
    <div class="controls">
     <div class="input-prepend input-append">
       <p class="add-on"><span id="txtCaptchaDiv" class="text-success"></span></p>
       <input type="hidden" id="txtCaptcha" />
       <input class="span2" type="text" name="txtInput" id="txtInput">
       <button type="submit" class="btn btn-success"><i class="icon-hand-right icon-white"></i> S\'inscrire</button>
     </div>
    </div>     
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
  <div class="control-group">
    <label class="control-label" for="birthday">Date d\'anniversaire</label>
    <div class="controls">
      <input type="text" id="birthday" name="birthday" value="'.$birthday.'" placeholder="Jour/Mois/Année">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">Mail</label>
    <div class="controls">
      <input type="email" id="email" name="email" value="'.$email.'">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="site">Site Web</label>
    <div class="controls">
      <input type="url" id="site" name="site" value="'.$site.'">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="signature">Signature</label>
    <div class="controls">
      <textarea class="input-xxlarge" rows="2" id="signature" name="signature" maxlength="150" placeholder="Aucune mise en forme possible et limité a 150 caractères">'.$signature.'</textarea>
    </div>
  </div>  
  <div class="control-group">
    <label class="control-label" for="site">Avatar <span class="badge badge-warning">&lt; '.($maxAvatarSize/1024).'ko</span></label>
    <div class="controls">
      <input type="file" id="avatar" name="avatar">
    </div>
  </div>      
  <div class="form-actions">
     <button type="submit" class="btn btn-primary">Valider</button>
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
          <ul class="dropdown-menu">'.$smileys.'</ul>
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
		    <form action="index.php" method="post" class="navbar-form pull-right">
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
	                 <td style="width:60%;"Titre du sujet</td>
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
		} else $buffer .= clean($titre);
		$buffer .= '</div>';
		// tooltips
		list($num,$auths)=$topicObj->getInfo(1);
		foreach($auths as $m) {
			if($forum->isMember($m)) {
				list($password,$time,$mail,$quote,$url,$birthday,$pic,$mod,$max)=$forum->getMember($m);
				// Déclaration de l'avatar ou défaut avatar
				$avatars[$m]=($pic!='')?'<img class="avatar" src="'.$pic.'" alt="avatar"/>':img(11,'img-circle');
				$buffer .= '<!-- Modal -->
<div id="show_'.$m.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="show_'.$m.'" aria-hidden="true">
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
		$buffer .= '<p><b>Signature:</b> <br><blockquote>'.$quote.'</blockquote></p>';
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
			$buffer .= '<table class="table table-condensed clearfix"><tr>';
			if($forum->isMember($auth)) {
				$buffer .= '<td class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
               <li class="nav-header"><a href="?private='.$auth.'" rel="tooltip" title="Envoyer un message privé">'.$auth.'</a></li>				
               <li class="span1">
                <a class="thumbnail" href="#show_'.$auth.'" role="button" data-toggle="modal" rel="tooltip" title="Afficher le profil">
                  '.$avatars[$auth].'
                </a>
               </li>
               <div class="clearfix"></div>
               <li class="divider"></li>
               <li>'.$modo[$auth].'</li>
               <li class="divider"></li>';
			} else {
				$buffer .= '<td class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="span2">
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
            $buffer .= '<a class="btn btn-mini" href="'.baseURL().'#bottom" onclick="quote("'.$auth.'",'.$cnt.')" rel="tooltip" title="citer le message de '.$auth.'" /><i class="icon-comment"></i> Citer</a></div></li>
			<li class="divider"></li>
			<li class="muted">'.date('d/m/y à H:i', $time).'</li>
			    </ul>
			</td>';
			// Message
			$buffer .= '<td class="span9" id="td'.$cnt.'">'.decode($content).'<div class="clearfix"></div>';
			if(!empty($attach)){
				$attachment = explode('/', $attach);
				$buffer .= '<p class="pull-right"><a href="?pid='.base64_encode($attach).'" rel="tooltip" title="Télécharger"><i class="icon-file"></i> '.$attachment[2].'</a></p>';
			}
			// Citation									
			if(isset($quotes[$auth])) $buffer .= '<hr /><blockquote class="text-info"><p>'.$quotes[$auth].'</p></blockquote>';			
			$buffer .= '</td></tr>';
			$buffer .= '</table>';
			$cnt++;
		}
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
function birthday($birthdate, $pattern = 'eu'){
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
		if($birthday!='') {
			$birthday = str_replace(' ', '', $birthday);
			$birthday = preg_replace('/([0-9]{2})+([0-9]{2})+([0-9]{2})+(.*)/i', '\\1 \\2 \\3', $birthday);
		} else $birthday = '&nbsp;';
		$avatar=($pic != '')?'<img style="width:80px; height:80px;" src="'.$pic.'" alt="Avatar" />':img(11,'img-circle');
		// PopOver
		$annu .= '<!-- Modal -->
<div id="show_'.$m.'" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="show_'.$m.'" aria-hidden="true">
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
		$annu .= '<p><b>Signature:</b> <br><blockquote>'.$quote.'</blockquote></p>';
	}  
$annu .= '				  
  </div>
  <div class="modal-footer">
    <a class="btn btn-primary" href="?private='.$m.'">Envoyer un message privé</a>
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
  </div>
</div>';
					
		$annu .= '<tr>';
		$annu .= '<td><a href="#show_'.$m.'" role="button" data-toggle="modal" rel="tooltip" title="Afficher le profil">'.$m.'</a></td>';
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
		$buffer .= '<div class="control-group">
    <label class="control-label" for="titre">Titre du sujet</label>
    <div class="controls">
      <input type="text" id="titre" name="titre" maxlength="35">
    </div>
  </div>';
		if($isadmin) $buffer .= '<div class="control-group">
    <label class="control-label" for="postit"><i class="icon-star"></i> Épinglé</label>
    <div class="controls">
      <input type="checkbox" id="postit" name="postit" value="1">
    </div>
  </div>';
	}
	if(!$cLogin) $buffer .= '<div class="control-group">
    <label class="control-label" for="anonymous">Utilisateur (obligatoire)</label>
    <div class="controls">
      <input type="text" id="anonymous" name="anonymous" maxlength="35">
    </div>
  </div>';
	
    $buffer .= formattingHelp();
	$buffer .= '<div class="control-group">
    <label class="control-label" for="message">Message</label>
    <div class="controls">
      <textarea class="input-xxlarge" rows="10" id="message" name="message">';
	if($edit) $buffer .= $content;
	$buffer .= '</textarea></div></div>';
	
	if($join) $buffer .= '<div class="control-group">
    <label class="control-label" for="anonymous">Joindre un fichier</label>
    <div class="controls">
      <input type="file" id="attachment" name="attachment" />
    </div>
  </div>';
  	
	$buffer .= '<div class="form-actions">
  <button type="submit" class="btn btn-success"><i class="icon-arrow-right icon-white"></i> Envoyer</button>
</div>
</form>
</div>';
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
	global $uforum,$nbrMsgIndex,$extStr,$maxAvatarSize,$wt,$forumMode,$quoteMode,$siteUrl,$siteName,$lang;
	
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
  <div class="control-group">
    <label class="control-label">Max. messages en index</label>
    <div class="controls">
      <input type="text" name="nbmess" value="'.$nbrMsgIndex.'" class="span1" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Langue</label>
    <div class="controls">
      <input type="text" name="uflang" value="'.$lang.'" class="span1" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Poid max. d\'un avatar (ko)</label>
    <div class="controls">
      <input type="text" name="maxav" value="'.($maxAvatarSize/1024).'" class="span1" />
    </div>
  </div>
  <div class="control-group">
    <label class="control-label">Extensions autorisées</label>
    <div class="controls">
      <input type="text" name="exts" value="'.clean($extStr).'" />
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label">Forum mode privé</label>
    <div class="controls">
      <input name="fmode" value="1" type="checkbox" '.$fmode.'/>
    </div>
  </div> 
  <div class="control-group">
    <label class="control-label">Signature en fin de message</label>
    <div class="controls">
      <input name="qmode" value="1" type="checkbox" '.$qmode.'/>
    </div>
  </div>         
  <div class="control-group">
    <label class="control-label">Message d\'accueil</label>
    <div class="controls">
      <textarea class="input-xxlarge" rows="20" id="message" name="message">'.$wtp.'</textarea>
    </div>
  </div> 
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
$gets=array('topic','action','logout','memberlist','login','password','editprofil','email','birthday','site','signature','titre','message','topicID','postID','deluser','switchuser','delpost','editpost','style','private','delprivate','mpTo','backup','restore','read','conf','uftitle','nbmess','maxav','exts','fmode','anonymous','qmode','postit','ufsite','uflang','ufsitename','rc','ntitle','pid');
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
	// on nettoie le login
	$login = str_replace(array(" ", '"', "'", "/", "&", "."), array("", '', "", "", "", ""), $login);
	$login = clean($login);
	$avatar='';
	if(in_array($login,$forum->listMember())) $error .= 'Cet utilisateur existe déjà !';
	else if($login != '' && $password != '' && $email != ''){
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
		$error .= 'Remplissez au moins les champs Identifiant, Mot de passe et adresse mail !';
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
	$siteName=$ufsitename?$ufsitename:'Retour';
	$config ="<?\$uforum='$uforum';\$utitle='$uftitle';\$lang=$uflang;\$nbrMsgIndex=$nbrMsgIndex;\$extensionsAutorises='$extStr';\$maxAvatarSize=$maxAvatarSize;\$forumMode=$forumMode;\$quoteMode=$quoteMode;\$siteUrl='$siteUrl';\$siteName='$siteName';\$siteBase='$siteBase';?>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
<?php
echo '<base href="'.$siteBase.'" />';
echo '<link rel="stylesheet" href="css/style_'.$cStyle.'.css" />';
?>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
   
    <!-- Le javascript
    ================================================== -->
    <script src="http://twitter.github.com/bootstrap/assets/js/jquery.js"></script> 
    <script src="http://twitter.github.com/bootstrap/assets/js/bootstrap.min.js"></script> 
<script>//<![CDATA[ 
    !function(a){a(function(){a("#top").tooltip({selector:"a[rel=tooltip]"});a("#top").popover();a("a[rel=popover]").popover().click(function(b){b.preventDefault()})})}(window.jQuery);
//]]></script>      
<?php
if(preg_match('/.gif$|.jpg$|.png$/i',$uforum) && file_exists($uforum)) {
	$tmp='<a href="index.php" title="'.htmlspecialchars($siteName, ENT_QUOTES).'"><img src="'.$uforum.'" alt="'.htmlspecialchars($siteName, ENT_QUOTES).'" /></a>';
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

// message d erreur ( en cas de mauvais password, user deja existant etc...)
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
	else { echo showTopics(); $st=1; }
	if(!$forumMode && !$ismember) { echo registerForm(); if(isset($st)) echo welcomeText();}
	if($havemp) echo showPrivateMsg();
} else {
	echo registerForm();
	echo welcomeText();
}


$arr_cnct=$conn->updateVisit($cLogin);
$stats=$forum->getStat();
echo '<hr />

      <div class="row-fluid container-narrow">
       <div class="span12 well">
        <div class="span6"><h4>Statistiques</h4>';
if($stats[0]>1) {$a[0]='s';$a[1]='ont';}
else {$a[0]='';$a[1]='a';}
$m=($stats[3]>1)?'s':'';
$s=($stats[2]>1)?'s':'';
$arr_cnct[0]=($arr_cnct[0])?$arr_cnct[0]:'aucun';

echo '<p>Nous avons '.$stats[3].' message'.$m.' dans '.$stats[2].' sujet'.$s.'. </p>';
echo '<p>Bienvenue à notre nouveau membre, <span class="text-warning">'.$stats[1].'</span><p>
      <p>Total Membre'.$a[0].': '. $stats[0].'</p>
      </div>
      <div class="span6">
      <h4>Qui est en ligne ?</h4>
      <p>Actuellement connectés : <b>'.$arr_cnct[0].'</b> ,Visiteurs : '.$arr_cnct[1];
echo ' </p>
      <h4>Légende</h4>
      <p><i class="icon-folder-open"></i> Ne contient pas de messages non lus. <i class="icon-star"></i> Épinglé</p> 
      <p><i class="icon-folder-close"></i> Contient des messages non lus. <i class="icon-file"></i> Pièce jointe</p>
        </div>
       </div>
      </div>';

echo '<hr />


      <div class="footer container-narrow">
        <p>Copyright © 2010-'.date('Y').' '.$tmp.', tous droits réservés. <span class="pull-right">Propulsé par <a id="bottom" name="bottom" href="http://uforum.byethost5.com" rel="tooltip" title="Forum sans Sql">µForum v'.$version.'</a>  <a href="'.baseURL().'#top" rel="tooltip" title="Haut de page"><i class="icon-chevron-up"></i></a></span></p>
      </div>';
?>
    <!-- Le javascript
    ================================================== -->
    <script type="text/javascript">//<![CDATA[
var activeSub=0;var SubNum=0;var timerID=null;var timerOn=false;var timecount=300;var what=null;var newbrowser=true;var check=false;var layerRef="";var tm="";var confirmMsg="Confirmez la suppression de ";var msie=navigator.userAgent.toLowerCase().indexOf("msie")+1;wmtt=null;document.onmousemove=updateWMTT;function init(){if(document.layers){layerRef="document.layers";styleSwitch="";visibleVar="show";what="ns4"}else{if(document.all){layerRef="document.all";styleSwitch=".style";visibleVar="visible";what="ie"}else{if(document.getElementById){layerRef="document.getElementByID";styleSwitch=".style";visibleVar="visible";what="moz"}else{what="none";newbrowser=false}}}check=true}function switchLayer(a){if(check){if(what=="none"){return}else{if(what=="moz"){if(document.getElementById(a).style.visibility=="visible"){document.getElementById(a).style.visibility="hidden";document.getElementById(a).style.display="none"}else{document.getElementById(a).style.visibility="visible";document.getElementById(a).style.display="block"}}else{if(document.all[a].style.visibility=="visible"){document.all[a].style.visibility="hidden";document.all[a].style.display="none"}else{document.all[a].style.visibility="visible";document.all[a].style.display="block"}}}}else{return}}function countInstances(c,b){var a=document.formulaire.message.value.split(c);var d=document.formulaire.message.value.split(b);return a.length+d.length-2}function insert(e,c){var b=document.getElementById("message");if(document.selection){var g=document.selection.createRange().text;document.formulaire.message.focus();var d=document.selection.createRange();if(c!=""){if(g==""){var f=countInstances(e,c);if(f%2!=0){d.text=d.text+c}else{d.text=d.text+e}}else{d.text=e+d.text+c}}else{d.text=d.text+e}}else{if(b.selectionStart|b.selectionStart==0){if(b.selectionEnd>b.value.length){b.selectionEnd=b.value.length}var h=b.selectionStart;var a=b.selectionEnd+e.length;b.value=b.value.slice(0,h)+e+b.value.slice(h);b.value=b.value.slice(0,a)+c+b.value.slice(a);b.selectionStart=h+e.length;b.selectionEnd=a;b.focus()}else{var d=document.formulaire.message;var f=countInstances(e,c);if(f%2!=0&&c!=""){d.value=d.value+c}else{d.value=d.value+e}}}}function updateWMTT(a){if(document.documentElement.scrollTop&&msie){x=window.event.x+document.documentElement.scrollLeft+10;y=window.event.y+document.documentElement.scrollTop+10}else{x=(document.all)?window.event.x+document.body.scrollLeft+10:(a.pageX+10)+"px";y=(document.all)?window.event.y+document.body.scrollTop+10:(a.pageY+10)+"px"}if(wmtt!=null){wmtt.style.left=x;wmtt.style.top=y}}function quote(c,f){var a=document.getElementById("td"+f).innerHTML;var b=new Array("<fieldset.*?>.*?</fieldset>","<br>|<br />","<small>.*?</small>|<pre>|</pre>|<font.*?>|</font>|&nbsp;","<b>","</b>","<i>","</i>","<u>","</u>","&amp;lt;|&lt;","&amp;gt;|&gt;","<hr />",'<img(.*?)src="pictures/(.*?)"(.*?)>');var e=new Array("","\n","","[b]","[/b]","[i]","[/i]","[u]","[/u]","<",">","[hr]","[sm=$2]");var d=0;for(i in b){regex=new RegExp(b[i],"gi");a=a.replace(regex,e[d++])}if(document.getElementById("form").style.visibility!="visible"){switchLayer("form")}document.getElementById("message").value+="[q="+c+"]"+a+"[/q]\n"}function confirmLink(b,c){var a=confirm(confirmMsg+" :\n"+c);if(a){b.href+="&amp;do=1"}return a}    
function checkform(f){var g="";if(f.txtInput.value==""){g+="- Code de sécurité ne doit pas être vide.\n"}if(f.txtInput.value!=""){if(ValidCaptcha(f.txtInput.value)==false){g+="- Code de sécurité ne correspond pas.\n"}}if(g!=""){alert(g);return false}}var a=Math.ceil(Math.random()*9)+"";var b=Math.ceil(Math.random()*9)+"";var c=Math.ceil(Math.random()*9)+"";var d=Math.ceil(Math.random()*9)+"";var e=Math.ceil(Math.random()*9)+"";var code=a+b+c+d+e;document.getElementById("txtCaptcha").value=code;document.getElementById("txtCaptchaDiv").innerHTML=code;function ValidCaptcha(){var g=removeSpaces(document.getElementById("txtCaptcha").value);var f=removeSpaces(document.getElementById("txtInput").value);if(g==f){return true}else{return false}}function removeSpaces(f){return f.split(" ").join("")};
//]]></script>

  </body>
</html>