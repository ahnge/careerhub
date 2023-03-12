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
          <div class="p-6 mb-4 bg-white rounded-md shadow-md job-posting">
            <h3 class="mb-2 text-xl font-semibold">{{ $jobPosting->title }}</h3>
            <p class="mb-4">{{ $jobPosting->description }}</p>
            <ul class="mb-4 ml-6 list-disc">
              <li>Type: <span class="font-semibold">{{ ucfirst($jobPosting->type) }}</span></li>
              <li>Time: <span class="font-semibold">{{ ucfirst($jobPosting->time) }}</span></li>
              <li>Salary: <span class="font-semibold">${{ number_format($jobPosting->salary, 2) }}</span></li>
              <li>Location: <span class="font-semibold">{{ $jobPosting->location->name }}</span></li>
            </ul>
            <a href="/jobposting/{{ $jobPosting->id }}" class="inline-block btn btn-primary">View Details</a>
          </div>
        @endforeach
      </div>
    </div>
  </div>

</x-app-layout>
