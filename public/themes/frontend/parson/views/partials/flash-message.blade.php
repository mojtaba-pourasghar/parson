@if ($message = Session::get('success'))
    <div class="alert-message success-alert">
    	   <span class="alert-icon col-2">
    	   	 <i class="fas fa-check"></i>
    	   </span>
        <h3 class="alert-text col-10">
            {{ $message }}
        </h3>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert-message danger-alert">
    	   <span class="alert-icon col-2">
    	   	<i class="fas fa-exclamation"></i>
    	   </span>
        <h3 class="alert-text col-10">
            {{ $message }}
        </h3>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert-message warning-alert">
    	   <span class="alert-icon col-2">
    	   	<i class="fas fa-exclamation-triangle"></i>
    	   </span>
        <h3 class="alert-text col-10">
            {{ $message }}
        </h3>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert-message info-alert">
    	   <span class="alert-icon col-2">
    	   	<i class="fas fa-exclamation-triangle"></i>
    	   </span>
        <h3 class="alert-text col-10">
            {{ $message }}
        </h3>
    </div>
@endif

@if ($errors->any())
    <div class="alert-message danger-alert">
    	   <span class="alert-icon col-2">
    	   	<i class="fas fa-exclamation"></i>
    	   </span>
        <h3 class="alert-text col-10">
            @foreach($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
        </h3>
    </div>
@endif
