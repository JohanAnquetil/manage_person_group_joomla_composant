<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\Log\Log;

// Configuration du système de log de Joomla
Log::addLogger(
    ['text_file' => 'com_elus.php'],
    Log::ALL,
    ['com_elus']
);

// Debug directement dans la page
echo '<pre style="background: #fff; color: #000; padding: 10px; margin: 10px; border: 1px solid #ccc;">';
echo "DEBUG elus.php\n";

try {
    echo "Base path: " . JPATH_COMPONENT . "\n";

    // Utiliser le dispatcher de composant
    $app = Factory::getApplication();
    echo "Application créée\n";

    $component = $app->bootComponent('com_elus');
    echo "Composant chargé : " . get_class($component) . "\n";

    if ($component instanceof ComponentDispatcher) {
        echo "Dispatcher trouvé, exécution...\n";
        $component->dispatch();
    } else {
        echo "ERREUR: Le composant n'est pas un dispatcher\n";
    }

} catch (\Exception $e) {
    Log::add('ERREUR: ' . $e->getMessage(), Log::ERROR, 'com_elus');
    Log::add($e->getTraceAsString(), Log::DEBUG, 'com_elus');
    echo "ERREUR: " . $e->getMessage() . "\n";
    echo "Fichier: " . $e->getFile() . " (Ligne: " . $e->getLine() . ")\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
}

echo '</pre>';