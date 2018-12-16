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

// Themes begin
am4core.useTheme(am4themes_animated);
am4core.useTheme(am4themes_dark);
// Themes end

// Create chart instance
var chart = am4core.create("chartsBars", am4charts.XYChart);
chart.paddingBottom = 30;
chart.angle = 35;

// Add data



chart.data = [{
    "ten_fee": 44.94,
    "fee": 1800.38,
    "item_sum": 26,
    "item_sum_all": 45,
    "item_start": 11,
    "item_finish": 8,
    "district": "微山县",
    "pic": "https://images.qdbfg.com/jining/weishan.png",
    "id": 9
},
    {
        "ten_fee": 32.78,
        "fee": 1800.38,
        "item_sum": 11,
        "item_sum_all": 18,
        "item_start": 6,
        "item_finish": 1,
        "district": "鱼台县",
        "pic": "https://images.qdbfg.com/jining/yutai.png",
        "id": 11
    },
    {
        "ten_fee": 26.63,
        "fee": 1800.38,
        "item_sum": 23,
        "item_sum_all": 35,
        "item_start": 10,
        "item_finish": 2,
        "district": "兖州区",
        "pic": "https://images.qdbfg.com/jining/yanzhou.png",
        "id": 3
    },
    {
        "ten_fee": 25.93,
        "fee": 1800.38,
        "item_sum": 27,
        "item_sum_all": 49,
        "item_start": 13,
        "item_finish": 6,
        "district": "曲阜市",
        "pic": "https://images.qdbfg.com/jining/qufu.png",
        "id": 4
    },
    {
        "ten_fee": 17.39,
        "fee": 1800.38,
        "item_sum": 7,
        "item_sum_all": 14,
        "item_start": 6,
        "item_finish": 1,
        "district": "济宁高新区",
        "pic": "https://images.qdbfg.com/jining/gaoxinqu.png",
        "id": 12
    },
    {
        "ten_fee": 13.72,
        "fee": 1800.38,
        "item_sum": 7,
        "item_sum_all": 9,
        "item_start": 2,
        "item_finish": 0,
        "district": "任城区",
        "pic": "https://images.qdbfg.com/jining/rencheng.png",
        "id": 2
    },
    {
        "ten_fee": 9.26,
        "fee": 1800.38,
        "item_sum": 26,
        "item_sum_all": 50,
        "item_start": 24,
        "item_finish": 0,
        "district": "梁山县",
        "pic": "https://images.qdbfg.com/jining/liangshan.png",
        "id": 8
    },
    {
        "ten_fee": 8.62,
        "fee": 1800.38,
        "item_sum": 17,
        "item_sum_all": 35,
        "item_start": 12,
        "item_finish": 6,
        "district": "嘉祥县",
        "pic": "https://images.qdbfg.com/jining/jiaxiang.png",
        "id": 10
    },
    {
        "ten_fee": 6.41,
        "fee": 1800.38,
        "item_sum": 13,
        "item_sum_all": 23,
        "item_start": 7,
        "item_finish": 3,
        "district": "金乡县",
        "pic": "https://images.qdbfg.com/jining/jinxiang.png",
        "id": 5
    },
    {
        "ten_fee": 5.09,
        "fee": 1800.38,
        "item_sum": 9,
        "item_sum_all": 18,
        "item_start": 8,
        "item_finish": 1,
        "district": "济宁经开区",
        "pic": "https://images.qdbfg.com/jining/jingkaiqu.png",
        "id": 13
    },
    {
        "ten_fee": 4.23,
        "fee": 1800.38,
        "item_sum": 10,
        "item_sum_all": 20,
        "item_start": 8,
        "item_finish": 2,
        "district": "泗水县",
        "pic": "https://images.qdbfg.com/jining/sishui.png",
        "id": 7
    },
    {
        "ten_fee": 2.34,
        "fee": 1800.38,
        "item_sum": 17,
        "item_sum_all": 43,
        "item_start": 14,
        "item_finish": 12,
        "district": "汶上县",
        "pic": "https://images.qdbfg.com/jining/wenshang.png",
        "id": 6
    },
    {
        "ten_fee": 0.98,
        "fee": 1800.38,
        "item_sum": 9,
        "item_sum_all": 16,
        "item_start": 5,
        "item_finish": 2,
        "district": "邹城区",
        "pic": "https://images.qdbfg.com/jining/zoucheng.png",
        "id": 1
    },
    {
        "ten_fee": 0,
        "fee": 1800.38,
        "item_sum": 1,
        "item_sum_all": 2,
        "item_start": 1,
        "item_finish": 0,
        "district": "太白湖新区",
        "pic": "https://images.qdbfg.com/jining/taibaihu.png",
        "id": 14
    }];


let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "district";
categoryAxis.renderer.minGridDistance = 80;

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

let series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryX = "district";
series.dataFields.valueY = "ten_fee";
series.tooltipText = "十强产业到位资金：{valueY.value}"
series.columns.template.strokeOpacity = 0;

chart.cursor = new am4charts.XYCursor();

// Add distinctive colors for each column using adapter
series.columns.template.adapter.add("fill", (fill, target) => {
    return chart.colors.getIndex(target.dataItem.index);
});
