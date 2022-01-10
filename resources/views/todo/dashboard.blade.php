@extends('app')

@section('content')
<!--form-->
<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="page-title">
              Add Todo
            </h2>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
            @if(count($errors) > 0)
            <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                <div class="text-muted">{{ $error }}</div>
            @endforeach
            </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('store') }}" method="post" method="POST" class="card">
            @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-4">
                    <div class="row">
                      <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                          <label class="form-label">Name</label>
                          <input type="text" class="form-control" name="name" placeholder="Name placeholder">
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Active</div>
                            <div>
                              <label class="form-check">
                                <input class="form-check-input" name="active" value="1" type="checkbox">
                                <span class="form-check-label">Checkbox input</span>
                              </label>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>

                <div class="col-xl-4">
                    <div class="row">
                      <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label">Deadline</label>
                            <input class="form-control mb-2" name="deadline" placeholder="Select a date" id="datepicker-default" value="{{Carbon\Carbon::now()->toDateString()}}" required/>

                        </div>
                        <div class="mb-3">
                          <div class="form-label">Level</div>
                          <select class="form-select" name="level">
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                            <option value="4">Four</option>
                            <option value="5" selected>Five</option>
                          </select>
                        </div>
                      </div>
                  </div>
                </div>

                <div class="col-xl-4">
                    <div class="row">
                      <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <textarea class="form-control" name="comment" rows="6" placeholder="Content.."></textarea>
                        </div>
                      </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="card-footer text-end">
              <div class="d-flex">
                <button type="submit" class="btn btn-primary ms-auto">Send data</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!--form end-->


<!--list-->
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
        <div class="col">
            <h2 class="page-title">
            List Todo
            </h2>
        </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
        <div class="col-12">
            <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                <thead>
                    <tr>
                    <th>Name</th>
                    <th>Active</th>
                    <th>Deadline</th>
                    <th>Level</th>
                    <th>Comment</th>
                    <th class="w-1"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allTodos as $todo)
                    <tr>
                        <td>{{$todo->name}}</td>
                        <td>{{$todo->active}}</td>
                        <td>{{$todo->deadline}}</td>
                        <td>{{$todo->level}}</td>
                        <td>{{$todo->comment}}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="{{ route('edit', ['id' => $todo->id]) }}" class="btn">Edit</a>
                                <form action="{{ route('delete', ['id' => $todo->id]) }}" method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button id="delete-btn" type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
                {{ $allTodos->links() }}
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<!--list end-->
@endsection
