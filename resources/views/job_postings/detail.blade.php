<x-guest-layout>
  {{-- Header --}}
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Job Posting Detail') }}
    </h2>
  </x-slot>

  <div class="px-6 py-6 mx-auto max-w-7xl lg:px-8">
    {{-- topper --}}
    <div
      class="relative flex flex-col items-center py-10 overflow-hidden bg-white border-b-4 border-blue-400 shadow-xl sm:flex-row px-7 sm:rounded-lg">

      @if ($jobPosting->employer->company_logo)
        <a href="{{ route('employers.show', $jobPosting->employer->slug) }}">
          <img src="{{ asset($jobPosting->employer->company_logo) }}" alt="{{ $jobPosting->employer->company_name }}"
            class="w-32 aspect-auto">
        </a>
      @endif

      <div class="absolute right-0 flex flex-col space-y-3 top-5">
        <div class="px-2 py-1 ml-3 text-sm text-blue-600 bg-blue-200">{{ ucfirst($jobPosting->type) }}</div>
        <div class="px-2 py-1 ml-3 text-sm text-blue-600 bg-blue-200">{{ ucfirst($jobPosting->time) }}</div>
      </div>

      <div class="mt-5 sm:mt-0 sm:ml-5">
        <div class="text-2xl font-bold">{{ $jobPosting->title }}</div>
        <a href="{{ route('employers.show', $jobPosting->employer->slug) }}">
          <div class="mt-2 text-xl font-bold hover:text-blue-400">{{ $jobPosting->employer->company_name }}</div>
        </a>
        <div class="mt-3 text-gray-500">
          <i class="mr-3 text-blue-400 fa-solid fa-location-dot"></i>{{ ucfirst($jobPosting->location->name) }}
        </div>
        <div class="text-gray-500">
          <i class="mr-3 text-blue-400 fa-solid fa-industry"></i>{{ $jobPosting->industry->name }}
        </div>
        <div class="mb-5 text-gray-500">
          <i class="mr-3 text-blue-400 fa-solid fa-compass"></i>{{ $jobPosting->jobFunction->name }}
        </div>

        @if (auth()->user() && auth()->user()->type === 'job_seeker')
          <form action="{{ route('application.store') }}" method="post">
            @csrf
            @method('post')
            <input type="hidden" name="job_seeker_id" value={{ auth()->user()->jobSeeker->id }}>
            <input type="hidden" name="job_posting_id" value={{ $jobPosting->id }}>
            <x-primary-button type="submit">Apply now</x-primary-button>
          </form>
        @endif

        @guest
          <a href="{{ route('login') }}" class="self-center ">
            <x-primary-button>Login to apply</x-primary-button>
          </a>
        @endguest
      </div>

    </div>

    {{-- Job Description --}}
    <div class="mt-14">
      <h3 class="w-full px-5 py-2 font-bold bg-white border-l-4 border-blue-400">Job Description</h3>
      <p class="mt-3">
        {{ $jobPosting->description }}
      </p>
    </div>

    {{-- Job Requirememts --}}
    <div class="mt-14">
      <h3 class="w-full px-5 py-2 font-bold bg-white border-l-4 border-blue-400">Job Requirements</h3>
      <p class="mt-3">
        {{ $jobPosting->requirements }}
      </p>
    </div>

    {{-- Job Positions --}}
    <div class="mt-14">
      <h3 class="w-full px-5 py-2 font-bold bg-white border-l-4 border-blue-400">Posts</h3>
      <p class="mt-3">
        Posts:
        {{ $jobPosting->post }}
      </p>
    </div>

    {{-- Related Jobs --}}
    <div class="mt-14">
      <h3 class="w-full px-5 py-2 font-bold bg-white border-l-4 border-blue-400">Related Jobs</h3>
      <div class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-2 2xl:grid-cols-3 2xl:gap-7">
        @if ($relatedJobPostings->count() > 0)
          @foreach ($relatedJobPostings as $relatedJobPosting)
            <div class="relative flex flex-col items-center pt-5 pb-16 bg-white border-b-4 border-blue-400 shadow-lg">
              @if ($relatedJobPosting->employer->company_logo)
                <img src="{{ asset($relatedJobPosting->employer->company_logo) }}" class="max-w-[4rem] aspect-auto"
                  alt="Company Logo">
              @endif

              <div class="absolute right-0 px-3 py-1 text-blue-600 bg-blue-100 top-5">
                @if ($relatedJobPosting->type === 'remote')
                  Remote
                @elseif ($relatedJobPosting->type === 'on_site')
                  On Site
                @endif
              </div>

              <a href="{{ route('jobpostings.show', $relatedJobPosting->slug) }}">
                <h1 class="mt-3 text-xl font-bold transition-colors hover:text-blue-400">
                  {{ $relatedJobPosting->title }}
                </h1>
              </a>

              <div class="mt-3 text-gray-500">
                <i class="mr-3 text-blue-400 fa-solid fa-industry"></i>{{ $relatedJobPosting->industry->name }}
              </div>
              <div class="text-gray-500">
                <i class="mr-3 text-blue-400 fa-solid fa-compass"></i>{{ $relatedJobPosting->jobFunction->name }}
              </div>

              <div class="px-3 py-1 mt-5 bg-gray-100 text-black/50">
                @if ($relatedJobPosting->post > 1)
                  {{ $relatedJobPosting->post }} Positions
                @else
                  {{ $relatedJobPosting->post }} Position
                @endif
              </div>

              <div class="absolute bottom-0 flex justify-start w-full px-5 mt-5 border-t">
                <div class="flex-1 py-3 text-center text-gray-400 border-r">
                  <i class="mr-3 text-blue-400 fa-solid fa-location-dot"></i>
                  {{ ucfirst($relatedJobPosting->location->name) }}
                </div>
                <div class="flex-1 py-3 text-center text-gray-400">
                  <i class="mr-3 text-blue-400 fa-solid fa-clock"></i>
                  @if ($relatedJobPosting->time === 'full_time')
                    Full time
                  @elseif ($relatedJobPosting->time === 'part_time')
                    Part time
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        @else
          <p class="mt-3">
            There is no related job postings currently.
          </p>
        @endif
      </div>
    </div>

  </div>
</x-guest-layout>
