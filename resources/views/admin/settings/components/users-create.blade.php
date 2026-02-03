<form method="POST" id="user-create">
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
<script>
    $(document).ready(function() {
        $('#user-create').on('submit', function(e) {
            e.preventDefault();

            const password = $('#password').val();
            const confirm = $('#confirm_password').val();

            if (password !== confirm) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Password mismatch',
                    text: 'Passwords do not match.'
                });
                return;
            }

            const btn = $('#submit-user');
            btn.prop('disabled', true);

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.user-create') }}',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'AJAX Error',
                        text: 'An unexpected error occurred. Please try again.'
                    });
                },
                complete: function() {
                    btn.prop('disabled', false);
                }
            });
        });
    });
</script>
