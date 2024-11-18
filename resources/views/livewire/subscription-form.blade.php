<div>
    @if (session()->get('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header h4">User Subscription</div>
        <div class="card-body">
            <form wire:submit.prevent="submit">

                @if ($step == 1)
                    <div class="row mb-3">
                        <label for="name" class="col-sm-3 col-form-label">Name *</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.name" id="name" class="form-control">
                            @error('data.name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-3 col-form-label">Email *</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.email" id="email" class="form-control">
                            @error('data.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-sm-3 col-form-label">Phone *</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.phone" id="phone" class="form-control">
                            @error('data.phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="subscription_type" class="col-sm-3 col-form-label">Subscription Type *</label>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input wire:model.lazy="data.subscription_type" class="form-check-input" type="radio"
                                    id="free" value="free">
                                <label class="form-check-label" for="free">
                                    Free
                                </label>
                            </div>
                            <div class="form-check">
                                <input wire:model.lazy="data.subscription_type" class="form-check-input" type="radio"
                                    id="premium" value="premium">
                                <label class="form-check-label" for="premium">
                                    Premium
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-secondary" type="button" wire:click="nextStep">Next</button>
                    </div>
                @endif

                @if ($step == 2)

                    <div class="row mb-3">
                        <label for="country" class="col-sm-3 col-form-label">Country *</label>
                        <div class="col-sm-9">
                            <select wire:model.lazy="data.country" id="country" class="form-control">
                                @foreach ($this->countries() as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                            @error('data.country')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address_1" class="col-sm-3 col-form-label">Address *</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.address_1" id="address_1" class="form-control">
                            @error('data.address_1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address_2" class="col-sm-3 col-form-label">Address 2</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.address_2" id="address_2" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="postal_code" class="col-sm-3 col-form-label">Postal Code </label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.postal_code" id="postal_code"
                                class="form-control">
                            @error('data.postal_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="state" class="col-sm-3 col-form-label">State/Province </label>
                        <div class="col-sm-9">
                            <input type="text" wire:model.lazy="data.state" id="state" class="form-control">
                            @error('data.state')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-secondary" type="button" wire:click="prevStep">Previous</button>
                        <button class="btn btn-secondary" type="button" wire:click="nextStep">Next</button>
                    </div>
                @endif

                @if ($step == 3)
                    <div class="row mb-3">
                        <label for="card_number" class="col-sm-3 col-form-label">Card Number *</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model="data.card_number" id="card_number"
                                class="form-control" wire:change="creditCardMasking">
                            @error('data.card_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <div class="row">
                                <label for="expiry_month" class="col-sm-6 col-form-label">Expiry Month</label>
                                <div class="col-sm-6">
                                    <select wire:model.lazy="data.expiry_month" id="expiry_month"
                                        class="form-control" wire:change="creditCardExpiry">
                                        @foreach ($this->months() as $code => $name)
                                            <option value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('data.expiry_month')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <label for="expiry_year" class="col-sm-5 col-form-label">Expiry Year *</label>
                                <div class="col-sm-7">
                                    <select wire:model.lazy="data.expiry_year" id="expiry_year" class="form-control"
                                        wire:change="creditCardExpiry">
                                        @for ($i = date('Y'); $i <= date('Y') + 20; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('data.expiry_year')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($cardExpiry)
                        <div class="row mb-3">
                            <label for="cvv" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-7 text-danger">Please user a valid card having future expiry date</div>
                        </div>
                    @endif

                    <div class="row mb-3">
                        <label for="cvv" class="col-sm-3 col-form-label">CVV *</label>
                        <div class="col-sm-2">
                            <input type="text" wire:model="data.cvv" id="cvv" class="form-control"
                                maxlength="3">
                            @error('data.cvv')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-secondary" type="button" wire:click="prevStep">Previous</button>
                        <button class="btn btn-secondary" type="button" wire:click="nextStep" :disabled="{{$cardExpiry}}">Next</button>
                    </div>
                @endif

                @if ($step === 4)
                    <div>
                        @livewire('review', ['data' => $data, 'cardNumberMask' => $cardNumberMask])

                        <button class="btn btn-secondary" type="button" wire:click="prevStep">Previous</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                @endif

            </form>
        </div>
    </div>
</div>
