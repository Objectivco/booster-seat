<?php

use Objectiv\BoosterSeat\Base\Singleton;

// Middle class so we can test more inheritance
class Middle extends Singleton {
	public $name = "";
}

// Test class 1
class Test1 extends Middle {}

// Test class 2
class Test2 extends Middle {}

// Test class 3
class Test3 extends Middle {}

/**
 * Sample test case.
 */
class SingletonTest extends WP_UnitTestCase {

	/**
	 * @var Test1
	 */
	public $test1;

	/**
	 * @var Test2
	 */
	public $test2;

	/**
	 * @var Test3
	 */
	public $test3;

	/**
	 * Test setup function where we grab each classes initial instance
	 */
	function setUp() {
		parent::setUp();

		$this->test1 = Test1::instance();
		$this->test1->name = "Murphy";

		$this->test2 = Test2::instance();
		$this->test2->name = "John";

		$this->test3 = Test3::instance();
		$this->test3->name = "Brandon";
	}

	/**
	 * Test that when multiple classes extend from this base class it correctly retrieves the right class
	 */
	function test_class_extended_can_allow_for_other_classes() {

		$this->assertTrue($this->test1 instanceof Test1);
		$this->assertTrue($this->test2 instanceof Test2);
		$this->assertTrue($this->test3 instanceof Test3);
	}

	/**
	 * T
	 */
	function test_class_extended_can_be_the_only_class_created() {

		$previous_test1 = $this->test1;
		$test1 = Test1::instance();

		$this->assertEquals($previous_test1, $test1);
		$this->assertEquals("Murphy", $test1->name);
		$this->assertEquals("John", Test2::instance()->name);
		$this->assertEquals("Brandon", Test3::instance()->name);
	}
}
