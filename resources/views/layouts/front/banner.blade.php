@php
    use  \App\Banner;
    $banners = Banner::getBanners();
  //  echo "<pre>"; print_r($banners); die();
@endphp

<div id="myCarousel" class="carousel slide">
    <div class="carousel-inner">
        @foreach ($banners as $key => $banner)
           
            <div class="item @if ($key == 0) active @endif">
            <div class="container">
                <a href="{{ !empty($banner['link']) ? $banner['link']: "javascript:void(0)"}}"><img title="{{ $banner['title'] }}" style="width:100%" src="{{ asset('img/adm_img/carousel/'.$banner['image']) }}" alt="{{ $banner['alt']}} "/></a>
            </div>
        </div>
        @endforeach
       
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>