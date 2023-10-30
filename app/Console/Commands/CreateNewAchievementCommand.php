<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class CreateNewAchievementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:achievement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new achievement';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $name = text(
            label: 'What is the name of your achievement?',
            placeholder: 'Eg: 3 Lessons Watched',
            required: true
        );
        $className = text(
            label: 'What is your preferred achievement php class name?',
            placeholder: 'Eg: ThreeLessonsWatched',
            required: true
        );
        $type = select(
            label: 'What role should the user have?',
            options: [
                'lessons'  => 'lessons',
                'comments' => 'comments',
            ],
            default: 'lessons'
        );
        $threshold = text(
            label: 'What is the threshold number of ' . $type . '?',
            placeholder: 'Eg: 20',
            required: true
        );

        $stubVariables = [
            'CLASS_NAME' => $className,
            'NAME'       => $name,
            'THRESHOLD'  => $threshold,
            'TYPE'       => $type,
        ];
        $contents = $this->getStubContents($stubVariables);

        file_put_contents(app_path('Achievements/' . $className . '.php'), $contents);
        $this->info(app_path('Achievements/' . $className . '.php was created'));
    }

    public function getStubContents($stubVariables = [])
    : array|bool|string {
        $contents = file_get_contents(base_path('/app/Stubs/') . 'achievement.stub');

        foreach ($stubVariables as $search => $replace) {

            $contents = str_replace('{{' . $search . '}}', $replace, $contents);
        }

        return $contents;

    }
}
