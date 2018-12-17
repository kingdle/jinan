var dom = document.getElementById("chartsBars");
var myChart = echarts.init(dom);
var app = {};
option = null;
// Generate data

var fourdata=[{
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
    }]
var category = [];
var ten_feeData = [];
var itemAllData = [];
var itemStartData=[]
var itemFinishData=[]
for (var j=0; j<fourdata.length;j++){
    category.push([fourdata[j].district])
    ten_feeData.push(fourdata[j].ten_fee);
    itemAllData.push(fourdata[j].item_sum_all);
    itemStartData.push(fourdata[j].item_start)
    itemFinishData.push(fourdata[j].item_finish)
}


// option
option = {
    backgroundColor: '',
    tooltip: {
        trigger: 'axis',
        axisPointer: {
            type: 'shadow'
        }
    },
    legend: {
        data: ['line', 'bar'],
        textStyle: {
            color: '#ccc'
        }
    },
    xAxis: {
        data: category,
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        },
        axisLabel: {
            interval:0,
            rotate:40
        }
    },
    yAxis: {
        splitLine: {show: false},
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        }
    },
    series: [{
        name: '到位资金',
        type: 'line',
        smooth: true,
        showAllSymbol: true,
        symbol: 'emptyCircle',
        symbolSize: 15,
        data: ten_feeData
    }, {
        name: '开工项目数',
        type: 'bar',
        barWidth: 10,
        itemStyle: {
            normal: {
                barBorderRadius: 5,
                color: new echarts.graphic.LinearGradient(
                    0, 0, 0, 1,
                    [
                        {offset: 0, color: '#14c8d4'},
                        {offset: 1, color: '#43eec6'}
                    ]
                )
            }
        },
        data: itemStartData
    }, {
        name: '竣工项目数',
        type: 'bar',
        barGap: '-100%',
        barWidth: 10,
        itemStyle: {
            normal: {
                color: new echarts.graphic.LinearGradient(
                    0, 0, 0, 1,
                    [
                        {offset: 0, color: 'rgba(20,200,212,0.5)'},
                        {offset: 0.2, color: 'rgba(20,200,212,0.2)'},
                        {offset: 1, color: 'rgba(20,200,212,0)'}
                    ]
                )
            }
        },
        z: -12,
        data: itemFinishData
    }, {
        name: '总项目数',
        type: 'pictorialBar',
        symbol: 'rect',
        itemStyle: {
            normal: {
                color: '#1b6539'
            }
        },
        symbolRepeat: true,
        symbolSize: [12, 4],
        symbolMargin: 1,
        z: -10,
        data: itemAllData
    }]
};;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
