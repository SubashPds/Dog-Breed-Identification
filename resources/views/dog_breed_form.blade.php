<x-navbar/>
<x-app-layout>
    <img src="{{ asset($image) }}" alt="Image description">

<div class="flex justify-center items-center pt-16">
    <form action="{{ route('predict-breed') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group disple">
            <label for="image">Upload a dog image:</label>
            <input type="file" name="image" id="image" class="form-control-file" onchange="displayImage(event)" required>
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <script>
            function displayImage(event) {
              var image = document.getElementById('preview');
              image.src = URL.createObjectURL(event.target.files[0]);
              image.style.display = "block";
            }
            </script>
            
            <img id="preview" style="display:none; width:120px;" />
        <button type="submit" class="btn btn-primary mt-3">Predict breed</button>
    </form>
</div>


@include('components.result', ['breed' => $breed ?? null,'image'=>$image ?? null])

</x-app-layout>


