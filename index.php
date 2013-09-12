<?php
# ------------------ BEGIN LICENSE BLOCK ------------------
#
# This file is part of µForum project: http://uforum.is-great.net
#
# @update     03-06-2013
# @copyright  2011-2013  Frédéric Kaplon and contributors
# @copyright   ~   2008  Okkin  Avetenebrae
# @license    http://www.gnu.org/licenses/lgpl-3.0.txt GNU LESSER GENERAL PUBLIC LICENSE (LGPL) version 3
# @link       http://uforum.is-great.net   µForum
# @version    Release: @package_version@
#
# ------------------- END LICENSE BLOCK -------------------
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
/*
** Version de µForum
*/
$version = '1.0 Beta';
/**
 * VARIABLES CLEFS
 */
$siteUrl=baseURL(); // pour un upgrade,  enlever dans les futures versions
$lang = 'fr';
@mkdir('lang/');
mklang();
if(!file_exists('lang/' .$lang. '.lng.php')) {
	require 'lang/' .$lang. '.lng.php';
} else {
	require 'lang/fr.lng.php';
}

foreach($LANG as $key => $value) {
	if(!defined($key)) define($key,$value);
}
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
/**
*
* Vérification de la version de php
*/
if (version_compare(PHP_VERSION, '5.3', '<')) {
    die(PHP_VERIF);
}
/**
*
* Choix du style (en feature)
*/
$cNames=array('[lt]','[dk]','[lk]','[ct]','[bk]','[br]');
$cVals['defaut']=array('e8ebed','b1c5d0','91a5b0','f90','eee','999');
$cVals['green']=array('ebede8','c5d0b1','a5b091','f90','eee','999');
$cVals['cyan']=array('e8edeb','b1d0c5','91b0a5','f90','eee','999');
$cVals['purple']=array('ede8eb','d0b1c5','b091a5','f90','eee','999');
$cVals['clean']=array('f9f9f6','f9f9f6','999','f90','333','fff');
/**
*
* TEXTE D'ACCEUIL ENCODÉ
*/
$wt = BBCODE_WELCOM_TXT;
/**
*
* NOMS DES IMAGES POUR LE DÉCODAGE
*/
$img_names = array('smile','wink','laugh','indifferent','sad','wry','tongue','sorry','arrow','mail','window','clip','avatar');
/**
*
* SAUVEGARDE LES OBJETS
*/
class SaveObj
{
	var $name= '';
	function saveObj() {
		if (!empty($this->name)) {
			if($fp=fopen($this->name,'w')) { 
				fputs($fp, serialize($this));
				fclose($fp);
			}
		}
	}
}
/**
*
* CLASS GLOBAL RETOURNANT TABLEAUX
*/
class Forum extends SaveObj {
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
class Topic extends SaveObj {
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
class Visit extends saveObj {
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
				if($this->conn[$k][0]!='') $arr.=($r==$k)?$id.' ':'<a class="Lien" href="?private='.$this->conn[$k][0].'" title="Envoyer un message privé">'.$this->conn[$k][0].'</a> ';
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
class Messages extends saveObj {
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
function cleanUser($str,$charset='utf-8') {
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		$str = str_replace(array(" ", '"', "'", "/", "&", ".", "!", "?", ":"), array("", '', "", "", "", "", "", "", ""), $str);
	    return $str;
}
/**
*
* SUPPRIME LES CARACTERES SPÉCIAUX
*/
function removeAccents($str,$charset='utf-8') {
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
function baseURL() {
	$dir = dirname($_SERVER['SCRIPT_NAME']);
	return '//' .$_SERVER['SERVER_NAME'].$dir.($dir === '/'? '' : '/');
}
/**
*
* RETOURNE L'URL
*/
function getURL() {
    $url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    return $url;
}  
/**
*
* CRÉATION DU FICHIER LANG
*/
function mklang() {
	$fr ="<?php
\$LANG = array(


# Installation & Configuration
'PHP_VERIF' => 'Vous devez disposer d\'un serveur équipé de PHP 5.3 ou plus !',
'THEME' => 'Thème',
'LANG' => 'Language',
'PLUGIN' => 'Plugin',
'CONFIG' => 'Configuration',
'REDIRECT' => 'Redirection vers',
'POWEREDBY' => 'Propulsé par <a id=\"bottom\" name=\"bottom\" href=\"http://uforum.is-great.net\" title=\"Forum sans Sql\">µForum</a>',
'BBCODE_WELCOM_TXT' => '[b][i]Bienvenue sur µforum[/i][/b]

Ce forum monothread est basé sur des fichiers uniquement (pas de base de données sql).
Le concept est un peu différent des autres forums puisque l\'information la plus importante mise en avant pour reconnaître un utilisateur est son avatar (pour une fois qu\'il sert à quelque chose..)

[u][b]Il intègre plusieurs fonctionnalités :[/b][/u] [i](★ = Nouveauté)[/i]

[c]✔ Gestion des membres par login / mot de passe (par cookies).
✔ 4 niveaux d\'utilisateurs : Administrateur, Modérateur, Membre, Anonyme.
✔ Mode privé / public, pour autoriser les non-membres.
✔ Liste des membres.
✔ Profil utilisateur (+ édition).
✔ Messagerie privée entre les membres.
✔ Upload d\'avatar et de pièces jointes (avec filtre d\'extensions).
✔ Smileys et BBCodes (ajout automatique des balises fermantes manquantes).
★ Coupure des chaines trop longues sans couper les phrases !
✔ Skins.
✔ Liens automatiques.
★ Html5 et css3 (Bootstrap de twitter).
✔ Affichage des connectés.
✔ Coloration syntaxique du code.
✔ Gestion des options d\'administration.
✔ Système simple de sauvegarde et restauration. (revu)
★ Captcha lors de l\'inscription.
★ Protection des mails, sur la liste des membres, pour contrer le spam.   
★ Indicateur de message (Status Icône).  
★ Date de naissance + Âge affiché si celle-ci renseignée.
★ Date picker (Inscription et édition du profil). 
★ Méta description pour le SEO.[/c]',
'WELCOME_TXT' => '<b><i>Bienvenue sur µforum</i></b> <br /> <br />Ce forum monothread est basé sur des fichiers uniquement (pas de base de données sql). <br />Le concept est un peu différent des autres forums puisque l\'information la plus importante mise en avant pour reconnaître un utilisateur est son avatar (pour une fois qu\'il sert à quelque chose..) <br /> <br /><ins><b>Il intègre plusieurs fonctionnalités :</b></ins> <i>(★ = Nouveauté)</i> <br /> <br /><pre>✔ Gestion des membres par login / mot de passe (par cookies). <br />✔ 4 niveaux d\'utilisateurs : Administrateur, Modérateur, Membre, Anonyme. <br />✔ Mode privé / public, pour autoriser les non-membres. <br />✔ Liste des membres. <br />✔ Profil utilisateur (+ édition). <br />✔ Messagerie privée entre les membres. <br />✔ Upload d\'avatar et de pièces jointes (avec filtre d\'extensions). <br />✔ Smileys et BBCodes (ajout automatique des balises fermantes manquantes). <br />★ Coupure des chaines trop longues sans couper les phrases ! <br />✔ Skins. <br />✔ Liens automatiques. <br />★ Html5 et css3 (Bootstrap de twitter). <br />✔ Affichage des connectés. <br />✔ Coloration syntaxique du code. <br />✔ Gestion des options d\'administration. <br />✔ Système simple de sauvegarde et restauration. (revu) <br />★ Captcha lors de l\'inscription. <br />★ Protection des mails, sur la liste des membres, pour contrer le spam.    <br />★ Indicateur de message (Status Icône).   <br />★ Date de naissance + Âge affiché si celle-ci renseignée. <br />★ Date picker (Inscription et édition du profil).  <br />★ Méta description pour le SEO.<br />&nbsp;</pre>&nbsp;</div>',
'INFORMATION' => 'Information',
'PARAMS' => 'Paramètres',
'GENERAL_PARAM' => 'Paramètre Général',
'SAVE_BACKUP' => 'Créer une sauvegarde',
'SAVE' => 'Sauvegarde',
'RESTORE_FROM_BACKUP' => 'Restaurer depuis une sauvegarde',
'RESTORE' => 'Restauration',
'ADMIN' => 'Admin',
'ARCHIVE_REC' => 'Archive créée avec succès !',
'DOWNLOAD_ARCHIVE' => 'Télécharger l\'archive',
'RESTAURATION_FORUM' => 'Restauration du forum',
'UPLOAD_BACKUP' => 'Envoyer une sauvegarde à restaurer',
'CONFIG_OPTIONS' => 'Options de configuration',
'TITLE_LOGO' => 'Titre du forum / Logo',
'NAME_AND_URL' => 'Nom &amp; Url du site',
'META_DESCRIPTION' => 'Méta-description',
'INDEX_MAX_MSG' => 'Max. messages en index',
'LANG' => 'Langue',
'MAX_AVATAR_WEIGHT' => 'Poids max. d\'un avatar',
'ALLOWED_EXT' => 'Extensions autorisées',
'PRIVATE_MODE' => 'Forum mode privé',
'SHOW_SIGNATURES' => 'Afficher les signatures',
'WELCOME_MSG' => 'Message d\'accueil',
'REC' => 'Enregistrer',
 
# Comptes
'JOIN_COMMUNITY' => 'Rejoindre notre communauté',
'REGISTER' => 'Créer un compte',
'NAME' => 'Nom',
'PASSWORD' => 'Mot de Passe',
'USER_LOGIN' => 'Nom d\'utilisateur',
'USER' => 'Identifiant',
'BIRTHDAY' => 'Date d\'Anniversaire',
'BORN_ON' => 'Né le',
'BIRTH' => 'Naissance',
'YEARS_OLD' => 'ans',
'CONNECT' => 'S\'identifier',
'EMAIL' => 'Adresse Mail',
'WEBSITE' => 'Site Web',
'SIGNATURE' => 'Signature',
'SIGNATURE_MSG' => 'Aucune mise en forme possible et limitée à 150 caractères',
'AVATAR' => 'Avatar',
'CHECKING_CODE' => 'Code de vérification',
'SIGN_UP' => 'S\'inscrire',
'MENDATORY_FIELDS' => 'Les champs indiqués en vert sont obligatoires.',
'CHAR_NOT_ALLOWED' => 'Si l\'identifiant comporte les caractères suivant:',
'CHAR_NOT_ALLOWED_BIS' => 'ou des espaces, ils seront automatiquement retirés.',
'EDIT_PROFIL' => 'Édition du profil',
'EDIT_MY_PROFIL' => 'Modifier mon profil',
'SAVE_PROFIL' => 'Sauvegarder mon profil',
'PROFIL' => 'Profil',
'PROFIL_OF' => 'Profil de',
'REGISTRED_ON' => 'Inscrit(e) le',
'SIGNATURE' => 'Signature',
'DISPLAY_PROFIL' => 'Afficher le profil',
'SEND_AN_EMAIL' => 'Envoyer un mail',
'ACTIVE_JAVASCRIPT_TO_SEE_EMAIL' => 'Activer JavaScript pour afficher le mail',
'SIGNATURE_OF' => 'Signature de',
'MINI_PROFIL_OF' => 'Mini profil de',
'MY_PERSONAL_FILES' => 'Mes Fichiers personnels',
'PERSONAL_FILES' => 'Fichiers personnels',
'FILE' => 'fichier',
'PRIVATE_INBOX' => 'Messagerie Privée',
'PRIVATE_MSG' => 'Message privé',
'EMPTY_MAILBOX' => 'Vider votre boite',
   
# Topics
'POST' => 'Article',
'REPLY' => 'Commentaire',
'ADD' => 'Ajouter',
'EDIT' => 'Modifier',
'DEL' => 'Supprimer',
'TITLE' => 'Titre',
'CONTENT' => 'Message',
'MORE' => 'En lire plus...',
'TRIP' => 'Laisser vide si Anonyme',
'NONE' => 'Aucune donnée actuellement',
'L_NONE' => 'aucun',
'UNCATEGORIZED' => 'Non classé',
'REPLIED' => 'répondus à',
'LIST_OF_ALL_TOPICS' => 'Lister toutes les discussions',
'TITLE_SUBJECT' => 'Titre du sujet',
'DISPLAY_TOPIC' => 'Afficher le sujet',
'STARTED_ON' => 'Débuté le',
'BY' => 'Par',
'L_ON' => 'Le',
'GOTO_LAST_MSG' => 'Aller au dernier message',
'DEL_MSG' => 'Supprimer le sujet ?',
'FOUNDER' => 'Fondateur',
'MODERATOR' => 'Modérateur',
'ANSWER_FROM' => 'Réponse de',
'WHOLE_TOPIC' => 'Tout le sujet',
'QUOTE_MSG_FROM' => 'Citer le message de',
'DOWNLOAD' => 'Télécharger',
'TOPIC_UNKNONW' => 'Sujet inexistant',
'BLOCKQUOTE' => 'Citation',
'EDIT_BY' => 'Modifié par',
'MODO' => 'Modo',
'DEL_MEMBER' => 'Supprimer le membre',
'DEL_THIS_USER' => 'Supprimer cet utilisateur',
'NEW_TOPIC' => 'Nouveau sujet',
'ANSWER' => 'Répondre',
'CHANGE' => 'Edition',
'TO' => 'à',
'PINNED' => 'Épinglé',
'USER_MENDATORY' => 'Utilisateur (obligatoire)',
'ATTACH_FILE' => 'Joindre un fichier',
'SEND' => 'Envoyer',
'WE_HAVE' => 'Nous avons',
'IN' => 'dans',
'TOPIC' => 'sujet',
'WELCOME_TO' => 'Bienvenue à notre nouveau membre',
'TOTAL_MB' => 'Total Membre',
'WHO_IS_ONLINE' => 'Qui est en ligne ?',
'MB_ONLINE' => 'Membres actuellement connectés',
'GUESTS' => 'Visiteurs',
'LEGEND' => 'Légende',
'NO_UNREAD_MSG' => 'Ne contient pas de message non lu',
'UNREAD_MSG' => 'Contient des messages non lus',
'ATTACHMENT' => 'Pièce jointe',
 
# BBCODE
'FORMATING' => 'Formatage',
'BOLD' => 'Gras',
'ITALIC' => 'Italique',
'UNDERLINE'=> 'Souligné',
'STROKE_THROUGH' => 'Barré',
'QUOTE' => 'Citation',
'CODE' => 'Code',
'LINK' => 'Insérer un lien',
'PICTURE' => 'Insérer une image',
'VIDEO' => 'Insérer une vidéo',
'SMILEYS' => 'Smileys',
'SMILE' => 'Sourire',
'WINK' => 'Clin d\'oeil',
'LAUGH' => 'Rire',
'INDIFFERENT' => 'Indifférent',
'SAD' => 'Triste',
'WRY' => 'Ironique',
'TONGUE' => 'Tire la langue',
'SORRY' => 'Désolé',
'ARROW' => 'Tu sors',


# Navigation
'LOGOUT' => 'Déconnexion',
'LOGIN' => 'Connexion',
'VIEW' => 'Affichage',
'SEARCH' => 'Recherche',
'LINK' => 'Lien',
'CATEGORY' => 'Catégorie',
'ARCHIVE' => 'Archive',
'URL' => 'URL',
'FEED' => 'Fil rss',
'WELCOME' => 'Bienvenue',
'ARCHIVES' => 'Archives',
'QUIT' => 'Quitter la session',
'LIST_OF_MEMBERS' => 'Liste des membres',
'MEMBERS' => 'Membres',
'MEMBER' => 'Membre',
'CLOSE' => 'Fermer',
'HOME_FORUM' => 'Accueil du Forum',
'HOME' => 'Accueil',
'FORUMS' => 'Forums',
'STATISTICS' => 'Statistiques',
'TOP' => 'Haut de page',
 
# Messages
'MESSAGES' => 'Messages',
'MESSAGE' => 'Message',
'LAST_MSG' => 'Dernier message',
'CONFIRM' => 'Ok',
'YES' => 'Oui',
'NO' => 'Non',
'LOCKED' => 'Fermé',
'ERRLEN' => 'est trop long ou trop court',
'ERRBOT' => 'CAPTCHA incorrect',
'NOTFOUND' => 'Oops! Cette page n\'existe plus :(',
'ERRNOTMATCH' => 'Les mots de passe ne correspondent pas',
'SEND_PRIVATE_MSG' => 'Envoyer un message privé',
'NEW_PRIVATE_MSG' => 'Nouveau Message Privé',
'BECAREFUL' => 'Attention : l\'identifiant ',
'CASE_SENSITIVE' => 'est sensible à la casse !',
'JS_UNAVAILABLE' => 'Javascript désactivé détecté',
'JS_UNAVAILABLE_MSG' => 'Vous avez actuellement désactivé le javascript. Plusieurs fonctionnalités peuvent ne pas marcher. Veuillez réactiver le javascript pour accéder à toutes les fonctionnalités.',

# Confirmations
'MKCSS' => 'Création du répertoire css',
'MKLANG' => 'Création du répertoire lang',
'MKBAK' => 'Création du répertoire backup',
'MKUPL' => 'Création du répertoire upload',
'MKDATA' => 'Création du répertoire data',
'MKMBR' => 'Création du répertoire membres',
'MKMSG' => 'Création du répertoire messages',
'MKJS' => 'Création du répertoire js',
'MKIMG' => 'Installation des images réussie',
'BACKUP_DONE' => 'Votre sauvegarde a été envoyée et décompressé. La restauration est terminée',
'DEL_CONFIRM' => 'Confirmez la suppression de ',

# Erreurs
'ERROR_MKCSS' => 'Echec à la création du répertoire css',
'ERROR_MKLANG' => 'Echec à la création du répertoire lang',
'ERROR_MKBAK' => 'Echec à la création du répertoire backup',
'ERROR_MKUPL' => 'Echec à la création du répertoire upload',
'ERROR_MKDATA' => 'Echec à la création du répertoire data',
'ERROR_MKMBR' => 'Echec à la création du répertoire membres',
'ERROR_MKMSG' => 'Echec à la création du répertoire messages',
'ERROR_MKJS' => 'Echec à la création du répertoire js',
'ERROR_MKIMG' => 'Echec à l\'installation des images',
'ERROR_AVATAR_CREATION' => 'Erreur d\'écriture de l\'avatar !',
'ERROR_ATTACHMENT_NOT_REC' => 'La pièce jointe n\'a pas pu être enregistrée !',
'ERROR_OVERWEIGHT_AVATAR' => 'Avatar trop gros',
'ERROR_PROHIBITED_FILE' => 'Type de fichier interdit !',
'ERROR_TYPE_NOT_ZIP_FILE' => 'Le fichier que vous essayez d\'envoyer n\'est pas un fichier au format .zip. Merci de recommencer.',
'ERROR_DURING_UPLOAD' => 'Une erreur est survenue lors de l\'envoi. Merci de recommencer.',
'ERROR_FILE_UNKNOWN' => 'Ce fichier n\'existe pas.',
'ERROR_WRONG_PASSWORD' => 'Mauvais mot de passe pour',
'ERROR_USER_ALREADY_EXISTS' => 'Cet utilisateur existe déjà !',
'ERROR_INVALID_EMAIL' => 'Vous avez fourni une adresse mail non valide !',
'ERROR_FILL_FIELDS' => 'Merci de remplir les champs Identifiant, Mot de passe, adresse mail et date de naissance !',
'ERROR_INVALID_PSEUDO' => 'Vous n\'avez pas indiqué de pseudonyme valide.',
'ERROR_PSEUDO_ALREADY_USED' => 'Un membre est déjà inscrit sous ce pseudonyme.',
'ERROR_INVALID_TOPIC' => 'Ce sujet n\'existe pas.',
'ERROR_EMPTY_PSEUDO' => 'Vous n\'avez pas indiqué de pseudonyme.',

# Temps
'DAY' => 'Jour',
'HOUR' => 'heure',
'MINUTE' => 'minute',
'SECOND' => 'seconde',
'PLURAL' => 's',
'AGO' => 'avant',
);

?>";
	if(!file_exists('lang/fr.lng.php')) {
		if($h=@fopen('lang/fr.lng.php','w')) { fputs($h,$fr);fclose($h); }
	}
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
		# mklang();
		# mkjs();
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
		$error.= (@mkdir('css/'))? sprintf("&#10004;&nbsp;".MKCSS.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKCSS." .\n");
        $error.= (@mkdir('lang/'))? sprintf("&#10004;&nbsp;".MKLANG.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKLANG.".\n");
        $error.= (@mkdir('backup/'))? sprintf("&#10004;&nbsp;".MKBAK.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKBAK.".\n");
        $error.= (@mkdir('upload/'))? sprintf("&#10004;&nbsp;".MKUPL.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKUPL.".\n");
		$error.= (@mkdir(U_DATA))? sprintf("&#10004;&nbsp;".MKDATA.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKDATA.".\n");
		$error.= (@mkdir(U_MEMBER))? sprintf("&#10004;&nbsp;".MKMBR.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKMBR.".\n");
		$error.= (@mkdir(U_THREAD))? sprintf("&#10004;&nbsp;".MKMSG.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKMSG.".\n");
        #$error.= (@mkdir('js/'))? sprintf("&#10004;&nbsp;".MKJS.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKJS.".\n");
		$error.= (mkimg())? sprintf("&#10004;&nbsp;".MKIMG.".\n") : sprintf("&#10008;&nbsp;".ERROR_MKIMG.".\n");
		mkcss();
		$forum = new Forum();
		$conn = new Visit();
		return true;
	}
	return false;
}
/**
*
* CREATION FEUILLES DE STYLE
*/
function mkcss() {
    // Style dupliqué en différent colori
	global $cNames,$cVals;
	$css='LyogPVVmb3J1bQ0KLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0qLw0KLkxpZ25le2ZvbnQtc2l6ZToxMXB4OyBib3JkZXItYm90dG9tOjFweCBzb2xpZCBbYnJdOyBwYWRkaW5nLWxlZnQ6NHB4OyB2ZXJ0aWNhbC1hbGlnbjptaWRkbGV9DQoubWVzc3tmb250LXNpemU6MTZweDsgYm9yZGVyLWJvdHRvbToxcHggc29saWQgW2JyXTsgdGV4dC1hbGlnbjpjZW50ZXI7IHZlcnRpY2FsLWFsaWduOm1pZGRsZX0NCg0KLyogRm9ybXVsYWlyZSAqLw0KLnJlZHtjb2xvcjojYzAwfQ0KLmJsdWV7Y29sb3I6IzAwZn0NCi5vcmFuZ2V7Y29sb3I6I2Y5MH0NCi5ncmV5e2NvbG9yOiNhYWF9DQoNCi5hdmF0YXJ7d2lkdGg6ODBweDsgaGVpZ2h0OjgwcHh9DQouYXZhdGFyVER7d2lkdGg6MTglOyBmb250LXNpemU6MTJweDsgZm9udC1mYW1pbHk6Q291cnJpZXIsTW9uYWNvLG1vbm9zcGFjZWQ7IHRleHQtYWxpZ246cmlnaHQ7IHBhZGRpbmctYm90dG9tOjEwcHh9DQoNCi5tZXNzYWdlVER7cGFkZGluZzoxMHB4OyBmb250LXNpemU6MTRweH0NCi50b29sdGlwVER7cGFkZGluZy1sZWZ0OjVweDsgdmVydGljYWwtYWxpZ246bWlkZGxlOyBmb250LXNpemU6OXB4OyBmb250LWZhbWlseTpDb3VycmllcixNb25hY28sbW9ub3NwYWNlZH0NCg0KLmZvcm1URHtiYWNrZ3JvdW5kOltsdF07IGZvbnQtc2l6ZToxMnB4OyBjb2xvcjojNjY2OyBwYWRkaW5nOjNweCA2cHggM3B4IDBweDsgdmVydGljYWwtYWxpZ246bWlkZGxlOyB0ZXh0LWFsaWduOnJpZ2h0OyB3aWR0aDoxNTBweH0NCg0KLnRpdHJlQ29se2JhY2tncm91bmQ6W2x0XTsgZm9udC1zaXplOjEzcHg7IGNvbG9yOiM2NjY7IHBhZGRpbmc6NHB4OyB2ZXJ0aWNhbC1hbGlnbjptaWRkbGV9DQouY29sRGF0ZXtmb250LXNpemU6MTFweDsgY29sb3I6IzY2NjsgcGFkZGluZzo0cHg7IHZlcnRpY2FsLWFsaWduOm1pZGRsZTsgYm9yZGVyLWJvdHRvbToxcHggc29saWQgW2JyXX0NCi8qIEJPVVRPTlMgKi8NCi50aXRyZUxpZW46bGluaywgLnRpdHJlTGllbjp2aXNpdGVke2NvbG9yOiNmZmY7IHRleHQtZGVjb3JhdGlvbjpub25lfQ0KLnRpdHJlTGllbjpob3Zlcntjb2xvcjojZmZmOyB0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lfQ0KDQouYkltYWdlOmxpbmssIC5iSW1hZ2U6dmlzaXRlZCwgLmJJbWFnZTpob3ZlcntwYWRkaW5nOjJweDsgb3BhY2l0eTouNn0NCi5iSW1hZ2U6aG92ZXJ7cGFkZGluZzoycHg7IG9wYWNpdHk6MX0NCg0KLkxpZW46bGluaywgLkxpZW46dmlzaXRlZHtjb2xvcjpbbGtdOyB0ZXh0LWRlY29yYXRpb246bm9uZX0NCi5MaWVuOmhvdmVye2NvbG9yOltsa107IHRleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmV9DQouTGllbk5vbkx1OmxpbmssIC5MaWVuTm9uTHU6dmlzaXRlZHtjb2xvcjpbY3RdOyB0ZXh0LWRlY29yYXRpb246bm9uZX0NCi5MaWVuTm9uTHU6aG92ZXJ7Y29sb3I6W2N0XTsgdGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZX0NCg0KLmF2YXRhclRvb2x0aXA6aG92ZXJ7Y3Vyc29yOmhlbHB9DQoNCi51Rm9ydW17YmFja2dyb3VuZDpbZGtdOyBkaXNwbGF5OmJsb2NrOyB0ZXh0LWFsaWduOmxlZnQ7IGJvcmRlcjoxcHggc29saWQgW2JyXTsgcGFkZGluZzo2cHg7IG1hcmdpbi1ib3R0b206M3B4OyBjb2xvcjojZmZmOyBmb250LXNpemU6MzBweDsgZm9udC13ZWlnaHQ6MTAwfQ0KLkJveHtiYWNrZ3JvdW5kOiNmZmY7IGJvcmRlcjoxcHggc29saWQgW2JyXTsgdmVydGljYWwtYWxpZ246bWlkZGxlOyBwYWRkaW5nOjRweDsgbWFyZ2luLWJvdHRvbTozcHg7IHRleHQtYWxpZ246bGVmdH0NCg0KDQoudGl0cmVEaXZ7YmFja2dyb3VuZDpbZGtdOyBib3JkZXI6MXB4IHNvbGlkIFticl07IGNvbG9yOiNmZmY7IHZlcnRpY2FsLWFsaWduOm1pZGRsZTsgcGFkZGluZzo2cHg7IG1hcmdpbi1ib3R0b206M3B4OyB0ZXh0LWFsaWduOmxlZnR9DQoudGl0cmVQb3N0e3RleHQtYWxpZ246bGVmdDsgZm9udC1zaXplOjE0cHg7IGNvbG9yOltka119DQoNCi5ncmFkaWVudHtiYWNrZ3JvdW5kOltka107IGJvcmRlcjoxcHggc29saWQgW2JyXTsgY29sb3I6I2ZmZjsgdmVydGljYWwtYWxpZ246bWlkZGxlOyBwYWRkaW5nOjZweDsgbWFyZ2luLWJvdHRvbTozcHg7IHRleHQtYWxpZ246bGVmdDsgZm9udC13ZWlnaHQ6Ym9sZH0NCg0KLmRhdGVQb3N0e2NvbG9yOiM5YTlhOWE7IGZvbnQtc2l6ZToxMnB4OyBmb250LWZhbWlseTpDb3VycmllcixNb25hY28sbW9ub3NwYWNlZDsgdGV4dC1hbGlnbjpyaWdodDsgcGFkZGluZy10b3A6NXB4OyBwYWRkaW5nLXJpZ2h0OjNweH0NCi5wb3N0TW9ke2ZvbnQtc2l6ZTo5cHg7IGZvbnQtZmFtaWx5OkNvdXJyaWVyLE1vbmFjbyxtb25vc3BhY2VkOyB0ZXh0LWFsaWduOnJpZ2h0OyBwYWRkaW5nLXRvcDo2cHg7IHBhZGRpbmctcmlnaHQ6M3B4OyBjb2xvcjpbZGtdfQ0KDQoucG9zdGVye2NvbG9yOiNmOTB9DQoucG9zdGVyOmxpbmssIC5wb3N0ZXI6dmlzaXRlZHt0ZXh0LWRlY29yYXRpb246bm9uZX0NCi5wb3N0ZXI6aG92ZXJ7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZX0NCg0KLmF0dGFjaExpbmt7dGV4dC1kZWNvcmF0aW9uOm5vbmU7IGRpc3BsYXk6YmxvY2s7IHBhZGRpbmctdG9wOjVweDsgZm9udC1zaXplOjlweDsgZm9udC1mYW1pbHk6Q291cnJpZXIsTW9uYWNvLG1vbm9zcGFjZWQ7IHRleHQtYWxpZ246cmlnaHR9DQouYXR0YWNoTGluazpsaW5rLCAuYXR0YWNoTGluazp2aXNpdGVke2NvbG9yOiM5OTl9DQouYXR0YWNoTGluazpob3Zlcntjb2xvcjpbY3RdfQ0KDQoudG9nZ2xle3BhZGRpbmctdG9wOjEwcHg7IG1hcmdpbjowcHg7IGRpc3BsYXk6bm9uZTsgdmlzaWJpbGl0eTpoaWRkZW59DQoudG9nZ2xlTGlua3t0ZXh0LWRlY29yYXRpb246bm9uZTsgZGlzcGxheTpibG9jazsgcGFkZGluZzozcHggM3B4IDNweCA2cHg7IG1hcmdpbjoycHh9DQoudG9nZ2xlTGluazpsaW5rLCAudG9nZ2xlTGluazp2aXNpdGVke2NvbG9yOiM2NjY7IGJhY2tncm91bmQ6W2x0XX0NCi50b2dnbGVMaW5rOmhvdmVye2JhY2tncm91bmQ6I2IxYzVkMDsgY29sb3I6I2ZmZn0NCg0KLnRvb2x0aXB7cG9zaXRpb246YWJzb2x1dGU7IGJvcmRlcjoxcHggc29saWQgIzk5OTsgdGV4dC1hbGlnbjpsZWZ0OyBkaXNwbGF5Om5vbmU7IGJhY2tncm91bmQtY29sb3I6cmdiYSgyNTUsMjU1LDI1NSwwLjkpOyBwYWRkaW5nOjZweDsgY29sb3I6IzY2NjsgZm9udC1zaXplOjExcHg7IHotaW5kZXg6OTk5OyB3aWR0aDo0MDBweH0NCkBrZXlmcmFtZXMgYmxpbmsgeyAgDQogICAgMCUgeyBjb2xvcjogcmVkOyB9DQogICAgMTAwJSB7IGNvbG9yOiBibGFjazsgfQ0KfQ0KQC13ZWJraXQta2V5ZnJhbWVzIGJsaW5rIHsNCiAgICAwJSB7IGNvbG9yOiByZWQ7IH0NCiAgICAxMDAlIHsgY29sb3I6IGJsYWNrOyB9DQp9DQouYmxpbmsgew0KICAgIC13ZWJraXQtYW5pbWF0aW9uOiBibGluayAwLjVzIGxpbmVhciBpbmZpbml0ZTsNCiAgICAtbW96LWFuaW1hdGlvbjogYmxpbmsgMC41cyBsaW5lYXIgaW5maW5pdGU7DQogICAgLW1zLWFuaW1hdGlvbjogYmxpbmsgMC41cyBsaW5lYXIgaW5maW5pdGU7DQogICAgLW8tYW5pbWF0aW9uOiBibGluayAwLjVzIGxpbmVhciBpbmZpbml0ZTsNCiAgICBhbmltYXRpb246IGJsaW5rIDAuNXMgbGluZWFyIGluZmluaXRlOw0KfSANCi8qID1MYXlvdXQNCi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tKi8NCi53cmFwcGVyIHsNCgltYXJnaW46IGF1dG87DQoJbWF4LXdpZHRoOiA5ODBweDsNCglwYWRkaW5nOiAzNnB4IDEwcHg7DQp9DQojbWFpbiBhc2lkZSB7DQoJYmFja2dyb3VuZC1jb2xvcjogI2Y2ZjZmNjsNCn0NCiNibG9ja3MgbGkgew0KCWJhY2tncm91bmQtY29sb3I6ICNmOGY4Zjg7DQoJcGFkZGluZzogMy4zZW0gMDsNCgl0ZXh0LWFsaWduOiBjZW50ZXI7DQp9DQoud2VsbCB7DQogICAgZGlzcGxheTogYmxvY2s7DQoJYmFja2dyb3VuZC1jb2xvcjogI2Y4ZjhmODsNCglwYWRkaW5nOiAzLjNlbSAwOw0KCWJvcmRlci1yYWRpdXM6IDVweA0KfQ0KLmxpbmstc2hvdy1jb2RlIHsNCiAgYmFja2dyb3VuZC1jb2xvcjogI2VlZTsNCiAgYm9yZGVyLXJhZGl1czogMTBweDsNCiAgY29sb3I6ICM1NTU7DQogIGZvbnQtc2l6ZTogMTJweDsNCiAgZGlzcGxheTogaW5saW5lLWJsb2NrOw0KICBsaW5lLWhlaWdodDogMTsNCiAgcGFkZGluZzogNXB4IDExcHg7DQogIHRleHQtZGVjb3JhdGlvbjogbm9uZTsNCn0NCi5saW5rLXNob3ctY29kZTpob3ZlciB7DQogIGJhY2tncm91bmQtY29sb3I6ICNlZjY0NjU7DQogIGNvbG9yOiAjZmZmOw0KfQ0KLmxpbmstc2hvdy1jb2RlLWFjdGl2ZSB7DQogIGJhY2tncm91bmQtY29sb3I6ICM0NDQ7DQogIGNvbG9yOiAjZmZmOw0KICBwYWRkaW5nOiA1cHggMTRweDsNCn0NCi5sYWJlbCB7dGV4dC10cmFuc2Zvcm06IHVwcGVyY2FzZTsgZm9udC1zaXplOiA5cHggIWltcG9ydGFudDsgZm9udC13ZWlnaHQ6IGJvbGR9DQovKiA9RWRpdG9yDQotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovDQp1bC5zbWlsZXlzIHsNCiAgICB3aWR0aDogMTcwcHgNCn0NCi5zbWlsZXlzIGxpew0KICAgIGZsb2F0OmxlZnQNCn0NCi8qID1IZWFkZXINCi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tKi8NCiNoZWFkZXIgew0KCW92ZXJmbG93OiBoaWRkZW47DQoJbWFyZ2luLWJvdHRvbTogMS41ZW07DQoJYm9yZGVyLWJvdHRvbTogMXB4IHNvbGlkICNlZWU7DQp9DQojaGVhZGVyIGgxIHsNCglmbG9hdDogbGVmdDsNCgltYXJnaW46IDA7DQp9DQojaGVhZGVyIG5hdiB7DQoJcGFkZGluZy10b3A6IDEwcHg7DQoJZmxvYXQ6IHJpZ2h0Ow0KfQ0KDQovKiA9Rm9vdGVyDQotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovDQojZm9vdGVyIHsNCglib3JkZXItdG9wOiAxcHggc29saWQgI2VlZTsNCglwYWRkaW5nLXRvcDogMS41ZW07DQoJbWFyZ2luOiAxLjVlbSAwOw0KCWZvbnQtc2l6ZTogLjg1ZW07DQp9DQojZm9vdGVyIHNwYW4gew0KICBmbG9hdDogcmlnaHQ7DQp9DQoNCg0KLyogPVRhYmxldCAoUG9ydHJhaXQpDQotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovDQpAbWVkaWEgb25seSBzY3JlZW4gYW5kIChtaW4td2lkdGg6IDc2OHB4KSBhbmQgKG1heC13aWR0aDogOTU5cHgpIHsNCiAgICAud3JhcHBlciB7IHdpZHRoOiA3NDhweDsgfQ0KfQ0KDQoNCi8qID1Nb2JpbGUgKFBvcnRyYWl0KQ0KLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0qLw0KQG1lZGlhIG9ubHkgc2NyZWVuIGFuZCAobWF4LXdpZHRoOiA3NjdweCkgew0KCS53cmFwcGVyIHsgd2lkdGg6IDMwMHB4OyB9DQoJI25hdiwgI2hlYWRlciBoMSB7IGZsb2F0OiBub25lOyB9DQoJI2hlYWRlciBoMSB7IG1hcmdpbi1ib3R0b206IC41ZW07IH0NCgkjbmF2IHVsIGxpIHsgbWFyZ2luOiAwOyBmbG9hdDogbm9uZTsgbWFyZ2luLWJvdHRvbTogMXB4OyBiYWNrZ3JvdW5kLWNvbG9yOiAjZjZmNmY2OyB9DQoJI25hdiB1bCBsaSBhLCAjbmF2IHVsIGxpIHNwYW4geyBkaXNwbGF5OiBibG9jazsgcGFkZGluZzogMnB4IDVweDsgfQ0KfQ0KDQovKiA9TW9iaWxlIChMYW5kc2NhcGUpDQotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovDQpAbWVkaWEgb25seSBzY3JlZW4gYW5kIChtaW4td2lkdGg6IDQ4MHB4KSBhbmQgKG1heC13aWR0aDogNzY3cHgpIHsNCgkud3JhcHBlciB7IHdpZHRoOiA0MjBweDsgfQ0KfQ0K';

// main.css	
$main_style='aHRtbHtmb250LWZhbWlseTpzYW5zLXNlcmlmOy1tcy10ZXh0LXNpemUtYWRqdXN0OjEwMCU7LXdlYmtpdC10ZXh0LXNpemUtYWRqdXN0OjEwMCV9aHRtbCxib2R5LGRpdixzcGFuLG9iamVjdCxpZnJhbWUscCxibG9ja3F1b3RlLHByZSxhLGFiYnIsYWNyb255bSxhZGRyZXNzLGJpZyxjaXRlLGNvZGUsZGVsLGRmbixlbSxpbWcsaW5zLGtiZCxxLHMsc2FtcCxzbWFsbCxzdHJpa2Usc3Ryb25nLHN1YixzdXAsdHQsdmFyLGIsdSxpLGNlbnRlcixkbCxkdCxkZCxvbCx1bCxsaSxmaWVsZHNldCxmb3JtLGxhYmVsLGxlZ2VuZCx0YWJsZSxjYXB0aW9uLHRib2R5LHRmb290LHRoZWFkLHRyLHRoLHRkLGFydGljbGUsYXNpZGUsY2FudmFzLGRldGFpbHMsZW1iZWQsZmlndXJlLGZpZ2NhcHRpb24sZm9vdGVyLGhlYWRlcixoZ3JvdXAsbWVudSxuYXYsb3V0cHV0LHJ1Ynksc2VjdGlvbixzdW1tYXJ5LHRpbWUsbWFyayxhdWRpbyx2aWRlbyxoMSxoMixoMyxoNCxoNSxoNnttYXJnaW46MDtwYWRkaW5nOjA7Ym9yZGVyOjA7b3V0bGluZTowO2ZvbnQtc2l6ZToxMDAlO3ZlcnRpY2FsLWFsaWduOmJhc2VsaW5lO2JhY2tncm91bmQ6dHJhbnNwYXJlbnQ7Zm9udC1zdHlsZTpub3JtYWx9YTphY3RpdmUsYTpob3ZlcntvdXRsaW5lOjB9YnV0dG9uLGlucHV0e2xpbmUtaGVpZ2h0Om5vcm1hbH1idXR0b24sc2VsZWN0e3RleHQtdHJhbnNmb3JtOm5vbmV9YXJ0aWNsZSxhc2lkZSxkZXRhaWxzLGZpZ2NhcHRpb24sZmlndXJlLGZvb3RlcixoZWFkZXIsaGdyb3VwLG1haW4sbmF2LHNlY3Rpb24sc3VtbWFyeXtkaXNwbGF5OmJsb2NrfWF1ZGlvLGNhbnZhcyx2aWRlb3tkaXNwbGF5OmlubGluZS1ibG9ja31hdWRpbzpub3QoW2NvbnRyb2xzXSl7ZGlzcGxheTpub25lO2hlaWdodDowfWJsb2NrcXVvdGUscXtxdW90ZXM6bm9uZX1ibG9ja3F1b3RlIHA6YmVmb3JlLGJsb2NrcXVvdGUgcDphZnRlcixxOmJlZm9yZSxxOmFmdGVye2NvbnRlbnQ6Jyc7Y29udGVudDpub25lfXRhYmxle2JvcmRlci1jb2xsYXBzZTpjb2xsYXBzZTtib3JkZXItc3BhY2luZzowfWNhcHRpb24sdGgsdGR7dGV4dC1hbGlnbjpsZWZ0O3ZlcnRpY2FsLWFsaWduOnRvcDtmb250LXdlaWdodDpub3JtYWx9dGhlYWQgdGgsdGhlYWQgdGR7Zm9udC13ZWlnaHQ6Ym9sZDt2ZXJ0aWNhbC1hbGlnbjpib3R0b219YSBpbWcsdGggaW1nLHRkIGltZ3t2ZXJ0aWNhbC1hbGlnbjp0b3B9YnV0dG9uLGlucHV0LHNlbGVjdCx0ZXh0YXJlYXttYXJnaW46MH10ZXh0YXJlYXtvdmVyZmxvdzphdXRvO3ZlcnRpY2FsLWFsaWduOnRvcH1idXR0b257d2lkdGg6YXV0bztvdmVyZmxvdzp2aXNpYmxlfWlucHV0W3R5cGU9YnV0dG9uXSxpbnB1dFt0eXBlPXN1Ym1pdF0sYnV0dG9ue2N1cnNvcjpwb2ludGVyfWlucHV0W3R5cGU9InJhZGlvIl0saW5wdXRbdHlwZT0iY2hlY2tib3giXXtmb250LXNpemU6MTEwJTtib3gtc2l6aW5nOmJvcmRlci1ib3h9aW5wdXRbdHlwZT0ic2VhcmNoIl17LXdlYmtpdC1hcHBlYXJhbmNlOnRleHRmaWVsZDstd2Via2l0LWJveC1zaXppbmc6Y29udGVudC1ib3g7LW1vei1ib3gtc2l6aW5nOmNvbnRlbnQtYm94O2JveC1zaXppbmc6Y29udGVudC1ib3h9aW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWNhbmNlbC1idXR0b24saW5wdXRbdHlwZT0ic2VhcmNoIl06Oi13ZWJraXQtc2VhcmNoLWRlY29yYXRpb257LXdlYmtpdC1hcHBlYXJhbmNlOm5vbmV9aHJ7ZGlzcGxheTpibG9jaztoZWlnaHQ6MXB4O2JvcmRlcjowO2JvcmRlci10b3A6MXB4IHNvbGlkICNkZGR9Lmdyb3VwOmFmdGVye2NvbnRlbnQ6Ii4iO2Rpc3BsYXk6YmxvY2s7aGVpZ2h0OjA7Y2xlYXI6Ym90aDt2aXNpYmlsaXR5OmhpZGRlbn1ib2R5e2JhY2tncm91bmQ6I2ZmZjtjb2xvcjojMzMzO2ZvbnQtc2l6ZTouODc1ZW07bGluZS1oZWlnaHQ6MS42NWVtO2ZvbnQtZmFtaWx5OidQVCBTYW5zJyxBcmlhbCwiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxUYWhvbWEsc2Fucy1zZXJpZn1he2NvbG9yOiMzNjl9YTpmb2N1cyxhOmhvdmVye2NvbG9yOiNlZjY0NjV9aDEsaDIsaDMsaDQsaDUsaDZ7Y29sb3I6IzIyMjtmb250LWZhbWlseTonUFQgU2FucycsQXJpYWwsIkhlbHZldGljYSBOZXVlIixIZWx2ZXRpY2EsVGFob21hLHNhbnMtc2VyaWY7Zm9udC13ZWlnaHQ6Ym9sZH1oMXtmb250LXNpemU6Mi4xNDJlbTtsaW5lLWhlaWdodDoxLjEzMzNlbTttYXJnaW4tYm90dG9tOi4yNjY2ZW19aDJ7Zm9udC1zaXplOjEuNzE0ZW07bGluZS1oZWlnaHQ6MS4xNjY2ZW07bWFyZ2luLWJvdHRvbTouNDU1NWVtfWgze2ZvbnQtc2l6ZToxLjQyOWVtO2xpbmUtaGVpZ2h0OjEuNGVtO21hcmdpbi1ib3R0b206LjRlbX1oNHtmb250LXNpemU6MS4xNDNlbTtsaW5lLWhlaWdodDoxLjY1ZW07bWFyZ2luLWJvdHRvbTouNDU1NWVtfWg1e2ZvbnQtc2l6ZToxZW07bGluZS1oZWlnaHQ6MS42NWVtO21hcmdpbi1ib3R0b206LjVlbX1oNntmb250LXNpemU6Ljg1N2VtO2xpbmUtaGVpZ2h0OjEuNWVtO21hcmdpbi1ib3R0b206LjQ1NTVlbTt0ZXh0LXRyYW5zZm9ybTp1cHBlcmNhc2V9aGdyb3VwIGgxLGhncm91cCBoMixoZ3JvdXAgaDMsaGdyb3VwIGg0LGhncm91cCBoNSxoZ3JvdXAgaDZ7bWFyZ2luLWJvdHRvbTowfWhncm91cHttYXJnaW4tYm90dG9tOi42ZW19LnN1YmhlYWRlcntmb250LXdlaWdodDozMDA7Y29sb3I6Izg4OH1oMS5zdWJoZWFkZXJ7Zm9udC1zaXplOjEuMzU3ZW07bGluZS1oZWlnaHQ6MS4yNjNlbX1oMi5zdWJoZWFkZXJ7Zm9udC1zaXplOjEuMjE0ZW07bGluZS1oZWlnaHQ6MS40MTJlbX1oMy5zdWJoZWFkZXJ7Zm9udC1zaXplOjFlbTtsaW5lLWhlaWdodDoxLjI4NmVtfWg0LnN1YmhlYWRlcixoNS5zdWJoZWFkZXJ7Zm9udC1zaXplOi45NWVtO2xpbmUtaGVpZ2h0OjEuMzg1ZW19aDYuc3ViaGVhZGVye2ZvbnQtc2l6ZTouOGVtO2xpbmUtaGVpZ2h0OjEuMzY0ZW19cCx1bCxvbCxkbCxkZCxkdCxibG9ja3F1b3RlLHRkLHRoe2xpbmUtaGVpZ2h0OjEuNjVlbX11bCxvbCx1bCB1bCxvbCBvbCx1bCBvbCxvbCB1bHttYXJnaW46MCAwIDAgMmVtfW9sIG9sIGxpe2xpc3Qtc3R5bGUtdHlwZTpsb3dlci1hbHBoYX1vbCBvbCBvbCBsaXtsaXN0LXN0eWxlLXR5cGU6bG93ZXItcm9tYW59cCx1bCxvbCxkbCxibG9ja3F1b3RlLGhyLHByZSx0YWJsZSxmb3JtLGZpZWxkc2V0LGZpZ3VyZXttYXJnaW4tYm90dG9tOjEuNjVlbX1kbCBkdHtmb250LXdlaWdodDpib2xkfWRke21hcmdpbi1sZWZ0OjFlbX1ibG9ja3F1b3Rle21hcmdpbi1ib3R0b206MS42NWVtO3Bvc2l0aW9uOnJlbGF0aXZlO2NvbG9yOiM3Nzc7cGFkZGluZy1sZWZ0OjEuNjVlbTttYXJnaW4tbGVmdDoxLjY1ZW07Ym9yZGVyLWxlZnQ6MXB4IHNvbGlkICNkZGR9YmxvY2txdW90ZSBzbWFsbCxjaXRle2NvbG9yOiM5OTk7Zm9udC1zdHlsZTpub3JtYWx9YmxvY2txdW90ZSBwe21hcmdpbi1ib3R0b206LjVlbX1zbWFsbCxibG9ja3F1b3RlIGNpdGV7Zm9udC1zaXplOi44NWVtO2xpbmUtaGVpZ2h0OjF9YmxvY2txdW90ZSAucHVsbC1yaWdodCwudW5pdHMtcm93IGJsb2NrcXVvdGUgLnB1bGwtcmlnaHR7ZmxvYXQ6bm9uZTt0ZXh0LWFsaWduOnJpZ2h0O2Rpc3BsYXk6YmxvY2t9YWRkcmVzc3tmb250LXN0eWxlOml0YWxpY31kZWx7dGV4dC1kZWNvcmF0aW9uOmxpbmUtdGhyb3VnaH1hYmJyW3RpdGxlXSxkZm5bdGl0bGVde2JvcmRlci1ib3R0b206MXB4IGRvdHRlZCAjMDAwO2N1cnNvcjpoZWxwfXN0cm9uZyxie2ZvbnQtd2VpZ2h0OmJvbGR9ZW0saXtmb250LXN0eWxlOml0YWxpY31zdWIsc3Vwe2ZvbnQtc2l6ZTouN2VtO2xpbmUtaGVpZ2h0OjA7cG9zaXRpb246cmVsYXRpdmV9c3Vwe3RvcDotMC41ZW19c3Vie2JvdHRvbTotMC4yNWVtfWZpZ2NhcHRpb257Zm9udC1zaXplOi44NWVtO2ZvbnQtc3R5bGU6aXRhbGljfWlucyxtYXJre2JhY2tncm91bmQtY29sb3I6I2ZlNTtjb2xvcjojMDAwO3RleHQtZGVjb3JhdGlvbjpub25lfXByZSxjb2RlLGtiZCxzYW1we2ZvbnQtc2l6ZTo5MCU7Zm9udC1mYW1pbHk6Q29uc29sYXMsTW9uYWNvLG1vbm9zcGFjZSxzYW5zLXNlcmlmfXByZXtmb250LXNpemU6OTAlO2NvbG9yOiM0NDQ7YmFja2dyb3VuZDojZjVmNWY1O3BhZGRpbmc6Ljg1ZW07b3ZlcmZsb3c6YXV0b31jb2Rle3BhZGRpbmc6MnB4IDNweDtkaXNwbGF5OmlubGluZS1ibG9jaztsaW5lLWhlaWdodDoxO2JhY2tncm91bmQ6I2Y1ZjVmNTtib3JkZXI6MXB4IHNvbGlkICNkZGR9a2Jke3BhZGRpbmc6MnB4IDZweCAxcHggNnB4O2xpbmUtaGVpZ2h0OjE7ZGlzcGxheTppbmxpbmUtYmxvY2s7Ym9yZGVyLXJhZGl1czouM2VtO2JveC1zaGFkb3c6MCAycHggMCByZ2JhKDAsMCwwLDAuMiksMCAwIDAgMXB4ICNmZmYgaW5zZXQ7YmFja2dyb3VuZC1jb2xvcjojZmFmYWZhO2JvcmRlci1jb2xvcjojY2NjICNjY2Mgd2hpdGU7Ym9yZGVyLXN0eWxlOnNvbGlkIHNvbGlkIG5vbmU7Ym9yZGVyLXdpZHRoOjFweCAxcHggbWVkaXVtO2NvbG9yOiM0NDQ7Zm9udC13ZWlnaHQ6bm9ybWFsO3doaXRlLXNwYWNlOm5vd3JhcH1pbnB1dFt0eXBlPSJ0ZXh0Il0saW5wdXRbdHlwZT0icGFzc3dvcmQiXSxpbnB1dFt0eXBlPSJlbWFpbCJdLHRleHRhcmVhe2ZvbnQtc2l6ZTouOTVlbX1maWVsZHNldHtwYWRkaW5nOjEuNjVlbTttYXJnaW4tYm90dG9tOjEuNjVlbTtib3JkZXI6MXB4IHNvbGlkICNlM2UzZTN9bGVnZW5ke2ZvbnQtd2VpZ2h0OmJvbGQ7cGFkZGluZzowIDFlbX0uY29te2NvbG9yOiM4ODh9LmxpdHtjb2xvcjojMTk1ZjkxfS5wdW4sLm9wbiwuY2xve2NvbG9yOiM5M2ExYTF9LmZ1bntjb2xvcjojMDA1Y2I5fS5zdHIsLmF0dntjb2xvcjojOGE2MzQzfS5rd2QsLmxpbmVudW1zLC50YWd7Y29sb3I6IzAwMH0udHlwLC5hdG4sLmRlYywudmFye2NvbG9yOiM2NjZ9LnBsbntjb2xvcjojNTg5MGFkfXRmb290IHRoLHRmb290IHRke2JhY2tncm91bmQtY29sb3I6I2YyZjJmMn10aCx0ZHtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZWVlO3BhZGRpbmc6LjVlbSAuOGVtfXRhYmxlIGNhcHRpb257dGV4dC10cmFuc2Zvcm06dXBwZXJjYXNlO3BhZGRpbmc6MCAxZW07Y29sb3I6Izk5OTtmb250LXNpemU6Ljg1ZW19dGFibGUudGFibGUtZmxhdCB0ZCx0YWJsZS50YWJsZS1mbGF0IHRoe2JvcmRlcjowO3BhZGRpbmc6MH10YWJsZS50YWJsZS1zaW1wbGUgdGQsdGFibGUudGFibGUtc2ltcGxlIHRoe2JvcmRlcjowO3BhZGRpbmc6LjgyNWVtIC43ZW0gLjgyNWVtIDB9dGFibGUudGFibGUtc2ltcGxlIGNhcHRpb257cGFkZGluZy1sZWZ0OjB9dGFibGUudGFibGUtYm9yZGVyZWQgdGQsdGFibGUudGFibGUtYm9yZGVyZWQgdGh7Ym9yZGVyOjFweCBzb2xpZCAjZGRkfXRhYmxlLnRhYmxlLXN0cm9rZWQgdGQsdGFibGUudGFibGUtc3Ryb2tlZCB0aHtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZWVlfXRhYmxlLnRhYmxlLXN0cmlwZWQgdGJvZHkgdHI6bnRoLWNoaWxkKG9kZCkgdGR7YmFja2dyb3VuZC1jb2xvcjojZjVmNWY1fXRhYmxlLnRhYmxlLWhvdmVyZWQgdGJvZHkgdHI6aG92ZXIgdGQsdGFibGUudGFibGUtaG92ZXJlZCB0aGVhZCB0cjpob3ZlciB0aHtiYWNrZ3JvdW5kLWNvbG9yOiNmNmY2ZjZ9LnRhYmxlLWNvbnRhaW5lcnt3aWR0aDoxMDAlO292ZXJmbG93OmF1dG87bWFyZ2luLWJvdHRvbToxLjY1ZW19LnRhYmxlLWNvbnRhaW5lciB0YWJsZXttYXJnaW4tYm90dG9tOjB9LnRhYmxlLWNvbnRhaW5lcjo6LXdlYmtpdC1zY3JvbGxiYXJ7LXdlYmtpdC1hcHBlYXJhbmNlOm5vbmU7d2lkdGg6MTRweDtoZWlnaHQ6MTRweH0udGFibGUtY29udGFpbmVyOjotd2Via2l0LXNjcm9sbGJhci10aHVtYntib3JkZXItcmFkaXVzOjhweDtib3JkZXI6M3B4IHNvbGlkICNmZmY7YmFja2dyb3VuZC1jb2xvcjpyZ2JhKDAsMCwwLDAuMyl9Lmxpc3RzLXNpbXBsZXttYXJnaW4tbGVmdDowO2xpc3Qtc3R5bGU6bm9uZX0ubGlzdHMtc2ltcGxlIHVsLC5saXN0cy1zaW1wbGUgb2x7bGlzdC1zdHlsZTpub25lO21hcmdpbi1sZWZ0OjEuNWVtfS5saXN0cy1kYXNoe21hcmdpbi1sZWZ0OjE4cHh9Lmxpc3RzLWRhc2ggbGl7bGlzdC1zdHlsZS10eXBlOm5vbmV9Lmxpc3RzLWRhc2ggbGk6YmVmb3Jle2NvbnRlbnQ6IlwyMDEzIjtwb3NpdGlvbjpyZWxhdGl2ZTttYXJnaW4tbGVmdDotMTBweDtsZWZ0Oi03cHh9LmZvcm1zIGxhYmVse2Rpc3BsYXk6YmxvY2s7bWFyZ2luLWJvdHRvbToxLjY1ZW19LmZvcm1zIGlucHV0W3R5cGU9InRleHQiXSwuZm9ybXMgaW5wdXRbdHlwZT0icGFzc3dvcmQiXSwuZm9ybXMgaW5wdXRbdHlwZT0iZW1haWwiXSwuZm9ybXMgaW5wdXRbdHlwZT0idXJsIl0sLmZvcm1zIGlucHV0W3R5cGU9InBob25lIl0sLmZvcm1zIGlucHV0W3R5cGU9InRlbCJdLC5mb3JtcyBpbnB1dFt0eXBlPSJudW1iZXIiXSwuZm9ybXMgaW5wdXRbdHlwZT0iZGF0ZXRpbWUiXSwuZm9ybXMgaW5wdXRbdHlwZT0iZGF0ZSJdLC5mb3JtcyBpbnB1dFt0eXBlPSJzZWFyY2giXSwuZm9ybXMgaW5wdXRbdHlwZT0icmFuZ2UiXSwuZm9ybXMgaW5wdXRbdHlwZT0iZmlsZSJdLC5mb3JtcyBpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdLC5mb3JtcyB0ZXh0YXJlYSwuZm9ybXMgc2VsZWN0LC5mb3JtcyBidXR0b257ZGlzcGxheTpibG9ja30uZm9ybXMtaW5saW5lIGlucHV0W3R5cGU9InRleHQiXSwuZm9ybXMtaW5saW5lIGlucHV0W3R5cGU9InBhc3N3b3JkIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJlbWFpbCJdLC5mb3Jtcy1pbmxpbmUgaW5wdXRbdHlwZT0idXJsIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJwaG9uZSJdLC5mb3Jtcy1pbmxpbmUgaW5wdXRbdHlwZT0idGVsIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJudW1iZXIiXSwuZm9ybXMtaW5saW5lIGlucHV0W3R5cGU9ImRhdGV0aW1lIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJkYXRlIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJzZWFyY2giXSwuZm9ybXMtaW5saW5lIGlucHV0W3R5cGU9InJhbmdlIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJmaWxlIl0sLmZvcm1zLWlubGluZSBpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdLC5mb3Jtcy1pbmxpbmUgdGV4dGFyZWEsLmZvcm1zLWlubGluZSBzZWxlY3QsLmZvcm1zLWlubGluZSBidXR0b24sLmZvcm1zLWlubGluZS1saXN0IGlucHV0W3R5cGU9InRleHQiXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0icGFzc3dvcmQiXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0iZW1haWwiXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0idXJsIl0sLmZvcm1zLWlubGluZS1saXN0IGlucHV0W3R5cGU9InBob25lIl0sLmZvcm1zLWlubGluZS1saXN0IGlucHV0W3R5cGU9InRlbCJdLC5mb3Jtcy1pbmxpbmUtbGlzdCBpbnB1dFt0eXBlPSJudW1iZXIiXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0iZGF0ZXRpbWUiXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0iZGF0ZSJdLC5mb3Jtcy1pbmxpbmUtbGlzdCBpbnB1dFt0eXBlPSJzZWFyY2giXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0icmFuZ2UiXSwuZm9ybXMtaW5saW5lLWxpc3QgaW5wdXRbdHlwZT0iZmlsZSJdLC5mb3Jtcy1pbmxpbmUtbGlzdCBpbnB1dFt0eXBlPSJkYXRldGltZS1sb2NhbCJdLC5mb3Jtcy1pbmxpbmUtbGlzdCB0ZXh0YXJlYSwuZm9ybXMtaW5saW5lLWxpc3Qgc2VsZWN0LC5mb3Jtcy1pbmxpbmUtbGlzdCBidXR0b257ZGlzcGxheTppbmxpbmUtYmxvY2t9LmZvcm1zLWxpc3QsLmZvcm1zLWlubGluZS1saXN0e21hcmdpbjowO3BhZGRpbmc6MDttYXJnaW4tYm90dG9tOjEuNjVlbTtsaXN0LXN0eWxlOm5vbmV9LmZvcm1zLWxpc3QgbGFiZWwsLmZvcm1zLWlubGluZS1saXN0IGxpLC5mb3Jtcy1pbmxpbmUtbGlzdCBsaSBsYWJlbHtkaXNwbGF5OmlubGluZS1ibG9jazttYXJnaW4tYm90dG9tOjB9LmZvcm1zLWlubGluZS1saXN0IGxpIGxhYmVse21hcmdpbi1yaWdodDoxLjY1ZW19LmZvcm1zLWxpc3QgbGl7bWFyZ2luLWJvdHRvbTo2cHh9LmZvcm1zLWRlc2N7bWFyZ2luLXRvcDo0cHg7Y29sb3I6Izk5OTtmb250LXNpemU6Ljg1ZW07bGluZS1oZWlnaHQ6MS40ZW19LmZvcm1zIGZpZWxkc2V0e3BhZGRpbmctYm90dG9tOi41ZW07Ym9yZGVyLXJhZGl1czouNWVtfWZpZWxkc2V0LmZvcm1zLXJvd3twYWRkaW5nOjA7Ym9yZGVyOjA7bWFyZ2luLWJvdHRvbTowfS5mb3Jtcy1jb2x1bW5hcjphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59LmZvcm1zLWNvbHVtbmFyIGlucHV0W3R5cGU9InJhbmdlIl0sLmZvcm1zLWNvbHVtbmFyIGlucHV0W3R5cGU9ImZpbGUiXSwuZm9ybXMtY29sdW1uYXIgc2VsZWN0W211bHRpcGxlPSJtdWx0aXBsZSJde2Rpc3BsYXk6aW5saW5lLWJsb2NrfS5mb3Jtcy1jb2x1bW5hciBwe3Bvc2l0aW9uOnJlbGF0aXZlO3BhZGRpbmctbGVmdDoxNzBweH0uZm9ybXMtY29sdW1uYXIgbGFiZWx7ZmxvYXQ6bGVmdDt3aWR0aDoxNTBweDt0ZXh0LWFsaWduOnJpZ2h0O3RvcDowO2xlZnQ6MDtwb3NpdGlvbjphYnNvbHV0ZX0uZm9ybXMtY29sdW1uYXIgLmZvcm1zLWxpc3QsLmZvcm1zLWNvbHVtbmFyIC5mb3Jtcy1pbmxpbmUtbGlzdHttYXJnaW4tbGVmdDoxNzBweH0uZm9ybXMtY29sdW1uYXIgLmZvcm1zLWxpc3QgbGFiZWwsLmZvcm1zLWNvbHVtbmFyIC5mb3Jtcy1pbmxpbmUtbGlzdCBsYWJlbHtwb3NpdGlvbjpzdGF0aWM7ZmxvYXQ6bm9uZTt3aWR0aDphdXRvO3RleHQtYWxpZ246bGVmdDttYXJnaW4tcmlnaHQ6MH0uZm9ybXMtY29sdW1uYXIgLmZvcm1zLWlubGluZS1saXN0IGxhYmVse21hcmdpbi1yaWdodDoxLjY1ZW19LmZvcm1zLXB1c2h7cG9zaXRpb246cmVsYXRpdmU7cGFkZGluZy1sZWZ0OjE3MHB4fS5mb3Jtcy1zZWN0aW9ue2ZvbnQtd2VpZ2h0OmJvbGQ7Ym9yZGVyLWJvdHRvbToxcHggc29saWQgI2VlZTtwYWRkaW5nOjAgMCAxMHB4IDA7bWFyZ2luLWJvdHRvbToxZW07bGluZS1oZWlnaHQ6MX0uZm9ybXMtY29sdW1uYXIgLmZvcm1zLXNlY3Rpb257cGFkZGluZy1sZWZ0OjE3MHB4fWlucHV0W3R5cGU9InJhZGlvIl0saW5wdXRbdHlwZT0iY2hlY2tib3giXXtwb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LTFweH1pbnB1dFt0eXBlPSJ0ZXh0Il0saW5wdXRbdHlwZT0icGFzc3dvcmQiXSxpbnB1dFt0eXBlPSJlbWFpbCJdLGlucHV0W3R5cGU9InVybCJdLGlucHV0W3R5cGU9InBob25lIl0saW5wdXRbdHlwZT0idGVsIl0saW5wdXRbdHlwZT0ibnVtYmVyIl0saW5wdXRbdHlwZT0iZGF0ZXRpbWUiXSxpbnB1dFt0eXBlPSJkYXRlIl0saW5wdXRbdHlwZT0ic2VhcmNoIl0saW5wdXRbdHlwZT0iZGF0ZXRpbWUtbG9jYWwiXSx0ZXh0YXJlYSxzZWxlY3RbbXVsdGlwbGU9Im11bHRpcGxlIl17cG9zaXRpb246cmVsYXRpdmU7ei1pbmRleDoyO2ZvbnQtZmFtaWx5OidQVCBTYW5zJyxBcmlhbCwiSGVsdmV0aWNhIE5ldWUiLEhlbHZldGljYSxUYWhvbWEsc2Fucy1zZXJpZjtib3JkZXI6MXB4IHNvbGlkICNjY2M7bWFyZ2luOjA7cGFkZGluZzozcHggMnB4O2JhY2tncm91bmQtY29sb3I6d2hpdGU7Y29sb3I6IzMzMztmb250LXNpemU6MWVtO2xpbmUtaGVpZ2h0OjE7Ym9yZGVyLXJhZGl1czoxcHg7Ym94LXNoYWRvdzowIDFweCAycHggcmdiYSgwLDAsMCwwLjEpIGluc2V0Oy13ZWJraXQtdHJhbnNpdGlvbjpib3JkZXIgZWFzZSAuNXM7LW1vei10cmFuc2l0aW9uOmJvcmRlciBlYXNlIC41czstby10cmFuc2l0aW9uOmJvcmRlciBlYXNlIC41czt0cmFuc2l0aW9uOmJvcmRlciBlYXNlIC41c31pbnB1dFt0eXBlPSJyYW5nZSJde3Bvc2l0aW9uOnJlbGF0aXZlO3RvcDozcHh9dGV4dGFyZWF7bGluZS1oZWlnaHQ6MS40ZW19c2VsZWN0e21hcmdpbi1ib3R0b206MCFpbXBvcnRhbnR9LmVycm9yLC5zdWNjZXNze21hcmdpbi1sZWZ0OjVweDtmb250LXdlaWdodDpub3JtYWw7Zm9udC1zaXplOi44NWVtfWlucHV0LmlucHV0LWVycm9yLHRleHRhcmVhLmlucHV0LWVycm9yLHNlbGVjdC5pbnB1dC1lcnJvciwuaW5wdXQtZXJyb3J7Ym9yZGVyLWNvbG9yOiNkYTNlNWE7Ym94LXNoYWRvdzowIDAgMCAycHggcmdiYSgyMTgsNjIsOTAsMC4zKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjIpIGluc2V0fWlucHV0LmlucHV0LXN1Y2Nlc3MsdGV4dGFyZWEuaW5wdXQtc3VjY2VzcyxzZWxlY3QuaW5wdXQtc3VjY2VzcywuaW5wdXQtc3VjY2Vzc3tib3JkZXItY29sb3I6IzE4YTAxMTtib3gtc2hhZG93OjAgMCAwIDJweCByZ2JhKDI0LDE2MCwxNywwLjMpLDAgMXB4IDJweCByZ2JhKDAsMCwwLDAuMikgaW5zZXR9aW5wdXQuaW5wdXQtZ3JheSx0ZXh0YXJlYS5pbnB1dC1ncmF5LHNlbGVjdC5pbnB1dC1ncmF5LC5pbnB1dC1ncmF5e2JvcmRlci1jb2xvcjojY2NjO2JveC1zaGFkb3c6MCAwIDAgMnB4IHJnYmEoMjA0LDIwNCwyMDQsMC4zKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjIpIGluc2V0fWlucHV0OmZvY3VzLHRleHRhcmVhOmZvY3Vze291dGxpbmU6MDtib3JkZXItY29sb3I6IzVjYTllNDtib3gtc2hhZG93OjAgMCAwIDJweCByZ2JhKDcwLDE2MSwyMzEsMC4zKSwwIDFweCAycHggcmdiYSgwLDAsMCwwLjIpIGluc2V0fWlucHV0LmlucHV0LXNlYXJjaCxpbnB1dFt0eXBlPSJzZWFyY2giXXtwYWRkaW5nLXJpZ2h0OjEwcHg7cGFkZGluZy1sZWZ0OjEwcHg7bWFyZ2luLWJvdHRvbTowO2JvcmRlci1yYWRpdXM6MTVweH0uaW5wdXQtYXBwZW5kLC5pbnB1dC1wcmVwZW5ke2Rpc3BsYXk6aW5saW5lLWJsb2NrO2JhY2tncm91bmQtY29sb3I6I2VlZTtoZWlnaHQ6MjNweDtib3JkZXI6MXB4IHNvbGlkICNjY2M7bWFyZ2luOjA7cGFkZGluZzoxcHggOHB4O2NvbG9yOiMzMzM7Zm9udC1zaXplOjFlbTtsaW5lLWhlaWdodDoyM3B4fS5pbnB1dC1wcmVwZW5ke21hcmdpbi1yaWdodDotMXB4fS5pbnB1dC1hcHBlbmR7cG9zaXRpb246cmVsYXRpdmU7ei1pbmRleDoxO21hcmdpbi1sZWZ0Oi0xcHh9Oi1tb3otcGxhY2Vob2xkZXJ7Y29sb3I6Izk5OX06Oi1tb3otcGxhY2Vob2xkZXJ7Y29sb3I6Izk5OX06LW1zLWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiM5OTl9Ojotd2Via2l0LWlucHV0LXBsYWNlaG9sZGVye2NvbG9yOiM5OTk7cGFkZGluZzoycHh9LmNvbG9yLWJsYWNre2NvbG9yOiMwMDB9LmNvbG9yLWdyYXktZGFya3tjb2xvcjojNTU1fS5jb2xvci1ncmF5e2NvbG9yOiM3Nzd9LmNvbG9yLWdyYXktbGlnaHR7Y29sb3I6Izk5OX0uY29sb3Itd2hpdGV7Y29sb3I6I2ZmZn0uY29sb3ItcmVkLC5lcnJvcntjb2xvcjojZWY2NDY1fS5jb2xvci1ncmVlbiwuc3VjY2Vzc3tjb2xvcjojOTBhZjQ1fS5jb2xvci1vcmFuZ2V7Y29sb3I6I2Y0OGEzMH0uY29sb3ItZ3JlZW57Y29sb3I6IzkwYWY0NX0uY29sb3ItYmx1ZXtjb2xvcjojMWM3YWI0fS5jb2xvci15ZWxsb3d7Y29sb3I6I2YzYzgzNX1hLmNvbG9yLXdoaXRlOmZvY3VzLGEuY29sb3Itd2hpdGU6aG92ZXJ7Y29sb3I6I2JmYmZiZjtjb2xvcjpyZ2JhKDI1NSwyNTUsMjU1LDAuNil9YS5jb2xvci1ncmVlbjpmb2N1cyxhLmNvbG9yLWdyZWVuOmhvdmVyLGEuY29sb3ItcmVkOmZvY3VzLGEuY29sb3ItcmVkOmhvdmVyLGEuY29sb3ItZXJyb3I6Zm9jdXMsYS5jb2xvci1lcnJvcjpob3Zlcntjb2xvcjojMDAwfS5sYWJlbCwubGFiZWwtYmFkZ2V7Ym9yZGVyLXJhZGl1czoyZW07Ym9yZGVyOjFweCBzb2xpZCAjZGRkO2ZvbnQtc2l6ZTouN2VtO2Rpc3BsYXk6aW5saW5lLWJsb2NrO3Bvc2l0aW9uOnJlbGF0aXZlO3RvcDotMXB4O2xpbmUtaGVpZ2h0OjE7cGFkZGluZzozcHggOHB4O2NvbG9yOiMwMDA7YmFja2dyb3VuZC1jb2xvcjojZmZmO3RleHQtZGVjb3JhdGlvbjpub25lfS5sYWJlbC1iYWRnZXt0b3A6LTRweDtsZWZ0Oi0xcHh9LmxhYmVsLWRhdGF7Y29sb3I6Izk5OTtiYWNrZ3JvdW5kOjA7Ym9yZGVyOjA7cGFkZGluZzowfWEubGFiZWw6aG92ZXJ7Y29sb3I6IzAwMDtmaWx0ZXI6YWxwaGEob3BhY2l0eT02MCk7LW1vei1vcGFjaXR5Oi42O29wYWNpdHk6LjZ9LmxhYmVsLWJsYWNre2JhY2tncm91bmQtY29sb3I6IzAwMH0ubGFiZWwtcmVke2JhY2tncm91bmQtY29sb3I6I2VmNjQ2NX0ubGFiZWwtb3Jhbmdle2JhY2tncm91bmQtY29sb3I6I2Y0OGEzMH0ubGFiZWwtZ3JlZW57YmFja2dyb3VuZC1jb2xvcjojOTBhZjQ1fS5sYWJlbC1ibHVle2JhY2tncm91bmQtY29sb3I6IzFjN2FiNH0ubGFiZWwteWVsbG93e2JhY2tncm91bmQtY29sb3I6I2YzYzgzNX0ubGFiZWwtYmxhY2ssLmxhYmVsLXJlZCwubGFiZWwtb3JhbmdlLC5sYWJlbC1ncmVlbiwubGFiZWwtYmx1ZSwubGFiZWwteWVsbG93e2JvcmRlcjowO2NvbG9yOiNmZmY7cGFkZGluZzo0cHggOHB4fWEubGFiZWwtYmxhY2s6aG92ZXIsYS5sYWJlbC1yZWQ6aG92ZXIsYS5sYWJlbC1vcmFuZ2U6aG92ZXIsYS5sYWJlbC1ncmVlbjpob3ZlcixhLmxhYmVsLWJsdWU6aG92ZXIsYS5sYWJlbC15ZWxsb3c6aG92ZXJ7Y29sb3I6I2ZmZn0ubGFiZWwtc21hbGx7Zm9udC1zaXplOi42ZW07cGFkZGluZzozcHggNXB4fS5idG57dGV4dC1kZWNvcmF0aW9uOm5vbmU7Y29sb3I6IzAwMDtib3JkZXItcmFkaXVzOjJweDtmb250LWZhbWlseTonUFQgU2FucycsQXJpYWwsIkhlbHZldGljYSBOZXVlIixIZWx2ZXRpY2EsVGFob21hLHNhbnMtc2VyaWY7Ym9yZGVyOjFweCBzb2xpZCAjY2NjO2JvcmRlci1ib3R0b20tY29sb3I6I2IzYjNiMztsaW5lLWhlaWdodDoxO3BhZGRpbmc6LjdlbSAxLjFlbSAuNmVtIDEuMWVtO2ZvbnQtd2VpZ2h0OjUwMDtmb250LXNpemU6Ljg1ZW07YmFja2dyb3VuZC1jb2xvcjojZjFmMWYxO2JhY2tncm91bmQtaW1hZ2U6LW1vei1saW5lYXItZ3JhZGllbnQodG9wLCNmY2ZjZmMsI2UwZTBlMCk7YmFja2dyb3VuZC1pbWFnZTotbXMtbGluZWFyLWdyYWRpZW50KHRvcCwjZmNmY2ZjLCNlMGUwZTApO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1ncmFkaWVudChsaW5lYXIsMCAwLDAgMTAwJSxmcm9tKCNmY2ZjZmMpLHRvKCNlMGUwZTApKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtbGluZWFyLWdyYWRpZW50KHRvcCwjZmNmY2ZjLCNlMGUwZTApO2JhY2tncm91bmQtaW1hZ2U6LW8tbGluZWFyLWdyYWRpZW50KHRvcCwjZmNmY2ZjLCNlMGUwZTApO2JhY2tncm91bmQtaW1hZ2U6bGluZWFyLWdyYWRpZW50KHRvcCwjZmNmY2ZjLCNlMGUwZTApO2ZpbHRlcjpwcm9naWQ6RFhJbWFnZVRyYW5zZm9ybS5NaWNyb3NvZnQuZ3JhZGllbnQoc3RhcnRDb2xvcnN0cj0nI2ZjZmNmYycsZW5kQ29sb3JzdHI9JyNlMGUwZTAnLEdyYWRpZW50VHlwZT0wKTt0ZXh0LXNoYWRvdzowIDFweCAwICNmZmY7Ym94LXNoYWRvdzpub25lfS5idG46aG92ZXJ7Y29sb3I6IzAwMDtiYWNrZ3JvdW5kOiNlMGUwZTB9LmJ0bi1ibGFja3tib3JkZXItY29sb3I6IzAwMDtiYWNrZ3JvdW5kLWNvbG9yOiMyZTJlMmU7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzRkNGQ0ZCwjMDAwKTtiYWNrZ3JvdW5kLWltYWdlOi1tcy1saW5lYXItZ3JhZGllbnQodG9wLCM0ZDRkNGQsIzAwMCk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzRkNGQ0ZCksdG8oIzAwMCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCM0ZDRkNGQsIzAwMCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCM0ZDRkNGQsIzAwMCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG9wLCM0ZDRkNGQsIzAwMCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjNGQ0ZDRkJyxlbmRDb2xvcnN0cj0nIzAwMDAwMCcsR3JhZGllbnRUeXBlPTApfS5idG4tcmVke2JvcmRlci1jb2xvcjojYzAxNDE1O2JvcmRlci1ib3R0b20tY29sb3I6IzkxMGYxMDtiYWNrZ3JvdW5kLWNvbG9yOiNlNTQ1NDY7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsI2VmNjQ2NSwjZDcxNjE4KTtiYWNrZ3JvdW5kLWltYWdlOi1tcy1saW5lYXItZ3JhZGllbnQodG9wLCNlZjY0NjUsI2Q3MTYxOCk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2VmNjQ2NSksdG8oI2Q3MTYxOCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNlZjY0NjUsI2Q3MTYxOCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNlZjY0NjUsI2Q3MTYxOCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG9wLCNlZjY0NjUsI2Q3MTYxOCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZWY2NDY1JyxlbmRDb2xvcnN0cj0nI2Q3MTYxOCcsR3JhZGllbnRUeXBlPTApfS5idG4tb3Jhbmdle2JvcmRlci1jb2xvcjojY2Q2NDBiO2JvcmRlci1ib3R0b20tY29sb3I6IzljNGMwODtiYWNrZ3JvdW5kLWNvbG9yOiNlZTdmMjI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsI2Y0OGEzMCwjZTU3MDBjKTtiYWNrZ3JvdW5kLWltYWdlOi1tcy1saW5lYXItZ3JhZGllbnQodG9wLCNmNDhhMzAsI2U1NzAwYyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2Y0OGEzMCksdG8oI2U1NzAwYykpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmNDhhMzAsI2U1NzAwYyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmNDhhMzAsI2U1NzAwYyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG9wLCNmNDhhMzAsI2U1NzAwYyk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZjQ4YTMwJyxlbmRDb2xvcnN0cj0nI2U1NzAwYycsR3JhZGllbnRUeXBlPTApfS5idG4tZ3JlZW57Ym9yZGVyLWNvbG9yOiM1YTZkMmI7Ym9yZGVyLWJvdHRvbS1jb2xvcjojM2M0OTFkO2JhY2tncm91bmQtY29sb3I6IzdlOTkzYztiYWNrZ3JvdW5kLWltYWdlOi1tb3otbGluZWFyLWdyYWRpZW50KHRvcCwjOTBhZjQ1LCM2Mzc4MmYpO2JhY2tncm91bmQtaW1hZ2U6LW1zLWxpbmVhci1ncmFkaWVudCh0b3AsIzkwYWY0NSwjNjM3ODJmKTtiYWNrZ3JvdW5kLWltYWdlOi13ZWJraXQtZ3JhZGllbnQobGluZWFyLDAgMCwwIDEwMCUsZnJvbSgjOTBhZjQ1KSx0bygjNjM3ODJmKSk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWxpbmVhci1ncmFkaWVudCh0b3AsIzkwYWY0NSwjNjM3ODJmKTtiYWNrZ3JvdW5kLWltYWdlOi1vLWxpbmVhci1ncmFkaWVudCh0b3AsIzkwYWY0NSwjNjM3ODJmKTtiYWNrZ3JvdW5kLWltYWdlOmxpbmVhci1ncmFkaWVudCh0b3AsIzkwYWY0NSwjNjM3ODJmKTtmaWx0ZXI6cHJvZ2lkOkRYSW1hZ2VUcmFuc2Zvcm0uTWljcm9zb2Z0LmdyYWRpZW50KHN0YXJ0Q29sb3JzdHI9JyM5MGFmNDUnLGVuZENvbG9yc3RyPScjNjM3ODJmJyxHcmFkaWVudFR5cGU9MCl9LmJ0bi1ibHVle2JvcmRlci1jb2xvcjojMTA0NzY5O2JvcmRlci1ib3R0b20tY29sb3I6IzA5MjkzZDtiYWNrZ3JvdW5kLWNvbG9yOiMxOTZlYTI7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsIzFjN2FiNCwjMTU1Yzg4KTtiYWNrZ3JvdW5kLWltYWdlOi1tcy1saW5lYXItZ3JhZGllbnQodG9wLCMxYzdhYjQsIzE1NWM4OCk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oIzFjN2FiNCksdG8oIzE1NWM4OCkpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCMxYzdhYjQsIzE1NWM4OCk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCMxYzdhYjQsIzE1NWM4OCk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG9wLCMxYzdhYjQsIzE1NWM4OCk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjMWM3YWI0JyxlbmRDb2xvcnN0cj0nIzE1NWM4OCcsR3JhZGllbnRUeXBlPTApfS5idG4teWVsbG93e2JvcmRlci1jb2xvcjojYjc5MDBiO2JvcmRlci1ib3R0b20tY29sb3I6Izg3NmEwODtiYWNrZ3JvdW5kLWNvbG9yOiNlNWI5MjU7YmFja2dyb3VuZC1pbWFnZTotbW96LWxpbmVhci1ncmFkaWVudCh0b3AsI2YzYzgzNSwjY2ZhMzBjKTtiYWNrZ3JvdW5kLWltYWdlOi1tcy1saW5lYXItZ3JhZGllbnQodG9wLCNmM2M4MzUsI2NmYTMwYyk7YmFja2dyb3VuZC1pbWFnZTotd2Via2l0LWdyYWRpZW50KGxpbmVhciwwIDAsMCAxMDAlLGZyb20oI2YzYzgzNSksdG8oI2NmYTMwYykpO2JhY2tncm91bmQtaW1hZ2U6LXdlYmtpdC1saW5lYXItZ3JhZGllbnQodG9wLCNmM2M4MzUsI2NmYTMwYyk7YmFja2dyb3VuZC1pbWFnZTotby1saW5lYXItZ3JhZGllbnQodG9wLCNmM2M4MzUsI2NmYTMwYyk7YmFja2dyb3VuZC1pbWFnZTpsaW5lYXItZ3JhZGllbnQodG9wLCNmM2M4MzUsI2NmYTMwYyk7ZmlsdGVyOnByb2dpZDpEWEltYWdlVHJhbnNmb3JtLk1pY3Jvc29mdC5ncmFkaWVudChzdGFydENvbG9yc3RyPScjZjNjODM1JyxlbmRDb2xvcnN0cj0nI2NmYTMwYycsR3JhZGllbnRUeXBlPTApfS5idG4tYmxhY2t7dGV4dC1zaGFkb3c6MCAtMXB4IDAgIzAwMH0uYnRuLXJlZCwuYnRuLW9yYW5nZSwuYnRuLWdyZWVuLC5idG4tYmx1ZSwuYnRuLXllbGxvd3t0ZXh0LXNoYWRvdzowIC0xcHggMCByZ2JhKDAsMCwwLDAuMjQpfS5idG4tYmxhY2ssLmJ0bi1yZWQsLmJ0bi1vcmFuZ2UsLmJ0bi1ncmVlbiwuYnRuLWJsdWUsLmJ0bi15ZWxsb3d7Y29sb3I6I2ZmZn0uYnRuLWJsYWNrOmhvdmVyLC5idG4tcmVkOmhvdmVyLC5idG4tb3JhbmdlOmhvdmVyLC5idG4tZ3JlZW46aG92ZXIsLmJ0bi1ibHVlOmhvdmVyLC5idG4teWVsbG93OmhvdmVye2NvbG9yOnJnYmEoMjU1LDI1NSwyNTUsMC44KX0uYnRuLWJsYWNrOmhvdmVye2JhY2tncm91bmQ6IzAwMH0uYnRuLXJlZDpob3ZlcntiYWNrZ3JvdW5kOiNkNzE2MTh9LmJ0bi1vcmFuZ2U6aG92ZXJ7YmFja2dyb3VuZDojZTU3MDBjfS5idG4tZ3JlZW46aG92ZXJ7YmFja2dyb3VuZDojNjM3ODJmfS5idG4tYmx1ZTpob3ZlcntiYWNrZ3JvdW5kOiMxNTVjODh9LmJ0bi15ZWxsb3c6aG92ZXJ7YmFja2dyb3VuZDojY2ZhMzBjfS5idG4tc21hbGx7Zm9udC1zaXplOi43ZW19LmJ0bi1iaWd7Zm9udC1zaXplOjEuMmVtO2xpbmUtaGVpZ2h0OjEuNjVlbTtwYWRkaW5nLWxlZnQ6MS41ZW07cGFkZGluZy1yaWdodDoxLjVlbX0uYnRuLXJvdW5ke2JvcmRlci1yYWRpdXM6MjBweH0uYnRuLWFjdGl2ZSwuYnRuLWFjdGl2ZTpob3ZlciwuYnRuLmRpc2FibGVkLC5idG5bZGlzYWJsZWRdLC5idG4tZGlzYWJsZWQsLmJ0bi1kaXNhYmxlZDpob3ZlcntmaWx0ZXI6YWxwaGEob3BhY2l0eT0xMDApOy1tb3otb3BhY2l0eToxO29wYWNpdHk6MTtiYWNrZ3JvdW5kOiNkMWQxZDE7Ym9yZGVyOjFweCBzb2xpZCAjYjNiM2IzO3RleHQtc2hhZG93OjAgMXB4IDFweCAjZmZmfS5idG4tYWN0aXZlLC5idG4tYWN0aXZlOmhvdmVye2NvbG9yOiM2NjZ9LmJ0bi5kaXNhYmxlZCwuYnRuW2Rpc2FibGVkXSwuYnRuLWRpc2FibGVkLC5idG4tZGlzYWJsZWQ6aG92ZXJ7Y29sb3I6Izk5OX0uYnRuOmZvY3VzIC5oYWxmbGluZ3MsLmJ0bjpob3ZlciAuaGFsZmxpbmdze2NvbG9yOiM1NTV9LmJ0bi1ibGFjazpob3ZlciAuaGFsZmxpbmdzLC5idG4tcmVkOmhvdmVyIC5oYWxmbGluZ3MsLmJ0bi1vcmFuZ2U6aG92ZXIgLmhhbGZsaW5ncywuYnRuLWdyZWVuOmhvdmVyIC5oYWxmbGluZ3MsLmJ0bi1ibHVlOmhvdmVyIC5oYWxmbGluZ3MsLmJ0bi15ZWxsb3c6aG92ZXIgLmhhbGZsaW5nc3tjb2xvcjpyZ2JhKDI1NSwyNTUsMjU1LDAuOCl9LmJ0bi1kaXNhYmxlZDpob3ZlciAuaGFsZmxpbmdze2NvbG9yOiM5OTl9LmJ0bi1hY3RpdmUgLmhhbGZsaW5nc3tjb2xvcjojNTU1fS5idG4tc2luZ2xlLC5idG4tZ3JvdXB7ZGlzcGxheTppbmxpbmUtYmxvY2s7bWFyZ2luLXJpZ2h0OjJweDt2ZXJ0aWNhbC1hbGlnbjpib3R0b219LmJ0bi1zaW5nbGU6YWZ0ZXIsLmJ0bi1ncm91cDphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59LmJ0bi1zaW5nbGU+LmJ0biwuYnRuLXNpbmdsZT5pbnB1dCwuYnRuLWdyb3VwPi5idG4sLmJ0bi1ncm91cD5pbnB1dHtmbG9hdDpsZWZ0O2JvcmRlci1yYWRpdXM6MDttYXJnaW4tbGVmdDotMXB4fS5idG4tc2luZ2xlPi5idG57Ym9yZGVyLXJhZGl1czo0cHh9LmJ0bi1ncm91cD4uYnRuOmZpcnN0LWNoaWxke2JvcmRlci1yYWRpdXM6NHB4IDAgMCA0cHh9LmJ0bi1ncm91cD4uYnRuOmxhc3QtY2hpbGR7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH0uYnRuLWdyb3VwPi5idG4uYnRuLXJvdW5kOmZpcnN0LWNoaWxkLC5idG4tZ3JvdXA+LmlucHV0LXNlYXJjaDpmaXJzdC1jaGlsZHtib3JkZXItcmFkaXVzOjE1cHggMCAwIDE1cHh9LmJ0bi1ncm91cD4uYnRuLmJ0bi1yb3VuZDpsYXN0LWNoaWxkLC5idG4tZ3JvdXA+LmlucHV0LXNlYXJjaDpsYXN0LWNoaWxke2JvcmRlci1yYWRpdXM6MCAxNXB4IDE1cHggMH0uYnRuLWFwcGVuZCwuYnRuLWdyb3VwIC5idG57cGFkZGluZzo3cHggMS4xZW0gNnB4IDEuMWVtfS5idG4tYXBwZW5ke3Bvc2l0aW9uOnJlbGF0aXZlO3RvcDotMXB4O21hcmdpbi1sZWZ0Oi0ycHg7Ym9yZGVyLXJhZGl1czowIDRweCA0cHggMH1ALW1vei1kb2N1bWVudCB1cmwtcHJlZml4KCJodHRwOi8vIil7aW5wdXRbdHlwZT1zdWJtaXRdLmJ0bjo6LW1vei1mb2N1cy1pbm5lcixidXR0b24uYnRuOjotbW96LWZvY3VzLWlubmVye2JvcmRlcjowO3BhZGRpbmc6MH19LmZpcnN0LWxldHRlcjo6Zmlyc3QtbGV0dGVyIHtmb250LXNpemU6NGVtO2xpbmUtaGVpZ2h0Oi43NWVtO2Zsb2F0OmxlZnQ7cG9zaXRpb246cmVsYXRpdmU7cGFkZGluZy1yaWdodDo2cHg7bWFyZ2luLXRvcDotMnB4O2ZvbnQtd2VpZ2h0Om5vcm1hbDtjb2xvcjojMzMzfS5zdXBlcnNtYWxse2ZvbnQtc2l6ZTouN2VtfS5zbWFsbHtmb250LXNpemU6Ljg1ZW19LmJpZ3tmb250LXNpemU6MS4yZW19aW5wdXQuYmlne3BhZGRpbmc6MnB4IDA7Zm9udC1zaXplOjEuMmVtfS50ZXh0LWNlbnRlcmVke3RleHQtYWxpZ246Y2VudGVyfS50ZXh0LXJpZ2h0e3RleHQtYWxpZ246cmlnaHR9LnRleHQtdXBwZXJjYXNle3RleHQtdHJhbnNmb3JtOnVwcGVyY2FzZX0ubm93cmFwe3doaXRlLXNwYWNlOm5vd3JhcH0uemVyb3ttYXJnaW46MCFpbXBvcnRhbnQ7cGFkZGluZzowIWltcG9ydGFudH0uY2xlYXJ7Y2xlYXI6Ym90aH0ubGFzdHttYXJnaW4tcmlnaHQ6MCFpbXBvcnRhbnR9LnBhdXNle21hcmdpbi1ib3R0b206Ljc1ZW0haW1wb3J0YW50fS5lbmR7bWFyZ2luLWJvdHRvbTowIWltcG9ydGFudH0uaGFuZGxle2N1cnNvcjptb3ZlfS5ub3JtYWx7Zm9udC13ZWlnaHQ6bm9ybWFsfS5ib2xke2ZvbnQtd2VpZ2h0OmJvbGR9Lml0YWxpY3tmb250LXN0eWxlOml0YWxpY30ucmVxLC5yZXF1aXJlZHtmb250LXdlaWdodDpub3JtYWw7Y29sb3I6I2VmNjQ2NX0uaGlnaGxpZ2h0e2JhY2tncm91bmQtY29sb3I6I2ZmZmY5ZSFpbXBvcnRhbnR9LmNsb3Nle3BhZGRpbmc6NHB4IDZweDtsaW5lLWhlaWdodDoxO2ZvbnQtc2l6ZToxOHB4O2N1cnNvcjpwb2ludGVyO2NvbG9yOiMwMDA7dGV4dC1kZWNvcmF0aW9uOm5vbmU7b3BhY2l0eTouNH0uY2xvc2U6YmVmb3Jle2NvbnRlbnQ6J1wwMEQ3J30uY2xvc2U6aG92ZXJ7Y29sb3I6IzAwMDtvcGFjaXR5OjF9LmltYWdlLWxlZnR7ZmxvYXQ6bGVmdDttYXJnaW46MCAxZW0gMWVtIDB9LmltYWdlLXJpZ2h0e2Zsb2F0OnJpZ2h0O21hcmdpbjowIDAgMWVtIDFlbX0uaW1hZ2UtbGVmdCBpbWcsLmltYWdlLXJpZ2h0IGltZ3twb3NpdGlvbjpyZWxhdGl2ZTt0b3A6LjRlbX0uaW1hZ2UtY2VudGVyZWR7dGV4dC1hbGlnbjpjZW50ZXJ9LmltYWdlLWNvbnRhaW5lcjphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59LmltYWdlLWNvbnRlbnR7b3ZlcmZsb3c6aGlkZGVufS5uYXYtaCwubmF2LWd7bWFyZ2luLWJvdHRvbToxLjY1ZW19Lm5hdi1oOmFmdGVyLC5uYXYtZzphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59Lm5hdi1oIHVsLC5uYXYtZyB1bHtsaXN0LXN0eWxlOm5vbmU7bWFyZ2luOjB9Lm5hdi1oIHVsOmFmdGVyLC5uYXYtZyB1bDphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59Lm5hdi1oIHVsIGxpLC5uYXYtZyB1bCBsaXtmbG9hdDpsZWZ0O21hcmdpbi1yaWdodDoxLjVlbX0ubmF2LWggdWwgbGkgYSwubmF2LWggdWwgbGkgc3BhbiwubmF2LWcgdWwgbGkgYSwubmF2LWcgdWwgbGkgc3BhbntkaXNwbGF5OmJsb2NrfS5uYXYtaCB1bCBsaSBhLC5uYXYtZyB1bCBsaSBhe3RleHQtZGVjb3JhdGlvbjpub25lfS5uYXYtaCB1bCBsaSBhOmhvdmVyLC5uYXYtZyB1bCBsaSBhOmhvdmVye2NvbG9yOiNlZjY0NjU7dGV4dC1kZWNvcmF0aW9uOnVuZGVybGluZX0ubmF2LWggdWwgbGkgc3BhbiwubmF2LWcgdWwgbGkgc3Bhbntjb2xvcjojOTk5fS5uYXYtdnttYXJnaW4tYm90dG9tOjEuNjVlbX0ubmF2LXYgdWx7bGlzdC1zdHlsZTpub25lO21hcmdpbjowfS5uYXYtdiB1bCBsaXtib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZWVlfS5uYXYtdiB1bCBsaSB1bHttYXJnaW4tbGVmdDoyZW07Zm9udC1zaXplOi45NWVtfS5uYXYtdiB1bCBsaSB1bCBsaTpsYXN0LWNoaWxke2JvcmRlci1ib3R0b206MH0ubmF2LXYgdWwgbGkgdWwgbGkgYSwubmF2LXYgdWwgbGkgdWwgbGkgc3BhbntwYWRkaW5nOjRweCAwfS5uYXYtdiB1bCBsaSBhLC5uYXYtdiB1bCBsaSBzcGFue2Rpc3BsYXk6YmxvY2s7cGFkZGluZzo1cHggMH0ubmF2LXYgdWwgbGkgYXt0ZXh0LWRlY29yYXRpb246bm9uZX0ubmF2LXYgdWwgbGkgYTpob3Zlcntjb2xvcjojZWY2NDY1O3RleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmV9Lm5hdi12IHVsIGxpIHNwYW57Y29sb3I6Izk5OX0ubmF2LXN0YWNrZWQgdWx7Ym9yZGVyOjFweCBzb2xpZCAjZWVlO2JvcmRlci1ib3R0b206MH0ubmF2LXN0YWNrZWQgdWwgbGkgYSwubmF2LXN0YWNrZWQgdWwgbGkgc3BhbntwYWRkaW5nOjVweCAxMHB4fS5uYXYtc3RhY2tlZCB1bCBsaSBhOmhvdmVye2JhY2tncm91bmQtY29sb3I6I2Y1ZjVmNX0ubmF2LXN0YXRzIGxpe3Bvc2l0aW9uOnJlbGF0aXZlfS5uYXYtc3RhdHMgbGkgYSwubmF2LXN0YXRzIGxpIHNwYW57cGFkZGluZy1yaWdodDo1MHB4fS5uYXYtc3RhdHMgLmxhYmVsLC5uYXYtc3RhdHMgLmxhYmVsLWJhZGdle3Bvc2l0aW9uOmFic29sdXRlO3RvcDo1MCU7bWFyZ2luLXRvcDotOHB4O3JpZ2h0OjB9Lm5hdi1zdGF0cy5uYXYtc3RhY2tlZCAubGFiZWwsLm5hdi1zdGF0cy5uYXYtc3RhY2tlZCAubGFiZWwtYmFkZ2V7cmlnaHQ6NHB4fS5uYXYtc3RhdHMgLmxhYmVsLmxhYmVsLWRhdGEsLm5hdi1zdGFja2VkIC5sYWJlbC1kYXRhe21hcmdpbi10b3A6LTZweDtyaWdodDo2cHh9Lm5hdi12IGgxLC5uYXYtdiBoMiwubmF2LXYgaDMsLm5hdi12IGg0LC5uYXYtdiBoNSwubmF2LXYgaDZ7bWFyZ2luLXRvcDoxLjVlbTttYXJnaW4tYm90dG9tOjNweH0ubmF2LXYgaDE6Zmlyc3QtY2hpbGQsLm5hdi12IGgyOmZpcnN0LWNoaWxkLC5uYXYtdiBoMzpmaXJzdC1jaGlsZCwubmF2LXYgaDQ6Zmlyc3QtY2hpbGQsLm5hdi12IGg1OmZpcnN0LWNoaWxkLC5uYXYtdiBoNjpmaXJzdC1jaGlsZHttYXJnaW4tdG9wOjB9LmJyZWFkY3J1bWJze21hcmdpbi1ib3R0b206MS42NWVtfS5icmVhZGNydW1iczphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59LmJyZWFkY3J1bWJzIHVse2ZvbnQtc2l6ZTouOWVtO2NvbG9yOiM5OTk7bGlzdC1zdHlsZTpub25lO21hcmdpbjowfS5icmVhZGNydW1icyB1bDphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59LmJyZWFkY3J1bWJzIHVsIGxpe2Zsb2F0OmxlZnQ7bWFyZ2luLXJpZ2h0OjNweH0uYnJlYWRjcnVtYnMgbGkrbGk6YmVmb3Jle2NvbnRlbnQ6IiA+ICI7Y29sb3I6I2FhYTtmb250LXNpemU6MTJweDttYXJnaW46MCAzcHg7cG9zaXRpb246cmVsYXRpdmU7dG9wOi0xcHh9LmJyZWFkY3J1bWJzLXNlY3Rpb25zIGxpK2xpOmJlZm9yZXtjb250ZW50OiIgfCAiO3RvcDowfS5icmVhZGNydW1icy1wYXRoIGxpK2xpOmJlZm9yZXtjb250ZW50OiIgLyAiO3RvcDowfS5icmVhZGNydW1icyB1bCBsaSBhe2NvbG9yOiMwMDA7dGV4dC1kZWNvcmF0aW9uOm5vbmV9LmJyZWFkY3J1bWJzIHVsIGxpIGEuYWN0aXZle2NvbG9yOiM5OTl9LmJyZWFkY3J1bWJzIHVsIGxpIGE6aG92ZXJ7Y29sb3I6IzAwMDt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lfS5uYXYtdGFic3tib3JkZXItYm90dG9tOjFweCBzb2xpZCAjZTNlM2UzO21hcmdpbi1ib3R0b206MS42NWVtfS5uYXYtdGFiczphZnRlcntjb250ZW50OiIuIjtkaXNwbGF5OmJsb2NrO2hlaWdodDowO2NsZWFyOmJvdGg7dmlzaWJpbGl0eTpoaWRkZW59Lm5hdi10YWJzIHVse2xpc3Qtc3R5bGU6bm9uZTttYXJnaW46MH0ubmF2LXRhYnMgdWw6YWZ0ZXJ7Y29udGVudDoiLiI7ZGlzcGxheTpibG9jaztoZWlnaHQ6MDtjbGVhcjpib3RoO3Zpc2liaWxpdHk6aGlkZGVufS5uYXYtdGFicyB1bCBsaXtmbG9hdDpsZWZ0O21hcmdpbi1yaWdodDoycHh9Lm5hdi10YWJzIHVsIGxpIGEsLm5hdi10YWJzIHVsIGxpIHNwYW57ZGlzcGxheTpibG9jaztsaW5lLWhlaWdodDoxO3BhZGRpbmc6OHB4IDEycHggOXB4IDEycHh9Lm5hdi10YWJzIHVsIGxpIGF7Y29sb3I6Izk5OTt0ZXh0LWRlY29yYXRpb246bm9uZX0ubmF2LXRhYnMgdWwgbGkgYTpmb2N1cywubmF2LXRhYnMgdWwgbGkgYTpob3Zlcntjb2xvcjojMDAwO3RleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmV9Lm5hdi10YWJzIHVsIGxpIC5hY3RpdmUsLm5hdi10YWJzIHVsIGxpIHNwYW57Y29sb3I6IzAwMDtiYWNrZ3JvdW5kOiNmZmY7bWFyZ2luLXRvcDotMnB4O3Bvc2l0aW9uOnJlbGF0aXZlO3BhZGRpbmc6OHB4IDExcHggOXB4IDExcHg7Ym9yZGVyOjFweCBzb2xpZCAjZGRkO2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNmZmY7Ym90dG9tOi0xcHh9Lm5hdi10YWJzIHVsIGxpIC5hY3RpdmV7Y3Vyc29yOmRlZmF1bHR9Lm5hdi10YWJzLXZ7Ym9yZGVyOjA7Ym9yZGVyLXJpZ2h0OjFweCBzb2xpZCAjZTNlM2UzfS5uYXYtdGFicy12IHVsIGxpe2Zsb2F0Om5vbmV9Lm5hdi10YWJzLXYgdWwgbGkgc3BhbnttYXJnaW4tdG9wOjA7Ym90dG9tOjA7bWFyZ2luLXJpZ2h0Oi0zcHg7Ym9yZGVyOjFweCBzb2xpZCAjZGRkO2JvcmRlci1yaWdodDoxcHggc29saWQgI2ZmZn0ubmF2LXBpbGxze21hcmdpbi1ib3R0b206MS4xNWVtfS5uYXYtcGlsbHM6YWZ0ZXJ7Y29udGVudDoiLiI7ZGlzcGxheTpibG9jaztoZWlnaHQ6MDtjbGVhcjpib3RoO3Zpc2liaWxpdHk6aGlkZGVufS5uYXYtcGlsbHMgdWx7bGlzdC1zdHlsZTpub25lO21hcmdpbjowfS5uYXYtcGlsbHMgdWw6YWZ0ZXJ7Y29udGVudDoiLiI7ZGlzcGxheTpibG9jaztoZWlnaHQ6MDtjbGVhcjpib3RoO3Zpc2liaWxpdHk6aGlkZGVufS5uYXYtcGlsbHMgdWwgbGl7ZmxvYXQ6bGVmdDttYXJnaW4tcmlnaHQ6LjVlbTttYXJnaW4tYm90dG9tOi42NDk5OTk5OTk5OTk5OTk5ZW19Lm5hdi1waWxscyB1bCBsaSBhLC5uYXYtcGlsbHMgdWwgbGkgc3BhbntkaXNwbGF5OmJsb2NrO3BhZGRpbmc6NnB4IDE1cHg7bGluZS1oZWlnaHQ6MTtib3JkZXItcmFkaXVzOjE1cHh9Lm5hdi1waWxscyB1bCBsaSBhe2NvbG9yOiM3Nzc7dGV4dC1kZWNvcmF0aW9uOm5vbmU7YmFja2dyb3VuZC1jb2xvcjojZjNmNGY1fS5uYXYtcGlsbHMgdWwgbGkgYTpob3Zlcntjb2xvcjojNTU1O3RleHQtZGVjb3JhdGlvbjp1bmRlcmxpbmV9Lm5hdi1waWxscyB1bCBsaSAuYWN0aXZlLC5uYXYtcGlsbHMgdWwgbGkgLmFjdGl2ZTpob3ZlciwubmF2LXBpbGxzIHVsIGxpIHNwYW57Y29sb3I6Izc3NztwYWRkaW5nOjVweCAxNHB4O2JvcmRlcjoxcHggc29saWQgI2RkZDtiYWNrZ3JvdW5kOjB9Lm5hdi1waWxscyB1bCBsaSAuYWN0aXZlLC5uYXYtcGlsbHMgdWwgbGkgLmFjdGl2ZTpob3ZlcntjdXJzb3I6ZGVmYXVsdDt0ZXh0LWRlY29yYXRpb246bm9uZX0ucGFnaW5hdGlvbntwb3NpdGlvbjpyZWxhdGl2ZTtsZWZ0Oi05cHg7bWFyZ2luLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmV9LnBhZ2luYXRpb246YWZ0ZXJ7Y29udGVudDoiLiI7ZGlzcGxheTpibG9jaztoZWlnaHQ6MDtjbGVhcjpib3RoO3Zpc2liaWxpdHk6aGlkZGVufS5wYWdpbmF0aW9uIGxpe2Zsb2F0OmxlZnQ7bWFyZ2luLXJpZ2h0OjJweH0ucGFnaW5hdGlvbiBsaSBhLC5wYWdpbmF0aW9uIGxpIHNwYW57ZGlzcGxheTpibG9jaztwYWRkaW5nOjdweCA5cHg7bGluZS1oZWlnaHQ6MTtib3JkZXItcmFkaXVzOjJlbTtjb2xvcjojMDAwO3RleHQtZGVjb3JhdGlvbjpub25lfS5wYWdpbmF0aW9uIHNwYW57Ym9yZGVyOjFweCBzb2xpZCAjZGRkfS5wYWdpbmF0aW9uIGxpIGE6Zm9jdXMsLnBhZ2luYXRpb24gbGkgYTpob3Zlcnt0ZXh0LWRlY29yYXRpb246dW5kZXJsaW5lO2JhY2tncm91bmQtY29sb3I6IzMzMztjb2xvcjojZmZmfS5wYWdpbmF0aW9uIGxpLnBhZ2luYXRpb24tb2xkZXJ7bWFyZ2luLWxlZnQ6N3B4fS5wYWdpbmF0aW9uIGxpLnBhZ2luYXRpb24tb2xkZXIgYSwucGFnaW5hdGlvbiBsaS5wYWdpbmF0aW9uLW5ld2VzdCBhLC5wYWdpbmF0aW9uIGxpLnBhZ2luYXRpb24tb2xkZXIgc3BhbiwucGFnaW5hdGlvbiBsaS5wYWdpbmF0aW9uLW5ld2VzdCBzcGFue3BhZGRpbmc6NXB4IDE1cHg7Ym9yZGVyLXJhZGl1czoyZW07Ym9yZGVyOjFweCBzb2xpZCAjZGRkfS5wYWdpbmF0aW9uIGxpLnBhZ2luYXRpb24tb2xkZXIgc3BhbiwucGFnaW5hdGlvbiBsaS5wYWdpbmF0aW9uLW5ld2VzdCBzcGFue2JvcmRlci1jb2xvcjojZWVlO2NvbG9yOiM5OTl9LnBhZ2luYXRpb24gbGkucGFnaW5hdGlvbi1wdWxse2Zsb2F0OnJpZ2h0O21hcmdpbi1yaWdodDotN3B4O21hcmdpbi1sZWZ0Oi41ZW19Lm1lc3NhZ2V7cG9zaXRpb246cmVsYXRpdmU7cGFkZGluZzo5cHggMTNweDtib3JkZXI6MXB4IHNvbGlkICNmN2RjN2Q7Ym9yZGVyLXJhZGl1czo1cHg7bWFyZ2luLWJvdHRvbToxLjY1ZW07Y29sb3I6IzlmN2QwOTtiYWNrZ3JvdW5kLWNvbG9yOiNmZGY3ZTJ9Lm1lc3NhZ2UtZXJyb3J7Y29sb3I6I2MwMTQxNTtib3JkZXItY29sb3I6I2Y5YzBjMTtiYWNrZ3JvdW5kLWNvbG9yOiNmZGVmZWZ9Lm1lc3NhZ2Utc3VjY2Vzc3tjb2xvcjojNTQ2NjI4O2JvcmRlci1jb2xvcjojZDFkZmFlO2JhY2tncm91bmQtY29sb3I6I2YwZjVlNX0ubWVzc2FnZS1pbmZve2NvbG9yOiMxMjRkNzI7Ym9yZGVyLWNvbG9yOiNiM2RiZjM7YmFja2dyb3VuZC1jb2xvcjojZGZmMGZhfS5tZXNzYWdlIGhlYWRlcntmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToxLjJlbX0ubWVzc2FnZSAuY2xvc2V7Y3Vyc29yOnBvaW50ZXI7cG9zaXRpb246YWJzb2x1dGU7cmlnaHQ6M3B4O3RvcDo2cHh9LnVuaXRzLWNvbnRhaW5lcjphZnRlciwudW5pdHMtcm93LWVuZDphZnRlciwudW5pdHMtcm93OmFmdGVye2NvbnRlbnQ6Ii4iO2Rpc3BsYXk6YmxvY2s7aGVpZ2h0OjA7Y2xlYXI6Ym90aDt2aXNpYmlsaXR5OmhpZGRlbn0udW5pdHMtY29udGFpbmVye3BhZGRpbmctdG9wOjFweDttYXJnaW4tdG9wOi0xcHh9LnVuaXRzLWNvbnRhaW5lciwudW5pdHMtcm93LWVuZCwudW5pdHMtcm93ey13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0udW5pdHMtcm93e21hcmdpbi1ib3R0b206MS41ZW19LnVuaXRzLXJvdy1lbmR7bWFyZ2luLWJvdHRvbTowfS53aWR0aC0xMDAsLnVuaXQtMTAwe3dpZHRoOjEwMCV9LndpZHRoLTgwLC51bml0LTgwe3dpZHRoOjgwJX0ud2lkdGgtNzUsLnVuaXQtNzV7d2lkdGg6NzUlfS53aWR0aC03MCwudW5pdC03MHt3aWR0aDo3MCV9LndpZHRoLTY2LC51bml0LTY2e3dpZHRoOjY2LjYlfS53aWR0aC02MCwudW5pdC02MHt3aWR0aDo2MCV9LndpZHRoLTUwLC51bml0LTUwe3dpZHRoOjUwJX0ud2lkdGgtNDAsLnVuaXQtNDB7d2lkdGg6NDAlfS53aWR0aC0zMywudW5pdC0zM3t3aWR0aDozMy4zJX0ud2lkdGgtMzAsLnVuaXQtMzB7d2lkdGg6MzAlfS53aWR0aC0yNSwudW5pdC0yNXt3aWR0aDoyNSV9LndpZHRoLTIwLC51bml0LTIwe3dpZHRoOjIwJX1pbnB1dC53aWR0aC0xMDAsaW5wdXQudW5pdC0xMDB7d2lkdGg6OTguNiV9dGV4dGFyZWEud2lkdGgtMTAwLHRleHRhcmVhLnVuaXQtMTAwe3dpZHRoOjk4LjglfXNlbGVjdC53aWR0aC0xMDAsc2VsZWN0LnVuaXQtMTAwe3dpZHRoOjk5LjQlfS53aWR0aC0xMDAsLndpZHRoLTgwLC53aWR0aC03NSwud2lkdGgtNzAsLndpZHRoLTY2LC53aWR0aC02MCwud2lkdGgtNTAsLndpZHRoLTQwLC53aWR0aC0zMywud2lkdGgtMzAsLndpZHRoLTI1LC53aWR0aC0yMCwudW5pdHMtcm93IC51bml0LTEwMCwudW5pdHMtcm93IC51bml0LTgwLC51bml0cy1yb3cgLnVuaXQtNzUsLnVuaXRzLXJvdyAudW5pdC03MCwudW5pdHMtcm93IC51bml0LTY2LC51bml0cy1yb3cgLnVuaXQtNjAsLnVuaXRzLXJvdyAudW5pdC01MCwudW5pdHMtcm93IC51bml0LTQwLC51bml0cy1yb3cgLnVuaXQtMzMsLnVuaXRzLXJvdyAudW5pdC0zMCwudW5pdHMtcm93IC51bml0LTI1LC51bml0cy1yb3cgLnVuaXQtMjAsLnVuaXRzLXJvdy1lbmQgLnVuaXQtMTAwLC51bml0cy1yb3ctZW5kIC51bml0LTgwLC51bml0cy1yb3ctZW5kIC51bml0LTc1LC51bml0cy1yb3ctZW5kIC51bml0LTcwLC51bml0cy1yb3ctZW5kIC51bml0LTY2LC51bml0cy1yb3ctZW5kIC51bml0LTYwLC51bml0cy1yb3ctZW5kIC51bml0LTUwLC51bml0cy1yb3ctZW5kIC51bml0LTQwLC51bml0cy1yb3ctZW5kIC51bml0LTMzLC51bml0cy1yb3ctZW5kIC51bml0LTMwLC51bml0cy1yb3ctZW5kIC51bml0LTI1LC51bml0cy1yb3ctZW5kIC51bml0LTIwey13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0udW5pdHMtcm93IC51bml0LTgwLC51bml0cy1yb3cgLnVuaXQtNzUsLnVuaXRzLXJvdyAudW5pdC03MCwudW5pdHMtcm93IC51bml0LTY2LC51bml0cy1yb3cgLnVuaXQtNjAsLnVuaXRzLXJvdyAudW5pdC01MCwudW5pdHMtcm93IC51bml0LTQwLC51bml0cy1yb3cgLnVuaXQtMzMsLnVuaXRzLXJvdyAudW5pdC0zMCwudW5pdHMtcm93IC51bml0LTI1LC51bml0cy1yb3cgLnVuaXQtMjAsLnVuaXRzLXJvdy1lbmQgLnVuaXQtMTAwLC51bml0cy1yb3ctZW5kIC51bml0LTgwLC51bml0cy1yb3ctZW5kIC51bml0LTc1LC51bml0cy1yb3ctZW5kIC51bml0LTcwLC51bml0cy1yb3ctZW5kIC51bml0LTY2LC51bml0cy1yb3ctZW5kIC51bml0LTYwLC51bml0cy1yb3ctZW5kIC51bml0LTUwLC51bml0cy1yb3ctZW5kIC51bml0LTQwLC51bml0cy1yb3ctZW5kIC51bml0LTMzLC51bml0cy1yb3ctZW5kIC51bml0LTMwLC51bml0cy1yb3ctZW5kIC51bml0LTI1LC51bml0cy1yb3ctZW5kIC51bml0LTIwe2Zsb2F0OmxlZnQ7bWFyZ2luLWxlZnQ6MyV9LnVuaXRzLXJvdyAudW5pdC04MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93IC51bml0LTc1OmZpcnN0LWNoaWxkLC51bml0cy1yb3cgLnVuaXQtNzA6Zmlyc3QtY2hpbGQsLnVuaXRzLXJvdyAudW5pdC02NjpmaXJzdC1jaGlsZCwudW5pdHMtcm93IC51bml0LTYwOmZpcnN0LWNoaWxkLC51bml0cy1yb3cgLnVuaXQtNTA6Zmlyc3QtY2hpbGQsLnVuaXRzLXJvdyAudW5pdC00MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93IC51bml0LTMzOmZpcnN0LWNoaWxkLC51bml0cy1yb3cgLnVuaXQtMzA6Zmlyc3QtY2hpbGQsLnVuaXRzLXJvdyAudW5pdC0yNTpmaXJzdC1jaGlsZCwudW5pdHMtcm93IC51bml0LTIwOmZpcnN0LWNoaWxkLC51bml0cy1yb3ctZW5kIC51bml0LTEwMDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC04MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC03NTpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC03MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC02NjpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC02MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC01MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC00MDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC0zMzpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC0zMDpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC0yNTpmaXJzdC1jaGlsZCwudW5pdHMtcm93LWVuZCAudW5pdC0yMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowfS51bml0cy1yb3cgLnVuaXQtODAsLnVuaXRzLXJvdy1lbmQgLnVuaXQtODB7d2lkdGg6NzkuNCV9LnVuaXRzLXJvdyAudW5pdC03NSwudW5pdHMtcm93LWVuZCAudW5pdC03NXt3aWR0aDo3NC4yNSV9LnVuaXRzLXJvdyAudW5pdC03MCwudW5pdHMtcm93LWVuZCAudW5pdC03MHt3aWR0aDo2OS4xJX0udW5pdHMtcm93IC51bml0LTY2LC51bml0cy1yb3ctZW5kIC51bml0LTY2e3dpZHRoOjY1LjY2NjY2NjY2NjY2NjY2JX0udW5pdHMtcm93IC51bml0LTYwLC51bml0cy1yb3ctZW5kIC51bml0LTYwe3dpZHRoOjU4LjgwMDAwMDAwMDAwMDAwNCV9LnVuaXRzLXJvdyAudW5pdC01MCwudW5pdHMtcm93LWVuZCAudW5pdC01MHt3aWR0aDo0OC41JX0udW5pdHMtcm93IC51bml0LTQwLC51bml0cy1yb3ctZW5kIC51bml0LTQwe3dpZHRoOjM4LjIlfS51bml0cy1yb3cgLnVuaXQtMzAsLnVuaXRzLXJvdy1lbmQgLnVuaXQtMzB7d2lkdGg6MjcuOSV9LnVuaXRzLXJvdyAudW5pdC0zMywudW5pdHMtcm93LWVuZCAudW5pdC0zM3t3aWR0aDozMS4zMzMzMzMzMzMzMzMzMzIlfS51bml0cy1yb3cgLnVuaXQtMjUsLnVuaXRzLXJvdy1lbmQgLnVuaXQtMjV7d2lkdGg6MjIuNzUlfS51bml0cy1yb3cgLnVuaXQtMjAsLnVuaXRzLXJvdy1lbmQgLnVuaXQtMjB7d2lkdGg6MTcuNiV9LnVuaXQtcHVzaC04MCwudW5pdC1wdXNoLTc1LC51bml0LXB1c2gtNzAsLnVuaXQtcHVzaC02NiwudW5pdC1wdXNoLTYwLC51bml0LXB1c2gtNTAsLnVuaXQtcHVzaC00MCwudW5pdC1wdXNoLTMzLC51bml0LXB1c2gtMzAsLnVuaXQtcHVzaC0yNSwudW5pdC1wdXNoLTIwe3Bvc2l0aW9uOnJlbGF0aXZlfS51bml0LXB1c2gtMzB7bGVmdDozMC45JX0udW5pdC1wdXNoLTgwe2xlZnQ6ODIuNCV9LnVuaXQtcHVzaC03NXtsZWZ0Ojc3LjI1JX0udW5pdC1wdXNoLTcwe2xlZnQ6NzIuMSV9LnVuaXQtcHVzaC02NntsZWZ0OjY4LjY2NjY2NjY2NjY2NjY2JX0udW5pdC1wdXNoLTYwe2xlZnQ6NjEuODAwMDAwMDAwMDAwMDA0JX0udW5pdC1wdXNoLTUwe2xlZnQ6NTEuNSV9LnVuaXQtcHVzaC00MHtsZWZ0OjQxLjIlfS51bml0LXB1c2gtMzN7bGVmdDozNC4zMzMzMzMzMzMzMzMzMyV9LnVuaXQtcHVzaC0yNXtsZWZ0OjI1Ljc1JX0udW5pdC1wdXNoLTIwe2xlZnQ6MjAuNiV9LnVuaXQtcHVzaC1yaWdodHtmbG9hdDpyaWdodH0uY2VudGVyZWQsLnVuaXQtY2VudGVyZWR7ZmxvYXQ6bm9uZSFpbXBvcnRhbnQ7bWFyZ2luOjAgYXV0byFpbXBvcnRhbnR9LnVuaXQtcGFkZGluZ3twYWRkaW5nOjEuNjVlbX0udW5pdHMtcGFkZGluZyAudW5pdC0xMDAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtODAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtNzUsLnVuaXRzLXBhZGRpbmcgLnVuaXQtNzAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtNjYsLnVuaXRzLXBhZGRpbmcgLnVuaXQtNjAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtNTAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtNDAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtMzMsLnVuaXRzLXBhZGRpbmcgLnVuaXQtMzAsLnVuaXRzLXBhZGRpbmcgLnVuaXQtMjUsLnVuaXRzLXBhZGRpbmcgLnVuaXQtMjB7cGFkZGluZzoxLjY1ZW19LnVuaXRzLXNwbGl0IC51bml0LTgwLC51bml0cy1zcGxpdCAudW5pdC03NSwudW5pdHMtc3BsaXQgLnVuaXQtNzAsLnVuaXRzLXNwbGl0IC51bml0LTY2LC51bml0cy1zcGxpdCAudW5pdC02MCwudW5pdHMtc3BsaXQgLnVuaXQtNTAsLnVuaXRzLXNwbGl0IC51bml0LTQwLC51bml0cy1zcGxpdCAudW5pdC0zMywudW5pdHMtc3BsaXQgLnVuaXQtMzAsLnVuaXRzLXNwbGl0IC51bml0LTI1LC51bml0cy1zcGxpdCAudW5pdC0yMHttYXJnaW4tbGVmdDowfS51bml0cy1zcGxpdCAudW5pdC04MHt3aWR0aDo4MCV9LnVuaXRzLXNwbGl0IC51bml0LTc1e3dpZHRoOjc1JX0udW5pdHMtc3BsaXQgLnVuaXQtNzB7d2lkdGg6NzAlfS51bml0cy1zcGxpdCAudW5pdC02Nnt3aWR0aDo2Ni42JX0udW5pdHMtc3BsaXQgLnVuaXQtNjB7d2lkdGg6NjAlfS51bml0cy1zcGxpdCAudW5pdC01MHt3aWR0aDo1MCV9LnVuaXRzLXNwbGl0IC51bml0LTQwe3dpZHRoOjQwJX0udW5pdHMtc3BsaXQgLnVuaXQtMzN7d2lkdGg6MzMuMyV9LnVuaXRzLXNwbGl0IC51bml0LTMwe3dpZHRoOjMwJX0udW5pdHMtc3BsaXQgLnVuaXQtMjV7d2lkdGg6MjUlfS51bml0cy1zcGxpdCAudW5pdC0yMHt3aWR0aDoyMCV9LmJsb2Nrcy0yLC5ibG9ja3MtMywuYmxvY2tzLTQsLmJsb2Nrcy01LC5ibG9ja3MtNntwYWRkaW5nLWxlZnQ6MDtsaXN0LXN0eWxlOm5vbmU7bWFyZ2luLWxlZnQ6LTMlOy13ZWJraXQtYm94LXNpemluZzpib3JkZXItYm94Oy1tb3otYm94LXNpemluZzpib3JkZXItYm94O2JveC1zaXppbmc6Ym9yZGVyLWJveH0uYmxvY2tzLTI6YWZ0ZXIsLmJsb2Nrcy0zOmFmdGVyLC5ibG9ja3MtNDphZnRlciwuYmxvY2tzLTU6YWZ0ZXIsLmJsb2Nrcy02OmFmdGVye2NvbnRlbnQ6Ii4iO2Rpc3BsYXk6YmxvY2s7aGVpZ2h0OjA7Y2xlYXI6Ym90aDt2aXNpYmlsaXR5OmhpZGRlbn0uYmxvY2tzLTI+bGksLmJsb2Nrcy0zPmxpLC5ibG9ja3MtND5saSwuYmxvY2tzLTU+bGksLmJsb2Nrcy02Pmxpe2hlaWdodDphdXRvO2Zsb2F0OmxlZnQ7bWFyZ2luLWJvdHRvbToxLjY1ZW07bWFyZ2luLWxlZnQ6MyU7LXdlYmtpdC1ib3gtc2l6aW5nOmJvcmRlci1ib3g7LW1vei1ib3gtc2l6aW5nOmJvcmRlci1ib3g7Ym94LXNpemluZzpib3JkZXItYm94fS5ibG9ja3MtMj5saXt3aWR0aDo0NyV9LmJsb2Nrcy0zPmxpe3dpZHRoOjMwLjMzMzMzMzMzMzMzMzMzMiV9LmJsb2Nrcy00Pmxpe3dpZHRoOjIyJX0uYmxvY2tzLTU+bGl7d2lkdGg6MTclfS5ibG9ja3MtNj5saXt3aWR0aDoxMy42NjY2NjY2NjY2NjY2NjYlfS5ibG9jay1maXJzdHtjbGVhcjpib3RofUBtZWRpYShtaW4td2lkdGg6NzY4cHgpey5kZXNrdG9wLWhpZGV7ZGlzcGxheTpub25lfX1AbWVkaWEgb25seSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6NzY3cHgpey5tb2JpbGUtdGV4dC1jZW50ZXJlZHt0ZXh0LWFsaWduOmNlbnRlcn0ubW9iaWxlLWhpZGV7ZGlzcGxheTpub25lfX1pbWcsdmlkZW97bWF4LXdpZHRoOjEwMCU7aGVpZ2h0OmF1dG99aW1ney1tcy1pbnRlcnBvbGF0aW9uLW1vZGU6YmljdWJpY31hdWRpb3t3aWR0aDoxMDAlfS52aWRlby13cmFwcGVye2hlaWdodDowO3BhZGRpbmctYm90dG9tOjU2LjI1JTtwb3NpdGlvbjpyZWxhdGl2ZTttYXJnaW4tYm90dG9tOjEuNjVlbX0udmlkZW8td3JhcHBlciBpZnJhbWUsLnZpZGVvLXdyYXBwZXIgb2JqZWN0LC52aWRlby13cmFwcGVyIGVtYmVke3Bvc2l0aW9uOmFic29sdXRlO3RvcDowO2xlZnQ6MDt3aWR0aDoxMDAlO2hlaWdodDoxMDAlfUBtZWRpYSBvbmx5IHNjcmVlbiBhbmQgKG1heC13aWR0aDo3NjdweCl7LnVuaXRzLXJvdyAudW5pdC04MCwudW5pdHMtcm93IC51bml0LTc1LC51bml0cy1yb3cgLnVuaXQtNzAsLnVuaXRzLXJvdyAudW5pdC02NiwudW5pdHMtcm93IC51bml0LTYwLC51bml0cy1yb3cgLnVuaXQtNTAsLnVuaXRzLXJvdyAudW5pdC00MCwudW5pdHMtcm93IC51bml0LTMzLC51bml0cy1yb3cgLnVuaXQtMzAsLnVuaXRzLXJvdyAudW5pdC0yNSwudW5pdHMtcm93IC51bml0LTIwLC51bml0cy1yb3ctZW5kIC51bml0LTgwLC51bml0cy1yb3ctZW5kIC51bml0LTc1LC51bml0cy1yb3ctZW5kIC51bml0LTcwLC51bml0cy1yb3ctZW5kIC51bml0LTY2LC51bml0cy1yb3ctZW5kIC51bml0LTYwLC51bml0cy1yb3ctZW5kIC51bml0LTUwLC51bml0cy1yb3ctZW5kIC51bml0LTQwLC51bml0cy1yb3ctZW5kIC51bml0LTMzLC51bml0cy1yb3ctZW5kIC51bml0LTMwLC51bml0cy1yb3ctZW5kIC51bml0LTI1LC51bml0cy1yb3ctZW5kIC51bml0LTIwe3dpZHRoOjEwMCU7ZmxvYXQ6bm9uZTttYXJnaW4tbGVmdDowO21hcmdpbi1ib3R0b206MS42NWVtfS51bml0LXB1c2gtODAsLnVuaXQtcHVzaC03NSwudW5pdC1wdXNoLTcwLC51bml0LXB1c2gtNjYsLnVuaXQtcHVzaC02MCwudW5pdC1wdXNoLTUwLC51bml0LXB1c2gtNDAsLnVuaXQtcHVzaC0zMywudW5pdC1wdXNoLTMwLC51bml0LXB1c2gtMjUsLnVuaXQtcHVzaC0yMHtsZWZ0OjB9LnVuaXRzLXJvdy1lbmQgLnVuaXQtcHVzaC1yaWdodCwudW5pdHMtcm93IC51bml0LXB1c2gtcmlnaHR7ZmxvYXQ6bm9uZX0udW5pdHMtbW9iaWxlLTUwIC51bml0LTgwLC51bml0cy1tb2JpbGUtNTAgLnVuaXQtNzUsLnVuaXRzLW1vYmlsZS01MCAudW5pdC03MCwudW5pdHMtbW9iaWxlLTUwIC51bml0LTY2LC51bml0cy1tb2JpbGUtNTAgLnVuaXQtNjAsLnVuaXRzLW1vYmlsZS01MCAudW5pdC00MCwudW5pdHMtbW9iaWxlLTUwIC51bml0LTMwLC51bml0cy1tb2JpbGUtNTAgLnVuaXQtMzMsLnVuaXRzLW1vYmlsZS01MCAudW5pdC0yNSwudW5pdHMtbW9iaWxlLTUwIC51bml0LTIwe2Zsb2F0OmxlZnQ7bWFyZ2luLWxlZnQ6MyU7d2lkdGg6NDguNSV9LnVuaXRzLW1vYmlsZS01MCAudW5pdC04MDpmaXJzdC1jaGlsZCwudW5pdHMtbW9iaWxlLTUwIC51bml0LTc1OmZpcnN0LWNoaWxkLC51bml0cy1tb2JpbGUtNTAgLnVuaXQtNzA6Zmlyc3QtY2hpbGQsLnVuaXRzLW1vYmlsZS01MCAudW5pdC02NjpmaXJzdC1jaGlsZCwudW5pdHMtbW9iaWxlLTUwIC51bml0LTYwOmZpcnN0LWNoaWxkLC51bml0cy1tb2JpbGUtNTAgLnVuaXQtNDA6Zmlyc3QtY2hpbGQsLnVuaXRzLW1vYmlsZS01MCAudW5pdC0zMDpmaXJzdC1jaGlsZCwudW5pdHMtbW9iaWxlLTUwIC51bml0LTMzOmZpcnN0LWNoaWxkLC51bml0cy1tb2JpbGUtNTAgLnVuaXQtMjU6Zmlyc3QtY2hpbGQsLnVuaXRzLW1vYmlsZS01MCAudW5pdC0yMDpmaXJzdC1jaGlsZHttYXJnaW4tbGVmdDowfX1AbWVkaWEgb25seSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6NzY3cHgpey5ibG9ja3MtMiwuYmxvY2tzLTMsLmJsb2Nrcy00LC5ibG9ja3MtNSwuYmxvY2tzLTZ7bWFyZ2luLWxlZnQ6MDttYXJnaW4tYm90dG9tOjEuNjVlbX0uYmxvY2tzLTI+bGksLmJsb2Nrcy0zPmxpLC5ibG9ja3MtND5saSwuYmxvY2tzLTU+bGksLmJsb2Nrcy02Pmxpe2Zsb2F0Om5vbmU7bWFyZ2luLWxlZnQ6MDt3aWR0aDoxMDAlfS5ibG9ja3MtbW9iaWxlLTUwPmxpLC5ibG9ja3MtbW9iaWxlLTMzPmxpe2Zsb2F0OmxlZnQ7bWFyZ2luLWxlZnQ6MyV9LmJsb2Nrcy1tb2JpbGUtMzMsLmJsb2Nrcy1tb2JpbGUtNTB7bWFyZ2luLWxlZnQ6LTMlfS5ibG9ja3MtbW9iaWxlLTUwPmxpe3dpZHRoOjQ3JX0uYmxvY2tzLW1vYmlsZS0zMz5saXt3aWR0aDozMC4zMzMzMzMzMzMzMzMzMzIlfX1AbWVkaWEgb25seSBzY3JlZW4gYW5kIChtYXgtd2lkdGg6NzY3cHgpey5uYXYtaCwubmF2LWggdWwsLm5hdi1oIHVsIGxpLC5uYXYtaCwubmF2LWcsLm5hdi1nIHVsLC5uYXYtZyB1bCBsaSwubmF2LWcsLm5hdi12IHVsLC5uYXYtdiwubmF2LXRhYnMgdWwsLm5hdi1waWxscywubmF2LXBpbGxzIHVse2Zsb2F0Om5vbmV9Lm5hdi1oIHVsIGxpLC5uYXYtZyB1bCBsaXttYXJnaW46MDttYXJnaW4tYm90dG9tOjFweH0ubmF2LXRhYnMgdWwgbGl7ZmxvYXQ6bm9uZTttYXJnaW4tcmlnaHQ6MH0ubmF2LXRhYnMgdWwgbGkgYSwubmF2LXRhYnMgdWwgbGkgc3BhbiwubmF2LXRhYnMgdWwgbGkgLmFjdGl2ZXttYXJnaW4tdG9wOjA7Ym90dG9tOjA7cGFkZGluZzo4cHggMTJweCA5cHggMTJweDtib3JkZXI6MXB4IHNvbGlkICNkZGQ7Ym9yZGVyLWJvdHRvbTowfS5uYXYtdGFicy12e2JvcmRlci1ib3R0b206MXB4IHNvbGlkICNkZGQ7Ym9yZGVyLXJpZ2h0OjB9Lm5hdi10YWJzLXYgdWwgbGkgc3BhbnttYXJnaW4tdG9wOjA7Ym90dG9tOjA7bWFyZ2luLXJpZ2h0OjB9fUBtZWRpYSBvbmx5IHNjcmVlbiBhbmQgKG1heC13aWR0aDo3NjdweCl7LmZvcm1zLWNvbHVtbmFyIGxhYmVse2Zsb2F0Om5vbmU7dGV4dC1hbGlnbjpsZWZ0O3dpZHRoOmF1dG87bWFyZ2luLWJvdHRvbTowfS5mb3Jtcy1wdXNoIGxhYmVse3Bvc2l0aW9uOnJlbGF0aXZlfS5mb3Jtcy1wdXNoLC5mb3Jtcy1jb2x1bW5hciAuZm9ybXMtc2VjdGlvbntwYWRkaW5nLWxlZnQ6MH0uZm9ybXMtY29sdW1uYXIgLmZvcm1zLWxpc3QsLmZvcm1zLWNvbHVtbmFyIC5mb3Jtcy1pbmxpbmUtbGlzdHttYXJnaW4tbGVmdDowfX0=';

//halflings
$halflings='LyohDQogKg0KICogIFByb2plY3Q6ICBHTFlQSElDT05TIEhBTEZMSU5HUw0KICogIEF1dGhvcjogICBKYW4gS292YXJpayAtIHd3dy5nbHlwaGljb25zLmNvbQ0KICogIFR3aXR0ZXI6ICBAamFua292YXJpaw0KICoNCiAqL2h0bWwsaHRtbCAuaGFsZmxpbmdzey13ZWJraXQtZm9udC1zbW9vdGhpbmc6YW50aWFsaWFzZWQhaW1wb3J0YW50fUBmb250LWZhY2V7Zm9udC1mYW1pbHk6J0dseXBoaWNvbnMgSGFsZmxpbmdzJztzcmM6dXJsKCcuLi9mb250cy9nbHlwaGljb25zaGFsZmxpbmdzLXJlZ3VsYXIuZW90Jyk7c3JjOnVybCgnLi4vZm9udHMvZ2x5cGhpY29uc2hhbGZsaW5ncy1yZWd1bGFyLmVvdD8jaWVmaXgnKSBmb3JtYXQoJ2VtYmVkZGVkLW9wZW50eXBlJyksdXJsKCcuLi9mb250cy9nbHlwaGljb25zaGFsZmxpbmdzLXJlZ3VsYXIud29mZicpIGZvcm1hdCgnd29mZicpLHVybCgnLi4vZm9udHMvZ2x5cGhpY29uc2hhbGZsaW5ncy1yZWd1bGFyLnR0ZicpIGZvcm1hdCgndHJ1ZXR5cGUnKSx1cmwoJy4uL2ZvbnRzL2dseXBoaWNvbnNoYWxmbGluZ3MtcmVndWxhci5zdmcjZ2x5cGhpY29uc19oYWxmbGluZ3NyZWd1bGFyJykgZm9ybWF0KCdzdmcnKTtmb250LXdlaWdodDpub3JtYWw7Zm9udC1zdHlsZTpub3JtYWx9LmhhbGZsaW5nc3tmb250LWZhbWlseTonR2x5cGhpY29ucyBIYWxmbGluZ3MnO2ZvbnQtc2l6ZToxMXB4LzFlbTtmb250LXN0eWxlOm5vcm1hbDtkaXNwbGF5OmlubGluZS1ibG9jaztsaW5lLWhlaWdodDouOGVtfS5oYWxmbGluZ3MuYmlne3Bvc2l0aW9uOnJlbGF0aXZlO3RvcDoycHh9LmhhbGZsaW5ncy5nbGFzczpiZWZvcmV7Y29udGVudDoiXGUwMDEifS5oYWxmbGluZ3MubXVzaWM6YmVmb3Jle2NvbnRlbnQ6IlxlMDAyIn0uaGFsZmxpbmdzLnNlYXJjaDpiZWZvcmV7Y29udGVudDoiXGUwMDMifS5oYWxmbGluZ3MuZW52ZWxvcGU6YmVmb3Jle2NvbnRlbnQ6IlwyNzA5In0uaGFsZmxpbmdzLmhlYXJ0OmJlZm9yZXtjb250ZW50OiJcZTAwNSJ9LmhhbGZsaW5ncy5zdGFyOmJlZm9yZXtjb250ZW50OiJcZTAwNiJ9LmhhbGZsaW5ncy5zdGFyLWVtcHR5OmJlZm9yZXtjb250ZW50OiJcZTAwNyJ9LmhhbGZsaW5ncy51c2VyOmJlZm9yZXtjb250ZW50OiJcZTAwOCJ9LmhhbGZsaW5ncy5maWxtOmJlZm9yZXtjb250ZW50OiJcZTAwOSJ9LmhhbGZsaW5ncy50aC1sYXJnZTpiZWZvcmV7Y29udGVudDoiXGUwMTAifS5oYWxmbGluZ3MudGg6YmVmb3Jle2NvbnRlbnQ6IlxlMDExIn0uaGFsZmxpbmdzLnRoLWxpc3Q6YmVmb3Jle2NvbnRlbnQ6IlxlMDEyIn0uaGFsZmxpbmdzLm9rOmJlZm9yZXtjb250ZW50OiJcZTAxMyJ9LmhhbGZsaW5ncy5yZW1vdmU6YmVmb3Jle2NvbnRlbnQ6IlxlMDE0In0uaGFsZmxpbmdzLnpvb20taW46YmVmb3Jle2NvbnRlbnQ6IlxlMDE1In0uaGFsZmxpbmdzLnpvb20tb3V0OmJlZm9yZXtjb250ZW50OiJcZTAxNiJ9LmhhbGZsaW5ncy5vZmY6YmVmb3Jle2NvbnRlbnQ6IlxlMDE3In0uaGFsZmxpbmdzLnNpZ25hbDpiZWZvcmV7Y29udGVudDoiXGUwMTgifS5oYWxmbGluZ3MuY29nOmJlZm9yZXtjb250ZW50OiJcZTAxOSJ9LmhhbGZsaW5ncy50cmFzaDpiZWZvcmV7Y29udGVudDoiXGUwMjAifS5oYWxmbGluZ3MuaG9tZTpiZWZvcmV7Y29udGVudDoiXGUwMjEifS5oYWxmbGluZ3MuZmlsZTpiZWZvcmV7Y29udGVudDoiXGUwMjIifS5oYWxmbGluZ3MudGltZTpiZWZvcmV7Y29udGVudDoiXGUwMjMifS5oYWxmbGluZ3Mucm9hZDpiZWZvcmV7Y29udGVudDoiXGUwMjQifS5oYWxmbGluZ3MuZG93bmxvYWQtYWx0OmJlZm9yZXtjb250ZW50OiJcZTAyNSJ9LmhhbGZsaW5ncy5kb3dubG9hZDpiZWZvcmV7Y29udGVudDoiXGUwMjYifS5oYWxmbGluZ3MudXBsb2FkOmJlZm9yZXtjb250ZW50OiJcZTAyNyJ9LmhhbGZsaW5ncy5pbmJveDpiZWZvcmV7Y29udGVudDoiXGUwMjgifS5oYWxmbGluZ3MucGxheS1jaXJjbGU6YmVmb3Jle2NvbnRlbnQ6IlxlMDI5In0uaGFsZmxpbmdzLnJlcGVhdDpiZWZvcmV7Y29udGVudDoiXGUwMzAifS5oYWxmbGluZ3MucmVmcmVzaDpiZWZvcmV7Y29udGVudDoiXGUwMzEifS5oYWxmbGluZ3MubGlzdC1hbHQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDMyIn0uaGFsZmxpbmdzLmxvY2s6YmVmb3Jle2NvbnRlbnQ6IlxlMDMzIn0uaGFsZmxpbmdzLmZsYWc6YmVmb3Jle2NvbnRlbnQ6IlxlMDM0In0uaGFsZmxpbmdzLmhlYWRwaG9uZXM6YmVmb3Jle2NvbnRlbnQ6IlxlMDM1In0uaGFsZmxpbmdzLnZvbHVtZS1vZmY6YmVmb3Jle2NvbnRlbnQ6IlxlMDM2In0uaGFsZmxpbmdzLnZvbHVtZS1kb3duOmJlZm9yZXtjb250ZW50OiJcZTAzNyJ9LmhhbGZsaW5ncy52b2x1bWUtdXA6YmVmb3Jle2NvbnRlbnQ6IlxlMDM4In0uaGFsZmxpbmdzLnFyY29kZTpiZWZvcmV7Y29udGVudDoiXGUwMzkifS5oYWxmbGluZ3MuYmFyY29kZTpiZWZvcmV7Y29udGVudDoiXGUwNDAifS5oYWxmbGluZ3MudGFnOmJlZm9yZXtjb250ZW50OiJcZTA0MSJ9LmhhbGZsaW5ncy50YWdzOmJlZm9yZXtjb250ZW50OiJcZTA0MiJ9LmhhbGZsaW5ncy5ib29rOmJlZm9yZXtjb250ZW50OiJcZTA0MyJ9LmhhbGZsaW5ncy5ib29rbWFyazpiZWZvcmV7Y29udGVudDoiXGUwNDQifS5oYWxmbGluZ3MucHJpbnQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDQ1In0uaGFsZmxpbmdzLmNhbWVyYTpiZWZvcmV7Y29udGVudDoiXGUwNDYifS5oYWxmbGluZ3MuZm9udDpiZWZvcmV7Y29udGVudDoiXGUwNDcifS5oYWxmbGluZ3MuYm9sZDpiZWZvcmV7Y29udGVudDoiXGUwNDgifS5oYWxmbGluZ3MuaXRhbGljOmJlZm9yZXtjb250ZW50OiJcZTA0OSJ9LmhhbGZsaW5ncy50ZXh0LWhlaWdodDpiZWZvcmV7Y29udGVudDoiXGUwNTAifS5oYWxmbGluZ3MudGV4dC13aWR0aDpiZWZvcmV7Y29udGVudDoiXGUwNTEifS5oYWxmbGluZ3MuYWxpZ24tbGVmdDpiZWZvcmV7Y29udGVudDoiXGUwNTIifS5oYWxmbGluZ3MuYWxpZ24tY2VudGVyOmJlZm9yZXtjb250ZW50OiJcZTA1MyJ9LmhhbGZsaW5ncy5hbGlnbi1yaWdodDpiZWZvcmV7Y29udGVudDoiXGUwNTQifS5oYWxmbGluZ3MuYWxpZ24tanVzdGlmeTpiZWZvcmV7Y29udGVudDoiXGUwNTUifS5oYWxmbGluZ3MubGlzdDpiZWZvcmV7Y29udGVudDoiXGUwNTYifS5oYWxmbGluZ3MuaW5kZW50LWxlZnQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDU3In0uaGFsZmxpbmdzLmluZGVudC1yaWdodDpiZWZvcmV7Y29udGVudDoiXGUwNTgifS5oYWxmbGluZ3MuZmFjZXRpbWUtdmlkZW86YmVmb3Jle2NvbnRlbnQ6IlxlMDU5In0uaGFsZmxpbmdzLnBpY3R1cmU6YmVmb3Jle2NvbnRlbnQ6IlxlMDYwIn0uaGFsZmxpbmdzLnBlbmNpbDpiZWZvcmV7Y29udGVudDoiXDI3MGYifS5oYWxmbGluZ3MubWFwLW1hcmtlcjpiZWZvcmV7Y29udGVudDoiXGUwNjIifS5oYWxmbGluZ3MuYWRqdXN0OmJlZm9yZXtjb250ZW50OiJcZTA2MyJ9LmhhbGZsaW5ncy50aW50OmJlZm9yZXtjb250ZW50OiJcZTA2NCJ9LmhhbGZsaW5ncy5lZGl0OmJlZm9yZXtjb250ZW50OiJcZTA2NSJ9LmhhbGZsaW5ncy5zaGFyZTpiZWZvcmV7Y29udGVudDoiXGUwNjYifS5oYWxmbGluZ3MuY2hlY2s6YmVmb3Jle2NvbnRlbnQ6IlxlMDY3In0uaGFsZmxpbmdzLm1vdmU6YmVmb3Jle2NvbnRlbnQ6IlxlMDY4In0uaGFsZmxpbmdzLnN0ZXAtYmFja3dhcmQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDY5In0uaGFsZmxpbmdzLmZhc3QtYmFja3dhcmQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDcwIn0uaGFsZmxpbmdzLmJhY2t3YXJkOmJlZm9yZXtjb250ZW50OiJcZTA3MSJ9LmhhbGZsaW5ncy5wbGF5OmJlZm9yZXtjb250ZW50OiJcZTA3MiJ9LmhhbGZsaW5ncy5wYXVzZTpiZWZvcmV7Y29udGVudDoiXGUwNzMifS5oYWxmbGluZ3Muc3RvcDpiZWZvcmV7Y29udGVudDoiXGUwNzQifS5oYWxmbGluZ3MuZm9yd2FyZDpiZWZvcmV7Y29udGVudDoiXGUwNzUifS5oYWxmbGluZ3MuZmFzdC1mb3J3YXJkOmJlZm9yZXtjb250ZW50OiJcZTA3NiJ9LmhhbGZsaW5ncy5zdGVwLWZvcndhcmQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDc3In0uaGFsZmxpbmdzLmVqZWN0OmJlZm9yZXtjb250ZW50OiJcZTA3OCJ9LmhhbGZsaW5ncy5jaGV2cm9uLWxlZnQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDc5In0uaGFsZmxpbmdzLmNoZXZyb24tcmlnaHQ6YmVmb3Jle2NvbnRlbnQ6IlxlMDgwIn0uaGFsZmxpbmdzLnBsdXMtc2lnbjpiZWZvcmV7Y29udGVudDoiXGUwODEifS5oYWxmbGluZ3MubWludXMtc2lnbjpiZWZvcmV7Y29udGVudDoiXGUwODIifS5oYWxmbGluZ3MucmVtb3ZlLXNpZ246YmVmb3Jle2NvbnRlbnQ6IlxlMDgzIn0uaGFsZmxpbmdzLm9rLXNpZ246YmVmb3Jle2NvbnRlbnQ6IlxlMDg0In0uaGFsZmxpbmdzLnF1ZXN0aW9uLXNpZ246YmVmb3Jle2NvbnRlbnQ6IlxlMDg1In0uaGFsZmxpbmdzLmluZm8tc2lnbjpiZWZvcmV7Y29udGVudDoiXGUwODYifS5oYWxmbGluZ3Muc2NyZWVuc2hvdDpiZWZvcmV7Y29udGVudDoiXGUwODcifS5oYWxmbGluZ3MucmVtb3ZlLWNpcmNsZTpiZWZvcmV7Y29udGVudDoiXGUwODgifS5oYWxmbGluZ3Mub2stY2lyY2xlOmJlZm9yZXtjb250ZW50OiJcZTA4OSJ9LmhhbGZsaW5ncy5iYW4tY2lyY2xlOmJlZm9yZXtjb250ZW50OiJcZTA5MCJ9LmhhbGZsaW5ncy5hcnJvdy1sZWZ0OmJlZm9yZXtjb250ZW50OiJcZTA5MSJ9LmhhbGZsaW5ncy5hcnJvdy1yaWdodDpiZWZvcmV7Y29udGVudDoiXGUwOTIifS5oYWxmbGluZ3MuYXJyb3ctdXA6YmVmb3Jle2NvbnRlbnQ6IlxlMDkzIn0uaGFsZmxpbmdzLmFycm93LWRvd246YmVmb3Jle2NvbnRlbnQ6IlxlMDk0In0uaGFsZmxpbmdzLnNoYXJlLWFsdDpiZWZvcmV7Y29udGVudDoiXGUwOTUifS5oYWxmbGluZ3MucmVzaXplLWZ1bGw6YmVmb3Jle2NvbnRlbnQ6IlxlMDk2In0uaGFsZmxpbmdzLnJlc2l6ZS1zbWFsbDpiZWZvcmV7Y29udGVudDoiXGUwOTcifS5oYWxmbGluZ3MucGx1czpiZWZvcmV7Y29udGVudDoiXDAwMmIifS5oYWxmbGluZ3MubWludXM6YmVmb3Jle2NvbnRlbnQ6IlwyMjEyIn0uaGFsZmxpbmdzLmFzdGVyaXNrOmJlZm9yZXtjb250ZW50OiJcMDAyYSJ9LmhhbGZsaW5ncy5leGNsYW1hdGlvbi1zaWduOmJlZm9yZXtjb250ZW50OiJcZTEwMSJ9LmhhbGZsaW5ncy5naWZ0OmJlZm9yZXtjb250ZW50OiJcZTEwMiJ9LmhhbGZsaW5ncy5sZWFmOmJlZm9yZXtjb250ZW50OiJcZTEwMyJ9LmhhbGZsaW5ncy5maXJlOmJlZm9yZXtjb250ZW50OiJcZTEwNCJ9LmhhbGZsaW5ncy5leWUtb3BlbjpiZWZvcmV7Y29udGVudDoiXGUxMDUifS5oYWxmbGluZ3MuZXllLWNsb3NlOmJlZm9yZXtjb250ZW50OiJcZTEwNiJ9LmhhbGZsaW5ncy53YXJuaW5nLXNpZ246YmVmb3Jle2NvbnRlbnQ6IlxlMTA3In0uaGFsZmxpbmdzLnBsYW5lOmJlZm9yZXtjb250ZW50OiJcZTEwOCJ9LmhhbGZsaW5ncy5jYWxlbmRhcjpiZWZvcmV7Y29udGVudDoiXGUxMDkifS5oYWxmbGluZ3MucmFuZG9tOmJlZm9yZXtjb250ZW50OiJcZTExMCJ9LmhhbGZsaW5ncy5jb21tZW50czpiZWZvcmV7Y29udGVudDoiXGUxMTEifS5oYWxmbGluZ3MubWFnbmV0OmJlZm9yZXtjb250ZW50OiJcZTExMyJ9LmhhbGZsaW5ncy5jaGV2cm9uLXVwOmJlZm9yZXtjb250ZW50OiJcZTExMyJ9LmhhbGZsaW5ncy5jaGV2cm9uLWRvd246YmVmb3Jle2NvbnRlbnQ6IlxlMTE0In0uaGFsZmxpbmdzLnJldHdlZXQ6YmVmb3Jle2NvbnRlbnQ6IlxlMTE1In0uaGFsZmxpbmdzLnNob3BwaW5nLWNhcnQ6YmVmb3Jle2NvbnRlbnQ6IlxlMTE2In0uaGFsZmxpbmdzLmZvbGRlci1jbG9zZTpiZWZvcmV7Y29udGVudDoiXGUxMTcifS5oYWxmbGluZ3MuZm9sZGVyLW9wZW46YmVmb3Jle2NvbnRlbnQ6IlxlMTE4In0uaGFsZmxpbmdzLnJlc2l6ZS12ZXJ0aWNhbDpiZWZvcmV7Y29udGVudDoiXGUxMTkifS5oYWxmbGluZ3MucmVzaXplLWhvcml6b250YWw6YmVmb3Jle2NvbnRlbnQ6IlxlMTIwIn0uaGFsZmxpbmdzLmhkZDpiZWZvcmV7Y29udGVudDoiXGUxMjEifS5oYWxmbGluZ3MuYnVsbGhvcm46YmVmb3Jle2NvbnRlbnQ6IlxlMTIyIn0uaGFsZmxpbmdzLmJlbGw6YmVmb3Jle2NvbnRlbnQ6IlxlMTIzIn0uaGFsZmxpbmdzLmNlcnRpZmljYXRlOmJlZm9yZXtjb250ZW50OiJcZTEyNCJ9LmhhbGZsaW5ncy50aHVtYnMtdXA6YmVmb3Jle2NvbnRlbnQ6IlxlMTI1In0uaGFsZmxpbmdzLnRodW1icy1kb3duOmJlZm9yZXtjb250ZW50OiJcZTEyNiJ9LmhhbGZsaW5ncy5oYW5kLXJpZ2h0OmJlZm9yZXtjb250ZW50OiJcZTEyNyJ9LmhhbGZsaW5ncy5oYW5kLWxlZnQ6YmVmb3Jle2NvbnRlbnQ6IlxlMTI4In0uaGFsZmxpbmdzLmhhbmQtdG9wOmJlZm9yZXtjb250ZW50OiJcZTEyOSJ9LmhhbGZsaW5ncy5oYW5kLWRvd246YmVmb3Jle2NvbnRlbnQ6IlxlMTMwIn0uaGFsZmxpbmdzLmNpcmNsZS1hcnJvdy1yaWdodDpiZWZvcmV7Y29udGVudDoiXGUxMzEifS5oYWxmbGluZ3MuY2lyY2xlLWFycm93LWxlZnQ6YmVmb3Jle2NvbnRlbnQ6IlxlMTMyIn0uaGFsZmxpbmdzLmNpcmNsZS1hcnJvdy10b3A6YmVmb3Jle2NvbnRlbnQ6IlxlMTMzIn0uaGFsZmxpbmdzLmNpcmNsZS1hcnJvdy1kb3duOmJlZm9yZXtjb250ZW50OiJcZTEzNCJ9LmhhbGZsaW5ncy5nbG9iZTpiZWZvcmV7Y29udGVudDoiXGUxMzUifS5oYWxmbGluZ3Mud3JlbmNoOmJlZm9yZXtjb250ZW50OiJcZTEzNiJ9LmhhbGZsaW5ncy50YXNrczpiZWZvcmV7Y29udGVudDoiXGUxMzcifS5oYWxmbGluZ3MuZmlsdGVyOmJlZm9yZXtjb250ZW50OiJcZTEzOCJ9LmhhbGZsaW5ncy5icmllZmNhc2U6YmVmb3Jle2NvbnRlbnQ6IlxlMTM5In0uaGFsZmxpbmdzLmZ1bGxzY3JlZW46YmVmb3Jle2NvbnRlbnQ6IlxlMTQwIn0uaGFsZmxpbmdzLmRhc2hib2FyZDpiZWZvcmV7Y29udGVudDoiXGUxNDEifS5oYWxmbGluZ3MucGFwZXJjbGlwOmJlZm9yZXtjb250ZW50OiJcZTE0MiJ9LmhhbGZsaW5ncy5oZWFydC1lbXB0eTpiZWZvcmV7Y29udGVudDoiXGUxNDMifS5oYWxmbGluZ3MubGluazpiZWZvcmV7Y29udGVudDoiXGUxNDQifS5oYWxmbGluZ3MucGhvbmU6YmVmb3Jle2NvbnRlbnQ6IlxlMTQ1In0uaGFsZmxpbmdzLnB1c2hwaW46YmVmb3Jle2NvbnRlbnQ6IlxlMTQ2In0uaGFsZmxpbmdzLmV1cm86YmVmb3Jle2NvbnRlbnQ6IlwyMGFjIn0uaGFsZmxpbmdzLnVzZDpiZWZvcmV7Y29udGVudDoiXGUxNDgifS5oYWxmbGluZ3MuZ2JwOmJlZm9yZXtjb250ZW50OiJcZTE0OSJ9LmhhbGZsaW5ncy5zb3J0OmJlZm9yZXtjb250ZW50OiJcZTE1MCJ9LmhhbGZsaW5ncy5zb3J0LWJ5LWFscGhhYmV0OmJlZm9yZXtjb250ZW50OiJcZTE1MSJ9LmhhbGZsaW5ncy5zb3J0LWJ5LWFscGhhYmV0LWFsdDpiZWZvcmV7Y29udGVudDoiXGUxNTIifS5oYWxmbGluZ3Muc29ydC1ieS1vcmRlcjpiZWZvcmV7Y29udGVudDoiXGUxNTMifS5oYWxmbGluZ3Muc29ydC1ieS1vcmRlci1hbHQ6YmVmb3Jle2NvbnRlbnQ6IlxlMTU0In0uaGFsZmxpbmdzLnNvcnQtYnktYXR0cmlidXRlczpiZWZvcmV7Y29udGVudDoiXGUxNTUifS5oYWxmbGluZ3Muc29ydC1ieS1hdHRyaWJ1dGVzLWFsdDpiZWZvcmV7Y29udGVudDoiXGUxNTYifS5oYWxmbGluZ3MudW5jaGVja2VkOmJlZm9yZXtjb250ZW50OiJcZTE1NyJ9LmhhbGZsaW5ncy5leHBhbmQ6YmVmb3Jle2NvbnRlbnQ6IlxlMTU4In0uaGFsZmxpbmdzLmNvbGxhcHNlOmJlZm9yZXtjb250ZW50OiJcZTE1OSJ9LmhhbGZsaW5ncy5jb2xsYXBzZS10b3A6YmVmb3Jle2NvbnRlbnQ6IlxlMTYwIn0=';	

	$css = base64_decode($css);
	foreach($cVals as $k=>$v) {
		$css_copy=$css;
		for($i=0;$i<count($cNames);$i++) $css_copy=str_replace($cNames[$i],'#'.$v[$i],$css_copy);
		if($h=@fopen('css/style_'.$k.'.css','w')) {fputs($h,$css_copy);fclose($h);}
	}
	if(!file_exists('css/main.css')) {
		if($h=@fopen('css/main.css','w')) { fputs($h,base64_decode($main_style));fclose($h); }
	}	
	if(!file_exists('css/halflings.css')) {
		if($h=@fopen('css/halflings.css','w')) { fputs($h,base64_decode($halflings));fclose($h); }
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
									
					'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAEJGlDQ1BJQ0MgUHJvZmlsZQAAOBGFVd9v21QUPolvUqQWPyBYR4eKxa9VU1u5GxqtxgZJk6XtShal6dgqJOQ6N4mpGwfb6baqT3uBNwb8AUDZAw9IPCENBmJ72fbAtElThyqqSUh76MQPISbtBVXhu3ZiJ1PEXPX6yznfOec7517bRD1fabWaGVWIlquunc8klZOnFpSeTYrSs9RLA9Sr6U4tkcvNEi7BFffO6+EdigjL7ZHu/k72I796i9zRiSJPwG4VHX0Z+AxRzNRrtksUvwf7+Gm3BtzzHPDTNgQCqwKXfZwSeNHHJz1OIT8JjtAq6xWtCLwGPLzYZi+3YV8DGMiT4VVuG7oiZpGzrZJhcs/hL49xtzH/Dy6bdfTsXYNY+5yluWO4D4neK/ZUvok/17X0HPBLsF+vuUlhfwX4j/rSfAJ4H1H0qZJ9dN7nR19frRTeBt4Fe9FwpwtN+2p1MXscGLHR9SXrmMgjONd1ZxKzpBeA71b4tNhj6JGoyFNp4GHgwUp9qplfmnFW5oTdy7NamcwCI49kv6fN5IAHgD+0rbyoBc3SOjczohbyS1drbq6pQdqumllRC/0ymTtej8gpbbuVwpQfyw66dqEZyxZKxtHpJn+tZnpnEdrYBbueF9qQn93S7HQGGHnYP7w6L+YGHNtd1FJitqPAR+hERCNOFi1i1alKO6RQnjKUxL1GNjwlMsiEhcPLYTEiT9ISbN15OY/jx4SMshe9LaJRpTvHr3C/ybFYP1PZAfwfYrPsMBtnE6SwN9ib7AhLwTrBDgUKcm06FSrTfSj187xPdVQWOk5Q8vxAfSiIUc7Z7xr6zY/+hpqwSyv0I0/QMTRb7RMgBxNodTfSPqdraz/sDjzKBrv4zu2+a2t0/HHzjd2Lbcc2sG7GtsL42K+xLfxtUgI7YHqKlqHK8HbCCXgjHT1cAdMlDetv4FnQ2lLasaOl6vmB0CMmwT/IPszSueHQqv6i/qluqF+oF9TfO2qEGTumJH0qfSv9KH0nfS/9TIp0Wboi/SRdlb6RLgU5u++9nyXYe69fYRPdil1o1WufNSdTTsp75BfllPy8/LI8G7AUuV8ek6fkvfDsCfbNDP0dvRh0CrNqTbV7LfEEGDQPJQadBtfGVMWEq3QWWdufk6ZSNsjG2PQjp3ZcnOWWing6noonSInvi0/Ex+IzAreevPhe+CawpgP1/pMTMDo64G0sTCXIM+KdOnFWRfQKdJvQzV1+Bt8OokmrdtY2yhVX2a+qrykJfMq4Ml3VR4cVzTQVz+UoNne4vcKLoyS+gyKO6EHe+75Fdt0Mbe5bRIf/wjvrVmhbqBN97RD1vxrahvBOfOYzoosH9bq94uejSOQGkVM6sN/7HelL4t10t9F4gPdVzydEOx83Gv+uNxo7XyL/FtFl8z9ZAHF4bBsrEwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAfNJREFUOBGFk0FPE1EQx//v7SsUWUJtt5VETJBoVS4QvgEe9ODBeDB4rAe/lEZOfgQTvPUgBw8QygWxRjDiqUvpKhCM7L7nzOvbdU1Xfcnumzc785vZmXnCGIO/ref+FQOBSBiz8uy01ymyk0XKVCdIeHj3QaU0Pt5+4TeWUn1+/yeADYPLAWZv3qhoKQoh/wUwZCKoodacL4SotXLdGMHJArYaMpXp5PSDvS7UbAPVW/OV4w/7nElWE/FqZs7ce7SKr1MSsU6gkwQnXw4Rn/+w0IWpGWy/20AYDRAsLSA+PUO/ux9JPSysBTy5/xib/QP0z75ZQL/7CRffzykj1yHKhCWpvAxyTBBBkN81ICPpeZS1RKlcttEF9dAuajVLJk5w1NmF8idRbV6v0K+3M4AggJASwpMYm7wE6GH0PIRhDGKnMd/no5WtwM6gRypFVa9ClrwRiCR4sHjH2oedXTtgyiWJ5elrwLT9NnzNLWeH9fZr9KiIdSoirx456zi2nRBrKqA2kjb7GddO18LWagtv3q5DX63btoY776PEOTNMPb0I0yT4/Md6OdGwhajdbiI8GSDskHMyjJwa5uKmqtzuLhrPxNHO3ogzW6qc+YjIqX3uHeLj5lYUa51NX96QbqoblrzWyTzmNEGRNGKl9bP4Ov8CNpTSfDBp7kcAAAAASUVORK5CYII=',// Arrow

					'R0lGODlhDgAKAJEAAGmGlqq2vuns7v///yH5BAAAAAAALAAAAAAOAAoAAAIkhI8Jw+03gJh0SjOErNouW23aJwQbEFBY6U3pyHLu+MqughsFADs=',
					
					'R0lGODlhDgAMAKIEAKOxusLK0FF3i////93d3QAAAAAAAAAAACH5BAEAAAQALAAAAAAOAAwAAAMpCLqsRCDIScGLIuudMf2BgDWNGA5oqpqC6g7su2JyKgJtDT95LfCcYAIAOw==',
					
					'R0lGODlhDgAMAKIAAP39/bKztMXGx9bW1mRlaIWGiebm5p+foSH5BAAAAAAALAAAAAAOAAwAAANECLorV4apo9w4RIZgbCTDEgjXGAADqIzpSJBvuA2FKwQxYBTXIbw4koI2+AFzil3IMAiGGAUI4CeUADAE3tOqGwwi1gQAOw==',
					
					'iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAIAAAD/gAIDAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAIGNIUk0AAG11AABzoAAA/N0AAINkAABw6AAA7GgAADA+AAAQkOTsmeoAAAmDSURBVHja7J1pcFPXFcf/9z1JT/tiyfKChReBHQfj2thshcZtzFocCNCBEpLMFNIO7WSGD6HTUpqlS/qlUzKTSbcPkDLpMAlTkgxLCQ0mjMFmTWy8xAZsvCAvsi0LyZZsLe+9flAhaTuTIdLTleTR+SbrvSO93zv36Jx7//eZvIA/IW2PZkwaQRpWGlYaVgqZLBm+BAEAwkMIIixCePBHRg5WBhaACDENCwyYEMJuTE5jhoPMCI1cwUbe4oOCG1N+BJXgjNApIRchJpaaLLGYHBhTQfZ4+ZzyjYVFldm2cotaz0UOCEyHBjtcvS3OttP97U0DTsxkIUMJhfAg9BIwAhJSZ7FgnZjgEXpi8+PrXlxU9mThVx/ffW3wX28117/TGoSYC7OYoIFJGxYBAdCH4aK51t1/XL24rvjRz+26fO/wjz/+9GZvPrLlYAXqvNhF2ECTlACxF8NPrC39zYVn8xdav9bpFpth9Z7KyV7f1Zu3NFBHcv9shtWHkbWbyvef2i7jorzUJZtLRDffeLVTDw0T+SGdfbBYMAMYXby48OX6Z2J0VbHe7m7zXO+8kwEDzeTFUIspN6aMctXPz2yTxOHe40/Pz81yYoJmcNGr4CfgeeHgKq1ZJZXDnxzeEEAgTLGSYOiElQvehTZb7YuVErotW1vwrW+WjmCC0AouSpE1Cd+6fVWSu123vwrgqaUtGrD8COTKjEt3lEjuubLObs/MnoQfVIKLAiwyCf+86hxDpiYeA7y0Ns8LH5kdkUWAEEL5i61x8p9fZaXWYNMYhmHwlgJdnJxn2g1KyPnZAUuAKAcrYcXwP8Zp5AwIZktkiSyYqJubR7gbIrUSnkLOYoII++8H4nUrRMyeOisyQibuTcarMXBMBhBkqCRfGp+hgGyw3RUn547W8RAEZnbUWSJENVQ9jSM8H5cm7vaFYQ1U4uwYhgB0UPW6xtrO9knueejW+O32QT00s+bXECwYETj/5k3JPZ872OLGtILWsgsNWAJEK0wNZzsGWp0SuvWO+c4cas6EcVY10gAUkIeBv+w8I6HPw7s+dvFTOqhAyyjBEiDkwHK1vef9X16SxOHFQ+3/PPWZDVae4uQfvTl4AqKGsuFie9E8q608pr66s37g1997Vw+dGhzN5TCqqzsc5CLI+Q9acmzGwkXZ0TlpOdXzyvqjLBRm6CkvHVKFJUJUQymCnDvREvKGKlYVEebrFZPHX7/0xg9PKKC0wMhTX8enCivCSwlOBa7pSlfzP3qMueq80sxHObH13N03nz958siNDBiN0PKJUDwkRutAQAiIExNBBCurClc8V1pZV5RjN///keODnrYzfRePdNy4dFcAcmBhACFBWhqSQAEuAyYM3gVPEEEz0eWVmvMWmrUZysi7M5NBR5vL0eUaDXhZyCwwyCFLoIQmwbAeRhmAGQT9CMwgEAb/sO5XglODU4IjyaFnS7zyL0KBg1wJBaAT/3tuBxABMSl0f0kik/wytS+9TDpLC3DTsNKw0rBSyZIhwRPyxeTEF2vLBOThzLqYHBlflkBAAsQAQj5MhxDmwfPg5ZDJwIgQyYM9BCxYFowMMi1UHBQRfImquWjDIiAixEn4PZhkwZihfawiO9NmmLMgw2TTagycQi0XeJFhSHAm7PcE3INTw53usX6Po9nlFMZDEPTQRNSk9JHRg8WACSI8Do+IcL41s6aupKw2v3jpnCy76VFOH+u7f+f60Of1A+2nB3ocTgEkE0YOcpoNEI12J7KZYhguOZjqmqJv71q4eEuxSstF5y0UDF//4HbD2+3Xznb7EMyBhRqy+MKK9H0jmOARWln32MafLVuwMl8q57evOk4cvHrpWFcIYi7MDEi8ZyPiCIsF40NgBOPl5bZnfltT9VRxPD6l40L/0QMXrjX1WGAyQMM/6MPjckVxmvxjwQ7DHcD0cy/XvHRsa26JOU4XYC0w1u6uMGpUN8/1uDBlgCaVYBEQBkwfhnOsugMfbqvdXUEhm5SsyFu2pfh2w72uMYcBujhJHySGFakM7mKoemnh6w3P28ozQcsMWZrVuyqcbROf3erWQcPGoTmRElZkBqoPw6ueKnutfienldPu3WTMyh0L/APTjS2d+jjwkhYW0wPHqrVl+09vT2BTUr2pOHBv5lJzpwFaaXVbksFiwfZjpLqq6LWGZxPexFVtmn+/c/JKxy0z9BJWE4xUpEbgsllMr57fkSQzBHvf27Rs0bwBjLLSbUtkpBh9ZArTYQQPnN6m1HNIGvvFR9syONU4PFINRmm8DGH0R79aU7AkG8lk2kz1vnc3ezEZRDgpYDFghuGqLrZvfGU5ks8qn55Xt7HKIdFgjBVWECGA3/POeiSr/eDQKgur8cIXuwKciT2snly3sGhJTtLC0lk0W/ctd0qxLTEmWAGEVJBt/f0KJLdtOLBkrtLshT9hsBgQJ9zLv1Myt8ya5LBUOm7NnopxuJlYR1K0xkMUwa95qRKpYLV7KzKgnUEwIbCIB1Ol2bnf+G5RSsCyFhgX1RS64Iklc0UJi4B44Vu01U4IQYpY9ffnhxCKZZkjSlgCBAXYsvX5SB0rW51vhjaWAjVKWNMIZCuMxSvnpBCsLLupoMQay+7z6GARP2byys0agwopZQXLsgIIEsqRNYPgnHIzUs1s5eZYlLvRwRJZIGueMeVgZc03KWJ48FY0sESABWvK06QcLEO2RgMuHO1yWXSwRBaM3pp6sNQGhQIyniasCDGZPPW0XZxWIZezIs1h+B9agphysLQmJaeWR71mHX0Fz8hSL7L8nkDQF2ZpwiIgIfDeMX/KwZoYmvKGp2XRCq2ihiV0feJIOVj9nzo98CtowgKgh+bG8e6kVPZ/lV1+u0sBBe2i1ABN1+jQJ39uTSFS3U2DjZdvWWJ4AGX0SdoE/d9+Wj8dt4fMSG5/3f0RC1YegzI0SlgixAzoRn1Tv9vwXkqQemvnyZtdAzkwC9R7QwDgIdhgvd7U+2rN3z0jU0mLKTQdPrj9/RNHb9iQFWOKjUkYQkAM0H7ef+/KkU6VUWGvygaSa+K08VjHH7Z8eKWxey6yWDAxqsEl0JSyYFzw+uAvLc6r3mi3L8sxJLpt9Lln7jQNNZ/p6Wh1yCC3wiTJcwGlEeBGlMJuTPngV0LOJnpLEA9xBiE1OBP0LBiphN/SbBqIzBBlQGeCVkj0P0/Ag30/Ec2mhBJ5KXdYRBgxIEmSuSS/Z+ktdGlYaVhpWGlYaVhpS8NKw0rDSrj9ewDcqE643RniEAAAAABJRU5ErkJggg==');// Avatar
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
/**
*
* FORMULAIRE D'INSCRIPTION
*/
function registerForm() {
	global $maxAvatarSize,$forum,$forumMode;$lang;

	$form ='';
	$r = $forum->getStat();
	if($r[0]) {
		if(!$forumMode) $form .= '<!-- Inscription -->';
		$form .= '<a class="btn" href="javascript:switchLayer(\'register\');" title="">'.SIGN_UP.'</a>';
		$form .= '<div class="toggle" id="register">';
	} else {
		$form .= '<div class="gradient">'.SIGN_UP.'</div>';
	}
	$form .= '<h4 class="forms-section">'.JOIN_COMMUNITY.'</h4>
	<form action="index.php" method="post" enctype="multipart/form-data" autocomplete="off" class="form forms forms-columnar">';
	$form .= '<input type="hidden" name="action" value="newuser" />
              <input type="hidden" name="MAX_FILE_SIZE" value="'.$maxAvatarSize.'" />' .
     //input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     input(USER_LOGIN, 'login', '', 'text', '', '20', '', 'width-30', 'user', 'success').
     input(PASSWORD, 'password', '', 'password', '', '50', '', 'width-30', 'lock', 'success'). 
     input(BIRTHDAY, 'birthday', '', 'date', 'Jour/Mois/Année', '10', '', 'width-20', 'calendar', 'success').
     input(EMAIL, 'email', '', 'email', '', '50', '', 'width-30', 'envelope', 'success').
     input(WEBSITE, 'site', '', 'url', 'http://', '255', '', 'width-30', 'globe').
     textarea(SIGNATURE, 'signature', '', '10', '2', SIGNATURE_MSG, '150', '', 'width-70'). '
	<p>
		<label for="avatar">'.AVATAR.' <span class="label label-red">&lt; '.($maxAvatarSize/1024).'ko</span></label>
        <input type="file" id="avatar" name="avatar">
	</p>
    
	<p>
		<button type="submit" class="btn btn-big btn-green"><i class="halflings hand-right"></i> '.SIGN_UP.'</button>
	</p>  
	
  <div class="message message-info"><i class="halflings exclamation-sign"></i> '.MENDATORY_FIELDS.' 
  '.CHAR_NOT_ALLOWED.'
  <pre>/ \ &amp; " \' . ! ? :</pre> '.CHAR_NOT_ALLOWED_BIS.'
  </div>  
     
</form>';
	if($r[0]) $form .= '</div>';
	
	return $form;
}
/**
*
* TEXTE D'ACCUEIL
*/
function welcomeText() {
	global $wt,$ismember,$lang;
	$buf='<!-- Welcome text -->';
	$buf.='<h4 class="forms-section">'.INFORMATION.'</h4>
          <div class="lead">';
	if(!$wtp=@file_get_contents('welcome.txt')) {
		$buf.= WELCOME_TXT;
	} else {
		$buf .= decode($wtp).'</div>';
	}
	return $buf;
}
/**
*
* ÉDITION DU PROFIL
*/
function editProfilForm() {
	global $cLogin,$maxAvatarSize,$forum;
	list($pwd,$time,$email,$signature,$site,$birthday,$pic,$mod,$post)=$forum->getMember($cLogin);
	$avatar=($pic!='')?'<figure><img src="'.$pic.'" alt="'.AVATAR.'" width="80px" /></figure>':'<figure>'.img(11,'img-polaroid').'</figure>';	
	
	$form = '<!-- Edit profil form -->';
	$form .= '<h4 class="forms-section">'.EDIT_PROFIL.' ~ '.$cLogin.'</h4>';
	$form .= '<div class="units-container">
  	
     <ul class="blocks-2">
     
       <li>'.$avatar.'</li> 
       
       <li>'.listFiles().'</li>
                 
     </ul> 
  <hr />
  
  <div class="units-row well">  
  <form action="index.php" method="post" enctype="multipart/form-data" class=" forms forms-columnar">
  <input type="hidden" name="action" value="editprofil" />
  <input type="hidden" name="MAX_FILE_SIZE" value=".$maxAvatarSize." /> 

  ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     input(BIRTHDAY, 'birthday', $birthday, 'date', 'Jour/Mois/Année', '10', '', 'width-20', 'calendar').
     input(EMAIL, 'email', $email, 'email', '', '50', '', 'width-30', 'envelope').
     input(WEBSITE, 'site', $site, 'url', 'http://', '255', '', 'width-30', 'globe').
     textarea(SIGNATURE, 'signature', $signature, '10', '2', SIGNATURE_MSG, '150', '', 'width-70'). '

	<p>
		<label for="avatar">'.AVATAR.' <span class="label label-red">&lt; '.($maxAvatarSize/1024).'ko</span></label>
        <input type="file" id="avatar" name="avatar">
	</p>
    
	<p>
		<button type="submit" class="btn btn-green"><i class="halflings hand-right"></i> '.SAVE_PROFIL.'</button>
	</p>
	
	</form>
           </div><!-- well -->';
	
	return $form;
}
/**
*
* AIDE FORMATAGE BBCODE (Éditeur)
*/
function formattingHelp() {
	$buff = '<p class="forms-inline"><label>Smileys</label><ul class="forms-inline-list">'; // smileys
	$s=array(':)',';)',':D',':|',':(','8(',':p',':$','->'); // smileys
	for($i=0;$i<sizeof($s);$i++) { $buff .= "<li><a class='bImage' href=\"javascript:insert(' ".$s[$i]." ','');\" title='smileys'>".img($i)."</a></li>"; }
	$buff .= '</ul></p>';
	$buff .= '<p><label style="margin-right:50px">'.FORMATING.'</label><ul class="forms-inline-list btn-group">           
       <li><a class="btn" href="javascript:insert(\'[b]\',\'[/b]\')" title="'.BOLD.'"><i class="halflings bold"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[i]\',\'[/i]\')" title="'.ITALIC.'"><i class="halflings italic"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[u]\',\'[/u]\')" title="'.UNDERLINE.'"><i class="halflings text-width"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[s]\',\'[/s]\')" title="'.STROKE_THROUGH.'"><i class="halflings text-height"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[quote]\',\'[/quote]\')" title="'.QUOTE.'"><i class="halflings comments"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[c]\',\'[/c]\')" title="'.CODE.'"><i class="halflings barcode"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[url]\',\'[/url]\')" title="'.LINK.'"><i class="halflings share"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[img]\',\'[/img]\')" title="'.PICTURE.'"><i class="halflings picture"></i></a></li>
       <li><a class="btn" href="javascript:insert(\'[youtube]\',\'[/youtube]\')" title="'.VIDEO.'"><i class="halflings film"></i></a></li>
    </ul><!-- /btn-group --> ';
	$buff .= '</p>';
	return $buff;
}
/**
*
* AFFICHAGE FIL D'ARIANE (Breadcrumbs)
*/
function breadcrumbs() {
	global $cLogin,$isadmin,$havemp,$cStyle,$cVals,$forum,$nbrMsgIndex,$ismember,$siteUrl,$siteName,$lang;
	$mn='';	
	$tLogin=$ismember?$cLogin:GUESTS;
	$mn .= '<nav class="breadcrumbs">
	         <div class="image-right">';	
	foreach($cVals as $k=>$v) $mn .= "<span onclick='window.location=\"?style=$k\"' title='$k' style='display: inline-block; border-radius: 3px; width: 16px; height: 16px; line-height: 18px; background-color: #".$v[1]."; cursor: pointer;'>&nbsp;&nbsp;</span> ";	
	$mn .= 	'</div>
	
	<ul><li><i class="halflings play-circle"></i> '.WELCOME.' <span class="';	
	$mn .= ($isadmin)?'color-red':'color-blue';
	$mn .= '"><strong>'.$tLogin.'</strong></span></li>';
    $mn .= 	'<li><a href="index.php"><i class="halflings home"></i> '.HOME.'</a></li>';
    	
	if($havemp) $mn .= '<li><a href="'.$_SERVER['REQUEST_URI'].'#private" id="mpmess" onclick=\'clearTimeout(tm);this.style.visibility="hidden";javascript:switchLayer("privatebox");\' title="'.NEW_PRIVATE_MSG.'"><i class="halflings inbox"></i> '.PRIVATE_MSG.'</a></li><script>blnk("mpmess",1);</script>';
	
	$mn .= '</ul>
	</nav>';
	return $mn;
}
/**
*
* AFFICHAGE DU MENU
*/
function menu() {
	global $cLogin,$havemp,$cStyle,$cVals,$forum,$nbrMsgIndex,$ismember,$siteUrl,$siteName,$lang;
	$mn=''; 	 
	if($siteUrl!='') $mn .='<li><a href="'.$siteUrl.'" title="'.$siteName.'"><i class="halflings home"></i> '.$siteName.'</a></li>';
	$stats=$forum->getStat();
	if($nbrMsgIndex<$stats[2]) $mn .='<li><a href="?showall=1" title="'.LIST_OF_ALL_TOPICS.'"><i class="halflings bookmark"></i> '.ARCHIVES.'</a></li>';			
	if($ismember) {
		$mn .='<li><a href="?logout=1" title="'.QUIT.'"><i class="halflings off"></i> '.LOGOUT.'</a></li>';
		$mn .='<li><a href="?editprofil=1" title="'.EDIT_MY_PROFIL.'"><i class="halflings eye-open"></i> '.PROFIL.'</a></li>';
		$mn .='<li><a href="?memberlist=1" title="'.LIST_OF_MEMBERS.'"><i class="halflings user"></i> '.MEMBERS.'</a></li>';
	} else {
		$mn .='
		    <form action="index.php" method="post" autocomplete="off" class="text-right">
		        <input type="hidden" name="action" value="enter" />
                <input class="width-33" type="text" name="login" placeholder="'.USER.'">
                <input class="width-33" type="password" name="password" placeholder="'.PASSWORD.'">
                <button type="submit" class="btn btn-blue"><i class="halflings ok"></i> '.CONNECT.'</button>
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
		$mn .= '<li><a href="?conf=1" title="'.GENERAL_PARAM.'"><i class="halflings wrench"></i> '.CONFIG.'</a></li>';
		$mn .= '<li><a href="?backup=1" title="'.SAVE_BACKUP.'"><i class="halflings hdd"></i> '.SAVE.'</a></li>';
		$mn .= '<li><a href="?restore=1" title="'.RESTORE_FROM_BACKUP.'"><i class="halflings refresh"></i> '.RESTORE.'</a></li>';
	}
	return $mn;
}
/**
*
* AFFICHAGE DE LA LISTE DES SUJETS (Forumhome)
*/
function showTopics() {
	global $isadmin,$nbrMsgIndex,$forum,$showall;

	$buffer = '';
	$buffer .= '<table class="width-100 table-bordered table-striped">
	             <tr class="info">
	                 <td style="width:60%;">'.TITLE_SUBJECT.'</td>
	                 <td style="width:5%; text-align:center;">'.MESSAGES.'</td>
	                 <td style="width:30%;">'.LAST_MSG.'</td>';
	    if($isadmin) $buffer .= '<td style="width:5%">'.ADMIN.'</td>';
	$buffer .= '</tr>';

	$topicList=($showall)?$forum->getallTopic(0,$nbrMsgIndex):$forum->getallTopic($nbrMsgIndex);
	foreach($topicList as $t) {
		list($titre,$auteur,$nombrePosts,$dernierPar,$dernierLe,$attachment,$postType,$topicID)=$t;
		$dernierLe = date('d M Y à H:i',$dernierLe);
		$started = date('d M Y', $topicID);
		$attachment=($attachment!='')?'<i class="halflings file"></i> ':'';
		$postType=$postType?'<i class="halflings star"></i> ':'';
		$statusIcon = (isset($_COOKIE["uFread$topicID"]))?'<i class="halflings folder-open"></i>':'<i class="halflings fire"></i>';
		$buffer .= '<tr>';
		$buffer .= '<td>'.$postType.$attachment.$statusIcon.' <a href="?topic='.$topicID.'" title="'.DISPLAY_TOPIC.'"">'.stripslashes($titre).'</a><br /><span class="image-right">'.STARTED_ON.' '.$started.', '.BY.' ';
		$buffer .= $forum->isMember($auteur)?'<a class="Lien" href="index.php?private='.$auteur.'" title="'.SEND_PRIVATE_MSG.'">'.$auteur.'</a></span></td>':$auteur.'</span></td>';
		$buffer .= '<td class="mess">'.$nombrePosts.'</td>';
		$buffer .= '<td><i>'.L_ON.' :</i> <a href="?topic='.$topicID.'#bottom" class="Lien" title="'.GOTO_LAST_MSG.'">'.$dernierLe.'</a><br /><i>'.BY.':</i> ';
		$buffer .= $forum->isMember($dernierPar)?'<a class="Lien" href="index.php?private='.$dernierPar.'" title="'.SEND_PRIVATE_MSG.'">'.$dernierPar.'</a></td>':$dernierPar.'</td>';
		if($isadmin) $buffer .= "<td><a href='?topic=".$topicID."&amp;delpost=".$topicID."' onclick='return confirmLink(this,\"$titre\")' rel='tooltip' title='".DEL_MSG."'><i class='halflings trash'></i></a></td>\n";
		$buffer .= '</tr>';
	}
	$buffer .= '</table>';
	$buffer .= replyForm('newtopic',count($topicList));	
	return $buffer;
}
/**
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
		$buffer .= '<div class="gradient">';
		if($isadmin) {
			$buffer .= '<form name="sub" method="post" class="forms-inline"><input type="hidden" name="topicID" value="'.$topic.'" />';
			$buffer .= img(10)." <input style='border:none;' type='checkbox' onclick=\"window.location='?topic=".$topic."&postit=".($type?"off":"on")."'\"";/*** On epingle le sujet ou pas ***/
			$buffer .= $type?"checked='checked' /> ":"/> ";
			$buffer .= "<span class='btn-group'><input type='text' value=\"".stripslashes($titre)."\" size='40' name='ntitle' /><button class='btn'>".EDIT."</button></span></form>";/*** Modification du Titre du sujet ***/
		} else $buffer .= stripslashes($titre);
		$buffer .= '</div>';
		// tooltips
		list($num,$auths)=$topicObj->getInfo(1);
		foreach($auths as $m) {
			if($forum->isMember($m)) {
				list($password,$time,$mail,$quote,$url,$birthday,$pic,$mod,$max)=$forum->getMember($m);
				$buffer .= '<div class="tooltip" id="'.cleanUser($m).'">';
				$buffer .= '<table style="width: 100%">';
				$buffer .= '<tr><th class="formTD">'.PROFIL_OF.' <b>'.$m.'</b></th></tr>';
				$buffer .= '<tr><td class="formTD">'.REGISTRED_ON.'</td><td class="tooltipTD">'.date('d M Y à H:i',$time).'</td></tr>';
				$buffer .= '<tr><td class="formTD">'.EMAIL.'</td><td class="tooltipTD">'.protect_email($mail).'</td></tr>';
				if(!empty($url)) $buffer .= '<tr><td class="formTD">'.WEBSITE.'</td><td class="tooltipTD">'.$url.'</td></tr>';
				if(!empty($birthday)) $buffer .= '<tr><td class="formTD">'.BORN_ON.'</td><td class="tooltipTD">'.$birthday.' <span class="badge">'.birthday($birthday, $pattern = 'eu').' '.YEARS_OLD.'</span></td></tr>';
				if(!empty($quote)) {
					$buffer .= '<tr><td class="formTD">'.SIGNATURE.'</td><td class="tooltipTD">'.$quote.'</td></tr>';
					if($quoteMode) $quotes[$m]=$quote;
				}
				$buffer .= '</table></div>';
				if($mod) $modo[$m]=($mod>1)?'<span class="label label-red">'.FOUNDER.'</span>':'<span class="label label-green">'.MODERATOR.'</span>';
				else $modo[$m]='<span class="label label-blue">'.MEMBER.'</span>';
			} else $pic='';
			// Avatar
			$avatars[$m]=($pic!='')?'<img class="avatar" src="'.$pic.'" alt="avatar"/>':img(12);
		}
		$cnt=0;
		while(list($auth,$time,$content,$attach)=$topicObj->nextReply()) {
			$buffer .= '<table class="width-100 table-bordered"><tr>';
			if($forum->isMember($auth)) {
				$buffer .= "<td class='avatarTD'><a onmouseover=\"showWMTT('".$auth."')\" onmouseout=\"hideWMTT()\" href='?private=".$auth."' title=''>".$avatars[$auth]."</a>";
				$buffer .= '<div class="datePost"><a class="LienNonLu" href="?private='.$auth.'" title="'.SEND_PRIVATE_MSG.'">'.$auth.'</a></div>';
				$buffer .= '<div>'.$modo[$auth].'</div>';
			} else {
				$buffer .= '<td class="avatarTD">'.$avatars[$auth];
				$buffer .= '<div class="datePost">'.$auth.'</div>';
			}
			$buffer .= '<div class="datePost">'.MESSAGE.': '.$max.'</div>';
			$buffer .= '<div class="datePost">'.date('d/m/Y H:i', $time).'</div></td>';
			$buffer .= '<td class="messageTD"><div id="td'.$cnt.'">'.decode($content).'</div>';
			if(isset($quotes[$auth])) $buffer .= '<div style="clear:both;margin-top:50px"><blockquote><p>'.$quotes[$auth].'</p></blockquote></div>';
			$buffer .= "</td></tr><tr><td style='text-align: center'><a href='".$_SERVER['REQUEST_URI']."#bottom' class='btn btn-small btn-orange' onclick='quote(\"$auth\",$cnt)' title='".QUOTE_MSG_FROM." ".$auth."' /><i class='halflings comments'></i> ".QUOTE."</a></td><td>";
			if($isadmin) { 
				$delmsg = $cnt?ANSWER_FORM.' '.$auth:' '.WHOLE_TOPIC;
				$buffer .= "<a class='btn btn-small' href='?topic=$topic&amp;editpost=$time' title='".EDIT."'><i class='halflings pencil'></i> ".EDIT."</a>&nbsp;<a class='btn btn-small btn-red' href='?topic=$topic&amp;delpost=$time' title='".DEL."' onclick='return confirmLink(this,\"$delmsg\")'><i class='halflings trash'></i> ".DEL."</a>&nbsp;<a class='btn btn-small' href='".$_SERVER['REQUEST_URI']."#bottom' title='".ANSWER."'><i class='halflings share-alt'></i> ".ANSWER."</a>\n";
			}				
			if(!empty($attach)){
				$attachment = explode('/', $attach);
				$buffer .= '<a class="image-right" href="?pid='.base64_encode($attach).'"  title="'.DOWNLOAD.'">'.$attachment[3].' '.img(11).'</a>';
			}		
			$buffer .= '</td></tr>';
			$buffer .= '</table>';
			$cnt++;
		}
		$buffer .= replyForm('newpost');	

	} else {
		$buffer .= '<div class="message">
		              <span class="close"></span>
		              <strong>'.TOPIC_UNKNONW.'</strong>
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
		$txt = preg_replace("/([a-zA-Z0-9\-\_]+)(\(+)([^\n\t]*)(\)+)/i", "<span class='color-blue'>\\0</span>", $txt);
		$txt = preg_replace("/((\n|\t))([^\n\r]+)/i", "<span class='color-gray'>\\0</span>", $txt);	
		$txt = preg_replace("/\\$([a-zA-Z0-9]*)/i", "<span class='color-orange'>\\0</span>", $txt);
		$txt = preg_replace("/\"([^\n\r]+)\"/i", "<span class='color-red'>\\0</span>", $txt);
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
	$replace[] = '<fieldset><legend>'.BLOCKQUOTE.' : $1</legend>$2</fieldset>';

	$pattern[] = '%\[e\]([^\n]+?)\[/e\]%';
	$replace[] = '<p class="color-gray">'.EDIT_BY.' : $1</p>';
	
    /* smiley */
    $pattern[] = '%:\)%';    $replace[] = '<img src="img/smile.png" alt="'.SMILE.'"/>';
    $pattern[] = '%;\)%';    $replace[] = '<img src="img/wink.png" alt="'.WINK.'"/>';
    $pattern[] = '%:D%' ;    $replace[] = '<img src="img/laugh.png" alt="'.LAUGH.'"/>';    
    $pattern[] = '%:\|%';    $replace[] = '<img src="img/indifferent.png" alt="'.INDIFFERENT.'"/>';
    $pattern[] = '%:\(%';    $replace[] = '<img src="img/sad.png" alt="'.SAD.'"/>';
    $pattern[] = '%8\(%' ;   $replace[] = '<img src="img/wry.png" alt="'.WRY.'"/>'; 
    $pattern[] = '%:p%';     $replace[] = '<img src="img/tongue.png" alt="'.TONGUE.'"/>';
    $pattern[] = '%:\$%';    $replace[] = '<img src="img/sorry.png" alt="'.SORRY.'"/>';
    $pattern[] = '%-&gt;%' ; $replace[] = '<img src="img/arrow.png" alt="'.ARROW.'"/>';
    	
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
			var d = "\' class=\'email\' rel=\'tooltip\' title=\''.SEND_AN_EMAIL.'\'><i class=\'halflings envelope\'></i>";
			var e = "</a>";
			document.write(a+b+"@"+c+d+e);
		</script>
		<noscript>'.ACTIVE_JAVASCRIPT_TO_SEE_EMAIL.'</noscript>';
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
		$form .= '<p';
		if($icon)  $form .= ' class="forms-inline">';
		else
			$form .= '>';		    
        $form .= '<label';
		if($require)  $form .= ' class="'.$require.'" for="'.$name.'">' .$label. '</label>';
		else
			$form .= ' for="'.$name.'">' .$label. '</label>';
		if($icon)
			$form .= '<span class="input-prepend"><i class="halflings '.$icon.'"></i></span>';				               		      
		if($readonly)
			$form .= '<input id="'.$name.'" name="'.$name.'" type="'.$type.'" class="readonly" value="'.$value.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').' readonly="readonly" />';
		else
			$form .= '<input id="'.$name.'" name="'.$name.'" type="'.$type.'"'.($class!=''?' class="'.$class.'"':'').' value="'.$value.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').' />';		
     $form .= '</p>';
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
    $form .= '<p><label for="'.$name.'">'.$label. '</label>';
	if($readonly)
		$form .= '<textarea id="'.$name.'" name="'.$name.'" class="readonly" cols="'.$cols.'" rows="'.$rows.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').' readonly="readonly">'.$value.'</textarea>';
	else
		$form .= '<textarea id="'.$name.'" name="'.$name.'"'.($class!=''?' class="'.$class.'"':'').' cols="'.$cols.'" rows="'.$rows.'"'.($maxlength!=''?' maxlength="'.$maxlength.'"':'').($placeholder!=''?' placeholder="'.$placeholder.'"':'').'>'.$value.'</textarea>';
		
    $form .='</p>';
	return $form;
}	
/**
*
* LISTE DES MEMBRES
*/
function showMemberlist() {
	global $isadmin,$cLogin,$forum;

	$toolTip = '';
	$wd=$isadmin?45:60;
	$annu .= '<table class="width-100 table-striped"><thead>
	         <tr class="colorGrayDark">
	              <td style="width:15%;">'.MEMBER.'</td>   
	              <td style="width:'.$wd.'%;">'.SIGNATURE.'</td>
	              <td style="width:13%;">'.BIRTH.'</td>
	              <td style="width:12%;">'.EMAIL.'</td>';
	if($isadmin) $annu .= '<td colspan="2" style="width:15%;">'.ADMIN.'</td>';
	$annu .= '</thead></tr>';
	$mb=$forum->listMember();
	foreach($mb as $m) {
		list($pass,$time,$mail,$quote,$url,$birthday,$pic,$mod,$post)=$forum->getMember($m);
		$protectmail='<a href="mailto:'.$mail.'" class="Lien" title="">'.img(9).'</a>';
		$signature=($quote!="")?tronquer_texte($quote, 50):"&nbsp;";
		if($url!='') {
			if (!preg_match('|http://|',$url)) $url='http://'.$url;
			$url='<a href="'.$url.'" title="">'.img(10).'</a>';
		}
		if($birthday!='') {
			$birthday = str_replace(' ', '', $birthday);
			$birthday = preg_replace('/([0-9]{2})+([0-9]{2})+([0-9]{2})+([0-9]{2})+([0-9]{2})+(.*)/i', '\\1 \\2 \\3 \\4 \\5', $birthday);
		} else $birthday = '&nbsp;';
		$avatar=($pic != '')?'<img style="width:80px; height:80px;" src="'.$pic.'" alt="Avatar" />':img(12,'img-circle');
		$toolTip .= '<div class="tooltip" id="'.$m.'">
		               <p class="image-right"><span class="thumbnail">'.$avatar.'</span></p>
                       <h4>'.MINI_PROFIL_OF.' <b>'.$m.'</b></h4>
                       <p><b>'.REGISTRED_ON.' : </b> '.date('d M Y à H:i',$time).'<br />';
	                   if(!empty($mail)) $toolTip .= '<b>'.EMAIL.' : </b> '.$mail.'<br />';
	                   if(!empty($birthday)) $toolTip .= '<b>'.BORN_ON.' : </b> '.$birthday.' <span class="label label-black">'.birthday($birthday, $pattern = 'eu').' '.YEARS_OLD.'</span><br />';
	                   if(!empty($quote)) {
		                  $toolTip .= '<b>'.SIGNATURE.' : </b> <blockquote><p class="color-blue">'.$quote.'</p></blockquote><br />';
	                   }  
        $toolTip .= '</p></div>';
					
		$annu .= '<tr>';
		$annu .= "<td><a class='Lien' href='?private=".$m."' onmouseover=\"showWMTT('".$m."')\" onmouseout=\"hideWMTT()\"  title='".SEND_PRIVATE_MSG."'>".$m."</a></td>\n";
		$annu .= '<td>'.$signature.'</td>';
		$annu .= '<td>'.$birthday.'</td>';
		$annu .= '<td>'.$protectmail.' '.$url.'</td>';
		if($isadmin) {
			if($mod) {
				if($m==$cLogin || $mod==2) {
					$str=($mod>1)? ADMIN:MODO;
					$annu .= '<td>&nbsp;</td>';
					$annu .= "<td><form><input style='border:none;' type='checkbox' checked='checked' onclick=\"this.checked='checked'\"/>$str!</form></td>\n";
				} else {
					$annu .= "<td><a class='Lien' href='?memberlist=1&deluser=".$m."' onclick='return confirmLink(this,\"$m\")' title='".DEL_MEMBER."'><i class='halflings trash'></i></a></td>\n";
					$annu .= "<td><form><input style='border:none;' type='checkbox' checked='checked' onclick=\"window.location='?memberlist=1&switchuser=".$m."';\" /> ".MODO."?</form></td>\n";
				}
			} else {
				$annu .= "<td><a href='?memberlist=1&deluser=".$m."' onclick='return confirmLink(this,\"$m\")' title='".DEL_THIS_USER."'><i class='halflings trash'></i></a></td>\n";
				$annu .= "<td><form><input style='border:none;' type='checkbox' onclick=\"window.location='?memberlist=1&switchuser=".$m."';\"/> ".MODO."?</form></td>\n";
			}
		}
		$annu .= '</tr>';
	}
	$annu .= '</table>';
	$annu .= $toolTip;
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
				} else $error=$type?ERROR_AVATAR_CREATION:ERROR_ATTACHMENT_NOT_REC;
			} else $error=ERROR_OVERWEIGHT_AVATAR;
		} else $error=ERROR_PROHIBITED_FILE;
	} else return false;
	return $avatar;
}
/**
*
* FORMULAIRE DE RÉPONSE
*/
function replyForm($type,$mpTo="") {
	global $topic,$editpost,$topicObj,$cLogin,$isadmin;
	$edit=0; $join=0; $show=0;
	if($type=='newtopic') {
		$name= NEW_TOPIC;
		$join=1;
		$show=$mpTo?0:1;
	} else if($type=='newpost') {
		$name= ANSWER;
		$join=1;
	} else if($type=='editpost') {
		if($s = implode("", file(U_THREAD.$topic.'.dat'))) $topicObj = unserialize($s);
		else return false;
		list($auth,$time,$content,$attach)=$topicObj->getReply($editpost);
		$content = preg_replace('/[e](.*)[e]\r\n/i','',$content);
		$name= CHANGE;
		$edit=1;
	} else {
		$name= SEND_PRIVATE_MSG.' '.TO.' '.$mpTo;
		$show=1;
	}
	$buffer = '<!-- Reply form -->';
	if($edit || $show) { 
		$buffer .= '<h4 class="forms-section">'.$name.'</h4>';
		$buffer .= '<div class="Box"><div>';
	} else { 
		$buffer .= "<a class='btn btn-big' href=\"javascript:switchLayer('form');\" title='formulaire'>$name</a>\n";
		$buffer .= '<div class="toggle" id="form">';
	} 
	$buffer .= '<br /><form id="formulaire" action="index.php" method="post" enctype="multipart/form-data" class="forms forms-columnar">';
	$buffer .= '<input type="hidden" name="action" value="'.$type.'" />';
	// Réponse
	if($type== 'newpost' || $edit) $buffer .= '<input type="hidden" name="topicID" value="'.$topic.'" />';
	// Mesage privé
	if($mpTo) $buffer .= '<input type="hidden" name="mpTo" value="'.$mpTo.'" />';
	// Edition
	if($edit) $buffer .= '<input type="hidden" name="postID" value="'.$editpost.'" />';
	$buffer .= '<div>';
	// Nouveau Sujet
	if($type== 'newtopic') { 
		$buffer .= input(TITLE_SUBJECT, 'titre', '', 'text', '', '','','width-40');
		if($isadmin) $buffer .= '<p><label for="postit"><i class="halflings star"></i> '.PINNED.'</label>
      <input type="checkbox" id="postit" name="postit" value="1"></p>';
	}
	if(!$cLogin) $buffer .= input(USER_MENDATORY, 'anonymous', '', 'text', '', '','','width-40');
    $buffer .= formattingHelp();
	if($edit) { 
		$buffer .= textarea(MESSAGE, 'message', $content, '40', '10', '', '', '', 'width-70');
	} else { 
		$buffer .= textarea(MESSAGE, 'message', '', '40', '10', '', '', '', 'width-70');
	} 
	
	if($join) $buffer .= input(ATTACH_FILE, 'attachment', '', 'file', '', '','','width-40');      
	$buffer .= '<p><button type="submit" class="text-right btn btn-green"><i class="halflings arrow-right"></i> '.SEND.'</button></p>';
	$buffer .= '</div>
              </form>
   </div></ul>
</nav>';
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
	$list='<div class="files">';
	$list.='<b>'.PERSONAL_FILES.'</b><br /><hr />';
	$h=dir($dir);
	$id=0;
	while ($f=$h->read()) {
		if (($f!='.') && ($f!='..') && ($f!=$cLogin.'.mp')) {
			$cl=($a[6]!=($dir.urlencode($f)))?"Lien":"poster";
			$list.=$id. ' | <a class="$cl" href="'.$dir.urlencode($f).'" title="fichier">'.$f.'</a><br />';
			$id++;
		}
	}
	$list .= '</div>';
	return $list;
}
/**
*
* AFFICHE LES MESSAGES PRIVÉ
*/
function showPrivateMsg() {
	global $cLogin,$forum;
	
	$s=implode('', file(U_MEMBER.$cLogin.'/'.$cLogin.'.mp'));
	$mp = unserialize($s);
	$mess=$mp->getMessage();
	$pvtBox = '<a name="private" id="private" title="'.PRIVATE_MSG.'"></a>
	          <div class="Box">';
	$pvtBox .= "<a class='toggleLink' href=\"javascript:switchLayer('privatebox');\" title='message privé'>".PRIVATE_INBOX."</a>\n";
	$pvtBox .= "<div class='toggle' id='privatebox'>\n";
	foreach($mess as $m) {
		if($forum->isMember($m[1])) $pvtBox .= '<a class="Lien" href="?private='.$m[1].'" title="'.PRIVATE_MSG.'">'.$m[1].'</a> le '.date('d/m/Y @ H:i',$m[0]).' <br />';
		else {
			$m[1]=preg_replace("/(([0-9]{1,3}\.[0-9]{1,3})\.([0-9]{1,3}\.[0-9]{1,3}))/i","\\2.x.x",$m[1]);
			$pvtBox .= $m[1].' le '.date('d/m/Y @ H:i',$m[0]).' <br />';
		}
		$pvtBox .= stripslashes(decode($m[2])).'<br /><hr />';
	}
	$pvtBox .= '<p class="text-right"><a href="?private='.$m[1].'" class="btn btn-green"><i class="halflings comments"></i> '.ANSWER.' '.TO.' '.$m[1].'</a>
                <a href="?delprivate=1" class="btn btn-red"><i class="halflings trash"></i> '.EMPTY_MAILBOX.'</a><p/>
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
    $error= '<div class="text-centered">'.ARCHIVE_REC.'  <a class="btn btn-small btn-blue" href="'.$destination.'" title="'.DOWNLOAD.'"><i class="halflings download-alt"></i> '.DOWNLOAD_ARCHIVE.'</a></div>';
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
		$error = ERROR_TYPE_NOT_ZIP_FILE;
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
		$error = BACKUP_DONE;
	} else {	
		$error = ERROR_DURING_UPLOAD;
	}
   }
}
/**
*
* FORMULAIRE DE RÉSTAURATION DE LA SAUVEGARDE
*/
function frestore() {
	$form = '<!-- Edit config form -->';
	$form .= '<div class="Box">
	           <h4 class="forms-section">'.RESTAURATION_FORUM.'</h4>
	           <div style="padding-top:10px">
	           <form action="index.php" method="post" enctype="multipart/form-data" class="forms forms-columnar">
	           <input type="hidden" name="restore" value="1" />
	           <input type="hidden" name="action" value="restore" />
	           ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
	           input(UPLOAD_BACKUP, 'backup', '', 'file', '', '','','width-40').'
               <p><input class="btn" type="submit" value="'.SEND.'" /></p>
       </form>
	</div>
</div>';
	
	return $form;
}
/**
*
* ÉDITION DE LA CONFIGURATION
*/
function editConf() {
	global $uforum,$nbrMsgIndex,$extStr,$maxAvatarSize,$wt,$forumMode,$quoteMode,$siteUrl,$siteName,$metaDesc,$lang;
	
	$fmode = $forumMode?'checked="checked" ':'';
	$qmode = $quoteMode?'checked="checked" ':'';
	if(!$wtp=@file_get_contents('welcome.txt')) $wtp=clean($wt);
	$form = '<!-- Edit config form -->';
	$form .= '<h4 class="forms-section">'.CONFIG_OPTIONS.'</h4>';
	$form .= '<div style="padding-top:10px;">';
	$form .= '<form action="index.php" method="post" enctype="multipart/form-data" class="forms forms-columnar">
  <input type="hidden" name="action" value="editoption" />
  
  <p class="forms-inline">
    <label>'.TITLE_LOGO.'</label>
      <input type="text" name="uftitle" maxlength="60" value="'.clean($uforum).'" class="width-30" />
      &nbsp;<input type="file" name="attachment" class="width-40" />
  </p> 

  <p class="forms-inline">
    <label>'.NAME_AND_URL.'</label>
      <input type="text" name="ufsitename" value="'.clean($siteName).'" placeholder="µForum" class="width-30" />
      &nbsp;<input type="url" maxlength="80" name="ufsite" value="'.$siteUrl.'" placeholder="http://…" class="width-40" />
  </p> 
   
  ' .//input($label, $name, $value='', $type='text', $placeholder='', $maxlength='255', $readonly=false, $class='', $icon, $require)
     textarea(META_DESCRIPTION, 'ufmetadesc', clean($metaDesc), '10', '2', 'Lightweight bulletin board without sql', '150', '', 'width-70').
     input(INDEX_MAX_MSG, 'nbmess', $nbrMsgIndex, 'number', '', '2', '', 'width-10').
     input(LANG, 'uflang', $lang, 'text', '', '2', '', 'width-10').
     input(MAX_AVATAR_WEIGHT, 'maxav', ($maxAvatarSize/1024), 'number', '', '10', '', 'width-10', 'resize-small').
     input(ALLOWED_EXT, 'exts', clean($extStr), 'text', '', '50', '', 'width-40'). '
  <p>
    <label>'.PRIVATE_MODE.'</label>
      <input name="fmode" value="1" type="checkbox" '.$fmode.'/>
  </p> 
  <p>
    <label>'.SHOW_SIGNATURES.'</label>
      <input name="qmode" value="1" type="checkbox" '.$qmode.'/>
  </p>  
  ' .textarea(WELCOME_MSG, 'message', $wtp, '40', '20', '', '', '', 'width-70'). '       

  <p class="text-right">
     <button type="submit" class="btn btn-green btn-big">'.REC.'</button>
  </p>  
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
require 'config.php';

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
	} else $error .= ERROR_FILE_UNKNOWN;
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
		if(!$goodpass) $error .= ERROR_WRONG_PASSWORD.' '.$cLogin.' !<br>';
		if(!$ismember) $error .= BECAREFUL.' '.$cLogin.' '.CASE_SENSITIVE.'<br>';
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
	if(in_array($login,$forum->listMember())) $error .= ERROR_USER_ALREADY_EXISTS;
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
			$error .= ERROR_INVALID_EMAIL;
		}
	} else {
		$error .= ERROR_FILL_FIELDS;
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
			$error .= ERROR_INVALID_PSEUDO;
		} else if ($forum->isMember($anonymous)) {
		    $error .= ERROR_PSEUDO_ALREADY_USED;
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
			} else $error .= ERROR_INVALID_TOPIC;
		}
	}
	break;
