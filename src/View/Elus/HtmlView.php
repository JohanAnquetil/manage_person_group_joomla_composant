<?php
namespace Joomla\Component\Elus\Administrator\View\Elus;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView 
{    
    /**
     * @var array
     */
    protected $items;

    /**
     * @var \Joomla\CMS\Pagination\Pagination
     */
    protected $pagination;

    /**
     * @var \Joomla\Registry\Registry
     */
    protected $state;

    public function display($tpl = null) 
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        if (empty($this->items)) {
            Factory::getApplication()->enqueueMessage('Aucun élu trouvé.', 'warning');
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