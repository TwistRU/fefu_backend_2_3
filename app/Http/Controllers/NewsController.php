<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function getList()
    {
        $news = News::Query()
            ->Where([
                ['is_published', true],
                ['published_at', '<=', 'NOW()']
            ])
            ->OrderBy('published_at', 'desc')
            ->OrderBy('id', 'desc')
            ->Paginate(5);
        return view('news_list', ['news' => $news]);
    }

    public function getDetails(string $slug)
    {
        $news_item = News::Query()
            ->Where('slug', $slug)
            ->Where('is_published', true)
            ->Where('published_at', '<=', 'NOW()>')
            ->First();
        if ($news_item === null) {
            abort(404);
        }
        return view('news_item', ['news_item' => $news_item]);
    }
}