case 'newtopic':
	if($titre!='' && $message!='' && ($ismember || !$forumMode)){
		if(!$ismember && !$anonymous) {
			$error .= ERROR_EMPTY_PSEUDO;
		} else if ($forum->isMember($anonymous)) {
		    $error .= ERROR_PSEUDO_ALREADY_USED;
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
	else if(!$ismember) $error.=ERROR_EMPTY_PSEUDO;
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
    <base href="<?php echo $siteBase; ?>" />
    <link rel="stylesheet" type="text/css"  href="css/style_<?php echo $cStyle; ?>.css" />
    <link rel="stylesheet" type="text/css"  href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/halflings.css" />    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]--> 
    
<!--[if lt IE 9]>
<script>
	var head = document.getElementsByTagName('head')[0], style = document.createElement('style');
	style.type = 'text/css';
	style.styleSheet.cssText = ':before,:after{content:none !important';
	head.appendChild(style);
	setTimeout(function(){ head.removeChild(style); }, 0);
</script>
<![endif]-->  

<script>
//<![CDATA[
var activeSub=0;var SubNum=0;var timerID=null;var timerOn=false;var timecount=300;var what=null;var newbrowser=true;var check=false;var layerRef="";var tm="";var confirmMsg="Confirmez la suppression de ";var msie=navigator.userAgent.toLowerCase().indexOf("msie")+1;wmtt=null;document.onmousemove=updateWMTT;function init(){if(document.layers){layerRef="document.layers";styleSwitch="";visibleVar="show";what="ns4"}else{if(document.all){layerRef="document.all";styleSwitch=".style";visibleVar="visible";what="ie"}else{if(document.getElementById){layerRef="document.getElementByID";styleSwitch=".style";visibleVar="visible";what="moz"}else{what="none";newbrowser=false}}}check=true}function switchLayer(a){if(check){if(what=="none"){return}else{if(what=="moz"){if(document.getElementById(a).style.visibility=="visible"){document.getElementById(a).style.visibility="hidden";document.getElementById(a).style.display="none"}else{document.getElementById(a).style.visibility="visible";document.getElementById(a).style.display="block"}}else{if(document.all[a].style.visibility=="visible"){document.all[a].style.visibility="hidden";document.all[a].style.display="none"}else{document.all[a].style.visibility="visible";document.all[a].style.display="block"}}}}else{return}}function countInstances(c,b){var a=document.formulaire.message.value.split(c);var d=document.formulaire.message.value.split(b);return a.length+d.length-2}function insert(e,c){var b=document.getElementById("message");if(document.selection){var g=document.selection.createRange().text;document.formulaire.message.focus();var d=document.selection.createRange();if(c!=""){if(g==""){var f=countInstances(e,c);if(f%2!=0){d.text=d.text+c}else{d.text=d.text+e}}else{d.text=e+d.text+c}}else{d.text=d.text+e}}else{if(b.selectionStart|b.selectionStart==0){if(b.selectionEnd>b.value.length){b.selectionEnd=b.value.length}var h=b.selectionStart;var a=b.selectionEnd+e.length;b.value=b.value.slice(0,h)+e+b.value.slice(h);b.value=b.value.slice(0,a)+c+b.value.slice(a);b.selectionStart=h+e.length;b.selectionEnd=a;b.focus()}else{var d=document.formulaire.message;var f=countInstances(e,c);if(f%2!=0&&c!=""){d.value=d.value+c}else{d.value=d.value+e}}}}function updateWMTT(a){if(document.documentElement.scrollTop&&msie){x=window.event.x+document.documentElement.scrollLeft+10;y=window.event.y+document.documentElement.scrollTop+10}else{x=(document.all)?window.event.x+document.body.scrollLeft+10:(a.pageX+10)+"px";y=(document.all)?window.event.y+document.body.scrollTop+10:(a.pageY+10)+"px"}if(wmtt!=null){wmtt.style.left=x;wmtt.style.top=y}}function showWMTT(a){wmtt=document.getElementById(a);wmtt.style.display="block"}function hideWMTT(){wmtt.style.display="none";wmtt=null}function quote(c,f){var a=document.getElementById("td"+f).innerHTML;var b=new Array("<fieldset.*?>.*?</fieldset>","<br>|<br />","<small>.*?</small>|<pre>|</pre>|<font.*?>|</font>|&nbsp;","<b>","</b>","<i>","</i>","<u>","</u>","&amp;lt;|&lt;","&amp;gt;|&gt;","<hr>",'<img(.*?)src="pictures/(.*?)"(.*?)>');var e=new Array("","\n","","[b]","[/b]","[i]","[/i]","[u]","[/u]","<",">","[hr]","[sm=$2]");var d=0;for(i in b){regex=new RegExp(b[i],"gi");a=a.replace(regex,e[d++])}if(document.getElementById("form").style.visibility!="visible"){switchLayer("form")}document.getElementById("message").value+="[q="+c+"]"+a+"[/q]\n"}function blnk(b,a){document.getElementById(b).style.textDecoration=(a)?"none":"underline";a=a?0:1;tm=setTimeout('blnk("'+b+'",'+a+")",1000)}function confirmLink(b,c){var a=confirm(confirmMsg+" :\n"+c);if(a){b.href+="&do=1"}return a};
//]]>
</script>
<?
if(preg_match('/.gif$|.jpg$|.png$/i',$uforum) && file_exists($uforum)) {
	$tmp='<a href="index.php" title="'.htmlspecialchars($siteName, ENT_QUOTES).'"><img src="'.$uforum.'" alt="'.htmlspecialchars($siteName, ENT_QUOTES).'" /></a>';
	echo '<title>'.htmlspecialchars($siteName, ENT_QUOTES).'</title>';
} else {
	$tmp=decode($uforum);
	$bbcodes=array('[b]','[/b]','[i]','[/i]','[u]','[/u]','[e]','[/e]','[hr]');
	echo '<title>'.stripslashes(str_replace($bbcodes,'',$uforum)).'</title>';
}

echo '</head>';
echo '<body onload="init();">';
echo '    <!-- Navbar
    ================================================== -->    
	<div class="wrapper">

		<header id="header">
			<h1>'.$tmp.'</h1>
			<nav class="nav-g">
				<ul>';
                       echo menu(); if($ismember || !$forumMode){ echo menu_admin(); }
echo '          </ul>
			</nav>
		</header>

		<div id="main">

			<div class="units-row">
				<article class="unit-100">
				     
               <noscript>
                 <div class="message message-error">
                   <span class="close"></span>
                   <header><i class="halflings warning-sign"></i> '.JS_UNAVAILABLE.'</header>
                   '.JS_UNAVAILABLE_MSG.' 
                 </div>
               </noscript>';

// message d'erreur (en cas de mauvais mot de passe, membre déjà existant etc...)
if($error != '') { echo '<div class="message"><span class="close"></span>'.$error.'</div>'; }

if($ismember || !$forumMode){
	echo breadcrumbs();
	if($havemp) echo showPrivateMsg();	
	if($editpost) echo replyForm('editpost');
	else if($conf) echo editConf();
	else if($topic) echo showPosts();
	else if($memberlist) echo showMemberlist();
	else if($editprofil) echo editProfilForm();
	else if($private) echo replyForm('mp',$private);
	else if($restore) echo frestore();
	#else { echo showTopics(); $st=1; }
	#if(!$forumMode && !$ismember) { echo registerForm(); if(isset($st)) echo welcomeText();}
	#if($havemp) echo showPrivateMsg();
	// MODE LIBRE
	else if(!$forumMode && !$ismember) {
	      $st=1; 
    echo '<nav class="nav-tabs">
            <ul>
              <li><a class="active" href="#home"><i class="halflings home"></i> '.HOME.'</a></li>
              <li><a href="#reg"><i class="halflings user"></i> '.SIGN_UP.'</a></li>
              <li><a href="#bb"><i class="halflings th-list"></i> '.FORUMS.'</a></li>
            </ul>
          </nav>
            
              <div id="home">
                '.welcomeText().'
              </div>
              
              <div id="reg">
                '.registerForm().'
              </div>
              
              <div id="bb">
                '.showTopics().'
              </div>';	       
	}
	else 
	{ #on est connecté, alors on affiche uniquement la liste des forums
	echo showTopics(); 
	}
		
} else {
    // MODE PRIVÉ
	echo '<nav class="nav-tabs">
            <ul>
              <li><a class="active" href="javascript:switchLayer(\'home\');"><i class="halflings home"></i> '.HOME.'</a></li>
              <li><a href="javascript:switchLayer(\'reg\');"><i class="halflings user"></i> '.SIGN_UP.'</a></li>
            </ul>
          </nav>

              <div id="home">
                '.welcomeText().'
              </div>
              
              <div id="reg">
                '.registerForm().'
              </div>';
}


$arr_cnct=$conn->updateVisit($cLogin);
$stats=$forum->getStat();
echo '				</article>
			</div>
		</div>
		
      <hr />

      <div class="units-row units-split">

        <div class="unit-33"><h4>'.STATISTICS.'</h4>';
if($stats[0]>1) {$a[0]='s';$a[1]='ont';}
else {$a[0]='';$a[1]='a';}//Total membre
$m=($stats[3]>1)?'s':'';//Message
$s=($stats[2]>1)?'s':'';//Sujet
$arr_cnct[0]=($arr_cnct[0])?$arr_cnct[0]:L_NONE;

echo '<p>'.WE_HAVE.' '.$stats[3].' '.MESSAGE.$m.' '.IN.' '.$stats[2].' '.TOPIC.$s.'. <br />
      '.WELCOME_TO.', <span class="color-orange">'.$stats[1].'</span><br />
      '.TOTAL_MB.$a[0].': '. $stats[0].'</p>
      </div>
      
      <div class="unit-33">
      <h4>'.LEGEND.'</h4>
      <p>
         <i class="halflings folder-open"></i> '.NO_UNREAD_MSG.'<br />
         <i class="halflings star"></i> '.PINNED.'<br /> 
         <i class="halflings fire"></i> '.UNREAD_MSG.'<br /> 
         <i class="halflings file"></i> '.ATTACHMENT.'
      </p>
      </div>
      
      <div class="unit-33">
      <h4>'.WHO_IS_ONLINE.'</h4>
      <p>'.MB_ONLINE.' : <b>'.$arr_cnct[0].'</b><br />'.GUESTS.' : '.$arr_cnct[1].'</p>
      </div>
      
    </div>';

echo '  <footer id="footer">© 2011-'.date('Y').' '.clean($siteName).'.  
             <span>'.POWEREDBY.' v.'.$version.'</a>&nbsp;&nbsp;
             &nbsp;&nbsp;<a href="' .getURL(). '#top" title="'.TOP.'"><i class="halflings chevron-up"></i></a></span>
        </footer>
	</div>';
?>
    <!-- Le javascript
    ================================================== -->    
    <script src="js/kube.tabs.js"></script>
  </body>
</html>