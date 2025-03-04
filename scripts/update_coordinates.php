<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class ElusCoordinatesUpdater
{
    public static function updateCoordinates()
    {
        $db = Factory::getDbo();
        
        // Récupérer tous les élus avec leurs villes
        $query = $db->getQuery(true)
            ->select(['id', 'ville'])
            ->from($db->quoteName('#__elus'))
            ->where($db->quoteName('ville') . ' IS NOT NULL');
        
        $db->setQuery($query);
        $elus = $db->loadObjectList();

        foreach ($elus as $elu) {
            if (!empty($elu->ville)) {
                // Extraire le nom de la ville et le code postal
                preg_match('/^([^(]+)\s*\((\d+)\)/', $elu->ville, $matches);
                if (count($matches) === 3) {
                    $ville = trim($matches[1]);
                    $codePostal = $matches[2];

                    // Appeler l'API geo.gouv.fr
                    $url = "https://geo.api.gouv.fr/communes?nom=" . urlencode($ville) . "&fields=nom,centre,codesPostaux&limit=1";
                    $response = file_get_contents($url);
                    $data = json_decode($response);

                    if (!empty($data) && isset($data[0]->centre)) {
                        // Mettre à jour les coordonnées
                        $query = $db->getQuery(true)
                            ->update($db->quoteName('#__elus'))
                            ->set([
                                $db->quoteName('latitude') . ' = ' . $data[0]->centre->coordinates[1],
                                $db->quoteName('longitude') . ' = ' . $data[0]->centre->coordinates[0]
                            ])
                            ->where($db->quoteName('id') . ' = ' . (int)$elu->id);

                        $db->setQuery($query);
                        $db->execute();

                        // Attendre 100ms entre chaque requête
                        usleep(100000);
                    }
                }
            }
        }
    }
}

// Exécuter la mise à jour
ElusCoordinatesUpdater::updateCoordinates();