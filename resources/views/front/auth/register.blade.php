@extends('layouts.front_layout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Registration Form</li>
    </ul>
    <h3>Registration Form</h3>
    <hr class="soft" />

    <div class="row">
        <div class="span4">
            <div class="well">
                <h5>CREATE YOUR ACCOUNT</h5><br />
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mt-1">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session('message'))
                <div class="alert alert-danger alert-dismissible mt-1">
                  {{ Session('message') }}
                </div>
              @endif
                <form id="registerForm" action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="control-label" for="name">Name:</label>
                        <div class="controls">
                            <input class="span3 @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="Enter Your Name" value="{{ old('name') }}">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="mobile">Mobile:</label>
                        <div class="controls">
                            <input class="span3 @error('mobile') is-invalid @enderror" type="text" name="mobile" id="mobile" placeholder="Enter Your Mobile Number" value="{{ old('mobile') }}">
                            
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="email">E-mail address:</label>
                        <div class="controls">
                            <input class="span3 @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="Enter Your Email Address">
                            
                        </div>
                    
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="password">Password:</label>
                        <div class="controls">
                            <input class="span3 @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="*********">
                           
                        </div>
                       
                    </div>
                    <div class="controls">
                        <button type="submit" class="btn btn-primary block" >Create Your Account</button>
                    </div>
                </form>
                <p>Already Registered? <a href="{{ url('/login') }}" class="btn btn-primary">Login</a></p>
                
            </div>
        </div>
       
    </div>

</div>
</div>
</div>
</div>
@endsection
