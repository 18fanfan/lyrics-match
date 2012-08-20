<?php
/**
 * audio-code-book.php is the /music/audio-code-book.php content
 *
 * PHP version 5
 *
 * @category PHP
 * @package  /music/
 * @author   Fukuball Lin <fukuball@gmail.com>
 * @license  No Licence
 * @version  Release: <1.0>
 * @link     http://sarasti.cs.nccu.edu.tw
 */
?>
<div id="chartdiv" style="width: 500px; height: 600px;"></div>
<script type="text/javascript">
      var chart;

      var chartData = [{
          year: 2005,
          income: 23.5,
          expenses: 18.1
      }, {
          year: 2006,
          income: 26.2,
          expenses: 22.8
      }, {
          year: 2007,
          income: 30.1,
          expenses: 23.9
      }, {
          year: 2008,
          income: 29.5,
          expenses: 25.1
      }, {
          year: 2009,
          income: 24.6,
          expenses: 25.0
      }];


      AmCharts.ready(function () {
          // SERIAL CHART
          chart = new AmCharts.AmSerialChart();
          chart.dataProvider = chartData;
          chart.categoryField = "year";
          chart.startDuration = 1;
          chart.rotate = true;

          // AXES
          // category
          var categoryAxis = chart.categoryAxis;
          categoryAxis.gridPosition = "start";
          categoryAxis.axisColor = "#DADADA";
          categoryAxis.dashLength = 5;

          // value
          var valueAxis = new AmCharts.ValueAxis();
          valueAxis.dashLength = 5;
          valueAxis.axisAlpha = 0.2;
          valueAxis.position = "top";
          valueAxis.title = "Million USD";
          chart.addValueAxis(valueAxis);

          // GRAPHS
          // column graph
          var graph1 = new AmCharts.AmGraph();
          graph1.type = "column";
          graph1.title = "Income";
          graph1.valueField = "income";
          graph1.lineAlpha = 0;
          graph1.fillColors = "#ADD981";
          graph1.fillAlphas = 1;
          chart.addGraph(graph1);

          // line graph
          var graph2 = new AmCharts.AmGraph();
          graph2.type = "line";
          graph2.title = "Expenses";
          graph2.valueField = "expenses";
          graph2.lineThickness = 2;
          graph2.bullet = "round";
          graph2.fillAlphas = 0;
          chart.addGraph(graph2);

          // LEGEND
          var legend = new AmCharts.AmLegend();
          chart.addLegend(legend);

          // WRITE
          chart.write("chartdiv");
      });
  </script>