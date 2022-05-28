<?php
declare(strict_types=1);

namespace MVC\Model;

use Ghunti\HighchartsPHP\HighchartJsExpr;
use pData;
use pImage;
use Ghunti\HighchartsPHP\Highchart;

class pChart
{
//    public function getChart(): string
//    {
//        $chart = new Highchart(Highchart::HIGHSTOCK);
//        $chart->chart->renderTo = "container";
//        $chart->title = array('text' => 'Monthly Average Temperature', 'x' => -20);
//        $chart->series[] = array('name' => 'Tokyo', 'data' => array(7.0, 6.9, 9.5));
//        return $chart->printScripts();

//        $chart = new Highchart(Highchart::HIGHSTOCK);
//
//        $chart->chart->renderTo = "container";
//        $chart->rangeSelector->selected = 1;
//        $chart->title->text = "AAPL Stock Price";
//        $chart->series[] = array(
//            'name' => "AAPL",
//            'data' => new HighchartJsExpr("data"),
//            'tooltip' => array(
//                'valueDecimals' => 2
//            )
//        );
//        return $chart->printScripts(true);

////        var_dump($return);
////        return $return;
////        return $chart->render("chart", null, true);
//        return $chart->render("chart", null, true);
//    }
    public function getChart()
    {
        $myData = new pData();
        $myData->addPoints([0, 1, 4, 9, 16, 25, 36, 49, 64, 81, 100]);
        $unique = date("Y.m.d_H.i");
        $gsFilename_Traffic = "traffic_".$unique.".png";

        $myData->setSerieDescription("Labels","Days");
        $myData->setAbscissa("Labels");
        $myData->setAxisUnit(0," KB");

        $serieSettings = array("R"=>229,"G"=>11,"B"=>11,"Alpha"=>100);
        $myData->setPalette("Total",$serieSettings);

        $myPicture = new pImage(1250,400,$myData); // <-- Размер холста
        $myPicture->setFontProperties(array("FontName"=>"fonts/tahoma.ttf","FontSize"=>8));
        $myPicture->setGraphArea(50,20,1230,380); // <-- Размещение графика на холсте
        $myPicture->drawScale();
        $myPicture->drawBestFit(array("Alpha"=>40)); // <-- Прямая статистики

        $myPicture->drawLineChart();
        $myPicture->drawPlotChart(array("DisplayValues"=>FALSE,"PlotBorder"=>TRUE,"BorderSize"=>0,"Surrounding"=>-60,"BorderAlpha"=>50)); // <-- Точки на графике
        $myPicture->drawLegend(700,10,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));// <-- Размещение легенды
        $myPicture->Render("pChartPic\\".$gsFilename_Traffic);
    }
}