
<style>
    .form-refferal{
        display: flex;
        flex-direction: column;
        width: 400px;
        color: white;
        margin: 0px 60px;
        padding: 20px;
    }

    .form-refferal :nth-child(n){
        margin: 5px 0px;
    }
    
    .form-refferal textarea{
        border-radius: 5px;
        border: 1px solid white;
        background: #1F2937;
    }
    
    form button{
            width: max-content;
    }
    
    @media only screen and (max-width:768px){  
    
        .form-refferal{
            width: 95%;
            margin: 0px 20px;
            padding: 20px;
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

        <form method="POST" class=" form-refferal bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" action="{{ url('/api/create-message') }}">
            @csrf

            <label for="referral_code">Create Message</label>
            <textarea type="text" id="message" name="message" required name="" id="" cols="30" rows="10"></textarea>

            <input type="hidden" name="uid" value="{{ Auth::id() }}">
            <input type="hidden" name="ruid" value="{{ $ruid }}">
            
            <button type="submit">
                <x-primary-button>
                    Submit
                </x-primary-button>
                </button>
        </form>
    </div>
</x-app-layout>