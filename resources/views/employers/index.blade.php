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
          <div class="p-6 mb-4 bg-white rounded-md shadow-md job-posting">
            <h3 class="mb-2 text-xl font-semibold">{{ $employer->company_name }}</h3>
            <div>Job Opennings: {{ count($employer->jobPostings) }}</div>
          </div>
        @endforeach
      </div>
      <div class="mt-10">
        {{ $employers->links() }}
      </div>
    </div>
  </div>

</x-app-layout>
