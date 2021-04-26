<div>
   <h2>{{ $data['type'] }}</h2>
   <p>Họ tên: {{$data['name']}}</p>
   <p>Địa chỉ: {{$data['street']}}</p>
   <p>SĐT: {{$data['phone']}}</p>
   <p>Ghi chú: {{$data['note']}}</p>
   <table class="table table-bordered">
      <thead>
         <tr>
            <th>Tên sp</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>link sp</th>
         </tr>
      </thead>
      <tbody>
         @foreach($data['products'] as $value)
         <tr>
            <td>{{$value->product->name ?? ''}}</td>
            <td class="price"><span>{{$value->orderProduct->promotion_price ?? 0}}</span></td>
            <td class="qty">{{$value->orderProduct->quantity ?? 1}}</td>
            <td class="total_price"><span>₫{{$value->total_order}}</span></td>
            <td>{{asset('files/')}}/{{$value->product->images[0] ?? ''}}</td>

         </tr>
         @endforeach
      </tbody>
   </table>
</div>