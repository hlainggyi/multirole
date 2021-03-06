@extends('layouts.app')

@section('content')
<div class="col-md-10 col-md-offset-1">
  <div class="panel panel-default">
    <div class="panel-heading">
      {{ $user->name }}
    </div>
    <form action="{{ route('assign') }}" method="post">
    <div class="panel-body">
      <div class="col-md-offset-1 col-md-4">
        <div class="row">
            <img src="/uploads/user_images/{{ $user->avatar }}" alt="" style="width:50px; height:50px; border-radius:50%"/> <br>

            User Name :  {{ $user->name }}<br>
            Email : {{ $user->email }}<input type="hidden" name="email" value="{{$user->email}}">

        </div>
      </div>
      <div class="col-md-7">
        <div class="row">
          @foreach ($roles as $role)
            <div class="togglebutton">
              <label>
                  <input type="checkbox" {{ $user->hasRole( $role->name ) ? 'checked' : '' }} name="{{ $role->name }}">
              </label> : <label><strong>{{ $role->description }}</strong></label>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <div class="panel-footer">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-offset-1 col-md-2">
          <button type="submit" name="submit" class="btn btn-sm btn-success"><i class="fa fa-id-card-o" aria-hidden="true"> Assign Role</i></button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection
