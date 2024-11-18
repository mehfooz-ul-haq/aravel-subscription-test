<div>
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="submit">
        @if ($step === 1)
        @livewire('subscription.steps.step-one', [
        'message' => 'Hello from Parent!',
        'name' => $formData['name'] ?? ''
        ])
        @endif

        @if ($step === 2)
        @livewire('subscription.steps.step-two')
        @endif

        <!-- && $formData['subscription_type'] === 'premium' -->
        @if ($step === 3)
        @livewire('subscription.steps.step-three')
        @endif

        <div class="mt-3">
            @if ($step > 2 )
            <button type="submit" class="btn btn-primary">Submit</button>
            @endif
        </div>
    </form>
</div>