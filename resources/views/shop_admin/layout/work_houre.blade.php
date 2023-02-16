@extends('shop_admin.shop_master')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Work Hour</h1>
    <!-- Button trigger modal -->
    @if($day_count <= 6) <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Setup Work hour
        </button>
        @endif
</div>

<table class="table align-middle text-center">
    <thead>
        <tr>
            <th scope="col">#SL</th>
            <th scope="col">Name Of the Day</th>
            <th scope="col">Opening Time Slot</th>
            <th scope="col">Closing Time Slot</th>
            <th scope="col">Day Off</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($work_hours as $key => $work_hour)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$work_hour->day_name}}</td>
            <td>
                @if($work_hour->opening_time == "")
                <i class="fa-lg fa-solid fa-xmark"></i>
                @else
                {{\Carbon\Carbon::parse($work_hour->opening_time)->format('g:i:s A')}} 
                @endif
            </td>
            <td>
                @if($work_hour->closing_time == "")
                <i class="fa-lg fa-solid fa-xmark"></i>
                @else
                {{\Carbon\Carbon::parse($work_hour->closing_time)->format('g:i:s A')}}
                @endif
            </td>
            <td>
                @if($work_hour->day_off == "day_off")
                <i class="fa-lg fa-solid fa-check "></i>
                @else
                <i class="fa-lg fa-solid fa-xmark "></i>
                @endif
            </td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Set your Weekly Schedule</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('shop_work_hour_add')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="u_id" value="{{ Auth::user()->id}}">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Select Day and Work hour</label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="day_name">
                            <option>Choose...</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <input type="time" class="timepicker form-control" name="opening_time">
                        </div>
                        <div class="col-4">
                            <input type="time" class="timepicker form-control" name="closing_time">
                        </div>
                        <div class="col-4">
                            <input type="checkbox" id="day_off" name="day_off" value="day_off">
                            <label for="day_off"> Day Off</label><br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">SET</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection