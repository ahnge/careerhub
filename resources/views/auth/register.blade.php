<x-guest-layout>
  {{-- Header --}}
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Register account') }}
    </h2>
  </x-slot>

  <div class="w-full px-5 min-h-[80vh]">
    <form method="POST" class="max-w-md my-20 p-5 bg-white rounded mx-auto" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
          autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <!-- Email Address -->
      <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
          autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Account Type -->
      <div class="mt-4">
        <x-input-label for="type" :value="__('Account Type')" />
        <x-selector class="block w-full mt-1" name="type" id="type" />
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
          autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Confirm Password -->
      <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

        <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation"
          required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          href="{{ route('login') }}">
          {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ml-4">
          {{ __('Register') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
