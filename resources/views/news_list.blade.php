<html lang="ru">
<body>
<h1>Новости</h1>
@foreach($news as $i => $news_item)
    <p>
        Название статьи -
        <a href="{{route('news_item', ['slug' => $news_item->slug])}}">
            <b>{{$news_item->title}}</b>
        </a>
    </p>
    <p>Дата-время публикации - {{$news_item->published_at}}</p>
    @if($news_item->description !== null)
        <p>Описание - {{$news_item->description}}</p>
    @endif
    <hr>
@endforeach
{{$news->links()}}
</body>
</html>
