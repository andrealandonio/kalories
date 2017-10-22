<?php

/**
 * Class Meal
 */
class Meal {

	/**
	 * ID
	 *
	 * @var int $id
	 */
	public $id;

	/**
	 * User ID
	 *
	 * @var int $user_id
	 */
	public $user_id;

	/**
	 * Description
	 *
	 * @var string $description
	 */
	public $description;

	/**
	 * Date
	 *
	 * @var int $date
	 */
	public $date;

	/**
	 * Time
	 *
	 * @var int $time
	 */
	public $time;

    /**
     * Meal's calories
     *
     * @var int $calories
     */
	public $calories;

	/**
	 * Constructor
	 *
	 * @param int $id
	 * @param int $user_id
	 * @param string $description
	 * @param int $date
	 * @param int $time
	 * @param int $calories
	 */
	public function __construct( $id, $user_id, $description, $date, $time, $calories ) {
		$this->id = $id;
		$this->user_id = $user_id;
		$this->description = $description;
		$this->date = $date;
		$this->time =  $time;
		$this->calories = $calories;
	}

	/**
	 * Get id
	 *
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Set id
	 *
	 * @param int $id
	 */
	public function set_id( $id ) {
		$this->id = $id;
	}

	/**
	 * Get user_id
	 *
	 * @return int
	 */
	public function get_user_id() {
		return $this->user_id;
	}

	/**
	 * Set user_id
	 *
	 * @param int $user_id
	 */
	public function set_user_id( $user_id ) {
		$this->user_id = $user_id;
	}

	/**
	 * Get description
	 *
	 * @return string
	 */
	public function get_description() {
		return $this->description;
	}

	/**
	 * Set description
	 *
	 * @param string $description
	 */
	public function set_description( $description ) {
		$this->description = $description;
	}

	/**
	 * Get date
	 *
	 * @return int
	 */
	public function get_date() {
		return $this->date;
	}

	/**
	 * Set date
	 *
	 * @param int $date
	 */
	public function set_date( $date ) {
		$this->date = $date;
	}

	/**
	 * Get time
	 *
	 * @return int
	 */
	public function get_time() {
		return $this->time;
	}

	/**
	 * Set time
	 *
	 * @param int $time
	 */
	public function set_time( $time ) {
		$this->time = $time;
	}

	/**
	 * Get calories
	 *
	 * @return int
	 */
	public function get_calories() {
		return $this->calories;
	}

	/**
	 * Set calories
	 *
	 * @param int $calories
	 */
	public function set_calories( $calories ) {
		$this->calories = $calories;
	}
} 