<?php
namespace Joomla\Component\Elus\Administrator\View\Syndicats;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView 
{    
    protected $items;
    protected $pagination;
    protected $state;
    protected $form;

    public function display($tpl = null) 
    {
        // Debug pour voir si la vue est chargée
        Factory::getApplication()->enqueueMessage('Debug: Vue Syndicats chargée', 'notice');

        try {
            $this->items = $this->get('Items');
            $this->pagination = $this->get('Pagination');
            $this->state = $this->get('State');

            // Vérification des erreurs
            if (count($errors = $this->get('Errors'))) {
                throw new \Exception(implode("\n", $errors));
            }

            // Ajout de la barre d'outils
            $this->addToolbar();

            // Affichage du template
            return parent::display($tpl);

        } catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage($e->getMessage(), 'error');
            return false;
        }
    }

    protected function addToolbar() 
    {
        ToolbarHelper::title(Text::_('Liste des syndicats'), 'list');
        ToolbarHelper::addNew('syndicat.add');
        ToolbarHelper::editList('syndicat.edit');
        ToolbarHelper::deleteList('', 'syndicat.delete');
    }
}