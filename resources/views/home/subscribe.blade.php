
{{-- @include('sweetalert::alert') --}}
<section class="subscribe_section">
    <div class="container-fuild">
       <div class="box">
          <div class="row">
             <div class="col-md-6 offset-md-3">
                <div class="subscribe_form ">
                   <div class="heading_container heading_center">
                      <h3>Subscribe To Get Discount Offers</h3>
                   </div>
                   <p>Subscribe to git all offers updates </p>
                   <form action="{{ url('subscribe') }}" method="post">
                     @csrf
                      <input type="email" placeholder="Enter your email" name="email" required>
                      <button>
                      subscribe
                      </button>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>