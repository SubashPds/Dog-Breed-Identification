<form action="{{ route('predict-breed') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Upload a dog image:</label>
        <input type="file" name="image" id="image" class="form-control-file">
        @error('image')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Predict breed</button>
</form>