<html lang="ru">
<body>
<a href="{{route('news_list')}}">Новости</a>
<h1>Название статьи - {{$news_item->title}}</h1>
<p>Дата-время публикации {{$news_item->published_at}}</p>
<p>Содержание статьи<br>{{$news_item->text}}</p>
</body>
</html>
