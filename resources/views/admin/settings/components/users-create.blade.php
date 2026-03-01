<form method="POST" id="user-create" action="{{ route('admin.user-create') }}">
    @csrf()
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required autocapitalize="on">
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" name="password" id="password" class="form-control" minlength="4" required>
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" minlength="4" class="form-control"
            required>
    </div>
    <div class="form-group text-center">
        <button id="submit-user" class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Submit</strong>
        </button>
    </div>
</form>

