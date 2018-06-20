 var myApp = angular.module("myApp", []);


        function formController($scope, $http) {

            $scope.formData = {};

            // process the form
            $scope.processForm = function() {
                $http({
                    method  : 'POST',
                    url     : 'api/process.php',
                    data    : $.param($scope.formData),  // pass in data as strings
                    headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
                })
                    .success(function(data) {
                        console.log(data);
                        if(data.errors == "notvalidage") {
                            $scope.message = "You must need to be 18 years old";
                        }
                        else if(data.errors == "notvalidphone") {
                             $scope.message = "Phone number not seems to be valid";
                        }
                        else if(data.errors == "notvalidname") {
                             $scope.message = "Name not seems to valid";
                        }
                        if (!data.success) {
                            // if not successful, bind errors to error variables
                            $scope.errorName = data.errors.name;
                            $scope.errorEmail = data.errors.email;
                            $scope.errorPhone = data.errors.phone;
                            $scope.errorDob = data.errors.dob;
                            
                        } else {
                            // if successful, bind success message to message
                            $scope.message = data.message;
                            location.reload();
                            $scope.name = '';
                            $scope.email = '';
                            $scope.phone = '';
                            $scope.dob = '';
                        }
                    });

            };

        }
