    

    <div class="modal-content w3-round">
            <div class="overlay d-flex justify-content-center align-items-center">
                <i class="fas fa-2x fa-sync fa-spin"></i>
            </div>

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Liked By:</h4>
               
            </div>
            <div class="modal-body">
      <div class="row">

         

        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body chat likers" id="chat-box">

              <ul class="products-list product-list-in-box ">
              <?php $likes = $post->allLikes; ?>
              <div class="likersAuto">
                @include('user.ajax.postLikers')
              </div>

              <div class="loadingLikers" style="display: none;"><span class='load fa fa-refresh fa-spin text-green'></span> Loading...</div>
              <div class="fallback likersAllRender" style="display: none;">
                {!! $likes->render() !!}
              </div>

              </ul>

            </div><!-- /.box-body -->
          </div>
        </div>
      </div>





        </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">&times;</button>
              
            </div>
          </div>
          <!-- /.modal-content -->