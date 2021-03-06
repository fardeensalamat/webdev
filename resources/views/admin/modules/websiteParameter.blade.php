
    <section class="content-header">
      <h1>
        Website
        <small>Parameters</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Website</a></li>
        <li class="active">Parameters</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content"> 


<!-- Info card -->
      <div class="row">
      <div class="col-md-12">

      @include('alerts.alerts')

        <div class="card card-widget">
            <div class="card-header with-border">
              <h3 class="card-title"><i class="fa fa-th"></i> All Website Parameters</h3>
              {{-- <div class="pull-right">
                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#myModal">Add New Dist Repr.</a>

              </div> --}}

              
            </div>

            <div class="card-body">

              @include('admin.includes.forms.websiteParameterForm')

            </div>

            <div class="card-footer text-center">
              
            </div>
        </div>
        
      </div>        
      </div>
      <!-- /.row -->

    </section>
