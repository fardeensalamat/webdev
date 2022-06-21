
<form class="form-inline" method="get" action="" enctype="multipart/form-data">

<div class="row">                             
                <div class="col-md-4">
                  <div class="form-group">
                  <label for="type">Search by Category:</label>
                  <select id="inputState" class="form-control" name="search_category">
                        <option value="">Select One</option>
                        @foreach ($allCategory as $data)                                        
                            <option value="{{$data->id}}" @if($data->id==$search) selected @endif> {{$data->name}} </option>
                            
                            <?php $gs=$data->name; ?>
                        @endforeach 
      
                    </select>
                                                            
                    </div>
                </div>
                <!-- ------ -->
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="type">Search by Workstation: </label>
                        <select id="inputState" class="form-control" name="search_workstation" >
                            <option value="">Select One</option>
                            @foreach ($allWorkStation as $data)                                        
                                <option value="{{$data->id}}" @if($data->id==$search2) selected @endif> {{$data->title}} </option>
                            @endforeach                         
                        </select>                                          
                    </div>
                </div> 

                <div class="col-md-4">
                <label for="files" style="color: white;">.</label>
                 <div class="form-group">
                 <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white">Search</button>
                 <a href="{{route('user.mediaAll')}}"><input type="submit" class="btn btn-lg btn-danger" value="Reset"></a> <br>
               

                 </div>
                 
              
                 	

</div>
    </form>

  