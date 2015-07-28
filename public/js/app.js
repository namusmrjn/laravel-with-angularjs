(function() {
  'use strict';
  var Config, MainCtrl, NewCtrl, Quote, oneline;

  oneline = angular.module('oneline', ['ngRoute', 'ngResource']);

  Config = function($routeProvider, $locationProvider) {
    $locationProvider.html5Mode(true);
    return $routeProvider.when('/app/home', {
      templateUrl: 'partials/home.html',
      controller: 'MainCtrl as vm'
    }).when('/app/new', {
      templateUrl: 'partials/new.html',
      controller: 'NewCtrl as vm'
    }).otherwise({
      redirectTo: '/app/home'
    });
  };

  MainCtrl = function($location, Quote) {
    var vm;
    vm = this;
    vm.hello = "Home: Hello World";
    vm.sp = 0;
    vm.quotes = [];
    vm["new"] = function() {
      return $location.path('app/new');
    };
    vm.load = function() {
      var quote;
      quote = new Quote;
      return quote.$get({
        sp: vm.sp
      }).then(function(response) {
        vm.sp = response.sp;
        return vm.quotes = vm.quotes.concat(response.quotes);
      })["catch"](function(response) {
        return alert('something is wrong and I donno why');
      });
    };
    vm.load();
  };

  NewCtrl = function($location, Quote) {
    var vm;
    vm = this;
    vm.hello = "New: Hello World";
    vm.quote = {
      quote: '',
      author: '',
      image: ''
    };
    vm.submit = function() {
      var quote;
      quote = new Quote(vm.quote);
      return quote.$save().then(function(response) {
        return vm.home;
      })["catch"](function(response) {
        return alert('something is wrong and I donno why');
      });
    };
    vm.home = function() {
      return $location.path('/app/home');
    };
  };

  Config.$inject = ['$routeProvider', '$locationProvider'];

  MainCtrl.$inject = ['$location', 'Quote'];

  NewCtrl.$inject = ['$location', 'Quote'];

  Quote = function($resource) {
    return $resource('quote');
  };

  Quote.$inject = ['$resource'];

  oneline.config(Config).factory('Quote', Quote).controller('MainCtrl', MainCtrl).controller('NewCtrl', NewCtrl);

  return;

}).call(this);

//# sourceMappingURL=app.js.map