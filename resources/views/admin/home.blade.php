@extends('layouts.auth')

    @section('content')
    <div class="container">
        <div class="row">
          <div class="col-sm-3">
               @include('admin.sidebar')
          </div>

         <div class="col-sm-9 pt-5">
          @if(auth('admin')->user())
             @forelse($notifications as $notification)
          
                 <div class="alert alert-success" role="alert">
                 [ {{ $notification -> created_at }}] {{ $notification -> data['order_number'] }} Cancelled!  -- {{ $notification -> data['first_name'] }} {{ $notification -> data['last_name'] }}
            <a href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                Mark as read
            </a>
        </div>

        @if($loop->last)
            <a href="#" id="mark-all">
                Mark all as read
            </a>
        @endif
    @empty
        There are no new notifications
    @endforelse
@endif
 
         </div>
        </div>
    </div>

    @if(auth('admin')->user())
    <script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('admin.markNotification') }}", {
            method: 'POST',
            data: {
                '_token':$('meta[name="csrf-token"]').attr('content'),
                id:id
            }
        });
    }
    $(function() {
        $('.mark-as-read').click(function() {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function() {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
    </script>
@endif
    @endsection