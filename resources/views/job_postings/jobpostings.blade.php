<x-app-layout>
  <div class="min-h-screen py-24 bg-white sm:py-32">
    <div class="px-6 mx-auto max-w-7xl lg:px-8">
      {{-- Header --}}
      <div class="max-w-2xl mx-auto lg:mx-0">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
          {{ __('Featured Jobs') }}
        </h2>
        <p class="mt-2 mb-6 text-lg leading-8 text-gray-600">Browse through our current job openings and find your next
          career
          opportunity!</p>
      </div>

      {{-- Search --}}
      <form action="{{ route('jobpostings.index') }}" class="mt-16 mb-10" method="GET">
        <div class="flex flex-wrap mb-4">

          <div class="w-full px-2 mb-4 md:w-1/2 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="title">
              Job Title or Keyword
            </label>
            <input
              class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white"
              id="q" name="q" type="text" placeholder="Enter job title or description keyword"
              value="{{ old('q', $q) }}">
          </div>

          <div class="w-full px-2 mb-4 md:w-1/2 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="industry">
              Industry
            </label>
            <div class="relative">
              <select
                class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                id="industry" name="industry">
                <option value="">All industry</option>
                @foreach ($industries as $industry => $id)
                  <option value="{{ $id }}" {{ old('industry_id', $industry_id) == $id ? 'selected' : '' }}>
                    {{ $industry }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="w-full px-2 mb-4 md:w-1/2 md:mt-3 md:mb-0">
            <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="industry">
              Functional Area
            </label>
            <div class="relative">
              <select
                class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500"
                id="job_function" name="job_function">
                <option value="">All Functional Area</option>
                @foreach ($job_functions as $job_function => $id)
                  <option value="{{ $id }}"
                    {{ old('job_function_id', $job_function_id) == $id ? 'selected' : '' }}>
                    {{ $job_function }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="w-full px-2 mb-4 md:w-1/2 md:mt-3 md:mb-0 md:relative">
            <x-primary-button type='submit' class="md:-translate-x-1/2 md:absolute md:top-1/2 md:left-1/2">
              Search
            </x-primary-button>
          </div>
        </div>
      </form>



      {{-- Jobs --}}
      @if ($jobPostings->count() > 0)
        @foreach ($jobPostings as $jobPosting)
          <div
            class="w-full p-6 mb-4 transition-colors duration-300 ease-in bg-white border-l-8 border-white rounded-md shadow-md job-posting hover:border-blue-400">
            <div class="flex items-center justify-start">
              <h3 class="mb-2 text-xl font-semibold">{{ $jobPosting->title }}</h3>
              <div class="px-2 py-1 ml-3 text-sm text-blue-600 bg-blue-200">{{ ucfirst($jobPosting->type) }}</div>
            </div>
            <ul class="mt-3 mb-4 ml-6 list-disc">
              <li>Functional area: <span class="font-semibold">{{ ucfirst($jobPosting->jobFunction->name) }}</span>
              </li>
              <li>Industry: <span class="font-semibold">{{ $jobPosting->industry->name }}</span></li>
            </ul>
            <div class="flex">
              <i class="text-blue-400 fa-solid fa-house"></i>
              <div class="ml-3"> {{ $jobPosting->employer->company_name }} Co.,Ltd</div>
            </div>
            <div class="flex">
              <i class="text-blue-400 fa-solid fa-location-dot"></i>
              <div class="ml-3"> {{ ucfirst($jobPosting->employer->location->name) }}</div>
            </div>
            <a href="{{ route('jobpostings.show', $jobPosting->slug) }}" class="inline-block mt-5 btn btn-primary">
              <x-primary-button>View Detail</x-primary-button>
            </a>
          </div>
        @endforeach
        <div class="mt-10">
          {{ $jobPostings->links() }}
        </div>
      @else
        <div>
          There is no Job Postings.
        </div>
      @endif
    </div>
  </div>

</x-app-layout>
