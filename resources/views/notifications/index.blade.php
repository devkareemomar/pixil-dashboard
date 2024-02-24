@extends('layout.app')
@section('title', __('Notification'))
@section('description', __('Manage Album'))
@section('content')
    <div class="container-fluid">
        <br>
        <div class="card mb-80">
            <div class="card-body">
                <div class="col-lg-2">
                    <h4 class="text-capitalize">{{ __('Notification') }}</h4>
                    ({{ $results->links()->paginator->total() }})
                </div>

                <br>
                <div class="col-lg-4">

                    <form action="{{route('notifications.updateAll')}}" method="POST"
                          class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button style="display: inline-block !important;" type="submit"
                                class="btn btn-primary btn-sm">
                            Read All
                        </button>
                    </form>

                    <form action="{{route('notifications.destroyAll')}}" method="POST"
                          class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button style="display: inline-block !important;" type="submit"
                                class="btn btn-danger btn-sm">
                            Delete All
                        </button>
                    </form>
                </div>
                <br>
                <div class="table-responsive">

                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Notification') }}</th>
                            <th>{{__('Time')}}</th>
                            <th>{{ __('Actions') }}</th>

                        <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Notification') }}</th>
                        <th>{{__('Time')}}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($results as $key=>$result)
                        <tr style="{{$result->is_read ==0 ? "background:#cbcbcba8" :'' }}">
                            <td>{{ $loop->iteration + $results->links()->paginator->firstItem() - 1}}</td>
                            <td>New Sign Up User {{ $result->user?->email }}</td>
                            <td>{{\Illuminate\Support\Carbon::now()->diffInHours(\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:s:i', $result->created_at))}} hours ago</td>
                            <td>
                                <form action="{{ route('notifications.destroy', $result->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button style="display: inline-block !important;" type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('{{ __('Are you sure?') }}')">
                                        -
                                    </button>
                                </form>
                                @if($result->is_read == 0)
                                <form action="{{ route('notifications.update', $result->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button style="display: inline-block !important;" type="submit"
                                            class="btn btn-primary btn-sm">
                                        &#10004;
                                    </button>
                                </form>
                                @endif

                            </td>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($results as $key=>$result)
                            <tr style="{{$result->is_read ==0 ? "background:#cbcbcba8" :'' }}">
                                <td>{{ $loop->iteration + $results->links()->paginator->firstItem() - 1}}</td>
                                <td>New Sign Up User {{ $result->user?->email }}</td>
                                <td>{{\Illuminate\Support\Carbon::now()->diffInHours(\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:s:i', $result->created_at))}}
                                    hours ago
                                </td>
                                <td>
                                    <form action="{{ route('notifications.destroy', $result->id) }}" method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button style="display: inline-block !important;" type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('{{ __('Are you sure?') }}')">
                                            -
                                        </button>
                                    </form>
                                    @if($result->is_read == 0)
                                        <form action="{{ route('notifications.update', $result->id) }}" method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button style="display: inline-block !important;" type="submit"
                                                    class="btn btn-primary btn-sm">
                                                &#10004;
                                            </button>
                                        </form>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $results->links()}}
            </div>
        </div>
    </div>
@endsection
