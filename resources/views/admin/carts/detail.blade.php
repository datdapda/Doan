@extends('admin.index')

@section('content')
    <div class="customer mt-3">
        <ul>
            <li>Tên khách hàng: <strong>{{ $customer->name }}</strong></li>
            <li>Số điện thoại: <strong>{{ $customer->phone }}</strong></li>
            <li>Địa chỉ: <strong>{{ $customer->address }}</strong></li>
            <li>Email: <strong>{{ $customer->email }}</strong></li>
            <li>Trạng thái: <strong>{!! \App\Helpers\Helper::activeCustomer($customer->active) !!}</strong></li>
            <li>Ghi chú: <strong>{{ $customer->content }}</strong></li>
        </ul>
    </div>

    <div class="carts">
        @php $total = 0; @endphp
        <table class="table">
            <tbody>
            <tr class="table_head">
                <th class="column-1">Hình ảnh</th>
                <th class="column-2">Tên sản phẩm</th>
                <th class="column-3">Giá</th>
                <th class="column-4">Số lượng</th>
                <th class="column-5">Tổng tiền</th>
            </tr>

            @foreach($carts as $key => $cart)
                @php
                    $price = $cart->price * $cart->pty;
                    $total += $price;
                @endphp
                <tr>
                    <td class="column-1">
                        <div class="how-itemcart1">
                            <img src="{{ $cart->product->thumb }}" alt="IMG" style="width: 100px">
                        </div>
                    </td>
                    <td class="column-2">{{ $cart->product->name }}</td>
                    <td class="column-3">{{ number_format($cart->price, 0, '', '.') }}</td>
                    <td class="column-4">{{ $cart->pty }}</td>
                    <td class="column-5">{{ number_format($price, 0, '', '.') }}</td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="4" class="text-right">Tổng Tiền</td>
                    <td>{{ number_format($total, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
        
        <div class="col-md-6">
            @if ($customer->active == 1 || $customer->active == 2)
                <form action="" method="post">
                    <div class="form-group">
                        <label>Trạng thái</label>
                        <select class="form-control" name="actives">
                            @foreach ($actives as $item)
                                <option value="{{$item->active}}" {!! ($customer->active == $item->active) ? 'selected' : '' ; !!}>{{$item->name}}</option>
                            @endforeach
                            <input type="text" hidden name="customer_id" value="{{$customer->id}}">
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit">Xác nhận</button>
                        @csrf
                    </div>
                </form>
            @endif
        </div>
        
    </div>
@endsection


