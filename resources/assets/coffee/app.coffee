'use strict'

oneline = angular.module 'oneline', ['ngRoute', 'ngResource']

Config = ($routeProvider, $locationProvider)->
  $locationProvider
    .html5Mode(true)
  $routeProvider
    .when '/app/home',
      templateUrl: 'partials/home.html',
      controller: 'MainCtrl as vm'
    .when '/app/new',
      templateUrl: 'partials/new.html',
      controller: 'NewCtrl as vm'
    .otherwise
      redirectTo: '/app/home'

MainCtrl = ($location, Quote)->
  vm = @
  vm.hello = "Home: Hello World"
  vm.sp = 0
  vm.quotes = []
  vm.new = ->
    $location.path 'app/new'
  vm.load = ->
    quote = new Quote
    quote.$get {sp: vm.sp}
      .then (response)->
        vm.sp = response.sp
        vm.quotes = vm.quotes.concat response.quotes
      .catch (response)->
        alert 'something is wrong and I donno why'
  vm.load()
  return

NewCtrl = ($location, Quote)->
  vm = @
  vm.hello = "New: Hello World"
  vm.quote =
    quote: '',
    author: '',
    image: ''
  vm.submit = ->
    quote = new Quote vm.quote
    quote.$save()
      .then (response)->
        vm.home
      .catch (response)->
        alert 'something is wrong and I donno why'
  vm.home = ->
    $location.path '/app/home'
  return

Config
  .$inject = ['$routeProvider', '$locationProvider']

MainCtrl
  .$inject = ['$location', 'Quote']

NewCtrl
  .$inject = ['$location', 'Quote']

Quote = ($resource)->
  $resource 'quote'

Quote
  .$inject = ['$resource']

oneline
  .config Config
  .factory 'Quote', Quote
  .controller 'MainCtrl', MainCtrl
  .controller 'NewCtrl', NewCtrl

return