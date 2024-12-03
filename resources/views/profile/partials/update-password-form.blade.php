<form method="POST" action="{{ route('password.update', $user->customer_id) }}">
    @csrf
    @method('PUT')
    <h3>Change Password</h3>
    <div class="group">
        <div class="form-group">
            <label for="current-password">Current Password</label><br>
            <input type="password" id="current-password" name="current_password" placeholder="Current Password" required>
        </div>
        <div class="form-group">
            <label for="new-password">New Password</label><br>
            <input type="password" id="new-password" name="new_password" placeholder="New Password" required>
        </div>
        <div class="form-group">
            <label for="confirm-new-password">Confirm New Password</label><br>
            <input type="password" id="confirm-new-password" name="new_password_confirmation" placeholder="Confirm New Password" required>
        </div>
    </div>

    <button type="submit" class="save-btn">Save</button>
</form>
