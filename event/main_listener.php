<?php

namespace flerex\linkedaccounts\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class main_listener implements EventSubscriberInterface
{

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \flerex\linkedaccounts\service\utils */
	protected $utils;

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 */
	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language_on_setup',
			'core.permissions' 	=> 'add_permissions',
			'core.page_header' 	=> 'add_switchable_accounts',
		);
	}

	public function __construct(\phpbb\user $user, \phpbb\template\template $template, \flerex\linkedaccounts\service\utils $utils)
	{
		$this->template	= $template;
		$this->user		= $user;
		$this->utils	= $utils;
	}

	/**
	 * Load the Linked Accounts language file
	 *	 flerex/linkedaccounts/language/en/common.php
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function load_language_on_setup($event)
	{

		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'flerex/linkedaccounts',
			'lang_set' => 'common',
		);
		$event['lang_set_ext'] = $lang_set_ext;

	}

	/**
	 * Make phpBB aware of Linked Accounts' permissions
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function add_permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_link_accounts'] = array('lang' => 'ACL_U_LINK_ACCOUNTS', 'cat' => 'profile');
		$event['permissions'] = $permissions;
	}

	/**
	 * Create global variables with the switched accounts
	 * to be used on the template event
	 *
	 * @param \phpbb\event\data $event The event object
	 */
	public function add_switchable_accounts($event)
	{
		foreach($this->utils->get_linked_accounts() as $linked_account)
		{
			$this->template->assign_block_vars('switchable_account', array(
				'SWITCH_LINK'	=> $linked_account['user_id'],
				'NAME'			=> get_username_string('no_profile', $linked_account['user_id'], $linked_account['username'], $linked_account['user_colour']),
			));
		}

	}
}

// $this->user->session_kill(false);
// $this->user->session_begin();
// $this->user->session_create(2);