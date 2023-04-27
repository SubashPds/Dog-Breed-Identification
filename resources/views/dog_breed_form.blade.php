<x-navbar />
<x-app-layout>
    {{-- <img src="{{ asset($image) }}" alt="Image description"> --}}
    <div class="flex justify-center items-center pt-16">
        <div class="flex justify-center items-center border-2 w-96 px-12 py-2">
            <form action="{{ route('predict-breed') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group disple">
                    <label for="image">Upload a dog image:</label>
                    <input type="file" name="image" id="image" class="form-control-file" onchange="displayImage(event)"
                        required>
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
                @include('components.result', ['breed' => $breed ?? null,'image'=>$image ?? null])

                    <span> <button type="submit" class="btn bg-yellow-500 text-white mt-3 mr-1">Predict breed</button>
                    </span>
             


            </form>
            {{-- <div class="mt-28 mr-4"> <a href="{{ route('about.show') }}"><button class="btn bg-red-400 text-white">Clear</button></a>
            </div> --}}
        </div>
    </div>




</x-app-layout>