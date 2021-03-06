@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Add Discussion</div>

        <div class="card-body">
           <form action="{{route('discussion.store')}}" method="post">

               @csrf

               <div class="form-group">
                   <label for="title">Title</label>
                   <input type="text" class="form-control" name="title" value="">
               </div>

               <div class="form-group">
                   <label for="Description">Description</label>
                   <input id="Description" type="hidden" name="Description">
                   <trix-editor input="Description"></trix-editor>
               </div>

               <div class="form-group">
                   <label for="channel">Channel</label>
                   <select id="channel" class="form-control" name="channel">
                       @foreach($channels as $channel)
                           <option value="{{$channel->id}}">{{$channel->name}}</option>
                           @endforeach
                   </select>
               </div>

               <button type="submit" class="btn btn-success">Create Discussion</button>
           </form>
        </div>
    </div>

@endsection

@section('css')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
@endsection

@section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
@endsection
