<?php

namespace matacms\manager\controllers;

use Yii;
use matacms\controllers\base\AuthenticatedController;
use Composer\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;


/**
 * ContentBlockController implements the CRUD actions for ContentBlock model.
 */
class ManagerController extends AuthenticatedController {


	public function actionIndex() {



		// Composer\Factory::getHomeDir() method 
		// needs COMPOSER_HOME environment variable set
		putenv('COMPOSER_HOME=' . Yii::getAlias("@vendor") . '/bin/composer');

		// call `composer install` command programmatically
		// $input = new ArrayInput(array('command' => 'install'));
		$application = new Application();

		$application->getLongVersion();
		exit;
		$application->setAutoExit(false); // prevent `$application->run` method from exitting the script
		$application->run($input);

		echo "Done.";



	}

}
