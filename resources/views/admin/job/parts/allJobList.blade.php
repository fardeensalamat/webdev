<section class="content">
    <br>
    <div class="row">

<style>
  tr.nowrap td {
       white-space:nowrap;
   }

   tr.nowrap th {
       white-space:nowrap;
   }
</style>

      
        <div class="col-sm-12">
          @include('alerts.alerts')
  
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        All Job List
                    </h3>

                    <div class="card-tools">
                        <form action="">

                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text"
                                    data-url="{{ route('admin.searchAjax', ['type' => 'job', 'status' => isset($status) ? $status : null]) }}"
                                    class="form-control ajax-data-search" placeholder="Search Job by ID">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary w3-border">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
    
                <div class="card-body">
                    @include('admin.job.ajax.allJobs')
                </div>
            </div>
        </div>
    </div>
</section>