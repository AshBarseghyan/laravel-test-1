<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ImportUsersTest extends TestCase
{
    /** @test */
    public function it_imports_users_from_csv()
    {
        // Prepare a temporary CSV file
        $csvFile = 'test-users.csv';
        file_put_contents($csvFile, "name,email,password\nAshot,abn@example.com,Asd123456+");

        // Run the import command
        Artisan::call('users:import', ['file' => $csvFile]);

        // Check if user was inserted
        $user = DB::table('users')->where('email', 'abn@example.com')->first();
        $this->assertNotNull($user);
        $this->assertEquals('Ashot', $user->name);
        $this->assertTrue(Hash::check('Asd123456+', $user->password));

        // Clean up
        unlink($csvFile);
    }
}
