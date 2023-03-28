<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Applicants for Job Posting') }}
    </h2>
  </x-slot>

  <div class="py-12 min-h-[80vh]">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="flex justify-between p-6">
          <a href="{{ route('jobpostings.show', $jobposting->id) }}">
            <h3 class="mb-2 text-lg font-bold text-indigo-500 hover:text-indigo-700">{{ $jobposting->title }}</h3>
          </a>
          <a href="{{ back()->getTargetUrl() }}">
            <x-primary-button>Back</x-primary-button>
          </a>
        </div>

        <div class="p-6">
          <h3 class="mb-4 text-lg font-bold">{{ __('Applicants') }}</h3>
          @if ($applicants->count() > 0)
            <div class="mt-4">
              <table class="w-full table-auto">
                <thead>
                  <tr class="text-left">
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Linkedin</th>
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
                      @if ($applicant->user->jobSeeker->linkedin_url)
                        <td class="px-4 py-2 text-indigo-500 border hover:text-indigo-700">
                          <a href="{{ $applicant->user->jobSeeker->linkedin_url }}" target="_blank">
                            Linkedin
                          </a>
                        </td>
                      @else
                        <td class="px-4 py-2 border">
                          N/A
                        </td>
                      @endif
                      <td class="px-4 py-2 text-right border">
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
