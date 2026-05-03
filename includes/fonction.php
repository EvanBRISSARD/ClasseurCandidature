<?php
function tauxAcceptation($ToutCandidatures, $ToutCandidatureAcceptee) {
    if (count($ToutCandidatures) === 0) {
        return "N/A"; // Éviter la division par zéro
    }
    $taux = (count($ToutCandidatureAcceptee) / count($ToutCandidatures)) * 100;
    return round($taux, 2) . "%";
    
}