<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UsersImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:import {file=public/convertcsv.csv : The CSV file path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users from a CSV file, which contains the user data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the file path from the argument
        $filePath = $this->argument('file');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return;
        }

        // Open the file for reading
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Read the header row
            $header = fgetcsv($handle);

            // Check if header is valid
            if (!$header || !in_array('email', $header)) {
                $this->error('Invalid CSV format.');
                fclose($handle);
                return;
            }

            // Process each row of the CSV file
            while (($row = fgetcsv($handle)) !== false) {
                $userData = array_combine($header, $row);

                // Handle password hashing
                if (isset($userData['password'])) {
                    $userData['password'] = Hash::make($userData['password']);
                }

                // Update or create user
                User::updateOrCreate(['email' => $userData['email']], $userData);

                // Output to console
                $this->info('Importing user: ' . $userData['email']);
            }

            // Close the file handle
            fclose($handle);
        } else {
            $this->error("Failed to open the file: {$filePath}");
        }

        $this->info('User import completed successfully.');
    }
}
