<script type="text/javascript">
	function refresh()
		{
			var random=Math.random();
			document.getElementById("verifycode").src="/images/verifycode.php?id="+random;
			document.getElementById("random").value=random;
		}
</script>