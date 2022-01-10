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

            <form action="{{ route('patch', ['id' => $todo->id]) }}" method="post" method="POST" class="card">
            @csrf
            {{ method_field('PATCH') }}
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-4">
                    <div class="row">
                      <div class="col-md-6 col-xl-12">
                        <div class="mb-3">
                          <label class="form-label">Name</label>
                          <input type="text" class="form-control" name="name" value="{{$todo->name}}" placeholder="Name placeholder">
                        </div>
                        <div class="mb-3">
                            <div class="form-label">Active</div>
                            <div>
                              <label class="form-check">
                                <input class="form-check-input" name="active" value="1" @if ($todo->active == 1) checked @endif type="checkbox">
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
                            <input class="form-control mb-2" name="deadline" placeholder="Select a date" id="datepicker-default" value="{{$todo->deadline}}" required/>

                        </div>
                        <div class="mb-3">
                          <div class="form-label">Level</div>
                          <select class="form-select" name="level">
                            <option value="1" @if($todo->level == 1)) selected @endif>One</option>
                            <option value="2" @if($todo->level == 2)) selected @endif>Two</option>
                            <option value="3" @if($todo->level == 3)) selected @endif>Three</option>
                            <option value="4" @if($todo->level == 4)) selected @endif>Four</option>
                            <option value="5" @if($todo->level == 5)) selected @endif>Five</option>
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
                            <textarea class="form-control" name="comment" rows="6" placeholder="Content..">{{$todo->comment}}</textarea>
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
@endsection
