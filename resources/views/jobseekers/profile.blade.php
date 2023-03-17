<x-guest-layout>
  <div class="px-5 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="px-4 py-5 bg-white rounded-lg shadow sm:p-6">
      <div class="flex flex-col items-center justify-center">
        @if ($user->jobSeeker->profile_img)
          <img src="{{ asset($user->jobSeeker->profile_img) }}" alt="Profile Image"
            class="object-cover w-32 h-32 rounded-full">
        @else
          <div class="flex items-center justify-center w-32 h-32 bg-gray-100 rounded-full">
            <svg class="w-20 h-20 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
        @endif

        <h2 class="mt-4 text-xl font-bold">{{ $user->name }}</h2>
        <p class="mt-2 text-gray-600">{{ $user->email }}</p>

        <!-- Resume download button -->
        @unless(auth()->user()->id === $user->id)
          @if ($user->jobSeeker->resume)
            <div class="mt-4">
              <a href="{{ Storage::url($user->jobSeeker->resume) }}" download="{{ $user->name }}'s_resume"
                class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                Download Resume
              </a>
            </div>
          @endif
        @endunless

        @auth
          @if (auth()->user()->id === $user->id)
            <a href="{{ route('profile.edit', $user) }}"
              class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Edit Profile
            </a>
          @endif
        @endauth
      </div>
    </div>
  </div>
</x-guest-layout>
