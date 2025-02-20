<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class ElusViewElus extends BaseHtmlView
{
    protected $items;
    protected $pagination;
    protected $state;

    public function display($tpl = null)
    {
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->state = $this->get('State');

        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        ToolbarHelper::title('Gestion des élus');
        ToolbarHelper::addNew('elu.add');
        ToolbarHelper::editList('elu.edit');
        ToolbarHelper::deleteList('Êtes-vous sûr de vouloir supprimer ?', 'elu.delete');
    }
}
