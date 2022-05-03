@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <h2>Path HIVST Users Table</h2>
        <br />
        <br />
        <br />

    <div class="row" >
        <div class="col-md-6">
            <label for="">Image</label>
        </div>
        <div class="col-md-6">
            <label for="">Change Status</label>
        </div>
    </div>

        @foreach($results as $result)
            <div class="row">
                <div class="col-md-6">
                    <img width="300px" src={{$result->image_url}} alt="" srcset="">
                </div>
                <div class="col-md-6">
                    <a href='/unsure/set_result?result_id={{$result->hiv_result_id}}&status=positive'><button >Positive</button></a>
                    <a href="/unsure/set_result?result_id={{$result->hiv_result_id}}&status=negative"><button >Negative</button></a>
                </div>
            </div>
        @endforeach


    </div>
</div>
@endsection
