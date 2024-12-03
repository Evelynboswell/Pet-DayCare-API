<form method="POST" action="{{ route('profile.update', $user->customer_id) }}">
    @csrf
    @method('PUT')
    <h3>Profile Information</h3>
    <div class="group">
        <div class="form-group">
            <label for="name">Name</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                placeholder="Your Name" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone Number</label><br>
            <input type="text" id="phone" name="phone_number"
                value="{{ old('phone_number', $user->phone_number) }}" placeholder="Your Phone Number">
        </div>
    </div>
    <div class="group">
        <div class="form-group">
            <label for="gender">Gender</label><br>
            <select id="gender" name="gender" required>
                <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Address</label><br>
            <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                placeholder="Your Address">
        </div>
    </div>
    <button type="submit" class="save-btn">Save</button>
</form>
