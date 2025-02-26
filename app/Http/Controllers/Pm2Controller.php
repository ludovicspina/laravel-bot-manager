<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Pm2Controller extends Controller
{
    public function index()
    {
        $process = new Process(['pm2', 'jlist']);
        $process->run();

        // Vérifier si l'exécution a échoué
        if (!$process->isSuccessful()) {
            return response()->json([
                'error' => 'Échec de l’exécution de la commande PM2',
                'output' => $process->getErrorOutput(),
            ]);
        }

        // Récupérer la sortie brute
        $output = $process->getOutput();

        // Vérifier si la sortie est vide
        if (empty($output)) {
            return response()->json([
                'error' => 'La commande PM2 n’a retourné aucune sortie',
            ]);
        }

        // Essayer de décoder le JSON
        $pm2Processes = json_decode($output, true);

        // Vérifier si la conversion JSON a échoué
        if ($pm2Processes === null) {
            return response()->json([
                'error' => 'Impossible de décoder le JSON',
                'raw_output' => $output,
                'json_last_error' => json_last_error_msg(),
            ]);
        }

        return view('pm2.index', compact('pm2Processes'));
    }
}
