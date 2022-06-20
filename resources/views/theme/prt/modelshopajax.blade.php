  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-sm-12">

        @include('alerts.alerts')

        <div class="card card-widget">
          <div class="card-header">
            <h3 class="card-title">
              Model Shop
            </h3>
          </div>
         <div class="card-body ">

            <div class="row">
              @foreach($datas as $data)
              <div class="col-md-3 col-6">
                  <a href="{{ $data->link }}">
                      <div class="card">
                          <div class="card-header text-center">
                              <img src="{{ route('imagecache', ['template' => 'pfism', 'filename' => $data->vc()]) }}"
                                                      alt="..." width="130" class="mb-2 img-thumbnail img-fluid">
                          </div>
                          <div class="card-body">
                              <p class="m-0"> <a
                                  href="{{ $data->link }}"
                                  class="btn w3-purple btn-sm btn-block">{{ mb_substr($data->name,0,16) }}..</a></p>
                          </div>
                      
                      </div>
                  </a>
              
              </div>
              @endforeach
          </div>

           

         </div>
       </div>




      </div>
    </div>
    

  </section>
  <!-- /.content -->

