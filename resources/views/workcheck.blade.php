<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <div class="data_check">
        <div class="productItemShow">

	</div>
    </div>


	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        getLocation();
        function getLocation(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(showPosition,errorMassage);
            }else{
                alert('Browser Not Supporting');
            }
        }
        function errorMassage(error){
            alert(error.message);
        }
        function showPosition(position){
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;
            console.log(lat);
            console.log(lon);

            axios.post('/getProduct',{
                lat:lat,
                lon:lon,
            })
            .then(function(response){
                let jsonData = response.data; 
                console.log(jsonData);
                $.each(jsonData, function(i,item){
                    $('<div class="col-lg-3 mb-4">').html(
                        '<div class="puduct-item border">'+
                                '<div class="product-content py-3 px-2">'+
                                    '<h1>'+jsonData[i].name+'</h1>'+
                                '</div>'+
                            '</div>'
                    ).appendTo('.productItemShow');
                })
            })  
            .catch(function(error){
                console.log('Error')
            })
        }



    </script>
</body>
</html>



{{-- public function dashboard()
{
    if (Auth::check()) {
        $ids = Subscriber::where('user_id', Auth::id())->groupBy('category_id')->pluck('id');
        if ($ids) {
            $t =  DB::table('subscribers')
                ->where('user_id', Auth::id())
                ->where('active', true)
                ->whereNotIn('id', $ids)
                ->update([
                    'active' => false
                ]);
        }
    }
    $request = request();
    $request->session()->forget(['lsbm', 'lsbsm']);
    $request->session()->put(['lsbm' => 'dashboard', 'lsbsm' => 'dashboard']);
    $user = Auth::user();
    $subscriber = Subscriber::where('user_id', $user->id)->first();

    // $shops = ServiceProfile::where('profile_type', 'business')->where('status', 1)->has('isOrderTrue')->has('liveProducts')->simplePaginate(24);

    $lat = $user->lat ?: 23.792433799999998;
    $lng = $user->lng ?: 90.4266676;
    $number = filter_var($request->radius, FILTER_SANITIZE_NUMBER_INT);
    $radius = $number ? (int) $number : 3000;
    if ($lat and $lng) {
        $haversine = "(6371 * acos(cos(radians(" . $lat . ")) 
                    * cos(radians(`lat`)) 
                    * cos(radians(`lng`) 
                    - radians(" . $lng . ")) 
                    + sin(radians(" . $lat . ")) 
                    * sin(radians(`lat`))))";
    }

    $shops = ServiceProfile::select('id', 'lat', 'lng', 'workstation_id', 'ws_cat_id', 'subscriber_id', 'user_id', 'name', 'email', 'mobile', 'img_name', 'cover_image', 'address', 'short_bio', 'zip_code', 'city', 'country', 'status','paystatus', 'profile_type', 'addedby_id', 'open', 'fixed_location', 'package_status')
        ->where('profile_type', 'business', 'expired_at')
        ->where('status', 1)
        ->where('paystatus',1)
        ->where(function ($q) {
            $q->where('expired_at', '>=', Carbon::now()->today());
            $q->orWhere('expired_at', null);
        })
        // ->has('isOrderTrue')
        // ->has('liveProducts')
        // ->whereRaw("{$haversine} < ?", [$radius])
        ->selectRaw("{$haversine} AS distance")
        ->latest()
        ->orderBy('distance')
        ->paginate(8);
        //dd($shops);

    return view('user.dashboard', [
        'user' => $user,
        // 'biz_profiles' => $biz_profile,
        'subscriber' => $subscriber,
        'shops' => $shops
    ]);
} --}}
