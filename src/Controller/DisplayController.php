<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class DisplayController extends BaseController
{
    /**
     * Vue par défaut du composant
     *
     * @var    string
     */
    protected $default_view = 'elus';

    /**
     * Méthode pour afficher la vue par défaut.
     *
     * @param   bool    $cachable   Si la vue doit être mise en cache.
     * @param   array   $urlparams  Paramètres de l'URL.
     *
     * @return  void
     */
    public function display($cachable = false, $urlparams = [])
    {
        // Par défaut, affiche la vue "elus"
        $view = $this->input->getCmd('view', 'elus');
        $this->input->set('view', $view);

        // Exécute l'affichage
        parent::display($cachable, $urlparams);
    }
}
