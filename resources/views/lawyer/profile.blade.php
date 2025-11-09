@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Lawyer Profile') }}</div>

                <div class="card-body">
                    {{ __('You are logged in as a lawyer!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
