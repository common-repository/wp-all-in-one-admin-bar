<?php

class Wordpress_All_In_One_Adminbar_Menu_Params {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;
 	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	private function __construct() {
	
	}

	protected $name = null;
	protected $id = null;
	protected $href = null;

    public function getName() {
	
        return $this->name;
		
    }

    public function setName($name) {
	
        $this->name = $name;   
        return $this;
		
    }

    public function getId() {
	
        return $this->id;
		
    }

    public function setId($id) {
	
        $this->id = $id;   
        return $this;
		
    }

    public function getHref() {
	
        return $this->href;
		
    }

    public function setHref($href) {
	
        $this->href = $href;   
        return $this;
		
    }	
	
}

?>