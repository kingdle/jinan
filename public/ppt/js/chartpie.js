/**
 * ---------------------------------------
 * This demo was created using amCharts 4.
 *
 * For more information visit:
 * https://www.amcharts.com/
 *
 * Documentation is available at:
 * https://www.amcharts.com/docs/v4/
 * ---------------------------------------
 */

am4core.useTheme(am4themes_animated);
am4core.useTheme(am4themes_dark);

var chart = am4core.create("chartpie", am4charts.PieChart3D);
chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

chart.data = [
    {
        country: "邹城区",
        litres: 14656
    },
    {
        country: "任城区",
        litres: 5763
    },
    {
        country: "兖州区",
        litres: 2899
    },
    {
        country: "曲阜市",
        litres: 5763
    },
    {
        country: "金乡县",
        litres: 2899
    },
    {
        country: "汶上县",
        litres: 5763
    },
    {
        country: "泗水县",
        litres: 2899
    },
    {
        country: "梁山县",
        litres: 5763
    },
    {
        country: "微山县",
        litres: 2899
    },
    {
        country: "嘉祥县",
        litres: 5763
    },
    {
        country: "鱼台县",
        litres: 2899
    },
    {
        country: "济宁高新区",
        litres: 5763
    },
    {
        country: "太白湖新区",
        litres: 2899
    }
];

chart.innerRadius = am4core.percent(40);
chart.depth = 120;
chart.legend = new am4charts.Legend();
chart.legend.position = "top";

var series = chart.series.push(new am4charts.PieSeries3D());
series.dataFields.value = "litres";
series.dataFields.depthValue = "litres";
series.dataFields.category = "country";
series.slices.template.cornerRadius = 5;
series.colors.step = 3;
