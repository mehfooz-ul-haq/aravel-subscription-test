<div>
    <div class="row mb-3">
        <label for="card_number" class="col-sm-3 col-form-label">Card Number</label>
        <div class="col-sm-9">
            <input type="text" wire:model="card_number" id="card_number" class="form-control">
            @error('card_number') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-sm-6">
            <div class="row">
                <label for="expiry_month" class="col-sm-6 col-form-label">Expiry Month</label>
                <div class="col-sm-6">
                    <input type="text" wire:model="expiry_month" id="expiry_month" class="form-control">
                    @error('expiry_month') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <label for="expiry_year" class="col-sm-5 col-form-label">Expiry Year</label>
                <div class="col-sm-7">
                    <input type="text" wire:model="expiry_year" id="expiry_year" class="form-control">
                    @error('expiry_year') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <label for="cvv" class="col-sm-3 col-form-label">CVV</label>
        <div class="col-sm-9">
            <input type="number" wire:model="cvv" id="cvv" class="form-control" maxlength="3">
            @error('cvv') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="row">
        <div class="text-center">
            <button type="button" class="btn btn-secondary" wire:click="emitPrevStep">Back</button>
        </div>
    </div>
</div>