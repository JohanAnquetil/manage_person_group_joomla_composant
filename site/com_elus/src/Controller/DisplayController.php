<?php

namespace Joomla\Component\Elus\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_elus
 */
class DisplayController extends BaseController 
{
    public function display($cachable = false, $urlparams = array()) 
    {        
        // Debug - Affichage des informations
        echo '<pre style="background: #fff; color: #000; padding: 10px; margin: 10px; border: 1px solid #ccc;">';
        echo "DEBUG DisplayController::display()\n";
        echo "JPATH_COMPONENT: " . JPATH_COMPONENT . "\n";
        echo "Classe du controller: " . get_class($this) . "\n";

        try {
            $document = Factory::getDocument();
            echo "Document créé\n";
            
            $viewName = $this->input->getCmd('view', 'elus');
            echo "Vue demandée: " . $viewName . "\n";
            
            $viewFormat = $document->getType();
            echo "Format de vue: " . $viewFormat . "\n";
            
            $view = $this->getView($viewName, $viewFormat);
            if ($view) {
                echo "Vue créée avec succès\n";
                $view->document = $document;
                $view->display();
            } else {
                echo "ERREUR: Impossible de créer la vue\n";
            }
        } catch (\Exception $e) {
            echo "ERREUR: " . $e->getMessage() . "\n";
            echo "Fichier: " . $e->getFile() . " (Ligne: " . $e->getLine() . ")\n";
            echo "Trace:\n" . $e->getTraceAsString() . "\n";
        }
        echo '</pre>';
    }
}