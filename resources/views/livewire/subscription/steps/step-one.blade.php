<div>
    <div class="row mb-3">
        <label for="name" class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-9">
            <input type="text" wire:model="data.name" id="name" class="form-control">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="email" class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="text" wire:model="data.email" id="email" class="form-control">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="phone" class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-9">
            <input type="text" wire:model="data.phone" id="phone" class="form-control">
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="phone" class="col-sm-3 col-form-label">Subscription Type</label>
        <div class="col-sm-9">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model="data.subscription_type" id="free" value="free">
                <label class="form-check-label" for="free">Free</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" wire:model="data.subscription_type" id="premium" value="premium">
                <label class="form-check-label" for="premium">Premium</label>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="text-center">
            <button type="button" class="btn btn-primary" wire:click="emitNextStep">Next</button>
        </div>
    </div>