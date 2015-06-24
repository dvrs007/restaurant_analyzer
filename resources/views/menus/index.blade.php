@extends('layouts.master')

@section('title')
Menu List
@stop

@section('content')
<div class="main-title">
    <h2>Menu
        <div class="create_link"><a href="{{ url('menus/list') }}"><span class="glyphicon glyphicon-list-alt"></span></a></div>        
    </h2>            
</div><!--/.main-title-->
<div class="row">
    <div class="col-lg-10 center-block">


        <div id="links"> 
            @foreach($items as $item)
            <div class="item_img">
            <a href="{{ url($item->img_path) }}" title="{{ $item->item_name }}"><img src="{{ url($item->img_path) }}" alt="{{ $item->item_name}}" title="{{ $item->item_name}}" class="img-thumbnail image-responsive"/></a>
            {{ $item->item_name }} ${{ $item->item_price }}
            </div>
            
            @endforeach
        </div> <!--  end of #links         -->
        <br/>
        <!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body 
                https://github.com/blueimp/Gallery/blob/master/README.md#description -->
        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
            <!-- The container for the modal slides -->
            <div class="slides"></div>
            <!-- Controls for the borderless lightbox -->
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
        </div> <!-- end for #blueimp-gallery -->      

    </div><!-- /.col-lg-10 center-block-->
</div><!--/ .row-->
<!--script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script-->
<!-- Bootstrap JS is not required, but included for the responsive demo navigation and button states -->
<script>
document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
            link = target.src ? target.parentNode : target,
            options = {index: link, event: event},
    links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};
</script> 
<!-- END of FILE image_list_view-->
@stop
