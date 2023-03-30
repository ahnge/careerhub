<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Jobseeker Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __('Update your jobseeker profile information') }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('jobseeker.update', $user->jobSeeker->id) }}" enctype="multipart/form-data"
    class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
      <x-input-label for="profile_img" :value="__('Profile Image')" />
      <div class="flex items-center mt-3">
        @if ($user->jobSeeker->profile_img)
          <img src="{{ asset($user->jobSeeker->profile_img) }}" alt="{{ $user->name }}'s logo"
            class="inline aspect-square max-w-[4rem] rounded-full mr-4">
        @else
          <img src="{{ asset('images/default_profile.svg') }}" alt="{{ $user->name }}'s logo"
            class="inline aspect-square max-w-[4rem] rounded-full mr-4">
        @endif
        <x-text-input id="profile_img" name="profile_img" type="file" class="block w-full mt-1" />
      </div>
      <x-input-error class="mt-2" :messages="$errors->get('profile_img')" />
    </div>

    <div>
      <x-input-label for="resume" :value="__('Resume')" />
      <x-text-input id="resume" name="resume" type="file" class="block w-full mt-1" />
      <x-input-error class="mt-2" :messages="$errors->get('resume')" />
    </div>

    <div>
      <x-input-label for="linkedin_url" :value="__('Linkedin')" />
      <x-text-input id="linkedin_url" name="linkedin_url" value="{{ $user->jobSeeker->linkedin_url ?? null }}"
        type="text" class="block w-full mt-1" />
      <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button type='submit'>{{ __('Save') }}</x-primary-button>
    </div>
  </form>
</section>
