<?php

namespace Objectiv\BoosterSeat\Base;

/**
 * Class Action
 *
 * @link objectiv.co
 * @since 1.0.0
 * @package Objectiv\BoosterSeat\Base
 * @author Brandon Tassone <brandon@objectiv.co>
 */
abstract class Action extends Tracked {

	/**
	 * @since 1.0.6
	 * @access private
	 * @var bool
	 */
	private $no_privilege;

	/**
	 * @since 1.0.6
	 * @access private
	 * @var string
	 */
	private $action_prefix;

	/**
	 * Action constructor.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param $id
	 * @param bool $no_privilege
	 * @param string $action_prefix
	 */
	public function __construct( $id, $no_privilege = true, $action_prefix = "wp_ajax_" ) {
		parent::__construct( $id );

		$this->set_no_privilege($no_privilege);
		$this->set_action_prefix($action_prefix);
	}

	/**
	 * @since 1.0.0
	 * @access public
	 */
	public function load() {
		add_action("{$this->get_action_prefix()}{$this->get_id()}", array($this, 'action'));

		if( $this->get_no_privilege() === true ) {
			add_action( "{$this->get_action_prefix()}nopriv_{$this->get_id()}", array( $this, 'action' ) );
		}
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 * @param $out
	 */
	protected function out($out) {
		echo json_encode($out, JSON_FORCE_OBJECT);
		wp_die();
	}

	/**
	 * @since 1.0.0
	 * @access public
	 * @return mixed
	 */
	abstract public function action();

	/**
	 * @since 1.0.6
	 * @access public
	 * @return bool
	 */
	public function get_no_privilege() {
		return $this->no_privilege;
	}

	/**
	 * @since 1.0.6
	 * @access public
	 * @param bool $no_privilege
	 */
	public function set_no_privilege($no_privilege) {
		$this->no_privilege = $no_privilege;
	}

	/**
	 * @since 1.0.6
	 * @access public
	 * @return string
	 */
	public function get_action_prefix() {
		return $this->action_prefix;
	}

	/**
	 * @since 1.0.6
	 * @access public
	 * @param string $action_prefix
	 */
	public function set_action_prefix($action_prefix) {
		$this->action_prefix = $action_prefix;
	}
}