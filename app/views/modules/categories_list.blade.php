<!--Display Categories-->
<ul>
@foreach($categories_list as $category)
				<li><a href="{{ URL::to('category-index', array('id'=>$category->id)) }}">{{ $category->category }}</a></p>
@endforeach
</ul>
