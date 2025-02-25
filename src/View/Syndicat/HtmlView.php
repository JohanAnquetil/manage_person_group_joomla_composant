<?php
namespace Joomla\Component\Elus\Administrator\View\Syndicat;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;

class HtmlView extends BaseHtmlView
{
    protected $form;
    protected $item;
    protected $state;

    public function display($tpl = null)
    {
        try {
            $this->form = $this->get('Form');
            
            // Get the Item
            $this->item = $this->get('Item');
            
            // Get the State
            $this->state = $this->get('State');
            
            // Check for errors
            if (count($errors = $this->get('Errors'))) {
            throw new \Exception(implode("\n", $errors), 500);
            }

            $this->addToolbar();
            return parent::display($tpl);
            
        } catch (\Exception $e) {
            var_dump("ERREUR:", $e->getMessage());
            die();
        }
    }

    protected function addToolbar()
    {
        $isNew = ($this->item->id == 0);
        ToolbarHelper::title($isNew ? 'Ajouter un syndicat' : 'Modifier un syndicat');
        ToolbarHelper::save('syndicat.save');
        ToolbarHelper::cancel('syndicat.cancel');
    }
}