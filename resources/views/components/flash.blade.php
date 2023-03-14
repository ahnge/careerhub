{{-- class="absolute right-10 top-20 py-3 px-4 rounded bg"- --}}
@props(['status', 'flash'])

@php
  switch ($status) {
      case 'success':
          $classes = 'py-3 px-4 rounded bg-success';
          break;
      case 'error':
          $classes = 'py-3 px-4 rounded bg-error';
          break;
      case 'warning':
          $classes = 'py-3 px-4 rounded bg-warning';
          break;
  
      default:
          $classes = 'py-3 px-4 rounded bg-warning';
          break;
  }
@endphp
<div x-data="{ show: true }" x-init="setTimeout(() => show = false, 2000)" class="fixed right-10 top-20 z-50">
  <div x-show="show" {{ $attributes->merge(['class' => $classes]) }}>
    <p class="inline-block mr-3">{{ $flash }}</p>
    <button @click="show = false" class="px-2 py-1 text-white hover:bg-gray-700 inline-block rounded">
      X
    </button>
  </div>
</div>
