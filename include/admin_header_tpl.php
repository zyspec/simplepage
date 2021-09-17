<style>
.clear{
clear: both;
}
.warning{
background-color: yellow;
padding: 10px;
}
.error{
background-color: #CC3333;
padding: 10px;
}

/*
.form-outer th{
	background-color: #C8D6FB;
}
*/
.form-head{
	background-color: #678FF4;
	color: #FFFFFF;
	padding: 4px;
}
.form-head a{
	color: #FFFFFF;
}
.form-head a:hover{
	color: #FF9900;
}

.button{
	padding: 2px 10px;
	border: double #666666;
	background-color: #CCCCCC;
}

.form-caption{
	text-align: right;
	padding-right: 10px;
}
.form-even{
	background-color: #DBE8FD;
}
.form-odd{
	background-color: #E1E9FB;
}

.pager{
	text-align: right;
	margin: 15px;
}

#nav{
	/*float: left;*/
}
#nav li{
	display: inline;
	color: #000000;
	text-decoration: none;
	/*padding: 2px 10px;
	border: double #666666;
	width: 97px;
	height: 22px;*/
	text-align: center;
	background-color: #ececec;
	margin-left: 20px;
}
</style>

<div>
<!--<img src="../assets/images/simplepage_slogo.jpg" style="float: left;" />-->
<ul id="nav">
  <li><a href="../index.php" class="button" target="_blank">Go to Module</a></li>
	<li><a href="page.php?op=add" class="button">Add Page</a></li>
  <li><a href="page.php?op=list" class="button">Show Pages</a></li>
	<li><a href="menuitem.php?op=add" class="button">Add Menu Item</a></li>
  <li><a href="menuitem.php?op=list" class="button">Show Menu</a></li>
</ul>
<div class="clear"></div>
</div>
<br>