<span>Please verify your email</span>
<form action=" {{ route('verification.resend') }}" method="POST">
    @csrf
    <button type="submit">Resend</button>
</form>