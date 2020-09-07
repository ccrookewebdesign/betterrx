<form action="/upload-image" method="post" enctype="multipart/form-data">
    @csrf
    <div class="flex-col flex">
        <label for="imageUploader" class="text-sm">Select an image*</label>

        <input id="imageUploader"
               type="file"
               name="image"
               accept="image/x-png"
               class="w-full focus:outline-none sm:w-2/5 rounded my-1 bg-betterrx-lighter p-4">

        <button type="submit"
                class="rounded bg-white text-betterrx-orange w-48 mt-2 p-3 font-bold text-xl lg:hover:shadow-lg">Submit
        </button>
    </div>
</form>
