<?php

namespace Objectiv\BoosterSeat\Base;

/**
 * Class Action
 *
 * @link objectiv.co
 * @since 1.0.0
 * @package Objectiv\Plugins\Checkout\Core\Base
 * @author Brandon Tassone <brandontassone@gmail.com>
 */
abstract class Action extends Tracked {

	/**
	 * Action constructor.
	 *
	 * @since 1.0.0
	 * @access public
	 * @param $id
	 */
	public function __construct( $id ) {
		parent::__construct( $id );
	}

	/**
	 * @since 1.0.0
	 * @access public
	 * @param boolean $np
	 */
	public function load($np = true) {
		add_action("wp_ajax_{$this->get_id()}", array($this, 'action'));

		if($np) {
			add_action( "wp_ajax_nopriv_{$this->get_id()}", array( $this, 'action' ) );
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
}