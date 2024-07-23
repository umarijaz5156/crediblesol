<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SetupController extends Controller
{
    public function lastStep(Request $request)
    {
        $summary = $request->summary;
        $summary = json_decode($summary, true);

        ini_set('max_execution_time', 600); //600 seconds = 10 minutes 

        try {
            $redirectPath = route('setup.finish');

            $this->changeEnv($summary);

            Artisan::call('config:cache');
            Artisan::call('config:clear');

            Artisan::call('migrate:fresh', [
                '--force' => true,
                '--seed' => true,
            ]);

            Artisan::call('storage:link');

            Storage::disk('public')->put('installed', 'Contents');

            return redirect()->to($redirectPath);
        } catch (\Throwable $th) {
            return $this->addError('error', 'Something went wrong, Please try again');
        }
    }

    public function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/(\r\n|\n|\r)/', $env);

            // Loop through given data
            foreach ((array) $data as $key => $value) {

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        if ($value !== null) {

                            $env[$env_key] = $key . "=" . $value;
                        }
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            return true;
        } else {
            return false;
        }
    }
}
