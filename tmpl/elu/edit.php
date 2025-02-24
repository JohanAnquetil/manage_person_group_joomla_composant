<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

$app = Factory::getApplication();
$input = $app->input;

$wa = $this->document->getWebAssetManager();
$wa->usePreset('choicesjs')
   ->useScript('com_elus.ville-autocomplete')
   ->useStyle('com_elus.ville-autocomplete-css');
$wa->useScript('keepalive')
    ->useScript('form.validate');

$layout  = 'edit';
$tmpl = $input->get('tmpl', '', 'cmd') === 'component' ? '&tmpl=component' : '';
$id = $input->getInt('id', 0);
?>

<form action="<?php echo Route::_('index.php?option=com_elus&layout=' . $layout . $tmpl . '&id=' . $id); ?>"
    method="post" name="adminForm" id="elu-form" class="form-validate">

    <?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

    <div class="main-card">
        <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'details')); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('Détails')); ?>
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <?php echo $this->form->renderField('id'); ?>
                        <?php echo $this->form->renderField('nom'); ?>
                        <?php echo $this->form->renderField('prenom'); ?>
                        <?php echo $this->form->renderField('poste'); ?>
                        <?php echo $this->form->renderField('syndicat'); ?>
                        <?php echo $this->form->renderField('etablissement'); ?>
                        <?php echo $this->form->renderField('commissions'); ?>
                        <?php echo $this->form->renderField('missions_local'); ?>
                        <?php echo $this->form->renderField('cse_local'); ?>
                        <?php echo $this->form->renderField('coordonnees'); ?>
                        <?php echo $this->form->renderField('ville'); ?>
                        <?php echo $this->form->renderField('photo'); ?>
                        <?php echo $this->form->renderField('fichier'); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <?php echo LayoutHelper::render('joomla.edit.global', $this); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.endTabSet'); ?>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
