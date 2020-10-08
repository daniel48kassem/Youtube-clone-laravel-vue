@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{$channel->name}}
                        <a href="{{route('channel.upload',$channel->id)}}">upload videos</a>
                    </div>

                    <div class="card-body">
                        @if($channel->editable())

                            <form id="update-channel-form" action="{{route('channels.update',$channel->id)}}"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                @endif

                                <div class="form-group row justify-content-center">

                                    <div class="channel-avatar ">
                                        @if($channel->editable())
                                            <div onclick="document.getElementById('image').click()"
                                                 class="channel-avatar-overlay">
                                                <img src="https://img.icons8.com/doodle/48/000000/camera.png"/>
                                            </div>
                                        @endif
                                    </div>
                                    <img src="{{$channel->image()}}" alt="">
                                </div>

                                <div class="form-group">
                                    <h4 class="text-center">
                                        {{$channel->name}}
                                    </h4>
                                    <div class="text-center">
                                        {{$channel->description}}
                                    </div>
                                </div>

                                <div class="text-center">
                                    <subscribe-button :channel="{{$channel}}"
                                                      :initial-subscriptions="{{$channel->subscriptions}}">
                                    </subscribe-button>
                                </div>

                                @if($channel->editable())
                                    <input onchange="document.getElementById('update-channel-form').submit()"
                                           style="display: none" id="image" type="file" name="image">


                                    <div class="form-group">
                                        <label for="name" class="form-control-label">
                                            Name
                                        </label>
                                        <input id="name" name="name" value="{{$channel->name}}" type="text"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="form-control-label">
                                            description
                                        </label>
                                        <textarea name="description" id="description" type="text"
                                                  class="form-control">{{$channel->description}}</textarea>
                                    </div>
                                    @if($errors->any())
                                        <ul class="list-group mb-5">
                                            @foreach($errors->all() as $error)
                                                <li class="text-danger list-group-item">
                                                    {{$error}}

                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif


                                    <button type="submit" class="btn btn-info">
                                        Update Channel
                                    </button>


                                @endif
                                @if($channel->editable())
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
