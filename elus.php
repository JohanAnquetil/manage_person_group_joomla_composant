<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

// Vérification des droits d'accès
if (!Factory::getUser()->authorise('core.manage', 'com_elus'))
{
    throw new \Exception(Text::_('JERROR_ALERTNOAUTHOR'), 403);
}

// Initialisation de l'application
$app    = Factory::getApplication();
$input  = $app->input;
$task   = $input->get('task', 'display');

// Chargement du contrôleur principal (DisplayController)
$controller = BaseController::getInstance('Display', ['base_path' => JPATH_COMPONENT_ADMINISTRATOR]);

// Exécution de la tâche
$controller->execute($task);
$controller->redirect();

// Enregistrement des services pour Joomla 5
return new class implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Joomla\\Component\\Elus'));
        $container->registerServiceProvider(new MVCFactory('\\Joomla\\Component\\Elus'));

        $container->set(
            ComponentDispatcherFactoryInterface::class,
            fn(Container $container) => $container->get(ComponentDispatcherFactory::class)
        );

        $container->set(
            MVCFactoryInterface::class,
            fn(Container $container) => $container->get(MVCFactory::class)
        );
    }
};
