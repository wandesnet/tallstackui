@php
    $computed  = $attributes->whereStartsWith('wire:model');
    $directive = array_key_first($computed->getAttributes());
    $property  = $computed[$directive];
    $customize = tallstackui_personalization('tabs', $customization())
@endphp

<div @if ($property)
         @if (!str($directive)->contains('.live'))
            x-data="tallstackui_tabs(@entangle($property))"
        @else
            x-data="tallstackui_tabs(@entangle($property).live)"
        @endif
     @else
         x-data="tallstackui_tabs(@js($selected))"
     @endif class="w-full" x-cloak
>
    <ul x-ref="tablist"
        role="tablist"
            @class($customize['wrapper'])>
        @foreach ($options as $tab)
            <li id="{{ $tab }}"
                @class($customize['item.wrapper'])
                x-on:click="select(@js($tab))"
                x-bind:aria-selected="selected(@js($tab))"
                x-bind:class="selected(@js($tab)) ? '{{ $customize['item.selected']}}' : '{{ $customize['item.unselected']}}'"
                role="tab">
                {{ $tab }}
            </li>
        @endforeach
    </ul>
    <div>
        {{ $slot }}
    </div>
</div>