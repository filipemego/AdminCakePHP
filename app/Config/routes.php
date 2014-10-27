<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	foreach(scandir('../View/Pages') as $path){
		if (is_dir('../View/Pages/' . $path)) {
			foreach(scandir('../View/Pages/' . $path) as $subPath){
				if(pathinfo($subPath, PATHINFO_EXTENSION) == "ctp"){
					$name = pathinfo($subPath, PATHINFO_FILENAME);
					Router::connect('/' . $path . '/' .$name, array('controller' => 'pages', 'action' => 'display', $path . '/' . $name));
				}
			}
		} else {
			if(pathinfo($path, PATHINFO_EXTENSION) == "ctp"){
				$name = pathinfo($path, PATHINFO_FILENAME);
				Router::connect('/'.$name, array('controller' => 'pages', 'action' => 'display', $name));
			}
		}
	}

	Router::connect(
		'/:prefix',
		array(
			'controller' => 'pages',
			'action' => 'display',
			'home',
			'prefix' => 'admin',
			'admin' => true,
		),
		array(
			'prefix' => '(?i:admin)'
		)
	);

	Router::connect(
		'/:prefix/',
		array(
			'controller' => 'pages',
			'action' => 'display',
			'home',
			'prefix' => 'admin',
			'admin' => true,
		),
		array(
			'prefix' => '(?i:admin)'
		)
	);

	Router::connect('/:prefix/login', array('controller' => 'users', 'action' => 'login', 'prefix' => 'admin', 'admin' => true));
	Router::connect('/:prefix/logout', array('controller' => 'users', 'action' => 'logout', 'prefix' => 'admin', 'admin' => true));
	

	Router::mapResources('fotos');
	Router::parseExtensions('json');

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
