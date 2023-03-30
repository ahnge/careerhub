<x-app-layout>
  <div class="min-h-screen py-24 bg-white sm:py-32">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
      {{-- Header --}}
      <div class="max-w-2xl mx-auto lg:mx-0">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
          {{ __('Hiring Companies') }}
        </h2>
        <p class="mt-2 mb-6 text-lg leading-8 text-gray-600">Browse a diverse range of companies across different
          industries and discover your perfect fit. Get started on your
          career journey today.
        </p>
      </div>

      {{-- Search --}}
      <form class="mt-16 mb-10" action="{{ route('employers.index') }}" method="GET">
        <div class="flex flex-wrap items-center mb-4">
          <div class="w-full px-2 mb-4 md:w-10/12 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="title">
              Company name
            </label>
            <input
              class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white"
              id="q" name="q" type="text" placeholder="Search company name"
              value="{{ old('q', $q) }}">
          </div>

          <div class="w-full px-2 mb-4 md:w-2/12 md:mb-0 md:mt-5">
            <x-primary-button type='submit'>Search</x-primary-button>
          </div>

        </div>


      </form>

      {{-- Jobs --}}
      <div class="">
        @foreach ($employers as $employer)
          @php
            $show = true;
            if (!$employer->company_name || !$employer->industry || !$employer->about || count($employer->jobPostings) < 1) {
                $show = null;
            }
          @endphp
          @isset($show)
            <div
              class="flex flex-col p-6 mb-4 bg-white rounded-md shadow-md md:flex-row md:justify-between md:items-center">
              <div class="flex">
                @if ($employer->company_logo)
                  <div class=" max-w-[3rem] md:max-w-[5rem] aspect-auto mr-4">
                    <img src="{{ $employer->company_logo }}" alt="Company Logo Image">
                  </div>
                @endif
                <div class="flex flex-col justify-center">
                  <a href="{{ route('employers.show', $employer->slug) }}" class="transition-colors hover:text-blue-400">
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
                  {{ ucfirst($employer->location->name) }}
                </div>
                <div class="md:hidden">
                  <i class="mr-3 text-blue-400 fa-sharp fa-solid fa-industry"></i>
                  {{ $employer->industry->name }}
                </div>
              </div>
              <div class="mt-3 text-blue-400">Job Opennings: {{ count($employer->jobPostings) }}</div>
            </div>
          @endisset
        @endforeach
      </div>
      <div class="mt-10">
        {{ $employers->links() }}
      </div>
    </div>
  </div>

</x-app-layout>
