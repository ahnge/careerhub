<x-guest-layout>
  {{-- Header --}}
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Log in') }}
    </h2>
  </x-slot>

  {{-- Form wrapper --}}
  <div class="w-full px-5 min-h-[80vh]">
    <form method="POST" class="max-w-md my-20 p-5 bg-white rounded mx-auto" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
          autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <!-- Password -->
      <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
          autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <!-- Remember Me -->
      <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
          <input id="remember_me" type="checkbox"
            class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
          <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
      </div>

      <div class="flex items-center justify-between pt-5 mt-8 border-t-2 border-gray-200">
        @if (Route::has('password.request'))
          <div class="flex flex-col space-y-1">
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              href="{{ route('password.request') }}">
              {{ __('Forgot your password?') }}
            </a>
            <a class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              href="{{ route('register') }}">
              {{ __('Don\'t haven an account?') }}
            </a>
          </div>
        @endif

        <x-primary-button class="ml-3">
          {{ __('Log in') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
