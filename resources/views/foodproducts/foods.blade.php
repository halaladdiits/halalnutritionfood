@foreach($foodproducts as $foodproduct)
    <div class="list-group">
        <a href="#" class="list-group-item">
            <h4 class="list-group-item-heading">{{ $foodproduct->fname }}</h4>
            <p class="list-group-item-text">Food Code: Food by {{ $foodproduct->fmanufacture }}</p>
        </a>
    </div>
@endforeach
<div class="pagination pagination-sm"> {!! $foodproducts->render() !!}</div>