<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Applicants for Job Posting') }}
    </h2>
  </x-slot>

  <div class="py-12 min-h-[80vh]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 flex justify-between">
          <a href="{{ route('jobpostings.show', $jobposting->id) }}">
            <h3 class="font-bold text-lg text-indigo-500 hover:text-indigo-700 mb-2">{{ $jobposting->title }}</h3>
          </a>
          <a href="{{ back()->getTargetUrl() }}">
            <x-primary-button>Back</x-primary-button>
          </a>
        </div>

        <div class="p-6">
          <h3 class="font-bold text-lg mb-4">{{ __('Applicants') }}</h3>
          @if ($applicants->count() > 0)
            <div class="mt-4">
              <table class="w-full table-auto">
                <thead>
                  <tr class="text-left">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2 text-right">Resume</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($applicants as $applicant)
                    <tr>
                      <td class="px-4 py-2 border">
                        {{ ucfirst($applicant->user->name) }}
                      </td>
                      <td class="px-4 py-2 border">
                        {{ $applicant->user->email }}
                      </td>
                      <td class="px-4 py-2 border text-right">
                        <a href="{{ Storage::url($applicant->resume) }}"
                          download="{{ $applicant->user->name }}'s_resume"
                          class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                          Download Resume
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="mt-10">
                {{ $applicants->links() }}
              </div>
            </div>
          @else
            <p>{{ __('No applications yet.') }}</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
