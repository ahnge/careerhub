<section>
  <header>
    <h2 class="text-lg font-medium text-gray-900">
      {{ __('Company Information') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600">
      {{ __('Update your company information') }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('employer.update', $user->employer->slug) }}" enctype="multipart/form-data"
    class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
      <x-input-label for="company_name" :value="__('Company Name')" />
      <x-text-input id="company_name" name="company_name" type="text" class="block w-full mt-1" :value="old('company_name', $user->employer->company_name)"
        required />
    </div>

    <div>
      <x-input-label for="company_logo" :value="__('Company Logo')" />
      <div class="flex items-center mt-3">
        @if ($user->employer->company_logo)
          <img src="{{ asset($user->employer->company_logo) }}" alt="{{ $user->employer->company_name }}'s logo"
            class="inline aspect-square max-w-[4rem] rounded-full mr-4">
        @else
          <img src="{{ asset('images/default_profile.svg') }}" alt="{{ $user->employer->company_name }}'s logo"
            class="inline aspect-square max-w-[4rem] rounded-full mr-4">
        @endif
        <x-text-input id="company_logo" name="company_logo" type="file" class="block w-full mt-1" />
      </div>
    </div>

    <div>
      <x-input-label for="industry_id" :value="__('Select Industry')" />
      <select class="block w-full" id="industry_id" name="industry_id">
        <option value="" disabled {{ !$current_industry_id ? 'selected ' : null }}>Select your industry</option>
        @foreach ($industries as $industry => $id)
          <option value="{{ $id }}" @selected(old('current_industry_id', $current_industry_id) == $id)>
            {{ $industry }}</option>
        @endforeach
      </select>
    </div>

    <div>
      <x-input-label for="about" :value="__('About Company')" />
      <textarea name="about" id="about" class="block w-full" cols="30" rows="7">{{ old('about', $user->employer->about ?? null) }}</textarea>
    </div>

    <div>
      <x-input-label for="location" :value="__('Headquarter location')" />
      <x-text-input id="location" name="location" type="text" class="block w-full mt-1" :value="old('location', $user->employer->location->name ?? null)" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button type='submit'>{{ __('Save') }}</x-primary-button>
    </div>
  </form>
</section>
