<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class ElusViewElu extends BaseHtmlView
{
    protected $form;

    public function display($tpl = null)
    {
        // Récupérer le formulaire
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        // Ajouter la barre d'outils
        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar()
    {
        ToolbarHelper::title('Gestion d\'un élu');
        ToolbarHelper::save('elu.save');
        ToolbarHelper::cancel('elu.cancel');
    }
}
