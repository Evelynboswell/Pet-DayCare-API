<form id="deleteForm" method="POST" action="{{ route('profile.delete', $user->customer_id) }}">
    @csrf
    @method('DELETE')
    <h3>Delete Account</h3>
    <label id="warningText">Once your account is deleted, all of its data will be permanently deleted</label><br>
    <button type="button" class="delete-btn" onclick="confirmDelete()">Delete</button>
</form>

<script>
    function confirmDelete() {
        if (confirm("Are you sure you want to DELETE your account?")) {
            document.getElementById('deleteForm').submit();
        }
    }
</script>
