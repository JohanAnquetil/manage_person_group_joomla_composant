<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;

HTMLHelper::_('behavior.multiselect');
HTMLHelper::_('bootstrap.tooltip');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo Route::_('index.php?option=com_elus'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <table class="table table-striped" id="elusList">
                    <thead>
                        <tr>
                            <th class="w-1 text-center">
                                <?php echo HTMLHelper::_('grid.checkall'); ?>
                            </th>
                            <th scope="col" class="w-1 text-center">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo HTMLHelper::_('searchtools.sort', 'Nom', 'a.nom', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo HTMLHelper::_('searchtools.sort', 'Prénom', 'a.prenom', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo HTMLHelper::_('searchtools.sort', 'Poste', 'a.poste', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo HTMLHelper::_('searchtools.sort', 'Syndicat', 'a.syndicat', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Établissement'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('CSE Local'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Commissions'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Missions Local'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Coordonnées'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Photo'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Fichier'); ?>
                            </th>
                            <th class="w-5 d-none d-md-table-cell">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->items as $i => $item) : 
                        $canEdit = true; // À remplacer par la vérification des permissions
                    ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="text-center">
                                <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                            </td>
                            <td class="text-center">
                                <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'elus.', true); ?>
                            </td>
                            <td>
                                <?php if ($canEdit) : ?>
                                    <a href="<?php echo Route::_('index.php?option=com_elus&task=elu.edit&id=' . $item->id); ?>">
                                        <?php echo $this->escape($item->nom); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo $this->escape($item->nom); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $this->escape($item->prenom); ?></td>
                            <td><?php echo $this->escape($item->poste); ?></td>
                            <td>
                                <?php echo $this->escape($item->syndicat_nom ?? ''); ?>
                            </td>
                            <td><?php echo $this->escape($item->etablissement); ?></td>
                            <td><?php echo $this->escape($item->cse_local); ?></td>
                            <td>
                                <?php echo $this->escape($item->commission_noms ?? ''); ?>
                            </td>
                            <td><?php echo $this->escape($item->missions_local); ?></td>
                            <td><?php echo $this->escape($item->coordonnees); ?></td>
                            <td><?php echo $this->escape($item->photo); ?></td>
                            <td><?php echo $this->escape($item->fichier); ?></td>
                            <td class="d-none d-md-table-cell">
                                <?php echo $item->id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?php echo $this->pagination->getListFooter(); ?>

                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>">
                <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>