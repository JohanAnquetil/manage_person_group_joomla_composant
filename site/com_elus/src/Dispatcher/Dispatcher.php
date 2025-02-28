<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_elus
 *
 * @copyright   (C) 2024 CGT APF
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Component\Elus\Site\Dispatcher;

use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\Language\Text;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * ComponentDispatcher class for com_elus
 *
 * @since  1.0.0
 */
class Dispatcher extends ComponentDispatcher
{
    /**
     * Dispatch a controller task. Redirecting the user if appropriate.
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function dispatch()
    {
        // Debug - Affichage des informations
        echo '<pre style="background: #fff; color: #000; padding: 10px; margin: 10px; border: 1px solid #ccc;">';
        echo "DEBUG Dispatcher::dispatch()\n";
        echo "View: " . $this->input->get('view', 'elus') . "\n";
        echo '</pre>';

        parent::dispatch();
    }
}