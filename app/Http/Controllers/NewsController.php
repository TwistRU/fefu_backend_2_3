<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getList()
    {
        $news = News::query()
            ->Where([
                ['is_published', true],
                ['published_at', '<=', 'NOW()']
            ])
            ->OrderByDesc('published_at')
            ->OrderByDesc('id')
            ->Paginate(5);
        return view('news_list', ['news' => $news]);
    }

    public function getDetails(string $slug)
    {
        $news_item = News::query()
            ->Where([
                ['slug', $slug],
                ['is_published', true],
                ['published_at', '<=', 'NOW()']
            ])
            ->First();
        if ($news_item === null) {
            abort(404);
        }
        return view('news_item', ['news_item' => $news_item]);
    }
}
