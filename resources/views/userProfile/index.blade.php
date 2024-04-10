<x-app-layout>
    <p>{{$user->name}}</p>

    @if ($user->id == Auth()->user()->id)
    <form enctype="multipart/form-data" method="POST" action="{{{url('user/'. $user->id . '/upload')}}}">
        @csrf
        <input name="image_user" type="file" class="mt-4" accept="jpeg,png,gif">
        <label for="">video</label>
        <input name="video_user" type="file" class="mt-4" accept="video/*">
        <button type="submit">submit</button>
    </form>
    @endif

    @foreach($images as $image)
        <img src="{{ asset('storage/images_users/' . $image->image_user)}}" alt="User Image" class="rounded-full h-20 w-20 mb-4">
        @if ($image->video_user)
            <video class="w-auto h-56" src="{{ asset('storage/videos_users/' . $image->video_user)}}" controls></video>
        @endif
    @endforeach
</x-app-layout>