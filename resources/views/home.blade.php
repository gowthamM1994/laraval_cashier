@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session()->get('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- {{ __('Welcome to the Dashboard!') }} -->
                    
                    @if ($status)
                        <div class="alert alert-success">
                            <strong>Success!</strong> {{ $value }}.
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <strong>Failed!</strong> {{ $value }}.
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
