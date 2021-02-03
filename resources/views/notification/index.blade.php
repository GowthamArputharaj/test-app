<x-guest-layout>
    <x-auth-card>
        @section('notifyArea')
        @isset($notifications)
            @foreach ($notifications as $notification)
                <div class="alert alert-warning alert-dismissible show" role="alert">
                    <strong>Hello {{ auth()->user()->name ?? '' }}!</strong> <code>{{ $notification->data['message'] }}</code>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="closeNotification" data-notify-id="{{ $notification->id}}">&times;</span>
                    </button>
                </div>
                {{-- <div class="text-danger text-center">
                    {{ $notification->data['message'] }}
                </div> --}}
            @endforeach
        @endisset
        @endsection
        @section('selectNotify')
            <select name="user" >
                <option value="0" selected>Select any one user</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
        @endsection
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            <div class="bg-success">
                {{-- <div class="text-danger text-center">
                    {{ $notifications[0]->data['message'] ?? 'No Notifications found!!!'}}
                </div> --}}

            </div>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        {{-- <form method="POST" action="{{ route('login') }}"> --}}
            {{-- @csrf --}}
            

            <div class="flex mt-4" id="sendNotification">
                <x-button>
                <span data-route="{{ route('notify.send') }}" >Send Notification</span>
                </x-button>
                @csrf
            </div>
        {{-- </form> --}}
    </x-auth-card>
    <script type="text/javascript">
        // $('#ajaxSuccessDiv').hide();
        // $('#ajaxSuccessDiv').alert('close')
        // $('#ajaxSuccessDiv').alert()

        $('#sendNotification').on('click', function(ev) {
            console.log('send Nofication is clicked');
            var url = '{{ route('notify.send') }}'
            var _token = $('[name=_token').val();
            var user = $('[name=user').val();
            console.log(url);

            $.ajax({
                type: "POST",
                url: url,
                data: { notify: true , _token: _token, user_id: user},
                success: function (response) {
                    console.log(response);
                    $('#ajaxSuccessMsg').val(response);
                    // $('#ajaxSuccessDiv').show();
                    $('#ajaxSuccessDiv').alert()

                }
            });
        });

        $('.closeNotification').on('click', function(ev) {
            console.log('read Nofication is clicked');
            var url = '{{ route('notify.read') }}'
            var _token = $('[name=_token').val();
            
            var not = $(this).attr('data-notify-id');
            console.log(url);

            $.ajax({
                type: "POST",
                url: url,
                data: { _token: _token, notification_id: not},
                success: function (response) {
                    console.log(response);
                }
            });
        });

        // $('.close').on('click', function(ev){
            // $('#ajaxSuccessDiv').hide();
        // });
    </script>
</x-guest-layout>
