<x-app-layout>
  <div class="min-h-screen py-24 bg-white sm:py-32">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
      {{-- Header --}}
      <div class="max-w-2xl mx-auto lg:mx-0">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
          {{ __('Hiring Companies') }}
        </h2>
        <p class="mt-2 mb-6 text-lg leading-8 text-gray-600">Browse through our current job openings and find your next
          career
          opportunity!</p>
      </div>

      {{-- Jobs --}}
      <div class="">
        @foreach ($employers as $employer)
          <div
            class="flex flex-col p-6 mb-4 bg-white rounded-md shadow-md md:flex-row md:justify-between md:items-center">
            <div class="flex">
              @if ($employer->company_logo)
                <div class=" max-w-[3rem] md:max-w-[5rem] aspect-square mr-4">
                  <img src="{{ $employer->company_logo }}" alt="Company Logo Image">
                </div>
              @endif
              <div class="flex flex-col justify-center">
                <a href="{{ route('employers.show', $employer->id) }}" class="transition-colors hover:text-blue-400">
                  <h3 class="mb-2 text-xl font-semibold md:mb-0">{{ $employer->company_name }}</h3>
                </a>
                <div class="hidden md:block">
                  <i class="mr-3 text-blue-400 fa-sharp fa-solid fa-industry"></i>
                  {{ $employer->industry->name }}
                </div>
              </div>
            </div>
            <div class="mt-2">
              <div>
                <i class="mr-3 text-blue-400 fa-solid fa-location-dot"></i>
                {{ $employer->location->name }}
              </div>
              <div class="md:hidden">
                <i class="mr-3 text-blue-400 fa-sharp fa-solid fa-industry"></i>
                {{ $employer->industry->name }}
              </div>
            </div>
            <div class="mt-3 text-blue-400">Job Opennings: {{ count($employer->jobPostings) }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-10">
        {{ $employers->links() }}
      </div>
    </div>
  </div>

</x-app-layout>
