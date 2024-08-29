@php
    use Illuminate\Support\Str;
@endphp


<style>
    .msg-list{
        display: flex;
        width: 100%;
        flex-wrap: wrap;
    }

    .msg-list li{
        width: 30%;
        padding: 20px;
        height: 190px;
        border: 2px solid #111827;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    ul button{
        width: max-content;
    }
    @media only screen and (max-width:768px){  
    .msg-list li{
        width: 100%;
        padding: 20px;
        height: 140px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }


    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hello, {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                
                @if(isset($data))
                    <p>Data: {{ $data }}</p>
                @endif
                
                
                    <!-- Button to create a new message -->
                    <form action="{{ route('verify-refferal') }}" method="GET">
                        <input type="hidden" name="uid" value="{{ Auth::id() }}">
                        <button type="submit">
                            <x-primary-button>
                                Send Message
                            </x-primary-button>
                        </button>
                    </form>
                    <!-- Display Error/Other Message -->
                    <h1 class="mt-4 mb-4">Your Messages:</h1>
                    @if(session('message'))
                        <p>{{ session('message') }}</p>
                    @endif
                
                    @if($messages->isNotEmpty())
                        <ul class="msg-list">
                            @foreach($messages as $message)
                                <li class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                    {{ Str::limit($message->message, 100, '...') }}
                                    <br>
                                    <!-- Button to create a new message -->
                                    <form action="{{ url('/api/msgid') }}" method="GET">
                                        <input type="hidden" name="msgid" value="{{ $message->id }}">
                                        <button class="mt-6" type="submit">
                                            <x-primary-button>
                                                View Message
                                            </x-primary-button>
                                        </button>
                                    </form>

                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No messages found.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
