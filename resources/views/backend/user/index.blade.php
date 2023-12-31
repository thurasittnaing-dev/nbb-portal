@extends('layouts.modernize')

@section('title', 'Dashboard')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('user.index')}}">System</a></li>
      <li class="breadcrumb-item active" aria-current="page">User</li>
    </ol>
</nav>
<div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">User List ({{$count}})</h5>
      <div class="my-2 d-flex justify-content-between">
        <div>
            @php
                $keyword = $_GET['keyword'] ?? '';
            @endphp
            <form action="" autocomplete="off">
                <div class="">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search..." value="{{$keyword}}">
                        <button class="btn btn-primary" type="button"data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">More Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            ...
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add New User</button>
            <!-- Modal -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('user.store')}}" method="POST" autocomplete="off" id="submit-form">
                        @csrf
                        <div class="modal-body">
                           <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="mb-2">Name</label>
                                <input type="text" name="name" class="form-control" id="name" class="form-control" placeholder="Name">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="loginid" class="mb-2">Login ID</label>
                                <input type="text" name="loginid" class="form-control" id="loginid" class="form-control" placeholder="Login ID">
                            </div>
                           </div>

                           <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="role" class="mb-2">Role</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">--Select--</option>
                                    @forelse (roles() as $role)
                                    <option {{$role == "subscriber" ? "selected" : "" }} value="{{$role}}">{{$role}}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="device_limit" class="mb-2">Device Limit</label>
                                <input type="number" name="device_limit" class="form-control" id="device_limit" class="form-control" value="2" min="1" max="20">
                            </div>
                           </div>

                           <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="password" class="mb-2">Password</label>
                                <input type="password" name="password" class="form-control" id="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="passwordconfirmation" class="mb-2">Password Confirmation</label>
                                <input type="password" name="passwordconfirmation" class="form-control" id="passwordconfirmation" class="form-control" placeholder="Password Confirmation">
                            </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submit-btn" class="btn btn-primary">Confirm & Save</button>
                        <button type="button" id="loader-btn" class="btn btn-primary me-2"><span id="loader" class="spinner-border spinner-border-sm me-2" role="status"></span> <span id="btext">Processing....</span></button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
      </div>
      <div class="">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Login ID</th>
                <th scope="col">Name</th>
                <th scope="col">Device Limit</th>
                <th scope="col">Role</th>
                <th scope="col">Remaining Days</th>
                <th scope="col">Status</th>
                <th scope="col">Created By</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($data as $user)
              <tr>
                <th scope="row">{{++$i}}.</th>
                <td>{!!highlight_keyword($user->name,$keyword)!!}</td>
                <td>{!!highlight_keyword($user->loginid,$keyword)!!}</td>
                <td>{{$user->device_limit}}</td>
                <td>{{$user->role}}</td>
                <td>
                    @if($user->role = "admin")
                    <span class="badge badge-sm bg-success badge-pill" style="font-size: 12px">unlimited</span>
                    @endif
                </td>
                <td>
                    <label class="switch">
                        <input data-id="{{ $user->id }}" data-size="small" class="toggle-class"
                            type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                            data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                        <span class="slider round"></span>
                    </label>
                </td>
                <td>{{$user->cby}}</td>
                <td>
                    <div class="d-flex">
                        <div>{{date('d-m-Y',strtotime($user->created_at))}}</div>
                        <div class="mx-1"></div>
                        <div>{{date('H:i:s A',strtotime($user->created_at))}}</div>
                    </div>
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Setting
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#updatePassword{{$user->id}}">Update Password</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}">Edit User</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteUser{{$user->id}}">Delete User</a>
                            </li>
                        </ul>
                    </div>
                </td>
              </tr>

            <!-- Modal -->
            <div class="modal fade" id="deleteUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('user.destroy',$user->id)}}" method="POST" autocomplete="off">
                        @csrf
                        @method('delete')
                        <div class="modal-body">
                          <p>Are you sure? you want to delete this?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-danger">Delte</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="updatePassword{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update User Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('user.updatePassword',$user->id)}}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                           <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="password" class="mb-2">Set New Password</label>
                                <input type="password" name="password" class="form-control" class="form-control" placeholder="Password">
                            </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{$user->name}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('user.update',$user->id)}}" method="POST" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                           <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="" class="mb-2">Name</label>
                                <input type="text" name="name" class="form-control" class="form-control" placeholder="Name" value="{{$user->name}}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="" class="mb-2">Login ID</label>
                                <input type="text" name="loginid" class="form-control" class="form-control" placeholder="Login ID" value="{{$user->loginid}}">
                            </div>
                           </div>

                           <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="" class="mb-2">Role</label>
                                <select name="role" class="form-control">
                                    <option value="">--Select--</option>
                                    @forelse (roles() as $role)
                                    <option {{$role == $user->role ? "selected" : "" }} value="{{$role}}">{{$role}}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="" class="mb-2">Device Limit</label>
                                <input type="number" name="device_limit" class="form-control" class="form-control" value="{{$user->device_limit}}" min="1" max="20">
                            </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
              @empty

              @endforelse
            </tbody>
          </table>
      </div>
      {!! $data->appends(request()->input())->links() !!}
    </div>
</div>
@endsection

@section('css')
<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 45px;
      height: 22px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 15px;
      width: 15px;
      left: 2px;
      bottom: 0px;
      top:3px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 36px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

</style>
@endsection


@section('js')
<script>
    @if(Session::has('success'))
        toastSuccess('{{ Session::get('success') }}')
    @endif

    @if(Session::has('error'))
        toastError('{{ Session::get('error') }}')
    @endif

    // Add New User
    $("#submit-btn").on("click",function(){

        let name = $("#name").val();
        let loginid = $("#loginid").val();
        let role = $("#role").val();
        let device_limit = $("#device_limit").val();
        let password = $("#password").val();
        let passwordconfirmation = $("#passwordconfirmation").val();

        if(name == "") {
            toastError('Name is required');
            return;
        }

        if(loginid == "") {
            toastError('Login ID is required');
            return;
        }

        if(role == "") {
            toastError('Role is required');
            return;
        }

        if(device_limit == "") {
            toastError('Devlice Limit is required');
            return;
        }

        if(password == "") {
            toastError('Password is required');
            return;
        }

        if(password != passwordconfirmation) {
            toastError('Password and Confirm Passsword not match');
            return;
        }

        $("#loader-btn").show();
        $("#submit-btn").hide();

        $("#submit-form").submit();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
        }
    });

    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var id = $(this).data('id');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{route('user.toggleStatus'); }}",
            data: JSON.stringify({
                'status': status,
                'id': id
            }),
            success: function(data) {

                if(data.status) {
                    toastSuccess(data.message)
                }

                if(!data.status) {
                    toastError(data.message)
                }
            }
        });
    });
</script>
@endsection
