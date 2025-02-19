<!-- 
<h1>Ajouter un élu</h1>
<form action="index.php?option=com_elus&task=elus.save" method="post" enctype="multipart/form-data">
    <div>
        <label for="syndicat">Syndicat :</label>
        <select name="syndicat" required>
            <option value="CFDT">CFDT</option>
            <option value="CGT">CGT</option>
            <option value="FO">FO</option>
        </select>
    </div>

    <div>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>
    </div>

    <div>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>
    </div>

    <div>
        <label for="poste">Poste :</label>
        <input type="text" name="poste" required>
    </div>

    <div>
        <label for="etablissement">Établissement :</label>
        <input type="text" name="etablissement" required>
    </div>

    <div>
        <label for="commissions">Commissions :</label><br>
        <input type="checkbox" name="commissions[]" value="economique"> Économique
        <input type="checkbox" name="commissions[]" value="emploi formation"> Emploi Formation
        <input type="checkbox" name="commissions[]" value="égalité pro"> Égalité Pro
        <input type="checkbox" name="commissions[]" value="CSSCT"> CSSCT
    </div>

    <div>
        <label for="missions_local">Missions locales :</label>
        <input type="text" name="missions_local" required>
    </div>

    <div>
        <label for="cse_local">Nom du CSEE :</label>
        <input type="text" name="cse_local" required>
    </div>

    <div>
        <label for="coordonnees">Coordonnées :</label>
        <input type="text" name="coordonnees">
    </div>

    <div>
        <label for="photo">Photo :</label>
        <input type="file" name="photo">
    </div>

    <input type="submit" value="Enregistrer">
</form> -->

<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');
?>

<form action="<?php echo Route::_('index.php?option=com_elus&task=elu.save'); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">
    <fieldset>
        <?php foreach ($this->form->getFieldset('details') as $field) : ?>
            <div class="control-group">
                <div class="control-label">
                    <?php echo $field->label; ?>
                </div>
                <div class="controls">
                    <?php echo $field->input; ?>
                </div>
            </div>
        <?php endforeach; ?>

        <input type="hidden" name="task" value="elu.save" />
        <?php echo HTMLHelper::_('form.token'); ?>
    </fieldset>
</form>
