 <script>
  $(document).ready(function() {
  
    $("#event").validate({
		
			rules: {
				eventLocZip: {
					required: true,
					minlength: 5,
					maxlength:5,
					number:true
				},
				
				targetAreaCode1: {
					required: true,
					minlength: 3,
					maxlength:3,
					number:true
				},

				targetAreaCode2: {
					minlength: 3,
					maxlength:3,
					number:true
				},
				
				targetAreaCode3: {
					minlength: 3,
					maxlength:3,
					number:true
				},
				
				targetAreaCode4: {
					minlength: 3,
					maxlength:3,
					number:true
				},
				
				targetAreaCode5: {
					minlength: 3,
					maxlength:3,
					number:true
				},
				
				rsvpPhone: {
					minlength:10,
					required:true
				},
				
				eventName: {
					maxlength:27,
					required:true
				},
				
				eventHighlight1: {
					maxlength:35,
				},
				
				eventHighlight2: {
					maxlength:35,
				},
				
				eventHighlight3: {
					maxlength:35,
				},
				
				eventHighlight4: {
					maxlength:35,
				},
				
				eventHighlight5: {
					maxlength:35,
				},
				
				eventHighlight6: {
					maxlength:35,
				},
				
				eventDesc: {
					maxlength:550,
				},
				
				admin: {
					required:true,
				}
				
				
			},
			
			messages: {
			
				eventLocZip:	{
					minlength: "5 Numbers",
					maxlength: "5 Numbers",
					number: "Numbers"
				},

				targetAreaCode1:	{
					minlength: "3 Numbers",
					maxlength: "3 Numbers",
					number: "Numbers"
				},
				
				targetAreaCode2:	{
					minlength: "3 Numbers",
					maxlength: "3 Numbers",
					number: "Numbers"
				},
				
				targetAreaCode3:	{
					minlength: "3 Numbers",
					maxlength: "3 Numbers",
					number: "Numbers"
				},
				
				targetAreaCode4:	{
					minlength: "3 Numbers",
					maxlength: "3 Numbers",
					number: "Numbers"
				},
				
				targetAreaCode5:	{
					minlength: "3 Numbers",
					maxlength: "3 Numbers",
					number: "Numbers"
				},
				
				rsvpPhone: {
					minlength: "10 numbers"
				},
				
				eventName: {
					maxlength: "Too Long"
				},
				
				eventName: {
					maxlength: "Too Long"
				},
				
				eventHighlight1: {
					maxlength: "Too Long"
				},
				
				eventHighlight2: {
					maxlength: "Too Long"
				},
				
				eventHighlight3: {
					maxlength: "Too Long"
				},
				
				eventHighlight4: {
					maxlength: "Too Long"
				},
				
				eventHighlight5: {
					maxlength: "Too Long"
				},
				
				eventDesc: {
					maxlength: "Too Long"
				},
				
				eventHighlight6: {
					maxlength: "Too Long"
				}
			
			}		 		 
	});

  });
  </script>