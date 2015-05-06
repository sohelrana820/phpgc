<?php
/**
 * @author: Sohel Rana
 * @email: me.sohelrana@gmail.com
 * @uri: http://sohelrana.me
 * @tags: gChart, Chart, Google Chart, Graph, 3D Graph
 */

namespace src;


class phpgc
{

    private $googleJsApi = '<script type="text/javascript" src="https://www.google.com/jsapi"></script>';

    private $visualize = '<script type="text/javascript">google.load("visualization", "1.1", {packages:["corechart", "bar", "table"]})</script>';

    private $callBack = 'google.setOnLoadCallback(drawChart)';

    private $options = array();

    public function __construct()
    {
        $this->initialise();
    }

    /**
     *
     */
    private function initialise()
    {
        echo $this->googleJsApi;
        echo $this->visualize;
    }

    /**
     * @param $columns
     * @param $rows
     * @return string
     */
    private function processingData($columns, $rows)
    {
        $columnArray[] = array();

        foreach ($columns as $name => $column) {
            $columnArray[0][] = $column['label'];
        }

        $data = array_merge($columnArray, $rows);
        $result = str_replace('"', "'", json_encode($data));

        return "google.visualization.arrayToDataTable({$result})";
    }

    /**
     * @param $options
     * @return mixed
     */
    private function getOptions($options)
    {
        $options = array_merge($this->options, $options);
        $result = str_replace('"', "'", json_encode($options));
        return $result;
    }

    /**
     * @param $options
     * @return string
     */
    private function setDiv($options)
    {
        $width = 900;
        if (isset($options['width'])) {
            $width = $options['width'];
        }

        $height = 500;
        if (isset($options['height'])) {
            $height = $options['height'];
        }

        $class = '';
        if (isset($options['class'])) {
            $class = $options['class'];
        }


        $div = "<div id='{$this->getDivID(
            $options
        )}' style='width: {$width}px; height: {$height}px; {$this->getWidgetStyle($options)}' class='{$class}'></div>";
        return $div;
    }

    /**
     * @param $options
     * @return string
     */
    private function getDivID($options)
    {
        $chartID = 'chart_div';
        if (isset($options['div'])) {
            $chartID = $options['div'];
        }

        return $chartID;
    }

    /**
     * @param $options
     * @return string
     */
    private function getWidgetStyle($options)
    {
        $widget = '';
        if (isset($options['widget'])) {
            $widget = 'border: 1px solid #CCC;
            box-shadow: 1px 1px 4px 1px #CCC;
            padding: 15px';
        }

        return $widget;
    }

    public function pieChart($column, $rows, $options = array())
    {
        $pieOptions = array(
            'title' => 'Pie Chart'
        );
        $this->options = $pieOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
            function drawChart() {
                var data = {$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)};
                var chart = new google.visualization.PieChart(document.getElementById('{$this->getDivID($options)}'));
                chart.draw(data, options);
            }
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function geoChart($column, $rows, $options = array())
    {
        $geoOptions = array();
        $this->options = $geoOptions;

        return "
        <script type='text/javascript'>
           {$this->callBack}
              function drawChart() {
                var data = {$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
                var chart = new google.visualization.GeoChart(document.getElementById('{$this->getDivID($options)}'));
                chart.draw(data, options);
              }
        </script>

        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function columnChart($column, $rows, $options = array())
    {
        $columnOptions = array(
            'chart' => array(
                'title' => 'Column Chart',
                'subtitle' => 'This is subtitle of column chart'
            ),
        );
        $this->options = $columnOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.charts.Bar(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function barChart($column, $rows, $options = array())
    {
        $barOptions = array(
            'chart' => array(
                'title' => 'BarChart Chart',
                'subtitle' => 'This is subtitle'
            ),
            'bars' => 'horizontal'
        );
        $this->options = $barOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.charts.Bar(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function histogramChart($column, $rows, $options = array())
    {
        $histogramOptions = array(
            'title' => 'Histogram Chart',
            'bars' => array(
                'position' => 'none'
            )
        );
        $this->options = $histogramOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.visualization.Histogram(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function scatterChart($column, $rows, $options = array())
    {
        $scatterOptions = array(
            'title' => 'Scatter Chart',
            'hAxis' => array(
                'title' => 'X Axis',
                'minValue' => 0
            ),
            'vAxis' => array(
                'title' => 'Y Axis',
                'minValue' => 0
            ),
            'legend' => 'none'
        );
        $this->options = $scatterOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.visualization.ScatterChart(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function lineChart($column, $rows, $options = array())
    {
        $lineOptions = array(
            'title' => 'Line Chart',
            'curveType' => 'function',
            'legend' => array(
                'position' => 'bottom'
            )
        );
        $this->options = $lineOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.visualization.LineChart(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function tableChart($column, $rows, $options = array())
    {
        $tableOptions = array(
            'title' => 'Table Chart',
        );
        $this->options = $tableOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.visualization.Table(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function areaChart($column, $rows, $options = array())
    {
        $areaOptions = array(
            'title' => 'Area Chart',
            'hAxis' => array(
                'title' => 'X Axis',
                'minValue' => 0
            ),
            'vAxis' => array(
                'title' => 'Y Axis',
                'minValue' => 0
            ),
        );
        $this->options = $areaOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.visualization.AreaChart(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }

    /**
     * @param $column
     * @param $rows
     * @param array $options
     * @return string
     */
    public function steppedAreaChart($column, $rows, $options = array())
    {
        $areaOptions = array(
            'title' => 'Stepped Area Chart',
            'hAxis' => array(
                'title' => 'X Axis',
            ),
            'vAxis' => array(
                'title' => 'Y Axis',
                'minValue' => 0
            ),
            'isStacked' => true
        );
        $this->options = $areaOptions;

        return "
        <script type='text/javascript'>
            {$this->callBack}
              function drawChart() {
                var data ={$this->processingData($column, $rows)}
                var options = {$this->getOptions($options)}
              var chart = new google.visualization.SteppedAreaChart(document.getElementById('{$this->getDivID($options)}'));
              chart.draw(data, options);
            };
        </script>
        {$this->setDiv($options)}";
    }
}

?>