<form method="POST" id="user-update">
    @csrf()
     <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" value="{{ Auth::user()->username ?? '' }}" class="form-control" >
    </div>
    <div class="form-group">
        <label>Role</label>
        <input type="text" name="role" value="{{ Auth::user()->role ?? 'Guest' }}" class="form-control" readonly>
    </div>


    <div class="form-group text-center">
        <button class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Submit</strong>
        </button>
    </div>
</form>
