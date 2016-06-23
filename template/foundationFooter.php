<!--Foundation Scripts Here-->
  <!--<script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'javascripts/vendor/zepto' : 'javascripts/vendor/jquery') +
  '.js><\/script>')
  </script>-->
  
  	<script src="./javascripts/vendor/jquery.js"></script>
  	<script src="./javascripts/foundation/foundation.js"></script>
	
	<script src="./javascripts/foundation/foundation.abide.js"></script>
	
	<script src="./javascripts/foundation/foundation.alerts.js"></script>
	
	<script src="./javascripts/foundation/foundation.clearing.js"></script>
	
	<script src="./javascripts/foundation/foundation.cookie.js"></script>
	
	<script src="./javascripts/foundation/foundation.dropdown.js"></script>
	
	<script src="./javascripts/foundation/foundation.forms.js"></script>
	
	<script src="./javascripts/foundation/foundation.interchange.js"></script>
	
	<script src="./javascripts/foundation/foundation.joyride.js"></script>
	
	<script src="./javascripts/foundation/foundation.magellan.js"></script>
	
	<script src="./javascripts/foundation/foundation.orbit.js"></script>
	
	<script src="./javascripts/foundation/foundation.placeholder.js"></script>
	
	<script src="./javascripts/foundation/foundation.reveal.js"></script>
	
	<script src="./javascripts/foundation/foundation.section.js"></script>
	
	<script src="./javascripts/foundation/foundation.tooltips.js"></script>
	
	<script src="./javascripts/foundation/foundation.topbar.js"></script>
	

  <!--initialize foundation javascript-->
  <script>
    $(document).foundation()
	.foundation('abide',{
		patterns:{
			isbn:/^([0-9]){13}$/
		}
	});
  </script>
    <!--Select and Search Widget for Book Categories-->
	<script src="/javascripts/select2-3.4.4/select2.js"></script>
<script>
        $(document).ready(function() { $("#category").select2(); });
    </script>

</body>
</html>