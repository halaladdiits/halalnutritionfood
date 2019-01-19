(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"public.home","action":"App\Http\Controllers\PagesController@getHome"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@getLogin"},{"host":null,"methods":["POST"],"uri":"login","name":"auth.login-post","action":"App\Http\Controllers\Auth\AuthController@postLogin"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"auth.register","action":"App\Http\Controllers\Auth\AuthController@getRegister"},{"host":null,"methods":["POST"],"uri":"register","name":"auth.register-post","action":"App\Http\Controllers\Auth\AuthController@postRegister"},{"host":null,"methods":["GET","HEAD"],"uri":"password","name":"auth.password","action":"App\Http\Controllers\Auth\PasswordResetController@getPasswordReset"},{"host":null,"methods":["POST"],"uri":"password","name":"auth.password-post","action":"App\Http\Controllers\Auth\PasswordResetController@postPasswordReset"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/{token}","name":"auth.reset","action":"App\Http\Controllers\Auth\PasswordResetController@getPasswordResetForm"},{"host":null,"methods":["POST"],"uri":"password\/{token}","name":"auth.reset-post","action":"App\Http\Controllers\Auth\PasswordResetController@postPasswordResetForm"},{"host":null,"methods":["GET","HEAD"],"uri":"social\/redirect\/{provider}","name":"social.redirect","action":"App\Http\Controllers\Auth\AuthController@getSocialRedirect"},{"host":null,"methods":["GET","HEAD"],"uri":"social\/handle\/{provider}","name":"social.handle","action":"App\Http\Controllers\Auth\AuthController@getSocialHandle"},{"host":null,"methods":["GET","HEAD"],"uri":"additive\/create","name":"additive.create","action":"App\Http\Controllers\IngredientController@create"},{"host":null,"methods":["POST"],"uri":"additive","name":"additive.store","action":"App\Http\Controllers\IngredientController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"additive\/{additive}\/edit","name":"additive.edit","action":"App\Http\Controllers\IngredientController@edit"},{"host":null,"methods":["PUT"],"uri":"additive\/{additive}","name":"additive.update","action":"App\Http\Controllers\IngredientController@update"},{"host":null,"methods":["PATCH"],"uri":"additive\/{additive}","name":null,"action":"App\Http\Controllers\IngredientController@update"},{"host":null,"methods":["DELETE"],"uri":"additive\/{additive}","name":"additive.destroy","action":"App\Http\Controllers\IngredientController@destroy"},{"host":null,"methods":["POST"],"uri":"foodproduct\/verify\/{id}","name":"foodproduct.verify","action":"App\Http\Controllers\FoodProductController@verify"},{"host":null,"methods":["DELETE"],"uri":"halalSource\/{id}","name":"halalSource.destroy","action":"App\Http\Controllers\IngredientController@halalSourceDestroy"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"authenticated.logout","action":"App\Http\Controllers\Auth\AuthController@getLogout"},{"host":null,"methods":["GET","HEAD"],"uri":"foodproduct\/create","name":"foodproduct.create","action":"App\Http\Controllers\FoodProductController@create"},{"host":null,"methods":["POST"],"uri":"foodproduct","name":"foodproduct.store","action":"App\Http\Controllers\FoodProductController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"foodproduct\/{foodproduct}\/edit","name":"foodproduct.edit","action":"App\Http\Controllers\FoodProductController@edit"},{"host":null,"methods":["PUT"],"uri":"foodproduct\/{foodproduct}","name":"foodproduct.update","action":"App\Http\Controllers\FoodProductController@update"},{"host":null,"methods":["PATCH"],"uri":"foodproduct\/{foodproduct}","name":null,"action":"App\Http\Controllers\FoodProductController@update"},{"host":null,"methods":["DELETE"],"uri":"foodproduct\/{foodproduct}","name":"foodproduct.destroy","action":"App\Http\Controllers\FoodProductController@destroy"},{"host":null,"methods":["DELETE"],"uri":"certificate\/{id}","name":"certificate.destroy","action":"App\Http\Controllers\FoodProductController@certificateDestroy"},{"host":null,"methods":["GET","HEAD"],"uri":"foodproduct","name":"foodproduct.index","action":"App\Http\Controllers\FoodProductController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"foodproduct\/{foodproduct}","name":"foodproduct.show","action":"App\Http\Controllers\FoodProductController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"additive","name":"additive.index","action":"App\Http\Controllers\IngredientController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"additive\/{additive}","name":"additive.show","action":"App\Http\Controllers\IngredientController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/food-product-list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.foodproduct.list","action":"App\Http\Controllers\ApiController@getFoodProductList"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/additive-list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.additive.list","action":"App\Http\Controllers\ApiController@getAdditiveList"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/ingredient-list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.ingredient.list","action":"App\Http\Controllers\ApiController@getIngredientList"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/additive-data\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.additive.data","action":"App\Http\Controllers\ApiController@getAdditiveData"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/food-product-data\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.foodproduct.data","action":"App\Http\Controllers\ApiController@getFoodProductData"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/manufacture-list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.manufacture.list","action":"App\Http\Controllers\ApiController@getManufactureList"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/halal-org-list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.halalOrg.list","action":"App\Http\Controllers\ApiController@getHalalOrgList"},{"host":null,"methods":["GET","HEAD"],"uri":"api\/cert-org-list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"api.certOrg.list","action":"App\Http\Controllers\ApiController@getCertOrgList"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"api\/{_missing}","name":null,"action":"App\Http\Controllers\ApiController@missingMethod"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

