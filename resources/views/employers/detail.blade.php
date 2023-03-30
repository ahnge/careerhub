<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      Company Detail
    </h2>
  </x-slot>

  <div class="px-6 min-h-[80vh] py-6 mx-auto max-w-7xl lg:px-8">
    {{-- topper --}}
    <div
      class="flex flex-col items-center py-10 overflow-hidden bg-white border-b-4 border-blue-400 shadow-xl sm:flex-row px-7 sm:rounded-lg">
      @if ($employer->company_logo)
        <img src="{{ asset($employer->company_logo) }}" alt="{{ $employer->company_name }}" class="w-32 aspect-auto">
      @endif
      <div class="mt-5 sm:mt-0 sm:ml-5">
        <div class="text-2xl font-bold">{{ $employer->company_name }}</div>
        <div class="mt-3 text-gray-500">
          <i class="mr-3 text-blue-400 fa-solid fa-location-dot"></i>{{ ucfirst($employer->location->name) }}
        </div>
        <div class="text-gray-500">
          <i class="mr-3 text-blue-400 fa-solid fa-industry"></i>{{ $employer->industry->name }}
        </div>
        <div class="text-gray-500">
          <i class="mr-3 text-blue-400 fa-solid fa-clock-rotate-left"></i>
          Member since: {{ $employer->created_at->diffForHumans() }}
        </div>
      </div>
    </div>

    {{-- about --}}
    <div class="mt-14">
      <h3 class="w-full px-5 py-2 font-bold bg-white border-l-4 border-blue-400">About Company</h3>
      <p class="mt-3">
        {{ $employer->about }}
      </p>
    </div>

    {{-- current oppenings --}}
    <div class="mt-14">
      <h3 class="w-full px-5 py-2 font-bold bg-white border-l-4 border-blue-400">Current Job openings</h3>
      <div class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-2 2xl:grid-cols-3 2xl:gap-7">
        @if ($employer->jobPostings->count() > 0)
          @foreach ($employer->jobPostings as $jobPosting)
            <div class="relative flex flex-col items-center pt-5 bg-white border-b-4 border-blue-400 shadow-lg">
              @if ($employer->company_logo)
                <img src="{{ asset($employer->company_logo) }}" class="max-w-[4rem] aspect-auto" alt="Company Logo">
              @endif

              <div class="absolute right-0 px-3 py-1 text-blue-600 bg-blue-100 top-5">
                @if ($jobPosting->type === 'remote')
                  Remote
                @elseif ($jobPosting->type === 'on_site')
                  On Site
                @endif
              </div>

              <a href="{{ route('jobpostings.show', $jobPosting->slug) }}">
                <h1 class="mt-3 text-xl font-bold transition-colors hover:text-blue-400">
                  {{ $jobPosting->title }}
                </h1>
              </a>

              <div class="mt-3 text-gray-500">
                <i class="mr-3 text-blue-400 fa-solid fa-industry"></i>{{ $jobPosting->industry->name }}
              </div>
              <div class="text-gray-500">
                <i class="mr-3 text-blue-400 fa-solid fa-compass"></i>{{ $jobPosting->jobFunction->name }}
              </div>

              <div class="px-3 py-1 mt-5 bg-gray-100 text-black/50">
                @if ($jobPosting->post > 1)
                  {{ $jobPosting->post }} Positions
                @else
                  {{ $jobPosting->post }} Position
                @endif
              </div>

              <div class="flex justify-start w-full px-5 mt-5 border-t">
                <div class="flex-1 py-3 text-center text-gray-400 border-r">
                  <i class="mr-3 text-blue-400 fa-solid fa-location-dot"></i>
                  {{ ucfirst($jobPosting->location->name) }}
                </div>
                <div class="flex-1 py-3 text-center text-gray-400">
                  <i class="mr-3 text-blue-400 fa-solid fa-clock"></i>
                  @if ($jobPosting->time === 'full_time')
                    Full time
                  @elseif ($jobPosting->time === 'part_time')
                    Part time
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        @else
          <p class="mt-3">
            There is no job openings currently.
          </p>
        @endif
      </div>
    </div>

  </div>
</x-app-layout>
