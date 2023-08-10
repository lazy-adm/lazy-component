<?php

namespace Lazyadm\LazyComponent\Tests\Components;

use Lazyadm\LazyComponent\Components\Badge;

it('should have an array of allowed sizes', function () {
    $component = new Badge();

    expect($component->allowedSizes())->toBeArray()->not()->toBeEmpty();
});

it('should have an array of allowed colors', function () {
    $component = new Badge();

    expect($component->allowedColors())->toBeArray()->not()->toBeEmpty();
});

it('can render badge', function () {
    $this
        ->blade('<x-lazy-badge>Badge</x-lazy-badge>')
        ->assertSee('badge')
        ->assertSee('Badge');

    $this
        ->blade('<x-lazy-badge label="Badge"/>')
        ->assertSee('badge')
        ->assertSee('Badge');

    $this
        ->blade("<x-lazy-badge label=\"Badge\" icon='<i class=\"fas fa-home\"></i>'/>")
        ->assertSee('badge')
        ->assertSee('Badge')
        ->assertSee('<i class="fas fa-home"></i>');

    $this
        ->blade('<x-lazy-badge label="Badge">
<x-slot:icon>
<i class="fas fa-home"></i>
</x-slot:icon>
</x-lazy-badge>')
        ->assertSee('badge')
        ->assertSee('Badge')
        ->assertSee('<i class="fas fa-home"></i>', false);
});

it('can render with colors attribute', function ($parameter, $class) {
    $this
        ->blade("<x-lazy-badge {$parameter} label='Badge label'/>")
        ->assertSee($class)
        ->assertSee('Badge label');

    $this
        ->blade("<x-lazy-badge {$parameter}>Badge label</x-lazy-badge>")
        ->assertSee('badge')
        ->assertSee('Badge label');

})->with([
    'primary' => ['primary', 'badge-primary'],
    'secondary' => ['secondary', 'badge-secondary'],
    'accent' => ['accent', 'badge-accent'],
    'info' => ['info', 'badge-info'],
    'success' => ['success', 'badge-success'],
    'warning' => ['warning', 'badge-warning'],
    'error' => ['error', 'badge-error'],
    // 'ghost'     => ['ghost', 'badge-ghost'],
]);
