@extends('user.layouts.userMaster')
@push('css')
<style>
    .mybalanetotal {
    border: 1px solid #eaeded;
    padding: 10px;
    text-align: center;
    }
    .mybalanetotal p {
    padding: 10px;
    margin: 0;
    background: #eaeded;
    }
    .mybalanetotal h6 {
    font-weight: bold;
    margin: 0;
    padding: 5px;
    }
    .mybalanetotal span {
    font-size: 50px;
    font-weight: bold;
    }
    .myaddbalanetotal {
    border: 1px solid #eaeded;
    padding: 10px;
    text-align: center;
    }
    .myaddbalanetotal p {
    padding: 10px;
    margin: 0;
    background: #eaeded;
    }
    .alltrasection {
    border: 1px solid #eaeded;
    padding: 10px;
    }
    @media only screen and (max-width: 600px) {
      .usersidebardiv {
        padding: 15px;
      }
    }
</style>
@endpush
@section('content')
<br>
    @include('user.userBalance.parts.userRecharge')
@endsection
@push('js')
<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };
    
        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

<script>
    function subscribeId(actionUrl) {
      $("#subscribeForm").attr("action", actionUrl);
    }
  </script>
@endpush

<aside class="sidebar sticky-active" id="sidebar" data-plugin-sticky="" data-plugin-options="{'minWidth': 991, 'containerSelector': '.container', 'padding': {'top': 110}}" style="width: 255px; top: 110px; position: fixed; left: 119.5px;">

  <h4 class="pt-2">Sticky Content</h4>
  <p>Nulla nunc dui, tristique in semper vel, congue sed ligula. Nam dolor ligula, faucibus id sodales in, auctor fringilla libero.</p>

  <a class="btn btn-modern btn-primary mb-4" href="contact-us.html">Contact Us Now!</a>
  
</aside>