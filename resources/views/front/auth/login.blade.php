@extends('layouts.front_layout')

@section('content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Login</li>
    </ul>
    
    <hr class="soft" />
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h3> Login</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
              
                <div class="span1"> &nbsp;</div>
                <div class="span4">
                    @if(Session('message'))
                    <div class="alert alert-danger alert-dismissible mt-1">
                      {{ Session('message') }}
                    </div>
                  @endif
                    <div class="well">
                        <form id="loginForm" action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="control-group">
                                <label class="control-label" for="email">Email</label>
                                <div class="controls">
                                    <input class="span3"  type="text" name="email" id="email" placeholder="Enter Your Email">
                                </div>
                                @error('email') 
                                 <strong role="alert">
                                     <span style="color: red"> {{ $message }}</span>
                                 </strong>
                                @enderror
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="password">Password</label>
                                <div class="controls">
                                    <input type="password" class="span3" name="password" id="password" placeholder="Password">
                                </div>
                                @error('password') 
                                <strong role="alert">
                                    <span style="color: red"> {{ $message }}</span>
                                </strong>
                               @enderror
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                     <a href="forgetpass.html">Forget
                                        password?
                                    </a>
                                </div>
                            </div>
                        </form>
                        <p>New Member? <a href="{{ url('/register') }}" style="color: blue">Register</a> here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

</div>
</div>
</div>
</div>
@endsection
