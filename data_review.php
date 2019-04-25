<?php 
    // Start MySQL connection
    include('dbconnect.php'); 
?>
<html>
	<head>
		<style>
			div.container {
				width: 100%; margin:auto;
			}

			header, footer {
				padding: 1em;
				color: white;
				background-color: #3b1813;
				clear: left;
				text-align: center;
			}

			#main-content { padding: 1px;}

			nav {
				float: left;
				max-width: 160px;
				margin: 0;
				padding: 1em;
			}

			nav ul {
				list-style-type: none;
				border-right: 1px solid black;
				padding: 0;
			}
			   
			nav ul a {
				text-decoration: none;
			}

			article {
				margin-left: 170px;
				padding: 1em;
				overflow: auto;
			}
			a:hover {
				color: black;
				background: white;
			}
			.button {
				background-color: #3b1813;
				border: none;
				width: 55%;
				color: white;
				padding: 15px 32px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
				margin: 4px 2px;
				cursor: pointer;
			}
			.table_titles, .table_cells_odd, .table_cells_even {
                padding-right: 20px;
                padding-left: 20px;
                color: #000;
			}
			.table_titles {
				color: #FFF;
				background-color: #3b1813;
			}
			.table_cells_odd {
				background-color: #CCC;
			}
			.table_cells_even {
				background-color: #FAFAFA;
			}
			table {
				border: 2px solid #333;
				width: auto;
			}	
			
    </style>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	
	
	</head>
<body style="background-color: #dc851f">

<div class="container">
	<div id="page-wrap">

<header>
   <h1>IOT BASED ELECTRICITY MANAGEMENT</h1>
</header>
  
<nav>
  <ul>
	<li><a href="#" class="button link" data-link="first">Motion Log Table</a></li>
	<li><a href="#" class="button link" data-link="second">Active Time Table</a></li>
	<li><a href="#" class="button link" data-link="third">Starting Time Table</a></li>
	<li><a href="#" class="button link" data-link="fourth">Stopping Time Table</a></li>
	
  </ul>
</nav>
<section id="main-content">

<!-- About the Project -->
<div class="textWord_about_project">
	<h1 style="text-align:center"><font size="100" style="oblique" >WELCOME</font></h1>
	
	
</div>	

<!-- Motion Log Start -->

<div class="textWord_about" data-link="first">
  <h1 style align="center">MOTION LOG</h1>
  <table align="center" border="0" cellspacing="0" cellpadding="4">
		<tr>
            <td class="table_titles">ID</td>
            <td class="table_titles">EVENT</td>
			<td class="table_titles">MOTION</td>
        </tr>

<?php
    // Retrieve all records and display them
	$SQL = "SELECT * from motion";
	$result = mysqli_query($con,$SQL);
    // Used for row color toggle
    $oddrow = true;

    // process every record
    while( $row = mysqli_fetch_array($result) )
    {
        if ($oddrow) 
        { 
            $css_class=' class="table_cells_odd"'; 
        }
        else
        { 
            $css_class=' class="table_cells_even"'; 
        }

        $oddrow = !$oddrow;

        echo '<tr>';
        echo '   <td'.$css_class.'>'.$row["id"].'</td>';
        echo '   <td'.$css_class.'>'.$row["event"].'</td>';
        echo '   <td'.$css_class.'>'.$row["motion"].'</td>';
        echo '</tr>';
    }
?>
  </table>
</div>

<!-- Active Time Log -->

<div class="textWord_about" data-link="second">
	<h1 style align="center">ACTIVE TIME LOG</h1>
  <table align="center" border="0" cellspacing="0" cellpadding="4">
		<tr>
            <td class="table_titles">ID</td>
            <td class="table_titles">START DATE-TIME</td>
			<td class="table_titles">STOP DATE-TIME</td>
			<td class="table_titles">ACTIVE TIME</td>
        </tr>

