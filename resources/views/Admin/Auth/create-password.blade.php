<form method="POST" action="{{ route('save-password') }}">
    @csrf
    <div class="form-group">
        <input hidden value= "{{$title}}" type="email" name="email" id="email" class="form-control">
        <label for="password">Yeni Şifre</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Şifre Oluştur</button>
</form>
