<?php
/**
 *
 * Linked Accounts extension for phpBB 3.2
 *
 * @copyright (c) 2018 Flerex
 * @author        Flerex <flerex@icloud.com>
 * @license       GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(

	'ACL_U_SWITCH_ACCOUNTS' => 'Peut changer de compte',
	'ACL_U_LINK_ACCOUNTS'   => 'Peut lier des comptes',
	'ACL_A_LINK_ACCOUNTS'   => 'Peut gérer les liens de compte',
	'ACL_U_POST_AS_ACCOUNT' => 'Can post as a one of their linked accounts',
	'ACL_U_VIEW_OTHER_USERS_LINKED_ACCOUNTS' => 'View other user’s linked accounts',

));
