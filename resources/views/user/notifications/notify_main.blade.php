

@foreach($mainNtf as $notif)
  @if($notif->knock())
    <?php $knock = $notif->notifiable; ?>
    @include('user.notifications.main_knock')
  @elseif($notif->post())
    <?php
    $post = $notif->notifiable;
    $publish = Auth::user()->publishedTo()->where('publishable_id', $post->id)->where('publishable_type', 'App\Model\Post')->orderBy('id','asc')->first();
    ?>
    @include('user.notifications.main_post')
  @elseif($notif->spread())
    <?php $spread = $notif->notifiable;


    $publish = Auth::user()->publishedTo()->where('publishable_id', $spread->id)->where('publishable_type', 'App\Model\Spread')->orderBy('id','asc')->first();
    ?>
      @if($spread->post())
        <?php $post = $spread->spreadable; ?>
        @if($post->isUserPosted())
          @include('user.notifications.main_spread_post')
        @endif

      @elseif($spread->shop())
        <?php $shop = $spread->spreadable; ?>
        @include('user.notifications.main_spread_shop')
        

      @elseif($spread->product())
      <?php 
      $product = $spread->spreadable;
      $shop = $product->shop;
      ?>
      @include('user.notifications.main_spread_product')


      @endif



  @endif
@endforeach