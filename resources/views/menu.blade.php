@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">List menu</div>
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add menu</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('menu.store')}}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Menu Name</label>
                  <input type="text" class="form-control" id="" name="menu" aria-describedby="emailHelp" placeholder="Enter menu name">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">address</label>
                    <input type="text" class="form-control" id="" name="address" aria-describedby="emailHelp" placeholder="Enter url address ex :/localhost/data">
                  </div>
            
        </div>
        <div class="modal-footer">
          
          <button type="submit" class="btn btn-primary">Save</button>
          <form>
        </div>
      </div>
    </div>
  </div>

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add menu</button>
                 <br/>
                 <br/>
<table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Menu name</th>
        <th scope="col">Address</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($menus as $item)
        <tr>
            <td>{{$item->menu_name}}</td>
            <td>{{$item->address}}</td>
          </tr>
        @endforeach
      
    </tbody>
  </table>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
