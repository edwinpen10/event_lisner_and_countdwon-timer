@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">setup role menu</div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
<form action="{{route('menu.storerole')}}" method="POST">
    @csrf
                        <select class="form-control" name="user">
                            @foreach ($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <br>
                        <br>
<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Menu name</th>
        <th scope="col">Read</th>
        <th scope="col">Create & Read</th>
        <th scope="col">Create & Read & edit</th>
        <th scope="col">Create & Read & edit & delete</th>
      </tr>
    </thead>

    <tbody>
        @foreach ($menus as $item)
        <tr>
            <td>{{$item->menu_name}}</td>
            <input type="hidden" name="menu[]" id="" value="{{$item->id}}">
            <td><input type="radio" name="role[]{{$item->id}}" value="1"></td>
            <td><input type="radio" name="role[]{{$item->id}}" value="2"></td>
            <td><input type="radio" name="role[]{{$item->id}}" value="3"></td>
            <td><input type="radio" name="role[]{{$item->id}}" value="4"></td>
          </tr>
        @endforeach
      
    </tbody>
  </table>
  <button type="submit" class="btn btn-info btn-small "> Setup role</button>
                </div>
               
            </form>     
            </div>
        </div>
    </div>
</div>
@endsection
