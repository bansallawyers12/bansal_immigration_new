<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateCrmApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crm:generate-token {email? : Admin user email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an API token for CRM integration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        // If no email provided, ask for it
        if (!$email) {
            $email = $this->ask('Enter the admin user email');
        }

        // Find the user
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email '{$email}' not found.");
            return 1;
        }

        // Check if user is admin
        if (!$user->isAdmin()) {
            $this->error("User '{$email}' is not an admin. Only admin users can generate CRM API tokens.");
            return 1;
        }

        // Generate token name
        $tokenName = $this->ask('Enter a name for this token (e.g., "CRM Integration")', 'CRM Integration - ' . now()->format('Y-m-d'));

        // Generate the token
        $token = $user->createToken($tokenName, ['crm:read'])->plainTextToken;

        $this->newLine();
        $this->info('✓ API Token generated successfully!');
        $this->newLine();
        
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->info('User: ' . $user->name . ' (' . $user->email . ')');
        $this->info('Token Name: ' . $tokenName);
        $this->newLine();
        $this->warn('⚠ IMPORTANT: Save this token now. You won\'t be able to see it again!');
        $this->newLine();
        $this->line('Token:');
        $this->line($token);
        $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->newLine();
        
        $this->comment('Example Usage:');
        $this->line('curl -X GET "https://yourdomain.com/api/crm/appointments" \\');
        $this->line('  -H "Authorization: Bearer ' . $token . '" \\');
        $this->line('  -H "Accept: application/json"');
        $this->newLine();

        return 0;
    }
}

