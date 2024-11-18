<form method="POST" action="{{ route('photo.update', $user->customer_id) }}" enctype="multipart/form-data">
    @csrf
    <div class="photo-upload">
        <img id="profileImage"
            src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/big_photoProfile.png') }}"
            alt="User Photo" class="profile-img">
        <input type="file" id="photoInput" name="photo" style="display: none;" onchange="previewImage(event)">
        <a href="#" class="camera-icon" onclick="document.getElementById('photoInput').click(); return false;">
            <div class="svg-inactive">
                @include('components.svg_cameraIcon')
            </div>
            <div class="svg-active" style="display: none;">
                @include('components.svg_cameraIconActive')
            </div>
        </a>
        <button type="submit" class="save-btn">SAVE</button>
    </div>
</form>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
</script>
