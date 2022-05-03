@extends('layouts.app')

@section('content')
<div class="container content">
    <div class="">
        <h2>Path HIVST Users Table</h2>
        <br />

        <form method="get">
            <input type="search" name="search" id="search" placeholder="search bot users">
            <button><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
 
        <table class="table table-striped" >
            <thead>
                <tr>
                <th class="w-1/2 ...">Name</th>
                <th class="w-1/4 ...">Age</th>
                <th class="w-1/4 ...">Gender</th>
                <th class="w-1/4 ...">Consent</th>
                <th class="w-1/3 ...">Phone</th>
                <th class="w-1/4 ...">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facebook_users as $user)
                    <tr>
                    <td>{{ $user->user->name ?? "" }}</td>
                    <td>{{ date('Y') - $user->birth_year ?? "" }}</td>
                    <td>{{ $user->gender ?? "" }}</td>
                    <td>{{ ($user->consent)?"Yes":"No" ?? "" }}</td>
                    <td>+{{ $user->phone_number }}</td>
                    <td>{{ $user->user->results->last()->result ?? "" }}</td>
                    </tr>  
                @endforeach
            </tbody>
        </table>

            {{$facebook_users-> links()}}
        
    </div>
</div>
@endsection
