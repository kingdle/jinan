var dom = document.getElementById("chartsBars");
var myChart = echarts.init(dom);
var app = {};
option = null;
// Generate data

var fourdata = [{
    "count_dw": 28311,
    "areaCode": 370811,
    "areaName": "任城区",
    "count_gth": 51713,
    "count_all": 80024
}, {
    "count_dw": 8779,
    "areaCode": 370812,
    "areaName": "兖州区",
    "count_gth": 27271,
    "count_all": 36050
}, {
    "count_dw": 11519,
    "areaCode": 370826,
    "areaName": "微山县",
    "count_gth": 34320,
    "count_all": 45839
}, {
    "count_dw": 7899,
    "areaCode": 370827,
    "areaName": "鱼台县",
    "count_gth": 26108,
    "count_all": 34007
}, {
    "count_dw": 11837,
    "areaCode": 370828,
    "areaName": "金乡县",
    "count_gth": 25667,
    "count_all": 37504
}, {
    "count_dw": 11587,
    "areaCode": 370829,
    "areaName": "嘉祥县",
    "count_gth": 33066,
    "count_all": 44653
}, {
    "count_dw": 11706,
    "areaCode": 370830,
    "areaName": "汶上县",
    "count_gth": 39195,
    "count_all": 50901
}, {
    "count_dw": 11031,
    "areaCode": 370831,
    "areaName": "泗水县",
    "count_gth": 30171,
    "count_all": 41202
}, {
    "count_dw": 16974,
    "areaCode": 370832,
    "areaName": "梁山县",
    "count_gth": 33161,
    "count_all": 50135
}, {
    "count_dw": 12985,

    "areaCode": 370871,
    "areaName": "高新区",
    "count_gth": 15280,
    "count_all": 28265
}, {
    "count_dw": 674,
    "areaCode": 370872,
    "areaName": "太白湖新区",
    "count_gth": 2190,
    "count_all": 2864
}, {
    "count_dw": 1661,
    "areaCode": 370873,
    "areaName": "经济开发区",
    "count_gth": 3294,
    "count_all": 4955
}, {
    "count_dw": 9708,
    "areaCode": 370881,
    "areaName": "曲阜市",
    "count_gth": 41565,
    "count_all": 51273
}, {"count_dw": 16147, "areaCode": 370883, "areaName": "邹城市", "count_gth": 46898, "count_all": 63045}]
var areaName = [];
var count_gth = [];
var count_dw = [];
var count_all = []
var count_now = []
fourdata.sort(function (a, b) {
    return a.count_all-b.count_all;
})
for (var j = 0; j < fourdata.length; j++) {
    areaName.push([fourdata[j].areaName])
    count_gth.push(fourdata[j].count_gth);
    count_dw.push(fourdata[j].count_dw);
    count_all.push(fourdata[j].count_all)
    count_now.push(Math.round(Math.random()*(fourdata[j].count_all/5)))
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
        data: ['普查总数', '企业个数', '个体工商户数', '当前上报总数'],
        left: 'left',
        textStyle: {
            color: '#ccc'
        }
    },
    xAxis: {
        splitLine: {show: false},
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        }
    },
    yAxis: {
        data: areaName,
        axisLine: {
            lineStyle: {
                color: '#ccc'
            }
        },
        axisLabel: {
            interval: 0,
        }
    },
    series: [{
        name: '当前上报总数',
        type: 'line',
        smooth: true,
        showAllSymbol: true,
        symbol: 'emptyCircle',
        symbolSize: 15,
        data: count_now,
        markPoint : {
            data : [
                {type : 'max', name: '最大值'},
                {type : 'min', name: '最小值'}
            ]
        },
    }, {
        name: '企业个数',
        type: 'bar',
        barWidth: 10,
        itemStyle: {
            normal: {
                barBorderRadius: 5,
                color: new echarts.graphic.LinearGradient(
                    1, 0, 0, 0,
                    [
                        {offset: 0, color: '#c35b1a'},
                        {offset: 1, color: '#ff734c'}
                    ]
                )
            }
        },
        data: count_dw
    }, {
        name: '个体工商户数',
        type: 'bar',
        barGap: '-100%',
        barWidth: 10,
        itemStyle: {
            normal: {
                barBorderRadius: 10,
                color: new echarts.graphic.LinearGradient(
                    1, 0, 0, 0,
                    [
                        {offset: 0, color: '#14c8d4'},
                        {offset: 1, color: '#43eec6'}
                    ]
                )
            }
        },
        z: -12,
        data: count_gth
    }, {
        name: '普查总数',
        type: 'pictorialBar',
        barWidth: 10,
        symbol: 'rect',
        itemStyle: {
            normal: {
                barBorderRadius: 5,
                color: '#207a45'
            }
        },
        symbolRepeat: true,
        symbolSize: [22, 10],
        symbolMargin: 1,
        z: -15,
        data: count_all
    }]
};
;
if (option && typeof option === "object") {
    myChart.setOption(option, true);
}
