 

<section class="content">
 
 <br>

    <div class="row">
        <div class="col-sm-12">

          @include('alerts')

          <div class="card card-primary">

            <div class="card-header with-border">
              <h3 class="card-title"><i class="fa fa-plus"></i> Add New Category</h3>
            </div>

            <div class="card-body">

              <div class="card card-widget mb-0">
                <div class="card-body w3-gray ">


                  <div class="card card-widget mb-0">
                    <div class="card-body">

                      <form class="form-inline text-center" method="post" action="{{route('admin.categoryAddNewPost')}}">

  {{ csrf_field() }}
  
  <div class="form-group {{ $errors->has('category') ? ' has-error' : '' }}">
    <label for="email">Category Name</label> &nbsp;
    <input type="text" name="category" class="form-control" value="{{old('category')}}" id="category" placeholder="Category Name" autocomplete="off">
      @if ($errors->has('category'))
        <span class="help-block">
            <strong>{{ $errors->first('category') }}</strong>
        </span>
    @endif
  </div>

  &nbsp;
  
  <button type="submit" class="btn btn-primary">Submit New Category</button>
</form>
                      

                

                    </div>
                  </div>
                  

                </div>
              </div>
            </div>

          </div>
 







<div class="card card-primary">

  <div class="card-header with-border">
    <h3 class="card-title"><i class="fa fa-list"></i> All Categories</h3>
  </div>

  <div class="card-body">

    <div class="card card-widget mb-0">
      <div class="card-body w3-gray ">


        <div class="card card-widget mb-0">
          <div class="card-body table-responsive ">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 50px;">ID</th>
                    <th >Category Name</th>
                    <th style="width: 150px;">Action</th>
                  </tr>
                </thead>                
              </table>

  


        <div class="row">
        <div id="sortablePanel" class="col-md-12 connectedSortable" data-url="{{route('admin.catSort')}}">

          @foreach($cats as $key => $cat)

          <div id="{{$cat->id}}" class="card card-widget card-panel mb-1">
            <div class="card-body table-responsive pt-0"style="min-height: 60px;">

             

             <table class="table table-sm table-cat">
                      @include('admin.categories.ajax.catTable')
                    </table>


             <table class="table table-sm table-subcat-new" style="display: none;">
              @include('admin.categories.ajax.subcatNewInput')
            </table>

              

            <div class="subcat-area">
            @include('admin.categories.ajax.subcatTable')
            </div>

            </div>

            {{-- <div class="card-footer w3-light-gray">
              Hi
            </div> --}}



          </div>

          @endforeach
        </div>
      </div>
        

      </div>
    </div>
 

              
  
 
          </div>         
        </div>
 </div>
</div>
</div>
</div>
 
  </section>