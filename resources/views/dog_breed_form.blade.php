<x-navbar />
<x-app-layout>
    {{-- <img src="{{ asset($image) }}" alt="Image description"> --}}
    <div class="flex justify-center items-center pt-16">

        <div class="flex justify-center items-center border-2 w-5/12 relative min-h-80 p-2" style="background-image: url('{{ asset('images/ai.jpg') }}'); background-size: cover; border-radius:6px">
            <form action="{{ route('predict-breed') }}" method="post" enctype="multipart/form-data" class="bg-gray-200 bg-opacity-60 text-white rounded-sm pl-5 py-5 w-full	">
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

                <div>
                    <span> <button type="submit" class="btn bg-yellow-500 text-white mt-3 mr-1">Predict breed</button>
                    </span>
                    <button class="btn mt-3 bg-red-400 text-white"  onclick="window.location.href='{{ route('dog-breed-form') }}'">Clear</button>
                </span>
                </div>


            </form>
        </div>
    </div>




</x-app-layout>