
    <style>
        .message-container{
            width: 600px;
            color: white;
            margin: 20px 70px;
        }

        @media only screen and (max-width:768px){
            .message-container{
                width: 80% !important;
                margin: 20px;
            }
        }
    </style>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Hello, {{ Auth::user()->name }}
            </h2>
        </x-slot>
        <div class="py-6 px-6 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg message-container">
            @if($data)
            {{ $data->message }}
            <div class="flex items-center mt-4">
                <button type="submit">
                    <x-primary-button class="">
                        Screenshot
                    </x-primary-button>
                </button>
                <form method="GET" action="{{ url('/api/message') }}">
                    @csrf
                    <button type="submit" class="ml-4">
                        <x-primary-button class="">
                            Delete
                        </x-primary-button>
                    </button>
                </form>

            </div>
            @else
                <p>No message found.</p>
            @endif

        </div>
    </x-app-layout>