<x-guest-layout>
  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
          <div class="text-2xl">
            {{ $user->name }}'s Profile
          </div>

          <div class="mt-6">
            <div class="flex">
              <div class="w-1/3 font-bold">Email:</div>
              <div class="w-2/3">{{ $user->email }}</div>
            </div>
            <div class="flex">
              <div class="w-1/3 font-bold">Location:</div>
              <div class="w-2/3">{{ $user->location }}</div>
            </div>
            <div class="flex">
              <div class="w-1/3 font-bold">Skills:</div>
              <div class="w-2/3">{{ $user->skills }}</div>
            </div>
            <div class="flex">
              <div class="w-1/3 font-bold">Resume:</div>
              <div class="w-2/3">
                Resume
                {{-- <a href="{{ route('job_seeker.resume', $user->id) }}" class="text-blue-500 hover:underline">View
                  Resume</a> --}}
              </div>
            </div>
          </div>

          <div class="flex justify-end mt-6">
            Edit Profile
            {{-- <a href="{{ route('job_seeker.edit_profile') }}"
              class="px-4 py-2 mr-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Edit Profile</a> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>
