<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class ElusViewElus extends BaseHtmlView 
{    
    public function display($tpl = null) 
{
    $this->items = $this->get('Items');
    $this->pagination = $this->get('Pagination');
    $this->state = $this->get('State');

    if (empty($this->items)) {
        \JFactory::getApplication()->enqueueMessage('Aucun élu trouvé.', 'warning');
    }

    $this->addToolbar();
    parent::display($tpl);
}


    protected function addToolbar() 
    {
        ToolbarHelper::title('Liste des élus');
        ToolbarHelper::addNew('elu.add');
        ToolbarHelper::editList('elu.edit');
        ToolbarHelper::deleteList('Êtes-vous sûr ?', 'elu.delete');
    }
}
