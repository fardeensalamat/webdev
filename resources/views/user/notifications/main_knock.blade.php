<li><!-- start message -->
    <a href="#">
      <div class="pull-left">
        <img class="img-rounded" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $knock->knocksBy->userProfilePic ]) }}" alt="User Image">
      </div>



      <h4>
        <span data-url="{{route('userProfile', [$knock->knocksBy->username])}}">
        {{custom_name($knock->knocksBy->selectedName(), 25)}}
        </span>

          @if($knock->accepted)


          <div class="btn-group btn-group-xs pull-right">

          <button type="button" class="btn btn-success pull-right" data-url=""><i class="fa fa-check"></i> Ok</button>

          </div>
          @else

          <div class="btn-group btn-group-xs pull-right">

          <button type="button" class="btn btn-warning pull-right btnKnockReply" data-url="{{route('knockReply', ['knock'=>$knock->id])}}">Ok</button>

          </div>



          @endif


      </h4>
      <p> knocked <i class="fa fa-hand-rock-o w3-large text-green"></i> you {{$knock->total_knock}} {{str_plural('time', $knock->total_knock)}}. Reply ok...

      </p>
    </a>
  </li><!-- end message -->