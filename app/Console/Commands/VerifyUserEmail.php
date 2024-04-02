<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

use function Laravel\Prompts\text;

class VerifyUserEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "user:verify-email {email?}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Verify given user email address";

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email =
            $this->argument("email") ??
            text(
                label: "What is user email?",
                required: true,
                hint: "Enter existing user email address"
            );

        /** @var User $user */
        if (!($user = User::where("email", $email)->first())) {
            $this->error("\nIndefined user with email: {$email}");
            $this->line("\n");

            return Command::FAILURE;
        }

        try {
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }

        $this->info("\nUser email address have been verified.\n");

        return Command::SUCCESS;
    }
}
