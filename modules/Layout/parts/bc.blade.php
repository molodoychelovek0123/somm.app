@if(!empty($breadcrumbs))
<div class="blog-breadcrumb hidden-xs">
    <div class="container">
        <ul>
            <li><a target="_self" href="{{url('')}}">{{__('Home')}}</a></li>
            @foreach($breadcrumbs as $breadcrumb)
                <li class=" {{$breadcrumb['class'] ?? ''}}">
                    @if(!empty($breadcrumb['url']))
                        <a target="_self" href="{{url($breadcrumb['url'])}}">{{$breadcrumb['name']}}</a>
                    @else
                        {{$breadcrumb['name']}}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endif
