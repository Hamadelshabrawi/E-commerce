<meta name="csrf-token" content="{{ csrf_token() }}">


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">

    var siteUrl = "{{url('/')}}";

</script>


        <li class="nav-item w-100">
          <form name="autocomplete-textbox" id="autocomplete-textbox" method="get" action="{{ url('admin_searchProduct') }}">
            @csrf
            <input type="text" class="form-control" placeholder="Search products" id="name" name="name">
          </form>
        </li>
     

  <script>
    $(document).ready(function() {
        $( "#name" ).autocomplete({
            source: function(request, response) {
                $.ajax({
                url: siteUrl + '/' +"autocomplete",
                data: {
                        term : request.term
                 },
                dataType: "json",
                success: function(data){
                   var resp = $.map(data,function(obj){
                        return obj.title;
                   }); 
                   response(resp);
                }
            });
        },
        minLength: 1
     });
    });
    </script>