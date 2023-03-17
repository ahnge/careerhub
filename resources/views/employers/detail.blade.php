<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      Company Detail
    </h2>
  </x-slot>

  <div class="py-6 mx-auto max-w-7xl px-6 lg:px-8">
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
      <div class="p-6">
        @if ($employer->company_logo)
          <div class="flex items-center justify-center mb-6">
            <img src="{{ asset($employer->company_logo) }}" alt="{{ $employer->company_name }}"
              class="w-32 h-32 rounded-full">
          </div>
        @endif

        <div class="flex justify-between">
          <h1 class="text-2xl font-bold">{{ $employer->company_name }}</h1>
          <a href="{{ back()->getTargetUrl() }}">
            <x-primary-button>Back</x-primary-button>
          </a>
        </div>

        <div class="mt-4">
          <h2 class="mb-2 text-lg font-semibold">Contact Information</h2>
          <ul class="ml-8 list-disc">
            <li>Email: {{ $employer->user->email }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
