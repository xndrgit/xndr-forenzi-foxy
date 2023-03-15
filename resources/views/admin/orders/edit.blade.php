<x-app-layout>
    @section('title', __('| Order Edit'))

    <x-layout.container>
        <x-layout.form-header>
            Edit Order
        </x-layout.form-header>

        <x-form
            action="{{ route('admin.orders.update', ['order' => $order->id]) }}"
        >
            @method('put')

            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="name"
                                >
                                    Nome
                                </label>
                                <input
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    required
                                    type="text"
                                    value="{{ old('name', $order->user->name) }}"
                                />

                                @error('name')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="surname"
                                >
                                    Cognome
                                </label>
                                <input
                                    class="form-control"
                                    id="surname"
                                    name="surname"
                                    required
                                    type="text"
                                    value="{{ old('surname', $order->user->user_detail->surname) }}"
                                />

                                @error('name')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="business_name"
                                >Ragione Sociale
                                </label>
                                <input
                                    class="form-control"
                                    id="business_name"
                                    name="business_name"
                                    required
                                    type="text"
                                    value="{{ old('business_name', $order->user->user_detail->business_name) }}"
                                />

                                @error('business_name')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="address"
                                >Indirizzo
                                </label>
                                <input
                                    class="form-control"
                                    id="address"
                                    name="address"
                                    required
                                    type="text"
                                    value="{{ old('address', $order->user->user_detail->address) }}"
                                />

                                @error('address')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="cap"
                                >
                                    Cap
                                </label>
                                <input
                                    class="form-control"
                                    id="cap"
                                    name="cap"
                                    required
                                    type="text"
                                    value="{{ old('cap', $order->user->user_detail->cap) }}"
                                />

                                @error('cap')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="city"
                                >
                                    Città
                                </label>
                                <input
                                    class="form-control"
                                    id="city"
                                    name="city"
                                    required
                                    type="text"
                                    value="{{ old('city', $order->user->user_detail->city) }}"
                                />

                                @error('city')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="province"
                                >
                                    Provincia
                                </label>
                                <input
                                    class="form-control"
                                    id="province"
                                    name="province"
                                    required
                                    type="text"
                                    value="{{ old('province', $order->user->user_detail->province) }}"
                                />

                                @error('province')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="state"
                                >
                                    Stato
                                </label>
                                <input
                                    class="form-control"
                                    id="state"
                                    name="state"
                                    required
                                    type="text"
                                    value="{{ old('state', $order->user->user_detail->state) }}"
                                />

                                @error('state')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="phone"
                                >Telefono
                                </label>
                                <input
                                    class="form-control"
                                    id="phone"
                                    name="phone"
                                    required
                                    type="text"
                                    value="{{ old('phone', $order->user->user_detail->phone) }}"
                                />

                                @error('phone')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="email"
                                >
                                    Email
                                </label>
                                <input
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    required
                                    type="text"
                                    value="{{ old('email', $order->user->email) }}"
                                />

                                @error('email')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="pec"
                                >
                                    Pec
                                </label>
                                <input
                                    class="form-control"
                                    id="pec"
                                    name="pec"
                                    required
                                    type="text"
                                    value="{{ old('pec', $order->user->user_detail->pec) }}"
                                />

                                @error('pec')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="code_sdi"
                                >Codice Sdi
                                </label>
                                <input
                                    class="form-control"
                                    id="code_sdi"
                                    name="code_sdi"
                                    required
                                    type="text"
                                    value="{{ old('code_sdi', $order->user->user_detail->code_sdi) }}"
                                />

                                @error('code_sdi')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-outline">
                                <label
                                    class="form-label"
                                    for="notes"
                                >
                                    Note
                                </label>

                                <textarea
                                    class="form-control"
                                    cols="30"
                                    id="notes"
                                    name="notes"
                                    required
                                    rows="4"
                                    style="word-wrap: break-word;"
                                >{{ old('notes', $order->user->user_detail->notes) }}</textarea>

                                @error('pec')
                                <x-alert.danger>
                                    {{ $message }}
                                </x-alert.danger>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-2">
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="id"
                        >
                            Id
                        </label>
                        <input
                            class="form-control"
                            id="id"
                            name="id"
                            readonly
                            required
                            type="text"
                            value="{{ $order->id }}"
                        />

                        @error('order_number')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="order_number"
                        >
                            Numero Ordine
                        </label>
                        <input
                            class="form-control"
                            id="order_number"
                            name="order_number"
                            rquired
                            type="text"
                            value="{{ old('order_number', $order->order_number) }}"
                        />

                        @error('order_number')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>
                <div class="col">

                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="status"
                        >
                            Stato
                        </label>
                        <select
                            class="form-control"
                            id="status"
                            name="status"
                            required
                        >
                            @foreach ($statuses as $status)
                                <option
                                    {{ $status->status == old('status', '') ? 'selected' : '' }}
                                    value="{{ $status->status }}"
                                >
                                    {{ ucwords($status->status) }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </div>
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="shipping_cost"
                        >
                            Costo Di Spedizione
                        </label>

                        <input
                            class="form-control"
                            id="shipping_cost"
                            name="shipping_cost"
                            required
                            type="text"
                            value="{{ old('shipping_cost', $order->shipping_cost) }}"
                        />

                        @error('shipping_cost')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="conai"
                        >
                            Conai
                        </label>
                        <input
                            class="form-control"
                            id="conai"
                            name="conai"
                            required
                            type="text"
                            value="{{ old('conai', $order->conai) }}"
                        />

                        @error('conai')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </div>
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="iva"
                        >
                            Iva
                        </label>
                        <input
                            class="form-control"
                            id="iva"
                            name="iva"
                            required
                            type="text"
                            value="{{ old('iva', $order->iva) }}"
                        />

                        @error('iva')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="subtotal"
                        >
                            Subtotale
                        </label>
                        <input
                            class="form-control"
                            id="subtotal"
                            name="subtotal"
                            required
                            type="text"
                            value="{{ old('subtotal', $order->subtotal) }}"
                        />

                        @error('subtotal')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </div>
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="total"
                        >
                            Totale
                        </label>
                        <input
                            class="form-control"
                            id="total"
                            name="total"
                            required
                            type="text"
                            value="{{ old('total', $order->total) }}"
                        />

                        @error('total')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror

                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-2">
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="payment_method"
                        >
                            Metodo Di Pagamento
                        </label>
                        <select
                            class="form-control"
                            id="payment_method"
                            name="payment_method"
                            required
                        >
                            @foreach ($payment_methods as $payment_method)
                                <option
                                    {{ $payment_method->payment_method == old('payment_method', $order->payment->payment_method) ? 'selected' : '' }}
                                    value="{{ $payment_method->payment_method }}"
                                >
                                    {{ ucwords($payment_method->payment_method) }}
                                </option>
                            @endforeach
                        </select>

                        @error('payment_method')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-outline">
                        <label
                            class="form-label"
                            for="payment_status"
                        >
                            Stato Pagamento
                        </label>
                        <select
                            class="form-control"
                            id="payment_status"
                            name="payment_status"
                            required
                        >
                            @foreach ($paymentStatuses as $paymentStatus)
                                <option
                                    {{ $paymentStatus->payment_status == old('payment_status', $order->payment->payment_status) ? 'selected' : '' }}
                                    value="{{ $paymentStatus->payment_status }}"
                                >
                                    {{ ucwords($paymentStatus->payment_status) }}
                                </option>
                            @endforeach
                        </select>

                        @error('payment_status')
                        <x-alert.danger>
                            {{ $message }}
                        </x-alert.danger>
                        @enderror
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Codice</th>
                    <th>Nome</th>
                    <th>Quantità</th>
                    <th>Prezzo</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->products as $product)
                    <tr>
                        <td>
                            <input
                                class="form-control"
                                name="products[{{ $product->id }}][product_id]"
                                readonly
                                type="number"
                                value="{{ old("products.$product->id.product_id", $product->pivot->product_id) }}"
                            >
                        </td>

                        <td>
                            <input
                                class="form-control"
                                name="products[{{ $product->id }}][code]"
                                type="number"
                                value="{{ old("products.$product->id.code", $product->code) }}"
                            >
                        </td>
                        <td>
                            <input
                                class="form-control"
                                name="products[{{ $product->id }}][name]"
                                type="text"
                                value="{{ old("products.$product->id.name", $product->name) }}"
                            >
                        </td>
                        <td>
                            <input
                                class="form-control"
                                name="products[{{ $product->id }}][quantity]"
                                type="number"
                                value="{{ old("products.$product->id.quantity", $product->pivot->quantity) }}"
                            >
                        </td>
                        <td>
                            <input
                                class="form-control"
                                min="1"
                                name="products[{{ $product->id }}][price]"
                                step="any"
                                type="number"
                                value="{{ old("products.$product->id.price", $product->price) }}"
                            >
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row justify-content-center m-4">
                <x-button
                    class="btn-primary btn-floating rounded-circle"
                >
                    <i class="fas fa-save"></i>
                </x-button>
            </div>
        </x-form>
    </x-layout.container>
</x-app-layout>
