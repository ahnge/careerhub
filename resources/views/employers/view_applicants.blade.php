<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Applicants for Job Posting') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 flex justify-between">
          <a href="{{ route('jobpostings.show', $jobposting->id) }}">
            <h3 class="font-bold text-lg mb-2">{{ $jobposting->title }}</h3>
          </a>
          <a href="{{ route('jobpostings.admin') }}">
            <x-primary-button>Back</x-primary-button>
          </a>
        </div>

        <div class="p-6">
          <h3 class="font-bold text-lg mb-4">{{ __('Applicants') }}</h3>
          @if ($applicants->count() > 0)
            <ul>
              @foreach ($applicants as $applicant)
                <li>
                  <a href="{{ route('jobseeker.profile', $applicant->user->jobSeeker->id) }}"
                    class="text-blue-600 hover:text-blue-800">
                    {{ $applicant->user->name }}
                  </a>
                </li>
              @endforeach
            </ul>
          @else
            <p>{{ __('No applications yet.') }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
