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
            throw new ProcessFailedException($process);
        }

        // Décoder la sortie JSON de PM2
        $pm2Processes = json_decode($process->getOutput(), true);

        return view('pm2.index', compact('pm2Processes'));
    }
}
