<?php

namespace App\Console\Commands;

use App\Models\Dictionary;
use Illuminate\Console\Command;

class InsertDictionaryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:dictionary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Start');
        Dictionary::truncate();

        $bar = $this->output->createProgressBar(17692);
        $bar->start();


        $file = storage_path('old_interslavic_words_list.csv');
        $i = 0;
        if (($handle = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                if ($i === 0) {
                    $i++;
                    continue;
                }

                if (!isset($data[4])) {
                    dump($data);
                    continue;
                }

                $model = new Dictionary();
                $model
                    ->setEnglish($data[4])
                    ->setInterslavic($data[0])
                    ->save();

                $bar->advance();
            }
            fclose($handle);
        }
        $bar->finish();
        
        $this->info('End');

        return 0;
    }
}
