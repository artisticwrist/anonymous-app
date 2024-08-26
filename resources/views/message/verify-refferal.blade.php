<style>
.form-refferal{
    display: flex;
    flex-direction: column;
    width: 400px;
    color: white;
    margin: 0px 60px;
    padding: 20px;
}

.form-refferal input{
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
            <form action="{{ route('send-message-form') }}" class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg form-refferal" method="GET">
                @csrf
                <label class="mb-2" for="referral_code">Input user referral code</label>
                <input class="mb-4" type="text" id="referral_code" name="referral_code" required>
                
                <input type="hidden" name="uid" value="{{ Auth::id() }}">
                
                <button type="submit">
                <x-primary-button>
                    Submit
                </x-primary-button>
                </button>
            </form>

    </div>
</x-app-layout>