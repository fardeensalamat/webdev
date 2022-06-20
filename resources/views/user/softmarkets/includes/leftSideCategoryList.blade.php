
  <div class="list-group p-0 list-group-flush"> 
    @foreach($categories as $category)
    <a href="{{ route('user.softmarketSearch',['category'=>$category->id]) }}" class="list-group-item list-group-item-action px-1 py-2 @if (isset($selectedCat)) {{ $selectedCat->id == $category->id ? 'active':null }} @endif "> {{ $loop->iteration }} {{ $category->name }} </a>                
    @endforeach
 </div>
