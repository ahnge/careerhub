{{-- class="absolute px-4 py-3 rounded right-10 top-20 bg"- --}}
@props(['flashes'])


<div class="fixed z-50 right-3 md:right-10 top-20">
  @foreach ($flashes as $flash)
    @php
      $classes = 'py-3 px-4 rounded';
      if ($flash['status'] ?? false) {
          switch ($flash['status']) {
              case 'success':
                  $classes .= ' bg-success';
                  break;
      
              case 'error':
                  $classes .= ' bg-error';
                  break;
      
              case 'warning':
                  $classes .= ' bg-warning';
                  break;
      
              default:
                  $classes .= ' bg-error';
                  break;
          }
      } else {
          $classes .= ' bg-error';
      }
    @endphp
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" class="mt-5">
      <div x-show="show" {{ $attributes->merge(['class' => $classes]) }}>
        <p class="inline-block mr-3">{{ $flash['message'] ?? $flash }}</p>
        <button x-on:click="show = false" class="inline-block px-2 py-1 text-white rounded hover:bg-gray-700">
          X
        </button>
      </div>
    </div>
  @endforeach
</div>
