<?php get_header(); ?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.tablesorter.js"></script>
<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/tablesorter.css" rel="stylesheet" />
<script type="text/javascript">
	$(document).ready(function() { 
		$(".bordered").tablesorter();
	});
</script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/concentration.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/d3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/d3.csv.js"></script>
<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/bordered.css" rel="stylesheet" />
<link type="text/css" href="<?php bloginfo('template_url'); ?>/css/concentration.css" rel="stylesheet" />	

<?php
// Concentration
include "class/concentration.php";
include "class/functions/string.php";

$Concentration = new Concentration();

if(isset($_GET['estado'])) {
	$key   = getState($_GET['estado']);
	$state = $_GET['estado'];
	$statescsv = '"concentration"';
	if($key !== FALSE) {
		$result = $Concentration->getState($key);
	} else { ?>
		<script type="text/javascript">
			window.location = "/subsidios/concentracion/?estado=nacional";
		</script>
	<?php }
} else { ?>
	 <script type="text/javascript">
		window.location = "/subsidios/concentracion/?estado=nacional";
	</script>
<?php 
	}
?>

<div class="container">
	<div class="content">
		<select name="states" id="selectstates">
			<option value="aguascalientes"<?php echo ($state=="aguascalientes") ? ' selected': ''; ?>>Aguascalientes</option>
			<option value="baja-california"<?php echo ($state=="baja-california") ? ' selected': ''; ?>>Baja california</option>
			<option value="baja-california-sur"<?php echo ($state=="baja-california-sur") ? ' selected': ''; ?>>Baja california sur</option>
			<option value="campeche"<?php echo ($state=="campeche") ? ' selected': ''; ?>>Campeche</option>
			<option value="coahuila"<?php echo ($state=="coahuila") ? ' selected': ''; ?>>Coahuila</option>
			<option value="colima"<?php echo ($state=="colima") ? ' selected': ''; ?>>Colima</option>
			<option value="chiapas"<?php echo ($state=="chiapas") ? ' selected': ''; ?>>Chiapas</option>
			<option value="chihuahua"<?php echo ($state=="chihuahua") ? ' selected': ''; ?>>Chihuahua</option>
			<option value="distrito-federal"<?php echo ($state=="distrito-federal") ? ' selected': ''; ?>>Distrito federal</option>
			<option value="durango"<?php echo ($state=="durango") ? ' selected': ''; ?>>Durango</option>
			<option value="guanajuato"<?php echo ($state=="guanajuato") ? ' selected': ''; ?>>Guanajuato</option>
			<option value="guerrero"<?php echo ($state=="guerrero") ? ' selected': ''; ?>>Guerrero</option>
			<option value="hidalgo"<?php echo ($state=="hidalgo") ? ' selected': ''; ?>>Hidalgo</option>
			<option value="jalisco"<?php echo ($state=="jalisco") ? ' selected': ''; ?>>Jalisco</option>
			<option value="mexico"<?php echo ($state=="mexico") ? ' selected': ''; ?>>Edo. de mexico</option>
			<option value="michoacan"<?php echo ($state=="michoacan") ? ' selected': ''; ?>>Michoacan</option>
			<option value="morelos"<?php echo ($state=="morelos") ? ' selected': ''; ?>>Morelos</option>
			<option value="nayarit"<?php echo ($state=="nayarit") ? ' selected': ''; ?>>Nayarit</option>
			<option value="nuevo-leon"<?php echo ($state=="nuevo-leon") ? ' selected': ''; ?>>Nuevo leon</option>
			<option value="oaxaca"<?php echo ($state=="oaxaca") ? ' selected': ''; ?>>Oaxaca</option>
			<option value="puebla"<?php echo ($state=="puebla") ? ' selected': ''; ?>>Puebla</option>
			<option value="queretaro"<?php echo ($state=="queretaro") ? ' selected': ''; ?>>Queretaro</option>
			<option value="quintana-roo"<?php echo ($state=="quintana-roo") ? ' selected': ''; ?>>Quintana roo</option>
			<option value="san-luis-potosi"<?php echo ($state=="san-luis-potosi") ? ' selected': ''; ?>>San luis potosi</option>
			<option value="sinaloa"<?php echo ($state=="sinaloa") ? ' selected': ''; ?>>Sinaloa</option>
			<option value="sonora"<?php echo ($state=="sonora") ? ' selected': ''; ?>>Sonora</option>
			<option value="tabasco"<?php echo ($state=="tabasco") ? ' selected': ''; ?>>Tabasco</option>
			<option value="tamaulipas"<?php echo ($state=="tamaulipas") ? ' selected': ''; ?>>Tamaulipas</option>
			<option value="tlaxcala"<?php echo ($state=="tlaxcala") ? ' selected': ''; ?>>Tlaxcala</option>
			<option value="veracruz"<?php echo ($state=="veracruz") ? ' selected': ''; ?>>Veracruz</option>
			<option value="yucatan"<?php echo ($state=="yucatan") ? ' selected': ''; ?>>Yucatan</option>
			<option value="zacatecas"<?php echo ($state=="zacatecas") ? ' selected': ''; ?>>Zacatecas</option>
			<option value="nacional"<?php echo ($state=="nacional") ? ' selected': ''; ?>>Nacional</option>
		</select>
		
		<input type="button" id="input-state" name="input-state" value="Ir" />
		
		<div id="info">
			<p>Concentraci&oacute;n: El porcentaje pertenece a los apoyos entregados 2006-2012, ordenados por monto total de forma descendente tomanto el primer 1%,2%,3% ... 20% y el 80 % restante</p><br/>
			<p class="name"><?php echo $result["name"];?></p>
		</div>
		
		<div id="graphic"></div>
		
		<table class="bordered" id="tableresults">
			<thead>
				<tr>
					<th>Porcentaje</th>        
					<th>Porcentaje de pagos</th>
					<th>No. beneficiarios</th>
					<th>No. hectareas</th>
					<th>Total de pago</th>
				</tr>
			</thead>
			
			<tr>
				<td>Primer 1%</td>
				<td><?php echo getArray($result["p1"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p1"],0);?></td>
				<td class="surface"><?php echo getArray($result["p1"],3);?></td>
				<td class="money"><?php echo getArray($result["p1"],1);?></td>
			</tr>
			<tr>
				<td>Primer 2%</td>
				<td><?php echo getArray($result["p2"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p2"],0);?></td>
				<td class="surface"><?php echo getArray($result["p2"],3);?></td>
				<td class="money"><?php echo getArray($result["p2"],1);?></td>
			</tr>
			<tr>
				<td>Primer 3%</td>
				<td><?php echo getArray($result["p3"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p3"],0);?></td>
				<td class="surface"><?php echo getArray($result["p3"],3);?></td>
				<td class="money"><?php echo getArray($result["p3"],1);?></td>
			</tr>
			<tr>
				<td>Primer 4%</td>
				<td><?php echo getArray($result["p4"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p4"],0);?></td>
				<td class="surface"><?php echo getArray($result["p4"],3);?></td>
				<td class="money"><?php echo getArray($result["p4"],1);?></td>
			</tr>
			<tr>
				<td>Primer 5%</td>
				<td><?php echo getArray($result["p5"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p5"],0);?></td>
				<td class="surface"><?php echo getArray($result["p5"],3);?></td>
				<td class="money"><?php echo getArray($result["p5"],1);?></td>
			</tr>
			<tr>
				<td>Primer 6%</td>
				<td><?php echo getArray($result["p6"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p6"],0);?></td>
				<td class="surface"><?php echo getArray($result["p6"],3);?></td>
				<td class="money"><?php echo getArray($result["p6"],1);?></td>
			</tr>
			<tr>
				<td>Primer 7%</td>
				<td><?php echo getArray($result["p7"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p7"],0);?></td>
				<td class="surface"><?php echo getArray($result["p7"],3);?></td>
				<td class="money"><?php echo getArray($result["p7"],1);?></td>
			</tr>
			<tr>
				<td>Primer 8%</td>
				<td><?php echo getArray($result["p8"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p8"],0);?></td>
				<td class="surface"><?php echo getArray($result["p8"],3);?></td>
				<td class="money"><?php echo getArray($result["p8"],1);?></td>
			</tr>
			<tr>
				<td>Primer 9%</td>
				<td><?php echo getArray($result["p9"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p9"],0);?></td>
				<td class="surface"><?php echo getArray($result["p9"],3);?></td>
				<td class="money"><?php echo getArray($result["p9"],1);?></td>
			</tr>
			<tr>
				<td>Primer 10%</td>
				<td><?php echo getArray($result["p10"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p10"],0);?></td>
				<td class="surface"><?php echo getArray($result["p10"],3);?></td>
				<td class="money"><?php echo getArray($result["p10"],1);?></td>
			</tr>
			<tr>
				<td>Primer 11%</td>
				<td><?php echo getArray($result["p11"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p11"],0);?></td>
				<td class="surface"><?php echo getArray($result["p11"],3);?></td>
				<td class="money"><?php echo getArray($result["p11"],1);?></td>
			</tr>
			<tr>
				<td>Primer 12%</td>
				<td><?php echo getArray($result["p12"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p12"],0);?></td>
				<td class="surface"><?php echo getArray($result["p12"],3);?></td>
				<td class="money"><?php echo getArray($result["p12"],1);?></td>
			</tr>
			<tr>
				<td>Primer 13%</td>
				<td><?php echo getArray($result["p13"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p13"],0);?></td>
				<td class="surface"><?php echo getArray($result["p13"],3);?></td>
				<td class="money"><?php echo getArray($result["p13"],1);?></td>
			</tr>
			<tr>
				<td>Primer 14%</td>
				<td><?php echo getArray($result["p14"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p14"],0);?></td>
				<td class="surface"><?php echo getArray($result["p14"],3);?></td>
				<td class="money"><?php echo getArray($result["p14"],1);?></td>
			</tr>
			<tr>
				<td>Primer 15%</td>
				<td><?php echo getArray($result["p15"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p15"],0);?></td>
				<td class="surface"><?php echo getArray($result["p15"],3);?></td>
				<td class="money"><?php echo getArray($result["p15"],1);?></td>
			</tr>
			<tr>
				<td>Primer 16%</td>
				<td><?php echo getArray($result["p16"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p16"],0);?></td>
				<td class="surface"><?php echo getArray($result["p16"],3);?></td>
				<td class="money"><?php echo getArray($result["p16"],1);?></td>
			</tr>
			<tr>
				<td>Primer 17%</td>
				<td><?php echo getArray($result["p17"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p17"],0);?></td>
				<td class="surface"><?php echo getArray($result["p17"],3);?></td>
				<td class="money"><?php echo getArray($result["p17"],1);?></td>
			</tr>
			<tr>
				<td>Primer 18%</td>
				<td><?php echo getArray($result["p18"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p18"],0);?></td>
				<td class="surface"><?php echo getArray($result["p18"],3);?></td>
				<td class="money"><?php echo getArray($result["p18"],1);?></td>
			</tr>
			<tr>
				<td>Primer 19%</td>
				<td><?php echo getArray($result["p19"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p19"],0);?></td>
				<td class="surface"><?php echo getArray($result["p19"],3);?></td>
				<td class="money"><?php echo getArray($result["p19"],1);?></td>
			</tr>
			<tr>
				<td>Primer 20%</td>
				<td><?php echo getArray($result["p20"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p20"],0);?></td>
				<td class="surface"><?php echo getArray($result["p20"],3);?></td>
				<td class="money"><?php echo getArray($result["p20"],1);?></td>
			</tr>
			<tr>
				<td>80% Restante</td>
				<td><?php echo getArray($result["p80"],2);?>%</td>
				<td class="surface"><?php echo getArray($result["p80"],0);?></td>
				<td class="surface"><?php echo getArray($result["p80"],3);?></td>
				<td class="money"><?php echo getArray($result["p80"],1);?></td>
			</tr>			
		</table>
	</div>
</div>

<script type="text/javascript">
var species = [<?php echo $statescsv;?>],
    traits = ["Porcentaje", "Beneficiarios", "Hectareas", "Monto"];

var m = [80, 160, 200, 160],
    w = 1200 - m[1] - m[3],
    h = 800 - m[0] - m[2];

var x = d3.scale.ordinal().domain(traits).rangePoints([0, w]),
    y = {};

var line = d3.svg.line(),
    axis = d3.svg.axis().orient("left"),
    foreground;

var svg = d3.select("#graphic").append("svg:svg")
    .attr("width", w + m[1] + m[3])
    .attr("height", h + m[0] + m[2])
  .append("svg:g")
    .attr("transform", "translate(" + m[3] + "," + m[0] + ")");

d3.csv("<?php bloginfo('template_url'); ?>/csv/<?php echo $state;?>.csv", function(states) {

  // Create a scale and brush for each trait.
  traits.forEach(function(d) {
	  
	if(d=='Porcentaje') {
		y[d] = d3.scale.linear()
			.domain(d3.extent(states, function(p) { return +p[d]; }))
			.range([0, h]);

		y[d].brush = d3.svg.brush()
			.y(y[d])
			.on("brush", brush);
	} else {
		y[d] = d3.scale.linear()
			.domain(d3.extent(states, function(p) { return +p[d]; }))
			.range([h, 0]);

		y[d].brush = d3.svg.brush()
			.y(y[d])
			.on("brush", brush);
	}
 });

  // Add a legend.
  var legend = svg.selectAll("g.legend")
      .data(species)
    .enter().append("svg:g")
      .attr("class", "legend")
      .attr("transform", function(d, i) { return "translate(0," + (i * 20 + 584) + ")"; });
      
  // Add foreground lines.
  foreground = svg.append("svg:g")
      .attr("class", "foreground")
    .selectAll("path")
      .data(states)
    .enter().append("svg:path")
      .attr("d", path)
      .attr("class", function(d) { return d.species; });

  // Add a group element for each trait.
  var g = svg.selectAll(".trait")
      .data(traits)
    .enter().append("svg:g")
      .attr("class", "trait")
      .attr("transform", function(d) { return "translate(" + x(d) + ")"; })
      .call(d3.behavior.drag()
      .origin(function(d) { return {x: x(d)}; })
      .on("dragstart", dragstart)
      .on("drag", drag)
      .on("dragend", dragend));

  // Add an axis and title.
  g.append("svg:g")
      .attr("class", "axis")
      .each(function(d) { d3.select(this).call(axis.scale(y[d])); })
    .append("svg:text")
      .attr("text-anchor", "middle")
      .attr("y", -9)
      .text(String);

  // Add a brush for each axis.
  g.append("svg:g")
      .attr("class", "brush")
      .each(function(d) { d3.select(this).call(y[d].brush); })
    .selectAll("rect")
      .attr("x", -8)
      .attr("width", 16);

  function dragstart(d) {
    i = traits.indexOf(d);
  }

  function drag(d) {
    x.range()[i] = d3.event.x;
    traits.sort(function(a, b) { return x(a) - x(b); });
    g.attr("transform", function(d) { return "translate(" + x(d) + ")"; });
    foreground.attr("d", path);
  }

  function dragend(d) {
    x.domain(traits).rangePoints([0, w]);
    var t = d3.transition().duration(500);
    t.selectAll(".trait").attr("transform", function(d) { return "translate(" + x(d) + ")"; });
    t.selectAll(".foreground path").attr("d", path);
  }
  
	var i=0;
	$("#graphic").find("text[x=-9]").each( function () {
		if((i==0 || i==1) || (i>6)) {
		
		} else {
			$(this).remove();
		}
		
		i=i+1;
	});
});

// Returns the path for a given data point.
function path(d) {
  return line(traits.map(function(p) { return [x(p), y[p](d[p])]; }));
}

// Handles a brush event, toggling the display of foreground lines.
function brush() {
  var actives = traits.filter(function(p) { return !y[p].brush.empty(); }),
      extents = actives.map(function(p) { return y[p].brush.extent(); });
  foreground.classed("fade", function(d) {
    return !actives.every(function(p, i) {
      return extents[i][0] <= d[p] && d[p] <= extents[i][1];
    });
  });
}

</script>

<?php get_footer(); ?>
