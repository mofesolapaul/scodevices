@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                {{--                {{ $errors->first() }}--}}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header">
                        {{ __('Devices') }}
                        <span class="float-right" data-toggle="modal" data-target="#newDeviceModal">
                            <a type="button" class="btn btn-sm btn-outline-dark"
                               data-toggle="tooltip" data-placement="bottom"
                               title="Add new device">+</a>
                        </span>
                    </h5>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <ul class="list-group list-group-flush">
                            @forelse($devices as $device)
                                <li class="list-group-item list-group-item-action">
                                    {{ $device->device_id }}
                                    <div class="small text-muted">
                                        {{ $device->work ? 'Work':'Home' }} |
                                        Added by: {{ $device->user->name }}
                                    </div>
                                </li>
                            @empty
                                There are no devices added yet. Click the 'plus' button above to get started.
                            @endforelse
                        </ul>
                    </div>

                    @if (isset($devices) && count($devices))
                        <div class="card-footer">
                            Farthest devices:
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="newDeviceModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add a new device</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="/devices">
                    <div class="modal-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="d-block">
                                Device ID:
                                <input name="device_id" type="text" class="form-control" value="{{ old('device_id') }}"
                                       required>
                            </label>
                            <label class="d-block">
                                Latitude:
                                <input name="latitude" type="text" class="form-control" value="{{ old('latitude') }}"
                                       required>
                            </label>
                            <label class="d-block">
                                Longitude:
                                <input name="longitude" type="text" class="form-control" value="{{ old('longitude') }}"
                                       required>
                            </label>
                            <label class="d-block">
                                Select place:
                                <select name="work" class="form-control" required>
                                    <option value="" class="d-none">Select Home or Work</option>
                                    <option value="0">Home</option>
                                    <option value="1">Work</option>
                                </select>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
