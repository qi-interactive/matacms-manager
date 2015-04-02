<?php 

namespace matacms\manager;

class ComposerPackage {

	public $name;
	public $version;
	public $description;


	public function __construct($name, $version, $description) {
		$this->name = $name;
		$this->version = $version;
		$this->description = $description;
	}
}