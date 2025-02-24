<?php
namespace Joomla\Component\Elus\Administrator\View\Elu;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView
{
    protected $form;

    public function display($tpl = null)
    {
        $this->form = $this->get('Form');
        $this->addToolbar();
        parent::display($tpl);
    }

    protected function addToolbar()
    {
        ToolbarHelper::title('Ajouter un élu');
        ToolbarHelper::save('elu.save');
        ToolbarHelper::cancel('elu.cancel');
    }
}
