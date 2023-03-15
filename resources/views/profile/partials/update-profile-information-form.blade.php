<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Profile Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __("Update your account's profile information and email address.") }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)" required
        autofocus autocomplete="name" />
      <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)" required
        autocomplete="username" />
      <x-input-error class="mt-2" :messages="$errors->get('email')" />

      @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
        <div>
          <p class="mt-2 text-sm text-gray-800">
            {{ __('Your email address is unverified.') }}

            <button form="send-verification"
              class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              {{ __('Click here to re-send the verification email.') }}
            </button>
          </p>

          @if (session('status') === 'verification-link-sent')
            <p class="mt-2 text-sm font-medium text-green-600">
              {{ __('A new verification link has been sent to your email address.') }}
            </p>
          @endif
        </div>
      @endif
    </div>

    <div>
      @if (auth()->user()->type === 'employer')
        <x-input-label for="company_name" :value="__('Company Name')" />
        <x-text-input id="company_name" name="company_name" type="text" class="block w-full mt-1" :value="old('compant_name', $user->employer->company_name)"
          required />
        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
      @endif
    </div>

    <div>
      @if (auth()->user()->type === 'employer')
        <x-input-label for="company_logo" :value="__('Company Logo')" />
        <x-text-input id="company_logo" name="company_logo" type="file" class="block w-full mt-1" />
        <x-input-error class="mt-2" :messages="$errors->get('company_logo')" />
      @else
        <x-input-label for="profile_img" :value="__('Profile Image')" />
        <x-text-input id="profile_img" name="profile_img" type="file" class="block w-full mt-1" />
        <x-input-error class="mt-2" :messages="$errors->get('profile_img')" />
      @endif
    </div>

    <div>
      @if (auth()->user()->type === 'job_seeker')
        <x-input-label for="resume" :value="__('Resume')" />
        <x-text-input id="resume" name="resume" type="file" class="block w-full mt-1" />
        <x-input-error class="mt-2" :messages="$errors->get('resume')" />
      @endif
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button>{{ __('Save') }}</x-primary-button>

      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
          {{ __('Saved.') }}</p>
      @endif
    </div>
  </form>
</section>
