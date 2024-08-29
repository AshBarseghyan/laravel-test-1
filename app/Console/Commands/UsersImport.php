<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UsersImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:import';

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
        // Get the file path
        // TODO: we can also pass the file path as an argument of the command
        $filePath = public_path('convertcsv.csv');

        // Check if file exists
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return;
        }

        // Open the file for reading
        if (($handle = fopen($filePath, 'r')) !== false) {
            // Read the header row
            $header = fgetcsv($handle);

            // Process each row of the CSV file
            while (($row = fgetcsv($handle)) !== false) {
                $userData = array_combine($header, $row);

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
