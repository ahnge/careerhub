<x-guest-layout>
  <x-slot name="header" class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
  </x-slot>

  <div class="w-full min-h-[75vh] px-5">
    <form method="POST" class="max-w-md my-20 p-5 bg-white rounded mx-auto" action="{{ route('password.email') }}">
      @csrf

      <!-- Email Address -->
      <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
          autofocus />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div class="flex items-center justify-end mt-4">
        <x-primary-button>
          {{ __('Email Password Reset Link') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
