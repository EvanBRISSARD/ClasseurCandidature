<?php
function tauxAcceptation($ToutCandidatures, $ToutCandidatureAcceptee) {
    if (count($ToutCandidatures) === 0) {
        return "N/A"; // Éviter la division par zéro
    }
    $taux = (count($ToutCandidatureAcceptee) / count($ToutCandidatures)) * 100;
    return round($taux, 2) . "%";
    
}

function getEntrepriseParId($id, $entreprises) {
    foreach ($entreprises as $entreprise) {
        if ($entreprise['id'] == $id) {
            return $entreprise;
        }
    }
    return null;
}
function getCandidaturesParEntrepriseId($idEntreprise, $candidatures) {
    $resultat = [];
    foreach ($candidatures as $candidature) {
        if ($candidature['entreprise_id'] == $idEntreprise) {
            $resultat[] = $candidature;
        }
    }
    return $resultat;
}
function formaterDateFr($dateString) {
    if (!$dateString || $dateString == '-') return '-';
    
    $d = new DateTime($dateString);
    return $d->format('d-m-Y');
}