<?php
    // Retrieve all records and display them
	$SQL = "SELECT starttime.id, starttime.startTime, stoptime.stopTime, activetime.activeTime from starttime INNER JOIN stoptime INNER JOIN activetime ON starttime.id=stoptime.id=activetime.id";
	$result = mysqli_query($con,$SQL);
    // Used for row color toggle
    $oddrow = true;

    // process every record
    while( $row = mysqli_fetch_array($result) )
    {
        if ($oddrow) 
        { 
            $css_class=' class="table_cells_odd"'; 
        }
        else
        { 
            $css_class=' class="table_cells_even"'; 
        }

        $oddrow = !$oddrow;

        echo '<tr>';
        echo '   <td'.$css_class.'>'.$row["id"].'</td>';
        echo '   <td'.$css_class.'>'.$row["startTime"].'</td>';
        echo '   <td'.$css_class.'>'.$row["stopTime"].'</td>';
		echo '   <td'.$css_class.'>'.$row["activeTime"].'</td>';
        echo '</tr>';
    }
?>
  </table>
</div>

<!-- Start Time Log -->
<div class="textWord_about" data-link="third">
	<h1 style align="center">START TIME LOG</h1>
	<table align="center" border="0" cellspacing="0" cellpadding="4">
		<tr>
            <td class="table_titles">ID</td>
            <td class="table_titles">START DATE-TIME</td>
			<td class="table_titles">MOTION</td>
			
        </tr>

<?php
    // Retrieve all records and display them
	$SQL = "SELECT * from starttime";
	$result = mysqli_query($con,$SQL);
    // Used for row color toggle
    $oddrow = true;

    // process every record
    while( $row = mysqli_fetch_array($result) )
    {
        if ($oddrow) 
        { 
            $css_class=' class="table_cells_odd"'; 
        }
        else
        { 
            $css_class=' class="table_cells_even"'; 
        }

        $oddrow = !$oddrow;

        echo '<tr>';
        echo '   <td'.$css_class.'>'.$row["id"].'</td>';
        echo '   <td'.$css_class.'>'.$row["startTime"].'</td>';
        echo '   <td'.$css_class.'>'.$row["motion"].'</td>';
        echo '</tr>';
    }
?>
	</table>
</div>

<!-- Stop Time Log -->
<div class="textWord_about" data-link="fourth">
	<h1 style align="center">STOP TIME LOG</h1>
	<table align="center" border="0" cellspacing="0" cellpadding="4">
		<tr>
            <td class="table_titles">ID</td>
			<td class="table_titles">STOP DATE-TIME</td>
			<td class="table_titles">MOTION</td>
        </tr>

<?php
    // Retrieve all records and display them
	$SQL = "SELECT * from stoptime";
	$result = mysqli_query($con,$SQL);
    // Used for row color toggle
    $oddrow = true;

    // process every record
    while( $row = mysqli_fetch_array($result) )
    {
        if ($oddrow) 
        { 
            $css_class=' class="table_cells_odd"'; 
        }
        else
        { 
            $css_class=' class="table_cells_even"'; 
        }

        $oddrow = !$oddrow;

        echo '<tr>';
        echo '   <td'.$css_class.'>'.$row["id"].'</td>';
        echo '   <td'.$css_class.'>'.$row["stopTime"].'</td>';
		echo '   <td'.$css_class.'>'.$row["motion"].'</td>';
        echo '</tr>';
    }
?>
  </table>
</div>
	
</section>



<footer style="margin-top:50px;">Copyright &copy; 2019 Abhijeet & Rishabh</footer>

</div>
</div>
<script type="text/javascript">
$('.textWord_about').hide();

$('.link').click(function() {
    $('.textWord_about').hide();
	$('.textWord_about_project').hide();
    $('.textWord_about[data-link=' + $(this).data('link') + ']').fadeIn({
        width: '200px'
    }, 300);
});
</script>
</body>
</html>
