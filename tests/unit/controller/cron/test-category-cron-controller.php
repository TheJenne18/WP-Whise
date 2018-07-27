<?php

namespace wp_whise\tests\unit\controller\cron;

use wp_whise\controller\adapter\Whise_Adapter;
use wp_whise\controller\Category_Controller;
use wp_whise\controller\cron\Cron_Controller;
use wp_whise\controller\Estate_Controller;
use wp_whise\controller\Whise_Controller;

class Test_Category_Cron_Controller extends \WP_UnitTestCase {

	CONST CLIENT_ID = '1829c9494c7d4340a152';

	protected $whise_adapter;

	protected $log;

	protected $whise_controller;

	function setUp() {
		$this->whise_adapter    = new Whise_Adapter();
		$this->log              = $this->getMockBuilder( 'wp_whise\controller\log\Database_Log_Controller' )->getMock();
		$this->whise_controller = new Whise_Controller( $this->whise_adapter, $this->log, static::CLIENT_ID );
	}

	/**
	 * @covers \wp_whise\controller\Category_Controller::get()
	 */
	function test_get_estates() {
		$cron = new Category_Controller( $this->whise_controller, $this->log );

		$result = $cron->get();

		$this->assertTrue( is_array( $result ) );
	}

	/**
	 * @covers \wp_whise\controller\Category_Controller::process()
	 */
	function test_process_estates() {
		$cron = new Category_Controller( $this->whise_controller, $this->log );

		$cron->get();

		$result = $cron->process();

		$this->assertTrue( $result );
	}
}