<h1>Create Message</h1>

<form method="POST" action="{{ url('/api/create-message') }}">
    @csrf
    <label for="referral_code">Message</label>
    <input type="text" id="message" name="message" required>
    
    <input type="text" name="uid" value="{{ Auth::id() }}">
    <input type="text" name="ruid" value="{{ $ruid }}">
    
    <button type="submit">Submit</button>
</form>