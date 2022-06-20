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
                        {{ ucfirst($status) }} works of Job: (ID: <a href=""></a> {{ $job->id }}) {{ $job->title }}
                    </h3>
                </div>
    
                <div class="card-body">
                    @include('admin.job.ajax.allWorks')
                </div>
            </div>
        </div>
    </div>
</section>