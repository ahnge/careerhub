@props(['url'])
<tr>
  <td class="header">
    <a href="{{ $url }}" style="display: inline-block;">
      @if (trim($slot) === 'Careerhub')
        <img src="{{ Storage::disk('s3')->url('images/careerhub.svg') }}" class="logo" alt="CareerHub Logo">
      @else
        {{ $slot }}
      @endif
    </a>
  </td>
</tr>
