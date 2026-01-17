@props([
    'date' => '',
    'name' => '',
    'user_name' => '',
])


<div class="small text-end d-flex justify-content-between align-items-center mb-1 ">
    <span class="fw-bold">{{ $date }}</span>
    <span class="text-secondary user" data-bs-toggle="tooltip" data-bs-html="true" data-bs-title="{{ $name }}">
        {{ $user_name }}
    </span>
</div>
