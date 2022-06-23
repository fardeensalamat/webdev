@extends('user.layouts.userMaster')

@section('content')
    <br>

    <style>
        #video {
            border: 1px solid black;
            box-shadow: 2px 2px 3px black;
            width:320px;
            height:240px;
        }

        #photo {
            border: 1px solid black;
            box-shadow: 2px 2px 3px black;
            width:320px;
            height:240px;
        }

        #canvas {
            display:none;
        }

        .camera {
            width: 340px;
            display:inline-block;
        }

        .output {
            width: 340px;
            display:inline-block;
            vertical-align: top;
        }

        #startbutton {
            display:block;
            position:relative;
            margin-left:auto;
            margin-right:auto;
            bottom:32px;
            background-color: rgba(0, 150, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0px 0px 1px 2px rgba(0, 0, 0, 0.2);
            font-size: 14px;
            font-family: "Lucida Grande", "Arial", sans-serif;
            color: rgba(255, 255, 255, 1.0);
        }

        .contentarea {
            font-size: 16px;
            font-family: "Lucida Grande", "Arial", sans-serif;
            width: 760px;
        }

    </style>
    <section class="content">
        @include('alerts.alerts')
        <div class="card bg-info">
            <div class="card-body">
                <h3>{{__('employeeReport.add_report')}}</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('user.storeemployeereport') }}" method="POST" id='my-form' enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">{{__('employeeReport.type')}}</label>

                                              <select id="inputState" class="form-control" name="type">
                                                     <option>Official</option>
                                                     <option>Marketing</option>
                                              </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Date</label>
                                            <input  type="date" class="form-control" name="date">

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{__('employeeReport.note')}}</label><br>
                                            <textarea name="note" type="text" class="form-control" id="" cols="45" rows="3"></textarea>


                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{__('employeeReport.specialnote')}}</label><br>
                                            <textarea name="special_note" type="text" class="form-control" id="" cols="45" rows="3"></textarea>

                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
{{--                                            <label for="photo" class="media" onclick="getLocations()">Open Camera</label>--}}
{{--                                            <input type="file" name="image" accept="image/*" capture="camera" id="photo" >--}}



                                            <input type="hidden" name="photo" id="image" >

                                            <div class="camera" >
                                                <video id="video">Video stream not available.</video>
                                                <button id="startbutton" onclick="getLocations()">Take photo</button>

                                            </div>

                                                <canvas id="canvas" >

                                                </canvas>


                                            <div id="output"  style="display: none !important;">
                                                <img id="photo" alt="The screen capture will appear in this box.">
                                            </div>


                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" id="location" readonly class="form-control">
                                            <input type="hidden" name="start_lat" id="start_lat">
                                            <input type="hidden" name="start_lng" id="start_lng">
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>




            <style>
                input[type="file"]{
                    display: none;
                }

                label.media{
                    display: inline-block;
                    background-color: darkblue;
                    padding: 1em 2em;
                    font-size: 1em;
                    color: #fff;
                }
            </style>


        </div>
    </section>

    <script>
        (function() {
            // The width and height of the captured photo. We will set the
            // width to the value defined here, but the height will be
            // calculated based on the aspect ratio of the input stream.

            var width = 320;    // We will scale the photo width to this
            var height = 0;     // This will be computed based on the input stream

            // |streaming| indicates whether or not we're currently streaming
            // video from the camera. Obviously, we start at false.

            var streaming = false;

            // The various HTML elements we need to configure or control. These
            // will be set by the startup() function.

            var video = null;
            var canvas = null;
            var photo = null;
            var startbutton = null;

            function showViewLiveResultButton() {
                if (window.self !== window.top) {
                    // Ensure that if our document is in a frame, we get the user
                    // to first open it in its own tab or window. Otherwise, it
                    // won't be able to request permission for camera access.
                    document.querySelector(".contentarea").remove();
                    const button = document.createElement("button");
                    button.textContent = "View live result of the example code above";
                    document.body.append(button);
                    button.addEventListener('click', () => window.open(location.href));
                    return true;
                }
                return false;
            }

            function startup() {
                if (showViewLiveResultButton()) { return; }
                video = document.getElementById('video');
                canvas = document.getElementById('canvas');
                photo = document.getElementById('photo');
                startbutton = document.getElementById('startbutton');

                navigator.mediaDevices.getUserMedia({video: true, audio: false})
                    .then(function(stream) {
                        video.srcObject = stream;
                        video.play();
                    })
                    .catch(function(err) {
                        console.log("An error occurred: " + err);
                    });

                video.addEventListener('canplay', function(ev){
                    if (!streaming) {
                        height = video.videoHeight / (video.videoWidth/width);

                        // Firefox currently has a bug where the height can't be read from
                        // the video, so we will make assumptions if this happens.

                        if (isNaN(height)) {
                            height = width / (4/3);
                        }

                        video.setAttribute('width', width);
                        video.setAttribute('height', height);
                        canvas.setAttribute('width', width);
                        canvas.setAttribute('height', height);
                        streaming = true;
                    }
                }, false);

                startbutton.addEventListener('click', function(ev){
                    takepicture();
                    ev.preventDefault();
                }, false);

                clearphoto();
            }

            // Fill the photo with an indication that none has been
            // captured.

            function clearphoto() {
                var context = canvas.getContext('2d');
                context.fillStyle = "#AAA";
                context.fillRect(0, 0, canvas.width, canvas.height);

                var data = canvas.toDataURL('image/png');
                photo.setAttribute('src', data);
            }

            // Capture a photo by fetching the current contents of the video
            // and drawing it into a canvas, then converting that to a PNG
            // format data URL. By drawing it on an offscreen canvas and then
            // drawing that to the screen, we can change its size and/or apply
            // other changes before drawing it.

            function takepicture() {
                document.getElementById('video').style.display = 'none';
                document.getElementById('output').style.display = 'block';
                startbutton.style.display = 'none';
                var context = canvas.getContext('2d');
                if (width && height) {canvas.width = width;
                    canvas.height = height;
                    context.drawImage(video, 0, 0, width, height);

                    var data = canvas.toDataURL('image/png');
                    photo.setAttribute('src', data);

                    // let buff = new Buffer(data, 'base64');
                    // fs.writeFileSync('stack-abuse-logo-out.png', buff);

                    // let fileName = new Date().getTime()+'.png'
                    // console.log(data);
                    // let file = new File([data],fileName,{type:'image/png', lastModified:new Date().getTime()}, 'utf-8');
                    // let container = new DataTransfer();
                    // container.items.add(file);
                    // document.querySelector('#image').files = container.files;
                    document.querySelector('#image').value = data;
                } else {
                    clearphoto();
                }
            }

            // Set up our event listener to run the startup process
            // once loading is complete.
            window.addEventListener('load', startup, false);
        })();


    </script>


    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHDmzYhDx3eLGS-WFobnapHpUA8JfTAoA&sensor=false"></script>
    <script>

        setTimeout(function () {
            getLocation()
        }, 1000);

        // window.load = function(){
        //     getLocation()
        // }

        var geocoder;
        function initialize() {

            geocoder = new google.maps.Geocoder();
        }

        function codeLatLng(lat , lng) {
            var latlng = new google.maps.LatLng(lat, lng);
            console.log(lat, lng)

            geocoder.geocode({
                'latLng': latlng
            }, function(results, status) {
                console.log(results);
                var lets =  results[0].formatted_address.split(',');
                // console.log(let[1] , let[2])
                // document.getElementById("test").innerHTML = '' + (results[0].formatted_address); + '';

                document.getElementById("location").value = lets[1]+ lets[2];

            });
        }



        // var x = document.getElementById("demo");
        function getLocations() {

            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            document.getElementById("start_lat").value = position.coords.latitude;
            document.getElementById("start_lng").value = position.coords.longitude;
            initialize();
            codeLatLng(position.coords.latitude, position.coords.longitude);

        }


    </script>





@endsection
@push('js')


@endpush
