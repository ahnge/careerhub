<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Admin Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12 min-h-[80vh]">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
          <div class="flex items-center justify-between mb-4">
            <h1 class="text-2xl font-medium">Your Company's Job Postings</h1>
            <a href="{{ route('jobpostings.create') }}"
              class="px-4 py-2 text-white bg-indigo-500 rounded hover:bg-indigo-600">Create Job Posting</a>
          </div>
          <div class="mt-4">
            <table class="w-full table-auto">
              <thead>
                <tr class="text-left">
                  <th class="px-4 py-2">Title</th>
                  <th class="px-4 py-2">Applicants</th>
                  <th class="px-4 py-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($jobPostings as $jobPosting)
                  <tr>
                    <td class="px-4 py-2 border">
                      <a class="text-indigo-500 hover:text-indigo-700"
                        href="{{ route('jobpostings.show', $jobPosting->slug) }}">
                        {{ $jobPosting->title }}
                      </a>
                    </td>
                    <td class="px-4 py-2 border">
                      @if (count($jobPosting->applicants) > 0)
                        @php
                          $count = count($jobPosting->applicants);
                        @endphp
                        <a class="text-indigo-500 hover:text-indigo-700"
                          href="{{ route('jobposting.applications', $jobPosting->slug) }}">See all {{ $count }}
                          Applicants</a>
                      @else
                        <p>No applicants yet</p>
                      @endif
                    </td>
                    <td class="px-4 py-2 border">
                      <a href="{{ route('jobpostings.edit', $jobPosting->slug) }}"
                        class="mr-2 text-indigo-500 hover:text-indigo-700">Edit</a>
                      <form action="{{ route('jobpostings.destroy', $jobPosting->slug) }}" method="POST"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-10">
              {{ $jobPostings->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
