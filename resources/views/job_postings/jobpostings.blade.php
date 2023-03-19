<x-app-layout>
  <div class="py-24 bg-white sm:py-32">
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

      {{-- Jobs --}}
      <div class="">
        @foreach ($jobPostings as $jobPosting)
          <div
            class="w-full p-6 mb-4 transition-colors duration-300 ease-in bg-white border-l-8 border-white rounded-md shadow-md job-posting hover:border-blue-400">
            <div class="flex items-center justify-start">
              <h3 class="mb-2 text-xl font-semibold">{{ $jobPosting->title }}</h3>
              <div class="px-2 py-1 ml-3 text-sm text-blue-600 bg-blue-200">{{ ucfirst($jobPosting->time) }}</div>
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
              <div class="ml-3"> {{ $jobPosting->employer->location->name }}</div>
            </div>
            <a href="{{ route('jobpostings.show', $jobPosting->id) }}" class="inline-block mt-5 btn btn-primary">
              <x-primary-button>View Detail</x-primary-button>
            </a>
          </div>
        @endforeach
      </div>
      <div class="mt-10">
        {{ $jobPostings->links() }}
      </div>
    </div>
  </div>

</x-app-layout>
