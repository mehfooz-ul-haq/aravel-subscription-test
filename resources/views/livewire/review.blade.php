<div>
    <h2>Review & Submit</h2>
    <p><strong>Name:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Phone:</strong> {{ $data['phone'] }}</p>
    <p><strong>Address:</strong> {{ $data['address_1'] }} <br /> {{ $data['address_2'] }}</p>
    <p><strong>Postal Code:</strong> {{ $data['postal_code'] }}</p>
    <p><strong>State/Province:</strong> {{ $data['state'] }}</p>
    <p><strong>Country:</strong> {{ $data['country'] }}</p>

    @if ($data['subscription_type'] == 'premium')
    <p><strong>Card Number:</strong> {{ $cardNumberMask }}</p>
    <p><strong>Card Expiry:</strong> {{ $data['expiry_month'] }}/{{ $data['expiry_year'] }}</p>
    <p><strong>CVV:</strong> {{ $data['cvv'] }}</p>
    @endif

    <p><strong>Subscription Type:</strong> {{ ucfirst($data['subscription_type']) }}</p>
</div>