@extends('layouts.appfront')
@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            @if( $webhook_error != '' )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
               {{ $webhook_error }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif

             @if( $webhook_success != '' )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               {{ $webhook_success }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white ">
                 Create webhook
                </div>

                <div class="col text-center">
                <form class="form-inline" id="webhook" method="post" action="{{ URL('/create-webhook') }}">
                    @csrf
                
                  <div class="form-group mx-sm-6 mb-2">
                    <input type="text" name="name" required class="form-control" id="name" placeholder="Enter webhook-name">
                    <button type="submit" id="submit" class="btn btn-primary ml-2">Submit</button>
                  </div>
               
                 
                </form>
                </div>
            </div>

             
        </div>
    </div>


@endsection

