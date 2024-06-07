@if(Session::has('alert-success'))
    <div class="alert alert-success alert-dismissible" role="alert">
	  {{Session::get('alert-success')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@elseif(Session::has('alert-danger'))
    <div class="alert alert-danger alert-dismissible" role="alert">
	  {{Session::get('alert-danger')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@elseif(Session::has('alert-warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
	  {{Session::get('alert-warning')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
@endif