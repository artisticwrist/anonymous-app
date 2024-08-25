<!DOCTYPE html>
<html>
<head>
    <title>Create Message</title>
</head>
<body>
    <h1>Enter User Refferal code</h1>

    <form action="{{ route('send-message-form') }}" method="GET">
        @csrf
        <label for="referral_code">Input user referral code:</label>
        <input type="text" id="referral_code" name="referral_code" required>
        
        <input type="hidden" name="uid" value="{{ Auth::id() }}">
        
        <button type="submit">Submit</button>
    </form>


</body>
</html>
