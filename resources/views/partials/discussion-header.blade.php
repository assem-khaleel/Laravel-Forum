<div class="card-header">
    <div class="d-flex justify-content-between">
        <div>
            <img width='40px' height='40px' style="border-radius:50%"
                 src="{{Gravatar::src($discussion->author->email)}}" alt="">
            <span class="ml-2 font-weight-bold">{{$discussion->author->name}}</span>
        </div>
        <div>

            @if($currentRoute == 'discussion.show')
                <a href="{{route('discussion.index')}}" class="btn brn-success btn-sm">Back</a>

            @else
                <a href="{{route('discussion.show',$discussion->slug)}}" class="btn brn-success btn-sm">View</a>

            @endif
        </div>
    </div>

</div>
