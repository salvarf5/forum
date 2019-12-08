<?php

header("Content-type: text/css");
?>
#iniciosesion{
	background-color: cornflowerblue;
	padding-top: 10px;
}
#iniciosesion p{
	color: white;
}
#iniciosesion p:last-child{
	padding-bottom: 10px;
}
#contenido{
    width: 17%;
	margin: 0 auto;
    border-width: medium;
    border-style: groove;
	background-color: white;
	text-align:left;
	padding-bottom: 6px;
}
#contenido2{
    width: 35%;
	margin: 50px auto;
}
h1{
	text-align: center;
	text-transform: uppercase;
}
h2{
	text-align: center;
}
.botoniniciosesion{
	background-color: orange;
	color: white;
	border-radius: 5px 5px 5px 5px;
margin-left: 15px;
}
#contenido a{
	color: orange;
}
.nombreiniciosesion{
	color: orange;
	font-weight: bold;
}

p{
	font-weight: bold;
	margin: 2px 15px;
}

.entradas{
	margin-bottom: 8px;
	margin-left: 15px;
}

.sesioniniciada{
	font-weight: normal;
}
#encabezadoreg{
    background-color: cornflowerblue;
	padding-top: 1px;
	color: white;
	font-size: 15px;
	text-align: center;
}
.catlinks{
	color: blue;
	text-decoration-line: none;
	font-weight: bold;
}
.catlinks2{
	color: blue;
	text-decoration-line: none;
	font-weight: bold;
}
.contar{
	color: blue;
	font-weight: bold;
}

.cerrarsesion{
	background:url(cerrar.png) no-repeat;
 	background-position:left;
	border-style: none;
text-align: right;
}

.edit a{
    float: right;
    padding-right: 3px;
    text-decoration: none;
    color: black;
    
}

.edit a:hover{
     opacity: 0.7;
}

.olvidado{
    text-align: right;
    padding-right: 55px;
}

.olvidado a{
    color: white;
}

[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
    text-decoration: none;
    color: white;
    font-size: 18px;
}

[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  opacity: 0;
  pointer-events: none;
}

[data-tooltip]:before {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -55px;
  padding: 7px;
  width: 100px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  background-color: #000;
  background-color: cornflowerblue;
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;

}

[data-tooltip]:after {
  position: absolute;
  bottom: 150%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid #000;
  border-top: 5px solid cornflowerblue;
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
}

[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  opacity: 1;
}

#mimsg{
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    right: 0;
    left: 0;
    margin-right: auto;
    margin-left: auto;
    width: 40%;
    position: fixed;
    bottom: 20px;
    font-size: 25px;
}
