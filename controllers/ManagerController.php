<?php

namespace matacms\manager\controllers;

use Yii;
use matacms\controllers\base\AuthenticatedController;
use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use matacms\manager\ComposerPackage;

/**
 * ContentBlockController implements the CRUD actions for ContentBlock model.
 */
class ManagerController extends AuthenticatedController {


	public function actionIndex() {

		// Composer\Factory::getHomeDir() method 
		// needs COMPOSER_HOME environment variable set
		// check if perhaps there is local composer
		 putenv('COMPOSER_HOME=' . Yii::getAlias("@vendor") . '/composer/composer/bin/composer');


		// call `composer install` command programmatically
		$input = new ArrayInput(array('command' => 'show', '-i' => true,
	'--working-dir' => Yii::getAlias("@vendor") . "/.."));


		$application = new Application();


		$application->setAutoExit(false); // prevent `$application->run` method from exitting the script
		$output = new BufferedOutput();

		$application->run($input, $output);
		$res = $output->fetch();

		$res = explode("\n", $res);

		$packages = [];

// echo "<pre>";
		foreach($res as $line) {
// echo $line . "<br/>";
			if (preg_match('/(\S*) *(\S*) *(\S*) *(.*)/', $line, $match)) {
				// print_r($match);
				$packages[] = new ComposerPackage($match[1], $match[2], $match[4]);

			}

			// echo "<br/><br/>";
		}


		foreach ($packages as $package)
			echo sprintf("%s in version %s: %s<br/>", $package->name, $package->version, $package->description);


		echo "Done.";



	}

}
