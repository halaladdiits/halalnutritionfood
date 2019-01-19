        @if(isset($noheader))
        @else
        <!-- Static navbar -->
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('public.home') }}">Halal Nutrition Food</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="{{ route('public.about')  }}">About</a></li>
                        <li><a href="{{ route('rdf.browser')  }}">RDF Browser</a></li>
                        <li><a href="{{ route('api.sparql')  }}">SPARQL</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if(!Auth::check())
                            @if(isset($nosignin))
                            @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sign In <span class="caret"></span></a>
                                <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
                                    <li>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! Form::open(['url' => route('auth.login-post'), 'id' => 'login-nav','class' => 'form-signin'] ) !!}
                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                                        {!! Form::email('email', null, [
                                                            'class'                         => 'form-control',
                                                            'placeholder'                   => 'Email address',
                                                            'required',
                                                            'id'                            => 'inputEmail'
                                                        ]) !!}
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="sr-only" for="exampleInputPassword2">Password</label>
                                                        {!! Form::password('password', [
                                                            'class'                         => 'form-control',
                                                            'placeholder'                   => 'Password',
                                                            'required',
                                                            'id'                            => 'inputPassword'
                                                        ]) !!}
                                                    </div>
                                                    <div class="checkbox">
                                                        <label>
                                                            {!! Form::checkbox('remember', 1) !!} Remember me
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                                        <!-- <p><a href="{{ route('auth.password') }}">Forgot password?</a></p> -->

                                                        <p class="or-social">Or Use Social Login</p>

                                                        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-primary btn-block facebook" type="submit">Facebook</a>
                                                        <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-primary btn-block twitter" type="submit">Twitter</a>
                                                        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-primary btn-block google" type="submit">Google</a>

                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            <li><a href="{{ route('auth.register') }}">Register</a></li>
                            <li><a href="{{ route('foodproduct.create') }}">Submit</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->first_name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('authenticated.logout') }}">Logout</a></li>
                                </ul>
                            @if(Auth::user()->roles[0]->name ==  "administrator")
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Submit <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('foodproduct.create') }}">Food Product</a></li>
                                        <li><a href="{{ route('additive.create') }}">Additive</a></li>
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route('foodproduct.create') }}">Submit</a></li>
                            @endif
                            </li>
                        @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Browse <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('foodproduct.index') }}">Food Product</a></li>
                                    <li><a href="{{ route('additive.index') }}">Additive</a></li>
                                </ul>
                            </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        @endif
