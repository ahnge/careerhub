<x-app-layout>
  {{-- Header --}}
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Update Job Posting') }}
    </h2>
  </x-slot>

  <div class="flex flex-col items-center justify-center px-5 pt-10 bg-gray-100 ">

    {{-- Form wrapper --}}
    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg lg:max-w-xl">

      <form method="POST" action="{{ route('jobpostings.update', $jobposting->slug) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
          <x-input-label for="title" :value="__('Job Title')" />
          <x-text-input id="title" class="block w-full mt-1" type="text" name="title" :value="old('title')" required
            autofocus autocomplete="title" value="{{ $jobposting->title }}" />
          <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="description">
            Job Description
          </label>
          <textarea
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="description" name="description" rows="5" placeholder="Enter job description">{{ $jobposting->description }}</textarea>
          <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="requirements">
            Job Requirements
          </label>
          <textarea
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="requirements" name="requirements" rows="5" placeholder="Enter job requirements">{{ $jobposting->requirements }}</textarea>
          <x-input-error :messages="$errors->get('requirements')" class="mt-2" />
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="type">
            Job Type
          </label>
          <div class="relative">
            <select
              class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
              id="type" name="type" required>
              <option value="" disabled>Job type</option>
              <option value="remote" @selected($jobposting->type === 'remote')>Remote</option>
              <option value="on_site" @selected($jobposting->type === 'on_site')>On-site</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
              <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                  d="M14.707 7.293a1 1 0 0 0-1.414 0L10 10.586 6.707 7.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0 0-1.414z" />
              </svg>
            </div>
          </div>
          <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="time">
            Work time
          </label>
          <div class="relative">
            <select
              class="w-full px-3 py-2 leading-tight text-gray-700 border rounded appearance-none focus:outline-none focus:shadow-outline"
              id="time" name="time" required>
              <option value="" disabled>Work time</option>
              <option value="part_time" @selected($jobposting->time === 'part_time')>Part time</option>
              <option value="full_time" @selected($jobposting->time === 'full_time')>Full time</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 pointer-events-none">
              <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                  d="M14.707 7.293a1 1 0 0 0-1.414 0L10 10.586 6.707 7.293a1 1 0 0 0-1.414 1.414l3 3a1 1 0 0 0 1.414 0l3-3a1 1 0 0 0 0-1.414z" />
              </svg>
            </div>
          </div>
          <x-input-error :messages="$errors->get('time')" class="mt-2" />
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="location">
            Location
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="location" name="location" required type="text" placeholder="City"
            value="{{ $jobposting->location->name }}">
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="salary">
            Salary
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="salary" min="0" name="salary" value="{{ $jobposting->salary }}" type="number"
            placeholder='Leave blank for "Negotiate"'>
          <x-input-error :messages="$errors->get('salary')" class="mt-2" />
        </div>
        <div class="mb-4">
          <label class="block mb-2 font-bold text-gray-700" for="salary">
            Post
          </label>
          <input
            class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
            id="post" min="1" name="post" type="number" value="{{ $jobposting->post }}"
            placeholder='How many post?'>
          <x-input-error :messages="$errors->get('post')" class="mt-2" />
        </div>
        <div class="mb-4">
          <x-input-label for="industry_id" :value="__('Select Industry')" />
          <select class="block w-full" id="industry_id" name="industry_id">
            <option value="" disabled>Select your industry
            </option>
            @foreach ($industries as $industry => $id)
              <option value="{{ $id }}" @selected($jobposting->industry->id === $id)>
                {{ $industry }}</option>
            @endforeach
          </select>
        </div>
        <div class="mb-4">
          <x-input-label for="job_function_id" :value="__('Select Functional Area')" />
          <div class="relative">
            <select class="block w-full" id="job_function_id" name="job_function_id">
              <option value="">All Functional Area</option>
              @foreach ($job_functions as $job_function => $id)
                <option value="{{ $id }}" @selected($jobposting->jobFunction->id === $id)>
                  {{ $job_function }}
                </option>
              @endforeach
            </select>
          </div>
        </div>


        <div class="flex justify-end mb-4">
          <x-primary-button type="submit" class="ml-auto">
            {{ __('Update') }}
          </x-primary-button>
        </div>
      </form>


    </div>

  </div>

</x-app-layout>
