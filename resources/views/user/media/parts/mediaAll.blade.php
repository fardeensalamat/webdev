   
    <!-- Content Header (Page header) -->
{{--     <section class="content-header">
      <h1>
        Media
        <small>All</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Media</a></li>
        <li class="active">All </li>
        
      </ol>
    </section> --}}

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-12">

          @include('alerts.alerts')

          <div class="card card-widget">
           <div class="card-body text-center">

             @include('user.media.includes.forms.mediaUploadForm')

           </div>
         </div>

          <div class="card card-widget">
            <div class="card-header">
              <h3 class="card-title">
              <?php 
               $ans='';
                   if($searchGoogle){
                    $ans = $searchGoogle->name;
                   }
                   
                  ?> 
                Media All  <a href="https://www.google.com/search?q={{$ans}}"><input class="btn  btn-success" value="Search in Google"></a> <br>
              </h3>
            </div>
           <div class="card-body ">

            <div class="card card-widget">
              <div class="card-body" style="background-color: #ccc;">
                @include('user.media.includes.others.mediaAll')
              
              </div>
            </div>

             

           </div>
         </div>




        </div>
      </div>
      

    </section>
    <!-- /.content -->

