define([
   "dojo/_base/declare",
   "aps/View",
   "aps/ResourceStore"
], function (
   declare,
   View,
   Store
) {
   return declare(View, {
      init: function() {

          /* Define the data store */

          /* Define a handler for the *SingUp* button click */
		  var signup = function() {
			   /* Start the process of signUp on Office 365 Adoption */
			   aps.apsc.gotoView("https://app.office365adoption.com");
		  };
		  
          /* Define and return widgets */
		  return ["aps/PageContainer", { id: 'page' }, [
					["aps/Button", {
						id: 				'signup',
						label: 				'Sign Up',
						onClick: 		signup
					}]
				]];		      
      }, // End of Init

      onContext: function(context) {

      },

      onHide: function() {
    	  	this.byId("signup").cancel();
      }

   });
});