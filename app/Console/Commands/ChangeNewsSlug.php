<?php

namespace App\Console\Commands;

use App\Models\News;
use App\Models\Redirect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ChangeNewsSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'change_news_slug {oldSlug} {newSlug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates redirect from old slug to new slug';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $oldSlug = $this->argument('oldSlug');
        $newSlug = $this->argument('newSlug');
        if ($oldSlug === $newSlug) {
            $this->error("Old slug and new slug can't be equal");
            return 1;
        }
        if (Redirect::query()
            ->where('old_slug', route('news_item', ['slug' => $oldSlug], false))
            ->where('new_slug', route('news_item', ['slug' => $newSlug], false))
            ->exists()) {
            $this->error("Redirect from $oldSlug to $newSlug already exists");
            return 1;
        }
        $news = News::query()->where('slug', $oldSlug)->first();
        if ($news === null) {
            $this->error("News with slug $oldSlug not found");
            return 1;
        }
        DB::transaction(function () use ($news, $newSlug) {
            Redirect::query()
                ->where('old_slug', route('news_item', ['slug' => $newSlug], false))
                ->delete();
            $news->slug = $newSlug;
            $news->save();
        });
        return 0;
    }
}
