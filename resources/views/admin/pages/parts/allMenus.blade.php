{{-- <section class="content-header">
        <h1>
          Menus
          <small>All</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Menus</a></li>
          <li class="active">All</li>
        </ol>
      </section> --}}
<br>


<!-- Main content -->
<section class="content">




    <!-- Info cardes -->
    <div class="row">
        <div class="col-md-12">

            @include('alerts.alerts')

            <div class="card card-primary">
                <div class="card-header with-border">
                    <h3 class="card-title"><i class="fa fa-th"></i> All Menus</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th style="text-align: left;">Menu Title</th>
                                <th>Menu Type</th>

                                <th>Added By</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($menus as $menu)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td style="text-align: left;">{{ $menu->menu_title }}</td>
                                    <td>
                                        {{ $menu->menu_type }}
                                    </td>

                                    <td>{{ $menu->addedBy->name }}</td>
                                    <td width="100">




                                        <div class="btn-group pull-right btn-group-xs">
                                            <a class="btn btn-primary " href="">Edit</a>
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="ml-2"><a class="btn btn-danger btn-xs "
                                                        onclick="return confirm('Do you want to delete this page?');"
                                                        href="{{ route('common1.menuDelete', $menu) }}">Delete</a>
                                                </li>

                                            </ul>
                                        </div>







                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- <div class="card-footer text-center">
                {{$menus->render()}}
              </div> --}}
            </div>

        </div>
    </div>
    <!-- /.row -->



</section>
