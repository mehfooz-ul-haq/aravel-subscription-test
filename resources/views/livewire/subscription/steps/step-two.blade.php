<div>
    <div class="row mb-3">
        <label for="address_1" class="col-sm-3 col-form-label">Address 1</label>
        <div class="col-sm-9">
            <input type="text" wire:model="address_1" id="address_1" class="form-control">
            @error('address_1') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="address_2" class="col-sm-3 col-form-label">Address 2</label>
        <div class="col-sm-9">
            <input type="text" wire:model="address_2" id="address_2" class="form-control">
            @error('address_2') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="postal_code" class="col-sm-3 col-form-label">Postal code</label>
        <div class="col-sm-9">
            <input type="text" wire:model="postal_code" id="postal_code" class="form-control">
            @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="state" class="col-sm-3 col-form-label">State/Province</label>
        <div class="col-sm-9">
            <input type="text" wire:model="state" id="state" class="form-control">
            @error('state') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="country" class="col-sm-3 col-form-label">Country</label>
        <div class="col-sm-9">
            <input type="text" wire:model="country" id="country" class="form-control">
            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="row">
        <div class="text-center">
            <button type="button" class="btn btn-secondary" wire:click="emitPrevStep">Back</button>
            <button type="button" class="btn btn-primary" wire:click="emitNextStep">Next</button>
        </div>
    </div>
</div>