<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Modules\Posts\Entities\Post;
use Illuminate\Support\Str;
use Modules\Posts\Entities\Category;

use function Laravel\Prompts\text;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch-news {no_of_articles?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news from Laravel News';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $no_of_articles = text('How many articles to download?') ?: 10;

        $home_page_feed = simplexml_load_string(Http::get('https://feed.laravel-news.com/')->body());

        // Delete previously fetched articles to avoid duplicacy
        Post::where('tags', '=', 'laravel-news')->delete();

        // Create a default category, if there are no categories in the system 
        if (Category::get()->count() == 0) {
            $category            = new Category();
            $category->name      = 'News';
            $category->parent_id = 0;
            $category->save();
        }

        $count_of_articles = 0;

        foreach ($home_page_feed->channel->item as $item) {
            if ($no_of_articles != 0 && $count_of_articles < $no_of_articles) {
                $post               = new Post();
                $post->title        = $item->title;
                $post->slug         = Str::slug($item->title);
                $post->tags         = json_encode('laravel-news');
                $post->description  = $item->description;
                $post->category_id  = 1;
                $post->status       = 1;
                $post->created_by   = 1;
                $post->save();
                $count_of_articles++;

                echo $post->title . "\n";
            }
        }
    }
}
