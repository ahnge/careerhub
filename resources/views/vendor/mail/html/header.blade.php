@props(['url'])
<tr>
  <td class="header">
    <a href="{{ $url }}" style="display: inline-block;">
      @if (trim($slot) === 'Jobboard')
        <img src="{{ asset('images/jobboard.svg') }}" class="logo" alt="Job Board Logo">
      @else
        {{ $slot }}
      @endif
    </a>
  </td>
</tr>
