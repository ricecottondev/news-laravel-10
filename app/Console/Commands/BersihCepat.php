<?php

namespace App\Console\Commands;


use App\Models\Product;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class BersihCepat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bersih:cepat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info("Command Clear Is Starting!");
        $this->info('Command Clear Is Starting!');

        Artisan::call('optimize:clear');
        Artisan::call('config:cache');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');

        Log::info("Command Clear is done!");
        $this->info('Command Clear is done!');

        Log::info("Command Caching is Starting!");
        $this->info('Command Caching is Starting!');

        Artisan::call('view:cache');
        // Artisan::call('config:cache');

        Log::info("Command Caching is done!");
        $this->info('Command Caching is done!');

        Log::info("Model Caching Starting!");
        $this->info('Model Caching Starting!');

        // Artisan::call('app:model-cache');
        // $this->modelCache();

        Log::info("Model Caching is done!");
        $this->info('All models have been cached successfully.');
    }

    public function modelCache()
    {
        // Product::all();
        // $this->info('Models Product have been cached successfully');


    }
}
