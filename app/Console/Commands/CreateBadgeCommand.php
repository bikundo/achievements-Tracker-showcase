<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\text;

class CreateBadgeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:badge';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user badge';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = text(
            label: 'What is the name of your Badge?',
            placeholder: 'Eg: 3 Ninja',
            required: true
        );
        $className = text(
            label: 'What is your preferred achievement php class name?',
            placeholder: 'Eg: NinjaBadge',
            required: true
        );
        $threshold = text(
            label: 'What is the threshold number of achievements?',
            placeholder: 'Eg: 20',
            required: true
        );

        $stubVariables = [
            'CLASS_NAME' => $className,
            'NAME'       => $name,
            'THRESHOLD'  => $threshold,
        ];
        $contents = $this->getStubContents($stubVariables);

        file_put_contents(app_path('Badges/' . $className . '.php'), $contents);
        $this->info(app_path('Badges/' . $className . '.php was created'));
    }

    public function getStubContents($stubVariables = [])
    : array|bool|string {
        $contents = file_get_contents(base_path('/app/Stubs/') . 'badge.stub');

        foreach ($stubVariables as $search => $replace) {

            $contents = str_replace('{{' . $search . '}}', $replace, $contents);
        }

        return $contents;

    }
}
