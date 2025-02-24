<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
?>

<form action="<?php echo Route::_('index.php?option=com_elus&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="elu-form" class="form-validate">

    <div class="row">
        <div class="col-md-12">
            <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details']); ?>
            <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('Détails de l\'élu')); ?>

            <div class="form-group">
                <?php echo $this->form->renderField('syndicat'); ?>
                <?php echo $this->form->renderField('nom'); ?>
                <?php echo $this->form->renderField('prenom'); ?>
                <?php echo $this->form->renderField('poste'); ?>
                <?php echo $this->form->renderField('etablissement'); ?>
                <?php echo $this->form->renderField('commissions'); ?>
                <?php echo $this->form->renderField('missions_local'); ?>
                <?php echo $this->form->renderField('cse_local'); ?>
                <?php echo $this->form->renderField('coordonnees'); ?>
                <?php echo $this->form->renderField('photo'); ?>
                <?php echo $this->form->renderField('fichier'); ?>
            </div>

            <?php echo HTMLHelper::_('uitab.endTab'); ?>
            <?php echo HTMLHelper::_('uitab.endTabSet'); ?>

            <!-- Champ caché pour l'ID -->
            <input type="hidden" name="jform[id]" value="<?php echo (int) $this->item->id; ?>" />

            <!-- Boutons d'action -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <?php echo Text::_('Enregistrer'); ?>
                </button>
                <a href="<?php echo Route::_('index.php?option=com_elus&view=elus'); ?>" class="btn btn-secondary">
                    <?php echo Text::_('Annuler'); ?>
                </a>
            </div>
        </div>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
