<x-guest-layout>
  {{-- Header --}}
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Job Posting Detail') }}
    </h2>
  </x-slot>

  {{-- Body --}}
  <div class="px-5">
    <div class="max-w-xl mx-auto mt-20 overflow-hidden bg-white rounded-lg shadow">
      <div class="px-4 py-5 sm:px-6">
        <h2 class="text-lg font-medium leading-6 text-gray-900">{{ $jobPosting->title }}</h2>
        <p class="max-w-2xl mt-1 text-sm text-gray-500">{{ $jobPosting->created_at->diffForHumans() }}</p>
      </div>
      <div class="px-4 py-5 border-t border-gray-200 sm:p-0">
        <dl class="sm:divide-y sm:divide-gray-200">
          <div class="px-4 py-5 sm:flex sm:items-center sm:justify-between sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Company
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $jobPosting->employer->company_name }}
            </dd>
          </div>

          @if ($jobPosting->type === 'on_site')
            <div class="px-4 py-5 sm:flex sm:items-center sm:justify-between sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Location
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $jobPosting->location->name }}
              </dd>
            </div>
          @else
            <div class="px-4 py-5 sm:flex sm:items-center sm:justify-between sm:px-6">
              <dt class="text-sm font-medium text-gray-500">
                Location
              </dt>
              <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                {{ $jobPosting->type }}
              </dd>
            </div>
          @endif

          <div class="px-4 py-5 sm:flex sm:items-center sm:justify-between sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              Salary
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              MMK {{ $jobPosting->salary }}
            </dd>
          </div>
          <div class="px-6 py-5">
            <div class="mb-3 text-sm font-medium text-center text-gray-500">
              Description
            </div>
            <dd class="mt-1 text-sm text-left text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $jobPosting->description }}
            </dd>
          </div>
          <div class="px-6 py-5">
            <div class="mb-3 text-sm font-medium text-center text-gray-500">
              Requirements
            </div>
            <dd class="mt-1 text-sm text-left text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $jobPosting->requirements }}
            </dd>
          </div>
        </dl>
      </div>

      @guest
        <div class="px-4 py-5 sm:px-6 flex justify-center border-t border-gray-200">
          <a href="{{ route('login') }}">
            <x-primary-button>Login to apply</x-primary-button>
          </a>
        </div>
      @endguest

      @if (auth()->user() && auth()->user()->type === 'job_seeker')
        <form action="{{ route('application.store') }}" method="post"
          class="px-4 py-5 sm:px-6 flex justify-center border-t border-gray-200">
          @csrf
          <input type="hidden" name="job_seeker_id" value="{{ auth()->user()->jobSeeker->id }}">
          <input type="hidden" name="job_posting_id" value="{{ $jobPosting->id }}">
          <x-primary-button>Apply</x-primary-button>
        </form>
      @endif
    </div>
  </div>

</x-guest-layout>
