<?php
	session_start();
	if(isset($_SESSION['islogged']))
	{
		?>
		<script type="text/javascript">
			window.location.href = "./home";
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
			window.location.href = "./login";
		</script>	
		<?php
	}
?>