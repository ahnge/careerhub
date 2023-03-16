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

  <form method="post" action="{{ route('employer.update', $user->employer->id) }}" enctype="multipart/form-data"
    class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div>
      <x-input-label for="company_name" :value="__('Company Name')" />
      <x-text-input id="company_name" name="company_name" type="text" class="block w-full mt-1" :value="old('compant_name', $user->employer->company_name)"
        required />
      <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
    </div>

    <div>
      <x-input-label for="company_logo" :value="__('Company Logo')" />
      <x-text-input id="company_logo" name="company_logo" type="file" class="block w-full mt-1" />
      <x-input-error class="mt-2" :messages="$errors->get('company_logo')" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button type='submit'>{{ __('Save') }}</x-primary-button>
    </div>
  </form>
</section>
