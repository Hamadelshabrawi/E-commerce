<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    {{-- @include('admin.dashboard.css') --}}

    @include('home.dashboard.head')
    {{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
      #invoice{
    padding: 30px;
}


.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
/* .myClass {
  display: block;
} */

.MyClass {
  display: none;

}

    </style>
  </head>

  <body>
    @include('sweetalert::alert')

    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->


@include('home.dashboard.sidebar')






<div class="flex flex-col flex-1 w-full">
@include('home.dashboard.header')



<div id="invoice">
  <div class="invoice overflow-auto">
      <div style="min-width: 600px">
          <main>
              <div class="row contacts">
                  <div class="col invoice-to">
                    <div class="border-top border-gray-200 pt-4 mt-4">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="text-muted mb-2">Invoice No. : <strong>#{{ $orders_invoice_name->order_id }}</strong></div>
                          
                          <div class="text-muted mb-2">Invoice Date : <strong>{{ $orders_invoice_name->created_at }}</strong></div>
                          
                      </div>
                      <div class="border-top border-gray-200 mt-4 py-4">
                        <div class="row">
                          <div class="col-md-6">
                            <strong class="text-muted mb-2">Payment from</strong>
                            <div>
                              {{ $orders_invoice_name->username}}
                            </div>
                            <p>
                              {{ $orders_invoice_name->user_phone}}
                            </p>
                            <p class="fs-sm">
                              {{ $orders_invoice_name->user_address }}
                              <br>
                              <a href="#!" class="text-purple">{{ $orders_invoice_name->user_email }}
                              </a>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
              <table border="0" cellspacing="0" cellpadding="0">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th style="text-align: center" class="text-left">Description</th>
                          <th style="text-align: center" class="text-right">QTY</th>
                          <th style="text-align: center" class="text-right">Price</th>
                          <th style="text-align: center" class="text-right">Discount</th>
                          <th style="text-align: center" class="text-right">Total</th>
                      </tr>
                  </thead>
                  <tbody>
                    @php $count = 1; @endphp
                    @foreach ($orders_invoice as $orders_invoice)

                      <tr>
                          <td style="text-align: center" class="no" >{{ $count++ }}</td>
                          <td style="text-align: center">{{ $orders_invoice->product_title }}</td>
                          <td style="text-align: center" class="unit">{{ $orders_invoice->product_quantity }}</td>
                          <td style="text-align: center" class="qty">{{ $orders_invoice->product_sale_price }}</td>
                          @if(empty($orders_invoice->product_discount))
                          <td style="text-align: center" >-</td>
                          @else
                          <td style="text-align: center" >{{ $orders_invoice->product_discount }}</td>
                          @endif
                          @if(empty($orders_invoice->Total_price))
                          <td style="text-align: center" class="total">{{ $orders_invoice->price_muliply_qty }}</td>
                          @else
                          <td style="text-align: center" class="total">{{ $orders_invoice->Total_price }}</td>
                          @endif
                      </tr>
                      @endforeach

                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="2"></td>
                          <td colspan="2">SUBTOTAL</td>
                          <td>$ {{ $price }}</td>
                      </tr>
                      @if ( $difference  > 1)
                      <tr>
                          <td colspan="2"></td>
                          <td colspan="2">Discount: </td>
                          <td>-$ {{ $difference }} </td>
                      </tr>
                      @endif
                      <tr>
                          <td colspan="2"></td>
                          <td colspan="2">GRAND TOTAL</td>
                          <td>$ {{ $totalDiscount }} USD</td>
                      </tr>
                  </tfoot>
              </table>
              <div class="thanks">Thank you!</div>
              <div class="notices">
                <div>Refund:</div>
                <div class="notice">you can easy refund from <span style="color:red" id="refund"> here</span></div>
            </div>


          </main>
      </div>




      <form class="forms-sample" action="{{ url('refund',$orders_invoice_name->order_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <table class="MyClass"  border="0" id="hidden" cellspacing="0" cellpadding="0">
          <thead>
              <tr>
                  <th style="text-align: center ; font-weight: bold">Reason </th>
                  <th style="text-align: center ; font-weight: bold">Refund cash or replace</th>
                  <th style="text-align: center ; font-weight: bold">Image upload </th>
              </tr>
          </thead>
          <tbody>

              <tr>
                  <td style="text-align: center" ><input type="text" class="form-control" id="exampleInputName1" placeholder="Reason" name="reason"></td>
                  <td style="text-align: center">                <select value="Refund" selected="" class="form-control" id="exampleSelectGender" name="replaceOrrefund"">
                    <option value="Refund">Refund</option>
                    <option value="Replace">Replace your order</option>
                    <option value="inform">Keep it but just to inform you</option>
                  </select>
                </td>
                  <td style="text-align: center"><input type="file" name="image"></td>
              </tr>
              <tr>
                {{-- <td style="text-align: center ; background-color:#b49494"><button style="width:280px text-align: center ; background-color:black" type="submit" value="">Go <button></td> --}}
              </tr>
          </tbody>

      </table>
      <button  id="hiddene" class=" MyClass flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" >Send <button>

    </form>

  </div>
</div>
      </div>
    </div>
  </body>
</html>

<script>
$('#refund').click(function() {
  $('#hiddene').removeClass("MyClass");
});
$('#refund').click(function() {
  $('#hidden').removeClass("MyClass");
});
</script>