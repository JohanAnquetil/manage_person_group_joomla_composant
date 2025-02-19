<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Controller\BaseController;

$app = Factory::getApplication();
$input = $app->input;

ComponentHelper::getComponent('com_elus');

$controller = $input->getCmd('controller', 'elus');
$controllerClass = 'ElusController' . ucfirst($controller);
$controllerPath = __DIR__ . '/controllers/' . strtolower($controller) . '_controller.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
}

if (!class_exists($controllerClass)) {
    $controllerClass = 'ElusController';
    require_once __DIR__ . '/controllers/elus_controller.php';
}

$controller = new $controllerClass();
$controller->execute($input->get('task'));
$controller->redirect();
