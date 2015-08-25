@extends('app')

@section('content')

<div class="container-fluid">
<div class="row">
    <div class="col s7 offset-s3">
         @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
         @endif

         @if(Session::has('message'))

         <ul>
              <li> <p class="alert alert-danger">{{ Session::get('message') }}</p></li>
         </ul>
         @endif
        <form class="col s12" role="form" method="POST" action="/verify">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-field">
                          <i class="material-icons prefix">account_circle</i>
                          <input id="icon_prefix" class="validate" name="code" type="text" class="validate" value="{{ old('code') }}">
                          <label for="icon_prefix">Enter the code received</label>
                 </div>


                 <button class="btn waves-effect waves-light" type="submit" name="action">Verify
                  </button>
        </form>
    </div>
</div>
</div>

@endsection