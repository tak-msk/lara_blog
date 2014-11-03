<!--Latest Articles-->
<ul>
@foreach($latest_articles as $article)
				<li><a href="{{ URL::to('article', array('id'=>$article->id)) }}">{{ $article->title }}</a></li>
@endforeach
</ul>
